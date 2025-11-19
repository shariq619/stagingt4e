{{-- 

For header Top Bar Component

<x-frontend.sticky-calendar /> 

--}}


{{--

    Subscription Popup

    Modal Code HTML

     <div class="formModalAutoOpen position-relative">
        <style>
            div#loadingSpinner {
                position: fixed;
                left: 0;
                right: 0;
                margin: auto;
                top: 0;
                bottom: 0;
                z-index: 9999;
                background: #00000036;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            div#loadingSpinner i {
                color: #007bff;
            }
        </style>
        <div id="loadingSpinner" style="display: none; text-align: center;">
            <i class="fas fa-spinner fa-spin fa-3x"></i>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="saleAnimate">
                        <div class="cell">
                            <div class="square hithere text-capitalize">Sign up Discount</div>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Receive an exclusive <br> £10 discount
                            towards our professional courses</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="contactForm" action="{{ route('subscriber.store') }}" method="POST">
                            @csrf
                            @honeypot
                            <div class="form-group">
                                <label class="col-form-label w-100">
                                    <input type="text" class="form-control" name="full_name" placeholder=" "
                                        autocomplete="off">
                                    <span>Full name</span>
                                </label>
                                <span class="input-error" style="color:red;"></span>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label w-100">
                                    <input type="email" class="form-control" name="email" placeholder=" "
                                        autocomplete="off">
                                    <span>Email</span>
                                </label>
                                <span class="input-error" style="color:red;"></span>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label w-100">
                                    <input type="tel" class="form-control" name="phone" placeholder=" "
                                        autocomplete="off">
                                    <span>Phone</span>
                                </label>
                                <span class="input-error" style="color:red;"></span>
                            </div>
                            <div class="recaptcha-form" id="recaptcha-form-3">
                                @if (app()->isProduction())
                                    {!! NoCaptcha::display() !!}
                                @endif
                            </div>
                            <span class="input-error" id="contactFormrecaptchaError"
                                style="color:white; display:none; margin-top:5px;"></span>

                            <button type="submit" class="btn btn-primary">Subscribe Now</button>
                            <p class="m-0 mt-3"><small><i class="fa-solid fa-asterisk text-danger"></i> terms and
                                    conditions applied.</small></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    Cockies Base Show Modal

        @php
        use Illuminate\Support\Facades\Cookie;
        $formSubmitted = cookie::get('form_submitted');
        $questionnaireFormSubmitted = cookie::get('questionnaire_form');
    @endphp

    @if (!$formSubmitted)
        <script>
            $(document).ready(function() {
                $('#exampleModalCenter').modal('show');
            });
        </script>
    @endif


    Modal Script


    <script defer>
        function getCookie(name) {
            let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? decodeURIComponent(match[2]) : null;
        }

        $(document).ready(function() {

            if (getCookie("form_submitted")) {
                console.log("Hiding modal because cookie is already set.");
                $('#exampleModalCenter').modal('hide');
            }


            $('#contactForm input[name="full_name"], #contactForm input[name="email"], #contactForm input[name="phone"]')
                .on('copy paste cut', function(e) {
                    e.preventDefault();
                });

            const formStartTime = Date.now();

            $("#contactForm").submit(function(e) {
                e.preventDefault();

                const timeSpent = (Date.now() - formStartTime) / 1000;
                if (timeSpent < 3) {
                    e.preventDefault();
                    return;
                }

                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const fullNameInput = form.find('input[name="full_name"]');
                const emailInput = form.find('input[name="email"]');
                const phoneInput = form.find('input[name="phone"]');


                const full_name = fullNameInput.val().trim();
                const email = emailInput.val().trim();
                const phone = phoneInput.val().trim();
                const contactFormrecaptchaError = grecaptcha.getResponse();

                form.find('span.input-error').remove();

                submitButton.prop('disabled', true).text('Submitting...');
                form.find('span.input-error').remove();

                let error = false;

                if (full_name === '') {
                    fullNameInput.after(
                        '<span class="input-error" style="color:white;display:block;margin-top:5px;">Please enter your full name.</span>'
                    );
                    error = true;
                }

                if (email === '') {
                    emailInput.after(
                        '<span class="input-error" style="color:white;display:block;margin-top:5px;">Please enter your email address.</span>'
                    );
                    error = true;
                } else if (!/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook)\.com$/.test(email)) {
                    emailInput.after(
                        '<span class="input-error" style="color:white;display:block;margin-top:5px;">Only Gmail, Yahoo, Hotmail, or Outlook email is allowed.</span>'
                    );
                    error = true;
                }

                if (phone === '') {
                    phoneInput.after(
                        '<span class="input-error" style="color:white;display:block;margin-top:5px;">Please enter your phone number.</span>'
                    );
                    error = true;
                }

                if (contactFormrecaptchaError.length === 0) {
                    $('#contactFormrecaptchaError').text('Please verify that you are not a robot.').show();
                    error = true;
                } else {
                    $('#contactFormrecaptchaError').hide();
                }

                if (error) {
                    submitButton.prop('disabled', false).text('Submit');
                    $('#loadingSpinner').hide();
                    return;
                }

                $('#loadingSpinner').show();

                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#loadingSpinner').hide();
                        submitButton.prop('disabled', false).text('Submit');
                        document.cookie = "form_submitted=true; path=/; max-age=" + (30 * 24 *
                            60 * 60);
                        $('#exampleModalCenter').modal('hide');

                        window.location = "{{ route('thank.you') }}";

                    },
                    error: function(xhr) {
                        $('#loadingSpinner').hide();
                        submitButton.prop('disabled', false).text('Submit');
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;

                            if (errors.full_name) {
                                fullNameInput.after(
                                    `<span class="input-error" style="color:white;display:block;margin-top:5px;">${errors.full_name[0]}</span>`
                                );
                            }

                            if (errors.email) {
                                emailInput.after(
                                    `<span class="input-error" style="color:white;display:block;margin-top:5px;">${errors.email[0]}</span>`
                                );
                            }

                            if (errors.phone) {
                                phoneInput.after(
                                    `<span class="input-error" style="color:white;display:block;margin-top:5px;">${errors.phone[0]}</span>`
                                );
                            }

                            if (errors['g-recaptcha-response']) {
                                $('#contactFormrecaptchaError')
                                    .text(errors['g-recaptcha-response'][0])
                                    .show();
                            }


                        } else {
                            // Handle other server errors (non-validation)
                            alert("Something went wrong. Please try again later.");
                        }
                    }
                });
            });
        });
    </script>

--}}