@extends('layouts.template')

@section('title','Make IntraBank Transfer')
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
                                <div class="alert alert-danger alert-dismissible fade show d-none" role="alert"></div>
                        <div id="first_form" class="form-group">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" value="{{auth()->user()->firstname}} - {{auth()->user()->account->account_number}} - {{money(auth()->user()->account->available_balance,optional(auth()->user())->currency)}}" placeholder="Amount" readonly>
                                    </div>
                                    <div class="form-group dateFormat">
                                        <label for="date">Date</label>
                                        <input name="date" class="form-control" id="date" value="{{old('date')}}" placeholder="Date" autocomplete="off">
                                        <span id="dateError" class="text-danger d-none" role="alert"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input name="amount" class="form-control" id="amount" value="{{old('amount')}}" placeholder="Amount">
                                        <span id="amountError" class="text-danger d-none" role="alert"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="account_number">Account Number</label>
                                        <input name="account_number" class="form-control" id="account_number" value="{{old('account_number')}}" placeholder="Account Number">
                                        <span id="accountNumberError" class="text-danger d-none" role="alert"></span>
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button id="submit_transfer" type="button" class="btn btn-success text-white btn-outline-secondary col-sm-12">Make Transfer</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="second_form" class="form-group d-none">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate FCC Code</h5>
                                        <label for="fcc">FCC</label>
                                        <input name="fcc" class="form-control" id="fcc" value="{{old('fcc')}}" placeholder="Enter FCC Code">
                                        <span id="fccError" class="text-danger d-none" role="alert"></span>
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button id="validate_fcc" type="button" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate FCC Code</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="third_form" class="form-group d-none">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate TAX Code</h5>
                                        <label for="tax">TAX</label>
                                        <input name="tax" class="form-control" id="tax" value="{{old('tax')}}" placeholder="Enter TAX Code">
                                        <span id="taxError" class="text-danger d-none" role="alert"></span>
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button id="validate_tax" type="button" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate TAX Code</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="forth_form" class="form-group d-none">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate IMF Code</h5>
                                        <label for="imf">IMF</label>
                                        <input name="imf" class="form-control" id="imf" value="{{old('imf')}}" placeholder="Enter IMF Code">
                                        <span id="imfError" class="text-danger d-none" role="alert"></span>
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button id="validate_imf" type="button" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate IMF Code</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="fifth_form" class="form-group d-none">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate One-Time-Pin (OTP)</h5>
                                        <label for="otp">OTP (<small>check your email for OTP</small>)</label>
                                        <input name="otp" class="form-control" id="otp" value="{{old('otp')}}" placeholder="Enter OTP Code">
                                        <span id="otpError" class="text-danger d-none" role="alert"></span>
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button id="validate_otp" type="button" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate OTP</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- <div id="second_form" class="form-group d-none">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate One-Time-Pin (OTP)</h5>

                                        <label for="otp">OTP</label>
                                        <input name="otp" class="form-control" id="otp" value="{{old('otp')}}" placeholder="Enter otp Code">
                                        <span id="otpError" class="text-danger d-none" role="alert"></span>
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button id="validate_otp" type="button" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate otp Code</button></div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}

                        {{-- <div id="third_form" class="form-group d-none">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate TAX Code</h5>
                                        <label for="tax">TAX</label>
                                        <input name="tax" class="form-control" id="tax" value="{{old('tax')}}" placeholder="Enter TAX Code">
                                        <span id="taxError" class="text-danger d-none" role="alert"></span>
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button id="validate_tax" type="button" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate TAX Code</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="forth_form" class="form-group d-none">
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5 class="text-center">Validate IMF Code</h5>
                                        <label for="imf">IMF</label>
                                        <input name="imf" class="form-control" id="imf" value="{{old('imf')}}" placeholder="Enter IMF Code">
                                        <span id="imfError" class="text-danger" role="alert"></span>
                                    </div>
                                    <div class="col-sm-8 mx-auto" ><button id="validate_imf" type="button" class="btn btn-success text-white btn-outline-secondary col-sm-12">Validate IMF Code</button></div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                  </div>
            </div>
          </div>
      </div>
    </section>
  </div>
@endsection

@section('script')
<script>
    $('document').ready(function(){

        var data = [];
        var slug = '';

        $('#submit_transfer').on('click',function(){
            $.LoadingOverlay("show");

            var date = $('#date').val();
            var amount = $('#amount').val();
            var account_number = $('#account_number').val();

            if(!date){
                $('#dateError').text('Pick Date');
                $('#dateError').removeClass('d-none');
                $('#date').addClass('is-invalid');
                $.LoadingOverlay("hide");
            }

            if(!amount){
                $('#amountError').text('Enter amount');
                $('#amountError').removeClass('d-none');
                $('#amount').addClass('is-invalid');
                $.LoadingOverlay("hide");
            }

            if(!account_number){
                $('#accountNumberError').text('Enter account number');
                $('#accountNumberError').removeClass('d-none');
                $('#account_number').addClass('is-invalid');
                $.LoadingOverlay("hide");
            }


            if(date && amount && account_number){
                var url = "{{url('account/process-transfer',[1,'intra-bank'])}}";
                axios({
                    url: url,
                    method: 'POST',
                    data: {
                        date: date,
                        amount: amount,
                        account_number: account_number,
                    },
                })
                .then((res)=>{
                    if(res.status == 200){
                        data = res.data.data;
                        slug = res.data.slug;
                        $('#first_form').addClass('d-none');
                        $('#second_form').removeClass('d-none');
                    }

                    $.LoadingOverlay("hide");
                })
                .catch((err)=>{
                    if(err.response.status == 500){
                        swal({
                            text:err.response.data.message,
                            icon: 'error',
                        });
                    }
                    if(err.response.status == 400){
                        swal({
                            text:err.response.data.message,
                            icon: 'error',
                        });
                    }

                    if(err.response.status == 422){
                        $.each(err.response.data.errors,function(key,value){
                            if(key == 'amount'){
                                $('#amountError').text(value);
                                $('#amountError').removeClass('d-none');
                                $('#amount').addClass('is-invalid');
                            }
                            if(key == 'account_number'){
                                $('#accountNumberError').text(value);
                                $('#accountNumberError').removeClass('d-none');
                                $('#account_number').addClass('is-invalid');
                            }
                        });
                    }
                    $.LoadingOverlay("hide");
                });
            }
        });
        $('#validate_fcc').on('click',function(){
            $.LoadingOverlay("show");
            var fcc = $('#fcc').val();

            if(!fcc){
                $('#fccError').text('Enter FCC');
                $('#fccError').removeClass('d-none');
                $('#fcc').addClass('is-invalid');
                $.LoadingOverlay("hide");
            }

            if(fcc){
                var url = "{{url('account/process-transfer',[2,'inter-bank'])}}";
                axios({
                    url: url,
                    method: 'POST',
                    data: {
                        slug: slug,
                        fcc : fcc,
                    },
                })
                .then((res)=>{
                    if(res.status == 200){
                        slug = res.data.slug;
                        $('#second_form').addClass('d-none');
                        $('#third_form').removeClass('d-none');
                    }
                    $.LoadingOverlay("hide");
                })
                .catch((err)=>{
                    if(err.response.status == 400){
                        $.LoadingOverlay("hide");
                        $('#fccError').text('Invalid Code! please try again');
                        $('general_error').text('Invalid Code! please try again');
                        $('general_error').removeClass('d-none');
                        $('#fccError').removeClass('d-none');
                        $('#').addClass('is-invalid');
                    }
                    if(err.response.status == 422){
                        $.LoadingOverlay("hide");
                        $.each(err.response.data.errors,function(key,value){
                            if(key == 'fcc'){
                                $('#fccError').text(value);
                                $('#fccError').removeClass('d-none');
                                $('#fcc').addClass('is-invalid');
                            }
                        });
                    }
                    $.LoadingOverlay("hide");
                });
            }
        });
        $('#validate_tax').on('click',function(){
            $.LoadingOverlay("show");
            var tax = $('#tax').val();

            if(!tax){
                $('#taxError').text('Enter tax');
                $('#taxError').removeClass('d-none');
                $('#tax').addClass('is-invalid');
                $.LoadingOverlay("hide");
            }

            if(tax){
                var url = "{{url('account/process-transfer',[3,'inter-bank'])}}";
                axios({
                    url: url,
                    method: 'POST',
                    data: {
                        slug: slug,
                        tax : tax,
                    },
                })
                .then((res)=>{
                    if(res.status == 200){
                        slug = res.data.slug;
                        $('#third_form').addClass('d-none');
                        $('#forth_form').removeClass('d-none');
                    }
                    $.LoadingOverlay("hide");
                })
                .catch((err)=>{
                    if(err.response.status == 400){
                        $.LoadingOverlay("hide");
                        $('#taxError').text('Invalid Code! please try again');
                        $('general_error').text('Invalid Code! please try again');
                        $('general_error').removeClass('d-none');
                        $('#taxError').removeClass('d-none');
                        $('#').addClass('is-invalid');
                    }
                    if(err.response.status == 422){
                        $.LoadingOverlay("hide");
                        $.each(err.response.data.errors,function(key,value){
                            if(key == 'tax'){
                                $('#taxError').text(value);
                                $('#taxError').removeClass('d-none');
                                $('#tax').addClass('is-invalid');
                            }
                        });
                    }
                    $.LoadingOverlay("hide");
                });
            }
        });
        $('#validate_imf').on('click',function(){
            $.LoadingOverlay("show");
            var imf = $('#imf').val();

            if(!imf){
                $('#imfError').text('Enter imf');
                $('#imfError').removeClass('d-none');
                $('#imf').addClass('is-invalid');
                $.LoadingOverlay("hide");
            }

            if(imf){
                var url = "{{url('account/process-transfer',[4,'inter-bank'])}}";
                axios({
                    url: url,
                    method: 'POST',
                    data: {
                        slug: slug,
                        imf : imf,
                    },
                })
                .then((res)=>{
                    if(res.status == 200){
                        slug = res.data.slug;
                        $('#forth_form').addClass('d-none');
                        $('#fifth_form').removeClass('d-none');
                    }
                    $.LoadingOverlay("hide");
                })
                .catch((err)=>{
                    if(err.response.status == 400){
                        $.LoadingOverlay("hide");
                        $('#imfError').text('Invalid Code! please try again');
                        $('general_error').text('Invalid Code! please try again');
                        $('general_error').removeClass('d-none');
                        $('#imfError').removeClass('d-none');
                        $('#').addClass('is-invalid');
                    }
                    if(err.response.status == 422){
                        $.LoadingOverlay("hide");
                        $.each(err.response.data.errors,function(key,value){
                            if(key == 'imf'){
                                $('#imfError').text(value);
                                $('#imfError').removeClass('d-none');
                                $('#imf').addClass('is-invalid');
                            }
                        });
                    }
                    $.LoadingOverlay("hide");
                });
            }
        });
        $('#validate_otp').on('click',function(){
            $.LoadingOverlay("show");
            var otp = $('#otp').val();

            if(!otp){
                $('#otpError').text('Enter otp');
                $('#otpError').removeClass('d-none');
                $('#otp').addClass('is-invalid');
                $.LoadingOverlay("hide");
            }

            if(otp){
                var url = "{{url('account/process-transfer',[5,'intra-bank'])}}";
                axios({
                    url: url,
                    method: 'POST',
                    data: {
                        slug: slug,
                        otp : otp,
                    },
                })
                .then((res)=>{
                    if(res.status == 200){
                        data = res.data.data;
                        slug = res.data.slug;
                        swal({
                             text: res.data.message,
                             icon: 'success',
                         }).then((e)=>{
                             window.location = "{{url('/account/transfers')}}"
                         });
                    }
                    $.LoadingOverlay("hide");
                })
                .catch((err)=>{
                    if(err.response.status == 400){
                        $('#otpError').text('Invalid Code! please try again');
                        $('general_error').text('Invalid Code! please try again');
                        $('general_error').removeClass('d-none');
                        $('#otpError').removeClass('d-none');
                        $('#otp').addClass('is-invalid');
                    }
                    if(err.response.status == 422){
                        $.each(err.response.data.errors,function(key,value){
                            if(key == 'otp'){
                                $('#otpError').text(value);
                                $('#otpError').removeClass('d-none');
                                $('#otp').addClass('is-invalid');
                            }
                        });
                    }
                    $.LoadingOverlay("hide");
                });
            }
        });

        $('#date').change(function(){
            $('#dateError').text('');
            $('#dateError').addClass('d-none');
            $('#date').removeClass('is-invalid');

        });

        $('#amount').on('keydown',function(){
            $('#amountError').text('');
            $('#amountError').addClass('d-none');
            $('#amount').removeClass('is-invalid');
        });

        $('#account_number').on('keydown',function(){
            $('#accountNumberError').text('');
            $('#accountNumberError').addClass('d-none');
            $('#account_number').removeClass('is-invalid');
        });
        $('#otp').on('keydown',function(){
            $('#otpError').text('');
            $('#otpError').addClass('d-none');
            $('#otp').removeClass('is-invalid');
             $('#general_error').text('');
            $('#general_error').addClass('d-none');
        });
        $('#fcc').on('keydown',function(){
            $('#fccError').text('');
            $('#fccError').addClass('d-none');
            $('#fcc').removeClass('is-invalid');
             $('#general_error').text('');
            $('#general_error').addClass('d-none');
        });
        $('#tax').on('keydown',function(){
            $('#taxError').text('');
            $('#taxError').addClass('d-none');
            $('#tax').removeClass('is-invalid');
             $('#general_error').text('');
            $('#general_error').addClass('d-none');
        });
        $('#imf').on('keydown',function(){
            $('#imfError').text('');
            $('#imfError').addClass('d-none');
            $('#imf').removeClass('is-invalid');
             $('#general_error').text('');
            $('#general_error').addClass('d-none');
        });

    });
</script>
@endsection
