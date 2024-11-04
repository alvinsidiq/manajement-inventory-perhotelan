@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    <div class="container">
        <h1>Transactions</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">Add Transaction</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Transaction Type</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Handled By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->transaction_type }}</td>
                        <td>{{ $transaction->item->name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ $transaction->transaction_date }}</td>
                        <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                        <!-- Menampilkan nama pengguna yang menangani transaksi -->
                        <td>
                            <a href="{{ route('transactions.show', $transaction->transaction_id) }}"
                                class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the transaction for item <strong id="itemName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="{{ route('transactions.destroy', 0) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(transactionId, itemName) {
            // Set action URL untuk form delete berdasarkan ID transaksi
            let form = document.getElementById('deleteForm');
            form.action = '{{ route('transactions.destroy', ':id') }}'.replace(':id', transactionId);

            // Tampilkan nama item di modal
            document.getElementById('itemName').textContent = itemName;

            // Tampilkan modal
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endsection
