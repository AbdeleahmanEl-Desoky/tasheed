@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.dashboard')</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                {{-- categories--}}
                @if (auth()->user()->hasPermission('categories-read'))
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><a href="{{ route('dashboard.categories.index') }}" style="color: white">{{ $categories_count }}</a></h3>

                            <p><a href="{{ route('dashboard.categories.index') }}" style="color: white">@lang('site.categories')</a></p>
                        </div>
                        <div class="icon">
                            <a href="{{ route('dashboard.categories.index') }}">   <i class="ion ion-bag"></i></a>
                        </div>
                        <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endif


                {{--products--}}
                @if (auth()->user()->hasPermission('products-read'))
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><a href="{{ route('dashboard.products.index') }}" style="color: white">{{ $products_count }}</a></h3>

                            <p><a href="{{ route('dashboard.products.index') }}" style="color: white">@lang('site.products')</a></p>
                        </div>
                        <div class="icon">
                            <a href="{{ route('dashboard.products.index') }}" style="color:green"><i class="ion ion-stats-bars"></i></a>
                        </div>
                        <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endif
                {{--clients--}}
                 @if (auth()->user()->hasPermission('orders-read'))
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><a href="{{ route('dashboard.orders.index') }}" style="color: white">{{ $order_day }}</a></h3>

                            <p><a href="{{ route('dashboard.orders.index') }}" style="color: white">طلبات</a></p>
                        </div>
                        <div class="icon">
                            <a href="{{ route('dashboard.orders.index') }}" style="color: firebrick"> <i class="fa fa-user"></i></a>
                        </div>
                        <a href="{{ route('dashboard.orders.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endif
                {{--users--}}
                @if (auth()->user()->hasPermission('users-read'))
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><a href="{{ route('dashboard.users.index') }}" style="color: white">{{ $users_count }}</a></h3>

                            <p><a href="{{ route('dashboard.users.index') }}" style="color: white">@lang('site.users')</a></p>
                        </div>
                        <div class="icon">
                            <a href="{{ route('dashboard.users.index') }}" style="color: white">    <i class="fa fa-users"></i></a>
                        </div>
                        <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endif

            </div><!-- end of row -->

     
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection





