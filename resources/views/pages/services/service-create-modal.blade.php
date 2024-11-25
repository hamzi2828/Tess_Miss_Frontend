<!-- Create Service Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddService" aria-labelledby="offcanvasAddServiceLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddServiceLabel" class="offcanvas-title">Add Service</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="addNewServiceForm" method="POST" action="{{ route('services.store') }}">
            @csrf
            <!-- Service Name Field -->
            <div class="mb-6">
                <label class="form-label" for="add-service-name">Service Name</label>
                <input type="text" class="form-control" id="add-service-name" name="serviceName" required />
            </div>

         <!-- Service Fields (Dynamic Inputs) -->
        <div class="mb-6">
            <label class="form-label">Service Fields</label>
            <div id="service-fields-container">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="serviceFields[]" placeholder="Enter field name" />
                    <button type="button" class="btn btn-success add-field-btn">
                        <i class="ti ti-plus"></i>
                    </button>
                </div>
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
        // Select the container where new input fields will be added
        let container = document.getElementById('service-fields-container');

        // Add a click event listener to the "+" button
        container.addEventListener('click', function(e) {
            if (e.target && e.target.closest('.add-field-btn')) {
                // Create a new input group with a remove button
                let newField = document.createElement('div');
                newField.classList.add('input-group', 'mb-2');
                newField.innerHTML = `
                    <input type="text" class="form-control" name="serviceFields[]" placeholder="Enter field name" />
                    <button type="button" class="btn btn-danger remove-field-btn">
                        <i class="ti ti-minus"></i>
                    </button>
                `;
                container.appendChild(newField);
            }
        });

        // Remove the input field when the "-" button is clicked
        container.addEventListener('click', function(e) {
            if (e.target && e.target.closest('.remove-field-btn')) {
                let fieldToRemove = e.target.closest('.input-group');
                fieldToRemove.remove();
            }
        });
    });
</script>