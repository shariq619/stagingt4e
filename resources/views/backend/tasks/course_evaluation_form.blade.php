@php use App\Models\Course; @endphp
@extends('layouts.main')


@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <style>
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
    </style>
@endpush

@section('title', 'User')
@section('main')
    <div class="formWrapper">
        <div class="row">
            <form action="{{ route('backend.task.submission') }}" method="POST" id="submitForm" enctype="multipart/form-data"
                style="width:100%;">
                @csrf

                @php
                    $username = auth()->user()->name;
                @endphp
                <div class="col-12">
                    <div class="form-step" id="step-1" data-step="1">

                        <div class="row headerDetail">
                            <div class="col-6">
                                <h1>Course Evaluation Form</h1>
                            </div>
                        </div>
                        <input type="hidden" name="task_name" value="{{ $task->name }}" />
                        <input type="hidden" name="task_id" value="{{ $task->id }}" />
                        <input type="hidden" name="course_id" value="{{ $course_id }}" />
                        <input type="hidden" name="cohort_id" value="{{ $cohort_id }}" />
                        <input type="hidden" name="trainer_id" value="{{ $trainer_id }}" />


                        <div class="studyAssessment">
                            <div class="row">
                                <div class="col-12">
                                    <div class="devider"></div>
                                    <p>Dear {{ auth()->user()->name }} {{ auth()->user()->last_name }},</p>
                                    <p>Thank you for the time you are taking to complete this evaluation. Your answers
                                        will help improve the content of our courses. All answers will be held in the
                                        strictest confidentiality.
                                    </p>
                                    <p>Thank you in advance. <br> Sincerely your,</p>
                                    <div class="devider"></div>
                                </div>
                            </div>
                        </div>

                        @php
                            $radioImgSimplePath = public_path('images/logo_with_details.PNG');
                            $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
                            $radioImgSimpleSrc =
                                'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
                        @endphp
                        <div>
                            <img src="{{ $radioImgSimpleSrc }}" style="width:10%;" alt="">
                        </div>

                        <br></br>

                        <button type="button" class="next-btn btn btn-primary" id="next-1">Start</button>
                    </div>

                    <div class="form-step" id="step-2" data-step="2">
                        <div class="studyAssessment">
                            <h2>Rate Your Course</h2>

                            <input type="hidden" name="data[username]" class="form-control" value="{{ $username }}"
                                readonly>

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Training centre') }}</label>
                                        <input type="text" name="data[Q1. Training centre]" class="form-control"
                                            value="{{ $cohort_info->venue->venue_name ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>{{ __('Course Date') }}</label>
                                            <input type="text" id="training_provider" name="data[Q2. Course Date]"
                                                class="form-control" value="{{ $cohort_info->start_date_time ?? '' }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Course attended') }}</label>
                                        <input type="text" name="data[Q3. Course attended]" class="form-control"
                                            value="{{ $cohort_info->course->name }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group bgBoxGray">
                                        <label>Did the course meet your expectations?</label>
                                        <div class="d-flex">
                                            <input type="radio" name="data[Q4. Did the course meet your expectations?][]"
                                                value="Yes" />
                                            <label class="mb-0 ml-2">Yes</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="radio" name="data[Q4. Did the course meet your expectations?][]"
                                                value="No" />
                                            <label class="mb-0 ml-2">No</label>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Did the course meet your expectations?</label>
                                        <table border="1" cellpadding="10" cellspacing="0"
                                            style="width: 100%; text-align: center;">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Excellent</th>
                                                    <th>Very Good</th>
                                                    <th>Good</th>
                                                    <th>Fair</th>
                                                    <th>Poor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Exercise and Practical Training</td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Exercise and Practical Training][]"
                                                            value="Excellent"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Exercise and Practical Training][]"
                                                            value="Very Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Exercise and Practical Training][]"
                                                            value="Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Exercise and Practical Training][]"
                                                            value="Fair"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Exercise and Practical Training][]"
                                                            value="Poor"></td>
                                                </tr>
                                                <tr>
                                                    <td>Presentation and Course Materials</td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                            value="Excellent"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                            value="Very Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                            value="Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                            value="Fair"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                            value="Poor"></td>
                                                </tr>
                                                <tr>
                                                    <td>Use of Class Time</td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                            value="Excellent"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                            value="Very Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                            value="Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                            value="Fair"></td>
                                                    <td><input type="radio"
                                                            name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                            value="Poor"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>How would you rate your Overall impressions?</label>
                                        <table border="1" cellpadding="10" cellspacing="0"
                                            style="width: 100%; text-align: center;">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Excellent</th>
                                                    <th>Very Good</th>
                                                    <th>Good</th>
                                                    <th>Fair</th>
                                                    <th>Poor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Joining Instructions/ Pre-Course Materials</td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Joining Instructions/ Pre-Course Materials][]"
                                                            value="Excellent"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Joining Instructions/ Pre-Course Materials][]"
                                                            value="Very Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Joining Instructions/ Pre-Course Materials][]"
                                                            value="Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Joining Instructions/ Pre-Course Materials][]"
                                                            value="Fair"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Joining Instructions/ Pre-Course Materials][]"
                                                            value="Poor"></td>
                                                </tr>
                                                <tr>
                                                    <td>Members of Staff (other than Trainer)</td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                            value="Excellent"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                            value="Very Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                            value="Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                            value="Fair"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                            value="Poor"></td>
                                                </tr>
                                                <tr>
                                                    <td>Venue/Facilities</td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities)][]"
                                                            value="Excellent"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities)][]"
                                                            value="Very Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities)][]"
                                                            value="Good"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities)][]"
                                                            value="Fair"></td>
                                                    <td><input type="radio"
                                                            name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities)][]"
                                                            value="Poor"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Do you feel there was any areas that we could improve?</label>
                                        <div class="d-flex">
                                            <input type="radio"
                                                name="data[Q7. Do you feel there was any areas that we could improve?)][]"
                                                value="Yes" />
                                            <label class="mb-0 ml-2">Yes</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="radio"
                                                name="data[Q7. Do you feel there was any areas that we could improve?)][]"
                                                value="No" />
                                            <label class="mb-0 ml-2">No</label>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>What did you enjoy most about the course?</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea name="data[Q8. What did you enjoy most about the course?]" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Q5. Any Further Notes/Comments?</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea name="data[Q9. Any Further Notes/Comments?]" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="prev-btn btn bg-gray">Previous</button>
                        <button type="button" class="next-btn btn btn-primary" id="next-2" disabled>Next</button>
                    </div>

                    <div class="form-step" id="step-3" data-step="3">
                        <div class="form-group">
                            <label>{{ __('Trainers Name') }}</label>
                            <input type="text" name="data[Q10. Trainers Name]" class="form-control"
                                value="{{ $cohort_info->trainer->name }}" readonly>
                        </div>
                        <div class="form-group bgBoxGray">
                            <label>How would you rate the trainer's performance?</label>
                            <table border="1" cellpadding="10" cellspacing="0"
                                style="width: 100%; text-align: center;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Excellent</th>
                                        <th>Very Good</th>
                                        <th>Good</th>
                                        <th>Fair</th>
                                        <th>Poor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Knowledge of Subject Matter</td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Knowledge of Subject Matter][]"
                                                value="Excellent"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Knowledge of Subject Matter][]"
                                                value="Very Good"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Knowledge of Subject Matter][]"
                                                value="Good"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Knowledge of Subject Matter][]"
                                                value="Fair"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Knowledge of Subject Matter][]"
                                                value="Poor"></td>
                                    </tr>
                                    <tr>
                                        <td>Overall Trainer Rating</td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                value="Excellent"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                value="Very Good"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                value="Good"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                value="Fair"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                value="Poor"></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Delivery Skills</td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                value="Excellent"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                value="Very Good"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                value="Good"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                value="Fair"></td>
                                        <td><input type="radio"
                                                name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                value="Poor"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group bgBoxGray">
                            <label>Any Further Notes/Comments about your Trainer?</label>
                            <div class="row">
                                <div class="col-12">
                                    <textarea name="data[Q12. Any Further Notes/Comments about your Trainer?][]" id="" cols="30"
                                        rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="prev-btn btn bg-gray">Previous</button>
                        <button type="button" class="next-btn btn btn-primary" id="next-3" disabled>Next</button>
                    </div>

                    <div class="form-step" id="step-4" data-step="4">


                        <div class="form-group bgBoxGray">
                            <label>Would you recommend this course to others?</label>
                            <div class="d-flex">
                                <input type="radio" name="data[Q13. Would you recommend this course to others?][]"
                                    value="Yes" />
                                <label class="mb-0 ml-2">Yes</label>
                            </div>
                            <div class="d-flex">
                                <input type="radio" name="data[Q13. Would you recommend this course to others?][]"
                                    value="No" />
                                <label class="mb-0 ml-2">No</label>
                            </div>
                        </div>

                        <div class="form-group bgBoxGray">
                            <label>Would you take another course by the Training4Employment?</label>
                            <div class="d-flex">
                                <input type="radio"
                                    name="data[Q14. Would you take another course by the Training4Employment?][]"
                                    value="Yes" />
                                <label class="mb-0 ml-2">Yes</label>
                            </div>
                            <div class="d-flex">
                                <input type="radio"
                                    name="data[Q14. Would you take another course by the Training4Employment?][]"
                                    value="No" />
                                <label class="mb-0 ml-2">No</label>
                            </div>
                            <div class="d-flex">
                                <input type="radio"
                                    name="data[Q14. Would you take another course by the Training4Employment?][]"
                                    value="Maybe" />
                                <label class="mb-0 ml-2">Maybe</label>
                            </div>
                        </div>

                        @php

                            $courses = Course::with('category')->get();


                        @endphp

                        <div class="form-group">
                            <label>{{ __('Please state which course you would be interested in') }}</label>
                            <select id="courses" multiple name="data[Q15. Please state which course you would be interested in][]" class="form-control" required>

                                @foreach ($courses as $course)
                                    <option value="{{ $course->name }}" {{ $cohort_info->course->name == $course->name ? 'selected' : '' }}>
                                        {{ $course->name }} ({{ $course->category->name ?? "" }})
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <button type="button" class="prev-btn btn bg-gray">Previous</button>
                        <button class="btn btn-primary btn-primary" id="previewButton" data-toggle="modal"
                            data-target="#deletePreviewApp">
                            <i class="fas fa-eye mr-2"></i>
                            {{ __('Save and Preview') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="deletePreviewApp" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="min-width: 75% !important;">
            <div id="loadingSpinner" style="display: none; text-align: center;">
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoleLabel">{{ __('Preview Application') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_body">
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

        .imageRow .col-6 {
            text-align: center;
        }

        .imageRow .col-6 img {
            display: block;
            margin: auto;
        }

        .imageRow button.btnImage {
            background: #3b1d8f;
            color: #fff;
            transform: translate(0px, -10px);
        }

        .imageRow button.btnImage i {
            margin-left: 6px;
        }

        .darkBox {
            background: #606060;
            display: inline-block;
            color: #fff;
            padding: 25px 25px;
            border-radius: 7px;
        }

        .darkBox h5 {
            font-size: 29px;
        }

        .sectionBorder>h4.bgHeadLight {
            background: #428bca;
            color: #fff;
            border-radius: 8px;
            padding: 15px 15px;
            font-weight: 600;
        }

        .bgLightTxt {
            background: #d9edf7;
            padding: 15px 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .bgLightTxt p>strong small {
            font-weight: bold !important;
        }

        .formWrapper textarea {
            width: 100%;
            resize: none;
            border-radius: 10px;
            padding: 15px;
        }

        .content-wrapper {
            background: #fff;
        }

        .formWrapper {
            padding: 10px 10px;
            border: solid 1px #cccc;
            border-radius: 10px;
        }

        .formWrapper .headerDetail h1 {
            color: #3b1d8f;
            font-weight: 600;
        }

        .formWrapper h2 {
            font-weight: 600;
        }

        h4.bgStrip {
            background: #3b1d8f;
            color: #fff;
            padding: 15px 15px;
            border-radius: 8px;
        }

        .sectionBorder {
            border: solid 1px #cccc;
            border-radius: 10px;
            padding: 20px;
        }

        .bgBoxGray {
            background: #f7f6f6;
            border: solid 1px #00000070;
            padding: 20px;
            border-radius: 10px;
        }

        .bgBoxGray>label {
            color: #3b1d8f;
        }

        .bgBoxGray>label>span {
            font-weight: 400;
        }
    </style>
@endpush

@push('js')


    <script src="{{ asset('admin') }}/plugins/select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#courses').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            function checkFormCompletion(step) {
                var isValid = true;
                // Check all required inputs in the current step
                $('#step-' + step).find('input[required], textarea[required]').each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                    }
                });

                $('#step-' + step).find('input[type="radio"][required]').each(function() {
                    var name = $(this).attr('name');
                    if (!$('input[name="' + name + '"]:checked').length) {
                        isValid = false;
                    }
                });

                // Enable or disable the next button based on form validation
                $('#next-' + step).prop('disabled', !isValid);
            }

            // Monitor input fields in each step
            $('#step-1 input').on('input', function() {
                checkFormCompletion(1);
            });

            $('#step-2 input').on('input', function() {
                checkFormCompletion(2);
            });

            $('#step-3 input').on('input', function() {
                checkFormCompletion(3);
            });

            $('#step-4 input').on('input', function() {
                checkFormCompletion(4);
            });

            // Initially hide all steps except the first one
            $('.form-step').hide();
            $('#step-1').show();

            // Navigate to the next step
            $('.next-btn').click(function() {
                var currentStep = $(this).closest('.form-step');
                var nextStep = currentStep.next('.form-step');

                if (nextStep.length) {
                    currentStep.hide();
                    nextStep.show();
                }
            });

            // Navigate to the previous step
            $('.prev-btn').click(function() {
                var currentStep = $(this).closest('.form-step');
                var prevStep = currentStep.prev('.form-step');

                if (prevStep.length) {
                    currentStep.hide();
                    prevStep.show();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '#previewButton', function(e) {
                e.preventDefault();

                function validateForm() {
                    let isValid = true;

                    $('.requiredRole input, .requiredRole textarea').each(function() {
                        if ($(this).val().trim() === '') {
                            isValid = false;
                            $(this).addClass('is-invalid');
                            $(this).next('.invalid-feedback').remove();
                            $(this).after(
                                '<div class="invalid-feedback">This field is required.</div>');
                        } else {
                            $(this).removeClass('is-invalid');
                            $(this).next('.invalid-feedback').remove();
                        }
                    });

                    $('.validList').each(function() {
                        let groupIsValid = true;

                        $(this).find('input').each(function() {
                            if ($(this).val().trim() === '') {
                                groupIsValid = false;
                                $(this).addClass('is-invalid');
                                $(this).next('.invalid-feedback')
                                    .remove();
                                $(this).after(
                                    '<div class="invalid-feedback">This field is required.</div>'
                                );
                            } else {
                                $(this).removeClass('is-invalid');
                                $(this).next('.invalid-feedback').remove();
                            }
                        });

                        if (!groupIsValid) {
                            isValid = false;
                        }
                    });


                    return isValid;
                }

                const form = document.getElementById('submitForm');
                const formData = new FormData(form);
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


                $.ajax({
                    method: "POST",
                    url: "{{ route('backend.task.preview') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(data) {
                        if (data.html) {
                            var iframe = document.getElementById('pdfPreview');
                            iframe.contentWindow.document.open();
                            iframe.contentWindow.document.write(data.html);
                            iframe.contentWindow.document.close();
                            $('#pdfPreview').show();
                        }
                        $('#PreviewApp').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {

            // var getSelectedValue = document.querySelector( 'input.yes:checked');

            $(document).on('click', '#modalFormHandler', function() {
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
                        // console.log(response.message);
                        button.prop('disabled', false);
                        form[0].reset();
                        $('#PreviewApp').modal('hide');
                        $('#loadingSpinner').hide();
                        window.location = '{{ route('backend.learner.dashboard') }}';
                    })
                    .catch(function(err) {
                        console.error(err);
                        $('#loadingSpinner').hide();
                        button.prop('disabled', false);
                    });
            });
        });
    </script>
@endpush
