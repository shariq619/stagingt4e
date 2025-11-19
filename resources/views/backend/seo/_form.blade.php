{{--<div class="col-12 col-md-6">--}}
{{--    <div class="form-group">--}}
{{--        <label>Slug</label>--}}
{{--        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') ?? (isset($seo->slug) ? ucwords(str_replace('-', ' ', $seo->slug)) : '') }}" required>--}}
{{--        @error('slug')--}}
{{--        <small class="invalid-feedback" role="alert">{{ $message }}</small>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--</div>--}}

<style>
    .seo-score {
        display: block;
        font-weight: bold;
        margin-top: 5px;
    }
    .score-red { color: red; }
    .score-orange { color: orange; }
    .score-green { color: green; }
</style>

@if($idFormEdit == false)
<div class="col-12 col-md-12">
    <div class="form-group">
        <label>Page URL</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug') ?? ($seo->slug ?? '') }}">

        {{-- Error Message Display --}}
        @error('slug')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        {{--<select name="slug" class="form-control" >
            <option value="">Select Page</option>
            @foreach($filteredPages as $key => $url)
                <option value="{{ $key }}" {{ ($seo->slug == $key || $seo->slug == $url) ? 'selected' : '' }}>
                    {{ ucfirst(str_replace(['-', '.index'], [' ', ''], $key)) }}
                </option>
            @endforeach
        </select>--}}
    </div>
</div>
@else
    <div class="col-12 col-md-12">
        <div class="form-group">
            <label>Page URL: </label>
            <a target="_blank" href="{{$seo->slug}}">{{$seo->slug}}</a>
        </div>
    </div>
@endif



<div class="col-6 col-md-6">
    <div class="form-group">
        <label>Meta Title</label>
        <input type="text" name="meta_title" id="meta_title" class="form-control"
               value="{{ old('meta_title') ?? ($seo->meta_title ?? '') }}" onkeyup="updateSeoScore()">
        {{--<small id="titleScore" class="seo-score">Score: 0/100</small>--}}
    </div>

    @error('meta_title')
    <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="col-6 col-md-6">
    <div class="form-group">
        <label>Meta Keywords</label>
        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
               value="{{ old('meta_keywords') ?? collect(json_decode($seo->meta_keywords, true))->pluck('value')->implode(',') }}"
               onkeyup="updateSeoScore()">
        {{--<small id="keywordScore" class="seo-score">Score: 0/100</small>--}}
    </div>

    @error('meta_keywords')
    <span class="text-danger">{{ $message }}</span>
    @enderror


</div>


<div class="col-12 col-md-12">
    <div class="form-group">
        <label>Meta Description</label>
        <textarea name="meta_description" id="meta_description" class="form-control"
                  onkeyup="updateSeoScore()">{{ old('meta_description') ?? ($seo->meta_description ?? '') }}</textarea>
        {{--<small id="descriptionScore" class="seo-score">Score: 0/100</small>--}}
    </div>

    @error('meta_description')
    <span class="text-danger">{{ $message }}</span>
    @enderror

</div>


<div class="col-12">
    <div class="form-group my-5">
        <div class="form-checkd d-flex align-items-center pl-3">
            <div class="pr-5">
                <input class="form-check-input" type="radio" name="robots" id="follow" value="index, follow"
                    {{ old('robots', $seo->robots ?? '') == 'index, follow' ? 'checked' : '' }}>
                <label class="form-check-label" for="follow">Index, Follow</label>
            </div>

            <div>
                <input class="form-check-input" type="radio" name="robots" id="nofollow" value="no index, no follow"
                    {{ old('robots', $seo->robots ?? '') == 'no index, no follow' ? 'checked' : '' }}>
                <label class="form-check-label" for="nofollow">No Index, No Follow</label>
            </div>
        </div>

        @error('robots')
        <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
</div>
