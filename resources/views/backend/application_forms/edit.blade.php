@extends('layouts.main')

@section('title', 'Application Form')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('change Application Form') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Application Form') }}</li>
            <li class="breadcrumb-item active">{{ __('Update') }}</li>
        </ol>
    </div>
@endsection

@section('main')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Form change Application Form') }}
                </div>
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.application-forms.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.application-forms.update', $application_form->id) }}" method="POST"
                        enctype="multipart/form-data" id="submitForm"
                        data-update-url="{{ route('backend.application-forms.update', $application_form->id) }}">
                        @csrf
                        @method('PUT')
                        @include('backend.application_forms._form')
                        {{--                        <div class="form-group">--}}
                        {{--                            <button type="submit" class="btn btn-primary">--}}
                        {{--                                <i class="fas fa-save mr-2"></i>--}}
                        {{--                                {{ __('Update') }}--}}
                        {{--                            </button>--}}
                        {{--                            <a href="{{ route('backend.learner.dashboard') }}" class="btn btn-secondary">--}}
                        {{--                                <i class="fas fa-times mr-2"></i>--}}
                        {{--                                {{ __('Cancel') }}--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}


                        <div class="form-group">
                            <button class="btn btn-primary" id="previewButton" data-toggle="modal"
                                data-target="#deletePreviewApp">
                                <i class="fas fa-eye mr-2"></i>
                                {{ __('Update and Preview') }}
                            </button>
                            <a href="{{ route('backend.learner.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
{{--                            <button class="btn btn-primary" id="previewButtonEdit" data-toggle="modal"--}}
{{--                                    data-target="#deletePreviewApp">--}}
{{--                                <i class="fas fa-eye mr-2"></i>--}}
{{--                                {{ __('Update and Preview') }}--}}
{{--                            </button>--}}
                        </div>


                    </form>


                    <div class="modal fade" id="deletePreviewApp" tabindex="-1" aria-labelledby="deleteCatLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        aria-label="Close">
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

                    <hr>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- @push('js') --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/5.0.2/signature_pad.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script> --}}

{{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);
            var clearButton = document.getElementById('clear-signature');
            var inputSignature = document.getElementById('signature');

            clearButton.addEventListener('click', function () {
                signaturePad.clear();
                inputSignature.value = '';
            });

            document.querySelector('form').addEventListener('submit', function () {
                if (!signaturePad.isEmpty()) {
                    inputSignature.value = signaturePad.toDataURL('image/png');
                }
            });
        });
    </script>
@endpush --}}

@push('css')
    <style>
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
    <script>
        $(document).ready(function() {
            $('#previewButton').click(function(e) {
                e.preventDefault();

                const form = $('#submitForm');
                const url = form.attr('action');
                const token = $('meta[name="csrf-token"]').attr('content');
                const formData = new FormData(form[0]);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    beforeSend: function() {
                        $('#loadingSpinner').show();
                    },
                    success: function(response) {
                        $('#loadingSpinner').hide();
                        console.log('tpath '+ response.pdfPath)
                        $('#pdfPreview').attr('src', response.pdfPath);
                        $('#deletePreviewApp').modal('show');
                    },
                    error: function(err) {
                        $('#loadingSpinner').hide();
                        console.error(err);
                    }
                });
            });

            $('#modalFormHandler').click(function(e) {
                e.preventDefault();

                const form = $('#submitForm');
                const url = form.attr('data-update-url');
                const token = $('meta[name="csrf-token"]').attr('content');
                const formData = new FormData(form[0]);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        const pdfDownloadUrl = response.pdfPath;

                        window.location.href = pdfDownloadUrl;

                        window.location.href =
                        '{{ route('backend.application-forms.index') }}';
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });

        });
    </script>
@endpush
