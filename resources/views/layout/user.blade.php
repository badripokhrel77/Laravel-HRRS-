<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'User Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <style>
        /* Sidebar styling copied from the admin blade */
        .sidebar {
            background-color: #d0e0f1;
            color: rgb(19, 16, 16);
            text-align: center;
            height: 100vh;
            padding-top: 20px;
            position: sticky;
            top: 0;
        }

        .sidebar img {
            width: 80px;
            transition: width 0.3s ease;
        }

        .sidebar a {
            color: rgb(17, 14, 14);
            display: flex;
            align-items: center;
            padding: 10px 20px;
            text-decoration: none;
            margin: 10px 0;
            border-radius: 4px;
            transition: background 0.3s;
            border-left: 4px solid transparent;
            text-align: left;
        }

        .sidebar a i {
            margin-right: 8px; /* Add margin to the right of the icon */
        }

        .sidebar a span {
            margin-left: 5px; /* Add margin to the left of the span */
        }

        .active-link {
            background-color: #98c4f3;
            border-left: 4px solid white;
            font-weight: bold;
        }

        /* Responsive for smaller screens */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
                text-align: center;
                padding-top: 10px;
            }

            .sidebar img {
                width: 40px;
            }

            .sidebar a span {
                display: none;
            }

            .sidebar a {
                justify-content: center;
                padding: 10px 10px;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 60px;
            }

            .sidebar img {
                width: 30px;
            }
        }

        /* Active link styling */
        .active-link {
            background-color: #86bdf5;
            border-left: 4px solid white;
            font-weight: bold;
        }
    </style>
</head>

<body style="background-color: white;">
    <div class="row no-gutters">
        <!-- Sidebar -->
        <div class="col-sm-2 sidebar">
            <a href="{{ url('home') }}"><img src="{{ asset('images/logohrr.png') }}" alt="HRRS" /></a>
            <hr class="mt-2 mb-2">
            <a href="{{ url('user/profile') }}" class="{{ request()->is('user/profile') ? 'active-link' : '' }}">
                <i class="fa-solid fa-user"></i> <span>User Profile</span>
            </a>
            <a href="{{ url('user/reservedroom') }}" class="{{ request()->is('user/reservedroom') ? 'active-link' : '' }}">
                <i class="fas fa-bed"></i> <span>Reserved Rooms</span>
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-sign-out-alt"></i> <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <!-- Content Area -->
        <div class="col-sm-10" style="padding: 20px; background-color: white;">
            @yield('content')
        </div>
    </div>

    <!-- Font Awesome Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>

</body>

</html>
