@extends('layouts.main')

@section('title', 'My Video Feedback')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('My Video Feedback') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('My Video Feedback') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <style>
        .vf-card {
            background: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(15,23,42,0.08);
            border: 1px solid #e5e7eb;
        }
        .vf-header-title {
            font-weight: 600;
            font-size: 1.05rem;
            color:#111827;
        }
        .vf-header-sub {
            font-size: 0.80rem;
            color:#6b7280;
        }
        .vf-btn {
            border-radius: 0.55rem;
            font-weight: 500;
            padding: .35rem .85rem;
        }
        .vf-badge {
            padding: .3rem .6rem;
            border-radius: .5rem;
            font-size: .75rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .gap-2 > * { margin-right: .5rem; }
        .gap-2 > *:last-child { margin-right: 0; }
    </style>
@endpush

@section('main')
    <div class="vf-card mb-4">
        <div class="card-header bg-white border-0 py-3 px-4 d-flex align-items-center">
            <div>
                <div class="vf-header-title">{{ __('Your submitted videos') }}</div>
                <div class="vf-header-sub">
                    {{ __('This list updates in real-time. You can refresh manually if needed.') }}
                </div>
            </div>

            <div class="d-flex gap-2 ml-auto">
                <a href="{{ route('backend.video-feedback.create') }}"
                   class="btn btn-primary btn-sm vf-btn d-flex align-items-center">
                    <i class="fas fa-plus-circle mr-1"></i> {{ __('Submit new') }}
                </a>
                <button type="button"
                        id="btn-refresh-my-videos"
                        class="btn btn-outline-secondary btn-sm vf-btn d-flex align-items-center">
                    <i class="fas fa-sync-alt mr-1"></i> {{ __('Refresh') }}
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <div id="my-videos-loading" class="p-3 text-muted">
                <i class="fas fa-spinner fa-spin mr-1"></i> {{ __('Loading your submissions...') }}
            </div>

            <div id="my-videos-empty" class="p-3 text-muted d-none">
                {{ __('You have not submitted any video feedback yet.') }}
                <a href="{{ route('backend.video-feedback.create') }}">{{ __('Submit your first one here.') }}</a>
            </div>

            <div class="table-responsive d-none" id="my-videos-table-wrapper">
                <table class="table table-hover mb-0">
                    <thead style="background:#f9fafb;">
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Submitted at') }}</th>
                        <th style="width: 120px;">{{ __('Preview') }}</th>
                    </tr>
                    </thead>
                    <tbody id="my-videos-tbody"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function () {
            var isLoading = false;
            var refreshIntervalMs = 30000;

            function badge(status) {
                if (status === 'approved') return '<span class="vf-badge badge-success">approved</span>';
                if (status === 'rejected') return '<span class="vf-badge badge-danger">rejected</span>';
                return '<span class="vf-badge badge-warning">pending</span>';
            }

            function loading(state) {
                isLoading = state;
                if (state) $('#my-videos-loading').removeClass('d-none');
                else $('#my-videos-loading').addClass('d-none');
            }

            function loadVideos() {
                if (isLoading) return;
                loading(true);

                $.ajax({
                    url: '{{ route('backend.video-feedback.my.data') }}',
                    method: 'GET',
                    dataType: 'json',
                    success: function (resp) {
                        loading(false);
                        var data = resp.data || [];
                        var tbody = $('#my-videos-tbody');
                        tbody.empty();

                        if (!data.length) {
                            $('#my-videos-empty').removeClass('d-none');
                            $('#my-videos-table-wrapper').addClass('d-none');
                            return;
                        }

                        $('#my-videos-empty').addClass('d-none');
                        $('#my-videos-table-wrapper').removeClass('d-none');

                        data.forEach(function (v) {
                            var msg = v.message ? '<div class="text-muted small mt-1">' + v.message + '</div>' : '';
                            var row =
                                '<tr>' +
                                '<td>' + v.title + msg + '</td>' +
                                '<td>' + badge(v.status) + '</td>' +
                                '<td>' + (v.created_at || '') + '</td>' +
                                '<td><a href="' + v.video_url + '" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fas fa-play mr-1"></i>{{ __("Play") }}</a></td>' +
                                '</tr>';
                            tbody.append(row);
                        });
                    },
                    error: function () {
                        loading(false);
                        $('#my-videos-empty').removeClass('d-none').text('{{ __("Unable to load your submissions right now.") }}');
                        $('#my-videos-table-wrapper').addClass('d-none');
                    }
                });
            }

            $('#btn-refresh-my-videos').on('click', loadVideos);

            loadVideos();

        });
    </script>
@endpush
