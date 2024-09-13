@extends('layout.user')
@section('title', 'My Reservations')
@section('content')
<div class="container">
    <h1>My Reservations</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>payment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->checkin }}</td>
                <td>{{ $booking->checkout }}</td>
                <td>
                    <!-- Display status badge -->
                    @if($booking->status == 'pending')
                        <label class="badge badge-danger">Pending</label>
                    @else
                        <label class="badge badge-success">{{ $booking->status }}</label>
                    @endif
                </td>
                <td>
                    <a href="{{ route('bookview', $booking->id) }}" class="btn btn-primary">View</a>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
