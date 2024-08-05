@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.orders')
                <small>{{ $orders->total() }} @lang('site.orders')</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.orders')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.orders')</h3>

                            <form action="{{ route('dashboard.orders.index') }}" method="get">

                                <div class="row">

                                    <div class="col-md-8">
                                        <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                    </div>

                                </div><!-- end of row -->

                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                        @if ($orders->count() > 0)

                            <div class="box-body table-responsive">

                                <table class="table table-hover">
                                    <tr>
                                        <th>@lang('site.client_name')</th>
                                        <th>الطابق</th>
                                        <th>@lang('site.price')</th>
{{--                                        <th>@lang('site.status')</th>--}}

                                        <th>@lang('site.action')</th>
                                    </tr>

                                    @foreach ($orders as $order)

                                        <tr>
                                            <td>{{ $order->client->name }}</td>
                                            @if($order->client->floor == '1')
                                            <td>الطابق الاول</td>
                                            @elseif($order->client->floor =='2')
                                              <td>الطابق الثاني</td>
                                              @else
                                              <td>__ </td>
                                              @endif
                                            <td>{{ number_format($order->total_price, 2) }}</td>
                                          
                                            <td>
                                                <button class="btn btn-primary btn-sm order-products"
                                                        data-url="{{ route('dashboard.orders.products', $order->id) }}"
                                                        data-method="get">
                                                    <i class="fa fa-list"></i>
                                                    @lang('site.show')
                                                </button>
                                                <a href="{{ route('dashboard.clients.orders.add', ['client' => $order->client->id, 'order' => $order->id]) }}" class="btn btn-yahoo btn-sm"><i class="fa "></i> اضافة طلب</a>

                                                @if (auth()->user()->hasPermission('orders-update'))
                                                    <a href="{{ route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> @lang('site.edit')</a>
                                                @else
                                                    <a href="#" disabled class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                                @endif

                                                @if (auth()->user()->hasPermission('orders-update'))
                                                <form action="{{ route('dashboard.clients.total.update', ['client' => $order->client->id, 'total' => $order->id]) }}" method="post" style="display: inline-block;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                    <button onclick="return confirm('هل تريد غلق الحســـــاب?');"   type="submit" class="tn btn-dropbox btn-dark "><i class="fa fa-archive"></i> غلق الحساب</button>
                                                </form>
                                              @endif

                                            @if (auth()->user()->hasPermission('orders-delete'))
                                                    <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post" style="display: inline-block;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                                    </form>
                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> @lang('site.delete')</a>
                                                @endif
                                                    <a  href="{{ route('dashboard.kitchen-notdone',  $order->client->id) }}"  class="btn btn-github btn-box-tool create">
                                                        <i class="fa fa-bitbucket-square "></i>  تتبع الطلب</a>
                                                        

                                            </td>

                                        </tr>

                                    @endforeach

                                </table><!-- end of table -->

                                {{ $orders->appends(request()->query())->links() }}

                            </div>

                        @else

                            <div class="box-body">
                                <h3>@lang('site.no_records')</h3>
                            </div>

                        @endif

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.show_products')</h3>
                        </div><!-- end of box header -->

                        <div class="box-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">@lang('site.loading')</p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content section -->

    </div><!-- end of content wrapper -->

@endsection

@section('scripts')
    <script>
    function printPdf(link) {
        {{--let pdf =--}}
        {{--    '{{ route('dashboard.orders.printproducts', ['id' => ':id']) }}';--}}
        {{--pdf = pdf.replace(':id', link);--}}
    var iframe = document.createElement('iframe');
    iframe.style.display = "none";
    // iframe.style.dir = "rtl";
    iframe.src = link;
    document.body.appendChild(iframe);
    iframe.contentWindow.focus();
    iframe.contentWindow.print();
    }

    </script>
    @endsection

