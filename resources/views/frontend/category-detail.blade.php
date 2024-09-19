@extends('layout.main')
@section('content')

<div class="back_re">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>{{ $category->title }}</h2>
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
                    <p class="margin_0">Enjoy a restful stay in our well-appointed rooms, designed for comfort and relaxation. Choose from a variety of options to suit your needs.</p>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($rooms as $room)
                @if($room->room_status !== 'booked') <!-- Check if the room is not booked -->
                    <div class="col-md-4 col-sm-6">
                        <div id="serv_hover" class="room">
                            <div class="room_img">
                                <figure><img src="{{ asset($room->image) }}" alt="#" /></figure>
                            </div>
                            <div class="bed_room">
                                <h3>{{ $room->name }}</h3>
                                <div class="room_price text-center">
                                    <h4 class="text-primary" style="font-weight: bold;">Rs.{{ $room->price }}/night</h4>
                                    
                                    <p id="about-text-{{ $room->id }}" class="text-collapsed">{{ $room->description }}
                                        <a id="read-more-{{ $room->id }}" href="javascript:void(0)" onclick="toggleText({{ $room->id }})">
                                            Read More....
                                        </a>
                                    </p>
                                    <button class="btn btn-outline-primary" style="margin-top: 5px;">
                                        <a href="{{ url('book', ['room' => $room->id]) }}" class="text-primary">Book Now</a>
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
                @else
                {{-- if room is booked --}}
                    <div class="col-md-4 col-sm-6">
                        <div id="serv_hover" class="room">
                            <div class="room_img">
                                <figure><img src="{{ asset($room->image) }}" alt="#" /></figure>
                            </div>
                            <div class="bed_room">
                                <h3>{{ $room->name }} (Booked Room)</h3>
                                <div class="room_price text-center">
                                    <h4 class="text-danger" style="font-weight: bold;">Rs.{{ $room->price }}/night</h4>
                                    <p class="text-danger" style="font-weight: bold;">This room is currently booked.</p>
                                    <!-- Optionally hide or disable the booking button for booked rooms -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach

        </div>
    </div>
</div>
<script>
    function toggleText(roomId) {
        var textElement = document.getElementById('about-text-' + roomId);
        var linkElement = document.getElementById('read-more-' + roomId);

        if (textElement.classList.contains('text-collapsed')) {
            textElement.classList.remove('text-collapsed');
            linkElement.textContent = 'Read Less';
        } else {
            textElement.classList.add('text-collapsed');
            linkElement.textContent = 'Read More';
        }
    }
</script>

<!-- end our_room -->


{{-- <div class="back_re">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>{{ $category->title }}</h2>
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
                            <h3>{{ $room->name }}</h3>
                            <div class="room_price text-center">
                                <h4 class="text-primary" style="font-weight: bold;">Rs.{{ $room->price }}/night</h4>
                                
                                <p id="about-text" class="text-collapsed">{{ $room->description }}
                                    <a id="read-more" href="javascript:void(0)" onclick="toggleText()">
                                        Read More....
                                    </a>
                                </p>
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
<script>
    function toggleText() {
        var textElement = document.getElementById('about-text');
        var linkElement = document.getElementById('read-more');

        if (textElement.classList.contains('text-collapsed')) {
            textElement.classList.remove('text-collapsed');
            linkElement.textContent = 'Read Less';
        } else {
            textElement.classList.add('text-collapsed');
            linkElement.textContent = 'Read More';
        }
    }
</script>

<!-- end our_room --> --}}
@endsection