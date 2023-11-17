<?php

namespace App\Http\Controllers\UserControllers\Auth;

use Auth;
use App\User;
use App\Account;
use App\TempRegistration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\NewUser;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\RegistrationVerificationOTP;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    protected $user;

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, TempRegistration $tempRegistration)
    {
        $this->middleware('guest');
        $this->user = $user;
        $this->tempRegistration = $tempRegistration;
    }

    public function initiateRegistration(Request $request)
    {
        $this->validate($request,[
            'firstname' => 'required|regex:/^[A-Za-z0-9_.,() ]+$/',
            'lastname' => 'required|regex:/^[A-Za-z0-9_.,() ]+$/',
            'middlename' => 'nullable|regex:/^[A-Za-z0-9_.,() ]+$/',
            'username' => 'required|unique:users|regex:(^[a-zA-Z0-9_]+)',
            'email' => 'required|email|unique:users',
            'password' => 'required', 'string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
            'birthday' => 'required|date|date_format:Y-m-d',
            'occupation' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'marital_status' => 'required|string',
            'currency' => 'required|string',
        ]);

        // generate 6 random digits as token
        $token = rand(100000, 999999);
        $data = [
            "firstname" => e($request->firstname),
            "middlename" => e($request->middlename),
            "lastname" => e($request->lastname),
            "email" => $request->email,
            "username" => $request->username,
            "phone" => $request->phone,
            "password" => bcrypt($request->password),
            "birthday" => $request->birthday,
            "sex" => $request->sex,
            "marital_status" => $request->marital_status,
            "occupation" => e($request->occupation),
            "address" => e($request->address),
            "currency" => $request->currency,
            'avatar' => URL::to('/') . "/uploads/avatar/avatar.png",
            "status" => 'pending',
        ];
        // Serialize $data
        $temp = $this->tempRegistration->updateOrCreate(['email' => $request->email],
        [
            'token' => $token,
            'data' => serialize($data),
            'slug' => Str::random(35),
        ]);
        // Send Notification to $request->email
        Notification::route('mail',$request->email)->notify(new RegistrationVerificationOTP($token,$request->firstname));
        return redirect()->route('account.register.verify-otp',['q='.$temp->slug])->with('success', 'Please check your email for verification code.');
    }

    public function registrationVerification()
    {
        if(!request()->q){
            return redirect('/account/register')->with('error','Oop! an error occured please try again!');
        }
        return view('auth.registration-otp');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $info = [
              "firstname" => $data['firstname'],
              "middlename" => $data['middlename'],
              "lastname" => $data['lastname'],
              "email" => $data['email'],
              "username" => $data['username'],
              "phone" => $data['phone'],
              "password" => bcrypt($data['password']),
              "birthday" => $data['birthday'],
              "sex" => $data['sex'],
              "marital_status" => $data['marital_status'],
              "occupation" => $data['occupation'],
              "address" => $data['address'],
              'avatar' => URL::to('/')."/uploads/avatar/avatar.png",
              "status" => 'pending',
        ];

        $user =  User::create($info);

        $account = new Account;
        $account->user_id = $user->id;
        $account->save();

        $user->assignRole('users');

		     // Logging activity for created role
		    activity()->performedOn($user)->withProperties(['name'=>$user->username,'by'=>$user->username])->causedBy($user)->log('Account was registered');
  		  return $user;
    }

        /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // $this->validator($request->all())->validate();
        $this->validate($request,[
            'otp' => 'required|numeric',
        ]);
        $tempRegistration = $this->tempRegistration->where('slug', $request->slug)->first();
        if($tempRegistration->token !== $request->otp){
            return redirect()->back()->with('error','Invalid OTP!');
        }
        $data = unserialize($tempRegistration->data);
        $user = $this->create($data);
        $this->tempRegistration->where('slug', $request->slug)->delete();
        return $this->registered($request, $user)
        ?: redirect($this->redirectPath());
        // return redirect()->route('account.login')->with('success', 'Account was created successfully.');
    }

     /**
       * The user has been registered.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  mixed  $user
       * @return mixed
       */
      protected function registered(Request $request, $user)
      {
          $user->notify(new WelcomeNotification($user));

          $admin = User::find(1);
          $admin->notify(new NewUser($user));
          return redirect()->route('account.successful-account',$user->id);
      }

      public function createdSuccessfully($id)
      {
          $user = User::find($id);

          if($user){
              return view('auth.created-successfully');
          }

          return redirect('/account/login');
      }
}
