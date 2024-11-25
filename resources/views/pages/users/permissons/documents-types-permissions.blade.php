
<h5 class="fw-bold mb-3">
    <input class="form-check-input me-2" type="checkbox" id="toggleDocumentsSection" name="permissions[toggle_Documents_Section]" value="1"
        {{ isset($permissionsArray['toggle_Documents_Section']) && $permissionsArray['toggle_Documents_Section'] == 1 ? 'checked' : '' }}>
    Documents Types
</h5>
<div class="row mb-3">
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="addSideBarDocuments" name="permissions[add_sideBarDocuments]" value="1"
                {{ isset($permissionsArray['add_sideBarDocuments']) && $permissionsArray['add_sideBarDocuments'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="addSideBarDocuments">Add Documents Types</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="viewSideBarDocuments" name="permissions[view_sideBarDocuments]" value="1"
                {{ isset($permissionsArray['view_sideBarDocuments']) && $permissionsArray['view_sideBarDocuments'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="viewSideBarDocuments">View Documents Types</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="changeSideBarDocuments" name="permissions[change_sideBarDocuments]" value="1"
                {{ isset($permissionsArray['change_sideBarDocuments']) && $permissionsArray['change_sideBarDocuments'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="changeSideBarDocuments">Edit Documents Types</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="deleteSideBarDocuments" name="permissions[delete_sideBarDocuments]" value="1"
                {{ isset($permissionsArray['delete_sideBarDocuments']) && $permissionsArray['delete_sideBarDocuments'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="deleteSideBarDocuments">Delete Documents Types</label>
        </div>
    </div>
</div>