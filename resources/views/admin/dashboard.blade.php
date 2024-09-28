@extends('layout.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 text-center" style="font-size: 2.5rem;">Admin Dashboard</h2>

    <div class="row">
        <!-- Card 1: Total Users -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-white bg-primary h-100 shadow-lg">
                <div class="card-header text-center font-weight-bold" style="font-size: 1.25rem;">
                    Total Users
                </div>
                <div class="card-body">
                    <h5 class="card-title display-4" style="font-size: 2.5rem;">{{ $totalUsers }}</h5>
                    <p class="card-text">Registered users on the platform</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Booked Rooms -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-white bg-success h-100 shadow-lg">
                <div class="card-header text-center font-weight-bold" style="font-size: 1.25rem;">
                    Currently Booked Rooms
                </div>
                <div class="card-body">
                    <h5 class="card-title display-4" style="font-size: 2.5rem;">{{ $currentBookedRooms->count() }}</h5>
                    <p class="card-text">Total currently booked rooms</p>
                </div>
            </div>
        </div>

        <!-- Card 3: Available Rooms -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-white bg-warning h-100 shadow-lg">
                <div class="card-header text-center font-weight-bold" style="font-size: 1.25rem;">
                    Available Rooms
                </div>
                <div class="card-body">
                    <h5 class="card-title display-4" style="font-size: 2.5rem;">{{ $availableRooms }}</h5>
                    <p class="card-text">Rooms available for booking</p>
                </div>
            </div>
        </div>

        <!-- Card 4: Transactions -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-white bg-danger h-100 shadow-lg">
                <div class="card-header text-center font-weight-bold" style="font-size: 1.25rem;">
                    Transactions
                </div>
                <div class="card-body">
                    <h6> Rs.</h6>
                    <h5 class="card-title display-4" style="font-size: 2.5rem;">
                       {{ number_format($totalRevenue) }}
                    </h5>
                    <p class="card-text">Total revenue this month</p>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <!-- Booked Rooms Table -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header font-weight-bold">
                    Booked Rooms in the Last 7 Days
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S.N</th>
                                <th scope="col">Guest Name</th>
                                <th scope="col">Check-in Date</th>
                                <th scope="col">Check-out Date</th>
                                <th scope="col">Room Type</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($last7DaysBookedRooms as $key => $RoomBook)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $RoomBook->name }}</td>
                                    <td>{{ $RoomBook->checkin }}</td>
                                    <td>{{ $RoomBook->checkout }}</td>
                                    <td>{{ $RoomBook->roomtype }}</td>
                                    <td>{{ $RoomBook->transaction->payment_method ?? '-' }}</td>
                                    <td>{{ $RoomBook->transaction->amount }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No bookings available in the last 7 days.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- Canceled Rooms Table -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card shadow-lg">
            <div class="card-header font-weight-bold">
                Canceled Rooms in the Last Month
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Guest Name</th>
                            <th scope="col">Check-in Date</th>
                            <th scope="col">Check-out Date</th>
                            <th scope="col">Room Type</th>
                            <th scope="col">Cancellation Date</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($canceledRooms as $key => $RoomBook)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $RoomBook->name }}</td>
                                <td>{{ $RoomBook->checkin }}</td>
                                <td>{{ $RoomBook->checkout }}</td>
                                <td>{{ $RoomBook->roomtype }}</td>
                                <td>{{ $RoomBook->updated_at }}</td> <!-- Assuming this is the cancellation date -->
                                <td>{{ $RoomBook->transaction->payment_method ?? '-' }}</td>
                                <td>{{ $RoomBook->transaction->amount }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No canceled bookings available in the last month.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Inline CSS for styling -->
<style>
    /* Card and General Layout Styling */
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .card {
        min-height: 150px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
    }

    .card-header {
        font-size: 1.25rem;
        text-align: center;
        font-weight: bold;
    }

    .card-title {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .card-text {
        font-size: 1rem;
    }

    .container-fluid {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    /* Booked Table Styling */
    .table {
        font-family: Arial, sans-serif;
        font-size: 1.1rem;
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead th {
        background-color: #e0f7fa; /* Light blue color */
        color: #000; /* Text color, adjust as needed */
    }

    .table tbody tr:nth-child(odd) {
        background-color: #e9ecef;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .table td, .table th {
        padding: 16px;
        text-align: center;
        vertical-align: middle;
    }

    /* Remove Zoom Effect */
    .card, .card:hover {
        transform: none;
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .card {
            min-height: 200px;
        }

        .card-title {
            font-size: 2rem;
        }

        .card-text {
            font-size: 0.9rem;
        }

        .container-fluid {
            padding: 10px;
        }

        .table td, .table th {
            padding: 12px;
        }
    }
</style>

@endsection
