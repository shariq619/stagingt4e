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
    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
                        <h1>DS Refresher WorkBook Unit 1</h1>
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

                    //dd($learner_response);

                    $first_name = $learner_response['data']['first_name'];

                    $assessmentDate = $learner_response['data']['assessment_date'];
                    $training_provider = $learner_response['data']['training_provider'];
                    $course_end_date = $learner_response['data']['info_course_end_date'];
                    $course_start_date = $learner_response['data']['info_course_start_date'];

                    $venueCapacityEquipment =
                        $learner_response['data'][
                            'Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity'
                        ];
                    $rightToSearchOccasions =
                        $learner_response['data'][
                            'Q2a. Identify THREE occasions when a door supervisor has the right to search'
                        ];
                    $singleSex = $learner_response['data']['Q2b Single sex'];
                    $transgenderIndividuals = $learner_response['data']['Q2b Transgender individuals'];
                    $searchEquipment =
                        $learner_response['data'][
                            'Q3. Identify SEVEN different types of equipment that can be used to assist with searches'
                        ];
                    $hazardsDuringSearch =
                        $learner_response['data'][
                            'Q4. Identify SEVEN hazards you may encounter when conducting searches'
                        ];
                    $searchPrecautions =
                        $learner_response['data'][
                            'Q5. State NINE precautions that you can take when carrying out a search'
                        ];
                    $actionsOnIncidentOrAccident =
                        $learner_response['data']['Q6. State the actions to take if an incident or an accident occurs'];
                    $reasonsForPremisesSearch =
                        $learner_response['data']['Q7. Identify FIVE reasons for carrying out a premises search'];

                    $actionsOnSearchRefusal =
                        $learner_response['data']['Q8. State FOUR actions to take in the event of a search refusal'];
                    $completingSearchDocumentation =
                        $learner_response['data']['Q9. Identify FOUR reasons for completing search documentation'];
                    $actionsOnProhibitedItems =
                        $learner_response['data'][
                            'Q10. actions to take if a prohibited or restricted item is found during a search'
                        ];
                    $dutyOfCare = $learner_response['data']['Q11a. Explain what is meant by duty of care'];
                    $dutyOfCareImportance =
                        $learner_response['data'][
                            'Q11b. Explain why it is important to have a duty of care for everyone, even if they do not appear to be vulnerable'
                        ];
                    $vulnerableFactors =
                        $learner_response['data'][
                            'Q12a. factors that could make someone vulnerable or more at risk than others'
                        ] ??  $learner_response['data'][
                            'Q12a. Identify FIVE factors that could make someone vulnerable or more at risk than others'
                        ];
                    $vulnerableFactorsExplanation =
                        $learner_response['data'][
                            'Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others'
                        ];
                    $actionsForVulnerableIndividuals =
                        $learner_response['data'][
                            'Q13. Identify FIVE actions that you should take towards vulnerable individuals'
                        ];
                    $behaviorsOfSexualPredators =
                        $learner_response['data'][
                            'Q14. Identify FOUR behaviours that may be exhibited by sexual predators'
                        ];
                    $fourIndicatorsOfAbuse = $learner_response['data']['Q15. Identify FOUR indicators of abuse'];
                    $dealingWithSexualAssault =
                        $learner_response['data']['Q16. State how to deal with allegations of sexual assault'];
                    $fiveThreatLevels = $learner_response['data']['Q18. Identify the FIVE different threat levels'];
                    $commonTerrorAttackMethods =
                        $learner_response['data']['Q19. What are the most common terror attack methods?'];
                    $actionsInTerrorThreat =
                        $learner_response['data'][
                            'Q20. Explain the actions you should take in the event of a terror threat at the venue or site'
                        ];
                    $proceduresForSuspiciousItems =
                        $learner_response['data']['Q21. Identify the procedures for dealing with suspicious items'];
                    $suspiciousBehaviorIndicators =
                        $learner_response['data'][
                            'Q22. Identify SIX behaviours that could indicate suspicious activity'
                        ];
                    $responseToSuspiciousBehavior =
                        $learner_response['data']['Q23. Identify how you should respond to suspicious behaviour'];
                    $fiveMethodsOfSpiking = $learner_response['data']['Q24. State FIVE methods of spiking'];
                    $lawOnSpiking = $learner_response['data']['Q25. State the law in relation to spiking'];
                    $drinkSpikingIndicators =
                        $learner_response['data']['Q26. State FIVE indicators that suggests a drink has been spiked'];
                    $behavioralSignsOfSpiking =
                        $learner_response['data'][
                            'Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks'
                        ];
                    $highRiskSpikingSituations =
                        $learner_response['data'][
                            'Q28. Identify THREE situations when an individual might be at high risk of spiking'
                        ];
                    $preventionOfSpikingIncidents =
                        $learner_response['data'][
                            'Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking'
                        ];
                    $individualSpikingIndicators =
                        $learner_response['data'][
                            'Q30. Describe the indicators that suggest an individual may have been spiked'
                        ];
                    $managingSpikingIncident = $learner_response['data']['Q31. State how to manage a spiking incident'];
                    $last_name = $learner_response['data']['last_name'];
                    // $first_name = $learner_response['first_name'];
                    $signature = $learner_response['signature'] ?? "";
                    $assessment_date = $learner_response['data']['assessment_date'];
                    //dd($learner_response);
                @endphp

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
                                <input type="text" name="data[training_provider]" value="Training4Employment"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Course Start Date</label>
                                <input type="date" name="data[course_start_date]" value="{{ $course_start_date ?? '' }}"
                                    class="form-control">
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
                            <label>{{ __('AC1.1 State the different type of searches carried out by a door supervisor') }}</label>
                            <p>As a door supervisor, you will be required to carry out different types of searches.
                            </p>
                            <label>{{ __('Question 1:') }}</label> State the <label>{{ __('THREE') }}</label>
                            THREE different types of searches that are carried out by a door supervisor.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"
                                class="form-control" value="{{ $venueCapacityEquipment[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"
                                class="form-control" value="{{ $venueCapacityEquipment[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"
                                class="form-control" value="{{ $venueCapacityEquipment[2] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC1.2 Identify a door supervisor’s right to search') }}</label>
                            <p>Door supervisors have specific powers related to their duties, but your right to
                                search individuals is limited. </p>
                            <label>{{ __('Question 2a:') }}</label> Identify <label>{{ __('THREE') }}</label>
                            occasions when a door supervisor has the right to search.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q2a. Identify THREE occasions when a door supervisor has the right to search][]"
                                class="form-control" value="{{ $rightToSearchOccasions[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q2a. Identify THREE occasions when a door supervisor has the right to search][]"
                                class="form-control" value="{{ $rightToSearchOccasions[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q2a. Identify THREE occasions when a door supervisor has the right to search][]"
                                class="form-control" value="{{ $rightToSearchOccasions[2] }}">
                        </div>
                        <small class="d-block">When conducting searches on single-sex and transgender individuals,
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
                    <h4 class="bgStrip">Knowledge questions</h4>
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
                            <input type="text" name="data[Q2b Single sex]" class="form-control"
                                value="{{ $singleSex }}">
                        </div>
                        <div class="mb-3">
                            <label>Transgender individuals</label>
                            <input type="text" name="data[Q2b Transgender individuals]" class="form-control"
                                value="{{ $transgenderIndividuals }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC1.3 Identify the different types of searching equipment') }}</label>
                            <p>As a door supervisor, you may be required to search staff, visitors or customers at a
                                site before allowing entry.</p>
                            <label>{{ __('Question 3:') }}</label> Identify <label>{{ __('SEVEN') }}</label>
                            different types of equipment that can be used to assist with searches.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                class="form-control" value="{{ $searchEquipment[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                class="form-control" value="{{ $searchEquipment[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                class="form-control" value="{{ $searchEquipment[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                class="form-control" value="{{ $searchEquipment[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                class="form-control" value="{{ $searchEquipment[4] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text"
                                name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                class="form-control" value="{{ $searchEquipment[5] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">7.</label>
                            <input type="text"
                                name="data[Q3. Identify SEVEN different types of equipment that can be used to assist with searches][]"
                                class="form-control" value="{{ $searchEquipment[6] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC1.4 Recognise possible hazards when conducting a search') }}</label>
                            <p>Door supervisors may encounter various potential hazards when conducting searches.
                            </p>
                            <label>{{ __('Question 4:') }}</label> Identify <label>{{ __('SEVEN') }}</label>
                            hazards you may encounter when conducting searches.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                class="form-control" value="{{ $hazardsDuringSearch[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                class="form-control" value="{{ $hazardsDuringSearch[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                class="form-control" value="{{ $hazardsDuringSearch[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                class="form-control" value="{{ $hazardsDuringSearch[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                class="form-control" value="{{ $hazardsDuringSearch[4] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text"
                                name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                class="form-control" value="{{ $hazardsDuringSearch[5] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">7.</label>
                            <input type="text"
                                name="data[Q4. Identify SEVEN hazards you may encounter when conducting searches][]"
                                class="form-control" value="{{ $hazardsDuringSearch[6] }}">
                        </div>
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
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $searchPrecautions[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $searchPrecautions[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $searchPrecautions[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $searchPrecautions[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $searchPrecautions[4] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $searchPrecautions[5] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">7.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $searchPrecautions[6] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">8.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $searchPrecautions[7] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">9.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $searchPrecautions[8] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label>{{ __('AC1.6 State the actions to take if an incident or an accident occurs') }}</label>
                            <p>From time to time, incidents or accidents may occur; it is important to always follow
                                the venue’s policy or
                                assignment instructions.</p>
                            <label>{{ __('Question 6:') }}</label>
                            <p>State the actions to take if an incident or an accident occurs.</p>
                            <textarea name="data[Q6. State the actions to take if an incident or an accident occurs]" cols="30"
                                rows="10" class="form-control">{{ $actionsOnIncidentOrAccident ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC1.8 Identify the reasons for carrying out a premises search') }}</label>
                            <p>As well as searching people, you may be required to carry out a premises search. </p>
                            <label>{{ __('Question 7:') }}</label> Identify <label>{{ __('FIVE') }}</label>
                            Identify FIVE reasons for carrying out a premises search.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q7. Identify FIVE reasons for carrying out a premises search][]"
                                class="form-control" value="{{ $reasonsForPremisesSearch[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q7. Identify FIVE reasons for carrying out a premises search][]"
                                class="form-control" value="{{ $reasonsForPremisesSearch[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q7. Identify FIVE reasons for carrying out a premises search][]"
                                class="form-control" value="{{ $reasonsForPremisesSearch[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q7. Identify FIVE reasons for carrying out a premises search][]"
                                class="form-control" value="{{ $reasonsForPremisesSearch[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q5. State NINE precautions that you can take when carrying out a search][]"
                                class="form-control" value="{{ $reasonsForPremisesSearch[4] }}">
                        </div>
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
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q8. State FOUR actions to take in the event of a search refusal][]"
                                class="form-control" value="{{ $actionsOnSearchRefusal[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q8. State FOUR actions to take in the event of a search refusal][]"
                                class="form-control" value="{{ $actionsOnSearchRefusal[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q8. State FOUR actions to take in the event of a search refusal][]"
                                class="form-control" value="{{ $actionsOnSearchRefusal[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q8. State FOUR actions to take in the event of a search refusal][]"
                                class="form-control" value="{{ $actionsOnSearchRefusal[3] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC1.10 Identify reasons for completing search documentation.') }}</label>
                            <p>Venues that require the security team to search people or their property must provide
                                a suitable method of
                                recording searches. </p>
                            <label>{{ __('Question 9:') }}</label> Identify <label>{{ __('FOUR') }}</label>
                            reasons for completing search documentation.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q9. Identify FOUR reasons for completing search documentation][]"
                                class="form-control" value="{{ $completingSearchDocumentation[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q9. Identify FOUR reasons for completing search documentation][]"
                                class="form-control" value="{{ $completingSearchDocumentation[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q9. Identify FOUR reasons for completing search documentation][]"
                                class="form-control" value="{{ $completingSearchDocumentation[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q9. Identify FOUR reasons for completing search documentation][]"
                                class="form-control" value="{{ $completingSearchDocumentation[3] }}">
                        </div>
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
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q10. actions to take if a prohibited or restricted item is found during a search][]"
                                class="form-control" value="{{ $actionsOnProhibitedItems[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q10. actions to take if a prohibited or restricted item is found during a search][]"
                                class="form-control" value="{{ $actionsOnProhibitedItems[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q10. actions to take if a prohibited or restricted item is found during a search][]"
                                class="form-control" value="{{ $actionsOnProhibitedItems[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q10. actions to take if a prohibited or restricted item is found during a search][]"
                                class="form-control" value="{{ $actionsOnProhibitedItems[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q10. actions to take if a prohibited or restricted item is found during a search][]"
                                class="form-control" value="{{ $actionsOnProhibitedItems[4] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text"
                                name="data[Q10. actions to take if a prohibited or restricted item is found during a search][]"
                                class="form-control" value="{{ $actionsOnProhibitedItems[5] }}">
                        </div>
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
                                class="form-control">{{ $dutyOfCare ?? '' }}</textarea>
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
                                cols="30" rows="10" class="form-control">{{ $dutyOfCareImportance ?? '' }}</textarea>
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
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q12a. factors that could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactors[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q12a. factors that could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactors[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q12a. factors that could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactors[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q12a. factors that could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactors[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q12a. factors that could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactors[4] }}">
                        </div>
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
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactorsExplanation[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactorsExplanation[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactorsExplanation[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactorsExplanation[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q12b. Explain why the FIVE factors you identified in question 12a could make someone vulnerable or more at risk than others][]"
                                class="form-control" value="{{ $vulnerableFactorsExplanation[4] }}">
                        </div>
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
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q13. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                class="form-control" value="{{ $actionsForVulnerableIndividuals[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q13. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                class="form-control" value="{{ $actionsForVulnerableIndividuals[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q13. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                class="form-control" value="{{ $actionsForVulnerableIndividuals[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q13. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                class="form-control" value="{{ $actionsForVulnerableIndividuals[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q13. Identify FIVE actions that you should take towards vulnerable individuals][]"
                                class="form-control" value="{{ $actionsForVulnerableIndividuals[4] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC2.4 Identify behaviours that may be exhibited by sexual predators') }}</label>
                            <p>As a door supervisor, you must be able to identify behaviours that may be exhibited
                                by sexual predators.</p>
                            <label>{{ __('Question 14:') }}</label> Identify <label>{{ __('FOUR') }}</label>
                            behaviours that may be exhibited by sexual predators.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q14. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                class="form-control" value="{{ $behaviorsOfSexualPredators[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q14. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                class="form-control" value="{{ $behaviorsOfSexualPredators[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q14. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                class="form-control" value="{{ $behaviorsOfSexualPredators[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q14. Identify FOUR behaviours that may be exhibited by sexual predators][]"
                                class="form-control" value="{{ $behaviorsOfSexualPredators[3] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC2.5 Identify indicators of abuse') }}</label>
                            <p>There are several identifying indicators of abuse that a door supervisor can look out
                                for.</p>
                            <label>{{ __('Question 15:') }}</label> Identify <label>{{ __('FOUR') }}</label>
                            indicators of abuse.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Q15. Identify FOUR indicators of abuse][]"
                                class="form-control" value="{{ $fourIndicatorsOfAbuse[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Q15. Identify FOUR indicators of abuse][]"
                                class="form-control" value="{{ $fourIndicatorsOfAbuse[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Q15. Identify FOUR indicators of abuse][]"
                                class="form-control" value="{{ $fourIndicatorsOfAbuse[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Q15. Identify FOUR indicators of abuse][]"
                                class="form-control" value="{{ $fourIndicatorsOfAbuse[3] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label>{{ __('AC2.6 State how to deal with allegations of sexual assault') }}</label>
                            <p>Door supervisors regularly wear uniforms. Some people find this reassuring and may
                                choose to tell the operative
                                about the abuse they have been subjected to. This is called disclosure. </p>
                            <label>{{ __('Question 16:') }}</label>
                            State how to deal with allegations of sexual assault.
                            <textarea name="data[Q16. State how to deal with allegations of sexual assault]" cols="30" rows="10"
                                class="form-control">{{ $dealingWithSexualAssault ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <h4 class="bgStripGrey">LO3 Understand terror threats and the role of the security operative in
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
                                <input type="text" name="data[Q18. Identify the FIVE different threat levels][]"
                                    class="form-control" value="{{ $fiveThreatLevels[0] }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" name="data[Q18. Identify the FIVE different threat levels][]"
                                    class="form-control" value="{{ $fiveThreatLevels[1] }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" name="data[Q18. Identify the FIVE different threat levels][]"
                                    class="form-control" value="{{ $fiveThreatLevels[2] }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" name="data[Q18. Identify the FIVE different threat levels][]"
                                    class="form-control" value="{{ $fiveThreatLevels[3] }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" name="data[Q18. Identify the FIVE different threat levels][]"
                                    class="form-control" value="{{ $fiveThreatLevels[4] }}">
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
                                class="form-control">{{ $commonTerrorAttackMethods ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label>{{ __('AC3.3 Recognise the actions to take in the event of a terror threat') }}</label>
                            <p>The role of a door supervisor during a terror attack will be outlined in the venue or
                                site’s policies and procedures.</p>
                            <label>{{ __('Question 20:') }}</label>
                            Explain the actions you should take in the event of a terror threat at the venue or site.
                            <textarea name="data[Q20. Explain the actions you should take in the event of a terror threat at the venue or site]"
                                cols="30" rows="10" class="form-control">{{ $actionsInTerrorThreat ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label>{{ __('AC3.4 Identify the procedures for dealing with suspicious items') }}</label>
                            <p>As a door supervisor, you need to be aware of suspicious packages and the procedures
                                to follow if one is identified.</p>
                            <label>{{ __('Question 21:') }}</label>
                            Identify the procedures for dealing with suspicious items.
                            <textarea name="data[Q21. Identify the procedures for dealing with suspicious items]" cols="30" rows="10"
                                class="form-control">{{ $proceduresForSuspiciousItems ?? '' }}</textarea>
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
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q22. Identify SIX behaviours that could indicate suspicious activity][]"
                                class="form-control" value="{{ $suspiciousBehaviorIndicators[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q22. Identify SIX behaviours that could indicate suspicious activity][]"
                                class="form-control" value="{{ $suspiciousBehaviorIndicators[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q22. Identify SIX behaviours that could indicate suspicious activity][]"
                                class="form-control" value="{{ $suspiciousBehaviorIndicators[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q22. Identify SIX behaviours that could indicate suspicious activity][]"
                                class="form-control" value="{{ $suspiciousBehaviorIndicators[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q22. Identify SIX behaviours that could indicate suspicious activity][]"
                                class="form-control" value="{{ $suspiciousBehaviorIndicators[4] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text"
                                name="data[Q22. Identify SIX behaviours that could indicate suspicious activity][]"
                                class="form-control" value="{{ $suspiciousBehaviorIndicators[5] }}">
                        </div>
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
                                class="form-control">{{ $responseToSuspiciousBehavior ?? '' }}</textarea>
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
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text" name="data[Q24. State FIVE methods of spiking][]" class="form-control"
                                value="{{ $fiveMethodsOfSpiking[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text" name="data[Q24. State FIVE methods of spiking][]" class="form-control"
                                value="{{ $fiveMethodsOfSpiking[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text" name="data[Q24. State FIVE methods of spiking][]" class="form-control"
                                value="{{ $fiveMethodsOfSpiking[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text" name="data[Q24. State FIVE methods of spiking][]" class="form-control"
                                value="{{ $fiveMethodsOfSpiking[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text" name="data[Q24. State FIVE methods of spiking][]" class="form-control"
                                value="{{ $fiveMethodsOfSpiking[4] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label>{{ __('AC4.2 State the law in relation to spiking') }}</label>
                            <p>It is important that you understand the laws in relation to spiking when working as a
                                door supervisor. </p>
                            <label>{{ __('Question 25:') }}</label>
                            State the law in relation to spiking.
                            <textarea name="data[Q25. State the law in relation to spiking]" cols="30" rows="10" class="form-control">{{ $lawOnSpiking ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>AC4.3 State indicators that drinks have been spiked</label>
                            <p>There are visual indicators that may suggest a person’s drink has been spiked.</p>
                            <label>Question 26:</label> State <label>FIVE</label>
                            indicators that suggests a drink has been spiked.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q26. State FIVE indicators that suggests a drink has been spiked][]"
                                class="form-control" value="{{ $drinkSpikingIndicators[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q26. State FIVE indicators that suggests a drink has been spiked][]"
                                class="form-control" value="{{ $drinkSpikingIndicators[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q26. State FIVE indicators that suggests a drink has been spiked][]"
                                class="form-control" value="{{ $drinkSpikingIndicators[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q26. State FIVE indicators that suggests a drink has been spiked][]"
                                class="form-control" value="{{ $drinkSpikingIndicators[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q26. State FIVE indicators that suggests a drink has been spiked][]"
                                class="form-control" value="{{ $drinkSpikingIndicators[4] }}">
                        </div>
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
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks][]"
                                class="form-control" value="{{ $behavioralSignsOfSpiking[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks][]"
                                class="form-control" value="{{ $behavioralSignsOfSpiking[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks][]"
                                class="form-control" value="{{ $behavioralSignsOfSpiking[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks][]"
                                class="form-control" value="{{ $behavioralSignsOfSpiking[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q27. Identify FIVE behavioural signs of an individual attempting to spike drinks][]"
                                class="form-control" value="{{ $behavioralSignsOfSpiking[4] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>AC4.5 Identify situations when an individual might be at high risk of
                                spiking</label>
                            <p>There are several situations where an individual might be at high risk of spiking.
                            </p>
                            <label>Question 28:</label> Identify <label>THREE</label>
                            situations when an individual might be at high risk of spiking.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q28. Identify THREE situations when an individual might be at high risk of spiking][]"
                                class="form-control" value="{{ $highRiskSpikingSituations[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q28. Identify THREE situations when an individual might be at high risk of spiking][]"
                                class="form-control" value="{{ $highRiskSpikingSituations[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q28. Identify THREE situations when an individual might be at high risk of spiking][]"
                                class="form-control" value="{{ $highRiskSpikingSituations[2] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>AC4.6 State actions door supervisors and/or venues may take to prevent incidents
                                of spiking</label>
                            <p>There are several actions you and the venue can take to prevent incidents of spiking.
                            </p>
                            <label>Question 29:</label> State <label>FIVE</label>
                            actions door supervisors and/or venues may take to prevent incidents of spiking.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking][]"
                                class="form-control" value="{{ $preventionOfSpikingIncidents[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking][]"
                                class="form-control" value="{{ $preventionOfSpikingIncidents[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking][]"
                                class="form-control" value="{{ $preventionOfSpikingIncidents[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking][]"
                                class="form-control" value="{{ $preventionOfSpikingIncidents[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q29. State FIVE actions door supervisors and/or venues may take to prevent incidents of spiking][]"
                                class="form-control" value="{{ $preventionOfSpikingIncidents[4] }}">
                        </div>
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
                                rows="10" class="form-control">{{ $individualSpikingIndicators ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <div>
                            <label>{{ __('AC4.8 State how to manage a spiking incident') }}</label>
                            <p>There are several ways that you can manage a spiking incident.</p>
                            <label>{{ __('Question 31:') }}</label>
                            State how to manage a spiking incident.
                            <textarea name="data[Q31. State how to manage a spiking incident]" cols="30" rows="10"
                                class="form-control">{{ $managingSpikingIncident ?? '' }}</textarea>
                        </div>
                    </div>
                    <label>Learner' Name</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" name="data['first_name']" class="form-control" value="{{$first_name ?? ''}}" readonly>
                                <small>First Name</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group requiredRole">
                                <input type="text" name="data['last_name']" class="form-control" value="{{$last_name ?? ''}}" readonly>
                                <small>Last Name</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Learner Signature<span>*</span></label>
                                <div class="border rounded">
                                    <img src="{{$signature ?? ''}}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Date, Time</label>
                                <input type="text" name="data['assessment_date']" class="form-control" value="{{$assessment_date ?? ''}}" readonly>
                                {{-- <p>{{$assessment_date ?? ''}}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('backend.task.response', ['submission' => $submission_id]) }}" id="submitForm" enctype="multipart/form-data">
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
        $(document).ready(function() {
            // $('.toggle-btn').click(function() {
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
