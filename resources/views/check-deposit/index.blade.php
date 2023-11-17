@extends('layouts.template')
@section('title','Check Deposit')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Check Deposit</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('account/check-deposit')}}">Check Deposit</a></li>
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
                          <h5 class="pull-right">Check Depsoits</h6>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive no-padding">
                  			<table id="dataTable" class="table table-hover table-borderless table-striped" >
                              <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Amount</th>
                                        <th>Check Front View</th>
                                        <th>Check Back View</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                              </thead>
                              <tbody>
                        		@foreach($checks as $key => $check)
                        			<tr>
                                        <td>{{++$key}}</td>
                                        <td>{{money($check->amount,optional(auth()->user())->currency)}}</td>
                                        <td>
                                            <form target="_blank" action="{{route('account.download-checks',['front-view',$check->id])}}" method="POST">
                                                @csrf
                                                <button  type="submit" class="btn btn-sm btn-default">Check Front View</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form target="_blank" action="{{route('account.download-checks',['back-view',$check->id])}}" method="POST">
                                                @csrf
                                                <button  type="submit" class="btn btn-sm btn-default">Check Back View</button>
                                            </form>
                                        <td>
                                            @if($check->status =='completed')
                                            <span class="text-success text-bold">{{'Completed'}}</span>
                                            @elseif($check->status=='pending')
                                            <span class="text-warning text-bold">{{'Pending'}}</span>
                                            @elseif($check->status=='paid')
                                            <span class="text-primary text-bold">{{'Paid'}}</span>
                                            @endif
                                        </td>
                                        <td>{{$check->date}}</td>
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
