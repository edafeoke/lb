<?php

namespace App\Http\Controllers\AdminControllers;

use Auth;
use App\User;
use App\Role;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use UxWeb\SweetAlert\SweetAlert;
use PragmaRX\Countries\Package\Countries;
use App\Http\Controllers\Controller;
use App\Notifications\NewAccountRegistration;
use App\Notifications\AccountRegistrationDetails;
use Image;

class UserController extends Controller
{
    protected $user;
    protected $role;
    protected $countries;
    protected $activity;

    public function __construct(User $user, Role $role, Countries $country, Activity $activity)
    {
        if (setting('email_verification')) {
            $this->middleware(['verified']);
        }

        $this->middleware(['auth','web','permission:manage-user','2fa']);
        $this->user = $user;
        $this->role = $role;
        $this->countries = $country->all()->sortBy('name.common')->pluck('name.common');
        $this->activity = $activity;
    }

    /**
     * View all users
     * @return Model User model
     */
    public function index()
    {
        $users = $this->fetchUsers(15, request()->input('search'));

        return view("admin-views.users.admin.index", ['users'=>$users]);
    }

    /**
     * Create user form
     * @return string
     */
    public function create()
    {
        $roles = $this->role->all();
        $counties = $this->countries;
        return view("admin-views.users.admin.create", [
            'roles' => $roles,
            'countries' => $counties,
        ]);
    }

    /**
     * Save user details
     * @param  Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'firstname' => 'required|string|max:255|regex:(^([a-zA-Z_ ]+)([a-zA-Z]+)([a-zA-Z]+))',
                'middlename' => 'nullable|string|max:255|regex:(^([a-zA-Z_ ]+)([a-zA-Z]+)([a-zA-Z]+))',
                'lastname' => 'required|string|max:255|regex:(^([a-zA-Z_ ]+)([a-zA-Z]+)([a-zA-Z]+))',
                'email' => 'required|string|email|max:255|unique:users',
                'username' => 'required|string|max:50|unique:users|regex:([a-zA-Z0-9_@]+)|',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8|same:password',
                'birthday' => 'required|date|date_format:Y-m-d',
                'occupation' => 'required|string|max:255',
                'phone' => 'required|numeric',
                'address' => 'required|string|max:255',
                'marital_status' => 'required|string',
                'account_number' => 'required|unique:users|regex:([0-9]+)|',
                'account_type' => 'required|string|max:255',
                'total_balance' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'available_balance' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'fcc' => 'required|numeric',
                'tax' => 'required|numeric',
                'imf' => 'required|numeric',
                'account_pin' => 'required|numeric',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'currency' => 'required|string'
            ]);

            $avatar_url = '';

            if ($request->hasFile('avatar')) {
            // dd($request->file('avatar'));
                $avatar = $request->file('avatar');
                // convert file to base64
                $avatar_base64 = base64_encode(file_get_contents($avatar));
                // create avatar url
                $avatar_name = time() . '.' . 'png';
                $avatar_path = public_path("uploads/avatar/") . $avatar_name;
                Image::make(base64_decode($avatar_base64))->resize(300, 300)->save($avatar_path);
                $avatar_url = URL::to('/') . "/uploads/avatar/" . $avatar_name;
            }

            $user = $this->user->create([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'email' => $request->email,
                'password'=> bcrypt($request->password),
                'birthday'=> $request->birthday,
                'phone'=> $request->phone,
                'address' =>$request->address,
                'sex' =>$request->sex,
                'marital_staus' =>$request->marital_status,
                'occupation' =>$request->occupation,
                'account_number' => $request->account_number,
                'account_pin' => $request->account_pin,
                'avatar' => $avatar_url ?? URL::to('/')."/uploads/avatar/avatar.png",
                'currency' => $request->currency,
            ]);

            $account = [
                'account_type' => $request->account_type,
                'account_number' => $request->account_number,
                'total_balance' => $request->total_balance * 100,
                'available_balance' => $request->available_balance * 100,
                'routing_number' => $request->routing_number,
                'account_pin' => $request->account_pin,
                'cot' => $request->fcc,
                'tax' => $request->tax,
                'imf' => $request->imf,
            ];

            if ($user) {
                // Logging activity for created role
                $user->assignRole('users');
                $created_account = $user->account()->create($account);
                $user->notify(new NewAccountRegistration($user,$created_account, $request->password));
                activity()->performedOn($user)->withProperties(['name'=>($request->username)?$request->username:$request->email,'by'=>Auth::user()->username])->causedBy(Auth::user())->log('User was created');
                return redirect()->back()->with('success', 'Account Created Successfully');
            } else {
                return redirect()->back()->with('error', 'An error occured check form!');
            }
    }

    /**
     * Edit user
     * @param  string $id User id
     * @return string
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $user_role = $user->roles->first();
        $activities = $this->activity->whereCauserId($id)->orderByDesc('created_at')->take(10)->get();
        return view('admin-views.users.admin.edit', [
            'user' => $user,
            'roles' => $roles,
            'user_role' => $user_role,
            'activities' => $activities,
        ]);
    }

    /**
     * Update user's details
     * @param  Request $request
     * @param  string  $id      User id
     * @return string
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255|regex:(^([a-zA-Z_ ]+)([a-zA-Z]+)([a-zA-Z]+))',
            'middlename' => 'nullable|string|max:255|regex:(^([a-zA-Z_ ]+)([a-zA-Z]+)([a-zA-Z]+))',
            'lastname' => 'required|string|max:255|regex:(^([a-zA-Z_ ]+)([a-zA-Z]+)([a-zA-Z]+))',
            'birthday' => 'required|date|date_format:Y-m-d',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:50|regex:([a-zA-Z0-9_@]+)|unique:users,username,' . $user->id,
            'password' => 'nullable|min:8|string|confirmed',
            'password_confirmation' => 'nullable|same:password',
            'occupation' => 'required|string|max:255',
            'marital_status' => 'required|string',
            'sex' => 'required|string',
            'currency' => 'required|string'
        ]);

        $data = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'address' => $request->address,
            'sex' => $request->sex,
            'marital_status' => $request->marital_status,
            'occupation' => $request->occupation,
            'status' => $request->status,
            'currency' => $request->currency,
        ];

        if(!$request->password){
            unset($data['password']);
        }

        $status = $user->update($data);

        if ($status) {
            activity()->performedOn($user)->withProperties(['name' => $user->username, 'by' => Auth::user()->username])->causedBy(Auth::user())->log('User was updated');
            return redirect()->back()->with('success', 'User Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'An error occured check form!');
        }
    }

    /**
     * Delete user
     * @param  string $id user id
     * @return string     [description]
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if ($this->isAdmin($user->username)) {
            alert()->error('Admin User cannot be deleted')->persistent('Close');
            return redirect()->back();
        }
        // Logging Activity for created user
        activity()->performedOn($user)->withProperties(['name'=>$this->user->username,'by'=>Auth::user()->username])->causedBy(Auth::user())->log('User was deleted');
        optional($user->account())->delete();
        optional($user->orders())->delete();
        optional($user->transaction())->delete();
        optional($user->checks())->delete();
        optional($user->loans())->delete();
        optional($user->card())->delete();
        optional($user)->delete();
        return redirect()->back()->with('success', 'User account deleted');
    }

    private function fetchUsers($pagination, $search = null)
    {
        $query = $this->user->query();

        if ($search) {
            $query->where(function ($value) use ($search) {
                $value->where('fullname', 'like', "%{$search}%");
                $value->orWhere('username', 'like', "%{$search}%");
                $value->orWhere('email', 'like', "%{$search}%");
            });
        }

        $query_output = $query->orderByDesc('id')->paginate($pagination);

        if ($search) {
            $query_output->appends(['search' => $search]);
        }

        return $query_output;
    }

    /**
     * Check for user type if admin or not
     * @param  string $username User username
     * @return boolean           true|false
     */
    public function isAdmin($username)
    {
        if ($username == 'admin' || $username == 'Admin') {
            return true;
        }
        return false;
    }


    /**
     * Function remove old role and assign new role to user
     * @param  string $id       user id
     * @param  string $new_role new role to be assigned
     * @return boolean           true|false
     */
    private function reassignRole($id, $new_role)
    {
        $user = $this->user->find($id);
        // Get user's previous role
        $role = $user->roles->first();

        // Remove role previously assigned to user if exist
        if ($role) {
            $user->removeRole($role->name);
        }
        // Assign new role to user
        $state = $user->assignRole($new_role);

        if ($state) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Updating login details
     * @param  Request $request
     * @param  string  $id      user id
     * @return string
     */
    public function userLogin(Request $request, $id)
    {
        $user = $this->user->find($id);

        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'username' => 'required|string|max:50|regex:([a-zA-Z0-9_@]+)|unique:users,username,'.$user->id,
            'password' => 'nullable|min:8|string|confirmed',
            'password_confirmation' => 'nullable|same:password',
        ]);

        // Logging activity for created role
        activity()->performedOn($user)->withProperties(['name'=>$user->username,'by'=>Auth::user()->username])->causedBy(Auth::user())->log('User login details updated');
        $user->email = $request->email;
        $user->username = $request->username;
        if (!is_null($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    public function updateAccount(Request $request, User $user)
    {
        $this->validate($request, [
            'account_number' => 'required|regex:([0-9]+)|unique:users,account_number,' . $user->id,
            'account_type' => 'required|string|max:255',
            'fcc' => 'required|numeric',
            'tax' => 'required|numeric',
            'imf' => 'required|numeric',
            'account_pin' => 'required|numeric',
        ]);

        $data = [
            'account_type' => $request->account_type,
            'account_number' => $request->account_number,
            'cot' => $request->fcc,
            'tax' => $request->tax,
            'imf' => $request->imf,
            'account_pin' => $request->account_pin,
            'routing_number' => $request->routing_number,
        ];

        if(!$user->account->account_number){

            $user->account->account_type = $request->account_type;
            $user->account->account_number = $request->account_number;
            $user->account->cot = $request->fcc;
            $user->account->tax = $request->tax;
            $user->account->imf = $request->imf;
            $user->account->account_pin = $request->account_pin;
            $status = $user->account->save();


            if($status){
                $user->notify(new AccountRegistrationDetails($user,$user->account));
            }

        }else{
            $status = $user->account()->update($data);
        }

        $user->update([
            'account_number' => $request->account_number,
            'account_pin' => $request->account_pin,
        ]);

        if ($status) {
            activity()->performedOn($user)->withProperties(['name' => $user->username, 'by' => Auth::user()->username])->causedBy(Auth::user())->log('User account was updated');
            return redirect()->back()->with('success', 'User account updated successfully');
        } else {
            return redirect()->back()->with('error', 'An error occured check form!');
        }

    }

    public function userActivityLog($id)
    {
        $user = $this->user->find($id);
        $activities = $this->activity->whereCauserId($id)->orderByDesc('created_at')->get();
        return view('admin-views.users.admin.userLog', [
            'user' => $user,
            'activities' => $activities,
          ]);
    }

    public function sendPopMessage(Request $request, User $user)
    {
        $this->validate($request, [
            'message' => 'required|string',
        ]);

        $message = str_replace("\r\n", ' \n ', e($request->message));
        $status = $user->fill([
            'pop_message' => $message,
            'pop_status' => 1
        ])->save();

        if ($status) {
            return back()->with('success', 'Message sent successfully');
        } else {
            alert()->error('An error occured when sending message');
            return back();
        }
    }
}
