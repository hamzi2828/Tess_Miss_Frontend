         <!-- Users Section Rights -->
         <h5 class="fw-bold mb-3">
            <input class="form-check-input me-2" type="checkbox" id="toggleUsersSection" name="permissions[toggle_users_section]" value="1"
                {{ isset($permissionsArray['toggle_users_section']) && $permissionsArray['toggle_users_section'] == 1 ? 'checked' : '' }}>
        Users Rights
        </h5>
        
         <div class="row mb-3">
             <div class="col-md-6">
                 <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="addUser" name="permissions[add_user]" value="1"
                         {{ isset($permissionsArray['add_user']) && $permissionsArray['add_user'] == 1 ? 'checked' : '' }}>
                     <label class="form-check-label" for="addUser">Add User</label>
                 </div>
                 <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="viewUsers" name="permissions[view_users]" value="1"
                         {{ isset($permissionsArray['view_users']) && $permissionsArray['view_users'] == 1 ? 'checked' : '' }}>
                     <label class="form-check-label" for="viewUsers">View All Users</label>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="changeUser" name="permissions[change_user]" value="1"
                         {{ isset($permissionsArray['change_user']) && $permissionsArray['change_user'] == 1 ? 'checked' : '' }}>
                     <label class="form-check-label" for="changeUser">Edit User</label>
                 </div>
                 <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="deleteUser" name="permissions[delete_user]" value="1"
                        {{ isset($permissionsArray['delete_user']) && $permissionsArray['delete_user'] == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="deleteUser">Delete User</label>
                </div>
             </div>

            

         </div>