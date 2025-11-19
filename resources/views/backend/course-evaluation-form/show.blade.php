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
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
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

    @if(session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Course Evaluation Form - {{ $data['data']['username'] ?? 'N/A' }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Course Details</h4>
                            <p><strong>Training Centre:</strong> {{ $data['data']['Q1. Training centre'] ?? 'N/A' }}</p>
                            <p><strong>Course Date:</strong> {{ \Carbon\Carbon::parse($data['data']['Q2. Course Date'] ?? now())->format('d M Y H:i') }}</p>
                            <p><strong>Course Attended:</strong> {{ $data['data']['Q3. Course attended'] ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-6">
                            <h4>Trainer Details</h4>
                            <p><strong>Trainer Name:</strong> {{ $data['data']['Q10. Trainers Name'] ?? 'N/A' }}</p>
                            <p><strong>Status:</strong>
                                @if($response->status == 'In Progress')
                                    <span class="badge badge-warning">In Progress</span>
                                @elseif($response->status == 'Approved')
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-secondary">{{ $response->status }}</span>
                                @endif
                            </p>
                            <p><strong>Submitted At:</strong> {{ $response->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <hr>

                    <h4>Course Evaluation</h4>
                    <p><strong>Did the course meet your expectations?</strong> {{ implode(', ', $data['data']['Q4. Did the course meet your expectations?'] ?? []) }}</p>

                    <h5>Course Components Rating</h5>
                    <ul>
                        @foreach($data['data']['Q5. Did the course meet your expectations?'] ?? [] as $key => $value)
                            <li><strong>{{ $key }}:</strong> {{ implode(', ', $value) }}</li>
                        @endforeach
                    </ul>

                    <h5>Overall Impressions</h5>
                    <ul>
                        @foreach($data['data']['Q6. How would you rate your Overall impressions?'] ?? [] as $key => $value)
                            <li><strong>{{ $key }}:</strong> {{ implode(', ', $value) }}</li>
                        @endforeach
                    </ul>

                    <p><strong>Areas for improvement:</strong> {{ implode(', ', $data['data']['Q7. Do you feel there was any areas that we could improve?)'] ?? []) }}</p>
                    <p><strong>What did you enjoy most:</strong> {{ $data['data']['Q8. What did you enjoy most about the course?'] ?? 'N/A' }}</p>
                    <p><strong>Additional comments:</strong> {{ $data['data']['Q9. Any Further Notes/Comments?'] ?? 'N/A' }}</p>

                    <h4>Trainer Evaluation</h4>
                    <ul>
                        @foreach($data['data']['Q11. How would you rate the trainer\'s performance?'] ?? [] as $key => $value)
                            <li><strong>{{ $key }}:</strong> {{ implode(', ', $value) }}</li>
                        @endforeach
                    </ul>

                    <p><strong>Trainer comments:</strong> {{ implode(', ', $data['data']['Q12. Any Further Notes/Comments about your Trainer?'] ?? []) }}</p>

                    <h4>Recommendations</h4>
                    <p><strong>Would you recommend this course?</strong> {{ implode(', ', $data['data']['Q13. Would you recommend this course to others?'] ?? []) }}</p>
                    <p><strong>Would you take another course?</strong> {{ implode(', ', $data['data']['Q14. Would you take another course by the Training4Employment?'] ?? []) }}</p>
                    <p><strong>Interested in courses:</strong> {{ implode(', ', $data['data']['Q15. Please state which course you would be interested in'] ?? []) }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('backend.course-evaluation-form.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
    </script>
@endpush
