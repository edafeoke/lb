<?php

namespace App\Http\Controllers\AdminControllers;

use App\CheckDeposit;
use App\Http\Controllers\Controller;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CheckDepositController extends Controller
{

    public function __construct(CheckDeposit $check)
    {
        $this->middleware(['web','auth','role:admin']);

        $this->check = $check;
    }

    public function index()
    {
        $checks = $this->check->get();
        return view('admin-views.account.check-deposit',[
            'checks' => $checks
        ]);
    }

    public function downloadChecks($page, CheckDeposit $check)
    {
        if ($page == 'front-view') {
            $file = Storage::disk('checks')->get($check->front_view);
            return (new Response($file, 200))->header('Content-Type', 'image/jpeg')->header('Content-Type', 'image/bmp')->header('Content-Type', 'image/png');
        }

        if ($page == 'back-view') {
            $file = Storage::disk('checks')->get($check->back_view);
            return (new Response($file, 200))->header('Content-Type', 'image/jpeg')->header('Content-Type', 'image/bmp')->header('Content-Type', 'image/png');
        }
    }

    public function redirectChecks()
    {
        return redirect('account/check-deposit');
    }

    public function checkAction($action, CheckDeposit $check)
    {
        if ($action == 'approve') {
            $check->update([
                'status' => 'successful'
            ]);

            $check->user->account->increment('total_balance',$check->amount);
            $check->user->account->increment('available_balance',$check->amount);

            $data = [
                'description' => "Check deposit",
                'status' => 'successful',
                'type' => 'credit',
                'amount' => $check->amount,
                'date' => date('Y-m-d',time()),
                'time' => date('H:i', time()),
                'account_number' => $check->user->account->account_number,
                'order_id' => 'ord-' . Str::random(15),
            ];

            $order = $check->user->orders()->create($data);

            $check->user->notify(new OrderNotification($order, $check->user));

            alert()->success('Check approved successfully')->persistent('close');
            return back();
        }

        if ($action == 'cancel') {
            $check->update([
                'status' => 'failed',
            ]);

            alert()->success('Check cancelled')->persistent('close');
            return back();
        }

        alert()->error('Oops! an error occured')->persistent('close');
        return back();
    }

}
