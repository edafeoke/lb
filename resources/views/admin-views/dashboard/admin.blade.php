@extends('admin-views.layouts.template')

@section('title','Dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <!-- Small boxes (Stat box) -->
      @include('layouts.includes.alerts')
      @role('admin')
      <!-- Info boxes -->
        <div class="row mb-2">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3 bg-dark">
              <a href="{{url('admin/user')}}"  Class="info-box-icon bg-dark elevation-1" data-toggle="tooltip" data-placement="bottom" title="See All Users"><i class="fa fa-users"></i></a>

              <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number lead">
                  {{$users}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3 bg-navy">
              <a href="{{url('admin/user')}}"  Class="info-box-icon bg-navy elevation-1" data-toggle="tooltip" data-placement="bottom" title="See Users"><i class="fa fa-user-plus"></i></a>

              <div class="info-box-content">
                <span class="info-box-text">New Users</span>
                <span class="info-box-number lead">
                  {{$latest_users_count}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>


          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3 bg-primary">
              <a href="{{url('admin/history/account')}}"  Class="info-box-icon bg-primary elevation-1" data-toggle="tooltip" data-placement="bottom" title="See Roles"><i class="fa fa-exchange"></i></a>

              <div class="info-box-content">
                <span class="info-box-text">Transactions History</span>
                <span class="info-box-number lead">
                  {{$transactions}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3 bg-success">
                <a href="{{url('admin/activity-log')}}"  Class="info-box-icon bg-success elevation-1" data-toggle="tooltip" data-placement="bottom" title="See Activity Log"><i class="fa fa-list"></i></a>

                <div class="info-box-content">
                <span class="info-box-text">Activity Log</span>
                <span class="info-box-number lead">
                    {{$activities}}
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3 bg-cyan">
                <a href="{{route('admin.user.create')}}"  Class="info-box-icon bg-cyan elevation-1" data-toggle="tooltip" data-placement="bottom" title="Create Account"><i class="fa fa-user"></i></a>
                <div class="info-box-content">
                <span class="info-box-text">Create Account</span>
                </div>
            </div>
        </div>
          <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3 bg-info">
                <a href="{{url('admin/accounts')}}"  Class="info-box-icon bg-info elevation-1" data-toggle="tooltip" data-placement="bottom" title="View Accounts"><i class="fa fa-users"></i></a>
                <div class="info-box-content">
                    <span class="info-box-text">View Account</span>
                </div>
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3 bg-teal">
                <a href="{{url('admin/credit/account')}}"  Class="info-box-icon bg-teal elevation-1" data-toggle="tooltip" data-placement="bottom" title="Credit Account"><i class="fa fa-credit-card"></i></a>
                <div class="info-box-content">
                <span class="info-box-text">Credit Account</span>
                </div>
            </div>
        </div>
          <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow p-3 bg-danger">
                <a href="{{url('admin/debit/account')}}"  Class="info-box-icon bg-danger elevation-1" data-toggle="tooltip" data-placement="bottom" title="Debit Account"><i class="fa fa-credit-card"></i></a>
                <div class="info-box-content">
                    <span class="info-box-text">Debit Account</span>
                </div>
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->


        </div>
        <!-- /.row -->



      <div class="row">


        <div class="col-lg-6 col-xs-11 h-100">
            <div class="card bg-white">
            <div class="card-header bg-primary">
            Recent Transactions
            <span class="pull-right"><a href="{{url('admin/transactions')}}" class=" text-white hover-danger">View all</a></span>
            </div>
            <div class="card-body">
            <div class="row">
                    <div class="col-md-12">
                          <div class="table-responsive no-padding">
                  			<table id="dataTable" class="table table-hover table-borderless table-striped" >
                              <thead>
                      			<tr>
                                    <th>Account Number</th>
                                    <th>Account Name</th>
                                    <th>Order Reference</th>
                                    <th>Amount</th>
                                    <th>Order Type</th>
                                    <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                        		@foreach($orders as $key => $order)
                        		<tr>
                                    <td>
                                        {{$order->account_number}}
                                    </td>
                                    <td>
                                        {{$order->user->fullnames}}
                                    </td>
                                    <td>
                                        {{$order->order_id}}
                                    </td>
                                    <td>
                                        {{money($order->amount,optional($order->user)->currency)}}
                                    </td>
                                    <td>
                                        {{Str::ucfirst($order->type)}}
                                    </td>
                                    <td>
                                        {{Str::ucfirst($order->status)}}
                                    </td>
                        		</tr>
                        		@endforeach
                              </tbody>
                  			</table>
                          </div>
                        </div>
            </div>
            </div>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-11 h-100">
            <!-- small box -->
            <div class="card bg-white">
                <div class="card-header bg-primary">
                Accounts
                <span class="pull-right"><a href="{{url('admin/accounts')}}" class=" text-white hover-danger">View all</a></span>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                          <div class="table-responsive no-padding">
                  			<table  class="table table-hover table-borderless table-striped dataTable" >
                              <thead>
                      			<tr>
                                    <th>Account</th>
                                    <th>Account Type</th>
                                    <th>Account Name</th>
                                    <th>Total Balance</th>
                                    <th>Available Balance</th>
                                    <th>Status</th>
                                    <th>FCC</th>
                                    <th>TAX</th>
                                    <th>IMF</th>
                                </tr>
                              </thead>
                              <tbody>
                        		@forelse($accounts as $key => $account)
                        		<tr>
                                    <td>{{$account->account_number}}</td>
                                    <td>{{$account->account_type}}</td>
                                    <td>
                                        {{($account->user)? $account->user->fullnames : 'Not Available'}}
                                    </td>
                                    <td>{{money($account->total_balance,optional($account->user)->currency)}}</td>
                                    <td>{{money($account->available_balance,optional($account->user)->currency)}}</td>
                                    <td>
                                        {{($account->user)? $account->user->status : 'Account Does not Exist'}}
                                    </td>
                                    <td>{{$account->cot}}</td>
                                    <td>{{$account->tax}}</td>
                                    <td>{{$account->imf}}</td>
                        		</tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                    <p><i>No record found</i></p>
                                    </td>
                                </tr>
                        		@endforelse
                              </tbody>
                  			</table>
                          </div>
                        </div>
                </div>
                </div>
            </div>
        </div>
        <!-- ./col -->

      </div>
		@endrole
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
