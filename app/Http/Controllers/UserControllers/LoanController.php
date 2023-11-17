<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Loan;
use Illuminate\Http\Request;
use App\User;

class LoanController extends Controller
{
    public function __construct(Loan $loan, User $user)
    {
        $this->loan = $loan;
        $this->user = $user;
    }


    public function index()
    {
        $loans = auth()->user()->loans()->get();
        return view('loan.index',[
            'loans' => $loans,
        ]);
    }

    public function create()
    {
        return view('loan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'reason' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'duration' => 'required|string',
        ]);

        $data = [
            'amount' => $request->amount * 100,
            'reason' => e($request->reason),
            'date' => $request->date,
            'duration' => $request->duration,
        ];

        $loan = auth()->user()->loans()->create($data);
        if($loan){
            alert()->success('Loan initiated successfully, awaiting response')->persistent('Close');
            return redirect('/account/loan');
        }else{
            alert()->error('Oops! an error occured during loan application')->persistent('close');
            return back();
        }
    }
}
