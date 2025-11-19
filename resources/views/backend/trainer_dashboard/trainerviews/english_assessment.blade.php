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

            @php
                $pdf = $submission_pdf;
            @endphp

                <div class="col-12">
                    <div class="row headerDetail">
                        <div class="col-4">
                            <h1>Initial English Assessment</h1>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <div class="floatingpdfTrainer d-inline-flex align-items-center overflow-auto" >
                                @if($pdf)
                                    <div href="{{ asset($pdf) }}" class="popup-pdf"><i
                                            class="fas fa-file-pdf"></i></div>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="companyInfo text-right">
                                <p class="m-0"><strong>Training for Employment Ltd</strong></p>
                                <span>89-91 Hatchett Street, Birmingham, B19 3NY</span><br/>
                                <span>E: info@training4employment.co.uk</span><br/>
                                <span>www.training4employment.co.uk</span><br/>
                                <span>Tel: 0121 630 2115</span><br/>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="task_name" value="{{ $task->name }}"/>
                    <input type="hidden" name="task_id" value="{{ $task->id }}"/>


                    @php
                        $learner_response = json_decode($learner_response, true);



                        // Get the "I confirm that" data from the decoded response
                        $confirm_responses = $learner_response['data']['I confirm that'] ?? [];


                        // Get the specific values from the learner response
                        $first_name = $learner_response['data']['first_name'] ?? '';
                        $last_name = $learner_response['data']['last_name'] ?? '';
                        $assessment_date = $learner_response['data']['assessment_date'] ?? '';
                        $learner_signature = $learner_response['signature'] ?? ''; // Assuming the signature is stored this way

                        $q1 = $learner_response['data']['Q1. What is the main purpose of Text A?'] ?? [];
                        $q2 = $learner_response['data']['Q2. According to Text A, how long will the roadworks take?'] ?? [];
                        $q3 = $learner_response['data']['Q3. According to Text A, how does the council plan to reduce congestion?'] ?? [];
                        $q4 = $learner_response['data']['Q4. According to Text A, who can use the park-and-ride service at a reduced cost?'] ?? [];
                        $q51 = $learner_response['data']['Q5. The writer of Text A states’ we will be heavy machinery to carry out the work’. Is this a fact or an opinion?'] ?? [];
                        $q52 = $learner_response['data']['Q5_reason'] ?? "";
                        $q6 = $learner_response['data']['Q6. Using Text A, identify two instruction given by Dee Rose to residents of Main Street'] ?? [];
                        $q7 = $learner_response['data']['Q7. Is Text A formal or informal? Give a reason for your answer'] ?? [];
                        $q8 = $learner_response['data']['Q8. What is the meaning of the term added bonus as used in Text B?'] ?? [];
                        $q9 = $learner_response['data']['Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?'] ?? [];
                        $q10 = $learner_response['data']['Q10. Using Text B, which of these statements is incorrect?'] ?? [];
                        $q11 = $learner_response['data']['Q11. According to Text B, most of the training takes place'] ?? [];
                        $q12 = $learner_response['data']['12. What does the image in Text B suggest about how the apprentices are feeling about their course?'] ?? [];
                        $q13 = $learner_response['data']['Q13. Explain why the author has used exclamation marks in Text B'] ?? [];
                        $q14 = $learner_response['data']['Q14. How does the information about roadworks in Text B compare with that given in Text A?'] ?? [];




                    @endphp


                    <div class="form-step" id="step-1" data-step="1">
                        <div class="studyAssessment">
                            <h2>Step 1</h2>
                            <h4 class="bgStrip">Learner Declaration</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div>
                                            <label>{{ __('I confirm that:') }}</label>
                                        </div>

                                        <div class="checkboxDiv d-flex">
                                            <input type="checkbox" name="data[I confirm that][]"
                                                   value="I received no help in answering the questions in this examination paper."
                                                {{ in_array('I received no help in answering the questions in this examination paper.', $confirm_responses) ? 'checked' : '' }}/>
                                            <label class="mb-0 ml-2">I received no help in answering the questions in
                                                this examination paper.</label>
                                        </div>

                                        <div class="checkboxDiv d-flex">
                                            <input type="checkbox" name="data[I confirm that][]"
                                                   value="I am the person stated above on this form."
                                                {{ in_array('I am the person stated above on this form.', $confirm_responses) ? 'checked' : '' }}/>
                                            <label class="mb-0 ml-2">I am the person stated above on this form.</label>
                                        </div>

                                        <div class="checkboxDiv d-flex">
                                            <input type="checkbox" name="data[I confirm that][]"
                                                   value="I will not discuss the content of the examination with anyone else."
                                                {{ in_array('I will not discuss the content of the examination with anyone else.', $confirm_responses) ? 'checked' : '' }}/>
                                            <label class="mb-0 ml-2">I will not discuss the content of the examination
                                                with anyone else.</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <!-- First Name Field -->
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('First Name') }}<span>*</span></label>
                                        <input type="text" id="first_name" name="data[first_name]" class="form-control"
                                               value="{{ $first_name ?? "" }}"/>
                                    </div>
                                </div>

                                <!-- Last Name Field -->
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Last Name') }}<span>*</span></label>
                                        <input type="text" id="last_name" name="data[last_name]" class="form-control"
                                               value="{{ $first_name ?? "" }}" />
                                    </div>
                                </div>

                                <!-- Learner Signature Field -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Learner Signature') }}<span>*</span></label>



                                        <!-- Display the signature as an image -->
                                        @if(isset($learner_signature))
                                            <div>
                                                <h5>Signature:</h5>
                                                <img src="{{ $learner_signature }}" alt="Learner's Signature"
                                                     style="max-width: 200px;">
                                            </div>
                                        @endif


                                    </div>
                                </div>

                                <!-- Assessment Date Field -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Date, Time Assessment Completed') }}</label>
                                        <input type="text" id="assessment_date" name="data[assessment_date]"
                                               class="form-control"
                                               value="{{ $assessment_date ?? "" }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="studyAssessment">
                        <h2>Step 2</h2>
                        <p>Dear {{ $first_name ?? "" }}</p>
                        <p>Please read the Text A carefully and answer questions 1 to 7</p>
                        <div class="secondForm">
                            <h4 class="bgStrip">Text A</h4>
                            <p>You receive the following document from Training for Employment:</p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="sectionBorder">
                                        <div>
                                            <label>{{ __('Dear Sir/Madam,') }}</label>
                                        </div>
                                        <p>
                                            <strong>Re: Notification of Roadworks on Main Street, Training for
                                                Employment</strong>
                                        </p>
                                        <p>
                                            As part of our continued commitment to improve road conditions
                                            in your area, Training4Employment Council is Going to resurface
                                            Main Street in Birmingham, Newtown. This work will begin on 9th
                                            August and will be completed in 2 weeks.
                                        </p>
                                        <p>
                                            We will be using heavy machinery to carry out the work, so
                                            unfortunately there will be long periods of noise and dust
                                            caused by the digging.
                                        </p>
                                        <p>
                                            Temporary traffic lights will be in place on Main Street for the
                                            duration of the resurfacing work to ease congestion. However
                                            delays should be expected. Therefore you may wish to consider
                                            using an alternative route or the park-and-ride services when
                                            travelling to and from the town centre. Residents of Main Street
                                            can use the park-and-ride service at a reduced cost. You must
                                            present evidence of your address when buying a ticket.
                                        </p>
                                        <p>
                                            Local businesses will be unaffected by the roadworks and will
                                            remain open as usual.
                                        </p>
                                        <p>
                                            We are sorry for any inconvenience caused by these necessary
                                            repairs. Feel free to contact us on 02345 678 910 if you have
                                            any queries.
                                        </p>
                                        <p>Yours faithfully,</p>
                                        <p><strong>Dee Rose</strong></p>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q1. What is the main purpose of Text A?
                                        <span>Please select one answer. (1 Point) </span></label>
                                    <div class="radioDiv d-flex">
                                        <input type="radio" name="data[Q1][]" value="To describe"
                                            {{ in_array('To describe', $q1) ? 'checked' : '' }}/>
                                        <label class="mb-0 ml-2">To describe</label>
                                    </div>
                                    <div class="radioDiv d-flex correctAns">
                                        <input type="radio" name="data[Q1. What is the main purpose of Text A?][]"
                                               value="To explain"
                                            {{ in_array('To explain', $q1) ? 'checked' : '' }}/>
                                        <label class="mb-0 ml-2">To explain</label>
                                    </div>
                                    <div class="radioDiv d-flex">
                                        <input type="radio" name="data[Q1. What is the main purpose of Text A?][]"
                                               value="To persuade"
                                            {{ in_array('To persuade', $q1) ? 'checked' : '' }}/>
                                        <label class="mb-0 ml-2">To persuade</label>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q2. According to Text A, how long will the roadworks take?
                                        <span>Please select one answer. (1 Point)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q2. According to Text A, how long will the roadworks take?][]"
                                                       value="As long as it takes"
                                                    {{ in_array('As long as it takes', $q2) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">As long as it takes</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex correctAns">
                                                <input type="radio"
                                                       name="data[Q2. According to Text A, how long will the roadworks take?][]"
                                                       value="2 weeks"
                                                    {{ in_array('2 weeks', $q2) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">2 weeks</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q2. According to Text A, how long will the roadworks take?][]"
                                                       value="9 days"
                                                    {{ in_array('9 days', $q2) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">9 days</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q2. According to Text A, how long will the roadworks take?][]"
                                                       value="Long periods"
                                                    {{ in_array('Long periods', $q2) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Long periods</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q3. According to Text A, how does the council plan to reduce
                                        congestion?
                                        <span>Please select one answer. (1 Point)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q3. According to Text A, how does the council plan to reduce congestion?][]"
                                                       value="By keeping local businesses open"
                                                    {{ in_array('By keeping local businesses open', $q3) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">By keeping local businesses open</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q3. According to Text A, how does the council plan to reduce congestion?][]"
                                                       value="By resurfacing the road"
                                                    {{ in_array('By resurfacing the road', $q3) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">By resurfacing the road</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex correctAns">
                                                <input type="radio"
                                                       name="data[Q3. According to Text A, how does the council plan to reduce congestion?][]"
                                                       value="By using temporary traffic lights"
                                                    {{ in_array('By using temporary traffic lights', $q3) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">By using temporary traffic lights</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q3. According to Text A, how does the council plan to reduce congestion?][]"
                                                       value="By using heavy machinery"
                                                    {{ in_array('By using heavy machinery', $q3) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">By using heavy machinery</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q4. According to Text A, who can use the park-and-ride service at a reduced
                                        cost? <span>Please select one answer. (1 Point)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="radioDiv d-flex correctAns">
                                                <input type="radio"
                                                       name="data[Q4. According to Text A, who can use the park-and-ride service at a reduced cost?][]"
                                                       value="People living on Main Street"
                                                    {{ in_array('People living on Main Street', $q4) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">People living on Main Street</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q4. According to Text A, who can use the park-and-ride service at a reduced cost?][]"
                                                       value="Dee Rose"
                                                    {{ in_array('Dee Rose', $q4) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Dee Rose</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q4. According to Text A, who can use the park-and-ride service at a reduced cost?][]"
                                                       value="Council employees"
                                                    {{ in_array('Council employees', $q4) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Council employees</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q4. According to Text A, who can use the park-and-ride service at a reduced cost?][]"
                                                       value="Businesses on Main Street"
                                                    {{ in_array('Businesses on Main Street', $q4) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Businesses on Main Street</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q5. The writer of Text A states’ we will be heavy machinery to carry out the
                                        work’. Is this a fact or an opinion?
                                        <span>Please select one answer. (1 Point)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="radioDiv d-flex correctAns">
                                                <input type="radio"
                                                       name="data[Q5. The writer of Text A states we will be heavy machinery to carry out the work. Is this a fact or an opinion?][]"
                                                       value="Fact"
                                                    {{ in_array('Fact', $q51) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Fact</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q5. The writer of Text A states we will be heavy machinery to carry out the work. Is this a fact or an opinion?][]"
                                                       value="Opinion"
                                                    {{ in_array('Opinion', $q51) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Opinion</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label><strong>Give a reason for your answer.</strong><br/><span>Please
                                                        write a paragraph which consists of approximately
                                                        3-4 sentences</span></label>
                                            <textarea
                                                name="data[Q5_reason]"
                                                id="" cols="30" rows="10">{{ $q52 ?? ""  }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q6. Using Text A, identify two instruction given by Dee Rose to
                                        residents of Main Street.<span>(2 Marks)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Example 1</label>
                                            <input type="text"
                                                   name="data[Q6. Using Text A, identify two instruction given by Dee Rose to residents of Main Street][]"
                                                   class="form-control" value="{{$q6[0]}}"/>
                                        </div>
                                        <div class="col-6">
                                            <label>Example 2</label>
                                            <input type="text"
                                                   name="data[Q6. Using Text A, identify two instruction given by Dee Rose to residents of Main Street][]"
                                                   class="form-control" value="{{$q6[1]}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q7. Is Text A formal or informal? Give a reason for your answer. <span>Please select one answer. (2 Marks)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="radioDiv d-flex correctAns">
                                                <input type="radio"
                                                       name="data[Q7. Is Text A formal or informal? Give a reason for your answer][]"
                                                       value="Formal"
                                                    {{ in_array('Formal', $q7) ? 'checked' : '' }} />
                                                <label class="mb-0 ml-2">Formal</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q7. Is Text A formal or informal? Give a reason for your answer][]"
                                                       value="Informal"
                                                    {{ in_array('Informal', $q7) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Informal</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label><strong>Give a reason for your answer.</strong><br/><span>Please
                                                        write a paragraph which consists of approximately
                                                        3-4 sentences</span></label>
                                            <textarea
                                                name="data[Q7. Is Text A formal or informal? Give a reason for your answer][]"
                                                id=""
                                                cols="30" rows="10">{{ $q7[1] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="studyAssessment">
                        <h2>Step 3</h2>
                        <p>Dear {{ $first_name }}</p>
                        <p>Please read the Text B carefully and answer questions 8 to 13.</p>
                        <div class="secondForm">
                            <h4 class="bgStrip">Text B</h4>
                            <p>You see the following advertisement in the local newspaper:</p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="sectionBorder">
                                        <h4 class="bgHeadLight">National Apprenticeship Week 20 - 27 August</h4>
                                        <p>National Apprenticeship Week is upon us and there has never been a better
                                            time to take control of your future.</p>
                                        <div class="row">
                                            <div class="col-7">
                                                <p><strong>Aged 16 and over? Could an apprenticeship be for
                                                        you?</strong></p>
                                                <p>Why an Apprenticeship? </p>
                                                <p>Apprenticeship programmes have benefits for both apprentices and
                                                    their employers.</p>
                                                <p>As an apprentice you will: </p>
                                                <ul>
                                                    <li>gain formal qualifications</li>
                                                    <li>learn job-specific skills</li>
                                                    <li>work alongside experienced staff</li>
                                                    <li>earn a salary</li>
                                                    <li>receive holiday pay</li>
                                                </ul>
                                            </div>
                                            <div class="col-5">
                                                <img src="{{ asset('images/page3.png') }}" alt="" data-lity
                                                     data-lity-target="{{ asset('images/page3.png') }}">
                                            </div>
                                        </div>
                                        <div class="bgLightTxt">
                                            <p><small>Apprentices are paid a salary by their employer and the cost
                                                    of
                                                    training is covered. You will therefore be earning as you are
                                                    learning, with the added bonus of no tuition fees, no student
                                                    loans
                                                    and hopefully no debt! Most of your learning is completed
                                                    'on-the-job' giving you the chance to put new skills immediately
                                                    into practice and gain confidence in a working
                                                    environment.</small>
                                            </p>
                                            <p><small>The apprenticeship programme is continually growing. Higher
                                                    level
                                                    apprenticeships are now available so why not aim to gain a
                                                    nationally recognised qualification at level 4 or above (the
                                                    equivalent to a higher education diploma or a foundation
                                                    degree)?</small></p>
                                            <p><small>Employers value apprenticeships as a way of helping their
                                                    workforce to develop their skills and progress their careers.
                                                    Employers see apprenticeships as a good way to provide training
                                                    in
                                                    their workplace rather than at college, helping to ensure that
                                                    the
                                                    specific needs of their business are met. Funding is also
                                                    available
                                                    to employers that train 16 to 24-year old apprentices.</small>
                                            </p>
                                            <p><strong><small>It's clear that now is a good time to sign up for an
                                                        apprenticeship programme!</small></strong></p>
                                        </div>
                                        <h4>Apprenticeship Opportunities :</h4>
                                        <p>Apprenticeships are currently available in many Industries including:</p>
                                        <div class="row">
                                            <div class="col-8">
                                                <ul>
                                                    <li>business and administration</li>
                                                    <li>catering</li>
                                                    <li>health and social care</li>
                                                    <li>retail</li>
                                                </ul>
                                            </div>
                                            <div class="col-4">
                                                <div class="darkBox">
                                                    <h5>Kick-start your career!</h5>
                                                    <p>Call into your local job centre <br>
                                                        for more information.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <h4>Important Information</h4>
                                        <p>The job centre on Main Street has limited access due to roadworks, with
                                            heavy
                                            machinery present on site. The job centre is therefore experiencing some
                                            disruption and caution is advised if attending on foot or if parking in
                                            the
                                            area. As an alternative, please visit one of our other branches on
                                            Townhead
                                            Road or Northern Street.</p>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q8. What is the meaning of the term "added bonus", as used in Text B?
                                        <span>Please select one answer. (1 Mark)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q8. What is the meaning of the term added bonus as used in Text B?][]"
                                                       value="A student loan" {{ in_array('A student loan', $q8) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">A student loan</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q8. What is the meaning of the term added bonus as used in Text B?][]"
                                                       value="A disadvantage" {{ in_array('A disadvantage', $q8) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">A disadvantage</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex correctAns">
                                                <input type="radio"
                                                       name="data[Q8. What is the meaning of the term added bonus as used in Text B?][]"
                                                       value="A benefit" {{ in_array('A benefit', $q8) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">A benefit</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q8. What is the meaning of the term added bonus as used in Text B?][]"
                                                       value="An extra payment" {{ in_array('An extra payment', $q8) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">An extra payment</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q9. In Text B, which organisational feature is used to demonstrate the
                                        benefits of an apprenticeship?
                                        <span>Please select one answer. (1 Mark)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?][]"
                                                       value="Paragraphs" {{ in_array('Paragraphs', $q9) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Paragraphs</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?][]"
                                                       value="Heading" {{ in_array('Heading', $q9) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Heading</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?][]"
                                                       value="Subheadings" {{ in_array('Subheadings', $q9) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Subheadings</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex correctAns">
                                                <input type="radio"
                                                       name="data[Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?][]"
                                                       value="Bullet points" {{ in_array('Bullet points', $q9) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Bullet points</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q10. Using Text B, which of these statements is incorrect? <span>Please select one answer. (1 Mark)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q10. Using Text B, which of these statements is incorrect?][]"
                                                       value="Apprentices earn a salary" {{ in_array('Apprentices earn a salary', $q10) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Apprentices earn a salary</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q10. Using Text B, which of these statements is incorrect?][]"
                                                       value="National Apprenticeship Week is in the summer" {{ in_array('National Apprenticeship Week is in the summer', $q10) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">National Apprenticeship Week is in the
                                                    summer</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q10. Using Text B, which of these statements is incorrect?][]"
                                                       value="Job centres have more details" {{ in_array('Job centres have more details', $q10) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Job centres have more details</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex correctAns">
                                                <input type="radio"
                                                       name="data[Q10. Using Text B, which of these statements is incorrect?][]"
                                                       value="Apprenticeship are only available to teenagers" {{ in_array('Apprenticeship are only available to teenagers', $q10) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">Apprenticeship are only available to
                                                    teenagers</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q11. According to Text B, most of the training takes place. <span>Please select one answer. (1 Mark)</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q11. According to Text B, most of the training takes place][]"
                                                       value="At the job centre" {{ in_array('At the job centre', $q11) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">At the job centre</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex correctAns">
                                                <input type="radio"
                                                       name="data[Q11. According to Text B, most of the training takes place][]"
                                                       value="In the workplace" {{ in_array('In the workplace', $q11) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">In the workplace</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q11. According to Text B, most of the training takes place][]"
                                                       value="At university" {{ in_array('At university', $q11) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">At university</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="radioDiv d-flex">
                                                <input type="radio"
                                                       name="data[Q11. According to Text B, most of the training takes place][]"
                                                       value="At college" {{ in_array('At college', $q11) ? 'checked' : '' }}/>
                                                <label class="mb-0 ml-2">At college</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>12. What does the image in Text B suggest about how the apprentices are
                                        feeling about their course?<span>(1
                                                mark)</span></label>
                                    <p>Please write a paragraph which consists of approximately 3-4 sentences</p>
                                    <textarea
                                        name="data[12. What does the image in Text B suggest about how the apprentices are feeling about their course?]"
                                        id=""
                                        cols="30" rows="10" style="display: block;">{{$q12}}</textarea>
                                </div>
                                <div class="form-group bgBoxGray">
                                    <label>Q13. Explain why the author has used exclamation marks in Text B.<span>(1 mark)</span></label>
                                    <p>Please write a paragraph which consists of approximately 3-4 sentences</p>
                                    <textarea
                                        name="data[Q13. Explain why the author has used exclamation marks in Text B]"
                                        id=""
                                        cols="30" rows="10" style="display: block;">{{$q13}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                    <h2>Step 4</h2>
                    <p>Dear {{ $first_name }}</p>
                    <p>Please review Text A and Text B, then proceed to answer question 14</p>
                    <div class="imageRow">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset('images/text-a.png') }}" class="img-fluid" data-lity
                                     data-lity-target="{{ asset('images/text-a.png') }}">
                                <button class="btn btnImage" data-lity
                                        data-lity-target="{{ asset('images/text-a.png') }}">Text A <i
                                        class="fas fa-search-plus"></i></button>
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('images/text-b.png') }}" class="img-fluid" data-lity
                                     data-lity-target="{{ asset('images/text-b.png') }}">
                                <button class="btn btnImage" data-lity
                                        data-lity-target="{{ asset('images/text-b.png') }}">Text B <i
                                        class="fas fa-search-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group bgBoxGray mt-5">
                        <label>Q14. How does the information about roadworks in Text B compare with that given in
                            Text A?<span>Give two examples. (2 marks)</span></label>
                        <div class="form-group requiredRole">
                            <label>Example 1</label>
                            <input type="text"
                                   name="data[Q14. How does the information about roadworks in Text B compare with that given in Text A?][]"
                                   class="form-control" value="{{$q14[0]}}">
                        </div>
                        <div class="form-group requiredRole">
                            <label>Example 2</label>
                            <input type="text"
                                   name="data[Q14. How does the information about roadworks in Text B compare with that given in Text A?][]"
                                   class="form-control" value="{{$q14[1]}}">
                        </div>
                    </div>

                    <a href="{{ url($submission_pdf) }}" target="_blank" class="btn btn-success">View learner response in a new window</a>



                    <form method="POST" action="{{ route('backend.task.response', ['submission' => $submission_id]) }}">
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
                                            <th scope="col">
                                                Correct/Incorrect
                                                <br>
                                                <button type="button" class="btn btn-sm btn-light mt-1" id="toggle-all-btn">Select All</button>
                                            </th>

                                            <th scope="col">Assessor Feedback</th>
                                            <th scope="col">Grade</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for($i = 1; $i <= 14; $i++)
                                            <tr>
                                                <td>Question {{ $i }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger toggle-btn" data-correct="false" style="width: 40px;">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    <input type="hidden" name="answers[{{ $i }}]" value="incorrect" class="toggle-input">
                                                </td>
                                                <td>
                                                    <input type="text" name="feedback[{{ $i }}]"  class="form-control">
                                                </td>
                                                <td>
                                                    <input type="number" name="grade[{{ $i }}]" class="form-control grade-input" value="0" min="0" max="2">
                                                </td>
                                            </tr>
                                        @endfor
                                        </tbody>
                                    </table>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all inputs with the class 'grade-input'
            const gradeInputs = document.querySelectorAll('.grade-input');

            // Loop through each input
            gradeInputs.forEach(function(input) {
                // Set the default value to 0 if it's not already set
                if (!input.value) {
                    input.value = 0;
                }

                // Add an input event listener
                input.addEventListener('input', function() {
                    // Get the current value
                    let value = parseInt(input.value);

                    // Restrict the value to 0, 1, or 2
                    if (value < 0) {
                        input.value = 0;
                    } else if (value > 2) {
                        input.value = 2;
                    }
                });
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".grade-input").forEach(function (input) {
                input.addEventListener("input", function () {
                    const grade = parseInt(this.value);
                    const row = this.closest("tr");
                    const toggleBtn = row.querySelector(".toggle-btn");
                    const toggleInput = row.querySelector(".toggle-input");

                    if (grade >= 1) {
                        toggleBtn.classList.remove("btn-danger");
                        toggleBtn.classList.add("btn-success");
                        toggleBtn.innerHTML = '<i class="fas fa-check"></i>';
                        toggleBtn.dataset.correct = "true";
                        toggleInput.value = "correct";
                    } else {
                        toggleBtn.classList.remove("btn-success");
                        toggleBtn.classList.add("btn-danger");
                        toggleBtn.innerHTML = '<i class="fas fa-times"></i>';
                        toggleBtn.dataset.correct = "false";
                        toggleInput.value = "incorrect";
                    }
                });
            });

            // Optional: also handle click toggle manually
            document.querySelectorAll(".toggle-btn").forEach(function (btn) {
                btn.addEventListener("click", function () {
                    const input = this.nextElementSibling;
                    const current = this.dataset.correct === "true";

                    if (current) {
                        this.classList.remove("btn-success");
                        this.classList.add("btn-danger");
                        this.innerHTML = '<i class="fas fa-times"></i>';
                        this.dataset.correct = "false";
                        input.value = "incorrect";
                    } else {
                        this.classList.remove("btn-danger");
                        this.classList.add("btn-success");
                        this.innerHTML = '<i class="fas fa-check"></i>';
                        this.dataset.correct = "true";
                        input.value = "correct";
                    }
                });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButtons = document.querySelectorAll('.toggle-btn');
            const toggleInputs = document.querySelectorAll('.toggle-input');
            const toggleAllBtn = document.getElementById('toggle-all-btn');

            // Individual toggle logic
            toggleButtons.forEach((btn, index) => {
                btn.addEventListener('click', function () {
                    const isCorrect = btn.dataset.correct === 'true';
                    btn.dataset.correct = (!isCorrect).toString();

                    // Update button class and icon
                    if (!isCorrect) {
                        btn.classList.remove('btn-danger');
                        btn.classList.add('btn-success');
                        btn.innerHTML = '<i class="fas fa-check"></i>';
                        toggleInputs[index].value = 'correct';
                    } else {
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-danger');
                        btn.innerHTML = '<i class="fas fa-times"></i>';
                        toggleInputs[index].value = 'incorrect';
                    }
                });
            });

            // Select All / Deselect All toggle logic
            let allSelected = false;

            toggleAllBtn.addEventListener('click', function () {
                allSelected = !allSelected;
                toggleAllBtn.textContent = allSelected ? 'Deselect All' : 'Select All';

                toggleButtons.forEach((btn, index) => {
                    btn.dataset.correct = allSelected.toString();
                    if (allSelected) {
                        btn.classList.remove('btn-danger');
                        btn.classList.add('btn-success');
                        btn.innerHTML = '<i class="fas fa-check"></i>';
                        toggleInputs[index].value = 'correct';
                    } else {
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-danger');
                        btn.innerHTML = '<i class="fas fa-times"></i>';
                        toggleInputs[index].value = 'incorrect';
                    }
                });
            });
        });
    </script>


@endpush
