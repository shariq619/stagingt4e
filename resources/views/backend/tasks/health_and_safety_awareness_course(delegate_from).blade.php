@extends('layouts.main')

@section('title', 'User')
@section('main')
    <div class="formWrapper">
        <div class="row">
            <form action="{{ route('backend.task.submission') }}" method="POST" id="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <input type="hidden" name="task_name" value="{{ $task->name }}" />
                    <input type="hidden" name="task_id" value="{{ $task->id }}" />
                    <input type="hidden" name="course_id" value="{{ $course_id }}" />
                    <input type="hidden" name="cohort_id" value="{{ $cohort_id }}" />
                    <input type="hidden" name="trainer_id" value="{{ $trainer_id }}" />
                    <div class="studyAssessment">
                        <h4 class="bgStrip text-center">Site Safety Plus Delegate Information Form</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Training Provider No:') }}</label>
                                    <input type="text" id="TrainingProviderNo" name="data[TrainingProviderNo]"
                                        class="form-control" value="22643" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Training Provider Name:') }}</label>
                                    <input type="text" id="TrainingProviderName" name="data[TrainingProviderName]"
                                        class="form-control" value="Training4Employment" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Course Type: Health and Safety Awareness Course (HSA):') }}</label>
                                    <input type="text" id="CourseType" name="data[CourseType]" class="form-control"
                                        value="Course Type: Health and Safety Awareness Course (HSA)" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="bgStrip text-center w-100"><u>Section A: Delegate Details</u> <small>(Please complete
                                    all fields where information is known.)</small></h4>
                            <div class="col-4">
                                <div class="form-group requiredRole">
                                    <label>{{ __('CITB registration No') }}</label>
                                    <input type="text" name="data[registration]" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Title') }}</label>
                                    <input type="text" name="data[title]" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group requiredRole">
                                    <label>{{ __('DOB') }}</label>
                                    <input type="date" name="data[dob]" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Forename(s)') }}</label>
                                    <input type="text" name="data[Forename]" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Surname (family name)') }}</label>
                                    <input type="text" name="data[surname]" class="form-control">
                                </div>
                                <small>Names with mixed case (e.g. prefixed by Mc or Mac) please indicate which letters
                                    should be lower case. Middle names should be included in the ‘Forename(s)’ field.
                                </small>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Home Address') }}</label>
                                    <textarea name="data[home_address]" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Postcode') }}</label>
                                    <input type="text" name="data[postcode]" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Telephone No (mobile)') }}</label>
                                    <input type="tel" name="data[telephone]" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('National Insurance No') }}</label>
                                    <input type="text" name="data[national_insurance]" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Email Address') }}</label>
                                    <input type="email" name="data[email_address]" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 my-3">
                                <h4 class="mb-3">Delegate Declaration: <span
                                        style="font-size: 15px;font-weight:500;">(Must be read and
                                        signed by the delegate) Signing this form confirms that you have
                                        successfully booked onto a
                                        Site Safety Plus Course with your chosen training provider. Your certificate will be
                                        produced with the details provided on this form. If you wish to
                                        change your name please enclose copies of your legal name change e.g. birth
                                        certificate, divorce certificate, deed poll name change certificate.</span></h4>
                                <h4>Data Protection Statement: <span style="font-size: 15px;font-weight:500;">The
                                        information you provide to us will be used for administering the Site Safety Plus
                                        Scheme and for
                                        purposes connected with our role as an Industrial Training Board in accordance with
                                        the Industrial Training Act 1982.</span></h4>
                                <p>Your data will be held securely and treated confidentially and will not be disclosed to
                                    external parties other than as required for the purposes
                                    described above, which may include sharing your information on a construction training
                                    register as well as with employers, awarding organisations
                                    or training providers. </p>
                                <p>For information explaining your legal rights and how we use your information, please view
                                    our Privacy Notice online at <a
                                        href="https://www.citb.co.uk/utility-links/privacy-policy-cookies/">www.citb.co.uk/privacy.</a>
                                </p>
                                <div class="form-group mt-4">
                                    <label>{{ __('Signature:') }}<span>*</span></label>
                                    <small>PLEASE NOTE: Failure to sign this
                                        document will result in your certification
                                        being delayed.</small>
                                    <div id="signature-pad" class="signature-pad">
                                        <div id="signature-pad" class="signature-pad">
                                            <div class="signature-pad-body">
                                                <canvas id="signature-canvas"
                                                    style="background: #fff; border: solid 2px #cccc; margin-bottom: 30px;"></canvas>
                                                <div id="signature-error" class="invalid-feedback" style="display: none;">
                                                    Signature is required.
                                                </div>
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
                        </div>
                    </div>
                    <div class="learnerDeclaration">
                        <h4 class="bgStrip"><u>Section B: Employer Details for Grant Claiming Purposes</u></h4>
                        <p>Please provide the delegate’s employer's seven-digit CITB Levy & Grant registration number and
                            employer's name if the employer wishes to claim
                            grant. Failure to do so will result in Grant being unclaimed. Employers should call the Levy &
                            Grant Customer Services Team to resolve this.
                            Please note: Levy numbers cannot be added after this form has been submitted to Site Safety
                            Plus.
                        </p>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Employer Name') }}</label>
                                    <input type="text" id="employer_name" name="data[employer_name]"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Levy Number') }}</label>
                                    <input type="tel" name="data[levy_number]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="previewButton">
                        <i class="fas fa-eye mr-2"></i>
                        {{ __('Save and Preview') }}
                    </button>
                </div>
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
                background: #00386b;
                font-size: 18px;
                font-weight: 500;
                color: #fff;
                margin-bottom: 10px;
                padding: 8px 0px 8px 10px;
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

                function validateForm() {
                    let isValid = true;

                    $('.requiredRole').each(function() {
                        $(this).find('input, textarea').each(function() {
                            const val = $(this).val().trim();
                            if (val === '') {
                                isValid = false;
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
                    });


                    // Signature validation
                    if (signaturePad.isEmpty()) {
                        isValid = false;
                        $('#signature-canvas').addClass('is-invalid');
                        $('#signature-error').show();
                    } else {
                        $('#signature-canvas').removeClass('is-invalid');
                        $('#signature-error').hide();
                    }

                    return isValid;
                }

                if (!validateForm()) {
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
                        $('#loadingSpinner').hide();
                        $('#PreviewApp').modal('hide');
                        window.location = "{{ route('backend.learner.dashboard') }}";
                    })
                    .catch(function(err) {
                        $('#loadingSpinner').hide();
                        console.error(err);
                        button.prop('disabled', false);
                    });
            });
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initially hide all textarea elements
            document.querySelectorAll('.selectedInput').forEach(function(textarea) {
                textarea.style.display = 'none';
            });

            // Add event listeners to each radio button
            document.querySelectorAll('.form-group input[type="radio"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    // Find the parent form-group of the changed radio button
                    let formGroup = radio.closest('.form-group');

                    // Ensure the textarea exists before trying to hide it
                    let textarea = formGroup.querySelector('.selectedInput');
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
    </script> --}}
@endpush
