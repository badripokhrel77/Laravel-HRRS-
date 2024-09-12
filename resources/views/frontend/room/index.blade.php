@extends('layout.main')
@section('title', 'Rooms')
@section('content')
    <div class="back_re">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Rooms Category</h2>
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
                        {{-- <h2>Room Categories</h2> --}}
                        <p>Enjoy a restful stay in our well-appointed rooms, designed for comfort and relaxation. Choose
                            from a variety of options to suit your needs.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-4 col-sm-6">
                        <div id="serv_hover" class="room">
                            <div class="room_img">

                                <figure><img src="{{ asset($category->image) }}" alt="#" /></figure>
                            </div>
                            <div class="bed_room">
                                <h3>{{ $category->title }}</h3>
                                <div class="room_price text-center">
                                    <p>{{ $category->description }}</p>
                                    <button class="btn btn-outline-primary" style="margin-top: 5px;">
                                        <a href="{{ url('category',$category->id) }}" class="text-primary" style="color: inherit; text-decoration: none;">Show Details</a>
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
    {{-- <div class="our_room">
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
                                <h4>{{ $room->category->title }}</h4>
                                <h3>{{ $room->name }}</h3>
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
    </div> --}}
    
    <!-- end our_room -->
@endsection
