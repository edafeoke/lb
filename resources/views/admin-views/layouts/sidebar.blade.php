<nav class="main-header navbar navbar-expand navbar-{{setting('app_theme')}}">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link desktop-toggle" id="toggleClose" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        <a class="nav-link mobile-toggle" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    @role('admin')
    <!-- SEARCH FORM -->
    <div class="d-none d-md-block d-lg-block d-xl-block">
    <form method="GET" action="{{url('admin/user')}}" class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" name="search" placeholder="Search users" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    </div>
    @endrole

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @impersonating
      <li class="nav-item">
        <a class="nav-link text-danger btn btn-none btn-outline-primary" href="{{ route('admin.impersonate.leave') }}">
          <p><i class="fa fa-ban mr-2" aria-hidden="true"></i>{{'Exit Impersonation'}}</p>
        </a>
      </li>
      @endImpersonating
      <!-- User Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="{{Auth::user()->avatar?Auth::user()->avatar:asset('uploads/avatar/avatar.png')}}" width="28px" class="img img-circle  img-responsive" alt="User Image">
          {{auth()->user()->firstname}}
          <i class="fa fa-angle-down right"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{url('admin/profile')}}" class="dropdown-item">
            <i class="fa fa-user mr-2"></i> Profile
          </a>

          <a href="{{url('admin/activity-log')}}" class="dropdown-item">
            <i class="fa fa-list mr-2"></i> Activity Log
          </a>

          @role('admin')
          <a href="{{url('admin/settings')}}" class="dropdown-item">
            <i class="fa fa-gear mr-2"></i> Application Settings
          </a>
          @endrole

          <div class="dropdown-divider"></div>
          <a href="{{url('admin/logout')}}" class="dropdown-item dropdown-footer bg-gray"><i class="fa fa-sign-out mr-2"></i> Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-{{setting('app_sidebar')}}-light elevation-4">
    <!-- Brand Logo -->
    <div class="navbar-brand d-flex justify-content-center">
      <a style="display:none;" class="nav-link  toggleopen"  data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      <a href="/" class="app-logo brand-link">
        @if(setting('app_dark_logo')||setting('app_light_logo'))
          <img src="{{(setting('app_sidebar')=='light')? asset('uploads/appLogo/app-logo-dark.png'):asset('uploads/appLogo/app-logo-light.png')}}" alt="App Logo" class=" img brand-image img-responsive" style="opacity: .8;">

        @else
          <img src="{{(setting('app_sidebar')=='light')? asset('uploads/appLogo/logo-dark.png'):asset('uploads/appLogo/logo-light.png')}}" alt="App Logo" class="img brand-image img-responsive" style="opacity: .8;">

        @endif
      </a>

    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="{{url('admin/profile')}}"><img src="{{Auth::user()->avatar?Auth::user()->avatar:asset('uploads/avatar/avatar.png')}}" width="40px" class="img img-circle  img-responsive" alt="User Image"></a>
        </div>
        <div class="info">
          <a href="{{url('admin/profile')}}" class="d-block">{{Auth::user()->firstname}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('admin/')}}" class="nav-link {{request()->is('admin/')? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @can('manage-user')
          <li class="nav-item has-treeview">
            <a href="{{url('admin/user')}}" class="nav-link {{request()->is('user*')? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-users"></i>
              <p>
              Users
              </p>
            </a>
          </li>
          @endcan

          @role('admin')
          <li class="nav-item">
            <a href="{{url('admin/activity-log')}}" class="nav-link {{request()->is('activity-log*')? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Activity Log
              </p>
            </a>
          </li>
          @endrole

          @can('manage-account')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{(request()->is('admin/accounts*')||request()->is('admin/user/create'))? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Accounts
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/accounts')}}" class="nav-link {{request()->is('admin/accounts')? 'sidebar-active':''}}">
                  <i class="fa fa nav-icon"></i>
                  <p>View Accounts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.user.create')}}" class="nav-link {{request()->is('admin/user/create')? 'sidebar-active':''}}">
                  <i class="fa fa nav-icon"></i>
                  <p>Create Account</p>
                </a>
              </li>
            </ul>
          </li>
                    <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{(request()->is('admin/credit/account*')||request()->is('admin/debit/account'))? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-credit-card"></i>
              <p>
                Credit/Debit Account
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/credit/account')}}" class="nav-link {{request()->is('admin/credit/account')? 'sidebar-active':''}}">
                  <i class="fa fa nav-icon"></i>
                  <p>Credit Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/debit/account')}}" class="nav-link {{request()->is('admin/debit/account')? 'sidebar-active':''}}">
                  <i class="fa fa nav-icon"></i>
                  <p>Debit Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/history/account')}}" class="nav-link {{request()->is('admin/history/account')? 'sidebar-active':''}}">
                  <i class="fa fa nav-icon"></i>
                  <p>History</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/loan')}}" class="nav-link {{request()->is('admin/loan')? 'sidebar-active':''}}">
                <i class="fa fa-credit-card nav-icon"></i>
                <p>Manage Loans</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/check-deposit')}}" class="nav-link {{request()->is('admin/check-deposit')? 'sidebar-active':''}}">
                <i class="fa fa-credit-card nav-icon"></i>
                <p>Manage Check Deposit</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/card')}}" class="nav-link {{request()->is('admin/card')? 'sidebar-active':''}}">
                <i class="fa fa-credit-card nav-icon"></i>
                <p>Manage Cards</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/transfers')}}" class="nav-link {{request()->is('admin/transfers')? 'sidebar-active':''}}">
                <i class="fa fa-credit-card nav-icon"></i>
                <p>Transfer History</p>
            </a>
          </li>
          @endcan

          @role('admin')
          <li class="nav-item">
            <a href="{{url('admin/settings')}}" class="nav-link {{request()->is('admin/settings')? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-gear"></i>
              <p>
                Application Settings
              </p>
            </a>
          </li>
          @endrole
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
