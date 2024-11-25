<h5 class="fw-bold mb-3">
    <input class="form-check-input me-2" type="checkbox" id="toggleCountriesSection" name="permissions[toggle_Countries_Section]" value="1"
        {{ isset($permissionsArray['toggle_Countries_Section']) && $permissionsArray['toggle_Countries_Section'] == 1 ? 'checked' : '' }}>
    Countries 
</h5>
<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="addCountries" name="permissions[add_countries]" value="1"
                {{ isset($permissionsArray['add_countries']) && $permissionsArray['add_countries'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="addCountries">Add Countries</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="viewCountries" name="permissions[view_countries]" value="1"
                {{ isset($permissionsArray['view_countries']) && $permissionsArray['view_countries'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="viewCountries">View All Countries</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="changeCountries" name="permissions[change_countries]" value="1"
                {{ isset($permissionsArray['change_countries']) && $permissionsArray['change_countries'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="changeCountries">Edit Countries</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="deleteCountries" name="permissions[delete_countries]" value="1"
                {{ isset($permissionsArray['delete_countries']) && $permissionsArray['delete_countries'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="deleteCountries">Delete Countries</label>
        </div>
    </div>
</div>
