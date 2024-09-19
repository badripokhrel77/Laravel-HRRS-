@extends('layout.main')
@section('title', 'Home')
@section('content')
    <section class="banner_main">
        <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Sticky Message -->
            <div class="container text-center d-flex align-items-center justify-content-center"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2;">
                <div style="background-color: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px;">
                    <h1 class="text-white" style="font-size: 3rem; font-weight: bold;">Welcome to Our Awesome Website</h1>
                    <p class="text-white" style="font-size: 1.5rem; margin-top: 10px;">A Best Place to Stay</p>
                    <a href="{{ url('/room') }}" class="btn btn-primary btn-lg mt-3"
                        style="padding: 10px 30px; font-size: 1.5rem; border-radius: 50px; background-color: #007bff; border: none;">
                        Book Now
                    </a>
                </div>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="images/banner1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="second-slide" src="images/banner2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="third-slide" src="images/banner3.jpg" alt="Third slide">
                </div>
            </div>

            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>


    <!-- end banner -->
    <!-- about -->
    <div class="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="titlepage">
                        <h2>About Us</h2>
                        <p id="about-text" class="text-collapsed">
                            Welcome to HRRS, where we believe that your stay should be as comfortable and seamless as
                            possible. Our hotel room reservation system is designed to provide you with a hassle-free
                            booking experience, whether you're planning a quick getaway or an extended stay.

                            At HRRS, we pride ourselves on offering a wide range of accommodations that cater to all types
                            of travelers. From cozy single rooms to luxurious suites, our hotel provides the perfect blend
                            of comfort, style, and convenience. Our reservation system is user-friendly, allowing you to
                            easily explore our room options, check availability, and book your stay with just a few clicks.

                            Our mission is to ensure that your journey, from booking to check-out, is smooth and enjoyable.
                            We understand that every guest has unique needs, and we strive to meet those with personalized
                            service and attention to detail. Whether you're traveling for business, leisure, or a special
                            occasion, our dedicated team is here to make your stay memorable.

                            Thank you for choosing HRRS. We look forward to welcoming you and making your stay with us a
                            delightful experience.
                        </p>
                        <a id="read-more" href="javascript:void(0)" onclick="toggleText()" class="btn btn-primary">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="about_img">
                        <figure><img src="images/about.png" alt="#" /></figure>
                    </div>
                </div>
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

    <style>
        .text-collapsed {
            display: -webkit-box;
            -webkit-line-clamp: 10;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Optional: Adjust button styling */
        #read-more {
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        #read-more:hover {
            background-color: #0056b3;
            /* Darker shade of primary color */
        }
    </style>

    <!-- end about -->
    <!-- our_room -->
    <div class="our_room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Room Categories</h2>
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
                                        <a href="{{ url('category', $category->id) }}" class="text-primary"
                                            style="color: inherit; text-decoration: none;">Show Details</a>
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
    <div class="our_room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Rooms</h2>
                        <br>
                        <p class="margin_0">Enjoy a restful stay in our well-appointed rooms, designed for comfort and
                            relaxation. Choose from a variety of options to suit your needs.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @php
                    $availableRooms = $rooms->filter(function ($room) {
                        return $room->room_status !== 'booked';
                    })->take(3);
                @endphp

                @if ($availableRooms->isEmpty())
                    <!-- No available rooms message -->
                    <div class="col-md-12">
                        <p class="text-center" style="font-size: 1.2em; color: red;">No rooms available at the moment.</p>
                    </div>
                @else
                    @foreach ($availableRooms as $room)
                        <div class="col-md-4 col-sm-6">
                            <div id="serv_hover" class="room">
                                <div class="room_img">
                                    <figure><img src="{{ asset($room->image) }}" alt="#" /></figure>
                                </div>
                                <div class="bed_room">
                                    <h4 style="color: rgb(91, 7, 156); font-weight:bold">{{$room->category->title}}</h4>
                                    <h3>{{ $room->name }}</h3>
                                    <div class="room_price text-center">
                                        <h4 class="text-primary" style="font-weight: bold;">Rs.{{ $room->price }}/night
                                        </h4>

                                        <p id="about-text-{{ $room->id }}" class="text-collapsed">
                                            {{ $room->description }}
                                            <a id="read-more-{{ $room->id }}" href="javascript:void(0)"
                                                onclick="toggleText({{ $room->id }})">
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
                @endif
            </div>
        </div>
    </div>


    <!-- end our_room -->
    <!-- gallery -->
    <div class="gallery">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>gallery</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="images/gallery1.jpg" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="images/gallery2.jpg" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="images/gallery3.jpg" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="images/gallery4.jpg" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="images/gallery5.jpg" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="images/gallery6.jpg" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="images/gallery7.jpg" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="gallery_img">
                        <figure><img src="images/gallery8.jpg" alt="#" /></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end gallery -->

    <!--  contact -->
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('contact.send') }}" method="POST" id="request" class="main_form">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Name" type="text" name="name" required>
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Email" type="email" name="email" required>
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Phone Number" type="tel" name="phone"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message" type="text" name='message' required></textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="send_btn" href="{{ url('/contact') }}">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="map_main">
                        <div class="map-responsive">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d113030.63588680512!2d83.38549965506907!3d27.710882888096393!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399686f71446a4b1%3A0x712e7c86b3c8d75!2sButwal%20Multiple%20Campus!5e0!3m2!1sen!2sus!4v1723964905391!5m2!1sen!2sus"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact -->
@endsection
