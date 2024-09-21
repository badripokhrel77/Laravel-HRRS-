@extends('layout.admin')

@section('content')
    <style>
        .badge,
        .btn {
            font-size: 12px;
            padding: 0.375rem 0.5625rem;
            border-radius: 0;
        }

        .badge,
        .btn {
            line-height: 1;
        }

        .btn i {
            margin-right: 0;
        }

        .pagination .page-item.disabled .page-link {
            pointer-events: none;
        }

        .pagination .page-item.active .page-link {
            background-color: rgb(107, 177, 224);
            border-color: rgb(107, 177, 224);
            color: rgb(7, 0, 0);
        }

        /* Centering table content */
        table td {
            text-align: center;
            vertical-align: middle;
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
            <input type="text" name="search" class="form-control me-2" style="width: 200px;"
                placeholder="Search by name or room number" value="{{ request('search') }}">
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
                    <th>Book Type</th>
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
                            {{ $RoomBook->transaction->payment_method }}
                           
                        </td>

                        <td>
                            @if ($RoomBook->transaction->payment_status == 'success' || $RoomBook->transaction->payment_status == 'cash')
                                
                                <label class="badge badge-success" style="color: white;">
                                    {{ $RoomBook->transaction->payment_status }}
                                </label>
                            @elseif($RoomBook->transaction->payment_status == 'pending')
                                <label class="badge badge-danger" style="color: white;">
                                    {{ $RoomBook->transaction->payment_status }}
                                </label>
                            @else
                                {{ $RoomBook->transaction->payment_status }}
                            @endif
                        </td>

                        <td>
                            @if ($RoomBook->room_status == 'booked')
                                <label class="badge bg-info" style="color: white;">Booked</label>
                            @elseif($RoomBook->room_status == 'cancel')
                                <label class="badge bg-danger" style="color: white;">Canceled</label>
                            @else
                                <label class="badge bg-success" style="color: white;">{{ $RoomBook->room_status }}</label>
                            @endif
                        </td>

                        <td>
                            <ul style="list-style: none; padding-left: 0; margin-bottom: 0;">
                                <!-- View icon -->
                                <li style="display: inline-block;">
                                    <a href="{{ route('roombook.show', $RoomBook->id) }}" class="btn btn-info btn-sm"
                                        title="show">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>
                                <!-- Edit icon -->
                                <li style="display: inline-block;">
                                    <a href="{{ route('roombook.edit', $RoomBook->id) }}" class="btn btn-primary btn-sm"
                                        title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                </li>
                                <!-- Delete icon -->
                                <li style="display: inline-block;">
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-form-action="{{ route('roombook.destroy', $RoomBook->id) }}">
                                        <i class="fa fa-times"></i>
                                    </button>
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

    <!-- Bootstrap Modal for Deletion Confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this reservation?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var formAction = button.getAttribute('data-form-action'); // Extract info from data-* attributes

            var form = deleteModal.querySelector('#deleteForm');
            form.action = formAction; // Update form action
        });
    </script>
@endsection
