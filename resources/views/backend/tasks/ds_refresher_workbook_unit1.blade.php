@extends('layouts.main')

@section('title', 'User')

@section('main')
    <div class="formWrapper">
        <div class="row">
            <div class="col-12">

                @php
                    $cohot = \App\Models\Cohort::find($cohort_id);
                    $start_date = optional($cohot)->start_date_time ? \Carbon\Carbon::parse($cohot->start_date_time)->format('Y-m-d') : '';
                    $end_date = optional($cohot)->end_date_time ? \Carbon\Carbon::parse($cohot->end_date_time)->format('Y-m-d') : '';
                @endphp

                @php

                    if(isset($learner_response["Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity"])){

                        $answers1 = $learner_response["Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity"] ?? [];
                        if (!is_array($answers1)) $answers1 = [];
                        $answers2a = $learner_response["Q2a. Identify THREE occasions when a door supervisor has the right to search"] ?? [];
                        if (!is_array($answers2a)) $answers2a = [];
                        $answers2b_single = $learner_response["Q2b Single sex"] ?? "";
                        $answers2b_trans = $learner_response["Q2b Transgender individuals"] ?? "";
                        $answers3 = $learner_response["Q3. Identify SEVEN different types of equipment that can be used to assist with searches"] ?? [];
                        if (!is_array($answers3)) $answers3 = [];
                        $answers4 = $learner_response["Q4. Identify SEVEN hazards you may encounter when conducting searches"] ?? [];
                        if (!is_array($answers4)) $answers4 = [];
                        $answers5 = $learner_response["Q5. State NINE precautions that you can take when carrying out a search"] ?? [];
                        if (!is_array($answers5)) $answers5 = [];
                        $answers6 = $learner_response["Q6. State the actions to take if an incident or an accident occurs"] ?? "";
                        $answers7 = $learner_response["Q7. Identify FIVE reasons for carrying out a premises search"] ?? [];
                        if (!is_array($answers7)) $answers7 = [];
                        $answers8 = $learner_response["Q8. State FOUR actions to take in the event of a search refusal"] ?? [];
                        if (!is_array($answers8)) $answers8 = [];
                        $answers9 = $learner_response["Q9. Identify FOUR reasons for completing search documentation"] ?? [];
                        if (!is_array($answers9)) $answers9 = [];
                        $answers10 = $learner_response["Q10. actions to take if a prohibited or restricted item is found during a search"] ?? [];
                        if (!is_array($answers10)) $answers10 = [];
                        $answers11a = $learner_response["Q11a. Explain what is meant by duty of care"] ?? "";
                        $answers11b = $learner_response["Q11b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable"] ?? "";
                        $answers12a = $learner_response["Q12a. Identify FIVE factors that could make someone vulnerable or more at risk than others"] ?? [];
                        if (!is_array($answers12a)) $answers12a = [];
                        $answers12b = $learner_response["Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others"] ?? [];
                        if (!is_array($answers12b)) $answers12b = [];
                        $answers13 = $learner_response["Q13. Identify FIVE actions that you should take towards vulnerable individuals"] ?? [];
                        if (!is_array($answers13)) $answers13 = [];
                        $answers14 = $learner_response["Q14. Identify FOUR behaviours that may be exhibited by sexual predators"] ?? [];
                        if (!is_array($answers14)) $answers14 = [];
                        $answers15 = $learner_response["Q15. Identify FOUR indicators of abuse"] ?? [];
                        if (!is_array($answers15)) $answers15 = [];
                        $answers16 = $learner_response["Q16. State how to deal with allegations of sexual assault"] ?? "";
                        $answers18 = $learner_response["Q18. Identify the FIVE different threat levels"] ?? [];
                        if (!is_array($answers18)) $answers18 = [];
                        $answers19 = $learner_response["Q19. What are the most common terror attack methods?"] ?? "";
                        $answers20 = $learner_response["Q20. Explain the actions you should take in the event of a terror threat at the venue or site"] ?? "";
                        $answers21 = $learner_response["Q21. Identify the procedures for dealing with suspicious items"] ?? "";
                        $answers22 = $learner_response["Q22. Identify SIX behaviours that could indicate suspicious activity"] ?? [];
                        if (!is_array($answers22)) $answers22 = [];
                        $answers23 = $learner_response["Q23. Identify how you should respond to suspicious behaviour"] ?? "";
                        $answers24 = $learner_response["Q24. State FIVE methods of spiking"] ?? [];
                        if (!is_array($answers24)) $answers24 = [];
                        $answers25 = $learner_response["Q25. State the law in relation to spiking"] ?? "";
                        $answers26 = $learner_response["Q26. State FIVE indicators that suggests a drink has been spiked"] ?? [];
                        if (!is_array($answers26)) $answers26 = [];
                        $answers27 = $learner_response["Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks"] ?? [];
                        if (!is_array($answers27)) $answers27 = [];
                        $answers28 = $learner_response["Q28. Identify THREE situations when an individual might be at high risk of spiking"] ?? [];
                        if (!is_array($answers28)) $answers28 = [];
                        $answers29 = $learner_response["Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking"] ?? [];
                        if (!is_array($answers29)) $answers29 = [];
                        $answers30 = $learner_response["Q30. Describe the indicators that suggest an individual may have been spiked"] ?? "";
                        $answers31 = $learner_response["Q31. State how to manage a spiking incident"] ?? "";

                    } else {

                        $answers1 = $learner_response['data']["Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity"] ?? [];
                        if (!is_array($answers1)) $answers1 = [];
                        $answers2a = $learner_response['data']["Q2a. Identify THREE occasions when a door supervisor has the right to search"] ?? [];
                        if (!is_array($answers2a)) $answers2a = [];
                        $answers2b_single = $learner_response['data']["Q2b Single sex"] ?? "";
                        $answers2b_trans = $learner_response['data']["Q2b Transgender individuals"] ?? "";
                        $answers3 = $learner_response['data']["Q3. Identify SEVEN different types of equipment that can be used to assist with searches"] ?? [];
                        if (!is_array($answers3)) $answers3 = [];
                        $answers4 = $learner_response['data']["Q4. Identify SEVEN hazards you may encounter when conducting searches"] ?? [];
                        if (!is_array($answers4)) $answers4 = [];
                        $answers5 = $learner_response['data']["Q5. State NINE precautions that you can take when carrying out a search"] ?? [];
                        if (!is_array($answers5)) $answers5 = [];
                        $answers6 = $learner_response['data']["Q6. State the actions to take if an incident or an accident occurs"] ?? "";
                        $answers7 = $learner_response['data']["Q7. Identify FIVE reasons for carrying out a premises search"] ?? [];
                        if (!is_array($answers7)) $answers7 = [];
                        $answers8 = $learner_response['data']["Q8. State FOUR actions to take in the event of a search refusal"] ?? [];
                        if (!is_array($answers8)) $answers8 = [];
                        $answers9 = $learner_response['data']["Q9. Identify FOUR reasons for completing search documentation"] ?? [];
                        if (!is_array($answers9)) $answers9 = [];
                        $answers10 = $learner_response['data']["Q10. actions to take if a prohibited or restricted item is found during a search"] ?? [];
                        if (!is_array($answers10)) $answers10 = [];
                        $answers11a = $learner_response['data']["Q11a. Explain what is meant by duty of care"] ?? "";
                        $answers11b = $learner_response['data']["Q11b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable"] ?? "";
                        $answers12a = $learner_response['data']["Q12a. Identify FIVE factors that could make someone vulnerable or more at risk than others"] ?? [];
                        if (!is_array($answers12a)) $answers12a = [];
                        $answers12b = $learner_response['data']["Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others"] ?? [];
                        if (!is_array($answers12b)) $answers12b = [];
                        $answers13 = $learner_response['data']["Q13. Identify FIVE actions that you should take towards vulnerable individuals"] ?? [];
                        if (!is_array($answers13)) $answers13 = [];
                        $answers14 = $learner_response['data']["Q14. Identify FOUR behaviours that may be exhibited by sexual predators"] ?? [];
                        if (!is_array($answers14)) $answers14 = [];
                        $answers15 = $learner_response['data']["Q15. Identify FOUR indicators of abuse"] ?? [];
                        if (!is_array($answers15)) $answers15 = [];
                        $answers16 = $learner_response['data']["Q16. State how to deal with allegations of sexual assault"] ?? "";
                        $answers18 = $learner_response['data']["Q18. Identify the FIVE different threat levels"] ?? [];
                        if (!is_array($answers18)) $answers18 = [];
                        $answers19 = $learner_response['data']["Q19. What are the most common terror attack methods?"] ?? "";
                        $answers20 = $learner_response['data']["Q20. Explain the actions you should take in the event of a terror threat at the venue or site"] ?? "";
                        $answers21 = $learner_response['data']["Q21. Identify the procedures for dealing with suspicious items"] ?? "";
                        $answers22 = $learner_response['data']["Q22. Identify SIX behaviours that could indicate suspicious activity"] ?? [];
                        if (!is_array($answers22)) $answers22 = [];
                        $answers23 = $learner_response['data']["Q23. Identify how you should respond to suspicious behaviour"] ?? "";
                        $answers24 = $learner_response['data']["Q24. State FIVE methods of spiking"] ?? [];
                        if (!is_array($answers24)) $answers24 = [];
                        $answers25 = $learner_response['data']["Q25. State the law in relation to spiking"] ?? "";
                        $answers26 = $learner_response['data']["Q26. State FIVE indicators that suggests a drink has been spiked"] ?? [];
                        if (!is_array($answers26)) $answers26 = [];
                        $answers27 = $learner_response['data']["Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks"] ?? [];
                        if (!is_array($answers27)) $answers27 = [];
                        $answers28 = $learner_response['data']["Q28. Identify THREE situations when an individual might be at high risk of spiking"] ?? [];
                        if (!is_array($answers28)) $answers28 = [];
                        $answers29 = $learner_response['data']["Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking"] ?? [];
                        if (!is_array($answers29)) $answers29 = [];
                        $answers30 = $learner_response['data']["Q30. Describe the indicators that suggest an individual may have been spiked"] ?? "";
                        $answers31 = $learner_response['data']["Q31. State how to manage a spiking incident"] ?? "";

                    }
                @endphp

                <form action="{{ route('backend.task.submission') }}" method="POST" id="submitForm"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="task_name" value="{{ $task->name }}" />
                    <input type="hidden" name="task_id" value="{{ $task->id }}" />
                    <input type="hidden" name="course_id" value="{{ $course_id }}" />
                    <input type="hidden" name="cohort_id" value="{{ $cohort_id }}" />
                    <input type="hidden" name="trainer_id" value="{{ $trainer_id }}" />
                    <div class="studyAssessment">
                        <h3 class="floatingpdftitle">DS Refresher WorkBook Unit 1</h3>
                        <div class="floatingpdf d-inline-flex align-items-center justify-content-end overflow-auto position-sticky bg-white float-right" >
                            <div href="{{ asset('resources/DS REFRESHER_Coursebook.pdf') }}" class="popup-pdf"><i
                                    class="fas fa-file-pdf"></i></div>
                        </div>

                        <div class="devider"></div>
                        <p>The Principles of Working as a Door Supervisor in the Private Security Industry
                            (Refresher)</p>
                        <p><strong>Unit 1: Principles of Working as a Door Supervisor in the Private Security Industry
                                (Refresher)</strong></p>
                        <div class="devider"></div>

                        <h4 class="bgStrip">Learner Information</h4>
                        <div class="learnerDeclaration">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Name') }}<span>*</span></label>
                                        <input type="text" id="first_name" name="data[learner_name]" class="form-control"
                                            value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>{{ __('Training Provider:') }}</label>
                                            <input type="text" id="training_provider" value="Training4Employment" name="data[training_provider]"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Course Start Date') }}</label>
                                        <input type="date" id="course_start_date" name="data[info_course_start_date]"
                                               class="form-control" value="{{ $start_date }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Course End Date') }}</label>
                                        <input type="date" id="course_end_date" name="data[info_course_end_date]"
                                               class="form-control" value="{{ $end_date }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="devider"></div>
                        <h4 class="bgStrip">Knowledge questions</h4>
                        <h4 class="bgStripGrey">LO1 Know how to conduct effective search procedures</h4>

                        @php
                            $answers = $learner_response["Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity"] ?? [];
                        @endphp




                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.1 State the different type of searches carried out by a door supervisor') }}</label>
                                    <p>As a door supervisor, you will be required to carry out different types of
                                        searches.
                                    </p>
                                    <label>{{ __('Question 1:') }}</label> State the <label>{{ __('THREE') }}</label> different types of searches that are carried out by a door supervisor.
                                </div>


                                @for ($i = 0; $i < 3; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                               name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"
                                               class="form-control"
                                               value="{{ $answers1[$i] ?? '' }}">
                                    </div>
                                @endfor


{{--                                <div class="d-flex mb-2 align-items-center">--}}
{{--                                    <label class="mr-3">1.</label>--}}
{{--                                    <input type="text"--}}
{{--                                        name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"--}}
{{--                                        class="form-control">--}}
{{--                                </div>--}}
{{--                                <div class="d-flex mb-2 align-items-center">--}}
{{--                                    <label class="mr-3">2.</label>--}}
{{--                                    <input type="text"--}}
{{--                                        name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"--}}
{{--                                        class="form-control">--}}
{{--                                </div>--}}
{{--                                <div class="d-flex mb-2 align-items-center">--}}
{{--                                    <label class="mr-3">3.</label>--}}
{{--                                    <input type="text"--}}
{{--                                        name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"--}}
{{--                                        class="form-control">--}}
{{--                                </div>--}}
                            </div>
                            <div class="devider"></div>
                        </div>

                        @php
                            $answers = $learner_response["Q2a. Identify THREE occasions when a door supervisor has the right to search"] ?? [];
                        @endphp

                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.2 Identify a door supervisor’s right to search') }}</label>
                                    <p>Door supervisors have specific powers related to their duties, but your right to
                                        search individuals is limited. </p>
                                    <label>{{ __('Question 2a:') }}</label> Identify <label>{{ __('THREE') }}</label>
                                    occasions when a door supervisor has the right to search.
                                </div>



                                @for ($i = 0; $i < 3; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                               name="data[Q2a. Identify THREE occasions when a door supervisor has the right to search][]"
                                               class="form-control"
                                               value="{{ $answers2a[$i] ?? '' }}">
                                    </div>
                                @endfor



{{--                                <div class="d-flex mb-2 align-items-center">--}}
{{--                                    <label class="mr-3">1.</label>--}}
{{--                                    <input type="text"--}}
{{--                                        name="data[Q2a. Identify THREE occasions when a door supervisor has the right to search][]"--}}
{{--                                        class="form-control">--}}
{{--                                </div>--}}
{{--                                <div class="d-flex mb-2 align-items-center">--}}
{{--                                    <label class="mr-3">2.</label>--}}
{{--                                    <input type="text"--}}
{{--                                        name="data[Q2a. Identify THREE occasions when a door supervisor has the right to search][]"--}}
{{--                                        class="form-control">--}}
{{--                                </div>--}}
{{--                                <div class="d-flex mb-2 align-items-center">--}}
{{--                                    <label class="mr-3">3.</label>--}}
{{--                                    <input type="text"--}}
{{--                                        name="data[Q2a. Identify THREE occasions when a door supervisor has the right to search][]"--}}
{{--                                        class="form-control">--}}
{{--                                </div>--}}
                                <small class="d-block">When conducting searches on single-sex and transgender
                                    individuals,
                                    door supervisors must follow
                                    guidelines to ensure the process is respectful. <br><strong>More information can be
                                        found at: </strong></small>
                                <small class="d-block">Guidance on conducting a search is available on paragraphs
                                    13.57-13.60 on pages 197 to 198 of the
                                    Equality and Human Rights Commission guidance at:
                                    <br><strong>https://www.equalityhumanrights.com/sites/default/files/servicescode_0.pdf
                                    </strong></small>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">

                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('Question 2b ') }}</label>
                                    <p>Explain the search process required when carrying out:</p>
                                    <ul>
                                        <li>single sex searches</li>
                                        <li>transgender individuals’ searches</li>
                                    </ul>
                                </div>
                                <div class="mb-3">
                                    <label>Single sex</label>
                                    <input type="text" name="data[Q2b Single sex]" class="form-control" value="{{ $answers2b_single }}">
                                </div>
                                <div class="mb-3">
                                    <label>Transgender individuals</label>
                                    <input type="text" name="data[Q2b Transgender individuals]" class="form-control" value="{{ $answers2b_trans }}">
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.3 Identify the different types of searching equipment') }}</label>
                                    <p>As a door supervisor, you may be required to search staff, visitors or customers
                                        at a
                                        site before allowing entry.</p>
                                    <label>{{ __('Question 3:') }}</label> Identify <label>{{ __('SEVEN') }}</label>
                                    different types of equipment that can be used to assist with searches.
                                </div>
                                @for ($i = 0; $i < 7; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                            class="form-control"
                                            value="{{ $answers3[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.4 Recognise possible hazards when conducting a search') }}</label>
                                    <p>Door supervisors may encounter various potential hazards when conducting
                                        searches.
                                    </p>
                                    <label>{{ __('Question 4:') }}</label> Identify <label>{{ __('SEVEN') }}</label>
                                    hazards you may encounter when conducting searches.
                                </div>
                                @for ($i = 0; $i < 7; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                            class="form-control"
                                            value="{{ $answers4[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.5 State the precautions to take when carrying out a search') }}</label>
                                    <p>AC1.5 State the precautions to take when carrying out a search</p>
                                    <label>{{ __('Question 5:') }}</label> State <label>{{ __('NINE') }}</label>
                                    precautions that you can take when carrying out a search.
                                </div>
                                @for ($i = 0; $i < 9; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                            class="form-control"
                                            value="{{ $answers5[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC1.6 State the actions to take if an incident or an accident occurs') }}</label>
                                    <p>From time to time, incidents or accidents may occur; it is important to always
                                        follow
                                        the venue’s policy or
                                        assignment instructions.</p>
                                    <label>{{ __('Question 6:') }}</label>
                                    <p>State the actions to take if an incident or an accident occurs.</p>
                                    <textarea name="data[Q6. State the actions to take if an incident or an accident occurs]" cols="30"
                                        rows="10" class="form-control">{{ $answers6 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.8 Identify the reasons for carrying out a premises search') }}</label>
                                    <p>As well as searching people, you may be required to carry out a premises
                                        search. </p>
                                    <label>{{ __('Question 7:') }}</label> Identify <label>{{ __('FIVE') }}</label> reasons for carrying out a premises search.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q7. Identify FIVE reasons for carrying out a premises search][]"
                                            class="form-control"
                                            value="{{ $answers7[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.9 Recognise actions to take in the event of a search refusal') }}</label>
                                    <p>Individuals may refuse to be searched or to have their belongings searched. Any
                                        refusals should be handled
                                        according to the venue’s policy or assignment instructions.</p>
                                    <label>{{ __('Question 8:') }}</label> State <label>{{ __('FOUR') }}</label>
                                    actions to take in the event of a search refusal.
                                </div>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q8. State FOUR actions to take in the event of a search refusal][]"
                                            class="form-control"
                                            value="{{ $answers8[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.10 Identify reasons for completing search documentation.') }}</label>
                                    <p>Venues that require the security team to search people or their property must
                                        provide
                                        a suitable method of
                                        recording searches. </p>
                                    <label>{{ __('Question 9:') }}</label> Identify <label>{{ __('FOUR') }}</label>
                                    reasons for completing search documentation.
                                </div>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q9. Identify FOUR reasons for completing search documentation][]"
                                            class="form-control"
                                            value="{{ $answers9[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.11 Identify actions to take if a prohibited or restricted item is found during a search') }}</label>
                                    <p>Any stolen, illegal or unauthorised items found during a search must be delt with
                                        correctly. </p>
                                    <label>{{ __('Question 10:') }}</label> Identify <label>{{ __('SIX') }}</label>
                                    actions to take if a prohibited or restricted item is found during a search.
                                </div>
                                @for ($i = 0; $i < 6; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q10. actions to take if a prohibited or restricted item is found during a search][]"
                                            class="form-control"
                                            value="{{ $answers10[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <h4 class="bgStripGrey">LO2 Understand how to keep vulnerable people safe</h4>
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC2.1 Recognise duty of care with regard to vulnerable people') }}</label>
                                    <p>As a door supervisor you have a duty of care to vulnerable people that enter the
                                        premises.</p>
                                    <label>{{ __('Question 11a:') }}</label>
                                    Explain what is meant by duty of care.
                                    <textarea name="data[Q11a. Explain what is meant by duty of care]" cols="30" rows="10"
                                        class="form-control">{{ $answers11a }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('Question 11b:') }}</label>
                                    Explain why it is important to have a duty of care for everyone, even if they do not
                                    appear to be vulnerable.
                                    <textarea
                                        name="data[Q11b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable]"
                                        cols="30" rows="10" class="form-control">{{ $answers11b }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>

                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC2.2 Identify factors that could make someone vulnerable') }}</label>
                                    <p>As a door supervisor, you need to be aware of individuals who may be considered
                                        vulnerable due to various factors. </p>
                                    <label>{{ __('Question 12a:') }}</label> Identify <label>{{ __('FIVE') }}</label>
                                    factors that could make someone vulnerable or more at risk than others.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q12a. Identify FIVE factors that could make someone vulnerable or more at risk than others][]"
                                            class="form-control"
                                            value="{{ $answers12a[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('Question 12b:') }}</label> Explain why the
                                    <label>{{ __('FIVE') }}</label>
                                    factors you identified in question 12a could make someone vulnerable or more at risk
                                    than others.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others][]"
                                            class="form-control" value="{{ $answers12b[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC2.3 Identify actions that the security operative should take towards vulnerable individuals') }}</label>
                                    <p>In your professional judgement, if a person appears to be vulnerable, you need to
                                        consider what help they might need.</p>
                                    <label>{{ __('Question 13:') }}</label> Identify <label>{{ __('FIVE') }}</label>
                                    actions that you should take towards vulnerable individuals.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q13. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                            class="form-control"
                                            value="{{ $answers13[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC2.4 Identify behaviours that may be exhibited by sexual predators') }}</label>
                                    <p>As a door supervisor, you must be able to identify behaviours that may be
                                        exhibited
                                        by sexual predators.</p>
                                    <label>{{ __('Question 14:') }}</label> Identify <label>{{ __('FOUR') }}</label>
                                    behaviours that may be exhibited by sexual predators.
                                </div>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q14. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                            class="form-control"
                                            value="{{ $answers14[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC2.5 Identify indicators of abuse') }}</label>
                                    <p>There are several identifying indicators of abuse that a door supervisor can look
                                        out
                                        for.</p>
                                    <label>{{ __('Question 15:') }}</label> Identify <label>{{ __('FOUR') }}</label>
                                    indicators of abuse.
                                </div>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text" name="data[Q15. Identify FOUR indicators of abuse][]"
                                        class="form-control" value="{{ $answers15[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC2.6 State how to deal with allegations of sexual assault') }}</label>
                                    <p>Door supervisors regularly wear uniforms. Some people find this reassuring and
                                        may
                                        choose to tell the operative
                                        about the abuse they have been subjected to. This is called disclosure. </p>
                                    <label>{{ __('Question 16:') }}</label>
                                    State how to deal with allegations of sexual assault.
                                    <textarea name="data[Q16. State how to deal with allegations of sexual assault]" cols="30" rows="10"
                                        class="form-control">{{ $answers16 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <h4 class="bgStripGrey">LO3 Understand terror threats and the role of the security operative
                                in
                                the event of a threat</h4>
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC3.1 Identify the different threat levels') }}</label>
                                    <p>Threat levels are designed to give a broad indication of the likelihood of a
                                        terrorist attack</p>
                                    <label>{{ __('Question 18:') }}</label>
                                    Identify the FIVE different threat levels.
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">1.</label>
                                        <input type="text"
                                            name="data[Q18. Identify the FIVE different threat levels][]"
                                            class="form-control"
                                            value="{{ $answers18[0] ?? '' }}">
                                    </div>
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">2.</label>
                                        <input type="text"
                                            name="data[Q18. Identify the FIVE different threat levels][]"
                                            class="form-control"
                                            value="{{ $answers18[1] ?? '' }}">
                                    </div>
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">3.</label>
                                        <input type="text"
                                            name="data[Q18. Identify the FIVE different threat levels][]"
                                            class="form-control"
                                            value="{{ $answers18[2] ?? '' }}">
                                    </div>
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">4.</label>
                                        <input type="text"
                                            name="data[Q18. Identify the FIVE different threat levels][]"
                                            class="form-control"
                                            value="{{ $answers18[3] ?? '' }}">
                                    </div>
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">5.</label>
                                        <input type="text"
                                            name="data[Q18. Identify the FIVE different threat levels][]"
                                            class="form-control"
                                            value="{{ $answers18[4] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC3.2 Recognise the common terror attack methods') }}</label>
                                    <p>It is important to be aware of the common methods used in terror attacks. </p>
                                    <label>{{ __('Question 19:') }}</label>
                                    What are the most common terror attack methods?
                                    <textarea name="data[Q19. What are the most common terror attack methods?]" cols="30" rows="10"
                                        class="form-control">{{ $answers19 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC3.3 Recognise the actions to take in the event of a terror threat') }}</label>
                                    <p>The role of a door supervisor during a terror attack will be outlined in the
                                        venue or
                                        site’s policies and procedures.</p>
                                    <label>{{ __('Question 20:') }}</label>
                                    Explain the actions you should take in the event of a terror threat at the venue or site.
                                    <textarea name="data[Q20. Explain the actions you should take in the event of a terror threat at the venue or site]"
                                        cols="30" rows="10" class="form-control">{{ $answers20 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC3.4 Identify the procedures for dealing with suspicious items') }}</label>
                                    <p>As a door supervisor, you need to be aware of suspicious packages and the
                                        procedures
                                        to follow if one is identified.</p>
                                    <label>{{ __('Question 21:') }}</label>
                                    Identify the procedures for dealing with suspicious items.
                                    <textarea name="data[Q21. Identify the procedures for dealing with suspicious items]" cols="30" rows="10"
                                        class="form-control">{{ $answers21 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>AC3.5 Identify behaviours that could indicate suspicious activity</label>
                                    <p>Suspicious activity is any observed behaviour that could indicate terrorism or
                                        terrorism-related crime.</p>
                                    <label>Question 22:</label> Identify <label>SIX</label>
                                    behaviours that could indicate suspicious activity.
                                </div>
                                @for ($i = 0; $i < 6; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q22. Identify SIX behaviours that could indicate suspicious activity][]"
                                            class="form-control" value="{{ $answers22[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC3.6 Identify how to respond to suspicious behaviour') }}</label>
                                    <p>As a door supervisor, you shouldn’t be afraid of responding when you suspect
                                        suspicious behaviour. </p>
                                    <label>{{ __('Question 23:') }}</label>
                                    Identify how you should respond to suspicious behaviour.
                                    <textarea name="data[Q23. Identify how you should respond to suspicious behaviour]" cols="30" rows="10"
                                        class="form-control">{{ $answers23 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <h4 class="bgStripGrey">LO4 Know how to safeguard the public from incidents of spiking</h4>
                            <div class="form-group validList">
                                <div>
                                    <label>AC4.1 State methods of spiking</label>
                                    <p>As a door supervisor, it is important to understand what spiking is and how to
                                        recognise it and prevent incidents from occurring.</p>
                                    <label>Question 24:</label> State <label>FIVE</label>
                                    methods of spiking.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text" name="data[Q24. State FIVE methods of spiking][]"
                                        class="form-control" value="{{ $answers24[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC4.2 State the law in relation to spiking') }}</label>
                                    <p>It is important that you understand the laws in relation to spiking when working
                                        as a
                                        door supervisor. </p>
                                    <label>{{ __('Question 25:') }}</label>
                                    State the law in relation to spiking.
                                    <textarea name="data[Q25. State the law in relation to spiking]" cols="30" rows="10" class="form-control">{{ $answers25 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>AC4.3 State indicators that drinks have been spiked</label>
                                    <p>There are visual indicators that may suggest a person’s drink has been
                                        spiked.</p>
                                    <label>Question 26:</label> State <label>FIVE</label>
                                     indicators that suggests a drink has been spiked.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q26. State FIVE indicators that suggests a drink has been spiked][]"
                                            class="form-control" value="{{ $answers26[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>AC4.4 Identify behavioural signs of an individual attempting to spike drinks
                                    </label>
                                    <p>As a door supervisor, there are behavioural signs that may indicate a person is
                                        attempting to spike a drink.</p>
                                    <label>Question 27:</label> State <label>FIVE</label>
                                    behavioural signs of an individual attempting to spike drinks.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks][]"
                                            class="form-control" value="{{ $answers27[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>AC4.5 Identify situations when an individual might be at high risk of
                                        spiking</label>
                                    <p>There are several situations where an individual might be at high risk of
                                        spiking.
                                    </p>
                                    <label>Question 28:</label> Identify <label>THREE</label>
                                    situations when an individual might be at high risk of spiking.
                                </div>
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q28. Identify THREE situations when an individual might be at high risk of spiking][]"
                                            class="form-control" value="{{ $answers28[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>AC4.6 State actions door supervisors and/or venues may take to prevent
                                        incidents
                                        of spiking</label>
                                    <p>There are several actions you and the venue can take to prevent incidents of
                                        spiking.
                                    </p>
                                    <label>Question 29:</label> State <label>FIVE</label>
                                    actions door supervisors and/or venues may take to prevent incidents of spiking.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking][]"
                                            class="form-control" value="{{ $answers29[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC4.7 Recognise indicators that suggest an individual may have been spiked') }}</label>
                                    <p>AC4.7 Recognise indicators that suggest an individual may have been spiked </p>
                                    <label>{{ __('Question 30:') }}</label>
                                    Describe the indicators that suggest an individual may have been spiked.
                                    <textarea name="data[Q30. Describe the indicators that suggest an individual may have been spiked]" cols="30"
                                        rows="10" class="form-control">{{ $answers30 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC4.8 State how to manage a spiking incident') }}</label>
                                    <p>There are several ways that you can manage a spiking incident.</p>
                                    <label>{{ __('Question 31:') }}</label>
                                    State how to manage a spiking incident.
                                    <textarea name="data[Q31. State how to manage a spiking incident]" cols="30" rows="10"
                                        class="form-control">{{ $answers31 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <label>Learner' Name</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group requiredRole">
                                        <input type="text" name="data[first_name]" class="form-control"
                                            value="{{ auth()->user()->name ?? '' }}" readonly>
                                        <small>First Name</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group requiredRole">
                                        <input type="text" name="data[last_name]" class="form-control"
                                            value="{{ auth()->user()->last_name ?? '' }}" readonly>
                                        <small>Last Name</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Learner Signature<span>*</span></label>
                                        <div id="signature-pad" class="signature-pad">
                                            <div id="signature-pad" class="signature-pad">
                                                <div class="signature-pad-body">
                                                    <canvas id="signature-canvas"
                                                        style="background: rgb(255, 255, 255); border: 2px solid rgba(204, 204, 204, 0.8); margin-bottom: 30px; touch-action: none;"></canvas>
                                                </div>
                                                <div class="signature-pad-footer">
                                                    <button type="button" class="btn btn-danger" id="clear-signature">
                                                        Clear
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="signature" id="signature-input-paf">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Date, Time</label>
                                        <input type="text" name="data[assessment_date]" class="form-control"
                                            value="2024-08-23 17:03" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <button type="button" id="saveProgressBtn" class="btn btn-secondary">Save for later</button>
                    <button class="btn btn-primary" id="previewButton">
                        <i class="fas fa-eye mr-2"></i>
                        {{ __('Save and Preview') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="PreviewApp" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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

        #PreviewApp .modal-dialog {
            max-width: 80%;
            margin: 1.75rem auto;
        }

        .formWrapper {
            padding: 20px;
            background: #fff;
            border-radius: 20px;
            box-shadow: #0000000f 0px 0px 10px 0px;

            h3 {
                font-weight: 600;
                font-size: 22px;
            }

            h4.bgStrip {
                background: #3b1d8f;
                color: #fff;
                padding: 15px 15px;
                border-radius: 8px;
            }

            .bgStripGrey {
                background: #c0c0c0;
                color: #000;
                padding: 15px 15px;
                border-radius: 8px;
            }

            label>span {
                color: #bb1a1a;
            }

            .form-group input,
            .form-group textarea {
                border: solid 1px #777777 !important;
                border-radius: 5px;
                resize: none;
            }

            .form-group {
                background: #f7f6f6;
                border: solid 1px #777;
                border-radius: 5px;
                padding: 15px;
            }

            .devider {
                margin: 19px 0px;
                border-top: solid 1px #c9c2c2;
            }

            .learnerDeclaration .form-group {
                padding: 0;
                background: transparent;
                border: none;
                margin-top: 10px;
                margin-top: 0;
            }

            .learnerDeclaration label.d-flex.align-items-center {
                padding-left: 28px;
            }

            .learnerDeclaration label.d-flex.align-items-center input.form-check-input {
                min-width: 15px;
                height: 15px;
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

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
                    console.log("Captured Signature:", signatureDataUrl);
                    document.getElementById('signature-input-paf').value = signatureDataUrl;
                }
            });


            $(document).ready(function() {
                $('#saveProgressBtn').click(function() {
                    var formData = $('#submitForm').serialize(); // Serialize form data
                    $.ajax({
                        url: '{{ route('backend.tasks.save-progress') }}', // Define the route for saving progress
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            alert('Progress saved successfully!');
                            setTimeout(function() {
                                window.location.href =
                                    '{{ route('backend.learner.dashboard') }}';
                            }, 1500);
                        },
                        error: function(response) {
                            alert('There was an error saving your progress.');
                        }
                    });
                });
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

                if (!validateForm()) {
                    alert("Please fill required fields.");
                    return; // Stop here if form is not valid
                }
                $('#PreviewApp').modal('show');
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
                        // $('#PreviewApp').modal('show');
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
                            'X-CSRF-TOKEN': token,
                        },
                    })
                    .then(function(response) {

                        setTimeout(() => {
                            $('#loadingSpinner').hide();
                            window.location = "{{ route('backend.learner.dashboard') }}"
                            button.prop('disabled', false);
                            form[0].reset();
                            $('#PreviewApp').modal('hide');
                        }, 2000);

                        //const pdfDownloadUrl = response.pdfPath;

                        // const link = document.createElement('a');
                        // link.href = pdfDownloadUrl;
                        // link.download = pdfDownloadUrl.split('/').pop();
                        // document.body.appendChild(link);
                        // link.click();
                        // document.body.removeChild(link);

                        // setTimeout(function () {
                        //    window.location.href =
                        //        '{{ route('backend.learner.dashboard') }}';
                        // }, 3000);
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
