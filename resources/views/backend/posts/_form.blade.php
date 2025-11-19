{{-- <div class="col-6 col-md-6">
    <div class="form-group">
        <label>Title <span class="text-red">*</span></label>
        <input type="text" name="title" class="form-control title @error('title') is-invalid  @enderror"
            placeholder="Title" value="{{ old('title', $post->title) }}">
        @error('title')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-6 col-md-6">
    <div class="form-group">
        <label>Slug <span class="text-red">*</span></label>
        <input type="text" name="slug" class="form-control slug @error('slug') is-invalid @enderror"
            placeholder="Slug" value="{{ old('slug', $post->slug) }}">
        @error('slug')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-6 col-md-6">
    <div class="form-group">
        <label>Category <span class="text-red">*</span></label>
        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-6 col-md-6">
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" accept=".jpg,.jpeg,.png">
        @error('image')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-6 col-md-12">
    <div class="form-group">
        <label>Excerpt</label>
        <textarea name="excerpt" class="w-100 form-control"> {{ old('excerpt', $post->excerpt) }} </textarea>
    </div>
</div>
<div class="col-6 col-md-12">
    <div class="form-group">
        <label>Content</label>
        <textarea name="content" class="w-100 form-control" id="content">{{ old('Content', $post->content) }}</textarea>
    </div>
</div> --}}
