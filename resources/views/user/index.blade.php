@extends('layout.user')

@section('title', 'My Reservations')

@section('content')
<div class="container">
    <h1 class="mb-4">My Reservations</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Payment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $key => $booking)
            <tr>
                <td class="text-center">{{ ++$key }}</td>
                <td class="text-center">{{ $booking->name }}</td>
                <td class="text-center">{{ $booking->checkin }}</td>
                <td class="text-center">{{ $booking->checkout }}</td>
                <td>
                    <label class="badge 
                        @if($booking->transaction->payment_status == 'success' || $booking->transaction->payment_status == 'cash') 
                            badge-success 
                        @else 
                            badge-danger 
                        @endif" 
                        style="color: white;">
                        {{ $booking->transaction->payment_status }}
                    </label>
                </td>
                <td class="text-center">
                    @if($booking->transaction->payment_status != 'success' && $booking->transaction->payment_status != 'cash')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal" data-booking-id="{{ $booking->id }}">
                            Cancel
                        </button>
                    @endif
                    <a href="{{ route('bookview', $booking->id) }}" class="btn btn-primary">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap Modal for Cancellation Confirmation -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Confirm Cancellation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this reservation?
            </div>
            <div class="modal-footer">
                <form id="cancelForm" action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes, Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Inline CSS for styling -->
<style>
    .text-center {
        text-align: center;
    }

    table {
        width: 100%;
        margin-top: 20px;
    }

    th, td {
        text-align: center;
    }

    .badge {
        display: inline-block;
        padding: 0.5em 1em;
        font-size: 0.875em;
        font-weight: 700;
        text-align: center;
        white-space: nowrap;
        border-radius: 0.25rem;
    }

    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .badge-success {
        background-color: #28a745;
        color: #fff;
    }

    .btn-danger {
        margin-left: 5px;
    }
</style>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    var cancelModal = document.getElementById('cancelModal');
    cancelModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var bookingId = button.getAttribute('data-booking-id'); // Extract info from data-* attributes

        var form = cancelModal.querySelector('#cancelForm');
        form.action = '/booking/' + bookingId + '/cancel'; // Update form action
    });
</script>

@endsection
