@php use App\Models\UserHistory; @endphp
@extends('layouts.main')

@section('title', 'User')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Users') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('User') }}</li>
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
                        {{ __('Data User') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools userDashboard d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.users.index') }}" method="GET"
                            class="d-flex  align-items-center formUser">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search by id or name.."
                                    value="{{ request('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="filterByRole ml-5 d-flex align-items-center">
                                <div class="form-group">
                                    <select name="role" class="form-control" style="width:300px;">
                                        <option value="">All Roles</option>
                                        @foreach ($roles as $roleName)
                                            <option value="{{ $roleName->name }}"
                                                {{ request()->get('role') == $roleName->name ? 'selected' : '' }}>
                                                {{ ucfirst($roleName->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Sorting control (optional) -->
                                <input type="hidden" name="sort" value="{{ $sort }}">
                                <button type="submit" class="btn btn-primary ml-2">Filter</button>
                            </div>
                        </form>
                        @can('add user')
                            <div class="addUserBtn text-right mb-3">
                                <a href="{{ route('backend.users.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    {{ __('Add user') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="table-responsive tableWrapper usersDataTable">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><a
                                            href="{{ route('backend.users.index', ['sort' => $sort == 'asc' ? 'desc' : 'asc']) }}">
                                            ID
                                            @if ($sort == 'asc')
                                                <i class="fas fa-sort-up"></i>
                                            @else
                                                <i class="fas fa-sort-down"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    {{-- <th>{{ __('Date created') }}</th> --}}
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="searchHide">
                                @php
                                    $loggedUser = auth()->user();
                                @endphp
                                @forelse ($users as $user)
                                    <tr>
                                        <td>#{{ $user->id }}</td>
                                        <td>
                                            @if ($user->profilePhoto && $user->profilePhoto->profile_photo && $user->profilePhoto->status === 'Approved')
                                                <img src="{{ asset($user->profilePhoto->profile_photo) }}" class="img-fluid w-50" alt="User Image">
                                            @else
                                                <img src="{{ asset('images/placeholderimage.jpg') }}" class="img-fluid w-50" alt="Placeholder Image">
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($user->company) && $user->hasRole('Corporate Client'))
                                                <p class="m-0">{{ $user->company ?? '' }}</p>
                                            @else
                                                <p class="m-0">{{ $user->name }} {{ $user->middle_name ?? "" }} {{ $user->last_name ?? '' }}</p>
                                            @endif


                                            @if ($user->hasRole('Learner'))
                                                <p class="mb-0">
                                                    <small><strong>Company: </strong></small>
                                                    <small>{{ $user->client->company ?? '' }}</small>
                                                </p>
                                            @endif

                                            @if ($user->hasRole('Trainer'))
                                                <p class="mb-0">
                                                    <small><strong>PI Methodology: </strong></small>
                                                    <small>{{ $user->methodology->name ?? '' }}</small>
                                                </p>
                                            @endif

                                            <p class="mb-0">
                                                <small><strong>Date Created: </strong></small>
                                                <small>{{ $user->created_at->diffForHumans() }}</small>
                                            </p>

                                            <p class="mb-0">
                                                <small><strong>Phone: </strong></small>
                                                <small> {{ $user->telephone }}</small>
                                            </p>

                                            @if ($user->hasRole('Learner'))
                                            <p class="mb-0">
                                                <small><strong>Courses:</strong></small>
                                                @foreach($user->cohorts->unique('course_id') as $cohort)
                                                    @php
                                                        $course = $cohort->course;
                                                    @endphp
                                                    @if($course)
                                                        <span class="badge mr-1" style="background-color: {{ $course->color_code }}; color: #fff;">
                                                            {{ $course->name }} ({{ $cohort->trainer->name ?? '' }})
                                                        </span>
                                                    @endif
                                                @endforeach


                                            </p>
                                            @endif


                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $user_role)
                                                <span class="badge badge-info">{{ $user_role->name }}</span>
                                            @endforeach
                                        </td>
                                        {{-- <td></td> --}}
                                        <td>
                                            <div class="d-flex flex-wrap gap-2 mt-2">
                                            @if (in_array('Super Admin', $user->roles->pluck('name')->toArray()))
                                            @else
                                                @can('change user')
                                                    <a href="{{ route('backend.users.edit', $user) }}"
                                                        class="btn btn-warning btn-sm btnCust">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        {{ __('Change') }}
                                                    </a>
                                                @endcan
                                            @endif

{{--                                                @can('see user')--}}
{{--                                                <a href="{{ route('backend.users.show', $user) }}"--}}
{{--                                                    class="btn btn-secondary btn-sm btnCust">--}}
{{--                                                    <i class="fas fa-eye mr-2"></i>--}}
{{--                                                    {{ __('Detail') }}--}}
{{--                                                </a>--}}
{{--                                                @endcan--}}



                                                @php
                                                    $hasHistory = \App\Models\UserHistory::where('user_id', $user->id)->exists();
                                                @endphp

                                                @if($hasHistory)
                                                    <a href="{{ route('backend.user.history', $user) }}"
                                                       class="btn btn-secondary btn-sm btnCust">
                                                        <i class="fas fa-eye mr-2"></i>
                                                        {{ __('User History') }}
                                                    </a>
                                                @endif





                                                @canBeImpersonated($user, $guard = null)
                                                <a class="btn btn-success btn-sm btnCust"
                                                    href="{{ route('impersonate', $user->id) }}">
                                                    <i class="fas fa-key mr-2"></i> Login
                                                </a>
                                                @endCanBeImpersonated


                                            @if (config('app.SystemName') == 'Shariq' && auth()->user()->email == 'web@deans-group.co.uk')
                                                <br><br>
                                                <form action="{{ route('backend.users.destroy', $user->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btnCust">
                                                        <i class="fas fa-trash mr-2"></i>
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            @endif



                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted"><i>{{ __('No User Found') }}</i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $users->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
