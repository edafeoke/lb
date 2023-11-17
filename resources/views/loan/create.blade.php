@extends('layouts.template')

@section('title','Apply for Loan')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Application for Loan</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('account/loan')}}">Loan</a></li>
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
                      Apply for Loan
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group ">
                            <form class="form-horizontal" method="POST" action="{{url('account/loan/create')}}">
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
                                        <label for="duration">Duration</label>
                                        <select name="duration" class="form-control @error('duration') is-invalid @enderror" id="duration" >
                                            <option value="one-week" {{(old('duration')=='one-week')?'selected':''}}>One (1) Week</option>
                                            <option value="two-weeks" {{(old('two-weeks')=='two-weeks')?'selected':''}}>Two (2) Weeks</option>
                                            <option value="one-month" {{(old('one-month')=='one-month')?'selected':''}}>One (1) Month</option>
                                            <option value="three-months" {{(old('three-months')=='three-months')?'selected':''}}>Three (3) Months</option>
                                            <option value="six-months" {{(old('six-months')=='six-months')?'selected':''}}>Six (6) Months</option>
                                            <option value="one-year" {{(old('one-year')=='one-year')?'selected':''}}>One (1) Year</option>
                                        </select>
                                        @error('duration')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Reason for loan</label>
                                        <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" id="reason" placeholder="Amount">
                                            {{old('reason')}}
                                        </textarea>
                                        @error('reason')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Submit Loan Application</button></div>
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
