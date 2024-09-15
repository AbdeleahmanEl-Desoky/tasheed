@extends('layouts.dashboard.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.home')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.home')</a></li>
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

                    <form id="upload-form" action="{{ route('dashboard.home.update', $home->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group col-md-6">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ $home->title }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.date')</label>
                            <input type="text" name="date" class="form-control" value="{{ $home->date }}">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="ex1"> Description</label>
                            <textarea class="form-control ckeditor" id="ex1"
                                      name="description" rows="3">{{$home->description}}</textarea>

                        </div>


                        <div class="form-group col-md-4">
                            <label>@lang('site.image')</label>
                            <input type="file" name="file" class="form-control image" id="file_input">
                        </div>

                        <div class="form-group col-md-4">
                            <label>@lang('site.file_type')</label>
                            <select name="file_type" class="form-control" id="file_type">
                                <option value="image" {{ $home->file_type == 'image' ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ $home->file_type == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <img src="{{  $home->media[0]->original_url  }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <video controls style="width: 100px;">
                            <source src="{{ $home->media[0]->original_url }}" type="" class="img-thumbnail image-preview">
                        </video>

                        <div class="form-group col-md-12">
                            <progress id="progress-bar" value="0" max="100" style="width: 100%;"></progress>
                        </div>


                        <div class="form-group">
                            <button type="submit" id="upload-button" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileTypeSelect = document.getElementById('file_type');
            const fileInput = document.getElementById('file_input');
            const maxImageSize = 2 * 1024 * 1024; // 2MB
            const maxVideoSize = 50 * 1024 * 1024; // 50MB

            function updateFileInputAccept() {
                const selectedType = fileTypeSelect.value;

                if (selectedType === 'image') {
                    fileInput.accept = 'image/jpeg, image/jpg, image/png'; // Accept specific image types
                } else if (selectedType === 'video') {
                    fileInput.accept = 'video/mp4'; // Accept only MP4 video files
                }
            }

            // Update file input accept attribute on page load
            updateFileInputAccept();

            // Update file input accept attribute when file type changes
            fileTypeSelect.addEventListener('change', updateFileInputAccept);

            // Validate file size on file selection
            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const fileSize = file.size;

                    if (fileTypeSelect.value === 'image' && fileSize > maxImageSize) {
                        alert('The selected image file exceeds the maximum size of 2MB.');
                        fileInput.value = ''; // Clear the file input
                    } else if (fileTypeSelect.value === 'video' && fileSize > maxVideoSize) {
                        alert('The selected video file exceeds the maximum size of 50MB.');
                        fileInput.value = ''; // Clear the file input
                    }
                }
            });
        });
    </script>



@endsection

@push('scripts')
<script>
    document.getElementById('upload-button').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default button click behavior
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
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
                window.location.href = "{{ route('dashboard.home.index') }}"; // Redirect on success
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
