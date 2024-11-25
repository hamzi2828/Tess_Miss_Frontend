<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditDepartment" aria-labelledby="offcanvasEditDepartmentLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasEditDepartmentLabel" class="offcanvas-title">Edit Department</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="editDepartmentForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Department Title -->
            <div class="mb-6">
                <label class="form-label" for="edit-department-title">Department Title</label>
                <input type="text" class="form-control" id="edit-department-title" name="departmentTitle" required />
            </div>

            <!-- Stage Dropdown -->
            <div class="mb-6">
                <label class="form-label" for="edit-department-stage">Stage</label>
                <select id="edit-department-stage" class="form-select" name="department_stage" required>
                    <option value="">Select Stage</option>
                    <option value="1">Stage 1 - KYC</option>
                    <option value="2">Stage 2 - Document</option>
                    <option value="3">Stage 3 - Sales</option>
                    <option value="4">Stage 4 - Services</option>
                </select>
            </div>



            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3">Update</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Edit Button Click
        document.querySelectorAll('.edit-department-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const departmentID = this.getAttribute('data-id');
                const departmentTitle = this.getAttribute('data-title');
                const departmentStage = this.getAttribute('data-stage');
                const supervisorName = this.getAttribute('data-supervisor-name'); // Get supervisor name

                // Set form action for updating the department
                document.getElementById('editDepartmentForm').action = '/departments/' + departmentID;

                // Populate fields in the modal with department data
                document.getElementById('edit-department-title').value = departmentTitle;
                document.getElementById('edit-department-stage').value = departmentStage;


            });
        });
    });
</script>
