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
                    <h6 class="m-0 font-weight-bold text-primary">Transaction </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="GET">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-control" id="filter_status" name="filter_status">
                                                <option value="" disabled selected>Filter to Status</option>
                                                <option value="all">All</option>
                                                <option value="request">Request</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button id="generatePdfBtn" class="btn btn-primary btn-generate-report" onclick="window.location='{{ route('transactions.generatePdf') }}'">Generate PDF Report</button>
                            </form>
                            <br/>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Borrower</th>
                                            <th>Book</th>
                                            <th>Time Session</th>
                                            <th>Date Reserved</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Borrower</th>
                                            <th>Book</th>
                                            <th>Time Session</th>
                                            <th>Date Reserved</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->borrowerUser->name }}</td>
                                                <td>{{ $transaction->borrowerBook->title }}</td>
                                                <td>
                                                    <span class="badge badge-primary">
                                                        {{ $transaction->ampm_session }}
                                                    </span>
                                                </td>
                                                <td>{{ (new DateTime($transaction['borrowed_date']))->format('F j, Y') }}</td>
                                                <td>
                                                    @if ($transaction->status == "request")
                                                        <span class="badge badge-warning">
                                                            {{ $transaction->status }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success">
                                                            {{ $transaction->status }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form id="returnForm-{{ $transaction->id }}" method="POST" action="{{ route('transactions.return', ['transactionId' => $transaction->id]) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                    
                                                        <button type="button" class="btn btn-success btn-icon-split btn-return" onclick="confirmReturn({{ $transaction->id }})">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-check"></i>
                                                            </span>
                                                        </button>
                                                    </form>
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

    <script>
        function confirmReturn(transactionId) {
            if (confirm('Are you sure you want to complete this transaction?')) {
                document.getElementById('returnForm-' + transactionId).submit();
            }
        }
        document.querySelector('.btn-generate-report').addEventListener('click', function() {
            // Prevent the default behavior (e.g., page reload)
            event.preventDefault();
            
            console.log('Button clicked'); // Debugging
            console.log('URL:', '{{ route('transactions.generatePdf') }}'); // Debugging
            window.location = '{{ route('transactions.generatePdf') }}';
        });
    </script>
 
 </div>
 
 <!-- /.container-fluid -->
 @endsection
 