@extends('layouts.main')

@section('title', 'Application Form')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Application Form') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Application Form') }}</li>
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

    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Application Form') }}
                    </h3>
                </div>
                <div class="card-body">
                    @if (!$application_form)
                        @can('add application-forms')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.application-forms.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add Application Form') }}
                                </a>
                            </div>
                        @endcan
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Last Name') }}</th>
                                    <th>{{ __('D O B') }}</th>
                                    <th>{{ __('Nationality') }}</th>
                                    <th>{{ __('email') }}</th>
                                    <th>{{ __('phone') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Comments') }}</th>
                                    @if (isset($application_form->status) == 'Rejected')
                                        <th>Action</th>
                                    @endif
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($application_form)
                                    <tr>
                                        <td>{{ $application_form->father_name ?? '' }}</td>
                                        <td>{{ $application_form->last_name ?? '' }}</td>
                                        <td>{{ $application_form->birth_date ?? '' }}</td>
                                        <td>{{ $application_form->nationality ?? '' }}</td>
                                        <td>{{ $application_form->email ?? '' }}</td>
                                        <td>{{ $application_form->phone_number ?? '' }}</td>

                                        <td>
                                            @switch($application_form->status)
                                                @case('Approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @break

                                                @case('Rejected')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @break

                                                @case('Not Submitted')
                                                    <span class="badge badge-secondary">Not Submitted</span>
                                                @break

                                                @default
                                                    <span class="badge badge-warning">In Progress</span>
                                            @endswitch
                                        </td>
                                        <td>{{ $application_form->comments ?? '' }}</td>

                                        <td>
                                            @if ($application_form->status == 'Rejected')
                                                @can('change application-forms')
                                                    <a href="{{ route('backend.application-forms.edit', $application_form->id) }}"
                                                        class="btn btn btn-warning">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        {{ __('Update') }}
                                                    </a>
                                                @endcan
                                            @endif
                                        </td>

                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            <i>{{ __('Application Forms Data is empty') }}</i>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
