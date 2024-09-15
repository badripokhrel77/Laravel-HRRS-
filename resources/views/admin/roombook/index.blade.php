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
    <h1 class="mb-0">Booking List</h1>
    <!-- Add search form -->
    <form action="{{ route('roombook.index') }}" method="GET" class="d-flex">
        <!-- Smaller search input box -->
        <input type="text" name="search" class="form-control me-2" style="width: 200px;" placeholder="Search by name or room number" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<!-- Wrap the table inside a responsive container -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr style="background-color: rgb(107, 177, 224); color: rgb(7, 0, 0); font-weight: bold;">
                <th>SN</th>
                <th>Full Name</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Room Type</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roombook as $key => $RoomBook)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $RoomBook->name }}</td>
                    
                    <td>{{ $RoomBook->checkin }}</td>
                    <td>{{ $RoomBook->checkout }}</td>
                    <td>{{ $RoomBook->roomtype }}</td>
                    <td>
                        <!-- Display status badge -->
                        @if($RoomBook->status == 'pending')
                            <label class="badge badge-danger">Pending</label>
                        @else
                            <label class="badge badge-success">{{ $RoomBook->status }}</label>
                        @endif
                    </td>
                    <td>
                        <label class="badge badge-info">{{ $RoomBook->room_status }}</label>
                    </td>
                    <td>
                        <ul style="list-style: none; padding-left: 0; margin-bottom: 0;">
                            <!-- View icon -->
                            <li style="display: inline-block;">
                                <a href="{{ route('roombook.show', $RoomBook->id) }}" class="btn btn-info btn-sm" title="show">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </li>
                            <!-- Edit icon -->
                            <li style="display: inline-block;">
                                <a href="{{ route('roombook.edit', $RoomBook->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                            </li>
                            <!-- Delete icon -->
                            <li style="display: inline-block;">
                                <form action="{{ route('roombook.destroy', $RoomBook->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
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
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($roombook->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $roombook->previousPageUrl() }}" aria-label="Previous">Previous</a>
                </li>
            @endif

            @for ($i = 1; $i <= $roombook->lastPage(); $i++)
                <li class="page-item {{ $i == $roombook->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $roombook->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($roombook->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $roombook->nextPageUrl() }}" aria-label="Next">Next</a>
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
