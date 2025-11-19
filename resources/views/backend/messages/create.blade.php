@extends('layouts.main')

@section('title', 'Messages')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Messages') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Messages') }}</li>
            <li class="breadcrumb-item active">{{ __('Create') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #6c757d;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            padding: 0 5px;
        }
    </style>
@endpush

@section('main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('backend.messages.index')  }}" class="btn btn-primary btn-block mb-3">Back to
                        Inbox</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Message</h3>
                        </div>
                        @include('backend.messages.partials.folders')
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Compose New Message</h3>
                        </div>

                        <div class="card-body">


                            <form action="{{ route('backend.messages.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                <div class="mb-3">
                                    <label for="recipient_id" class="form-label">To:</label>


                                    <select name="recipient_id[]" class="form-control" multiple required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} -
                                                @if(isset($user->roles) && $user->roles->isNotEmpty())
                                                    {{ $user->roles->pluck('name')->join(', ') }}
                                                @else
                                                    No roles assigned
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>


{{--                                    <select name="recipient_id[]" class="form-control" multiple required>--}}
{{--                                        <!-- Add multiple attribute -->--}}
{{--                                    @foreach($users as $user)--}}
{{--                                        @if(!$user->hasRole('learner')) <!-- Check if user does not have 'learner' role -->--}}
{{--                                            <option value="{{ $user->id }}">--}}
{{--                                                {{ $user->name }} ---}}
{{--                                                @if($user->roles->isNotEmpty())--}}
{{--                                                    {{ $user->roles->pluck('name')->join(', ') }}--}}
{{--                                                @else--}}
{{--                                                    No roles assigned--}}
{{--                                                @endif--}}
{{--                                            </option>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}

                                </div>


                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject:</label>
                                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="body" class="form-label">Message:</label>
                                    {{--                                <textarea name="body" class="form-control" rows="5" required></textarea>--}}
                                    <textarea name="body" id="mailBody" class="form-control" rows="5"></textarea>
                                    @error('body')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="attachments" class="form-label">Attachments:</label>
                                    <input type="file" name="attachments[]" class="form-control" multiple
                                           accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                    <small class="form-text text-muted">Maximum combined size: 5MB. Allowed file types:
                                        JPG, PNG, PDF, DOC, DOCX.</small>
                                    @error('attachments')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i>Send
                                        </button>
                                    </div>
                                </div>

                            </form>


                            {{--                        <div class="form-group">--}}
                            {{--                            <input class="form-control" placeholder="To:">--}}
                            {{--                        </div>--}}
                            {{--                        <div class="form-group">--}}
                            {{--                            <input class="form-control" placeholder="Subject:">--}}
                            {{--                        </div>--}}
                            {{--                        <div class="form-group">--}}
                            {{--                            <textarea id="mailBody" class="form-control"></textarea>--}}
                            {{--                        </div>--}}
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
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        // Initialize TinyMCE on the textarea
        tinymce.init({
            selector: 'textarea#mailBody', // Target the specific textarea with ID 'mailBody'
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
    </script>

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
    </script>




    <script>
        $(document).ready(function () {
            // Initialize Select2 on the recipient select box
            $('select[name="recipient_id[]"]').select2({
                placeholder: "Select recipients",
                allowClear: true
            });
        });
    </script>

@endpush
