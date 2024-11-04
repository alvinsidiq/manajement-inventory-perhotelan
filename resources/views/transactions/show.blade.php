@extends('layouts.app')

@section('title', 'Transaction Details')

@section('content')
<div class="container">
    <h1>Transaction Details</h1>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary mb-3">Back to Transactions</a>

    <div class="card">
        <div class="card-header">
            Transaction #{{ $transaction->transaction_id }}
        </div>
        <div class="card-body">
            <p><strong>Transaction Type:</strong> {{ $transaction->transaction_type }}</p>
            <p><strong>Item:</strong> {{ $transaction->item->name }}</p>
            <p><strong>Quantity:</strong> {{ $transaction->quantity }}</p>
            <p><strong>Date:</strong> {{ $transaction->transaction_date }}</p>
            <p><strong>Handled By:</strong> {{ $transaction->user->name ?? 'N/A' }}</p>
        </div>
    </div>
</div>
@endsection
