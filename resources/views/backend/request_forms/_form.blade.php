<div class="form-group">
    <label for="industry">{{ __('Industry') }} <span
            class="text-red">*</span></label>
    <select name="industry" id="industry" class="form-control">
        <option value="Fire Safety" {{ ($exam->industry == 'Fire Safety') ? 'selected' : '' }} >Fire Safety</option>
        <option value="Security" {{ ($exam->industry == 'Security') ? 'selected' : '' }} >Security</option>
        <option value="Construction" {{ ($exam->industry == 'Construction') ? 'selected' : '' }} >Construction</option>
    </select>
</div>
<div class="form-group">
    <label for="type">{{ __('Type') }} <span
            class="text-red">*</span></label>
    <select name="type" id="type" class="form-control">
        <option value="MCQ" {{ ($exam->type == 'MCQ') ? 'selected' : '' }} >MCQ</option>
        <option value="Practical" {{ ($exam->type == 'Practical') ? 'selected' : '' }} >Practical</option>
    </select>
</div>
<div class="form-group">
    <label>{{ __('Exam') }}</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $exam->name) }}">
    @error('name')
    <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label>{{ __('Min Score') }}</label>
    <input type="text" name="min_score" class="form-control @error('min_score') is-invalid @enderror"
           value="{{ old('min_score', $exam->min_score) }}">
    @error('min_score')
    <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label>{{ __('Max Score') }}</label>
    <input type="text" name="max_score" class="form-control @error('max_score') is-invalid @enderror"
           value="{{ old('max_score', $exam->max_score) }}">
    @error('max_score')
    <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label>{{ __('Pass Rate') }}</label>
    <input type="text" name="pass_rate" class="form-control @error('pass_rate') is-invalid @enderror"
           value="{{ old('pass_rate', $exam->pass_rate) }}">
    @error('pass_rate')
    <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>
