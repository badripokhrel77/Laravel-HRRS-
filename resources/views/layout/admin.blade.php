<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Hotel Room Reservation')</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">


</head>

<body style="background-color: white;">
    <div class="row no-gutters">
        <!-- Sidebar -->
        <div class="col-sm-2"
            style="background-color: #d0e0f1; color: rgb(19, 16, 16); text-align: center; height: 100vh; padding-top: 20px; position: sticky; top: 0;">
            <div
                style="background-color: #d0e2f5; color: rgb(26, 23, 23); padding: 15px; text-align: center; margin-bottom: 20px; font-weight: bold;">
                Admin Dashboard
            </div>

            <a href="{{ url('admin/dashboard') }}"
                style="color: rgb(17, 14, 14); display: block; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 4px; transition: background 0.3s; border-left: 4px solid transparent; text-align: left;"
                class="{{ request()->is('admin/dashboard') ? 'active-link' : '' }}">
                <i class="fas fa-home" style="margin-right: 8px;"></i> Dashboard
            </a>

            <a href="{{ url('admin/userinfo') }}"
                style="color: rgb(17, 14, 14); display: block; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 4px; transition: background 0.3s; border-left: 4px solid transparent; text-align: left;"
                class="{{ request()->is('admin/userinfo') ? 'active-link' : '' }}">
                <i class="fa-solid fa-user" style="margin-right: 8px;"></i> User Info
            </a>
            <a href="{{ url('admin/roomcategory') }}"
                style="color: rgb(17, 14, 14); display: block; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 4px; transition: background 0.3s; border-left: 4px solid transparent; text-align: left;"
                class="{{ request()->is('admin/roomcategory') ? 'active-link' : '' }}">
                <i class="fa-solid fa-user" style="margin-right: 8px;"></i> Room Category
            </a>

            <a href="{{ url('admin/rooms') }}"
                style="color: rgb(29, 24, 24); display: block; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 4px; transition: background 0.3s; border-left: 4px solid transparent; text-align: left;"
                class="{{ request()->is('admin/rooms') ? 'active-link' : '' }}">
                <i class="fas fa-bed" style="margin-right: 8px;"></i> Rooms
            </a>


            <a href="{{ url('admin/roombook') }}"
                style="color: rgb(29, 24, 24); display: block; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 4px; transition: background 0.3s; border-left: 4px solid transparent; text-align: left;"
                class="{{ request()->is('admin/roombook') ? 'active-link' : '' }}">
                <i class="fa-solid fa-list" style="margin-right: 8px;"></i> Booked Room
            </a>

            <a href="{{ url('admin/transaction') }}"
                style="color: rgb(29, 24, 24); display: block; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 4px; transition: background 0.3s; border-left: 4px solid transparent; text-align: left;"
                class="{{ request()->is('admin/transaction') ? 'active-link' : '' }}">
                <i class="fas fa-money-bill-wave" style="margin-right: 8px;"></i> Transaction
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
            background-color: #98c4f3;
            /* Slightly darker blue for active link */
            border-left: 4px solid rgb(255, 255, 255);
            /* White left border for active link */
            font-weight: bold;
            /* Bold text for active link */
        }
    </style>
</body>

</html>
