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

                <!--button type="button" style="width: 100px ; height: 50px" class="btn btn-danger"></button-->
                @foreach($placeOrder as $num)
                    @if ($num->is_active == 1)
                        <a href="{{ route('dashboard.place.create', $num->id) }}" style="width: 100px ; height: 50px" class="btn btn-danger">{{$num->name}}</a>

                    @elseif ($num->is_active == 0)
                        <a href="{{ route('dashboard.place.create', $num->id) }}" style="width: 100px ; height: 50px" class="btn btn-primary">{{$num->nme}}</a>

                    @endif
                @endforeach

            </div><!-- end of row -->
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
