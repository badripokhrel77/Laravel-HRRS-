@extends('layout.main')
@section('title', 'Booking')

<style>
    .radio-button-group {
        display: flex;
    }

    .radio-button-group .item {
        flex: 1;
        position: relative;

    }

    .radio-button-group .radio-button {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;

    }

    .radio-button-group .radio-button+label {
        padding: 16px 10px;
        cursor: pointer;
        border: 1px solid #CCC;
        margin-right: -2px;
        color: #555;
        background-color: #ffffff;
        text-align: center;
        display: block;
    }

    .radio-button-group .item:first-of-type .radio-button+label {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .radio-button-group .item:last-of-type .radio-button+label {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .radio-button-group .radio-button:checked+label {
        background-color: #1ba0ff;
        color: #FFF;
    }
</style>
@section('content')
        {{-- {{ $room }} --}}
    <div class="container-fluid p-0" style="min-height: 100vh; display: flex; align-items: stretch;">
        <div class="row no-gutters w-100">
            <!-- Form Column -->
            <div class="col-md-6 d-flex justify-content-center align-items-center"
                style="background: linear-gradient(to right, rgb(213, 213, 242), white);">
                <div class="p-4 rounded shadow-lg"
                    style="background-color: rgba(226, 248, 238, 0.9); width: 100%; max-width: 600px;">
                    <h2 class="text-center text-dark mb-4">Hotel Room Booking Form</h2>
                    @if (session()->has('success'))
                        <div class="alert bg-success">{{ session()->get('success') }}</div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form action="{{ url('book') }}" method="post">
                        @csrf
                        <div class="form-group">
                            
                            <input type="hidden" class="form-control" id="room_id" name="room_id"
                                value="{{ $room->id}}">
                        </div>
                        <div class="form-group">
                            <label for="fullName" class="text-dark">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullname"
                                value="{{ $user->f_name }} {{ $user->l_name }}" placeholder="Full Name">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="text-dark">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                value="{{ $user->phone }}" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            
                            <input type="hidden" class="form-control" id="room_id" name="roomtype"
                                value="{{ $room->category->title}}">
                        </div>

                        <div class="form-group">
                            
                            <input type="hidden" class="form-control" id="room_id" name="roomno"
                                value="{{ $room->name}}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="checkIn" class="text-dark">Check-In Date</label>
                                <input type="date" class="form-control" id="checkIn" name="checkin">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="checkOut" class="text-dark">Check-Out Date</label>
                                <input type="date" class="form-control" id="checkOut" name="checkout">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="guests" class="text-dark">Number of Guests</label>
                            <input type="number" class="form-control" id="guests" name="guestn" min="1"
                                max="10">
                        </div>

                        <div class="form-group">
                            <label for="specialRequests" class="text-dark">Special Requests</label>
                            <textarea class="form-control" id="specialRequests" name="message" rows="3" placeholder="Any special requests?"></textarea>
                        </div>
                        <input type="hidden" name="payment_type" id="payment_type" value="cash">
                        <div class="radio-button-group mts">
                            <div class="item">
                                <input type="radio" name="payment_type" class="radio-button" value="cash" id="button1"
                                    checked />
                                <label for="button1">Cash </label>
                            </div>
                            <div class="item">
                                <input type="radio" name="payment_type" class="radio-button" value="online"
                                    id="button2" />
                                <label for="button2">Online Payment</label>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="reset" class="btn btn-danger btn-lg mx-2">Reset</button>
                            <button type="submit" class="cash-section btn btn-primary btn-lg mx-2">Submit</button>
                            <button type="submit" id="payment-button"
                                style="display: none; background-color: #5D2E8E; color: #ffffff; font-size: 16px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"
                                class="online-section btn btn-primary btn-lg mx-2">Pay with Khalti</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Room Details Column -->
            <div class="col-md-6">
                <section style="background-color: #eee;">
                    <div class="container py-5">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div>
                                        <img src="{{ asset($room->image) }}" alt="room"
                                            style="width: 300px; height:180px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0" style="color: rgb(19, 24, 66);">Type</p>
                                            </div>

                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ $room->category->title }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0" style="color: rgb(19, 24, 66);">Room</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{ $room->name }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0" style="color: rgb(19, 24, 66);">Price</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">Rs.{{ $room->price }}/night</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container py-2 h-100">
                                <div class="row d-flex align-items-center h-100">
                                    <div class="col-12 col-xl-12"> <!-- Adjusted the column to take full width -->
                                        <div class="card mb-5" style="border-radius: 15px;">
                                            <div class="card-body p-4"> <!-- Reduced padding for more width -->
                                                <h3 class="mb-1" style="color: rgb(19, 24, 66); font-size: 1.6em;">
                                                    Description</h3>
                                                <p class="small mb-0" style="font-size: 1.2em; color: black;">
                                                    {{ $room->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('.radio-button').click(function() {
        var paymentType = $(this).val();

        // Update the hidden input field value based on selected payment type
        $('#payment_type').val(paymentType);

        if (paymentType == 'online') {
            $('.cash-section').hide();
            $('.online-section').show();
        } else {
            $('.cash-section').show();
            $('.online-section').hide();
        }
    });
</script>
@endsection