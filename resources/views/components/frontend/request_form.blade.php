<style>
    div#loadingSpinner {
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

    div#loadingSpinner i {
        color: #007bff;
    }

    .custom-section {
        background-color: #003d66;
        /* Dark blue overlay */
        color: white;
        padding: 60px 20px;
        background-blend-mode: multiply;

        background-size: cover;
        background-position: center;
    }

    .custom-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 61, 102, 0.8);
        /* Dark blue overlay with opacity */
        z-index: -1;
    }


    .custom-section {
        position: relative;
        background-image: url({{ asset('frontend/img/WhatsApp-Image-2023-02-20-at-10.04.30.webp') }});
        /* Replace with your background image */
        background-size: cover;
        background-position: center;
        color: white;
        /* Ensures text is readable */
        z-index: 1;
    }


    /* .custom-form .form-control {
        border-radius: 0;
    }

    .custom-btn {
        background-color: #ff6600;
        border-color: #ff6600;
        color: white;
        border-radius: 0;
        font-weight: bold;
    } */

    /* .custom-btn:hover {
        background-color: #cc5200;
        border-color: #cc5200;
    } */
</style>
<section class="{{ Request::is('corporate-training-solutions') ? 'customisedForm' : 'custom-section' }} py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <div class="mb-4 h1 text-white">We Can Bring Our Courses to You</div>
                <p class="font-weight-bold h5">Save your time, reduce travel costs, and reduce downtime!</p>
                <p>Please request a quote now to receive information tailored to your business needs.</p>
            </div>
            <div class="col-md-6 py-0" id="succ" data-aos="fade-left">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="custom-form formWrapper formSubmitHandler" method="POST"
                    action="{{ route('frontend.request.form.store') }}">
                    @csrf
                    <div class="position-relative">
                        <div id="loadingSpinner" style="display: none; text-align: center;">
                            <i class="fas fa-spinner fa-spin fa-3x"></i>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Your Name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="company_name"
                                class="form-control @error('company_name') is-invalid @enderror"
                                placeholder="Company Name" value="{{ old('company_name') }}">
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea name="training_needs" class="form-control @error('training_needs') is-invalid @enderror" rows="3"
                                placeholder="Tell Us about your training needs">{{ old('training_needs') }}</textarea>
                            @error('training_needs')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn custom-btn btn-block btnForm bgBtnSecondary">Request A
                            Quote</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@if (!Route::currentRouteNamed('home.index'))
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                $(document).on('submit', '.formSubmitHandler', function(e) {
                    e.preventDefault();

                    const self = $(this);
                    const url = self.attr('action');
                    const token = $('meta[name="csrf-token"]').attr('content');
                    const loading = $('#loadingSpinner');
                    const formData = new FormData(self[0]);
                    const button = self.find('button[type="submit"]');
                    button.prop('disabled', true).text('Submitting...');

                    loading.show();

                    $.ajax({
                            url: url,
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': token
                            }
                        })
                        .done(function(response) {
                            loading.hide();
                            button.prop('disabled', false).text('Submit');
                            self[0].reset();
                            toastr.success(response.message || 'Form submitted successfully.');

                            // Redirect to Thank You page after success
                            window.location.href = "{{ route('thank.you') }}";
                        })
                        .fail(function(xhr) {
                            console.error(xhr);
                            loading.hide();
                            button.prop('disabled', false).text('Submit');
                            let errorMessage = "Something went wrong! Please try again.";

                            if (xhr.responseJSON) {
                                if (xhr.responseJSON.errors) {
                                    $.each(xhr.responseJSON.errors, function(key, messages) {
                                        messages.forEach(function(message) {
                                            toastr.error(message);
                                        });
                                    });
                                    return;
                                } else if (xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                            } else if (xhr.responseText) {
                                errorMessage = xhr.responseText;
                            }

                            toastr.error(errorMessage);
                        })
                        .always(function() {
                            button.prop('disabled', false).text('Submit');
                            loading.hide();
                        });

                });
            });
        </script>
    @endpush
@endif
