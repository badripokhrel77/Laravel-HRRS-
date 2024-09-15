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

    .pagination .page-item.disabled .page-link {
        pointer-events: none;
    }

    .pagination .page-item.active .page-link {
        background-color: rgb(107, 177, 224);
        border-color: rgb(107, 177, 224);
        color: rgb(7, 0, 0);
    }
</style>

@if (session()->has('success'))
    <div class="alert bg-success">{{ session()->get('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Room List</h1>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a>
</div>

<!-- Add search form -->
<div class="mb-3 d-flex justify-content-end">
    <form action="{{ route('rooms.index') }}" method="GET" class="d-flex">
        <!-- Single search input box -->
        <input type="text" name="search" class="form-control me-2" style="width: 300px;" placeholder="Search by name or category" value="{{ request('search') }}">

        <button type="submit" class="btn btn-primary">Search</button>
    </form>
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
                <th>Status</th>
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
                        <label class="badge badge-success">Available</label>
                    </td>
                    <td>
                        <ul style="list-style: none; padding-left: 0; margin-bottom: 0;">
                            <li style="display: inline-block;">
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary btn-sm btn-action">
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
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($rooms->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $rooms->previousPageUrl() }}" aria-label="Previous">Previous</a>
                </li>
            @endif

            @for ($i = 1; $i <= $rooms->lastPage(); $i++)
                <li class="page-item {{ $i == $rooms->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $rooms->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($rooms->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $rooms->nextPageUrl() }}" aria-label="Next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>

@endsection