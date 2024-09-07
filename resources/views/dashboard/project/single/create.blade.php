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

                    <form id="upload-form" action="{{ route('dashboard.project.single.store') }}" method="post" enctype="multipart/form-data">

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
                            <label>@lang('site.type')</label>
                            <select  name="type" class="form-control" value="{{ old('type') }}">
                                <option value="normal">Normal</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="featured">Featured</option>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label>@lang('site.location')</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('site.year')</label>
                            <input type="number" name="year" class="form-control" value="{{ old('year') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('site.data')</label>
                            <input type="text" name="data" class="form-control" value="{{ old('data') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('site.adderss')</label>
                            <input type="text" name="adderss" class="form-control" value="{{ old('adderss') }}">
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label>@lang('site.map')</label>
                            <input type="text" name="map" class="form-control" value="{{ old('map') }}">
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label>@lang('site.map_description')</label>
                            <input type="text" name="map_description" class="form-control" value="{{ old('map_description') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.facebook')</label>
                            <input type="text" name="facebook" class="form-control" value="{{ old('facebook') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('site.instagram')</label>
                            <input type="text" name="instagram" class="form-control" value="{{ old('instagram') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('site.twitter')</label>
                            <input type="text" name="twitter" class="form-control" value="{{ old('twitter') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('site.youtube')</label>
                            <input type="text" name="youtube" class="form-control" value="{{ old('youtube') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('site.telegram')</label>
                            <input type="text" name="telegram" class="form-control" value="{{ old('telegram') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.caver')</label>
                            <input type="file" name="caver" class="form-control image">
                        </div>

                        <div class="form-group col-md-6">
                            <img src="{{ asset('uploads/user_images/default.png') }}"  style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>
                    </div>

                    <div class="row">
                            <h2>Key Feature</h2>
                            @foreach ($features as $feature)
                            <div class="form-group col-md-3">
                                <label>{{ $feature->title }}</label>
                                <input type="checkbox" name="feature_id[]" value="{{ $feature->id }}" {{ in_array($feature->id, old('feature_id', [])) ? 'checked' : '' }}>
                            </div>
                            @endforeach
                        </div>
                        <!-- Gallery File Inputs -->
                        <div class="form-group col-md-6">
                            <label>@lang('site.gallery')</label>
                            <div id="gallery-inputs">
                                <input type="file" name="gallery[]" class="form-control gallery-input">
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-gallery-button"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>
                                                <!-- Map Selection -->
                                                <div class="form-group col-md-12">
                                                    <label for="map">Select Location on Map</label>
                                                    <div id="map" style="height: 400px;"></div>
                                                    <input type="hidden" id="latitude" name="latitude" value="{{ $contact->latitude ?? '' }}">
                                                    <input type="hidden" id="longitude" name="longitude" value="{{ $contact->longitude ?? '' }}">
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
        // Get the "Add" button
        const addGalleryButton = document.getElementById('add-gallery-button');

        // Add click event listener to the "Add" button
        addGalleryButton.addEventListener('click', function () {
            // Create a new file input for the gallery
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'gallery[]';
            newInput.className = 'form-control gallery-input mt-2';

            // Append the new input to the gallery inputs container
            const galleryInputsContainer = document.getElementById('gallery-inputs');
            galleryInputsContainer.appendChild(newInput);
        });
    });
</script>

@endpush
@push('scripts')
<!-- Include Leaflet.js library -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<script>
    // Get latitude and longitude from input fields
    var initialLat = {{ $contact->latitude ?? '30.0444' }}; // Default latitude
    var initialLng = {{ $contact->longitude ?? '31.2357' }}; // Default longitude

    // Initialize the map
    var map = L.map('map').setView([initialLat, initialLng], 6); // Use initial coordinates

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Add a marker with the initial coordinates
    var marker = L.marker([initialLat, initialLng], {
        draggable: true
    }).addTo(map);

    // Update input values when the marker is dragged
    marker.on('dragend', function(e) {
        var latLng = e.target.getLatLng();
        document.getElementById('latitude').value = latLng.lat;
        document.getElementById('longitude').value = latLng.lng;
    });

    // Add and remove Call Us inputs dynamically
    $('#add-call-us').click(function() {
        $('#call-us-container').append(`
            <div class="input-group mb-3">
                <input type="text" name="call_us[]" class="form-control">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-call-us">@lang('site.remove')</button>
                </div>
            </div>
        `);
    });

    $(document).on('click', '.remove-call-us', function() {
        $(this).closest('.input-group').remove();
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
