@extends('admin-views.layouts.template')
@section('title','Credit and Debit History')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Credit and Debit History</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('admin/history/account')}}">History</a></li>
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
                                    <th>Order Id</th>
                                    <th>Account Number</th>
                                    <th>Account Name</th>
                                    <th>Amount</th>
                                    <th>Order Type</th>
                                    <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                        		@foreach($orders as $key => $order)
                        		<tr>
                                    <td>
                                        {{++$key}}
                                    </td>
                                    <td>
                                        {{$order->order_id}}
                                    </td>
                                    <td>
                                        {{$order->account_number}}
                                    </td>
                                    <td>
                                        {{$order->user->fullnames}}
                                    </td>
                                    <td>
                                        {{money($order->amount,optional(auth()->user())->currency)}}
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
          </div>
       </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
