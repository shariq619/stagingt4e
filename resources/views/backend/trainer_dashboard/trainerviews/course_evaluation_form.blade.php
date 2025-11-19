@extends('layouts.main')

@section('title', 'User')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css"
          integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .bgBoxGray .d-flex > label {
            font-weight: 400;
        }

        .d-flex.correctAns {
            background: #28a745;
            padding: 6px 12px;
            display: inline-block !important;
            margin: 5px 0px;
            border-radius: 10px;
        }

        .correctAns label {
            color: #fff;
        }

        .radioDiv {
            padding: 6px 12px;
        }

        .bg-purple {
            background-color: #4b0082; /* Use the purple shade from your image */
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

        .sectionBorder > h4.bgHeadLight {
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

        .bgLightTxt p > strong small {
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
            background: #919191;
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

        .bgBoxGray > label {
            color: #3b1d8f;
        }

        .bgBoxGray > label > span {
            font-weight: 400;
        }

        .toggle-btn {
            width: 40px;
            height: 40px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2em;
        }
    </style>
@endpush

@section('main')
    <div class="formWrapper">
        <div class="row">



                <div class="col-12">



                    @php
                        $learner_response = json_decode($learner_response, true);


                        $username = $learner_response['data']["username"] ?? '';
                        $Q2 = $learner_response['data']["Q2. Course Date"] ?? '';
                        $Q10 = $learner_response['data']["Q10. Trainers Name"] ?? '';
                        $Q1 = $learner_response['data']["Q1. Training centre"] ?? '';
                        $Q3 = $learner_response['data']["Q3. Course attended"] ?? '';
                        $Q9 = $learner_response['data']["Q9. Any Further Notes/Comments?"] ?? '';
                        $Q4 = $learner_response['data']["Q4. Did the course meet your expectations?"] ?? '';
                        $Q5 = $learner_response['data']["Q5. Did the course meet your expectations?"] ?? '';
                        $Q8 = $learner_response['data']["Q8. What did you enjoy most about the course?"] ?? '';
                        $Q13 = $learner_response['data']["Q13. Would you recommend this course to others?"] ?? '';
                        $Q6 = $learner_response['data']["Q6. How would you rate your Overall impressions?"] ?? '';
                        $Q11 = $learner_response['data']["Q11. How would you rate the trainer's performance?"] ?? '';
                        $Q12 = $learner_response['data']["Q12. Any Further Notes/Comments about your Trainer?"] ?? '';
                        $Q15 = $learner_response['data']["Q15. Please state which course you would be interested in"] ?? '';
                        $Q7 = $learner_response['data']["Q7. Do you feel there was any areas that we could improve?)"] ?? '';
                        $Q14 = $learner_response['data']["Q14. Would you take another course by the Training4Employment?"] ?? '';

                        //dd($learner_response);

                    @endphp





                    <div class="col-12">
                        <div class="form-step" id="step-1" data-step="1">

                            <div class="row headerDetail">
                                <div class="col-6">
                                    <h1>Course Evaluation Form</h1>
                                </div>
                            </div>

                            <div class="studyAssessment">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="devider"></div>
                                        <p>Dear {{ $username }},</p>
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

                            <br>


                        </div>

                        <div class="form-step" id="step-2" data-step="2">
                            <div class="studyAssessment">
                                <h2>Rate Your Course</h2>

                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Training centre') }}</label>
                                            <input type="text"  name="data[Q1. Training centre]"
                                                   class="form-control" value="{{  $Q1 ?? "" }}" readonly >
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>{{ __('Course Date') }}</label>
                                                <input type="text" id="training_provider" name="data[Q2. Course Date]"
                                                       class="form-control" value="{{  $Q2 ?? "" }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group requiredRole">
                                            <label>{{ __('Course attended') }}</label>
                                            <input type="text"  name="data[Q3. Course attended]"
                                                   class="form-control" value="{{  $Q3 ?? "" }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group bgBoxGray">
                                            <label>Did the course meet your expectations? </label>
                                            <div class="d-flex">
                                                <input type="radio" name="data[Q4. Did the course meet your expectations?][]"
                                                       value="Yes" {{ $Q4[0] == 'Yes' ? 'checked' : '' }} />
                                                <label class="mb-0 ml-2">Yes</label>
                                            </div>
                                            <div class="d-flex">
                                                <input type="radio" name="data[Q4. Did the course meet your expectations?][]"
                                                       value="No" {{ $Q4[0] == 'No' ? 'checked' : '' }} />
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
                                                               value="Excellent" {{ isset($Q5['Exercise and Practical Training']) && $Q5['Exercise and Practical Training'][0] == 'Excellent' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Exercise and Practical Training][]"
                                                               value="Very Good" {{ isset($Q5['Exercise and Practical Training']) && $Q5['Exercise and Practical Training'][0] == 'Very Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Exercise and Practical Training][]"
                                                               value="Good" {{ isset($Q5['Exercise and Practical Training']) && $Q5['Exercise and Practical Training'][0] == 'Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Exercise and Practical Training][]"
                                                               value="Fair" {{ isset($Q5['Exercise and Practical Training']) && $Q5['Exercise and Practical Training'][0] == 'Fair' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Exercise and Practical Training][]"
                                                               value="Poor" {{ isset($Q5['Exercise and Practical Training']) && $Q5['Exercise and Practical Training'][0] == 'Poor' ? 'checked' : '' }}></td>
                                                </tr>
                                                <tr>
                                                    <td>Presentation and Course Materials</td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                               value="Excellent" {{ isset($Q5['Presentation and Course Materials']) && $Q5['Presentation and Course Materials'][0] == 'Excellent' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                               value="Very Good" {{ isset($Q5['Presentation and Course Materials']) && $Q5['Presentation and Course Materials'][0] == 'Very Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                               value="Good" {{ isset($Q5['Presentation and Course Materials']) && $Q5['Presentation and Course Materials'][0] == 'Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                               value="Fair" {{ isset($Q5['Presentation and Course Materials']) && $Q5['Presentation and Course Materials'][0] == 'Fair' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Presentation and Course Materials][]"
                                                               value="Poor" {{ isset($Q5['Presentation and Course Materials']) && $Q5['Presentation and Course Materials'][0] == 'Poor' ? 'checked' : '' }}></td>
                                                </tr>
                                                <tr>
                                                    <td>Use of Class Time</td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                               value="Excellent" {{ isset($Q5['Use of Class Time']) && $Q5['Use of Class Time'][0] == 'Excellent' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                               value="Very Good" {{ isset($Q5['Use of Class Time']) && $Q5['Use of Class Time'][0] == 'Very Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                               value="Good" {{ isset($Q5['Use of Class Time']) && $Q5['Use of Class Time'][0] == 'Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                               value="Fair" {{ isset($Q5['Use of Class Time']) && $Q5['Use of Class Time'][0] == 'Fair' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q5. Did the course meet your expectations?][Use of Class Time][]"
                                                               value="Poor" {{ isset($Q5['Use of Class Time']) && $Q5['Use of Class Time'][0] == 'Poor' ? 'checked' : '' }}></td>
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
                                                               value="Excellent" {{ isset($Q6['Joining Instructions/ Pre-Course Materials']) && $Q6['Joining Instructions/ Pre-Course Materials'][0] == 'Excellent' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Joining Instructions/ Pre-Course Materials][]"
                                                               value="Very Good" {{ isset($Q6['Joining Instructions/ Pre-Course Materials']) && $Q6['Joining Instructions/ Pre-Course Materials'][0] == 'Very Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Joining Instructions/ Pre-Course Materials][]"
                                                               value="Good" {{ isset($Q6['Joining Instructions/ Pre-Course Materials']) && $Q6['Joining Instructions/ Pre-Course Materials'][0] == 'Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Joining Instructions/ Pre-Course Materials][]"
                                                               value="Fair" {{ isset($Q6['Joining Instructions/ Pre-Course Materials']) && $Q6['Joining Instructions/ Pre-Course Materials'][0] == 'Fair' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Joining Instructions/ Pre-Course Materials][]"
                                                               value="Poor" {{ isset($Q6['Joining Instructions/ Pre-Course Materials']) && $Q6['Joining Instructions/ Pre-Course Materials'][0] == 'Poor' ? 'checked' : '' }}></td>
                                                </tr>
                                                <tr>
                                                    <td>Members of Staff (other than Trainer)</td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                               value="Excellent" {{ isset($Q6['Members of Staff (other than Trainer)']) && $Q6['Members of Staff (other than Trainer)'][0] == 'Excellent' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                               value="Very Good" {{ isset($Q6['Members of Staff (other than Trainer)']) && $Q6['Members of Staff (other than Trainer)'][0] == 'Very Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                               value="Good" {{ isset($Q6['Members of Staff (other than Trainer)']) && $Q6['Members of Staff (other than Trainer)'][0] == 'Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                               value="Fair" {{ isset($Q6['Members of Staff (other than Trainer)']) && $Q6['Members of Staff (other than Trainer)'][0] == 'Fair' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Members of Staff (other than Trainer)][]"
                                                               value="Poor" {{ isset($Q6['Members of Staff (other than Trainer)']) && $Q6['Members of Staff (other than Trainer)'][0] == 'Poor' ? 'checked' : '' }}></td>
                                                </tr>
                                                <tr>
                                                    <td>Venue/Facilities</td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities)][]"
                                                               value="Excellent" {{ isset($Q6['Venue/Facilities)']) && $Q6['Venue/Facilities)'][0] == 'Excellent' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities))][]"
                                                               value="Very Good" {{ isset($Q6['Venue/Facilities)']) && $Q6['Venue/Facilities)'][0] == 'Very Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities))][]"
                                                               value="Good" {{ isset($Q6['Venue/Facilities)']) && $Q6['Venue/Facilities)'][0] == 'Good' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities))][]"
                                                               value="Fair" {{ isset($Q6['Venue/Facilities)']) && $Q6['Venue/Facilities)'][0] == 'Fair' ? 'checked' : '' }}></td>
                                                    <td><input type="radio"
                                                               name="data[Q6. How would you rate your Overall impressions?][Venue/Facilities))][]"
                                                               value="Poor" {{ isset($Q6['Venue/Facilities)']) && $Q6['Venue/Facilities)'][0] == 'Poor' ? 'checked' : '' }}></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group bgBoxGray">
                                            <label>Do you feel there was any areas that we could improve?</label>
                                            <div class="d-flex">
                                                <input type="radio"
                                                       name="data[Q7. Do you feel there was any areas that we could improve?)][]"
                                                       value="Yes" {{ $Q7[0] == 'Yes' ? 'checked' : '' }} />
                                                <label class="mb-0 ml-2">Yes</label>
                                            </div>
                                            <div class="d-flex">
                                                <input type="radio"
                                                       name="data[Q7. Do you feel there was any areas that we could improve?)][]"
                                                       value="No" {{ $Q7[0] == 'No' ? 'checked' : '' }}  />
                                                <label class="mb-0 ml-2">No</label>
                                            </div>
                                        </div>
                                        <div class="form-group bgBoxGray">
                                            <label>What did you enjoy most about the course?</label>
                                            <div class="row">
                                                <div class="col-12">
                                                    <textarea name="data[Q8. What did you enjoy most about the course?]" cols="30" rows="10">{{ $Q8 ?? "" }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group bgBoxGray">
                                            <label>Q5. Any Further Notes/Comments?</label>
                                            <div class="row">
                                                <div class="col-12">
                                                    <textarea name="data[Q9. Any Further Notes/Comments?]" id="" cols="30" rows="10">{{ $Q9 ?? "" }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-step" id="step-3" data-step="3">
                            <div class="form-group">
                                <label>{{ __('Trainers Name') }}</label>
                                <input type="text"   name="data[Q10. Trainers Name]"
                                       class="form-control" value="{{  $Q10 ?? "" }}" readonly>
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
                                                   value="Excellent" {{ isset($Q11['Knowledge of Subject Matter']) && $Q11['Knowledge of Subject Matter'][0] == 'Excellent' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Knowledge of Subject Matter][]"
                                                   value="Very Good" {{ isset($Q11['Knowledge of Subject Matter']) && $Q11['Knowledge of Subject Matter'][0] == 'Very Good' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Knowledge of Subject Matter][]"
                                                   value="Good" {{ isset($Q11['Knowledge of Subject Matter']) && $Q11['Knowledge of Subject Matter'][0] == 'Good' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Knowledge of Subject Matter][]"
                                                   value="Fair" {{ isset($Q11['Knowledge of Subject Matter']) && $Q11['Knowledge of Subject Matter'][0] == 'Fair' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Knowledge of Subject Matter][]"
                                                   value="Poor" {{ isset($Q11['Knowledge of Subject Matter']) && $Q11['Knowledge of Subject Matter'][0] == 'Poor' ? 'checked' : '' }}></td>
                                    </tr>
                                    <tr>
                                        <td>Overall Trainer Rating</td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                   value="Excellent" {{ isset($Q11['Overall Trainer Rating']) && $Q11['Overall Trainer Rating'][0] == 'Excellent' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                   value="Very Good" {{ isset($Q11['Overall Trainer Rating']) && $Q11['Overall Trainer Rating'][0] == 'Very Good' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                   value="Good" {{ isset($Q11['Overall Trainer Rating']) && $Q11['Overall Trainer Rating'][0] == 'Good' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                   value="Fair" {{ isset($Q11['Overall Trainer Rating']) && $Q11['Overall Trainer Rating'][0] == 'Fair' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Overall Trainer Rating][]"
                                                   value="Poor" {{ isset($Q11['Overall Trainer Rating']) && $Q11['Overall Trainer Rating'][0] == 'Poor' ? 'checked' : '' }}></td>
                                    </tr>
                                    <tr>
                                        <td>Presentation and Delivery Skills</td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                   value="Excellent" {{ isset($Q11['Presentation and Delivery Skills)']) && $Q11['Presentation and Delivery Skills)'][0] == 'Excellent' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                   value="Very Good" {{ isset($Q11['Presentation and Delivery Skills)']) && $Q11['Presentation and Delivery Skills)'][0] == 'Very Good' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                   value="Good" {{ isset($Q11['Presentation and Delivery Skills)']) && $Q11['Presentation and Delivery Skills)'][0] == 'Good' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                   value="Fair" {{ isset($Q11['Presentation and Delivery Skills)']) && $Q11['Presentation and Delivery Skills)'][0] == 'Fair' ? 'checked' : '' }}></td>
                                        <td><input type="radio"
                                                   name="data[Q11. How would you rate the trainer's performance?][Presentation and Delivery Skills)][]"
                                                   value="Poor" {{ isset($Q11['Presentation and Delivery Skills)']) && $Q11['Presentation and Delivery Skills)'][0] == 'Poor' ? 'checked' : '' }}></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group bgBoxGray">
                                <label>Any Further Notes/Comments about your Trainer?</label>
                                <div class="row">
                                    <div class="col-12">
                                    <textarea name="data[Q12. Any Further Notes/Comments about your Trainer?][]" id="" cols="30"
                                              rows="10">{{ $Q12[0]  }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-step" id="step-4" data-step="4">


                            <div class="form-group bgBoxGray">
                                <label>Would you recommend this course to others?</label>
                                <div class="d-flex">
                                    <input type="radio" name="data[Q13. Would you recommend this course to others?][]"
                                           value="Yes" {{ $Q13[0] == 'Yes' ? 'checked' : '' }} />
                                    <label class="mb-0 ml-2" >Yes</label>
                                </div>
                                <div class="d-flex">
                                    <input type="radio" name="data[Q13. Would you recommend this course to others?][]"
                                           value="No" {{ $Q13[0] == 'No' ? 'checked' : '' }} />
                                    <label class="mb-0 ml-2" >No</label>
                                </div>
                            </div>

                            <div class="form-group bgBoxGray">
                                <label>Would you take another course by the Training4Employment?</label>
                                <div class="d-flex">
                                    <input type="radio"
                                           name="data[Q14. Would you take another course by the Training4Employment?][]"
                                           value="Yes" {{ $Q14[0] == 'Yes' ? 'checked' : '' }} />
                                    <label class="mb-0 ml-2">Yes</label>
                                </div>
                                <div class="d-flex">
                                    <input type="radio"
                                           name="data[Q14. Would you take another course by the Training4Employment?][]"
                                           value="No" {{ $Q14[0] == 'No' ? 'checked' : '' }} />
                                    <label class="mb-0 ml-2">No</label>
                                </div>
                                <div class="d-flex">
                                    <input type="radio"
                                           name="data[Q14. Would you take another course by the Training4Employment?][]"
                                           value="Maybe" {{ $Q14[0] == 'Maybe' ? 'checked' : '' }} />
                                    <label class="mb-0 ml-2">Maybe</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Please state which course you would be interested in') }}</label>
{{--                                <input type="text"   name="data[Q15. Please state which course you would be interested in]"--}}
{{--                                       class="form-control" value="{{  $Q15 }}" readonly>--}}

                                @php
                                    $selectedCourses = $Q15 ?? [];
                                    if (!is_array($selectedCourses)) {
                                        $selectedCourses = explode(',', $selectedCourses); // Convert comma-separated string to array
                                    }
                                @endphp

                                <div>
                                    @foreach ($selectedCourses as $course)
                                        <span class="badge badge-primary">{{ $course }}</span>
                                    @endforeach
                                </div>




                            </div>

                        </div>
                    </div>


                    <form method="POST" action="{{ route('backend.task.response', ['submission' => $submission_id]) }}">
                        @csrf

                        <div class="card mt-4">
                            <div class="card-header bg-purple text-white">
                                <h5 class="mb-0">Trainer/Assessor Notes</h5>
                            </div>
                            <div class="card-body">

                                <!-- Status Dropdown -->
                                <div class="form-group mb-4">
                                    <label for="status">Task Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>



                </div>


            </form>
        </div>
    </div>

@endsection




@push('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
            integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        $(document).ready(function () {
            $('.toggle-btn').click(function () {
                // Find the associated hidden input
                let hiddenInput = $(this).siblings('.toggle-input');

                if ($(this).hasClass('btn-success')) {
                    // Toggle to incorrect
                    $(this).removeClass('btn-success').addClass('btn-danger');
                    $(this).html('<i class="fas fa-times"></i>');
                    $(this).attr('data-correct', 'false');
                    hiddenInput.val('incorrect'); // Update the hidden input value
                } else {
                    // Toggle to correct
                    $(this).removeClass('btn-danger').addClass('btn-success');
                    $(this).html('<i class="fas fa-check"></i>');
                    $(this).attr('data-correct', 'true');
                    hiddenInput.val('correct'); // Update the hidden input value
                }
            });
        });


    </script>

@endpush
