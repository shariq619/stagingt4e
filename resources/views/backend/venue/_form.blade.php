<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Code') }}</label>
            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', $venue->code) }}">
            @error('code')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Venue Name') }}</label>
            <input type="text" name="venue_name" id="venue_name"
                class="form-control @error('venue_name') is-invalid @enderror"
                value="{{ old('venue_name', $venue->venue_name) }}">
            @error('venue_name')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Address Line 1') }}</label>
            <input type="text" name="address" id="address"
                class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address', $venue->address) }}">
            @error('address')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Post Code') }}</label>
            <div class="input-group">
                <input type="text" name="post_code" id="post_code"
                    class="form-control @error('post_code') is-invalid @enderror"
                    value="{{ old('post_code', $venue->post_code) }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="postcode_lookup">Lookup</button>
                </div>
            </div>
            @error('post_code')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
            <small id="post_code_help" class="form-text text-muted">
                Examples: <span class="postcode-example" data-postcode="OX49 5NU">OX49 5NU</span>,
                <span class="postcode-example" data-postcode="M32 0JG">M32 0JG</span>,
                <span class="postcode-example" data-postcode="NE30 1DP">NE30 1DP</span>
            </small>
        </div>
        <div id="postcode_results"></div>
        <div class="form-group">
            <label for="uk-regions">Select UK Region</label>
            <select class="form-control" name="region" id="uk-regions" required>
                <option value="">Select a region</option>
                @foreach ($regions as $region)
                    <option value="{{ $region }}" @if ($region == $venue->region) selected @endif>
                        {{ $region }}</option>
                @endforeach
            </select>
            @error('region')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="uk-cities">Select City</label>
            <select class="form-control" name="city" id="uk-cities" required>
                <option value="">Select a city</option>
                @foreach ($cities as $city)
                    <option value="{{ $city }}" @if ($city == $venue->city) selected @endif>
                        {{ $city }}</option>
                @endforeach
            </select>
            @error('city')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Primary Contact Number') }}</label>
            <input type="tel" name="primary_contact_number" id="primary_contact_number"
                class="form-control @error('primary_contact_number') is-invalid @enderror"
                value="{{ old('primary_contact_number', $venue->primary_contact_number) }}">
            @error('primary_contact_number')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Telephone Number') }}</label>
            <input type="tel" name="telephone_number" id="telephone_number"
                class="form-control @error('telephone_number') is-invalid @enderror"
                value="{{ old('telephone_number', $venue->telephone_number) }}">
            @error('telephone_number')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Email') }}</label>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $venue->email) }}">
            @error('email')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Parking') }}</label>
            <input type="text" name="parking" id="parking"
                class="form-control @error('parking') is-invalid @enderror"
                value="{{ old('parking', $venue->parking) }}">
            @error('parking')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Access Instructions') }}</label>
            <textarea name="access_instructions" id="access_instructions"
                class="form-control @error('access_instructions') is-invalid @enderror">{{ old('access_instructions', $venue->access_instructions) }}</textarea>
            @error('access_instructions')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#postcode_lookup').click(function() {
                var postcode = $('#post_code').val();
                var button = $(this);
                button.html('Searching...'); // Change button text to indicate searching
                $.ajax({
                    url: 'https://api.postcodes.io/postcodes/' + postcode,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 200) {
                            var resultHtml = '<p><strong>Postcode:</strong> ' + response.result
                                .postcode + ' <span class="text-success">&#10004;</span></p>';


                            // + ' <span class="text-success">&#10004;</span></p>' +
                            // '<p><strong>Latitude:</strong> ' + response.result.latitude + '</p>' +
                            // '<p><strong>Longitude:</strong> ' + response.result.longitude + '</p>' +
                            // '<p><strong>Region:</strong> ' + response.result.region + '</p>' +
                            // '<p><strong>Country:</strong> ' + response.result.country + '</p>'


                            $('#postcode_results').html(resultHtml);
                        } else {
                            $('#postcode_results').html(
                                '<p class="text-danger">Postcode not found</p>');
                            $('#post_code').val(''); // Clear the postcode input field
                        }
                        button.html('Lookup'); // Change button text back to original
                    },
                    error: function() {
                        $('#postcode_results').html(
                            '<p class="text-danger">Postcode not found</p>');
                        $('#post_code').val(''); // Clear the postcode input field
                        button.html('Lookup'); // Change button text back to original
                    }
                });
            });
        });
    </script>
@endpush
