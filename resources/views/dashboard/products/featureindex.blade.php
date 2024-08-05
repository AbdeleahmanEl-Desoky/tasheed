@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>خصائص المادة</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
            </ol>
        </section>




        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
               



                
                </div><!-- end of box header -->

                <div class="box-body">
                
                <div class="col-md-4">
                        <a href="{{ route('dashboard.productc',$product->id) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                </div>
                
                    @if ($features->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>

                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($features as $index=>$feature)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $feature->feature }}</td>
                                    <td>
                                            <a href="{{ route('dashboard.productedit', $feature->id) }}" class="btn btn-info btn-facebook"><i class="fa fa-edit"></i>تعديل</a>

                                            <form action="{{ route('dashboard.productdestroy', $feature->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
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
