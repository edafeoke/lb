@extends('layouts.template')

@section('title','Card Application')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Card Application</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('account/card')}}">Card</a></li>
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

                  <!-- Permission Creation -->
                  <div class="card">
                    <div class="card-header with-border">
                      Card Application
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group ">
                            <form class="form-horizontal" method="POST" action="{{url('account/card/create')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="amount">Select Card Type</label>
                                        <select name="card_type" class="form-control @error('card_type') is-invalid @enderror" id="card_type" value="{{old('card_type')}}" placeholder="card_type">
                                            <option value="credit-master-card">Credit Master Card</option>
                                            <option value="debit-master-card">Debit Master Card</option>
                                            <option value="credit-visa-card">Credit VISA Card</option>
                                            <option value="debit-visa-card">Debit VISA Card</option>
                                        </select>
                                        @error('card_type')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Apply for Card</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
      </div>
    </section>
  </div>
@endsection
