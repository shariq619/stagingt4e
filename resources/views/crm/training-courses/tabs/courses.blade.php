@section('title', 'Course Detail')
<div class="tab-pane active" id="pills-course" role="tabpanel" aria-labelledby="pills-course-tab">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Course Name</th>
                    <th>Course Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($training_course->learners as $learner)
                    @foreach ($learner->cohorts as $cohort)
                        <tr>
                            <td>{{ $cohort->course->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($cohort->start_date_time)->format('d-m-Y') ?? 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
