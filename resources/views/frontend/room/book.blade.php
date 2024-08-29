@extends('layout.main')
@section('title', 'Booking')

@section('content')

    <div class="container-fluid p-0" style="min-height: 100vh; display: flex; align-items: stretch;">
        <div class="row no-gutters w-100">
            <!-- Form Column -->

            <div class="col-md-6 d-flex justify-content-center align-items-center"
                style="background: linear-gradient(to right, blue, white);">
                <div class="p-4 rounded shadow-lg"
                    style="background-color: rgba(255, 255, 255, 0.9); width: 100%; max-width: 600px;">
                    <h2 class="text-center text-dark mb-4">Hotel Room Booking Form</h2>
                    @if (session()->has('success'))
                        <div class="alert bg-success">{{ session()->get('success') }}</div>
                    @endif

                    <form action="{{ url('book') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="fullName" class="text-dark">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="name"
                                placeholder="Full Name">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="text-dark">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="Phone Number">
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
                            <label for="roomType" class="text-dark">Room Type</label>
                            <select id="roomType" name="roomtype" class="form-control">
                                <option selected>Choose...</option>
                                <option>Single Room</option>
                                <option>Double Room</option>
                                <option>Deluxe Room</option>
                                <option>Family Room</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="roomNumber" class="text-dark">Room Number</label>
                            <select id="roomNumber" name="roomno" class="form-control">
                                <option selected>Available Room...</option>
                                <option>101</option>
                                <option>102</option>
                                <option>103</option>
                                <option>104</option>
                            </select>
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

                        <div class="text-center">
                            <button type="reset" class="btn btn-danger btn-lg mx-2">Reset</button>
                            <button type="submit" class="btn btn-primary btn-lg mx-2">Book Now</button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Images Column -->
            <div class="col-md-6 d-flex flex-column">
                <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                    <div class="border-box p-2"
                        style="border: 2px solid #d1bcbc; border-radius: 8px; overflow: hidden; flex: 1;">
                        <img src="images/banner1.jpg" alt="Photo 1" class="img-fluid"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="border-box p-2 mt-2"
                        style="border: 2px solid #000; border-radius: 8px; overflow: hidden; flex: 1;">
                        <img src="images/banner2.jpg" alt="Photo 2" class="img-fluid"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
