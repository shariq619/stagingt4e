@if (!Route::currentRouteNamed('home.index'))
    <div class="modal fade myModal" id="bespokeForm" tabindex="-1" aria-labelledby="bespokeFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0 position-relative">
                <div class="text-center mt-4 h3">Request a Quote</div>
                <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close"
                    style="top:0;right:0;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="bespokeFormWrapper position-relative">
                            <div id="loadingSpinner2" style="display: none; text-align: center;">
                                <i class="fas fa-spinner fa-spin fa-3x"></i>
                            </div>
                            <form action="{{ route('bespoke.store') }}" method="POST" id="addBespoke">
                                @csrf
                                @honeypot
                                <div class="form-row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="text" name="first_name" class="form-control"
                                                placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="text" name="last_name" class="form-control"
                                                placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Entre your email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="tel" name="phone" class="form-control"
                                                placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="text" name="company_name" class="form-control"
                                                placeholder="Company Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="text" name="participant" class="form-control"
                                                placeholder="Participant">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="company_address" class="form-control"
                                                placeholder="Company Address">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="SIA Security Training" />
                                            <label class="form-check-label">SIA Security Training</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="CITB Health and safety awareness (HSA) - 1 day" />
                                            <label class="form-check-label">CITB Health and safety awareness (HSA) - 1
                                                day</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="CITB Site Supervision Safety Training Scheme (SSSTS) - 2 days" />
                                            <label class="form-check-label">CITB Site Supervision Safety Training Scheme
                                                (SSSTS) - 2
                                                days</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="CITB Site Supervision Safety Training Scheme Refresher (SSSTS-R) - 1 day" />
                                            <label class="form-check-label">CITB Site Supervision Safety Training Scheme
                                                Refresher
                                                (SSSTS-R) - 1 day</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="CITB Site Management Safety Training Scheme (SMSTS) - 5 days" />
                                            <label class="form-check-label">CITB Site Management Safety Training Scheme
                                                (SMSTS) - 5
                                                days</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="CITB Site Management Safety Training Scheme Refresher (SMSTS-R) - 2 days" />
                                            <label class="form-check-label">CITB Site Management Safety Training Scheme
                                                Refresher
                                                (SMSTS-R) - 2 days</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="EUSR National Water Hygiene Card – 1 day" />
                                            <label class="form-check-label">EUSR National Water Hygiene Card – 1
                                                day</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="EUSR SHEA Water - 1 day" />
                                            <label class="form-check-label">EUSR SHEA Water - 1 day</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="EUSR HSG47 Avoiding Danger from Underground Services (Cat and Geny) – 1 day" />
                                            <label class="form-check-label">EUSR HSG47 Avoiding Danger from Underground
                                                Services (Cat
                                                and Geny) – 1 day</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="EUSR SHEA Power - 1 day" />
                                            <label class="form-check-label">EUSR SHEA Power - 1 day</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="Traffic Marshal, Vehicle Banksman - 2 hours" />
                                            <label class="form-check-label">Traffic Marshal, Vehicle Banksman - 2
                                                hours</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="Fire Safety for fire Marshals/Wardens (Level 2) - 1 day" />
                                            <label class="form-check-label">Fire Safety for fire Marshals/Wardens
                                                (Level 2) - 1
                                                day</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="Fire Safety Awareness (Level 1) - 1 day" />
                                            <label class="form-check-label">Fire Safety Awareness (Level 1) - 1
                                                day</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="First Aid at Work - 3 days" />
                                            <label class="form-check-label">First Aid at Work - 3 days</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="courses[]"
                                                value="Emergency First Aid at Work - E-learning + half day" />
                                            <label class="form-check-label">Emergency First Aid at Work - E-learning +
                                                half day</label>
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control w-100"
                                                placeholder="Brief description of attendees or other relevant information:"></textarea>
                                            <p><strong>Training4Employment will use the information provided for the
                                                    purposes of dealing
                                                    with your enquiry. We also would like to get in touch with you with
                                                    relevant news
                                                    about other courses , promotions and progression opportunities by
                                                    email or text
                                                    messaging. Please indicate if you agree:</strong></p>
                                            <div class="form-check form-check-inline">
                                                <div><input class="form-check-input" type="radio"
                                                        name="promotions_allowed_email" value="yes" checked />
                                                    <label class="form-check-label">Yes</label>
                                                </div>
                                                <div class="ml-5"><input class="form-check-input" type="radio"
                                                        name="promotions_allowed_email" value="no" />
                                                    <label class="form-check-label">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="recaptcha-form" id="recaptcha-form-2">
                                    @if(app()->isProduction())
                                        {!! NoCaptcha::display() !!}
                                    @endif
                                </div>

                                <div id="recaptchaError"></div>
                                <span class="input-error" id="contactFormrecaptchaError"
                                    style="color:white; display:none; margin-top:5px;"></span>

                                <button type="submit" class="btn btn-primary mt-4">Submit</button>

                            </form>
{{--                            @if(app()->isProduction())--}}
{{--                                {!! NoCaptcha::renderJs() !!}--}}
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            #bespokeForm button.close {
                z-index: 9;
            }
    
            .bespokeFormWrapper input::placeholder {
                font-size: 14px;
            }
    
            .bespokeFormWrapper {
                padding: 40px;
            }
    
            .bespokeFormWrapper input,
            .bespokeFormWrapper textarea {
                border: solid 1px #ddd;
                box-shadow: #0000001a 0px 0px 5px 0px;
            }
    
            .bespokeFormWrapper .form-group textarea {
                margin-top: 30px;
                margin-bottom: 30px;
            }
    
            div#loadingSpinner2 {
                position: fixed;
                left: 0;
                right: 0;
                margin: auto;
                top: 0;
                bottom: 0;
                z-index: 99;
                background: #00000036;
                display: flex;
                align-items: center;
                justify-content: center;
            }
    
            div#loadingSpinner2 i {
                color: #007bff;
            }
        </style>
    @endpush
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                $('#addBespoke').submit(function(e) {
                    e.preventDefault();
    
                    const formData = new FormData(this);
                    const url = $(this).attr('action');
                    const token = $('meta[name="csrf-token"]').attr('content');
                    const submitButton = $(this).find('button[type="submit"]');
                    submitButton.prop("disabled", true).text("Submitting...");
    
                    $('#loadingSpinner2').show();
    
                    $.ajax({
                            url: url,
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': token
                            }
                        })
                        .then((response) => {
                            $('#loadingSpinner2').hide();
                            submitButton.prop("disabled", false).text("Submit");
                            toastr.success('Form submitted successfully');
                            $('#addBespoke')[0].reset();
                            $('#bespokeForm').modal('hide');
    
                        }).catch((xhr) => {
                            submitButton.prop("disabled", false).text("Submit");
                            $('#loadingSpinner2').hide();
                            const errors = xhr.responseJSON.errors;
                            if (errors['g-recaptcha-response']) {
                                $('#recaptchaError')
                                    .text(errors['g-recaptcha-response'][0])
                                    .show();
                            }
                            if (errors) {
                                $.each(errors, function(key, value) {
                                    toastr.error(value[0]);
                                });
                            } else {
                                toastr.error("Something went wrong! Please try again.");
                                console.error(xhr.responseText);
                            }
                        });
                });
            });
        </script>
    @endpush
@endif