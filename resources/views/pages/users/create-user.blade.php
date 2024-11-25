@extends('master.master')

<style>
    .form-label {
        font-weight: 500;
        color: #6c757d;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    /* Remove the border-radius for square inputs */
    .form-control,
    .form-select {
        border-radius: 0px !important;
    }

    /* You can adjust the card radius or leave it as it is */
    .card-custom {
        border-radius: 5px;
        background-color: #f8f9fa;
    }
</style>

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Left Side: User Details -->
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card shadow-lg p-4 card-custom">
                <h4 class="fw-bold text-primary mb-4">Add User</h4>

                <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" onsubmit="return validatePassword()">
                    @csrf
                
                    <!-- Full Name -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userFullname">Full Name
                             <span class="required-asterisk text-danger">*</span>
                         </label>
                        <input type="text" class="form-control" id="userFullname" name="userFullname" value="{{ old('userFullname') }}" required />
                         
                        @if($errors->has('userFullname'))
                            <div class="text-danger">{{ $errors->first('userFullname') }}</div>
                        @endif
                    </div>
                
                    <!-- Email -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userEmail">Email  <span class="required-asterisk text-danger">*</span> </label>
                        <input type="email" id="userEmail" class="form-control" name="userEmail" value="{{ old('userEmail') }}" required />
                        @if($errors->has('userEmail'))
                            <div class="text-danger">{{ $errors->first('userEmail') }}</div>
                        @endif
                    </div>
                
                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userPhone">Phone</label>
                        <input type="tel" id="userPhone" class="form-control" name="userPhone" value="{{ old('userPhone') }}" />
                        @if($errors->has('userPhone'))
                            <div class="text-danger">{{ $errors->first('userPhone') }}</div>
                        @endif
                    </div>
                
                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userStatus">Status</label>
                        <select id="userStatus" class="form-select" name="userStatus" required>
                            <option value="active" {{ old('userStatus') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('userStatus') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @if($errors->has('userStatus'))
                            <div class="text-danger">{{ $errors->first('userStatus') }}</div>
                        @endif
                    </div>
                
                    <!-- Department -->
                    <div class="mb-4">
                        <label for="selectDepartment" class="form-label fw-medium text-secondary">Department  <span class="required-asterisk text-danger">*</span></label>
                        <select class="form-select select2" id="selectDepartment" name="department_id" required>
                            <option selected>Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->title }}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has('department_id'))
                            <div class="text-danger">{{ $errors->first('department_id') }}</div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userRole">Select User Role</label>
                        <select id="userRole" class="form-select select2" name="user_role" required>
                            <option value="user" {{ old('user_role') == 'user' ? 'selected' : '' }}>Simple User</option>
                            <option value="supervisor" {{ old('user_role') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        </select>
                        @if($errors->has('user_role'))
                            <div class="text-danger">{{ $errors->first('user_role') }}</div>
                        @endif
                    </div>
                    
                
                    <!-- Password -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userPassword">Password  <span class="required-asterisk text-danger">*</span></label>
                        <input type="password" id="userPassword" class="form-control" name="userPassword" required />
                        @if($errors->has('userPassword'))
                            <div class="text-danger">{{ $errors->first('userPassword') }}</div>
                        @endif
                    </div>
                
                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userPasswordConfirmation">Confirm Password</label>
                        <input type="password" id="userPasswordConfirmation" class="form-control" name="userPasswordConfirmation" required />
                    </div>

                    <!-- gender -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userGender">Gender</label>
                        <select id="userGender" class="form-select" name="userGender" required>
                            <option value="male" {{ old('userGender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('userGender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @if($errors->has('userGender'))
                            <div class="text-danger">{{ $errors->first('userGender') }}</div>
                        @endif
                    </div>
                
                    <!-- File Input -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="file-input">Upload Profile Picture</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="file-input" name="userPicture" accept="image/*">
                        </div>
                        @if($errors->has('userPicture'))
                            <div class="text-danger">{{ $errors->first('userPicture') }}</div>
                        @endif
                    </div>
                
                    <!-- Address -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userAddress">Address</label>
                        <textarea id="userAddress" class="form-control" name="userAddress" rows="3">{{ old('userAddress') }}</textarea>
                        @if($errors->has('userAddress'))
                            <div class="text-danger">{{ $errors->first('userAddress') }}</div>
                        @endif
                    </div>
                
                    <!-- Submit & Cancel Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4 me-3">Create</button>
                        <a href="{{ route('users.index') }}" class="btn btn-danger px-4">Cancel</a>
                    </div>
                </form>
                
                <script>
                    // Initialize Select2 on the initial page load for existing selects
                    document.addEventListener('DOMContentLoaded', function() {
                        $('#selectDepartment').select2({
                            placeholder: 'Select Department',
                            allowClear: true
                        });
                    });
                
                    // Validate password and confirm password match
                    function validatePassword() {
                        const password = document.getElementById('userPassword').value;
                        const confirmPassword = document.getElementById('userPasswordConfirmation').value;
                
                        if (password !== confirmPassword) {
                            alert('Passwords do not match.');
                            return false; // Prevent form submission
                        }
                        return true; // Allow form submission
                    }
                </script>
                
            </div>
        </div>
    </div>
</div>

@endsection
