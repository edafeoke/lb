@extends('admin-views.layouts.template')

@section('title','Credit Account')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Debit Account</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('admin/debit/account')}}">Debit Account</a></li>
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
            <form class="form-horizontal" method="POST" action="{{url('admin/credit-debit/account','debit')}}">
                  @csrf
                  <!-- Permission Creation -->
                  <div class="card">
                    <div class="card-header with-border">
                      Debit Account
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group ">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <select name="user_id" class="form-control" id="user_id">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->fullnames}}</option>
                                    @endforeach
                                </select>
                                @error('user')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>

                              <div class="form-group">
                                <label for="amount">Amount</label>
                                <input name="amount" class="form-control" id="amount" value="{{old('amount')}}" placeholder="Amount">
                                @error('amount')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" placeholder="Description">
                                    {{old('description')}}
                                </textarea>
                                @error('description')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group dateFormat">
                                <label for="date">Date</label>
                                <input name="date" class="form-control" id="date" value="{{old('date')}}" placeholder="Date">
                                @error('date')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="time">Time <small>24h (e.g 22:10)</small></label>
                                <input name="time" class="form-control timepicker" id="time" value="{{old('time')}}" placeholder="Time e.g 23:40">
                                @error('time')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Debit Account</button></div>
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
