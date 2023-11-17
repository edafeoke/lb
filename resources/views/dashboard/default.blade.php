@extends('layouts.template')

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
      <div class="row">
		<!--============================ View for Non-Admin ============================-->
		@unlessrole('admin')
            <div class="col-lg-12 col-xs-11 h-100">
                <!-- small box -->
                <div class="card bg-white">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="table-responsive no-padding p-0">
                            <table class="table table-hover table-borderless table-striped text-bold" >
                                <tbody>
                                <tr>
                                    <td>
                                        Account Name
                                    </td>
                                    <td>
                                        {{Str::upper(auth()->user()->fullnames)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Account Number
                                    </td>
                                    <td>
                                        {{optional(auth()->user()->account)->account_number ?? '-'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Account Type
                                    </td>
                                    <td>
                                        {{Str::upper(optional(auth()->user()->account)->account_type) ?? '-'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Routing Number
                                    </td>
                                    <td>
                                        {{Str::upper(optional(auth()->user()->account)->routing_number) ?? '-'}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box shadow p-3 bg-info">
                <a href="#"  Class="info-box-icon bg-info elevation-1" data-toggle="tooltip" data-placement="bottom" title="Total Balance"><i class="fa fa-money"></i></a>
                <div class="info-box-content">
                    <span class="info-box-text">Account Balance</span>
                    <span class="info-box-number">{{money(auth()->user()->account->total_balance,optional(auth()->user())->currency)}}</span>
                </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box shadow p-3 bg-navy">
                <a href="#"  Class="info-box-icon bg-navy elevation-1" data-toggle="tooltip" data-placement="bottom" title="Available Balance"><i class="fa fa-money"></i></a>
                <div class="info-box-content">
                    <span class="info-box-text">Ledger Balance</span>
                    <span class="info-box-number">{{money(auth()->user()->account->available_balance,optional(auth()->user())->currency)}}</span>
                </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box shadow p-3 bg-secondary">
                <a href="{{url('account/transfers')}}"  Class="info-box-icon bg-secondary elevation-1" data-toggle="tooltip" data-placement="bottom" title="Transfer History"><i class="fa fa-list"></i></a>
                <div class="info-box-content">
                    <span class="info-box-text">Transfer History</span>
                </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box shadow p-3 bg-danger">
                <a href="{{url('account/check-deposit')}}"  Class="info-box-icon bg-danger elevation-1" data-toggle="tooltip" data-placement="bottom" title="Deposit History"><i class="fa fa-list"></i></a>
                <div class="info-box-content">
                    <span class="info-box-text">Deposit History</span>
                </div>
                </div>
            </div>
          <!-- Financial Charts  -->
            <div class="col-lg-12 col-xs-11 h-100">
                <!-- small box -->
                <div class="card bg-white">
                <div class="card-header bg-primary">
                    Accounts
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="table-responsive no-padding p-0">
                            <table class="table table-hover table-borderless table-striped" >
                                <thead>
                      			<tr>
                                    <th>Account</th>
                                    <th>Balance</th>
                                    <th>Type</th>
                                </tr>
                              </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {{auth()->user()->account->account_number}}
                                    </td>
                                    <td>
                                        {{money(auth()->user()->account->available_balance,optional(auth()->user())->currency)}}
                                    </td>
                                    <td>
                                        {{Str::upper(auth()->user()->account->account_type)}}
                                    </td>
                                </tr>
                                @if(auth()->user()->card)
                                    @if(auth()->user()->card->status == 'activate')
                                        <tr>
                                            <td>
                                                {{auth()->user()->card->card_account}}
                                            </td>
                                            <td>
                                                {{money(auth()->user()->card->card_balance,optional(auth()->user())->currency)}}
                                            </td>
                                            <td>
                                                {{Str::upper(auth()->user()->card->card_type)}}
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-12 col-xs-11 h-100">
                <!-- small box -->
                <div class="card bg-white">
                <div class="card-header bg-primary">
                Transfers
                <span class="pull-right"><a href="{{url('account/transfers')}}" class=" text-white hover-danger">View all</a></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="table-responsive no-padding">
                  			<table id="dataTable" class="table table-hover table-borderless table-striped" >
                              <thead>
                      			<tr>
                                    <th>Account</th>
                                    <th>Name</th>
                                    <th>Account Type</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Remarks</th>
                                    <th>Date</th>
                                </tr>
                              </thead>
                              <tbody>
                        		@foreach($transfers as $key => $transfer)
                        		<tr>
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
                                        {!! money($transfer->amount,optional(auth()->user())->currency) !!}
                                    </td>
                                    <td>
                                        {!! $transfer->remarks !!}
                                    </td>
                                    <td>
                                        {!! $transfer->date !!}
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
          <!-- Financial Charts  -->
        @endunlessrole
      </div>

      @if (auth()->user()->pop_status)
            <script defer>
            swal({
                text: "{!! auth()->user()->pop_message !!}",
                title: "Notice",
                closeOnClickOutside: false,
            }).then((value) => {
                fetch('{{url("/account/update-pop")}}',{
                    method:'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": '{{csrf_token()}}'
                    },
                })
                .then(response => response.json())
                .then(data => {});
            });
            </script>
        @endif

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
