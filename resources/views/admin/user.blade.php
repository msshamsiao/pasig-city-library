 <!-- dashboard/index.blade.php -->

 @extends('layouts.admin_app')

 @section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}">

     <!-- Begin Page Content -->
  <div class="container-fluid">
     <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">User </h6>
                    <a href="#" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#addMemberModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                    </a>
                </div>
                <!-- Card Body -->              
                <div class="card-body">
                    <div class="card shadow mb-4">                    
                        <div class="card-body">   
                            <form action="{{ route('admin.user') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="user_type" class="form-label">User Type:</label>
                                            <select class="form-control" id="user_type" name="user_type">
                                                <option value="">All</option>
                                                <option value="0">Borrower</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Librarian</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="member_library" class="form-label">Member Library:</label>
                                            <select class="form-control" id="member_library" name="member_library">
                                                <option value="">All</option>
                                                @foreach($memberLibraries as $library)
                                                    <option value="{{ $library->id }}">{{ $library->member_library_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form> 
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Type of User</th>
                                            <th>Member Library</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Type of User</th>
                                            <th>Member Library</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->admin == 0) <!-- normal user -->
                                                        <span class="badge badge-success">
                                                            Borrower
                                                        </span>
                                                    @elseif ($user->admin == 1) <!--admin user -->
                                                        <span class="badge badge-warning">
                                                            Admin
                                                        </span>
                                                    @else <!--librarian user -->
                                                        <span class="badge badge-primary">
                                                            Librarian
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->user_member_library)
                                                        {{ $user->user_member_library->name }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-icon-split btn-update" data-user-id="{{ $user->id }}" data-toggle="modal" data-target="#editUserModal">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </span>
                                                    </a>                                             
                                                    <a href="#" class="btn btn-danger btn-icon-split" onclick="confirmAndDelete({{ $user->id }}); return false;">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-trash"></i>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Add Member Library Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addMemberForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="user_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="user_password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_type" class="form-label">Choose Type of User</label>
                            <select class="form-control" name="user_type" id="user_type" required>
                                <option value="">All Type of User</option>
                                <option value="0">Borrower</option>
                                <option value="1">Admin</option>
                                <option value="2">Librarian</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="member_library" class="form-label">Choose Member Library</label>
                            <select class="form-control" name="member_library" id="user_member_library" required>
                                <option value="">All Member Libraries</option>
                                @php
                                    $memberLibraries = \App\Models\MemberLibrary::get();
                                @endphp
                                  @foreach($memberLibraries as $memberLibrary)
                                      <option value="{{ $memberLibrary->id }}">{{ $memberLibrary->name }}</option>
                                  @endforeach
                            </select>
                        </div>
                        <!-- Move the button inside the form -->
                        <div class="modal-footer">
                            <button class="btn btn-primary" id="addMemberButton" type="button">
                                Add User
                            </button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Update Member Library Modal -->
     <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Update User Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit Member Form -->
                    <form id="editUserForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editUserId" name="editUserId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user_name" name="edit_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="user_email" name="edit_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_type" class="form-label">Choose Type of User</label>
                            <select class="form-control" name="edit_user_type" id="user_type" required>
                                <option value="">All Type of User</option>
                                <option value="0">Borrower</option>
                                <option value="1">Admin</option>
                                <option value="2">Librarian</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="member_library" class="form-label">Choose Member Library</label>
                            <select class="form-control" name="edit_member_library" id="user_member_library" required>
                                <option value="">All Member Libraries</option>
                                <option value="0">Not Applicable</option>
                                @php
                                    $memberLibraries = \App\Models\MemberLibrary::get();
                                @endphp
                                  @foreach($memberLibraries as $memberLibrary)
                                      <option value="{{ $memberLibrary->id }}">
                                        {{ $memberLibrary->name }}
                                    </option>
                                  @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Update User</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
       
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fetch and display members when the page loads
            fetchMembers();

            // Fetch and display members using AJAX
            function fetchMembers() {
                $.ajax({
                    url: "{{ route('admin.user') }}",
                    type: "GET",
                    success: function (response) {
                        $('#memberList').html(response);
                    }
                });
            }

            $('#addMemberButton').click(function() {
                // Add Member information
                $.ajax({
                    url: `/admin/user`,
                    type: "POST",
                    data: $('#addMemberForm').serialize(),
                    success: function(response) {
                        $('#addMemberModal').modal('hide');
                        // Reload the page after successful addition
                        location.reload();
                        alert(response.success);
                    },
                    error: function(error) {
                        console.error("Error adding member:", error);
                        // Handle error
                    }
                });
            });

            // Function to show the edit member modal and fill in the form with member data
            function editUser(memberId) {
                $.ajax({
                    url: `/admin/user/${memberId}/edit`,
                    type: "GET",
                    success: function(response) {
                        console.log("User data for editing:", response.user);
                        fillUserForm(response.user);
                        $('#editUserId').val(memberId);
                        $('#editUserModal').modal('show');
                    },
                    error: function(error) {
                        console.error("Error fetching member data for editing:", error);
                    }
                });
            }

            // Function to fill the edit form with member data
            function fillUserForm(user) {
                $('input[name="edit_name"]').val(user.name);
                $('input[name="edit_email"]').val(user.email);
                $('select[name="edit_user_type"]').val(user.admin);
                $('select[name="edit_member_library"]').val(user.member_library);
            }

            // Event handler for the "Update" button click
            $(document).on('click', '.btn-update', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id') || $(this).closest('.btn-update').data('user-id');
                console.log("Clicked button ID:", userId);
                editUser(userId);
            });

            // Event handler for form submission
            $('#editUserForm').submit(function(e) {
                e.preventDefault();
                var userId = $('#editUserId').val();
                $.ajax({
                    url: `/admin/user/${userId}`,
                    type: "PUT",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editUserModal').modal('hide');
                        fetchMembers();
                        alert(response.success);

                        // Reload the page after successful update
                        location.reload();
                    },
                    error: function(error) {
                        console.error("Error updating user:", error);
                        // Handle error
                    }
                });
            });

            // Modal shown event handler
            $('#editUserModal').on('shown.bs.modal', function() {
                var userId = $('#editUserId').val();
                console.log("Modal shown for user ID:", userId);
            });
       
            // Function to confirm and delete member
            window.confirmAndDelete = function(id) {
                if (confirm('Are you sure you want to delete this user?')) {
                    deleteMember(id);
                }
            };

            // Function to delete member using AJAX
            function deleteMember(id) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "/admin/user/" + id,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        handleDeleteSuccess(response);
                    },
                    error: function(error) {
                        handleDeleteError(error);
                    }
                });
            }

            // Function to handle successful delete
            function handleDeleteSuccess(response) {
                fetchMembers(); // Assuming fetchMembers is defined elsewhere to refresh the member list
                alert(response.success);

                location.reload();
            }

            // Function to handle delete error
            function handleDeleteError(error) {
                console.error("Error deleting user:", error);

                if (error.responseJSON && error.responseJSON.error) {
                    alert("Error: " + error.responseJSON.error);
                } else {
                    alert("An error occurred while deleting the member.");
                }

                location.reload();
            }
        })
    </script>
 
 </div>
 
 <!-- /.container-fluid -->
 @endsection
 