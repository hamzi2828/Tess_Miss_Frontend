@extends('master.master')

@section('content')
<style>
    .shareholder-entry .col-md-4 {
    display: flex;
    flex-direction: column;
    justify-content: center;
    }
    .shareholder-entry .col-md-3 {
    display: flex;
    flex-direction: column;
    justify-content: center;
    }


</style>

    
<div class="container-xxl flex-grow-1 container-p-y">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    
   <!-- Update the form to POST and set the action to the correct route -->
    <form class="kyc-form" action="{{ route('store.merchants.kyc') }}" method="POST">
        @csrf <!-- This is important for Laravel's CSRF protection -->

        <!-- Basic Details Section -->
        <div class="form-section box-container">

            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.progressBar')
        
            <h4 class="mb-3">Basic Details</h4>
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
                            {{ in_array($country->id, $merchant_details['operating_countries'] ?? []) ? 'selected' : '' }}>
                            {{ $country->country_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="mobileNumber" class="form-label">Mobile Number <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="mobileNumber" name="mobile_number" value="{{ old('mobile_number') }}" required>
                </div>
        
                <div class="col-md-6">
                    <label for="companyActivities" class="form-label">Company Principal Activities <span class="required-asterisk">*</span></label>
                    <select class="form-select select2" id="companyActivities" name="company_activities" required>
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
                    <input type="tel" class="form-control" id="landlineNumber" name="landline_number" value="{{ old('landline_number') }}" required>
                </div>
        
                <div class="col-md-6">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" class="form-control" id="website" name="website" value="{{ old('website') }}">
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="required-asterisk">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-md-6">
                    <label for="monthlyWebsiteVisitors" class="form-label">Monthly Website Visitors</label>
                    <input type="number" class="form-control" id="monthlyWebsiteVisitors" name="monthly_website_visitors" value="{{ old('monthly_website_visitors') }}">
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointOfContact" class="form-label">Key Point of Contact <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="keyPointOfContact" name="key_point_of_contact" value="{{ old('key_point_of_contact') }}" required>
                </div>
        
                <div class="col-md-6">
                    <label for="monthlyActiveUsers" class="form-label">Monthly Active Users</label>
                    <input type="number" class="form-control" id="monthlyActiveUsers" name="monthly_active_users" value="{{ old('monthly_active_users') }}">
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointMobile" class="form-label">Key Point Mobile <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="keyPointMobile" name="key_point_mobile" value="{{ old('key_point_mobile') }}" required>
                </div>
        
                <div class="col-md-6">
                    <label for="monthlyAvgVolume" class="form-label">Monthly Average Volume (QAR)</label>
                    <input type="number" class="form-control" id="monthlyAvgVolume" name="monthly_avg_volume" value="{{ old('monthly_avg_volume') }}">
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="existingBankingPartner" class="form-label">Existing Banking Partner</label>
                    <input type="text" class="form-control" id="existingBankingPartner" name="existing_banking_partner" value="{{ old('existing_banking_partner') }}">
                </div>
        
                <div class="col-md-6">
                    <label for="monthlyAvgTransactions" class="form-label">Monthly Average No. Of Transactions <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="monthlyAvgTransactions" name="monthly_avg_transactions" value="{{ old('monthly_avg_transactions') }}" required>
                </div>
            </div>
        </div>
        


        <!-- Shareholders Section with Add Button -->
        <div class="form-section box-container">
            <h4 class="mb-3">Shareholders</h4>

            <!-- Container for all shareholders -->
            <div id="shareholders-container">
                <div class="shareholder-entry row mb-3">
                    <div class="col-md-2">
                        <label for="shareholderFirstName" class="form-label">First Name <span class="required-asterisk">*</span></label>
                        <input type="text" class="form-control" name="shareholderFirstName[]" required>
                    </div>
                    <div class="col-md-2" style="max-width: 150px">
                        <label for="shareholderMiddleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" name="shareholderMiddleName[]">
                    </div>
                    <div class="col-md-2">
                        <label for="shareholderLastName" class="form-label">Last Name <span class="required-asterisk">*</span></label>
                        <input type="text" class="form-control" name="shareholderLastName[]" required>
                    </div>
                    <div class="col-md-2" style="max-width: 160px">
                        <label for="shareholderDOB" class="form-label">Date of Birth <span class="required-asterisk">*</span></label>
                        <input type="date" class="form-control" name="shareholderDOB[]" required>
                    </div>
                    <div class="col-md-2">
                        <label for="shareholderNationality" class="form-label">Nationality <span class="required-asterisk">*</span></label>
                        <select class="form-select select2" name="shareholderNationality[]" required>
                            <option selected>Select Country</option>
                            @foreach($Country as $country)
                                <option value="{{ $country['id'] }}">{{ $country['country_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="shareholderID" class="form-label">Shareholder QID</label>
                        <input type="text" class="form-control" name="shareholderID[]">
                    </div>
                    <div class="col-md-1">
                        <a class="remove-btn">
                            <i class="ti ti-trash" style="margin-top: 30px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Add Shareholder Button -->
            <div class="text-end">
                <button type="button" id="add-shareholder-btn" class="btn btn-success">+ Add Shareholder</button>
            </div>
        </div>


        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save & Proceed</button>
        </div>
    </form>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get today's date in 'YYYY-MM-DD' format
    let today = new Date().toISOString().split('T')[0];
    
    document.querySelectorAll('input[type="date"]').forEach(function(dateInput) {
        dateInput.setAttribute('max', today); // Set the max attribute to today's date
    });
});



    document.addEventListener('DOMContentLoaded', function() {
        // Function to dynamically add new Shareholders
        document.getElementById('add-shareholder-btn').addEventListener('click', function() {
            const shareholdersContainer = document.getElementById('shareholders-container');

            // Create new shareholder input group
            const newShareholder = document.createElement('div');
            newShareholder.classList.add('shareholder-entry', 'row', 'mb-3');

            newShareholder.innerHTML = `
                <div class="col-md-2">
                    <label for="shareholderFirstName" class="form-label">First Name *</label>
                    <input type="text" class="form-control" name="shareholderFirstName[]" required>
                </div>
                <div class="col-md-2" style="max-width: 150px">
                    <label for="shareholderMiddleName" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" name="shareholderMiddleName[]">
                </div>
                <div class="col-md-2">
                    <label for="shareholderLastName" class="form-label">Last Name *</label>
                    <input type="text" class="form-control" name="shareholderLastName[]" required>
                </div>
                <div class="col-md-2" style="max-width: 160px">
                    <label for="shareholderDOB" class="form-label">DOB *</label>
                    <input type="date" class="form-control" name="shareholderDOB[]" required>
                </div>
                <div class="col-md-2">
                    <label for="shareholderNationality" class="form-label">Nationality *</label>
                    <select class="form-select select2" name="shareholderNationality[]" required>
                        <option selected>Select Country</option>
                        @foreach($Country as $country)
                            <option value="{{ $country['id'] }}">{{ $country['country_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="shareholderID" class="form-label">Shareholder QID</label>
                    <input type="text" class="form-control" name="shareholderID[]">
                </div>
                <div class="col-md-1">
                    <a class="remove-btn">
                        <i class="ti ti-trash" style="margin-top: 30px;"></i>
                    </a>
                </div>
            `;

            // Append the new shareholder entry to the container
            shareholdersContainer.appendChild(newShareholder);

            // Reinitialize Select2 for newly added selects
            $(newShareholder).find('.select2').select2({
                placeholder: 'Select Country',
                allowClear: true,
            });

            // Add functionality to remove the newly added shareholder
            newShareholder.querySelector('.remove-btn').addEventListener('click', function() {
                shareholdersContainer.removeChild(newShareholder);
            });
        });

        // Reinitialize Select2 for existing selects
        $('#operatingCountries, .select2').select2({
            placeholder: 'Select Country',
            allowClear: true,
        });

        // Handle today's date for DOB fields
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('input[type="date"]').forEach(function(dateInput) {
            dateInput.setAttribute('max', today); // Restrict DOB to not exceed today
        });
    });


</script>