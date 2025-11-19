<div class="form-group">
    <label>{{ __('Category') }}</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $category->name) }}">
    @error('name')
        <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label>{{ __('Image') }}</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>
