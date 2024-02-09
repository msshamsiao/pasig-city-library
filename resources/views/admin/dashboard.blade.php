 <!-- dashboard/index.blade.php -->

@extends('layouts.admin_app')

@section('content')
    <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pending Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countPendingUsers}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-red-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->admin == 2)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Books Borrow to Approve</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-red-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Not Returned</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php
                                        $borrowed = \App\Models\Transaction::where('status', 'borrowed')->count();
                                    @endphp
                                {{$borrowed}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-red-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Returned</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php
                                        $returned = \App\Models\Transaction::where('status', 'returned')->count();
                                    @endphp
                                    {{$returned}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-red-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (auth()->user()->admin == 1)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Member Libraries
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countMemberLibraries}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Books Available
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countBooksAvailable}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Books Not Available
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countBooksNotAvailable}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Content Row -->

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">

        <!-- Pending Book -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List of Pending Users</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="toggleMemberLibrary">
                                    <label class="form-check-label" for="toggleMemberLibrary">
                                        Unhide Member Library Column
                                    </label>
                                </div>
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Member Library</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Member Library</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($pendingMembers as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    @if ($user->user_member_library)
                                                        {{ $user->user_member_library->name }}
                                                    @endif
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->registration_status == "pending")
                                                        <span class="badge badge-danger">
                                                            {{ $user->registration_status }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success">
                                                            {{ $user->registration_status }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->registration_status === "pending")
                                                        <form id="approveForm-{{ $user->id }}" method="POST" action="{{ route('users.approve', ['userId' => $user->id]) }}">
                                                            @csrf
                                                            @method('PATCH')
                                
                                                            <button type="button" class="btn btn-success btn-icon-split btn-update" data-member-id="{{ $user->id }}" data-toggle="modal" data-target="#userModal" onclick="confirmApproval({{ $user->id }})">
                                                                <span class="icon text-white-50">
                                                                    <i class="fas fa-check"></i>
                                                                </span>
                                                            </button>
                                                        </form>
                                                    @elseif($user->registration_status === "approve")
                                                        <form id="unapproveForm-{{ $user->id }}" method="POST" action="{{ route('users.unapprove', ['userId' => $user->id]) }}">
                                                            @csrf
                                                            @method('PATCH')
                                
                                                            <button type="button" class="btn btn-warning btn-icon-split btn-unapprove" onclick="confirmUnapproval({{ $user->id }})">
                                                                <span class="icon text-white-50">
                                                                    <i class="fas fa-times"></i>
                                                                </span>
                                                            </button>
                                                        </form>    
                                                    @endif
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

</div>

<!-- /.container-fluid -->
<script>
    function confirmApproval(userId) {
        if (confirm('Are you sure you want to approve this user?')) {
            document.getElementById('approveForm-' + userId).submit();
        }
    }

    function confirmUnapproval(userId) {
        if (confirm('Are you sure you want to unapprove this user?')) {
            document.getElementById('unapproveForm-' + userId).submit();
        }
    }

    // JavaScript to toggle visibility of the Member Library column
    document.getElementById('toggleMemberLibrary').addEventListener('change', function() {
        var hideMemberLibrary = !this.checked; // Get the checked state of the checkbox
        var memberLibraryColumns = document.querySelectorAll('th:nth-child(2), td:nth-child(2)'); // Select all th and td elements in the second column

        // Loop through each th and td element in the second column
        memberLibraryColumns.forEach(function(column) {
            column.style.display = hideMemberLibrary ? 'none' : ''; // Set display style based on the checked state
        });
    });

</script> 
@endsection
