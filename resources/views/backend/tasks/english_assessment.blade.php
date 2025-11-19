@extends('layouts.main')

@section('title', 'User')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css"
        integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bgBoxGray .d-flex>label {
            font-weight: 400;
        }
    </style>
@endpush

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
                    <div class="row headerDetail">
                        <div class="col-6">
                            <h1>Initial English Assessment</h1>
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
                    <input type="hidden" name="course_id" value="{{ $course_id }}" />
                    <input type="hidden" name="cohort_id" value="{{ $cohort_id }}" />
                    <input type="hidden" name="trainer_id" value="{{ $trainer_id }}" />

                    <div class="form-step" id="step-1" data-step="1">
                        <div class="studyAssessment">
                            <h2>Step 1</h2>
                            <h4 class="bgStrip">Learner Details</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div>
                                            <label>{{ __('I confirm that:') }}</label>
                                        </div>

                                        <div class="d-flex">
                                            <input type="checkbox" name="data[I confirm that][]" required
                                                   value="I received no help in answering the questions in this examination paper." />
                                            <label class="mb-0 ml-2">I received no help in answering the questions in this
                                                examination paper.</label>
                                        </div>

                                        <div class="d-flex">
                                            <input type="checkbox" name="data[I confirm that][]" required
                                                   value="I am the person stated above on this form." />
                                            <label class="mb-0 ml-2">I am the person stated above on this form.</label>
                                        </div>

                                        <div class="d-flex">
                                            <input type="checkbox" name="data[I confirm that][]" required
                                                   value="I will not discuss the content of the examination with anyone else." />
                                            <label class="mb-0 ml-2">I will not discuss the content of the examination with
                                                anyone else.</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('First Name') }}<span>*</span></label>
                                        <input type="text" id="first_name" name="data[first_name]" class="form-control"
                                            value="{{ auth()->user()->name ?? '' }}" readonly />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Last Name') }}<span>*</span></label>
                                        <input type="text" id="last_name" name="data[last_name]" class="form-control"
                                            value="{{ auth()->user()->last_name ?? '' }}" readonly />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('Learner Signature') }}<span>*</span></label>
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
                                                    <button type="button" class="btn btn-danger" id="clear-signature">
                                                        Clear
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="signature" id="signature-input-paf" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        @php $now = new DateTime(); @endphp
                                        <label>{{ __('Date, Time Assessment Completed') }}</label>
                                        <input type="text" id="assessment_date" name="data[assessment_date]"
                                            class="form-control" value="{{ $now->format('Y-m-d H:i') }}" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="next-btn btn btn-primary" id="next-1" disabled>Next</button>
                    </div>

                    <div class="form-step" id="step-2" data-step="2">
                        <div class="studyAssessment">
                            <h2>Step 2</h2>
                            <p>Dear {{ $username }}</p>
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
                                            <span>Please select one answer. (1 Point)</span></label>
                                        <div class="d-flex">
                                            <input type="radio" name="data[Q1. What is the main purpose of Text A?][]"
                                                value="To describe" />
                                            <label class="mb-0 ml-2">To describe</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="radio" name="data[Q1. What is the main purpose of Text A?][]"
                                                value="To explain" />
                                            <label class="mb-0 ml-2">To explain</label>
                                        </div>
                                        <div class="d-flex">
                                            <input type="radio" name="data[Q1. What is the main purpose of Text A?][]"
                                                value="To persuade" />
                                            <label class="mb-0 ml-2">To persuade</label>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Q2. According to Text A, how long will the roadworks take?
                                            <span>Please select one answer. (1 Point)</span></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q2. According to Text A, how long will the roadworks take?][]"
                                                        value="As long as it takes" />
                                                    <label class="mb-0 ml-2">As long as it takes</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q2. According to Text A, how long will the roadworks take?][]"
                                                        value="2 weeks" />
                                                    <label class="mb-0 ml-2">2 weeks</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q2. According to Text A, how long will the roadworks take?][]"
                                                        value="9 days" />
                                                    <label class="mb-0 ml-2">9 days</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q2. According to Text A, how long will the roadworks take?][]"
                                                        value="Long periods" />
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
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q3. According to Text A, how does the council plan to reduce congestion?][]"
                                                        value="By keeping local businesses open" />
                                                    <label class="mb-0 ml-2">By keeping local businesses open</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q3. According to Text A, how does the council plan to reduce congestion?][]"
                                                        value="By resurfacing the road" />
                                                    <label class="mb-0 ml-2">By resurfacing the road</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q3. According to Text A, how does the council plan to reduce congestion?][]"
                                                        value="By using temporary traffic lights" />
                                                    <label class="mb-0 ml-2">By using temporary traffic lights</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q3. According to Text A, how does the council plan to reduce congestion?][]"
                                                        value="By using heavy machinery" />
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
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q4. According to Text A, who can use the park-and-ride service at a reduced cost?][]"
                                                        value="People living on Main Street" />
                                                    <label class="mb-0 ml-2">People living on Main Street</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q4. According to Text A, who can use the park-and-ride service at a reduced cost?][]"
                                                        value="Dee Rose" />
                                                    <label class="mb-0 ml-2">Dee Rose</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q4. According to Text A, who can use the park-and-ride service at a reduced cost?][]"
                                                        value="Council employees" />
                                                    <label class="mb-0 ml-2">Council employees</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q4. According to Text A, who can use the park-and-ride service at a reduced cost?][]"
                                                        value="Businesses on Main Street" />
                                                    <label class="mb-0 ml-2">Businesses on Main Street</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Q5. The writer of Text A states’ we will be heavy machinery to carry out the
                                            work’. Is this a fact or an opinion? <span>Please select one answer. (1
                                                Point)</span></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q5. The writer of Text A states’ we will be heavy machinery to carry out the work’. Is this a fact or an opinion?][]"
                                                        value="Fact" />
                                                    <label class="mb-0 ml-2">Fact</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q5. The writer of Text A states’ we will be heavy machinery to carry out the work’. Is this a fact or an opinion?][]"
                                                        value="Opinion" />
                                                    <label class="mb-0 ml-2">Opinion</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label><strong>Give a reason for your answer.</strong><br /><span>Please
                                                        write a paragraph which consists of approximately
                                                        3-4 sentences</span></label>
                                                <textarea
                                                    name="data[Q5_reason]"
                                                    id="" cols="30" rows="10"></textarea>
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
                                                    class="form-control" />
                                            </div>
                                            <div class="col-6">
                                                <label>Example 2</label>
                                                <input type="text"
                                                    name="data[Q6. Using Text A, identify two instruction given by Dee Rose to residents of Main Street][]"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Q7. Is Text A formal or informal? Give a reason for your answer. <span>Please
                                                select one answer. (2 Marks)</span></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q7. Is Text A formal or informal? Give a reason for your answer][]"
                                                        value="Formal" />
                                                    <label class="mb-0 ml-2">Formal</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q7. Is Text A formal or informal? Give a reason for your answer][]"
                                                        value="Informal" />
                                                    <label class="mb-0 ml-2">Informal</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label><strong>Give a reason for your answer.</strong><br /><span>Please
                                                        write a paragraph which consists of approximately
                                                        3-4 sentences</span></label>
                                                <textarea name="data[Q7. Is Text A formal or informal? Give a reason for your answer][]" id=""
                                                    cols="30" rows="10"></textarea>
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
                        <div class="studyAssessment">
                            <h2>Step 3</h2>
                            <p>Dear {{ $username }}</p>
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
                                                <p><small>Apprentices are paid a salary by their employer and the cost of
                                                        training is covered. You will therefore be earning as you are
                                                        learning, with the added bonus of no tuition fees, no student loans
                                                        and hopefully no debt! Most of your learning is completed
                                                        'on-the-job' giving you the chance to put new skills immediately
                                                        into practice and gain confidence in a working environment.</small>
                                                </p>
                                                <p><small>The apprenticeship programme is continually growing. Higher level
                                                        apprenticeships are now available so why not aim to gain a
                                                        nationally recognised qualification at level 4 or above (the
                                                        equivalent to a higher education diploma or a foundation
                                                        degree)?</small></p>
                                                <p><small>Employers value apprenticeships as a way of helping their
                                                        workforce to develop their skills and progress their careers.
                                                        Employers see apprenticeships as a good way to provide training in
                                                        their workplace rather than at college, helping to ensure that the
                                                        specific needs of their business are met. Funding is also available
                                                        to employers that train 16 to 24-year old apprentices.</small></p>
                                                <p><strong><small>It's clear that now is a good time to sign up for an
                                                            apprenticeship programme!</small></strong></p>
                                            </div>
                                            <h4>Apprenticeship Opportunities :</h4>
                                            <p>Apprenticeships are currently available in many Industries including:</p>
                                            <div class="row">
                                                <div class="col-8">
                                                    <ul>
                                                        <li>business and administration </li>
                                                        <li>catering </li>
                                                        <li>health and social care </li>
                                                        <li>retail </li>
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
                                            <p>The job centre on Main Street has limited access due to roadworks, with heavy
                                                machinery present on site. The job centre is therefore experiencing some
                                                disruption and caution is advised if attending on foot or if parking in the
                                                area. As an alternative, please visit one of our other branches on Townhead
                                                Road or Northern Street.</p>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Q8. What is the meaning of the term "added bonus", as used in Text B?
                                            <span>Please select one answer. (1 Mark)</span></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q8. What is the meaning of the term added bonus as used in Text B?][]"
                                                        value="A student loan" />
                                                    <label class="mb-0 ml-2">A student loan</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q8. What is the meaning of the term added bonus as used in Text B?][]"
                                                        value="A disadvantage" />
                                                    <label class="mb-0 ml-2">A disadvantage</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q8. What is the meaning of the term added bonus as used in Text B?][]"
                                                        value="A benefit" />
                                                    <label class="mb-0 ml-2">A benefit</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q8. What is the meaning of the term added bonus as used in Text B?][]"
                                                        value="An extra payment" />
                                                    <label class="mb-0 ml-2">An extra payment</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Q9. In Text B, which organisational feature is used to demonstrate the
                                            benefits of an apprenticeship? <span>Please select one answer. (1
                                                Mark)</span></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?][]"
                                                        value="Paragraphs" />
                                                    <label class="mb-0 ml-2">Paragraphs</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?][]"
                                                        value="Heading" />
                                                    <label class="mb-0 ml-2">Heading</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?][]"
                                                        value="Subheadings" />
                                                    <label class="mb-0 ml-2">Subheadings</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q9. In Text B, which organisational feature is used to demonstrate the benefits of an apprenticeship?][]"
                                                        value="Bullet points" />
                                                    <label class="mb-0 ml-2">Bullet points</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Q10. Using Text B, which of these statements is incorrect? <span>Please
                                                select one answer. (1 Mark)</span></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q10. Using Text B, which of these statements is incorrect?][]"
                                                        value="Apprentices earn a salary" />
                                                    <label class="mb-0 ml-2">Apprentices earn a salary</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q10. Using Text B, which of these statements is incorrect?][]"
                                                        value="National Apprenticeship Week is in the summer" />
                                                    <label class="mb-0 ml-2">National Apprenticeship Week is in the
                                                        summer</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q10. Using Text B, which of these statements is incorrect?][]"
                                                        value="Job centres have more details" />
                                                    <label class="mb-0 ml-2">Job centres have more details</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q10. Using Text B, which of these statements is incorrect?][]"
                                                        value="Apprenticeship are only available to teenagers" />
                                                    <label class="mb-0 ml-2">Apprenticeship are only available to
                                                        teenagers</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Q11. According to Text B, most of the training takes place. <span>Please
                                                select one answer. (1 Mark)</span></label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q11. According to Text B, most of the training takes place][]"
                                                        value="At the job centre" />
                                                    <label class="mb-0 ml-2">At the job centre</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q11. According to Text B, most of the training takes place][]"
                                                        value="In the workplace" />
                                                    <label class="mb-0 ml-2">In the workplace</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q11. According to Text B, most of the training takes place][]"
                                                        value="At university" />
                                                    <label class="mb-0 ml-2">At university</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                        name="data[Q11. According to Text B, most of the training takes place][]"
                                                        value="At college" />
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
                                            id="" cols="30" rows="10" style="display: block;"></textarea>
                                    </div>
                                    <div class="form-group bgBoxGray">
                                        <label>Q13. Explain why the author has used exclamation marks in Text B.<span>(1
                                                mark)</span></label>
                                        <p>Please write a paragraph which consists of approximately 3-4 sentences</p>
                                        <textarea name="data[Q13. Explain why the author has used exclamation marks in Text B]" id="" cols="30"
                                            rows="10" style="display: block;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="prev-btn btn bg-gray">Previous</button>
                        <button type="button" class="next-btn btn btn-primary" id="next-3" disabled>Next</button>
                    </div>

                    <div class="form-step" id="step-4" data-step="4">
                        <h2>Step 4</h2>
                        <p>Dear {{ $username }}</p>
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
                            <label>Q14. How does the information about roadworks in Text B compare with that given in Text
                                A?<span>Give two examples. (2 marks)</span></label>
                            <div class="form-group requiredRole">
                                <label>Example 1</label>
                                <input type="text"
                                    name="data[Q14. How does the information about roadworks in Text B compare with that given in Text A?][]"
                                    class="form-control">
                            </div>
                            <div class="form-group requiredRole">
                                <label>Example 2</label>
                                <input type="text"
                                    name="data[Q14. How does the information about roadworks in Text B compare with that given in Text A?][]"
                                    class="form-control">
                            </div>
                        </div>
                        <button type="button" class="prev-btn btn bg-gray">Previous</button>
                        <button type="submit" id="previewButton" class="btn btn-primary">Finish & Preview</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="PreviewApp" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
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
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
        integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            function checkFormCompletion(step) {
                var isValid = true;
                // Check all required inputs in the current step
                $('#step-' + step).find('input[required]:not([type=checkbox]), textarea[required]').each(function() {
                //$('#step-' + step).find('input[required], textarea[required]').each(function() {
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

                // ✅ NEW: Check if all required checkboxes are ticked
                $('#step-' + step).find('input[type="checkbox"][required]').each(function() {
                    if (!$(this).is(':checked')) {
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
                    // console.log("Captured Signature:", signatureDataUrl);
                    document.getElementById('signature-input-paf').value = signatureDataUrl;
                }
            });

            $(document).on('click', '#previewButton', function(e) {
                e.preventDefault();

                function validateForm() {
                    let isValid = true;

                    $('.requiredRole input, .requiredRole textarea').each(function() {
                        if ($(this).val().trim() === '') {
                            isValid = false;
                            $(this).addClass('is-invalid');
                            $(this).next('.invalid-feedback').remove(); // Remove existing feedback
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

                if (!validateForm('.requiredRole input, .requiredRole textarea', '.validList input')) {
                    $('#PreviewApp').modal('hide');
                    return;
                }

                const signatureDataUrl = signaturePad.toDataURL();
                document.getElementById('signature-input-paf').value = signatureDataUrl;

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
                        setTimeout(() => {
                            $('#loadingSpinner').hide();
                            window.location = "{{ route('backend.learner.dashboard') }}"
                            button.prop('disabled', false);
                            form[0].reset();
                            $('#PreviewApp').modal('hide');
                        }, 2000);
                    })
                    .catch(function(err) {
                        $('#loadingSpinner').hide();
                        console.error(err);
                        button.prop('disabled', false);
                    });
            });
        });
    </script>
@endpush
