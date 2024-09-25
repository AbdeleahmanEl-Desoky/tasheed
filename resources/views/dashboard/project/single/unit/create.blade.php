@extends('layouts.dashboard.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.single')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.project.single.index') }}"> @lang('site.single')</a></li>
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

                <form id="upload-form" action="{{ route('dashboard.project.single.unit.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="row">
                        <input type="hidden" name="single_project_id" value="{{$project_id}}">
                        <div class="form-group col-md-6">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.description')</label>
                            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                        </div>

                        <!-- Room Number and Name Inputs -->
                        <div id="room-inputs">
                            <div class="form-group col-md-6">
                                <label>@lang('site.number_room')</label>
                                <input type="number" name="number_room[]" class="form-control" value="{{ old('number_room') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('site.name_room')</label>
                                <input type="text" name="name_room[]" class="form-control" value="{{ old('name_room') }}">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-success mt-2" id="add-room-button"><i class="fa fa-plus"></i> @lang('site.add_room')</button>
                        </div>

                        <!-- Caver File Inputs -->
                        <div class="form-group col-md-6">
                            <label>@lang('site.caver')</label>
                            <div id="caver-inputs">
                                <input type="file" name="caver[]" class="form-control image">
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-caver-button"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                        <!-- Gallery File Inputs -->
                        <div class="form-group col-md-6">
                            <label>@lang('site.3d')</label>
                            <div id="gallery-inputs">
                                <input type="file" name="gallery[]" class="form-control gallery-input">
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-gallery-button"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>
                    </div>

                    <div class="row">
                        <h2>Key Feature</h2>
                        @foreach ($features as $feature)
                        <div class="form-group col-md-3">
                            <label>{{ $feature->title }}</label>
                            <input type="checkbox" name="feature_unit_id[]" value="{{ $feature->id }}" {{ in_array($feature->id, old('feature_unit_id', [])) ? 'checked' : '' }}>
                        </div>
                        @endforeach
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
        // Add new input for gallery images
        const addGalleryButton = document.getElementById('add-gallery-button');
        addGalleryButton.addEventListener('click', function () {
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'gallery[]';
            newInput.className = 'form-control gallery-input mt-2';
            document.getElementById('gallery-inputs').appendChild(newInput);
        });

        // Add new input for caver images
        const addCaverButton = document.getElementById('add-caver-button');
        addCaverButton.addEventListener('click', function () {
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'caver[]';
            newInput.className = 'form-control image mt-2';
            document.getElementById('caver-inputs').appendChild(newInput);
        });

        // Add new inputs for room number and room name
        const addRoomButton = document.getElementById('add-room-button');
        addRoomButton.addEventListener('click', function () {
            const roomInputs = document.getElementById('room-inputs');

            // Create room number input
            const numberDiv = document.createElement('div');
            numberDiv.className = 'form-group col-md-6 mt-2';
            const numberLabel = document.createElement('label');
            numberLabel.innerText = '@lang('site.number_room')';
            const numberInput = document.createElement('input');
            numberInput.type = 'number';
            numberInput.name = 'number_room[]';
            numberInput.className = 'form-control';
            numberDiv.appendChild(numberLabel);
            numberDiv.appendChild(numberInput);

            // Create room name input
            const nameDiv = document.createElement('div');
            nameDiv.className = 'form-group col-md-6 mt-2';
            const nameLabel = document.createElement('label');
            nameLabel.innerText = '@lang('site.name_room')';
            const nameInput = document.createElement('input');
            nameInput.type = 'text';
            nameInput.name = 'name_room[]';
            nameInput.className = 'form-control';
            nameDiv.appendChild(nameLabel);
            nameDiv.appendChild(nameInput);

            // Append the new inputs to the room inputs section
            roomInputs.appendChild(numberDiv);
            roomInputs.appendChild(nameDiv);
        });
    });
</script>
@endpush

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
                window.location.href = "{{ route('dashboard.project.single.index') }}"; // Redirect on success
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
