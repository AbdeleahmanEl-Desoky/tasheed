@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.jobs')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.job.index') }}"> @lang('site.jobs')</a></li>
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

                    <form action="{{ route('dashboard.job.update', $job->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group col-md-6">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ $job->title }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.description')</label>
                            <textarea type="text" name="description" class="form-control ckeditor">{{ $job->description }}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.location')</label>
                            <input type="text" name="location" class="form-control" value="{{ $job->location }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.job_type')</label>
                            <input type="text" name="job_type" class="form-control" value="{{ $job->job_type }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.salary')</label>
                            <input type="text" name="salary" class="form-control" value="{{ $job->salary }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.responsibilities')</label>
                            <textarea type="text" name="responsibilities" class="form-control ckeditor" >{{ $job->responsibilities }}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.job_type')</label>
                            <select name="career_id" class="form-control">
                                <option value="">@lang('site.select_career')</option>
                                @foreach($careers as $career)
                                    <option value="{{ $career->id }}" {{ $job->career_id == $career->id ? 'selected' : '' }}>
                                        {{ $career->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->




@endsection
