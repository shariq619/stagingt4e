@php use App\Models\Cohort;use Carbon\Carbon; @endphp
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


            @php
                $username = auth()->user()->name;
            @endphp
            <div class="col-12">
                <div class="row headerDetail">

                    <h1>Door Supervisor Self-Study Activity Sheet</h1>


                </div>
                <input type="hidden" name="task_name" value="{{ $task->name }}"/>
                <input type="hidden" name="task_id" value="{{ $task->id }}"/>


                @php
                    $learner_response = json_decode($learner_response, true);

                    //dd($learner_response['data']);


                    $cohort_data = Cohort::find($learner_response['cohort_id']);

                    if($cohort_data){
                        $course_start_date = $cohort_data->end_date_time;
                        $formatted_date = $course_start_date ? Carbon::parse($course_start_date)->format('Y-m-d') : '';
                    }


                    $email = $learner_response['data']['email'] ?? [];
                    $last_name = $learner_response['data']['last_name'] ?? [];
                    $first_name = $learner_response['data']['first_name'] ?? [];
                    $assessment_date = $learner_response['data']['assessment_date'] ?? [];
                    $detail_last_name = $learner_response['data']['detail_last_name'] ?? [];
                    $course_start_date = $learner_response['data']['course_start_date'] ?? $formatted_date;
                    $detail_first_name = $learner_response['data']['detail_first_name'] ?? [];
                    $Q30 = $learner_response['data']['Q30. What is terrorism?'] ?? [];
                    $Q24 = $learner_response['data']['Q24. What is an emergency?'] ?? [];
                    $Q5 = $learner_response['data']['Q5. List 3 benefits of using CCTV'] ?? [];
                    $Q21 = $learner_response['data']['Q21. Name 6 different safety signs'] ?? [];
                    $Q25 = $learner_response['data']['Q25. What are the 4 aims of first aid?'] ?? [];
                    $Q11 = $learner_response['data']['Q11. Please describe internal customers'] ?? [];
                    $Q3 = $learner_response['data']['Q3. Describe the 3 main aims of the SIA'] ?? [];
                    $Q14 = $learner_response['data']['Q14. What are protected characteristics?'] ?? [];
                    $Q12 = $learner_response['data']['Q12. List different types of communication'] ?? [];
                    $Q23 = $learner_response['data']['Q23. What are internal fire doors used for?'] ?? [];
                    $Q27 = $learner_response['data']['Q27. List FIVE examples of workplace hazards'] ?? [];
                    $Q8 = $learner_response['data']['Q8. Explain what is meant by the term ARREST'] ?? [];
                    $Q1 = $learner_response['data']['Q1. What is the purpose of security industry?'] ?? [];
                    $Q2 = $learner_response['data']['Q2. List 3 ways in which security is provided'] ?? [];
                    $Q31 = $learner_response['data']['Q31. What type of threat level is substational?'] ?? [];
                    $Q16 = $learner_response['data']['Q16. Give 3 reasons why venue might be evacuated'] ?? [];
                    $Q29 = $learner_response['data']['Q29. Give 3 examples of child sexual exploitation'] ?? [];
                    $Q17 = $learner_response['data']['Q17. What are the components of the fire triangle?'] ?? [];
                    $Q7 = $learner_response['data']['Q7. What are the legal implications of using CCTV?'] ?? [];
                    $Q19 = $learner_response['data']['Q19. How many Data protection principles are there?'] ?? [];
                    //$Q20 = $learner_response['data']['Q20. How many Data protection principles are there?'] ?? [];
                    $Q15 = $learner_response['data']['Q15. What are the 3 consideration when forces applied?'] ?? [];
                    $Q22 = $learner_response['data']['Q22. Classify the fire and give one example of each one'] ?? $learner_response['data']['Q21. Classify the fire and give one example of each one'];
                    $Q4 = $learner_response['data']['Q4. List any 5 examples of community safety initiatives'] ?? [];
                    $Q28 = $learner_response['data']['Q28. Explain the principles of evacuation and invacuation'] ?? [];
                    $Q6 = $learner_response['data']['Q6. List any 5 qualities that a security operative should have'] ?? [];
                    $Q26 = $learner_response['data']['Q26. What are the risks of lone working within the private security industry'] ?? [];
                    $Q10 = $learner_response['data']['Q10. Explain the procedures a security operative should follow after an arrest'] ?? [];
                    $Q13 = $learner_response['data']['Q13. Give 3 examples of good customer care and 3 examples of bad customer care'] ?? [];
                    $Q9 = $learner_response['data']['Q9. Provide 6 examples of offences for which a security operative can make an arrest'] ?? [];
                    $Q18 = $learner_response['data']['Q18. What are the priorities that you need to observe during evacuation from a venue?'] ?? [];
                    $learner_signature = $learner_response['signature'] ?? ''; // Assuming the signature is stored this way

                   // dd($course_start_date);

                @endphp


                <div class="col-12">

                    <div class="studyAssessment">

                        <div class="devider"></div>
                        <h4 class="bgStrip">Learner Details</h4>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>{{ __('First Name') }}<span>*</span></label>
                                    <input type="text" id="first_name" name="data[first_name]" class="form-control"
                                           value="{{ $first_name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Last Name') }}<span>*</span></label>
                                    <input type="text" id="last_name" name="data[last_name]" class="form-control"
                                           value="{{ $last_name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Email Address') }}<span>*</span></label>
                                    <input type="email" id="email" name="data[email]" class="form-control"
                                           value="{{ $email ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>{{ __('Course Start Date') }}</label>
                                    <input type="date" id="course_start_date" name="data[course_start_date]"
                                           class="form-control" value="{{ $course_start_date ?? "" }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="assessment">
                        <div class="devider"></div>
                        <h4 class="bgStrip">Theory Questions </h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Q1. What is the purpose of security industry?') }}
                                        <span>*</span></label>
                                    <textarea name="data[Q1. What is the purpose of security industry?]"
                                              id="q1_ans_security" cols="30" rows="10"
                                              class="form-control">{{ $Q1 ?? '' }}</textarea>
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
                                    <label>{{ __('Q2. List 3 ways in which security is provided') }}
                                        <span>*</span></label>

                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="d-flex mb-2 align-items-center">
                                            <label class="mr-3">{{ $i + 1 }}.</label>
                                            <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                   name="data[Q2. List 3 ways in which security is provided][]"
                                                   class="form-control" value="{{ $Q2[$i] ?? '' }}">
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
                                                   name="data[Q3. Describe the 3 main aims of the SIA][]"
                                                   class="form-control"
                                                   value="{{ $Q3[$i] ?? '' }}">
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
                                    <label>{{ __('Q4. List any 5 examples of community safety initiatives') }}
                                        <span>*</span></label>

                                    @for ($i = 0; $i < 5; $i++)
                                        <div class="d-flex mb-2 align-items-center">
                                            <label class="mr-3">{{ $i + 1 }}.</label>
                                            <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                   name="data[Q4. List any 5 examples of community safety initiatives][]"
                                                   class="form-control" value="{{ $Q4[$i] ?? '' }}">
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
                                                   value="{{ $Q5[$i] ?? '' }}">
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
                                    <label>{{ __('Q6. List any 5 qualities that a security operative should have') }}
                                        <span>*</span></label>

                                    @for ($i = 0; $i < 5; $i++)
                                        <div class="d-flex mb-2 align-items-center">
                                            <label class="mr-3">{{ $i + 1 }}.</label>
                                            <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                   name="data[Q6. List any 5 qualities that a security operative should have][]"
                                                   class="form-control" value="{{ $Q6[$i] ?? '' }}">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q7. What are the legal implications of using CCTV?<span>*</span></label>
                                    <textarea name="data[Q7. What are the legal implications of using CCTV?]" cols="30"
                                              rows="10"
                                              class="form-control ">{{  $Q7 ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q8. Explain what is meant by the term ARREST.<span>*</span></label>
                                    <textarea name="data[Q8. Explain what is meant by the term ARREST]" cols="30"
                                              rows="10"
                                              class="form-control ">{{  $Q8 ?? '' }}</textarea>
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
                                        <label>{{ __('Q9. Provide 6 examples of offences for which a security operative can make an arrest') }}
                                            <span>*</span></label>

                                        @for ($i = 0; $i < 6; $i++)
                                            <div class="d-flex mb-2 align-items-center">
                                                <label class="mr-3">{{ $i + 1 }}.</label>
                                                <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                       name="data[Q9. Provide 6 examples of offences for which a security operative can make an arrest][]"
                                                       class="form-control"
                                                       value="{{ $Q9[$i] ?? '' }}">
                                            </div>
                                        @endfor
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q10. Explain the procedures a security operative should follow after an
                                        arrest<span>*</span></label>
                                    <textarea
                                        name="data[Q10. Explain the procedures a security operative should follow after an arrest]"
                                        id="q10_ans_procedures" cols="30" rows="10"
                                        class="form-control ">{{ $Q10 ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q11. Please describe internal customers.<span>*</span></label>
                                    <textarea name="data[Q11. Please describe internal customers]"
                                              id="q11_ans_customers" cols="30" rows="10"
                                              class="form-control ">{{  $Q11 ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q12. List different types of communication.<span>*</span></label>
                                    <textarea name="data[Q12. List different types of communication]"
                                              id="q12_ans_communication" cols="30"
                                              rows="10" class="form-control ">{{ $Q12 ?? '' }}</textarea>
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
                                        <label>{{ __('Q13. Give 3 examples of good customer care and 3 examples of bad customer care') }}
                                            <span>*</span></label>

                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="d-flex mb-2 align-items-center">
                                                <label class="mr-3">{{ $i + 1 }}.</label>
                                                <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                       name="data[Q13. Give 3 examples of good customer care and 3 examples of bad customer care][]"
                                                       class="form-control" value="{{ $Q13[$i] ?? '' }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q14. What are protected characteristics?<span>*</span></label>
                                    <textarea name="data[Q14. What are protected characteristics?]"
                                              id="q14_ans_characteristics" cols="30"
                                              rows="10" class="form-control ">{{ $Q14 ?? '' }}</textarea>
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
                                        <label>{{ __('Q15. What are the 3 consideration when forces applied?') }}
                                            <span>*</span></label>

                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="d-flex mb-2 align-items-center">
                                                <label class="mr-3">{{ $i + 1 }}.</label>
                                                <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                       name="data[Q15. What are the 3 consideration when forces applied?][]"
                                                       class="form-control"
                                                       value="{{ $Q15[$i] ?? '' }}">
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
                                            $learner_response['Q16. Give 3 reasons why venue might be evacuated'] ??
                                                [],
                                        );
                                    @endphp
                                    <div class="form-group validList">
                                        <label>{{ __('Q16. Give 3 reasons why venue might be evacuated') }}
                                            <span>*</span></label>

                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="d-flex mb-2 align-items-center">
                                                <label class="mr-3">{{ $i + 1 }}.</label>
                                                <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                       name="data[Q16. Give 3 reasons why venue might be evacuated][]"
                                                       class="form-control" value="{{ $Q16[$i] ?? '' }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q17. What are the components of the fire triangle?<span>*</span></label>
                                    <textarea name="data[Q17. What are the components of the fire triangle?]"
                                              id="q17_ans_triangle" cols="30"
                                              rows="10" class="form-control ">{{ $Q17 ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q18. What are the priorities that you need to observe during evacuation from
                                        a
                                        venue?<span>*</span></label>
                                    <textarea
                                        name="data[Q18. What are the priorities that you need to observe during evacuation from a venue?]"
                                        id="q18_ans_evacuation" cols="30"
                                        class="form-control ">{{ $Q18 ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>Q19. How many Data protection principles are there?<span>*</span></label>
                                    <textarea name="data[Q19. How many Data protection principles are there?]"
                                              id="q19_ans_protection" cols="30"
                                              rows="10" class="form-control ">{{ $Q19 ?? '' }}</textarea>
                                </div>
                            </div>
{{--                            <div class="col-12">--}}
{{--                                <div class="form-group requiredRole">--}}
{{--                                    <label>Q20. How many Data protection principles are there?<span>*</span></label>--}}
{{--                                    <textarea name="data[Q20. How many Data protection principles are there?]"--}}
{{--                                              id="q20_ans_protection" cols="30"--}}
{{--                                              rows="10" class="form-control ">{{ $Q20 ?? '' }}</textarea>--}}
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
                                                       name="data[Q21. Name 6 different safety signs][]"
                                                       class="form-control" value="{{ $Q21[$i] ?? '' }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Q21. Classify the fire and give one example of each one') }}<span>*</span></label>
                                        <textarea class="form-control ">{{ $Q22  ?? '' }}</textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q22. What are internal fire doors used for?<span>*</span></label>
                                        <textarea class="form-control ">{{ $Q23  ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q23. What is an emergency?<span>*</span></label>
                                        <textarea name="data[Q24. What is an emergency?]" id="q24_ans_emergency"
                                                  cols="30" rows="10"
                                                  class="form-control ">{{ $Q24 ?? '' }}</textarea>
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
                                            <label>{{ __('Q24. What are the 4 aims of first aid?') }}
                                                <span>*</span></label>

                                            @for ($i = 0; $i < 4; $i++)
                                                <div class="d-flex mb-2 align-items-center">
                                                    <label class="mr-3">{{ $i + 1 }}.</label>
                                                    <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                           name="data[Q25. What are the 4 aims of first aid?][]"
                                                           class="form-control" value="{{ $Q25[$i] ?? '' }}">
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q25. What are the risks of lone working within the private security
                                            industry<span>*</span></label>
                                        <textarea
                                            name="data[Q26. What are the risks of lone working within the private security industry]"
                                            id="q26_ans_risks"
                                            cols="30" rows="10" class="form-control">{{ $Q26 ?? '' }}</textarea>
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
                                            <label>{{ __('Q26. List FIVE examples of workplace hazards') }}
                                                <span>*</span></label>

                                            @for ($i = 0; $i < 5; $i++)
                                                <div class="d-flex mb-2 align-items-center">
                                                    <label class="mr-3">{{ $i + 1 }}.</label>
                                                    <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                           name="data[Q27. List FIVE examples of workplace hazards][]"
                                                           class="form-control" value="{{ $Q27[$i] ?? '' }}">
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q27. Explain the principles of evacuation and
                                            invacuation.<span>*</span></label>
                                        <textarea name="data[Q28. Explain the principles of evacuation and invacuation]"
                                                  id="q28_ans_invacuation"
                                                  cols="30" rows="10" class="form-control">{{ $Q28 ?? '' }}</textarea>
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
                                            <label>{{ __('Q28. Give 3 examples of child sexual exploitation') }}
                                                <span>*</span></label>

                                            @for ($i = 0; $i < 3; $i++)
                                                <div class="d-flex mb-2 align-items-center">
                                                    <label class="mr-3">{{ $i + 1 }}.</label>
                                                    <input type="text" id="q2_ans_{{ $i + 1 }}"
                                                           name="data[Q29. Give 3 examples of child sexual exploitation][]"
                                                           class="form-control"
                                                           value="{{ $Q29[$i] ?? '' }}">
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q29. What is terrorism?<span>*</span></label>
                                        <textarea name="data[Q30. What is terrorism?]" id="q30_ans_terrorism" cols="30"
                                                  rows="10"
                                                  class="form-control ">{{  $Q30 ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>Q30. What type of threat level is substational?<span>*</span></label>
                                        <textarea name="data[Q31. What type of threat level is substational?]"
                                                  id="q31_ans_substational" cols="30"
                                                  rows="10" class="form-control ">{{ $Q31 ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="learnerDeclaration">
                            <h4 class="bgStrip">Learner Declaration</h4>
                            <label class="ml-4 align-items-center">
                                <input type="checkbox" name="guideline1" class="form-check-input" checked>
                                <span style="color:#000;">I can confirm that I have spent the minimum of 8 hours, studying
                                    the SIA Door Supervisor course Distance Learning Workbook.</span>
                            </label>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('First Name') }}<span>*</span></label>
                                        <input type="text" id="first_name" name="data[detail_first_name]"
                                               class="form-control" value="{{ $detail_first_name }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Last Name') }}<span>*</span></label>
                                        <input type="text" id="last_name" name="data[detail_last_name]"
                                               class="form-control" value="{{ $detail_last_name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Learner Signature') }}<span>*</span></label>
                                        @if(isset($learner_signature))
                                            <div>
                                                <h5>Signature:</h5>
                                                <img src="{{ $learner_signature }}" alt="Learner's Signature"
                                                     style="max-width: 200px;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            @php
                                                $now = new DateTime();
                                            @endphp
                                            <label>{{ __('Date, Time Assessment Completed') }}</label>
                                            <input type="text" id="assessment_date" name="data[assessment_date]"
                                                   class="form-control" value="{{ $assessment_date }}"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 30; $i++)
                                        <tr>
                                            <td>Question {{ $i }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger toggle-btn"
                                                        data-correct="false" style="width: 40px;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <input type="hidden" name="answers[{{ $i }}]" value="incorrect"
                                                       class="toggle-input">
                                            </td>
                                            <td>
                                                <input type="text" name="feedback[{{ $i }}]" class="form-control">
                                                {{-- <textarea name="feedback[{{ $i }}]" class="form-control" rows="4" cols="50" placeholder="Enter feedback"></textarea>--}}
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

        // $(document).ready(function () {
        //     $('.toggle-btn').click(function () {
        //         // Find the associated hidden input
        //         let hiddenInput = $(this).siblings('.toggle-input');
        //
        //         if ($(this).hasClass('btn-success')) {
        //             // Toggle to incorrect
        //             $(this).removeClass('btn-success').addClass('btn-danger');
        //             $(this).html('<i class="fas fa-times"></i>');
        //             $(this).attr('data-correct', 'false');
        //             hiddenInput.val('incorrect'); // Update the hidden input value
        //         } else {
        //             // Toggle to correct
        //             $(this).removeClass('btn-danger').addClass('btn-success');
        //             $(this).html('<i class="fas fa-check"></i>');
        //             $(this).attr('data-correct', 'true');
        //             hiddenInput.val('correct'); // Update the hidden input value
        //         }
        //     });
        // });


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
