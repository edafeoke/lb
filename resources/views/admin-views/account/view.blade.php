@extends('admin-views.layouts.template')
@section('title','View Account')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Accounts</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('admin/accounts')}}">Accounts</a></li>
              <li class="breadcrumb-item active">View</li>
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
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="table-responsive no-padding">
                  			<table id="dataTable" class="table table-hover table-borderless table-striped" >
                              <thead>
                      			<tr>
                                    <th>ID</th>
                                    <th>Account Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Account Type</th>
                                    <th>Account Number</th>
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
                                    <td>
                                        {{++$key}}
                                    </td>

                                    <td>
                                        {{($account->user)? $account->user->fullnames : 'Not Available'}}
                                    </td>
                                    <td>
                                        {{($account->user)? $account->user->email : 'Not Available'}}
                                    </td>
                                    <td>
                                        {{($account->user)? $account->user->username : 'Not Available'}}
                                    </td>
                                    <td>{{$account->account_type}}</td>
                                    <td>{{$account->account_number}}</td>
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
          </div>
       </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
