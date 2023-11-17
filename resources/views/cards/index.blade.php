@extends('layouts.template')
@section('title','Card Details')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Card details</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('account/card')}}">Card</a></li>
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
             <div class="col-md-8 mx-auto">
  		           @include('layouts.includes.alerts')
                  <div class="card">
                    <div class="card-body p-0">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="table-responsive no-padding">
                  			<table class="table table-hover table-borderless table-striped" >
                              @if(auth()->user()->card)
                                @if(auth()->user()->card->status == 'activate')
                                    <tbody>
                                            <tr>
                                                <td>Card Type</td>
                                                <td class="text-bold">{{Str::upper(auth()->user()->card->card_type)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Card Number</td>
                                                <td class="text-bold">{{auth()->user()->card->card_number}}</td>
                                            </tr>
                                            <tr>
                                                <td>Card CVV</td>
                                                <td class="text-bold">{{auth()->user()->card->card_cvv}}</td>
                                            </tr>
                                            <tr>
                                                <td>Card Date</td>
                                                <td class="text-bold">{{auth()->user()->card->card_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>Card Account Number</td>
                                                <td class="text-bold">{{auth()->user()->card->card_account}}</td>
                                            </tr>
                                            <tr>
                                                <td>Card Balance</td>
                                                <td class="text-bold">{{money(auth()->user()->card->card_balance,optional(auth()->user())->currency)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Card Limit</td>
                                                <td class="text-bold">{{money(auth()->user()->card->card_limit,optional(auth()->user())->currency)}}</td>
                                            </tr>
                                    </tbody>
                                @elseif (auth()->user()->card->status == 'pending')
                                    <tbody>
                                            <tr>
                                                <td colspan="2" class="text-bold font-italic text-success">Card Request Submitted successfully awaiting approval</td>
                                            </tr>
                                            <tr>
                                                <td>Card Type</td>
                                                <td class="text-bold">{{Str::upper(auth()->user()->card->card_type)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Card Number</td>
                                                <td class="text-bold"> Not Activated Yet</td>
                                            </tr>
                                            <tr>
                                                <td>Card CVV</td>
                                                <td class="text-bold"> Not Activated Yet</td>
                                            </tr>
                                            <tr>
                                                <td>Card Date</td>
                                                <td class="text-bold"> Not Activated Yet</td>
                                            </tr>
                                            <tr>
                                                <td>Card Account Number</td>
                                               <td class="text-bold"> Not Activated Yet</td>
                                            </tr>
                                            <tr>
                                                <td>Card Balance</td>
                                                <td class="text-bold"> Not Activated Yet</td>
                                            </tr>
                                            <tr>
                                                <td>Card Limit</td>
                                                <td class="text-bold"> Not Activated Yet</td>
                                            </tr>
                                    </tbody>
                                @else
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="text-bold font-italic text-danger">Please contact administrator for more information</td>
                                        </tr>
                                    </tbody>
                                @endif
                              @else
                              <tbody>
                        			<tr>
                                        <td class="text-center">There is no card activated. <a href="{{url('account/card/create')}}">Click Here</a> to apply for card </td>
                                    </tr>
                              </tbody>
                              @endif
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
