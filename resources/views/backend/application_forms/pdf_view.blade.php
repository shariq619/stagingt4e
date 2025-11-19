<!-- resources/views/backend/application_forms/pdf_view.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Submission</title>
    <style>
        .grid {
            width: 100%;
            display: block;
            clear: both;
        }

        .grid-item {
            float: left;
            width: 50%;
            margin: 0px 0px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            width: 50%;
            /* float: left; */
        }

        .bgBar {
            background: #919191;
            padding: 5px 20px;
            border-radius: 7px;
            color: #fff;
            font-weight: 600;
            font-size: 13px;
        }

        .bgbargray {
            display: block;
            clear: both;
        }

        .inputRow {
            /* display: flex; */
            margin: 0px 0px;
            align-items: center;
        }

        .inputRow .label {
            color: #000;
            font-weight: 500;
            margin-bottom: 1px;
            font-size: 13px;
        }

        .label {
            font-weight: normal !important;
            font-size: 13px !important;
        }

        .divinput {
            line-height: 20px;
            border: solid 1px #777;
            height: 18px;
            padding-left: 10px;
            border-radius: 7px;
            font-size: 12px;
        }

        .wrapper {
            padding: 0px 50px;
        }

        /* .ulPostion li {
            position: relative;
            padding-left: 18px;
        }

        .ulPostion li:before {
            content: '';
            width: 7px;
            height: 7px;
            border: solid 1px #000;
            left: 5px;
            top: 2px;
            border-radius: 100%;
            position: absolute;
        } */

        p {
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @php
            $imagePath = public_path('images/header-pdf.png');
            $image = base64_encode(file_get_contents($imagePath));
            $imageSrc = 'data:' . mime_content_type($imagePath) . ';base64,' . $image;

            $checkedPath = public_path('images/checked.png');
            $checkedImage = base64_encode(file_get_contents($checkedPath));
            $checkedSrc = 'data:' . mime_content_type($checkedPath) . ';base64,' . $checkedImage;
        @endphp

        {{-- <img src="{{ $imageSrc }}" style="height:60px;width:100%;object-fit:cover;" /> --}}




        @php
            $radioImgSimplePath = public_path('images/blacklogo.png');
            $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
            $radioImgSimpleSrc = 'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
        @endphp
        @php
            $notificationPath = public_path('images/notificationimg.png');
            $notification = base64_encode(file_get_contents($notificationPath));
            $notificationSrc = 'data:' . mime_content_type($notificationPath) . ';base64,' . $notification;
        @endphp
        @php
            $keyPointPath = public_path('images/notificationlight.png');
            $keyPoint = base64_encode(file_get_contents($keyPointPath));
            $keyPointSrc = 'data:' . mime_content_type($keyPointPath) . ';base64,' . $keyPoint;
        @endphp

        <div style="display: block;clear: both;overflow: overlay;padding-bottom: 15px;">
            <div class="col-6" style="width:47%;float:left;margin-right:5px;">
                @php
                    $radioImgSimplePath = public_path('images/blacklogo.png');
                    $radioImgSimple = base64_encode(file_get_contents($radioImgSimplePath));
                    $radioImgSimpleSrc =
                        'data:' . mime_content_type($radioImgSimplePath) . ';base64,' . $radioImgSimple;
                @endphp
                <img src="{{ $radioImgSimpleSrc }}" class="img-fluid" alt="">
            </div>
            <div class="col-6" style="width:50%;float:left;margin-left:5px;">
                <div class="companyInfo" style="text-align:right;">
                    <p style="margin:0;"><strong>Training for Employment Ltd</strong></p>
                    <span>89-91 Hatchett Street, Birmingham, B19 3NY</span><br>
                    <span>E: info@training4employment.co.uk</span><br>
                    <span>www.training4employment.co.uk</span><br>
                    <span>Tel: 0121 630 2115</span><br>
                </div>
            </div>
        </div>



        <h1 style="color:#000;font-size:17px;margin:0;margin-top:10px;">Application Form</h1>
        <div class="bgBar">Personal Details</div>
        <div class="grid">
            <div style="margin-bottom:4px;width: 100%;">
                <div class="inputRow">
                    <div class="label">First Name</div>
                    <div class="divinput">{{ $formData['father_name'] }}</div>
                </div>
            </div>
            <div style="margin-bottom:4px;width: 100%;">
                <div class="inputRow">
                    <div class="label">Middle Name</div>
                    <div class="divinput">{{ $formData['middle_name'] }}</div>
                </div>
            </div>
            <div style="margin-bottom:4px;width: 100%;">
                <div class="inputRow">
                    <div class="label">Last Name</div>
                    <div class="divinput">{{ $formData['last_name'] }}</div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="grid-item" style="width: 35%;margin-right:5px;">
                <div class="inputRow">
                    <div class="label">DOB</div>
                    <div class="divinput">{{ $formData['birth_date'] }}</div>
                </div>
            </div>
            <div class="grid-item" style="width: 65%;margin-left:5px;">
                <div class="inputRow">
                    <div class="label">Nationality</div>
                    <div class="divinput">{{ $formData['nationality'] }}</div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="grid-item" style="width: 65%;margin-right:5px;">
                <div class="inputRow" style="width:100%;">
                    <div class="label">Post Code</div>
                    <div class="divinput">{{ $formData['post_code'] }}</div>
                </div>
            </div>
            <div class="grid-item" style="width: 35%;margin-left:5px;">
                <div class="inputRow" style="width:100%;">
                    <div class="label">Full Address</div>
                    <div class="divinput">{{ $formData['address'] }}</div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div style="margin-bottom:4px;width: 100%;">
                <div class="inputRow">
                    <div class="label">Email Address</div>
                    <div class="divinput">{{ $formData['email'] }}</div>
                </div>
            </div>
        </div>
        <div class="grid" style="margin-bottom:50px;">
            <div class="grid-item" style="width: 50%;margin-right:5px;">
                <div class="inputRow">
                    <div class="label">Mobile No.</div>
                    <div class="divinput">{{ $formData['phone_number'] }}</div>
                </div>
            </div>
            <div class="grid-item" style="width: 50%;margin-left:5px;">
                <div class="inputRow">
                    <div class="label">Telephone No.</div>
                    <div class="divinput">{{ $formData['telephone'] }}</div>
                </div>
            </div>
        </div>
        <div style="display:block;clear:both;margin:5px 0px;">
            <div class="bgBar">Next of Kin</div>
        </div>
        <div class="grid">
            <div class="grid-item" style="float:left;width:50%;margin-right:4px;">
                <div class="inputRow">
                    <div class="label">Name</div>
                    <div class="divinput">{{ $formData['name'] }}</div>
                </div>
            </div>
            <div class="grid-item" style="float:left;width:50%;margin-left:4px;">
                <div class="inputRow">
                    <div class="label">Contact No.</div>
                    <div class="divinput">{{ $formData['contact_num'] }}</div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="inputRow" style="width:100%;margin-bottom:10px;">
                <div class="label">Relationship to you</div>
                <div class="divinput">{{ $formData['relationship_to_you'] }}</div>
            </div>
        </div>
        <div class="bgbargray">
            <div class="bgBar">Employer Details</div>
        </div>
        <div class="grid">
            <div class="inputRow" style="width:100%;margin-bottom:4px;">
                <div class="label">Company Name</div>
                <div class="divinput" style="width:100%;">{{ $formData['company'] }}</div>
            </div>
        </div>
        <div class="grid">
            <div class="grid-item" style="float:left;width:65%;margin-right:5px;">
                <div style="width:100%;">
                    <div class="label">Contact Name</div>
                    <div class="divinput">{{ $formData['emp_contact_name'] }}</div>
                </div>
            </div>
            <div class="grid-item" style="float:left;width:35%;margin-left:5px;">
                <div style="width:100%;">
                    <div class="label">Contact Number.</div>
                    <div class="divinput">{{ $formData['emp_contact_num'] ?? '' }}</div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="grid-item" style="float:left;width:70%;">
                <div class="inputRow">
                    <div class="label">Copmany Address</div>
                    <div class="divinput" style="margin-right:5px;">{{ $formData['emp_copmany_address'] ?? '' }}
                    </div>
                </div>
            </div>
            <div class="grid-item" style="float:left;width:30%;">
                <div class="inputRow">
                    <div class="label">Post Code</div>
                    <div class="divinput" style="margin-left:5px;">{{ $formData['emp_post_code'] ?? '' }}</div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="inputRow" style="width:100%;margin-bottom:10px;">
                <div class="label">Levy Number (If Applicable):</div>
                <div class="divinput">{{ $formData['levy_number'] ?? '' }}</div>
            </div>
        </div>
        <div class="bgbargray">
            <div class="bgBar" style="margin-bottom:10px;">Enrolment Details</div>
        </div>
        <div class="grid">
            <div class="inputRow" style="margin-bottom:10px;">
                <div
                    style="height:35px;border:solid 1px #cccc;border-radius:10px 10px 10px 10px;padding-top:10px;padding-left:10px;font-size:13px;">
                    Course(s) Booked:</div>
            </div>
        </div>
        <div class="bgbargray">
            <div class="bgBar" style="width:100%;margin-bottom:10px;">How Did You Hear Abou Us?</div>
        </div>
        <div class="grid">
            @php
                $checkedRadio = public_path('images/round.png');
                $checkedRadioImage = base64_encode(file_get_contents($checkedRadio));
                $checkedRadioSrc = 'data:' . mime_content_type($checkedRadio) . ';base64,' . $checkedRadioImage;

                $checkedBasicRadio = public_path('images/dry-clean.png');
                $checkedBasicRadioImage = base64_encode(file_get_contents($checkedBasicRadio));
                $checkedBasicRadioSrc =
                    'data:' . mime_content_type($checkedBasicRadio) . ';base64,' . $checkedBasicRadioImage;

                $hearAboutOptions = [
                    '1' => 'Social Media (Facebook, Instagram, LinkedIn, X, TikTok, YouTube, etc.)',
                    '2' => 'Search Engine (Google, Yahoo, etc)',
                    '3' => 'Paid Google Advertisement',
                    '4' => 'Paid Bing Advertisement',
                    '5' => 'Word of Mouth',
                    '6' => 'Email',
                    '7' => 'Referred by a Trainer',
                    '8' => 'Referred by a Friend',
                    '9' => 'Third Party (Hurak, Get Licenced, etc)',
                    '10' => 'Other',
                ];
            @endphp

            <div class="grid-item">
                <ul style="margin:0;padding:0;list-style:none;" class="ulPostion">
                    @foreach ($hearAboutOptions as $key => $option)
                        <li value="{{ $key }}">
                            <img src="{{ $formData['hear_about'] == $key ? $checkedRadioSrc : $checkedBasicRadioSrc }}"
                                style="width:10px; height:10px;" alt="">
                            <label style="font-size:11px;">{{ $option }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <br><br><br><br><br>
        <div class="bgbargray">
            <div class="bgBar" style="width:100%;">Declaration</div>
            <h4 style="color:#000;font-size:17px;margin:0;margin-top:10px;">GUIDELINES FOR CANDIDATES & EMPLOYERS</h4>
            <p style="margin: 0;">Training for Employment courses can be physically demanding. It is the employer’s
                responsibility to ensure that candidates are free from any condition which would affect their
                capability, and that they have the aptitude to cope with an intensive course of study. (We welcome
                candidates with disabilities for training, but it remains their employer’s responsibility to ensure that
                they are appropriately supported in their workplace.)</p>
            @if ($formData['guideline1'] == 1)
                <p style="margin: 0;"><img src="{{ $checkedSrc }}"
                        style="width:10px;height:10px;object-fit:contain;" /> I consent to having images and videos of
                    myself taken during the course for quality assurance and compliance purposes. These images and
                    videos may be shared with the examination board to support the attainment of my qualification(s).
                </p>
            @endif
            @if ($formData['guideline2'] == 1)
                <p style="margin: 0;"><img src="{{ $checkedSrc }}"
                        style="width:10px;height:10px;object-fit:contain;" /> I understand that if, at any time during
                    the course, I do not wish to participate in or appear in marketing and promotional videos and/or
                    images, I must inform the trainer or the staff member taking the images to ensure I am not included.
                </p>
            @endif
            <p style="margin: 0;"><img src="{{ $checkedSrc }}"
                    style="width:10px;height:10px;object-fit:contain;" /> At Training for Employment Ltd we offer
                exclusive offers and useful industry information to our loyal customers. To do this, we require your
                permission to confirm you are happy for Training for Employment Ltd to contact you via email, post, SMS,
                phone, and other electronic means. We will always treat your personal details with the utmost care and
                will never sell them to other companies for marketing purposes.</p>
            @if ($formData['guideline3'] == 1)
                <p style="margin: 0;"> I consent to Training for Employment Ltd to contact via email, SMS or phone.</p>
            @endif
            <h4 style="color:#000;font-size:17px;margin:0;margin-top:10px;">PURCHASES MADE FROM REED.CO.UK</h4>
            <p style="margin: 0;"><img src="{{ $checkedSrc }}"
                    style="width:10px;height:10px;object-fit:contain;" /> You may cancel your purchase of the course
                within the period of 14 calendar days from the date on which the contract of purchase is concluded. This
                is called a “Cancellation Period”. Note that if you redeem your voucher during the Cancellation Period,
                you expressly request us to begin providing the course materials and you acknowledge that you lose your
                right to cancel the purchase of the course and get any refund for it.</p>
            <p style="margin: 0;"><img src="{{ $checkedSrc }}"
                    style="width:10px;height:10px;object-fit:contain;" /> In case you decide to cancel your purchase of
                a course, it can be done in the following way: By sending a cancellation email to
                info@training4employment.co.uk.</p>
        </div>
        <div class="bgbargray">
            <div class="bgBar" style="width:100%;margin:10px 0px;">Terms and Conditions</div>
            <p style="margin: 0;">Our aim is to make it as easy as possible to learn and relate subjects with Training
                4 Employment Ltd.
            </p>
            <p style="margin: 0;">
                1. BOOKINGS AND ENROLMENT:

                1.1. Bookings may be made via e-mail, T4E website, telephone, or in person.

                1.2. Registration for a course is not guaranteed until we have received full course fee or deposit
                payment (if applicable) and required paperwork has been complete by a delegate. Placement in the course
                will be confirmed via E-mail by a member of T4E staff.
            </p>
            <p style="margin: 0;">
                2. DEPOSIT AND PAYMENT:

                2.1. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform
                us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for
                the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.
            </p>
            <p style="margin: 0;">
                3. COURSE ATTENDANCE& RESCHEDULING:

                3.1. 100% attendance is a must. If you fail to attend without notice or arrive late for the course, the
                tutor will refuse your place on the course due to the amount of content missed, you will not be entitled
                to a refund.

                3.2. Once a course has commenced, the delegate must attend all sessions necessary to complete the course
                the course cannot be completed later. You will not be entitled to any refund for any absence.

                3.3. If you are absent from any session, we reserve the right to refuse to accept you for training and
                the full course fee remains payable.

                3.4. Training4Employment will review each absence and any reasons given for that absence. If the
                delegate was unable to attend due to exceptional circumstances, then Training4Employment may offer a new
                course start date. Training4Employment will require you to provide supporting documents to prove the
                exceptional circumstances alleged.

                3.5. If you do not reschedule your course 72 hours before it starts or fail to attend the course you
                have booked, regardless of the package you have purchased, you will be required to pay for a new booking
                if you wish to take the course in the future.

                3.6. If you are unable to attend on the scheduled course date, you must notify us at least 72 hours
                before your course starts. If your course is starting within 72 hours, you will be charged the standard
                reschedule fee (please see section 7).

                3.7. It is a legal requirement to always have ID on you during your training. If you do not bring the
                required IDs and any other required documents, you will need to be rescheduled onto another course and
                you will be charged a rescheduling fee (please see section 7).

                3.8. If a course is cancelled by T4E, you will be advised at the earliest possible opportunity and
                arrangements will be made for your course to be rearranged or the course fee to be refunded. This may
                occur at very short notice, in particular if the minimum number of participants has not been reached.

                4. HOUSEKEEPING:

                4.1. Abuse towards staff and other trainees will not be tolerated, you will be taken off the course and
                no refund.
            </p>
            <p style="margin: 0;">
                5. CERTIFICATION:

                5.1. Due to COVID-19 pandemic, we are only able to supply delegates with e-certificates

                5.2. You will receive your e-certificate to the email provided when booking

                5.3. Your e-certificate will be emailed 3-5 working days after you have received your results.

                5.4. Results may take from 7 to 14 working days.
            </p>
            <p style="margin: 0;">
                6. EXAM RETAKES:

                6.1. SIA Security Training Courses:

                6.1.1. Sor SIA Security Training Courses there are 2 free retakes applicable.

                6.1.2. Retake exams will be held within 2 – 3 weeks of us receiving exam papers.

                6.1.3. Video recordings of delegates will be taken in the duration of the course for the purposes of the
                delegates practical examinations.
            </p>
            <p style="margin: 0;">
                6.2. Construction Courses:

                6.2.1. For all construction courses there is 1 free retake applicable.

                6.2.2. The examination can either be retaken on the same day or the delegate can attend another course
                within a 90-day period (the delegate is not obliged to re-sit the day’s course).

                6.2.3. Delegates must attend a full CITB course again before they are allowed to retake the examination
                if they score less than in the original exam:

                6.2.3.1. 60% for CSCS HAS Course

                6.2.3.2. 67% for SSSTS / SSSTS Course

                6.2.3.3. 69% for SMSTS / SMSTS-R Courses
            </p>
            <p style="margin: 0;">
                6.3. Other Courses:

                6.3.1. No Pass No resit Fee applicable to the following courses:

                6.3.1.1. First Aid at Work

                6.3.1.2. Emergency First Aid at Work

                6.3.1.3. Traffic Marshall, Vehicle Banksman
            </p>
            <p style="margin: 0;">
                7. RESCHEDULING FEES:

                7.1. SIA Door Supervisor | SIA CCTV courses – £80

                7.2. SIA Door Supervisor Top Up | SIA Security Guard Top Up courses – £60

                7.3. Emergency First Aid at Work | Paediatric Emergency First Aid courses – £40

                7.4. First Aid at Work | Paediatric First Aid Courses – £60

                7.5. Health and Safety Awareness (HAS) course – £60

                7.6. SSTS| SSTS-R | SMSTS | SMSTS-R courses – £80

                7.7. All Utility & Energy courses – £80

                7.8. Fire Safety courses – £60

                7.9. Traffic Marshal, Vehicle Banksman Course – £20.
            </p>
            @if ($formData['term'])
                <p style="margin: 0;"><img src="{{ $checkedSrc }}"
                        style="width:10px;height:10px;object-fit:contain;" /> I confirm that I have read the Terms &
                    Conditions and fully understand the contents therein and further confirm that I shall be responsible
                    for my and any fees applicable as set out in the Terms & Conditions.</p>
            @endif
        </div>
    </div>
    {{-- @endforeach --}}
    {{-- <h1>Form Submission</h1>
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        @foreach ($formData as $field => $value)
            @if ($field !== 'signature')
                <tr>
                    <td>{{ ucwords(str_replace('_', ' ', $field)) }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endif
        @endforeach
    </table> --}}
</body>

</html>
