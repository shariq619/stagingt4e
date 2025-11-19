@extends('layouts.main')

@section('title', 'Course Pre Requisites')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('change Course Pre Requisites') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Course Pre Requisites') }}</li>
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
                        <a href="{{ route('backend.course-pre-requisites.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
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
                    <form action="{{ route('backend.course-pre-requisites.update', $preRequisites->id) }}" method="POST"
                        enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')



                        <div class="row">
                            <div class="col-md-12">


                                <div class="bgGray">Step 1  - Please select your qualification from the options below:</div>
                                <div class="form-group border p-4 border-width-2 border-dark">
                                    <p>If your qualification is not listed, please select "Any other valid first aid qualification.</p>

                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="qualification_type" id="option0" value="external"
                                                    {{ $preRequisites->qualification_type == 'external' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="option0">
                                                    External certifications (requiring proof of certification):
                                                </label>
                                            </div>

                                            <ul class="list-unstyled pl-4">
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input certification-option" type="radio" name="certification_id" id="option1" value="1"
                                                            {{ $preRequisites->certification_id == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option1">
                                                            Emergency First Aid at Work
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input certification-option" type="radio" name="certification_id" id="option2" value="2"
                                                            {{ $preRequisites->certification_id == 2 ? 'checked' : '' }}>
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
                                                    {{ $preRequisites->qualification_type == 'internal' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="option4">
                                                    Other courses within T4E Hub (requiring cohort selection):
                                                </label>
                                            </div>

                                            <ul class="list-unstyled pl-4">
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input internal-option" type="radio" name="certification_id" id="option5" value="1"
                                                            {{ $preRequisites->certification_id == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option5">
                                                            Emergency First Aid at Work
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input internal-option" type="radio" name="certification_id" id="option6" value="2"
                                                            {{ $preRequisites->certification_id == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="option6">
                                                            First Aid at Work
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group border p-4">
                                            <img src="{{ asset($preRequisites->course_certificate) }}" width="200" height="200"  >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group border p-4 border-width-2 border-dark">



                                    <div class="form-group">
                                        <label class="form-check-label" for="option5">
                                            <strong>Please update your Course Pre Requisites</strong>
                                        </label>
                                        <input type="file" class="filepond" name="course_certificate" data-filepond>
                                        @error('course_certificate')
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
                            <a href="{{ route('backend.course-pre-requisites.index') }}" class="btn btn-secondary">
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



@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
            integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
