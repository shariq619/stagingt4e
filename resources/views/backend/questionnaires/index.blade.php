@extends('layouts.main')

@section('title', 'Questionnaire Data')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Questionnaire') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Questionnaire') }}</li>
        </ol>
    </div>
@endsection

@push('css')
<style>


    .table-primary, .table-primary>td, .table-primary>th {
        background-color: #1a69ac;
    }

</style>
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

{{--        <div class="col-md-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title">--}}
{{--                        {{ __('📊 Questionnaire Answer Statistics') }}--}}
{{--                    </h3>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <canvas id="questionnaireChart" width="100%" height="40"></canvas>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Questionnaire') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.questionnaires-forms.index') }}" method="GET" class="d-flex  align-items-center">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search Questionnaire..."
                                    value="{{ request()->get('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-primary text-white">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Suggestion</th>
                                <th>Submitted At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($questionnaires as $index => $questionnaire)
                                <tr>
                                    <td>{{ $loop->iteration + ($questionnaires->currentPage() - 1) * $questionnaires->perPage() }}</td>
                                    <td>{{ $questionnaire->name }}</td>
                                    <td>{{ $questionnaire->email }}</td>
                                    <td>{{ $questionnaire->phone }}</td>
                                    <td>{{ $questionnaire->suggestion }}</td>
                                    <td>{{ \Carbon\Carbon::parse($questionnaire->created_at)->format('d M Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-warning mb-0">
                                            <i>No questionnaire submissions found.</i>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $questionnaires->links('pagination::bootstrap-4') }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

{{--@push('js')--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
{{--    <script>--}}
{{--        const chartData = {--}}
{{--            labels: {!! json_encode(array_keys($data)) !!}, // Q1 to Q6--}}
{{--            datasets: [--}}
{{--                {--}}
{{--                    label: 'Option A',--}}
{{--                    backgroundColor: '#4CAF50',--}}
{{--                    data: {!! json_encode(array_map(fn($q) => $q['A'], $data)) !!}--}}
{{--                },--}}
{{--                {--}}
{{--                    label: 'Option B',--}}
{{--                    backgroundColor: '#2196F3',--}}
{{--                    data: {!! json_encode(array_map(fn($q) => $q['B'], $data)) !!}--}}
{{--                },--}}
{{--                {--}}
{{--                    label: 'Option C',--}}
{{--                    backgroundColor: '#FFC107',--}}
{{--                    data: {!! json_encode(array_map(fn($q) => $q['C'], $data)) !!}--}}
{{--                }--}}
{{--            ]--}}
{{--        };--}}

{{--        const config = {--}}
{{--            type: 'bar',--}}
{{--            data: chartData,--}}
{{--            options: {--}}
{{--                responsive: true,--}}
{{--                plugins: {--}}
{{--                    title: {--}}
{{--                        display: true,--}}
{{--                        text: 'Distribution of Answers (A, B, C) per Question'--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        };--}}

{{--        const questionnaireChart = new Chart(--}}
{{--            document.getElementById('questionnaireChart'),--}}
{{--            config--}}
{{--        );--}}
{{--    </script>--}}
{{--@endpush--}}
