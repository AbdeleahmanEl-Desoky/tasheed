@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.single')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.blog.index') }}"> @lang('site.single')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div><!-- end of box header -->

            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.blog.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.description')</label>
                            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.3d')</label>
                            <input type="file" name="blog" class="form-control gallery-input">
                        </div>
                        <!-- End Blog -->
                        <div id="room-inputs">
                            <div class="form-group col-md-12">
                                <label for="ex1">Blog Description</label>
                                <textarea class="form-control" id="ex1"
                                          name="blog_description[]" rows="3"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label>@lang('site.blog_description')</label>
                                <input type="file" name="blog_description_file[]" class="form-control">
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-success mt-2" id="add_blog_description"><i class="fa fa-plus"></i> @lang('site.add_blog_description')</button>
                        </div>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Add new inputs for blog description
        const addRoomButton = document.getElementById('add_blog_description');
        addRoomButton.addEventListener('click', function () {
            const roomInputs = document.getElementById('room-inputs');

            // Create description textarea
            const descriptionDiv = document.createElement('div');
            descriptionDiv.className = 'form-group col-md-12 mt-2';
            const descriptionLabel = document.createElement('label');
            descriptionLabel.innerText = '{{ __("Blog Description") }}';
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
            fileLabel.innerText = '{{ __("site.blog_description") }}';
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'blog_description_file[]';
            fileInput.className = 'form-control';
            fileDiv.appendChild(fileLabel);
            fileDiv.appendChild(fileInput);

            // Append the new inputs to the room inputs section
            roomInputs.appendChild(descriptionDiv);
            roomInputs.appendChild(fileDiv);
        });
    });
</script>

@endpush
