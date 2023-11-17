<?php

namespace App\Http\Controllers\AdminControllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\Permission;
use App\Account;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order,Account $accounts)
    {
        if(setting('email_verification')){
            $this->middleware(['verified']);
        }
        $this->middleware(['auth','web','2fa','role:admin']);

        $this->user = $user;
        $this->order = $order;
        $this->account = $accounts;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
          return $this->adminDashboard();
    }

    /**
     * return admin users to admin dashboard
     * @return
     */
    private function adminDashboard()
    {
          $users = User::count();
          $transactions = $this->order->count();
          $activities = Activity::count();
          $latest_user_count = $this->getLatestUsers()->count();
          $latest_user = $this->getLatestUsers()->take(8)->get();
          $orders = $this->order->get();
          $accounts = $this->account->orderBy('id')->get();

          return view('admin-views.dashboard.admin',[
            'users' => $users,
            'transactions'=> $transactions,
            'activities'=> $activities,
            'latest_users_count' => $latest_user_count,
            'latest_users' => $latest_user,
            'orders' => $orders,
            'accounts' => $accounts,
          ]);
    }


    private function getLatestUsers()
    {
        return $this->user->whereBetween('created_at', [
        now()->subDay(3)->toDateString(),now()->addDay()->toDateString()
      ]);
    }
}
