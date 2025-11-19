@extends('layouts.frontend')

@section('title', 'Faqs')

@section('main')
    <div class="faqsPage">
        <section class="pageHeaderMain">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8" data-aos="fade-right">
                        <div class="pageHeaderTitle">
                            <h1>Faqs</h1>
                            {{--                            <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vestibulum --}}
                            {{--                                aliquam pretium. Ut in dignissim dolor. Praesent convallis euismod turpis, condimentum --}}
                            {{--                                condimentum erat faucibus vitae.</p> --}}
                            <ul class="m-0 p-0 list-unstyled d-flex align-items-center">
                                <li class="mr-2"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="mr-2"><i class="fa-solid fa-angles-right"></i></li>
                                <li class="mr-2"><a href="javascript:;">Faqs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="referFriendFaqs py-5" data-aos="fade-up">
            <div class="container">
                <h2 class="mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">GENERAL</h2>
                <div class="row" data-aos="fade-right">
                    <div class="col-12">
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="accordionFaqs">
                                <div class="card active">
                                    <div class="card-header" id="acc1">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse1"
                                                aria-expanded="true" aria-controls="collapse1">
                                                <span>Is the cost of an SIA licence included in the price of the course? And
                                                    can you help me apply?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse1" class="collapse show" aria-labelledby="acc1"
                                        data-parent="#accordionFaqs">
                                        <p>No, the licence fee is a separate price. Payment for the license is £190.00 which
                                            is payable to the SIA (Security Industry Authority) this can be paid online on
                                            their website or at the Post Office.</p>
                                        <p>Yes, our members of staff are more than happy to help you apply for your SIA
                                            badge, call to book an appointment and there will be a £20 fee.
                                        </p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc2">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse2"
                                                aria-expanded="true" aria-controls="collapse2">
                                                <span>Do I have to pay before the course starts?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse2" class="collapse" aria-labelledby="acc2"
                                        data-parent="#accordionFaqs">
                                        <p>We require a minimum of £50 deposit on booking, the remaining amount to be paid
                                            on the first day of the course.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc3">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse3"
                                                aria-expanded="true" aria-controls="collapse3">
                                                <span>Can I pay by debit or credit card?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse3" class="collapse" aria-labelledby="acc3"
                                        data-parent="#accordionFaqs">
                                        <p>Yes you can pay using your credit card or debit card on the website or over the
                                            phone. You can alternatively make payment at our main office.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc4">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse4"
                                                aria-expanded="true" aria-controls="collapse4">
                                                <span>Do I need to bring ID? If so what do I need to bring?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse4" class="collapse" aria-labelledby="acc4"
                                        data-parent="#accordionFaqs">
                                        <p>For exam purposes you must bring with you:</p>
                                        <h6><strong>Two items of identification:</strong></h6>
                                        <p>2 Items from Group A below (at least one document must show your current address
                                            and one showing your date of birth) or 1 item from Group A and 2 items from
                                            Group B.</p>
                                        <h6><strong>Group A</strong></h6>
                                        <ul>
                                            <li>Signed valid passport of any nationality.</li>
                                            <li>Driving Licence photocard if it was issued by the DVLA in Great Britain. We
                                                will not accept the photocard on its own if it was issued by the DVA in
                                                Northern Ireland.</li>
                                            <li>Driving Licence photocard and its paper counterpart issued by the DVA in
                                                Northern Ireland.</li>
                                            <li>UK original birth certificate issued within 12 months of birth.</li>
                                            <li>UK Biometric Residence Permit.</li>
                                        </ul>
                                        <h6><strong>Group B</strong></h6>
                                        <ul>
                                            <li>Documents that confirm your identity and your address:</li>
                                            <li>Valid UK firearms license with photo.</li>
                                            <li>Current UK driving licence – paper version(not the paper counterpart to a
                                                photocard).</li>
                                            <li>P45 statement of income for tax purposes on leaving a job issued in the last
                                                12 months.</li>
                                            <li>P60 annual statement of income for tax purposes issued in the last 12
                                                months.</li>
                                            <li>Bank or building society statement issued to your current address, less than
                                                three old. You can use more than one statement as long as each is issued by
                                                a different bank or a building society.</li>
                                            <li>Mortgage statement issued in the last 12 months.</li>
                                            <li>Utility bill (gas, electric, telephone, water, satellite, cable,) issued to
                                                your current address within the last three months. You can only submit one
                                                utility bill in support of your SIA application (mobile phone contracts are
                                                NOT accepted).</li>
                                            <li>Pension, endowment or ISA statement issued in last 12 months.</li>
                                            <li>Letter from H.M. Revenue &amp; Customs, Department of Work and Pensions,
                                                employment service, or local authority issued within the last three months.
                                                You can use more than one letter as long as each is issued by a different
                                                Government department or a different local authority.</li>
                                            <li>A credit card statement sent to your current address within the last three
                                                months. You can use more than one statement as long as each is issued by a
                                                different issuer.</li>
                                            <li>Council Tax statement issued in the last 12 months. <a
                                                    href="https://www.gov.uk/guidance/apply-for-an-sia-licence#check-you-have-the-right-document"
                                                    target="_blank" rel="noopener noreferrer">Read more</a>.</li>
                                            <li>TWO passport-sized good quality colour photographs as normally specified for
                                                passports.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc5">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse5"
                                                aria-expanded="true" aria-controls="collapse5">
                                                <span>I do not have the correct ID. Can I still take the course?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse5" class="collapse" aria-labelledby="acc5"
                                        data-parent="#accordionFaqs">
                                        <p>Failure to bring valid, original, correct identification, and photographs as
                                            specified will result in no examination.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc6">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse6"
                                                aria-expanded="true" aria-controls="collapse6">
                                                <span>Do I need to bring photos?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse6" class="collapse" aria-labelledby="acc6"
                                        data-parent="#accordionFaqs">
                                        <p>Yes, we require 2 passport size pictures.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc6">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse7"
                                                aria-expanded="true" aria-controls="collapse7">
                                                <span>Is there any food provided?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse7" class="collapse" aria-labelledby="acc6"
                                        data-parent="#accordionFaqs">
                                        <p>Unfortunately, food is not provided.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc7">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse8"
                                                aria-expanded="true" aria-controls="collapse8">
                                                <span>Is there free parking available?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse8" class="collapse" aria-labelledby="acc7"
                                        data-parent="#accordionFaqs">
                                        <p>Yes, free parking with limited space. </p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc8">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse9"
                                                aria-expanded="true" aria-controls="collapse9">
                                                <span>Do you provide all stationery?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse9" class="collapse" aria-labelledby="acc8"
                                        data-parent="#accordionFaqs">
                                        <p>Yes, all stationery and learning materials are provided by the training centre.
                                        </p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc9">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse10"
                                                aria-expanded="true" aria-controls="collapse10">
                                                <span>Can I cancel my booking before the course begins?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse10" class="collapse" aria-labelledby="acc9"
                                        data-parent="#accordionFaqs">
                                        <p>Deposit and payments are not refundable. Once your booking is made, we will start
                                            to provide services to you by ordering the course materials. You can only make a
                                            use of our Free Transfers Policy.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc10">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse11"
                                                aria-expanded="true" aria-controls="collapse11">
                                                <span>My name is spelt wrong on the certificate, what do I do?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse11" class="collapse" aria-labelledby="acc10"
                                        data-parent="#accordionFaqs">
                                        <p>If your name is spelt incorrectly on your certificate, please contact us and we
                                            will forward your query to our Awarding body. Name changes can take between 3-4
                                            working days to be resolved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-left">
                    <div class="col-12">
                        <h2 class="mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">SIA Door Supervisor Course</h2>
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="siaDsCFaqs">
                                <div class="card active">
                                    <div class="card-header" id="acc1">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse1"
                                                aria-expanded="true" aria-controls="collapse1">
                                                <span>What qualification do you need to be a Door Supervisor?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse1" class="collapse show" aria-labelledby="acc1"
                                        data-parent="#siaDsCFaqs">
                                        <p>You’ll need to do the Level 2 Award for working as a Door Supervisor within the
                                            Private Security Industry, to get a front line licence, which is issued by the
                                            Security Industry Authority. You’ll need to complete 4 training modules and pass
                                            the exams.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc2">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse2"
                                                aria-expanded="true" aria-controls="collapse2">
                                                <span>Do I have to complete any distance learning before attending the
                                                    training?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse2" class="collapse" aria-labelledby="acc2"
                                        data-parent="#siaDsCFaqs">
                                        <p>Yes, the Door Supervisor course includes distance learning which you must
                                            complete before you attend the classroom training.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc3">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse3"
                                                aria-expanded="true" aria-controls="collapse3">
                                                <span>How long does Door Supervisor Certificate last?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse3" class="collapse" aria-labelledby="acc3"
                                        data-parent="#siaDsCFaqs">
                                        <p>Three years. Once a qualification is achieved, it is then valid to use to apply
                                            for the licence for three years.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc4">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse4"
                                                aria-expanded="true" aria-controls="collapse4">
                                                <span>What's the difference between door supervisor and security
                                                    guard?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse4" class="collapse" aria-labelledby="acc4"
                                        data-parent="#siaDsCFaqs">
                                        <p>Door supervisors:</p>
                                        <p>Those who carry out security duties in or at licensed premises, like pubs and
                                            nightclubs, preventing crime and disorder and keeping staff and customers safe
                                        </p>
                                        <p>Security officers (guarding):</p>
                                        <p>Those who guard premises against unauthorised access or occupation, outbreaks of
                                            disorder, theft or damage</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc5">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse5"
                                                aria-expanded="true" aria-controls="collapse5">
                                                <span>When will I receive my certificate?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse5" class="collapse" aria-labelledby="acc5"
                                        data-parent="#siaDsCFaqs">
                                        <p>Certificates are usually sent to your email 3 days after successfully passed the
                                            examination . </p>
                                        <p>Please note, you don’t need a certificate to apply for your SIA Licence.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc6">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse6"
                                                aria-expanded="true" aria-controls="collapse6">
                                                <span>Is the first aid qualification needed to do the SIA Door Supervisor
                                                    course?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse6" class="collapse" aria-labelledby="acc6"
                                        data-parent="#siaDsCFaqs">
                                        <p>Yes, from August 2021 it is an SIA requirement that training centres must confirm
                                            that each candidate is sufficiently qualified in First Aid or Emergency First
                                            Aid.</p>
                                        <p>Therefore, all candidates will need to show that they hold a current and valid
                                            First Aid or Emergency First Aid certificate that meets the requirements of the
                                            Health and Safety (First Aid) Regulations 1981.</p>
                                        <p>The First Aid or Emergency First Aid certificate must be valid for at least 12
                                            months from the course start date.</p>
                                        <p>You will need to present your First Aid or Emergency First Aid certificate to
                                            Training4Employment before you start SIA Door Supervisor training.</p>
                                        <p>If you don’t have a valid First Aid or Emergency First Aid certificate, we can
                                            offer you an<span>&nbsp;</span><a
                                                href="https://training4employment.co.uk/courses/emergency-first-aid-at-work/"
                                                target="_blank" rel="noopener noreferrer">Emergency First Aid Training
                                                Course</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-right">
                    <div class="col-12">
                        <h2 class="mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">SIA CCTV Operator Course</h2>
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="siaCCTVFaqs">
                                <div class="card active">
                                    <div class="card-header" id="acc1">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse1"
                                                aria-expanded="true" aria-controls="collapse1">
                                                <span>Who is this qualification for?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse1" class="collapse show" aria-labelledby="acc1"
                                        data-parent="#siaCCTVFaqs">
                                        <p>This qualification is designed for those learners wishing to apply for a licence
                                            from the Security Industry Authority (SIA) to work as a CCTV Operator in Public
                                            Space Surveillance.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc2">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse2"
                                                aria-expanded="true" aria-controls="collapse2">
                                                <span>How long is a CCTV course?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse2" class="collapse" aria-labelledby="acc2"
                                        data-parent="#siaCCTVFaqs">
                                        <p>The SIA CCTV Operator course runs over 3 days and is divided into 3 units:
                                            Working within the Private Security Industry. Working as a CCTV Operator within
                                            the Private Security Industry.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc3">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse3"
                                                aria-expanded="true" aria-controls="collapse3">
                                                <span>Does this course involve practical work with CCTV?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse3" class="collapse" aria-labelledby="acc3"
                                        data-parent="#siaCCTVFaqs">
                                        <p>Yes, this course involves hands-on experience working with CCTV systems.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc4">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse4"
                                                aria-expanded="true" aria-controls="collapse4">
                                                <span>Do I have to complete any distance learning before attending the
                                                    training?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse4" class="collapse" aria-labelledby="acc4"
                                        data-parent="#siaCCTVFaqs">
                                        <p>Yes, the CCTV Operator course includes distance learning which you must complete
                                            before you attend the classroom training.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc5">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse5"
                                                aria-expanded="true" aria-controls="collapse5">
                                                <span>How long does the CCTV Operator Certificate last?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse5" class="collapse" aria-labelledby="acc5"
                                        data-parent="#siaCCTVFaqs">
                                        <p>Three years. Once a qualification is achieved, it is then valid to use to apply
                                            for the licence for three years.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc6">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse6"
                                                aria-expanded="true" aria-controls="collapse6">
                                                <span>When will I receive my certificate?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse6" class="collapse" aria-labelledby="acc6"
                                        data-parent="#siaCCTVFaqs">
                                        <p>Certificates are usually sent to your email 3 days after successfully passed the
                                            examination .</p>
                                        <p>Please note, you don’t need a certificate to apply for your SIA Licence.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-left">
                    <div class="col-12">
                        <h2 class="mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">SIA LICENSING</h2>
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="siaLicensingFaqs">
                                <div class="card active">
                                    <div class="card-header" id="acc1">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse1"
                                                aria-expanded="true" aria-controls="collapse1">
                                                <span>I have a criminal record. Can I still get a licence?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse1" class="collapse show" aria-labelledby="acc1"
                                        data-parent="#siaLicensingFaqs">
                                        <p>The SIA will check your criminal record history for the last 5 years. If you have
                                            any convictions they will ask you to explain the circumstances and the SIA will
                                            decide whether to grant you a licence. Convictions within the last 12 months
                                            relating to violence, deception or theft are not usually considered acceptable.
                                            For more information, please visit the <a
                                                href="https://www.gov.uk/guidance/check-if-you-can-get-an-sia-licence-with-a-criminal-record"
                                                target="_blank" rel="noopener">SIA website</a>.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc2">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse2"
                                                aria-expanded="true" aria-controls="collapse2">
                                                <span>I have not lived in the country for the last 5 years. Is this a
                                                    problem?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse2" class="collapse" aria-labelledby="acc2"
                                        data-parent="#siaLicensingFaqs">
                                        <p>If you lived outside the UK, you need to provide evidence of a criminal record
                                            check from the country you lived in.</p>
                                        <p>If you have spent any periods of 6 continuous months or more outside the UK in
                                            the last 5 years, you will need to provide evidence of a criminal record check
                                            for each country you spent time in during each of these periods.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc3">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse3"
                                                aria-expanded="true" aria-controls="collapse3">
                                                <span>Can I still renew my licence after it expired?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse3" class="collapse" aria-labelledby="acc3"
                                        data-parent="#siaLicensingFaqs">
                                        <p>Your SIA licence will not renew automatically. You must <a
                                                href="https://services.sia.homeoffice.gov.uk/login/" target="_blank"
                                                rel="noopener">apply for a renewal</a> if you want to keep working in the
                                            same role when your current licence expires.</p>
                                        <p>You can apply to renew your licence four months before your current licence
                                            expires. You should submit your renewal application as soon as you can. Applying
                                            early gives us more time to process your application, which reduces the risk of
                                            you being unlicensed and unable to work.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc4">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse4"
                                                aria-expanded="true" aria-controls="collapse4">
                                                <span>How do I get a security licence in the UK?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse4" class="collapse" aria-labelledby="acc4"
                                        data-parent="#siaLicensingFaqs">
                                        <ol>
                                            <li>Complete and pass your SIA training
                                                course.</li>
                                            <li>Submit your licence
                                                application to the SIA.</li>
                                            <li>Complete the relevant check.</li>
                                            <li>As soon as your licence application is
                                                accepted you can start working.</li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc5">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse5"
                                                aria-expanded="true" aria-controls="collapse5">
                                                <span>Do I need my certificate to apply for SIA licence?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse5" class="collapse" aria-labelledby="acc5"
                                        data-parent="#siaLicensingFaqs">
                                        <p>No, you do not need your certificate to apply for the SIA Licence. Your details
                                            are passed on to the SIA when you pass the course.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-right">
                    <div class="col-12">
                        <h2 class="mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">SIA Security Guard Course</h2>
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="siaCGLCFaqs">
                                <div class="card active">
                                    <div class="card-header" id="acc1">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse1"
                                                aria-expanded="true" aria-controls="collapse1">
                                                <span>Who needs a Labourer/CSCS green card?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse1" class="collapse show" aria-labelledby="acc1"
                                        data-parent="#siaCGLCFaqs">
                                        <p><a href="https://www.cscs.uk.com/card-type/labourer/" target="_blank"
                                                rel="noopener"><strong>The Labourer Card</strong></a><span>&nbsp;</span>is
                                            designed for construction workers who have been employed to carry out various
                                            manual labour jobs on construction sites. It allows the workers to perform
                                            entry-level tasks on construction sites.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc2">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse2"
                                                aria-expanded="true" aria-controls="collapse2">
                                                <span>What does a Labourer card do?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse2" class="collapse" aria-labelledby="acc2"
                                        data-parent="#siaCGLCFaqs">
                                        <p><a href="https://www.cscs.uk.com/card-type/labourer/" target="_blank"
                                                rel="noopener"><strong>The Labourer
                                                    Card</strong></a><span>&nbsp;</span>confirms that the cardholder
                                            possesses the minimum required qualifications to work on the construction site
                                            and is competent with basic health and safety. While CSCS Cards are not legally
                                            required on all construction sites, the vast majority of employers do require
                                            them in order to allow workers on site.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc3">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse3"
                                                aria-expanded="true" aria-controls="collapse3">
                                                <span>What are the green CSCS card requirements?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse3" class="collapse" aria-labelledby="acc3"
                                        data-parent="#siaCGLCFaqs">
                                        <p>In order to apply for your green <a
                                                href="https://www.cscs.uk.com/card-type/labourer/" target="_blank"
                                                rel="noopener"><strong>Labourer Card</strong></a> you must be 16+ years old
                                            and have certain qualifications:</p>
                                        <ul>
                                            <li>You must have passed the <a
                                                    href="https://www.citb.co.uk/courses-and-qualifications/hse-test-and-cards/"
                                                    target="_blank" rel="noopener"><strong>CITB Health, Safety and
                                                        Environment test</strong></a>&nbsp;within the past two years.</li>
                                            <li>Complete the&nbsp;<strong><a
                                                        href="https://training4employment.co.uk/courses/health-and-safety-awareness-course"
                                                        target="_blank" rel="noopener">CSCS Labourer (Green Card) training
                                                        – Health and Safety Awareness (HSA)</a></strong>&nbsp;or an
                                                alternative qualification that CSCS accept. Also, you will need to attend a
                                                refresher course every 3 or 5 years.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-left">
                    <div class="col-12">
                        <h2 class="mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">First Aid Course</h2>
                        <div class="faqsInner">
                            <div class="accordion toggaleAccordion" id="siteSaftyFaqs">
                                <div class="card active">
                                    <div class="card-header" id="acc1">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse1"
                                                aria-expanded="true" aria-controls="collapse1">
                                                <span>What is Site Safety Plus?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse1" class="collapse show" aria-labelledby="acc1"
                                        data-parent="#siteSaftyFaqs">
                                        <p>Site Safety Plus or SSP is a group of Health and Safety courses are designed to
                                            give everyone, from operative to senior manager, the skills they need to
                                            progress through the construction industry. Each course is aimed at a different
                                            role in the building, civil engineering and allied industries to develop their
                                            onsite skills.</p>
                                        <p>Site Safety Plus training is imperative on all construction sites to keep workers
                                            free from harm and to ensure that workers and managers have the knowledge to
                                            spot risks and prevent injuries.</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="acc2">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link text-left d-flex align-items-center justify-content-between w-100"
                                                type="button" data-toggle="collapse" data-target="#collapse2"
                                                aria-expanded="true" aria-controls="collapse2">
                                                <span>What Site Safety Plus courses do you offer?</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse2" class="collapse" aria-labelledby="acc2"
                                        data-parent="#siteSaftyFaqs">
                                        <p>We currently are in a position to offer the following CITB Site Safety Plus
                                            courses:</p>
                                        <ul>
                                            <li><a href="https://training4employment.co.uk/courses/health-and-safety-awareness-course"
                                                    target="_blank" rel="noopener noreferrer">Health and Safety Awareness
                                                    (HSA)</a></li>
                                            <li><a href="https://training4employment.co.uk/sssts" target="_blank"
                                                    rel="noopener noreferrer">Site Supervision Safety Training Scheme
                                                    (SSSTS)</a></li>
                                            <li><a href="https://training4employment.co.uk/sssts-r" target="_blank"
                                                    rel="noopener noreferrer">Site Supervision Safety Training Scheme
                                                    Refresher (SSSTS-R)</a></li>
                                            <li><a href="https://training4employment.co.uk/smsts" target="_blank"
                                                    rel="noopener noreferrer">Site Management Safety Training Scheme
                                                    (SMSTS)</a></li>
                                            <li><a href="https://training4employment.co.uk/smsts-r" target="_blank"
                                                    rel="noopener noreferrer">Site Management Safety Training Scheme
                                                    Refresher (SMSTS-R)</a></li>
                                        </ul>
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

@push('footer_schema')
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
            "@type": "Question",
            "name": "Is the cost of an SIA licence included in the price of the course? And can you help me apply?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "No, the licence fee is a separate price. Payment for the license is £190.00 which is payable to the SIA. Yes, our staff can help you apply for your SIA badge for a £20 fee."
            }
            },
            {
            "@type": "Question",
            "name": "Do I have to pay before the course starts?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "We require a minimum £50 deposit on booking, with the remaining balance due on the first day of the course."
            }
            },
            {
            "@type": "Question",
            "name": "Can I pay by debit or credit card?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, you can pay using a credit or debit card online, by phone, or in person at our main office."
            }
            },
            {
            "@type": "Question",
            "name": "Do I need to bring ID? If so what do I need to bring?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "You must bring two items of ID: either two from Group A (e.g., passport, photocard driving licence, birth certificate, biometric residence permit), or one from Group A and two from Group B (e.g., bank statement, utility bill, firearms licence)."
            }
            },
            {
            "@type": "Question",
            "name": "Do I need to bring photos?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, we require two passport‑sized photographs."
            }
            },
            {
            "@type": "Question",
            "name": "Is there any food provided?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "No, food is not provided."
            }
            },
            {
            "@type": "Question",
            "name": "Is there free parking available?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, there is free parking available, though spaces are limited."
            }
            },
            {
            "@type": "Question",
            "name": "Do you provide all stationery?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, all stationery and learning materials are provided by the training centre."
            }
            },
            {
            "@type": "Question",
            "name": "Can I cancel my booking before the course begins?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Deposits and payments are non‑refundable. Once booked, we start providing services by ordering your course materials. You may use our Free Transfers Policy."
            }
            },
            {
            "@type": "Question",
            "name": "My name is spelt wrong on the certificate, what do I do?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Please contact us and we will forward your query to our Awarding body. Name changes typically take 3‑4 working days to resolve."
            }
            },
            {
            "@type": "Question",
            "name": "What qualification do you need to be a Door Supervisor?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "You need the Level 2 Award for working as a Door Supervisor within the Private Security Industry, which includes 4 training modules and exams."
            }
            },
            {
            "@type": "Question",
            "name": "Do I have to complete any distance learning before attending the training?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, both Door Supervisor and CCTV courses include distance learning which must be completed before attending classroom training."
            }
            },
            {
            "@type": "Question",
            "name": "How long does Door Supervisor Certificate last?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Three years. Once achieved, the certificate is valid for three years to apply for the licence."
            }
            },
            {
            "@type": "Question",
            "name": "What's the difference between door supervisor and security guard?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Door supervisors work at licensed premises to prevent crime and disorder; security guards protect premises against unauthorised access, theft, or damage."
            }
            },
            {
            "@type": "Question",
            "name": "When will I receive my certificate?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Certificates are emailed three days after passing the exam. Note: the certificate is not required to apply for your SIA licence."
            }
            },
            {
            "@type": "Question",
            "name": "Is the first aid qualification needed to do the SIA Door Supervisor course?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes. Since August 2021, a valid First Aid or Emergency First Aid certificate (valid for at least 12 months from the course start date) is mandatory before you start the Door Supervisor course."
            }
            },
            {
            "@type": "Question",
            "name": "Who is the CCTV course qualification for?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "It is designed for learners applying for a licence to work as a CCTV Operator in Public Space Surveillance."
            }
            },
            {
            "@type": "Question",
            "name": "How long is a CCTV course?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "The CCTV Operator course runs over three days and covers units on working within the Private Security Industry and working as a CCTV Operator."
            }
            },
            {
            "@type": "Question",
            "name": "Does the CCTV course involve practical work?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, it includes hands‑on experience working with CCTV systems."
            }
            },
            {
            "@type": "Question",
            "name": "How long does the CCTV Operator Certificate last?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "The certificate is valid for three years."
            }
            },
            {
            "@type": "Question",
            "name": "I have a criminal record. Can I still get a licence?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "The SIA checks your criminal record for the last five years. If convictions occurred within the last 12 months related to violence, deception or theft, a licence usually isn’t granted."
            }
            },
            {
            "@type": "Question",
            "name": "I have not lived in the country for the last 5 years. Is this a problem?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "You’ll need a criminal record check from any country where you lived for six continuous months or more in the last five years."
            }
            },
            {
            "@type": "Question",
            "name": "Can I still renew my licence after it expired?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "No—your SIA licence does not renew automatically. You can apply for a renewal up to four months before expiry to reduce downtime."
            }
            },
            {
            "@type": "Question",
            "name": "How do I get a security licence in the UK?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "1. Pass your SIA training course. 2. Submit your licence application. 3. Complete relevant checks. 4. You can start working once accepted."
            }
            },
            {
            "@type": "Question",
            "name": "Do I need my certificate to apply for SIA licence?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "No, the certificate isn’t required—your details are passed to the SIA upon passing the course."
            }
            }
        ]
        }
    </script>
@endpush
