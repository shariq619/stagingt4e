@extends('layouts.main')

@section('title', 'Application Form')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Add Application Form') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Application Form') }}</li>
            <li class="breadcrumb-item active">{{ __('Add') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{--            <div class="card-header"> --}}
                {{--                {{ __('Form add qualifications') }} --}}
                {{--            </div> --}}
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.learner.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.application-forms.store') }}" method="POST" id="submitForm">
                        @csrf
                        @include('backend.application_forms._form')
                        <div class="form-group">
                            <a href="{{ route('backend.learner.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                            <button class="btn btn-primary" id="previewButton" data-toggle="modal"
                                data-target="#deletePreviewApp">
                                <i class="fas fa-eye mr-2"></i>
                                {{ __('Save and Preview') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal fade" id="deletePreviewApp" tabindex="-1" aria-labelledby="deleteCatLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        {{-- <div id="loadingSpinner" style="display: none; text-align: center;">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                        </div> --}}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteRoleLabel">{{ __('Preview Application') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="loadingSpinner" style="display: none; text-align: center;">
                                    <i class="fas fa-spinner fa-spin fa-3x"></i>
                                </div>
                                <iframe id="pdfPreview" width="100%" height="600"></iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-pencil mr-2"></i>
                                    Edit
                                </button>
                                <button type="submit" id="modalFormHandler" class="btn btn-primary">
                                    <i class="fas fa-save mr-2"></i>
                                    Save & Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
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

        .bgGray {
            background: #919191;
            color: #fff;
            font-size: 25px;
            font-weight: 700;
            padding: 7px 20px;
            border-radius: 5px;
            margin: 30px 0px;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <script>
        $('#telephone').mask('+44 00 0000 0000');
        $('#contact_num').mask('+44 00 0000 0000');
        $('#emp_contact_num').mask('+44 00 0000 0000');
        $('#phone_number').mask('+44 00 0000 0000');

        $('#post_code').mask('AAAA AAA', {
            translation: {
                'A': {
                    pattern: /[A-Za-z0-9]/
                },
            },
            placeholder: "____ ___"
        });

        $('#emp_post_code').mask('AAAA AAA', {
            translation: {
                'A': {
                    pattern: /[A-Za-z0-9]/
                },
            },
            placeholder: "____ ___"
        });

        $(document).ready(function() {

            function validateForm() {
                let isValid = true;

                // Clear previous error highlights
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').hide();

                const requiredFields = [
                    '#birth_date',
                    '#nationality',
                    '#email',
                    '#address',
                    '#post_code',
                    '#phone_number',
                    '#name',
                    '#contact_num'
                ];

                requiredFields.forEach(selector => {
                    const field = $(selector);

                    // Special handling for select elements
                    if (field.is('select')) {
                        if (!field.val() || field.val() === "") {
                            field.addClass('is-invalid');
                            field.next('.invalid-feedback').show();
                            isValid = false;
                        }
                    }
                    // For readonly fields, we just need to check they have a value
                    else if (field.is('[readonly]')) {
                        if (!field.val()) {
                            field.addClass('is-invalid');
                            field.next('.invalid-feedback').show();
                            isValid = false;
                        }
                    }
                    else {
                        if (!field.val()) {
                            field.addClass('is-invalid');
                            field.next('.invalid-feedback').show();
                            isValid = false;
                        }
                    }

                    if (!isValid) {
                        $('html, body').animate({
                            scrollTop: field.offset().top - 100
                        }, 500);
                        return false;
                    }
                });

                if (!$('input[name="hear_about"]:checked').length) {
                    $('input[name="hear_about"]').addClass('is-invalid');
                    $('input[name="hear_about"]').closest('.form-group').find('.invalid-feedback').show();
                    isValid = false;

                    if (!isValid) {
                        $('html, body').animate({
                            scrollTop: $('input[name="hear_about"]').offset().top - 100
                        }, 500);
                    }
                }

                if (!$('input[name="term"]').is(':checked')) {
                    $('input[name="term"]').addClass('is-invalid');
                    $('input[name="term"]').closest('.form-check').find('.invalid-feedback').show();
                    isValid = false;

                    if (!isValid) {
                        $('html, body').animate({
                            scrollTop: $('input[name="term"]').offset().top - 100
                        }, 500);
                    }
                }

                return isValid;
            }

            $('#previewButton').click(function(e) {
                e.preventDefault();

                if (!validateForm()) {
                    return false;
                }

                $('#deletePreviewApp').modal('show');
                const form = $('#submitForm')[0];
                const formData = new FormData(form);
                const token = $('meta[name="csrf-token"]').attr('content');
                $('#loadingSpinner').show();
                $('#pdfPreview').hide();

                $.ajax({
                    method: "POST",
                    url: "{{ route('backend.application-forms.preview') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(data) {
                        if (data.pdfPath) {
                            $('#pdfPreview').attr('src', data.pdfPath);
                            $('#loadingSpinner').hide();
                            $('#pdfPreview').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $('#loadingSpinner').hide();
                    }
                });
            });

            $('#modalFormHandler').click(function(e) {
                e.preventDefault();

                if ($('#submitForm').valid()) {
                    const form = $('#submitForm');
                    const url = form.attr('action');
                    const token = $('meta[name="csrf-token"]').attr('content');
                    const formData = new FormData(form[0]);
                    const button = $(this);

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
                        })
                        .then(function(response) {
                            console.log(response.message);
                            button.prop('disabled', false);
                            form[0].reset();
                            $('#deletePreviewApp').modal('hide');
                            const pdfDownloadUrl = response.pdfPath;

                            const link = document.createElement('a');
                            link.href = pdfDownloadUrl;
                            link.download = pdfDownloadUrl.split('/').pop();
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                            $('#loadingSpinner').hide();
                            if (response.learner) {
                                window.location.href = response.learner;
                            } else {
                                setTimeout(function() {
                                    window.location.href =
                                        '{{ route('backend.application-forms.index') }}';
                                }, 3000);
                            }
                        })
                        .catch(function(err) {
                            $('#loadingSpinner').hide();
                            console.error(err);
                            button.prop('disabled', false);
                        });
                }
            });
        });
    </script>
@endpush
