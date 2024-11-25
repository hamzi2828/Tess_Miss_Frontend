<h5 class="fw-bold mb-3">
    <input class="form-check-input me-2" type="checkbox" id="toggleDepartmentsSection" name="permissions[toggle_Departments_Section]" value="1"
        {{ isset($permissionsArray['toggle_Departments_Section']) && $permissionsArray['toggle_Departments_Section'] == 1 ? 'checked' : '' }}>
    Departments 
</h5>

<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="addDepartments" name="permissions[add_departments]" value="1"
                {{ isset($permissionsArray['add_departments']) && $permissionsArray['add_departments'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="addDepartments">Add Departments</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="viewDepartments" name="permissions[view_departments]" value="1"
                {{ isset($permissionsArray['view_departments']) && $permissionsArray['view_departments'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="viewDepartments">View All Departments</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="changeDepartments" name="permissions[change_departments]" value="1"
                {{ isset($permissionsArray['change_departments']) && $permissionsArray['change_departments'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="changeDepartments">Edit Departments</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="deleteDepartments" name="permissions[delete_departments]" value="1"
                {{ isset($permissionsArray['delete_departments']) && $permissionsArray['delete_departments'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="deleteDepartments">Delete Departments</label>
        </div>
    </div>
</div>