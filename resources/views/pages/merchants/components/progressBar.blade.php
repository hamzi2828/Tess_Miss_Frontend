<style>

   

    /* Styling for the container */

    .step-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .step {
        display: flex;
        align-items: center;
        position: relative;
        color: #6c757d; /* Default gray color for non-active steps */
        flex: 1;
        text-align: center;
        padding: 0 10px; /* Add some padding between the steps */
    }

    .step-number {
        background-color: #6c757d; /* Default gray */
        color: white;
        border-radius: 50%;
        padding: 12px 20px;
        font-weight: bold;
        margin-right: 10px;
        display: inline-block;
        z-index: 1;
    }

    .step.active .step-number {
        background-color: rgb(115,103,240); /* Blue color for the active step */
    }

    .step-title {
        font-size: 1rem;
        color: black;
        z-index: 1;
        font-weight: 500;
    } 
</style>


<style>
    /* Styling for the form */
    .kyc-form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Section headers */
    .form-section h4 {
        font-size: 1.2rem;
        color: #007BFF;
        font-weight: 600;
        border-bottom: 2px solid #007BFF;
        padding-bottom: 5px;
    }

    /* Labels and inputs */
    .form-label {
        font-weight: 500;
        color: #333;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    /* Add some margin between form sections */
    .form-section {
        margin-bottom: 30px;
    }

    .box-container {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .required-asterisk {
        color: red;
        font-weight: bold;
        font-size: 1.2em; /* Adjust the size as needed */
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .form-section h4 {
            font-size: 1.1rem;
        }

        button.btn {
            width: 100%;
            font-size: 1rem;
        }
    }

</style>

<div class="header text-center mb-4" style="background-color: rgb(115,103,240); padding:2px; border-radius: 8px;">
    <h2 style="color: white;">{{ $title }}</h2>
</div>

<div class="step-container">
    <div class="step {{ Route::currentRouteName() == 'create.merchants.kfc' ? 'active' : '' }}">
        <a href="{{ route('create.merchants.kfc') }}">
            <div class="step-number">1</div>
            <div class="step-title">KYC</div>
        </a>
    </div>

    <div class="step {{ Route::currentRouteName() == 'create.merchants.documents' ? 'active' : '' }}">
        <a href="#">
           <div class="step-number">2</div>
           <div class="step-title">Documents</div>
        </a>
    </div>

    <div class="step {{ Route::currentRouteName() == 'create.merchants.sales' ? 'active' : '' }}">
        <a href="#">
           <div class="step-number">3</div>
           <div class="step-title">Sales</div>
        </a>
    </div>

    <div class="step {{ Route::currentRouteName() == 'create.merchants.services' ? 'active' : '' }}">
        <a href="#">
           <div class="step-number">4</div>
           <div class="step-title">Services</div>
        </a>
    </div>
</div>
