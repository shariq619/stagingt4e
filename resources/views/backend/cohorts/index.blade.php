@extends('layouts.main')

@section('title', 'Cohort')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Cohort') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Cohort') }}</li>
        </ol>
    </div>



@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
@endpush

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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Cohort') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.cohorts.index') }}" method="GET"
                              class="d-flex align-items-center flex-wrap">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search Cohorts..."
                                       value="{{ request('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Year Filter -->
                            <div class="form-group mb-3 mr-2">
                                <select name="year" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="">All Years</option>
                                    @foreach($years as $y)
                                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Month Filter -->
                            <div class="form-group mb-3 mr-2">
                                <select name="month" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="">All Months</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Course Filter -->
                            <div class="form-group mb-3 mr-2">
{{--                                <select name="course_id" class="form-control form-control-sm select2" onchange="this.form.submit()">--}}
{{--                                    <option value="">All Courses</option>--}}
{{--                                    @foreach($courses as $id => $name)--}}
{{--                                        <option value="{{ $id }}" {{ request('course_id') == $id ? 'selected' : '' }}>{{ $name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}

                                <select name="course_id" class="form-control form-control-sm select2" onchange="this.form.submit()">
                                    <option value="">All Courses</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course['id'] }}"
                                            {{ request('course_id') == $course['id'] ? 'selected' : '' }}>
                                            {{ $course['name'] }}
                                        </option>
                                    @endforeach
                                </select>


                            </div>

                            <!-- Venue Filter -->
                            <div class="form-group mb-3 mr-2">
                                <select name="venue_id" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="">All Venues</option>
                                    @foreach($venues as $id => $name)
                                        <option value="{{ $id }}" {{ request('venue_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Trainer Filter -->
                            <div class="form-group mb-3 mr-2">
                                <select name="trainer_id" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="">All Trainers</option>
                                    @foreach($trainers as $id => $name)
                                        <option value="{{ $id }}" {{ request('trainer_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3 mr-2">
                                <a href="{{ route('backend.cohorts.index', array_merge(request()->query(), ['with_learners' => true])) }}"
                                   class="btn btn-sm btn-info {{ request('with_learners') ? 'active' : '' }}">
                                    <i class="fas fa-users"></i> Enrolled Learners
                                </a>
                            </div>

                            <!-- Reset Filters Button -->
                            <div class="form-group mb-3 mr-2">
                                <a href="{{ route('backend.cohorts.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-sync-alt"></i> Reset
                                </a>
                            </div>

                        </form>
                        @can('add category')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.cohorts.create') }}" class="btn btn-primary btn-lg shadow-sm rounded-circle" style="width: 50px; height: 50px; padding: 0; line-height: 50px;">
                                    <i class="fas fa-plus"></i>
                                    <span class="sr-only">{{ __('Add cohort') }}</span>
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="20%">{{ __('Course') }}</th>
                                @if(auth()->user()->email == "web@deans-group.co.uk")
                                    <th width="15%">{{ __('Status') }}</th>
                                @endif
                                 <th width="10%">{{ __('Venue') }}</th>
                                 <th width="10%">{{ __('Trainer') }}</th>

                                <th width="30%">
                                    <a
                                        href="{{ route('backend.cohorts.index', ['sort' => $sort == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('Start / End Date Time') }}
                                        @if ($sort == 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    </a>
                                </th>
                                {{-- <th width="10%">{{ __('Trainer') }}</th> --}}
                                {{-- <th width="">{{ __('Max Learners') }}</th> --}}

                                <th width="10%">{{ __('Reseller') }}</th>
                                <th width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($cohorts as $cohort)
                                <tr>
                                    <td>
                                        <p>{{ $cohort->course->name }} ({{ $cohort->course->reseller_name }})</p>

                                        <p></p>
                                        <p class="m-0"><strong>Max Learners: </strong><small>{{ $cohort->max_learner ?? '' }}</small></p>
                                        {{--<p class="m-0"><strong>Trainer: </strong><small>{{ $cohort->trainer->name ?? '' }}</small></p>--}}
                                        <p class="m-0"><strong>Client: </strong><small>{{ $cohort->corporateClient->name ?? '-' }}</small></p>
                                    </td>
                                    @if(auth()->user()->email == "web@deans-group.co.uk")
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input toggle-status"
                                                   id="toggleCohort{{ $cohort->id }}"
                                                   data-id="{{ $cohort->id }}"
                                                   data-status="{{ $cohort->cohort_status }}"
                                                {{ $cohort->cohort_status == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="toggleCohort{{ $cohort->id }}">
                                                {{ $cohort->cohort_status == 1 ? 'Active' : 'Inactive' }}
                                            </label>
                                        </div>
                                    </td>
                                    @endif
                                    <td>{{ $cohort->venue->venue_name ?? '' }}</td>
                                    <td>{{ $cohort->trainer->name ?? '' }}</td>

                                    <td>  {{  formatCourseDate($cohort)  }}</td>
                                    <td>{{ $cohort->reseller->name ?? "" }}</td>
                                    <td class="text-nowrap">
                                        <div class="d-flex align-items-center" style="gap: 8px;">
                                            <!-- View Learners Button -->
                                            <a href="{{ route('backend.cohorts.users', $cohort->id) }}"
                                               class="btn btn-sm btn-success d-flex align-items-center transition-all"
                                               style="border-radius: 4px; min-width: 110px; justify-content: center;">
                                                <i class="fas fa-user mr-2"></i>
                                                <span>View Learners <span class="badge badge-warning ml-2">{{ $cohort->learners_count }}</span></span>
                                            </a>

                                            @if ($cohort->name == 'Super Admin')
                                                <span class="badge badge-secondary align-self-center px-2 py-1">
                {{ __('Default') }}
            </span>
                                            @else
                                                @can('change cohorts')
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('backend.cohorts.edit', $cohort->id) }}"
                                                       class="btn btn-sm btn-warning d-flex align-items-center transition-all"
                                                       style="border-radius: 4px; min-width: 90px; justify-content: center;">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        <span>{{ __('Edit') }}</span>
                                                    </a>
                                                @endcan
                                            @endif
                                        </div>
                                    </td>

                                </tr>


                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <i>{{ __('Cohort Data is empty') }}</i>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $cohorts->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        $(document).on('click', '.toggle-status', function () {
            let button = $(this);
            let cohortId = button.data('id');
            let currentStatus = button.data('status');

            $.ajax({
                url: "{{ route('backend.cohorts.toggle-status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cohort_id: cohortId,
                    status: currentStatus == 1 ? 0 : 1  // Toggle between 1 and 0
                },
                success: function (response) {
                    if (response.success) {
                        button.data('status', response.new_status);
                        button.text(response.new_status == 1 ? 'Active' : 'Inactive');
                        button.toggleClass('btn-success btn-danger');
                    } else {
                        alert('Something went wrong!');
                    }
                },
                error: function () {
                    alert('Failed to update status!');
                }
            });
        });

        $('.select2').select2({
            placeholder: "Select Course", // Changed to match your select
            allowClear: true,
            theme: "bootstrap-5",
        });

    </script>
@endpush
