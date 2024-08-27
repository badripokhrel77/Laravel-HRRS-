@extends('layout.main')
@section('title', 'Reservation Details')
@section('content')

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center">Reservation Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Full Name:</h5>
                    <p>{{ $roombook->name }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Phone Number:</h5>
                    <p>{{ $roombook->phone }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Check-In Date:</h5>
                    <p>{{ $roombook->checkin }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Check-Out Date:</h5>
                    <p>{{ $roombook->checkout }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Room Type:</h5>
                    <p>{{ $roombook->roomtype }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Room Number:</h5>
                    <p>{{ $roombook->roomno }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Number of Guests:</h5>
                    <p>{{ $roombook->guestn }}</p>
                </div>
                <div class="col-md-12">
                    <h5>Special Requests:</h5>
                    <p>{{ $roombook->message }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
