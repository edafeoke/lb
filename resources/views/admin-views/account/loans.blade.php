@extends('admin-views.layouts.template')
@section('title','All Loans')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Loans</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('admin/loan')}}">Loan</a></li>
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
                          <div class="col-md-12 mb-4">
                          <h5 class="pull-right">All Loans</h6>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive no-padding">
                  			<table id="dataTable" class="table table-hover table-borderless table-striped" >
                              <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Fullname</th>
                                        <th>Amount</th>
                                        <th>Duration</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                              </thead>
                              <tbody>
                        		@foreach($loans as $key => $loan)
                        			<tr>
                                        <td>{{++$key}}</td>
                                        <td>{{($loan->user)?$loan->user->fullnames:'Not Available'}}</td>
                                        <td>{{money($loan->amount,optional($loan->user)->currency)}}</td>
                                        <td>
                                            {{$loan->duration}}
                                        </td>
                                        <td>
                                            {!! $loan->reason !!}
                                        <td>
                                            @if($loan->status =='successful')
                                            <span class="text-success text-bold">{{'Approved'}}</span>
                                            @elseif($loan->status=='pending')
                                            <span class="text-warning text-bold">{{'Pending'}}</span>
                                            @elseif($loan->status=='cancelled')
                                            <span class="text-danger text-bold">{{'Cancelled'}}</span>
                                            @endif
                                        </td>
                                        <td>{{$loan->date}}</td>
                                        <td>
                                             @if($loan->status == 'pending')
                                                <a href="{{url('/admin/loan-action',['approve',$loan->id])}}" class="btn btn-sm btn-success"><i class="fa fa-check "></i></a>
                                                <a href="{{url('/admin/loan-action',['cancel',$loan->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-times "></i></a>
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
