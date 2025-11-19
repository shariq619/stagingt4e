@extends('layouts.main')

@section('title', 'Application Form')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Identification Validation') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Identification Validation') }}</li>
            <li class="breadcrumb-item active">{{ __('Add') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview@^4/dist/filepond-plugin-image-preview.min.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
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
                    <div class="text-right">
                        <a href="{{ route('backend.learner.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>

                    <form action="{{ route('backend.document-uploads.update', $documentUpload->id) }}" method="POST"
                          enctype="multipart/form-data" id="documentUploadHandler">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="document_text">
                                    <p>In line with the SIA documentation requirements, we may accept the following
                                        forms of identification:</p>
                                    <ul>
                                        <li>
                                            <strong>one identity document</strong> from the <strong>Group A</strong>
                                            list AND <strong>two documents</strong> from the <strong>Group B</strong>
                                            list.
                                        </li>
                                        <li>
                                            at least one document must show the learner’s current address.
                                        </li>
                                        <li>
                                            at least one document must show their date of birth.
                                        </li>
                                    </ul>
                                    <p>
                                        The list of identity documents are provided below.
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            {{-- Group A Documents --}}
                            <div class="col-md-6">
                                <div class="form-group border p-4 border-width-2 border-dark">
                                    <p><strong>Group A Documents:</strong></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="first_option" id="option1"
                                               value="passport" {{ old('first_option', $documentUpload->first_option) == 'passport' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option1">
                                            A passport that is signed, current, and valid
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="first_option" id="option2"
                                               value="dvlaLicence" {{ old('first_option', $documentUpload->first_option) == 'dvlaLicence' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option2">
                                            A driving licence photocard issued by the Driver and Vehicle Licensing
                                            Agency (DVLA) in the UK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="first_option" id="option3"
                                               value="dvaLicence" {{ old('first_option', $documentUpload->first_option) == 'dvaLicence' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option3">
                                            A driving licence photocard and its paper counterpart issued by the Driver
                                            and Vehicle Agency (DVA) in Northern Ireland
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="first_option" id="option4"
                                               value="birthCertificate" {{ old('first_option', $documentUpload->first_option) == 'birthCertificate' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option4">
                                            A UK original birth certificate issued within 12 months of birth
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="first_option" id="option5"
                                               value="residencePermit" {{ old('first_option', $documentUpload->first_option) == 'residencePermit' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option5">
                                            A UK biometric residence permit card
                                        </label>
                                    </div>
                                    @error('first_option')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-check-label" for="option5">
                                            <strong>Group A Front Side Document</strong>
                                        </label>
                                        <input type="file" class="filepond" name="first_front_upload" data-filepond>
                                        @error('first_front_upload')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-check-label" for="option5">
                                            <strong>Group A Back Side Document</strong>
                                        </label>
                                        <input type="file" class="filepond" name="first_back_upload" data-filepond>
                                    </div>
                                </div>
                            </div>


                            {{-- Group B Documents --}}
                            <div class="col-md-6">
                                <div class="form-group border p-4 border-width-2 border-dark">
                                    <p><strong>Group B Documents:</strong></p>
                                    <p>Documents that confirm your identity and your address.</p>
                                    <p>Note: 2 forms of the same type of document will not be accepted (e.g. we will not
                                        accept 2 council tax statements).
                                        We will only accept 1 council tax statement and 1 document of a different type.
                                    </p>
                                    <div class="form-group">
                                        <label for="documentOptions">Choose your documents:</label>

                                        @php
                                            $secondOption = old('second_option', explode(',', $documentUpload->second_option ?? ''));
                                        @endphp

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option6" value="bankStatement"
                                                {{ is_array($secondOption) && in_array('bankStatement', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option6">
                                                A bank or building society statement from the last 3 months (we will
                                                accept 2 statements, but only if they are from different banks or
                                                building societies)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option7" value="utilityBill"
                                                {{ is_array($secondOption) && in_array('utilityBill', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option7">
                                                A utility bill (for example: gas, electric, telephone, water, satellite
                                                TV or cable TV) from the last 3 months
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option8" value="creditCardStatement"
                                                {{ is_array($secondOption) && in_array('creditCardStatement', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option8">
                                                A credit card statement from the last 3 months (we will accept 2
                                                statements, but only if they are from different credit-card providers)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option9" value="councilTaxStatement"
                                                {{ is_array($secondOption) && in_array('councilTaxStatement', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option9">
                                                A council tax statement from the last 12 months
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option10" value="mortgageStatement"
                                                {{ is_array($secondOption) && in_array('mortgageStatement', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option10">
                                                A mortgage statement from the last 12 months
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option11" value="officialLetter"
                                                {{ is_array($secondOption) && in_array('officialLetter', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option11">
                                                A letter from the last 3 months from any of the following:
                                                <ul>
                                                    <li>HM Revenue and Customs</li>
                                                    <li>The Department of Work and Pensions</li>
                                                    <li>A Jobcentre Plus – or any other employment service</li>
                                                    <li>A local authority</li>
                                                </ul>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option12" value="taxStatement"
                                                {{ is_array($secondOption) && in_array('taxStatement', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option12">
                                                A P45 or P60 tax statement from the last 12 months
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option13" value="paperDrivingLicence"
                                                {{ is_array($secondOption) && in_array('paperDrivingLicence', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option13">
                                                A paper version of a current UK driving licence (not the paper
                                                counterpart to a photocard)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option14" value="dvaLicencePhotocard"
                                                {{ is_array($secondOption) && in_array('dvaLicencePhotocard', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option14">
                                                A driving licence photocard issued by the DVA in Northern Ireland (not
                                                the paper counterpart)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option15" value="pensionStatement"
                                                {{ is_array($secondOption) && in_array('pensionStatement', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option15">
                                                A pension, endowment or ISA statement from the last 12 months
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                   id="option16" value="UKfirearmslicence"
                                                {{ is_array($secondOption) && in_array('UKfirearmslicence', $secondOption) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option16">
                                                A valid UK firearms licence with photo
                                            </label>
                                        </div>

                                        @error('second_option')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <hr>
                                        <div class="form-group">
                                            <label class="form-check-label" for="option5">
                                                <strong>Group B 1st Document Front Side</strong>
                                            </label>
                                            <input type="file" class="filepond" name="second_front_upload"
                                                   data-filepond>
                                            @error('second_front_upload')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-check-label" for="option5">
                                                <strong>Group B 1st Document Back Side</strong>
                                            </label>
                                            <input type="file" class="filepond" name="second_back_upload"
                                                   data-filepond>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-check-label" for="option5">
                                                <strong>Group B 2nd Document Front Side</strong>
                                            </label>
                                            <input type="file" class="filepond" name="third_front_upload"
                                                   data-filepond>
                                            @error('third_front_upload')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-check-label" for="option5">
                                                <strong>Group B 2nd Document Back Side</strong>
                                            </label>
                                            <input type="file" class="filepond" name="third_back_upload"
                                                   data-filepond>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('backend.learner.dashboard') }}" class="btn btn-secondary">
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
    <style>
        .form-group label > span {
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
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js" crossorigin="anonymous"
            referrerpolicy="no-referrer">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            FilePond.registerPlugin(FilePondPluginFileValidateSize, FilePondPluginImagePreview);

            const filepondOptions = {
                maxFileSize: '2MB',
                acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml']
            };

            const firstFrontUpload = FilePond.create(document.querySelector('input[name="first_front_upload"]'), filepondOptions);
            const firstBackUpload = FilePond.create(document.querySelector('input[name="first_back_upload"]'), filepondOptions);
            const secondFrontUpload = FilePond.create(document.querySelector('input[name="second_front_upload"]'), filepondOptions);
            const secondBackUpload = FilePond.create(document.querySelector('input[name="second_back_upload"]'), filepondOptions);
            const thirdFrontUpload = FilePond.create(document.querySelector('input[name="third_front_upload"]'), filepondOptions);
            const thirdBackUpload = FilePond.create(document.querySelector('input[name="third_back_upload"]'), filepondOptions);

            $('#documentUploadHandler').submit(function (e) {
                e.preventDefault();

                const formData = new FormData(this);

                const filePondInstances = [
                    {name: 'first_front_upload', instance: firstFrontUpload},
                    {name: 'first_back_upload', instance: firstBackUpload},
                    {name: 'second_front_upload', instance: secondFrontUpload},
                    {name: 'second_back_upload', instance: secondBackUpload},
                    {name: 'third_front_upload', instance: thirdFrontUpload},
                    {name: 'third_back_upload', instance: thirdBackUpload}
                ];

                filePondInstances.forEach(({name, instance}) => {
                    const files = instance.getFiles();
                    if (files.length > 0) {
                        formData.append(name, files[0].file);
                    } else {
                        formData.delete(name);
                    }
                });

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
                    toastr.error(err.responseJSON.message);
                    button.prop('disabled', false);
                });
            });
        });

    </script>

    <script>
        toastr.options = {
            "closeButton": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        }
    </script>
@endpush
