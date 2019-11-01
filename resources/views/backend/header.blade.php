<header class="main-header">
        <!-- Logo -->
        <a href="{{URL::to('viewcusaccount')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>M</b>C</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Motor</b>Cong</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{Auth::User()->fullname}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                    <p>
                      {{Auth::User()->name}}
                      {{-- <small>Member since Nov. 2012</small> --}}
                    </p>
                  </li>

                  <li class="user-footer">
                    <div class="pull-right">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" style="padding: 0;"><a  class="btn btn-default btn-flat">Sign out</a></button>
                        </form>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
