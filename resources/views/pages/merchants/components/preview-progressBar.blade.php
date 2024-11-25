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


    <style>
        p {
            margin-bottom: 0.5rem; /* Reduce space between fields */
        }
        strong {
            color: #333; /* Optional: Adjust color for better readability */
        }

    .basic-details-header {
        background-color: #007BFF; /* Blue background */
        color: #ffffff !important; /* White text */
        padding: 10px 15px; /* Add some padding */
        border-radius: 5px; /* Optional: Rounded corners */
        font-weight: bold; /* Make the text bold */
        text-align: left; /* Center the text */
        margin-bottom: 20px; /* Space below the heading */
    }
</style>
