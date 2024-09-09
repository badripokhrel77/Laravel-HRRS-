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
</head>

<body style="background-color: white;">
    <div class="row no-gutters">
        <!-- Sidebar -->
        <div class="col-sm-2"
            style="background-color: rgb(208, 226, 228); color: rgb(255, 254, 254); height: 100vh; padding-top: 0; position: sticky; top: 0;">
            <a href=" {{ url('home') }}"><img src="{{ asset('images/logohrr.png') }}" alt="HRRS" style="width: 80px; margin-left:70px; margin-top:6px;"/> </a>

            <hr class="mt-2 mb-2">
            <a href="{{ url('user/profile') }}"
                style="color: rgb(15, 15, 15); display: block; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 4px; transition: background 0.3s; border-left: 4px solid transparent; text-align: left;"
                class="{{ request()->is('user/profile') ? 'active-link' : '' }}">
                <i class="fa-solid fa-user" style="margin-right: 8px;"></i> User Profile
            </a>

            <a href="{{ url('user/reservedroom') }}"
                style="color: rgb(15, 15, 15); display: block; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 4px; transition: background 0.3s; border-left: 4px solid transparent; text-align: left;"
                class="{{ request()->is('user/reservedroom') ? 'active-link' : '' }}">
                <i class="fas fa-bed" style="margin-right: 8px;"></i> Reserved Rooms
            </a>

            <a href="{{ route('logout') }}"
                style="color: rgb(15, 15, 15); display: block; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 4px; transition: background 0.3s; border-left: 4px solid transparent; text-align: left;"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-sign-out-alt" style="margin-right: 8px;"></i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <!-- Add more links here as needed -->
        </div>

        <!-- Content Area -->
        <div class="col-sm-10" style="padding: 20px; background-color: white;">
            @yield('content')
        </div>
    </div>

    <!-- Font Awesome Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>

    <!-- Inline Script for Active Link Styling -->
    <style>
        .active-link {
            background-color: #86bdf5;
            /* Slightly darker blue for active link */
            border-left: 4px solid rgb(255, 255, 255);
            /* White left border for active link */
            font-weight: bold;
            /* Bold text for active link */
        }
    </style>
</body>

</html>
