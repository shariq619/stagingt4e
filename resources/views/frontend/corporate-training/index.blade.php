@extends('layouts.frontend')
@section('title', 'Corporate Training Solutions')

@push('css')
<style>
    .company img {
        height: 45px; /* keeps a good consistent height */
        width: auto; /* maintain natural aspect ratio */
        border-radius: 0; /* logos shouldn’t be circular */
        object-fit: contain;
        flex-shrink: 0;
        margin-right: 10px;
    }

    .placeholder-img {
        width: 60px;
        height: 60px;
        border-radius: 50%; /* circular for initials */
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #666;
        border: 1px solid #ddd;
        font-size: 14px;
        flex-shrink: 0;
        margin-right: 10px;
    }

    .testimonial {
        height: 100%;
        display: flex;
        flex-direction: column;
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 20px;
        background: #fff;
        transition: box-shadow 0.3s ease;
    }

    .testimonial:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .testimonial p {
        flex-grow: 1;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .testimonialhead h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
        font-weight: bold;
    }

    .company {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
    }

    .company span {
        font-weight: bold;
        color: #333;
    }

    .company-logo {
        max-height: 45px;
        width: auto;
    }

</style>
@endpush
@section('main')
    <div class="corporateTrainingSolutionsPage">
        <section class="referFriendBanner corporateTraining py-5 position-relative" id="corporateTraining">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 offset-xl-6 offset-lg-6 offset-md-6 offset-0" data-aos="fade-left">
                        <div class="referFriendBannerDesc position-relative">
                            <p class="bannerSubTitle">Elevate Your Organisation’s Safety and Compliance with our</p>
                            <h1 class="mb-4"><strong>Corporate Training Solutions</strong>
                            </h1>
                            <p>Whether you're looking to enhance your career prospects, upskill your workforce, or explore a new field, our e-learning solutions offer flexibility, expert knowledge, and industry-relevant content.</p>
                            <div class="corporateTrainingBox mt-5">
                                <div class="d-flex align-items-start align-items-md-center align-items-lg-center align-items-xl-center flex-row mb-3">
                                    <div class="corporatIcon text-white d-flex align-items-center justify-content-center mr-2"><i class="fa-solid fa-truck"></i></div>
                                    <div class="corporatInfo"><h3 class="mb-0 text-white ml-2">Nationwide Delivery</h3></div>
                                </div>
                                <div class="d-flex align-items-start align-items-md-center align-items-lg-center align-items-xl-center flex-row mb-3">
                                    <div class="corporatIcon text-white d-flex align-items-center justify-content-center mr-2"><i class="fa-solid fa-building"></i></div>
                                    <div class="corporatInfo"><h3 class="mb-0 text-white ml-2">On-site & Off-site Delivery Options</h3></div>
                                </div>
                                <div class="d-flex align-items-start align-items-md-center align-items-lg-center align-items-xl-center flex-row mb-3">
                                    <div class="corporatIcon text-white d-flex align-items-center justify-content-center mr-2"><i class="fa-solid fa-puzzle-piece"></i></div>
                                    <div class="corporatInfo"><h3 class="mb-0 text-white ml-2">Bespoke Programmes</h3></div>
                                </div>
                            </div>
                            <div class="mt-5 referBannerBtn corporateDanger">
                                <a href="" class="d-inline-block">Learn More <i class="fas fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="getStaff py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-down">
                        <h2 class="fs2 text-center pt-5 mb-5">Get your Staff Easily Trained with Us!</h2>
                        <p class="mb-5 text-center">In today’s dynamic business environment, maintaining a high standard of safety and compliance is paramount. At Training for Employment, we specialise in delivering tailored corporate training solutions that meet the unique needs of businesses across various sectors including security, hotel, hospitality, sporting events, and construction. Our comprehensive training packages ensure that your team is not only skilled but also compliant with essential health and safety and first aid regulations. Whether you’re looking to train your team in person or through e-learning, our courses empower your workforce to meet compliance standards, reduce risks, and maintain operational excellence.</p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="staffBox mb-5" data-aos="fade-right">
                            <h3 class="mb-4">On-Site Delivery</h3>
                            <p>We bring our training directly to your location, providing a convenient and effective way to equip your team with essential skills.</p>
                        </div>
                        <div class="staffBox mb-5" data-aos="fade-right">
                            <h3 class="mb-4">95% Pass Rate</h3>
                            <p>Our expert trainers boast a remarkable 95% pass rate. Plus, we offer hassle-free rebooking to accommodate your schedule and needs.</p>
                        </div class="mb-4">
                        <div class="staffBox mb-5" data-aos="fade-right">
                            <h3 class="mb-4">Online Tracking</h3>
                            <p>Instant access to our <strong>Online Portal</strong>. Easily access and manage all delegate information, invoices, and training results in one centralised location.</p>
                        </div class="mb-4">
                        <div class="staffBox mb-5" data-aos="fade-right">
                            <h3 class="mb-4">Top-Quality Resources</h3>
                            <p>instant access to our premium training materials, mock exams, and additional training resources.</p>
                        </div class="mb-4">
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6" data-aos="fade-down">
                        <img src="{{asset('frontend/img/portalimg.webp')}}" class="img-fluid" alt="Learner Portal">
                        <div class="staffBtn">
                            <a href="tel:08082808098" class="d-inline-block">Contact Us</a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="staffBox mb-5" data-aos="fade-left">
                            <h3 class="mb-4">Off-Site Training</h3>
                            <p>By stepping out of the regular work setting, employees can fully concentrate on developing new skills and knowledge, ensuring they return to work better equipped and more motivated.</p>
                        </div class="mb-4">
                        <div class="staffBox mb-5" data-aos="fade-left">
                            <h3 class="mb-4">Exceptional Customer Service</h3>
                            <p>From start to finish, our dedicated account managers handle all your training logistics, offering personalised assistance tailored to your specific requirements. We take care of the details so you can focus on your core business.</p>
                        </div class="mb-4">
                        <div class="staffBox mb-5" data-aos="fade-left">
                            <h3 class="mb-4">Customisable Packages</h3>
                            <p>We work with your organisation to develop bespoke training that aligns with your specific compliance and skill requirements.</p>
                        </div class="mb-4">
                    </div>
                </div>
            </div>
        </section>
        <section class="whyJoin healthSafety py-5">
            <div class="container pb-5">
                <h2 class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2" data-aos="fade-down">Comprehensive Health and Safety Compliance</h2>
                <p class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0" data-aos="fade-down">Our training packages are designed to ensure that your business remains compliant with all health and safety regulations. We provide in-depth training on:</p>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" data-aos="fade-up" data-aos-anchor-placement="center-center">
                        <div class="whyJoinBox text-center">
                            <div><i class="fa-solid fa-coins"></i></div>
                            <div class="mt-4">
                                <h3 class="my-4">Regulatory Compliance</h3>
                                <p>Keep your business fully compliant with the latest laws and industry standards.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" data-aos="fade-up" data-aos-anchor-placement="center-center">
                        <div class="whyJoinBox text-center">
                            <div><i class="fa-solid fa-money-check"></i></div>
                            <div class="mt-4">
                                <h3 class="my-4">Risk Reduction</h3>
                                <p>Training helps prevent workplace incidents and legal issues, ensuring a safer, more compliant environment.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" data-aos="fade-up" data-aos-anchor-placement="center-center">
                        <div class="whyJoinBox text-center">
                            <div><i class="fas fa-cogs"></i></div>
                            <div class="mt-4">
                                <h3 class="my-4">Flexible Delivery</h3>
                                <p>Choose from e-learning, block release, or on-site training to suit your business needs.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" data-aos="fade-up" data-aos-anchor-placement="center-center">
                        <div class="whyJoinBox text-center">
                            <div><i class="fa-solid fa-headset"></i></div>
                            <div class="mt-4">
                                <h3 class="my-4">Expert Trainers</h3>
                                <p>Our courses are delivered by experienced professionals with deep expertise in compliance and corporate regulations.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="brandsWrapper p-5" data-aos="fade-down">
            <h2 class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">Trusted by Leading Brands</h2>
            <div class="brandsSlider py-5 position-relative">
                <div class="brandImg">
                    <img src="{{asset('frontend/img/sl3.png')}}" class="img-fluid" alt="Trusted by Leading Brands 1">
                </div>
                <div class="brandImg">
                    <img src="{{asset('frontend/img/sl2.webp')}}" class="img-fluid" alt="Trusted by Leading Brands 2">
                </div>
                <div class="brandImg">
                    <img src="{{asset('frontend/img/sl3.webp')}}" class="img-fluid" alt="Trusted by Leading Brands 3">
                </div>
                <div class="brandImg">
                    <img src="{{asset('frontend/img/sl5.webp')}}" class="img-fluid" alt="Trusted by Leading Brands 4">
                </div>
                <div class="brandImg">
                    <img src="{{asset('frontend/img/sl4.webp')}}" class="img-fluid" alt="Trusted by Leading Brands 5">
                </div>
                <div class="brandImg">
                    <img src="{{asset('frontend/img/sl3.png')}}" class="img-fluid" alt="Trusted by Leading Brands 6">
                </div>
            </div>
        </section>
        <section class="testimonials">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="testimonialhead">
                            <h2>OUR TESTIMONIALS</h2>
                        </div>
                    </div>

                    <!-- First Testimonial - No image available -->
                    <div class="col-sm-12 col-md-4">
                        <div class="testimonial">
                            <p>We have been working with Training 4 Employment for some years to support our SIA mandatory course delivery. We are delighted in the professional approach by Training 4 Employment in understanding our requirements and working with us to deliver training solutions that achieve our objectives. Training 4 Employment have consistently demonstrated professional standards of delivery and a high degree of reliability. As important as the course delivery is head office support and again, I have to say the Training 4 Employment infrastructure has enabled smooth, professional communication and delivery of courses. In summary, I am very pleased with the partnership we have developed, and I look forward to working with you into the future.</p>
                            <div class="company d-flex align-items-center">
                                <div class="placeholder-img mr-2">RM</div>
                                <span>Risk Management Consultancy</span>
                            </div>
                        </div>
                    </div>

                    <!-- Second Testimonial - Has ABM image -->
                    <div class="col-sm-12 col-md-4">
                        <div class="testimonial">
                            <p>I have been using Training for Employment for the past year and have been very pleased with their service. The staff are always welcoming, professional, and highly responsive, making the training process smooth and efficient. Their support, even at short notice, has been invaluable, and their courses are well-structured and delivered to a high standard. I highly recommend Training for Employment to anyone looking for reliable and professional training services.</p>
                            <div class="company d-flex align-items-center">
                                <img src="images/abm-logo.png" class="company-logo" alt="ABM Facility Services UK Limited">
                                <span>Musa from ABM Facility Services UK Limited</span>
                            </div>
                        </div>
                    </div>

                    <!-- Third Testimonial - Has Trade Skills image -->
                    <div class="col-sm-12 col-md-4">
                        <div class="testimonial">
                            <p>We have worked alongside T4E for a number of years now helping our clients to gain industry recognised qualifications to get them back into work. The team are always efficient with the booking process and any queries are always handled in a professional manner.</p>
                            <div class="company d-flex align-items-center">
                                <img src="images/trade-skills-logo.png" class="img-fluid mr-2" alt="Trade Skills Ltd">
                                <span>Trade Skills Ltd</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>


        <div id="startCours" data-aos="fade-up">
            <x-frontend.request_form />
        </div>
        <section class="weOffer">
            <div class="container">
                <h2 class="text-center mb-5 mt-4 px-3 px-lg-0 px-xl-0 fs2">What Training We Offer?</h2>
                <div class="row pt-4">
                    <div class="col-12 col-md-4 col-lg-4 text-center" data-aos="flip-up">
                        <a class="weOfferBook" href="{{asset('frontend/pdf/T4E-Corporate-Training-Brochure-_Digital_Optimised.pdf')}}" target="_blank" rel="noopener noreferrer">
                            <img src="{{asset('frontend/img/T4E-Corporate-Training-Brochure-_Cover.webp')}}" class="img-fluid w-75 shadow-lg " alt="E-Brochure">
                            <span class="bbHover d-inline-block mt-5">View E-Brochure</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
            $(window).on('load', function() {
                AOS.refresh();
            });
        });



    </script>
@endpush
