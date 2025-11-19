@extends('layouts.main')

@section('title', 'Proof of ID')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Proof of IDs') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Proof of ID') }}</li>
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
            <div class="card">
                <div class="card-body">

                    <form method="GET" action="{{ route('backend.document-uploads.index') }}">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" name="learner_name" class="form-control" placeholder="Search by Learner Name" value="{{ request('learner_name') }}">
                            </div>
                            <div class="col-md-4">
                                <select name="status" class="form-control">
                                    <option value="">-- Filter by Status --</option>
                                    <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="Not Submitted" {{ request('status') == 'Not Submitted' ? 'selected' : '' }}>Not Submitted</option>
                                    <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('backend.document-uploads.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>


                    <div class="table-responsive">
                            <!-- ADDDDDDDDDDDDMMMMMMMMMMMIIIIIIIIIIIIIIIIIIIINNNNNNNNNNNNNN -->
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('User') }}</th>

                                    <th>{{ __('First Front Upload') }}</th>
                                    <th>{{ __('First Back Upload') }}</th>

                                    <th>{{ __('Second Front Upload') }}</th>
                                    <th>{{ __('Second Back Upload') }}</th>
                                    <th>{{ __('Third Front Upload') }}</th>
                                    <th>{{ __('Third Back Upload') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Comments') }}</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users_documents as $doc)

                                    <tr>
                                        <td>{{ $doc->id }}</td>
                                        <td>{{ $doc->user->name ?? "" }} {{ $doc->user->last_name ?? "" }}</td>







                                        @if(isset($doc))

                                            <td class="text-center">

                                                <span class="badge badge-secondary mb-2">{{ $doc->first_option }}</span>



                                                <div class="d-flex flex-column" style="gap: 8px;">
                                                    <!-- View Button -->
                                                    <a href="{{ asset($doc->first_front_upload) }}"
                                                       data-lity
                                                       class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-eye mr-2"></i>
                                                        <span>View</span>
                                                    </a>

                                                    <!-- Download Button -->
                                                    <a href="{{ asset($doc->first_front_upload) }}"
                                                       download
                                                       class="btn btn-success btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-download mr-2"></i>
                                                        <span>Download</span>
                                                    </a>
                                                </div>
                                            </td>

                                        @else
                                            <td>-</td>
                                        @endif


                                        @if(isset($doc->first_back_upload))
                                            <td class="text-center">
                                                <div class="d-flex flex-column" style="gap: 8px;">
                                                    <!-- View Button -->
                                                    <a href="{{ asset($doc->first_back_upload) }}"
                                                       data-lity
                                                       class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-eye mr-2"></i>
                                                        <span>View</span>
                                                    </a>

                                                    <!-- Download Button -->
                                                    <a href="{{ asset($doc->first_back_upload) }}"
                                                       download
                                                       class="btn btn-success btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-download mr-2"></i>
                                                        <span>Download</span>
                                                    </a>
                                                </div>
                                            </td>
                                        @else
                                            <td>-</td>
                                        @endif





                                        @if(isset($doc))







                                            <td class="text-center">


                                                @if($doc->second_option)
                                                    @foreach(explode(',', $doc->second_option) as $option)
                                                        <span class="badge badge-secondary mb-2">{{ $option }}</span>
                                                    @endforeach
                                                @endif


                                                <div class="d-flex flex-column" style="gap: 8px;">
                                                    <!-- View Button -->
                                                    <a href="{{ asset($doc->second_front_upload) }}"
                                                       data-lity
                                                       class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-eye mr-2"></i>
                                                        <span>View</span>
                                                    </a>

                                                    <!-- Download Button -->
                                                    <a href="{{ asset($doc->second_front_upload) }}"
                                                       download
                                                       class="btn btn-success btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-download mr-2"></i>
                                                        <span>Download</span>
                                                    </a>
                                                </div>
                                            </td>



                                        @else
                                            <td>-</td>
                                        @endif

                                        @if(isset($doc->second_back_upload))
                                            <td class="text-center">
                                                <div class="d-flex flex-column" style="gap: 8px;">
                                                    <!-- View Button -->
                                                    <a href="{{ asset($doc->second_back_upload) }}"
                                                       data-lity
                                                       class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-eye mr-2"></i>
                                                        <span>View</span>
                                                    </a>

                                                    <!-- Download Button -->
                                                    <a href="{{ asset($doc->second_back_upload) }}"
                                                       download
                                                       class="btn btn-success btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-download mr-2"></i>
                                                        <span>Download</span>
                                                    </a>
                                                </div>
                                            </td>
                                        @else
                                            <td>-</td>
                                        @endif

                                        @if(isset($doc))
                                        <td class="text-center">


                                            @if($doc->second_option)
                                                @foreach(explode(',', $doc->second_option) as $option)
                                                    <span class="badge badge-secondary mb-2">{{ $option }}</span>
                                                @endforeach
                                            @endif



                                            <div class="d-flex flex-column" style="gap: 8px;">
                                                <!-- View Button -->
                                                <a href="{{ asset($doc->third_front_upload) }}"
                                                   data-lity
                                                   class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                                                   style="border-radius: 4px; min-width: 100px;">
                                                    <i class="fas fa-eye mr-2"></i>
                                                    <span>View</span>
                                                </a>

                                                <!-- Download Button -->
                                                <a href="{{ asset($doc->third_front_upload) }}"
                                                   download
                                                   class="btn btn-success btn-sm d-flex align-items-center justify-content-center"
                                                   style="border-radius: 4px; min-width: 100px;">
                                                    <i class="fas fa-download mr-2"></i>
                                                    <span>Download</span>
                                                </a>
                                            </div>
                                        </td>
                                        @else
                                            <td>-</td>
                                        @endif


                                        @if(isset($doc->third_back_upload))
                                            <td class="text-center">
                                                <div class="d-flex flex-column" style="gap: 8px;">
                                                    <!-- View Button -->
                                                    <a href="{{ asset($doc->third_back_upload) }}"
                                                       data-lity
                                                       class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-eye mr-2"></i>
                                                        <span>View</span>
                                                    </a>

                                                    <!-- Download Button -->
                                                    <a href="{{ asset($doc->third_back_upload) }}"
                                                       download
                                                       class="btn btn-success btn-sm d-flex align-items-center justify-content-center"
                                                       style="border-radius: 4px; min-width: 100px;">
                                                        <i class="fas fa-download mr-2"></i>
                                                        <span>Download</span>
                                                    </a>
                                                </div>
                                            </td>
                                        @else
                                            <td>-</td>
                                        @endif


                                        <td>
                                            @switch($doc->status)
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

                                        <td>
                                            @if($doc->comments)
                                                <button type="button"
                                                        class="btn btn-sm btn-secondary"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="{{ $doc->comments }}">
                                                    View
                                                </button>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>


                                        <td class="d-flex m-2" colspan="2">
                                            @if( isset($doc->first_option) &&  $doc->status == "In Progress"  )

                                                <a href="{{ route('backend.document-uploads.approve', $doc->id) }}"
                                                   class="btn btn-success mr-2">Approve</a>


                                                <button class="btn btn-danger" data-toggle="modal"
                                                        data-target="#rejectModal"
                                                        data-documentup="{{ $doc->id }}">
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

                        <div class="d-flex justify-content-center mt-4">
                           {{ $users_documents->appends(request()->except('page'))->links() }}
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
                    <h5 class="modal-title" id="rejectModalLabel">Reject Documents</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="rejectForm" method="POST" action="{{ route('backend.document-uploads.reject', ['id' => 0]) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Select documents to reject:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="reject_first_front_upload" name="rejected_documents[]" value="first_front">
                                <label class="form-check-label" for="reject_first_front_upload">
                                    First Front Upload
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="reject_first_back_upload" name="rejected_documents[]" value="first_back">
                                <label class="form-check-label" for="reject_first_back_upload">
                                    First Back Upload
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="reject_second_front_upload" name="rejected_documents[]" value="second_front">
                                <label class="form-check-label" for="reject_second_front_upload">
                                    Second Front Upload
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="reject_second_back_upload" name="rejected_documents[]" value="second_back">
                                <label class="form-check-label" for="reject_second_back_upload">
                                    Second Back Upload
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="reject_third_front_upload" name="rejected_documents[]" value="third_front">
                                <label class="form-check-label" for="reject_third_front_upload">
                                    Third Front Upload
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="reject_third_back_upload" name="rejected_documents[]" value="third_back">
                                <label class="form-check-label" for="reject_third_back_upload">
                                    Third Back Upload
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comments">Reason for rejection</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Reject Selected</button>
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
            var proofId = button.data('documentup'); // Extract info from data-* attributes

            var form = $('#rejectForm');
            var action = form.attr('action').replace('/0', '/' + proofId);
            form.attr('action', action);
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
