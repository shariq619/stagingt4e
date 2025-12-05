@extends('layouts.main')

@section('title', 'Video Feedback Detail')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Video Feedback Detail') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('backend.video-feedback.index') }}">{{ __('Video Feedback') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Detail') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <style>
        .vf-card { background:#fff; border-radius:.75rem; box-shadow:0 10px 25px rgba(15,23,42,.08); border:1px solid #e5e7eb; }
        .vf-badge { padding:.25rem .6rem; border-radius:.6rem; font-size:.75rem; font-weight:600; text-transform:capitalize; }
        .vf-label { font-size:.8rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:.04em; margin-bottom:.15rem; }
        .vf-value { font-size:.9rem; color:#111827; }
        .vf-consent-box { background:#f9fafb; border-radius:.75rem; border:1px solid #e5e7eb; padding:.75rem .9rem; font-size:.85rem; max-height:160px; overflow-y:auto; }
        .vf-btn { border-radius:.55rem; font-weight:500; padding:.35rem .85rem; }
    </style>
@endpush

@section('main')
    <div class="row">

        <div class="col-lg-7 mb-4">
            <div class="vf-card p-3 p-md-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">{{ $video->title ?: __('Video feedback') }}</h5>
                    @php
                        $cls = $video->status === 'approved' ? 'badge-success' :
                               ($video->status === 'rejected' ? 'badge-danger' : 'badge-warning');
                    @endphp
                    <span class="vf-badge {{ $cls }}">{{ ucfirst($video->status) }}</span>
                </div>

                <div class="mb-3">
                    <video controls style="width:100%; border-radius:.75rem; background:#020617;">
                        <source src="{{ Storage::disk($video->video_disk)->url($video->video_path) }}" type="video/{{ $video->video_format }}">
                    </video>
                </div>

                @if($video->message)
                    <div class="mb-3">
                        <div class="vf-label">{{ __('Message') }}</div>
                        <div class="vf-value">{{ $video->message }}</div>
                    </div>
                @endif

                <div class="d-flex flex-wrap align-items-center" style="display:none !important;">
                    @if($video->status !== 'approved')
                        <form method="POST" action="{{ route('backend.video-feedback.approve', $video->id) }}" class="mr-2 mb-2 js-video-approve-form">
                            @csrf
                            <button type="submit" class="btn btn-success vf-btn">
                                <i class="fas fa-check mr-1"></i> {{ __('Approve') }}
                            </button>
                        </form>
                    @endif

                    @if($video->status !== 'rejected')
                        <form method="POST" action="{{ route('backend.video-feedback.reject', $video->id) }}" class="mb-2 js-video-reject-form">
                            @csrf
                            <input type="hidden" name="review_notes" value="{{ $video->review_notes }}">
                            <button type="submit" class="btn btn-danger vf-btn">
                                <i class="fas fa-times mr-1"></i> {{ __('Reject') }}
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>

        <div class="col-lg-5 mb-4">

            <div class="vf-card p-3 p-md-4 mb-3">
                <h6 class="mb-3">{{ __('Learner & Submission Details') }}</h6>

                <div class="mb-2">
                    <div class="vf-label">{{ __('Learner') }}</div>
                    <div class="vf-value">
                        {{ optional($video->user)->name ?? __('Unknown') }}
                        @if(optional($video->user)->email)
                            <span class="text-muted small d-block">{{ optional($video->user)->email }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-2">
                    <div class="vf-label">{{ __('Submitted at') }}</div>
                    <div class="vf-value">{{ $video->created_at?->format('d M Y, H:i') }}</div>
                </div>

                <div class="mb-2">
                    <div class="vf-label">{{ __('IP Address') }}</div>
                    <div class="vf-value">{{ $video->ip_address ?: '—' }}</div>
                </div>

                <div class="mb-2">
                    <div class="vf-label">{{ __('Duration') }}</div>
                    <div class="vf-value">
                        @if($video->video_duration)
                            {{ $video->video_duration }} {{ __('seconds') }}
                        @else
                            {{ __('Not available') }}
                        @endif
                    </div>
                </div>

                <div class="mb-2">
                    <div class="vf-label">{{ __('File size') }}</div>
                    <div class="vf-value">
                        @if($video->video_size)
                            {{ number_format($video->video_size / 1024 / 1024, 2) }} MB
                        @else
                            {{ __('Unknown') }}
                        @endif
                    </div>
                </div>

                <div class="mb-2">
                    <div class="vf-label">{{ __('Reviewed by') }}</div>
                    <div class="vf-value">
                        @if($video->reviewed_by && $video->reviewed_at)
                            {{ optional($video->reviewer)->name ?? 'User '.$video->reviewed_by }}
                            <span class="text-muted small d-block">{{ $video->reviewed_at->format('d M Y, H:i') }}</span>
                        @else
                            {{ __('Not reviewed yet') }}
                        @endif
                    </div>
                </div>

                @if($video->review_notes)
                    <div class="mb-2">
                        <div class="vf-label">{{ __('Review notes') }}</div>
                        <div class="vf-value">{{ $video->review_notes }}</div>
                    </div>
                @endif
            </div>

            <div class="vf-card p-3 p-md-4">
                <h6 class="mb-3">{{ __('Consent') }}</h6>

                <div class="mb-2">
                    <div class="vf-label">{{ __('Consent given') }}</div>
                    <div class="vf-value">
                        @if($video->consent_given)
                            <span class="vf-badge badge-success">{{ __('Yes') }}</span>
                        @else
                            <span class="vf-badge badge-secondary">{{ __('No') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-2">
                    <div class="vf-label">{{ __('Consented at') }}</div>
                    <div class="vf-value">
                        @if($video->consent_at)
                            {{ $video->consent_at->format('d M Y, H:i') }}
                        @else
                            {{ __('Not recorded') }}
                        @endif
                    </div>
                </div>

                <div class="mb-2">
                    <div class="vf-label">{{ __('Consent text') }}</div>
                    <div class="vf-consent-box mt-1">{{ $video->consent_text }}</div>
                </div>

            </div>

        </div>

    </div>
@endsection

@push('js')
    <script>
        $(function () {
            if (typeof Swal === 'undefined') {
                $.getScript('https://cdn.jsdelivr.net/npm/sweetalert2@11');
            }

            $(document).on('submit', '.js-video-approve-form', function (e) {
                e.preventDefault();
                var f = this;

                Swal.fire({
                    icon: 'question',
                    title: '{{ __("Approve this video?") }}',
                    text: '{{ __("This learner video will be marked as approved for marketing use.") }}',
                    showCancelButton: true,
                    confirmButtonText: '{{ __("Yes, approve") }}',
                    cancelButtonText: '{{ __("Cancel") }}'
                }).then(function (r) { if (r.isConfirmed) f.submit(); });
            });

            $(document).on('submit', '.js-video-reject-form', function (e) {
                e.preventDefault();
                var f = this;

                Swal.fire({
                    icon: 'warning',
                    title: '{{ __("Reject this video?") }}',
                    text: '{{ __("This learner video will be marked as rejected.") }}',
                    showCancelButton: true,
                    confirmButtonText: '{{ __("Yes, reject") }}',
                    cancelButtonText: '{{ __("Cancel") }}'
                }).then(function (r) { if (r.isConfirmed) f.submit(); });
            });
        });
    </script>
@endpush
