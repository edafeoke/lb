@extends('layouts.app')

@section('title','2-Factor Authentication')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Google 2FA</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Google 2FA</li>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    		<div class="row">
    				<!--Google Two Factor Authentication card-->
    				<div class="col-md-7 mx-3 p-2">
              @include('layouts.includes.alerts')

    				  <div class="card">
        					<div class="card-header">
        					  <h3 class="card-title">Google 2FA</h3>
        					</div>
    					@if(empty($user->google2fa))
    					<!--=============Generate QRCode for Google 2FA Authentication=============-->
    					<!-- <div id="float-none" class="col-md-12 mx-auto mt-5"> -->
    						<form class="form-horizontal" method="POST" action="{{route('generate-2fa')}}">
    							@csrf
    								<div class="card-body">
    									<div class="row">
    									  <div class="col-md-12">
    										      <p>To activate Two factor Authentication Generate QRCode</p>
    									  </div>
    									</div>
    								</div>
    								<div class="card-footer">
                      <div class="col-md-8 mx-auto">
                        <button type="submit" class="btn btn-primary col-md-12">Generate Secret Key</button>
                      </div>
    								</div>
    						</form>
    					<!-- </div> -->
    					<!--=============Generate QRCode for Google 2FA Authentication=============-->
    					@elseif(!$user->google2fa->google2fa_enable)
    					<!--=============Enable Google 2FA Authentication=============-->
    					<!-- <div id="float-none" class="col-md-12 mx-auto mt-5"> -->
    						<form class="form-horizontal" method="POST" action="{{route('enable-2fa')}}">
    							@csrf
    								<div class="card-body">
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
    								</div>
    								<div class="card-footer">
                      <div class="col-md-8 mx-auto">
                        <button type="submit" class="btn btn-primary col-sm-12">Enable 2FA</button>
                      </div>
    								</div>
    						</form>
    					<!-- </div> -->
    					<!--=============Enable Google 2FA Authentication=============-->
    					@elseif($user->google2fa->google2fa_enable)
    					<!--=============Disable Google 2FA Authentication=============-->
    					<!-- <div id="float-none" class="col-md-12 mx-auto mt-5"> -->
    						<form class="form-horizontal" method="POST" action="{{route('disable-2fa')}}">
    							@csrf
    								<div class="card-body">
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
    								</div>
    								<div class="card-footer">
                      <div class="col-md-8 mx-auto">
                        <button type="submit" class="btn btn-danger col-sm-12">Disable 2FA</button>
                      </div>
    								</div>
    						</form>
    					<!-- </div> -->
    					<!--=============Disable Google 2FA Authentication=============-->
    					@endif

    				  </div>
    				</div>
    				<!--Google Two Factor Authentication card-->

    				<!--Download Instructions for the Mobile Google Authenticator-->
    				<div class="col-md-4">
    					<div class="card card-warning">
    						<div class="card-header with-border">
    						  <h3 class="card-title">Downloading Instructions</h3>
    						</div>
    						<div class="card-body bg-gray-light">
    							<div class="row">
    								<div class="col-md-12">
    										<p>
    											<strong>
    												Download Google Mobile Authenticator for any of your mobile platform, Andriod or iOS
    											</strong>
    										</p>
                        <p><a href="/2fa/instruction" target="_blank">Click here</a> step by step instruction in set of Two Factor Authentication</p>
    								</div>
                    <div class="col-md-12">
                      <hr>
                            <div class="col-xs-12 text-center">
                              <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">
                                <img class="img-responsive" src="{{asset('uploads/google-play-badge.png')}}" height="50px" width="250px" alt="Download for PlayStore">
                              </a>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                          <hr>
                              <!-- <a class='btn btn-secondary col-md-12 my-2'>Playstore</a> -->
                              <a href="https://apps.apple.com/us/app/google-authenticator/id388497605" target="_blank">
                                <img class="img" src="{{asset('uploads/apple-store-badge.png')}}" height="50px" width="250px" alt="Download for PlayStore" >
                              </a>
                        </div>
    							</div>
    						</div>
    					</div>
    			    </div>
    				<!--Download Instructions for the Mobile Google Authenticator-->
    		</div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
