@extends('layouts.main')

@section('title', 'User')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css"
        integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bgHeading {
            background: #6f42c1;
            color: #fff;
            padding: 15px 10px;
            border-radius: 5px;
            font-weight: 600;
        }

        .bgBoxGray .d-flex>label {
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
            background-color: #4b0082;
            /* Use the purple shade from your image */
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

        .bgBoxGray>label {
            color: #3b1d8f;
        }

        .bgBoxGray>label>span {
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
            @php
                $username = auth()->user()->name;
            @endphp
            <div class="col-12">
                <div class="row headerDetail">
                    <div class="col-6">
                        <h1>SG Top-Up Workbook</h1>
                    </div>
                    <div class="col-6">
                        <div class="companyInfo text-right">
                            <p class="m-0"><strong>Training for Employment Ltd</strong></p>
                            <span>89-91 Hatchett Street, Birmingham, B19 3NY</span><br />
                            <span>E: info@training4employment.co.uk</span><br />
                            <span>www.training4employment.co.uk</span><br />
                            <span>Tel: 0121 630 2115</span><br />
                        </div>
                    </div>
                </div>
                <input type="hidden" name="task_name" value="{{ $task->name }}" />
                <input type="hidden" name="task_id" value="{{ $task->id }}" />
                @php
                    $learner_response = json_decode($learner_response, true);
                    $first_name = $learner_response['data']['first_name'] ?? '';
                    $last_name = $learner_response['data']['last_name'] ?? '';
                    $email_address = $learner_response['data']['email_address'] ?? '';
                    $assessment_date = $learner_response['data']['assessment_date'] ?? '';

                    $course_start_date = $learner_response['data']['course_start_date'] ?? '';
                    $course_end_date = $learner_response['data']['course_end_date'] ?? '';
                    $training_provider = $learner_response['data']['training_provider'] ?? '';

                    $learner_signature = $learner_response['signature'] ?? ''; // Assuming the signature is stored this way

                    $q1a = $learner_response['data']['Question 1 a'] ?? [];
                    $q1b = $learner_response['data']['Question 1 b'] ?? [];

                    $q2 = $learner_response['data']['Question 2'] ?? [];
                    $q3 = $learner_response['data']['Question 3'] ?? [];
                    $q4 = $learner_response['data']['Question 4'] ?? [];
                    $q5 = $learner_response['data']['Question 5'] ?? [];
                    $q6a = $learner_response['data']['Question 6 a'] ?? [];
                    $q6b = $learner_response['data']['Question 6 b'] ?? [];
                    $q7 = $learner_response['data']['Question 7'] ?? [];
                    $q8 = $learner_response['data']['Question 8'] ?? [];
                    $q9 = $learner_response['data']['Question 9'] ?? [];
                    $q10 = $learner_response['data']['Question 10'] ?? [];
                    $q11 = $learner_response['data']['Question 11'] ?? [];
                    $q12 = $learner_response['data']['Question 12'] ?? [];
                    $q13 = $learner_response['data']['Question 13'] ?? [];
                    $q14 =
                        $learner_response['data'][
                            'Q14. How does the information about roadworks in Text B compare with that given in Text A?'
                        ] ?? [];

                @endphp
                <div class="col-12">
                    <h1>Security Guard Top-Up Workbook</h1>
                    <p>Principles of Using Equipment as a Door Supervisor in the Private Security IndustryT/618/6844</p>
                    <div class="learnerInformation">
                        <h4 class="bgStrip">Learner Information</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>First Name<span>*</span></label>
                                    <input type="text" id="first_name" name="data[first_name]" class="form-control"
                                        value="{{ $first_name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Last Name<span>*</span></label>
                                    <input type="text" id="last_name" name="data[last_name]" class="form-control"
                                        value="{{ $last_name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email Address<span>*</span></label>
                                    <input type="email" name="data[email_address]" class="form-control"
                                        value="{{ $email_address ?? '' }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Course Start Date</label>
                                    <input type="date" name="data[course_start_date]"
                                        value="{{ $course_start_date ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Training Provider </label>
                                    <input type="text" name="data[training_provider]"
                                        value="{{ $training_provider ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Course End Date </label>
                                    <input type="date" name="data[course_end_date]" value="{{ $course_end_date ?? '' }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="introduction">
                        <h4 class="bgStrip">Introduction</h4>
                        <p>This online form has been created based on the Security Guard Self-Study (Top-Up) Workbook from
                            Highfield Products.</p>
                        <p>This workbook has been developed to support you in achieving the requirements of the self-study
                            learning outcomes and assessment criteria from the Highfield Level 2 Award for Security Officers
                            in
                            the Private Security Industry (Top Up) Unit 2: Principles of Minimising Personal Risk for
                            Security
                            Officers in the Private Security Industry.</p>
                        <div class="alertNotification">
                            <img src="{{ asset('images/notificationimg.png') }}" class="img-fluid" alt="">
                            <span>This workbook must be completed and submitted to Training4Employment before any further
                                face-to-face training.</span>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <h4 class="bgStrip">Knowledge Questions</h4>
                        <h4 class="bgGray">LO1 Know how to minimise risk to personal safety at work.</h4>
                        <div class="questions">

                            <label><strong>AC1.1 Identify responsibilities for personal safety at work.</strong></label>
                            <p>All employees and employers have basic responsibilities that they must follow to help ensure
                                personal safety is maintained at work.</p>
                            <p><strong>Question 1 a:</strong> Identify <strong>SIX</strong> employee responsibilities for
                                personal safety at work when working as a security officer.</p>
                            <div class="form-group">
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">1.</label>
                                    <input type="text" value="{{ $q1a[0] }}" class="form-control">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">2.</label>
                                    <input type="text" value="{{ $q1a[1] ?? '' }}" class="form-control">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">3.</label>
                                    <input type="text" value="{{ $q1a[2] ?? '' }}" class="form-control">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">4.</label>
                                    <input type="text" value="{{ $q1a[3] ?? '' }}" class="form-control">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">5.</label>
                                    <input type="text" value="{{ $q1a[4] ?? '' }}" class="form-control">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">6.</label>
                                    <input type="text" value="{{ $q1a[5] ?? '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <p><strong>Question 1 b:</strong> Identify <strong>SEVEN</strong> employer responsibilities.
                                </p>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">1.</label>
                                    <input type="text" name="data[Question 1 b][]" class="form-control"
                                        value="{{ $q1b[0] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">2.</label>
                                    <input type="text" name="data[Question 1 b][]" class="form-control"
                                        value="{{ $q1b[1] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">3.</label>
                                    <input type="text" name="data[Question 1 b][]" class="form-control"
                                        value="{{ $q1b[2] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">4.</label>
                                    <input type="text" name="data[Question 1 b][]" class="form-control"
                                        value="{{ $q1b[3] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">5.</label>
                                    <input type="text" name="data[Question 1 b][]" class="form-control"
                                        value="{{ $q1b[4] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">6.</label>
                                    <input type="text" name="data[Question 1 b][]" class="form-control"
                                        value="{{ $q1b[5] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">7.</label>
                                    <input type="text" name="data[Question 1 b][]" class="form-control"
                                        value="{{ $q1b[6] ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.2 Identify situations that might compromise personal safety.</label>
                        <p>As a security officer, you should always be aware of situations that could compromise your
                            safety.
                        </p>
                        <div class="form-group">
                            <p><strong>Question 2:</strong> Identify <strong>FOUR</strong> of the most common situations
                                that
                                might compromise your personal safety.</p>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 2][]" class="form-control"
                                    value="{{ $q2[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 2][]" class="form-control"
                                    value="{{ $q2[1] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 2][]" class="form-control"
                                    value="{{ $q2[2] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Question 2][]" class="form-control"
                                    value="{{ $q2[3] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.3 Identify the risks of ignoring personal safety in conflict situations.</label>
                        <p>Whenever you are dealing with conflict situations, there is an increased level of risk and
                            potential
                            for escalation.</p>
                        <div class="form-group">
                            <p><strong>Question 3:</strong> Identify <strong>THREE</strong> risks of ignoring personal
                                safety in
                                conflict situations.</p>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 3][]" class="form-control"
                                    value="{{ $q3[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 3][]" class="form-control"
                                    value="{{ $q3[1] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 3][]" class="form-control"
                                    value="{{ $q3[2] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.4 State the personal safety benefits of undertaking dynamic risk assessments.</label>
                        <p>A dynamic risk assessment is a systematic way of assessing the risk of the potential for violence
                            before approaching or responding to a situation.</p>
                        <div class="form-group">
                            <p><strong>Question 4:</strong> State the personal safety benefits of undertaking dynamic risk
                                assessments.</p>
                            <textarea name="data[Question 4]" cols="30" rows="10" class="form-control">{{ $q4 ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.5 List ways to minimise risk to personal safety.</label>
                        <p>It is important that you can minimise risks to your personal safety when working as a security
                            officer.</p>
                        <div class="form-group">
                            <p><strong>Question 5:</strong> List <strong>SIX</strong> ways to minimise risk to personal
                                safety.
                            </p>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 5][]" class="form-control"
                                    value="{{ $q5[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 5][]" class="form-control"
                                    value="{{ $q5[1] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 5][]" class="form-control"
                                    value="{{ $q5[2] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Question 5][]" class="form-control"
                                    value="{{ $q5[3] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Question 5][]" class="form-control"
                                    value="{{ $q5[4] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text" name="data[Question 5][]" class="form-control"
                                    value="{{ $q5[5] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.6 Recognise the different types of personal protective equipment relevant to the role of
                            a
                            security officer.</label>
                        <p>Personal protective equipment (PPE) is used to help protect you from harm when carrying out your
                            job
                            role.</p>
                        <div class="form-group">
                            <p><strong>Question 6 a:</strong> Identify <strong>EIGHT</strong> different types of personal
                                protective equipment that you may wear as a security officer.</p>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 6 a][]" class="form-control"
                                    value="{{ $q6a[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 6 a][]" class="form-control"
                                    value="{{ $q6a[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 6 a][]" class="form-control"
                                    value="{{ $q6a[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Question 6 a][]" class="form-control"
                                    value="{{ $q6a[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Question 6 a][]" class="form-control"
                                    value="{{ $q6a[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text" name="data[Question 6 a][]" class="form-control"
                                    value="{{ $q6a[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">7.</label>
                                <input type="text" name="data[Question 6 a][]" class="form-control"
                                    value="{{ $q6a[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">8.</label>
                                <input type="text" name="data[Question 6 a][]" class="form-control"
                                    value="{{ $q6a[0] ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <p><strong>Question 6 b:</strong> Identify <strong>SIX</strong> different types of personal
                                protective equipment that can be used to help maintain your safety when working as a
                                security
                                officer.</p>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 6 b][]" class="form-control"
                                    value="{{ $q6b[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 6 b][]" class="form-control"
                                    value="{{ $q6b[1] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 6 b][]" class="form-control"
                                    value="{{ $q6b[2] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Question 6 b][]" class="form-control"
                                    value="{{ $q6b[3] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Question 6 b][]" class="form-control"
                                    value="{{ $q6b[4] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text" name="data[Question 6 b][]" class="form-control"
                                    value="{{ $q6b[5] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.7 State the purpose of using body-worn cameras (BWC).</label>
                        <p>Body-worn cameras (BWC) have many benefits and as such are becoming more popular within the
                            private
                            security industry and well as within law enforcement.</p>
                        <div class="form-group">
                            <p><strong>Question 7:</strong> State the purpose of body-worn cameras.</p>
                            <textarea name="data[Question 7]" cols="30" rows="10" class="form-control">{{ $q7 ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.8 Identify strategies that can assist personal safety in conflict situations.</label>
                        <p>There are several problem-solving strategies that may help de-escalate a situation.</p>
                        <div class="form-group">
                            <p><strong>Question 8:</strong> Identify <strong>EIGHT</strong> strategies that can assist
                                personal
                                safety in conflict situations.</p>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 8][]" class="form-control"
                                    value="{{ $q8[0] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 8][]" class="form-control"
                                    value="{{ $q8[1] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 8][]" class="form-control"
                                    value="{{ $q8[2] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Question 8][]" class="form-control"
                                    value="{{ $q8[3] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Question 8][]" class="form-control"
                                    value="{{ $q8[4] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text" name="data[Question 8][]" class="form-control"
                                    value="{{ $q8[5] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">7.</label>
                                <input type="text" name="data[Question 8][]" class="form-control"
                                    value="{{ $q8[6] ?? '' }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">8.</label>
                                <input type="text" name="data[Question 8][]" class="form-control"
                                    value="{{ $q8[7] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.9 Describe limits of own responsibility in physical intervention situations.</label>
                        <p>Physical intervention is a non-pain compliant method of escorting an individual to the
                            destination of
                            your choice.</p>
                        <div class="alertNotification notLight">
                            <img src="http://127.0.0.1:8000/images/notificationlight.png" class="img-fluid"
                                alt="">
                            <span><strong>KEY POINT</strong><br> You must be trained in how to correctly apply holds prior
                                to
                                using them.</span>
                        </div>
                        <div class="form-group">
                            <p><strong>Question 9:</strong> Describe the limits of your responsibility in physical
                                intervention
                                situations..</p>
                            <textarea name="data[Question 9]" cols="30" rows="10" class="form-control">{{ $q9 ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.10 Identify types of harm that can occur during physical interventions.</label>
                        <p>Any forceful restraint can lead to medical complications.</p>
                        <div class="form-group">
                            <p><strong>Question 10:</strong> Identify <strong>SIX</strong> types of harm that can occur
                                during
                                physical interventions.</p>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 10][]" value="{{ $q10[0] ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 10][]" value="{{ $q10[1] ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 10][]" value="{{ $q10[2] ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Question 10][]" value="{{ $q10[3] ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Question 10][]" value="{{ $q10[4] ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text" name="data[Question 10][]" value="{{ $q10[5] ?? '' }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.11 Identify types of harm that can occur during physical interventions.</label>
                        <p>Mental alertness is vital while working as a security officer. There are many advantages to
                            ensuring
                            you look after your mental well-being.</p>
                        <div class="form-group">
                            <p><strong>Question 11:</strong> Identify <strong>FIVE</strong> personal advantages of mental
                                alertness at work.</p>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Question 11][]" value="{{ $q11[0] ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Question 11][]" value="{{ $q11[1] ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Question 11][]" value="{{ $q11[2] ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Question 11][]" value="{{ $q11[3] ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Question 11][]" value="{{ $q11[4] ?? '' }}"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <div class="knowledge_questions mt-5 borderBottom">
                        <label>AC1.12 State the benefits of reflecting on personal safety experiences.</label>
                        <p>Reflection is a useful tool to enable you and your colleagues to learn from past experiences.</p>
                        <div class="form-group">
                            <p><strong>Question 12:</strong> State the benefits of reflecting on personal safety
                                experiences.
                            </p>
                            <textarea name="data[Question 12]" cols="30" rows="10" class="form-control">{{ $q12 ?? '' }}</textarea>
                        </div>
                        <h4 class="bgGray my-4">LO2 Know what actions to take in relation to global (or critical)
                            incidents.
                        </h4>
                        <label>AC2.1 Know government guidance in relation to global (or critical) incidents.</label>
                        <p>As a security officer, it is important to know what actions you should take and where you can
                            find
                            additional information and guidance when dealing with global or critical incidents.</p>
                        <div class="form-group">
                            <p><strong>Question 13:</strong> Describe the government guidance in relation to global (or
                                critical) incidents.</p>
                            <textarea name="data[Question 13]" cols="30" rows="10" class="form-control">{{ $q13 ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Learner' Name</label>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <input type="text" name="data[first_name]" class="form-control"
                                        value="{{ $first_name ?? '' }}">
                                    <small>First Name</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <input type="text" name="data[last_name]" class="form-control"
                                        value="{{ $last_name ?? '' }}">
                                    <small>Last Name</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Learner Signature<span>*</span></label>
                                    @if (isset($learner_signature))
                                        <div>
                                            <h5>Signature:</h5>
                                            <img src="{{ $learner_signature }}" alt="Learner's Signature"
                                                style="max-width: 200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Date, Time</label>
                                    <input type="text" name="data[assessment_date]" class="form-control"
                                        value="{{ $assessment_date ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                </div>
                <form method="POST" action="{{ route('backend.task.response', ['submission' => $submission_id]) }}"
                    id="submitForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card mt-4">
                        <div class="card-header bg-purple text-white">
                            <h5 class="mb-0">Trainer/Assessor Notes</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Questions</th>
                                            <th scope="col">Correct/Incorrect</th>
                                            <th scope="col">Assessor Feedback</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 1; $i <= 13; $i++)
                                            @php
                                                // Define an array for the questions that have sub-questions
                                                $subQuestions = [
                                                    1 => ['a', 'b'],
                                                    6 => ['a', 'b'],
                                                ];
                                            @endphp

                                            {{-- Check if the question has sub-questions --}}
                                            @if (array_key_exists($i, $subQuestions))
                                                {{-- Loop through sub-questions --}}
                                                @foreach ($subQuestions[$i] as $sub)
                                                    <tr>
                                                        <td>Question {{ $i }}{{ $sub }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger toggle-btn"
                                                                data-correct="false" style="width: 40px;">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                            <input type="hidden"
                                                                name="answers[{{ $i }}{{ $sub }}]"
                                                                value="incorrect" class="toggle-input">
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                name="feedback[{{ $i }}{{ $sub }}]"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                {{-- Normal questions --}}
                                                <tr>
                                                    <td>Question {{ $i }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger toggle-btn"
                                                            data-correct="false" style="width: 40px;">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                        <input type="hidden" name="answers[{{ $i }}]"
                                                            value="incorrect" class="toggle-input">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="feedback[{{ $i }}]"
                                                            class="form-control">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="unitMapping">
                                        <h4 class="bgHeading">Highfield Unit Mapping</h4>
                                        <p>The following mapping reference provides a guide for assessors on suggested
                                            coverage of unit criteria within this kit. Where indicated on the ‘Unit Kit
                                            Question’ column with a ‘QXX’, this refers to a question within the kit that
                                            could provide coverage for the identified criteria.</p>
                                        <p>However, it should be noted that it is still the responsibility of the assessor
                                            to ensure the answer provided by the learner is of the appropriate standard to
                                            meet the criteria in full.</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label>Learner Name <span>*</span></label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="high_field_response[learner_name]"
                                        value="{{ $first_name ?? '' }}" readonly>
                                    <small>First Name</small>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="high_field_response[last_name]"
                                        value="{{ $last_name ?? '' }}" readonly>
                                    <small>Last Name</small>
                                </div>
                                <div class="col-12  mt-3">
                                    <label>Centre Name</label>
                                    <input type="text" class="form-control" name="high_field_response[center_name]">
                                </div>
                                <div class="col-12">
                                    <h4 class="mt-3">Unit 2: Principles of Minimising Personal Risk for Security Officers
                                        in the Private Security Industry</h4>

                                    <div class="table-responsive my-3">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-light">
                                                <tr class="bg-gray">
                                                    <th width="15%">Unit criteria</th>
                                                    <th width="25%">Unit kit question</th>
                                                    <th width="60%">Additional evidence</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= 13; $i++)
                                                    @php
                                                        // Define an array for the questions that have sub-questions
                                                        $subQuestions = [
                                                            1 => ['a', 'b'],
                                                            6 => ['a', 'b'],
                                                        ];
                                                    @endphp

                                                    {{-- Check if the question has sub-questions --}}
                                                    @if (array_key_exists($i, $subQuestions))
                                                        {{-- Loop through sub-questions --}}
                                                        @foreach ($subQuestions[$i] as $sub)
                                                            <tr>
                                                                <td><strong>1.{{ $i }}</strong></td>
                                                                <td>Question {{ $i }}{{ $sub }}</td>
                                                                <td>
                                                                    <input type="text"
                                                                        name="high_field_response[additional_evidence][{{ $i }}{{ $sub }}]"
                                                                        class="form-control">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        {{-- Normal questions --}}
                                                        <tr>
                                                            <td><strong>1.{{ $i }}</strong></td>
                                                            <td>Question {{ $i }}</td>
                                                            <td>
                                                                <input type="text"
                                                                    name="high_field_response[additional_evidence][{{ $i }}]"
                                                                    class="form-control">
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endfor

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="my-3 border rounded">
                                        <h4 class="bgHeading my-3 mx-3">Training Provider/Assessment Confirmation</h4>
                                        <div class="m-3">
                                            <h5><strong>Further Evidence</strong></h5>
                                            <div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="high_field_response[evidence1]"
                                                        value="Further assessment evidence guidance is required">
                                                    <label class="form-check-label">Further assessment evidence guidance is
                                                        required.</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="high_field_response[evidence1]"
                                                        value="No further assessment evidence guidance is required">
                                                    <label class="form-check-label">No further assessment evidence guidance
                                                        is required, as all criteria within this unit are linked to the
                                                        questions within the workbook. If assessors wish to supplement this
                                                        learner evidence further, they may do so and map this in the
                                                        ‘Additional evidence’ column above.</label>
                                                </div>
                                            </div>
                                            <p class="m-0"><label>Assessor's Name</label></p>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" name="high_field_response[assessor_first_name]"
                                                        class="w-100 form-control">
                                                    <small>First Name</small>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="high_field_response[assessor_last_name]"
                                                        class="w-100 form-control">
                                                    <small>Last Name</small>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-3">
                                                <div class="col-6">
                                                    <p class="m-0"><label>Assessor's Signature</label></p>
                                                    <div id="signature-pad" class="signature-pad">
                                                        <div id="signature-pad" class="signature-pad">
                                                            <div class="signature-pad-body">
                                                                <canvas id="signature-canvas"
                                                                    style="
                                                                    background: #fff;
                                                                    border: solid 2px #cccc;
                                                                    margin-bottom: 30px;
                                                                    ">
                                                                </canvas>
                                                            </div>
                                                            <div class="signature-pad-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    id="clear-signature">
                                                                    Clear
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="signature" id="signature-input-paf">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="m-0"><label>Date, Time</label></p>
                                                    <input type="date" name="high_field_response[date_time]"
                                                        class="w-100 form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Status Dropdown -->
                            <div class="form-group mb-4">
                                <label for="status">Task Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Approved">PASSED</option>
                                    <option value="Rejected">FAILED</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-btn').click(function() {
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

            const canvas = document.getElementById('signature-canvas');
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)'
            });

            document.getElementById('clear-signature').addEventListener('click', function() {
                signaturePad.clear();
            });

            document.getElementById('submitForm').addEventListener('submit', function(event) {
                if (signaturePad.isEmpty()) {
                    event.preventDefault();
                } else {
                    const signatureDataUrl = signaturePad.toDataURL();
                    //console.log("Captured Signature:", signatureDataUrl);
                    document.getElementById('signature-input-paf').value = signatureDataUrl;
                }
            });
        });
    </script>
@endpush
