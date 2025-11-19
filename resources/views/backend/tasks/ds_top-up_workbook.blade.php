@extends('layouts.main')

@section('title', 'User')
@section('main')
    <div class="formWrapper">
        <div class="row">
            <form action="{{ route('backend.task.submission') }}" method="POST" id="submitForm"
                  enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <input type="hidden" name="task_name" value="{{ $task->name }}" />
                    <input type="hidden" name="task_id" value="{{ $task->id }}" />
                    <input type="hidden" name="course_id" value="{{ $course_id }}" />
                    <input type="hidden" name="cohort_id" value="{{ $cohort_id }}" />
                    <input type="hidden" name="trainer_id" value="{{ $trainer_id }}" />
                    <div class="studyAssessment">
                        <h3 class="floatingpdftitle">Door Supervisor Top-Up Workbook</h3>
                        <div class="floatingpdf d-inline-flex align-items-center justify-content-end overflow-auto position-sticky bg-white float-right" >
                            <div href="{{ asset('resources/DStopupselfstudytexbook.pdf') }}" class="popup-pdf"><i
                                    class="fas fa-file-pdf"></i></div>
                        </div>

                        <div class="devider"></div>
                        <p>Principles of Using Equipment as a Door Supervisor in the Private Security
                            IndustryT/618/6844</p>
                        <div class="devider"></div>

                        <h4 class="bgStrip">Learner Information</h4>
                        <div class="learnerDeclaration">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('First Name') }}<span>*</span></label>
                                        <input type="text" id="first_name" name="data[info_first_name]"
                                               class="form-control"
                                               value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Last Name') }}<span>*</span></label>
                                        <input type="text" id="last_name" name="data[info_last_name]"
                                               class="form-control"
                                               value="{{ auth()->user()->last_name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>{{ __('Email Address') }}</label>
                                            <input type="email" id="assessment_date" name="data[info_email]"
                                                   class="form-control"
                                                   value="{{ auth()->user()->email }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Course Start Date') }}</label>
                                        <input type="date" id="course_start_date" name="data[info_course_start_date]"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>{{ __('Training Provider') }}</label>
                                            <input type="text" id="training_provider" name="data[info_training_provider]"
                                                   class="form-control"
                                                   value="Training4Employment" readonly>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Course End Date') }}</label>
                                        <input type="date" id="course_end_date" name="data[info_course_end_date]"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="devider"></div>
                        <h4 class="bgStrip">Introduction</h4>

                        <div class="alert alert-danger text-center text-dark" role="alert"
                             style="display: block;justify-content: center;color: #fad2e0;width: 50%;margin: auto;">
                            <i class="nav-icon fas fa-bell text-white"
                               style="font-size: 3rem;margin-right: 10px;float: left;"></i>
                            <div class="font-weight-bold">
                                <p style="margin: 0;text-align: left;color: #fff;">This workbook must be completed and
                                    submitted to Training4Employment</p>
                                <p style="margin: 0;text-align: left;color: #fff;">before any further face-to-face
                                    training.</p>
                            </div>
                        </div>
                        <br>
                        <p>This online form has been created based on the Door Supervisor Self-Study (Top-Up) Workbook
                            from Highfield Products.</p>
                        <p>This workbook has been developed to support you in achieving the requirements of the
                            self-study learning outcomes and assessment criteria from the Highfield Level 2 Award for
                            Door Supervisors in the Private Security Industry (Top Up) Unit 2: Principles of Using
                            Equipment as a Door supervisor in the Private Security Industry.</p>




                        <div class="devider"></div>
                        <h4 class="bgStrip">Knowledge Questions</h4>
                        <h4 class="bgStripGrey">LO1 Know how to use equipment relevant to a door supervisor.</h4>
                        <div class="col-12">
                            <div class="form-group validList">
                                <div>
                                    <label>{{ __('AC1.1 Recognise equipment used to manage venue capacity.') }}</label>
                                    <p>
                                        As a door supervisor, you will be required to use different types of equipment
                                        to help you to manage the venue capacity.
                                    </p>
                                    <label>{{ __('Question 1:') }}</label> Identify <label>{{ __('THREE') }}</label>
                                    different types of equipment that can be used to help you manage venue capacity.
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">1.</label>
                                    <input type="text" id="q1_ans_1"
                                           name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"
                                           class="form-control" value="{{ old('q2_ans_1') }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">2.</label>
                                    <input type="text" id="q1_ans_2"
                                           name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"
                                           class="form-control" value="{{ old('q1_ans_2') }}">
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <label class="mr-3">3.</label>
                                    <input type="text" id="q1_ans_3"
                                           name="data[Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity][]"
                                           class="form-control" value="{{ old('q1_ans_3') }}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="devider"></div>

                    <div class="col-12">
                        <div class="form-group validList">
                            <div>
                                <label>{{ __('AC1.2 Recognise the different types of personal protective equipment relevant to the role of a door supervisor.') }}</label>
                                <p>Personal protective equipment (PPE) is used to help protect you from harm when
                                    carrying out your job role.</p>
                                <label>{{ __('Question 2:') }}</label> Identify <label>{{ __('EIGHT') }}</label>
                                different types of personal protective equipment thay maybe used or worn when working as
                                a doorsupervior.
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">1.</label>
                                <input type="text" id="2_ans_1"
                                       name="data[Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.][]" class="form-control"
                                       value="{{ old('2_ans_1') }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">2.</label>
                                <input type="text" id="2_ans_2"
                                       name="data[Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.][]" class="form-control"
                                       value="{{ old('2_ans_2') }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">3.</label>
                                <input type="text" id="2_ans_3"
                                       name="data[Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.][]" class="form-control"
                                       value="{{ old('2_ans_3') }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">4.</label>
                                <input type="text" id="2_ans_4"
                                       name="data[Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.][]" class="form-control"
                                       value="{{ old('2_ans_4') }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">5.</label>
                                <input type="text" id="2_ans_5"
                                       name="data[Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.][]" class="form-control"
                                       value="{{ old('2_ans_5') }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">6.</label>
                                <input type="text" id="21_ans_6"
                                       name="data[Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.][]" class="form-control"
                                       value="{{ old('2_ans_6') }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">7.</label>
                                <input type="text" id="2_ans_7"
                                       name="data[Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.][]" class="form-control"
                                       value="{{ old('2_ans_7') }}">
                            </div>
                            <div class="d-flex mb-2 align-items-center">
                                <label class="mr-3">8.</label>
                                <input type="text" id="2_ans_8"
                                       name="data[Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.][]" class="form-control"
                                       value="{{ old('2_ans_8') }}">
                            </div>
                        </div>
                    </div>
                    <div class="devider"></div>

                    <div class="col-12">
                        <div class="form-group requiredRole">
                            <div>
                                <label>{{ __('AC1.3 State the purpose of using body-worn cameras (BWC)') }}</label>
                                <p>Body-worn cameras (BWC) have many benefits and as such are becoming more popular within the private security industry as well as within law enforcement.</p>
                                <label>{{ __('Question 3:') }}</label> State the purpose of body-worn cameras
                            </div>
                            <textarea name="data[Q3. State the purpose of body-worn cameras][]" cols="30" rows="10"
                                      class="form-control" ></textarea>
                        </div>
                    </div>
                    <div class="devider"></div>

                    <div class="col-12">
                        <div class="form-group requiredRole">
                            <div>
                                <label>{{ __('AC1.4 Identify how to communicate effectively using relevant equipment.') }}</label>
                                <p>As a door supervisor, you will have regular contact with several different types of people during your duties, including members of the public, other staff members and members of external agencies, therefore effective communication is always vital.</p>
                                <label>{{ __('Question 4:') }}</label> Identify how to communicate effectively with internal and external colleagues, on the premises and with the police and other outside agencies using the equipment listed.
                            </div>
                            <label>Radios and earpieces</label>
                            <textarea name="data[Q4. Identify how to communicate effectively with internal and external colleagues, on the premises and with the police and other outside agencies using the equipment listed.][]" cols="30" rows="5"
                                      class="form-control" ></textarea>
                            <label>Mobile phones</label>
                            <textarea name="data[Q4. Identify how to communicate effectively with internal and external colleagues, on the premises and with the police and other outside agencies using the equipment listed.][]" cols="30" rows="5"
                                      class="form-control" ></textarea>
                            <label>Internal telephone systems</label>
                            <textarea name="data[Q4. Identify how to communicate effectively with internal and external colleagues, on the premises and with the police and other outside agencies using the equipment listed.][]" cols="30" rows="5"
                                      class="form-control" ></textarea>
                        </div>
                    </div>
                    <div class="devider"></div>


                    <div class="col-12">
                        <div class="form-group requiredRole">
                            <div>
                                <label>{{ __('AC1.5 Demonstrate effective use of communication devices.') }}</label>
                                <p>You will have access to and use different types of communication devices as part of your role, and it is important that they are used effectively and for their intended purpose. Devices may include:</p>
                                <ul>
                                    <li>radios</li>
                                    <li>mobile phones</li>
                                    <li>internal phone systems</li>
                                    <li>internal address systems</li>
                                </ul>
                                <label>{{ __('Question 5:') }}</label> Explain how you ensure you demonstrate effective use of communication devices.
                            </div>
                            <textarea name="data[Q5. Explain how you ensure you demonstrate effective use of communication devices.]" cols="30" rows="10"
                                      class="form-control" ></textarea>
                        </div>
                    </div>
                    <div class="devider"></div>


                    <h4 class="bgStripGrey">LO2 Know what actions to take in relation to global (or critical) incidents.</h4>
                    <div class="col-12">
                        <div class="form-group requiredRole">
                            <div>
                                <label>{{ __('AC2.1 Know government guidance in relation to global (or critical) incidents.') }}</label>
                                <p>As a door supervisor, it is important to know what actions you should take and where you can find additional information and guidance when dealing with global or critical incidents.</p>

                                <label>{{ __('Question 6:') }}</label> Describe the government guidance in relation to global (or critical) incidents.
                            </div>
                            <textarea name="data[Q6. Describe the government guidance in relation to global (or critical) incidents.]" cols="30" rows="10"
                                      class="form-control" ></textarea>
                        </div>
                    </div>

                </div>
                <div class="devider"></div>

                <div class="learnerDeclaration">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <label>{{ __('First Name') }}<span>*</span></label>
                                <input type="text" id="first_name" name="data[detail_first_name]" class="form-control"
                                       value="{{ auth()->user()->name ?? "" }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <label>{{ __('Last Name') }}<span>*</span></label>
                                <input type="text" id="last_name" name="data[detail_last_name]" class="form-control"
                                       value="{{ auth()->user()->last_name ?? "" }}">
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
                                                    id="clear-signature">Clear
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="signature" id="signature-input-paf">

                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                @php
                                    $now = new DateTime();
                                @endphp
                                <label>{{ __('Date, Time Assessment Completed') }}</label>
                                <input type="text" id="assessment_date" name="data[assessment_date]"
                                       class="form-control"
                                       value="{{ $now->format('Y-m-d H:i') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" id="previewButton" data-toggle="modal" data-target="#PreviewApp">
                    <i class="fas fa-eye mr-2"></i>
                    {{ __('Save and Preview') }}
                </button>
        </div>
        </form>
    </div>
    </div>
    <div class="modal fade" id="PreviewApp" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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

            .bgStripGrey{
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
                    success: function (data) {
                        if (data.html) {
                            var iframe = document.getElementById('pdfPreview');
                            iframe.contentWindow.document.open();
                            iframe.contentWindow.document.write(data.html);
                            iframe.contentWindow.document.close();
                            $('#pdfPreview').show();
                        }
                        $('#PreviewApp').modal('show');
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
                    .then(function (response) {
                        console.log(response.message);
                        button.prop('disabled', false);
                        form[0].reset();
                        $('#PreviewApp').modal('hide');
                        //const pdfDownloadUrl = response.pdfPath;

                        // const link = document.createElement('a');
                        // link.href = pdfDownloadUrl;
                        // link.download = pdfDownloadUrl.split('/').pop();
                        // document.body.appendChild(link);
                        // link.click();
                        // document.body.removeChild(link);

                        {{--setTimeout(function () {--}}
                        {{--    window.location.href =--}}
                        {{--        '{{ route('backend.learner.dashboard') }}';--}}
                        {{--}, 3000);--}}
                    })
                    .catch(function (err) {
                        console.error(err);
                        button.prop('disabled', false);
                    });
            });
        });
    </script>
@endpush
