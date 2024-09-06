@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.About')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.about')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">


                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.about.vision.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                            <input type="hidden" name="id" class="form-control" value="{{ $vision?->id }}">

                        <div class="form-group col-md-6">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ $vision?->title }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.sub_description')</label>
                            <input type="text" name="sub_description" class="form-control" value="{{ $vision?->sub_description }}">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="ex1"> Description</label>
                            <textarea class="form-control ckeditor" id="ex1"
                                      name="description" rows="3">{{$vision?->description}}</textarea>

                        </div>


                        <div class="form-group col-md-6">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.image')</label>
                            <input type="file" name="file" class="form-control image">
                        </div>

                        <hr>
                        <div class="form-group col-md-12">
                            @foreach ($vision->media as $media)
                            <img src="{{  $media->original_url  }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                            @endforeach
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
