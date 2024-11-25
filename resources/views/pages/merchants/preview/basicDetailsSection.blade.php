<div class="form-section box-container">

    <!-- Step-based Progress Bar -->
    @include('pages.merchants.components.preview-progressBar')

    
  <h4 class="basic-details-header">Basic Details</h4>


<div class="form-section box-container mb-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Merchant Name:</strong> {{ $merchant_details['merchant_name'] ?? 'N/A' }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Date of Incorporation:</strong> 
                {{ $merchant_details['merchant_date_incorp'] ? \Carbon\Carbon::parse($merchant_details['merchant_date_incorp'])->format('Y-m-d') : 'N/A' }}
            </p>  </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <p><strong>Merchant Arabic Name:</strong> {{ $merchant_details['merchant_name_ar'] ?? 'N/A' }}</p>
        </div>
    
        <div class="col-md-6">
            <p><strong>Company Registration:</strong> {{ $merchant_details['comm_reg_no'] ?? 'N/A' }}</p>
        </div>
    </div>
    

    <div class="mb-3">
         <p class="mb-0">
             <strong>Registered Company Address/Details:</strong> {{ $merchant_details['address'] ?? 'N/A' }}
        </p>
    </div>

 

    <div class="row mb-3">
        <div class="col-md-6">
            <p>
                <strong>Mobile Number:</strong> 
                {{ $merchant_details['merchant_mobile'] ?? 'N/A' }}
            </p>
        </div>

        <div class="col-md-6">
            <p>
                <strong>Company Principal Activities:</strong>
                @php
                    $activity = $MerchantCategory->where('id', $merchant_details['merchant_category'])->first();
                @endphp
                {{ $activity ? $activity->title : 'N/A' }}
            </p>
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-md-6">
            <p>
                <strong>Landline Number:</strong> 
                {{ $merchant_details['merchant_landline'] ?? 'N/A' }}
            </p>
        </div>

        <div class="col-md-6">
            <p>
                <strong>Website:</strong> 
                <a href="{{ $merchant_details['merchant_url'] ?? '#' }}" target="_blank">
                    {{ $merchant_details['merchant_url'] ?? 'N/A' }}
                </a>
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <p>
                <strong>Email:</strong> 
                {{ $merchant_details['merchant_email'] ?? 'N/A' }}
            </p>
        </div>

        <div class="col-md-6">
            <p>
                <strong>Monthly Website Visitors:</strong> 
                {{ $merchant_details['website_month_visit'] ?? 'N/A' }}
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <p>
                <strong>Key Point of Contact:</strong> 
                {{ $merchant_details['contact_person_name'] ?? 'N/A' }}
            </p>
        </div>

        <div class="col-md-6">
            <p>
                <strong>Monthly Active Users:</strong> 
                {{ $merchant_details['website_month_active'] ?? 'N/A' }}
            </p>
        </div>
    </div>


  <div class="row mb-3">
    <div class="col-md-6">
        <p>
            <strong>Key Point Mobile:</strong> 
            {{ $merchant_details['contact_person_mobile'] ?? 'N/A' }}
        </p>
    </div>

    <div class="col-md-6">
        <p>
            <strong>Monthly Average Volume (QAR):</strong> 
            {{ number_format($merchant_details['website_month_volume'] ?? 0, 2) }}
        </p>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <p>
            <strong>Existing Banking Partner:</strong> 
            {{ $merchant_details['merchant_previous_bank'] ?? 'N/A' }}
        </p>
    </div>

    <div class="col-md-6">
        <p>
            <strong>Monthly Average No. Of Transactions:</strong> 
            {{ $merchant_details['website_month_transaction'] ?? 'N/A' }}
        </p>
    </div>
</div>
</div>
</div>


      <!-- Shareholders Section with Add Button -->
 <div class="form-section box-container">
    <h4 class="mb-3 basic-details-header ">Shareholders</h4>

    <!-- Container for all shareholders -->
    <div id="shareholders-container" class="form-section box-container mb-4">
    
        @foreach($merchant_details['shareholders'] as $shareholder)
        <div class="shareholder-entry row mb-3">
            <div class="col-md-4">
                <p>
                    <strong>Shareholder Name:</strong> 
                    {{ $shareholder['title'] ?? 'N/A' }}
                </p>
            </div>
            <div class="col-md-4">
                <p>
                    <strong>Shareholder Nationality:</strong> 
                    {{ $Country->firstWhere('id', $shareholder['country_id'])?->country_name ?? 'N/A' }}
                </p>
            </div>
            <div class="col-md-4">
                <p>
                    <strong>Shareholder QID:</strong> 
                    {{ $shareholder['qid'] ?? 'N/A' }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>
