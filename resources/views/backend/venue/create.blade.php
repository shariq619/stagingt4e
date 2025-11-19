@extends('layouts.main')

@section('title', 'Venue')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Add Venues') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Venues') }}</li>
            <li class="breadcrumb-item active">{{ __('Create') }}</li>
        </ol>
    </div>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card carFormWrapper">
                <div class="card-header">
                    {{ __('Form add venue') }}
                </div>
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.venues.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{route('backend.venues.store')}}" method="POST">
                        @csrf
                        @include('backend.venue._form')
                        <div class="col-md-12">
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-2"></i>
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('backend.venues.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times mr-2"></i>
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            // Load regions on page load
            $.ajax({
                url: '/regions',
                method: 'GET',
                success: function (data) {
                    let regionsDropdown = $('#uk-regions');
                    data.forEach(function (region) {
                        regionsDropdown.append(new Option(region, region));
                    });
                }
            });

            // Handle region change
            $('#uk-regions').change(function () {
                let region = $(this).val();
                let citiesDropdown = $('#uk-cities');
                citiesDropdown.empty().append(new Option('Select a city', '')).prop('disabled', true);

                if (region) {
                    $.ajax({
                        url: '/cities/' + encodeURIComponent(region),
                        method: 'GET',
                        success: function (data) {
                            data.forEach(function (city) {
                                citiesDropdown.append(new Option(city, city));
                            });
                            citiesDropdown.prop('disabled', false);
                        }
                    });
                }
            });
        });
    </script>
@endpush
