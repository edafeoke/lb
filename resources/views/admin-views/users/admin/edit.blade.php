@extends('admin-views.layouts.template')

@section('title','Edit Users')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>{{($user->fullname)? $user->fullname:$user->username}}</h3>
        </div>
        <div class="col-sm-6">
          {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/user">Users</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol> --}}
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
         @include('layouts.includes.alerts')
        <!-- Profile Image -->
        <div class="card">
          <div class="card-body text-center">
          <div class="row">
            <div class="col-md-12">
                <img class="img profile-user-img img-responsive img-circle" width="40px" height="100px" src="{{($user->avatar)? $user->avatar: asset('uploads/avatar/avatar.png')}}" alt="User profile picture">
              <h5 class="mt-3 mb-0"><b>{{$user->fullname}}</b></h5>
              <p>{{$user->email}}</p>

            </div>
            <div class="col-md-12">
                <span class="mt-2 mb-0 d-block">
                  <p><b>Role:</b>
                        {{($user_role)? ucfirst($user_role->name): 'No role assigned'}}
                  </p>
                </span>
              <span class="mt-0 d-block">
                <p><b>Last Login:</b>
                    {{empty($user->last_login_at)? 'Yet to login': ($user->last_login_at)->diffForHumans() }}
                </p>
              </span>
              <span class="mt-0 d-block">
                <p><b>Status:</b>
                    @if($user->status == 'active')
                      <span class="badge badge-success badge-md"> {{'Active'}}</span>
                    @elseif($user->status == 'banned')
                      <span class="badge badge-danger badge-md"> {{'Banned'}}</span>
                    @elseif($user->status == 'hold')
                      <span class="badge badge-warning badge-md"> {{'On Hold'}}</span>
                    @elseif($user->status == 'suspended')
                      <span class="badge badge-danger badge-md"> {{'Suspended'}}</span>
                    @endif
                </p>
                @if($user->id !== 1)
                    <button class="btn btn-sm btn-success col-md-12 my-1" type="button" data-toggle="modal" data-target="#popMessageModal"">Send Pop-up Message</button>
                @endif
              </span>
            </div>
          </div>
          </div>
          <!-- /.card-body -->
        </div>
            <div class="modal fade" id="popMessageModal" tabindex="-1" role="dialog" aria-labelledby="popMessageModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popMessageModalLabel">Send Pop-up Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" action="{{url('admin/send-pop',$user->id)}}" method="post">
                        @csrf
                            <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="amount">Enter Message</label>
                                <textarea type="text" class="form-control" name="message" value="{{$user->pop_message?$user->pop_message:old('message')}}" placeholder="Enter Message">
                                </textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="row">
                                <button type="submit" class="btn btn-primary btn-md col-md-12">Send Message</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        <!-- /.card -->
      </div>
      <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link active" id="contact-details-tab" data-toggle="tab" href="#contact-details" role="tab" aria-controls="contact-details" aria-selected="false">Contact Details</a>
                    </li>
                    @if($user->hasRole('users'))
                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">Account Details</a>
                    </li>
                    @endif
                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="activiylog-details-tab" data-toggle="tab" href="#activiylog-details" role="tab" aria-controls="activiylog-details" aria-selected="false">Activity Logs</a>
                    </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content mt-3">
                    <div class="tab-pane active" id="contact-details" role="tabpanel" aria-labelledby="contact-details-tab">
                          <form class="form-horizontal" method="POST" action="{{route('admin.user.update',$user->id)}}">
                              @csrf
                              @method('put')
                                  <div class="row form-group">
                                        <div class="col-md-6 mt-1">
                                            <label for="mobile">Status</label>
                                            <select name="status" class="form-control form-control-inline-block">
                                                <option value="active" {{($user->status == 'active')? 'selected':''}}>{{'Active'}}</option>
                                                <option value="banned" {{($user->status == 'banned')? 'selected':''}}>{{'Banned'}}</option>
                                                <option value="suspended" {{($user->status == 'suspended')? 'selected':''}}>{{'Suspended'}}</option>
                                                <option value="hold" {{($user->status == 'hold')? 'selected':''}}>{{'Hold'}}</option>
                                                @error('status')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                                @enderror
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div><label class="label-block">Email</label></div>
                                            <input type="text" name="email" value="{{$user->email}}" placeholder="Email" class="form-control" >
                                            @if ($errors->has('email'))
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-4 mb-1 mt-1">
                                          <div><label class="label-block">Firstname</label></div>
                                          <input type="text" name="firstname" value="{{ $user->firstname }}" placeholder="Firstname" class="form-control" >
                                            @error('firstname')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @endif
                                        </div>
                                        <div class="col-md-4 mb-1 mt-1">
                                          <div><label class="label-block">Middlename</label></div>
                                          <input type="text" name="middlename" value="{{ $user->middlename }}" placeholder="Middlename" class="form-control" >
                                            @error('middlename')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-1 mt-1">
                                          <div><label class="label-block">Lastname</label></div>
                                          <input type="text" name="lastname" value="{{ $user->lastname }}" placeholder="Lastname" class="form-control" >
                                            @error('lastname')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>

                                    <div class="col-md-6">
                                      <div><label class="label-block">Username</label></div>
                                      <input type="text" name="username" value="{{$user->username}}" placeholder="Username" class="form-control" autocomplete="off">
                                      @error('username')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                    </div>
                                    <div id="birthday" class="col-sm-6 mb-1 mt-1">
                                        <label for="name">Birthday</label>
                                        <input type="text" name="birthday" value="{{$user->birthday}}" placeholder="Birthday" class="form-control">
                                        @error('birthday')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                      <div><label class="label-block">Sex</label></div>
                                      <select name="sex" class="form-control @error('sex') is-invalid @enderror" placeholder="Phone">
                                        <option value="">Select-Sex</option>
                                        <option value="female" {{($user->sex == 'female')?'selected':''}}>Female</option>
                                        <option value="male" {{($user->sex == 'male')?'selected':''}}>Male</option>
                                      </select>
                                      @error('sex')
                                      <span class="text-danger d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                  </div>
                                  <div class="col-sm-4">
                                      <div><label class="label-block">Marital Status</label></div>
                                      <select name="marital_status" class="form-control @error('marital_status') is-invalid @enderror" >
                                        <option value="">Select-Marital-Status</option>
                                        <option value="single" {{($user->marital_status == 'single')?'selected':''}}>Single</option>
                                        <option value="married" {{($user->marital_status == 'married')?'selected':''}}>Married</option>
                                        <option value="divorce" {{($user->marital_status == 'divorce')?'selected':''}}>Divorce</option>
                                      </select>
                                      @error('marital_status')
                                      <span class="text-danger d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                  </div>
                                  <div class="col-sm-4">
                                    <label for="occupation" class="control-label">Occupation</label>
                                    <input type="text" name="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{$user->occupation}}" id="occupation" placeholder="Occupation">
                                    @error('occupation')
                                    <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @endif
                                 </div>
                                <div class="col-sm-6 mt-1">
                                    <div><label class="label-block">Currency</label></div>
                                    <select name="currency" class="form-control @error('currency') is-invalid @enderror" placeholder="Currency">
                                        <option value="">Select-Currency</option>
                                        <option value="USD" {{($user->currency == 'USD')? 'selected' : ''}}>USD</option>
                                        <option value="GBP" {{($user->currency == 'GBP')? 'selected' : ''}}>GBP</option>
                                        <option value="JPY" {{($user->currency == 'JPY')? 'selected' : ''}}>JPY</option>
                                        <option value="EUR" {{($user->currency == 'EUR')? 'selected' : ''}}>EUR</option>
                                    </select>
                                    @error('currency')
                                    <span class="text-danger d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                    <div class="col-md-6 mt-1">
                                        <div><label class="label-block">Phone</label></div>
                                        <input type="text" name="phone" value="{{$user->phone}}" class="form-control" placeholder="Phone" >
                                        @error('phone')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mt-1">
                                        <label for="address" class="control-label">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{$user->address}}" id="address" placeholder="Address">
                                        @error('address')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 my-1">
                                      <div><label class="label-block">Password</label></div>
                                      <input type="password" name="password" value="" placeholder="Leave blank if you don't want to change" class="form-control" autocomplete="off">
                                      @error('password')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                    </div>
                                    <div class="col-md-6 my-1">
                                      <div><label class="label-block">Confirm Pasword</label></div>
                                      <input type="password" name="password_confirmation" value="" placeholder="Leave blank if you don't want to change" class="form-control" autocomplete="off">
                                      @error('password_confirmation')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                    </div>
                                  </div>

                                <div class="col-md-8 mx-auto">
                                  <button type="submit" class="btn btn-primary col-sm-12">Update Contact</button>
                                </div>
                        </form>
                    </div>
                    @if($user->hasRole('users'))
                    <div class="tab-pane" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                          <form class="form-horizontal" method="POST" action="{{route('admin.update-account',$user->id)}}">
                              @csrf
                                  <div class="row form-group">
                                        <div class="col-sm-6">
                                            <label class="label-block">Account Type</label>
                                            <select name="account_type" class="form-control @error('occupation') is-invalid @enderror" >
                                                <option value="">Select-Account-Type</option>
                                                <option value="savings" {{($user->account->account_type == 'savings')?'selected':''}}>Savings</option>
                                                <option value="current" {{($user->account->account_type == 'current')?'selected':''}}>Current</option>
                                            </select>
                                            @error('account_type')
                                            <span class="text-danger d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="account_number" class="control-label">Account Number</label>
                                            <input type="text" name="account_number" value="{{$user->account->account_number}}" class="form-control @error('account_number') is-invalid @enderror" id="account_number" placeholder="Account Number">
                                            @error('account_number')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="account_pin" class="control-label">Account Pin</label>
                                            <input type="text" name="account_pin" value="{{$user->account->account_pin}}" class="form-control @error('account_pin') is-invalid @enderror" id="account_pin" placeholder="Account Pin">
                                            @error('account_pin')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                                    <label for="routing_number" class="control-label">Routing Number</label>
                                                    <input type="text" name="routing_number" value="{{$user->account->routing_number}}" class="form-control @error('routing_number') is-invalid @enderror" id="routing_number" placeholder="Routing Number">
                                                    @error('routing_number')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                              </div>
                                        <div class="col-sm-6">
                                            <label for="fcc" class="control-label">FCC</label>
                                            <input type="text" name="fcc" value="{{$user->account->cot}}" class="form-control @error('fcc') is-invalid @enderror" id="fcc" placeholder="FCC">
                                            @error('fcc')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="tax" class="control-label">TAX</label>
                                            <input type="text" name="tax" value="{{$user->account->tax}}" class="form-control @error('tax') is-invalid @enderror" id="tax" placeholder="TAX">
                                            @error('tax')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="imf" class="control-label">IMF</label>
                                            <input type="text" name="imf" value="{{$user->account->imf}}" class="form-control @error('imf') is-invalid @enderror" id="imf" placeholder="IMF">
                                            @error('imf')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                  </div>

                                <div class="col-md-8 mx-auto">
                                  <button type="submit" class="btn btn-primary col-sm-12">Update Account</button>
                                </div>
                        </form>
                    </div>
                    @endif
                    <div class="tab-pane" id="activiylog-details" role="tabpanel" aria-labelledby="activiylog-details-tab">
                      <div class="row">
                        <div class="col-md-12">
                          <a href="/admin/user/{{$user->id}}/activity-log" class="btn btn-outline-secondary pull-right">View All</a>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive no-padding">
                        <table class="table table-hover table-striped table-borderless">
                          <thead>
                            <tr>
                              <th class="">Activity Description</th>
                              <th class="">Activity Created at</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(count($activities) > 0)
                              @foreach($activities as $activity)
                               <tr>
                                 <td>{{$activity->description}}</td>
                                 <td>{{date('Y-m-d h:i',strtotime($activity->created_at))}}</td>
                               </tr>
                              @endforeach
                            @else
                            <tr>
                              <td colspan="2"> <i><h5 class="text-muted text-center">No record found</h5></i></td>
                            </tr>
                            @endif
                         </tbody>
                         </table>
                       </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div>
  </section>
        <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
