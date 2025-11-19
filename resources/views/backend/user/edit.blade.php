@extends('layouts.main')

@section('title', 'User')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('User') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('User') }}</li>
            <li class="breadcrumb-item active">{{ __('Change') }}</li>
        </ol>
    </div>
@endsection

@section('main')

    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 carFormWrapper">
            <form action="{{ route('backend.users.update', $user) }}" enctype="multipart/form-data" method="POST"
                  id="{{($idFormEdit == true) ? 'editFormHandler': ''}}">
                @csrf
                @method('PUT')
                @include('backend.user._form')
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Change') }}
                            </button>
                            <a href="{{ route('backend.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>

                    </div>
                </div>
            </form>
            <hr>
            <div class="card mb-4">
                <div class="card-body">
{{--                    @can('delete user')--}}
{{--                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteUser">--}}
{{--                            <i class="fas fa-trash-alt mr-2"></i>--}}
{{--                            {{ __('Delete user') }}--}}
{{--                        </button>--}}
{{--                    @endcan--}}
                </div>
            </div>

            @can('delete user')
                {{-- Delete user --}}
                <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteUserLabel">{{ __('delete user') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('backend.users.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <div class="alert alert-danger">
                                        {{ __('delete user?') }}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times mr-2"></i>
                                        {{ __('Cancel') }}
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>

@endsection

@push('js')
    <script>
        document.getElementById('select_all').addEventListener('change', function (e) {
            let checkboxes = document.querySelectorAll('input[type="checkbox"][name="cohort_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
        });


        // document.addEventListener('DOMContentLoaded', function () {
        //     const corporate_client_id = document.getElementById('corporate_client_id');
        //     const userTypeSelect = document.getElementById('user_type');
        //     const cohortsSection = document.getElementById('cohorts_section');
        //     const corporateMessage = document.getElementById('corporate_message');
        //
        //     function toggleSections() {
        //         const userType = userTypeSelect.options[userTypeSelect.selectedIndex].text;
        //         if (userType === 'Corporate Client') {
        //             corporateMessage.style.display = 'block';
        //             corporate_client_id.style.display = 'none';
        //             cohortsSection.style.display = 'none';
        //         } else if (userType === 'Learner') {
        //             corporateMessage.style.display = 'none';
        //             cohortsSection.style.display = 'block';
        //             corporate_client_id.style.display = 'block';
        //         } else {
        //             corporateMessage.style.display = 'none';
        //             cohortsSection.style.display = 'none';
        //             corporate_client_id.style.display = 'block';
        //         }
        //     }
        //
        //     userTypeSelect.addEventListener('change', toggleSections);
        //     toggleSections(); // Initial check
        // });

        document.addEventListener('DOMContentLoaded', function () {
            const corporate_client_id = document.getElementById('corporate_client_id');
            const userTypeSelect = document.getElementById('user_type');
            const cohortsSection = document.getElementById('cohorts_section');

            const corporateMessage = document.getElementById('corporate_message');
            const categorySelect = document.getElementById('category_id');
            const courseSelect = document.getElementById('course_id');
            const dateSelect = document.getElementById('filter_date');
            const cohortsTable = document.getElementById('cohorts_table');

            @if($user->hasRole('Learner'))
                corporate_client_id.style.display = 'block';
            @else
                corporate_client_id.style.display = 'none';
            @endif



            function toggleSections() {
                const userType = userTypeSelect.options[userTypeSelect.selectedIndex].text;
                if (userType === 'Corporate Client') {
                    corporateMessage.style.display = 'block';
                    cohortsSection.style.display = 'none';
                    corporate_client_id.style.display = 'none';

                } else if (userType === 'Learner') {
                    corporate_client_id.style.display = 'block';
                    corporateMessage.style.display = 'block';
                    cohortsSection.style.display = 'block';

                } else {
                    corporate_client_id.style.display = 'none';
                    corporateMessage.style.display = 'none';
                    cohortsSection.style.display = 'none';

                }
            }

            function filterCohorts(page = 1) {
                const category_id = categorySelect.value;
                const course_id = courseSelect.value;
                const filter_date = dateSelect.value;

                $.ajax({
                    url: '{{ route('backend.users.filterCohorts') }}',
                    method: 'GET',
                    data: {
                        category_id: category_id,
                        course_id: course_id,
                        filter_date: filter_date,
                        page: page
                    },
                    success: function (response) {
                        cohortsTable.innerHTML = response.cohorts;
                        attachPaginationEvents(); // Re-attach events for pagination links
                    },
                    error: function (error) {
                        console.error('Error fetching filtered cohorts:', error);
                    }
                });
            }

            function attachPaginationEvents() {
                const paginationLinks = document.querySelectorAll('.pagination-links a');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const url = new URL(this.href);
                        const page = url.searchParams.get('page');
                        filterCohorts(page);
                    });
                });
            }

            userTypeSelect.addEventListener('change', toggleSections);
            categorySelect.addEventListener('change', () => filterCohorts());
            courseSelect.addEventListener('change', () => filterCohorts());
            dateSelect.addEventListener('change', () => filterCohorts());

            toggleSections(); // Initial check
            attachPaginationEvents(); // Initial attach for existing pagination links
        });


    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resendBtn = document.getElementById('resendEmailBtn');

            resendBtn?.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const email = document.querySelector('input[name="email"]').value;

                // Optional: confirm before sending
                if (!confirm(`Send welcome email to ${email}?`)) return;

                // Disable button while sending
                resendBtn.disabled = true;
                resendBtn.innerText = 'Sending...';

                fetch('{{ route('backend.users.ajaxResendEmail') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ user_id: userId, email: email })
                })
                    .then(res => res.json())
                    .then(data => {
                        alert(data.message);
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Error sending email!');
                    })
                    .finally(() => {
                        resendBtn.disabled = false;
                        resendBtn.innerText = 'Resend Email';
                    });
            });
        });
    </script>

@endpush
