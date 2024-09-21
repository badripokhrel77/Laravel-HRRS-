@extends('layout.admin')
@section('content')

<style>
    .room-form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .room-form .form-group {
        margin-bottom: 15px;
    }

    .room-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .room-form input.form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .room-form .form-control[type="file"] {
        padding: 0px;
    }

    .room-form .btn-submit {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff;
        color: #fff;
        text-align: center;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .room-form .btn-submit:hover {
        background-color: #0056b3;
    }
</style>

<div style="text-align: center; margin-bottom: 20px;">
    <h1 style="color: darkblue;">Booked Room Update Section</h1>
</div>

<div class="room-form-container">
    <h1>Edit Booked Detail</h1>

    <form action="{{ route('roombook.update', $roomBook->id) }}" method="POST" class="room-form" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $roomBook->name) }}" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone', $roomBook->phone) }}" class="form-control" required>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="checkin">Check In Date</label>
            <input type="date" id="checkin" name="checkin" value="{{ old('checkin', $roomBook->checkin) }}" class="form-control" required>
            @error('checkin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="checkout">Check Out Date</label>
            <input type="date" id="checkout" name="checkout" value="{{ old('checkout', $roomBook->checkout) }}" class="form-control" required>
            @error('checkout')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="guestn">Guest Number</label>
            <input type="number" id="guestn" name="guestn" value="{{ old('guestn', $roomBook->guestn) }}" class="form-control" required>
            @error('guestn')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Change Payment Status</label>
            <select id="status" name="status" @if($roomBook->transaction->payment_status == 'online') disabled  @endif   class="form-control">
                <option value="pending" {{ $roomBook->transaction->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="cash" {{ $roomBook->transaction->payment_status == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="online" disabled {{ $roomBook->transaction->payment_status == 'online' ? 'selected' : '' }}>Online</option>
            </select>
            @error('room_status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="room_status">Choose Option</label>
            <select id="room_status" name="room_status" class="form-control" required>
                <option value="" disabled {{ old('room_status', $roomBook->room_status) == null ? 'selected' : '' }}>-- Select an Option --</option>
                <option value="booked" {{ old('room_status', $roomBook->room_status) == 'booked' ? 'selected' : '' }}>Booked</option>
                <option value="check-out" {{ old('room_status', $roomBook->room_status) == 'check-out' ? 'selected' : '' }}>Check Out</option>
                <option value="cancel" {{ old('room_status', $roomBook->room_status) == 'cancel' ? 'selected' : '' }}>Canceled</option>
            </select>
            @error('room_status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        

        <div class="form-group">
            <button type="submit" class="btn-submit">Update</button>
        </div>
    </form>
</div>
@endsection
