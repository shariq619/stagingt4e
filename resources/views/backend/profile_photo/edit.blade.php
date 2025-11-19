@extends('layouts.main')

@section('title', 'Profile Photo')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('change Profile Photo') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Profile Photo') }}</li>
            <li class="breadcrumb-item active">{{ __('Update') }}</li>
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

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="text-right mb-2">
                        <a href="{{ route('backend.profile-photo.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.profile-photo.update', $profile_photo->id) }}" method="POST"
                        enctype="multipart/form-data" id="updatePhotoHandler">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group border p-4">
                                    <img src="{{ asset($profile_photo->profile_photo) }}" alt="Profile Photo" width="200"
                                        height="200">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group border p-4 border-width-2 border-dark">
                                    <div class="form-group">
                                        <label class="form-check-label" for="option5">
                                            <strong>Please update your profile photo</strong>
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
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('backend.profile-photo.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
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

{{--            @if ($profile_photo->profile_photo)--}}
{{--                const existingImageUrl = "{{ Storage::url($profile_photo->profile_photo) }}";--}}
{{--                profile_photo.addFile(existingImageUrl);--}}
{{--            @endif--}}

            $('#updatePhotoHandler').submit(function(e) {
                e.preventDefault();


                const formData = new FormData(this);
                const files = profile_photo.getFiles();
                if (files.length > 0) {
                    formData.append('profile_photo', files[0].file);
                } else {
                    formData.delete('profile_photo');
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
                        // Redirect to the new URL
                        window.location.href = response.url;
                        button.prop('disabled', false);
                    }).catch((err) => {
                        console.error(err, 'Job create failed');
                        toastr.error(response.message);
                        button.prop('disabled', false);
                    });
            });
        });
    </script>
@endpush
