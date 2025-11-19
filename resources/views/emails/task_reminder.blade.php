<p>Hi {{ $learner->name }},</p>

<p>This is a reminder that your cohort  starts on <strong>{{ \Carbon\Carbon::parse($cohort->start_date_time)->toFormattedDateString() }}</strong>.</p>

<p>You still have the following task(s) pending approval:</p>

<ul>
    @foreach($incompleteTasks as $task)
        <li>{{ $task }}</li>
    @endforeach
</ul>

<p>Please complete them as soon as possible to be ready for the cohort.</p>

<p>Thank you,<br>Admin Team</p>
