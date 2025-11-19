@extends('layouts.main')

@section('title', 'Course')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Add Course') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Course') }}</li>
            <li class="breadcrumb-item active">{{ __('Create') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <style>
        /* Select2 Bootstrap 4 compatibility */
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
            line-height: 1.5;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
        }

        .select2-container .select2-selection--multiple {
            min-height: calc(2.25rem + 2px) !important;
        }

        .select2-container .select2-selection__choice {
            margin-top: 0.25rem;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
        }


        .card-body h3 {
            font-size: 1.5em;
        }

        .custom-toggle {
            font-size: 1.2em;
            padding: 10px;
        }

        .custom-toggle input[type="radio"] {
            transform: scale(1.5);
            margin-left: 5px;
        }
    </style>
@endpush

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card carFormWrapper">
                <div class="card-header">
                    {{ __('Form add courses') }}
                </div>
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.courses.create') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Course Name') }}</label>
                                    <input type="text" name="course_name"
                                        class="form-control @error('course_name') is-invalid @enderror"
                                        value="{{ old('course_name') }}" placeholder="Course Name">
                                    @error('course_name')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-5">
                                <label for="course_image">{{ __('Course Image') }} </label>
                                <div class='file-input'>
                                    <input type='file' name="course_image">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>{{ __('Color Code') }}</label>
                                    <input type="color" name="color_code" value="#ff0000"
                                        class="form-control @error('color_code') is-invalid @enderror placeholder=" Color
                                        Code">
                                    @error('color_code')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="bannerImageName">{{ __('Banner Image') }} </label>
                                <div class='file-input'>
                                    <input type='file' name="banner_image">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="category_id">{{ __('Category') }}</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Qualification') }}</label>
                                    <select name="qualification"
                                        class="form-control @error('qualification') is-invalid @enderror">
                                        <option value="">Select Qualification</option>
                                        @foreach ($qualifications as $qualification)
                                            <option value="{{ $qualification->id }}"
                                                {{ old('qualification') == $qualification->id ? 'selected' : '' }}>
                                                {{ $qualification->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('qualification')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Key Information') }} </label>
                                    <textarea name="key_information" id="key_information" class="form-control">{{ old('key_information') }}</textarea>
                                    @error('key_information')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Requirements') }} </label>
                                    <textarea name="requirements" id="requirements" class="form-control">{{ old('requirements') }}</textarea>
                                    @error('requirements')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Course Structure') }} </label>
                                    <textarea name="course_structure" id="course_structure" class="form-control">{{ old('course_structure') }}</textarea>
                                    @error('course_structure')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Banner Description') }} <span class="text-red">*</span></label>
                                    <textarea name="banner_description" id="banner_description" class="form-control">{{ old('banner_description') }}</textarea>
                                    @error('banner_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Description') }} <span class="text-red">*</span></label>
                                    <textarea name="description"  class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Price') }} <span class="text-red">*</span></label>
                                    <input type="text" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="Price">
                                    @error('price')
                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Duration') }}</label>
                                    <input type="text" name="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        placeholder="Date or Time"
                                        value="{{old('duration')}}">
                                    @error('duration')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Certification') }}</label>
                                    <div class="certificationWrapper d-flex align-items-center">
                                        <div class="certification mr-3" id="external">
                                            <label>{{ __('External') }}</label>
                                            <input type="radio" name="certification[]" value="External"
                                                {{ is_array(old('certification')) && in_array('External', old('certification')) ? 'checked' : '' }}>
                                        </div>
                                        <div class="certification" id="enternal">
                                            <label>{{ __('Internal') }}</label>
                                            <input type="radio" name="certification[]" value="Internal"
                                                {{ is_array(old('certification')) && in_array('Internal', old('certification')) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    @error('certification')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div id="awarding_bodies" class="form-group" style="display: none;">
                                    <label>{{ __('Awarding Bodies') }}</label>
                                    <div class="awardingBodies">
                                        <select name="awarding_bodies"
                                            class="form-control @error('awarding_bodies') is-invalid @enderror">
                                            @foreach ($awardingBodies as $awardingBody)
                                                <option value="">Select Awarding Body</option>
                                                <option value="{{ $awardingBody->id }}"
                                                    {{ old('awarding_bodies') == $awardingBody->id ? 'selected' : '' }}>
                                                    {{ $awardingBody->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('awarding_bodies')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exam">{{ __('Exams') }} <span class="text-red">*</span></label>
                                    <select name="exams[]" id="exam" class="form-control" multiple>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}">
                                                {{ $exam->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('exam')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Delivery Mode') }}</label>
                                    <select name="delivery_mode"
                                        class="form-control @error('delivery_mode') is-invalid @enderror">
                                        @foreach (config('course_settings.delivery_modes') as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('delivery_mode') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('delivery_mode')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Course Type') }}</label>
                            <select name="course_type" class="form-control @error('course_type') is-invalid @enderror">
                                @foreach (config('course_settings.course_types') as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ old('course_type') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="card mb-4" id="classroom_based_courses">
                            <div class="card-header bg-secondary text-white">Specify Tasks for Learners to Complete
                                Online
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Course Work</h3>
                                        @foreach ($coursesCourseWork as $coursework)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="{{ Str::slug($coursework->name) }}" name="tasks[]"
                                                    value="{{ $coursework->id }}">
                                                <label class="form-check-label"
                                                    for="{{ Str::slug($coursework->name) }}">{{ $coursework->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Reminders</h3>

                                        @foreach ($coursesReminders as $reminders)
                                            <input type="hidden" name="tasks[]" value="{{ $reminders->id }}">
                                        @endforeach

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="CourseStartDatereminder"
                                                value="Course Start Date reminder" checked disabled>
                                            <label class="form-check-label" for="CourseStartDatereminder">Course Start
                                                Date reminder<span class="text-red">*</span></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="OutstandingTasksreminder"
                                                value="Outstanding Tasks reminder" checked disabled>
                                            <label class="form-check-label" for="OutstandingTasksreminder">Outstanding
                                                Tasks reminder<span class="text-red">*</span></label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                id="qualificationExpireReminder" value="Qualification Expire Reminder"
                                                checked disabled>
                                            <label class="form-check-label"
                                                for="qualificationExpireReminder">Qualification
                                                Expire Reminder<span class="text-red">*</span></label>
                                        </div>

                                        <h3 class="mt-4">Post Completion</h3>

                                        @foreach ($coursesPostCompletion as $postCompletion)
                                            <input type="hidden" name="tasks[]" value="{{ $postCompletion->id }}">
                                        @endforeach

                                        @foreach ($coursesPostCompletion as $postCompletion)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked disabled
                                                    id="{{ Str::slug($postCompletion->name) }}" name="tasks[]"
                                                    value="{{ $postCompletion->id }}">
                                                <label class="form-check-label"
                                                    for="{{ Str::slug($postCompletion->name) }}">{{ $postCompletion->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3" id="prerequisites-section">
                            <div class="card-header bg-secondary text-white">Course Pre-Requisites</div>
                            <div class="card-body">

                                <div class="card-body">
                                    <h3 style="display: inline; margin-right: 10px; font-size: 1.5em;">Qualification
                                        Type</h3>
                                    <label class="custom-toggle"
                                        style="display: inline; font-size: 1.2em; padding: 10px;">
                                        Internal
                                        <input type="checkbox" id="internal" name="qualification_type[]"
                                            value="internal" style="transform: scale(1.5); margin-left: 5px;">
                                    </label>
                                    <label class="custom-toggle"
                                        style="display: inline; font-size: 1.2em; padding: 10px;">
                                        External
                                        <input type="checkbox" id="externalType" name="qualification_type[]"
                                            value="external" style="transform: scale(1.5); margin-left: 5px;">
                                    </label>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="external">
                                            <h3>External certifications (requiring proof of certification):</h3>
                                            @foreach ($certifications as $certification)
                                                <div class="form-check">
                                                    {{ $certification->name }}
                                                </div>
                                            @endforeach
                                        </div>

                                        <br>

                                        <div class="internal">
                                            <h3>Other courses within T4E Hub (requiring to select cohort):</h3>
                                            @foreach ($certifications->reject(function ($certification) {
            return $certification->id == 3;
        }) as $certification)
                                                <div class="form-check">
                                                    {{ $certification->name }}
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3" id="licenses-section">
                            <div class="card-header bg-secondary text-white">Assign E-learning Licence(s)</div>
                            <div class="card-body">
                                <div class="row">
                                    @php
                                        $totalLicenses = $licenses->count();
                                        $columnSize = ceil($totalLicenses / 3); // Calculate number of licenses per column
                                    @endphp

                                    @for ($i = 0; $i < 3; $i++)
                                        @php
                                            $start = $i * $columnSize;
                                            $end = min($start + $columnSize, $totalLicenses);
                                        @endphp

                                        <div class="col-md-4">
                                            @foreach ($licenses->slice($start, $end - $start) as $license)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="licences[]"
                                                        id="licence_{{ $license->id }}" value="{{ $license->id }}">
                                                    <label class="form-check-label"
                                                        for="licence_{{ $license->id }}">{{ $license->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endfor
                                </div>

                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="form-group">
                                <label>{{ __('Long Description') }}</label>
                                <textarea name="long_desc" id="long_desc" class="form-control">{{ old('long_desc') }}</textarea>
                                @error('long_desc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="card mt-3 p-2">
                            <h2>Add FAQ's</h2>

                            <div class="fqsMain">
                                <div class="fqsWrapper">
                                    <div class="faqInner">
                                        <div class="faqs-container">
                                            <div class="faq-item">
                                                <div class="form-group">
                                                    <label for="faqs[0][question]">Question</label>
                                                    <input type="text" name="faqs[0][question]" class="form-control"
                                                        placeholder="Enter question">
                                                </div>
                                                <div class="form-group">
                                                    <label for="faqs[0][answer]">Answer</label>
                                                    <textarea name="faqs[0][answer]" class="form-control" placeholder="Enter answer"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger remove-faq"><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="mt-4 add-faq btn btn-success"><i
                                        class="fas fa-plus"></i>Add
                                    Faq
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('backend.courses.index') }}" class="btn btn-secondary">
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
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.0/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            let faqIndex = 1; // Initial FAQ index

            // Add FAQ dynamically
            $(document).on('click', '.add-faq', function() {
                // Check if all FAQ are removed, reset faqIndex to 1 if no FAQ exist
                if ($('.faqInner').length === 0) {
                    faqIndex = 1; // Reset to 1 if no FAQ exists
                }

                // Create new FAQ HTML
                const newFaq = `
                    <div class="faqInner">
                        <div class="faqs-container">
                            <div class="faq-item">
                                <div class="form-group">
                                    <label for="faqs[${faqIndex}][question]">Question</label>
                                    <input type="text" name="faqs[${faqIndex}][question]" class="form-control" placeholder="Enter question">
                                </div>
                                <div class="form-group">
                                    <label for="faqs[${faqIndex}][answer]">Answer</label>
                                    <textarea name="faqs[${faqIndex}][answer]" class="form-control" placeholder="Enter answer"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger remove-faq"><i class="fas fa-times"></i></button>
                    </div>
                `;
                // Append the new FAQ
                $('.fqsWrapper').append(newFaq);

                // Increment faqIndex for next FAQ
                faqIndex++;
            });

            // Remove FAQ dynamically
            $('.fqsWrapper').on('click', '.remove-faq', function() {
                const faqItem = $(this).closest('.faqInner');
                const questionInput = faqItem.find('input[name*="question"]');
                const answerInput = faqItem.find('textarea[name*="answer"]');
                const question = questionInput.val().trim();
                const answer = answerInput.val().trim();

                // Only remove FAQ if question or answer exists
                if (question || answer) {
                    faqItem.remove();
                    faqIndex--; // Decrement faqIndex when FAQ is removed
                }

                // Reset faqIndex to 1 when no FAQs are present
                if ($('.faqInner').length === 0) {
                    faqIndex = 1; // Reset the index when all FAQs are removed
                }
            });
        });
    </script>




    <script>
        tinymce.init({
            selector: 'textarea#key_information',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        tinymce.init({
            selector: 'textarea#requirements',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        tinymce.init({
            selector: 'textarea#course_structure',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        tinymce.init({
            selector: 'textarea#banner_description',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        tinymce.init({
            selector: 'textarea#long_desc',
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
        // tinymce.init({
        //     selector: 'textarea#description',
        //     plugins: 'code table lists',
        //     toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        // });
    </script>
    <script>
        $('#category_id').change(function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/backend/courses/get-subcategories/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#sub_category_id').empty().append(
                            '<option value="">Select Subcategory</option>');
                        $.each(data, function(subcategoryId, subcategoryName) {
                            $('#sub_category_id').append('<option value="' + subcategoryId +
                                '">' + subcategoryName + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_category_id').empty().append('<option value="">Select Category First</option>');
            }
        });
    </script>
    <script src="{{ asset('admin') }}/plugins/select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#exam').select2();

            $("#external").click(function() {
                $("#awarding_bodies").show()
            });
            $("#enternal").click(function() {
                $("#awarding_bodies").hide()
            });
        });


        $(document).ready(function() {

            $('#licenses-toggle').bootstrapToggle();

            $('#licenses-toggle').change(function() {
                $('#licenses-section').toggle(this.checked);
            });
        });


        // document.addEventListener('DOMContentLoaded', function () {
        //     // Get radio buttons and sections
        //     const internalRadio = document.getElementById('internal');
        //     const externalRadio = document.getElementById('externalType');
        //     const internalDiv = document.querySelector('.internal');
        //     const externalDiv = document.querySelector('.external');
        //
        //     function toggleSections() {
        //         if (internalRadio.checked) {
        //             internalDiv.style.display = 'block'; // Show internal section
        //             externalDiv.style.display = 'none'; // Hide external section
        //         } else if (externalRadio.checked) {
        //             internalDiv.style.display = 'none'; // Hide internal section
        //             externalDiv.style.display = 'block'; // Show external section
        //         }
        //     }
        //
        //     // Event listeners for radio buttons
        //     internalRadio.addEventListener('change', toggleSections);
        //     externalRadio.addEventListener('change', toggleSections);
        //
        //     // Run toggle on page load to ensure correct section is displayed initially
        //     toggleSections();
        // });
    </script>
@endpush
