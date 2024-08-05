<div id="print-area">
    <table class="table table-hover table-bordered">

        <thead>
        <tr>
            <th>@lang('site.name')</th>
            <th>@lang('site.quantity')</th>
            <th>@lang('site.price')</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ number_format($product->pivot->quantity * $product->sale_price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3>@lang('site.total') <span>{{ number_format($order->total_price, 2) }}</span></h3>

</div>

<button class="btn  btn-block btn-primary" onclick="printPdf('{{ route('dashboard.orders.printproducts', $order->id) }}')"><i class="fa fa-print"></i> طباعة </button>
{{--<button class="btn btn-block btn-primary " on-click="printPdf('{{ route('orders.printproducts', $order->id) }}')" ><i class="fa fa-print"></i> @lang('site.print')</button>--}}



