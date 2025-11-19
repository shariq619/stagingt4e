@extends('layouts.main')

@section('title', 'Messages')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Messages') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Messages') }}</li>
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('backend.messages.create')  }}" class="btn btn-success btn-block mb-3">Compose</a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Folders</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    @include('backend.messages.partials.folders')
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-body p-0">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <!-- Display sender/recipient name based on context -->
                                        @if (Request::is('backend/messages/index*'))
                                            <td class="mailbox-name">{{ $message->sender->name ?? "Unknown Sender" }}</td>
                                        @endif
                                        @if (Request::is('backend/messages/sent*'))
                                            <td class="mailbox-name">{{ $message->recipient->name ?? "Unknown Recipient" }}</td>
                                        @endif
                                        <td class="mailbox-subject">
                                            {{ $message->subject }}
                                            @if (Request::is('backend/messages/index*'))
                                                @if ($message->is_read == 0)
                                                    <span class="badge bg-danger">New</span>
                                                    <!-- Show "New" badge for unread messages -->
                                                @endif
                                            @endif



                                        </td>
                                        <td>
                                            <!-- Display attachment icon if there are attachments -->
                                            @if ($message->attachments->isNotEmpty())
                                                <i class="fas fa-paperclip" title="This message has attachments"></i>
                                            @endif
                                        </td>
                                        <td class="mailbox-body">{!! Str::limit($message->body, 50) !!}</td>
                                        <td class="mailbox-date">{{ $message->created_at->diffForHumans() }}</td>
                                        <td>
                                            <!-- Button to open the modal -->
                                            {{--                                            <button class="btn btn-primary" data-toggle="modal" data-target="#messageModal{{ $message->id }}">--}}
                                            {{--                                                View--}}
                                            {{--                                            </button>--}}

                                            <button class="btn btn-primary" data-id="{{ $message->id }}"
                                                    data-toggle="modal" data-target="#messageModal{{ $message->id }}"
                                                    onclick="viewMessage({{ $message->id }})">
                                                View
                                            </button>


                                        </td>
                                    </tr>

                                    <!-- Modal for viewing the full message -->
                                    <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1"
                                         role="dialog" aria-labelledby="messageModalLabel{{ $message->id }}"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">
                                                        Message from {{ $message->sender->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $message->body !!}


                                                    @if ($message->attachments->isNotEmpty())
                                                        <hr>
                                                        <h5>Attachments:</h5>
                                                        <ul>
                                                            @foreach ($message->attachments as $attachment)
                                                                <li>
                                                                    <a href="{{ asset('storage/' . $attachment->filename) }}" target="_blank">
                                                                        {{ $attachment->filename }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif


                                                </div>

                                                @if (Request::is('backend/messages/sent*'))
                                                @else
                                                    <div class="modal-footer">
                                                        <!-- Button to trigger the reply form -->
                                                        <button class="btn btn-success" data-toggle="collapse"
                                                                data-target="#replyForm{{ $message->id }}"
                                                                aria-expanded="false"
                                                                aria-controls="replyForm{{ $message->id }}">
                                                            Reply
                                                        </button>
                                                    </div>
                                            @endif

                                            <!-- Reply form (collapsible inside the modal) -->
                                                <div class="collapse" id="replyForm{{ $message->id }}">
                                                    <form action="{{ route('backend.messages.reply', $message->id) }}"
                                                          method="POST" enctype="multipart/form-data">
                                                        @csrf

{{--                                                        @if ($errors->any())--}}
{{--                                                            <div class="alert alert-danger">--}}
{{--                                                                <ul>--}}
{{--                                                                    @foreach ($errors->all() as $error)--}}
{{--                                                                        <li>{{ $error }}</li>--}}
{{--                                                                    @endforeach--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        @endif--}}


                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="mailResponseBody">Reply</label>
                                                                <textarea name="body" class="form-control"
                                                                          id="mailResponseBody" rows="3"></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="attachments"
                                                                       class="form-label">Attachments:</label>
                                                                <input type="file" name="attachments[]"
                                                                       class="form-control" multiple
                                                                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                                                <small class="form-text text-muted">Maximum combined
                                                                    size: 5MB. Allowed file types: JPG, PNG, PDF, DOC,
                                                                    DOCX.</small>
                                                                @error('attachments')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Send Reply
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination links -->
                            <div class="d-flex justify-content-center">
                            {{ $messages->links() }} <!-- Display pagination links -->
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <!-- TinyMCE Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
    <script>
        // Initialize TinyMCE on the textarea
        tinymce.init({
            selector: 'textarea#mailResponseBody', // Target the specific textarea with ID 'mailBody'
            branding: false, // Remove TinyMCE branding
            plugins: 'code table lists', // Enable useful plugins like code, table, and lists
            menubar: false, // Disable the default menubar
            statusbar: true, // Enable the status bar at the bottom
            toolbar: 'bold italic underline | fontsizeselect | forecolor | bullist numlist | alignleft aligncenter alignright | link | blocks', // Define the toolbar layout
        });

        // On form submit, sync TinyMCE content to the actual textarea
        document.querySelector('form').addEventListener('submit', function (e) {
            tinymce.triggerSave(); // This ensures that the content is copied to the original textarea
        });


        function viewMessage(messageId) {
            $.ajax({
                url: '/backend/messages/view/' + messageId, // Route to fetch the message
                method: 'GET',
                success: function (response) {
                    // Assuming the response contains the message body
                    //  $('#messageModalBody').html(response); // Populate modal body with message
                    $('#messageModal').modal('show'); // Show the modal

                    // location.reload();

                },
                error: function (xhr) {
                    console.log('Error:', xhr);
                }
            });
        }

    </script>
@endpush
