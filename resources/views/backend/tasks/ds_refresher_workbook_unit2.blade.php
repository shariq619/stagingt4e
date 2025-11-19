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


                <form action="{{ route('backend.task.submission') }}" method="POST" id="submitForm"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="task_name" value="{{ $task->name }}"/>
                    <input type="hidden" name="task_id" value="{{ $task->id }}"/>
                    <input type="hidden" name="course_id" value="{{ $course_id }}"/>
                    <input type="hidden" name="cohort_id" value="{{ $cohort_id }}"/>
                    <input type="hidden" name="trainer_id" value="{{ $trainer_id }}"/>
                    <div class="studyAssessment">
                        <h3 class="floatingpdftitle">DS Refresher WorkBook Unit 2</h3>
                        <div class="floatingpdf d-inline-flex align-items-center justify-content-end overflow-auto position-sticky bg-white float-right">
                            <div href="{{ asset('resources/DS REFRESHER_Coursebook.pdf') }}" class="popup-pdf"><i
                                        class="fas fa-file-pdf"></i></div>
                        </div>


                        <div class="devider"></div>
                        <p>The Principles of Working as a
                            Door Supervisor in the Private
                            Security Industry (Refresher)</p>
                        <p><strong>Unit 2: Application of Physical Intervention Skills
                                in the Private Security Industry (Refresher)</strong></p>
                        <div class="devider"></div>

                        <h4 class="bgStrip">Learner Information</h4>
                        <div class="learnerDeclaration">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Name') }}<span>*</span></label>
                                        <input type="text" id="first_name" name="data[learner_name]"
                                               class="form-control"
                                               value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>{{ __('Training Provider:') }}</label>
                                            <input type="text" id="training_provider" value="Training4Employment"
                                                   name="data[training_provider]"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Course Start Date') }}</label>
                                        <input type="date" id="course_start_date" value="{{ $start_date }}"
                                               name="data[info_course_start_date]"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Course End Date') }}</label>
                                        <input type="date" id="course_end_date" value="{{ $end_date }}"
                                               name="data[info_course_end_date]"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            if(isset($learner_response["Q1. State the legal implications of using physical intervention"])){

                                    $answers1 = $learner_response["Q1. State the legal implications of using physical intervention"] ?? "";
                                    $answers2 = $learner_response["Q2. Identify FIVE professional implications of using physical intervention"] ?? [];
                                    if (!is_array($answers2)) $answers2 = [];
                                    $answers3 = $learner_response["Q3. Identify positive alternatives to physical intervention"] ?? "";
                                    $answers4 = $learner_response["Q4. Identify the TWO key differences between defensive physical skills and physical interventions"] ?? [];
                                    if (!is_array($answers4)) $answers4 = [];
                                    $answers5 = $learner_response["Q5. Identify the risk factors involved with the use of physical intervention"] ?? "";
                                    $answers6 = $learner_response["Q6. Describe the signs and symptoms associated with acute behavioural disturbance (ABD) and psychosis"] ?? "";
                                    $answers7 = $learner_response["Q7. State the specific risks associated with prolonged physical interventions"] ?? "";
                                    $answers8 = $learner_response["Q8. State the specific risks of dealing with physical intervention incidents on the ground"] ?? "";
                                    $answers9 = $learner_response["Q9. ways of reducing the risk of harm during physical interventions"] ?? [];
                                    if (!is_array($answers9)) $answers9 = [];
                                    $answers10 = $learner_response["Q10. State how to manage and monitor a persons safety during physical intervention"] ?? "";
                                    $answers11 = $learner_response["Q11. Identify FIVE responsibilities of all involved during a physical intervention"] ?? [];
                                    if (!is_array($answers11)) $answers11 = [];
                                    $answers12 = $learner_response["Q12. Identify SIX responsibilities immediately following a physical intervention"] ?? [];
                                    if (!is_array($answers12)) $answers12 = [];
                                    $answers13 = $learner_response["Q13. State why it is important to maintain physical intervention knowledge and skills"] ?? "";

                                } else {

                                    $answers1 = $learner_response['data']["Q1. State the legal implications of using physical intervention"] ?? "";




                                    $answers2 = $learner_response['data']["Q2. Identify FIVE professional implications of using physical intervention"] ?? [];
                                    if (!is_array($answers2)) $answers2 = [];
                                    $answers3 = $learner_response['data']["Q3. Identify positive alternatives to physical intervention"] ?? "";
                                    $answers4 = $learner_response['data']["Q4. Identify the TWO key differences between defensive physical skills and physical interventions"] ?? [];
                                    if (!is_array($answers4)) $answers4 = [];
                                    $answers5 = $learner_response['data']["Q5. Identify the risk factors involved with the use of physical intervention"] ?? "";
                                    $answers6 = $learner_response['data']["Q6. Describe the signs and symptoms associated with acute behavioural disturbance (ABD) and psychosis"] ?? "";
                                    $answers7 = $learner_response['data']["Q7. State the specific risks associated with prolonged physical interventions"] ?? "";
                                    $answers8 = $learner_response['data']["Q8. State the specific risks of dealing with physical intervention incidents on the ground"] ?? "";
                                    $answers9 = $learner_response['data']["Q9. ways of reducing the risk of harm during physical interventions"] ?? [];
                                    if (!is_array($answers9)) $answers9 = [];
                                    $answers10 = $learner_response['data']["Q10. State how to manage and monitor a persons safety during physical intervention"] ?? "";
                                    $answers11 = $learner_response['data']["Q11. Identify FIVE responsibilities of all involved during a physical intervention"] ?? [];
                                    if (!is_array($answers11)) $answers11 = [];
                                    $answers12 = $learner_response['data']["Q12. Identify SIX responsibilities immediately following a physical intervention"] ?? [];
                                    if (!is_array($answers12)) $answers12 = [];
                                    $answers13 = $learner_response['data']["Q13. State why it is important to maintain physical intervention knowledge and skills"] ?? "";
                                }
                        @endphp

                        <div class="devider"></div>
                        <h4 class="bgStrip">Knowledge questions</h4>
                        <h4 class="bgStripGrey">LO1 Know the implications of physical interventions and their use</h4>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>AC1.1 State the legal implications of using physical intervention</label>
                                    <p>Using physical intervention carries important legal considerations that must be
                                        understood to ensure actions remain within the bounds of the law. Failure to
                                        comply
                                        with legal standards can result in serious consequences for all
                                        parties involved.</p>
                                    <label>Question 1:</label>
                                    <p>State the legal implications of using physical intervention.</p>
                                    <div>
                                        <textarea class="form-control"
                                                  name="data[Q1. State the legal implications of using physical intervention]"
                                                  cols="30" rows="10">{{ $answers1 ?? "" }}</textarea>
                                    </div>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>AC1.2 State the professional implications of using physical
                                        intervention</label>
                                    <p>Using physical intervention in a professional setting can have significant
                                        consequences for both individuals and organisations. It is important to
                                        understand how such actions can affect one’s
                                        career, reputation and compliance with industry standards.</p>
                                    <label>Question 2:</label> Identify <label>FIVE</label>
                                    professional implications of using physical intervention.
                                </div>
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i+1 }}.</label>
                                        <input type="text"
                                               name="data[Q2. Identify FIVE professional implications of using physical intervention][]"
                                               class="form-control"
                                               value="{{ $answers2[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>AC1.3 Identify positive alternatives to physical intervention</label>
                                    <p>In situations where conflict or aggression arises, it is essential to consider
                                        alternatives to physical intervention that can help de-escalate tensions and
                                        resolve issues peacefully.</p>
                                    <label>Question 3:</label>
                                    <p>Identify positive alternatives to physical intervention.</p>
                                    <div>
                                        <textarea class="form-control"
                                                  name="data[Q3. Identify positive alternatives to physical intervention]"
                                                  cols="30"
                                                  rows="10">{{ $answers3 ?? "" }}</textarea>
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
                                    <p>There is a distinction between defensive physical skills and physical
                                        interventions,
                                        as a door supervisor it is important that you are able to identify the
                                        differences.
                                    </p>
                                    <label>Question 4:</label>
                                    <p>Identify the <strong>TWO</strong> key differences between defensive physical
                                        skills
                                        and physical interventions.</p>
                                    @for ($i = 0; $i < 2; $i++)
                                        <div class="mb-3">
                                            <textarea class="form-control"
                                                      name="data[Q4. Identify the TWO key differences between defensive physical skills and physical interventions][]"
                                                      cols="30" rows="10">{{ $answers4[$i] ?? '' }}</textarea>
                                        </div>
                                    @endfor
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label>Question 5:</label>
                                    <p>Identify the risk factors involved with the use of physical intervention. </p>
                                    <div class="mb-3">
                                        <textarea class="form-control"
                                                  name="data[Q5. Identify the risk factors involved with the use of physical intervention]"
                                                  cols="30"
                                                  rows="10">{{ $answers5 ?? '' }}</textarea>
                                    </div>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label><strong>AC2.2 Recognise the signs and symptoms associated with acute
                                            behavioural disturbance (ABD)
                                            and psychosis</strong></label>
                                    <p>When working as a door supervisor, it is crucial to understand and identify
                                        certain
                                        medical and psychological
                                        conditions that may affect individuals’ behaviour. Being able to recognise these
                                        conditions can help ensure the
                                        safety of everyone involved.</p>
                                    <label>Question 6:</label>
                                    <p>Describe the signs and symptoms associated with <strong>acute behavioural
                                            disturbance
                                            (ABD)</strong> and psychosis. </p>
                                    <div class="mb-3">
                                        <textarea class="form-control"
                                                  name="data[Q6. Describe the signs and symptoms associated with acute behavioural disturbance (ABD) and psychosis]"
                                                  cols="30" rows="10">{{ $answers6 ?? '' }}</textarea>
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
                                    <p>Prolonged physical interventions carry significant risks for both the individual
                                        and
                                        the person applying the
                                        intervention.</p>
                                    <label>Question 7:</label>
                                    <p>State the specific risks associated with prolonged physical interventions.</p>
                                    <div class="mb-3">
                                        <textarea class="form-control"
                                                  name="data[Q7. State the specific risks associated with prolonged physical interventions]"
                                                  cols="30"
                                                  rows="10">{{ $answers7 ?? '' }}</textarea>
                                    </div>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <h4 class="bgStripGrey">LO3 Know how to reduce the risks associated with physical
                                intervention
                            </h4>
                            <div class="form-group requiredRole">
                                <div>
                                    <label><strong>AC3.1 State the specific risks of dealing with physical intervention
                                            incidents on the ground</strong></label>
                                    <p>When physical interventions occur on the ground, they can present additional
                                        hazards
                                        that increase the risk of
                                        harm to both the individual and the door supervisor involved. Understanding
                                        these
                                        risks is essential for ensuring
                                        safety during such situations.</p>
                                    <label>Question 8:</label>
                                    <p>State the specific risks of dealing with physical intervention incidents on the
                                        ground.</p>
                                    <div class="mb-3">
                                        <textarea class="form-control"
                                                  name="data[Q8. State the specific risks of dealing with physical intervention incidents on the ground]"
                                                  cols="30" rows="10">{{ $answers8 ?? '' }}</textarea>
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
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i+1 }}.</label>
                                        <input type="text"
                                               name="data[Q9. ways of reducing the risk of harm during physical interventions][]"
                                               class="form-control"
                                               value="{{ $answers9[$i] ?? '' }}">
                                    </div>
                                @endfor
                            </div>
                            <div class="devider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <div>
                                    <label><strong>AC3.4 State how to manage and monitor a person’s safety during
                                            physical
                                            intervention</strong></label>
                                    <p>During a physical intervention, it is crucial to ensure the safety of the
                                        individual
                                        involved. Proper management
                                        and continuous monitoring are key to preventing harm and minimising risk
                                        throughout
                                        the process.</p>
                                    <label>Question 10:</label>
                                    <p>State how to manage and monitor a person’s safety during physical
                                        intervention.</p>
                                    <div class="mb-3">
                                        <textarea class="form-control"
                                                  name="data[Q10. State how to manage and monitor a persons safety during physical intervention]"
                                                  cols="30"
                                                  rows="10">{{ $answers10 ?? '' }}</textarea>
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
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i+1 }}.</label>
                                        <input type="text"
                                               name="data[Q11. Identify FIVE responsibilities of all involved during a physical intervention][]"
                                               class="form-control"
                                               value="{{ $answers11[$i] ?? '' }}">
                                    </div>
                                @endfor
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
                                @for ($i = 0; $i < 6; $i++)
                                    <div class="d-flex mb-2 align-items-center">
                                        <label class="mr-3">{{ $i+1 }}.</label>
                                        <input type="text"
                                               name="data[Q12. Identify SIX responsibilities immediately following a physical intervention][]"
                                               class="form-control"
                                               value="{{ $answers12[$i] ?? '' }}">
                                    </div>
                                @endfor
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
                                    <p>State why it is important to maintain physical intervention knowledge and
                                        skills.</p>
                                    <div class="mb-3">
                                        <textarea class="form-control"
                                                  name="data[Q13. State why it is important to maintain physical intervention knowledge and skills]"
                                                  cols="30"
                                                  rows="10">{{ $answers13 ?? '' }}</textarea>
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

            label > span {
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
        $(document).ready(function () {
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
                    console.log("Captured Signature:", signatureDataUrl);
                    document.getElementById('signature-input-paf').value = signatureDataUrl;
                }
            });

            $(document).ready(function () {
                $('#saveProgressBtn').click(function () {
                    var formData = $('#submitForm').serialize(); // Serialize form data
                    $.ajax({
                        url: '{{ route('backend.tasks.save-progress') }}', // Define the route for saving progress
                        method: 'POST',
                        data: formData,
                        success: function (response) {
                            alert('Progress saved successfully!');
                            setTimeout(function () {
                                window.location.href =
                                    '{{ route('backend.learner.dashboard') }}';
                            }, 1500);
                        },
                        error: function (response) {
                            alert('There was an error saving your progress.');
                        }
                    });
                });
            });

            $(document).on('click', '#previewButton', function (e) {
                e.preventDefault();

                function validateForm() {
                    let isValid = true;

                    $('.requiredRole input, .requiredRole textarea').each(function () {
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

                    $('.validList').each(function () {
                        let groupIsValid = true;

                        $(this).find('input').each(function () {
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
                    success: function (data) {
                        if (data.html) {
                            var iframe = document.getElementById('pdfPreview');
                            iframe.contentWindow.document.open();
                            iframe.contentWindow.document.write(data.html);
                            iframe.contentWindow.document.close();
                            $('#pdfPreview').show();
                        }
                        // $('#PreviewApp').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });

            });
        });
    </script>
    <script>
        $(document).ready(function () {

            // var getSelectedValue = document.querySelector( 'input.yes:checked');

            $(document).on('click', '#modalFormHandler', function () {
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
                    .then(function (response) {
                        $('#loadingSpinner').hide();
                        window.location = "{{ route('backend.learner.dashboard') }}"
                        button.prop('disabled', false);
                        form[0].reset();
                        $('#PreviewApp').modal('hide');
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
