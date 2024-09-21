@extends('layout.admin')

@section('title', 'Reservation Details')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-center align-items-center" style="background-color: #f0f2f5; min-height: 100vh; padding: 20px;">
        <div class="col-lg-10 col-md-12 col-sm-12">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4" style="color: #003366;">Transaction Details</h4>
                    
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                    @endif

                    {{-- @php
                        $fields = [
                            'Full Name' => $transaction->roomBook->name,
                            'Room Name' => $transaction->roomBook->roomno,
                          
                        ];
                    @endphp

                    @foreach ($fields as $label => $value)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <p class="mb-0 font-weight-bold" style="color: #003366;">{{ $label }}:</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">{{ $value }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                    @endforeach --}}
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0 font-weight-bold" style="color: #003366;">Full Name:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ $transaction->roomBook->name}}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0 font-weight-bold" style="color: #003366;">Room:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ $transaction->roomBook->roomno}}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0 font-weight-bold" style="color: #003366;">Room Type:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ $transaction->roomBook->roomtype}}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0 font-weight-bold" style="color: #003366;">Payment ID:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ $transaction->pidx ?? '-'}}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0 font-weight-bold" style="color: #003366;">Payment Method:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ $transaction->payment_method ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0 font-weight-bold" style="color: #003366;">Amount:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ number_format($transaction->amount ?? 0, 2) }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0 font-weight-bold" style="color: #003366;">Payment Status:</p>
                        </div>
                        <div class="col-sm-8">
                        
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
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('transactions.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
