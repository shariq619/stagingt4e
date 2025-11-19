<div class="row">
    <div class="col-12">
        <div class="bgGray">Personal Details</div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('First Name') }}<span>*</span></label>
            <input type="text" id="father_name" name="father_name" class="form-control @error('father_name') is-invalid @enderror"
                   value="{{ auth()->user()->name ?? "" }}" readonly>
            @error('father_name')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Middle Name') }}</label>
            <input type="text" id="middle_name" name="middle_name" class="form-control">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Last Name') }}<span>*</span></label>
            <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                   value="{{ auth()->user()->last_name ?? "" }}" readonly>
            @error('last_name')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('D.O.B') }}<span>*</span></label>
            <input type="date" id="birth_date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror"
                   value="{{ old('birth_date', $application_form->birth_date) }}" required>
            @error('birth_date')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Nationality') }}<span>*</span></label>
            <select id="nationality" name="nationality" class="form-control @error('nationality') is-invalid @enderror" required>
                <option value="" disabled <?= empty($application_form->nationality) ? 'selected' : '' ?>>Select Nationality</option>
                <option value="Afghan" <?= $application_form->nationality == 'Afghan' ? 'selected' : '' ?>>Afghan</option>
                <option value="Albanian" <?= $application_form->nationality == 'Albanian' ? 'selected' : '' ?>>Albanian</option>
                <option value="Algerian" <?= $application_form->nationality == 'Algerian' ? 'selected' : '' ?>>Algerian</option>
                <option value="American" <?= $application_form->nationality == 'American' ? 'selected' : '' ?>>American</option>
                <option value="Andorran" <?= $application_form->nationality == 'Andorran' ? 'selected' : '' ?>>Andorran</option>
                <option value="Angolan" <?= $application_form->nationality == 'Angolan' ? 'selected' : '' ?>>Angolan</option>
                <option value="Anguillan" <?= $application_form->nationality == 'Anguillan' ? 'selected' : '' ?>>Anguillan</option>
                <option value="Argentine" <?= $application_form->nationality == 'Argentine' ? 'selected' : '' ?>>Argentine</option>
                <option value="Armenian" <?= $application_form->nationality == 'Armenian' ? 'selected' : '' ?>>Armenian</option>
                <option value="Australian" <?= $application_form->nationality == 'Australian' ? 'selected' : '' ?>>Australian</option>
                <option value="Austrian" <?= $application_form->nationality == 'Austrian' ? 'selected' : '' ?>>Austrian</option>
                <option value="Azerbaijani" <?= $application_form->nationality == 'Azerbaijani' ? 'selected' : '' ?>>Azerbaijani</option>
                <option value="Bahamian" <?= $application_form->nationality == 'Bahamian' ? 'selected' : '' ?>>Bahamian</option>
                <option value="Bahraini" <?= $application_form->nationality == 'Bahraini' ? 'selected' : '' ?>>Bahraini</option>
                <option value="Bangladeshi" <?= $application_form->nationality == 'Bangladeshi' ? 'selected' : '' ?>>Bangladeshi</option>
                <option value="Barbadian" <?= $application_form->nationality == 'Barbadian' ? 'selected' : '' ?>>Barbadian</option>
                <option value="Belarusian" <?= $application_form->nationality == 'Belarusian' ? 'selected' : '' ?>>Belarusian</option>
                <option value="Belgian" <?= $application_form->nationality == 'Belgian' ? 'selected' : '' ?>>Belgian</option>
                <option value="Belizean" <?= $application_form->nationality == 'Belizean' ? 'selected' : '' ?>>Belizean</option>
                <option value="Beninese" <?= $application_form->nationality == 'Beninese' ? 'selected' : '' ?>>Beninese</option>
                <option value="Bermudian" <?= $application_form->nationality == 'Bermudian' ? 'selected' : '' ?>>Bermudian</option>
                <option value="Bhutanese" <?= $application_form->nationality == 'Bhutanese' ? 'selected' : '' ?>>Bhutanese</option>
                <option value="Bolivian" <?= $application_form->nationality == 'Bolivian' ? 'selected' : '' ?>>Bolivian</option>
                <option value="Botswanan" <?= $application_form->nationality == 'Botswanan' ? 'selected' : '' ?>>Botswanan</option>
                <option value="Brazilian" <?= $application_form->nationality == 'Brazilian' ? 'selected' : '' ?>>Brazilian</option>
                <option value="British" <?= $application_form->nationality == 'British' ? 'selected' : '' ?>>British</option>
                <option value="British Virgin Islander" <?= $application_form->nationality == 'British Virgin Islander' ? 'selected' : '' ?>>British Virgin Islander</option>
                <option value="Bruneian" <?= $application_form->nationality == 'Bruneian' ? 'selected' : '' ?>>Bruneian</option>
                <option value="Bulgarian" <?= $application_form->nationality == 'Bulgarian' ? 'selected' : '' ?>>Bulgarian</option>
                <option value="Burkinan" <?= $application_form->nationality == 'Burkinan' ? 'selected' : '' ?>>Burkinan</option>
                <option value="Burmese" <?= $application_form->nationality == 'Burmese' ? 'selected' : '' ?>>Burmese</option>
                <option value="Burundian" <?= $application_form->nationality == 'Burundian' ? 'selected' : '' ?>>Burundian</option>
                <option value="Cambodian" <?= $application_form->nationality == 'Cambodian' ? 'selected' : '' ?>>Cambodian</option>
                <option value="Cameroonian" <?= $application_form->nationality == 'Cameroonian' ? 'selected' : '' ?>>Cameroonian</option>
                <option value="Canadian" <?= $application_form->nationality == 'Canadian' ? 'selected' : '' ?>>Canadian</option>
                <option value="Cape Verdean" <?= $application_form->nationality == 'Cape Verdean' ? 'selected' : '' ?>>Cape Verdean</option>
                <option value="Cayman Islander" <?= $application_form->nationality == 'Cayman Islander' ? 'selected' : '' ?>>Cayman Islander</option>
                <option value="Central African" <?= $application_form->nationality == 'Central African' ? 'selected' : '' ?>>Central African</option>
                <option value="Chadian" <?= $application_form->nationality == 'Chadian' ? 'selected' : '' ?>>Chadian</option>
                <option value="Chilean" <?= $application_form->nationality == 'Chilean' ? 'selected' : '' ?>>Chilean</option>
                <option value="Chinese" <?= $application_form->nationality == 'Chinese' ? 'selected' : '' ?>>Chinese</option>
                <option value="Citizen of Antigua and Barbuda" <?= $application_form->nationality == 'Citizen of Antigua and Barbuda' ? 'selected' : '' ?>>Citizen of Antigua and Barbuda</option>
                <option value="Citizen of Bosnia and Herzegovina" <?= $application_form->nationality == 'Citizen of Bosnia and Herzegovina' ? 'selected' : '' ?>>Citizen of Bosnia and Herzegovina</option>
                <option value="Citizen of Guinea-Bissau" <?= $application_form->nationality == 'Citizen of Guinea-Bissau' ? 'selected' : '' ?>>Citizen of Guinea-Bissau</option>
                <option value="Citizen of Kiribati" <?= $application_form->nationality == 'Citizen of Kiribati' ? 'selected' : '' ?>>Citizen of Kiribati</option>
                <option value="Citizen of Seychelles" <?= $application_form->nationality == 'Citizen of Seychelles' ? 'selected' : '' ?>>Citizen of Seychelles</option>
                <option value="Citizen of the Dominican Republic" <?= $application_form->nationality == 'Citizen of the Dominican Republic' ? 'selected' : '' ?>>Citizen of the Dominican Republic</option>
                <option value="Citizen of Vanuatu" <?= $application_form->nationality == 'Citizen of Vanuatu' ? 'selected' : '' ?>>Citizen of Vanuatu</option>
                <option value="Colombian" <?= $application_form->nationality == 'Colombian' ? 'selected' : '' ?>>Colombian</option>
                <option value="Comoran" <?= $application_form->nationality == 'Comoran' ? 'selected' : '' ?>>Comoran</option>
                <option value="Congolese (Congo)" <?= $application_form->nationality == 'Congolese (Congo)' ? 'selected' : '' ?>>Congolese (Congo)</option>
                <option value="Congolese (DRC)" <?= $application_form->nationality == 'Congolese (DRC)' ? 'selected' : '' ?>>Congolese (DRC)</option>
                <option value="Cook Islander" <?= $application_form->nationality == 'Cook Islander' ? 'selected' : '' ?>>Cook Islander</option>
                <option value="Costa Rican" <?= $application_form->nationality == 'Costa Rican' ? 'selected' : '' ?>>Costa Rican</option>
                <option value="Croatian" <?= $application_form->nationality == 'Croatian' ? 'selected' : '' ?>>Croatian</option>
                <option value="Cuban" <?= $application_form->nationality == 'Cuban' ? 'selected' : '' ?>>Cuban</option>
                <option value="Cymraes" <?= $application_form->nationality == 'Cymraes' ? 'selected' : '' ?>>Cymraes</option>
                <option value="Cymro" <?= $application_form->nationality == 'Cymro' ? 'selected' : '' ?>>Cymro</option>
                <option value="Cypriot" <?= $application_form->nationality == 'Cypriot' ? 'selected' : '' ?>>Cypriot</option>
                <option value="Czech" <?= $application_form->nationality == 'Czech' ? 'selected' : '' ?>>Czech</option>
                <option value="Danish" <?= $application_form->nationality == 'Danish' ? 'selected' : '' ?>>Danish</option>
                <option value="Djiboutian" <?= $application_form->nationality == 'Djiboutian' ? 'selected' : '' ?>>Djiboutian</option>
                <option value="Dominican" <?= $application_form->nationality == 'Dominican' ? 'selected' : '' ?>>Dominican</option>
                <option value="Dutch" <?= $application_form->nationality == 'Dutch' ? 'selected' : '' ?>>Dutch</option>
                <option value="East Timorese" <?= $application_form->nationality == 'East Timorese' ? 'selected' : '' ?>>East Timorese</option>
                <option value="Ecuadorean" <?= $application_form->nationality == 'Ecuadorean' ? 'selected' : '' ?>>Ecuadorean</option>
                <option value="Egyptian" <?= $application_form->nationality == 'Egyptian' ? 'selected' : '' ?>>Egyptian</option>
                <option value="Emirati" <?= $application_form->nationality == 'Emirati' ? 'selected' : '' ?>>Emirati</option>
                <option value="English" <?= $application_form->nationality == 'English' ? 'selected' : '' ?>>English</option>
                <option value="Equatorial Guinean" <?= $application_form->nationality == 'Equatorial Guinean' ? 'selected' : '' ?>>Equatorial Guinean</option>
                <option value="Eritrean" <?= $application_form->nationality == 'Eritrean' ? 'selected' : '' ?>>Eritrean</option>
                <option value="Estonian" <?= $application_form->nationality == 'Estonian' ? 'selected' : '' ?>>Estonian</option>
                <option value="Ethiopian" <?= $application_form->nationality == 'Ethiopian' ? 'selected' : '' ?>>Ethiopian</option>
                <option value="Faroese" <?= $application_form->nationality == 'Faroese' ? 'selected' : '' ?>>Faroese</option>
                <option value="Fijian" <?= $application_form->nationality == 'Fijian' ? 'selected' : '' ?>>Fijian</option>
                <option value="Filipino" <?= $application_form->nationality == 'Filipino' ? 'selected' : '' ?>>Filipino</option>
                <option value="Finnish" <?= $application_form->nationality == 'Finnish' ? 'selected' : '' ?>>Finnish</option>
                <option value="French" <?= $application_form->nationality == 'French' ? 'selected' : '' ?>>French</option>
                <option value="Gabonese" <?= $application_form->nationality == 'Gabonese' ? 'selected' : '' ?>>Gabonese</option>
                <option value="Gambian" <?= $application_form->nationality == 'Gambian' ? 'selected' : '' ?>>Gambian</option>
                <option value="Georgian" <?= $application_form->nationality == 'Georgian' ? 'selected' : '' ?>>Georgian</option>
                <option value="German" <?= $application_form->nationality == 'German' ? 'selected' : '' ?>>German</option>
                <option value="Ghanaian" <?= $application_form->nationality == 'Ghanaian' ? 'selected' : '' ?>>Ghanaian</option>
                <option value="Gibraltarian" <?= $application_form->nationality == 'Gibraltarian' ? 'selected' : '' ?>>Gibraltarian</option>
                <option value="Greek" <?= $application_form->nationality == 'Greek' ? 'selected' : '' ?>>Greek</option>
                <option value="Greenlandic" <?= $application_form->nationality == 'Greenlandic' ? 'selected' : '' ?>>Greenlandic</option>
                <option value="Grenadian" <?= $application_form->nationality == 'Grenadian' ? 'selected' : '' ?>>Grenadian</option>
                <option value="Guamanian" <?= $application_form->nationality == 'Guamanian' ? 'selected' : '' ?>>Guamanian</option>
                <option value="Guatemalan" <?= $application_form->nationality == 'Guatemalan' ? 'selected' : '' ?>>Guatemalan</option>
                <option value="Guinean" <?= $application_form->nationality == 'Guinean' ? 'selected' : '' ?>>Guinean</option>
                <option value="Guyanese" <?= $application_form->nationality == 'Guyanese' ? 'selected' : '' ?>>Guyanese</option>
                <option value="Haitian" <?= $application_form->nationality == 'Haitian' ? 'selected' : '' ?>>Haitian</option>
                <option value="Honduran" <?= $application_form->nationality == 'Honduran' ? 'selected' : '' ?>>Honduran</option>
                <option value="Hong Konger" <?= $application_form->nationality == 'Hong Konger' ? 'selected' : '' ?>>Hong Konger</option>
                <option value="Hungarian" <?= $application_form->nationality == 'Hungarian' ? 'selected' : '' ?>>Hungarian</option>
                <option value="Icelandic" <?= $application_form->nationality == 'Icelandic' ? 'selected' : '' ?>>Icelandic</option>
                <option value="Indian" <?= $application_form->nationality == 'Indian' ? 'selected' : '' ?>>Indian</option>
                <option value="Indonesian" <?= $application_form->nationality == 'Indonesian' ? 'selected' : '' ?>>Indonesian</option>
                <option value="Iranian" <?= $application_form->nationality == 'Iranian' ? 'selected' : '' ?>>Iranian</option>
                <option value="Iraqi" <?= $application_form->nationality == 'Iraqi' ? 'selected' : '' ?>>Iraqi</option>
                <option value="Irish" <?= $application_form->nationality == 'Irish' ? 'selected' : '' ?>>Irish</option>
                <option value="Israeli" <?= $application_form->nationality == 'Israeli' ? 'selected' : '' ?>>Israeli</option>
                <option value="Italian" <?= $application_form->nationality == 'Italian' ? 'selected' : '' ?>>Italian</option>
                <option value="Ivorian" <?= $application_form->nationality == 'Ivorian' ? 'selected' : '' ?>>Ivorian</option>
                <option value="Jamaican" <?= $application_form->nationality == 'Jamaican' ? 'selected' : '' ?>>Jamaican</option>
                <option value="Japanese" <?= $application_form->nationality == 'Japanese' ? 'selected' : '' ?>>Japanese</option>
                <option value="Jordanian" <?= $application_form->nationality == 'Jordanian' ? 'selected' : '' ?>>Jordanian</option>
                <option value="Kazakh" <?= $application_form->nationality == 'Kazakh' ? 'selected' : '' ?>>Kazakh</option>
                <option value="Kenyan" <?= $application_form->nationality == 'Kenyan' ? 'selected' : '' ?>>Kenyan</option>
                <option value="Kittitian" <?= $application_form->nationality == 'Kittitian' ? 'selected' : '' ?>>Kittitian</option>
                <option value="Kosovan" <?= $application_form->nationality == 'Kosovan' ? 'selected' : '' ?>>Kosovan</option>
                <option value="Kuwaiti" <?= $application_form->nationality == 'Kuwaiti' ? 'selected' : '' ?>>Kuwaiti</option>
                <option value="Kyrgyz" <?= $application_form->nationality == 'Kyrgyz' ? 'selected' : '' ?>>Kyrgyz</option>
                <option value="Lao" <?= $application_form->nationality == 'Lao' ? 'selected' : '' ?>>Lao</option>
                <option value="Latvian" <?= $application_form->nationality == 'Latvian' ? 'selected' : '' ?>>Latvian</option>
                <option value="Lebanese" <?= $application_form->nationality == 'Lebanese' ? 'selected' : '' ?>>Lebanese</option>
                <option value="Liberian" <?= $application_form->nationality == 'Liberian' ? 'selected' : '' ?>>Liberian</option>
                <option value="Libyan" <?= $application_form->nationality == 'Libyan' ? 'selected' : '' ?>>Libyan</option>
                <option value="Liechtenstein citizen" <?= $application_form->nationality == 'Liechtenstein citizen' ? 'selected' : '' ?>>Liechtenstein citizen</option>
                <option value="Lithuanian" <?= $application_form->nationality == 'Lithuanian' ? 'selected' : '' ?>>Lithuanian</option>
                <option value="Luxembourger" <?= $application_form->nationality == 'Luxembourger' ? 'selected' : '' ?>>Luxembourger</option>
                <option value="Macanese" <?= $application_form->nationality == 'Macanese' ? 'selected' : '' ?>>Macanese</option>
                <option value="Macedonian" <?= $application_form->nationality == 'Macedonian' ? 'selected' : '' ?>>Macedonian</option>
                <option value="Malagasy" <?= $application_form->nationality == 'Malagasy' ? 'selected' : '' ?>>Malagasy</option>
                <option value="Malawian" <?= $application_form->nationality == 'Malawian' ? 'selected' : '' ?>>Malawian</option>
                <option value="Malaysian" <?= $application_form->nationality == 'Malaysian' ? 'selected' : '' ?>>Malaysian</option>
                <option value="Maldivian" <?= $application_form->nationality == 'Maldivian' ? 'selected' : '' ?>>Maldivian</option>
                <option value="Malian" <?= $application_form->nationality == 'Malian' ? 'selected' : '' ?>>Malian</option>
                <option value="Maltese" <?= $application_form->nationality == 'Maltese' ? 'selected' : '' ?>>Maltese</option>
                <option value="Marshallese" <?= $application_form->nationality == 'Marshallese' ? 'selected' : '' ?>>Marshallese</option>
                <option value="Martiniquais" <?= $application_form->nationality == 'Martiniquais' ? 'selected' : '' ?>>Martiniquais</option>
                <option value="Mauritanian" <?= $application_form->nationality == 'Mauritanian' ? 'selected' : '' ?>>Mauritanian</option>
                <option value="Mauritian" <?= $application_form->nationality == 'Mauritian' ? 'selected' : '' ?>>Mauritian</option>
                <option value="Mexican" <?= $application_form->nationality == 'Mexican' ? 'selected' : '' ?>>Mexican</option>
                <option value="Micronesian" <?= $application_form->nationality == 'Micronesian' ? 'selected' : '' ?>>Micronesian</option>
                <option value="Moldovan" <?= $application_form->nationality == 'Moldovan' ? 'selected' : '' ?>>Moldovan</option>
                <option value="Monegasque" <?= $application_form->nationality == 'Monegasque' ? 'selected' : '' ?>>Monegasque</option>
                <option value="Mongolian" <?= $application_form->nationality == 'Mongolian' ? 'selected' : '' ?>>Mongolian</option>
                <option value="Montenegrin" <?= $application_form->nationality == 'Montenegrin' ? 'selected' : '' ?>>Montenegrin</option>
                <option value="Montserratian" <?= $application_form->nationality == 'Montserratian' ? 'selected' : '' ?>>Montserratian</option>
                <option value="Moroccan" <?= $application_form->nationality == 'Moroccan' ? 'selected' : '' ?>>Moroccan</option>
                <option value="Mosotho" <?= $application_form->nationality == 'Mosotho' ? 'selected' : '' ?>>Mosotho</option>
                <option value="Mozambican" <?= $application_form->nationality == 'Mozambican' ? 'selected' : '' ?>>Mozambican</option>
                <option value="Namibian" <?= $application_form->nationality == 'Namibian' ? 'selected' : '' ?>>Namibian</option>
                <option value="Nauruan" <?= $application_form->nationality == 'Nauruan' ? 'selected' : '' ?>>Nauruan</option>
                <option value="Nepalese" <?= $application_form->nationality == 'Nepalese' ? 'selected' : '' ?>>Nepalese</option>
                <option value="New Zealander" <?= $application_form->nationality == 'New Zealander' ? 'selected' : '' ?>>New Zealander</option>
                <option value="Nicaraguan" <?= $application_form->nationality == 'Nicaraguan' ? 'selected' : '' ?>>Nicaraguan</option>
                <option value="Nigerian" <?= $application_form->nationality == 'Nigerian' ? 'selected' : '' ?>>Nigerian</option>
                <option value="Nigerien" <?= $application_form->nationality == 'Nigerien' ? 'selected' : '' ?>>Nigerien</option>
                <option value="Niuean" <?= $application_form->nationality == 'Niuean' ? 'selected' : '' ?>>Niuean</option>
                <option value="North Korean" <?= $application_form->nationality == 'North Korean' ? 'selected' : '' ?>>North Korean</option>
                <option value="Northern Irish" <?= $application_form->nationality == 'Northern Irish' ? 'selected' : '' ?>>Northern Irish</option>
                <option value="Norwegian" <?= $application_form->nationality == 'Norwegian' ? 'selected' : '' ?>>Norwegian</option>
                <option value="Omani" <?= $application_form->nationality == 'Omani' ? 'selected' : '' ?>>Omani</option>
                <option value="Pakistani" <?= $application_form->nationality == 'Pakistani' ? 'selected' : '' ?>>Pakistani</option>
                <option value="Palauan" <?= $application_form->nationality == 'Palauan' ? 'selected' : '' ?>>Palauan</option>
                <option value="Palestinian" <?= $application_form->nationality == 'Palestinian' ? 'selected' : '' ?>>Palestinian</option>
                <option value="Panamanian" <?= $application_form->nationality == 'Panamanian' ? 'selected' : '' ?>>Panamanian</option>
                <option value="Papua New Guinean" <?= $application_form->nationality == 'Papua New Guinean' ? 'selected' : '' ?>>Papua New Guinean</option>
                <option value="Paraguayan" <?= $application_form->nationality == 'Paraguayan' ? 'selected' : '' ?>>Paraguayan</option>
                <option value="Peruvian" <?= $application_form->nationality == 'Peruvian' ? 'selected' : '' ?>>Peruvian</option>
                <option value="Pitcairn Islander" <?= $application_form->nationality == 'Pitcairn Islander' ? 'selected' : '' ?>>Pitcairn Islander</option>
                <option value="Polish" <?= $application_form->nationality == 'Polish' ? 'selected' : '' ?>>Polish</option>
                <option value="Portuguese" <?= $application_form->nationality == 'Portuguese' ? 'selected' : '' ?>>Portuguese</option>
                <option value="Prydeinig" <?= $application_form->nationality == 'Prydeinig' ? 'selected' : '' ?>>Prydeinig</option>
                <option value="Puerto Rican" <?= $application_form->nationality == 'Puerto Rican' ? 'selected' : '' ?>>Puerto Rican</option>
                <option value="Qatari" <?= $application_form->nationality == 'Qatari' ? 'selected' : '' ?>>Qatari</option>
                <option value="Romanian" <?= $application_form->nationality == 'Romanian' ? 'selected' : '' ?>>Romanian</option>
                <option value="Russian" <?= $application_form->nationality == 'Russian' ? 'selected' : '' ?>>Russian</option>
                <option value="Rwandan" <?= $application_form->nationality == 'Rwandan' ? 'selected' : '' ?>>Rwandan</option>
                <option value="Salvadorean" <?= $application_form->nationality == 'Salvadorean' ? 'selected' : '' ?>>Salvadorean</option>
                <option value="Sammarinese" <?= $application_form->nationality == 'Sammarinese' ? 'selected' : '' ?>>Sammarinese</option>
                <option value="Samoan" <?= $application_form->nationality == 'Samoan' ? 'selected' : '' ?>>Samoan</option>
                <option value="Sao Tomean" <?= $application_form->nationality == 'Sao Tomean' ? 'selected' : '' ?>>Sao Tomean</option>
                <option value="Saudi Arabian" <?= $application_form->nationality == 'Saudi Arabian' ? 'selected' : '' ?>>Saudi Arabian</option>
                <option value="Scottish" <?= $application_form->nationality == 'Scottish' ? 'selected' : '' ?>>Scottish</option>
                <option value="Senegalese" <?= $application_form->nationality == 'Senegalese' ? 'selected' : '' ?>>Senegalese</option>
                <option value="Serbian" <?= $application_form->nationality == 'Serbian' ? 'selected' : '' ?>>Serbian</option>
                <option value="Seychellois" <?= $application_form->nationality == 'Seychellois' ? 'selected' : '' ?>>Seychellois</option>
                <option value="Sierra Leonean" <?= $application_form->nationality == 'Sierra Leonean' ? 'selected' : '' ?>>Sierra Leonean</option>
                <option value="Singaporean" <?= $application_form->nationality == 'Singaporean' ? 'selected' : '' ?>>Singaporean</option>
                <option value="Slovak" <?= $application_form->nationality == 'Slovak' ? 'selected' : '' ?>>Slovak</option>
                <option value="Slovenian" <?= $application_form->nationality == 'Slovenian' ? 'selected' : '' ?>>Slovenian</option>
                <option value="Solomon Islander" <?= $application_form->nationality == 'Solomon Islander' ? 'selected' : '' ?>>Solomon Islander</option>
                <option value="Somali" <?= $application_form->nationality == 'Somali' ? 'selected' : '' ?>>Somali</option>
                <option value="South African" <?= $application_form->nationality == 'South African' ? 'selected' : '' ?>>South African</option>
                <option value="South Korean" <?= $application_form->nationality == 'South Korean' ? 'selected' : '' ?>>South Korean</option>
                <option value="South Sudanese" <?= $application_form->nationality == 'South Sudanese' ? 'selected' : '' ?>>South Sudanese</option>
                <option value="Spanish" <?= $application_form->nationality == 'Spanish' ? 'selected' : '' ?>>Spanish</option>
                <option value="Sri Lankan" <?= $application_form->nationality == 'Sri Lankan' ? 'selected' : '' ?>>Sri Lankan</option>
                <option value="St Helenian" <?= $application_form->nationality == 'St Helenian' ? 'selected' : '' ?>>St Helenian</option>
                <option value="St Lucian" <?= $application_form->nationality == 'St Lucian' ? 'selected' : '' ?>>St Lucian</option>
                <option value="Stateless" <?= $application_form->nationality == 'Stateless' ? 'selected' : '' ?>>Stateless</option>
                <option value="Sudanese" <?= $application_form->nationality == 'Sudanese' ? 'selected' : '' ?>>Sudanese</option>
                <option value="Surinamese" <?= $application_form->nationality == 'Surinamese' ? 'selected' : '' ?>>Surinamese</option>
                <option value="Swazi" <?= $application_form->nationality == 'Swazi' ? 'selected' : '' ?>>Swazi</option>
                <option value="Swedish" <?= $application_form->nationality == 'Swedish' ? 'selected' : '' ?>>Swedish</option>
                <option value="Swiss" <?= $application_form->nationality == 'Swiss' ? 'selected' : '' ?>>Swiss</option>
                <option value="Syrian" <?= $application_form->nationality == 'Syrian' ? 'selected' : '' ?>>Syrian</option>
                <option value="Taiwanese" <?= $application_form->nationality == 'Taiwanese' ? 'selected' : '' ?>>Taiwanese</option>
                <option value="Tajik" <?= $application_form->nationality == 'Tajik' ? 'selected' : '' ?>>Tajik</option>
                <option value="Tanzanian" <?= $application_form->nationality == 'Tanzanian' ? 'selected' : '' ?>>Tanzanian</option>
                <option value="Thai" <?= $application_form->nationality == 'Thai' ? 'selected' : '' ?>>Thai</option>
                <option value="Togolese" <?= $application_form->nationality == 'Togolese' ? 'selected' : '' ?>>Togolese</option>
                <option value="Tongan" <?= $application_form->nationality == 'Tongan' ? 'selected' : '' ?>>Tongan</option>
                <option value="Trinidadian" <?= $application_form->nationality == 'Trinidadian' ? 'selected' : '' ?>>Trinidadian</option>
                <option value="Tristanian" <?= $application_form->nationality == 'Tristanian' ? 'selected' : '' ?>>Tristanian</option>
                <option value="Tunisian" <?= $application_form->nationality == 'Tunisian' ? 'selected' : '' ?>>Tunisian</option>
                <option value="Turkish" <?= $application_form->nationality == 'Turkish' ? 'selected' : '' ?>>Turkish</option>
                <option value="Turkmen" <?= $application_form->nationality == 'Turkmen' ? 'selected' : '' ?>>Turkmen</option>
                <option value="Tuvaluan" <?= $application_form->nationality == 'Tuvaluan' ? 'selected' : '' ?>>Tuvaluan</option>
                <option value="Ugandan" <?= $application_form->nationality == 'Ugandan' ? 'selected' : '' ?>>Ugandan</option>
                <option value="Ukrainian" <?= $application_form->nationality == 'Ukrainian' ? 'selected' : '' ?>>Ukrainian</option>
                <option value="Uruguayan" <?= $application_form->nationality == 'Uruguayan' ? 'selected' : '' ?>>Uruguayan</option>
                <option value="Uzbek" <?= $application_form->nationality == 'Uzbek' ? 'selected' : '' ?>>Uzbek</option>
                <option value="Vatican citizen" <?= $application_form->nationality == 'Vatican citizen' ? 'selected' : '' ?>>Vatican citizen</option>
                <option value="Venezuelan" <?= $application_form->nationality == 'Venezuelan' ? 'selected' : '' ?>>Venezuelan</option>
                <option value="Vietnamese" <?= $application_form->nationality == 'Vietnamese' ? 'selected' : '' ?>>Vietnamese</option>
                <option value="Vincentian" <?= $application_form->nationality == 'Vincentian' ? 'selected' : '' ?>>Vincentian</option>
                <option value="Wallisian" <?= $application_form->nationality == 'Wallisian' ? 'selected' : '' ?>>Wallisian</option>
                <option value="Welsh" <?= $application_form->nationality == 'Welsh' ? 'selected' : '' ?>>Welsh</option>
                <option value="Yemeni" <?= $application_form->nationality == 'Yemeni' ? 'selected' : '' ?>>Yemeni</option>
                <option value="Zambian" <?= $application_form->nationality == 'Zambian' ? 'selected' : '' ?>>Zambian</option>
                <option value="Zimbabwean" <?= $application_form->nationality == 'Zimbabwean' ? 'selected' : '' ?>>Zimbabwean</option>
            </select>
            @error('nationality')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Email Address') }}<span>*</span></label>
            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ auth()->user()->email ?? "" }}"  readonly  >
            @error('email')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Address') }}<span>*</span></label>
            <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror"
                   value="{{ old('address', $application_form->address) }}" required>
            @error('address')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Post Code') }}<span>*</span></label>
            <input type="text" id="post_code" name="post_code" class="form-control @error('post_code') is-invalid @enderror"
                   value="{{ old('post_code', $application_form->post_code) }}" required>
            @error('post_code')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Mobile Number') }}<span>*</span></label>
            <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                   value="{{ old('phone_number', $application_form->phone_number) }}" required>
            @error('phone_number')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Telephone No') }}</label>
            <input type="text" id="telephone" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                   value="{{ old('telephone', $application_form->telephone) }}">
            @error('telephone')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="bgGray">Next of Kin</div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Name') }}<span>*</span></label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $application_form->name) }}" required>
            @error('name')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Contact Number') }}<span>*</span></label>
            <input type="text" id="contact_num" name="contact_num" class="form-control @error('contact_num') is-invalid @enderror"
                   value="{{ old('contact_num', $application_form->contact_num) }}" required>
            @error('contact_num')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Relationship to you') }}</label>
            <input type="text" id="relationship_to_you" name="relationship_to_you"
                   class="form-control @error('relationship_to_you') is-invalid @enderror"
                   value="{{ old('relationship_to_you', $application_form->relationship_to_you) }}">
            @error('relationship_to_you')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="bgGray">Employer Details</div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Company Name') }}</label>
            <input type="text" id="company" name="company" class="form-control "
                   value="{{ old('company', $application_form->company) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Contact Name') }}</label>
            <input type="text" id="emp_contact_name" name="emp_contact_name"
                   class="form-control "
                   value="{{ old('emp_contact_name', $application_form->emp_contact_name) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Contact Number') }}</label>
            <input type="text" id="emp_contact_num" name="emp_contact_num"
                   class="form-control "
                   value="{{ old('emp_contact_num', $application_form->emp_contact_num) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Company Address') }}</label>
            <input type="text" id="emp_copmany_address" name="emp_copmany_address"
                   class="form-control"
                   value="{{ old('emp_copmany_address', $application_form->emp_copmany_address) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Post Code') }}</label>
            <input type="text" id="emp_post_code" name="emp_post_code"
                   class="form-control"
                   value="{{ old('emp_post_code', $application_form->emp_post_code) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Levy Number (If Applicable):') }}</label>
            <input type="text" id="levy_number" name="levy_number" class="form-control @error('levy_number') is-invalid @enderror"
                   value="{{ old('levy_number', $application_form->levy_number) }}">
        </div>
    </div>
    <div class="col-md-12">

        <div class="form-group">
            <div class="bgGray">{{ __('How Did You Hear Abou Us?') }} <span class="text-red">*</span></div>
            @php
                $hearAboutOptions = [
                    '1' => 'Social Media (Facebook, Instagram, LinkedIn, X, TikTok, YouTube, etc.)',
                    '2' => 'Search Engine (Google, Yahoo, etc)',
                    '3' => 'Paid Google Advertisement',
                    '4' => 'Paid Bing Advertisement',
                    '5' => 'Word of Mouth',
                    '6' => 'Email',
                    '7' => 'Referred by a Trainer',
                    '8' => 'Referred by a Friend',
                    '9' => 'Third Party (Hurak, Get Licenced, etc)',
                    '10' => 'Other',
                ];
            @endphp
            @foreach ($hearAboutOptions as $key => $option)
                <div class="custom-control custom-radio">
                    <input type="radio" id="hear_about_{{ $key }}" name="hear_about"
                           class="custom-control-input" value="{{ $key }}"
                        {{ old('hear_about', $application_form->hear_about) == $key ? 'checked' : '' }}>
                    <label class="custom-control-label"
                           for="hear_about_{{ $key }}">{{ $option }}</label>
                </div>
            @endforeach

            @error('hear_about')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="bgGray">{{ __('Declaration') }}</div>
            <h3>GUIDELINES FOR CANDIDATES & EMPLOYERS</h3>
            <p>Training for Employment courses can be physically demanding. It is the employer’s responsibility to
                ensure that candidates are free from any condition which would affect their capability, and that they
                have the aptitude to cope with an intensive course of study. (We welcome candidates with disabilities
                for training, but it remains their employer’s responsibility to ensure that they are appropriately
                supported in their workplace.)</p>

            <div class="form-check">
                <input type="checkbox" name="guideline1" checked class="form-check-input"
                    {{ old('guideline1', $application_form->guideline1) == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="defaultCheck1">
                    I consent to having images and videos of myself taken during the course for quality assurance and
                    compliance purposes. These images and videos may be shared with the examination board to support the
                    attainment of my qualification(s).
                </label>

            </div>
            <div class="form-check">
                <input type="checkbox" name="guideline2" checked class="form-check-input"
                    {{ old('guideline1', $application_form->guideline2) == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="defaultCheck1">
                    I understand that if, at any time during the course, I do not wish to participate in or appear in
                    marketing and promotional videos and/or images, I must inform the trainer or the staff member taking
                    the
                    images to ensure I am not included.
                </label>
            </div>
            <p>At Training for Employment Ltd we offer exclusive offers and useful industry information to our loyal
                customers. To do this, we require your permission to confirm you are happy for Training for Employment
                Ltd to contact you via email, post, SMS, phone, and other electronic means. We will always treat your
                personal details with the utmost care and will never sell them to other companies for marketing
                purposes.</p>
            <div class="form-check">
                <input type="checkbox" name="guideline3" checked class="form-check-input"
                    {{ old('guideline1', $application_form->guideline3) == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="defaultCheck1">
                    I consent to Training for Employment Ltd to contact via email, SMS or phone.
                </label>
            </div>
            <h4>PURCHASES MADE FROM REED.CO.UK</h4>
            <p>You may cancel your purchase of the course within the period of 14 calendar days from the date on which
                the contract of purchase is concluded. This is called a “Cancellation Period”. Note that if you redeem
                your voucher during the Cancellation Period, you expressly request us to begin providing the course
                materials and you acknowledge that you lose your right to cancel the purchase of the course and get any
                refund for it.</p>
            <p>In case you decide to cancel your purchase of a course, it can be done in the following way: By sending a
                cancellation email to info@training4employment.co.uk.</p>

            @error('hear_about')
            <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="bgGray">{{ __('Terms and Conditions') }}</div>

            <p>Our aim is to make it as easy as possible to learn and relate subjects with Training 4 Employment Ltd.
            </p>
            <p>
                1. BOOKINGS AND ENROLMENT:

                1.1. Bookings may be made via e-mail, T4E website, telephone, or in person.

                1.2. Registration for a course is not guaranteed until we have received full course fee or deposit
                payment (if applicable) and required paperwork has been complete by a delegate. Placement in the course
                will be confirmed via E-mail by a member of T4E staff.
            </p>
            <p>
                2. DEPOSIT AND PAYMENT:

                2.1. Our courses are non-refundable 24 hours after booking. You can receive a full refund if you inform
                us within 24 hours of booking of your intention to cancel, and you will be refunded the amount paid for
                the course. Courses cancelled after 24 hours of booking will not be eligible for a refund.
            </p>
            <p>
                3. COURSE ATTENDANCE& RESCHEDULING:

                3.1. 100% attendance is a must. If you fail to attend without notice or arrive late for the course, the
                tutor will refuse your place on the course due to the amount of content missed, you will not be entitled
                to a refund.

                3.2. Once a course has commenced, the delegate must attend all sessions necessary to complete the course
                the course cannot be completed later. You will not be entitled to any refund for any absence.

                3.3. If you are absent from any session, we reserve the right to refuse to accept you for training and
                the full course fee remains payable.

                3.4. Training4Employment will review each absence and any reasons given for that absence. If the
                delegate was unable to attend due to exceptional circumstances, then Training4Employment may offer a new
                course start date. Training4Employment will require you to provide supporting documents to prove the
                exceptional circumstances alleged.

                3.5. If you do not reschedule your course 72 hours before it starts or fail to attend the course you
                have booked, regardless of the package you have purchased, you will be required to pay for a new booking
                if you wish to take the course in the future.

                3.6. If you are unable to attend on the scheduled course date, you must notify us at least 72 hours
                before your course starts. If your course is starting within 72 hours, you will be charged the standard
                reschedule fee (please see section 7).

                3.7. It is a legal requirement to always have ID on you during your training. If you do not bring the
                required IDs and any other required documents, you will need to be rescheduled onto another course and
                you will be charged a rescheduling fee (please see section 7).

                3.8. If a course is cancelled by T4E, you will be advised at the earliest possible opportunity and
                arrangements will be made for your course to be rearranged or the course fee to be refunded. This may
                occur at very short notice, in particular if the minimum number of participants has not been reached.

                4. HOUSEKEEPING:

                4.1. Abuse towards staff and other trainees will not be tolerated, you will be taken off the course and
                no refund.
            </p>
            <p>
                5. CERTIFICATION:

                5.1. Due to COVID-19 pandemic, we are only able to supply delegates with e-certificates

                5.2. You will receive your e-certificate to the email provided when booking

                5.3. Your e-certificate will be emailed 3-5 working days after you have received your results.

                5.4. Results may take from 7 to 14 working days.
            </p>
            <p>
                6. EXAM RETAKES:

                6.1. SIA Security Training Courses:

                6.1.1. Sor SIA Security Training Courses there are 2 free retakes applicable.

                6.1.2. Retake exams will be held within 2 – 3 weeks of us receiving exam papers.

                6.1.3. Video recordings of delegates will be taken in the duration of the course for the purposes of the
                delegates practical examinations.
            </p>
            <p>
                6.2. Construction Courses:

                6.2.1. For all construction courses there is 1 free retake applicable.

                6.2.2. The examination can either be retaken on the same day or the delegate can attend another course
                within a 90-day period (the delegate is not obliged to re-sit the day’s course).

                6.2.3. Delegates must attend a full CITB course again before they are allowed to retake the examination
                if they score less than in the original exam:

                6.2.3.1. 60% for CSCS HAS Course

                6.2.3.2. 67% for SSSTS / SSSTS Course

                6.2.3.3. 69% for SMSTS / SMSTS-R Courses
            </p>
            <p>
                6.3. Other Courses:

                6.3.1. No Pass No resit Fee applicable to the following courses:

                6.3.1.1. First Aid at Work

                6.3.1.2. Emergency First Aid at Work

                6.3.1.3. Traffic Marshall, Vehicle Banksman
            </p>
            <p>
                7. RESCHEDULING FEES:

                7.1. SIA Door Supervisor | SIA CCTV courses – £80

                7.2. SIA Door Supervisor Top Up | SIA Security Guard Top Up courses – £60

                7.3. Emergency First Aid at Work | Paediatric Emergency First Aid courses – £40

                7.4. First Aid at Work | Paediatric First Aid Courses – £60

                7.5. Health and Safety Awareness (HAS) course – £60

                7.6. SSTS| SSTS-R | SMSTS | SMSTS-R courses – £80

                7.7. All Utility & Energy courses – £80

                7.8. Fire Safety courses – £60

                7.9. Traffic Marshal, Vehicle Banksman Course – £20.
            </p>
            <div class="form-check">
                <input type="checkbox" checked class="form-check-input" name="term"
                {{ old('term', $application_form->term) == 1 ? 'checked' : '' }}
                <label class="form-check-label" for="defaultCheck1">
                    I confirm that I have read the Terms & Conditions and fully understand the contents therein and
                    further confirm that I shall be responsible for my and any fees applicable as set out in the Terms &
                    Conditions. </label>
            </div>
        </div>
    </div>
</div>
