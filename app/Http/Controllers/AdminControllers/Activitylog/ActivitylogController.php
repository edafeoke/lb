<?php

namespace App\Http\Controllers\AdminControllers\Activitylog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\User;
use Auth;

class ActivitylogController extends Controller
{
    public function __construct()
    {
        if (setting('email_verification')) {
            $this->middleware(['verified']);
        }

        $this->middleware(['auth','web','2fa','role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->adminLog();
    }

    /**
     * If user has admin role it fetches all logs
     * @return [type] [description]
     */
    private function adminLog()
    {
        $activities = Activity::orderByDesc('created_at')->get();
        return view('admin-views.activitylog.adminLog', [
        'activities' => $activities,
      ]);
    }

}
