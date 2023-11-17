@extends('admin-views.layouts.template')

@section('title','Settings')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
		<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>App Settings</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">App Settings</li>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mx-auto mb-3">
                  <ul class="nav nav-tabs" id="app-setting" role="tablist">

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link active" id="app-name-tab" data-toggle="tab" href="#app-name" role="tab" aria-controls="app-name" aria-selected="true"><i class="fa fa-user mr-2"></i>App name</a>
                    </li>

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="app-logo-tab" data-toggle="tab" href="#app-logo" role="tab" aria-controls="app-logo" aria-selected="false"><i class="fa fa-image mr-2"></i>App Logo</a>
                    </li>

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="app-theme-tab" data-toggle="tab" href="#app-theme" role="tab" aria-controls="app-theme" aria-selected="false"><i class="fa fa-paint-brush mr-2"></i>App Theme</a>
                    </li>

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="auth-settings-tab" data-toggle="tab" href="#auth-settings" role="tab" aria-controls="auth-settings" aria-selected="false"><i class="fa fa-key mr-2"></i>Authentication Settings</a>
                    </li>

                    <li class="nav-item shadow mb-3 mr-2">
                      <a class="nav-link" id="app-backup-tab" data-toggle="tab" href="#app-backup" role="tab" aria-controls="app-backup" aria-selected="false"><i class="fa fa-database mr-2 text-light"></i>Application Backup</a>
                    </li>
                  </ul>
              </div>
              <div class="col-md-7 mx-auto">
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content my-3" id="app-settingContent">
                    <div class="tab-pane fade show active" id="app-name" role="tabpanel" aria-labelledby="app-name-tab">
                      <form action="{{route('admin.settings/app-name/update')}}" method="POST">
                            @csrf
                            <div class="col-md-12">
                              <div class="form-group">
                                <input type="text"  name="app_name"  class="form-control" value="{{setting('app_name')}}" placeholder="Application Name">
                              </div>
                              <input type="submit"  class="form-control mt-2 btn btn-success" value="Save Name">
                            </div>
                    </form>
                    </div>
                    <div class="tab-pane fade" id="app-logo" role="tabpanel" aria-labelledby="app-logo-tab">
                          <form action="{{route('admin.settings/app-logo/update')}}" enctype="multipart/form-data" method="POST">
                              @csrf
                              <div class="col-md-12">
                                <div class="form-group bg-light text-center">
                                  <img id="app-dark-logo" class="img img-responsive my-5 w-50 justify-content-center text-center" src="{{setting('app_dark_logo')? asset('uploads/appLogo/app-logo-dark.png') :asset('uploads/appLogo/logo-dark.png')}}" alt="App_logo">
                                </div>
                                <div class="form-group">
                                  <label class="form-group mb-1">Select Dark Logo</label>
                                  <input type="file"  name="app_dark_logo"  class="form-control" value="Select Dark Logo">
                                </div>
                                <div class="form-group bg-secondary text-center">
                                  <img id="app-light-logo" class="img img-responsive my-5 w-50 justify-content-center text-center" src="{{setting('app_light_logo')? asset('uploads/appLogo/app-logo-light.png') :asset('uploads/appLogo/logo-light.png')}}" alt="App_logo">
                                </div>
                                <div class="form-group">
                                  <label class="form-group mb-1">Select Light Logo</label>
                                  <input type="file"  name="app_light_logo"  class="form-control" value="Select Light Logo">
                                </div>
                                <input type="submit"  class="form-control mt-2 btn btn-success" value="Update Logo">
                              </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="app-theme" role="tabpanel" aria-labelledby="app-theme-tab">
                          <form action="{{route('admin.settings/app-theme/update')}}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                  <div class="form-group">
                                        <label class="form-group">Sidebar Theme</label>
                                      <select class="form-control" name="app_sidebar">
                                        <option value="dark" {{(setting('app_sidebar')=="dark")? 'selected' : ''}}>Dark</option>
                                        <option value="light" {{(setting('app_sidebar')=="light")? 'selected' : ''}}>Light</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-group">NavBar Text Color</label>
                                      <select class="form-control" name="app_theme">
                                        <option value="dark" {{(setting('app_theme')=="dark")? 'selected' : ''}}>Dark</option>
                                        <option value="light" {{(setting('app_theme')=="light")? 'selected' : ''}}>Light</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                        <label class="form-group">NavBar Background</label>
                                        <input type="color" class="form-control" name="app_navbar" value="{{setting('app_navbar')}}" id="color-picker">
                                  </div>
                                  <input type="submit"  class="form-control mt-2 btn btn-success" value="Save Theme">
                                </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="auth-settings" role="tabpanel" aria-labelledby="auth-settings-tab">
                        <form action="{{route('admin.settings/auth-settings/update')}}" method="POST">
                              @csrf
                              <div class="col-md-12">
                                <div class="form-group row mb-4">
                                  <div class="col-md-8">
                                    <strong class="d-block">Two Factor Authentication</strong>
                                    {{!setting('2fa')? 'Activate': 'Deactivate'}} Two factor authentication for application.
                                  </div>
                                  <div class="col-md-4">
                                    <input id="status_toggle" type="checkbox"   name="two_factor_auth" data-toggle="toggle" data-width="100" data-on="Enabled" data-size="sm" data-off="Disabled" data-onstyle="success" data-offstyle="danger"  {{ setting('2fa')? 'checked':'unchecked' }}>
                                  </div>
              									</div>
                                <div class="form-group row mb-4">
                                  <div class="col-md-8">
                                    <strong class="d-block">Captcha</strong>
                                    {{!setting('captcha')? 'Activate': 'Deactivate'}} Re-Captcha for application.
                                  </div>
                                  <div class="col-md-4">
                                    <input id="status_toggle" type="checkbox"   name="captcha" data-toggle="toggle" data-width="100" data-on="Enabled" data-size="sm" data-off="Disabled" data-onstyle="success" data-offstyle="danger"  {{ setting('captcha')? 'checked':'unchecked' }}>
                                  </div>
              									</div>
                                <div class="form-group row">
                                  <div class="col-md-8">
                                    <strong class="d-block">Email Verification</strong>
                                    {{!setting('email_verification')? 'Activate': 'Deactivate'}} Email verification for application.
                                  </div>
                                  <div class="col-md-4">
                                    <input id="status_toggle" type="checkbox"   name="email_verification" data-toggle="toggle" data-width="100" data-on="Enabled" data-size="sm" data-off="Disabled" data-onstyle="success" data-offstyle="danger"  {{ setting('email_verification')? 'checked':'unchecked' }}>
                                  </div>
                                </div>
                              </div>
                              <input type="submit"  class="form-control mt-2 btn btn-success" value="Update Authentication Settings">
                          </form>
                    </div>

                    <div class="tab-pane fade p-0" id="app-backup" role="tabpanel" aria-labelledby="app-backup-tab">
                    <div class="row p-0 m-0">
                      <div class="col-md-12">
                        <h4>Application Backup History</h4>
                        <div class="table-responsive">
                        <table class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th>Filename</th>
                              <th>Size</th>
                              <th>Time</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(count($backups) > 0)
                                @foreach($backups as $backup)
                                <tr>
                                  <td>{{$backup['filename']}}</td>
                                  <td>{{ByteConverter::bytesToHuman($backup['size'])}}</td>
                                  <td>{{date('Y-m-d H:i',$backup['time'])}}</td>
                                  <td>
                                      <div class="d-inline-block">
                                        <form action="{{route('admin.backup-download',['name'=> $backup['filename'],'ext'=>$backup['extension']])}}" method="post">
                                          @csrf
                                          <button class="btn btn-info btn-sm"><i class="fa fa-download"></i></button>
                                        </form>
                                      </div>
                                      <div class="d-inline-block">
                                        <form action="{{route('admin.backup-delete',['name'=> $backup['filename'],'ext'=>$backup['extension']])}}" method="post">
                                          @csrf
                                          <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                      </div>
                                  </td>
                                </tr>
                                @endforeach
                            @else
                              <tr>
                                <td></td>
                                <td></td>
                                <td><i><h5>No backup found</h5></i></td>
                                <td></td>
                                <td></td>
                              </tr>
                            @endif
                          </tbody>
                        </table>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <form action="{{route('admin.backup-files')}}" method="POST">
                                  @csrf
                                  <input type="submit"  class="form-control mt-2 btn btn-success" value="Backup File">
                            </form>
                          </div>
                          <div class="col-md-6">
                            <form action="{{route('admin.backup-db')}}" method="POST">
                                  @csrf
                                  <input type="submit"  class="form-control mt-2 btn btn-success" value="Backup Database">
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
            </div>
          </div>
    </section>
    <!-- Main content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
