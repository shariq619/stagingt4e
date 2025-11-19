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



                <div class="col-12">



                    @php
                        $learner_response = json_decode($learner_response, true);

                        //dd($learner_response);

                        $detail_first_name = $learner_response['data']["detail_first_name"] ?? '';
                        $detail_last_name = $learner_response['data']["detail_last_name"] ?? '';
                        $assessment_date = $learner_response['data']["assessment_date"] ?? '';
                        $signatureLearner = $learner_response['signature'] ?? "";

                        //dd($learner_response);

                    @endphp





                    <div class="col-12">
                        <div class="form-step" id="step-1" data-step="1">

                            <div class="row headerDetail">
                                <div class="col-6">
                                    <h1>PI Techniques Questionnaire </h1>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form method="POST" action="{{ route('backend.task.response', ['submission' => $submission_id]) }}">
                        @csrf


                        <div class="studyAssessment">
                            <h4 class="bgStrip my-5">Techniques Questionnaire for Physical <br> Intervention Participants</h4>
                            <p>Dear <strong>{{ $detail_first_name ?? "" }} {{ $detail_last_name ?? "" }},</strong></p>

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
                                               value="{{ $detail_first_name ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group requiredRole">
                                        <label>{{ __('Last Name') }}<span>*</span></label>
                                        <input type="text" id="last_name" name="data[detail_last_name]" class="form-control"
                                               value="{{ $detail_last_name ?? "" }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>{{ __('Learner Signature') }}<span>*</span></label>
                                        <div id="signature-pad" class="signature-pad">
                                            <img src="{{$signatureLearner}}" class="img-fluid" alt="">
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
                                               value="{{ $assessment_date }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

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


            </form>
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
        });


    </script>

@endpush
