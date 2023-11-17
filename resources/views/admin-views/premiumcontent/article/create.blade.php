@extends('admin-views.layouts.template')

@section('title','Article Create')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
  		<section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Article</h1>
            </div>
            <div class="col-sm-6">
              {{-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/article">Article</a></li>
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
          <div class="col-md-12">
            @include('layouts.includes.alerts')
          </div>
          <div class="col-md-8">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <form class="" action="/article" method="post">
                                  @csrf
                                  <div class="form-group">
                                    <select class="form-control" name="category">
                                      <option>{{'--Select Category--'}}</option>
                                      @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{Str::title($category->name)}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Article Titile">
                                  </div>
                                  <div class="form-group">
                                    <textarea id="summernote" class="form-control" name="content" style="resize:none;"></textarea>
                                  </div>
                                  <div class="form-group">
                                    <input type="submit" class="btn btn-primary col-md-12" value="Publish Article">
                                  </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12 mb-2">
                    <h5>Add Category</h5>
                  </div>
                  <div class="col-md-12">
                  <form class="" action="/category-article" method="post">
                          @csrf
                          <div class="form-group">
                            <input type="text" name="name" class="form-control" id="title" placeholder="Category Name">
                          </div>
                          <div class="form-group">
                            <textarea name="description" class="form-control" id="description" rows="3" style="resize:none;" placeholder="Category Description"></textarea>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="btn btn-primary col-md-12" value="Add Category">
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
