@extends('admin-views.layouts.template')

@section('title','Update Card')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Card</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('admin/card')}}">Card</a></li>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
        <!-- right column -->
        <div class="col-md-7 mx-auto">
            @include('layouts.includes.alerts')
            <form class="form-horizontal" method="POST" action="{{url('admin/card/update',$card->id)}}">
                  @csrf
                  <!-- Permission Creation -->
                  <div class="card">
                    <div class="card-header with-border">
                      Update Card
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group ">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <select name="user_id" class="form-control" id="user_id" readonly>
                                    <option value="{{$card->user->id}}" selected>{{$card->user->fullnames}}</option>
                                </select>
                                @error('user_id')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <select name="card_type" class="form-control" id="card_type">
                                    <option value="credit-master-card" {{($card->card_type == "credit-master-card")?'selected':''}}>Credit Master Card</option>
                                    <option value="debit-master-card" {{($card->card_type == "debit-master-card")?'selected':''}}>Debit Master Card</option>
                                    <option value="credit-visa-card" {{($card->card_type == "credit-visa-card")?'selected':''}}>Credit VISA Card</option>
                                    <option value="debit-visa-card" {{($card->card_type == "debit-visa-card")?'selected':''}}>Debit VISA Card</option>
                                </select>
                                @error('card_type')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="card_number">Card Number</label>
                                <input name="card_number" class="form-control" id="card_number" value="{{$card->card_number}}" placeholder="Card Number">
                                @error('card_number')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="card_cvv">Card CVV</label>
                                <input name="card_cvv" class="form-control" id="card_cvv" value="{{$card->card_cvv}}" placeholder="Card CVV">
                                @error('card_cvv')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group datePicker">
                                <label for="card_date">Card Date</label>
                                <input name="card_date" class="form-control datePicker" id="card_date" value="{{$card->card_date}}" placeholder="Card Date">
                                @error('card_date')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="card_pin">Card Pin</label>
                                <input name="card_pin" class="form-control" id="card_pin" value="{{$card->card_pin}}" placeholder="Card Pin">
                                @error('card_pin')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="card_account">Card Account Number</label>
                                <input name="card_account" class="form-control" id="card_account" value="{{$card->card_account}}" placeholder="Card Account">
                                @error('card_account')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="card_limit">Card Amount Limit</label>
                                <input name="card_limit" class="form-control" id="card_limit" value="{{$card->card_limit}}" placeholder="Card Limit">
                                @error('card_limit')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="card_balance">Card Balance</label>
                                <input name="card_balance" class="form-control" id="card_balance" value="{{$card->card_balance}}" placeholder="Card Balance">
                                @error('card_balance')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Update Card</button></div>
                            </div>
                              </div>
                        </div>
                    </div>
                  </div>
            </form>
            </div>
          </div>
      </div>
    </section>
  </div>
@endsection
