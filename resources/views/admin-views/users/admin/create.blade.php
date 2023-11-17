@extends('admin-views.layouts.template')

@section('title','Create Users')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Account</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('admin/user')}}">Account</a></li>
              <li class="breadcrumb-item active">Create</li>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                  @include('layouts.includes.alerts')
                  <form class="form-horizontal" method="POST" action="{{url('/admin/user')}}" enctype="multipart/form-data">
                      @csrf
                    <!-- Contact Details -->
                      <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12 mb-2">
                                <h5 class="pull-right">Contact Details</h5>
                                <hr class="my-4">
                              </div>
                                <hr>
                              <div class="col-md-12">
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
                                 <div class="col-sm-8">
                                    <label for="address" class="control-label">Address</label>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" id="address" placeholder="Address">
                                    @error('address')
                                    <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                      </div>
                    <!-- Contact Details -->
                    <!-- Account Details -->
                        <div class="card">
                              <div class="card-body">
                                  <div class="row">
                                        <div class="col-md-12 mb-2">
                                          <h5 class="pull-right">Account Avatar</h5>
                                          <hr class="my-4">
                                        </div>
                                        <div class="col-md-12">
                                          <div class="form-row">
                                              <div class="col-sm-12">
                                                    <label for="avatar" class="control-label">Avatar</label>
                                                    <input type="file" name="avatar" value="{{old('avatar')}}" class="form-control @error('avatar') is-invalid @enderror" id="avatar">
                                                    @error('avatar')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            <!-- /.card-body -->
                        </div>
                    <!-- Account Details -->
                    <!-- Account Details -->
                        <div class="card">
                              <div class="card-body">
                                  <div class="row">
                                        <div class="col-md-12 mb-2">
                                          <h5 class="pull-right">Account Details</h5>
                                          <hr class="my-4">
                                        </div>
                                        <div class="col-md-12">
                                          <div class="form-row">
                                              <div class="col-sm-6">
                                                <label class="label-block">Account Type</label>
                                                <select name="account_type" class="form-control @error('occupation') is-invalid @enderror" >
                                                    <option value="">Select-Account-Type</option>
                                                    <option value="checking">Checking Account</option>
                                                    <option value="savings">Savings Account</option>
                                                    <option value="money-market">Money Market Account</option>
                                                    <option value="brokerage">Brokerage Account</option>
                                                    <option value="individual-retirement">Individual Retirement Account</option>
                                                </select>
                                                @error('account_type')
                                                <span class="text-danger d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                              <div class="col-sm-6">
                                                    <label for="account_number" class="control-label">Account Number</label>
                                                    <input type="text" name="account_number" value="{{old('account_number')}}" class="form-control @error('account_number') is-invalid @enderror" id="account_number" placeholder="Account Number">
                                                    @error('account_number')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                              </div>
                                              <div class="col-sm-6">
                                                    <label for="total_balance" class="control-label">Total Balance</label>
                                                    <input type="text" name="total_balance" value="{{old('total_balance')}}" class="form-control @error('total_balance') is-invalid @enderror" id="total_balance" placeholder="Total Balance">
                                                    @error('total_balance')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                              </div>
                                              <div class="col-sm-6">
                                                    <label for="available_balance" class="control-label">Available Balance</label>
                                                    <input type="text" name="available_balance" value="{{old('available_balance')}}" class="form-control @error('available_balance') is-invalid @enderror" id="available_balance" placeholder="Available Balance">
                                                    @error('available_balance')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                              </div>
                                              <div class="col-sm-6">
                                                    <label for="account_pin" class="control-label">Account Pin</label>
                                                    <input type="text" name="account_pin" value="{{old('account_pin')}}" class="form-control @error('account_pin') is-invalid @enderror" id="account_pin" placeholder="Account Pin">
                                                    @error('account_pin')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                              </div>
                                              <div class="col-sm-6">
                                                    <label for="fcc" class="control-label">FCC</label>
                                                    <input type="text" name="fcc" value="{{old('fcc')}}" class="form-control @error('fcc') is-invalid @enderror" id="fcc" placeholder="FCC">
                                                    @error('fcc')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                              </div>
                                              <div class="col-sm-6">
                                                    <label for="routing_number" class="control-label">Routing Number</label>
                                                    <input type="text" name="routing_number" value="{{old('routing_number')}}" class="form-control @error('routing_number') is-invalid @enderror" id="routing_number" placeholder="Routing Number">
                                                    @error('routing_number')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                              </div>
                                              <div class="col-sm-6">
                                                    <label for="tax" class="control-label">TAX</label>
                                                    <input type="text" name="tax" value="{{old('tax')}}" class="form-control @error('tax') is-invalid @enderror" id="tax" placeholder="TAX">
                                                    @error('tax')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                              </div>
                                              <div class="col-sm-6">
                                                    <label for="imf" class="control-label">IMF</label>
                                                    <input type="text" name="imf" value="{{old('imf')}}" class="form-control @error('imf') is-invalid @enderror" id="imf" placeholder="IMF">
                                                    @error('imf')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
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
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-8 mx-auto mt-4">
                                    <button type="submit" class="btn btn-primary col-md-12">Create Account</button>
                                  </div>
                              </div>
                            <!-- /.card-body -->
                        </div>
                    <!-- Account Details -->
                  </form>
                  <!-- form end -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
