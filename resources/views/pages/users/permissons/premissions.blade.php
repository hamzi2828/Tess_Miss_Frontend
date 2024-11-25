
<div class="col-md-6">
    <div class="card shadow-lg p-4 card-custom">
        <h4 class="fw-bold text-primary mb-4">User Rights</h4>

        <!-- KYC Section Rights -->
        <h5 class="fw-bold mb-3">KYC Section Rights</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="addKYC" name="permissions[add_kyc]" value="1"
                        {{ isset($permissionsArray['add_kyc']) && $permissionsArray['add_kyc'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="addKYC">Add KYC</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="viewKYC" name="permissions[view_kyc]" value="1"
                        {{ isset($permissionsArray['view_kyc']) && $permissionsArray['view_kyc'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="viewKYC">View KYC</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="changeKYC" name="permissions[change_kyc]" value="1"
                        {{ isset($permissionsArray['change_kyc']) && $permissionsArray['change_kyc'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="changeKYC">Edit KYC</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="approveKYC" name="permissions[approve_kyc]" value="1"
                        {{ isset($permissionsArray['approve_kyc']) && $permissionsArray['approve_kyc'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approveKYC">Approve KYC</label>
                </div>
            </div>
        </div>

        <!-- Documents Section Rights -->
        <h5 class="fw-bold mb-3">Documents Section Rights</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="addDocuments" name="permissions[add_documents]" value="1"
                        {{ isset($permissionsArray['add_documents']) && $permissionsArray['add_documents'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="addDocuments">Add Documents</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="viewDocuments" name="permissions[view_documents]" value="1"
                        {{ isset($permissionsArray['view_documents']) && $permissionsArray['view_documents'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="viewDocuments">View Documents</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="changeDocuments" name="permissions[change_documents]" value="1"
                        {{ isset($permissionsArray['change_documents']) && $permissionsArray['change_documents'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="changeDocuments">Edit Documents</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="approveDocuments" name="permissions[approve_documents]" value="1"
                        {{ isset($permissionsArray['approve_documents']) && $permissionsArray['approve_documents'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approveDocuments">Approve Documents</label>
                </div>
            </div>
        </div>

        <!-- Sales Section Rights -->
        <h5 class="fw-bold mb-3">Sales Section Rights</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="addSales" name="permissions[add_sales]" value="1"
                        {{ isset($permissionsArray['add_sales']) && $permissionsArray['add_sales'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="addSales">Add Sales</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="viewSales" name="permissions[view_sales]" value="1"
                        {{ isset($permissionsArray['view_sales']) && $permissionsArray['view_sales'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="viewSales">View Sales</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="changeSales" name="permissions[change_sales]" value="1"
                        {{ isset($permissionsArray['change_sales']) && $permissionsArray['change_sales'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="changeSales">Edit Sales</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="approveSales" name="permissions[approve_sales]" value="1"
                        {{ isset($permissionsArray['approve_sales']) && $permissionsArray['approve_sales'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approveSales">Approve Sales</label>
                </div>
            </div>
        </div>

        <!-- Services Section Rights -->
        <h5 class="fw-bold mb-3">Services  Rights</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="addServices" name="permissions[add_services]" value="1"
                        {{ isset($permissionsArray['add_services']) && $permissionsArray['add_services'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="addServices">Add Services</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="viewServices" name="permissions[view_services]" value="1"
                        {{ isset($permissionsArray['view_services']) && $permissionsArray['view_services'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="viewServices">View Services</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="changeServices" name="permissions[change_services]" value="1"
                        {{ isset($permissionsArray['change_services']) && $permissionsArray['change_services'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="changeServices">Edit Services</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="approveServices" name="permissions[approve_services]" value="1"
                        {{ isset($permissionsArray['approve_services']) && $permissionsArray['approve_services'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approveServices">Approve Services</label>
                </div>
            </div>
        </div>
    </div>
    
    <br>
    <div class="card shadow-lg p-4 card-custom">
        <h4 class="fw-bold text-primary mb-4">Other Section Rights</h4>

       
        
        @include('pages.users.permissons.countries-permissions')

         @include('pages.users.permissons.departments-permissions')

        @include('pages.users.permissons.documents-types-permissions')
   
        @include('pages.users.permissons.merchant-categories-permission')

        @include('pages.users.permissons.services-types-permission')
       
        @include('pages.users.permissons.activity-logs-permissions')
        @include('pages.users.permissons.user-section-permission')
    </div>

</div>



<script>
    // Function to handle individual permission dependencies (Approve -> Change -> Add -> View)
    function handlePermissionChange(approveId, changeId, addId, viewId) {
        const approveElement = document.getElementById(approveId);
        const changeElement = document.getElementById(changeId);
        const addElement = document.getElementById(addId);
        const viewElement = document.getElementById(viewId);

        // Approve permission logic
        approveElement.addEventListener('change', function () {
            if (this.checked) {
                addElement.checked = true;
                viewElement.checked = true;
                changeElement.checked = true;
            }
        });

        // Change permission logic
        changeElement.addEventListener('change', function () {
            if (this.checked) {
                addElement.checked = true;
                viewElement.checked = true;
            }
        });
    }

    // Function to handle section-level toggle checkboxes
    function toggleSectionPermissions(sectionToggleId, permissionIds) {
        const sectionToggle = document.getElementById(sectionToggleId);
        
        sectionToggle.addEventListener('change', function () {
            const isChecked = this.checked;

            // Toggle each permission checkbox in the section
            permissionIds.forEach(permissionId => {
                const checkbox = document.getElementById(permissionId);
                if (checkbox) {
                    checkbox.checked = isChecked;
                }
            });
        });
    }

    // Apply dependencies within each section
    handlePermissionChange('approveKYC', 'changeKYC', 'addKYC', 'viewKYC');
    handlePermissionChange('approveDocuments', 'changeDocuments', 'addDocuments', 'viewDocuments');
    handlePermissionChange('approveSales', 'changeSales', 'addSales', 'viewSales');
    handlePermissionChange('approveServices', 'changeServices', 'addServices', 'viewServices');
    

    // Toggle permissions in sections
    toggleSectionPermissions('toggleUsersSection', ['addUser', 'viewUsers', 'changeUser', 'deleteUser']);
    toggleSectionPermissions('toggleDepartmentsSection',[ 'addDepartments', 'viewDepartments', 'changeDepartments','deleteDepartments']);
    toggleSectionPermissions('toggleDocumentsSection',[ 'addSideBarDocuments', 'viewSideBarDocuments', 'changeSideBarDocuments','deleteSideBarDocuments']);
    toggleSectionPermissions('toggleMerchantCategoriesSection',[ 'addMerchantCategories', 'viewMerchantCategories', 'changeMerchantCategories','deleteMerchantCategories']);
    toggleSectionPermissions('toggleCountriesSection',[ 'addCountries', 'viewCountries', 'changeCountries','deleteCountries']);
    toggleSectionPermissions('toggleActivityLogsSection',[ 'myActivityLogs', 'allActivityLogs']);
    toggleSectionPermissions('toggleMerchantsSection', [ 'addMerchant','viewMerchants', 'changeMerchant','deleteMerchant' ]);
    toggleSectionPermissions('toggleServicesSection', [ 'addSideBarServices','viewSideBarServices', 'changeSideBarServices','deleteSideBarServices' ]);




</script>
