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

            @include('pages.merchants.create.components.create-basicDetails')

        </div>


        @php
            $oldShareholderFirstNames = old('shareholderFirstName', []);
            $oldShareholderMiddleNames = old('shareholderMiddleName', []);
            $oldShareholderLastNames = old('shareholderLastName', []);
            $oldShareholderDOBs = old('shareholderDOB', []);
            $oldShareholderNationalities = old('shareholderNationality', []);
            $oldShareholderIDs = old('shareholderID', []);
        @endphp


        <!-- Shareholders Section with Add Button -->
        <div class="form-section box-container">
            <h4 class="mb-3">Shareholders</h4>
            <div class="text-end">
                <button type="button" id="add-shareholder-btn" class="btn btn-success">+ Add Shareholder</button>
            </div>
            <div id="shareholders-container">
                @if(count($oldShareholderFirstNames) > 0)
                    @foreach($oldShareholderFirstNames as $index => $firstName)
                    <div class="shareholder-entry row mb-3">
                        <div class="col-md-3">
                            <label for="shareholderFirstName" class="form-label">First Name <span class="required-asterisk">*</span></label>
                            <input type="text" class="form-control" name="shareholderFirstName[]" value="{{ $firstName }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="shareholderMiddleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="shareholderMiddleName[]" value="{{ $oldShareholderMiddleNames[$index] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label for="shareholderLastName" class="form-label">Last Name <span class="required-asterisk">*</span></label>
                            <input type="text" class="form-control" name="shareholderLastName[]" value="{{ $oldShareholderLastNames[$index] ?? '' }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="shareholderDOB" class="form-label">Date of Birth <span class="required-asterisk">*</span></label>
                            <input type="date" class="form-control" name="shareholderDOB[]" value="{{ $oldShareholderDOBs[$index] ?? '' }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="shareholderNationality" class="form-label">Nationality <span class="required-asterisk">*</span></label>
                            <select class="form-select select2" name="shareholderNationality[]" required>
                                <option value="">Select Country</option>
                                @foreach($Country as $country)
                                    <option value="{{ $country['id'] }}" {{ ($oldShareholderNationalities[$index] ?? '') == $country['id'] ? 'selected' : '' }}>
                                        {{ $country['country_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="shareholderID" class="form-label">QID / National ID / Passport Name <span class="required-asterisk">*</span></label>
                            <input type="text" class="form-control" name="shareholderID[]" value="{{ $oldShareholderIDs[$index] ?? '' }}" required>
                        </div>
                        <div class="col-md-1">
                            <a class="remove-btn">
                                <i class="ti ti-trash" style="margin-top: 30px;"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                <div id="shareholders-container">
                    <div class="shareholder-entry row mb-3">
                        <div class="col-md-3">
                            <label for="shareholderFirstName" class="form-label">First Name <span class="required-asterisk">*</span></label>
                            <input type="text" class="form-control" name="shareholderFirstName[]" required>
                        </div>
                        <div class="col-md-3">
                            <label for="shareholderMiddleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="shareholderMiddleName[]">
                        </div>
                        <div class="col-md-3">
                            <label for="shareholderLastName" class="form-label">Last Name <span class="required-asterisk">*</span></label>
                            <input type="text" class="form-control" name="shareholderLastName[]" required>
                        </div>
                        <div class="col-md-3">
                            <label for="shareholderDOB" class="form-label">Date of Birth <span class="required-asterisk">*</span></label>
                            <input type="date" class="form-control" name="shareholderDOB[]" required>
                        </div>
                        <div class="col-md-3">
                            <label for="shareholderNationality" class="form-label">Nationality <span class="required-asterisk">*</span></label>
                            <select class="form-select select2" name="shareholderNationality[]" required>
                                <option selected>Select Country</option>
                                @foreach($Country as $country)
                                    <option value="{{ $country['id'] }}">{{ $country['country_name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="shareholderID" class="form-label">QID / National ID / Passport Name <span class="required-asterisk">*</span></label>
                            <input type="text" class="form-control" name="shareholderID[]" required>
                        </div>


                        <div class="col-md-1">
                            <a class="remove-btn">
                                <i class="ti ti-trash" style="margin-top: 30px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

            <!-- Add Shareholder Button -->

        </div>


        <div style="margin-top: 20px" class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    const shareholdersContainer = document.getElementById('shareholders-container');
    const screenButton = document.querySelector('button[type="submit"]');
    const addShareholderBtn = document.getElementById('add-shareholder-btn');
    const today = new Date().toISOString().split('T')[0];

    // Function to toggle the state of the Screen button
    function toggleScreenButton() {
        const shareholderEntries = shareholdersContainer.querySelectorAll('.shareholder-entry');
        screenButton.disabled = shareholderEntries.length === 0;
    }

    // Initialize the button state
    toggleScreenButton();

    // Add event listener to Add Shareholder button
    addShareholderBtn.addEventListener('click', function () {
        const newShareholder = createShareholderEntry();
        shareholdersContainer.appendChild(newShareholder);
        toggleScreenButton(); // Update button state
    });

    // Function to create a new shareholder entry
    function createShareholderEntry(values = {}) {
        const newShareholder = document.createElement('div');
        newShareholder.classList.add('shareholder-entry', 'row', 'mb-3');

        newShareholder.innerHTML = `
            <div class="col-md-3">
                <label class="form-label">First Name <span class="required-asterisk">*</span></label>
                <input type="text" class="form-control" name="shareholderFirstName[]" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Middle Name</label>
                <input type="text" class="form-control" name="shareholderMiddleName[]">
            </div>
            <div class="col-md-3">
                <label class="form-label">Last Name <span class="required-asterisk">*</span></label>
                <input type="text" class="form-control" name="shareholderLastName[]" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Date of Birth <span class="required-asterisk">*</span></label>
                <input type="date" class="form-control" name="shareholderDOB[]" max="${today}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Nationality <span class="required-asterisk">*</span></label>
                <select class="form-select" name="shareholderNationality[]" required>
                    <option value="">Select Country</option>
                    @foreach($Country as $country)
                        <option value="{{ $country['id'] }}">{{ $country['country_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">QID / National ID / Passport Name <span class="required-asterisk">*</span></label>
                <input type="text" class="form-control" name="shareholderID[]" required>
            </div>
            <div class="col-md-1">
                <a class="remove-btn">
                    <i class="ti ti-trash" style="margin-top: 30px;"></i>
                </a>
            </div>
        `;
 
        // Add remove functionality
        newShareholder.querySelector('.remove-btn').addEventListener('click', function () {
            newShareholder.remove();
            toggleScreenButton(); // Update button state
        });

        return newShareholder;
    }

    // Set max date for existing date inputs
    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.setAttribute('max', today);
    });

    // Add remove functionality to existing remove buttons
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.shareholder-entry').remove();
            toggleScreenButton();
        });
    });
});
</script>
