@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.features')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.meet_team.team.index') }}"> @lang('site.features')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.meet_team.team.update', $team->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group col-md-6">
                            <label>@lang('site.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $team->name) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.job_name')</label>
                            <input type="text" name="job_name" class="form-control" value="{{ old('job_name', $team->job_name) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.job_rank')</label>
                            <input type="text" name="job_rank" class="form-control" value="{{ old('job_rank', $team->job_rank) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.image')</label>
                            <input type="file" name="file" class="form-control image">
                        </div>

                        <div class="form-group col-md-3">
                            <!-- Hidden input to ensure value 0 is sent if unchecked -->
                            <input type="hidden" name="in_page" value="0">
                            <label>in Page </label>
                            <input type="checkbox" name="in_page" value="1" {{ old('in_page', $team->in_page) ? 'checked' : '' }}>
                        </div>

                        <div class="form-group col-md-6">
                            <img src="{{ $team->getFirstMediaUrl('team', 'thumb') ?? asset('uploads/user_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> @lang('site.save')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
