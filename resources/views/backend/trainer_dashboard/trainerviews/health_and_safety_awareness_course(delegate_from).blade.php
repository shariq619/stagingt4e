@extends('layouts.main')

@section('title', 'Health and Safety Awareness (HSA)')

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
    <div class="formWrapper mb-2">
        <div class="row">


            @php
                $username = auth()->user()->name;
                $pdf = $submission_pdf;
            @endphp


            <div class="col-12">
                <div class="row headerDetail mb-5">
                    <div class="col-4">
                        <h1>Health and Safety Awareness</h1>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <div class="floatingpdfTrainer d-inline-flex align-items-center overflow-auto">
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
                    $TrainingProviderNo = $learner_response['data']['TrainingProviderNo'];
                    $TrainingProviderName = $learner_response['data']['TrainingProviderName'];
                    $CourseType = $learner_response['data']['CourseType'];
                    $registration = $learner_response['data']['registration'];
                    $title = $learner_response['data']['title'];
                    $signature = $learner_response['signature'];
                    $dob = $learner_response['data']['dob'];
                    $Forename = $learner_response['data']['Forename'];
                    $surname = $learner_response['data']['surname'];
                    $home_address = $learner_response['data']['home_address'];
                    $postcode = $learner_response['data']['postcode'];
                    $telephone = $learner_response['data']['telephone'];
                    $national_insurance = $learner_response['data']['national_insurance'];
                    $email_address = $learner_response['data']['email_address'];
                    $employer_name = $learner_response['data']['employer_name'];
                    $levy_number = $learner_response['data']['levy_number'];


                @endphp
                <div class="col-12">

                    <div class="learnerInformation">
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
                            <h4 class="bgStrip text-center w-100"><u>Section A: Delegate Details</u> <small>(Please
                                    complete
                                    all fields where information is known.)</small></h4>
                            <div class="col-4">
                                <div class="form-group requiredRole">
                                    <label>{{ __('CITB registration No') }}</label>
                                    <input type="text" name="data[registration]" value="{{ $registration }}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Title') }}</label>
                                    <input type="text" name="data[title]" value="{{ $title }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group requiredRole">
                                    <label>{{ __('DOB') }}</label>
                                    <input type="text" name="data[dob]" value="{{ $dob }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Forename(s)') }}</label>
                                    <input type="text" name="data[Forename]" value="{{ $Forename }}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Surname (family name)') }}</label>
                                    <input type="text" name="data[surname]" value="{{ $surname }}" class="form-control">
                                </div>
                                <small>Names with mixed case (e.g. prefixed by Mc or Mac) please indicate which letters
                                    should be lower case. Middle names should be included in the ‘Forename(s)’ field.
                                </small>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Home Address') }}</label>
                                    <textarea name="data[home_address]"
                                              class="form-control">{{ $home_address }}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Postcode') }}</label>
                                    <input type="text" name="data[postcode]" value="{{ $postcode }}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Telephone No (mobile)') }}</label>
                                    <input type="tel" name="data[telephone]" value="{{ $telephone }}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('National Insurance No') }}</label>
                                    <input type="text" name="data[national_insurance]" value="{{ $national_insurance }}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group requiredRole">
                                    <label>{{ __('Email Address') }}</label>
                                    <input type="email" name="data[email_address]" value="{{ $email_address }}"
                                           class="form-control">
                                </div>
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
                        </div>

                        <div style="margin-bottom: 20px;">
                            <div class="form-group">
                                <label>Signature<span>*</span></label>
                                <div class="inputField" style="margin-bottom:5px;">
                                    @if(isset($signature))
                                            <img src="{{ $signature }}" alt="Learner's Signature"
                                                >
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 my-3">
                            <div style="margin-bottom: 10px;">
                                <h4 class="bgStrip text-center w-100"><u>Section B: Employer Details for Grant Claiming Purposes</u></h4>
                                <p>Please provide the delegate’s employer's seven-digit CITB Levy & Grant registration
                                    number and
                                    employer's name if the employer wishes to claim
                                    grant. Failure to do so will result in Grant being unclaimed. Employers should call
                                    the Levy &
                                    Grant Customer Services Team to resolve this.
                                    Please note: Levy numbers cannot be added after this form has been submitted to Site
                                    Safety
                                    Plus.
                                </p>
                            </div>

                            <div style="display: flex;margin-bottom: 10px;">
                                <div class="col-6" style="width:50%;float:left;margin-right:5px;">
                                    <label>Employer Name</label>
                                    <div class="form-group">
                                        <div class="inputField">{{ $employer_name}}</div>
                                    </div>
                                </div>
                                <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                                    <label>Levy Number</label>
                                    <div class="form-group">
                                        <div class="inputField">{{ $levy_number }}</div>
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

                                <!-- Status Dropdown -->
                                <div class="form-group mb-4">
                                    <label for="status">Task Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>















            </div>
            <div class="clear-fix"></div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
            integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        $(document).ready(function () {
            $('.toggle-btn').click(function () {
                // Find the associated hidden input
                let hiddenInput = $(this).siblings('.toggle-input');

                if ($(this).hasClass('btn-success')) {
                    // Toggle to incorrect
                    $(this).removeClass('btn-success').addClass('btn-danger');
                    $(this).html('<i class="fas fa-times"></i>');
                    $(this).attr('data-correct', 'false');
                    hiddenInput.val('incorrect'); // Update the hidden input value
                } else {
                    // Toggle to correct
                    $(this).removeClass('btn-danger').addClass('btn-success');
                    $(this).html('<i class="fas fa-check"></i>');
                    $(this).attr('data-correct', 'true');
                    hiddenInput.val('correct'); // Update the hidden input value
                }
            });

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

@endpush
