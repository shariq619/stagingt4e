@extends('layouts.main')

@section('title', 'Course Pre Requisites')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Course Pre Requisites') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Course Pre Requisites') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.css"
        integrity="sha512-NDcw4w5Uk5nra1mdgmYYbghnm2azNRbxeI63fd3Zw72aYzFYdBGgODILLl1tHZezbC8Kep/Ep/civILr5nd1Qw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card tableFs">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Course Pre Requisites') }}
                    </h3>
                </div>
                <div class="card-body">
                    @if (auth()->user()->hasRole('Learner'))
                        @if (!$courseprerequisites)
                            @can('add course-pre-requisites')
                                <div class="text-right mb-3">
                                    <a href="{{ route('backend.course-pre-requisites.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle mr-2"></i>
                                        {{ __('Add Course Pre Requisites') }}
                                    </a>
                                </div>
                            @endcan
                        @endif
                    @endif

                    @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                        <form method="GET" action="{{ route('backend.course-pre-requisites.index') }}">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" name="learner_name" class="form-control"
                                        placeholder="Search by Learner Name" value="{{ request('learner_name') }}">
                                </div>
                                <div class="col-md-4">
                                    <select name="status" class="form-control">
                                        <option value="">-- Filter by Status --</option>
                                        <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>
                                            Approved</option>
                                        <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>
                                            Rejected</option>
                                        <option value="Not Submitted"
                                            {{ request('status') == 'Not Submitted' ? 'selected' : '' }}>Not Submitted
                                        </option>
                                        <option value="In Progress"
                                            {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <a href="{{ route('backend.course-pre-requisites.index') }}"
                                        class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    @endif


                    <div class="table-responsive">
                        @if (auth()->user()->hasRole('Learner'))
                            @if ($courseprerequisites)
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            @if (isset($courseprerequisites->course_certificate) && $courseprerequisites->qualification_type == 'external')
                                                <th>{{ __('Certificate') }}</th>
                                            @endif
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Certification') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Comments') }}</th>
                                            @if ($courseprerequisites->status == 'Rejected')
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $courseprerequisites->id }}</td>
                                            @if (isset($courseprerequisites->course_certificate) && $courseprerequisites->qualification_type == 'external')
                                                <td>

                                                    {{--                                            <img src="{{ asset($courseprerequisites->course_certificate) }}" --}}
                                                    {{--                                                 alt="Course Certificate" --}}
                                                    {{--                                                 width="200" height="200" data-lity --}}
                                                    {{--                                                 data-lity-target="{{ asset($courseprerequisites->course_certificate) }}"> --}}


                                                    <a href="{{ asset($courseprerequisites->course_certificate) }}"
                                                        data-lity class="btn btn-primary">
                                                        View
                                                    </a>


                                                </td>
                                            @endif
                                            <td>{{ ucfirst($courseprerequisites->qualification_type) }}</td>
                                            <td>{{ $courseprerequisites->certification->name ?? '' }}</td>
                                            <td>
                                                @switch($courseprerequisites->status)
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
                                            <td>{{ $courseprerequisites->comments ?? '' }}</td>
                                            @if ($courseprerequisites->status == 'Rejected')
                                                <td>
                                                    @can('change course-pre-requisites')
                                                        <a href="{{ route('backend.course-pre-requisites.edit', $courseprerequisites->id) }}"
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
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Certificate') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Certification') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Comments') }}</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courseprerequisites as $courseprerequisite)
                                        <tr>
                                            <td>{{ $courseprerequisite->id }}</td>
                                            <td>{{ $courseprerequisite->user->name ?? '' }}</td>
                                            @if (isset($courseprerequisite->course_certificate) && $courseprerequisite->qualification_type == 'external')
                                                <td>
                                                    {{--                                            <img src="{{ asset($courseprerequisite->course_certificate) }}" --}}
                                                    {{--                                                 alt="Course Certificate" --}}
                                                    {{--                                                 width="200" height="200" data-lity --}}
                                                    {{--                                                 data-lity-target="{{ asset($courseprerequisite->course_certificate) }}"> --}}

                                                    <a href="{{ asset($courseprerequisite->course_certificate) }}"
                                                        target="_blank" class="btn btn-primary">
                                                        View
                                                    </a>


                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{ ucfirst($courseprerequisite->qualification_type) }}</td>
                                            <td>{{ $courseprerequisite->certification->name ?? '' }}</td>
                                            <td>
                                                @switch($courseprerequisite->status)
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
                                            <td>{{ $courseprerequisite->comments ?? '' }}</td>
                                            @if ($courseprerequisite->qualification_type == 'external')
                                                <td colspan="2">
                                                    @if (isset($courseprerequisite) && $courseprerequisite->status == 'In Progress')
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('backend.course-pre-requisites.approve', $courseprerequisite->id) }}"
                                                                class="btn btn-success btn-sm mr-2">Approve</a>
                                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#rejectModal"
                                                                data-profilephotoid="{{ $courseprerequisite->id }}">
                                                                Reject
                                                            </button>
                                                        </div>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $courseprerequisites->appends(request()->except('page'))->links() }}
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
                    <h5 class="modal-title" id="rejectModalLabel">Reject Course Pre Requisites</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="rejectForm" method="POST"
                    action="{{ route('backend.course-pre-requisites.reject', ['id' => 0]) }}">
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
        $('#rejectModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var profilePhotoId = button.data('profilephotoid'); // Extract info from data-* attributes

            var form = $('#rejectForm');
            var action = form.attr('action').replace('/0', '/' + profilePhotoId);
            form.attr('action', action);
        });
    </script>
@endpush
