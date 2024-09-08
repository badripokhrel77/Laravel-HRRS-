@extends('layout.main')
@section('title', 'Rooms')
@section('content')
    <div class="back_re">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Our Rooms</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- our_room -->
    <div class="our_room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <p class="margin_0">Enjoy a restful stay in our well-appointed rooms, designed for comfort and
                            relaxation. Choose from a variety of options to suit your needs. </p>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($rooms as $room)
                    <div class="col-md-4 col-sm-6">
                        <div id="serv_hover" class="room">
                            <div class="room_img">
                                <figure><img src="{{ asset($room->image) }}" alt="#" /></figure>
                            </div>
                            <div class="bed_room">
                                <h3>{{ $room->name }} Room</h3>
                                <div class="room_price text-center">
                                    <h4 class="text-primary" style="font-weight: bold;">Rs.{{ $room->price }}/night</h4>
                                    <p>{{ $room->description }}</p>
                                    <button class="btn btn-outline-primary" style="margin-top: 5px;">
                                        <a href="{{ url('book', ['room' => $room->id]) }}" class="text-primary">Book
                                            Now</a>
                                    </button>
                                    <style>
                                        .btn:hover .text-primary {
                                            color: white !important;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    
    <!-- end our_room -->
@endsection
