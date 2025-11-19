@extends('layouts.main')

@section('title', 'Cohorts')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Add Cohort') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Cohorts') }}</li>
            <li class="breadcrumb-item active">{{ __('Create') }}</li>
        </ol>
    </div>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Form add cohort') }}
                </div>
                <div class="card-body carFormWrapper">
                    <div class="text-right">
                        <a href="{{ route('backend.cohorts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Return') }}
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('backend.cohorts.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Delivery Mode') }}</label>
                                    <select id="delivery_mode" name="delivery_mode"
                                            class="form-control @error('delivery_mode') is-invalid @enderror">
                                        <option value="" disabled {{ old('delivery_mode') == '' ? 'selected' : '' }}>
                                            Select Delivery Mode
                                        </option>
                                        @foreach(config('course_settings.delivery_modes') as $key => $value)
                                            <option
                                                value="{{ $key }}" {{ old('delivery_mode') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('delivery_mode')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="course_id">{{ __('Select Course') }}</label>
                                    <select name="course_id" id="course_id"
                                            class="form-control @error('course_id') is-invalid @enderror">
                                        <option value="" disabled selected>Select Course</option>
                                        @foreach($courses as $course)
                                            <option
                                                value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="venue_id">{{ __('Select Venue') }}</label>
                                    <select name="venue_id" id="venue_id"
                                            class="form-control @error('venue_id') is-invalid @enderror">
                                        <option value="" disabled selected>Select Venue</option>
                                        @foreach($venues as $venue)
                                            <option
                                                value="{{ $venue->id }}" {{ old('venue_id') == $venue->id ? 'selected' : '' }}>
                                                {{ $venue->venue_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('venue_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('Max Number of Learners') }}</label>
                                    <input type="number" name="max_learner" id="max_learner"
                                           class="form-control @error('max_learner') is-invalid @enderror"
                                           value="{{ old('max_learner') }}">
                                    @error('max_learner')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ __('Booking Reference') }}</label>
                                    <input type="text" name="booking_reference" id="booking_reference"
                                           class="form-control" value="{{ old('booking_reference') }}">
                                </div>
                            </div>
                        </div>

                        <hr>



                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="date_range_start">{{ __('Start Date') }}</label>
                                    <input type="date" id="date_range_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="start_time">{{ __('Start Time') }}</label>
                                    <input type="time" id="start_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="date_range_end">{{ __('End Date') }}</label>
                                    <input type="date" id="date_range_end" class="form-control">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="end_time">{{ __('End Time') }}</label>
                                    <input type="time" id="end_time" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Select Days') }}</label><br>
                                    <label><input type="checkbox" class="days-checkbox" value="1"> Monday</label>
                                    <label><input type="checkbox" class="days-checkbox" value="2"> Tuesday</label>
                                    <label><input type="checkbox" class="days-checkbox" value="3"> Wednesday</label>
                                    <label><input type="checkbox" class="days-checkbox" value="4"> Thursday</label>
                                    <label><input type="checkbox" class="days-checkbox" value="5"> Friday</label>
                                    <label><input type="checkbox" class="days-checkbox" value="6"> Saturday</label>
                                    <label><input type="checkbox" class="days-checkbox" value="0"> Sunday</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <button type="button" id="generate-schedules" class="btn btn-primary">
                                    <i class="fas fa-calendar"></i> Generate Schedules
                                </button>
                            </div>
                        </div>


                        <hr>

                        <div id="schedule-container">
                            <div class="row schedule-row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Start Date, Time</label>
                                        <input type="datetime-local" class="form-control"
                                               name="schedules[0][start_date_time]"
                                               placeholder="Start Date, Time">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>End Date, Time</label>
                                        <input type="datetime-local" class="form-control"
                                               name="schedules[0][end_date_time]"
                                               placeholder="End Date, Time">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Select Trainer</label>
                                        <select class="form-control" name="schedules[0][trainer_id]">
                                            {{--<option value="" disabled selected>Select Trainer</option>--}}
                                            @foreach($trainers as $trainer)
                                                <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <button type="button" id="add-more-schedule" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Add More
                                </button>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-2"></i>
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{ route('backend.cohorts.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times mr-2"></i>
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
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
            $('#delivery_mode').change(function () {
                var deliveryMode = $(this).val();
                $.ajax({
                    url: "/backend/courses/by-delivery-mode/" + deliveryMode,
                    method: 'GET',
                    success: function (data) {
                        $('#course_id').empty();
                        $('#course_id').append('<option value="" disabled selected>Select Course</option>');
                        $.each(data, function (key, course) {
                            $('#course_id').append('<option value="' + course.id + '">' + course.name + '</option>');
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
        document.getElementById('add-more-schedule').addEventListener('click', function () {
            const container = document.getElementById('schedule-container');
            const rows = container.querySelectorAll('.schedule-row');
            const newIndex = rows.length; // Determine the new index

            // Clone the first row and adjust the input names
            const newRow = rows[0].cloneNode(true);
            Array.from(newRow.querySelectorAll('input, select')).forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/\d+/, newIndex)); // Update index
                    input.value = ''; // Clear input value
                }
            });

            container.appendChild(newRow);
        });
    </script>


    <script>
        document.getElementById('generate-schedules').addEventListener('click', function () {
            const startDate = new Date(document.getElementById('date_range_start').value);
            const endDate = new Date(document.getElementById('date_range_end').value);
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;
            const selectedDays = Array.from(document.querySelectorAll('.days-checkbox:checked')).map(cb => parseInt(cb.value));
            const container = document.getElementById('schedule-container');
            container.innerHTML = ''; // Clear existing schedules

            if (isNaN(startDate) || isNaN(endDate) || !startTime || !endTime || selectedDays.length === 0) {
                alert('Please select a valid date range, times, and days.');
                return;
            }

            let currentDate = new Date(startDate);
            let scheduleIndex = 0;

            while (currentDate <= endDate) {
                if (selectedDays.includes(currentDate.getDay())) {
                    const startDateTime = new Date(currentDate);
                    const endDateTime = new Date(currentDate);

                    // Set the provided start and end times
                    const [startHour, startMinute] = startTime.split(':');
                    const [endHour, endMinute] = endTime.split(':');

                    startDateTime.setHours(startHour, startMinute);
                    endDateTime.setHours(endHour, endMinute);

                    // Format the date and time as 'YYYY-MM-DDTHH:mm' for the input fields
                    const formatDateTime = (date) => {
                        const year = date.getFullYear();
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const day = String(date.getDate()).padStart(2, '0');
                        const hours = String(date.getHours()).padStart(2, '0');
                        const minutes = String(date.getMinutes()).padStart(2, '0');
                        return `${year}-${month}-${day}T${hours}:${minutes}`;
                    };

                    const newRow = document.createElement('div');
                    newRow.classList.add('row', 'schedule-row');
                    newRow.innerHTML = `
                <div class="col-4">
                    <div class="form-group">
                        <label>Start Date, Time</label>
                        <input type="datetime-local" class="form-control"
                               name="schedules[${scheduleIndex}][start_date_time]"
                               value="${formatDateTime(startDateTime)}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>End Date, Time</label>
                        <input type="datetime-local" class="form-control"
                               name="schedules[${scheduleIndex}][end_date_time]"
                               value="${formatDateTime(endDateTime)}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Select Trainer</label>
                        <select class="form-control" name="schedules[${scheduleIndex}][trainer_id]">
                            @foreach($trainers as $trainer)
                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                            @endforeach
                    </select>
                </div>
            </div>
`;
                    container.appendChild(newRow);
                    scheduleIndex++;
                }
                currentDate.setDate(currentDate.getDate() + 1);
            }

            if (scheduleIndex === 0) {
                alert('No schedules generated for the selected range and days.');
            }
        });

    </script>


@endpush
