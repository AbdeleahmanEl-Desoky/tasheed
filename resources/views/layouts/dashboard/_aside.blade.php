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

            <!-- Home Caver -->
            <li><a href="{{ route('dashboard.home.index') }}"><i class="fa fa-th"></i><span>Home Cover</span></a></li>

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
                        <li><a href="{{ route('dashboard.about.vision.index') }}"><i class="fa fa-circle-o"></i> Vision</a></li>
                        <li><a href="{{ route('dashboard.about.mission.index') }}"><i class="fa fa-circle-o"></i> Mission</a></li>
                    </li>
                </ul>
            </li>

            <!-- Blogs Menu Item -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i><span>Blog</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('dashboard.blog.caver') }}"><i class="fa fa-th"></i><span>Blog Cover</span></a></li>
                    <li><a href="{{ route('dashboard.blog.index') }}"><i class="fa fa-th"></i><span>Blogs</span></a></li>
                </ul>
            </li>

            <li><a href="{{ route('dashboard.contact.index') }}"><i class="fa fa-th"></i><span>Contact Us</span></a></li>

            <!-- Project Dropdown -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i><span>Project</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <li><a href="{{ route('dashboard.project.index') }}"><i class="fa fa-circle-o"></i>Project Cover</a></li>
                        <li><a href="{{ route('dashboard.project.features.index') }}"><i class="fa fa-circle-o"></i>Project Features</a></li>
                        <li><a href="{{ route('dashboard.project.feature_unit.index') }}"><i class="fa fa-circle-o"></i>Project Features Unit</a></li>
                        <li><a href="{{ route('dashboard.project.single.index') }}"><i class="fa fa-circle-o"></i>Project</a></li>
                    </li>
                </ul>
            </li>

            <!-- Team Dropdown -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i><span>Team</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <li><a href="{{ route('dashboard.meet_team.index') }}"><i class="fa fa-circle-o"></i>Team Cover</a></li>
                        <li><a href="{{ route('dashboard.meet_team.team.index') }}"><i class="fa fa-circle-o"></i>Team</a></li>
                    </li>
                </ul>
            </li>

            <!-- career Dropdown -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i><span>Career</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <li><a href="{{ route('dashboard.career.cover') }}"><i class="fa fa-circle-o"></i>Career Cover</a></li>
                        <li><a href="{{ route('dashboard.career.index') }}"><i class="fa fa-circle-o"></i>career</a></li>
                        <li><a href="{{ route('dashboard.job.index') }}"><i class="fa fa-circle-o"></i>job</a></li>
                    </li>
                </ul>
            </li>

            <!-- Message Dropdown -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i><span>Message</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <li><a href="{{ route('dashboard.message') }}"><i class="fa fa-circle-o"></i>Message</a></li>
                        <li><a href="{{ route('dashboard.apply_job') }}"><i class="fa fa-circle-o"></i>Apply Job</a></li>
                        <li><a href="{{ route('dashboard.emils') }}"><i class="fa fa-circle-o"></i>Emils</a></li>
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
