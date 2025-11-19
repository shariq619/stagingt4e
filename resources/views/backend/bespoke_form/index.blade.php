@extends('layouts.main')

@section('title', 'Leads')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Leads') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Leads') }}</li>
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
                        {{ __('Leads') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.request.bespoke.index') }}" method="GET"
                            class="d-flex  align-items-center">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="text" name="search" class="form-control" placeholder="Search Leads..."
                                    value="{{ request()->get('search') }}" style="height: calc(2.25rem + 2px);">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="30%">{{ __('Name') }}</th>
                                    <th width="20%">{{ __('Participant') }}</th>
                                    <th width="30%">{{ __('Message') }}</th>
                                    <th width="20%">{{ __('Date') }}</th>
                                    <th width="20%">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bespokeLeads as $bespoke)
                                    <tr  style="background-color : {{ $bespoke->is_read == 1 ? '' : 'rgba(0,0,0,.075)' }}">
                                        <td>
                                            {{ $bespoke->first_name . ' ' . $bespoke->last_name }} <br>
                                            <small><strong>Email:</strong> {{ $bespoke->email ?? '' }}</small><br>
                                            <small><strong>Phone:</strong> {{ $bespoke->phone ?? '' }}</small><br>
                                            <small><strong>Company:</strong> {{ $bespoke->company_name ?? '' }}</small><br>
                                            <small><strong>Promotions Email:</strong>
                                                {{ $bespoke->promotions_allowed_email ?? '' }}</small>
                                        </td>
                                        <td>{{ $bespoke->participant ?? '' }}</td>
                                        <td class="msgBespoke">{{ $bespoke->message ?? '' }}</td>
                                        <td>{{ $bespoke->created_at->format('d M Y h:i:A') }}</td>
                                        <td>
                                            <button class="text-sm btn btn-sm btn-{{ $bespoke->is_read == 0 ? 'success' : 'secondary' }} mark-as-read"
                                                data-id="{{ $bespoke->id }}">
                                                <i class="fas fa-envelope{{ $bespoke->is_read == 0 ? '' : '-open' }}"></i>
                                                {{-- Mark as {{ $bespoke->is_read == 0 ? 'Read' : 'Unread' }} --}}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <i>{{ __('Bespoke Data is empty') }}</i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $bespokeLeads->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.mark-as-read').click(function() {
                var id = $(this).data('id');
                var button = $(this);

                $.ajax({
                    url: "{{ route('backend.request.bespoke.markAsRead') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Something went wrong.');
                    }
                });
            });
        });
    </script>
@endpush
