@extends('admin-views.layouts.template')

@section('title','Profile')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Profile</h1> -->
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
			     @include('layouts.includes.alerts')
          <!-- Profile Image -->
          <div class="card">
            <div class="card-body text-center">
              <div class="row">
                <div id="avatar-holder" class="col-md-12">
                  <img id="avatar-img" width="40px" height="100px" class="img profile-user-img img-responsive img-circle" src="{{$user->avatar? $user->avatar :asset('uploads/avatar/avatar.png')}}" alt="User profile picture">
                  <h5 class="mt-3 mb-0"><b>{{$user->fullname}}</b></h5>
                  <p>{{$user->email}}</p>
                  <span class="mt-5 mb-0 d-block">
                    <p>
                      <b>Role:</b>
                      {{($role)? $role->name:'Role Not Set'}}
                    </p>
                  </span>
                  <span class="mt-0 d-block"><p><b>Joined:</b>
                        {{$user->created_at}}
                  </p></span>

                  <label class="btn btn-secondary btn-lg d-block mx-auto mt-5 col-sm-12 mb-0" for="avatarCrop">
                      Update Avatar
                      <input type="file" class="d-none"  id="avatarCrop">
                  </label>
                </div>
                <div id="avatar-updater" class="col-xs-12 d-none">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="image-preview"></div>
                    </div>
                    <div class="col-md-12">
                      <input type="text" name="avatar-url" class="d-none" value="{{route('admin.update-avatar',Auth::user()->id)}}">
                      <button type="button"  id="rotate-image" class="btn btn-info col-sm-12 mb-1">Rotate Image</button>
                      <button type="button"  id="crop_image" class="btn btn-primary col-sm-12">Crop Image</button>
                      <button type="button" id="avatar-cancel-btn" name="button" class="btn btn-secondary col-sm-12 mt-1">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-8">
          <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item shadow mb-3 mr-2">
                        <a class="nav-link active" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">Account Details</a>
                      </li>
                      <li class="nav-item shadow mb-3 mr-2">
                        <a class="nav-link" id="login-details-tab" data-toggle="tab" href="#login-details" role="tab" aria-controls="login-details" aria-selected="false">Login Details</a>
                      </li>
                      @if(setting('2fa'))
                      <li class="nav-item shadow mb-3 mr-2">
                        <a class="nav-link" id="tfa-settings-tab" data-toggle="tab" href="#tfa-settings" role="tab" aria-controls="tfa-settings" aria-selected="false">Two Factor Auth</a>
                      </li>
                      @endif
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content mt-3 mx-0">
                        <div class="tab-pane active" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                              <form class="form-horizontal" method="POST" action="{{route('admin.profile.update',$user->id)}}">
                                  @csrf
                                  @method('put')
                                  <div class="row form-group">
                                        <div class="col-md-6 mt-1">
                                          <div><label class="label-block">Role</label></div>
                                          <input type="text" name="role" value="{{($role)? $role->name:'Role Not Set'}}" class="form-control" disabled>
                                        </div>
                                        <div class="col-md-6 mt-1">
                                          <div><label class="label-block">Status</label></div>
                                          <select class="form-control" name="status" disabled>
                                            <option value="active" {{($user->status == 'active')? 'SELECTED':''}}>{{$user->status}}</option>
                                            <option value="banned" {{($user->status == 'banned')? 'SELECTED':''}}>{{$user->status}}</option>
                                            <option value="hold" {{($user->status == 'hold')? 'SELECTED':''}}>{{$user->status}}</option>
                                            <option value="suspended" {{($user->status == 'suspended')? 'SELECTED':''}}>{{$user->status}}</option>
                                          </select>
                                        </div>
                                        <div class="col-md-4 mb-1 mt-1">
                                          <div><label class="label-block">Firstname</label></div>
                                          <input type="text" name="firstname" value="{{ $user->firstname }}" placeholder="Firstname" class="form-control" >
                                            @error('firstname')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @endif
                                        </div>
                                        <div class="col-md-4 mb-1 mt-1">
                                          <div><label class="label-block">Middlename</label></div>
                                          <input type="text" name="middlename" value="{{ $user->middlename }}" placeholder="Middlename" class="form-control" >
                                            @error('middlename')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-1 mt-1">
                                          <div><label class="label-block">Lastname</label></div>
                                          <input type="text" name="lastname" value="{{ $user->lastname }}" placeholder="Lastname" class="form-control" >
                                            @error('lastname')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-1">
                                          <div><label class="label-block">Phone</label></div>
                                          <input type="text" name="phone" value="{{$user->phone}}" class="form-control" placeholder="Phone" >
                                          @if ($errors->has('phone'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('phone') }}</strong>
                                              </span>
                                          @endif
                                        </div>
                                    <div class="col-sm-6 mt-1">
                                      <label for="address" class="control-label">Address</label>
                                      <input type="text" name="address" class="form-control" value="{{$user->address}}" id="address" placeholder="Address">
                                      @if ($errors->has('address'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('address') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-md-8 mx-auto">
                                    <button type="submit" class="btn btn-primary col-sm-12">Update Account</button>
                                  </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="login-details" role="tabpanel" aria-labelledby="login-details-tab">
                          <form class="form-horizontal" method="POST" action="{{route('admin.update-login',$user->id)}}">
                              @csrf
                                  <div class="row form-group">
                                        <div class="col-md-6">
                                          <div><label class="label-block">Email</label></div>
                                          <input type="text" name="email" value="{{$user->email}}" class="form-control" >
                                          @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                        <div class="col-md-6">
                                          <div><label class="label-block">Username</label></div>
                                          <input type="text" name="username" value="{{$user->username}}" class="form-control" autocomplete="off">
                                          @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                        <div class="col-md-6 my-1">
                                          <div><label class="label-block">Password</label></div>
                                          <input type="password" name="password" value="" placeholder="Leave blank if you don't want to change" class="form-control" autocomplete="off">
                                          @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                        <div class="col-md-6 my-1">
                                          <div><label class="label-block">Confirm Pasword</label></div>
                                          <input type="password" name="password_confirmation" value="" placeholder="Leave blank if you don't want to change" class="form-control" autocomplete="off">
                                          @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                  </div>
                                  <div class="col-md-8 mx-auto">
                                  <button type="submit" class="btn btn-primary col-sm-12">Update Login</button>
                                </div>
                          </form>
                        </div>
                        @if(setting('2fa'))
                        <div class="tab-pane" id="tfa-settings" role="tabpanel" aria-labelledby="tfa-settings-tab">
                          <!--Google Two Factor Authentication card-->
                          <div class="col-md-12">
                            @include('layouts.includes.alerts')
                                <!-- <h4 class="">Google 2FA</h4> -->
                                <!-- <hr> -->
                            @if(empty(auth()->user()->google2fa))
                            <!--=============Generate QRCode for Google 2FA Authentication=============-->
                              <!-- <form class="form-horizontal" method="POST" action="">
                                @csrf -->
                                  <div class="row p-0">
                                    <div class="col-md-12">
                                          <p>To activate Two factor Authentication Generate QRCode</p>
                                    </div>
                                  <div class="col-md-12">
                                    <form class="" action="{{route('admin.activate-2fa')}}" method="post">
                                      @csrf
                                      <button class="btn btn-primary col-md-6">Activate 2FA</button>
                                      <a class="btn btn-secondary col-md-5" data-toggle="collapse" href="#collapseExample"
                                      role="button" aria-expanded="false" aria-controls="collapseExample">Setup Instruction</a>
                                    </form>
                                  </div>
                                  <div class="col-md-12 mt-3 collapse" id="collapseExample">
                                    <hr>
                                    <h3 class="">Two Factor Authentication(2FA) Setup Instruction</h3>
                                    <hr>
                                   <div class="mt-4">
                                          <h4>Below is a step by step instruction on setting up Two Factor Authentication</h4>
                                          <p><label>Step 1:</label> Download the <strong>Google Authenticator</strong> application for Andriod or iOS</p>
                                          <p class="text-center">
                                            <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank"
                                            class="btn btn-success">Download for Andriod <i class="fa fa-android fa-2x ml-2"></i></a>
                                            <a href="https://apps.apple.com/us/app/google-authenticator/id388497605" target="_blank"
                                            class="btn btn-dark ml-2">Download for iPhone<i class="fa fa-apple fa-2x ml-2"></i></a></p>
                                          <p><label>Step 2:</label> Click on on Generate Secret Key on the platform to generate a QRCode</p>
                                          <p><label>Step 3:</label> Open the <strong>Google Authenticator</strong> App and click on <strong>Begin</strong> on the Mobile App</p>
                                          <p><label>Step 4:</label> After which click on <strong>Scan a barcode</strong></p>
                                          <p><label>Step 5:</label> Then scan the QRCode generated on the platform</p>
                                          <p><label>Step 6:</label> Enter the Verification code generate on the platform and Enable 2FA</p>
                                          <hr>
                                          <p><label>NOTE:</label> To disable 2FA Enter code from the Google Authenticator App and password to disable 2FA</p>
                                   </div>
                                  </div>
                                </div>
                              <!-- </form> -->
                            <!--=============Generate QRCode for Google 2FA Authentication=============-->
                            @elseif(!auth()->user()->google2fa->google2fa_enable)
                            <!--=============Enable Google 2FA Authentication=============-->
                              <form class="form-horizontal" method="POST" action="{{route('admin.enable-2fa')}}">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-12"><p><strong>Scan the QRCode with <dfn>Google Authenticator</dfn> and enter the generated code below</strong></p></div>
                                        <div class="col-md-12"><img src="{{$generated}}" /></div>
                                        <div class="col-md-12">
                                        <p>To Enable 2-Factor Authentication Verify QRCode</p>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="address" class="control-label">Verification Code</label>
                                          <input type="text" name="code" class="form-control" id="code" placeholder="Enter Verification Code">
                                          @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                          @endif
                                        </div>
                                      </div>
                                    <div class="col-md-8 mx-auto m-2">
                                      <button type="submit" class="btn btn-primary col-sm-12">Enable 2FA</button>
                                    </div>
                              </form>
                            <!--=============Enable Google 2FA Authentication=============-->
                            @elseif(auth()->user()->google2fa->google2fa_enable)
                            <!--=============Disable Google 2FA Authentication=============-->
                              <form class="form-horizontal" method="POST" action="{{route('admin.disable-2fa')}}">
                                @csrf
                                    <div class="row">
                                          <div class="col-md-12"><img src="{{$generated}}" /></div>
                                          <div class="col-md-12">
                                               <p>To Disable 2-Factor Authentication Verify QRCode</p>
                                          </div>
                                          <div class="col-sm-12">
                                              <label for="address" class="control-label">Verification Code</label>
                                              <input type="text" name="code" class="form-control" id="code" placeholder="Enter Verification Code">
                                              @if ($errors->has('code'))
                                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('code') }}</strong>
                                                </span>
                                              @endif
                                          </div>
                                          <div class="col-sm-12">
                                                <label for="address" class="control-label">Current Password</label>
                                                <input id="password" type="password" placeholder="{{ __('Current Password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                @error('password')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error('password')}}</strong>
                                                  </span>
                                                @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-8 mx-auto m-2">
                                        <button type="submit" class="btn btn-danger col-sm-12">Disable 2FA</button>
                                      </div>
                              </form>
                            <!--=============Disable Google 2FA Authentication=============-->
                            @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->
          </div>

    </section>
          <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
