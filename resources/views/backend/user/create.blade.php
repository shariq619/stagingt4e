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
            <li class="breadcrumb-item active">{{ __('Add') }}</li>
        </ol>
    </div>
@endsection

@section('main')

    {{--            <div class="card-header">--}}
    {{--                <h3 class="card-title">--}}
    {{--                    {{ __('Form tambah data User') }}--}}
    {{--                </h3>--}}
    {{--            </div>--}}
    <div class="row">
        <div class="col-md-12 carFormWrapper">
            <form action="{{ route('backend.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('backend.user._form')
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('backend.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@push('js')
    <script>
        document.getElementById('select_all').addEventListener('change', function(e){
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


            corporate_client_id.style.display = 'none';

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


@endpush
