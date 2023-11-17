<?php

namespace App\Http\Controllers\UserControllers;

use App\Card;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    protected $user;
    protected $card;

    public function __construct(User $user,Card $card)
    {
        $this->middleware(['web','auth']);

        $this->card = $card;
        $this->user = $user;
    }

    public function index()
    {
        return view('cards.index');
    }

    public function cardApplication()
    {
        return view('cards.application');
    }

    public function applyForCard(Request $request)
    {
        $this->validate($request,[
            'card_type' => 'required|string'
        ]);

        $data= [
            'card_type' => $request->card_type,
        ];

        $card = auth()->user()->card()->create($data);

        if($card){
            alert()->success('Application submitted successfully')->persistent('close');
            return redirect('account/card');
        }else{
            alert()->error('Oops! an error occured during card application. please try again')->persistent('close');
            return back();
        }
    }
}
