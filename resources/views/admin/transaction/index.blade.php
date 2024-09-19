@extends('layout.admin')

@section('title', 'Transactions')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Transactions</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Room Type</th>
                        <th>Payment ID</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th>view</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $key => $transaction)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $transaction->roombook->roomtype }}</td>
                            <td>{{ $transaction->pidx }}</td>
                            <td>{{ $transaction->payment_method }}</td>
                            <td>{{ number_format($transaction->amount, 2) }}</td>
                            <td>
                                <label
                                    class="badge @if ($transaction->payment_status == 'success' || $transaction->payment_status == 'cash') badge-success 
                            @else badge-danger @endif"
                                    style="color: white;">
                                    {{ $transaction->payment_status }}
                                </label>
                            </td>
                            <td>
                                <div style="display: inline-block;">
                                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm" title="show">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="11" style="text-align: center">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @push('styles')
            <style>
                .badge {
                    display: inline-block;
                    padding: 0.5em 1em;
                    font-size: 0.875em;
                    font-weight: 700;
                    text-align: center;
                    white-space: nowrap;
                    border-radius: 0.25rem;
                }

                .badge.bg-danger {
                    background-color: #dc3545;
                    color: #fff;
                }

                .badge.bg-success {
                    background-color: #28a745;
                    color: #fff;
                }

                /* Table styling */
                table {
                    width: 100%;
                    margin-top: 20px;
                }

                th,
                td {
                    text-align: center;
                    /* Center horizontally */
                    vertical-align: middle;
                    /* Center vertically */
                }
            </style>
        @endpush

    @endsection
