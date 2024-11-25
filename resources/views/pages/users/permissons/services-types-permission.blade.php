<h5 class="fw-bold mb-3">
    <input class="form-check-input me-2" type="checkbox" id="toggleServicesSection" name="permissions[toggle_Services_Section]" value="1"
        {{ isset($permissionsArray['toggle_Services_Section']) && $permissionsArray['toggle_Services_Section'] == 1 ? 'checked' : '' }}>
    Services Types
</h5>
<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="addSideBarServices" name="permissions[add_sideBarServices]" value="1"
                {{ isset($permissionsArray['add_sideBarServices']) && $permissionsArray['add_sideBarServices'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="addSideBarServices">Add Services Types</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="viewSideBarServices" name="permissions[view_sideBarServices]" value="1"
                {{ isset($permissionsArray['view_sideBarServices']) && $permissionsArray['view_sideBarServices'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="viewSideBarServices">View Services Types</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="changeSideBarServices" name="permissions[change_sideBarServices]" value="1"
                {{ isset($permissionsArray['change_sideBarServices']) && $permissionsArray['change_sideBarServices'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="changeSideBarServices">Edit Services Types</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="deleteSideBarServices" name="permissions[delete_sideBarServices]" value="1"
                {{ isset($permissionsArray['delete_sideBarServices']) && $permissionsArray['delete_sideBarServices'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="deleteSideBarServices">Delete Services Types</label>
        </div>
    </div>
</div>
