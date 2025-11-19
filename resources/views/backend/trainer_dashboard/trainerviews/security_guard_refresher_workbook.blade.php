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

    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('main')
    <div class="formWrapper">
        <div class="row">


            @php
                $username = auth()->user()->name;
                $pdf = $submission_pdf;
            @endphp


            <div class="col-12">
                <div class="row headerDetail mb-5">
                    <div class="col-4">
                        <h1>Security Guard Refresher Workbook</h1>
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
                    //dd($learner_response);
                    $first_name = $learner_response['data']['first_name'];
                    $last_name = $learner_response['data']['last_name'];
                    $training_provider = $learner_response['data']['training_provider'];
                    $course_start_date = $learner_response['data']['info_course_end_date'];
                    $course_end_date = $learner_response['data']['info_course_end_date'];
                    $signature = $learner_response['signature'];
                    $assessment_date = $learner_response['data']['assessment_date'];
                    $types_of_searches = $learner_response['data']['Q1. State the THREE different types of searches that are carried out by a security officer'] ?? [];
                    $duty_of_care = $learner_response['data']['Q2a. Explain what is meant by duty of care'] ?? [];
                    $occasions_for_search_rights = $learner_response['data']['Q2a. Identify THREE occasions when a security officer has the right to search'] ?? [];
                    $single_sex = $learner_response['data']['Q2b. Single sex'] ?? [];
                    $transgender_individuals = $learner_response['data']['Q2b. Transgender individuals'] ?? [];
                    $duty_of_care_for_all = $learner_response['data']['Q2b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable'] ?? [];
                    $search_equipment = $learner_response['data']['Q3. Identify SEVEN different types of equipment that can be used to assist with searches'] ?? [];
                    $hazards_when_conducting_searches = $learner_response['data']['Q4. Identify SEVEN hazards you may encounter when conducting searches'] ?? [];
                    $precautions_for_searching = $learner_response['data']['Q5. State FIVE precautions that you can take when carrying out a search'] ?? [];
                    $incident_or_accident_actions = $learner_response['data']['Q6. State the actions to take if an incident or an accident occurs'] ?? [];
                    $cars = $learner_response['data']['Q7. Cars'] ?? [];
                    $vans = $learner_response['data']['Q7. Vans'] ?? [];
                    $cycles = $learner_response['data']['Q7. Cycles'] ?? [];
                    $motorcycles = $learner_response['data']['Q7. Motorcycles'] ?? [];
                    $heavy_goods_vehicles = $learner_response['data']['Q7. Heavy goods vehicles'] ?? [];
                    $reasons_for_premises_search = $learner_response['data']['Q8. Identify FIVE reasons for carrying out a premises search'] ?? [];
                    $actions_on_search_refusal = $learner_response['data']['Q9. State FOUR actions to take in the event of a search refusal'] ?? [];
                    $search_documentation = $learner_response['data']['Q10. Identify FOUR reasons for completing search documentation'] ?? [];
                    $prohibited_item_actions = $learner_response['data']['Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search'] ?? [];
                    $vulnerable_factors = $learner_response['data']['Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others'] ?? [];
                    $vulnerable_factors_explanation = $learner_response['data']['Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable'] ?? [];
                    $vulnerable_individual_actions = $learner_response['data']['Q14. Identify FIVE actions that you should take towards vulnerable individuals'] ?? [];
                    $behaviours_of_sexual_predators = $learner_response['data']['Q15. Identify FOUR behaviours that may be exhibited by sexual predators'] ?? [];
                    $indicators_of_abuse = $learner_response['data']['Q16. Identify FOUR indicators of abuse'] ?? [];
                    $allegations_of_sexual_assault = $learner_response['data']['Q17. State how to deal with allegations of sexual assault'] ?? [];
                    $antisocial_behaviour = $learner_response['data']['Q18. State how to deal with anti-social behaviour'] ?? [];
                    $threat_levels = $learner_response['data']['Q19. Identify the FIVE different threat levels'] ?? [];
                    $terror_attack_methods = $learner_response['data']['Q20. What are the most common terror attack methods?'] ?? [];
                    $terror_threat_actions = $learner_response['data']['Q21. Explain the actions you should take in the event of a terror threat at the venue or site'] ?? [];
                    $suspicious_items_procedures = $learner_response['data']['Q22. Identify the procedures for dealing with suspicious items'] ?? [];
                    $suspicious_activity_behaviours = $learner_response['data']['Q23. Identify SIX behaviours that could indicate suspicious activity'] ?? [];
                    $response_to_suspicious_behaviour = $learner_response['data']['Q24. Identify how you should respond to suspicious behaviour'] ?? [];

                @endphp
                <div class="col-12">
                    {{-- <h1>Security Guard Refresher Workbook</h1> --}}
                    <div class="learnerInformation">
                        <h4 class="bgStrip">Learner Information</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>Name<span>*</span></label>
                                    <input type="text" id="first_name" name="data[first_name]" class="form-control"
                                           value="{{ $first_name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Training Provider </label>
                                    <input type="text" name="data[training_provider]"
                                           value="{{ $training_provider ?? '' }}" class="form-control"
                                    >
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
                                    <label>Course End Date </label>
                                    <input type="date" name="data[course_end_date]" value="{{ $course_end_date ?? '' }}"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <h4 class="bgStrip">Knowledge questions </h4>
                    <div class="devider"></div>
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
                                       class="form-control" value="{{$types_of_searches[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q1. State the THREE different types of searches that are carried out by a security officer][]"
                                       class="form-control" value="{{$types_of_searches[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q1. State the THREE different types of searches that are carried out by a security officer][]"
                                       class="form-control" value="{{$types_of_searches[2]}}">
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
                                       class="form-control" value="{{$occasions_for_search_rights[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q2a. Identify THREE occasions when a security officer has the right to search][]"
                                       class="form-control" value="{{$occasions_for_search_rights[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q2a. Identify THREE occasions when a security officer has the right to search][]"
                                       class="form-control" value="{{$occasions_for_search_rights[2]}}">
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
                                       value="{{$single_sex}}">
                            </div>
                            <div>
                                <p><strong>Transgender individuals</strong></p>
                                <input type="text" name="data[Q2b. Transgender individuals]"
                                       value="{{$transgender_individuals}}" class="form-control">
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                       class="form-control" value="{{$search_equipment[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                       class="form-control" value="{{$search_equipment[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                       class="form-control" value="{{$search_equipment[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                       class="form-control" value="{{$search_equipment[3]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text"
                                       name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                       class="form-control" value="{{$search_equipment[4]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text"
                                       name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                       class="form-control" value="{{$search_equipment[5]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">7.</label>
                                <input type="text"
                                       name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                       class="form-control" value="{{$search_equipment[6]}}">
                            </div>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                       class="form-control" value="{{$hazards_when_conducting_searches[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                       class="form-control" value="{{$hazards_when_conducting_searches[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                       class="form-control" value="{{$hazards_when_conducting_searches[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                       class="form-control" value="{{$hazards_when_conducting_searches[3]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text"
                                       name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                       class="form-control" value="{{$hazards_when_conducting_searches[4]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text"
                                       name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                       class="form-control" value="{{$hazards_when_conducting_searches[5]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">7.</label>
                                <input type="text"
                                       name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                       class="form-control" value="{{$hazards_when_conducting_searches[6]}}">
                            </div>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q5. State FIVE precautions that you can take when carrying out a search][]"
                                       class="form-control" value="{{$precautions_for_searching[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q5. State FIVE precautions that you can take when carrying out a search][]"
                                       class="form-control" value="{{$precautions_for_searching[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q5. State FIVE precautions that you can take when carrying out a search][]"
                                       class="form-control" value="{{$precautions_for_searching[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q5. State FIVE precautions that you can take when carrying out a search][]"
                                       class="form-control" value="{{$precautions_for_searching[3]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text"
                                       name="data[Q5. State FIVE precautions that you can take when carrying out a search][]"
                                       class="form-control" value="{{$precautions_for_searching[4]}}">
                            </div>
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
                                <textarea
                                    name="data[Q6. State the actions to take if an incident or an accident occurs]"
                                    cols="30"
                                    rows="10" class="form-control">{{$incident_or_accident_actions ?? ""}}</textarea>
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
                                <input type="text" name="data[Q7. Cycles]" class="form-control" value="{{$cycles}}">
                            </div>
                            <div>
                                <p><strong>Motorcycles</strong></p>
                                <input type="text" name="data[Q7. Motorcycles]" class="form-control"
                                       value="{{$motorcycles}}">
                            </div>
                            <div>
                                <p><strong>Cars</strong></p>
                                <input type="text" name="data[Q7. Cars]" class="form-control" value="{{$cars}}">
                            </div>
                            <div>
                                <p><strong>Vans</strong></p>
                                <input type="text" name="data[Q7. Vans]" class="form-control" value="{{$vans}}">
                            </div>
                            <div>
                                <p><strong>Heavy goods vehicles</strong></p>
                                <input type="text" name="data[Q7. Heavy goods vehicles]" class="form-control"
                                       value="{{$heavy_goods_vehicles}}">
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q8. Identify FIVE reasons for carrying out a premises search][]"
                                       class="form-control" value="{{$reasons_for_premises_search[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q8. Identify FIVE reasons for carrying out a premises search][]"
                                       class="form-control" value="{{$reasons_for_premises_search[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q8. Identify FIVE reasons for carrying out a premises search][]"
                                       class="form-control" value="{{$reasons_for_premises_search[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q8. Identify FIVE reasons for carrying out a premises search][]"
                                       class="form-control" value="{{$reasons_for_premises_search[3]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text"
                                       name="data[Q8. Identify FIVE reasons for carrying out a premises search][]"
                                       class="form-control" value="{{$reasons_for_premises_search[4]}}">
                            </div>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q9. State FOUR actions to take in the event of a search refusal][]"
                                       class="form-control" value="{{$actions_on_search_refusal[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q9. State FOUR actions to take in the event of a search refusal][]"
                                       class="form-control" value="{{$actions_on_search_refusal[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q9. State FOUR actions to take in the event of a search refusal][]"
                                       class="form-control" value="{{$actions_on_search_refusal[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q9. State FOUR actions to take in the event of a search refusal][]"
                                       class="form-control" value="{{$actions_on_search_refusal[3]}}">
                            </div>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q10. Identify FOUR reasons for completing search documentation][]"
                                       class="form-control" value="{{$search_documentation[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q10. Identify FOUR reasons for completing search documentation][]"
                                       class="form-control" value="{{$search_documentation[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q10. Identify FOUR reasons for completing search documentation][]"
                                       class="form-control" value="{{$search_documentation[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q10. Identify FOUR reasons for completing search documentation][]"
                                       class="form-control" value="{{$search_documentation[3]}}">
                            </div>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search][]"
                                       class="form-control" value="{{$prohibited_item_actions[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search][]"
                                       class="form-control" value="{{$prohibited_item_actions[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search][]"
                                       class="form-control" value="{{$prohibited_item_actions[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search][]"
                                       class="form-control" value="{{$prohibited_item_actions[3]}}">
                            </div>


                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text"
                                       name="data[Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search][]"
                                       class="form-control" value="{{$prohibited_item_actions[4]}}">
                            </div>

                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text"
                                       name="data[Q11. Identify SIX actions to take if a prohibited or restricted item is found during a search][]"
                                       class="form-control" value="{{$prohibited_item_actions[5]}}">
                            </div>

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
                                      class="form-control">{{$duty_of_care}}</textarea>
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
                                cols="30"
                                rows="10" class="form-control">{{$duty_of_care_for_all}}</textarea>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others][]"
                                       class="form-control" value="{{$vulnerable_factors[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others][]"
                                       class="form-control" value="{{$vulnerable_factors[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others][]"
                                       class="form-control" value="{{$vulnerable_factors[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others][]"
                                       class="form-control" value="{{$vulnerable_factors[3]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text"
                                       name="data[Q13a. Identify FIVE factors that could make someone vulnerable or more at risk than others][]"
                                       class="form-control" value="{{$vulnerable_factors[4]}}">
                            </div>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable][]"
                                       class="form-control" value="{{$vulnerable_factors_explanation[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable][]"
                                       class="form-control" value="{{$vulnerable_factors_explanation[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable][]"
                                       class="form-control" value="{{$vulnerable_factors_explanation[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable][]"
                                       class="form-control" value="{{$vulnerable_factors_explanation[3]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text"
                                       name="data[Q13b. Explain why the FIVE factors you identified in question 13a could make someone vulnerable][]"
                                       class="form-control" value="{{$vulnerable_factors_explanation[4]}}">
                            </div>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q14. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                       class="form-control" value="{{$vulnerable_individual_actions[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q14. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                       class="form-control" value="{{$vulnerable_individual_actions[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q14. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                       class="form-control" value="{{$vulnerable_individual_actions[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q14. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                       class="form-control" value="{{$vulnerable_individual_actions[3]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text"
                                       name="data[Q14. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                       class="form-control" value="{{$vulnerable_individual_actions[4]}}">
                            </div>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q15. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                       class="form-control" value="{{$behaviours_of_sexual_predators[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q15. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                       class="form-control" value="{{$behaviours_of_sexual_predators[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q15. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                       class="form-control" value="{{$behaviours_of_sexual_predators[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q15. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                       class="form-control" value="{{$behaviours_of_sexual_predators[3]}}">
                            </div>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Q16. Identify FOUR indicators of abuse][]"
                                       class="form-control" value="{{$indicators_of_abuse[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Q16. Identify FOUR indicators of abuse][]"
                                       class="form-control" value="{{$indicators_of_abuse[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Q16. Identify FOUR indicators of abuse][]"
                                       class="form-control" value="{{$indicators_of_abuse[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Q16. Identify FOUR indicators of abuse][]"
                                       class="form-control" value="{{$indicators_of_abuse[3]}}">
                            </div>
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
                                <textarea name="data[Q17. State how to deal with allegations of sexual assault]"
                                          cols="30" rows="10"
                                          class="form-control">{{$allegations_of_sexual_assault ?? ""}}</textarea>
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
                                <textarea name="data[Q18. State how to deal with anti-social behaviour]" cols="30"
                                          rows="10"
                                          class="form-control">{{$antisocial_behaviour ?? ""}}</textarea>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" name="data[Q19. Identify the FIVE different threat levels][]"
                                       class="form-control" value="{{$threat_levels[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Q19. Identify the FIVE different threat levels][]"
                                       class="form-control" value="{{$threat_levels[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Q19. Identify the FIVE different threat levels][]"
                                       class="form-control" value="{{$threat_levels[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Q19. Identify the FIVE different threat levels][]"
                                       class="form-control" value="{{$threat_levels[3]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Q19. Identify the FIVE different threat levels][]"
                                       class="form-control" value="{{$threat_levels[4]}}">
                            </div>
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
                                <texttarea name="data[Q20. What are the most common terror attack methods?]" cols="30"
                                           rows="10"
                                           class="form-control">{{$terror_attack_methods}}</texttarea>
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
                                <textarea
                                    name="data[Q21. Explain the actions you should take in the event of a terror threat at the venue or site]"
                                    cols="30" rows="10"
                                    class="form-control">{{$terror_threat_actions}}</textarea>
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
                                <textarea name="data[Q22. Identify the procedures for dealing with suspicious items]"
                                          cols="30" rows="10"
                                          class="form-control">{{$suspicious_items_procedures}}</textarea>
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
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text"
                                       name="data[Q23. Identify SIX behaviours that could indicate suspicious activity][]"
                                       class="form-control" value="{{$suspicious_activity_behaviours[0]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text"
                                       name="data[Q23. Identify SIX behaviours that could indicate suspicious activity][]"
                                       class="form-control" value="{{$suspicious_activity_behaviours[1]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text"
                                       name="data[Q23. Identify SIX behaviours that could indicate suspicious activity][]"
                                       class="form-control" value="{{$suspicious_activity_behaviours[2]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text"
                                       name="data[Q23. Identify SIX behaviours that could indicate suspicious activity][]"
                                       class="form-control" value="{{$suspicious_activity_behaviours[3]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text"
                                       name="data[Q23. Identify SIX behaviours that could indicate suspicious activity][]"
                                       class="form-control" value="{{$suspicious_activity_behaviours[4]}}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text"
                                       name="data[Q23. Identify SIX behaviours that could indicate suspicious activity][]"
                                       class="form-control" value="{{$suspicious_activity_behaviours[5]}}">
                            </div>
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
                                <textarea name="data[Q24. Identify how you should respond to suspicious behaviour]"
                                          cols="30" rows="10"
                                          class="form-control">{{$response_to_suspicious_behaviour ?? ""}}</textarea>
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
                                           value="{{ $first_name ?? '' }}" readonly>
                                    <small>First Name</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <input type="text" name="data[last_name]" class="form-control"
                                           value="{{ $last_name ?? '' }}" readonly>
                                    <small>Last Name</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Learner Signature<span>*</span></label>
                                    <div>
                                        <img src="{{$signature ?? ''}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Date, Time</label>
                                    <input type="text" name="data[assessment_date]" class="form-control"
                                           value="{{$assessment_date}}" readonly="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
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
                                        <th scope="col">
                                            Correct/Incorrect
                                            <br>
                                            <button type="button" class="btn btn-sm btn-light mt-1" id="toggle-all-btn">Select All</button>
                                        </th>
                                        <th scope="col">Assessor Feedback</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 24; $i++)
                                        @php
                                            // Define an array for the questions that have sub-questions
                                            $subQuestions = [
                                                2 => ['a', 'b'],
                                                12 => ['a', 'b'],
                                                13 => ['a', 'b'],
                                            ];
                                        @endphp

                                        {{-- Check if the question has sub-questions --}}
                                        @if(array_key_exists($i, $subQuestions))
                                            {{-- Loop through sub-questions --}}
                                            @foreach($subQuestions[$i] as $sub)
                                                <tr>
                                                    <td>Question {{ $i }}{{ $sub }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger toggle-btn"
                                                                data-correct="false"
                                                                style="width: 40px;">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                        <input type="hidden" name="answers[{{ $i }}{{ $sub }}]"
                                                               value="incorrect"
                                                               class="toggle-input">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="feedback[{{ $i }}{{ $sub }}]"
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
                                                            data-correct="false"
                                                            style="width: 40px;">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    <input type="hidden" name="answers[{{ $i }}]" value="incorrect"
                                                           class="toggle-input">
                                                </td>
                                                <td>
                                                    <input type="text" name="feedback[{{ $i }}]" class="form-control">
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
                                        <p>However, it should be noted that it is still the responsibility of the
                                            assessor
                                            to ensure the answer provided by the learner is of the appropriate standard
                                            to
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
                                    <h4 class="mt-3">Unit 2: Principles of Minimising Personal Risk for Security
                                        Officers
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
                                            @for ($i = 1; $i <= 31; $i++)
                                                @php
                                                    // Define an array for the questions that have sub-questions
                                                    $subQuestions = [
                                                        2 => ['a', 'b'],
                                                        11 => ['a', 'b'],
                                                        12 => ['a', 'b'],
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
                                                    <label class="form-check-label">Further assessment evidence guidance
                                                        is
                                                        required.</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                           name="high_field_response[evidence1]"
                                                           value="No further assessment evidence guidance is required">
                                                    <label class="form-check-label">No further assessment evidence
                                                        guidance
                                                        is required, as all criteria within this unit are linked to the
                                                        questions within the workbook. If assessors wish to supplement
                                                        this
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
                                                    <input type="text" name="high_field_response[date_time]"
                                                           class="w-100 form-control" id="customDate">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
            integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Include Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>

        $(document).ready(function () {
            // $('.toggle-btn').click(function () {
            //     // Find the associated hidden input
            //     let hiddenInput = $(this).siblings('.toggle-input');
            //
            //     if ($(this).hasClass('btn-success')) {
            //         // Toggle to incorrect
            //         $(this).removeClass('btn-success').addClass('btn-danger');
            //         $(this).html('<i class="fas fa-times"></i>');
            //         $(this).attr('data-correct', 'false');
            //         hiddenInput.val('incorrect'); // Update the hidden input value
            //     } else {
            //         // Toggle to correct
            //         $(this).removeClass('btn-danger').addClass('btn-success');
            //         $(this).html('<i class="fas fa-check"></i>');
            //         $(this).attr('data-correct', 'true');
            //         hiddenInput.val('correct'); // Update the hidden input value
            //     }
            // });

            const canvas = document.getElementById('signature-canvas');
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)'
            });

            document.getElementById('clear-signature').addEventListener('click', function () {
                signaturePad.clear();
            });

            document.getElementById('submitForm').addEventListener('submit', function (event) {
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

    <script>
        flatpickr("#customDate", {
            dateFormat: "d/m/Y",  // Forces dd/mm/yyyy format
            allowInput: true
        });
    </script>

@endpush
