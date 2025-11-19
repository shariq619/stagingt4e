@extends('layouts.frontend')
@section('title', 'Fire Safety Training')
@section('main')
    <div class="fireSaftyWrapper coursePage">
        <section id="banner" class="bannerWrapper">
            <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 bannerImg" style='background: url({{asset('CategoryImages/fire-safety-for-fire-wardens-1.png')}}) no-repeat center/cover!important;' data-aos="fade-right"></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 py-5" data-aos="fade-left">
                    <div class="bannerCol px-3 px-lg-0 px-md-0 px-xl-0 pl-xl-5 pl-lg-5 pl-md-5 mr-xl-5 pr-xl-5">
                        <div class="bannerInfo">
                            <h1 class="mb-4">Fire Safety Training</h1>
                            <p class="mb-4">Ensure your team is prepared to handle fire risks by enrolling in one of our fire safety
                                courses. From basic awareness to advanced fire marshal training, we provide the skills and
                                knowledge your employees need to maintain a safe workplace.</p>
                            <ul class="list-unstyled p-0 m-0">
                                <li class="d-flex mb-3">
                                    <i class="mt-2 far fa-check-square mr-2"></i>
                                    <p class="m-0 font-weight-normal"><em><strong>Accredited Trainers</strong>: Our
                                            courses are delivered by experienced and qualified fire safety trainers</em></p>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="mt-2 far fa-check-square mr-2"></i>
                                    <p class="m-0 font-weight-normal"><em><strong>Flexible Delivery</strong>: Whether you
                                            prefer onsite training, classroom learning, or e-learning, we offer flexible
                                            delivery
                                            methods</em></p>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="mt-2 far fa-check-square mr-2"></i>
                                    <p class="m-0 font-weight-normal"><em><strong>Nationwide Coverage</strong>: No matter
                                            where you're located, we can deliver fire safety training nationwide</em></p>
                                </li>
                                <li class="d-flex mb-3">
                                    <i class="mt-2 far fa-check-square mr-2"></i>
                                    <p class="m-0 font-weight-normal"><em><strong>Regulatory Compliance</strong>: Our
                                            courses meet current fire safety regulations, helping you stay compliant with
                                            legal
                                            obligations</em></p>
                                </li>
                            </ul>
                        </div>
                        <div class="bookingBtnGroup d-flex flex-column flex-md-row flex-lg-row mb-2 mt-4">
                            <a href="#firsSection"
                                class="mr-lg-2 mr-md-2 mr-sm-0 mb-2 mb-md-0 mb-lg-0 btnMstr text-center"><i
                                    class="fas fa-shopping-cart"></i> Book Now</a>
                            <a href="javascript:;" class="btnWhiteBg text-center" data-toggle="modal" data-target="#bespokeForm"><i class="fas fa-users"></i> Request
                                Bespoke Training</a>
                        </div>
                        <script defer async src='https://cdn.trustindex.io/loader.js?c6282b731b132346ef669eb8980'></script>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="coursesWrapper py-5" id="firsSection">
            <div class="container">
                <h2 class="text-center mb-4 mt-4 px-3 px-lg-0 px-xl-0 fs2">Fire Safety Training Courses We Offer</h2>
                <p class="text-center mb-4 mt-4 px-3 px-lg-0 px-xl-0 mb-5">At Training4Employment, we offer a variety of fire
                    safety training courses to help businesses comply with UK fire safety regulations and ensure that
                    employees know how to prevent, manage, and respond to fire risks:</p>
                <div class="row" id="courses-container">
                    @include('frontend.categories.courses.index', ['courses' => $category->courses])
                </div>
                {{-- <div class="row justify-content-center" id="courses-container">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <div class="singleCourse mb-4">
                            <div class="wrap">
                                <div class="box">
                                    <div class="hover panel">
                                        <div class="front w-100"
                                            style="background:url({{ asset('frontend/img/EFAW.webp') }}) no-repeat center/cover;">
                                            <div class="base1">
                                            </div>
                                        </div>
                                        <div class="back w-100 d-flex align-items-center justify-content-center">
                                            <div class="base2">
                                                <a href="javascript:;" class="panelBtn text-uppercase font-weight-bold">View
                                                    Dates &amp; Venues</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panelContent">
                                        <h3>Emergency First Aid At Work (EFAW)</h3>
                                        <p>Ideal for low-risk workplaces, as the course covers the basics of first aid,
                                            including CPR, treating minor injuries, and managing emergency situations.</p>
                                        <ul class="list-unstyled p-0 m-0">
                                            <li class="d-flex align-content-center"><i class="mr-2 fas fa-home"></i>
                                                <p class="m-0"><strong>Delivery Mode</strong>: E-learning + Face-to-face
                                                </p>
                                            </li>
                                            <li class="d-flex align-content-center"><i class="mr-2 fas fa-certificate"></i>
                                                <p class="m-0"><strong>Award</strong>: Highfield Qualifications</p>
                                            </li>
                                            <li class="d-flex align-content-center"><i
                                                    class="mr-2 fas fa-money-bill-wave"></i>
                                                <p class="m-0"><strong>Duration</strong>: 1 day</p>
                                            </li>
                                            <li class="d-flex align-content-center"><i class="mr-2 far fa-clock"></i>
                                                <p class="m-0"><strong>Price</strong>: from £65</p>
                                            </li>
                                        </ul>
                                        <div class="panelViewDateBtn">
                                            <a href="javascript:;">View Dates &amp; Venues</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <div class="singleCourse mb-4">
                            <div class="wrap">
                                <div class="box">
                                    <div class="hover panel">
                                        <div class="front w-100"
                                            style="background:url({{ asset('frontend/img/FAW.webp') }}) no-repeat center/cover;">
                                            <div class="base1">
                                            </div>
                                        </div>
                                        <div class="back w-100 d-flex align-items-center justify-content-center">
                                            <div class="base2">
                                                <a href="javascript:;" class="panelBtn text-uppercase font-weight-bold">View
                                                    Dates &amp; Venues</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panelContent">
                                        <h3>First Aid At Work (FAW)</h3>
                                        <p>A comprehensive first aid program that goes beyond the basics, addressing a wider
                                            range of medical conditions and injuries.
                                            Ideal for High-risk workplace employees, safety officers, and those seeking a
                                            thorough understanding of first aid.</p>
                                        <ul class="list-unstyled p-0 m-0">
                                            <li class="d-flex align-content-center"><i class="mr-2 fas fa-home"></i>
                                                <p class="m-0"><strong>Delivery Mode</strong>: Face-to-face</p>
                                            </li>
                                            <li class="d-flex align-content-center"><i class="mr-2 fas fa-certificate"></i>
                                                <p class="m-0"><strong>Award</strong>: Highfield Qualifications</p>
                                            </li>
                                            <li class="d-flex align-content-center"><i
                                                    class="mr-2 fas fa-money-bill-wave"></i>
                                                <p class="m-0"><strong>Duration</strong>: 3 day</p>
                                            </li>
                                            <li class="d-flex align-content-center"><i class="mr-2 far fa-clock"></i>
                                                <p class="m-0"><strong>Price</strong>: from £179</p>
                                            </li>
                                        </ul>
                                        <div class="panelViewDateBtn">
                                            <a href="javascript:;">View Dates &amp; Venues</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <div class="singleCourse mb-4">
                            <div class="wrap">
                                <div class="box">
                                    <div class="hover panel">
                                        <div class="front w-100"
                                            style="background:url({{ asset('frontend/img/EFA.webp') }}) no-repeat center/cover;">
                                            <div class="base1">
                                            </div>
                                        </div>
                                        <div class="back w-100 d-flex align-items-center justify-content-center">
                                            <div class="base2">
                                                <a href="javascript:;" class="panelBtn text-uppercase font-weight-bold">View
                                                    Dates &amp; Venues</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panelContent">
                                        <h3>Paediatric First Aid (PFA)</h3>
                                        <p>Focuses on first aid for infants and children, covering conditions like choking,
                                            asthma, and severe allergic reactions.
                                            Ideal for Childcare professionals, teachers, and parents.</p>
                                        <ul class="list-unstyled p-0 m-0">
                                            <li class="d-flex align-content-center"><i class="mr-2 fas fa-home"></i>
                                                <p class="m-0"><strong>Delivery Mode</strong>: E-learning + Face-to-face
                                                </p>
                                            </li>
                                            <li class="d-flex align-content-center"><i class="mr-2 fas fa-certificate"></i>
                                                <p class="m-0"><strong>Award</strong>: Highfield Qualifications</p>
                                            </li>
                                            <li class="d-flex align-content-center"><i
                                                    class="mr-2 fas fa-money-bill-wave"></i>
                                                <p class="m-0"><strong>Duration</strong>: 2 day</p>
                                            </li>
                                            <li class="d-flex align-content-center"><i class="mr-2 far fa-clock"></i>
                                                <p class="m-0"><strong>Price</strong>: from £155</p>
                                            </li>
                                        </ul>
                                        <div class="panelViewDateBtn">
                                            <a href="javascript:;">View Dates &amp; Venues</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
        <section class="fireSaftyRegulation">
            <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-5 col-lg-5 fireSaftyBgImg d-none d-xl-block d-lg-block" data-aos="fade-right"></div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-5 fireSaftySmBgImg d-block d-xl-none d-lg-none" data-aos="fade-right">
                    <img src="{{asset('frontend/img/Fire-Safety-Equipment-Training.webp')}}" class="img-fluid" alt="Fire Safety Regulations">
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-7 px-0 px-xl-5 px-lg-5" data-aos="fade-left">
                    <h2 class="fs2 mb-5 pl-4 mt-4 mt-xl-0 mt-lg-0">Fire Safety Regulations for Workplaces in the UK</h2>
                    <p class="pl-4">In the UK, fire safety in workplaces is governed by the Regulatory Reform (Fire Safety) Order 2005
                        (FSO). These regulations apply to almost all non-domestic premises, including offices, factories,
                        shops, restaurants, and construction sites. Employers, building owners, and landlords are legally
                        required to ensure their premises meet fire safety standards to protect employees and anyone else
                        who may be on-site.</p>
                    <p class="pl-4">Here’s an overview of the key aspects of fire safety regulations for workplaces in the UK:</p>
                    <div class="accordion fireSaftyAccr pl-4 mt-5" id="fireSaftyAccr">
                        <div class="card active">
                            <div class="card-header" id="heading1">
                                <h3 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                        data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        The Role of the ‘Responsible Person
                                    </button>
                                </h3>
                            </div>

                            <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#fireSaftyAccr">
                                <div class="card-body">
                                    <p>Under the Fire Safety Order, the responsibility for fire safety in a workplace rests
                                        with the “Responsible Person.” This is typically the employer, but in some cases, it
                                        may also include building owners, landlords, or facility managers. The Responsible
                                        Person is tasked with:</p>
                                    <ul>
                                        <li>Conducting regular fire risk assessments</li>
                                        <li>Identifying fire hazards and ensuring appropriate safety measures are in place
                                        </li>
                                        <li>Informing employees and visitors about fire safety measures</li>
                                        <li>Ensuring proper fire safety equipment is installed</li>
                                        <li>Providing appropriate training and fire drills</li>
                                        <li>Maintaining fire safety systems, such as alarms and extinguishers</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading2">
                                <h3 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapse2" aria-expanded="false"
                                        aria-controls="collapse2">
                                        Fire Risk Assessments
                                    </button>
                                </h3>
                            </div>
                            <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#fireSaftyAccr">
                                <div class="card-body">
                                    <p>A fire risk assessment is a fundamental requirement of the Fire Safety Order. The
                                        Responsible Person must regularly carry out and update this assessment to ensure the
                                        workplace remains safe. Key steps include:</p>
                                    <ul>
                                        <li>Identifying potential fire hazards (flammable materials, faulty electrical
                                            systems, etc.)</li>
                                        <li>Determining who may be at risk (employees, visitors, contractors, etc.)</li>
                                        <li>Evaluating existing fire safety measures (alarm systems, evacuation routes)</li>
                                        <li>Implementing improvements to reduce or eliminate risks</li>
                                        <li>Documenting findings, especially for businesses with 5 or more employees.</li>
                                    </ul>
                                    <p>The fire risk assessment must be reviewed regularly, especially when there are
                                        changes in the workplace, such as new machinery or building renovations.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading3">
                                <h3 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapse3" aria-expanded="false"
                                        aria-controls="collapse3">
                                        Fire Detection and Warning Systems
                                    </button>
                                </h3>
                            </div>
                            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#fireSaftyAccr">
                                <div class="card-body">
                                    <p>Workplaces must have adequate fire detection systems, such as smoke alarms, heat
                                        detectors, and manual call points, to provide early warning in the event of a fire.
                                        These systems must be:</p>
                                    <ul>
                                        <li>Properly installed by qualified professionals</li>
                                        <li>Regularly tested and maintained</li>
                                        <li>Clearly audible across the entire premises</li>
                                        <li>Connected to a reliable fire alarm system.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading4">
                                <h3 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapse4" aria-expanded="true"
                                        aria-controls="collapse4">
                                        Firefighting Equipment
                                    </button>
                                </h3>
                            </div>

                            <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#fireSaftyAccr">
                                <div class="card-body">
                                    <p>All workplaces must be equipped with suitable firefighting equipment, including:</p>
                                    <ul>
                                        <li>Fire extinguishers (water, foam, CO2, powder, etc., depending on the specific
                                            risks)</li>
                                        <li>Fire blankets in kitchens or areas where cooking is done</li>
                                        <li>Fire hose reels (if necessary)</li>
                                        <li>Fire extinguishers should be easily accessible, regularly inspected, and
                                            employees must be trained in their use.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading5">
                                <h3 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapse5" aria-expanded="false"
                                        aria-controls="collapse5">
                                        Emergency Evacuation Procedures
                                    </button>
                                </h3>
                            </div>
                            <div id="collapse5" class="collapse" aria-labelledby="heading5"
                                data-parent="#fireSaftyAccr">
                                <div class="card-body">
                                    <p>A critical aspect of fire safety is ensuring that all employees and visitors can
                                        safely evacuate the building in the event of a fire. To comply with the law,
                                        workplaces must:</p>
                                    <ul>
                                        <li>Clearly mark fire exits and ensure they are easily accessible</li>
                                        <li>Provide adequate emergency lighting if the power fails</li>
                                        <li>Display fire action notices near fire exits</li>
                                        <li>Conduct regular fire drills to ensure everyone knows the evacuation procedure
                                        </li>
                                        <li>Designate fire marshals or wardens to assist with evacuations</li>
                                        <li>Ensure that escape routes are always kept clear</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading6">
                                <h3 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapse6" aria-expanded="false"
                                        aria-controls="collapse6">
                                        Employee Training and Fire Drills
                                    </button>
                                </h3>
                            </div>
                            <div id="collapse6" class="collapse" aria-labelledby="heading6"
                                data-parent="#fireSaftyAccr">
                                <div class="card-body">
                                    <p>Employers are legally required to provide fire safety training to all employees. This
                                        training should cover:</p>
                                    <ul>
                                        <li>The risks identified in the fire risk assessment</li>
                                        <li>Fire prevention measures and good housekeeping practices</li>
                                        <li>The location of fire exits and firefighting equipment</li>
                                        <li>How to raise the alarm in the event of a fire</li>
                                        <li>The emergency evacuation procedure, including any special arrangements for
                                            vulnerable individuals (e.g., those with disabilities)</li>
                                        <li>Regular fire drills are necessary to reinforce the training and ensure that
                                            employees are prepared in case of a real emergency.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="whyChooseFst mt-5 mt-xl-0 mt-lg-0">
            <div class="container">
            <div class="row flex-column-reverse flex-lg-row flex-xl-row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 py-5 px-0 px-xl-5 px-lg-5">
                    <h2 class="fs2 mb-5">Why Choose Training4Employment for Your Fire Safety Training?</h2>
                    <p class="mb-5">At Training4Employment, we offer accredited, expert-led fire safety training tailored to meet UK
                        regulations, ensuring the safety of your team. Here’s why companies across Birmingham and the UK
                        rely on us for their fire safety training:</p>
                    <div class="whyChooseFstBox">
                        <div class="whyChooseFstBoxinner mb-3 d-flex" data-aos="fade-right" data-aos-duration="2000">
                            <div class="whyChooseFstBoxIcon mr-2">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="whyChooseFstBoxInfo">
                                <div class="h5">Qualified Instructors:</div>
                                <p>Our trainers are seasoned professionals with in-depth expertise in fire safety
                                    regulations and real-world emergency response.</p>
                            </div>
                        </div>
                        <div class="whyChooseFstBoxinner mb-3 d-flex" data-aos="fade-right" data-aos-duration="1700">
                            <div class="whyChooseFstBoxIcon mr-2">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="whyChooseFstBoxInfo">
                                <div class="h5">Flexible Learning Options:</div>
                                <p>We provide versatile training solutions, including onsite sessions, classroom
                                    instruction, and online courses to fit your schedule and needs.</p>
                            </div>
                        </div>
                        <div class="whyChooseFstBoxinner mb-3 d-flex" data-aos="fade-right" data-aos-duration="1400">
                            <div class="whyChooseFstBoxIcon mr-2">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="whyChooseFstBoxInfo">
                                <div class="h5">Nationwide Coverage:</div>
                                <p>Whether you're in Birmingham or elsewhere in the UK, our fire safety training services
                                    are available across the country.</p>
                            </div>
                        </div>
                        <div class="whyChooseFstBoxinner mb-3 d-flex" data-aos="fade-right" data-aos-duration="1100">
                            <div class="whyChooseFstBoxIcon mr-2">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="whyChooseFstBoxInfo">
                                <div class="h5">Legal Compliance:</div>
                                <p>Our courses are carefully designed to help your business stay fully compliant with the
                                    Regulatory Reform (Fire Safety) Order 2005.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 whyChooseFstBgImg d-none d-xl-block d-lg-block" data-aos="fade-left"></div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-5 d-block col-xl-5 d-xl-none d-lg-none" data-aos="fade-left">
                    <img src="{{asset('frontend/img/Fire-Safety-Training-in-Dudley.webp')}}" class="img-fluid" alt="Fire-Safety-Training-in-Dudley">
                </div>
            </div>
            </div>
        </section>
        {{-- Form --}}
        <div id="contactForm">
            <x-frontend.request_form />
        </div>
    </div>
    @include('frontend.bespoke_form.index')
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
            $('.hover').hover(function() {
                $(this).addClass('flip');
            }, function() {
                $(this).removeClass('flip');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.fireSaftyAccr .card', function() {
                $('.fireSaftyAccr .card').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endpush
