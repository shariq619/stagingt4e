@extends('layouts.frontend')
@section('title', 'Resources')

@section('main')
    <div class="expertResourcesPage">
        <div class="pageTitleTop pyxl-5">
            <div class="container">
                <h1 class="text-center">Discover free, expert resources relevant to SIA security and construction training</h1>
            </div>
        </div>
    </div>
    <section class="gettingStarted pyxl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="gettingStartedLeft text-center">
                        <h2>Getting Started</h2>
                        <p>Explore our comprehensive library of resources designed to help you succeed in SIA security
                            training and construction safety certifications. Whether you're preparing for a career in
                            security, construction, or related industries, our expert guides, eBooks, and toolkits provide
                            valuable insights into health and safety regulations, security protocols, and employment
                            preparation.</p>
                        <p>Not sure where to start, or struggling to find the right course? Just click on this link to
                            browse all our courses.</p>
                    </div>
                </div>
            </div>
            <div class="row gettingStartedRow mt-5">
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="gettingStartedBox">
                        <a href="{{ route('contact') }}">
                            <img src="{{ asset('frontend/img/Classroom Training.png') }}" class="img-fluid"
                                alt="{{ __('Classroom Training') }}">
                            <h3 class="h5">Classroom Training</h3>
                            <p>Our venues: Birmingham New Town and Birmingham Small Heath.</p>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="gettingStartedBox">
                        <a href="{{ route('elearning.index') }}">
                            <img src="{{ asset('frontend/img/Distance Learning.png') }}" class="img-fluid"
                                alt="{{ __('Distance Learning') }}">
                            <h3 class="h5">Distance Learning</h3>
                            <p>Ensuring the continued delivery of our qualifications during the COVID-19 pandemics.</p>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="gettingStartedBox">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('frontend/img/In-House Training.png') }}" class="img-fluid"
                                alt="{{ __('In-House Training') }}">
                            <h3 class="h5">In-House Training</h3>
                            <p>You can be in control of the schedule – we deliver in-house training that will suit your
                                business needs.</p>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="gettingStartedBox">
                        <a href="{{ route('courses.byCategory', 'construction') }}">
                            <img src="{{ asset('frontend/img/Construction Courses.png') }}" class="img-fluid"
                                alt="{{ __('Construction Courses') }}">
                            <h3 class="h5">Construction Courses</h3>
                            <p>Construction training for beginners and experienced trades people.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="usefulLinks pyxl-5" style="margin-top:0px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <h2 class="text-center text-capitalize mb-5 fs2 text-white">Useful Links</h2>
                </div>
                <div class="col-12 col-md-4 col-lg-4 border-right">
                    <div class="usefulLinksBox">
                        <h3 class="h5 text-white mb-4">Security Industry Authority (SIA)</h3>
                        <p class="text-white">As the organization responsible for regulating the private security industry
                            this website
                            provides a wealth of information about licensing for all of the UK security sectors.</p>
                        <a href="https://www.gov.uk/government/organisations/security-industry-authority" target="_blank"
                            class="text-decoration-underline text-white">www.the-sia.org.uk</a>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 border-right">
                    <div class="usefulLinksBox">
                        <h3 class="h5 text-white mb-4">National Counter Terrorism Security Office (NaCTSO)</h3>
                        <p class="text-white">This is a counter terrorism government website with specific information about
                            what actions
                            should be consider in the light of terrorism by pubs, clubs and other venues. The information
                            for pubs and clubs is contained in the section shown as ‘crowded places’.</p>
                        <a href="http://www.nactso.gov.uk/" target="_blank"
                            class="text-decoration-underline text-white">www.nactso.gov.uk</a>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="usefulLinksBox">
                        <h3 class="h5 text-white mb-4">Drug misuse and dependency</h3>
                        <p class="text-white">This government website gives details of current strategies and campaigns. You
                            will find a range
                            of information on this website.</p>
                        <a href="https://www.gov.uk" target="_blank"
                            class="text-decoration-underline text-white">https://www.gov.uk</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pyxl-5 siLicence">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4 col-lg-4 bgBlueCol1">
                    <div class="siLicenceBox">
                        <h2>Need SIA Licence?</h2>
                        <p class="mt-4 mb-5">If you wish to work in the private security industry, you will now need to
                            apply for a licence from the Security Industry Authority (SIA), the government body responsible
                            for regulating the private security industry in the UK.</p>
                        <a href="javascript:void(0);" class="btn btnBlue d-inline">Learn How</a>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 bgBlueCol2">
                    <div class="siLicenceBox">
                        <h2 class="h5 mb-3">Pandemic Update</h2>
                        <p>We are pleased to announce that all classroom training is running as scheduled.</p>
                        <p>We will be providing you with PPE throughout the course and ensuring you are kept safe following
                            government guidelines.</p>
                        <p>All candidates will have their temperature checked before they start the course and at the start
                            of every training day. Learn more…</p>
                        <h4 class="h6 mt-5">
                            <a href="{{ asset('frontend/pdf/COVID-19-T4E-Method-Statement-Venue-Specific_Branded.pdf')}}" target="_blank" class="text-white">COVID-19 Safe</a>
                        </h4>
                        <small>Read our COVID-19 Method Statement</small>
                        <p class="mt-4">Read our Training Venue Risk Assessment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pyxl-5 secritySection">
        <div class="container">
            <h2 class="text-center text-capitalize mb-5 fs2">Other Useful Links</h2>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                    <div class="secrityBox d-flex flex-column justify-content-between text-center">
                        <div>
                            <h3 class="h5 mb-4">Security Industry Union Ltd</h3>
                            <p>SIU represents security professionals, protects their rights at work, and provides advice,
                                support, representation, and a bespoke group of member benefits that aren’t available to the
                                general public</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                    <div class="secrityBox d-flex flex-column justify-content-between text-center">
                        <div>
                            <h3 class="h5 mb-4">Health and Safety Executive</h3>
                            <p>A large website with a wealth of health and safety guidelines and advice. The website also
                                includes specific sections on managing violence in licensed and retail premises as well as
                                work-related violence guidelines in general.</p>
                        </div>
                        <a href="http://www.hse.gov.uk/" target="_blank">www.hse.gov.uk</a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                    <div class="secrityBox d-flex flex-column justify-content-between text-center">
                        <div>
                            <h3 class="h5 mb-4">Equality and Human Rights Commission</h3>
                            <p>You will find guidelines to discrimination law, best practice advice for organizations and
                                information about current campaigns and policies on this website.</p>
                        </div>
                        <a href="https://www.equalityhumanrights.com/" target="_blank">www.equalityhumanrights.com</a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                    <div class="secrityBox d-flex flex-column justify-content-between text-center">
                        <h3 class="h5 mb-4">Victim Support (England & Wales)</h3>
                        <p>This national charity helps people affected by crime in England and Wales. They give free and
                            confidential support to victims and witnesses, whether or not they report the crime to the
                            police.</p>
                        <a href="http://www.victimsupport.org.uk/" target="_blank">www.victimsupport.org.uk</a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                    <div class="secrityBox d-flex flex-column justify-content-between text-center">
                        <div>
                            <h3 class="h5 mb-4">Criminal Injuries Compensation Authority (CICA)</h3>
                            <p>This website enables you to apply for compensation if you have, as a victim of a violent
                                crime,
                                been physically or mentally injured. You must have been injured in England, Scotland or
                                Wales
                                and the offender does not necessarily have to have been convicted of, or even charged with,
                                the
                                crime.</p>
                        </div>
                        <a href="http://www.cica.gov.uk/" target="_blank">www.cica.gov.uk</a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                    <div class="secrityBox d-flex flex-column justify-content-between text-center">
                        <div>
                            <h3 class="h5">Working the Doors</h3>
                            <p>The free national on-line forum for frontline door supervisors.</p>
                        </div>
                        <a href="http://www.workingthedoors.co.uk/" target="_blank">www.workingthedoors.co.uk</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pyxl-5 downloadPdfs">
        <div class="container">
            <h2 class="text-center text-capitalize mb-5 fs2">Downloads</h2>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-4 col-md-3 col-lg-3">
                    <a href="{{ asset('frontend/pdf/servicescode_0.pdf') }}" target="_blank">
                        <img src="{{ asset('frontend/img/Equality-Act-2020-Code-of-Practice.webp') }}" class="img-fluid" alt="Equality-Act-2020-Code-of-Practice">
                        <p class="text-center mt-4"><strong>Services, public functions and associations Statutory Code of Practice</strong></p>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <style>
        .secritySection {
            background: #8f8f8f;
        }

        .secritySection .secrityBox {
            padding: 20px 30px;
            box-shadow: #00000029 0px 0px 20px 0px;
            height: 100%;
            background: #fff;
        }

        .gettingStartedBox {
            background: #1a68ab;
            height: 100%;
            text-align: center;
            padding: 20px 10px;
        }

        .gettingStarted .gettingStartedRow .col-12 {
            margin-bottom: 30px;
        }

        .gettingStartedBox a img {
            width: 125px;
            height: 125px;
            margin: auto;
            display: block;
            margin-bottom: 20px;
        }

        .gettingStartedBox h3,
        .gettingStartedBox p {
            color: #fff;
        }

        .usefulLinks {
            background: #8f8f8f;
        }

        .bgBlueCol1 {
            background: #d6d6d6;
        }

        .bgBlueCol2 {
            background: #1a68ab;
        }

        .bgBlueCol2 h2,
        .bgBlueCol2 p,
        .bgBlueCol2 h4,
        .bgBlueCol2 small {
            color: #fff;
        }

        .bgBlueCol2 .siLicenceBox {
            padding: 20px 0px 20px 20px;
        }

        .bgBlueCol1 .siLicenceBox {
            padding: 20px 20px 0px 20px;
        }
    </style>
@endpush
