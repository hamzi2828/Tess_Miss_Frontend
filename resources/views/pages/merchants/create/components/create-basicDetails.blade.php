<div class="row mb-3">
    <div class="col-md-6">
        <label for="merchantName" class="form-label">Merchant Name <span class="required-asterisk">*</span></label>
        <input type="text" class="form-control" id="merchantName" name="merchant_name" value="{{ old('merchant_name') }}" required>
    </div>

    <div class="col-md-6">
        <label for="dateOfIncorporation" class="form-label">Date of Incorporation <span class="required-asterisk">*</span></label>
        <input type="date" class="form-control" id="dateOfIncorporation" name="date_of_incorporation" value="{{ old('date_of_incorporation') }}" required>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="merchantArabicName" class="form-label">Merchant Arabic Name <span class="required-asterisk">*</span></label>
        <input type="text" class="form-control" id="merchantArabicName" name="merchant_arabic_name" value="{{ old('merchant_arabic_name') }}" required>
    </div>

    <div class="col-md-6">
        <label for="companyRegistration" class="form-label">Company Registration <span class="required-asterisk">*</span></label>
        <input type="text" class="form-control" id="companyRegistration" name="company_registration" value="{{ old('company_registration') }}" required>
    </div>
</div>

<div class="mb-3">
    <label for="companyAddress" class="form-label">Registered Company Address/Details <span class="required-asterisk">*</span></label>
    <textarea class="form-control" id="companyAddress" name="company_address" rows="3" required>{{ old('company_address') }}</textarea>
</div>


<div class="mb-3">
    <label for="operatingCountries" class="form-label">Operating Countries <span class="required-asterisk">*</span></label>
    <select class="form-select select2" id="operatingCountries" name="operating_countries[]" multiple required>
        @foreach($Country as $country)
            <option value="{{ $country->id }}"
                {{ in_array($country->id, old('operating_countries', $merchant_details['operating_countries'] ?? [])) ? 'selected' : '' }}>
                {{ $country->country_name }}
            </option>
        @endforeach
    </select>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label for="mobileNumber" class="form-label">Mobile Number <span class="required-asterisk">*</span></label>
        <input type="tel" class="form-control" id="mobileNumber" name="mobile_number" value="{{ old('mobile_number') }}" required tabindex="1">
    </div>

    <div class="col-md-6">
        <label for="companyActivities" class="form-label">Company Principal Activities <span class="required-asterisk">*</span></label>
        <select class="form-select select2" id="companyActivities" name="company_activities" required tabindex="7">
            <option value="" disabled {{ old('company_activities') == null ? 'selected' : '' }}>Select Activities</option>
            @foreach($MerchantCategory as $parentCategory)
                @if(is_null($parentCategory->parent_id))
                    @php
                        $hasChildren = $MerchantCategory->where('parent_id', $parentCategory->id)->count() > 0;
                    @endphp
                    @if($hasChildren)
                        <optgroup label="{{ $parentCategory->title }}">
                            @foreach($MerchantCategory as $childCategory)
                                @if($childCategory->parent_id == $parentCategory->id)
                                    <option value="{{ $childCategory->id }}" {{ old('company_activities') == $childCategory->id ? 'selected' : '' }}>
                                        {{ $childCategory->title }}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>
                    @else
                        <option value="{{ $parentCategory->id }}" {{ old('company_activities') == $parentCategory->id ? 'selected' : '' }}>
                            {{ $parentCategory->title }}
                        </option>
                    @endif
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="landlineNumber" class="form-label">Landline Number <span class="required-asterisk">*</span></label>
        <input type="tel" class="form-control" id="landlineNumber" name="landline_number" value="{{ old('landline_number') }}" required tabindex="2">
    </div>

    <div class="col-md-6">
        <label for="website" class="form-label">Website</label>
        <input type="url" class="form-control" id="website" name="website" value="{{ old('website') }}" tabindex="8">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="email" class="form-label">Email <span class="required-asterisk">*</span></label >
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required tabindex="3">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="monthlyWebsiteVisitors" class="form-label">Monthly Website Visitors</label>
        <input type="number" class="form-control" id="monthlyWebsiteVisitors" name="monthly_website_visitors" value="{{ old('monthly_website_visitors') }}" tabindex="9">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="keyPointOfContact" class="form-label">Key Point of Contact <span class="required-asterisk">*</span></label>
        <input type="text" class="form-control" id="keyPointOfContact" name="key_point_of_contact" value="{{ old('key_point_of_contact') }}" required tabindex="4">
    </div>

    <div class="col-md-6">
        <label for="monthlyActiveUsers" class="form-label">Monthly Active Users</label>
        <input type="number" class="form-control" id="monthlyActiveUsers" name="monthly_active_users" value="{{ old('monthly_active_users') }}" tabindex="10">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="keyPointMobile" class="form-label">Key Point Mobile <span class="required-asterisk">*</span></label>
        <input type="tel" class="form-control" id="keyPointMobile" name="key_point_mobile" value="{{ old('key_point_mobile') }}" requiredtabindex="5">
    </div>

    <div class="col-md-6">
        <label for="monthlyAvgVolume" class="form-label">Monthly Average Volume (QAR)</label>
        <input type="number" class="form-control" id="monthlyAvgVolume" name="monthly_avg_volume" value="{{ old('monthly_avg_volume') }}" tabindex="11">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="existingBankingPartner" class="form-label">Existing Banking Partner</label>
        <input type="text" class="form-control" id="existingBankingPartner" name="existing_banking_partner" value="{{ old('existing_banking_partner') }}" tabindex="6">
    </div>

    <div class="col-md-6">
        <label for="monthlyAvgTransactions" class="form-label">Monthly Average No. Of Transactions <span class="required-asterisk">*</span></label>
        <input type="number" class="form-control" id="monthlyAvgTransactions" name="monthly_avg_transactions" value="{{ old('monthly_avg_transactions') }}" required tabindex="12">
    </div>
</div>
