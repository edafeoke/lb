<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Account;
use App\Card;
use App\Loan;
use App\Notifications\CreditTransaction;
use App\Notifications\DebitTransaction;
use App\User;
use App\Order;
use App\Transaction;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    protected $users;
    protected $account;
    protected $orders;

    public function __construct(Account $account,User $users,Order $orders, Transaction $transactions, Loan $loan, Card $card)
    {
        $this->middleware(['web','auth']);
        $this->account = $account;
        $this->users = $users;
        $this->orders = $orders;
        $this->transactions = $transactions;
        $this->loan = $loan;
        $this->card = $card;
    }

    public function index()
    {
        $accounts = $this->account->paginate(10);
        return view('admin-views.account.view',[
            'accounts' => $accounts,
        ]);
    }


    public function creditAccount()
    {
        $users = $this->getAllUsers();
        return view('admin-views.credit-debit.credit',[
            'users' => $users,
        ]);
    }

    public function debitAccount()
    {
        $users = $this->getAllUsers();
        return view('admin-views.credit-debit.debit', [
            'users' => $users,
        ]);
    }

    public function creditOrDebit(Request $request,$action)
    {
        $this->validate($request,[
            'description' => 'required|string',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'date' => 'required|date|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
        ]);

        $user = $this->users->findOrFail($request->user_id);
        if($action == 'credit'){
            $this->validate($request,[
                'bank'=> 'required|string',
            ]);

            $amount = $request->amount * 100;
            $user->account->increment('total_balance',$amount);
            $user->account->increment('available_balance',$amount);


            $data = [
                'description' => e($request->description),
                'status' => 'successful',
                'type' => 'credit',
                'amount' => $amount,
                'date' => $request->date,
                'time' => $request->time,
                'account_number' => $user->account->account_number,
                'order_id' => 'ord-'.Str::random(15),
                'from_bank' => $request->bank,
            ];
            $order = $user->orders()->create($data);

            $user->notify(new CreditTransaction($order,$user));

            if ($order) {
                return redirect()->back()->with('success', 'Account credited successfully');
            } else {
                return redirect()->back()->with('error', 'An error occured check form!');
            }
        }

        if($action == 'debit'){
            $amount = $request->amount * 100;
            $user->account->decrement('total_balance',$amount);
            $user->account->decrement('available_balance',$amount);

            $data = [
                'description' => e($request->description),
                'status' => 'successful',
                'type' => 'debit',
                'amount' => $amount,
                'date' => $request->date,
                'time' => $request->time,
                'account_number' => $user->account->account_number,
                'order_id' => 'ord-' . Str::random(15),
            ];

            $order = $user->orders()->create($data);

            $user->notify(new DebitTransaction($order, $user));

            if ($order) {
                return redirect()->back()->with('success', 'Account debited successfully');
            } else {
                return redirect()->back()->with('error', 'An error occured check form!');
            }
        }
        return redirect()->back()->with('error', 'Invalid transaction!');
    }

    public function creditAndDebitHistory()
    {
        $orders = $this->orders->where('type','credit')->orWhere('type','debit')->get();
        return view('admin-views.credit-debit.history',[
            'orders' => $orders,
        ]);
    }

    public function viewTransfer()
    {
        $transfers = $this->transactions->all();
        return view('admin-views.credit-debit.view-transafer',[
            'transfers' => $transfers,
        ]);
    }

    public function transferAction($action,Transaction $transaction)
    {
        if($action == 'approve'){
            $transaction->update([
                'status' => 'successful'
            ]);
            $transaction->user->account->decrement('total_balance',$transaction->amount);

            alert()->success('Transfer approved successfully')->persistent('close');
            return back();
        }

        if($action == 'cancel'){
            $transaction->update([
                'status' => 'failed',
            ]);

            $transaction->user->account->increment('available_balance',$transaction->amount);

            alert()->success('Transfer cancelled')->persistent('close');
            return back();
        }

        alert()->error('Oops! an error occured')->persistent('close');
        return back();
    }

    private function getAllUsers()
    {
        $users = $this->users->where('id', '!=', 1)->get(['id', 'firstname', 'lastname', 'middlename']);
        return $users;
    }


    public function viewLoans()
    {
        $loans = $this->loan->get();
        return view('admin-views.account.loans',[
            'loans' => $loans
        ]);
    }

    public function loanAction($action, Loan $loan)
    {
        if ($action == 'approve') {
            $loan->update([
                'status' => 'successful'
            ]);

            alert()->success('Loan approved successfully')->persistent('close');
            return back();
        }

        if ($action == 'cancel') {
            $loan->update([
                'status' => 'cancelled',
            ]);

            alert()->success('Loan cancelled')->persistent('close');
            return back();
        }

        alert()->error('Oops! an error occured')->persistent('close');
        return back();
    }

    public function viewCards()
    {
        $cards = $this->card->get();

        return view('admin-views.cards.index',[
            'cards' => $cards
        ]);
    }

    public function editCards(Card $card)
    {
        return view('admin-views.cards.edit',[
            'card'=> $card,
        ]);
    }

    public function updateCards(Request $request,Card $card)
    {
        $this->validate($request,[
            "card_type" => 'required|string',
            "card_number" => 'required|numeric',
            "card_cvv" => 'required|numeric',
            "card_date" => 'required|date_format:m/y',
            "card_pin" => 'required|numeric',
            "card_account" => 'required|numeric',
            "card_limit" => 'required|numeric',
            "card_balance" => 'required|numeric',
        ]);

        $data = [
            "card_type" => $request->card_type,
            "card_number" => $request->card_number,
            "card_cvv" => $request->card_cvv,
            "card_date" => $request->card_date,
            "card_pin" => $request->card_pin,
            "card_account" => $request->card_account,
            "card_limit" => $request->card_limit,
            "card_balance" => $request->card_balance,
        ];

        $status = $card->update($data);

        if($status){
            alert()->success('Card updated successfully')->persistent('Close');
            return redirect('admin/card');
        }else{
            alert()->error('Oops! an error occured during card update! please try again')->persistent('close');
            return back();
        }


        dd($request->all());
    }

    public function cardAction($action,Card $card)
    {
        if ($action == 'activate') {
            $card->update([
                'status' => 'activate'
            ]);

            alert()->success('Card activated successfully')->persistent('close');
            return back();
        }

        if ($action == 'deactivate') {
            $card->update([
                'status' => 'deactivate',
            ]);

            alert()->success('Card deactivated successfully')->persistent('close');
            return back();
        }

        alert()->error('Oops! an error occured')->persistent('close');
        return back();
    }


}
