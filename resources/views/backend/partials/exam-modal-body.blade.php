@foreach ($exams as $exam)
    @php $result = $results[$exam->id] ?? null; @endphp
    <div class="mb-4 border p-3 rounded shadow-sm">
        <div class="mb-2">
            <strong>{{ $exam->name }}</strong>
            <span class="badge bg-secondary">{{ $exam->type ?? 'N/A' }}</span>
            <span class="badge bg-warning text-dark">Min: {{ $exam->min_score ?? 'N/A' }}</span>
            <span class="badge bg-info text-dark">Max: {{ $exam->max_score ?? 'N/A' }}</span>
            <span class="badge bg-success">Pass Rate: {{ $exam->pass_rate ?? 'N/A' }}%</span>
        </div>

        <input type="hidden" name="exams[{{ $exam->id }}][exam_id]" value="{{ $exam->id }}">
        <input type="hidden" name="exams[{{ $exam->id }}][learner_id]" value="{{ $learnerId }}">
        <input type="hidden" name="exams[{{ $exam->id }}][cohort_id]" value="{{ $cohortId }}">

        <div class="row">
            <div class="col-md-3">
                <input type="number" name="exams[{{ $exam->id }}][score]" class="form-control"
                       placeholder="Score" value="{{ $result->score ?? '' }}">
            </div>
            <div class="col-md-3">
                <select name="exams[{{ $exam->id }}][status]" class="form-control">
                    <option value="">Select</option>
                    <option value="Passed" {{ ($result->status ?? '') == 'Passed' ? 'selected' : '' }}>Passed</option>
                    <option value="Failed" {{ ($result->status ?? '') == 'Failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
        </div>
    </div>
@endforeach
