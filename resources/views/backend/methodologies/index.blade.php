@extends('layouts.main')

@section('title', 'Methodology')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Methodology') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Methodology') }}</li>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Methodologies') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools userDashboard d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.methodologies.index') }}" method="GET"
                              class="d-flex  align-items-center formUser">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control"
                                       placeholder="Search methodology..."
                                       value="{{ request()->get('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        @can('add methodology')
                            <div class="text-right mb-3">
                                <a href="{{ route('backend.methodologies.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add methodology') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Documents') }}</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($methodologies as $methodology)
                                <tr>
                                    <td>#{{ $methodology->id }}</td>
                                    <td>{{ $methodology->name }}</td>
                                    <td>
                                        @if ($methodology->documents)
                                            @foreach (json_decode($methodology->documents, true) as $document)
                                                <div class="d-flex align-items-center">
                                                    <a role="button" class="btn btn-success me-2" href="{{ asset($document) }}" target="_blank">View Document</a>
                                                    <form action="{{ route('backend.methodologies.deleteDocument', $methodology->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this document?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="document" value="{{ $document }}">
                                                        <button type="submit" class="ml-2 mb-2 btn btn-danger">Remove</button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        @else
                                            <i>No documents uploaded</i>
                                        @endif
                                    </td>

                                    <td>

                                        @can('change methodology')
                                            <a href="{{ route('backend.methodologies.edit', $methodology->id) }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit mr-2"></i>
                                                {{ __('Update') }}
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <i>{{ __('Methodologies not found') }}</i>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $methodologies->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (event) {
            if (!confirm('Are you sure you want to delete this document?')) {
                event.preventDefault();
            }
        });
    });
</script>
@endpush
