@extends('layout.user')
@section('title', 'Reservation Details')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="background-color: rgb(167, 189, 193); height: 100vh;">
    @if (session()->has('success'))
        <div class="alert bg-success">{{ session()->get('success') }}</div>
    @endif
    <div class="col-lg-8">
        <div class="card mb-4" style="border: 1px solid rgb(2, 9, 71);">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Field</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Full Name</td>
                            <td>{{ $book->name }}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>{{ $book->phone }}</td>
                        </tr>
                        <tr>
                            <td>Check In Date</td>
                            <td>{{ $book->checkin }}</td>
                        </tr>
                        <tr>
                            <td>Check Out Date</td>
                            <td>{{ $book->checkout }}</td>
                        </tr>
                        <tr>
                            <td>Room Type</td>
                            <td>{{ $book->roomtype }}</td>
                        </tr>
                        <tr>
                            <td>Room Name</td>
                            <td>{{ $book->roomno }}</td>
                        </tr>
                        <tr>
                            <td>Number of Guests</td>
                            <td>{{ $book->guestn }}</td>
                        </tr>
                        <tr>
                            <td>Special Request</td>
                            <td>{{ $book->message }}</td>
                        </tr>
                        <tr>
                            <td>Payment Status</td>
                            <td>
                                @if($book->status == 'pending')
                                    <label class="badge badge-danger">Pending</label>
                                @else
                                    <label class="badge badge-success">{{ $book->status }}</label>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
