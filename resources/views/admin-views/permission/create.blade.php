@extends('admin-views.layouts.template')

@section('title','Create Permission')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permissions</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.permission.index')}}">Permission</a></li>
              <li class="breadcrumb-item active">Create</li>
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
            <form class="form-horizontal" method="POST" action="{{route('admin.permission.store')}}">
                  @csrf
                  <!-- Permission Creation -->
                  <div class="card">
                    <div class="card-header with-border">
                      Create Permission
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group ">
                          <div class="row">

                            <div class="col-sm-12">
                              <div class="form-group">
                                <!-- <label for="name" class="control-label">Name of Permission</label> -->
                                <input type="text" name="name" class="form-control" id="password" placeholder="Name of Permission">
                                @if ($errors->has('permission'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('permission') }}</strong>
                                  </span>
                                @endif
                              </div>
                              <div class="col-sm-8 mx-auto" ><button type="submit" class="btn btn-success text-white btn-outline-secondary col-sm-12">Create Permission</button></div>
                            </div>
                              </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer">
                    </div> -->
                      <!-- /.card-footer -->
                  </div>
                  <!-- Permission Creation -->
            </form>
            <!-- form end -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
