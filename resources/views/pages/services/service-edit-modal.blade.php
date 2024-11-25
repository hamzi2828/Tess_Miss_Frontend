<!-- Edit Service Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditService" aria-labelledby="offcanvasEditServiceLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasEditServiceLabel" class="offcanvas-title">Edit Service</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="editServiceForm" method="POST" action="">
            @csrf
            @method('PUT')

            <!-- Service Name Field -->
            <div class="mb-6">
                <label class="form-label" for="edit-service-name">Service Name</label>
                <input type="text" class="form-control" id="edit-service-name" name="serviceName" required />
            </div>

            <!-- Service Fields (Dynamic Inputs) -->
            <div class="mb-6">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label">Service Fields</label>
                    <button type="button" class="btn btn-success add-field-btn-edit-service">
                        <i class="ti ti-plus"></i> Add
                    </button>
                </div>
                <div id="edit-service-fields-container">
                    <!-- Existing fields will be populated here -->
                </div>
             
            </div>

            

            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to populate data into the modal when the edit button is clicked
    document.querySelectorAll('.edit-service-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const serviceID = this.getAttribute('data-id');
            const serviceName = this.getAttribute('data-name');
            let serviceFields = this.getAttribute('data-fields'); // JSON encoded string

            // Decode the HTML entities in the JSON string
            serviceFields = serviceFields.replace(/&quot;/g, '"');

            // Try parsing serviceFields twice to handle double-encoding
            try {
                serviceFields = JSON.parse(serviceFields); // First parse to convert stringified JSON to valid JSON
                if (typeof serviceFields === 'string') {
                    // Parse again if it's still a string
                    serviceFields = JSON.parse(serviceFields);
                }
            } catch (e) {
                console.error('Error parsing fields JSON:', e);
                serviceFields = [];
            }

            // Debugging to ensure fields are now an array
            console.log('Parsed serviceFields:', serviceFields);

            // Set form action to update the service
            document.getElementById('editServiceForm').action = `/services/${serviceID}`;

            // Set the service name in the input
            document.getElementById('edit-service-name').value = serviceName;

            // Populate service fields dynamically
            const container = document.getElementById('edit-service-fields-container');
            container.innerHTML = ''; // Clear existing fields before populating new ones

            // Add each service field dynamically
            if (Array.isArray(serviceFields)) {
                serviceFields.forEach(function(field) {
                    let fieldElement = document.createElement('div');
                    fieldElement.classList.add('input-group', 'mb-2');
                    fieldElement.innerHTML = `
                        <input type="text" class="form-control" name="serviceFields[]" value="${field}" placeholder="Enter field name" />
                        <button type="button" class="btn btn-danger remove-field-btn-edit-service">
                            <i class="ti ti-minus"></i>
                        </button>
                    `;
                    container.appendChild(fieldElement);
                });
            } else {
                console.log('serviceFields is not an array:', serviceFields);
            }
        });
    });

    // Event listener for adding new service fields dynamically
    document.querySelector('.add-field-btn-edit-service').addEventListener('click', function() {
        const container = document.getElementById('edit-service-fields-container');
        let newField = document.createElement('div');
        newField.classList.add('input-group', 'mb-2');
        newField.innerHTML = `
            <input type="text" class="form-control" name="serviceFields[]" placeholder="Enter field name" />
            <button type="button" class="btn btn-danger remove-field-btn-edit-service">
                <i class="ti ti-minus"></i>
            </button>
        `;
        container.appendChild(newField);
    });

    // Event delegation for removing service fields
    document.getElementById('edit-service-fields-container').addEventListener('click', function(e) {
        if (e.target && e.target.closest('.remove-field-btn-edit-service')) {
            e.target.closest('.input-group').remove();
        }
    });
});

</script>
