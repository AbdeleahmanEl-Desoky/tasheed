@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.messages')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.Emils')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.home') <small>{{ $messages->total() }}</small></h3>

                    <form action="{{ route('dashboard.message') }}" method="get">

                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>
                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($messages->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <td>@lang('site.email')</td>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($messages as $index=>$message)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $message->email }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $messages->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->


    </div><!-- end of content wrapper -->

@endsection
