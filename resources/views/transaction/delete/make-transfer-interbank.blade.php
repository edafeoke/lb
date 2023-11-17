@extends('layouts.template')

@section('title','Make Transfer')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Make Transfer</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('account/make-transfer')}}">Make Transfer</a></li>
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
                      Make Transfer
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            @if ($error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                </div>
                            @endif
                        <div class="form-group {{($tab == 1)? '' : 'd-none'}} ">
                            <form class="form-horizontal" method="POST" action="{{url('account/process-transfer',[1,'inter-bank'])}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" value="{{auth()->user()->firstname}} - {{auth()->user()->account->account_number}} - {{money(auth()->user()->account->available_balance,optional(auth()->user())->currency)}}" placeholder="Amount" readonly>
                                    </div>
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
                                        <label for="account_name">Account Name</label>
                                        <input name="account_name" class="form-control @error('account_name') is-invalid @enderror" id="account_name" value="{{old('account_name')}}" placeholder="Account Name">
                                        @error('account_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="account_number">Account Number</label>
                                        <input name="account_number" class="form-control @error('account_number') is-invalid @enderror" id="account_number" value="{{old('account_number')}}" placeholder="Account Number">
                                        @error('account_number')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name</label>
                                        <input name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" value="{{old('bank_name')}}" placeholder="Bank Name">
                                        @error('bank_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="swift">IFSC/Swift Code</label>
                                        <input name="swift" class="form-control @error('swift') is-invalid @enderror" id="swift" value="{{old('swift')}}" placeholder="Swift Code">
                                        @error('swift')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="routing">Routing Transit Number (RTN)</label>
                                        <input name="routing" class="form-control @error('routing') is-invalid @enderror" id="routing" value="{{old('routing')}}" placeholder="Routing Transit Number (RTN)">
                                        @error('routing')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="remarks">Remarks</label>
                                        <textarea name="remarks" class="form-control @error('remarks') is-invalid @enderror" id="remarks" placeholder="Remarks">
                                            {{old('remarks')}}
                                        </textarea>
                                        @error('remarks')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="account_type" id="inlineRadio1" value="savings" checked>
                                            <label class="form-check-label" for="savings">Savings</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="account_type" id="inlineRadio2" value="current">
                                            <label class="form-check-label" for="current">Current</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="account_type" id="inlineRadio3" value="checking">
                                            <label class="form-check-label" for="checking">Checking</label>
                                        </div>
                                        @error('account_type')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Make Transfer</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="form-group {{($tab == 2 || session('tab') == 2)? '' : 'd-none'}}">
                            <form class="form-horizontal" method="POST" action="{{url('account/process-transfer',[2,'inter-bank'])}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate FCC Code</h5>

                                        <label for="fcc">FCC</label>
                                        <input name="fcc" class="form-control" id="fcc" value="{{old('fcc')}}" placeholder="Enter FCC Code">
                                        @error('fcc')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        @foreach ($data as $key => $dt )
                                            <input type="hidden" name="data[{{$key}}]" class="form-control" id="data" value="{{$dt}}">
                                        @endforeach
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate FCC Code</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="form-group {{($tab == 3 || session('tab') == 3)? '' : 'd-none'}}">
                            <form class="form-horizontal" method="POST" action="{{url('account/process-transfer',[3,'inter-bank'])}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate TAX Code</h5>
                                        <label for="tax">TAX</label>
                                        <input name="tax" class="form-control" id="tax" value="{{old('tax')}}" placeholder="Enter TAX Code">
                                        @error('tax')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        @foreach ($data as $key => $dt )
                                            <input type="hidden" name="data[{{$key}}]" class="form-control" id="data" value="{{$dt}}">
                                        @endforeach
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate TAX Code</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="form-group {{($tab == 4 || session('tab') == 4)? '' : 'd-none'}}">
                            <form class="form-horizontal" method="POST" action="{{url('account/process-transfer',[4,'inter-bank'])}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate IMF Code</h5>
                                        <label for="imf">IMF</label>
                                        <input name="imf" class="form-control" id="imf" value="{{old('imf')}}" placeholder="Enter IMF Code">
                                        @error('imf')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        @foreach ($data as $key => $dt )
                                            <input type="hidden" name="data[{{$key}}]" class="form-control" id="data" value="{{$dt}}">
                                        @endforeach
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate IMF Code</button></div>
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
