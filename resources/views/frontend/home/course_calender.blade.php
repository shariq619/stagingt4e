@extends('layouts.frontend')

@section('title', 'SIA Training Course')

@section('main')
    <div class="home-page">
        <section class="courses-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="filter_section mb-4">
                            <h1>COURSES</h1>
                            <form method="GET" action="" class="form-row align-items-end">
                                <div class="form-group col-md-2 mb-2">
                                    <label for="month" class="font-weight-bold">Month</label>
                                    <select name="month" id="month" class="form-control">
                                        <option value="">Select Month</option>
                                        @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $idx => $m)
                                            <option value="{{ $idx + 1 }}"
                                                {{ request('month') == $idx + 1 ? 'selected' : '' }}>{{ $m }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-2 mb-2">
                                    <label for="year" class="font-weight-bold">Year</label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="">Select Year</option>
                                        @php $currentYear = now()->year; @endphp
                                        @for ($y = $currentYear - 2; $y <= $currentYear + 2; $y++)
                                            <option value="{{ $y }}"
                                                {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group col-md-2 mb-2">
                                    <label for="category_id" class="font-weight-bold">Course Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-2 mb-2">
                                    <label for="venue_id" class="font-weight-bold">Location</label>
                                    <select name="venue_id" id="venue_id" class="form-control">
                                        <option value="">All Locations</option>
                                        @foreach ($venues as $venue)
                                            <option value="{{ $venue->id }}"
                                                {{ request('venue_id') == $venue->id ? 'selected' : '' }}>
                                                {{ $venue->venue_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4 mb-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Filter</button>
                                    <a href="{{route('courses.calender')}}" class="btn btn-secondary btn-block mr-2">Reset</a>
                                    <a href="{{ route('courses.calender.pdf', request()->all()) }}" class="btn btn-success btn-block" target="_blank">Print PDF</a>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-striped">
                            <thead style="background: #002855; color: #fff;">
                                <tr>
                                    <th>Month</th>
                                    <th>Course Title</th>
                                    <th>Venue</th>
                                    <th>Date, Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($cohorts as $cohort)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($cohort->start_date_time)->format('F') }}</td>
                                        <td>{{ $cohort->course->name }}</td>
                                        <td>{{ $cohort->venue->venue_name ?? '-' }}</td>
                                        <td>


                                           {!!  formatCourseCalDate($cohort) !!}


{{--                                            <b>{{ \Carbon\Carbon::parse($cohort->start_date_time)->format('d M Y') }}</b>--}}
{{--                                            {{ \Carbon\Carbon::parse($cohort->start_date_time)->format('g:i A') }} to--}}
{{--                                            <b>{{ \Carbon\Carbon::parse($cohort->end_date_time)->format('d M Y') }}</b>--}}
{{--                                            {{ \Carbon\Carbon::parse($cohort->end_date_time)->format('g:i A') }}--}}
                                        </td>
                                        <td>
                                            <a href="{{ route('course.show', $cohort->course->slug ?? $cohort->course->id) }}"
                                                class="btn btn-primary btn-sm">Book Now</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No courses found.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $cohorts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
