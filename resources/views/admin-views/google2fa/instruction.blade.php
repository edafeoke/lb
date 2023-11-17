@extends('admin-views.layouts.template')

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
              <li class="breadcrumb-item"><a href="2fa">Google 2FA</a></li>
              <li class="breadcrumb-item active">Setup Instruction</li>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      		<div class="row">
      				<!--Google Two Factor Authentication Setup Instruction-->
      				<div class="col-md-7 mx-auto">
                @include('layouts.includes.alerts')
      				  <div class="card">
          					<div class="card-header">
          					  <h3 class="card-title">Google 2FA Setup Instruction</h3>
          					</div>
      								<div class="card-body">
                            <h3>Below is a step by step instruction on setting up Two Factor Authentication</h3>
                            <p><label>Step 1:</label> Download the Google Authentication application for Andriod or iOS</p>
                            <p><label>Step 2:</label> Click on on Generate Secret Key on the platform to generate a QRCode</p>
                            <p><label>Step 3:</label> Open the Google Authenticator App and click on <strong>Begin</strong> on the Mobile App</p>
                            <p><label>Step 4:</label> After which click on <strong>Scan a barcode</strong></p>
                            <p><label>Step 5:</label> Then scan the QRCode generated on the platform</p>
                            <p><label>Step 6:</label> Enter the Verification code generate on the platfrom and Enable 2FA</p>
                            <hr>
                            <p><label>NOTE:</label> To disable 2FA Enter code from the Google Authenticator App and password to disable 2FA</p>
      								</div>
      						</div>
      				</div>
      				<!--Google Two Factor Authentication Setup Instruction-->
      		</div>
        </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
