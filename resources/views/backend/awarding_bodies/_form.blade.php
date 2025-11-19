<div class="form-group">
    <label>{{ __('Name') }}</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $awardingBody->name) }}">
    @error('name')
    <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label>{{ __('Description') }}</label>
    <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description', $awardingBody->description) }}</textarea>
    {{-- <input type="text" name="description" 
           > --}}
    @error('description')
    <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>

