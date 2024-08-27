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
                style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; z-index: 2;">
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
                        <p>Welcome to HRRS, where we believe that your stay should be as comfortable and seamless as
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
                            delightful experience.</p>
                        <a class="read_more" href="Javascript:void(0)"> Read More</a>
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
    <!-- end about -->
    <!-- our_room -->
    <div class="our_room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Room</h2>
                        <p>Enjoy a restful stay in our well-appointed rooms, designed for comfort and relaxation. Choose
                            from a variety of options to suit your needs.</p>
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
                                    <p>{{ $room->description }}</p>
                                    <button class="btn btn-outline-primary" style="margin-top: 5px;">
                                        <a href="{{ url('book', ['room' => $room->id]) }}" class="text-primary">Book
                                            Now</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
                    <form id="request" class="main_form">
                        <div class="row">
                            <div class="col-md-12 ">
                                <input class="contactus" placeholder="Name" type="type" name="Name">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Email" type="type" name="Email">
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number">
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message" type="type" Message="Name"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="send_btn">Send</button>
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
