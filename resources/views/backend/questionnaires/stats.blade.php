@extends('layouts.main')

@section('title', 'Stats')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('📊 Questionnaire Answer Statistics') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Questionnaire Answer Statistics') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Total Submissions: <span class="badge bg-primary">{{ $totalUsers }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="questionnaireChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = {
            labels: {!! json_encode(array_keys($data)) !!}, // Q1 to Q6
            datasets: [
                {
                    label: 'Option A',
                    backgroundColor: '#4CAF50',
                    data: {!! json_encode(array_map(fn($q) => $q['A'], $data)) !!}
                },
                {
                    label: 'Option B',
                    backgroundColor: '#2196F3',
                    data: {!! json_encode(array_map(fn($q) => $q['B'], $data)) !!}
                },
                {
                    label: 'Option C',
                    backgroundColor: '#FFC107',
                    data: {!! json_encode(array_map(fn($q) => $q['C'], $data)) !!}
                }
            ]
        };

        const config = {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribution of Answers (A, B, C) per Question'
                    }
                }
            }
        };

        const questionnaireChart = new Chart(
            document.getElementById('questionnaireChart'),
            config
        );
    </script>
@endpush
