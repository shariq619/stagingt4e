@extends('layouts.main')

@section('title', 'Course Evaluation Form')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Course Evaluation Form') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Course Evaluation Form') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css"
        integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card tableFs">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Course Evaluation Form') }}
                    </h3>
                </div>
                <div class="card-body">


                    <!-- Statistics Section -->
                    {{-- <div class="row mb-4">
                        @php
                            $cards = [
                                [
                                    'title' => 'Total Responses',
                                    'value' => $stats['total_responses'],
                                    'bg' => 'primary',
                                    'suffix' => '',
                                ],
                                [
                                    'title' => 'Met Expectations',
                                    'value' => $stats['meet_expectations'],
                                    'bg' => 'success',
                                    'suffix' => '%',
                                ],
                                [
                                    'title' => 'Recommendation Rate',
                                    'value' => $stats['recommendation_rate'],
                                    'bg' => 'info',
                                    'suffix' => '%',
                                ],
                                [
                                    'title' => 'Would Take Another Course',
                                    'value' => $stats['take_another_course'],
                                    'bg' => 'warning',
                                    'suffix' => '%',
                                ],
                            ];
                        @endphp

                        @foreach ($cards as $card)
                            <div class="col-md-6 col-xl-3 mb-3">
                                <div class="card shadow-sm border-0 bg-{{ $card['bg'] }} text-white h-100">
                                    <div class="card-body d-flex flex-column justify-content-center">
                                        <h6 class="card-title text-uppercase small mb-2">{{ $card['title'] }}</h6>
                                        <h2 class="font-weight-bold mb-0">
                                            {{ $card['value'] }}{{ $card['suffix'] }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <!-- Rating Averages -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">Course Components Rating</h5>
                                </div>
                                <div class="card-body">
                                    @foreach ($stats['avg_ratings']['Q5'] as $component => $rating)
                                        <div class="mb-2">
                                            <strong>{{ $component }}:</strong>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ ($rating / 5) * 100 }}%"
                                                    aria-valuenow="{{ $rating }}" aria-valuemin="0"
                                                    aria-valuemax="5">
                                                    {{ $rating }}/5
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">Overall Impressions</h5>
                                </div>
                                <div class="card-body">
                                    @foreach ($stats['avg_ratings']['Q6'] as $impression => $rating)
                                        <div class="mb-2">
                                            <strong>{{ $impression }}:</strong>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ ($rating / 5) * 100 }}%"
                                                    aria-valuenow="{{ $rating }}" aria-valuemin="0"
                                                    aria-valuemax="5">
                                                    {{ $rating }}/5
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">Trainer Performance</h5>
                                </div>
                                <div class="card-body">
                                    @foreach ($stats['avg_ratings']['Q11'] as $aspect => $rating)
                                        <div class="mb-2">
                                            <strong>{{ $aspect }}:</strong>
                                            <div class="progress">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ ($rating / 5) * 100 }}%"
                                                    aria-valuenow="{{ $rating }}" aria-valuemin="0"
                                                    aria-valuemax="5">
                                                    {{ $rating }}/5
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Courses -->
                    <!-- Most Requested Future Courses -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">Most Requested Future Courses</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @forelse($stats['popular_courses'] as $course => $count)
                                            <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                                                <div class="card h-100 border-left border-primary shadow-sm">
                                                    <div class="card-body d-flex flex-column justify-content-center">
                                                        <h6 class="font-weight-bold text-dark">{{ $course }}</h6>
                                                        <p class="mb-0 text-muted">{{ $count }}
                                                            request{{ $count > 1 ? 's' : '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-muted">No course requests available.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Existing Table -->
                    <table class="table table-hover">
                        <!-- ... your existing table code ... -->
                    </table> --}}

                    <form action="{{ route('backend.course-evaluation-form.index') }}" method="GET"
                        class="d-flex align-items-center formUser flex-wrap gap-2">
                        <div class="input-group input-group-sm mb-3" style="width: 300px;">
                            <input type="text" name="search" class="form-control" placeholder="Search user..."
                                value="{{ request('search') }}" style="height: calc(2.25rem + 2px);">
                            {{-- <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div> --}}
                        </div>
                        <select name="course_id" class="form-control mx-1 mb-3" style="width: 180px;">
                            <option value="">All Courses</option>
                            @foreach (getFilterationData()['courses'] as $course)
                                @if (isset($course))
                                    <option value="{{ $course->id }}"
                                        {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        {{-- <select name="cohort_id" class="form-control mx-1 mb-3" style="width: 180px;">
                            <option value="">All Cohorts</option>
                            @foreach (getFilterationData()['cohorts'] as $cohort)
                                @if (isset($cohort))
                                <option value="{{ $cohort->id }}"
                                    {{ request('cohort_id') == $cohort->id ? 'selected' : '' }}>{{ $cohort->start_date_time }}
                                </option>
                                @endif
                            @endforeach
                        </select> --}}
                        <select name="venue_id" class="form-control mx-1 mb-3" style="width: 180px;">
                            <option value="">All Venues</option>
                            @foreach (getFilterationData()['venues'] as $venue)
                                @if (isset($venue))
                                    <option value="{{ $venue->id }}"
                                        {{ request('venue_id') == $venue->id ? 'selected' : '' }}>{{ $venue->venue_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <select name="trainer_id" class="form-control mx-1 mb-3" style="width: 180px;">
                            <option value="">All Trainers</option>
                            @foreach (getFilterationData()['trainers'] as $trainer)
                                @if (isset($trainer))
                                    <option value="{{ $trainer->id }}"
                                        {{ request('trainer_id') == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}
                                        {{ $trainer->last_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <button class="btn btn-primary mx-1 mb-3" type="submit">Filter</button>
                        <a class="btn btn-secondary mx-1 mb-3"
                            href="{{ route('backend.course-evaluation-form.index') }}">Reset</a>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Start Time</th>
                                    <th>Completion Time</th>
                                    <th>Knowledge of Subject Matter</th>
                                    <th>Presentation and Delivery Skills</th>
                                    <th>User</th>
                                    <th>Your E-mail address:</th>
                                    <th>Which Training Centre did you attend to:</th>
                                    <th>Overall Trainer Rating</th>
                                    <th>Which Course did you attend?</th>
                                    <th>Course date</th>
                                    <th>Trainer Name</th>
                                    <th>Did the course meet your expectations?</th>
                                    <th>Presentation and Course Materials</th>
                                    <th>Exercises and Practical Training</th>
                                    <th>Use of Class Time</th>
                                    <th>Joining Instructions/Pre-Course Materials</th>
                                    <th>Venue/Facilities</th>
                                    <th>Members of Staff (other than Trainer)</th>
                                    <th>What did you enjoy most about the course?</th>
                                    {{-- <th>Do you feel there was anything not included on this course?</th> --}}
                                    <th>Do you feel there was any areas that we could improve?</th>
                                    <th>Any Further Notes/Comments?</th>
                                    <th>Would you recommend this course to others?</th>
                                    <th>Would you take another course by the Training4Employment?</th>
                                    <th>Please state which course you would be interested in:</th>
                                    {{-- <th>How did you hear about this course?</th> --}}
                                    {{-- <th>Become A Partner E-mail</th>
                                    <th>Course info packs sent</th>
                                    <th>Follow Up Call</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($responses as $response)
                                    @php
                                        $data = json_decode($response->response, true);
                                        $username =
                                            $response->user->name . ' ' . $response->user->last_name ??
                                            ($data['data']['username'] ?? 'N/A');
                                        $training_centre = $data['data']['Q1. Training centre'] ?? 'N/A';
                                        $course_date_raw = $data['data']['Q2. Course Date'] ?? null;
                                        try {
                                            $course_date =
                                                $course_date_raw && strtotime($course_date_raw)
                                                    ? \Carbon\Carbon::parse($course_date_raw)->format('d M Y H:i')
                                                    : 'N/A';
                                        } catch (\Exception $e) {
                                            $course_date = 'N/A';
                                        }
                                        $course_attended = $data['data']['Q3. Course attended'] ?? 'N/A';
                                        $trainer_name = $data['data']['Q10. Trainers Name'] ?? 'N/A';
                                        // $status = $response->status;
                                        $submitted_at = $response->created_at->format('d/M/Y H:i:s');
                                        $completion_at = $response->updated_at->format('d/M/Y H:i:s');
                                    @endphp
                                    <tr>
                                        <td>{{ $response->id }}</td>
                                        <td>{{ $submitted_at }}</td>
                                        <td>{{ $completion_at }}</td>
                                        <td>
                                            {{ $data['data']['Q11. How would you rate the trainer\'s performance?']['Knowledge of Subject Matter'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q11. How would you rate the trainer\'s performance?']['Presentation and Delivery Skills)'][0] ?? 'N/A' }}
                                        </td>
                                        <td>{{ $username }}</td>
                                        <td>{{ $response->user->email ?? 'N/A' }}</td>
                                        <td>{{ $training_centre }}</td>
                                        <td>
                                            {{ $data['data']['Q11. How would you rate the trainer\'s performance?']['Overall Trainer Rating'][0] ?? 'N/A' }}
                                        </td>
                                        <td>{{ $course_attended }}</td>
                                        <td>{{ $course_date }}</td>
                                        <td>{{ $trainer_name }}</td>
                                        <td>
                                            {{ $data['data']['Q4. Did the course meet your expectations?'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q5. Did the course meet your expectations?']['Presentation and Course Materials'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q5. Did the course meet your expectations?']['Exercise and Practical Training'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q5. Did the course meet your expectations?']['Use of Class Time'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q6. How would you rate your Overall impressions?']['Joining Instructions/ Pre-Course Materials'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q6. How would you rate your Overall impressions?']['Venue/Facilities)'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q6. How would you rate your Overall impressions?']['Members of Staff (other than Trainer)'][0] ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $data['data']['Q8. What did you enjoy most about the course?'] ?? 'N/A' }}
                                        </td>
                                        {{-- <td>
                                            ????
                                        </td> --}}
                                        <td>
                                            {{ $data['data']['Q7. Do you feel there was any areas that we could improve?)'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q9. Any Further Notes/Comments?'] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q13. Would you recommend this course to others?'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q14. Would you take another course by the Training4Employment?'][0] ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $data['data']['Q15. Please state which course you would be interested in'][0] ?? 'N/A' }}
                                        </td>
                                        {{-- <td>???</td> --}}
                                        {{-- <td>???</td>
                                        <td>???</td>
                                        <td>???</td> --}}
                                        <td>
                                            <a href="{{ route('backend.course-evaluation-form.show', $response->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $responses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script></script>
@endpush
