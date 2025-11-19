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
                        <h1>DS Refresher WorkBook Unit 2</h1>
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

                    $last_name = $learner_response['data']['last_name'];
                    $first_name = $learner_response['data']['first_name'];
                    $learner_name = $learner_response['data']['learner_name'];
                    $assessment_date = $learner_response['data']['assessment_date'];
                    $training_provider = $learner_response['data']['training_provider'];
                    $course_end_date = $learner_response['data']['info_course_end_date'];
                    $course_start_date = $learner_response['data']['info_course_start_date'];

                    $legalImplications =
                        $learner_response['data']['Q1. State the legal implications of using physical intervention'];
                    $professionalImplications =
                        $learner_response['data'][
                            'Q2. Identify FIVE professional implications of using physical intervention'
                        ];
                    $positiveAlternatives =
                        $learner_response['data']['Q3. Identify positive alternatives to physical intervention'];
                    $defensiveSkillsVsIntervention =
                        $learner_response['data'][
                            'Q4. Identify the TWO key differences between defensive physical skills and physical interventions'
                        ];
                    $riskFactors =
                        $learner_response['data'][
                            'Q5. Identify the risk factors involved with the use of physical intervention'
                        ];
                    $signsAndSymptomsABD =
                        $learner_response['data'][
                            'Q6. Describe the signs and symptoms associated with acute behavioural disturbance (ABD) and psychosis'
                        ];
                    $prolongedInterventionRisks =
                        $learner_response['data'][
                            'Q7. State the specific risks associated with prolonged physical interventions'
                        ];
                    $groundInterventionRisks =
                        $learner_response['data'][
                            'Q8. State the specific risks of dealing with physical intervention incidents on the ground'
                        ];
                    $riskReductionMethods =
                        $learner_response['data'][
                            'Q9. ways of reducing the risk of harm during physical interventions'
                        ];
                    $safetyManagement =
                        $learner_response['data'][
                            'Q10. State how to manage and monitor a persons safety during physical intervention'
                        ];
                    $interventionResponsibilities =
                        $learner_response['data'][
                            'Q11. Identify FIVE responsibilities of all involved during a physical intervention'
                        ];
                    $postInterventionResponsibilities =
                        $learner_response['data'][
                            'Q12. Identify SIX responsibilities immediately following a physical intervention'
                        ];
                    $skillsMaintenanceImportance =
                        $learner_response['data'][
                            'Q13. State why it is important to maintain physical intervention knowledge and skills'
                        ];
                    $signatureLearner =
                        $learner_response['signature'] ?? "";
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
                                <input type="text" name="data[training_provider]" value="{{ $training_provider ?? '' }}"
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
                    <div class="form-group requiredRole">
                        <div>
                            <label>AC1.1 State the legal implications of using physical intervention</label>
                            <p>Using physical intervention carries important legal considerations that must be
                                understood to ensure actions remain within the bounds of the law. Failure to comply
                                with legal standards can result in serious consequences for all
                                parties involved.</p>
                            <label>Question 1:</label>
                            <p>State the legal implications of using physical intervention.</p>
                            <div>
                                <textarea class="form-control" name="data[Q1. State the legal implications of using physical intervention]"
                                    cols="30" rows="10">{{ $legalImplications ?? '' }}</textarea>
                            </div>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC1.2 State the professional implications of using physical intervention') }}</label>
                            <p>Using physical intervention in a professional setting can have significant
                                consequences for both individuals and
                                organisations. It is important to understand how such actions can affect one’s
                                career, reputation and compliance
                                with industry standards.</p>
                            <label>{{ __('Question 2:') }}</label> Identify <label>{{ __('FIVE') }}</label>
                            professional implications of using physical intervention.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q2. Identify FIVE professional implications of using physical intervention][]"
                                class="form-control" value="{{ $professionalImplications[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q2. Identify FIVE professional implications of using physical intervention][]"
                                class="form-control" value="{{ $professionalImplications[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q2. Identify FIVE professional implications of using physical intervention][]"
                                class="form-control" value="{{ $professionalImplications[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q2. Identify FIVE professional implications of using physical intervention][]"
                                class="form-control" value="{{ $professionalImplications[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q2. Identify FIVE professional implications of using physical intervention][]"
                                class="form-control" value="{{ $professionalImplications[4] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label>AC1.3 Identify positive alternatives to physical intervention</label>
                            <p>In situations where conflict or aggression arises, it is essential to consider
                                alternatives to physical intervention that
                                can help de-escalate tensions and resolve issues peacefully.</p>
                            <label>Question 3:</label>
                            <p>Identify positive alternatives to physical intervention.</p>
                            <div>
                                <textarea class="form-control" name="data[Q3. Identify positive alternatives to physical intervention]" cols="30"
                                    rows="10">{{ $positiveAlternatives ?? '' }}</textarea>
                            </div>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label>AC1.4 Identify the differences between defensive physical skills and physical
                                interventions</label>
                            <p>There is a distinction between defensive physical skills and physical interventions,
                                as a door supervisor it is important that you are able to identify the differences.
                            </p>
                            <label>Question 4:</label>
                            <p>Identify the <strong>TWO</strong> key differences between defensive physical skills
                                and physical interventions.</p>
                            <div class="mb-3">
                                <textarea class="form-control"
                                    name="data[Q4. Identify the TWO key differences between defensive physical skills and physical interventions][]"
                                    cols="30" rows="10">{{ $defensiveSkillsVsIntervention[0] }}</textarea>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control"
                                    name="data[Q4. Identify the TWO key differences between defensive physical skills and physical interventions][]"
                                    cols="30" rows="10">{{ $defensiveSkillsVsIntervention[1] }}</textarea>
                            </div>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <h4 class="bgStripGrey">LO2 Know the risks associated with using physical intervention</h4>
                    <div class="form-group requiredRole">
                        <div>
                            <label>AC2.1 Identify the risk factors involved with the use of physical
                                intervention</label>
                            <p>When using physical intervention, there are various risk factors that can impact the
                                safety and well-being of both
                                the individual being restrained and the person applying the intervention.
                                Understanding these risks is crucial for
                                minimising harm.</p>
                            <label>Question 5:</label>
                            <p>Identify the risk factors involved with the use of physical intervention. </p>
                            <div class="mb-3">
                                <textarea class="form-control"
                                    name="data[Q5. Identify the risk factors involved with the use of physical intervention]" cols="30"
                                    rows="10">{{ $riskFactors }}</textarea>
                            </div>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label><strong>AC2.2 Recognise the signs and symptoms associated with acute behavioural
                                    disturbance (ABD)
                                    and psychosis</strong></label>
                            <p>When working as a door supervisor, it is crucial to understand and identify certain
                                medical and psychological
                                conditions that may affect individuals’ behaviour. Being able to recognise these
                                conditions can help ensure the
                                safety of everyone involved.</p>
                            <label>Question 6:</label>
                            <p>Describe the signs and symptoms associated with <strong>acute behavioural disturbance
                                    (ABD)</strong> and psychosis. </p>
                            <div class="mb-3">
                                <textarea class="form-control"
                                    name="data[Q6. Describe the signs and symptoms associated with acute behavioural disturbance (ABD) and psychosis]"
                                    cols="30" rows="10">{{ $signsAndSymptomsABD }}</textarea>
                            </div>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label><strong>AC2.4 State the specific risks associated with prolonged physical
                                    interventions</strong></label>
                            <p>Prolonged physical interventions carry significant risks for both the individual and
                                the person applying the
                                intervention.</p>
                            <label>Question 7:</label>
                            <p>State the specific risks associated with prolonged physical interventions.</p>
                            <div class="mb-3">
                                <textarea class="form-control"
                                    name="data[Q7. State the specific risks associated with prolonged physical interventions]" cols="30"
                                    rows="10">{{ $prolongedInterventionRisks }}</textarea>
                            </div>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <h4 class="bgStripGrey">LO3 Know how to reduce the risks associated with physical intervention
                    </h4>
                    <div class="form-group requiredRole">
                        <div>
                            <label><strong>AC3.1 State the specific risks of dealing with physical intervention
                                    incidents on the ground</strong></label>
                            <p>When physical interventions occur on the ground, they can present additional hazards
                                that increase the risk of
                                harm to both the individual and the door supervisor involved. Understanding these
                                risks is essential for ensuring
                                safety during such situations.</p>
                            <label>Question 8:</label>
                            <p>State the specific risks of dealing with physical intervention incidents on the
                                ground.</p>
                            <div class="mb-3">
                                <textarea class="form-control"
                                    name="data[Q8. State the specific risks of dealing with physical intervention incidents on the ground]"
                                    cols="30" rows="10">{{ $groundInterventionRisks ?? '' }}</textarea>
                            </div>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC3.3 Identify ways of reducing the risk of harm during physical interventions') }}</label>
                            <p>Minimising harm during physical interventions is a critical part of maintaining
                                safety for everyone involved. By
                                using appropriate techniques and strategies, the risks associated with these
                                situations can be significantly reduced.</p>
                            <label>{{ __('Question 9:') }}</label> Identify <label>{{ __('THREE') }}</label>
                            ways of reducing the risk of harm during physical interventions.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q9. ways of reducing the risk of harm during physical interventions][]"
                                class="form-control" value="{{ $riskReductionMethods[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q9. ways of reducing the risk of harm during physical interventions][]"
                                class="form-control" value="{{ $riskReductionMethods[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q9. ways of reducing the risk of harm during physical interventions][]"
                                class="form-control" value="{{ $riskReductionMethods[2] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label><strong>AC3.4 State how to manage and monitor a person’s safety during physical
                                    intervention</strong></label>
                            <p>During a physical intervention, it is crucial to ensure the safety of the individual
                                involved. Proper management
                                and continuous monitoring are key to preventing harm and minimising risk throughout
                                the process.</p>
                            <label>Question 10:</label>
                            <p>State how to manage and monitor a person’s safety during physical intervention.</p>
                            <div class="mb-3">
                                <textarea class="form-control"
                                    name="data[Q10. State how to manage and monitor a persons safety during physical intervention]" cols="30"
                                    rows="10">{{ $safetyManagement ?? '' }}</textarea>
                            </div>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC3.6 State the responsibilities of all involved during a physical intervention') }}</label>
                            <p>In any physical intervention, it is important that everyone involved understands
                                their specific roles and
                                responsibilities to ensure the safety and well-being of all parties. Clear
                                communication and coordination are
                                essential for a successful outcome.</p>
                            <label>{{ __('Question 11:') }}</label> Identify <label>{{ __('FIVE') }}</label>
                            responsibilities of all involved during a physical intervention.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q11. Identify FIVE responsibilities of all involved during a physical intervention][]"
                                class="form-control" value="{{ $interventionResponsibilities[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q11. Identify FIVE responsibilities of all involved during a physical intervention][]"
                                class="form-control" value="{{ $interventionResponsibilities[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q11. Identify FIVE responsibilities of all involved during a physical intervention][]"
                                class="form-control" value="{{ $interventionResponsibilities[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q11. Identify FIVE responsibilities of all involved during a physical intervention][]"
                                class="form-control" value="{{ $interventionResponsibilities[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q11. Identify FIVE responsibilities of all involved during a physical intervention][]"
                                class="form-control" value="{{ $interventionResponsibilities[4] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group validList">
                        <div>
                            <label>{{ __('AC 3.7 State the responsibilities immediately following a physical intervention') }}</label>
                            <p>After a physical intervention, it is essential to follow specific procedures to
                                ensure the safety and well-being of
                                everyone involved, as well as to meet legal and professional requirements.</p>
                            <label>{{ __('Question 12:') }}</label> Identify <label>{{ __('SIX') }}</label>
                            responsibilities immediately following a physical intervention.
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">1.</label>
                            <input type="text"
                                name="data[Q12. Identify SIX responsibilities immediately following a physical intervention][]"
                                class="form-control" value="{{ $postInterventionResponsibilities[0] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">2.</label>
                            <input type="text"
                                name="data[Q12. Identify SIX responsibilities immediately following a physical intervention][]"
                                class="form-control" value="{{ $postInterventionResponsibilities[1] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">3.</label>
                            <input type="text"
                                name="data[Q12. Identify SIX responsibilities immediately following a physical intervention][]"
                                class="form-control" value="{{ $postInterventionResponsibilities[2] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">4.</label>
                            <input type="text"
                                name="data[Q12. Identify SIX responsibilities immediately following a physical intervention][]"
                                class="form-control" value="{{ $postInterventionResponsibilities[3] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">5.</label>
                            <input type="text"
                                name="data[Q12. Identify SIX responsibilities immediately following a physical intervention][]"
                                class="form-control" value="{{ $postInterventionResponsibilities[4] }}">
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <label class="mr-3">6.</label>
                            <input type="text"
                                name="data[Q12. Identify SIX responsibilities immediately following a physical intervention][]"
                                class="form-control" value="{{ $postInterventionResponsibilities[5] }}">
                        </div>
                    </div>
                    <div class="devider"></div>
                </div>
                <div class="col-12">
                    <div class="form-group requiredRole">
                        <div>
                            <label><strong>AC 3.8 State why it is important to maintain physical intervention
                                    knowledge and skills</strong></label>
                            <p>Keeping physical intervention knowledge and skills up to date is essential for
                                ensuring safe and effective actions
                                while meeting legal and professional standards.</p>
                            <label>Question 13:</label>
                            <p>State why it is important to maintain physical intervention knowledge and skills.</p>
                            <div class="mb-3">
                                <textarea class="form-control"
                                    name="data[Q13. State why it is important to maintain physical intervention knowledge and skills]" cols="30"
                                    rows="10">{{ $skillsMaintenanceImportance ?? '' }}</textarea>
                            </div>
                            <div class="invalid-feedback">This field is required.</div>
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
                                <div>
                                    <img src="{{$signatureLearner}}" class="img-fluid" alt="">
                                </div>
                                {{-- <div id="signature-pad" class="signature-pad">
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
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Date, Time</label>
                                <input type="text" name="data[assessment_date]" class="form-control"
                                    value="2024-08-23 17:03" readonly="" id="customDate">
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
                                    @for ($i = 1; $i <= 13; $i++)
                                        @php
                                            // Define an array for the questions that have sub-questions
                                            $subQuestions = [];
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
                                                        // 2 => ['a', 'b'],
                                                        // 11 => ['a', 'b'],
                                                        // 12 => ['a', 'b'],
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
