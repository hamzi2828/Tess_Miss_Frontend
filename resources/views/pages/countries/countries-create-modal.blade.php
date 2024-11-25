<!-- Create Country Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddCountry" aria-labelledby="offcanvasAddCountryLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddCountryLabel" class="offcanvas-title">Add Country</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="addNewCountryForm" method="POST" action="{{ route('countries.store') }}">
            @csrf
            <!-- Country Code Field -->
            <div class="mb-6">
                <label class="form-label" for="add-country-code">Country Code</label>
                <input type="text" class="form-control" id="add-country-code" name="countryCode" required />
            </div>

            <!-- Country Name Field -->
            <div class="mb-6">
                <label class="form-label" for="add-country-name">Country Name</label>
                <input type="text" class="form-control" id="add-country-name" name="countryName" required />
            </div>
            
            <!-- Country Status Field (Dropdown) -->
            <div class="mb-6">
                <label class="form-label" for="add-country-status">Country Status</label>
                <select class="form-select" id="add-country-status" name="countryStatus" required>
                    <option value="">Select Status</option> <!-- Placeholder option -->
                    <option value="No Risk">No Risk</option>
                    <option value="Low Risk">Low Risk</option>
                    <option value="Medium Risk">Medium Risk</option>
                    <option value="High Risk">High Risk</option>
                </select>
            </div>


            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
