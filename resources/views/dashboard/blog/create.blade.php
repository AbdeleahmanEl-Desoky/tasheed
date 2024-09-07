@extends('layouts.dashboard.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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

                <form id="upload-form" action="{{ route('dashboard.blog.store') }}" method="post" enctype="multipart/form-data">

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
                    <div class="form-group col-md-12">
                        <progress id="progress-bar" value="0" max="100" style="width: 100%;"></progress>
                    </div>


                    <div class="form-group">
                        <button type="submit" id="upload-button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
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

@push('scripts')
<script>
    document.getElementById('upload-button').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default button click behavior

        var form = document.getElementById('upload-form');
        var formData = new FormData(form);
        var fileInput = document.querySelector('input[name="file"]');
        var maxFileSize = 20 * 1024 * 1024; // 10 MB in bytes

        // Check if a file is selected and if its size exceeds the maximum limit
        if (fileInput.files[0] && fileInput.files[0].size > maxFileSize) {
            alert('The file size exceeds the maximum limit of 10 MB.');
            return; // Stop the function if the file size is too large
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        // Add CSRF token to the AJAX request
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        xhr.upload.addEventListener('progress', function (e) {
            if (e.lengthComputable) {
                var percentComplete = (e.loaded / e.total) * 100;
                document.getElementById('progress-bar').value = percentComplete;
            }
        });

        xhr.onload = function () {
            if (xhr.status === 200) {
                alert('File uploaded successfully');
                window.location.href = "{{ route('dashboard.blog.index') }}"; // Redirect on success
            } else {
                console.log(xhr.responseText); // Display server error message
                alert('An error occurred: ' + xhr.responseText); // Show the error message
            }
        };

        xhr.onerror = function () {
            alert('An error occurred while uploading the file.');
        };

        xhr.send(formData);
    });
</script>
@endpush
