@extends('layout.admin')

@section('title', 'Transactions')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Transactions</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">S.N</th>
                        <th style="text-align: center; vertical-align: middle;">Room Type</th>
                        <th style="text-align: center; vertical-align: middle;">Payment ID</th>
                        <th style="text-align: center; vertical-align: middle;">Payment Method</th>
                        <th style="text-align: center; vertical-align: middle;">Amount</th>
                        <th style="text-align: center; vertical-align: middle;">Payment Status</th>
                        <th style="text-align: center; vertical-align: middle;">Room Status</th>
                        <th style="text-align: center; vertical-align: middle;">View</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $key => $transaction)
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">{{ ++$key }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $transaction->roombook->roomtype }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $transaction->pidx }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $transaction->payment_method }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ number_format($transaction->amount, 2) }}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                @if ($transaction->payment_status == 'success' || $transaction->payment_status == 'cash')
                                    <label class="badge badge-success" style="color: white;">
                                        {{ $transaction->payment_status }}
                                    </label>
                                @elseif($transaction->payment_status == 'pending')
                                    <label class="badge badge-danger" style="color: white;">
                                        {{ $transaction->payment_status }}
                                    </label>
                                @else
                                    {{ $transaction->payment_status }}
                                @endif
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                @if ($transaction->roombook->room_status == 'booked')
                                    <label class="badge bg-info" style="color: white;">Booked</label>
                                @elseif($transaction->roombook->room_status == 'cancel')
                                    <label class="badge bg-danger" style="color: white;">Canceled</label>
                                @else
                                    <label class="badge bg-success" style="color: white;">
                                        {{ $transaction->roombook->room_status }}
                                    </label>
                                @endif
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm" title="show">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" style="text-align: center; vertical-align: middle;">No Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
