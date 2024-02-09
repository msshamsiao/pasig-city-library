 <!-- dashboard/index.blade.php -->

 @extends('layouts.admin_app')

 @section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}">

     <!-- Begin Page Content -->
  <div class="container-fluid">
 
     <!-- Content Row -->
     <div class="row">
 
     </div>
 
     <!-- Content Row -->
 
     <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Member Library </h6>
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
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Description</th>
                                            <th>Link</th>
                                            <th>Logo</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Description</th>
                                            <th>Link</th>
                                            <th>Logo</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($members as $member)
                                            <tr>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->description }}</td>
                                                <td>{{ $member->link }}</td>
                                                <td>
                                                    <!-- Display logo image -->
                                                    @if($member->image_logo)
                                                        <img src="{{ asset('uploads/' . $member->image_logo) }}" alt="Logo" style="max-width: 100px;">
                                                    @else
                                                        No Logo
                                                    @endif
                                                </td>
                                                <th>
                                                    @if ($member->status == 1)
                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </th>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-icon-split btn-update" data-member-id="{{ $member->id }}" data-toggle="modal" data-target="#editMemberModal">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </span>
                                                    </a>                                             
                                                    <a href="#" class="btn btn-danger btn-icon-split" onclick="confirmAndDelete({{ $member->id }}); return false;">
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Member Library Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addMemberForm" enctype="multipart/form-data"> 
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" class="form-control-file" id="file" name="logo">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Link</label>
                            <input type="email" class="form-control" id="link" name="link" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" id="addMemberButton" type="button">
                                Add Member Library
                            </button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Update Member Library Modal -->
     <div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="editMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMemberModalLabel">Update Member Library Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit Member Form -->
                    <form id="editMemberForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editMemberId" name="editMemberId">
                        <div class="mb-3">
                            <label for="member_library_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="member_library_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="edit_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="edit_description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Link</label>
                            <input type="text" class="form-control" id="edit_link" name="edit_link" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Status</label>
                            <select class="form-control" name="edit_status" id="edit_status" required>
                                <option value="" selected>Please choose status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Update Member Library</button>
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
                    url: "{{ route('admin.member_library') }}",
                    type: "GET",
                    success: function (response) {
                        $('#memberList').html(response);
                    }
                });
            }

            $('#addMemberButton').click(function() {
                // Create FormData object
                var formData = new FormData($('#addMemberForm')[0]);

                $.ajax({
                    url: `/admin/member_library`,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#addMemberModal').modal('hide');
                        location.reload();
                        alert(response.success);
                    },
                    error: function(error) {
                        console.error("Error adding member:", error);
                    }
                });
            });

            // Function to show the edit member modal and fill in the form with member data
            function editMember(memberId) {
                $.ajax({
                    url: `/admin/member_library/${memberId}/edit`,
                    type: "GET",
                    success: function(response) {
                        fillEditForm(response.member);
                        $('#editMemberId').val(memberId);
                        $('#editMemberModal').modal('show');
                    },
                    error: function(error) {
                        console.error("Error fetching member data for editing:", error);
                        // Handle error
                    }
                });
            }

            // Function to fill the edit form with member data
            function fillEditForm(member) {
                $('#edit_name').val(member.name);
                $('#edit_email').val(member.email);
                $('#edit_description').val(member.description);
                $('#edit_link').val(member.link);
                $('#edit_status').val(member.status);
            }

            // Event handler for the "Update" button click
            $(document).on('click', '.btn-update', function(e) {
                e.preventDefault();
                var memberId = $(this).data('member-id') || $(this).closest('.btn-update').data('member-id');
                console.log("Clicked button ID:", memberId);
                editMember(memberId);
            });

            // Event handler for form submission
            $('#editMemberForm').submit(function(e) {
                e.preventDefault();
                var memberId = $('#editMemberId').val();
                $.ajax({
                    url: `/admin/member_library/${memberId}`,
                    type: "PUT",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editMemberModal').modal('hide');
                        fetchMembers(); // Assuming fetchMembers is defined elsewhere to refresh the member list
                        alert(response.success);

                        // Reload the page after successful update
                        location.reload();
                    },
                    error: function(error) {
                        console.error("Error updating member:", error);
                        // Handle error
                    }
                });
            });

            // Modal shown event handler
            $('#editMemberModal').on('shown.bs.modal', function() {
                var memberId = $('#editMemberId').val();
                console.log("Modal shown for member ID:", memberId);
                // Additional actions when the modal is shown
            });
       
            // Function to confirm and delete member
            window.confirmAndDelete = function(id) {
                if (confirm('Are you sure you want to delete this member?')) {
                    deleteMember(id);
                }
            };

            // Function to delete member using AJAX
            function deleteMember(id) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "/admin/member_library/" + id,
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
                console.error("Error deleting member:", error);
                alert("An error occurred while deleting the member.");

                location.reload();
            }
        })
    </script>
 
 </div>
 
 <!-- /.container-fluid -->
 @endsection
 