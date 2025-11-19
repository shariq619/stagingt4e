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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Application Form') }}
                    </h3>
                </div>
                <div class="card-body">
                    {{-- <div class="card-tools d-flex align-items-center justify-content-between"> --}}
                        <form action="{{ route('backend.application-forms.index') }}" method="GET">
                            {{-- <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search User..."
                                    value="{{ request()->get('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search User..."
                                        value="{{ request()->get('search') }}" style="height: calc(2.25rem + 2px);">
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
                                    <a href="{{ route('backend.application-forms.index') }}"
                                        class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    {{-- </div> --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="35%">{{ __('User') }}</th>
                                    <th width="20%">{{ __('email') }}</th>
                                    <th width="10%">{{ __('Status') }}</th>
                                    <th width="20%">{{ __('Comments') }}</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($application_forms as $application_form)
                                    <tr>
                                        <td>
                                            <p>{{ $application_form->father_name }} {{ $application_form->last_name }}</p>
                                            <p class="m-0"><strong>{{ __('D O B') }}:
                                                </strong>{{ $application_form->birth_date ?? '' }}</p>
                                            <p class="m-0"><strong>{{ __('Phone') }}:
                                                </strong>{{ $application_form->phone_number ?? '' }}</p>
                                            <p class="m-0"><strong>{{ __('Nationality') }}:
                                                </strong>{{ $application_form->nationality ?? '' }}</p>
                                        </td>
                                        {{-- <td>{{ $application_form->birth_date ?? "" }}</td> --}}
                                        {{-- <td>{{ $application_form->nationality ?? ""}}</td> --}}
                                        <td>{{ $application_form->email ?? '' }}</td>
                                        {{-- <td>{{ $application_form->phone_number ?? ""}}</td> --}}
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
                                        <td>{{ $application_form->comments }}</td>
                                        <td colspan="3">
                                            @if (isset($application_form) && $application_form->status == 'In Progress')
                                                <a target="_blank" href="{{ asset($application_form->learner_pdf) }}"
                                                    class="btn btn-primary btn-sm applicationBtnSize">View</a>
                                                <a href="{{ route('backend.application-forms.approve', $application_form->id) }}"
                                                    class="btn btn-success btn-sm applicationBtnSize">Approve</a>
                                                <button class="btn btn-danger btn-sm applicationBtnSize" data-toggle="modal"
                                                    data-target="#rejectModal"
                                                    data-profilephotoid="{{ $application_form->id }}">
                                                    Reject
                                                </button>
                                            @else
                                                <a target="_blank" href="{{ asset($application_form->learner_pdf) }}"
                                                    class="btn btn-primary btn-sm applicationBtnSize">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <i>{{ __('Application Forms Data is empty') }}</i>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-3">
                                {{ $application_forms->appends(request()->except('page'))->links() }}
                            </div>

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
                    <form id="rejectForm" method="POST" action="{{ route('backend.application-forms.reject', ['id' => 0]) }}">
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
