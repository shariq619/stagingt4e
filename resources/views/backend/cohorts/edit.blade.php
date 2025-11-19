@extends('layouts.main')

@section('title', 'Cohort')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('change Cohort') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Cohort') }}</li>
            <li class="breadcrumb-item active">{{ __('Update') }}</li>
        </ol>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <style>
        /* Select2 Bootstrap 4 compatibility */
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
            line-height: 1.5;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
        }

        .select2-container .select2-selection--multiple {
            min-height: calc(2.25rem + 2px) !important;
        }

        .select2-container .select2-selection__choice {
            margin-top: 0.25rem;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
        }
    </style>
@endpush

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card carFormWrapper">
                <div class="card-header">
                    {{ __('Form change cohort') }}
                </div>
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{ route('backend.cohorts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>
                    <form action="{{ route('backend.cohorts.update', $cohort->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('Delivery Mode') }}</label>
                                    <select id="delivery_mode" class="form-control">
                                        <option value="" disabled>Select Delivery Mode</option>
                                        @foreach (config('course_settings.delivery_modes') as $key => $value)
                                            <option
                                                value="{{ $key }} {{ $key == $cohort->delivery_modes ? 'selected' : '' }}">
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="course_id">{{ __('Select Course') }}</label>
                                    <select name="course_id" id="course_id"
                                        class="form-control @error('course_id') is-invalid @enderror">
                                        <option value="" disabled selected>Select Course</option>
{{--                                        @foreach ($courses as $course)--}}
{{--                                            <option value="{{ $course->id }}"--}}
{{--                                                {{ $course->id == $cohort->course_id ? 'selected' : '' }}>--}}
{{--                                                {{ $course->name }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}


                                        @foreach($courses as $course)
                                            <option value="{{ $course['id'] }}"
                                                {{ $course['id'] == $cohort->course_id ? 'selected' : '' }}>
                                                {{ $course['name'] }}
                                            </option>
                                        @endforeach


                                    </select>
                                    @error('course_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="reseller_id">{{ __('Select Reseller') }}</label>
                                    <select name="reseller_id" id="reseller_id"
                                            class="form-control">
                                        <option value="" disabled selected>Select Reseller</option>
                                        @foreach($resellers as $reseller)
                                            <option value="{{ $reseller->id }}"
                                                {{ old('reseller_id', $cohort->reseller_id) == $reseller->id ? 'selected' : '' }}>
                                                {{ $reseller->name }} {{ $reseller->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="venue_id">{{ __('Select Venue') }}</label>
                                    <select name="venue_id" id="venue_id"
                                        class="form-control @error('venue_id') is-invalid @enderror">
                                        <option value="" disabled selected>Select Venue</option>
                                        @foreach ($venues as $venue)
                                            <option value="{{ $venue->id }}"
                                                {{ $venue->id == $cohort->venue_id ? 'selected' : '' }}>
                                                {{ $venue->venue_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('venue_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Max Number of Learners') }}</label>
                                    <input type="number" name="max_learner" id="max_learner"
                                        class="form-control @error('max_learner') is-invalid @enderror"
                                        value="{{ $cohort->max_learner }}">
                                    @error('max_learner')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Start Date, Time</label>
                                    <input type="datetime-local"
                                        class="form-control @error('start_date_time') is-invalid @enderror"
                                        name="start_date_time" placeholder="Start Date, Time"
                                        value="{{ $cohort->start_date_time }}">
                                    @error('start_date_time')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label>End Date, Time</label>
                                    <input type="datetime-local"
                                        class="form-control @error('end_date_time') is-invalid @enderror"
                                        name="end_date_time" placeholder="End Date, Time"
                                        value="{{ $cohort->end_date_time }}">
                                    @error('end_date_time')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label for="is_weekend">Is Weekend</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_weekend" name="is_weekend" value="1" {{ $cohort->is_weekend == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_weekend">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label for="is_soldout">Is Sold Out?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_soldout" name="is_soldout" value="1" {{ $cohort->is_soldout == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_soldout">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Select Trainer') }}</label>
                                    <select class="form-control" name="trainer_id">
                                        <option value="" disabled selected>Select Trainer</option>
                                        @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}"
                                                {{ $trainer->id == $cohort->trainer_id ? 'selected' : '' }}>
                                                {{ $trainer->name }} {{ $trainer->last_name ?? "" }}</option>
                                        @endforeach
                                    </select>
                                    @error('trainer_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
{{--                            <div class="col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>{{ __('Default Corporate Customer') }}</label>--}}
{{--                                    <select class="form-control" name="corporate_client_id">--}}
{{--                                        <option value="" selected>Select Corporate Customer</option>--}}
{{--                                        @foreach ($clients as $client)--}}
{{--                                            <option value="{{ $client->id }}"--}}
{{--                                                {{ $client->id == $cohort->corporate_client_id ? 'selected' : '' }}>--}}
{{--                                                {{ $client->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @error('corporate_client_id')--}}
{{--                                        <small class="text-danger">{{ $message }}</small>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Booking Reference') }}</label>
                                    <input type="text" name="booking_reference" id="booking_reference"
                                        class="form-control @error('booking_reference') is-invalid @enderror"
                                        value="{{ $cohort->booking_reference }}">
                                    @error('booking_reference')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        @php
                            $additionalTimes = json_decode($cohort->additional_times, true);
                        @endphp

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Second Start Time</label>
                                    <input type="time" class="form-control" name="second_start_time"
                                           value="{{ old('second_start_time', $additionalTimes['second_start_time'] ?? '') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Second End Time</label>
                                    <input type="time" class="form-control" name="second_end_time"
                                           value="{{ old('second_end_time', $additionalTimes['second_end_time'] ?? '') }}">
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('backend.cohorts.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
{{--                    <hr>--}}
{{--                    @can('delete course')--}}
{{--                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCohorts">--}}
{{--                            <i class="fas fa-trash-alt mr-2"></i>--}}
{{--                            {{ __('Delete Cohort') }}--}}
{{--                        </button>--}}
{{--                    @endcan--}}
                </div>
            </div>
        </div>
    </div>
    @can('delete cohorts')
        <div class="modal fade" id="deleteCohorts" tabindex="-1" aria-labelledby="deleteCohortLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoleLabel">{{ __('Delete Cohort') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('backend.cohorts.destroy', $cohort) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                {{ __('Delete cohort?') }}
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
        CKEDITOR.replace('description');
    </script>
    <script>
        $(document).ready(function() {
            $('#delivery_mode').change(function() {
                var deliveryMode = $(this).val();
                $.ajax({
                    url: "/backend/courses/by-delivery-mode/" + deliveryMode,
                    method: 'GET',
                    success: function(data) {
                        $('#course_id').empty();
                        $('#course_id').append(
                            '<option value="" disabled selected>Select Course</option>');
                        $.each(data, function(key, course) {
                            $('#course_id').append('<option value="' + course.id +
                                '">' + course.name + '</option>');
                        });
                    }
                });
            });

            // Initialize the datepicker
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                clearBtn: true,
                multidate: true,
                multidateSeparator: ', '
            });


        });
    </script>
    <script>
        $('#category_id').change(function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/backend/courses/get-subcategories/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#sub_category_id').empty().append(
                            '<option value="">Select Subcategory</option>');
                        $.each(data, function(subcategoryId, subcategoryName) {
                            $('#sub_category_id').append('<option value="' + subcategoryId +
                                '">' + subcategoryName + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_category_id').empty().append('<option value="">Select Category First</option>');
            }
        });
    </script>
    <script src="{{ asset('admin') }}/plugins/select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#module').select2();
        });
    </script>
@endpush
