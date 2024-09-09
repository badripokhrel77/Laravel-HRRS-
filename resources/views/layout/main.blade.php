<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Hotel Room Reservation')</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}"
        media="screen">
 <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

</head>

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="Loading...." /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header" style="width: 100%;">
            <div class="container-fluid" style="padding: 0;">
                <div class="row no-gutters" style="width: 100%;">
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href=" {{ url('home') }}"><img src="{{ asset('images/logohrr.png') }}" alt="HRRS" /> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link {{ Request::is('home') ? 'active text-danger border-bottom border-danger border-bottom-1' : '' }}"
                                            href="{{ url('home') }}">
                                            <i class="fas fa-home" style="margin-right: 8px;"></i>Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('about') ? 'active text-danger border-bottom border-danger border-bottom-1' : '' }}"
                                            href="{{ url('about') }}">
                                            <i class="fa-duotone fa-solid fa-book-open-reader"
                                                style="margin-right: 8px;"></i>About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('room') ? 'active text-danger border-bottom border-danger border-bottom-1' : '' }}"
                                            href="{{ url('room') }}">
                                            <i class="fas fa-bed" style="margin-right: 8px;"></i>Our Rooms</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('gallery') ? 'active text-danger border-bottom border-danger border-bottom-1' : '' }}"
                                            href="{{ url('gallery') }}">
                                            <i class="fa-solid fa-image" style="margin-right: 8px;"></i>Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('contact') ? 'active text-danger border-bottom border-danger border-bottom-1' : '' }}"
                                            href="{{ url('contact') }}">
                                            <i class="fa-solid fa-address-book" style="margin-right: 8px;"></i>Contact Us</a>
                                    </li>
                                </ul>
                                
                                <ul class="navbar-nav ms-auto">
                                    @if (auth()->check())
                                        <li class="nav-item dropdown ">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                {{-- <i class="fa-solid fa-user" style="margin-right: 8px;"></i>
                                                {{ Auth::user()->f_name }} --}}
                                                <img class="img-account-profile rounded-circle mb-2"
                                                src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/profile.jpg') }}"
                                                alt="Profile Picture" style="width: 20px; height: 20px; object-fit: cover; margin-right: 8px;">
                                                {{ Auth::user()->f_name }}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="right: 0; left: auto;">
                                                <!-- Dashboard Link -->
                                                <a class="dropdown-item" href="{{ url('user/profile') }}">
                                                    <i class="fa-solid fa-user" style="margin-right: 8px;"></i>
                                                    {{ __('Profile') }}
                                                </a>
                                                <!-- Logout Link -->
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fa-solid fa-sign-out-alt" style="margin-right: 8px;"></i>
                                                    {{ __('Logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">
                                                <i class="fa-solid fa-user" style="margin-right: 8px;"></i>
                                                {{ __('Login') }}
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    

    @yield('content')

    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class=" col-md-4">
                        <h3>Contact US</h3>
                        <ul class="conta">
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> Address</li>
                            <li><i class="fa fa-mobile" aria-hidden="true"></i> +977-9840074989</li>
                            <li> <i class="fa fa-envelope" aria-hidden="true"></i><a
                                    href="#">hrrs024@gmail.com</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Menu Link</h3>
                        <ul class="link_menu">
                            <li class=" {{ Request::is('home') ? 'active text-danger ' : '' }}"><a
                                    href="{{ url('home') }}">Home</a></li>
                            <li class=" {{ Request::is('about') ? 'active text-danger' : '' }}"><a
                                    href="{{ url('about') }}"> about</a></li>
                            <li class=" {{ Request::is('room') ? 'active text-danger' : '' }}"><a
                                    href="{{ url('room') }}">Our Room</a></li>
                            <li class=" {{ Request::is('gallery') ? 'active text-danger' : '' }}"><a
                                    href="{{ url('gallery') }}">Gallery</a></li>
                            <li class=" {{ Request::is('contact') ? 'active text-danger' : '' }}"><a
                                    href="{{ url('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Connect with Us</h3>
                        <ul class="social_icon">
                            <li><a href="https://www.facebook.com/badri.pokhrel7777" target="_blank"><i
                                        class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="https://github.com/badripokhrel77" target="_blank"><i class="fa fa-github"
                                        aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 offset-md-1">

                            <p>
                                &copy;2024 Hotel Room Booking. All Right Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.0.0.min.js') }}"></script>
    <!-- sidebar -->
    <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    @yield('script')
</body>

</html>
