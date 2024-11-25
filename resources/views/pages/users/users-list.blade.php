@extends('master.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-ecommerce-user">
    
        <div class="d-flex mb-6 align-items-center">
            <h4 class="fw-bold">All Users</h4>
        
            <div class="d-flex col-lg-3 col-md-3 ms-auto" style="justify-content: end">
                @can('addUser', App\Models\User::class)
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-md">
                    <i class="ti ti-plus me-1"></i> Add User
                </a>
                @endcan
            </div>
            
        </div>
        

        <div class="card">
            <div class="card-datatable table-responsive">
                <table id="customUserTable" class="table border-top">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th class="text-lg-center">User Details</th>
                            <th>Address</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th class="text-lg-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @php $i = 1; @endphp
                        @foreach($users as $user)
                        <tr>
                            <td></td>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($user->picture)
                                        {{-- <img src="{{ asset('storage/' . $user->picture) }}" alt="Avatar" class="rounded-circle me-2" style="width: 50px; height: 50px;"> --}}
                                        <img src="{{ asset($user->picture) }}" alt="Profile Picture"  class="rounded-circle me-2" style="width: 50px; height: 50px;">
                                    @else
                                        @php
                                            $initials = strtoupper(substr($user->name, 0, 2));
                                            $stateNum = rand(0, 5);
                                            $states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
                                            $state = $states[$stateNum];
                                        @endphp
                                        <span class="avatar-initial rounded-circle bg-label-{{ $state }} me-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                            {{ $initials }}
                                        </span>
                                    @endif
                                    <div>
                                        <span class="text-heading text-wrap fw-medium">{{ $user->name }}</span><br>
                                        <small>{{ $user->email }}</small><br>
                                        <small>{{ $user->phone }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->address }}</td>
                          
                            <td>
                                {{ $user->getDepartmentTitle($user->department) }} 
                            </td>

                            <td>{{ $user->role }}</td>
                            
                            <td>{{ $user->created_at }}</td>
                          
                            <td>
                                @if($user->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            
                    
                            <td class="text-lg-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <!-- Edit Button -->
                                    @can('changeUser', App\Models\User::class)
                                    <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-user-btn"
                                            onclick="editUser({{ $user->id }})">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    @endcan
                                    @can('deleteUser', App\Models\User::class)
                                  <!-- Delete Form -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-user-form" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 delete-user-btn">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                            @endcan
                                </div>
                            </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>

<!-- Hidden Form for Edit User -->
<form id="editUserForm" action="{{ route('users.edit') }}" method="GET" style="display:none;">
    @csrf
    <input type="hidden" id="userId" name="user_id">
</form>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-user-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission
            const confirmation = confirm("Are you sure you want to delete this user?");
            if (confirmation) {
                // Find the closest form and submit it
                this.closest('form').submit();
            }
        });
    });
});


    // Function to filter table rows based on the search input
    // function filterTable() {
    //     let input = document.getElementById('customUserSearch');
    //     let filter = input.value.toLowerCase();
    //     let table = document.getElementById('customUserTable');
    //     let rows = table.getElementsByTagName('tr');

    //     for (let i = 1; i < rows.length; i++) {
    //         let cells = rows[i].getElementsByTagName('td');
    //         let match = false;

    //         for (let j = 0; j < cells.length; j++) {
    //             let cellValue = cells[j].textContent || cells[j].innerText;
    //             if (cellValue.toLowerCase().indexOf(filter) > -1) {
    //                 match = true;
    //                 break;
    //             }
    //         }

    //         if (match) {
    //             rows[i].style.display = "";
    //         } else {
    //             rows[i].style.display = "none";
    //         }
    //     }
    // }

    // Function to handle edit user button click
    function editUser(userId) {
    let form = document.getElementById('editUserForm');
    document.getElementById('userId').value = userId; // Pass userId in the hidden input
    form.submit();
}

</script>

@endsection



@push('script')
<!-- Initialize DataTables with export options -->
<script>
    $(document).ready(function() {
        var table = $('#customUserTable').DataTable({
            "paging": true,      // Enable pagination
            "ordering": true,    // Enable sorting
            "info": true,        // Display table information
            "searching": true,   // Enable search functionality
            "order": [[ 1, 'asc' ]], // Default sorting by Title (column index 3), ascending

            // Add export buttons before the search box
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'excelHtml5',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'print',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                }
            ]
        });

        // Trigger the export actions from the dropdown
        $('#exportCsv').on('click', function() {
            table.button('.buttons-csv').trigger();
        });

        $('#exportExcel').on('click', function() {
            table.button('.buttons-excel').trigger();
        });

        $('#exportPdf').on('click', function() {
            table.button('.buttons-pdf').trigger();
        });

        $('#exportPrint').on('click', function() {
            table.button('.buttons-print').trigger();
        });
    });
</script>
@endpush
