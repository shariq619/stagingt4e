<div class="form-group">
    <label>{{ __('Methodology') }}</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $methodology->name) }}">
    @error('name')
    <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="document">Upload New Documents (Optional)</label>
    <input type="file" name="documents[]" id="document" multiple class="form-control">
    <small class="form-text text-muted">You can upload multiple PDF documents.</small>
</div>

