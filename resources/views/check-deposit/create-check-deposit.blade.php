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
                      Create Check Deposit
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            {{-- @if ($error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                </div>
                            @endif --}}
                        <div class="form-group ">
                            <form class="form-horizontal" method="POST" action="{{url('account/check-deposit/create')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group dateFormat">
                                        <label for="date">Date</label>
                                        <input name="date" class="form-control @error('date') is-invalid @enderror" id="date" value="{{old('date')}}" placeholder="Date" autocomplete="off">
                                        @error('date')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" value="{{old('amount')}}" placeholder="Amount">
                                        @error('amount')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="account_number">Check Front View</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('front_view') is-invalid @enderror" id="customFile" name="front_view">
                                            <label class="custom-file-label" for="customFile">Check Front View</label>
                                        </div>
                                        @error('front_view')
                                            <small class="text-danger">
                                                {{$message}}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="account_number">Check Back View</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('back_view') is-invalid @enderror" id="customFile" name="back_view">
                                            <label class="custom-file-label" for="customFile">Check Back View</label>
                                        </div>
                                        @error('back_view')
                                            <small class="text-danger">
                                                {{$message}}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Deposit Check</button></div>
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
