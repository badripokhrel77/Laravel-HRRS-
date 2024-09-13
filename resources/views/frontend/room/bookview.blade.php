@extends('layout.main')
@section('title', 'Reservation Details')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="background-color: rgb(167, 189, 193); height: 100vh;">
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    <div class="col-lg-8">
        <div class="card shadow-lg mb-4" style="border: none;">
            <div class="card-body p-4">
                <h4 class="text-center mb-4" style="color: rgb(2, 9, 71);">Reservation Details</h4>
                @php
                    $fields = [
                        'Full Name' => $book->name,
                        'Phone Number' => $book->phone,
                        'Check In Date' => $book->checkin,
                        'Check Out Date' => $book->checkout,
                        'Room Type' => $book->roomtype,
                        'Room Name' => $book->roomno,
                        'Number of Guests' => $book->guestn,
                    ];
                @endphp

                @foreach ($fields as $label => $value)
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0 font-weight-bold" style="color: rgb(2, 9, 71);">{{ $label }}:</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">{{ $value }}</p>
                        </div>
                    </div>
                    <hr class="my-2">
                @endforeach

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="mb-0 font-weight-bold" style="color: rgb(2, 9, 71);">Special Request:</p>
                    </div>
                    <div class="col-sm-8">
                        <div class="alert alert-info" role="alert">
                            {{ $book->message }}
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0 font-weight-bold" style="color: rgb(2, 9, 71);">Payment Status:</p>
                    </div>
                    <div class="col-sm-8">
                        <span class="badge badge-{{ $book->status == 'pending' ? 'danger' : 'success' }} p-2">
                            {{ ucfirst($book->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
