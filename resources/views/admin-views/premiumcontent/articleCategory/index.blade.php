@extends('admin-views.layouts.template')

@section('title','Article Category')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Article Category</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/category-article">Article Category</a></li>
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
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <a href="/category-article/create" class="pull-right btn btn-primary">Create Category</a>
                </div>
                <div class="col-md-12">
                  <div class="table-responsive no-padding ">
                <table id="dataTable" class="table table-borderless table-striped table-hover">
                  <thead>
                  <tr>
                    <th class="">Category Name</th>
                    <th class="">Created At</th>
                    <th class="">Updated At</th>
                    <th class="">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                  <tr>
                    <td>{{$category->name}}</td>
                    <td>{{Str::limit($category->description,80,' (...)')}}</td>
                    <td>{{date('M d, Y',strtotime($category->created_at))}}</td>
                    <td>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="mx-1">
                            <a href="/category-article/{{$category->slug}}/edit"><button class="btn btn-info" data-toggle="tooltip"  data-placement="bottom" title="Edit Article"/><i class="fa fa-edit text-white"></i></button></a>
                          </div>
                          <div class="mx-1">
                            <form action="/category-article/{{$category->slug}}" method="POST">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger" data-toggle="tooltip"  data-placement="bottom" title="Delete Article"/><i class='fa fa-trash text-white'></i></button>
                            </form>
                          </div>
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
