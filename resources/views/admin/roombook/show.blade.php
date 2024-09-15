@extends('layout.admin')
@section('title', 'Reservation Details')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="background-color: #f0f2f5; height: 100vh; padding: 20px;">
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif

    <div class="col-lg-8">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <h4 class="text-center mb-4" style="color: #003366;">Reservation Details</h4>
                
                @php
                    $fields = [
                        'Full Name' => $roomBook->name,
                        'Phone Number' => $roomBook->phone,
                        'Check In Date' => $roomBook->checkin,
                        'Check Out Date' => $roomBook->checkout,
                        'Room Type' => $roomBook->roomtype,
                        'Room Name' => $roomBook->roomno,
                        'Number of Guests' => $roomBook->guestn,
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
                @endforeach

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="mb-0 font-weight-bold" style="color: #003366;">Special Request:</p>
                    </div>
                    <div class="col-sm-8">
                        <div class="alert alert-info" role="alert">
                            {{ $roomBook->message }}
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="mb-0 font-weight-bold" style="color: #003366;">Payment Status:</p>
                    </div>
                    <div class="col-sm-8">
                        <span class="badge badge-{{ $roomBook->status == 'pending' ? 'danger' : 'success' }} p-2">
                            {{ ucfirst($roomBook->status) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('roombook.index') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
