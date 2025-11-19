@extends('layouts.main')

@section('title', 'User')
@section('main')
    <div class="formWrapper">
        <div class="row">

            @php
                $cohot = \App\Models\Cohort::find($cohort_id);
                $start_date = optional($cohot)->start_date_time ? \Carbon\Carbon::parse($cohot->start_date_time)->format('Y-m-d') : '';
                $end_date = optional($cohot)->end_date_time ? \Carbon\Carbon::parse($cohot->end_date_time)->format('Y-m-d') : '';


                $learner_response = $learner_response['data'] ?? $learner_response ?? [];

                //dd($learner_response);

            @endphp


            <form action="{{ route('backend.task.submission') }}" method="POST" id="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <input type="hidden" name="task_name" value="{{ $task->name }}" />
                    <input type="hidden" name="task_id" value="{{ $task->id }}" />
                    <input type="hidden" name="course_id" value="{{ $course_id }}" />
                    <input type="hidden" name="cohort_id" value="{{ $cohort_id }}" />
                    <input type="hidden" name="trainer_id" value="{{ $trainer_id }}" />
                    <div class="studyAssessment">
                        <h3 class="floatingpdftitle">Door Supervisor Self-Study Activity Sheet</h3>
                        <div class="floatingpdf d-inline-flex align-items-center justify-content-end overflow-auto position-sticky bg-white float-right" >
                            <div href="{{ asset('resources/DistanceLearningBooklet_DS_2023.pdf') }}" class="popup-pdf"><i
                                    class="fas fa-file-pdf"></i></div>
                        </div>

                        <div class="devider"></div>
                        <h4 class="bgStrip">Learner Details</h4>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>{{ __('First Name') }}<span>*</span></label>
                                    <input type="text" id="first_name" name="data[first_name]" class="form-control"
                                        value="{{ old('data[first_name]', auth()->user()->name ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Last Name') }}<span>*</span></label>
                                    <input type="text" id="last_name" name="data[last_name]" class="form-control"
                                        value="{{ old('data[last_name]', auth()->user()->last_name ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Email Address') }}<span>*</span></label>
                                    <input type="email" id="email" name="data[email]" class="form-control"
                                        value="{{ old('data[email]', auth()->user()->email ?? '') }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>{{ __('Course Start Date') }}</label>
                                    <input type="date" id="course_start_date" name="data[course_start_date]"
                                        class="form-control"
                                        value="{{ old('data[course_start_date]', $learner_response['course_start_date'] ?? $start_date) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="assessment">
                        <div class="devider"></div>
                        <h4 class="bgStrip">Theory Questions</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Q1. What is the purpose of security industry?') }}<span>*</span></label>
                                    <textarea name="data[Q1. What is the purpose of security industry?]" id="q1_ans_security" cols="30" rows="10"
                                        class="form-control">{{ old('data[Q1. What is the purpose of security industry?]', $learner_response['Q1. What is the purpose of security industry?'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                @php
                                    $securityWays = old(
                                        'data[Q2. List 3 ways in which security is provided]',
                                        $learner_response['Q2. List 3 ways in which security is provided'] ?? [],
                                    );
                                @endphp
                                <div class="form-group validList">
                                    <label>{{ __('Q2. List 3 ways in which security is provided') }}<span>*</span></label>

                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="d-flex mb-2 align-items-center">
                                            <label class="mr-3">{{ $i + 1 }}.</label>
                                            <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                name="data[Q2. List 3 ways in which security is provided][]"
                                                class="form-control" value="{{ $securityWays[$i] ?? '' }}">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-12">
                                @php
                                    $siaAims = old(
                                        'data[Q3. Describe the 3 main aims of the SIA]',
                                        $learner_response['Q3. Describe the 3 main aims of the SIA'] ?? [],
                                    );
                                @endphp
                                <div class="form-group validList">
                                    <label>{{ __('Q3. Describe the 3 main aims of the SIA') }}<span>*</span></label>

                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="d-flex mb-2 align-items-center">
                                            <label class="mr-3">{{ $i + 1 }}.</label>
                                            <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                name="data[Q3. Describe the 3 main aims of the SIA][]" class="form-control"
                                                value="{{ $siaAims[$i] ?? '' }}">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-12">
                                @php
                                    $communitySafetyInitiatives = old(
                                        'data[Q4. List any 5 examples of community safety initiatives]',
                                        $learner_response['Q4. List any 5 examples of community safety initiatives'] ??
                                            [],
                                    );
                                @endphp
                                <div class="form-group validList">
                                    <label>{{ __('Q4. List any 5 examples of community safety initiatives') }}<span>*</span></label>

                                    @for ($i = 0; $i < 5; $i++)
                                        <div class="d-flex mb-2 align-items-center">
                                            <label class="mr-3">{{ $i + 1 }}.</label>
                                            <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                name="data[Q4. List any 5 examples of community safety initiatives][]"
                                                class="form-control" value="{{ $communitySafetyInitiatives[$i] ?? '' }}">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-12">
                                @php
                                    $benefitsUsingCCTV = old(
                                        'data[Q5. List 3 benefits of using CCTV]',
                                        $learner_response['Q5. List 3 benefits of using CCTV'] ?? [],
                                    );
                                @endphp
                                <div class="form-group validList">
                                    <label>{{ __('Q5. List 3 benefits of using CCTV') }}<span>*</span></label>

                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="d-flex mb-2 align-items-center">
                                            <label class="mr-3">{{ $i + 1 }}.</label>
                                            <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                name="data[Q5. List 3 benefits of using CCTV][]" class="form-control"
                                                value="{{ $benefitsUsingCCTV[$i] ?? '' }}">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-12">
                                @php
                                    $qualitiesSecurityOperative = old(
                                        'data[Q6. List any 5 qualities that a security operative should have]',
                                        $learner_response[
                                            'Q6. List any 5 qualities that a security operative should have'
                                        ] ?? [],
                                    );
                                @endphp
                                <div class="form-group validList">
                                    <label>{{ __('Q6. List any 5 qualities that a security operative should have') }}<span>*</span></label>

                                    @for ($i = 0; $i < 5; $i++)
                                        <div class="d-flex mb-2 align-items-center">
                                            <label class="mr-3">{{ $i + 1 }}.</label>
                                            <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                name="data[Q6. List any 5 qualities that a security operative should have][]"
                                                class="form-control" value="{{ $qualitiesSecurityOperative[$i] ?? '' }}">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q7. What are the legal implications of using CCTV?<span>*</span></label>
                                    <textarea name="data[Q7. What are the legal implications of using CCTV?]" cols="30" rows="10"
                                        class="form-control ">{{ old('data[Q7. What are the legal implications of using CCTV?]', $learner_response['Q7. What are the legal implications of using CCTV?'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q8. Explain what is meant by the term ARREST.<span>*</span></label>
                                    <textarea name="data[Q8. Explain what is meant by the term ARREST]" cols="30" rows="10"
                                        class="form-control ">{{ old('data[Q8. Explain what is meant by the term ARREST]', $learner_response['Q8. Explain what is meant by the term ARREST'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group validList">

                                    @php
                                        $securityOperativeArrest = old(
                                            'data[Q9. Provide 6 examples of offences for which a security operative can make an arrest]',
                                            $learner_response[
                                                'Q9. Provide 6 examples of offences for which a security operative can make an arrest'
                                            ] ?? [],
                                        );
                                    @endphp
                                    <div class="form-group validList">
                                        <label>{{ __('Q9. Provide 6 examples of offences for which a security operative can make an arrest') }}<span>*</span></label>

                                        @for ($i = 0; $i < 6; $i++)
                                            <div class="d-flex mb-2 align-items-center">
                                                <label class="mr-3">{{ $i + 1 }}.</label>
                                                <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                    name="data[Q9. Provide 6 examples of offences for which a security operative can make an arrest][]"
                                                    class="form-control"
                                                    value="{{ $securityOperativeArrest[$i] ?? '' }}">
                                            </div>
                                        @endfor
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q10. Explain the procedures a security operative should follow after an
                                        arrest<span>*</span></label>
                                    <textarea name="data[Q10. Explain the procedures a security operative should follow after an arrest]"
                                        id="q10_ans_procedures" cols="30" rows="10" class="form-control ">{{ old('data[Q10. Explain the procedures a security operative should follow after an arrest]', $learner_response['Q10. Explain the procedures a security operative should follow after an arrest'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q11. Please describe internal customers.<span>*</span></label>
                                    <textarea name="data[Q11. Please describe internal customers]" id="q11_ans_customers" cols="30" rows="10"
                                        class="form-control ">{{ old('data[Q11. Please describe internal customers]', $learner_response['Q11. Please describe internal customers'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q12. List different types of communication.<span>*</span></label>
                                    <textarea name="data[Q12. List different types of communication]" id="q12_ans_communication" cols="30"
                                        rows="10" class="form-control ">{{ old('data[Q12. List different types of communication]', $learner_response['Q12. List different types of communication'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group validList">
                                    @php
                                        $badCustomerCare = old(
                                            'data[Q13. Give 3 examples of good customer care and 3 examples of bad customer care]',
                                            $learner_response[
                                                'Q13. Give 3 examples of good customer care and 3 examples of bad customer care'
                                            ] ?? [],
                                        );
                                    @endphp
                                    <div class="form-group validList">
                                        <label>{{ __('Q13. Give 3 examples of good customer care and 3 examples of bad customer care') }}<span>*</span></label>

                                        @for ($i = 0; $i < 6; $i++)
                                            <div class="d-flex mb-2 align-items-center">
                                                <label class="mr-3">{{ $i + 1 }}.</label>
                                                <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                    name="data[Q13. Give 3 examples of good customer care and 3 examples of bad customer care][]"
                                                    class="form-control" value="{{ $badCustomerCare[$i] ?? '' }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q14. What are protected characteristics?<span>*</span></label>
                                    <textarea name="data[Q14. What are protected characteristics?]" id="q14_ans_characteristics" cols="30"
                                        rows="10" class="form-control ">{{ old('data[Q14. What are protected characteristics?]', $learner_response['Q14. What are protected characteristics?'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group validList">
                                    @php
                                        $considerationWhenForces = old(
                                            'data[Q15. What are the 3 consideration when forces applied?]',
                                            $learner_response[
                                                'Q15. What are the 3 consideration when forces applied?'
                                            ] ?? [],
                                        );
                                    @endphp
                                    <div class="form-group validList">
                                        <label>{{ __('Q15. What are the 3 consideration when forces applied?') }}<span>*</span></label>

                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="d-flex mb-2 align-items-center">
                                                <label class="mr-3">{{ $i + 1 }}.</label>
                                                <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                    name="data[Q15. What are the 3 consideration when forces applied?][]"
                                                    class="form-control"
                                                    value="{{ $considerationWhenForces[$i] ?? '' }}">
                                            </div>
                                        @endfor
                                    </div>


                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group validList">
                                    @php
                                        $venuemightbe = old(
                                            'data[Q16. Give 3 reasons why venue might be evacuated]',
                                            $learner_response['Q16. Give 3 reasons why venue might be evacuated'] ?? [],
                                        );
                                    @endphp
                                    <div class="form-group validList">
                                        <label>{{ __('Q16. Give 3 reasons why venue might be evacuated') }}<span>*</span></label>

                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="d-flex mb-2 align-items-center">
                                                <label class="mr-3">{{ $i + 1 }}.</label>
                                                <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                    name="data[Q16. Give 3 reasons why venue might be evacuated][]"
                                                    class="form-control" value="{{ $venuemightbe[$i] ?? '' }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q17. What are the components of the fire triangle?<span>*</span></label>
                                    <textarea name="data[Q17. What are the components of the fire triangle?]" id="q17_ans_triangle" cols="30"
                                        rows="10" class="form-control ">{{ old('data[Q17. What are the components of the fire triangle?]', $learner_response['Q17. What are the components of the fire triangle?'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q18. What are the priorities that you need to observe during evacuation from a
                                        venue?<span>*</span></label>
                                    <textarea name="data[Q18. What are the priorities that you need to observe during evacuation from a venue?]"
                                        id="q18_ans_evacuation" cols="30" rows="10" class="form-control ">{{ old('data[Q18. What are the priorities that you need to observe during evacuation from a venue?]', $learner_response['Q18. What are the priorities that you need to observe during evacuation from a venue?'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q19. How many Data protection principles are there?<span>*</span></label>
                                    <textarea name="data[Q19. How many Data protection principles are there?]" id="q19_ans_protection" cols="30"
                                        rows="10" class="form-control ">{{ old('data[Q19. How many Data protection principles are there?]', $learner_response['Q19. How many Data protection principles are there?'] ?? '') }}</textarea>
                                </div>
                            </div>
{{--                            <div class="col-12">--}}
{{--                                <div class="form-group requiredRole">--}}
{{--                                    <label>Q20. How many Data protection principles are there?<span>*</span></label>--}}
{{--                                    <textarea name="data[Q20. How many Data protection principles are there?]" id="q20_ans_protection" cols="30"--}}
{{--                                        rows="10" class="form-control ">{{ old('data[Q20. How many Data protection principles are there?]', $learner_response['Q20. How many Data protection principles are there?'] ?? '') }}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-12">
                                <div class="form-group validList">
                                    @php
                                        $differentSafetySigns = old(
                                            'data[Q21. Name 6 different safety signs]',
                                            $learner_response['Q21. Name 6 different safety signs'] ?? [],
                                        );
                                    @endphp
                                    <div class="form-group validList">
                                        <label>{{ __('Q20. Name 6 different safety signs') }}<span>*</span></label>

                                        @for ($i = 0; $i < 6; $i++)
                                            <div class="d-flex mb-2 align-items-center">
                                                <label class="mr-3">{{ $i + 1 }}.</label>
                                                <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                    name="data[Q21. Name 6 different safety signs][]" class="form-control"
                                                    value="{{ $differentSafetySigns[$i] ?? '' }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>




                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Q21. Classify the fire and give one example of each one') }}<span>*</span></label>
{{--                                        <textarea name="data[Q21. Classify the fire and give one example of each one]" id="q18_ans_evacuation" cols="30"--}}
{{--                                            rows="10" class="form-control ">--}}
{{--                                            {{ old(--}}
{{--                                                'data[Q21. Classify the fire and give one example of each one]',--}}
{{--                                                $learner_response['Q21. Classify the fire and give one example of each one']--}}
{{--                                                    ?? $learner_response['Q22. Classify the fire and give one example of each one']--}}
{{--                                                    ?? $learner_response['Q21. Classify the fire and give one example of each one.']--}}
{{--                                            ) }}--}}
{{--                                        </textarea>--}}

                                        <textarea name="data[Q21. Classify the fire and give one example of each one]" id="q18_ans_evacuation" cols="30" rows="10" class="form-control">
                                            {{ old('data[Q21. Classify the fire and give one example of each one]',
                                                $learner_response['Q21. Classify the fire and give one example of each one']
                                                ?? $learner_response['Q21. Classify the fire and give one example of each one.']
                                                ?? $learner_response['Q22. Classify the fire and give one example of each one']
                                                ?? '') }}
                                        </textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q22. What are internal fire doors used for?<span>*</span></label>
                                        <textarea name="data[Q23. What are internal fire doors used for?]" id="q18_ans_evacuation" cols="30"
                                            rows="10" class="form-control ">{{ old('data[Q23. What are internal fire doors used for?]', $learner_response['Q23. What are internal fire doors used for?'] ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q23. What is an emergency?<span>*</span></label>
                                        <textarea name="data[Q24. What is an emergency?]" id="q24_ans_emergency" cols="30" rows="10"
                                            class="form-control ">{{ old('data[Q24. What is an emergency?]', $learner_response['Q24. What is an emergency?'] ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group validList">

                                        @php
                                            $aimsOffirstaid = old(
                                                'data[Q25. What are the 4 aims of first aid?]',
                                                $learner_response['Q25. What are the 4 aims of first aid?'] ?? [],
                                            );
                                        @endphp
                                        <div class="form-group validList">
                                            <label>{{ __('Q24. What are the 4 aims of first aid?') }}<span>*</span></label>

                                            @for ($i = 0; $i < 4; $i++)
                                                <div class="d-flex mb-2 align-items-center">
                                                    <label class="mr-3">{{ $i + 1 }}.</label>
                                                    <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                        name="data[Q25. What are the 4 aims of first aid?][]"
                                                        class="form-control" value="{{ $aimsOffirstaid[$i] ?? '' }}">
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q25. What are the risks of lone working within the private security
                                            industry<span>*</span></label>
                                        <textarea name="data[Q26. What are the risks of lone working within the private security industry]" id="q26_ans_risks"
                                            cols="30" rows="10" class="form-control ">{{ old('data[Q26. What are the risks of lone working within the private security industry]', $learner_response['Q26. What are the risks of lone working within the private security industry'] ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group validList">
                                        @php
                                            $workplaceHazards = old(
                                                'data[Q27. List FIVE examples of workplace hazards]',
                                                $learner_response['Q27. List FIVE examples of workplace hazards'] ?? [],
                                            );
                                        @endphp
                                        <div class="form-group validList">
                                            <label>{{ __('Q26. List FIVE examples of workplace hazards') }}<span>*</span></label>

                                            @for ($i = 0; $i < 5; $i++)
                                                <div class="d-flex mb-2 align-items-center">
                                                    <label class="mr-3">{{ $i + 1 }}.</label>
                                                    <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                        name="data[Q27. List FIVE examples of workplace hazards][]"
                                                        class="form-control" value="{{ $workplaceHazards[$i] ?? '' }}">
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q27. Explain the principles of evacuation and
                                            invacuation.<span>*</span></label>
                                        <textarea name="data[Q28. Explain the principles of evacuation and invacuation]" id="q28_ans_invacuation"
                                            cols="30" rows="10" class="form-control ">{{ old('data[Q28. Explain the principles of evacuation and invacuation]', $learner_response['Q28. Explain the principles of evacuation and invacuation'] ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group validList">
                                        @php
                                            $childsexualexploitation = old(
                                                'data[Q29. Give 3 examples of child sexual exploitation]',
                                                $learner_response[
                                                    'Q29. Give 3 examples of child sexual exploitation'
                                                ] ?? [],
                                            );
                                        @endphp
                                        <div class="form-group validList">
                                            <label>{{ __('Q28. Give 3 examples of child sexual exploitation') }}<span>*</span></label>

                                            @for ($i = 0; $i < 3; $i++)
                                                <div class="d-flex mb-2 align-items-center">
                                                    <label class="mr-3">{{ $i + 1 }}.</label>
                                                    <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                        name="data[Q29. Give 3 examples of child sexual exploitation][]"
                                                        class="form-control"
                                                        value="{{ $childsexualexploitation[$i] ?? '' }}">
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q29. What is terrorism?<span>*</span></label>
                                        <textarea name="data[Q30. What is terrorism?]" id="q30_ans_terrorism" cols="30" rows="10"
                                            class="form-control ">{{ old('data[Q30. What is terrorism?]', $learner_response['Q30. What is terrorism?'] ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q30. What type of threat level is substational?<span>*</span></label>
                                        <textarea name="data[Q31. What type of threat level is substational?]" id="q31_ans_substational" cols="30"
                                            rows="10" class="form-control ">{{ old('data[Q31. What type of threat level is substational?]', $learner_response['Q31. What type of threat level is substational?'] ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="learnerDeclaration">
                            <h4 class="bgStrip">Learner Declaration</h4>
                            <label class="d-flex align-items-center">
                                <input type="checkbox" name="guideline1" class="form-check-input">
                                <span style="color:#000;">I can confirm that I have spent the minimum of 9 hours, studying
                                    the SIA Door Supervisor course Distance Learning Booklet.</span>
                            </label>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('First Name') }}<span>*</span></label>
                                        <input type="text" id="first_name" name="data[detail_first_name]"
                                            class="form-control" value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Last Name') }}<span>*</span></label>
                                        <input type="text" id="last_name" name="data[detail_last_name]"
                                            class="form-control" value="{{ auth()->user()->last_name ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Learner Signature') }}<span>*</span></label>
                                        <div id="signature-pad" class="signature-pad">
                                            <div id="signature-pad" class="signature-pad">
                                                <div class="signature-pad-body">
                                                    <canvas id="signature-canvas"
                                                        style="background: #fff; border: solid 2px #cccc; margin-bottom: 30px;"></canvas>
                                                </div>
                                                <div class="signature-pad-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        id="clear-signature">Clear</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="signature" id="signature-input-paf" required>

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            @php
                                                $now = new DateTime();
                                            @endphp
                                            <label>{{ __('Date, Time Assessment Completed') }}</label>
                                            <input type="text" id="assessment_date" name="data[assessment_date]"
                                                class="form-control" value="{{ $now->format('Y-m-d H:i') }}" readonly>
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



                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="deletePreviewApp" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
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
        #deletePreviewApp .modal-dialog {
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
                background: #919191;
                border-radius: 5px;
                font-size: 18px;
                font-weight: 500;
                color: #fff;
                padding: 6px 0px 6px 10px;
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

                    // Validate requiredRole inputs and textareas
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

                    // Validate validList inputs
                    $('.validList').each(function() {
                        let groupIsValid = true;

                        $(this).find('input').each(function() {
                            if ($(this).val().trim() === '') {
                                groupIsValid = false;
                                $(this).addClass('is-invalid');
                                $(this).next('.invalid-feedback').remove();
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

                    // Validate signature
                    const canvas = document.getElementById('signature-canvas');
                    const signatureInput = document.getElementById('signature-input-paf');
                    if (signaturePad.isEmpty()) {
                        isValid = false;
                        $('#signature-canvas').addClass('is-invalid');
                        if (!$('#signature-canvas').next('.invalid-feedback').length) {
                            $('#signature-canvas').after(
                                '<div class="invalid-feedback">Signature is required.</div>');
                        }
                    } else {
                        signatureInput.value = signaturePad.toDataURL();
                        $('#signature-canvas').removeClass('is-invalid');
                        $('#signature-canvas').next('.invalid-feedback').remove();
                    }

                    return isValid;
                }

                // Validate the form before proceeding
                if (!validateForm()) {
                    alert("Please fill required fields.");
                    return; // Stop here if form is not valid
                }

                // If form is valid, show the modal
                $('#deletePreviewApp').modal('show');

                // Capture the signature data
                const signatureDataUrl = signaturePad.toDataURL();
                document.getElementById('signature-input-paf').value = signatureDataUrl;

                // Submit the form via AJAX
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
                            window.location = "{{route('backend.learner.dashboard')}}"
                            button.prop('disabled', false);
                            form[0].reset();
                            $('#deletePreviewApp').modal('hide');
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
