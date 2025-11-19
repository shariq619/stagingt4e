@extends('layouts.main')

@section('title', 'Venue')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Update Venues') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Venues') }}</li>
            <li class="breadcrumb-item active">{{ __('Update') }}</li>
        </ol>
    </div>
@endsection
@section('main')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card carFormWrapper">
                <div class="card-header">
                    {{ __('Form update venue') }}
                </div>
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.venues.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.venues.update', $venue) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('backend.venue._form')
                        <div class="col-md-12">
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-2"></i>
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('backend.venues.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times mr-2"></i>
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    <hr>
                    @can('delete venue')
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteVen">
                            <i class="fas fa-trash-alt mr-2"></i>
                            {{ __('Delete venue') }}
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @can('delete venue')
        <div class="modal fade" id="deleteVen" tabindex="-1" aria-labelledby="deleteCatLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoleLabel">{{ __('delete Venue') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('backend.venues.destroy', $venue) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                {{ __('delete venue?') }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt mr-2"></i>
                                {{ __('Delete') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@push('js')

    <script>
        $(document).ready(function () {


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
