<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{__('Email Verification')}} - @setting('app_name')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- App Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/icheck/skin/all.css')}}">
  <script src="{{asset('plugins/sweetalert/js/sweetalert.min.js')}}"></script>

  <!-- FAVICON -->
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- FAVICON -->
  <style>
    .has-feedback{
        color: red;
    }

    .cover-image {
        background: url('{{setting("app_background_image")? setting("app_background_image") : asset("uploads/appBackgroundImage/background-image.png")}}') center center no-repeat fixed !important;
        background-size: cover !important;
        position: fixed !important;
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
    <body class="hold-transition login-page cover-image">
          <div class="login-box">
            <div class="login-logo">
              <div class=" d-block text-center mt-5">
                <img src="{{setting('app_dark_logo')? setting('app_dark_logo'):asset('uploads/appLogo/logo-dark.png')}}" class="img img-responsive" height="60px" width="220px" alt="App Logo">
              </div>
            </div>
              <!-- /.login-logo -->
            <div class="card">
                @include('layouts.includes.alerts')
              <div class="card-body text-center">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <h5 class="text-center">{{ __('Verify Your Email Address') }}</h5>

                      {{ __('Before proceeding, please check your email for a verification link.') }}
                      {{ __('If you did not receive the email') }},
                      <form class="d-inline" method="POST" action="{{ route('account.verification.resend') }}">
                          @csrf
                          <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                      </form>
                </div>
            </div>
            <div class="text-center">
              <span><a href="{{url('/account/logout')}}">Logout</a></span>
            </div>
          </div>

          <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
          <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
          <script src="{{ asset('assets/js/theme.min.js') }}"></script>
    </body>
  </html>
