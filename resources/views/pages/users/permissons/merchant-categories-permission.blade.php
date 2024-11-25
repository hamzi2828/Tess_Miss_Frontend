<h5 class="fw-bold mb-3">
    <input class="form-check-input me-2" type="checkbox" id="toggleMerchantCategoriesSection" name="permissions[toggle_Merchant_Categories_Section]" value="1"
        {{ isset($permissionsArray['toggle_Merchant_Categories_Section']) && $permissionsArray['toggle_Merchant_Categories_Section'] == 1 ? 'checked' : '' }}>
    Merchant Categories 
</h5>
<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="addMerchantCategories" name="permissions[add_merchantCategories]" value="1"
                {{ isset($permissionsArray['add_merchantCategories']) && $permissionsArray['add_merchantCategories'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="addMerchantCategories">Add Merchant Categories</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="viewMerchantCategories" name="permissions[view_merchantCategories]" value="1"
                {{ isset($permissionsArray['view_merchantCategories']) && $permissionsArray['view_merchantCategories'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="viewMerchantCategories">View All Merchant Categories</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="changeMerchantCategories" name="permissions[change_merchantCategories]" value="1"
                {{ isset($permissionsArray['change_merchantCategories']) && $permissionsArray['change_merchantCategories'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="changeMerchantCategories">Edit Merchant Categories</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="deleteMerchantCategories" name="permissions[delete_merchantCategories]" value="1"
                {{ isset($permissionsArray['delete_merchantCategories']) && $permissionsArray['delete_merchantCategories'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="deleteMerchantCategories">Delete Merchant Categories</label>
        </div>
    </div>
</div>