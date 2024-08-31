@extends('layouts.dashboard.app')

@section('content')

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

                    <form action="{{ route('dashboard.project.single.store') }}" method="post" enctype="multipart/form-data">

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
                        <div class="form-group col-md-6">
                            <label>@lang('site.map')</label>
                            <input type="text" name="map" class="form-control" value="{{ old('map') }}">
                        </div>
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
