@extends('layouts.main')

@section('title', 'User')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Task') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.learner.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Task') }}</li>
            <li class="breadcrumb-item active">{{ __('Detail') }}</li>
        </ol>
    </div>
@endsection

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">

                </h3>
            </div>
            <div class="card-body">
                <div class="text-right mb-3">
                    <a href="{{ route('backend.learner.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Return') }}
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <h1>Form Response #{{ $formResponse->id }}</h1>
                        <p><strong>Submission ID:</strong> {{ $formResponse->submission_id }}</p>
                        <p><strong>Form ID:</strong> {{ $formResponse->form_id }}</p>
                        <p><strong>IP:</strong> {{ $formResponse->ip }}</p>
                        <h2>Response</h2>
                        <table class="table table-bordered">
                            <tbody>
                            @foreach($response as $key => $value)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>
                                        @if(is_array($value))
{{--                                            <li>{{ $key }}:</li>--}}
                                            <ul>
                                                @foreach ($value as $subKey => $subValue)
                                                    <li>{{ $subKey }}: {{ $subValue }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            @if (is_string($value) && str_starts_with($value, 'uploads/'))
                                                <a href="https://eu-files.jotform.com/{{ $value }}" target="_blank">
                                                    <img style="max-width: 100%; height: auto;" src="https://eu-files.jotform.com/{{ $value }}"  />
                                                </a>
                                            @else
                                               {{ $value }}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
