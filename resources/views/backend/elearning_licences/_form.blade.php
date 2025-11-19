<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('Name') }}<span class="text-red">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $elearningLicence->name) }}">
            @error('name')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>{{ __('Course ID') }}</label>
            <input type="text" name="course_id" class="form-control"
                value="{{ old('course_id', $elearningLicence->course_id) }}">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label>{{ __('Description') }}</label>
            <textarea name="description" id="" cols="30" rows="10"
                class="form-control @error('description') is-invalid @enderror">{{ old('description', $elearningLicence->description) }}</textarea>
            @error('description')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
