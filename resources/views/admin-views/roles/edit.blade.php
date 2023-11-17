@extends('admin-views.layouts.template')

@section('title','Edit Role')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ucfirst($role->name)}}</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Roles</a></li>
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
        <!-- right column -->
        <div class="col-md-7 mx-auto">
            @include('layouts.includes.alerts')
            <form class="form-horizontal" method="POST" action="{{route('admin.role.update',$role->id)}}">
                @csrf
                @method('PUT')
              <!-- Role Creation -->
                  <div class="card">
                    <div class="card-header with-border">
                      Edit Role
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body">
                        <div class="form-group">
                          <div  class="col-md-12 text-center">
                              <input type="text" value="{{$role->name}}"name="name" class="form-control" id="password" placeholder="Name of Role">
                              @if ($errors->has('role'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                              @endif
                          </div>
                        </div>
                        <div class="col-sm-8 mx-auto" style="margin: auto;float:none;"><button type="submit" class="btn btn-success col-sm-12">Update Role</button></div>
                    </div>
                      <!-- /.card-body -->
                  </div>
              <!-- Role Creation -->
            </form>
            <!-- form end -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
