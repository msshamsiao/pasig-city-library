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
                    <h6 class="m-0 font-weight-bold text-primary">Book Library </h6>
                    @if (auth()->user()->admin == 2)
                        <a href="#" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#addBookModal">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                        </a>
                    @endif
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Book Name</th>
                                            <th>Book Author</th>
                                            <th>Subject</th>
                                            <th>Call Number</th>
                                            <th>ISBN</th>
                                            <th>ISSN</th>
                                            <th>Resource Type</th>
                                            <th>Member Library</th>
                                            <th>Copies of Book</th>
                                            @if (auth()->user()->admin == 2)
                                                <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Status</th>
                                            <th>Book Name</th>
                                            <th>Book Author</th>
                                            <th>Subject</th>
                                            <th>Call Number</th>
                                            <th>ISBN</th>
                                            <th>ISSN</th>
                                            <th>Resource Type</th>
                                            <th>Member Library</th>
                                            <th>Copies of Book</th>
                                            @if (auth()->user()->admin == 2)
                                                <th>Actions</th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td>
                                                    @if ($book->status == 1)
                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ $book->title }}</td>
                                                <td>{{ $book->author }}</td>
                                                <td>{{ $book->subject }}</td>
                                                <td>{{ $book->call_number }}</td>
                                                <td>{{ $book->isbn }}</td>
                                                <td>{{ $book->issn }}</td>
                                                <td>
                                                    @if ($book->resource_type == 1)
                                                        <span class="badge badge-primary">
                                                            Hardbound
                                                        </span>
                                                    @else
                                                        <span class="badge badge-primary">
                                                            PDF
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ $book->memberLibrary->name }}</td>
                                                <td>{{ $book->available }}</td>
                                                @if (auth()->user()->admin == 2)
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-icon-split btn-update" data-book-id="{{ $book->id }}" data-toggle="modal" data-target="#editBookModal">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </span>
                                                        </a>                                             
                                                        <a href="#" class="btn btn-danger btn-icon-split" onclick="confirmAndDelete({{ $book->id }}); return false;">
                                                            <span class="icon text-white">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                        </a>
                                                    </td>
                                                @endif
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
    <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addBookForm">
                        @csrf
                        <div class="mb-3">
                            <label for="member_library" class="form-label">Choose Resource Type</label>
                            <select class="form-control" name="resource_type" id="resource_type" required>
                                <option value="" selected>All Resource Type</option>
                                <option value="0">Hardbound</option>
                                <option value="1">PDF</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Book Author</label>
                                <input type="text" class="form-control" id="author" name="author" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                        </div> 
                        <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label">Call Number</label>
                            <input type="text" class="form-control" id="call_number" name="call_number" required>
                        </div>                   
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="issn" class="form-label">ISSN</label>
                                <input type="text" class="form-control" id="issn" name="issn" required>
                            </div>
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
                        <div class="mb-3">
                            <label for="available" class="form-label">No of Copies</label>
                            <input type="number" class="form-control" id="available" name="available" required>
                        </div>
                        <!-- Move the button inside the form -->
                        <div class="modal-footer">
                            <button class="btn btn-primary" id="addBookButton" type="button">
                                Add Book
                            </button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Update Member Library Modal -->
     <div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="editBookModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel">Update Book Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit Member Form -->
                    <form id="editBookForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editBookId" name="editBookId">
                        <div class="mb-3">
                            <label for="member_library" class="form-label">Choose Resource Type</label>
                            <select class="form-control" name="edit_resource_type" id="resource_type" required>
                                <option value="" selected>All Resource Type</option>
                                <option value="0">Hardbound</option>
                                <option value="1">PDF</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="edit_title" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Book Author</label>
                                <input type="text" class="form-control" id="author" name="edit_author" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="edit_subject" required>
                            </div>
                        </div>  
                        <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label">Call Number</label>
                            <input type="text" class="form-control" id="call_number" name="edit_call_number" required>
                        </div>                       
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="edit_isbn" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="issn" class="form-label">ISSN</label>
                                <input type="text" class="form-control" id="issn" name="edit_issn" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="member_library" class="form-label">Choose Member Library</label>
                            <select class="form-control" name="edit_member_library" id="edit_member_library" required>
                                <option value="">All Member Libraries</option>
                                @php
                                    $memberLibraries = \App\Models\MemberLibrary::get();
                                @endphp
                                  @foreach($memberLibraries as $memberLibrary)
                                      <option value="{{ $memberLibrary->id }}">{{ $memberLibrary->name }}</option>
                                  @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="available" class="form-label">No of Copies</label>
                            <input type="number" class="form-control" id="available" name="edit_available" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="member_library" class="form-label">Choose Status</label>
                            <select class="form-control" name="edit_status" id="edit_status" required>
                                <option value="" selected>All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Update Book</button>
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
            fetchBooks();

            // Fetch and display members using AJAX
            function fetchBooks() {
                $.ajax({
                    url: "{{ route('admin.book') }}",
                    type: "GET",
                    success: function (response) {
                        $('#memberList').html(response);
                    }
                });
            }

            $('#addBookButton').click(function() {
                // Add Member information
                $.ajax({
                    url: `/admin/book`,
                    type: "POST",
                    data: $('#addBookForm').serialize(),
                    success: function(response) {
                        $('#addBookModal').modal('hide');
                        // Reload the page after successful addition
                        location.reload();
                        alert(response.success);
                    },
                    error: function(error) {
                        console.error("Error adding book:", error);
                    }
                });
            });

            // Function to show the edit book modal and fill in the form with member data
            function editBook(bookId) {
                $.ajax({
                    url: `/admin/book/${bookId}/edit`,
                    type: "GET",
                    success: function(response) {
                        console.log("User data for editing:", response.book);
                        fillUserForm(response.book);
                        $('#editBookId').val(bookId);
                        $('#editBookModal').modal('show');
                    },
                    error: function(error) {
                        console.error("Error fetching member data for editing:", error);
                    }
                });
            }

            // Function to fill the edit form with member data
            function fillUserForm(book) {
                $('select[name="edit_resource_type"]').val(book.resource_type);
                $('input[name="edit_title"]').val(book.title);
                $('input[name="edit_author"]').val(book.author);
                $('input[name="edit_subject"]').val(book.subject);
                $('input[name="edit_call_number"]').val(book.call_number);
                $('input[name="edit_isbn"]').val(book.isbn);
                $('input[name="edit_issn"]').val(book.issn);
                $('select[name="edit_member_library"]').val(book.school);
                $('input[name="edit_available"]').val(book.available);
                $('select[name="edit_status"]').val(book.status);
            }

            // Event handler for the "Update" button click
            $(document).on('click', '.btn-update', function(e) {
                e.preventDefault();
                var bookId = $(this).data('book-id') || $(this).closest('.btn-update').data('book-id');
                console.log("Clicked button ID:", bookId);
                editBook(bookId);
            });

            // Event handler for form submission
            $('#editBookForm').submit(function(e) {
                e.preventDefault();
                var bookId = $('#editBookId').val();
                $.ajax({
                    url: `/admin/book/${bookId}`,
                    type: "PUT",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editBookModal').modal('hide');
                        fetchBooks();
                        alert(response.success);

                        // Reload the page after successful update
                        location.reload();
                    },
                    error: function(error) {
                        console.error("Error updating book:", error);
                    }
                });
            });

            // Modal shown event handler
            $('#editBookModal').on('shown.bs.modal', function() {
                var bookId = $('#editBookId').val();
                console.log("Modal shown for user ID:", bookId);
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
                    url: "/admin/book/" + id,
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
                fetchBooks(); // Assuming fetchBooks is defined elsewhere to refresh the member list
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
 