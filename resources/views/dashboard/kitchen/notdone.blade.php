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



                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>المادة</th>
                                <th>خصائص المادة</th>
                                <th>الكمية</th>
                                <th>ملاحظات</th>
                                <th>الحالة</th>
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
                                    <td>{{$product->id}}</td>
                                    @if ($product->is_finsh == 0)
                                    <td class="btn btn-danger">جاري التنفيذ</td>
                                    @elseif ($product->is_finsh == 1)
                                    <td class="btn btn-facebook"><a href="{{route('dashboard.finshorder',[$product->id,$product->client_id])}}" method="post"  style="color: white">تم الانتهاء</a> </td>
                                    @elseif ($product->is_finsh == 2)
                                    <td class="btn btn-default">تم التسليم </td>
                                    @endif
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->





                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
