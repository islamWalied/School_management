<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <?php $type =  \Illuminate\Support\Facades\Auth::user()->user_type?>

        <li class="nav-item">
            <a href="{{route($type .'.dashboard')}}" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        @if($type == 'admin')
            <li class="nav-item">
                <a href="{{route('dashboard.list')}}" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                        Admin List
                    </p>
                </a>
            </li>
        @endif


        <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
