@extends('layouts.main')

@section('title', 'Profile Photo')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Profile Photo Upload') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Profile Photo Upload') }}</li>
            <li class="breadcrumb-item active">{{ __('Add') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview@^4/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        span.select2-selection.select2-selection--single {
            height: 40px;
        }
    </style>
@endpush

@section('main')
    <div id="loadingSpinner" style="display: none; text-align: center;">
        <i class="fas fa-spinner fa-spin fa-3x"></i>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.profile-photo.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form method="POST" action="{{ route('backend.profile-photo.store') }}" enctype="multipart/form-data"
                        id="profilePhotoForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group border p-4 border-width-2 border-dark">
                                    <div class="form-group">
                                        <label class="form-check-label" for="option5">
                                            <strong>Please upload your profile photo</strong>
                                        </label>
                                        <input type="file" class="filepond" name="profile_photo" data-filepond>
                                        @error('profile_photo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('backend.profile-photo.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                            <button class="btn btn-primary">
                                <i class="fas fa-eye mr-2"></i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        div#loadingSpinner {
            position: fixed;
            left: 0;
            right: 0;
            margin: auto;
            top: 0;
            bottom: 0;
            z-index: 9999;
            background: #00000036;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        div#loadingSpinner i {
            color: #007bff;
        }

        .form-group label>span {
            color: #dc3545;
        }

        #deletePreviewApp .modal-dialog {
            max-width: 65vw;
        }
    </style>
@endpush

@push('js')
    <script src="https://unpkg.com/filepond/dist/filepond.min.js" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size@^2/dist/filepond-plugin-file-validate-size.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview@^4/dist/filepond-plugin-image-preview.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <script>
        toastr.options = {
            "closeButton": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        }
    </script>

    <script>
        $(document).ready(function() {

            FilePond.registerPlugin(FilePondPluginFileValidateSize, FilePondPluginImagePreview);
            const profile_photo = FilePond.create(document.querySelector('input[name="profile_photo"]'));

            @if ($profilePhoto->profile_photo)
                const existingImageUrl = "{{ asset($profilePhoto->profile_photo) }}";
                profile_photo.addFile(existingImageUrl);
            @endif

            // Handle form submission
            $('#profilePhotoForm').submit(function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                const isNotEmptyFile = profile_photo.getFiles().length > 0;

                if (!isNotEmptyFile) {
                    toastr.error('Please select a profile photo to upload.');
                    return;
                }

                // Append the file to FormData
                profile_photo.getFiles().forEach(file => {
                    formData.append('profile_photo', file.file);
                });

                const url = $(this).attr('action');
                const token = $('meta[name="csrf-token"]').attr('content');
                const button = $('button[type="submit"]');
                button.prop('disabled', true);
                $('#loadingSpinner').show();

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                }).then((response) => {
                    toastr.success(response.message);

                    // Redirect to the new URL
                    window.location.href = response.url;
                    $('#loadingSpinner').hide();
                    button.prop('disabled', false);
                    if ($(e.target).attr('id') === 'profilePhotoForm') {
                        $('#profilePhotoForm')[0].reset();
                        profile_photo.removeFiles();
                    }
                    
                }).catch((err) => {
                    $('#loadingSpinner').hide();
                    console.error("Error response: ", err);
                    if (err.responseJSON && err.responseJSON.errors) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            toastr.error(value);
                        });
                    } else {
                        toastr.error('Error updating profile photo');
                    }
                    button.prop('disabled', false);
                });
            });
        });
    </script>



    {{-- my code --}}
    {{-- <script>
    $(document).ready(function() {
        FilePond.registerPlugin(FilePondPluginFileValidateSize, FilePondPluginImagePreview);
        const job_img = FilePond.create(document.querySelector('input[name="job_img"]'));

        @if ($job->job_img)
            const existingImageUrl = "{{ asset($job->job_img) }}";
            job_img.addFile(existingImageUrl);
        @endif

        $('#createJobHandler, #updateJobHandler').submit(function(e) {
            e.preventDefault();



            const formData = new FormData(this);
            const files = job_img.getFiles();
            if (files.length > 0) {
                formData.append('job_img', files[0].file);
            } else {
                formData.delete('job_img');
            }

            const url = $(this).attr('action');
            const token = $('meta[name="csrf-token"]').attr('content');
            const button = $('input[type="submit"]');
            button.prop('disabled', true);

            $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                .then((response) => {
                    toastr.success(response.message);
                    button.prop('disabled', false);
                    if ($(e.target).attr('id') === 'createJobHandler') {
                        $('#createJobHandler')[0].reset();
                        job_img.removeFiles();
                    }
                }).catch((err) => {
                    console.error(err, 'Job create failed');
                    toastr.error(response.message);
                    button.prop('disabled', false);
                });
        });
    });
</script> --}}
@endpush
