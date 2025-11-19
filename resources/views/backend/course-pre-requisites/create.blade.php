@extends('layouts.main')

@section('title', 'Course Pre Requisites')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Course Pre Requisites Upload') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Course Pre Requisites Upload') }}</li>
            <li class="breadcrumb-item active">{{ __('Add') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    {{-- <link href="https://unpkg.com/filepond@^4/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview@^4/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        span.select2-selection.select2-selection--single {
            height: 40px;
        }

        .bgGray {
            background: #919191;
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            padding: 7px 20px;
            border-radius: 5px;
            margin: 30px 0px;
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
                        <a href="{{ route('backend.course-pre-requisites.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form method="POST" action="{{ route('backend.course-pre-requisites.store') }}"
                        enctype="multipart/form-data" >
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="document_text">
                                    <h2>We do require an evidence of a valid First Aid Qualification</h2>
                                    <hr>
                                    <p>In line with the SIA requirements, all delegates must hold a current and valid First
                                        Aid or Emergency First Aid certificate that <strong>meets the requirements of the
                                            Health and Safety (First Aid) Regulations 1981.</strong></p>
                                    <p>The First Aid or Emergency First Aid certificate must be valid for at least 12 months
                                        from the course start date.</p>
                                    <p><strong>Emergency First Aid at Work</strong> - learning outcomes should be covered
                                        <strong>AS MINIMUM</strong>:</p>
                                    <ul>
                                        <li>
                                            Understand the role of the first aider, including reference to:
                                            <ul>
                                                <li>the importance of preventing cross-infection</li>
                                                <li>the need for recording incidents and actions</li>
                                                <li>use of available equipment</li>
                                            </ul>
                                        </li>
                                        <li>Assess the situation and circumstances in order to act safely, promptly and
                                            effectively in an emergency</li>
                                        <li>Administer first aid to a casualty who is unconscious (including seizure)</li>
                                        <li>Administer cardiopulmonary resuscitation and use of an automated external
                                            defibrillator</li>
                                        <li>Administer first aid to a casualty who is choking</li>
                                        <li>Administer first aid to a casualty who is wounded and bleeding</li>
                                        <li>Administer first aid to a casualty who is suffering from shock</li>
                                        <li>Provide appropriate first aid for minor injuries</li>
                                    </ul>
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
                            <div class="col-md-12">
                                <div class="bgGray">Step 1  - Please select your qualification from the options below:</div>
                                <div class="form-group border p-4 border-width-2 border-dark">
                                    <p>If your qualification is not listed, please select "Any other valid first aid qualification.</p>

                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="qualification_type" id="option0" value="external"
                                                    {{ old('qualification_type') == 'external' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="option0">
                                                    External certifications (requiring proof of certification):
                                                </label>
                                            </div>

                                            <ul class="list-unstyled pl-4">
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input certification-option" type="radio" name="certification_id" id="option1" value="1"
                                                            {{ old('certification_id') == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option1">
                                                            Emergency First Aid at Work
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input certification-option" type="radio" name="certification_id" id="option2" value="2"
                                                            {{ old('certification_id') == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option2">
                                                            First Aid at Work
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input certification-option" type="radio" name="certification_id" id="option3" value="3"
                                                            {{ old('certification_id') == 3 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option3">
                                                            Any other valid first aid qualification
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="qualification_type" id="option4" value="internal"
                                                    {{ old('qualification_type') == 'internal' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="option4">
                                                    Other courses within T4E Hub (requiring cohort selection):
                                                </label>
                                            </div>

                                            <ul class="list-unstyled pl-4">
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input internal-option" type="radio" name="certification_id" id="option5" value="1"
                                                            {{ old('certification_id') == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option5">
                                                            Emergency First Aid at Work
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input internal-option" type="radio" name="certification_id" id="option6" value="2"
                                                            {{ old('certification_id') == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option6">
                                                            First Aid at Work
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const qualificationTypeRadios = document.querySelectorAll('input[name="qualification_type"]');
                                        const certificationOptions = document.querySelectorAll('.certification-option');
                                        const internalOptions = document.querySelectorAll('.internal-option');

                                        qualificationTypeRadios.forEach(radio => {
                                            radio.addEventListener('change', function() {
                                                if (this.value === 'external') {
                                                    // Uncheck all internal options and select the first certification option
                                                    internalOptions.forEach(opt => opt.checked = false);
                                                    certificationOptions[0].checked = true;
                                                } else if (this.value === 'internal') {
                                                    // Uncheck all certification options and select the first internal option
                                                    certificationOptions.forEach(opt => opt.checked = false);
                                                    internalOptions[0].checked = true;
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <div class="form-group border p-4 border-width-2 border-dark">

                                    <p class="text-red">If you booked courses within T4E Hub, you can skip this step</p>


                                    <div class="bgGray">Step 2  - Please upload a document to verify your completed First Aid qualification:  </div>
                                    <p>Please upload a document to verify your completed First Aid qualification. Accepted formats include PDF, JPG, or PNG, and the document should clearly show your name, the qualification level, the issuing organisation, and the date of completion.</p>
                                    <p>If you encounter any issues or need assistance, feel free to contact our admin team.</p>
                                    <p>Thank you for your cooperation!</p>



                                    <div class="form-group">

                                        <input type="file" name="course_certificate" id="course_certificate">

                                        @error('course_certificate')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
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
    </style> --}}
@endpush

@push('js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qualificationTypeRadios = document.querySelectorAll('input[name="qualification_type"]');
            const certificationOptions = document.querySelectorAll('.certification-option');
            const internalOptions = document.querySelectorAll('.internal-option');

            qualificationTypeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'external') {
                        // Uncheck all internal options and select the first certification option
                        internalOptions.forEach(opt => opt.checked = false);
                        certificationOptions[0].checked = true;
                    } else if (this.value === 'internal') {
                        // Uncheck all certification options and select the first internal option
                        certificationOptions.forEach(opt => opt.checked = false);
                        internalOptions[0].checked = true;
                    }
                });
            });
        });
    </script>
@endpush
