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
            padding: .25rem .6rem;
            border-radius: .6rem;
            font-size: .75rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .vf-filter-label {
            font-size: 0.75rem;
            font-weight: 600;
            color:#6b7280;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .vf-input-sm {
            height: 32px;
            font-size: 0.85rem;
            border-radius: 0.5rem;
        }
        .gap-2 > * { margin-right: .5rem; }
        .gap-2 > *:last-child { margin-right: 0; }
    </style>
@endpush

@section('main')
    <div class="vf-card mb-4">
        <div class="card-header bg-white border-0 py-3 px-4 d-flex align-items-center">
            <div>
                <div class="vf-header-title">{{ __('All video feedback') }}</div>
                <div class="vf-header-sub">
                    {{ __('Review, approve or reject learner video submissions.') }}
                </div>
            </div>
            <div class="d-flex gap-2 ml-auto">
                <div class="d-none d-md-flex align-items-center mr-2">
                    <span class="vf-filter-label mr-2">{{ __('Status') }}</span>
                    <select id="filter-status" class="form-control form-control-sm vf-input-sm">
                        <option value="all">{{ __('All') }}</option>
                        <option value="pending">{{ __('Pending') }}</option>
                        <option value="approved">{{ __('Approved') }}</option>
                        <option value="rejected">{{ __('Rejected') }}</option>
                    </select>
                </div>
                <button type="button"
                        id="btn-refresh-admin-videos"
                        class="btn btn-outline-secondary btn-sm vf-btn d-flex align-items-center">
                    <i class="fas fa-sync-alt mr-1"></i> {{ __('Refresh') }}
                </button>
            </div>
        </div>

        <div class="card-body border-top p-3 pb-2">
            <div class="row mb-2">
                <div class="col-md-4 mb-2 mb-md-0">
                    <label class="vf-filter-label mb-1 d-block">{{ __('Search') }}</label>
                    <input type="text" id="filter-search" class="form-control form-control-sm vf-input-sm"
                           placeholder="{{ __('Search by learner, title or message') }}">
                </div>
                <div class="col-md-4 mb-2 mb-md-0 d-md-none">
                    <label class="vf-filter-label mb-1 d-block">{{ __('Status') }}</label>
                    <select id="filter-status-mobile" class="form-control form-control-sm vf-input-sm">
                        <option value="all">{{ __('All') }}</option>
                        <option value="pending">{{ __('Pending') }}</option>
                        <option value="approved">{{ __('Approved') }}</option>
                        <option value="rejected">{{ __('Rejected') }}</option>
                    </select>
                </div>
            </div>

            <div id="admin-videos-loading" class="p-2 text-muted">
                <i class="fas fa-spinner fa-spin mr-1"></i> {{ __('Loading video feedback...') }}
            </div>

            <div id="admin-videos-empty" class="p-3 text-muted d-none">
                {{ __('No video feedback found for the current filters.') }}
            </div>

            <div class="table-responsive d-none" id="admin-videos-table-wrapper">
                <table class="table table-hover mb-0">
                    <thead style="background:#f9fafb;">
                    <tr>
                        <th>{{ __('Learner') }}</th>
                        <th>{{ __('Title / Message') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Consent') }}</th>
                        <th>{{ __('Submitted at') }}</th>
                        <th style="width: 150px;">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody id="admin-videos-tbody"></tbody>
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

            function badgeStatus(status) {
                if (status === 'approved') return '<span class="vf-badge badge-success">approved</span>';
                if (status === 'rejected') return '<span class="vf-badge badge-danger">rejected</span>';
                return '<span class="vf-badge badge-warning">pending</span>';
            }

            function badgeConsent(val) {
                if (val === 'yes') return '<span class="vf-badge badge-info">{{ __("Given") }}</span>';
                return '<span class="vf-badge badge-secondary">{{ __("Not given") }}</span>';
            }

            function setLoading(state) {
                isLoading = state;
                if (state) $('#admin-videos-loading').removeClass('d-none');
                else $('#admin-videos-loading').addClass('d-none');
            }

            function currentStatusFilter() {
                var $desktop = $('#filter-status');
                var $mobile = $('#filter-status-mobile');

                if ($mobile.is(':visible')) {
                    return $mobile.val() || 'all';
                }

                return $desktop.val() || 'all';
            }

            function loadAdminVideos() {
                if (isLoading) return;
                setLoading(true);

                var status = currentStatusFilter();
                $('#filter-status').val(status);
                $('#filter-status-mobile').val(status);

                $.ajax({
                    url: '{{ route('backend.video-feedback.index.data') }}',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        status: status,
                        search: $('#filter-search').val()
                    },
                    success: function (resp) {
                        setLoading(false);
                        var data = resp.data || [];
                        var tbody = $('#admin-videos-tbody');
                        tbody.empty();

                        if (!data.length) {
                            $('#admin-videos-empty').removeClass('d-none');
                            $('#admin-videos-table-wrapper').addClass('d-none');
                            return;
                        }

                        $('#admin-videos-empty').addClass('d-none');
                        $('#admin-videos-table-wrapper').removeClass('d-none');

                        data.forEach(function (v) {
                            var learner = v.user_name ? v.user_name : '{{ __("Unknown") }}';
                            if (v.user_email) learner += ' <span class="text-muted small">&lt;' + v.user_email + '&gt;</span>';

                            var msg = v.message ? '<div class="text-muted small mt-1">' + v.message + '</div>' : '';

                            var actions =
                                '<a href="' + v.show_url + '" class="btn btn-outline-secondary btn-xs mr-1">' +
                                '<i class="fas fa-eye"></i>' +
                                '</a>';

                            if (v.status === 'pending') {
                                actions +=
                                    '<form method="POST" action="' + v.approve_url + '" class="d-inline js-video-approve-form">' +
                                    '@csrf' +
                                    '<button type="submit" class="btn btn-success btn-xs mr-1"><i class="fas fa-check"></i></button>' +
                                    '</form>' +
                                    '<form method="POST" action="' + v.reject_url + '" class="d-inline js-video-reject-form">' +
                                    '@csrf' +
                                    '<button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-times"></i></button>' +
                                    '</form>';
                            }

                            var row =
                                '<tr>' +
                                '<td>' + learner + '</td>' +
                                '<td>' + v.title + msg + '</td>' +
                                '<td>' + badgeStatus(v.status) + '</td>' +
                                '<td>' + badgeConsent(v.consent) + '</td>' +
                                '<td>' + (v.created_at || '') + '</td>' +
                                '<td>' + actions + '</td>' +
                                '</tr>';

                            tbody.append(row);
                        });
                    },
                    error: function () {
                        setLoading(false);
                        $('#admin-videos-empty').removeClass('d-none').text('{{ __("Unable to load video feedback right now.") }}');
                        $('#admin-videos-table-wrapper').addClass('d-none');
                    }
                });
            }

            $('#btn-refresh-admin-videos').on('click', loadAdminVideos);

            $('#filter-status, #filter-status-mobile').on('change', function () {
                loadAdminVideos();
            });

            $('#filter-search').on('keyup', function () {
                clearTimeout($.data(this, 'timer'));
                var wait = setTimeout(loadAdminVideos, 400);
                $(this).data('timer', wait);
            });

            loadAdminVideos();

            if (typeof Swal === 'undefined') {
                $.getScript('https://cdn.jsdelivr.net/npm/sweetalert2@11');
            }

            $(document).on('submit', '.js-video-approve-form', function (e) {
                e.preventDefault();
                var form = this;
                var url = $(form).attr('action');
                var data = $(form).serialize();

                Swal.fire({
                    icon: 'question',
                    title: '{{ __("Approve this video?") }}',
                    text: '{{ __("This learner video will be marked as approved for marketing use.") }}',
                    showCancelButton: true,
                    confirmButtonText: '{{ __("Yes, approve") }}',
                    cancelButtonText: '{{ __("Cancel") }}'
                }).then(function (result) {
                    if (!result.isConfirmed) return;

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: data,
                        success: function () {
                            Swal.fire({
                                icon: 'success',
                                title: '{{ __("Approved") }}',
                                text: '{{ __("The video has been approved.") }}'
                            });
                            loadAdminVideos();
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: '{{ __("Error") }}',
                                text: '{{ __("Unable to approve this video right now.") }}'
                            });
                        }
                    });
                });
            });

            $(document).on('submit', '.js-video-reject-form', function (e) {
                e.preventDefault();
                var form = this;
                var url = $(form).attr('action');
                var data = $(form).serialize();

                Swal.fire({
                    icon: 'warning',
                    title: '{{ __("Reject this video?") }}',
                    text: '{{ __("This learner video will be marked as rejected.") }}',
                    showCancelButton: true,
                    confirmButtonText: '{{ __("Yes, reject") }}',
                    cancelButtonText: '{{ __("Cancel") }}'
                }).then(function (result) {
                    if (!result.isConfirmed) return;

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: data,
                        success: function () {
                            Swal.fire({
                                icon: 'success',
                                title: '{{ __("Rejected") }}',
                                text: '{{ __("The video has been rejected.") }}'
                            });
                            loadAdminVideos();
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: '{{ __("Error") }}',
                                text: '{{ __("Unable to reject this video right now.") }}'
                            });
                        }
                    });
                });
            });
        });
    </script>
@endpush

