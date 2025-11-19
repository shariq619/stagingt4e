@php use App\Models\UserHistory; @endphp
@extends('layouts.main')

@section('title', 'Resellers')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Resellers') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Resellers') }}</li>
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
    @if (session()->has('error'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Resellers List') }}
                    </h3>
                    <div class="card-tools">
                        @can('add reseller')
                            <a href="{{ route('backend.resellers.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ __('Add Reseller') }}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company Name</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($resellers as $reseller)
                                <tr>
                                    <td>{{ $reseller->id }}</td>
                                    <td>{{ $reseller->company_name }}</td>
                                    <td>{{ $reseller->contact_person }}</td>
                                    <td>{{ $reseller->email }}</td>
                                    <td>{{ $reseller->phone }}</td>
                                    <td>
                                            <span class="badge badge-{{ $reseller->status === 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($reseller->status) }}
                                            </span>
                                    </td>
                                    <td>
{{--                                        @can('see reseller')--}}
{{--                                            <a href="{{ route('backend.resellers.show', $reseller) }}" class="btn btn-sm btn-info">--}}
{{--                                                <i class="fas fa-eye"></i>--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}
                                        @can('change reseller')
                                            <a href="{{ route('backend.resellers.edit', $reseller) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete reseller')
                                            <form action="{{ route('backend.resellers.destroy', $reseller) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $resellers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
