@extends('layouts.frontend')
@section('title', 'Booking Terms and Conditions')

@section('main')
    <div class="bookingTermCondition">
        <section class="pageHeaderSec position-relative">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-8 col-xl-8 d-lg-none d-md-none d-xl-none mblCol">
                    <img src="{{ asset('frontend/img/Shop-page-v3_03.jpg') }}" class="img-fluid" alt="Shop page">
                </div>
                <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-4 mblColContent">
                    <div class="pageHeaderTitle pl-0 pl-md-3 pl-lg-4 pl-xl-5 ml-0 ml-sm-0 ml-md-0 ml-lg-0 ml-xl-4">
                        <h1>Booking Terms and Conditions</h1>
                        <p class="my-4 h5">Clear Guidelines to Ensure a Smooth Booking Experience</p>
                        <p>We have 24 hours refund policy</p>
                        <div class="d-flex align-items-center">
                            <a href="{{route('contact')}}" class="btnWhite">Contact Us</a>
                            <a href="{{ route('courses.index') }}" class="btnSimple ml-4">Book Course Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7 col-lg-8 d-none d-lg-block d-md-block d-xl-block" data-aos="fade-left"
                    style="background:url({{ asset('frontend/img/Shop-page-v3_03.jpg') }}) no-repeat center/cover;"></div>
            </div>
        </section>
        <section class="contentWrapper pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4" data-aos="fade-right">
                        <div class="tableOfContent mb-4">
                            <h3>Table of Contents</h3>
                            <ol class="pl-4 m-0">
                                <li><a href="#bookings-and-enrolment">Bookings and Enrolment:</a></li>
                                <li><a href="#deposit-and-payment">Deposit And Payment:</a></li>
                                <li><a href="#course-attendanceand-rescheduling">Course Attendance& Rescheduling:</a></li>
                                <li><a href="#housekeeping">Housekeeping:</a></li>
                                <li><a href="#certification">Certification:</a></li>
                                <li><a href="#exam-retakes">Exam Retakes:</a></li>
                                <li><a href="#rescheduling-fees">Rescheduling Fees:</a></li>
                                <li><a href="#guidelines-for-candidates-and-employers">Guidelines For Candidates & Employers:</a></li>
                                <li><a href="#purchases-made-from-reedcouk">Purchases Made From Reed.co.uk:</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8" data-aos="fade-left">
                        <div class="content">
                            <p>Our aim is to make it as easy as possible to learn and relate subjects with Training for
                                Employment Ltd.</p>
                            <article id="bookings-and-enrolment" class="my-5">
                                <h2>1. Bookings and Enrolment:</h2>
                                <p class="m-0">1.1. Bookings may be made via e-mail, T4E website, telephone, or in
                                    person.</p>
                                <p class="m-0">1.2. Registration for a course is not guaranteed until we have received
                                    full course fee or deposit payment (if applicable) and required paperwork has been
                                    complete by a delegate. Placement in the course will be confirmed via E-mail by a member
                                    of T4E staff.</p>
                            </article>
                            <article id="deposit-and-payment" class="my-5">
                                <h2>2. Deposit And Payment:</h2>
                                <p class="m-0">2.1. Our courses are non-refundable 24 hours after booking. You can
                                    receive a full refund if you inform us within 24 hours of booking of your intention to
                                    cancel, and you will be refunded the amount paid for the course. Courses cancelled after
                                    24 hours of booking will not be eligible for a refund.</p>
                            </article>
                            <article id="course-attendanceand-rescheduling" class="my-5">
                                <h2>3. Course Attendance& Rescheduling:</h2>
                                <p class="m-0">3.1. 100% attendance is a must. If you fail to attend without notice or
                                    arrive late for the course, the tutor will refuse your place on the course due to the
                                    amount of content missed, you will not be entitled to a refund.<br>
                                    3.2. Once a course has commenced, the delegate must attend all sessions necessary to
                                    complete the course the course cannot be completed later. You will not be entitled to
                                    any refund for any absence.<br>
                                    3.3. If you are absent from any session, we reserve the right to refuse to accept you
                                    for training and the full course fee remains payable.<br>
                                    3.4. Training4Employment will review each absence and any reasons given for that
                                    absence. If the delegate was unable to attend due to exceptional circumstances, then
                                    Training4Employment may offer a new course start date. Training4Employment will require
                                    you to provide supporting documents to prove the exceptional circumstances alleged.<br>
                                    3.5. If you do not reschedule your course 72 hours before it starts or fail to attend
                                    the course you have booked, regardless of the package you have purchased, you will be
                                    required to pay for a new booking if you wish to take the course in the future.<br>
                                    3.6. If you are unable to attend on the scheduled course date, you must notify us at
                                    least 72 hours before your course starts. If your course is starting within 72 hours,
                                    you will be charged the standard reschedule fee (please see section 7).<br>
                                    3.7. It is a legal requirement to always have ID on you during your training. If you do
                                    not bring the required IDs and any other required documents, you will need to be
                                    rescheduled onto another course and you will be charged a rescheduling fee (please see
                                    section 7).<br>
                                    3.8. If a course is cancelled by T4E, you will be advised at the earliest possible
                                    opportunity and arrangements will be made for your course to be rearranged or the course
                                    fee to be refunded. This may occur at very short notice, in particular if the minimum
                                    number of participants has not been reached.</p>
                            </article>
                            <article id="housekeeping" class="my-5">
                                <h2>4. Housekeeping:</h2>
                                <p class="m-0">4.1. Abuse towards staff and other trainees will not be tolerated, you
                                    will be taken off the course and no refund.</p>
                            </article>
                            <article id="certification" class="my-5">
                                <h2>5. Certification:</h2>
                                <p class="m-0">5.1. Due to COVID-19 pandemic, we are only able to supply delegates
                                    with e-certificates<br>
                                    5.2. You will receive your e-certificate to the email provided when booking<br>
                                    5.3. Your e-certificate will be emailed 3-5 working days after you have received
                                    your results.
                                    5.4. Results may take from 7 to 14 working days.</p>
                            </article>
                            <article id="exam-retakes" class="my-5">
                                <h2>6. Exam Retakes:</h2>
                                <strong>6.1. SIA Security Training Courses:</strong> <br>6.1.1. Sor SIA Security
                                Training Courses there are 2 free retakes applicable. <br>6.1.2. Retake exams will be
                                held within 2 – 3 weeks of us receiving exam papers. <br>6.1.3. Video recordings of
                                delegates will be taken in the duration of the course for the purposes of the delegates
                                practical examinations.<p></p>
                                <p><strong>6.2. Construction Courses:</strong> <br>6.2.1. For all construction courses
                                    there is 1 free retake applicable.<br>6.2.2. The examination can either be retaken
                                    on the same day or the delegate can attend another course within a 90-day period
                                    (the delegate is not obliged to re-sit the day’s course).<br>6.2.3. Delegates must
                                    attend a full CITB course again before they are allowed to retake the examination if
                                    they score less than in the original exam: <br>6.2.3.1. 60% for CSCS HAS Course
                                    <br>6.2.3.2. 67% for SSSTS / SSSTS Course 6.2.3.3. 69% for SMSTS / SMSTS-R Courses
                                </p>
                                <p><strong>6.3. Other Courses:</strong> <br>6.3.1. No Pass No resit Fee applicable to
                                    the following courses: <br>6.3.1.1. First Aid at Work <br>6.3.1.2. Emergency First
                                    Aid at Work <br>6.3.1.3. Traffic Marshall, Vehicle Banksman </p>
                            </article>
                            <article id="rescheduling-fees" class="my-5">
                                <h2>7. Rescheduling Fees:</h2>
                                <p class="m-0">
                                    7.1. SIA Door Supervisor | SIA CCTV courses – £80<br>
                                    7.2. SIA Door Supervisor Top Up | SIA Security Guard Top Up courses – £60<br>
                                    7.3. Emergency First Aid at Work | Paediatric Emergency First Aid courses – £40<br>
                                    7.4. First Aid at Work | Paediatric First Aid Courses – £60<br>
                                    7.5. Health and Safety Awareness (HAS) course – £60<br>
                                    7.6. SSTS| SSTS-R | SMSTS | SMSTS-R courses – £80<br>
                                    7.7. All Utility &amp; Energy courses – £80<br>
                                    7.8. Fire Safety courses – £60<br>
                                    7.9. Traffic Marshal, Vehicle Banksman Course – £20.
                                </p>
                            </article>
                            <article id="guidelines-for-candidates-and-employers" class="my-5">
                                <h2>8. Guidelines For Candidates & Employers:</h2>
                                <p class="m-0">8.1 Training for Employment courses can be physically demanding. It is the employer’s responsibility to ensure that candidates are free from any condition which would affect their capability, and that they have the aptitude to cope with an intensive course of study. (We welcome candidates with disabilities for training, but it remains their employer’s responsibility to ensure that they are appropriately supported in their workplace.)</p>
                            </article>
                            <article id="purchases-made-from-reedcouk" class="my-5">
                                <h2>9. Purchases Made From Reed.co.uk:</h2>
                                <p class="m-0">9.1 You may cancel your purchase of the course within the period of 14 calendar days from the date on which the contract of purchase is concluded. This is called a “Cancellation Period”. Note that if you redeem your voucher during the Cancellation Period, you expressly request us to begin providing the course materials and you acknowledge that you lose your right to cancel the purchase of the course and get any refund for it. In case you decide to cancel your purchase of a course, it can be done in the following way: By sending a cancellation email to info@training4employment.co.uk.</p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
            $(window).on('load', function() {
                AOS.refresh();
            });
        });
    </script>
@endpush
