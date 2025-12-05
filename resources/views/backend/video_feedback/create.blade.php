@extends('layouts.main')

@section('title', 'Video Feedback')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Video Feedback') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Video Feedback') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <style>
        .vf-card {
            background: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            border: 1px solid #e5e7eb;
        }
        .vf-tabs .nav-link {
            border-radius: 999px;
            padding: 0.35rem 1rem;
            font-weight: 500;
            color: #4b5563;
        }
        .vf-tabs .nav-link.active {
            background: #2563eb;
            color: #fff;
        }
        .vf-video-wrapper {
            background: #020617;
            border-radius: 0.75rem;
            padding: 0.75rem;
            position: relative;
        }
        .vf-video-wrapper video {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
            background: #000;
        }
        .vf-chip {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.7rem;
            border-radius: 999px;
            font-size: 0.75rem;
            background: #e0f2fe;
            color: #0369a1;
            font-weight: 500;
        }
        .vf-btn {
            border-radius: 999px;
            font-weight: 500;
        }
        .vf-btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.1rem;
            height: 2.1rem;
            border-radius: 999px;
            margin-right: 0.4rem;
        }
        .vf-btn-record {
            background: #ef4444;
            color: #fff;
        }
        .vf-btn-record.vf-recording {
            box-shadow: 0 0 0 0.35rem rgba(239, 68, 68, 0.25);
        }
        .vf-progress {
            height: 0.45rem;
            border-radius: 999px;
            overflow: hidden;
            background: #e5e7eb;
        }
        .vf-progress-bar {
            background: #22c55e;
        }
        .vf-consent-box {
            background: #f9fafb;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            padding: 0.75rem 0.9rem;
            font-size: 0.85rem;
            max-height: 140px;
            overflow-y: auto;
        }
        .vf-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
        }
        .vf-helper {
            font-size: 0.75rem;
            color: #6b7280;
        }
        .vf-badge-soft {
            font-size: 0.7rem;
            background: #eef2ff;
            color: #4f46e5;
            border-radius: 999px;
            padding: 0.15rem 0.6rem;
        }
        .vf-error {
            font-size: 0.8rem;
        }
    </style>
@endpush

@section('main')
    @if (session()->has('success'))
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible mb-0">
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

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li class="vf-error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="vf-card p-3 p-md-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h5 class="mb-1">Share your experience</h5>
                        <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                            Record a short video (up to 2 minutes) telling us about your training experience.
                        </p>
                    </div>
                    <span class="vf-chip">
                        <i class="fas fa-lock mr-1"></i> Secure upload
                    </span>
                </div>

                <ul class="nav nav-pills vf-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab-record" role="tab">
                            <i class="fas fa-video mr-1"></i> Record with camera
                        </a>
                    </li>
                    <li class="nav-item ml-1">
                        <a class="nav-link" data-toggle="pill" href="#tab-upload" role="tab">
                            <i class="fas fa-upload mr-1"></i> Upload a video
                        </a>
                    </li>
                </ul>

                <form id="video-feedback-form"
                      action="{{ route('backend.video-feedback.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="video_duration" id="video_duration">

                    <div class="tab-content mb-3">
                        <div class="tab-pane fade show active" id="tab-record" role="tabpanel">
                            <div class="vf-video-wrapper mb-2">
                                <video id="previewVideo" playsinline muted></video>
                                <div id="vf-record-overlay" class="position-absolute" style="right: 0.75rem; bottom: 0.75rem;">
                                    <span class="vf-badge-soft">
                                        <i class="fas fa-circle text-danger mr-1"></i>
                                        <span id="recordStatusLabel">Idle</span>
                                    </span>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap align-items-center mb-2">
                                <button type="button"
                                        id="btnStartRecording"
                                        class="btn btn-danger vf-btn mr-2 mb-2">
                                    <span class="vf-btn-icon vf-btn-record" id="recordIcon">
                                        <i class="fas fa-circle"></i>
                                    </span>
                                    <span id="recordBtnLabel">Start recording</span>
                                </button>

                                <button type="button"
                                        id="btnStopRecording"
                                        class="btn btn-outline-secondary vf-btn mr-2 mb-2"
                                        disabled>
                                    <i class="fas fa-stop mr-1"></i> Stop
                                </button>

                                <button type="button"
                                        id="btnResetRecording"
                                        class="btn btn-outline-light border vf-btn mb-2"
                                        disabled>
                                    <i class="fas fa-undo mr-1"></i> Reset
                                </button>

                                <div class="ml-auto d-flex align-items-center mb-2">
                                    <span class="vf-helper mr-2">
                                        <i class="fas fa-clock mr-1"></i>
                                        <span id="timerLabel">00:00</span> / 02:00
                                    </span>
                                </div>
                            </div>

                            <input type="file" id="hiddenRecordedFile" class="d-none">
                        </div>

                        <div class="tab-pane fade" id="tab-upload" role="tabpanel">
                            <div class="border rounded p-3 mb-2">
                                <div class="d-flex align-items-center mb-2">
                                    <div>
                                        <div class="vf-label mb-1">Upload a video file</div>
                                        <div class="vf-helper">
                                            MP4, WEBM or MOV. Max size 50 MB. Recommended length up to 2 minutes.
                                        </div>
                                    </div>
                                </div>
                                <input type="file"
                                       id="uploadVideoInput"
                                       name="video_file"
                                       accept="video/mp4,video/webm,video/quicktime"
                                       class="form-control-file">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="vf-progress mb-1 d-none" id="uploadProgressWrapper">
                            <div class="progress-bar vf-progress-bar" role="progressbar"
                                 style="width: 0%" id="uploadProgressBar"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="vf-helper" id="uploadStatusLabel"></span>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="title" class="vf-label">Title (optional)</label>
                        <input type="text"
                               name="title"
                               id="title"
                               class="form-control"
                               maxlength="150"
                               placeholder="My experience with Training4Employment">
                    </div>

                    <div class="form-group mb-3">
                        <label for="message" class="vf-label">Short message (optional)</label>
                        <textarea name="message"
                                  id="message"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Share any key highlight, what you enjoyed the most, or how this helped you."></textarea>
                        <span class="vf-helper">
                            This text will be saved along with your video feedback.
                        </span>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="vf-label mb-0">Consent to use your video</div>
                            <span class="vf-badge-soft">Required</span>
                        </div>
                        <div class="vf-consent-box mb-2">
                            {{ $consentText ?? '' }}
                        </div>
                        <input type="hidden" name="consent_text" value="{{ $consentText ?? '' }}">
                        <div class="form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="consent_given"
                                   name="consent_given"
                                   value="1">
                            <label class="form-check-label vf-helper" for="consent_given">
                                I have read and agree to the above consent terms.
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" id="btnSubmit" class="btn btn-primary vf-btn">
                            <i class="fas fa-paper-plane mr-1"></i>
                            Submit feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="vf-card p-3 p-md-4">
                <h6 class="mb-2">Tips for a great testimonial</h6>
                <ul class="mb-2 pl-3" style="font-size: 0.85rem; color: #4b5563;">
                    <li>Keep it under 2 minutes.</li>
                    <li>Use a quiet, well-lit space.</li>
                    <li>Introduce yourself and your programme.</li>
                    <li>Share one or two specific benefits or outcomes.</li>
                </ul>
                <div class="vf-helper mb-2">
                    By sending your video, you help future learners understand how this training can help them.
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function () {
            if (typeof window.Swal === 'undefined') {
                var s = document.createElement('script');
                s.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
                document.head.appendChild(s);
            }

            function showSwal(options) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire(options);
                } else {
                    var text = options.text || '';
                    if (!text && options.html) {
                        var tmp = document.createElement('div');
                        tmp.innerHTML = options.html;
                        text = tmp.innerText;
                    }
                    alert((options.title ? options.title + '\n\n' : '') + text);
                }
            }

            var mediaRecorder = null;
            var recordedChunks = [];
            var stream = null;
            var maxDurationSeconds = 120;
            var timerInterval = null;
            var elapsedSeconds = 0;
            var usingRecordTab = true;

            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr('href');
                usingRecordTab = target === '#tab-record';
                if (!usingRecordTab) {
                    stopRecordingInternal(true);
                }
            });

            function formatTime(seconds) {
                var m = Math.floor(seconds / 60);
                var s = seconds % 60;
                return (m < 10 ? '0' + m : m) + ':' + (s < 10 ? '0' + s : s);
            }

            function resetTimer() {
                elapsedSeconds = 0;
                $('#timerLabel').text('00:00');
            }

            function startTimer() {
                resetTimer();
                timerInterval = setInterval(function () {
                    elapsedSeconds++;
                    $('#timerLabel').text(formatTime(elapsedSeconds));
                    if (elapsedSeconds >= maxDurationSeconds) {
                        stopRecordingInternal(false);
                    }
                }, 1000);
            }

            function stopTimer() {
                if (timerInterval) {
                    clearInterval(timerInterval);
                    timerInterval = null;
                }
            }

            function setStatus(text) {
                $('#recordStatusLabel').text(text);
            }

            function setRecordingUI(isRecording) {
                if (isRecording) {
                    $('#btnStartRecording').prop('disabled', true);
                    $('#btnStopRecording').prop('disabled', false);
                    $('#btnResetRecording').prop('disabled', true);
                    $('#recordIcon').addClass('vf-recording');
                    $('#recordBtnLabel').text('Recording...');
                } else {
                    $('#btnStartRecording').prop('disabled', false);
                    $('#btnStopRecording').prop('disabled', true);
                    $('#btnResetRecording').prop('disabled', false);
                    $('#recordIcon').removeClass('vf-recording');
                    $('#recordBtnLabel').text('Start recording');
                }
            }

            function stopRecordingInternal(resetPreview) {
                if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                    mediaRecorder.stop();
                }
                if (stream) {
                    stream.getTracks().forEach(function (t) { t.stop(); });
                    stream = null;
                }
                stopTimer();
                setRecordingUI(false);
                if (resetPreview) {
                    $('#previewVideo').attr('src', '');
                    $('#previewVideo')[0].load();
                    $('#hiddenRecordedFile').val('');
                    $('#video_duration').val('');
                    recordedChunks = [];
                    setStatus('Idle');
                }
            }

            $('#btnStartRecording').on('click', function () {
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    showSwal({
                        icon: 'error',
                        title: 'Camera not supported',
                        text: 'Your browser does not support camera recording. Please use the Upload option instead.'
                    });
                    return;
                }

                resetTimer();
                recordedChunks = [];

                navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                    .then(function (s) {
                        stream = s;
                        var videoEl = $('#previewVideo')[0];
                        videoEl.srcObject = stream;
                        videoEl.muted = true;
                        videoEl.play();

                        var options = {};
                        if (MediaRecorder.isTypeSupported('video/webm;codecs=vp9')) {
                            options.mimeType = 'video/webm;codecs=vp9';
                        } else if (MediaRecorder.isTypeSupported('video/webm;codecs=vp8')) {
                            options.mimeType = 'video/webm;codecs=vp8';
                        } else if (MediaRecorder.isTypeSupported('video/webm')) {
                            options.mimeType = 'video/webm';
                        }

                        mediaRecorder = new MediaRecorder(stream, options);

                        mediaRecorder.ondataavailable = function (e) {
                            if (e.data && e.data.size > 0) {
                                recordedChunks.push(e.data);
                            }
                        };

                        mediaRecorder.onstop = function () {
                            var blob = new Blob(recordedChunks, { type: 'video/webm' });
                            var url = URL.createObjectURL(blob);
                            var videoEl = $('#previewVideo')[0];
                            videoEl.srcObject = null;
                            videoEl.src = url;
                            videoEl.muted = false;

                            videoEl.onloadedmetadata = function () {
                                var d = videoEl.duration;
                                if (!isFinite(d) || d <= 0) {
                                    d = elapsedSeconds > 0 ? elapsedSeconds : null;
                                }
                                if (d !== null) {
                                    $('#video_duration').val(Math.round(d));
                                } else {
                                    $('#video_duration').val('');
                                }
                            };

                            $('#uploadVideoInput').val('');
                            setStatus('Ready to submit');
                        };

                        mediaRecorder.start(1000);
                        setStatus('Recording');
                        setRecordingUI(true);
                        startTimer();
                    })
                    .catch(function () {
                        showSwal({
                            icon: 'error',
                            title: 'Camera access blocked',
                            text: 'Please allow camera and microphone access or use the Upload tab.'
                        });
                        setStatus('Idle');
                    });
            });

            $('#btnStopRecording').on('click', function () {
                stopRecordingInternal(false);
            });

            $('#btnResetRecording').on('click', function () {
                stopRecordingInternal(true);
            });

            var directFileSelected = false;

            $('#uploadVideoInput').on('change', function () {
                var file = this.files[0];
                if (!file) {
                    directFileSelected = false;
                    return;
                }
                directFileSelected = true;
                $('#video_duration').val('');
                setStatus('');
                $('#previewVideo').attr('src', '');
                $('#previewVideo')[0].load();
            });

            $('#video-feedback-form').on('submit', function (e) {
                e.preventDefault();

                $('#uploadStatusLabel').text('');
                $('#uploadProgressWrapper').removeClass('d-none');
                $('#uploadProgressBar').css('width', '0%');
                $('#btnSubmit').prop('disabled', true);

                var formData = new FormData(this);

                if (usingRecordTab && !directFileSelected) {
                    if (!recordedChunks.length) {
                        var msg = 'Please record a video or use the upload option.';
                        $('#uploadStatusLabel').text(msg);
                        $('#btnSubmit').prop('disabled', false);
                        $('#uploadProgressWrapper').addClass('d-none');
                        showSwal({
                            icon: 'error',
                            title: 'Missing video',
                            text: msg
                        });
                        return;
                    }
                    var recordedBlob = new Blob(recordedChunks, { type: 'video/webm' });
                    formData.delete('video_file');
                    formData.append('video_file', recordedBlob, 'testimonial.webm');
                } else {
                    if (!$('#uploadVideoInput')[0].files.length) {
                        var msg2 = 'Please select a video file to upload.';
                        $('#uploadStatusLabel').text(msg2);
                        $('#btnSubmit').prop('disabled', false);
                        $('#uploadProgressWrapper').addClass('d-none');
                        showSwal({
                            icon: 'error',
                            title: 'Missing video',
                            text: msg2
                        });
                        return;
                    }
                }

                $.ajax({
                    url: $('#video-feedback-form').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (evt) {
                            if (evt.lengthComputable) {
                                var percent = Math.round((evt.loaded / evt.total) * 100);
                                $('#uploadProgressBar').css('width', percent + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (resp) {
                        $('#uploadStatusLabel').text(resp.message || 'Video submitted successfully.');
                        $('#uploadProgressBar').css('width', '100%');
                        $('#btnSubmit').prop('disabled', false);

                        recordedChunks = [];
                        $('#uploadVideoInput').val('');
                        $('#title').val('');
                        $('#message').val('');
                        $('#consent_given').prop('checked', false);
                        $('#video_duration').val('');
                        $('#previewVideo').attr('src', '');
                        $('#previewVideo')[0].load();
                        setStatus('Idle');

                        setTimeout(function () {
                            $('#uploadProgressWrapper').addClass('d-none');
                        }, 1200);

                        showSwal({
                            icon: 'success',
                            title: 'Thank you!',
                            text: 'Your video feedback has been submitted.'
                        });
                    },
                    error: function (xhr) {
                        $('#btnSubmit').prop('disabled', false);
                        $('#uploadProgressWrapper').addClass('d-none');

                        var messages = [];
                        var labelText = '';

                        if (xhr.status === 422) {
                            var json = xhr.responseJSON;
                            if (!json && xhr.responseText) {
                                try {
                                    json = JSON.parse(xhr.responseText);
                                } catch (e) {}
                            }

                            if (json && json.errors) {
                                Object.keys(json.errors).forEach(function (field) {
                                    json.errors[field].forEach(function (msg) {
                                        messages.push(msg);
                                    });
                                });
                            }
                        }

                        if (!messages.length) {
                            labelText = 'Something went wrong while uploading the video.';
                            $('#uploadStatusLabel').text(labelText);
                            showSwal({
                                icon: 'error',
                                title: 'Upload failed',
                                text: labelText
                            });
                            return;
                        }

                        labelText = messages.join(' ');
                        $('#uploadStatusLabel').text(labelText);

                        var htmlList = '<ul style="text-align:left; margin:0; padding-left:18px;">' +
                            messages.map(function (m) {
                                return '<li>' + m + '</li>';
                            }).join('') +
                            '</ul>';

                        showSwal({
                            icon: 'error',
                            title: 'Please fix the following:',
                            html: htmlList
                        });
                    }
                });
            });
        });
    </script>
@endpush

