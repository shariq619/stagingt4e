@extends('layouts.frontend')
@section('title', 'Become a Partner')
@section('main')
    <div class="referFriendPage">
        <section class="referFriendBanner py-5 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 offset-xl-6 offset-lg-6 offset-md-6 offset-0 referFriendSectionColumn"
                        data-aos="fade-left">
                        <div class="referFriendBannerDesc position-relative">
                            <p class="bannerSubTitle mb-5">Refer 5 friends a week and earn up to £1,246 per month.</p>
                            <h1 class="mb-5"><strong>Become a Partner – Earn 10% Commission with Every Referral!</strong>
                            </h1>
                            <p class="mb-4">Looking to earn a second income while helping others succeed in the security industry? Join
                                Training 4 Employment’s (T4E) Partner Program and start earning 10% commission for every
                                successful referral. Share access to top-rated SIA training courses, including SIA Security,
                                Door Supervisor, and CCTV Operator programs, and turn your referrals into rewards with this
                                fantastic 'refer and earn' opportunity.</p>
                            <div class="mt-5 referBannerBtn">
                                <a href="#referFriend">Join now to start building a second income <i
                                        class="fas fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="partnerProgram py-5 mb-5 mt-4">
            <div class="container">
                <h2 class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2" data-aos="fade-down">How Our Partner Program Works</h2>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" data-aos="fade-right">
                        <div class="partnerProgramBox text-center">
                            <img src="{{ asset('frontend/img/high-five.png') }}" class="img-fluid" alt="Refer a Friend">
                            <div class="px-0 px-lg-4 px-md-3 px-xl-4">
                                <h3 class="mt-3 my-5">Refer a Friend</h3>
                                <p>Simply refer someone you know who is interested in building a career in security. They
                                    can choose from various SIA training programs, including SIA Security, SIA Door
                                    Supervisor, and SIA CCTV courses.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" data-aos="fade-up">
                        <div class="partnerProgramBox text-center">
                            <img src="{{ asset('frontend/img/connections.png') }}" class="img-fluid" alt="T4E Contacts Your Referral">
                            <div class="px-0 px-lg-4 px-md-3 px-xl-4">
                                <h3 class="mt-3 my-5">T4E Contacts Your Referral</h3>
                                <p>After you refer a potential candidate, we will follow up with them to provide all the
                                    necessary information about our SIA training courses and guide them through the
                                    enrolment process.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" data-aos="fade-left">
                        <div class="partnerProgramBox text-center">
                            <img src="{{ asset('frontend/img/coin.png') }}" class="img-fluid" alt="Earn a 10% Commission">
                            <div class="px-0 px-lg-4 px-md-3 px-xl-4">
                                <h3 class="mt-3 my-5">Earn a 10% Commission</h3>
                                <p>When your referral completes their course, you’ll receive a 10% commission on the course
                                    fee. For example, with an SIA Door Supervisor course costing £215.83, you’ll earn £21.58
                                    per completed referral.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="partnerProgramBtn text-center mt-5" data-aos="fade-down">
                    <a href="https://forms.office.com/e/HdEDCM80BU" target="_blank" class="btnPartner d-inline-block">Refer
                        a Friend Now! <i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
        </section>
        <section class="whyJoin py-5" id="referFriend">
            <div class="container">
                <h2 class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2" data-aos="fade-up">Why Join Our Partner Program?</h2>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" data-aos="fade-down">
                        <div class="whyJoinBox text-center">
                            <img src="{{ asset('frontend/img/Refer-a-Friend-steps.svg') }}" width="150" height="150"
                                class="img-fluid" alt="Unlimited Referrals, Unlimited Earnings">
                            <div class="px-0 px-lg-4 px-md-3 px-xl-4">
                                <h3 class="my-4 h5">Unlimited Referrals, Unlimited Earnings</h3>
                                <p>There’s no cap on how many people you can refer. More referrals mean more income
                                    opportunities.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" data-aos="fade-down">
                        <div class="whyJoinBox text-center">
                            <img src="{{ asset('frontend/img/Become-a-Partner-Reliable-Finance.svg') }}" width="150"
                                height="150" class="img-fluid" alt="Reliable Payments">
                            <div class="px-0 px-lg-4 px-md-3 px-xl-4">
                                <h3 class="my-4 h5">Reliable Payments</h3>
                                <p>Receive your commission payment within 10 working days of the course completion.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" data-aos="fade-down">
                        <div class="whyJoinBox text-center">
                            <img src="{{ asset('frontend/img/Become-a-Partner-Flexible-Payment.svg') }}" width="150"
                                height="150" class="img-fluid" alt="Easy & Flexible">
                            <div class="px-0 px-lg-4 px-md-3 px-xl-4">
                                <h3 class="my-4 h5">Easy & Flexible</h3>
                                <p>With no strict eligibility requirements, anyone can join. Simply share our SIA training
                                    options with others to start earning.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" data-aos="fade-down">
                        <div class="whyJoinBox text-center">
                            <img src="{{ asset('frontend/img/Become-a-Partner-Suport.svg') }}" width="150" height="150"
                                class="img-fluid" alt="Support & Resources">
                            <div class="px-0 px-lg-4 px-md-3 px-xl-4">
                                <h3 class="my-4 h5">Support & Resources</h3>
                                <p>T4E provides the tools and support you need to make referring easy and effective.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="earnings py-5">
            <h2 class="text-center mb-4 mt-4 px-3 px-lg-0 px-xl-0 fs2" data-aos="fade-right">Potential Earnings Calculation</h2>
            <p class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 mt-3 mt-md-5 mt-lg-5 mt-xl-5" data-aos="fade-left"><strong>If you refer 5 people
                    each week to each course, your monthly earnings could be:</strong></p>
            <div class="container pb-5">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3" data-aos="fade-right">
                        <div class="earningInner h-100">
                            <h4 class="mb-4">SIA Door Supervisor Course</h4>
                            <ul class="list-unstyled p-0 m-0">
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Course Fee excl. VAT:</strong>
                                    <u>£215.83</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Commission per Referral:</strong>
                                    <u>£215.83 x 10% = £21.58</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Weekly Earnings (5
                                        referrals):</strong> <u>£21.58 x 5 people = £107.90</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Monthly Earnings:</strong> <u>£107.90
                                        x 4 = <strong>£431.60</strong></u>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3" data-aos="fade-left">
                        <div class="earningInner h-100">
                            <h4 class="mb-4">SIA CCTV Operator, Public Surveillance Course</h4>
                            <ul class="list-unstyled p-0 m-0">
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Course Fee excl. VAT:</strong>
                                    <u>£165.83</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Commission per Referral:</strong>
                                    <u>£165.83 * 10% = £16.58</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Weekly Earnings (5
                                        referrals):</strong> <u>£16.58 * 5 people = £82.900</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Monthly Earnings:</strong> <u>£82.90
                                        *
                                        4 weeks = <strong>£331.60</strong></u>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3" data-aos="fade-right">
                        <div class="earningInner h-100">
                            <h4 class="mb-4">SIA Door Supervisor Top-Up Course</h4>
                            <ul class="list-unstyled p-0 m-0">
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Course Fee excl. VAT:</strong>
                                    <u>£120.83</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Commission per Referral:</strong>
                                    <u>£120.83 * 10% = £12.08</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Weekly Earnings (5
                                        referrals):</strong> <u>£12.08 * 5 people = £60.40</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Monthly Earnings:</strong> <u>£60.40
                                        * 4 = <strong>£241.60</strong></u>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3" data-aos="fade-left">
                        <div class="earningInner h-100">
                            <h4 class="mb-4">Health and Safety Awareness (HSA) Course</h4>
                            <ul class="list-unstyled p-0 m-0">
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Course Fee excl. VAT:</strong>
                                    <u>£120.83</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Commission per Referral:</strong>
                                    <u>£120.83 * 10% = £12.08</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Weekly Earnings (5
                                        referrals):</strong> <u>£12.08 * 5 people = £60.40</u>
                                </li>
                                <li class="mb-4">
                                    <i class="fas fa-angle-double-right"></i> <strong>Monthly Earnings:</strong> <u>£60.40
                                        * 4 weeks = <strong>£241.60</strong></u>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center mb-5 mt-4" data-aos="fade-up"><strong>Total Potential Monthly Earnings (if referring 5 people weekly to each
                    course): £1,246.40</strong></p>
            <div class="partnerProgramBtn text-center pb-5" data-aos="fade-up">
                <a href="https://forms.office.com/e/HdEDCM80BU" target="_blank" class="btnPartner d-inline-block">Start
                    Refering <i class="fas fa-angle-double-right"></i></a>
            </div>
        </section>
        <section class="clientReviews py-5" data-aos="fade-down">
            <div class="container py-5">
                <h2 class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2 text-white">What Our Learners Say?</h2>
                <script defer async src='https://cdn.trustindex.io/loader.js?34690d4371cd5966f966569d8e0'></script>
            </div>
        </section>
        <section class="referFriendFaqs py-5" data-aos="fade-up">
            <div class="container pb-5">
                <h2 class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">Got a Question?</h2>
                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="accordionFaqs">
                                <div class="card active">
                                    <div class="card-header" id="acc1">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse1"
                                                aria-expanded="true" aria-controls="collapse1">
                                                <span>How much can I earn as a T4E Partner?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse1" class="collapse show" aria-labelledby="acc1"
                                        data-parent="#accordionFaqs">
                                        <p>All our training courses are held at the 89-91 Hatchett Street, Birmingham, West
                                            Midlands, B19 3NY. The venue is easily accessible by public transport and offers
                                            a comfortable learning environment.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc2">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse2"
                                                aria-expanded="true" aria-controls="collapse2">
                                                <span>What courses can I refer people to?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse2" class="collapse" aria-labelledby="acc2"
                                        data-parent="#accordionFaqs">
                                        <p>You can refer individuals to most of our popular training programs, including SIA
                                            Door Supervisor, SIA CCTV Operator, SIA Door Supervisor Top-Up, and Health and
                                            Safety Awareness (HSA) courses. Any open courses priced above £100 qualify for
                                            referral commission, providing you with plenty of opportunities to earn.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc3">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse3"
                                                aria-expanded="true" aria-controls="collapse3">
                                                <span>How and when will I receive my commission?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse3" class="collapse" aria-labelledby="acc3"
                                        data-parent="#accordionFaqs">
                                        <p>Once a referred user completes their course, your 10% commission will be paid
                                            within 10 working days. You’ll receive an email notification once the referral
                                            completes their course, and the payment will be processed to your chosen payment
                                            method.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc4">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse4"
                                                aria-expanded="true" aria-controls="collapse4">
                                                <span>Are there any limitations or restrictions?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse4" class="collapse" aria-labelledby="acc4"
                                        data-parent="#accordionFaqs">
                                        <p>Yes, please be aware of the following:</p>
                                        <ul>
                                            <li>Self-referrals are not permitted—you cannot refer yourself to earn a
                                                commission.</li>
                                            <li>If a referred user cancels or requests a refund, you will not qualify for
                                                the commission on that referral.</li>
                                            <li>The user must complete their course and remit full payment for your
                                                commission to apply.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="accordionFaqs">
                                <div class="card">
                                    <div class="card-header" id="acc5">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse5"
                                                aria-expanded="true" aria-controls="collapse5">
                                                <span>Can T4E modify the terms of the partner program?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse5" class="collapse" aria-labelledby="acc5"
                                        data-parent="#accordionFaqs">
                                        <p>Yes, T4E reserves the right to change the program terms, commission rates, or
                                            course eligibility, or to discontinue the program at any time without prior
                                            notice. Any such changes will be communicated to our partners whenever possible.
                                        </p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc6">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse6"
                                                aria-expanded="true" aria-controls="collapse6">
                                                <span>How does the “Refer and Earn” process work?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse6" class="collapse" aria-labelledby="acc6"
                                        data-parent="#accordionFaqs">
                                        <p>The process is simple: refer individuals to our eligible courses, and we’ll
                                            handle enrolment. Once your referral pays in full and completes the course, your
                                            10% commission is processed within 10 working days.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc6">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse7"
                                                aria-expanded="true" aria-controls="collapse7">
                                                <span>Where can I find the complete terms and conditions?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse7" class="collapse" aria-labelledby="acc6"
                                        data-parent="#accordionFaqs">
                                        <p>By joining the T4E Partner Program, you agree to all terms outlined in the Become
                                            a Business Partner Terms and Conditions included in Application Form. Please
                                            review these terms to understand the complete details of eligibility and
                                            commission guidelines.</p>
                                    </div>
                                </div>
                            </div>
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
    <script>
        $(document).ready(function() {
            $(document).on('click', '.toggaleAccordion .card', function() {
                $('.toggaleAccordion .card').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endpush
