<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://trainingforemployment.test/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        .alertNotification img {
            float: left;
            width: 50px;
            margin-right: 15px;
        }

        .alertNotification span {
            /* margin-top: 26px; */
            display: block;
        }

        .alertNotification {
            margin: auto;
            background: #fad2e0;
            display: block;
            border: solid 1px #ff3823;
            border-radius: 5px;
            padding: 23px 20px;
        }

        .content {
            margin-top: 50px;
            margin-bottom: 30px;
        }

        .bgStrip {
            background: #3b1d8f;
            color: #fff;
            padding: 15px 15px;
            border-radius: 8px;
        }

        .alert-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #d32535;
        }

        .form-group {
            background: #f7f6f6;
            border: solid 1px #777;
            border-radius: 5px;
            padding: 15px;
            margin-top: 7px;
            margin-bottom: 7px;
        }

        .fa-bell:before {
            content: "\f0f3";
        }

        .inputField {
            border: solid 1px #777777 !important;
            border-radius: 5px;
            resize: none;
            background-color: #fff !important;
            font-size: 14px;
            padding: 5px 10px;
        }

        .text-center {
            text-align: center !important;
        }

        .alert {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

        label {
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
        }

        .bgStripGrey {
            background: #c0c0c0;
            color: #000;
            padding: 15px 15px;
            border-radius: 8px;
        }

        .clear-fix {
            clear: both;
        }
    </style>
</head>

<body>

    <div class="formWrapper">
        @php
            $radioImgSimplePath = public_path('images/header-pdf.png');
            $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
            $radioImgSimpleSrc = 'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
            
            $notificationPath = public_path('images/notificationimg.png');
            $notification = base64_encode(file_get_contents($notificationPath));
            $notificationSrc = 'data:' . mime_content_type($notificationPath) . ';base64,' . $notification;
        @endphp
        <div>
            <img src="{{ $radioImgSimpleSrc }}" style="width:100%;" alt="">
        </div>

        <p style="font-weight: 400;color:#5395cf;">
            <strong>
                Principles of Using Equipment as a Door Supervisor in the Private Security IndustryT/618/6844
            </strong>
        </p>

        <h1>Self Study (Top-Up) Workbook</h1>
        <div class="row">
            <div class="clear-fix"></div>
            <div class="bgStrip">Learner Information</div>
            <div class="clear-fix"></div>
            <div style="display: flex;">
                <div class="col-6" style="width:50%;float:left;margin-right:5px;">
                    <div class="form-group">
                        <label>First Name:</label>
                        <div class="inputField">{{ $formData['data']['info_first_name'] }}</div>
                    </div>
                </div>
                <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                    <div class="form-group">
                        <label>Last Name:</label>
                        <div class="inputField">{{ $formData['data']['info_last_name'] }}</div>
                    </div>
                </div>
            </div>
            <div class="clear-fix"></div>
            <div style="display: flex;">
                <div class="col-6" style="width:50%;float:left;margin-right:5px;">
                    <div class="form-group">
                        <label>E-Mail Address:</label>
                        <div class="inputField">{{ $formData['data']['info_email'] }}</div>
                    </div>
                </div>
                <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                    <div class="form-group">
                        <label>Course Start Date:</label>
                        <div class="inputField">{{ $formData['data']['info_course_start_date'] }}</div>
                    </div>
                </div>
            </div>
            <div class="clear-fix"></div>
            <div style="display: flex;">
                <div class="col-6" style="width:50%;float:left;margin-right:5px;">
                    <div class="form-group">
                        <label>Training Provider:</label>
                        <div class="inputField">{{ $formData['data']['info_training_provider'] }}</div>
                    </div>
                </div>
                <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                    <div class="form-group">
                        <label>Course End Date:</label>
                        <div class="inputField">{{ $formData['data']['info_course_end_date'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clear-fix"></div>
        <div class="bgStrip">Introduction</div>
        <div class="clear-fix"></div>
        <div
            style="background: #f7f6f6;border: solid 1px #777;border-radius: 5px;padding: 15px;margin-top: 4px;margin-bottom: 7px;">
            <div class="alertNotification">
                <img src="{{$notification}}" alt="">
                <span>This workbook must be completed and submitted to Training4Employment <br>
                    before any further face-to-face training.</span>
            </div>
            {{-- <div class="alert alert-danger text-center text-dark" role="alert"
                style="display: block;justify-content: center;color: #fad2e0;width: 50%;margin: auto;">
                <i class="nav-icon fas fa-bell text-white"
                    style="font-size: 3rem;margin-right: 10px;float: left;"></i><br>
                <div class="font-weight-bold">
                    <p style="margin: 0;text-align: left;color: #fff;"></p>
                    <p style="margin: 0;text-align: left;color: #fff;"></p>
                </div>
            </div> --}}
            <br>
            <p>This online form has been created based on the Door Supervisor Self-Study (Top-Up) Workbook
                from Highfield Products.</p>
            <p>This workbook has been developed to support you in achieving the requirements of the
                self-study learning outcomes and assessment criteria from the Highfield Level 2 Award for
                Door Supervisors in the Private Security Industry (Top Up) Unit 2: Principles of Using
                Equipment as a Door supervisor in the Private Security Industry.</p>
        </div>
        <br><br>


        <div class="devider"></div>
        <h4 class="bgStrip">Knowledge Questions</h4>
        <h4 class="bgStripGrey">LO1 Know how to use equipment relevant to a door supervisor.</h4>


        <div class="form-group">
            <div>
                <label>{{ __('AC1.1 Recognise equipment used to manage venue capacity.') }}</label>
                <p>
                    As a door supervisor, you will be required to use different types of equipment
                    to help you to manage the venue capacity.
                </p>
                <label>{{ __('Question 1:') }}</label> Identify <label>{{ __('THREE') }}</label>
                different types of equipment that can be used to help you manage venue capacity.
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>1. </strong>
                {{ $formData['data']['Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity'][0] }}
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>2. </strong>
                {{ $formData['data']['Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity'][1] }}
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>3. </strong>
                {{ $formData['data']['Q1. Identify THREE different types of equipment that can be used to help you manage venue capacity'][2] }}
            </div>
        </div>


        <div class="form-group">
            <div>
                <label>{{ __('AC1.2 Recognise the different types of personal protective equipment relevant to the role of a door supervisor.') }}</label>
                <p>Personal protective equipment (PPE) is used to help protect you from harm when
                    carrying out your job role.</p>
                <label>{{ __('Question 2:') }}</label> Identify <label>{{ __('EIGHT') }}</label>
                different types of personal protective equipment thay maybe used or worn when working as
                a doorsupervior.
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>1. </strong>
                {{ $formData['data']['Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.'][0] }}
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>2. </strong>
                {{ $formData['data']['Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.'][1] }}
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>3. </strong>
                {{ $formData['data']['Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.'][2] }}
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>4. </strong>
                {{ $formData['data']['Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.'][3] }}
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>5. </strong>
                {{ $formData['data']['Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.'][4] }}
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>6. </strong>
                {{ $formData['data']['Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.'][5] }}
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>7. </strong>
                {{ $formData['data']['Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.'][6] }}
            </div>
            <div class="inputField" style="margin-bottom:5px;">
                <strong>8. </strong>
                {{ $formData['data']['Q2. Identify EIGHT different types of personal protective equipment thay maybe used or worn when working as a doorsupervior.'][7] }}
            </div>

        </div>


        <div class="form-group">
            <div class="form-group requiredRole">
                <div>
                    <label>{{ __('AC1.3 State the purpose of using body-worn cameras (BWC)') }}</label>
                    <p>Body-worn cameras (BWC) have many benefits and as such are becoming more popular within the
                        private
                        security industry as well as within law enforcement.</p>
                    <label>{{ __('Question 3:') }}</label> State the purpose of body-worn cameras
                </div>
                <textarea name="data[Q3. State the purpose of body-worn cameras][]" cols="186" rows="10" class="form-control">{{ $formData['data']['Q3. State the purpose of body-worn cameras'][0] }}</textarea>
            </div>
        </div>


        <div class="form-group">
            <div class="form-group requiredRole">
                <div>
                    <label>{{ __('AC1.4 Identify how to communicate effectively using relevant equipment.') }}</label>
                    <p>As a door supervisor, you will have regular contact with several different types of people during
                        your duties, including members of the public, other staff members and members of external
                        agencies, therefore effective communication is always vital.</p>
                    <label>{{ __('Question 4:') }}</label> Identify how to communicate effectively with internal and
                    external colleagues, on the premises and with the police and other outside agencies using the
                    equipment listed.
                </div>

                <label>Radios and earpieces</label>
                <textarea cols="184" rows="10" class="form-control">{{ $formData['data']['Q4. Identify how to communicate effectively with internal and external colleagues, on the premises and with the police and other outside agencies using the equipment listed.'][0] }}</textarea>
                <label>Mobile phones</label>
                <textarea cols="184" rows="10" class="form-control">{{ $formData['data']['Q4. Identify how to communicate effectively with internal and external colleagues, on the premises and with the police and other outside agencies using the equipment listed.'][1] }}</textarea>
                <label>Internal telephone systems</label>
                <textarea cols="184" rows="10" class="form-control">{{ $formData['data']['Q4. Identify how to communicate effectively with internal and external colleagues, on the premises and with the police and other outside agencies using the equipment listed.'][2] }}</textarea>
            </div>
        </div>



        <div class="form-group">
            <div class="form-group requiredRole">
                <div>
                    <label>{{ __('AC1.5 Demonstrate effective use of communication devices.') }}</label>
                    <p>You will have access to and use different types of communication devices as part of your role,
                        and it is important that they are used effectively and for their intended purpose. Devices may
                        include:</p>
                    <ul>
                        <li>radios</li>
                        <li>mobile phones</li>
                        <li>internal phone systems</li>
                        <li>internal address systems</li>
                    </ul>
                    <label>{{ __('Question 5:') }}</label> Explain how you ensure you demonstrate effective use of
                    communication devices.
                </div>
                <textarea cols="184" rows="10" class="form-control">{{ $formData['data']['Q5. Explain how you ensure you demonstrate effective use of communication devices.'][0] }}</textarea>
            </div>
        </div>

        <h4 class="bgStripGrey">LO2 Know what actions to take in relation to global (or critical) incidents.</h4>
        <div class="form-group">
            <div class="form-group requiredRole">
                <div>
                    <label>{{ __('AC2.1 Know government guidance in relation to global (or critical) incidents.') }}</label>
                    <p>As a door supervisor, it is important to know what actions you should take and where you can find
                        additional information and guidance when dealing with global or critical incidents.</p>

                    <label>{{ __('Question 6:') }}</label> Describe the government guidance in relation to global (or
                    critical) incidents.
                </div>
                <textarea cols="184" rows="10" class="form-control">{{ $formData['data']['Q6. Describe the government guidance in relation to global (or critical) incidents.'][0] }}</textarea>
            </div>
        </div>

        <div class="bgStrip" style="clear: both;margin:10px 0px;">Learner Declaration</div>
        <div class="form-group">
            <label>First Name</label>
            <div class="inputField" style="margin-bottom:5px;">
                {{ $formData['data']['detail_first_name'] }}
            </div>
            <label>Last Name</label>
            <div class="inputField" style="margin-bottom:5px;">
                {{ $formData['data']['detail_last_name'] }}
            </div>
            <label>Date, Time Assessment Completed</label>
            <div class="inputField" style="margin-bottom:5px;">
                {{ $formData['data']['assessment_date'] }}
            </div>
            <label>Signature</label>
            <div class="inputField" style="margin-bottom:5px;">
                <img src="{{ $signatureData }}" alt="">
            </div>
        </div>


    </div>


</body>

</html>
