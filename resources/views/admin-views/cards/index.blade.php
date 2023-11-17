@extends('admin-views.layouts.template')
@section('title','Card Management')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Card Management</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('admin/card')}}">Cards</a></li>
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
                                    <th>Card Holder</th>
                                    <th>Card Type</th>
                                    <th>Card Number</th>
                                    <th>Card CVV</th>
                                    <th>Card Date</th>
                                    <th>Card Pin</th>
                                    <th>Card Account</th>
                                    <th>Card Limit</th>
                                    <th>Card Balance</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                        		@foreach($cards as $key => $card)
                        		<tr>
                                    <td>
                                        {{++$key}}
                                    </td>
                                    <td>
                                        {!!$card->user->fullnames !!}
                                    </td>
                                    <td>
                                        {!!$card->card_type !!}
                                    </td>
                                    <td>
                                        {!!($card->card_number)? $card->card_number : "N/A" !!}
                                    </td>
                                    <td>
                                        {!!($card->card_cvv)? $card->card_cvv : "N/A" !!}
                                    </td>
                                    <td>
                                        {!!($card->card_date)? $card->card_date : "N/A" !!}
                                    </td>
                                    <td>
                                        {!!($card->card_pin)? $card->card_pin : "N/A" !!}
                                    </td>
                                    <td>
                                        {!!($card->card_account)? $card->card_account : "N/A" !!}
                                    </td>
                                    <td>
                                        {!!($card->card_limit)? $card->card_limit : "N/A" !!}
                                    </td>
                                    <td>
                                        {!!($card->card_balance)? $card->card_balance : "N/A" !!}
                                    </td>
                                    <td>
                                        @if($card->status == 'activate')
                                        <span class="text-success text-bold">
                                            {!!Str::ucfirst("Activated") !!}
                                        </span>
                                        @endif
                                        @if($card->status == 'pending')
                                        <span class="text-warning text-bold">
                                            {!!Str::ucfirst("Pending") !!}
                                        </span>
                                        @endif
                                        @if($card->status == 'pending')
                                        <span class="text-warning text-bold">
                                            {!!Str::ucfirst("Deactivated") !!}
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        {!!$card->created_at->diffForHumans() !!}
                                    </td>
                                    <td>
                                        <a href="{{url('/admin/card/update',$card->id)}}" class="btn btn-sm btn-success m-1">Update</a>
                                        @if($card->status == 'pending')
                                            <a href="{{url('/admin/card-action',['activate',$card->id])}}" class="btn btn-sm btn-primary m-1">Activate</a>
                                        @endif
                                        @if($card->status == 'activate')
                                            <a href="{{url('/admin/card-action',['deactivate',$card->id])}}" class="btn btn-sm btn-danger m-1">Deactivate</a>
                                        @endif
                                        @if($card->status == 'deactivate')
                                            <a href="{{url('/admin/card-action',['activate',$card->id])}}" class="btn btn-sm btn-primary m-1">Activate</a>
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
