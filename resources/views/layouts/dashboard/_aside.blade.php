<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/logo.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>

            @if (auth()->user()->hasPermission('categories-read'))
                <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-th"></i><span>@lang('site.categories')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('products-read'))
                <li><a href="{{ route('dashboard.products.index') }}"><i class="fa fa-th"></i><span>@lang('site.products')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('add_orders-read'))
                <li><a href="{{ route('dashboard.type') }}"><i class="fa fa-th"></i><span>اضافة طلب </span></a></li>
            @endif

            @if (auth()->user()->hasPermission('orders-read'))
                <li><a href="{{ route('dashboard.orders.index') }}"><i class="fa fa-th"></i><span>@lang('site.orders')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('users-read'))
                <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-th"></i><span>@lang('site.users')</span></a></li>
            @endif


            @if (auth()->user()->hasPermission('kitchen-read'))
            <li><a href="{{ route('dashboard.kitchen_table') }}"><i class="fa fa-th"></i><span>مطبخ</span></a></li>
            @endif


        </ul>


    </section>

</aside>

