@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>الطاولات</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">الطاولات</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <!--button type="button" style="width: 100px ; height: 50px" class="btn btn-danger"></button-->
<h1> الطابق الاول </h1>
                @foreach($clients  as $client )
                    @if ($client->is_active == 1 && $client->floor==1)
                        <a href="{{ route('dashboard.place.edit', $client->id) }}" style="width: 100px ; height: 50px" class="btn btn-danger">{{$client->name}}</a>
                    @elseif ($client->is_active == 0 && $client->floor==1)
                        <a href="{{ route('dashboard.clients.orders.create', $client->id) }}" style="width: 100px ; height: 50px" class="btn btn-primary">{{$client->name}}</a>
                    @endif
                @endforeach
            </div>
            <div class="row">
                <a> </a>

                <h1>الطابق الثاني</h1>
            </div>
                <div class="row">
                @foreach($clients  as $client )
                @if ($client->is_active == 1 && $client->floor==2)
                    <a href="{{ route('dashboard.place.edit', $client->id) }}" style="width: 100px ; height: 50px" class="btn btn-danger">{{$client->name}}</a>
                @elseif ($client->is_active == 0 && $client->floor==2)
                    <a href="{{ route('dashboard.clients.orders.create', $client->id) }}" style="width: 100px ; height: 50px" class="btn btn-primary">{{$client->name}}</a>
                @endif
            @endforeach


            </div><!-- end of row -->
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
