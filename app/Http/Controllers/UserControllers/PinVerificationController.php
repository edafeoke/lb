<?php

namespace App\Http\Controllers\UserControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PinVerificationController extends Controller
{

    public function __construct()
    {
        $this->middleware(['web','auth']);
    }

    public function showVerification()
    {
        if(auth()->user()->hasVerified()){
            return redirect('/');
        }
        return view('auth.verify-pin');
    }

    public function verify(Request $request)
    {
        if($request->pin !== auth()->user()->account_pin){
            return back()->with('error','Invalid pin entered! please try again');
        }

        $request->user()->update([
            'pin_verified_at' => now(),
        ]);

        return redirect('/');
    }
}
