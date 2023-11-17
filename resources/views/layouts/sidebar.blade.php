<nav class="main-header navbar navbar-expand navbar-{{setting('app_theme')}}">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link desktop-toggle" id="toggleClose" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        <a class="nav-link mobile-toggle" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

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
          {{auth()->user()->fullname}}
          <i class="fa fa-angle-down right"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{url('/account/profile')}}" class="dropdown-item">
            <i class="fa fa-user mr-2"></i> Profile
          </a>

          <div class="dropdown-divider"></div>
          <a href="{{url('account/logout')}}" class="dropdown-item dropdown-footer bg-gray"><i class="fa fa-sign-out mr-2"></i> Logout</a>
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
          <a href="{{url('/account/profile')}}"><img src="{{Auth::user()->avatar?Auth::user()->avatar:asset('uploads/avatar/avatar.png')}}" width="40px" class="img img-circle  img-responsive" alt="User Image"></a>
        </div>
        <div class="info">
          <a href="{{url('/account/profile')}}" class="d-block">{{Auth::user()->firstname}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('/account')}}" class="nav-link {{request()->is('/')? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{(request()->is('account/transfers')||request()->is('account/make-transfer/*'))? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-send"></i>
              <p>
                Transfer
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('account/make-transfer/intra-bank')}}" class="nav-link {{request()->is('account/make-transfer/intra-bank')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa"></i>
                    <p>
                        Intra-Bank Transfer
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('account/make-transfer/inter-bank')}}" class="nav-link {{request()->is('account/make-transfer/inter-bank')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa"></i>
                    <p>
                        Inter-Bank Transfer
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('account/make-transfer/wire-transfer')}}" class="nav-link {{request()->is('account/make-transfer/wire-transfer')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa"></i>
                    <p>
                        Wire Transfer
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('account/transfers')}}" class="nav-link {{request()->is('account/transfers')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa"></i>
                    <p>
                        Transfer History
                    </p>
                    </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{(request()->is('account/card*'))? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-credit-card"></i>
              <p>
                Card
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('account/card')}}" class="nav-link {{request()->is('account/card')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa-hands"></i>
                    <p>
                        View Card
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('account/card/create')}}" class="nav-link {{request()->is('account/card/create')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa-hands"></i>
                    <p>
                       Apply for Card
                    </p>
                    </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{(request()->is('account/loan*'))? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-leaf"></i>
              <p>
                Loan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('account/loan')}}" class="nav-link {{request()->is('account/loan')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa-hands"></i>
                    <p>
                        View Loan Application
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('account/loan/create')}}" class="nav-link {{request()->is('account/loan/create')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa-hands"></i>
                    <p>
                       Apply for Loan
                    </p>
                    </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{(request()->is('account/check-deposit/create')||request()->is('account/check-deposit'))? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-download"></i>
              <p>
                Deposit
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('account/check-deposit/create')}}" class="nav-link {{request()->is('account/check-deposit/create')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa"></i>
                    <p>
                    Check Deposit
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('account/check-deposit')}}" class="nav-link {{request()->is('account/check-deposit')? 'sidebar-active':''}}">
                    <i class="nav-icon fa fa"></i>
                    <p>
                        Deposit History
                    </p>
                    </a>
                </li>
            </ul>
          </li>
         <li class="nav-item">
            <a href="{{url('account/transactions')}}" class="nav-link {{request()->is('account/transactions')? 'sidebar-active':''}}">
              <i class="nav-icon fa fa-exchange"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
