@extends('layout.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 text-center">Admin Dashboard</h2>

    <div class="row">
        <!-- Card 1: Total Users -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">150</h5>
                    <p class="card-text">Registered users on the platform</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Booked Rooms -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-header">Booked Rooms</div>
                <div class="card-body">
                    <h5 class="card-title">120</h5>
                    <p class="card-text">Rooms booked in the last 30 days</p>
                </div>
            </div>
        </div>

        <!-- Card 3: Available Rooms -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-header">Available Rooms</div>
                <div class="card-body">
                    <h5 class="card-title">25</h5>
                    <p class="card-text">Rooms available for booking</p>
                </div>
            </div>
        </div>

        <!-- Card 4: Transactions -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card text-white bg-danger h-100">
                <div class="card-header">Transactions</div>
                <div class="card-body">
                    <h5 class="card-title">$12,300</h5>
                    <p class="card-text">Total revenue this month</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="row">
        <div class="col-12">
            <div class="activity-card mt-4 border rounded shadow-sm">
                <div class="activity-card-header bg-light p-3">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">User John booked a Deluxe Room on 08/09/2024</li>
                    <li class="list-group-item">User Sarah checked out from a Standard Room</li>
                    <li class="list-group-item">Admin updated the Room Category list</li>
                    <li class="list-group-item">Transaction of $300 processed by User Alex</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Add some inline CSS to control card heights and zoom-in effect -->
<style>
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .card {
        min-height: 150px;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05); /* Slight zoom-in effect */
        transition: transform 0.3s ease-in-out; /* Smooth transition */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional: Add shadow for focus effect */
    }

    /* Recent Activity Styling */
    .activity-card {
        max-height: 400px;
        overflow-y: auto;
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .card {
            min-height: 200px;
        }

        h5.card-title {
            font-size: 1.25rem; /* Adjust font size on smaller screens */
        }

        .card-text {
            font-size: 0.9rem;
        }

        /* Ensure padding for smaller screens */
        .container-fluid {
            padding: 10px;
        }
    }
</style>
@endsection
