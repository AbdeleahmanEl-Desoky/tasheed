@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>اضافة طلب</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                {{-- categories--}}
                    <div class="col-lg-3 col-xs-6" >
                        <div class="small-box bg-aqua" >
                            <div   class="inner">
                                <h3> <a href="{{ route('dashboard.place.index') }}" style="color: white"> قاعة المطعم</a></h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('dashboard.place.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                {{--products--}}
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><a href=" {{ route('dashboard.clients.orders.create' , '100') }}" style="color: white"> تيك اوي </a></h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href=" {{ route('dashboard.clients.orders.create' , '100') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                {{--clients--}}x
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><a href = "{{ route('dashboard.clients.index')}}"style="color: white">توصيل خارج</a></h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <a href = "{{ route('dashboard.clients.index')}}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
            </div><!-- end of row -->
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
