@extends('layouts.dashboard.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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

                    <form id="upload-form" action="{{ route('dashboard.contact.store') }}" method="post" enctype="multipart/form-data">
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
                            <label>@lang('CRM General')</label>
                            <input type="number" name="crm_general" class="form-control" value="{{ $contact?->crm_general }}">
                        </div>

                        {{-- <div class="form-group col-md-12">
                            <label for="visit_us">Visit Us</label>
                            <textarea class="form-control" id="visit_us" name="visit_us" rows="3">{{ $contact->visit_us ?? '' }}</textarea>
                        </div> --}}
                        <div class="form-group col-md-12">
                            <labegl for="visit_us">visit link</labegl>
                            <input class="form-control" id="visit_link" name="visit_link" {{ $contact->visit_link ?? '' }}>
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

                        <!-- visit Us Section -->
                        <div class="form-group col-md-12">
                            <label for="visit_us">Visit Us</label>
                            <div id="visit-us-container">
                                @if(isset($contact) && is_array($contact->visit_us))
                                    @foreach($contact->visit_us as $index => $visit)
                                        <div class="input-group mb-3">
                                            <input type="text" name="visit_us[{{ $index }}][visit_us]" class="form-control" value="{{ $visit['visit_us'] ?? '' }}" placeholder="Visit Us">
                                            <input type="text" name="visit_us[{{ $index }}][visit_link]" class="form-control" value="{{ $visit['visit_link'] ?? '' }}" placeholder="Visit Link">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-visit-us">@lang('site.remove')</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-3">
                                        <input type="text" name="visit_us[0][visit_us]" class="form-control" placeholder="Visit Us">
                                        <input type="text" name="visit_us[0][visit_link]" class="form-control" placeholder="Visit Link">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger remove-visit-us">@lang('site.remove')</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-visit-us" class="btn btn-success">@lang('site.add_visit')</button>
                        </div>

                        <!-- File Uploads -->
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="form-group col-md-4">
                                <label>@lang('site.contact_' . $i)</label>
                                <input type="file" name="contact_{{ $i }}" class="form-control">
                            </div>
                        @endfor


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

    // Add and remove Visit Us inputs dynamically

    $('#add-visit-us').click(function() {
        var index = $('#visit-us-container .input-group').length;
        $('#visit-us-container').append(`
            <div class="input-group mb-3">
                <input type="text" name="visit_us[${index}][visit_us]" class="form-control" placeholder="Visit Us">
                <input type="text" name="visit_us[${index}][visit_link]" class="form-control" placeholder="Visit Link">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-visit-us">@lang('site.remove')</button>
                </div>
            </div>
        `);
    });



    // Handle file uploads and form submission
    document.getElementById('upload-button').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default form submission
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var form = document.getElementById('upload-form');
        var formData = new FormData(form);
        var maxFileSize = 200 * 1024 * 1024; // 10 MB in bytes
        var allowedFileTypes = ['image/jpeg', 'image/png', 'application/pdf']; // Define allowed file types

        // Validate each file input
        var isValid = true;
        document.querySelectorAll('input[type="file"]').forEach(function(fileInput) {
            var file = fileInput.files[0];
            if (file) {
                var fileType = file.type;
                var fileSize = file.size;

                // Check if the file type is allowed
                if (!allowedFileTypes.includes(fileType)) {
                    alert('Invalid file type. Only JPG, PNG, and PDF files are allowed.');
                    isValid = false;
                    return;
                }

                // Check if the file size exceeds the maximum limit
                if (fileSize > maxFileSize) {
                    alert('The file size exceeds the maximum limit of 10 MB.');
                    isValid = false;
                    return;
                }
            }
        });

        if (!isValid) {
            return; // Stop the function if any file input is invalid
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
                window.location.href = "{{ route('dashboard.contact.index') }}"; // Redirect on success
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
