@extends('layouts.dashboard.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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

                    <form id="upload-form" action="{{ route('dashboard.about.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <input type="hidden" name="id" class="form-control" value="{{ $about?->id }}">

                        <div class="form-group col-md-12">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ $about?->title }}">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="ex1"> Description</label>
                            <textarea class="form-control ckeditor" id="ex1" name="description" rows="3">{{$about?->description}}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="ex1">Home Description </label>
                            <textarea class="form-control ckeditor" id="ex1" name="description_home" rows="3">{{$about?->description_home}}</textarea>
                        </div>


                        <div class="form-group col-md-4">
                            <label>@lang('projects')</label>
                            <input type="number" name="projects" class="form-control" value="{{ $about?->projects }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label>@lang('years experience')</label>
                            <input type="number" name="years_experience" class="form-control" value="{{ $about?->years_experience }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label>@lang('sold unit')</label>
                            <input type="number" name="projects" class="form-control" value="{{ $about?->sold_unit }}">
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

                        <div class="form-group col-md-4">
                            <label>@lang('Image Home')</label>
                            <input type="file" name="home_about" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <img src="{{  $aboutGallery?->media[0]->original_url  }}" style="width: 100px" alt="">
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

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        var form = document.getElementById('upload-form');
        var formData = new FormData(form);
        var fileInput = document.querySelector('input[name="file"]');
        var maxFileSize = 200 * 1024 * 1024; // 10 MB in bytes

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
                window.location.href = "{{ route('dashboard.about.index') }}"; // Redirect on success
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
