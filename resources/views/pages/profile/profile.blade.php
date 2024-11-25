@extends('master.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" class="w-100" style="max-width: 900px;">
         @csrf
        @method('PUT') 
    <div class="row">

   
        <!-- Left Side: User Details -->
        <div class="col-md-12">
            <div class="card shadow-lg p-4 card-custom">
                <h4 class="fw-bold text-primary mb-4">Edit Profile</h4>
        
                <!-- Full Name -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userFullname">Full Name</label>
                    <input type="text" class="form-control" id="userFullname" name="userFullname" value="{{ $user->name }}" readonly />
                </div>
        
                <!-- Email -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userEmail">Email</label>
                    <input type="email" id="userEmail" class="form-control" name="userEmail" value="{{ $user->email }}" readonly />
                </div>
        
                <!-- Phone -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userPhone">Phone</label>
                    <input type="tel" id="userPhone" class="form-control" name="userPhone" value="{{ $user->phone }}" />
                </div>
                {{-- Gender --}}
                <div class="mb-4" style="display: none;">
                    <label class="form-label fw-medium text-secondary" for="userGender">Gender</label>
                    <select id="userGender" class="form-select" name="userGender" required>
                        <option value="male" {{ $user->userGender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user->userGender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>   
                </div>

        
                <!-- Status -->
                <div class="mb-4" style="display: none;">
                    <label class="form-label fw-medium text-secondary" for="userStatus">Status</label>
                    <select id="userStatus" class="form-select" name="userStatus" required>
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
     
          
                {{-- <!-- Department --> --}}
                <div class="mb-4" style="display: none;">
                    <label for="selectDepartment" class="form-label fw-medium text-secondary">Department</label>
                    <select class="form-select select2" id="selectDepartment" name="department_id" required>
                       
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ $user->department == $department->id ? 'selected' : '' }}>
                                {{ $department->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                

                <script>
                    // Initialize Select2 on the initial page load for existing selects
                    document.addEventListener('DOMContentLoaded', function() {

                        $('#selectDepartment').select2({
                            placeholder: 'Select Country',
                            allowClear: true
                        });
                    });
                </script>

                  <!-- New Password -->
                  <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userNewPassword">New Password</label>
                    <input type="password" id="userNewPassword" class="form-control" name="new_password" placeholder="Enter new password" />
                    @if($errors->has('new_password'))
                        <div class="text-danger">{{ $errors->first('new_password') }}</div>
                    @endif
                </div>
        
                <!-- Current Profile Picture -->
                @if($user->picture)
                <div class="mb-4 text-center">
                    <label class="form-label fw-medium text-secondary" for="currentUserPicture">Current Profile Picture</label><br>
                    <img src="{{ asset($user->picture) }}" alt="Profile Picture"  class="rounded-circle shadow-sm" style="max-width: 150px; height: auto;">
               
                </div>
                @endif
        
                <!-- File input -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="file-input">Edit Profile Picture</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="file-input" name="userPicture" accept="image/*">
                    </div>
                </div>
        
                <!-- Address -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userAddress">Address</label>
                    <textarea id="userAddress" class="form-control" name="userAddress" rows="3">{{ $user->address }}</textarea>
                </div>
        
                <!-- Submit & Cancel Buttons -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 me-3">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger px-4">Cancel</a>
                </div>
            </div>
        </div>
        

   

   
    </div>

</form>
</div>

@endsection