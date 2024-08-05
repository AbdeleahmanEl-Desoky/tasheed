@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>المطبخ</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">المطبخ</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">طلبات <small></small></h3>


                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($products->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>المادة</th>
                                <th>خصائص المادة</th>
                                <th>الكمية</th>
                                <th>ملاحظات</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($clients as $index=>$product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->features}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->note}}</td>
                                    <td>
                                            <form action="{{route('dashboard.kitchen-finsh',[$product->id,$product->client_id] )}}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('post') }}
                                                <button type="submit" class="btn btn-github  btn-sm"><i class="fa fa-clock-o"></i> تم التنفيذ</button>
                                            </form><!-- end of form -->
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->



                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
