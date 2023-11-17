<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{__('Registration')}} - @setting('app_name')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @if(setting('recaptcha'))
      {!! htmlScriptTagJsApi([
              'action' => 'registration',])
      !!}
  @endif
  {!! NoCaptcha::renderJs() !!}

  <!-- FAVICON -->
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- FAVICON -->

  <!-- STYLESHEET -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <script src="{{asset('plugins/sweetalert/js/sweetalert.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/icheck/skin/all.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datepicker/css/bootstrap-datepicker.standalone.css')}}">

  <style>
     .cover-image {
        background: url('{{setting("app_background_image")? setting("app_background_image") : asset("uploads/appBackgroundImage/background-image.png")}}') center center no-repeat fixed !important;
        background-size: cover !important;
        /*position: fixed !important;*/
        background-color: aliceblue!important;
    }

    .cover-image, .cover-image:before {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .twitter-blue{
      color: #00acee;
    }
  </style>

</head>
<body class="hold-transition register-page cover-image">
<div class="register-box">
    <div class="register-logo">
      <div class=" d-block text-center mt-5">
        <a href="./">
          <img src="{{setting('app_dark_logo')? setting('app_dark_logo'):asset('uploads/appLogo/logo-dark.png')}}" class="img img-responsive" height="60px" width="220px" alt="App Logo">
        </a>
      </div>
    </div>

    <div class="card shadow px-3">
      <div class="card-body register-card-body rounded">
        @include('layouts.includes.alerts')
        @if (session('error'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('error') }}
            </div>
        @endif
        <p class="login-box-msg">Create New Account</p>

      <form method="POST" action="{{ route('account.register.step-one') }}">
          @csrf
        <div class="form-row mb-1">
              <div class="col-sm-4">
                 <label for="name">First Name</label>
                  <input type="text" name="firstname" value="{{old('firstname')}}" placeholder="Firstname" class="form-control @error('firstname') is-invalid @enderror" id="irstname">
                  @error('firstname')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="col-sm-4">
                 <label for="name">Middle Name (Optional)</label>
                  <input type="text" name="middlename" value="{{old('middlename')}}" placeholder="Middlename" class="form-control @error('middlename') is-invalid @enderror" id="middlename">
                  @error('middlename')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="col-sm-4">
                 <label for="name">Last Name</label>
                  <input type="text" name="lastname" value="{{old('lastname')}}" placeholder="Lastname" class="form-control @error('lastname') is-invalid @enderror" id="lastname">
                  @error('lastname')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="col-sm-4">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" >
                    @error('email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
              </div>

              <div class="col-sm-4">
                <label for="email" class="control-label">Username</label>
                <input type="text"  name="username" value="{{old('username')}}" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username">
                @error('username')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-sm-4">
                  <div><label class="label-block">Phone</label></div>
                  <input type="text" name="phone" value="{{ old('phone') }}" class="form-control  @error('phone') is-invalid @enderror" placeholder="Phone" >
                  @error('phone')
                  <span class="text-danger d-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="col-sm-6">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
              </div>
              <div class="col-sm-6">
                <label for="password_confirmation" class="control-label">Confirm Password</label>
                <input type="password"  name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm Password">
                @error('password_confirmation')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-row mb-1">
          <div id="birthday" class="col-sm-4">
             <label for="name">Birthday</label>
              <input type="text" name="birthday" value="{{old('birthday')}}" placeholder="Birthday" class="form-control @error('virthday') is-invalid @enderror">
              @error('birthday')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          <div class="col-sm-4">
              <div><label class="label-block">Sex</label></div>
              <select name="sex" class="form-control @error('sex') is-invalid @enderror" placeholder="Phone">
                <option value="">Select-Sex</option>
                <option value="female">Female</option>
                <option value="male">Male</option>
              </select>
              @error('sex')
              <span class="text-danger d-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <div class="col-sm-4">
              <div><label class="label-block">Marital Status</label></div>
              <select name="marital_status" class="form-control @error('marital_status') is-invalid @enderror" >
                <option value="">Select-Marital-Status</option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorce">Divorce</option>
              </select>
              @error('marital_status')
              <span class="text-danger d-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
        </div>
        <div class="form-row mb-1">
             <div class="col-sm-4">
                <label for="occupation" class="control-label">Occupation</label>
                <input type="text" name="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{old('occupation')}}" id="occupation" placeholder="Occupation">
                @error('occupation')
                <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @endif
             </div>
            <div class="col-sm-4">
              <div><label class="label-block">Currency</label></div>
              <select name="currency" class="form-control @error('currency') is-invalid @enderror" placeholder="Phone">
                <option value="">Select-Currency</option>
                <option value="USD">USD</option>
                <option value="GBP">GBP</option>
                <option value="JPY">JPY</option>
                <option value="EUR">EUR</option>
              </select>
              @error('currency')
              <span class="text-danger d-block" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
             <div class="col-sm-4">
                <label for="address" class="control-label">Address</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" id="address" placeholder="Address">
                @error('address')
                <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
             </div>
        </div>

        <!-- Submit Button -->
        <div class="row">
          <div class="col-md-12">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
        <!-- Submit Button -->
      </form>

      <a href="{{route('account.login')}}" class="text-center">I already have an account</a>
    </div>
    <!-- /.form-box -->
    </div>
</div>
<!-- /.register-box -->


<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.min.js') }}"></script>
<script src="{{asset('plugins/datatable/js/datatables.min.js')}}"></script>
<script src="{{asset('plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
<script src="{{asset('plugins/croppie/js/croppie.min.js')}}"></script>
<script src="{{asset('plugins/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>
