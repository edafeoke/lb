@extends('admin-views.layouts.template')

@section('title','Article Category Edit')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
  		<section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!-- <h1></h1> -->
            </div>
            <div class="col-sm-6">
              {{-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/category-article">Article Category</a></li>
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
          <div class="col-md-7 mx-auto">
            @include('layouts.includes.alerts')
            <div class="row">
              <div class="col-md-12">
                <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                  <form class="" action="/category-article/{{$category->slug}}" method="post">
                          @method('PUT')
                          @csrf
                          <div class="form-group">
                            <input type="text" name="name" value="{{$category->name}}" class="form-control" id="title" placeholder="Category Name">
                          </div>
                          <div class="form-group">
                            <textarea name="description" class="form-control" id="description" rows="3" style="resize:none;" placeholder="Category Description">{{$category->description}}</textarea>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="btn btn-primary col-md-12" value="Update Category">
                          </div>
                    </form>
                </div>
                </div>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
