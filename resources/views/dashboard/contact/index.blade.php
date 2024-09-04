@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.Contact')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.contact')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.contact.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <input type="hidden" name="id" class="form-control" value="{{ $contact->id ?? '' }}">

                        <div class="form-group col-md-12">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ $contact->title ?? '' }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="ex1"> Description</label>
                            <textarea class="form-control ckeditor" id="ex1" name="description" rows="3">{{ $contact->description ?? '' }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="visit_us">Visit Us</label>
                            <textarea class="form-control" id="visit_us" name="visit_us" rows="3">{{ $contact->visit_us ?? '' }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="email_us">Email Us</label>
                            <textarea class="form-control" id="email_us" name="email_us" rows="3">{{ $contact->email_us ?? '' }}</textarea>
                        </div>

                        <!-- Call Us Section -->
                        <div class="form-group col-md-12">
                            <label for="call_us">Call Us</label>
                            <div id="call-us-container">
                                @if(isset($contact) && is_array($contact->call_us))
                                    @foreach($contact->call_us as $index => $call)
                                        <div class="input-group mb-3">
                                            <input type="text" name="call_us[]" class="form-control" value="{{ $call }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-call-us">@lang('site.remove')</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-3">
                                        <input type="text" name="call_us[]" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-call-us">@lang('site.remove')</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-call-us" class="btn btn-success">@lang('site.add_call')</button>
                        </div>

                        <!-- File Uploads -->
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="form-group col-md-4">
                                <label>@lang('site.contact_' . $i)</label>
                                <input type="file" name="contact_{{ $i }}" class="form-control">
                            </div>
                        @endfor

                        <!-- Map Selection -->
                        <div class="form-group col-md-12">
                            <label for="map">Select Location on Map</label>
                            <div id="map" style="height: 400px;"></div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ $contact->latitude ?? '' }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ $contact->longitude ?? '' }}">
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
