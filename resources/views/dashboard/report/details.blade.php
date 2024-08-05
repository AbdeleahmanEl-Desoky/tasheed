@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
                <li class="active">التقرير</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">اعلي المنتاجات مبيعات</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')



                    <table class="table table-striped">
                        <tr>

                            <th>المنتج</th>
                            <th>الكميه</th>
                            <th>السعر القطعة</th>
                            <th>اجمالي السعر</th>
                        </tr>

                        @foreach ($worker_get  as $order)

                            <tr>
                                <td>{{ $order->product_name }}</td>
                                <td>{{$order->quantity  }}</td>
                                <td>{{ number_format($order->sale_price, 2) }}</td>
                                <td>{{ number_format(($order->sale_price*$order->quantity),2) }}</td>
                            </tr>

                        @endforeach



                    </table><!-- end of table -->




                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
