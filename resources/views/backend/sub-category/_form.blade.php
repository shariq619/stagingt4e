<div class="form-group">
    <label>{{ __('Sub Category Name') }}</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name') ?? $subCategory->name }}">
    @error('name')
        <small class="invalid-feedback" role="alert">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="cat_id">{{ __('Category') }}</label>
    <select name="cat_id" id="cat_id" class="form-control">
        <option value="">Select a Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $subCategory->cat_id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('cat_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
