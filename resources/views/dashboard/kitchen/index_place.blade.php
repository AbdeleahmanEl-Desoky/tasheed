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


                                        <th>@lang('site.created_at')</th>
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
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>


                                                <form action="{{ route('dashboard.kitchen-done', $order->client->id) }}" method="post" style="display: inline-block;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('GEt') }}
                                                    <button type="submit" class="tn btn-dropbox btn-dark"><i class="fa fa-clone"></i>  عرض الطلبات  </button>
                                                </form>











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

