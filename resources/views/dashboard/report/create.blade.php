@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products') <small></small></h3>



                </div><!-- end of box header -->

                <div class="box-body">


                    <table class="table table-striped">
                        <tr>

                            <th>المنتج</th>
                            <th>الكميه</th>

                        </tr>

                        @foreach ($products  as $product)

                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{$product->quantity  }}</td>

                            </tr>

                        @endforeach



                    </table><!-- end of table -->



                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
