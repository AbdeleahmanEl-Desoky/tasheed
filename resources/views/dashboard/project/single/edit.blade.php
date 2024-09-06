@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h1>@lang('site.single')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.project.single.index') }}"> @lang('site.single')</a></li>
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

                <form action="{{ route('dashboard.project.single.update', $project->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $project->title) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.description')</label>
                            <input type="text" name="description" class="form-control" value="{{ old('description', $project->description) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.type')</label>
                            <select name="type" class="form-control">
                                <option value="normal" {{ old('type', $project->type) == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="ongoing" {{ old('type', $project->type) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="featured" {{ old('type', $project->type) == 'featured' ? 'selected' : '' }}>Featured</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.location')</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location', $project->location) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.year')</label>
                            <input type="number" name="year" class="form-control" value="{{ old('year', $project->year) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.data')</label>
                            <input type="text" name="data" class="form-control" value="{{ old('data', $project->data) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.adderss')</label>
                            <input type="text" name="adderss" class="form-control" value="{{ old('adderss', $project->adderss) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.map_description')</label>
                            <input type="text" name="map_description" class="form-control" value="{{ old('map_description', $project->map_description) }}">
                        </div>

                        <!-- Social Media Fields -->
                        <div class="form-group col-md-6">
                            <label>@lang('site.facebook')</label>
                            <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $project->facebook) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.instagram')</label>
                            <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $project->instagram) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.twitter')</label>
                            <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $project->twitter) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.youtube')</label>
                            <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $project->youtube) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.telegram')</label>
                            <input type="text" name="telegram" class="form-control" value="{{ old('telegram', $project->telegram) }}">
                        </div>

                        <!-- Cover Image -->
                        <div class="form-group col-md-6">
                            <label>@lang('site.caver')</label>
                            <input type="file" name="caver" class="form-control image">
                        </div>

                        <!-- Cover Image -->
                        <div class="form-group col-md-6">

                            @foreach ($project->getMedia('singleProjectCaver') as $image)
                            <div class="gallery-image-wrapper">
                                <img src="{{ $image->getUrl() }}" style="width: 100px" class="img-thumbnail" alt="">
                            </div>
                        @endforeach
                        </div>



                        <!-- Key Features -->
                        <div class="row">
                            <h2>Key Feature</h2>
                            @foreach ($features as $feature)
                                <div class="form-group col-md-3">
                                    <label>{{ $feature->title }}</label>
                                    <input type="checkbox" name="feature_id[]" value="{{ $feature->id }}" {{ in_array($feature->id, old('feature_id', $project->features->pluck('id')->toArray())) ? 'checked' : '' }}>
                                </div>
                            @endforeach
                        </div>


                    <!-- Gallery Images -->
                    <div class="form-group col-md-12">
                        <label>@lang('site.gallery')</label>
                        <div id="gallery-inputs">
                            @foreach ($project->getMedia('singleProjectGallery') as $image)
                                <div class="gallery-image-wrapper">
                                    <img src="{{ $image->getUrl() }}" style="width: 100px" class="img-thumbnail" alt="">
                                </div>
                            @endforeach
                            <input type="file" name="gallery[]" class="form-control gallery-input mt-2">
                        </div>
                        <button type="button" class="btn btn-success mt-2" id="add-gallery-button"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>

                        <!-- Map Selection -->
                        <div class="form-group col-md-12">
                            <label for="map">Select Location on Map</label>
                            <div id="map" style="height: 400px;"></div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ $project->latitude }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ $project->longitude }}">
                        </div>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->

@endsection

@push('scripts')
<script>
// Gallery Add More Inputs
document.addEventListener('DOMContentLoaded', function () {
    const addGalleryButton = document.getElementById('add-gallery-button');
    addGalleryButton.addEventListener('click', function () {
        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'gallery[]';
        newInput.className = 'form-control gallery-input mt-2';
        const galleryInputsContainer = document.getElementById('gallery-inputs');
        galleryInputsContainer.appendChild(newInput);
    });
});
</script>

<!-- Include Leaflet.js library -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<script>
var initialLat = {{ $project->latitude ?? '30.0444' }};
var initialLng = {{ $project->longitude ?? '31.2357' }};
var map = L.map('map').setView([initialLat, initialLng], 6);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '© OpenStreetMap'
}).addTo(map);

var marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);
marker.on('dragend', function(e) {
    var latLng = e.target.getLatLng();
    document.getElementById('latitude').value = latLng.lat;
    document.getElementById('longitude').value = latLng.lng;
});
</script>
@endpush
