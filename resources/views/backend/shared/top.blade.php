<header class="main-header">
    <!-- Logo -->
    <a href="{!! url('/admin') !!}" class="logo"><b>Student</b>jibe</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">



                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ gratavarUrl(Auth::user()->email) }}" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span> </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ gratavarUrl(Auth::user()->email) }}" class="img-circle" alt="User Image"/>

                            <p>
                            <p> {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} - Web Developer
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">

                            </div>
                            <div class="col-xs-4 text-center">

                            </div>
                            <div class="col-xs-4 text-center">

                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('/admin/user/' . Auth::user()->id) }}" class="btn btn-default btn-flat"><i class="fa fa-globe"></i> Public</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a></div>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>