@extends('layouts.main')

@section('title', 'Profile Photo')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Profile Photo') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Profile Photo') }}</li>
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
            <div class="card tableFs">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Profile Photo') }}
                    </h3>
                </div>
                <div class="card-body">

                    @if (auth()->user()->hasRole('Learner'))
                        <div class="alert alert-info" style="background-color:#007bff">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <strong>Profile Photo Guidelines:</strong><br>
                                    Please upload a clear, passport-style photo that meets the following criteria:
                                    <ul>
                                        <li>White background</li>
                                        <li>Face clearly visible and centered</li>
                                        <li>From shoulders to the top of the head</li>
                                        <li>No sunglasses, hats, or masks</li>
                                        <li>Image must be in JPG or PNG format</li>
                                    </ul>
                                </div>
                                <div class="col-md-4 text-center">
                                    <p><strong>Example of an acceptable photo:</strong></p>
                                    <img src="{{ asset('images/profile_photo_sample.png') }}" alt="Sample Profile Photo"
                                         style="max-width: 50%; border: 1px solid #ccc; padding: 5px;">
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (auth()->user()->hasRole('Super Admin'))
                        <form action="{{ route('backend.profile-photo.index') }}" method="GET">
                            {{-- <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search user..."
                                       value="{{ request('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search user..."
                                           value="{{ request('search') }}" style="height: calc(2.25rem + 2px);">
                                </div>
                                <div class="col-md-4">
                                    <select name="status" class="form-control">
                                        <option value="">-- Filter by Status --</option>
                                        <option
                                            value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>
                                            Approved
                                        </option>
                                        <option
                                            value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>
                                            Rejected
                                        </option>
                                        <option value="Not Submitted"
                                            {{ request('status') == 'Not Submitted' ? 'selected' : '' }}>Not Submitted
                                        </option>
                                        <option value="In Progress"
                                            {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <a href="{{ route('backend.profile-photo.index') }}"
                                       class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    @endif


                    @if (auth()->user()->hasRole('Learner'))
                        @if (!$profile_photo)
                            @can('add profile photo')
                                <div class="text-right mb-3">
                                    <a href="{{ route('backend.profile-photo.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle mr-2"></i>
                                        {{ __('Add Profile Photo') }}
                                    </a>
                                </div>
                            @endcan
                        @endif
                    @endif
                    <div class="table-responsive">
                        @if (auth()->user()->hasRole('Learner'))
                            @if ($profile_photo)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Comments') }}</th>
                                        @if ($profile_photo->status == 'Rejected')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $profile_photo->id }}</td>
                                        <td><img src="{{ asset($profile_photo->profile_photo) }}" alt="Profile Photo"
                                                 width="200" height="200" data-lity
                                                 data-lity-target="{{ asset($profile_photo->profile_photo) }}"></td>
                                        <td>
                                            @switch($profile_photo->status)
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
                                        <td>{{ $profile_photo->comments ?? '' }}</td>
                                        @if ($profile_photo->status == 'Rejected')
                                            <td>
                                                @can('change profile photo')
                                                    <a href="{{ route('backend.profile-photo.edit', $profile_photo->id) }}"
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        {{ __('Update') }}
                                                    </a>
                                                @endcan
                                            </td>
                                        @endif
                                    </tr>
                                    </tbody>
                                </table>
                            @endif
                        @else
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Comments') }}</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users_profile_photos as $profile_photo)
                                    <tr>
                                        <td>{{ $profile_photo->user->name ?? '' }} {{ $profile_photo->user->last_name ?? '' }}</td>
                                        @if (isset($profile_photo))
                                            <td><img src="{{ asset($profile_photo->profile_photo) }}"
                                                     alt="Profile Photo" data-lity
                                                     data-lity-target="{{ asset($profile_photo->profile_photo) }}"
                                                     width="100" height="100">
                                            </td>
                                        @else
                                            <td>-</td>
                                        @endif

                                        <td>
                                            @switch($profile_photo->status)
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
                                        <td>{{ $profile_photo->comments }}</td>
                                        <td colspan="2">
                                            @if (isset($profile_photo) && $profile_photo->status == 'In Progress')
                                                <a href="{{ route('backend.profile.photo.approve', $profile_photo->id) }}"
                                                   class="btn btn-success btn-sm">Approve</a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#rejectModal"
                                                        data-profilephotoid="{{ $profile_photo->id }}">
                                                    Reject
                                                </button>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $users_profile_photos->appends(request()->except('page'))->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Profile Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="rejectForm" method="POST" action="{{ route('backend.profile.photo.reject', ['id' => 0]) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
            integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#rejectModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var profilePhotoId = button.data('profilephotoid'); // Extract info from data-* attributes

            var form = $('#rejectForm');
            var action = form.attr('action').replace('/0', '/' + profilePhotoId);
            form.attr('action', action);
        });
    </script>
@endpush
