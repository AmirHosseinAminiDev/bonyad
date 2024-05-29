<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g"
                         class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->fullName() }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                کاربران
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('requests.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-arrow-circle-down"></i>
                            <p>
                                درخواست ها
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('teachers.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-clipboard"></i>
                            <p>
                                اساتید
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('universities.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-university"></i>
                            <p>
                                دانشگاه ها
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('classes.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-book"></i>
                            <p>
                                کلاس ها
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
