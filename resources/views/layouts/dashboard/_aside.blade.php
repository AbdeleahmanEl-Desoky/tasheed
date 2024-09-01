<aside class="main-sidebar">
    <section class="sidebar">

        <!-- User Panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/logo.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

            <!-- About Dropdown -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i><span>About</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <!-- Nested Benefits and Galleries -->
                    <li class="treeview">
                        <li><a href="{{ route('dashboard.about.index') }}"><i class="fa fa-circle-o"></i> About</a></li>
                        <li><a href="{{ route('dashboard.about.benefits.index') }}"><i class="fa fa-circle-o"></i> Benefits</a></li>
                        <li><a href="{{ route('dashboard.about.galleries.index') }}"><i class="fa fa-circle-o"></i> Galleries</a></li>
                    </li>
                </ul>
            </li>

            <!-- Blogs Menu Item -->
            <li><a href="{{ route('dashboard.blog.index') }}"><i class="fa fa-th"></i><span>Blogs</span></a></li>

            <li><a href="{{ route('dashboard.home.index') }}"><i class="fa fa-th"></i><span>Home Caver</span></a></li>

                  <!-- Project Dropdown -->
                  <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i><span>Project</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <!-- Nested Benefits and Galleries -->
                        <li class="treeview">
                            <li><a href="{{ route('dashboard.project.index') }}"><i class="fa fa-circle-o"></i>Project Caver</a></li>
                            <li><a href="{{ route('dashboard.project.features.index') }}"><i class="fa fa-circle-o"></i>Project Features</a></li>
                            <li><a href="{{ route('dashboard.project.feature_unit.index') }}"><i class="fa fa-circle-o"></i>Project Features Unit</a></li>
                            <li><a href="{{ route('dashboard.project.single.index') }}"><i class="fa fa-circle-o"></i>Project Single</a></li>
                        </li>
                    </ul>
                </li>
            <!-- Users Menu Item -->
            @if (auth()->user()->hasPermission('users-read'))
                <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-th"></i><span>@lang('site.users')</span></a></li>
            @endif
        </ul>

    </section>
</aside>
