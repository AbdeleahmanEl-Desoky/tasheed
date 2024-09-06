@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h1>@lang('site.edit')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.blog.index') }}"> @lang('site.blogs')</a></li>
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

                <form action="{{ route('dashboard.blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.description')</label>
                            <input type="text" name="description" class="form-control" value="{{ $blog->description }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.3d')</label>
                            <input type="file" name="blog" class="form-control gallery-input" accept=".jpg, .jpeg, .png, .mp4">

                            <!-- Display existing blog image -->
                            @if ($blog->getFirstMediaUrl('blog'))
                                <div class="mt-2">
                                    <img src="{{ $blog->getFirstMediaUrl('blog') }}" alt="Blog Image" class="img-thumbnail" width="150">
                                </div>
                            @endif
                        </div>

                        <!-- Existing Blog Descriptions Section -->
                        @foreach ($blogDescriptions as $index => $description)
                            <div class="form-group col-md-12">
                                <input type="hidden" name="description_ids[]" value="{{ $description->id }}">
                                <label>@lang('Blog Description')</label>
                                <textarea class="form-control" name="blog_description[]" rows="3">{{ $description->description }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label>@lang('site.blog_description_file')</label>
                                <input type="file" name="blog_description_file[]" class="form-control" accept=".jpg, .jpeg, .png, .pdf">

                                <!-- Display existing description image -->
                                @if ($description->getFirstMediaUrl('blog_descriptions'))
                                    <div class="mt-2">
                                        <img src="{{ $description->getFirstMediaUrl('blog_descriptions') }}" alt="Description Image" class="img-thumbnail" width="150">
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <!-- Add New Blog Descriptions Section -->
                        <div id="new-room-inputs"></div>

                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-success mt-2" id="add_blog_description"><i class="fa fa-plus"></i> @lang('site.add_blog_description')</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to add new blog description inputs
        function addBlogDescriptionInputs() {
            const roomInputs = document.getElementById('new-room-inputs');

            // Create blog description textarea
            const descriptionDiv = document.createElement('div');
            descriptionDiv.className = 'form-group col-md-12 mt-2';
            const descriptionLabel = document.createElement('label');
            descriptionLabel.innerText = '{{ __("site.blog_description") }}';
            const descriptionInput = document.createElement('textarea');
            descriptionInput.name = 'blog_description[]';
            descriptionInput.className = 'form-control';
            descriptionInput.rows = 3;
            descriptionDiv.appendChild(descriptionLabel);
            descriptionDiv.appendChild(descriptionInput);

            // Create file input for blog description
            const fileDiv = document.createElement('div');
            fileDiv.className = 'form-group col-md-12 mt-2';
            const fileLabel = document.createElement('label');
            fileLabel.innerText = '{{ __("site.blog_description_file") }}';
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'blog_description_file[]';
            fileInput.className = 'form-control';
            fileInput.accept = '.jpg, .jpeg, .png, .pdf';
            fileDiv.appendChild(fileLabel);
            fileDiv.appendChild(fileInput);

            // Append new inputs to the container
            roomInputs.appendChild(descriptionDiv);
            roomInputs.appendChild(fileDiv);
        }

        // Add new blog description event
        document.getElementById('add_blog_description').addEventListener('click', function () {
            addBlogDescriptionInputs();
        });
    });
</script>
@endpush
