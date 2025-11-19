@extends('layouts.main')

@section('title', 'Risk Assessments')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Risk Assessments') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Risk Assessments') }}</li>
        </ol>
    </div>
@endsection

@section('main')
    <div class="container">
        <h1>Edit Risk Assessment</h1>
        <form action="{{ route('backend.risk-assessments.update', $riskAssessment) }}" method="POST">
            @method('PUT')
            @include('backend.risk_assessments.form')
        </form>
    </div>
@endsection
