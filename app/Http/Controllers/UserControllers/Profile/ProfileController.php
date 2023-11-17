<?php

namespace App\Http\Controllers\UserControllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Image;
use URL;
use Auth;
use PragmaRX\Countries\Package\Countries;
use App\Google2fa as TwoFactor;
use Google2FA;
use Hash;

class ProfileController extends Controller
{
    protected $country;

    public function __construct(Countries $country)
    {
        if (setting('email_verification')) {
            $this->middleware(['verified']);
        }
        $this->middleware(['auth','web','2fa']);
        $this->countries = $country->all()->sortBy('name.common')->pluck('name.common');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!setting('2fa')) {
            $user = auth()->user();
            $role = $user->roles->first();
            $activies = auth()->user()->actions->sortByDesc('created_at')->take(6)->all();
            $countries = $this->countries;
            return view('users.profile.index', [
            'user' => $user,
            'role' => $role,
            'activities' => $activies,
            'countries' => $countries,
          ]);
        }

        return $this->activeTwoFactor();
    }

    private function activeTwoFactor()
    {
        $generated = '';

        if (!empty(auth()->user()->google2fa)) {
            $generated = $this->generateCode();
        }

        $user = auth()->user();
        $role = $user->roles->first();
        $activies = auth()->user()->actions->sortByDesc('created_at')->take(6)->all();
        $countries = $this->countries;

        return view('users.profile.index', [
        'user' => $user,
        'role' => $role,
        'activities' => $activies,
        'countries' => $countries,
        'generated' => $generated,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {

        $this->validate($request, [
            'firstname' => 'required|string|max:255|regex:(^([a-zA-Z_ ]+)([a-zA-Z]+)([a-zA-Z]+))',
            'middlename' => 'nullable|string|max:255|regex:(^([a-zA-Z_ ]+)([a-zA-Z]+)([a-zA-Z]+))',
            'lastname' => 'required|string|max:255|regex:(^([a-zA-Z_ ]+)([a-zA-Z]+)([a-zA-Z]+))',
            'birthday' => 'required|date|date_format:Y-m-d',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'marital_status' => 'required|string',
            'sex' => 'required|string',
        ]);

        $data = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'address' => $request->address,
            'sex' => $request->sex,
            'marital_staus' => $request->marital_status,
            'occupation' => $request->occupation,
        ];

        $profile->update($data);

        /*
        |Logging profile update action
        */
        activity()
      ->performedOn($profile)
      ->withProperties(['name'=> $profile->username,'by'=>Auth::user()->username])
      ->causedBy(Auth::user())
      ->log('Updated profile');
        return redirect()->back()->with('success', 'Account details Updated Successfully');
    }

    /**
     * update avatar image
     * @param  Request $request
     * @param  string  $id      user id
     * @return string
     */
    public function updateAvatar(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'avatar' => 'required|',
         ]);

        $image = $request->avatar;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $imagename = time().'.'.'png';
        $imagepath = public_path("uploads/avatar/").$imagename;
        $imageurl = URL::to('/uploads/avatar/')."/".$imagename;

        $file = Image::make(base64_decode($image))->resize(200, 200)->save($imagepath);

        $user->avatar = $imageurl;

        //
        if ($user->save()) {
            return "Avatar Updated Successfully"; //redirect()->back()->with('success', 'Avatar Updated Successfully');
        }

        return "Avatar Updated Failed" ;
        // // // return redirect()->back()->with('error', 'Avatar Updated Failed');
    }

    /**
     * Update login details
     * @param  Request $request
     * @param  string  $id    user id
     * @return string
     */
    public function updateLogin(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
          'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
          'username' => 'required|string|max:50|unique:users,username,'.$user->id,
          'password' => 'nullable|string|min:8|confirmed',
          'password_confirmation' => 'same:password',
      ]);

        $user->email = $request->email;
        $user->username = $request->username;
        if (!is_null($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        /*
        |Logging profile update action
        */

        activity()
        ->performedOn($user)
        ->withProperties(['name'=>$user->username,'by'=>Auth::user()->username])
        ->causedBy(Auth::user())
        ->log('Updated profile');
        return redirect()->back()->with('success', 'Login details Updated Successfully');
    }

    // ++++++++++++++++++++++++++++++PROFILE AUTHENTICATION SETTINGS++++++++++++++++++++++++++++++++//
    // TWO FACTOR AUTHENTICATION//

    private function generateCode()
    {
        $google2fa = app('pragmarx.google2fa');
        $generated = $google2fa->getQRCodeInline(
            config('app.name'),
            auth()->user()->fullname,
            auth()->user()->google2fa->google2fa_secret
        );
        return $generated;
    }
    /**
     * Generate QRCode Two Factor Authentication
     * @return string
     */
    public function activate()
    {
        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');

        $google2fa = $google2fa->generateSecretKey();
        TwoFactor::create([
               'user_id' => $user->id,
               'google2fa_enable' => 0,
               'google2fa_secret' => $google2fa
        ]);

        return redirect()->back()->with('success', '2-Factor Activated');
    }

    /**
    * Enable Two Factor Authentication
    * @param string $request
    * @return string
    */
    public function enable(Request $request)
    {
        $this->validate($request, [
              'code' => 'required',
          ]);

        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');
        $verified = $google2fa->verifyKey($user->google2fa->google2fa_secret, $request->code);

        if ($verified) {
            $user->google2fa->google2fa_enable = 1;
            $user->google2fa->save();
            return redirect()->back()->with('success', '2-Factor Enabled');
        }

        return redirect()->back()->with('fail', 'Verification Code is Invalid');
    }

    /**
    * Disable active Two Factor Authentication
    * @param string $request
    * @return string
    */
    public function disable(Request $request)
    {
        $this->validate($request, [
                'code' => 'required',
                'password' => 'required',
          ]);

        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');

        if (Hash::check($request->password, $user->password)) {
            $verified = $google2fa->verifyKey($user->google2fa->google2fa_secret, $request->code);

            if ($verified) {
                $user->google2fa->delete();
                return redirect()->back()->with('success', '2-Factor Disabled');
            }

            return redirect()->back()->with('fail', 'Verification Code is Invalid');
        } else {
            return redirect()->back()->with('fail', 'Invalid Password! Check Password and try again');
        }
    }

    public function verify()
    {
        return redirect(URL()->previous());
    }

    /**
    * Disable active Two Factor Authentication
    * @param string $request
    * @return string
    */
    public function instruction()
    {
        return view('google2fa.instruction');
    }

    public function updatePopStatus()
    {
        auth()->user()->fill([
            'pop_status' => 0,
        ])->save();

        return "true";
    }
}
