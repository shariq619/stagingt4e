<div class="formModalAutoOpen">
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Get In Touch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="contactForm" action="{{ url('/submit-form') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label w-100">
                                <input type="text" class="form-control" name="first_name" placeholder=" " required>
                                <span>First name</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label w-100">
                                <input type="text" class="form-control" name="last_name" placeholder=" " required>
                                <span>Last name</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label w-100">
                                <input type="email" class="form-control" name="email" placeholder=" " required>
                                <span>Email</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var formSubmitted = {{ $formSubmitted ? 'true' : 'false' }};

            if (!formSubmitted) {
                $('#exampleModalCenter').modal('show');
            }

            $("#contactForm").submit(function(event) {
                event.preventDefault(); // Form submit hone se roke
                document.cookie = "form_submitted=true; path=/; max-age=" + (30 * 24 * 60 *
                60); // Cookie 30 din ke liye set karega
                this.submit(); // Ab actual form submit karega
            });
        });
    </script>
@endpush
