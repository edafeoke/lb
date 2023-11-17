@extends('admin-views.layouts.template')
@section('title','Transfer History')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Transfer History</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('account/transfer')}}">Transfer History</a></li>
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
                                    <th>Sender</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Account Type</th>
                                    <th>Swift</th>
                                    <th>Routing</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                        		@foreach($transfers as $key => $transfer)
                        		<tr>
                                    <td>
                                        {{++$key}}
                                    </td>
                                    <td>
                                        {!!$transfer->user->fullnames !!}
                                    </td>
                                    <td>
                                        {!!$transfer->bank_name !!}
                                    </td>
                                    <td>
                                        {!!$transfer->account_number !!}
                                    </td>
                                    <td>
                                        {!!$transfer->account_name !!}
                                    </td>
                                    <td>
                                        {!!$transfer->account_type !!}
                                    </td>
                                    <td>
                                        {!!$transfer->swift !!}
                                    </td>
                                    <td>
                                        {!!$transfer->routing !!}
                                    </td>
                                    <td>
                                        @if($transfer->status == 'failed')
                                        <span class="text-danger text-bold">
                                            {!!Str::ucfirst($transfer->status) !!}
                                        </span>
                                        @endif
                                        @if($transfer->status == 'successful')
                                        <span class="text-success text-bold">
                                            {!!Str::ucfirst($transfer->status) !!}
                                        </span>
                                        @endif
                                        @if($transfer->status == 'pending')
                                        <span class="text-warning text-bold">
                                            {!!Str::ucfirst($transfer->status) !!}
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        {!! $transfer->routing !!}
                                    </td>
                                    <td>
                                        {!! money($transfer->amount,optional($transfer->user)->currency) !!}
                                    </td>
                                    <td>
                                        {!! $transfer->date !!}
                                    </td>
                                    <td>
                                        @if($transfer->status == 'pending')
                                            <a href="{{url('/admin/transfer-action',['approve',$transfer->id])}}" class="btn btn-sm btn-success"><i class="fa fa-check "></i></a>
                                            <a href="{{url('/admin/transfer-action',['cancel',$transfer->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-times "></i></a>
                                        @endif
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
