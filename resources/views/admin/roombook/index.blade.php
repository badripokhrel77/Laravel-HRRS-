@extends('layout.admin')
@section('content')
<style>
    .badge,
    .btn {
        font-size: 12px; /* Adjust to the size you need */
        padding: 0.375rem 0.5625rem; /* Adjust padding to match */
        border-radius: 0; /* Ensure consistent border radius */
    }

    .badge {
        line-height: 1; /* Align text properly */
    }

    .btn {
        line-height: 1; /* Align text properly */
    }

    .btn i {
        margin-right: 0; /* Optional: Remove margin if needed */
    }
</style>

@if (session()->has('success'))
    <div class="alert bg-success">{{ session()->get('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Booking List</h1>
</div>

<!-- Wrap the table inside a responsive container -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr style="background-color: rgb(107, 177, 224); color: rgb(7, 0, 0); font-weight: bold;">
                <th>SN</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Room Type</th>
                <th>Room No.</th>
                <th>Guest No.</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roombook as $key => $RoomBook)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $RoomBook->name }}</td>
                    <td>{{ $RoomBook->phone }}</td>
                    <td>{{ $RoomBook->checkin }}</td>
                    <td>{{ $RoomBook->checkout }}</td>
                    <td>{{ $RoomBook->roomtype }}</td>
                    <td>{{ $RoomBook->roomno }}</td>
                    <td>{{ $RoomBook->guestn }}</td>
                    <td>{{ $RoomBook->message }}</td>
                    <td>
                        <!-- Display status badge -->
                        @if($RoomBook->status == 'pending')
                            <label class="badge badge-danger">Pending</label>
                        @else
                            <label class="badge badge-success">{{ $RoomBook->status }}</label>
                        @endif
                    </td>
                    <td>
                        <ul style="list-style: none; padding-left: 0; margin-bottom: 0;">
                            <li style="display: inline-block;">
                                <a href="{{ route('userinfo.edit', $RoomBook->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                            </li>
                            <li style="display: inline-block;">
                                <form action="{{ route('roombook.destroy', $RoomBook->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="text-align: center">No Data Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $roombook->links() }}
</div>
@endsection
