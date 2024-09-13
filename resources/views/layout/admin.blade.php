<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Hotel Room Reservation')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

    <style>
        /* Default sidebar styling for large screens */
        .sidebar {
            background-color: #d0e0f1;
            color: rgb(19, 16, 16);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: auto;
            padding-top: 5px;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .sidebar .image-container {
            display: flex;
            justify-content: center;
        }

        .sidebar img {
            width: 80px;
            transition: width 0.3s ease;
            margin-bottom: 0;
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
        }

        .sidebar a i {
            margin-right: 8px;
            /* Add margin between icon and text */
        }

        .sidebar a span {
            margin-left: 5px;
        }

        .active-link {
            background-color: #98c4f3;
            border-left: 4px solid white;
            font-weight: bold;
        }

        /* Hide menu icon for larger screens */
        .toggle-btn {
            display: none;
        }

        /* Media query for screens smaller than 768px */
        @media (max-width: 900px) {
            .sidebar {
                left: -170px;
                background-color: transparent;
                width: auto;
                height: 100vh;
                transition: left 0.3s ease;
            }

            .sidebar.open {
                left: 0;
                background-color: rgba(255, 255, 255, 0.8);
            }

            .sidebar img {
                width: 40px;
            }

            .sidebar a span {
                font-size: 14px;
            }

            .toggle-btn {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1000;
                cursor: pointer;
            }

            .content {
                margin-left: 0;
            }
        }

        @media (min-width: 900px) {
            .content {
                margin-left: 170px;
            }
        }

    </style>
</head>

<body style="background-color: white;">
    <!-- Menu toggle button -->
    <button class="toggle-btn btn btn-primary" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
    </button>

    <div class="row no-gutters">
        <!-- Sidebar -->
        <div class="col-sm-2 sidebar">
            <div class="image-container">
                <a href="{{ url('home') }}"><img src="{{ asset('images/logohrr.png') }}" alt="HRRS" /></a>
            </div>
            <hr class="mt-2 mb-2">
            <a href="{{ url('admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active-link' : '' }}">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
            <a href="{{ url('admin/userinfo') }}" class="{{ request()->is('admin/userinfo') ? 'active-link' : '' }}">
                <i class="fa-solid fa-user"></i> <span>User Info</span>
            </a>
            <a href="{{ url('admin/roomcategory') }}"
                class="{{ request()->is('admin/roomcategory') ? 'active-link' : '' }}">
                <i class="fas fa-th-large"></i> <span>Room Category</span>
            </a>
            <a href="{{ url('admin/rooms') }}" class="{{ request()->is('admin/rooms') ? 'active-link' : '' }}">
                <i class="fas fa-bed"></i> <span>Rooms</span>
            </a>
            <a href="{{ url('admin/roombook') }}" class="{{ request()->is('admin/roombook') ? 'active-link' : '' }}">
                <i class="fa-solid fa-list"></i> <span>Booked Room</span>
            </a>
            <a href="{{ url('admin/transaction') }}"
                class="{{ request()->is('admin/transaction') ? 'active-link' : '' }}">
                <i class="fas fa-money-bill-wave"></i> <span>Transaction</span>
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-sign-out-alt"></i> <span>{{ __('Logout') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <!-- Content Area -->
        <div class="col-sm-10 content" style="padding: 20px; background-color: white;">
            @yield('content')
        </div>
    </div>

    <!-- Font Awesome Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>

    <!-- JavaScript to toggle sidebar visibility -->
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
        }
    </script>

</body>

</html>
