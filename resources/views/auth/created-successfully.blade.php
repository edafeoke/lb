<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{__('Account Pin Verification')}} - @setting('app_name')</title>
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
              <div class="card-body text-center">
                    <h4 class="text-center text-success">Account Application Submitted Successfully</h4>
                    <p>You will be notified when your account is activated</p>
                    <p><a href="{{url('/account/login')}}">Click here</a> to continue</p>
               </div>
          </div>

          <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
          <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
          <script src="{{ asset('assets/js/theme.min.js') }}"></script>
          <div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    </body>
  </html>
