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

                    <form action="{{ route('dashboard.about.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                            <input type="hidden" name="id" class="form-control" value="{{ $about?->id }}">

                        <div class="form-group col-md-12">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ $about?->title }}">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="ex1"> Description</label>
                            <textarea class="form-control ckeditor" id="ex1"
                                      name="description" rows="3">{{$about?->description}}</textarea>

                        </div>


                        <div class="form-group col-md-4">
                            <label>@lang('site.image')</label>
                            <input type="file" name="file" class="form-control image">
                        </div>

                        <div class="form-group form-group col-md-4">
                            <label>@lang('site.file_type')</label>
                            <select name="file_type" class="form-control" id="file_type">
                                <option value="image" {{ $about?->file_type == 'image' ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ $about?->file_type == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <img src="{{ asset('uploads/user_images/default.png') }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>
                        <hr>
                        <div class="form-group col-md-12">
                            @if($about?->file_type == 'video')
                                <video class="form-group col-md-6" controls style="width: 100px;">
                                    <source src="{{ $about?->media[0]->original_url }}" type="" class="img-thumbnail image-preview">
                                </video>
                            @else
                                <img src="{{  $about?->media[0]->original_url  }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                            @endif
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
