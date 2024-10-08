@extends('layout.main')
@section('title', 'Reservation Details')

@section('content')
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-center align-items-center"
            style="background-color: rgb(167, 189, 193); min-height: 100vh; padding: 20px;">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="card shadow-lg mb-4" style="border: none;">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4" style="color: rgb(2, 9, 71);">Reservation Details</h2>

                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session()->get('success') }}</div>
                        @endif

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
                                <p class="mb-0 font-weight-bold" style="color: #003366;">Room Status:</p>
                            </div>
                            <div class="col-sm-8">
                                @if ($book->room_status == 'booked')
                                    <label class="badge bg-info" style="color: white;">Booked</label>
                                @elseif($book->room_status == 'cancel')
                                    <label class="badge bg-danger" style="color: white;">Canceled</label>
                                @else
                                    <label class="badge bg-success" style="color: white;">{{ $book->room_status }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <p class="mb-0 font-weight-bold" style="color: rgb(2, 9, 71); font-size: 16px;">Special
                                    Request:</p>
                            </div>
                            <div class="col-sm-8">
                                <div class="alert alert-info" role="alert" style="font-size: 15px;">
                                    {{ $book->message ? $book->message : 'No special requests made.' }}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <hr>


                        {{-- Payment Details Section --}}
                        <h2 class="text-center mb-4" style="color: rgb(2, 9, 71);">Payment Details</h2>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <p class="mb-0 font-weight-bold" style="color: #003366;">Payment Method:</p>
                            </div>
                            <div class="col-sm-8">
                                
                                @if ($book->room_status == 'cancel')
                                    {{ $book->transaction->payment_method = '-' }}
                                @else
                                    {{ $book->transaction->payment_method }}
                                @endif

                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <p class="mb-0 font-weight-bold" style="color: #003366;">Amount:</p>
                            </div>
                            <div class="col-sm-8">
                                
                                @if ($book->room_status == 'cancel')
                                    {{ $book->transaction->amount = '-' }}
                                @else
                                    {{ $book->transaction->amount }}
                                @endif
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <p class="mb-0 font-weight-bold" style="color: #003366;">Payment Status:</p>
                            </div>
                            <div class="col-sm-8">


                                @if ($book->transaction->payment_status == 'success' || $book->transaction->payment_status == 'cash')
                                    <label class="badge badge-success" style="color: white;">
                                        {{ $book->transaction->payment_status }}
                                    </label>
                                @elseif($book->transaction->payment_status == 'pending')
                                    <label class="badge badge-danger" style="color: white;">
                                        {{ $book->transaction->payment_status }}
                                    </label>
                                @else
                                    {{ $book->transaction->payment_status }}
                                @endif

                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
