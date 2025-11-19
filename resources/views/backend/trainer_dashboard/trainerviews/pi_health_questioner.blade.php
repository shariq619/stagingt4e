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

                       // dd($learner_response);


                        $username = $learner_response['data']["username"] ?? '';
                        $Q1 = $learner_response['data']["Have you been exercise inactive for the past 12 months?"] ?? '';

                       // dd($Q1);

                        $Q2 = $learner_response['data']["Do you have a heart condition?"] ?? '';
                        $Q3 = $learner_response['data']["Have you ever experienced chest pains when exercising?"] ?? '';
                        $Q4 = $learner_response['data']["Do you suffer from any joint problems?"] ?? '';
                        $Q5 = $learner_response['data']["Do you have any ongoing injuries or are you currently taking medication or receiving treatment?"] ?? '';
                        $Q6 = $learner_response['data']["Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?"] ?? '';

                         $signatureLearner = $learner_response['signature'] ?? "";
                         $detail_first_name = $learner_response['data']['detail_first_name'] ?? "";
                         $detail_last_name = $learner_response['data']['detail_last_name'] ?? "";
                         $assessment_date = $learner_response['data']['assessment_date'] ?? "";

                    @endphp





                    <div class="col-12">
                        <div class="form-step" id="step-1" data-step="1">

                            <div class="row headerDetail">
                                <div class="col-6">
                                    <h1>PI Health Questionnaire </h1>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form method="POST" action="{{ route('backend.task.response', ['submission' => $submission_id]) }}">
                        @csrf



                        <div class="col-12">

                            <div class="studyAssessment">
                                <div class="devider"></div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div>
                                                <label>{{ __('Have you been exercise inactive for the past 12 months?') }}</label>
                                            </div>
                                            <div class="d-flex">
                                                <input type="radio"
                                                       name="data[Have you been exercise inactive for the past 12 months?][]"
                                                       class="yes"
                                                       value="Yes, I have been exercise inactive due to ongoing health issues" {{ in_array('Yes, I have been exercise inactive due to ongoing health issues', $Q1) ? 'checked' : '' }}>
                                                <label class="mb-0 ml-2">Yes, I have been exercise inactive due to ongoing health
                                                    issues</label>
                                            </div>
                                            <div class="d-flex">
                                                <input type="radio"
                                                       name="data[Have you been exercise inactive for the past 12 months?][]"
                                                       value="No, for past 12 months keep physically active" {{ in_array('No, for past 12 months keep physically active', $Q1) ? 'checked' : '' }}>
                                                <label class="mb-0 ml-2">No, for past 12 months keep physically active</label>
                                            </div>
                                            <div class="mt-3 selectedInput">
                                                <label>Please provide details:</label>
                                                <textarea name="data[Have you been exercise inactive for the past 12 months?][]" class="form-control" cols="30"
                                                          rows="10">{{ $Q1[1] ?? "" }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Do you have a heart condition?') }}</label>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <input type="radio" name="data[Do you have a heart condition?][]"
                                                           value="Yes" {{ in_array('Yes', $Q2) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">Yes</label>
                                                </div>
                                                <div class="d-flex ml-5">
                                                    <input type="radio" name="data[Do you have a heart condition?][]"
                                                           value="No" {{ in_array('No', $Q2) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Have you ever experienced chest pains when exercising?') }}</label>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <input type="radio"
                                                           name="data[Have you ever experienced chest pains when exercising?][]"
                                                           value="Yes" {{ in_array('Yes', $Q3) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">Yes</label>
                                                </div>
                                                <div class="d-flex ml-5">
                                                    <input type="radio"
                                                           name="data[Have you ever experienced chest pains when exercising?][]"
                                                           value="No" {{ in_array('No', $Q3) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Do you suffer from any joint problems?') }}</label>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <input type="radio" class="yes"
                                                           name="data[Do you suffer from any joint problems?][]" value="Yes" {{ in_array('Yes', $Q4) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">Yes</label>
                                                </div>
                                                <div class="d-flex ml-5">
                                                    <input type="radio" name="data[Do you suffer from any joint problems?][]"
                                                           value="No" {{ in_array('No', $Q4) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">No</label>
                                                </div>
                                            </div>
                                            <div class="mt-3 selectedInput">
                                                <label>Please provide details:</label>
                                                <textarea name="data[Do you suffer from any joint problems?][]" class="form-control" cols="30" rows="10">{{ $Q4[1] ?? "" }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Do you have any ongoing injuries or are you currently taking medication or receiving treatment?') }}</label>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <input type="radio" class="yes"
                                                           name="data[Do you have any ongoing injuries or are you currently taking medication or receiving treatment?][]"
                                                           value="Yes" {{ in_array('Yes', $Q5) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">Yes</label>
                                                </div>
                                                <div class="d-flex ml-5">
                                                    <input type="radio"
                                                           name="data[Do you have any ongoing injuries or are you currently taking medication or receiving treatment?][]"
                                                           value="No" {{ in_array('No', $Q5) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">No</label>
                                                </div>
                                            </div>
                                            <div class="mt-3 selectedInput">
                                                <label>Please provide details:</label>
                                                <textarea
                                                    name="data[Do you have any ongoing injuries or are you currently taking medication or receiving treatment?][]"
                                                    class="form-control" cols="30" rows="10">{{ $Q5[1] ?? "" }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?') }}</label>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <input type="radio" class="yes"
                                                           name="data[Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?][]"
                                                           value="Yes" {{ in_array('Yes', $Q6) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">Yes</label>
                                                </div>
                                                <div class="d-flex ml-5">
                                                    <input type="radio"
                                                           name="data[Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?][]"
                                                           value="No" {{ in_array('No', $Q6) ? 'checked' : '' }}>
                                                    <label class="mb-0 ml-2">No</label>
                                                </div>
                                            </div>
                                            <div class="mt-3 selectedInput">
                                                <label>Please provide details:</label>
                                                <textarea
                                                    name="data[Is there anything else not previously mentioned which, could effect your inclusion on the training during the day?][]"
                                                    class="form-control" cols="30" rows="10">{{ $Q6[1] ?? "" }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="learnerDeclaration">
                                <h4 class="bgStrip">Learner Details</h4>
                                <label class="d-flex align-items-center ml-4">
                                    <input type="checkbox" name="guideline1" class="form-check-input " checked>
                                    <span style="color:#000;font-weight: 400;font-size: 14px;">I declare that I have never had any
                                other disorder not already mentioned that could effect my involvement on the training. I
                                understand that if any of the information is incorrect or if there are any omission, I will
                                not hold the Training team, Centre or Awarding Body responsible for any injuries that
                                result.</label>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group requiredRole">
                                            <label>{{ __('First Name') }}<span>*</span></label>
                                            <input type="text" id="first_name" name="data[detail_first_name]"
                                                   class="form-control" value="{{ $detail_first_name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group requiredRole">
                                            <label>{{ __('Last Name') }}<span>*</span></label>
                                            <input type="text" id="last_name" name="data[detail_last_name]"
                                                   class="form-control" value="{{ $detail_last_name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Learner Signature') }}<span>*</span></label>
                                            <div id="signature-pad" class="signature-pad">
                                                <img src="{{$signatureLearner}}" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                @php
                                                    $now = new DateTime();
                                                @endphp
                                                <label>{{ __('Date, Time Assessment Completed') }}</label>
                                                <input type="text" id="assessment_date" name="data[assessment_date]"
                                                       class="form-control" value="{{ $assessment_date }}" readonly>
                                            </div>
                                        </div>
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
