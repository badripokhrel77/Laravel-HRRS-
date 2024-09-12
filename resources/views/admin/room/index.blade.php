@extends('layout.admin')
@section('content')
<style>
    .badge {
        font-size: 12px; /* Keep badge size smaller */
        padding: 0.375rem 0.5625rem; /* Adjust padding */
        border-radius: 0; /* Ensure consistent border radius */
        line-height: 1; /* Align text properly */
    }

    .btn-action {
        font-size: 12px; /* Adjust action buttons only */
        padding: 0.375rem 0.5625rem; /* Adjust padding */
        border-radius: 0; /* Ensure consistent border radius */
        line-height: 1; /* Align text properly */
    }

    .btn-action i {
        margin-right: 0; /* Remove margin for action button icons */
    }
</style>

@if (session()->has('success'))
    <div class="alert bg-success">{{ session()->get('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Room List</h1>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a>
</div>

<!-- Wrap the table inside a responsive container -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr style="background-color: rgb(107, 177, 224); color: rgb(7, 0, 0); font-weight: bold;">
                <th>SN</th>
                <th>Category</th>
                <th>Room Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $key => $room)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $room->category->title ?? '-' }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->price }}</td>
                    <td>
                        <a target="_blank" href="{{ asset($room->image) }}">
                            <img src="{{ asset($room->image) }}" alt="Room Image" style="height: 60px; width: auto;">
                        </a>
                    </td>
                    <td>{{ $room->description }}</td>
                    <td>
                        <ul style="list-style: none; padding-left: 0; margin-bottom: 0;">
                            <li style="display: inline-block;">
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary  btn-sm btn-action">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                            </li>
                            <li style="display: inline-block;">
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center">No Data Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $rooms->links() }}
</div>
@endsection
