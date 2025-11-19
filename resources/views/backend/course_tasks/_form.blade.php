<div class="form-group">
    <label>{{ __('Name') }}</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $course_tasks->name) }}">
    @error('name')
    <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>


<div class="form-group">
    <label for="document">Existing Document:</label>
    @if ($course_tasks->task_code)
        <a class="btn btn-info" role="button" href="{{ asset($course_tasks->task_code) }}" target="_blank">View</a>
    @else
        Not found
    @endif
</div>

<div class="form-group">
    <label for="document">Upload Document (Optional):</label>
    <input type="file" name="document" id="document" accept=".pdf" class="form-control">
</div>
