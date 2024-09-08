@extends('layout.user')
@section('content')
    <style>
        body {
            margin-top: 20px;
            background-color: #e2e8f0;
            color: #1a202c;
        }

        .img-account-profile {
            height: 7rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
            font-weight: 500;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .radio-button-group {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        .radio-button-group .item {
            flex: 1;
            position: relative;
        }

        .radio-button-group .radio-button {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
        }

        .radio-button-group .radio-button+label {
            padding: 14px 20px;
            cursor: pointer;
            border: 2px solid #ddd;
            margin-right: -2px;
            color: #666;
            background-color: #f9f9f9;
            text-align: center;
            display: block;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .radio-button-group .item:first-of-type .radio-button+label {
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        .radio-button-group .item:last-of-type .radio-button+label {
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .radio-button-group .radio-button+label:hover {
            background-color: #ececec;
        }

        .radio-button-group .radio-button:checked+label {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .radio-button-group .radio-button:checked+label:hover {
            background-color: #0056b3;
        }
    </style>
    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="nav-item active">
                        <a class="nav-link {{ Request::is('home') ? 'active text-danger border-bottom border-danger border-bottom-1' : '' }}"
                            href="{{ url('home') }}">
                            <i class="fas fa-home" style="margin-right: 8px;"></i>Home</a>
                    </li>
                </ol>
            </nav>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- /Breadcrumb -->
            <div class="radio-button-group mts">
                <div class="item">
                    <input type="radio" name="view_type" class="radio-button" value="profile" id="button1"
                        onclick="showSection('profile')" checked>
                    <label for="button1">Profile</label>
                </div>
                <div class="item">
                    <input type="radio" name="view_type" class="radio-button" value="editprofile" id="button2"
                        onclick="showSection('editprofile')">
                    <label for="button2">Change Profile</label>
                </div>
                <div class="item">
                    <input type="radio" name="view_type" class="radio-button" value="changepw" id="button3"
                        onclick="showSection('changepw')">
                    <label for="button3">Password Change</label>
                </div>
            </div>

            <hr class="mt-0 mb-4">
            <div id="profileSection">
                <div class="row gutters-sm">
                    <div class="card mb-2 mb-xl-0" style="height: 240px;">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle"
                                src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                            <!-- Profile picture help block-->
                            <div class="medium font-italic text-black mb-4">
                                {{ Auth::user()->f_name . ' ' . Auth::user()->l_name }}</div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-header">User Details</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->f_name . ' ' . Auth::user()->l_name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->phone }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->address }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Edit Profile Section -->
            <div id="editProfileSection" style="display: none;">
                <div class="container-xl px-4 mt-4">

                    <div class="row">
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img class="img-account-profile rounded-circle mb-2"
                                        src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" type="button">Upload new image</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">User Details</div>
                                <div class="card-body">
                                    <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- Specify the method to update -->
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputFirstName">First name</label>
                                                <input class="form-control" id="inputFirstName" type="text"
                                                    name="f_name" value="{{ Auth::user()->f_name }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLastName">Last name</label>
                                                <input class="form-control" id="inputLastName" type="text"
                                                    name="l_name" value="{{ Auth::user()->l_name }}">
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputOrgName">Address</label>
                                                <input class="form-control" id="inputOrgName" type="text"
                                                    name="address" value="{{ Auth::user()->address }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLocation">Phone Number</label>
                                                <input class="form-control" id="inputLocation" type="text"
                                                    name="phone" value="{{ Auth::user()->phone }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                            <input class="form-control" id="inputEmailAddress" type="email"
                                                name="email" value="{{ Auth::user()->email }}">
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- form card change password -->
            <div id="changePwSection" style="display: none;">
                <div class="card card-outline-secondary">
                    <div class="card-header">
                        <h3 class="mb-0">Change Password</h3>
                    </div>
                    <div class="card-body">
                        <!-- Update the form action to point to the route for password change -->
                        <form class="form" role="form" method="POST" action="{{ route('password.change') }}" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="inputPasswordOld">Current Password</label>
                                <input type="password" class="form-control" id="inputPasswordOld" name="current_password" required="">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordNew">New Password</label>
                                <input type="password" class="form-control" id="inputPasswordNew" name="new_password" required="">
                                <span class="form-text small text-muted">
                                    The password must be 8-20 characters, and must <em>not</em> contain spaces.
                                </span>
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordNewVerify">Verify</label>
                                <input type="password" class="form-control" id="inputPasswordNewVerify" name="new_password_confirmation" required="">
                                <span class="form-text small text-muted">
                                    To confirm, type the new password again.
                                </span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script>
        $("#btnLogin").click(function(event) {

            var form = $("#loginForm");

            if (form[0].checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }

            // if validation passed form
            // would post to the server here

            form.addClass('was-validated');
        });

        function showSection(section) {
            // Hide all sections
            document.getElementById('profileSection').style.display = 'none';
            document.getElementById('editProfileSection').style.display = 'none';
            document.getElementById('changePwSection').style.display = 'none';

            // Show the selected section based on the radio button value
            if (section === 'profile') {
                document.getElementById('profileSection').style.display = 'block';
            } else if (section === 'editprofile') {
                document.getElementById('editProfileSection').style.display = 'block';
            } else if (section === 'changepw') {
                document.getElementById('changePwSection').style.display = 'block';
            }
        }
    </script>
@endsection
