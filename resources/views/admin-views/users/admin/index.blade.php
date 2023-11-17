@extends('admin-views.layouts.template')
@section('title','Users')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">Users</a></li>
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
             <div class="col-12">
  		           @include('layouts.includes.alerts')
                  <div class="card">

                    <div class="card-body">
                      <div class="row">
                        {{-- <div class="col-md-12 mb-3">
                          <a href="{{route('admin.user.create')}}" class="pull-right btn btn-primary">Create User</a>
                        </div> --}}
                        <div class="col-md-4 mb-2">
                          <form class="form" action="" method="GET">
                            <div class="input-group">
                               <input type="text" name="search" value="{{ request()->input('search') }}" class="form-control" placeholder="Search">
                               @if(request()->input('search') && request()->input('search')!= '')
                                 <div class="input-group-append">
                                   <a class="btn btn-outline-secondary" href="{{route('admin.user.index')}}" type="submit"><i class="fa fa-close"></i></a>
                                 </div>
                               @endif
                               <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search text-muted"></i></button>
                               </div>
                            </div>
                          </form>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive no-padding">
                  			<table id="" class="table table-hover table-borderless table-striped" >
                              <thead>
                      			<tr>
                                    <th>ID</th>
                                    <th>Picture</th>
                                    <th>Fullname</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                        		@forelse($users as $key => $user)
                        		<tr>
                                    <td>{{++$key}}</td>
                                    <td><img class="img-fluid rounded-circle" width="40px" src="{{($user->avatar)? $user->avatar : asset('uploads/avatar/avatar.png')}}" alt="icon"></td>
                                    <td><a href="{{route('admin.user.edit',$user->id)}}">{{$user->fullname}}</a></td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->status=='active')
                                          <span class="badge badge-success">{{'Active'}}</span>
                                        @elseif($user->status=='banned')
                                          <span class="badge badge-danger">{{'Banned'}}</span>
                                        @elseif($user->status=='hold')
                                          <span class="badge badge-warning">{{'On Hold'}}</span>
                                        @elseif($user->status=='suspended')
                                          <span class="badge badge-danger">{{'Suspended'}}</span>
                                        @endif
                                    </td>
                        			<td>{{$user->created_at}}</td>
                        			<td>
                                        <div class="d-inline-block">
                                          <div class="dropdown">
                                            @if($user->username != 'admin')
                                            @canBeImpersonated($user)
                                            <a href="{{route('admin.impersonate',$user->id)}}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="impersonate user"><i class="fa text-white fa-user-secret"></i></a>
                                            @endCanBeImpersonated
                                            @endif

                                          </div>
                                        </div>
                                        <div class="d-inline-block">
                                          <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit" data-toggle="tooltip"  data-placement="bottom" title="Edit User"></i></a>
                                        </div>
                                        <div class="d-inline-block">
                                          @if($user->id !== 1)

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUser{{$user->id}}"><i class='fa fa-trash'></i></button>
                                            <div class="modal fade" id="deleteUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteUserLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <form action="{{route('admin.user.destroy',$user->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body text-center">
                                                    <h3 class="mb-4">Please Confirm!</h3>
                                                    <p class="mb-5">Are you sure you want to delete user?</p>
                                                    <button type="button" class="btn btn-secondary col-md-5 pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger col-md-6 pull-right">Delete</button>
                                                    </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>

                                          @endif
                                        </div>
                                   </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <p><i>No record found</i></p>
                                    </td>
                                </tr>
                                @endforelse
                              </tbody>
                  			</table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 mt-2">
                    {{$users->links()}}
                  </div>
                  <!-- /.card -->

             </div>
          </div>
       </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
