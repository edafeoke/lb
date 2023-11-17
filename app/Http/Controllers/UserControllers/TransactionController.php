<?php

namespace App\Http\Controllers\UserControllers;

use App\User;
use App\Transaction;
use App\TransferOtp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\TransactionInitiated;
use App\Notifications\TransferNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransferOtp as TransferOtpNotification;

class TransactionController extends Controller
{

    protected $transaction;

    public function __construct(Transaction $transaction, User $user, TransferOtp $transferOtp)
    {
        $this->middleware(['web','auth']);
        $this->transaction = $transaction;
        $this->user = $user;
        $this->transferOtp = $transferOtp;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = auth()->user()->orders()->get();
        return view('transaction.view-transactions',[
            'orders' => $orders
        ]);
    }

    public function viewTransfer()
    {
        $transfers = auth()->user()->transaction->all();
        return view('transaction.view-transfer',[
            'transfers' => $transfers
        ]);
    }

    public function redirectToMakeTransfer()
    {
        return redirect('/account');
    }

    public function makeTransfer($type)
    {
        if($type == 'intra-bank'){
            return view('transaction.make-transfer-intrabank',[
                'tab' => 1,
                'data' => collect([]),
                'error' => ''
            ]);
        }

        if($type == 'inter-bank'){
            return view('transaction.make-transfer-interbank', [
                'tab' => 1,
                'data' => collect([]),
                'error' => ''
            ]);
        }

        if ($type == 'wire-transfer') {
            return view('transaction.make-transfer-wire-transfer', [
                'tab' => 1,
                'data' => collect([]),
                'error' => ''
            ]);
        }

        alert()->error('Unknown request')->persistent('close');
        return redirect('/account');
    }

    public function processTransfer(Request $request,$page,$type)
    {
           if($type == 'inter-bank'){

                $info = [
                    "amount" => $request->amount * 100,
                    "account_name" => $request->account_name,
                    "account_number" => $request->account_number,
                    "account_type" => $request->account_type,
                    "bank_name" => $request->bank_name,
                    "swift" => $request->swift,
                    "routing" => $request->routing,
                    "date" => $request->date,
                    "remarks" => $request->remarks,
                    "type" => 'inter-bank',
                ];

                $amount = $request->amount * 100;

                if(auth()->user()->account->available_balance < $amount){
                    return response()->json([
                        'status' => false,
                        'message' => 'Insuffient Balance',
                    ],500);
                }

                if($page == 1){

                    $this->validate($request,[
                        "amount" => "required|regex:/^\d+(\.\d{1,2})?$/",
                        "account_name" => "required|regex:/^[A-Za-z0-9_.,()\- ]+$/",
                        "account_number" =>"required|numeric",
                        "account_type" => "required",
                        "bank_name" => "required|regex:/^[A-Za-z0-9_.,()\- ]+$/",
                        "swift" =>"required|string",
                        "routing" =>"required|string",
                        "remarks" =>"required",
                        'date' => 'required|date_format:Y-m-d',
                    ],[
                     'amount.regex' => 'Invalid amount entered. Amount must be in digits'
                   ]);
                    $token = rand(100000, 999999);
                   $data = $this->transferOtp->updateOrCreate([
                        'user_id' => auth()->user()->id,
                    ],[
                        'data' => serialize($info),
                        'slug' => Str::random(35),
                        'otp' => $token,
                   ]);
                   Notification::route('mail', auth()->user()->email)->notify(new TransferOtpNotification($token,auth()->user()));
                    return response()->json([
                        'tab' => 2,
                        'slug' => $data->slug,
                        'error' => '',
                    ]);
                }
                if ($page == 2) {
                    if (auth()->user()->account->cot !== $request->fcc) {
                        return response()->json([
                            'tab' => 2,
                            'slug' => $request->slug,
                            'error' => 'Invalid FCC code! please try again'
                        ], 400);
                    }
                    return response()->json([
                        'tab' => 3,
                        'slug' => $request->slug,
                        'error' => ''
                    ], 200);
                }
                if ($page == 3) {
                    if (auth()->user()->account->tax !== $request->tax) {
                        return response()->json([
                            'tab' => 3,
                            'data' => collect($request['data']),
                            'error' => 'Invalid FCC code! please try again'
                        ], 400);
                    }
                    return response()->json([
                        'tab' => 4,
                        'slug' => $request->slug,
                        'error' => ''
                    ], 200);
                }
                if ($page == 4) {
                    if (auth()->user()->account->imf !== $request->imf) {
                        return response()->json([
                            'tab' => 4,
                            'slug' => $request->slug,
                            'error' => 'Invalid TAX code! please try again'
                        ], 400);
                    }
                    return response()->json([
                        'tab' => 5,
                        'slug' => $request->slug,
                        'error' => ''
                    ], 200);
                }
                if($page == 5){
                    $transfer = $this->transferOtp->where('slug',$request->slug)->first();
                    if(!$transfer){
                        return response()->json([
                            'status' => false,
                            'message' => 'Invalid request',
                        ],500);
                    }
                    if ($transfer->otp !== $request->otp) {
                        return response()->json([
                            'tab' => 2,
                            'error' => 'Invalid OTP! please try again'
                        ],400);
                    }
                    $data = unserialize($transfer->data);
                    $amount = $data['amount'];
                    $transaction = auth()->user()->transaction()->create($data);
                    if(!$transaction){
                        return response()->json([
                            'status'=> true,
                            'message' => '',
                            'tab' => 5,
                            'slug' => $request->slug,
                            'error' => 'Oops! an error occured'
                        ],500);
                    }
                    $this->getAdmin()->notify(new TransferNotification($transaction, auth()->user()));
                    auth()->user()->account->decrement('available_balance', $amount);
                    auth()->user()->notify(new TransactionInitiated($transaction, auth()->user()));
                    optional($transfer)->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Transfer initiated successfully',
                        'tab' => 5,
                    ], 200);
                }
            }

           if($type == 'intra-bank'){

                $info = [
                    "amount" => $request->amount * 100,
                    "account_number" => $request->account_number,
                    "date" => $request->date,
                ];

                $amount = $request->amount * 100;

                if (auth()->user()->account->available_balance < $amount) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Insuffient Balance',
                    ],500);
                }

            if($page == 1){
                    $this->validate($request,[
                        "amount" => "required|regex:/^\d+(\.\d{1,2})?$/",
                        "account_number" =>"required|numeric",
                        'date' => 'required|date_format:Y-m-d',
                    ]);

                    $user = $this->user->where('account_number',$request->account_number)->first();

                    if(!$user){
                         return response()->json([
                            'status' => false,
                            'message' => 'Invalid account number! check and try again',
                         ],500);
                        // alert()->error('Invalid account number! check and try again')->persistent('Close');
                        // return back();
                    }

                    $token = rand(100000, 999999);
                    $data = $this->transferOtp->updateOrCreate([
                        'user_id' => auth()->user()->id,
                    ],[
                        'slug' => Str::random(35),
                        'otp' => $token,
                        'data' => serialize($info),
                    ]);
                    Notification::route('mail', auth()->user()->email)->notify(new TransferOtpNotification($token, auth()->user()));
                    return response()->json([
                        'tab' => 2,
                        'slug' => $data->slug,
                        'error' => '',
                        'status' => true,
                        'message' => 'success',
                    ]);
            }
            if ($page == 2) {
                if (auth()->user()->account->cot !== $request->fcc) {
                    return response()->json([
                        'tab' => 2,
                        'slug' => $request->slug,
                        'error' => 'Invalid FCC code! please try again'
                    ], 400);
                }
                return response()->json([
                    'tab' => 3,
                    'slug' => $request->slug,
                    'error' => ''
                ], 200);
            }
            if ($page == 3) {
                if (auth()->user()->account->tax !== $request->tax) {
                    return response()->json([
                        'tab' => 3,
                        'data' => collect($request['data']),
                        'error' => 'Invalid FCC code! please try again'
                    ], 400);
                }
                return response()->json([
                    'tab' => 4,
                    'slug' => $request->slug,
                    'error' => ''
                ], 200);
            }
            if ($page == 4) {
                if (auth()->user()->account->imf !== $request->imf) {
                    return response()->json([
                        'tab' => 4,
                        'slug' => $request->slug,
                        'error' => 'Invalid TAX code! please try again'
                    ], 400);
                }
                return response()->json([
                    'tab' => 5,
                    'slug' => $request->slug,
                    'error' => ''
                ], 200);
            }
            if($page == 5){
                $transfer = $this->transferOtp->where('slug',$request->slug)->first();
                if(!$transfer){
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid request',
                    ],500);
                }
                if ($transfer->otp !== $request->otp) {
                    return response()->json([
                        'tab' => 5,
                        'error' => 'Invalid OTP! please try again'
                    ],400);
                }
                $data = unserialize($transfer->data);
                $amount = $data['amount'];
                $user = $this->user->whereAccountNumber($data['account_number'])->first();
                if($user){
                    $dt = [
                        "amount" => $data['amount'],
                        "date" => $data['date'],
                        "account_name" => $user->fullnames,
                        "account_number" => $user->account->account_number,
                        "account_type" => $user->account->account_type,
                        "bank_name" =>setting('app_name'),
                        "swift" => rand(100000, 999999),
                        "routing" => rand(100000, 999999),
                        "remarks" => 'Intra-bank transfer to '. $user->fullnames,
                        "type" => 'intra-bank'
                    ];

                    $transaction = auth()->user()->transaction()->create($dt);

                    if($transaction){
                        $this->getAdmin()->notify(new TransferNotification($transaction,auth()->user()));
                        auth()->user()->notify(new TransactionInitiated($transaction,auth()->user()));
                        auth()->user()->account->decrement('available_balance', $amount);

                        return response()->json([
                            'status'=> true,
                            'message' => 'Transfer initiated successfully',
                            'tab' => 4,
                        ],200);
                    }else{
                        return response()->json([
                            'status'=> true,
                            'message' => '',
                            'tab' => 4,
                            'error' => 'Oops! an error occured'
                        ],500);
                    }
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid account number! check and try again',
                        ],500);
                }
            }
        }
    }

    public function getAdmin()
    {
        return $this->user->find(1);
    }

}
