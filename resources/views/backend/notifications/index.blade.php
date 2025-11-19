@extends('layouts.main')

@section('title', 'Profile Photo')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Notifications') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Notifications') }}</li>
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
                        {{ __('Notifications') }}
                    </h3>
                </div>
                <div class="card-body">
                    <h1>Notifications</h1>
                    @if ($notifications->count() > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Message</th>
                                <th>Task</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->data['message'] }}</td>
                                    <td><a href="{{ $notification->data['task_url'] ?? "" }}" class="btn btn-sm btn-success">View</a></td>
                                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($notification->read_at === null)
                                            <span class="badge badge-warning">Unread</span>
                                        @else
                                            <span class="badge badge-success">Read</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($notification->read_at === null)
                                            <form action="{{ route('backend.notifications.markAsRead') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $notification->id }}">
                                                <button type="submit" class="btn btn-sm btn-primary">Mark as Read</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $notifications->links() }}
                    @else
                        <p>No notifications found.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
