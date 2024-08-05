@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>التقرير</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">التقرير</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">



                    <form action="{{ route('dashboard.report') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="date" name="date1"  class="form-control" style="speak-date: ymd" placeholder="@lang('site.search')"
                                       value="{{ request()->date1 }}">
                            </div>

                            <div class="col-md-4">
                                <input type="date" name="date2"  style="speak-date: ymd"class="form-control" placeholder="@lang('site.search')"
                                       value="{{request()->date2 }}">
                            </div>


                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @isset(request()->date1)
                                @isset(request()->date2)

                                <a href="{{ route('dashboard.report-products',[request()->date1 ,request()->date2]) }}" class="btn btn-primary"><i></i>تقرير بالمادة</a>
                                @endisset
                                @endisset
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">




                        <table class="table table-light">
                            <tr>
                                <td>قيمة الطلبات المفتوحة  </td>
                                @if(request()->date2 == null || request()->date1 == null)
                                <td>{{$report_aa}}  ILS</td>
                                @else
                                    <td>{{$report_a}} ILS</td>
                                @endif
                            </tr>
                            <tr>
                                    <td>قيمة الطلبات المغلقة </td>
                                @if(request()->date2 == null || request()->date1 == null)
                                    <td>{{$report_dd}} ILS</td>
                                @else
                                    <td>{{$report_d}}  ILS</td>
                                @endif
                            </tr>
                            <tr>
                                <th>قيمة اجمالي الطلبات</th>

                                @if(request()->date2 == null || request()->date1 == null)
                                    <th>{{ $report_aa + $report_dd}}  ILS</th>
                                @else
                                    <th>{{ $report_a + $report_d}}  ILS</th>
                                @endif
                            </tr>
                            <tr>
                                <th>عدد  الطلبات</th>

                                @if(request()->date2 == null || request()->date1 == null)
                                    <th>{{ $count_order_a}}  </th>
                                @else
                                    <th>{{ $count_order}}  </th>
                                @endif
                            </tr>
                        </table><!-- end of table -->

                    @if(request()->date2 == null || request()->date1 == null)
                    <table class="table table-striped">
                        <tr>
                            <th>اسم الطلب</th>
                            <th>الطابق</th>
                            <th>@lang('site.price')</th>
                            <th>@lang('site.created_at')</th>
                        </tr>

                        @foreach ($orders  as $order)

                            <tr>
                                <td><a href="{{route('dashboard.report-client_id',$order->client->id)}}">{{ $order->client->name }}</td>
                                 @if($order->client->floor == 1)
                                <th>الطابق الاول</th>
                                @elseif ($order->client->floor == 2)
                                <th>الطابق الثاني</th>
                                @else
                                <th> </th>
                                @endif
                                <td>{{ number_format($order->total_price, 2) }} ILS</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>

                        @endforeach



                    </table><!-- end of table -->
                    {{ $orders->appends(request()->query())->links() }}
                    @endif
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
