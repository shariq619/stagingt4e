@extends('layouts.main')

@section('title', 'Order')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Order Details') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Order Details') }}</li>
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
                        {{ __('Data Order Details') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-tools d-flex align-items-center justify-content-between">
                        <form action="{{ route('backend.order.index') }}" method="GET" class="d-flex align-items-center">
                            <div class="input-group input-group-sm mb-3" style="width: 300px;">
                                <input type="month" name="month" class="form-control"
                                       value="{{ request()->get('month') }}"
                                       style="height: calc(2.25rem + 2px);">

                            </div>


                            {{-- Reseller filter --}}
                            <div class="input-group input-group-sm mb-3 mr-2" style="width: 200px;">
                                <select name="reseller_id" class="form-control">
                                    <option value="">All Resellers</option>
                                    @foreach($resellers as $reseller)
                                        <option value="{{ $reseller->id }}"
                                            {{ request()->get('reseller_id') == $reseller->id ? 'selected' : '' }}>
                                            {{ $reseller->name }} {{ $reseller->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>


                        </form>

                        <!-- Display total amount -->
                        <div class="alert alert-warning">
                            <strong>Total Sales: {{ config('settings.currency_symbol', '£') }} {{ number_format($totalAmount, 2) }}</strong>
                            @if(request()->has('month'))
                                for {{ date('F Y', strtotime(request()->get('month'))) }}
                            @endif
                        </div>


                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="20%">{{ __('Order') }}</th>
                                    <th>{{ __('Reseller') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Order Status') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id . ' ' . $order->checkoutDetail->first_name . ' ' . $order->checkoutDetail->last_name }}</td>
                                        <td>{{ $order->frontOrderDetail->first()->reseller->name ?? "" }}</td>
                                        <td>
                                            @php
                                                $date = $order->created_at;
                                                $formattedDate =
                                                    $date->diffInHours(now()) < 24
                                                        ? $date->diffForHumans()
                                                        : $date->format('j M Y');
                                            @endphp
                                            {{ $formattedDate }}
                                        </td>
                                        <td>
                                            @php
                                                $status = $order->order_status;
                                                $badgeClasses = [
                                                    'Processing' => 'badge-warning',
                                                    'Completed' => 'badge-success',
                                                    'Partially Paid' => 'badge-warning',
                                                    'Cancelled' => 'badge-danger',
                                                    'Refund' => 'badge-danger',
                                                ];
                                            @endphp
                                            <p class="m-0 badge {{ $badgeClasses[$status] ?? '' }}">
                                                {{ $status }}
                                            </p>
                                        </td>
                                        <td>£{{ $order->total_amount }}</td>
                                        @can('see order')
                                            <td>
                                                <a href="{{ route('backend.order.show', $order->id) }}"
                                                    class="btn btn-sm btn-primary badge-">
                                                    <i class="fas fa-eye"></i> <span
                                                        class="font-weight-bold">{{ __('View') }}</span>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <i>{{ __('Orders not found') }}</i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $orders->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
