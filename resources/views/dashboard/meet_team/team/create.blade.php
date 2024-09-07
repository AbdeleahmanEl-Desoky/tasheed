@extends('layouts.dashboard.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.features')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.meet_team.team.index') }}"> @lang('site.features')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div>
            <div class="box-body">
                @include('partials._errors')
                <form id="upload-form" action="{{ route('dashboard.meet_team.team.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-6">
                        <label>@lang('site.name')</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>@lang('site.job_name')</label>
                        <input type="text" name="job_name" class="form-control" value="{{ old('job_name') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>@lang('site.job_rank')</label>
                        <input type="text" name="job_rank" class="form-control" value="{{ old('job_rank') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>@lang('site.image')</label>
                        <input type="file" name="file" class="form-control image">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Head Team </label>
                        <input type="checkbox" name="in_page" value="1">
                    </div>

                    <div class="form-group col-md-6">
                        <img src="{{ asset('uploads/user_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                    </div>

                    <div class="form-group col-md-12">
                        <progress id="progress-bar" value="0" max="100" style="width: 100%;"></progress>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="upload-button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script>
    document.querySelector('input[name="file"]').addEventListener('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('.image-preview').src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });

    document.getElementById('upload-button').addEventListener('click', function (e) {
        e.preventDefault();

        var form = document.getElementById('upload-form');
        var formData = new FormData(form);
        var fileInput = document.querySelector('input[name="file"]');
        var maxFileSize = 10 * 1024 * 1024; // 10 MB

        if (fileInput.files[0] && fileInput.files[0].size > maxFileSize) {
            alert('The file size exceeds the maximum limit of 10 MB.');
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

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
                window.location.href = "{{ route('dashboard.meet_team.team.index') }}";
            } else {
                console.log(xhr.responseText);
                alert('An error occurred: ' + xhr.responseText);
            }
        };

        xhr.onerror = function () {
            alert('An error occurred while uploading the file.');
        };

        xhr.send(formData);
    });
</script>
@endpush
