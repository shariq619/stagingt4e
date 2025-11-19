@extends('layouts.main')

@section('title', 'User')
@section('main')
    <div class="formWrapper">


        @php
            $cohot = \App\Models\Cohort::find($cohort_id);
            $start_date = optional($cohot)->start_date_time
                ? \Carbon\Carbon::parse($cohot->start_date_time)->format('Y-m-d')
                : '';
            $end_date = optional($cohot)->end_date_time
                ? \Carbon\Carbon::parse($cohot->end_date_time)->format('Y-m-d')
                : '';
            $lr = $learner_response['data'] ?? ($learner_response ?? []);
            // Prefetch all answers for each question as arrays or strings
            $q1 =
                $lr['Q1. State the THREE different types of searches that are carried out by a security officer'] ?? [];
            // dd($lr);
            if (!is_array($q1)) {
                $q1 = [];
            }
            $q2a = $lr['Q2a. Identify THREE occasions when a security officer has the right to search'] ?? [];
            if (!is_array($q2a)) {
                $q2a = [];
            }
            $q2b_single = $lr['Q2b. Single sex'] ?? '';
            $q2b_trans = $lr['Q2b. Transgender individuals'] ?? '';
            $q3 = $lr['Q3. Identify SEVEN different types of equipment that can be used to assist with searches'] ?? [];
            if (!is_array($q3)) {
                $q3 = [];
            }
            $q4 = $lr['Q4. Identify SEVEN hazards you may encounter when conducting searches'] ?? [];
            if (!is_array($q4)) {
                $q4 = [];
            }
            $q5 = $lr['Q5. State FIVE precautions that you can take when carrying out a search'] ?? [];
            if (!is_array($q5)) {
                $q5 = [];
            }
            $q6 = $lr['Q6. State the actions to take if an incident or an accident occurs'] ?? '';
            $q7_cycles = $lr['Q7. Cycles'] ?? '';
            $q7_motor = $lr['Q7. Motorcycles'] ?? '';
            $q7_cars = $lr['Q7. Cars'] ?? '';
            $q7_vans = $lr['Q7. Vans'] ?? '';
            $q7_hgv = $lr['Q7. Heavy goods vehicles'] ?? '';
            $q8 = $lr['Q8. Identify FIVE reasons for carrying out a premises search'] ?? [];
            if (!is_array($q8)) {
                $q8 = [];
            }
            $q9 = $lr['Q9. State FOUR actions to take in the event of a search refusal'] ?? [];
            if (!is_array($q9)) {
                $q9 = [];
            }
            $q10 = $lr['Q10. Identify FOUR reasons for completing search documentation'] ?? [];
            if (!is_array($q10)) {
                $q10 = [];
            }
            $q11 =
                $lr['Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search'] ??
                [];
            if (!is_array($q11)) {
                $q11 = [];
            }
            $q12a = $lr['Q2a. Explain what is meant by duty of care'] ?? '';
            $q12b =
                $lr[
                    'Q2b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable'
                ] ?? '';
            $q13a =
                $lr['Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others'] ?? [];
            if (!is_array($q13a)) {
                $q13a = [];
            }
            $q13b =
                $lr[
                    'Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable'
                ] ?? [];
            if (!is_array($q13b)) {
                $q13b = [];
            }
            $q14 = $lr['Q14. Identify FIVE actions that you should take towards vulnerable individuals'] ?? [];
            if (!is_array($q14)) {
                $q14 = [];
            }
            $q15 = $lr['Q15. Identify FOUR behaviours that may be exhibited by sexual predators'] ?? [];
            if (!is_array($q15)) {
                $q15 = [];
            }
            $q16 = $lr['Q16. Identify FOUR indicators of abuse'] ?? [];
            if (!is_array($q16)) {
                $q16 = [];
            }
            $q17 = $lr['Q17. State how to deal with allegations of sexual assault'] ?? '';
            $q18 = $lr['Q18. State how to deal with anti-social behaviour'] ?? '';
            $q19 = $lr['Q19. Identify the FIVE different threat levels'] ?? [];
            if (!is_array($q19)) {
                $q19 = [];
            }
            $q20 = $lr['Q20. What are the most common terror attack methods?'] ?? '';
            $q21 =
                $lr['Q21. Explain the actions you should take in the event of a terror threat at the venue or site'] ??
                '';
            $q22 = $lr['Q22. Identify the procedures for dealing with suspicious items'] ?? '';
            $q23 = $lr['Q23. Identify SIX behaviours that could indicate suspicious activity'] ?? [];
            if (!is_array($q23)) {
                $q23 = [];
            }
            $q24 = $lr['Q24. Identify how you should respond to suspicious behaviour'] ?? '';
        @endphp

        <div class="row">
            <div class="col-12">
                <form action="{{ route('backend.task.submission') }}" method="POST" id="submitForm"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="task_name" value="{{ $task->name }}" />
                    <input type="hidden" name="task_id" value="{{ $task->id }}" />
                    <input type="hidden" name="course_id" value="{{ $course_id }}" />
                    <input type="hidden" name="cohort_id" value="{{ $cohort_id }}" />
                    <input type="hidden" name="trainer_id" value="{{ $trainer_id }}" />
                    <div class="studyAssessment">
                        <h3 class="floatingpdftitle">Security Guard Refresher Workbook</h3>
                        <div
                            class="floatingpdf d-inline-flex align-items-center justify-content-end overflow-auto position-sticky bg-white float-right">
                            <div href="{{ asset('resources/Security Guard REFRESHER_Workbook.pdf') }}" class="popup-pdf"><i
                                    class="fas fa-file-pdf"></i></div>
                        </div>



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
                                            <input type="text" id="training_provider" value="Training4Employment"
                                                name="data[training_provider]" class="form-control">
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
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.1 State the different type of searches carried out by a security officer') }}</label>
                                    <p>As a security officer you will be required to carry out different types of searches.
                                    </p>
                                    <label>{{ __('Question 1:') }}</label> State the <label>{{ __('THREE') }}</label>
                                    different types of searches that are carried out by a security officer.
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">1.</label>
                                    <input type="text"
                                        name="data[Q1. State the THREE different types of searches that are carried out by a security officer][]"
                                        class="form-control" value="{{ $q1[0] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">2.</label>
                                    <input type="text"
                                        name="data[Q1. State the THREE different types of searches that are carried out by a security officer][]"
                                        class="form-control" value="{{ $q1[1] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">3.</label>
                                    <input type="text"
                                        name="data[Q1. State the THREE different types of searches that are carried out by a security officer][]"
                                        class="form-control" value="{{ $q1[2] ?? '' }}">
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.2 Identify a security officer’s right to search') }}</label>
                                    <p>Security officers have specific powers related to their duties, but your right to
                                        search individuals is limited. </p>
                                    <label>{{ __('Question 2a:') }}</label> State the <label>{{ __('THREE') }}</label>
                                    occasions when a security officer has the right to search.
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">1.</label>
                                    <input type="text"
                                        name="data[Q2a. Identify THREE occasions when a security officer has the right to search][]"
                                        class="form-control" value="{{ $q2a[0] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">2.</label>
                                    <input type="text"
                                        name="data[Q2a. Identify THREE occasions when a security officer has the right to search][]"
                                        class="form-control" value="{{ $q2a[1] ?? '' }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">3.</label>
                                    <input type="text"
                                        name="data[Q2a. Identify THREE occasions when a security officer has the right to search][]"
                                        class="form-control" value="{{ $q2a[2] ?? '' }}">
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    {{-- <label>{{ __('AC1.2 Identify a security officer’s right to search') }}</label>
                                    <p>Security officers have specific powers related to their duties, but your right to search individuals is limited. </p> --}}
                                    <label>{{ __('Question 2b:') }}</label>
                                    <p>Explain the search process required when carrying out:</p>
                                    <ul>
                                        <li>single sex searches</li>
                                        <li>transgender individuals’ searches</li>
                                    </ul>
                                </div>
                                <div>
                                    <p><strong>Single sex</strong></p>
                                    <input type="text" name="data[Q2b. Single sex]" class="form-control"
                                        value="{{ $q2b_single }}">
                                </div>
                                <div>
                                    <p><strong>Transgender individuals</strong></p>
                                    <input type="text" name="data[Q2b. Transgender individuals]" class="form-control"
                                        value="{{ $q2b_trans }}">
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.3 Identify the different types of searching equipment') }}</label>
                                    <p>As a security officer, you may be required to search staff, visitors or customers at
                                        a site before allowing entry.</p>
                                    <label>{{ __('Question 3:') }}</label> Identify <label>{{ __('SEVEN') }}</label>
                                    different types of equipment that can be used to assist with searches.
                                </div>
                                @for ($i = 0; $i < 7; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                            class="form-control" value="{{ $q3[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.4 Recognise possible hazards when conducting a search') }}</label>
                                    <p>Security officers may encounter various potential hazards when conducting searches.
                                    </p>
                                    <label>{{ __('Question 4:') }}</label> Identify <label>{{ __('SEVEN') }}</label>
                                    hazards you may encounter when conducting searches.
                                </div>
                                @for ($i = 0; $i < 7; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                            class="form-control" value="{{ $q4[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.5 State the precautions to take when carrying out a search') }}</label>
                                    <p>It is important that as a security officer you take care of yourself when conducting
                                        searches.</p>
                                    <label>{{ __('Question 5:') }}</label> State <label>{{ __('FIVE') }}</label>
                                    precautions that you can take when carrying out a search.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q5. State FIVE precautions that you can take when carrying out a search][]"
                                            class="form-control" value="{{ $q5[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12 textarea">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC1.6 State the actions to take if an incident or an accident occurs') }}</label>
                                    <p>From time to time, incidents or accidents may occur; it is important to always follow
                                        the venue’s policy or
                                        assignment instructions.</p>
                                    <label>{{ __('Question 6:') }}</label>
                                    <p>State the actions to take if an incident or an accident occurs.</p>
                                    <textarea name="data[Q6. State the actions to take if an incident or an accident occurs]" cols="30"
                                        rows="10" class="form-control">{{ $q6 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.8 State typical areas of vehicles to be searched') }}</label>
                                    <p>Some sites require vehicles to be searched, including:</p>
                                    <ul>
                                        <li>cycles</li>
                                        <li>motorcycles</li>
                                        <li>cars</li>
                                        <li>vans</li>
                                        <li>heavy goods vehicles</li>
                                    </ul>
                                    <label>{{ __('Question 7:') }}</label>
                                    <p>State typical areas of vehicles to be searched.</p>
                                </div>
                                <div>
                                    <p><strong>Cycles</strong></p>
                                    <input type="text" name="data[Q7. Cycles]" class="form-control"
                                        value="{{ $q7_cycles }}">
                                </div>
                                <div>
                                    <p><strong>Motorcycles</strong></p>
                                    <input type="text" name="data[Q7. Motorcycles]" class="form-control"
                                        value="{{ $q7_motor }}">
                                </div>
                                <div>
                                    <p><strong>Cars</strong></p>
                                    <input type="text" name="data[Q7. Cars]" class="form-control"
                                        value="{{ $q7_cars }}">
                                </div>
                                <div>
                                    <p><strong>Vans</strong></p>
                                    <input type="text" name="data[Q7. Vans]" class="form-control"
                                        value="{{ $q7_vans }}">
                                </div>
                                <div>
                                    <p><strong>Heavy goods vehicles</strong></p>
                                    <input type="text" name="data[Q7. Heavy goods vehicles]" class="form-control"
                                        value="{{ $q7_hgv }}">
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.9 Identify the reasons for carrying out a premises search') }}</label>
                                    <p>As well as searching people, you may be required to carry out a premises search</p>
                                    <label>{{ __('Question 8:') }}</label> Identify <label>{{ __('FIVE') }}</label>
                                    reasons for carrying out a premises search.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q8. Identify FIVE reasons for carrying out a premises search][]"
                                            class="form-control" value="{{ $q8[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.10 Recognise actions to take in the event of a search refusal') }}</label>
                                    <p>Individuals may refuse to be searched or to have their belongings searched. Any
                                        refusals should be handled
                                        according to the venue’s policy or assignment instructions.</p>
                                    <label>{{ __('Question 9:') }}</label> State <label>{{ __('FOUR') }}</label>
                                    actions to take in the event of a search refusal.
                                </div>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q9. State FOUR actions to take in the event of a search refusal][]"
                                            class="form-control" value="{{ $q9[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.11 Identify reasons for completing search documentation') }}</label>
                                    <p>Venues that require the security team to search people or their property must provide
                                        a suitable method of
                                        recording searches.</p>
                                    <label>{{ __('Question 10:') }}</label> Identify <label>{{ __('FOUR') }}</label>
                                    reasons for completing search documentation.
                                </div>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q10. Identify FOUR reasons for completing search documentation][]"
                                            class="form-control" value="{{ $q10[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.12 Identify actions to take if a prohibited or restricted item is found during a search') }}</label>
                                    <p>Any stolen, illegal or unauthorised items found during a search must be delt with
                                        correctly. </p>
                                    <label>{{ __('Question 11:') }}</label> Identify <label>{{ __('SIX') }}</label>
                                    actions to take if a prohibited or restricted item is found during a search.
                                </div>
                                @for ($i = 0; $i < 6; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search][]"
                                            class="form-control" value="{{ $q11[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <h4 class="bgStripGrey">LO2 Understand how to keep vulnerable people safe</h4>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC2.1 Recognise duty of care with regard to vulnerable people') }}</label>
                                    <p>As a security officer you have a duty of care to vulnerable people that enter the
                                        premises. </p>
                                    <label>{{ __('Question 12a:') }}</label>
                                    <p>Explain what is meant by duty of care.</p>
                                </div>
                                <textarea name="data[Q2a. Explain what is meant by duty of care]" cols="30" rows="10"
                                    class="form-control">{{ $q12a }}</textarea>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('Question 12b:') }}</label>
                                    <p>Explain why it is important to have a duty of care for everyone, even if they do not
                                        appear to be vulnerable. </p>
                                </div>
                                <textarea
                                    name="data[Q2b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable]"
                                    cols="30" rows="10" class="form-control">{{ $q12b }}</textarea>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC 2.2 Identify factors that could make someone vulnerable') }}</label>
                                    <p>As a security officer, you need to be aware of individuals who may be considered
                                        vulnerable due to various factors.</p>
                                    <label>{{ __('Question 13a:') }}</label> Identify <label>{{ __('FIVE') }}</label>
                                    factors that could make someone vulnerable or more at risk than others.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others][]"
                                            class="form-control" value="{{ $q13a[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('Question 13b:') }}</label> Explain why the
                                    <label>{{ __('FIVE') }}</label>
                                    factors you identified in question 13a could make someone vulnerable.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable][]"
                                            class="form-control" value="{{ $q13b[$i] ?? '' }}">
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
                                        consider what help they might
                                        need. </p>
                                    <label>{{ __('Question 14:') }}</label> Identify <label>{{ __('FIVE') }}</label>
                                    actions that you should take towards vulnerable individuals.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q14. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                            class="form-control" value="{{ $q14[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC2.4 Identify behaviours that may be exhibited by sexual predators') }}</label>
                                    <p>As a security officer, you must be able to identify behaviours that may be exhibited
                                        by sexual predators. </p>
                                    <label>{{ __('Question 15:') }}</label> Identify <label>{{ __('FOUR') }}</label>
                                    behaviours that may be exhibited by sexual predators.
                                </div>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q15. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                            class="form-control" value="{{ $q15[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC2.5 Identify indicators of abuse') }}</label>
                                    <p>There are several identifying indicators of abuse that a security officer can look
                                        out for. </p>
                                    <label>{{ __('Question 16:') }}</label> Identify <label>{{ __('FOUR') }}</label>
                                    indicators of abuse.
                                </div>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text" name="data[Q16. Identify FOUR indicators of abuse][]"
                                            class="form-control" value="{{ $q16[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12 textarea">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC2.6 State how to deal with allegations of sexual assault') }}</label>
                                    <p>Security officers regularly wear uniforms. Some people find this reassuring and may
                                        choose to tell the operative
                                        about the abuse they have been subjected to. This is called disclosure. </p>
                                    <label>{{ __('Question 17:') }}</label>
                                    <p>State how to deal with allegations of sexual assault.</p>
                                    <textarea name="data[Q17. State how to deal with allegations of sexual assault]" cols="30" rows="10"
                                        class="form-control">{{ $q17 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12 textarea">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC2.7 State how to deal with anti-social behaviour') }}</label>
                                    <p>As a security officer, you should always maintain a positive and productive attitude
                                        when dealing with members
                                        of the public who are demonstrating anti-social behaviour.</p>
                                    <label>{{ __('Question 18:') }}</label>
                                    <p>State how to deal with anti-social behaviour.</p>
                                    <textarea name="data[Q18. State how to deal with anti-social behaviour]" cols="30" rows="10"
                                        class="form-control">{{ $q18 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>

                        <h4 class="bgStripGrey">LO3 Understand terror threats and the role of the security operative in the
                            event of a threat</h4>

                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC3.1 Identify the different threat levels') }}</label>
                                    <p>Threat levels are designed to give a broad indication of the likelihood of a
                                        terrorist attack. </p>
                                    <label>{{ __('Question 19:') }}</label> Identify the
                                    <label>{{ __('FIVE') }}</label>
                                    different threat levels.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q19. Identify the FIVE different threat levels][]"
                                            class="form-control" value="{{ $q19[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12 textarea">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC3.2 Recognise the common terror attack methods') }}</label>
                                    <p>It is important to be aware of the common methods used in terror attacks.</p>
                                    <label>{{ __('Question 20:') }}</label>
                                    <p>What are the most common terror attack methods?</p>
                                    <textarea name="data[Q20. What are the most common terror attack methods?]" cols="30" rows="10"
                                        class="form-control">{{ $q20 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12 textarea">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC3.3 Recognise the actions to take in the event of a terror threat') }}</label>
                                    <p>The role of a security officer during a terror attack will be outlined in the venue
                                        or site’s policies and procedures.</p>
                                    <label>{{ __('Question 21:') }}</label>
                                    <p>Explain the actions you should take in the event of a terror threat at the venue or
                                        site.</p>
                                    <textarea name="data[Q21. Explain the actions you should take in the event of a terror threat at the venue or site]"
                                        cols="30" rows="10" class="form-control">{{ $q21 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12 textarea">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC3.4 Identify the procedures for dealing with suspicious items') }}</label>
                                    <p>As a security officer, you need to be aware of suspicious packages and the procedures
                                        to follow if one is identified.</p>
                                    <label>{{ __('Question 22:') }}</label>
                                    <p>Identify the procedures for dealing with suspicious items.</p>
                                    <textarea name="data[Q22. Identify the procedures for dealing with suspicious items]" cols="30" rows="10"
                                        class="form-control">{{ $q22 }}</textarea>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC3.5 Identify behaviours that could indicate suspicious activity') }}</label>
                                    <p>Suspicious activity is any observed behaviour that could indicate terrorism or
                                        terrorism-related crime.</p>
                                    <label>{{ __('Question 23:') }}</label>
                                    <label>Identify <strong>SIX </strong> behaviours that could indicate suspicious
                                        activity.</label>
                                </div>
                                @for ($i = 0; $i < 6; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i + 1 }}.</label>
                                        <input type="text"
                                            name="data[Q23. Identify SIX behaviours that could indicate suspicious activity][]"
                                            class="form-control" value="{{ $q23[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12 textarea">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>{{ __('AC3.6 Identify how to respond to suspicious behaviour') }}</label>
                                    <p>As a security officer, you shouldn’t be afraid of responding when you suspect
                                        suspicious behaviour.</p>
                                    <label>{{ __('Question 24:') }}</label>
                                    <p>Identify how you should respond to suspicious behaviour.</p>
                                    <textarea name="data[Q24. Identify how you should respond to suspicious behaviour]" cols="30" rows="10"
                                        class="form-control">{{ $q24 }}</textarea>
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
                                            value="{{ now()->format('Y-m-d H:i') }}" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="saveProgressBtn" class="btn btn-secondary">Save For Later</button>
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
