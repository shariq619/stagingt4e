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
                        <a href="{{ route('backend.learner.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form method="POST" action="{{ route('backend.document-uploads.store') }}"
                        enctype="multipart/form-data" id="documentUploadHandler">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="document_text">
                                    <p>In line with the SIA documentation requirements, we may accept the following
                                        forms of identification:</p>
                                    <ul>
                                        <li>
                                            One (1) identity document from the <strong>Group A</strong> list AND two (2) proofs of address documents from the <strong>Group B</strong> list.
                                        </li>
                                        <li>
                                            Please be advised that we cannot accept 2 of the same type of documents form <strong>Group B</strong> (e.g., we cannot accept 2 council tax statements. The SIA will only accept 1 council tax statement and 1 document of a different type.).
                                        </li>
                                    </ul>
                                    <p>
                                        The acceptable identity document lists for groups A and B are provided below.
                                    </p>
                                </div>

                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif



                        <div class="row">
                            {{-- Group A Documents --}}
                            <div class="col-md-6">
                                <div class="form-group border p-4 border-width-2 border-dark">
                                    <p><strong>Group A Documents:</strong></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="first_option" id="option1"
                                            value="passport" {{ old('first_option') == 'passport' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option1">
                                            Passport
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="first_option" id="option2"
                                            value="dvlaLicence"
                                            {{ old('first_option') == 'dvlaLicence' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option2">
                                            Driving licence issued by the Driver and Vehicle Licensing Agency (DVLA) in the UK or the Driver and Vehicle Agency (DVA) in Northern Ireland
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="first_option" id="option4"
                                            value="birthCertificate"
                                            {{ old('first_option') == 'birthCertificate' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option4">
                                            A UK original birth certificate
                                        </label>
                                    </div>

                                    @error('first_option')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <hr class="border border-dark border-2 my-4">
                                    <div class="form-group">
                                        <h4 class="text-success font-weight-bold">First Front Document</h4>
                                        <label class="form-check-label" for="option5">
                                            <strong>Group A Front Side Document <span class="text-red">*</span></strong>
                                        </label>
                                        <input type="file" name="first_front_upload" id="first_front_upload">
                                        @if ($documents->first_front_upload)
                                            @php $nic_frontUrl = asset($documents->first_front_upload); @endphp
                                        @endif
                                        <img id="first_front_upload_preview" class="imagePreview mt-2" width="150"
                                            src="{{ isset($nic_frontUrl) ? $nic_frontUrl : '#' }}" alt="Image Preview"
                                            style="display:{{ isset($nic_frontUrl) ? 'block' : 'none' }};" />

                                        @error('first_front_upload')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <hr class="border border-dark border-2 my-4">
                                    <div class="form-group">
                                        <h4 class="text-success font-weight-bold">First Back Document</h4>

                                        <label class="form-check-label" for="option5">
                                            <strong>Group A Back Side Document <span class="text-green">(Optional)</span></strong>
                                        </label>
                                        <input type="file" name="first_back_upload" id="first_back_upload">
                                        @if ($documents->first_back_upload)
                                            @php $first_back_uploadUrl = asset($documents->first_back_upload); @endphp
                                        @endif
                                        <img id="first_back_upload_preview" class="imagePreview mt-2" width="150"
                                            src="{{ isset($first_back_uploadUrl) ? $first_back_uploadUrl : '#' }}"
                                            alt="Image Preview"
                                            style="display:{{ isset($first_back_uploadUrl) ? 'block' : 'none' }};" />
                                        @error('first_back_upload')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                id="option6" value="bankStatement"
                                                {{ is_array(old('second_option')) && in_array('bankStatement', old('second_option')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option6">
                                                A bank or building society statement from the last 3 months (we will
                                                accept 2 statements, but only if they are from different banks or
                                                building societies)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                id="option7" value="utilityBill"
                                                {{ is_array(old('second_option')) && in_array('utilityBill', old('second_option')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option7">
                                                A utility bill from the last 3 months (we will accept gas, electric, telephone landline, water, satellite TV or cable TV bills but not mobile phone bills)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                id="option8" value="creditCardStatement"
                                                {{ is_array(old('second_option')) && in_array('creditCardStatement', old('second_option')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option8">
                                                A credit card statement from the last 3 months (we will accept 2 statements, but only if they are from different credit-card providers)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                id="option9" value="councilTaxStatement"
                                                {{ is_array(old('second_option')) && in_array('councilTaxStatement', old('second_option')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option9">
                                                A council tax statement from the last 12 months
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                id="option10" value="mortgageStatement"
                                                {{ is_array(old('second_option')) && in_array('mortgageStatement', old('second_option')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option10">
                                                A mortgage statement from the last 12 months
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="second_option[]"
                                                id="option11" value="officialLetter"
                                                {{ is_array(old('second_option')) && in_array('officialLetter', old('second_option')) ? 'checked' : '' }}>
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
                                                {{ is_array(old('second_option')) && in_array('taxStatement', old('second_option')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="option12">
                                                A P45 or P60 tax statement from the last 12 months
                                            </label>
                                        </div>

                                        <hr class="border border-dark border-2 my-4">
                                        @error('second_option')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <hr>
                                        <div class="form-group">
                                            <h4 class="text-success font-weight-bold">Second Front Document</h4>
                                            <label class="form-check-label" for="option5">
                                                <strong>Group B 1st Document Front Side <span class="text-red">*</span></strong>
                                            </label>
                                            <input type="file" name="second_front_upload" id="second_front_upload">

                                            @if ($documents->second_front_upload)
                                                @php $second_front_uploadUrl = asset($documents->second_front_upload); @endphp
                                            @endif
                                            <img id="second_front_upload_preview" class="imagePreview mt-2" width="150"
                                                src="{{ isset($second_front_uploadUrl) ? $second_front_uploadUrl : '#' }}"
                                                alt="Image Preview"
                                                style="display:{{ isset($second_front_uploadUrl) ? 'block' : 'none' }};" />

                                            @error('second_front_upload')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <hr class="border border-dark border-2 my-4">

                                        <div class="form-group">

                                            <h4 class="text-success font-weight-bold">Second Back Document</h4>

                                            <label class="form-check-label" for="option5">
                                                <strong>Group B 1st Document Back Side <span class="text-green">(Optional)</span></strong>
                                            </label>
                                            <input type="file" name="second_back_upload" id="second_back_upload">
                                            @if ($documents->second_back_upload)
                                                @php $second_back_uploadUrl = asset($documents->second_back_upload); @endphp
                                            @endif
                                            <img id="second_back_upload_preview" class="imagePreview mt-2" width="150"
                                                src="{{ isset($second_back_uploadUrl) ? $second_back_uploadUrl : '#' }}"
                                                alt="Image Preview"
                                                style="display:{{ isset($second_back_uploadUrl) ? 'block' : 'none' }};" />
                                        </div>

                                        <hr class="border border-dark border-2 my-4">

                                        <div class="form-group">

                                            <h4 class="text-success font-weight-bold">Third Front Document</h4>


                                            <label class="form-check-label" for="option5">
                                                <strong>Group B 2nd Document Front Side <span class="text-red">*</span></strong>
                                            </label>
                                            <input type="file" name="third_front_upload" id="third_front_upload">
                                            @if ($documents->third_front_upload)
                                                @php $third_front_uploadUrl = asset($documents->third_front_upload); @endphp
                                            @endif
                                            <img id="third_front_upload_preview" class="imagePreview" width="150"
                                                src="{{ isset($third_front_uploadUrl) ? $third_front_uploadUrl : '#' }}"
                                                alt="Image Preview"
                                                style="display:{{ isset($third_front_uploadUrl) ? 'block' : 'none' }};" />
                                            @error('third_front_upload')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <hr class="border border-dark border-2 my-4">

                                        <div class="form-group">

                                            <h4 class="text-success font-weight-bold">Third Back Document</h4>


                                            <label class="form-check-label" for="option5">
                                                <strong>Group B 2nd Document Back Side <span class="text-green">(Optional)</span></strong>
                                            </label>
                                            <input type="file" name="third_back_upload" id="third_back_upload">
                                            @if ($documents->third_back_upload)
                                                @php $third_back_uploadUrl = asset($documents->third_back_upload); @endphp
                                            @endif
                                            <img id="third_back_upload_preview" class="imagePreview" width="150"
                                                src="{{ isset($third_back_uploadUrl) ? $third_back_uploadUrl : '#' }}"
                                                alt="Image Preview"
                                                style="display:{{ isset($third_back_uploadUrl) ? 'block' : 'none' }};" />
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
                            <button type="submit" class="btn btn-primary">
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
        document.addEventListener('DOMContentLoaded', function() {
            const fileInputs = ['first_front_upload', 'first_back_upload', 'second_front_upload',
                'second_back_upload', 'third_front_upload', 'third_back_upload'
            ];
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

            fileInputs.forEach(inputId => {
                const fileInput = document.getElementById(inputId);
                const previewImgElement = document.getElementById(inputId + '_preview');

                fileInput.addEventListener('change', event => {
                    const file = event.target.files[0];

                    if (file && validImageTypes.includes(file.type)) {
                        const reader = new FileReader();
                        reader.onload = () => {
                            previewImgElement.src = reader.result;
                            previewImgElement.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
@endpush
