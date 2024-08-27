@extends('layout.admin')
@section('content')
    @if (session()->has('success'))
        <div class="alert bg-success">{{ session()->get('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Room List</h1>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a>
    </div>

    <table class="table">
        <tr style="background-color: rgb(236, 229, 229); color: rgb(7, 0, 0); font-weight: bold;">

            <th>SN</th>
            <th>Room Name</th>
            <th>Price</th>
            <th>Image</th>
            <Th>Description</Th>
            <th>Action</th>
        </tr>
        @forelse ($rooms as $key => $room)
            <tr>
                <td>{{ ++$key }}</td>
                <th>{{ $room->name }}</th>
                <th>{{ $room->price }}</th>
                <th><a target="_blank" href="{{ asset($room->image) }}"><img src="{{ asset($room->image) }}" alt="Room Image"
                            style="height: 60px; width: auto;">
                    </a></th>
                <th>{{ $room->description }}</th>
                <th>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                   
                    {{-- <a href="{{ route('rooms.index', $room->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display: inline;">
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
        {{ $rooms->links() }}
    </div>
@endsection
