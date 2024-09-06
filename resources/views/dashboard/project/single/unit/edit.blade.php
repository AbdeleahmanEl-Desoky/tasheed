@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h1>@lang('site.single')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.project.single.unit.index', $project_id) }}"> @lang('site.single')</a></li>
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

                <form action="{{ route('dashboard.project.single.unit.update', $singleProjectUnit->id) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <input type="hidden" name="single_project_id" value="{{ $project_id }}">
                        <div class="form-group col-md-6">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $singleProjectUnit->title) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>@lang('site.description')</label>
                            <input type="text" name="description" class="form-control" value="{{ old('description', $singleProjectUnit->description) }}">
                        </div>

                        <!-- Room Number and Name Inputs -->
                        <div id="room-inputs">
                            @foreach (json_decode($singleProjectUnit->data, true) as $room)
                                <div class="form-group col-md-6">
                                    <label>@lang('site.number_room')</label>
                                    <input type="number" name="number_room[]" class="form-control" value="{{ $room['room_number'] }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('site.name_room')</label>
                                    <input type="text" name="name_room[]" class="form-control" value="{{ $room['room_name'] }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-success mt-2" id="add-room-button"><i class="fa fa-plus"></i> @lang('site.add_room')</button>
                        </div>

                        <!-- Caver File Inputs and Previews -->
                        <div class="form-group col-md-6">
                            <label>@lang('site.caver')</label>
                            <div id="caver-inputs">
                                @foreach ($singleProjectUnit->getMedia('singleProjectCaver') as $media)
                                    <div class="mt-2">
                                        <img src="{{ $media->getUrl() }}" alt="Caver Image" style="width: 150px; height: auto; display: block;">
                                        <input type="file" name="caver[]" class="form-control image mt-2">
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-caver-button"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                        <!-- Gallery File Inputs and Previews -->
                        <div class="form-group col-md-6">
                            <label>@lang('site.3d')</label>
                            <div id="gallery-inputs">
                                @foreach ($singleProjectUnit->getMedia('3d') as $media)
                                    <div class="mt-2">
                                        <img src="{{ $media->getUrl() }}" alt="Gallery Image" style="width: 150px; height: auto; display: block;">
                                        <input type="file" name="gallery[]" class="form-control gallery-input mt-2">
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-gallery-button"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>
                    </div>

                    <div class="row">
                        <h2>Key Feature</h2>
                        @foreach ($features as $feature)
                        <div class="form-group col-md-3">
                            <label>{{ $feature->title }}</label>
                            <input type="checkbox" name="feature_unit_id[]" value="{{ $feature->id }}" {{ in_array($feature->id, old('feature_unit_id', $singleProjectUnit->unitFeatures->pluck('id')->toArray())) ? 'checked' : '' }}>
                        </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> @lang('site.save')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-room-button').addEventListener('click', function() {
        console.log('Add Room button clicked'); // Add this line
        let roomInputs = document.getElementById('room-inputs');
        let newRoom = `
            <div class="form-group col-md-6">
                <label>@lang('site.number_room')</label>
                <input type="number" name="number_room[]" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label>@lang('site.name_room')</label>
                <input type="text" name="name_room[]" class="form-control">
            </div>
        `;
        roomInputs.insertAdjacentHTML('beforeend', newRoom);
    });

    document.getElementById('add-caver-button').addEventListener('click', function() {
        let caverInputs = document.getElementById('caver-inputs');
        let newCaver = `<input type="file" name="caver[]" class="form-control image mt-2">`;
        caverInputs.insertAdjacentHTML('beforeend', newCaver);
    });

    document.getElementById('add-gallery-button').addEventListener('click', function() {
        let galleryInputs = document.getElementById('gallery-inputs');
        let newGallery = `<input type="file" name="gallery[]" class="form-control gallery-input mt-2">`;
        galleryInputs.insertAdjacentHTML('beforeend', newGallery);
    });
});

</script>
@endsection
