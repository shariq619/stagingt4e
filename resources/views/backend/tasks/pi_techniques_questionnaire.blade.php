@extends('layouts.main')

@section('title', 'User')
@section('main')
    <div class="formWrapper">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/headerlogopdf.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-md-6">
                <div class="companyInfo text-right">
                    <p class="m-0"><strong>Training for Employment Ltd</strong></p>
                    <span>89-91 Hatchett Street, Birmingham, B19 3NY</span><br>
                    <span>E: info@training4employment.co.uk</span><br>
                    <span>www.training4employment.co.uk</span><br>
                    <span>Tel: 0121 630 2115</span><br>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('backend.task.submission') }}" method="POST" id="submitForm"
                enctype="multipart/form-data" class="w-100">
                @csrf
                <input type="hidden" name="task_name" value="{{ $task->name }}" />
                <input type="hidden" name="task_id" value="{{ $task->id }}" />
                <input type="hidden" name="course_id" value="{{ $course_id }}" />
                <input type="hidden" name="cohort_id" value="{{ $cohort_id }}" />
                <input type="hidden" name="trainer_id" value="{{ $trainer_id }}" />


                <div class="studyAssessment">
                    <h4 class="bgStrip my-5">Techniques Questionnaire for Physical <br> Intervention Participants</h4>
                    <p>Dear <strong>{{ auth()->user()->name }},</strong></p>

                    <p>We ask you to confirm that during your Physical Intervention programme, you have <strong>NOT</strong>
                        been taught or shown any techniques that:</p>
                    <div class="quetionList">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center boxRow">
                                    <div class="number">1.</div>
                                    <div class="text">Involve direct contact with neck or spine</div>
                                </div>
                                <div class="d-flex align-items-center boxRow">
                                    <div class="number">2.</div>
                                    <div class="text">Involve striking or pushing</div>
                                </div>
                                <div class="d-flex align-items-center boxRow">
                                    <div class="number">3.</div>
                                    <div class="text">Are contra-indicative in terms of flexion or extension of joint, or
                                        apply pressure directly to it</div>
                                </div>
                                <div class="d-flex align-items-center boxRow">
                                    <div class="number">4.</div>
                                    <div class="text">Carry inherent likelihood of resulting in pain</div>
                                </div>
                                <div class="d-flex align-items-center boxRow">
                                    <div class="number">5.</div>
                                    <div class="text">Involve pressing on or compression of the stomach or chest</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="learnerDeclaration">
                    <label class="d-flex align-items-center mt-2">
                        <input type="checkbox" name="guideline1" class="form-check-input mr-4" checked>
                        <span style="color:#000;color:#000;font-weight:400;">I declare that I have never had any other
                            disorder not already mentioned that could effect my involvement on the training. I understand
                            that if any of the information is incorrect or if there are any omission, I will not hold the
                            Training team, Centre or Awarding Body responsible for any injuries that result.</span>
                    </label>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <label>{{ __('First Name') }}<span>*</span></label>
                                <input type="text" id="first_name" name="data[detail_first_name]" class="form-control"
                                    value="{{ auth()->user()->name ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group requiredRole">
                                <label>{{ __('Last Name') }}<span>*</span></label>
                                <input type="text" id="last_name" name="data[detail_last_name]" class="form-control"
                                    value="{{ auth()->user()->last_name ?? '' }}" readonly>
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
                                <input type="text" id="assessment_date" name="data[assessment_date]" class="form-control"
                                    value="{{ $now->format('Y-m-d H:i') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" id="previewButton" data-toggle="modal" data-target="#deletePreviewApp">
                    <i class="fas fa-eye mr-2"></i>
                    {{ __('Save and Preview') }}
                </button>
            </form>
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

        div#PreviewApp .modal-dialog {
            max-width: 80% !important;
            margin: 1.75rem auto !important;
        }

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

            .boxRow {
                border: solid 1px #000;
                border-radius: 10px;
                margin: 10px 0px;
            }

            .number {
                background: #3b1d8f;
                color: #fff;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 9px 0px 0px 9px;
                margin-right: 10px;
            }

            h4.bgStrip {
                background: #3b1d8f;
                border-radius: 5px;
                font-size: 35px;
                font-weight: 700;
                color: #fff;
                padding: 15px 0px 15px 10px;
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

            $(document).on('click', '#previewButton', function(e) {
                e.preventDefault();

                // ❗ Check if the signature is empty BEFORE proceeding
                if (signaturePad.isEmpty()) {
                    alert('Please provide your signature.');
                    return; // stop execution if no signature
                }


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
                        console.log(response.message);
                        button.prop('disabled', false);
                        form[0].reset();
                        $('#PreviewApp').modal('hide');
                        $('#loadingSpinner').hide();
                        window.location = "{{route('backend.learner.dashboard')}}";
                    })
                    .catch(function(err) {
                        $('#loadingSpinner').hide();
                        console.error(err);
                        button.prop('disabled', false);
                    });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initially hide all textarea elements
            document.querySelectorAll('.form-group textarea').forEach(function(textarea) {
                textarea.style.display = 'none';
            });

            // Add event listeners to each radio button
            document.querySelectorAll('.form-group input[type="radio"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    // Find the parent form-group of the changed radio button
                    let formGroup = radio.closest('.form-group');

                    // Ensure the textarea exists before trying to hide it
                    let textarea = formGroup.querySelector('textarea');
                    if (textarea) {
                        // Hide the textarea by default
                        textarea.style.display = 'none';

                        // If the 'Yes' option is selected, show the textarea
                        if (radio.classList.contains('yes') && radio.checked) {
                            textarea.style.display = 'block';
                        }
                    }
                });
            });
        });
    </script>
@endpush
