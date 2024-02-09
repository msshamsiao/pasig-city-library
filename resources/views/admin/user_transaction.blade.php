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
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Borrower</th>
                                            <th>Book</th>
                                            <th>Date Request</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Borrower</th>
                                            <th>Book</th>
                                            <th>Date Request</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($userTransactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction['borrowerUser']['name'] }}</td>
                                                <td>{{ $transaction['borrowerBook']['title'] }}</td>
                                                <td>{{ (new DateTime($transaction['borrowed_date']))->format('F j, Y') }}</td>
                                                <td>
                                                    @if ( $transaction['status'] == "request")
                                                        <span class="badge badge-warning">
                                                            {{ $transaction['status'] }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success">
                                                            {{ $transaction['status'] }}
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
                                                    <form id="cancelForm-{{ $transaction->id }}" method="POST" action="{{ route('transactions.cancel', ['transactionId' => $transaction->id]) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                
                                                        <button type="button" class="btn btn-danger btn-icon-split btn-cancel" onclick="confirmCancel({{ $transaction->id }})">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-times"></i>
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
            if (confirm('Are you sure you want to return this book?')) {
                document.getElementById('returnForm-' + transactionId).submit();
            }
        }

        function confirmCancel(transactionId) {
            if (confirm('Are you sure you want to cancel this book?')) {
                document.getElementById('cancelForm-' + transactionId).submit();
            }
        }
    </script>
 
 </div>
 
 <!-- /.container-fluid -->
 @endsection
 