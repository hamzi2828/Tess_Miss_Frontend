<!-- Edit Country Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditCountry" aria-labelledby="offcanvasEditCountryLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasEditCountryLabel" class="offcanvas-title">Edit Country</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="editCountryForm" method="POST" action="">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->

            <!-- Country Code Field -->
            <div class="mb-6">
                <label class="form-label" for="edit-country-code">Country Code</label>
                <input type="text" class="form-control" id="edit-country-code" name="countryCode" required />
            </div>

            <!-- Country Name Field -->
            <div class="mb-6">
                <label class="form-label" for="edit-country-name">Country Name</label>
                <input type="text" class="form-control" id="edit-country-name" name="countryName" required />
            </div>

            <!-- Country Status Field (Dropdown) -->
            <div class="mb-6">
                <label class="form-label" for="edit-country-status">Country Status</label>
                <select class="form-select" id="edit-country-status" name="countryStatus" required>
                    <option value="">Select Status</option> <!-- Placeholder option -->
                    <option value="No Risk">No Risk</option>
                    <option value="Low Risk">Low Risk</option>
                    <option value="Medium Risk">Medium Risk</option>
                    <option value="High Risk">High Risk</option>
                </select>
            </div>

            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3 data-submit">Update</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-country-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                // Get the country data from the button's data attributes
                const countryID = this.getAttribute('data-id');
                const countryCode = this.getAttribute('data-code');
                const countryName = this.getAttribute('data-name');
                const countryStatus = this.getAttribute('data-status');

                // Set form action to update the country
                document.getElementById('editCountryForm').action = `/countries/${countryID}`;

                // Populate the form fields with the existing country data
                document.getElementById('edit-country-code').value = countryCode;
                document.getElementById('edit-country-name').value = countryName;

                // Set the correct status option in the dropdown
                document.getElementById('edit-country-status').value = countryStatus;

                // Open the edit modal
                new bootstrap.Offcanvas(document.getElementById('offcanvasEditCountry')).show();
            });
        });
    });
</script>
