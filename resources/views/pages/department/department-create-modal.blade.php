<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddDepartment" aria-labelledby="offcanvasAddDepartmentLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddDepartmentLabel" class="offcanvas-title">Add Department</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="addNewDepartmentForm" method="POST" action="{{ route('departments.store') }}">
            @csrf

            <!-- Title Field --> 
            <div class="mb-6">
                <label class="form-label" for="add-department-title">Department Title</label>
                <input type="text" class="form-control" id="add-department-title" placeholder="Enter department title" name="departmentTitle" aria-label="Department Title" required />
            </div>

               <!-- Stages Dropdown -->
               <div class="mb-6">
                <label class="form-label" for="add-department-stage">Stage</label>
                <select id="add-department-stage" class="form-select" name="department_stage" required>
                    <option value="">Select Stage</option>
                    <option value="1">Stage 1 - KYC </option>
                    <option value="2">Stage 2 - Document </option>
                    <option value="3">Stage 3 - Sales</option>
                    <option value="4">Stage 4 - Services</option>
                </select>
            </div>

            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
