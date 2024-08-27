@extends('layout.admin')
@section('content')
    @if (session()->has('success'))
        <div class="alert bg-success">{{ session()->get('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Booking List</h1>
        {{-- <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a> --}}
    </div>

    <table class="table">
        <tr style="background-color: rgb(236, 229, 229); color: rgb(7, 0, 0); font-weight: bold;">

            <th>SN</th>
            <th>Full Name</th>
            <th>phone</th>
            <th>Check In</th>
            <th>Check out</th>
            <Th>Room Type</Th>
            <Th>Room No.</Th>
            <Th>Guest No.</Th>
            <Th>Message</Th>
            <th>Action</th>
        </tr>
        @forelse ($roombook as $key => $RoomBook)
            <tr>
                <td>{{ ++$key }}</td>
                <th>{{ $RoomBook->name }}</th>
                <th>{{ $RoomBook->phone }}</th>
                <th>{{ $RoomBook->checkin}}</th>
                <th>{{ $RoomBook->checkout}}</th>
                <th>{{ $RoomBook->roomtype}}</th>
                <th>{{ $RoomBook->roomno}}</th>
                <th>{{ $RoomBook->guestn}}</th>
                <th>{{ $RoomBook->message}}</th>
                <th>
                    <a href="{{ route('userinfo.edit', $RoomBook->id) }}" class="btn btn-warning btn-sm">Edit</a>
                   
                    {{-- <a href="{{ route('rooms.index', $room->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                    <form action="{{ route('roombook.destroy', $RoomBook->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" > Delete</button>
                    </form>

                </th>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center">No Data Found</td>
            </tr>
        @endforelse
    </table>

    <div class="mt-3">
        {{ $roombook->links() }}
    </div>
@endsection
