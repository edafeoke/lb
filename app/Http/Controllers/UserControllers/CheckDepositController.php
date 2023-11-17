<?php

namespace App\Http\Controllers\UserControllers;

use App\CheckDeposit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class CheckDepositController extends Controller
{
    public function __construct(CheckDeposit $check)
    {
        $this->middleware(['auth','web']);

        $this->check = $check;
    }

    public function index()
    {
        $checks = auth()->user()->checks()->get();

        return view('check-deposit.index',[
            'checks' => $checks,
        ]);
    }

    public function createCheckDeposit()
    {
        return view('check-deposit.create-check-deposit');
    }

    public function storeCheckDeposit(Request $request)
    {
        $this->validate($request,[
            "amount" => "required|regex:/^\d+(\.\d{1,2})?$/",
            'front_view' => 'required|image|max:2048|mimes:jpeg,bmp,png,jpg',
            'back_view' => 'required|image|max:2048|mimes:jpeg,bmp,png,jpg',
            'date' => 'required|date_format:Y-m-d',
        ]);

        $front = $request->file('front_view');
        $back = $request->file('back_view');

        $title = Str::slug(auth()->user()->fullnames).'-'.Str::random(10);

        $front_title = $title.'-front-view'.'.'. $front->getClientOriginalExtension();
        $back_title = $title.'-back-view'.'.'. $back->getClientOriginalExtension();

        $path = storage_path('/checks');

        $front->move($path,$front_title);
        $back->move($path,$back_title);

        $data = [
            'amount'  => $request->amount * 100,
            'date'  => $request->date,
            'front_view' => $front_title,
            'back_view' => $back_title,
            'slug' => $title,
        ];

        auth()->user()->checks()->create($data);

        alert()->success('Check deposited successfully')->persistent('close');
        return back();

    }

    public function downloadChecks($page,CheckDeposit $check)
    {
        if($page == 'front-view'){
            $file = Storage::disk('checks')->get($check->back_view);
            return (new Response($file, 200))->header('Content-Type', 'image/jpeg')->header('Content-Type', 'image/bmp')->header('Content-Type', 'image/png');
        }

        if($page == 'back-view'){
            $file = Storage::disk('checks')->get($check->back_view);
            return (new Response($file, 200))->header('Content-Type', 'image/jpeg')->header('Content-Type', 'image/bmp')->header('Content-Type', 'image/png');
        }
    }

    public function redirectChecks()
    {
        return redirect('account/check-deposit');
    }
}
