<footer id="footerWrapper" class="pt-5">
    <div class="container">
        <div class="row footerTop py-5">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget1">
                    <div class="footerIcon">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <p class="widgetTitle"><strong>Call</strong></p>
                    <p>Anytime, day or night—our phone lines are open 24/7 to assist with any questions or
                        concerns.</p>
{{--                    <a href="tel:01216302115">0121 630 2115</a>--}}
                    <a href="tel:08082808098">0808 280 8098</a>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 col-sm-6 col-12">
                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget2">
                    <div class="footerIcon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <p class="widgetTitle"><strong>Text</strong></p>
                    <p>Drop us a Message:</p>
                    <a href="tel:07904010700">07904 010 700</a>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 col-sm-6 col-12">
                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget3">
                    <div class="footerIcon">
                        <i class="far fa-envelope"></i>
                    </div>
                    <p class="widgetTitle"><strong>Email</strong></p>
                    <p>We will respond promptly</p>
                    <a href="sms:+07904010700?body=Hello%20there,%20I%20have%20a%20question%20for%20you.">Send an Email</a>
                </div>
            </div>
{{--            <div class="col-md-3 col-lg-5 col-xl-5 col-sm-6 col-12">--}}
{{--                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget4">--}}
{{--                    <p class="widgetTitle"><strong>Payment Options</strong></p>--}}
{{--                    <img src="{{ asset('frontend/img/Powered-by-Stripe.webp') }}" class="img-fluid"--}}
{{--                        alt="Powered-by-Stripe">--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="col-md-3 col-lg-5 col-xl-5 col-sm-6 col-12">
                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget4">
                    <p class="widgetTitle"><strong>Accreditations</strong></p>

                    <div class="row g-3 align-items-center">
                        <div class="col-6">
                            <img class="img-fluid w-75"
                                 src="{{ asset('images/Highfield Qualifications.webp') }}"
                                 alt="Highfield Qualifications"
                                 title="Highfield Logo">
                        </div>
                        <div class="col-6">
                            <img class="img-fluid w-75"
                                 src="{{ asset('images/CITB-Logo.webp') }}"
                                 alt="CITB Logo"
                                 title="CITB Logo">
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <div class="row footerBottom py-5">
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget5">
                    <img src="{{ asset('frontend/img/logo.webp') }}" class="img-fluid" alt="T4E">
                    <div class="footerSocial">
                        <a href="https://www.linkedin.com/company/10628798"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.facebook.com/training4employmentUK"><i
                                class="fab fa-facebook-square"></i></a>
                        <a href="https://www.youtube.com/@training4employment38"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.instagram.com/trainingforemployment/"><i class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/447904010700" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget6">
                    <p class="widgetTitle"><strong>Get to Know Us:</strong></p>
                    <ul class="list-unstyled p-0 m-0">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="https://training4employment.co.uk/blogs/">News & Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget7">
                    <p class="widgetTitle"><strong>Resources:</strong></p>
                    <ul class="list-unstyled p-0 m-0">
                        <li><a href="{{ route('expert.resources') }}">Resources</a></li>
                        <li><a href="{{ route('examination.requirements') }}">Examination Requirements</a></li>
                        <li><a href="{{ route('faq') }}">FAQ’s</a></li>
                        <li><a href="{{ route('booking.conditions') }}">Booking Terms and Conditions</a></li>
                        <li><a href="{{ route('courses.calender') }}" target="_blank">Course Calendar</a></li>
                    </ul>
                </div>
            </div>


            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-12">
                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget8">
                    <p class="widgetTitle"><strong>Privacy Policy:</strong></p>
                    <ul class="list-unstyled p-0 m-0">
                        <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

{{--            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-12">--}}
{{--                <div class="widgets mb-5 mb-lg-0 mb-xl-0 widget8">--}}
{{--                    <p class="widgetTitle"><strong>Orders & Returns:</strong></p>--}}
{{--                    <ul class="list-unstyled p-0 m-0">--}}
{{--                        <li><a href="javascript:;">Orders & Returns</a></li>--}}
{{--                        <li><a href="javascript:;">Shipping & Delivery</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="row copyRight justify-content-between">
            <div class="col-md-12 col-lg-4 col-xl-4 col-12">
{{--                <ul--}}
{{--                    class="list-unstyled p-0 m-0 d-flex justify-content-lg-start justify-content-xl-start justify-content-center">--}}
{{--                    <li><a href="javascript:;" class="mr-2">Orders & Returns:</a></li>--}}
{{--                    <li><a href="javascript:;" class="mr-2">Shipping & Delivery</a></li>--}}
{{--                </ul>--}}
            </div>
            <div class="col-md-12 col-lg-8 col-xl-8 col-12" >
                <p class="m-0 text-lg-right text-xl-right text-center"><a target="_blank"
                        href="http://www.deans-group.co.uk/">© {{ date('Y') }} Training 4 Employment. All rights
                        reserved. 07457750 –
                        part of Dean’s Group www.deans-group.co.uk</a></p>
            </div>
        </div>
    </div>
</footer>


<script defer>
document.addEventListener("DOMContentLoaded", function () {
    let marqueA = document.querySelector(".marqueA");
    let marque = document.querySelector(".marque");
    let lastScrollTop = 0;

    // Add hidden class on page load
    marque.classList.add("marque-hidden");

    window.addEventListener("scroll", function () {
        let scrollTop = window.scrollY;

        if (scrollTop === 0) {
            marque.classList.remove("marque-active");
            marque.classList.add("marque-hidden");
        } else if (scrollTop > lastScrollTop) {
            marque.classList.remove("marque-hidden");
            marque.classList.add("marque-active");

            marqueA.classList.add("marqueA-hidden");
        } else {
            marque.classList.remove("marque-hidden");
            marque.classList.remove("marque-active");

            marqueA.classList.remove("marqueA-hidden");
        }

        lastScrollTop = scrollTop;
    });
});
</script>
