@extends('admin-views.layouts.template')

@section('title','Role')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Roles</a></li>
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
        <div class="col-md-12">
          @include('layouts.includes.alerts')
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <a href="{{route('admin.role.create')}}" class="pull-right btn btn-primary">Create Role</a>
                </div>
                <div class="col-md-12">
                  <div class="table-responsive no-padding">
                <table id="dataTable" class="table table-hover table-borderless table-striped">
                  <thead>
                  <tr>
                    <th class="">ID</th>
                    <th class="">Name</th>
                    <th class="">Created At</th>
                    <th class="">Updated At</th>
                    <th class="">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($roles as $role)
                  <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->created_at}}</td>
                    <td>{{$role->updated_at}}</td>
                    <td>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="mx-1">
                            <a href="{{route('admin.role.show',$role->id)}}"><button class="btn btn-success btn-sm" data-toggle="tooltip"  data-placement="bottom" title="Add Permission"/><i class="fa fa-shield"></i></button></a>
                          </div>
                          <div class="mx-1">
                            <a href="{{route('admin.role.edit',$role->id)}}"><button class="btn btn-info btn-sm" data-toggle="tooltip"  data-placement="bottom" title="Edit Role"/><i class="fa fa-edit text-white"></i></button></a>
                          </div>
                          @if($role->removable)
                          <div class="mx-1">
                            <form action="{{route('admin.role.destroy',$role->id)}}" method="POST">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger btn-sm" data-toggle="tooltip"  data-placement="bottom" title="Delete Role"/><i class='fa fa-trash text-white'></i></button>
                            </form>
                          </div>
                          @endif
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                </table>
              </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
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
@section('script')
<script src="{{asset('js/datatable.js')}}" charset="utf-8"></script>
@endsection
