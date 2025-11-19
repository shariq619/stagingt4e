<div class="col-12 col-md-6">
    <div class="form-group">
        <label>{{ __('Product Name') }} <span class="text-red">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $slug->name ?? '') }}">
        @error('name')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="form-group">
        <label>{{ __('Product Image') }}</label>
        <input type="file" name="product_image" class="form-control">
        @error('product_image')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="form-group">
        <label>{{ __('Price') }} <span class="text-red">*</span></label>
        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
            value="{{ old('price', $slug->price ?? '') }}">
        @error('price')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="form-group">
        <label>{{ __('Discount Price') }} </label>
        <input type="text" name="discount_price" class="form-control"
            value="{{ old('discount_price', $slug->discount_price ?? '') }}">
        @error('discount_price')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-12">
    <div class="form-group">
        <label>{{ __('Excerpt') }} </label>
        <textarea name="excerpt" id="excerpt" class="form-control"> {{ old('excerpt', $slug->excerpt ?? '') }} </textarea>
        @error('excerpt')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-12">
    <div class="form-group">
        <label>{{ __('Short Description') }} </label>
        <textarea name="short_description" id="short_description" class="form-control"> {{ old('short_description', $slug->short_description ?? '') }} </textarea>
        @error('short_description')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-12">
    <div class="form-group">
        <label>{{ __('Description') }} </label>
        <textarea name="description" id="description" class="form-control">
            {{ old('description', $slug->description ?? '') }}
        </textarea>
        @error('description')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-12">
    <div class="form-group">
        <label>{{ __('Description Two') }} </label>
        <textarea name="description_two" id="description_two" class="form-control">
            {{ old('description_two', $slug->description_two ?? '') }}
        </textarea>
        @error('description_two')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-12">
    <div class="form-group">
        <label>{{ __('Description Three') }} </label>
        <textarea name="description_three" id="description_three" class="form-control">
            {{ old('description_three', $slug->description_three ?? '') }}
        </textarea>
        @error('description_three')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-12">
    <div class="form-group">
        <label>{{ __('Description Four') }} </label>
        <textarea name="description_four" id="description_four" class="form-control">
            {{ old('description_four', $slug->description_four ?? '') }}
        </textarea>
        @error('description_four')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="col-12 col-md-12">
    <div class="form-group">
        <div class="form-group">
            <label>{{ __('Image Gallery') }}</label>
            @php $current_route = Route::currentRouteName(); @endphp
            @if ($current_route == 'backend.products.edit')
                @php $gallery = json_decode($slug->gallery); @endphp
                <div class="custom-file">
                    <input type="file" name="gallery[]" class="custom-file-input" id="gallery" multiple>
                    <label class="custom-file-label" for="gallery">Choose files</label>
                </div>
                @if ($gallery)
                    <div class="gallery-images d-flex align-items-center flex-wrap mt-2">
                        @foreach ($gallery as $index => $image)
                            <div class="gallery-image" id="image_{{ $index }}">
                                <img src="{{ asset($image) }}" alt="Gallery Image" class="img-thumbnail">
                                <a class="btn btn-danger btn-sm delete-image" data-image="{{ $image }}">x</a>
                            </div>
                        @endforeach
                    </div>
                @endif
                <input type="hidden" name="deleted_images" id="deleted_images" value="[]">
            @else
                <div class="custom-file">
                    <input type="file" name="gallery[]" class="custom-file-input" id="gallery" multiple>
                    <label class="custom-file-label" for="gallery">Choose files</label>
                </div>
                <ul id="fileList"></ul>
            @endif
        </div>
        @error('gallery')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror

    </div>
</div>
