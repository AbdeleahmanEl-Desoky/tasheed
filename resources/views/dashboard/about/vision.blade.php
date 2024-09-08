@extends('layouts.dashboard.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.vision')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.vision')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">


                <div class="box-body">

                    @include('partials._errors')

                    <form id="upload-form" action="{{ route('dashboard.about.vision.store') }}" method="post" enctype="multipart/form-data">

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
                            @if($vision?->media != null)
                            @foreach ($vision->media as $media)
                            <img src="{{  $media->original_url  }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                            @endforeach
                            @endif
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
    document.getElementById('upload-button').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default button click behavior

        var form = document.getElementById('upload-form');
        var formData = new FormData(form);
        var fileInput = document.querySelector('input[name="file"]');
        var maxFileSize = 10 * 1024 * 1024; // 10 MB in bytes
        var allowedFileTypes = ['image/jpeg', 'image/png', 'application/pdf']; // Define allowed file types

        // Check if a file is selected
        if (fileInput.files[0]) {
            var fileType = fileInput.files[0].type;
            var fileSize = fileInput.files[0].size;

            // Check if the file type is allowed
            if (!allowedFileTypes.includes(fileType)) {
                alert('Invalid file type. Only JPG, PNG, and PDF files are allowed.');
                return; // Stop the function if the file type is not allowed
            }

            // Check if the file size exceeds the maximum limit
            if (fileSize > maxFileSize) {
                alert('The file size exceeds the maximum limit of 10 MB.');
                return; // Stop the function if the file size is too large
            }
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
                window.location.href = "{{ route('dashboard.about.vision.index') }}"; // Redirect on success
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
