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
    <form class="kyc-form" action="{{ route('update.merchants.kyc',['merchant_id' => request()->merchant_id]) }}" method="POST">
        @csrf

        <!-- Basic Details Section -->
        <div class="form-section box-container">

            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.edit-progressBar')

            <h4 class="mb-3">Basic Details</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="merchantName" class="form-label">Merchant Name <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="merchantName" name="merchant_name" value="{{ $merchant_details['merchant_name'] ?? '' }}" required>
                </div>

                <div class="col-md-6">
                    <label for="dateOfIncorporation" class="form-label">Date of Incorporation <span class="required-asterisk">*</span></label>
                    <input type="date" class="form-control" id="dateOfIncorporation" name="date_of_incorporation" value="{{ $merchant_details['merchant_date_incorp'] ? \Carbon\Carbon::parse($merchant_details['merchant_date_incorp'])->format('Y-m-d') : '' }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="merchantArabicName" class="form-label">Merchant Arabic Name <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="merchantArabicName" name="merchant_arabic_name" value="{{ $merchant_details['merchant_name_ar'] ?? '' }}" required>
                </div>

                <div class="col-md-6">
                    <label for="companyRegistration" class="form-label">Company Registration <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="companyRegistration" name="company_registration" value="{{ $merchant_details['comm_reg_no'] ?? '' }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="companyAddress" class="form-label">Registered Company Address/Details <span class="required-asterisk">*</span></label>
                <textarea class="form-control" id="companyAddress" name="company_address" rows="3" required>{{ $merchant_details['address'] ?? '' }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="mobileNumber" class="form-label">Mobile Number <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="mobileNumber" name="mobile_number" value="{{ $merchant_details['merchant_mobile'] ?? '' }}" required>
                </div>

                <div class="col-md-6">
                    <label for="companyActivities" class="form-label">Company Principal Activities <span class="required-asterisk">*</span></label>
                    <select class="form-select select2" id="companyActivities" name="company_activities" required>
                        <option selected>Select Activities</option>
                        @foreach($MerchantCategory as $category)
                            <option value="{{ $category->id }}" {{ $merchant_details['merchant_category'] == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="landlineNumber" class="form-label">Landline Number <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="landlineNumber" name="landline_number" value="{{ $merchant_details['merchant_landline'] ?? '' }}" required>
                </div>

                <div class="col-md-6">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" class="form-control" id="website" name="website" value="{{ $merchant_details['merchant_url'] ?? '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="required-asterisk">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $merchant_details['merchant_email'] ?? '' }}" required>
                </div>

                <div class="col-md-6">
                    <label for="monthlyWebsiteVisitors" class="form-label">Monthly Website Visitors</label>
                    <input type="number" class="form-control" id="monthlyWebsiteVisitors" name="monthly_website_visitors" value="{{ $merchant_details['website_month_visit'] ?? '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointOfContact" class="form-label">Key Point of Contact <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="keyPointOfContact" name="key_point_of_contact" value="{{ $merchant_details['contact_person_name'] ?? '' }}" required>
                </div>

                <div class="col-md-6">
                    <label for="monthlyActiveUsers" class="form-label">Monthly Active Users</label>
                    <input type="number" class="form-control" id="monthlyActiveUsers" name="monthly_active_users" value="{{ $merchant_details['website_month_active'] ?? '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointMobile" class="form-label">Key Point Mobile <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="keyPointMobile" name="key_point_mobile" value="{{ $merchant_details['contact_person_mobile'] ?? '' }}" required>
                </div>

                <div class="col-md-6">
                    <label for="monthlyAvgVolume" class="form-label">Monthly Average Volume (QAR)</label>
                    <input type="number" class="form-control" id="monthlyAvgVolume" name="monthly_avg_volume" value="{{ $merchant_details['website_month_volume'] ?? '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="existingBankingPartner" class="form-label">Existing Banking Partner</label>
                    <input type="text" class="form-control" id="existingBankingPartner" name="existing_banking_partner" value="{{ $merchant_details['merchant_previous_bank'] ?? '' }}">
                </div>

                <div class="col-md-6">
                    <label for="monthlyAvgTransactions" class="form-label">Monthly Average No. Of Transactions <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="monthlyAvgTransactions" name="monthly_avg_transactions" value="{{ $merchant_details['website_month_transaction'] ?? '' }}" required>
                </div>
            </div>
        </div>

        <!-- Shareholders Section with Add Button -->
        <div class="form-section box-container">
            <h4 class="mb-3">Shareholders</h4>

            <!-- Container for all shareholders -->
            <div id="shareholders-container">
                @foreach($merchant_details['shareholders'] as $shareholder)
                <div class="shareholder-entry row mb-3">
                    <div class="col-md-4">
                        <label for="shareholderName" class="form-label">Shareholder Name <span class="required-asterisk">*</span></label>
                        <input type="text" class="form-control" name="shareholderName[]" value="{{ $shareholder['title'] }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="shareholderNationality" class="form-label">Shareholder Nationality <span class="required-asterisk">*</span></label>
                        <select class="form-select select2" name="shareholderNationality[]" required>
                            <option selected>Select Country</option>
                            @foreach($Country as $country)
                                <option value="{{ $country->id }}" {{ $shareholder['country_id'] == $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="shareholderID" class="form-label">Shareholder QID</label>
                        <input type="text" class="form-control" name="shareholderID[]" value="{{ $shareholder['qid'] }}">
                    </div>
                    <div class="col-md-1">
                       
                        {{-- <button type="button" class="btn btn-danger remove-btn" style="margin-top: 20px">
                            <i class="fas fa-trash"></i> <!-- Trash bin icon -->
                        </button> --}}
                        <a  class="remove-btn" >
                            <i class="ti ti-trash" style="margin-top: 30px"></i>
                           </a>
                    </div>
                </div>
                @endforeach
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

    
    // JavaScript to handle the Add Shareholder functionality
  // JavaScript to handle the Add Shareholder functionality
  document.addEventListener('DOMContentLoaded', function() {
    // Function to handle removing shareholder entry
    function removeShareholder() {
        document.querySelectorAll('.remove-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const shareholderEntry = this.closest('.shareholder-entry');
                shareholderEntry.remove();
            });
        });
    }

    // Call the remove function for initially rendered shareholders
    removeShareholder();

    // Add new shareholders dynamically
    document.getElementById('add-shareholder-btn').addEventListener('click', function() {
        const shareholdersContainer = document.getElementById('shareholders-container');
        
        // Create new shareholder input group
        const newShareholder = document.createElement('div');
        newShareholder.classList.add('shareholder-entry', 'row', 'mb-3');
        
        newShareholder.innerHTML = `
            <div class="col-md-4">
                <label for="shareholderName" class="form-label">Shareholder Name *</label>
                <input type="text" class="form-control" name="shareholderName[]" required>
            </div>
            <div class="col-md-4">
                <label for="shareholderNationality" class="form-label">Shareholder Nationality <span class="required-asterisk">*</span></label>
                <select class="form-select select2" name="shareholderNationality[]" required>
                    <option selected>Select Country</option>
                    @foreach($Country as $country)
                        <option value="{{ $country['id'] }}">{{ $country['country_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="shareholderID" class="form-label">Shareholder QID</label>
                <input type="text" class="form-control" name="shareholderID[]">
            </div>
            <div class="col-md-1">
                <a  class="remove-btn" >
                 <i class="ti ti-trash" style="margin-top: 30px"></i>
                </a>
            </div>
        `;
        
        // Append the new shareholder entry to the container
        shareholdersContainer.appendChild(newShareholder);

        // Reinitialize Select2 on the newly added select element
        $(newShareholder).find('.select2').select2({
            placeholder: 'Select Country',
            allowClear: true
        });

        // Reapply remove button functionality for newly added shareholders
        removeShareholder();
    });
});


</script>