<?php

namespace App\Http\Controllers\UserControllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
      private $user;

      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct(User $user, Transaction $transfer)
      {
        if(setting('email_verification')){
            $this->middleware(['verified']);
        }
        $this->middleware(['auth','web','2fa']);

        $this->user = $user;
        $this->transfer = $transfer;
      }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin')){
            return redirect('/admin');
        }
        return $this->defaultDashboard();
    }

    /**
     * Function directs users to default dashboard
     * @return view default user dashboard
     */
    private function defaultDashboard()
    {
        $lastWithdrawal = 0;
        $withdrawal = auth()->user()->orders->where('type','transfer')->last();
        if($withdrawal){
            $lastWithdrawal = $withdrawal->amount;
        }

        $transfers = auth()->user()->transaction()->get();

        return view('dashboard.default',[
            'lastWithdrawal' => $lastWithdrawal,
            'transfers' => $transfers

        ]);
    }
}
