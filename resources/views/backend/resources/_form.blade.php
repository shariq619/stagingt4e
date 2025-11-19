@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label>{{ __('Name') }} <span class="text-danger">*</span> </label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $resource->name) }}">
    @error('name')
    <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label class="d-block mb-2">{{ __('Courses') }}</label>
    @foreach($courses as $course)
        <div class="form-check mb-1">
            <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}"
                {{ in_array($course->id, old('courses', $selectedCourses ?? [])) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $course->name }}</label>
        </div>
    @endforeach
</div>

@if($resource->file)
    <div class="form-group">
        @php
            $fileExtension = pathinfo($resource->file, PATHINFO_EXTENSION);
        @endphp

        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
            <!-- Display image -->
            <img src="{{ asset($resource->file) }}" alt="Resource File" class="img-fluid" width="200">
        @elseif ($fileExtension === 'pdf')
            <!-- Display PDF in an iframe -->
            <iframe src="{{ asset($resource->file) }}" width="100%" height="500px"></iframe>
        @else
            <!-- Provide download/view link for unsupported types -->
            <a href="{{ asset($resource->file) }}" class="btn btn-primary" target="_blank">View</a>
        @endif
    </div>

@endif

<div class="form-group">
    <label for="file">File (PDF or Image) <span class="text-danger">*</span></label>
    <input type="file" name="file" id="file" class="form-control">
</div>
