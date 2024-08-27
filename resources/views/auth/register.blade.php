@extends('layout.main')
@section('title','Register')
@section('content')
<section class="reg">
    <div class="Reg-form">
        <div class="head1">
            <div class="head_c">
                <img src="images/logohrr.png" alt="HRRS">
            </div>
            <div class="head_d">
                <h1>Registration Form</h1>
            </div>
        </div>

        <form action="{{ url('register') }}" method="post">
            @csrf
            <div class="name">
                <div class="first">
                    <p>First Name:</p>
                    <div class="input-box"> <input type="text" name="f_name" placeholder="First Name" required>
                        <i class="fa-solid fa-pen"></i>
                    </div>
                </div>
                <div class="first">
                    <p>Last Name:</p>
                    <div class="input-box">
                        <input type="text" name="l_name" placeholder="Last Name" required>
                        <i class="fa-solid fa-pen"></i>
                    </div>
                </div>
            </div>
            <div class="name">
                <div class="first">
                    <p>Address:</p>
                    <div class="input-box">
                        <input type="text" name="address" placeholder="Address" required> 
                        <i class="fa-solid fa-address-book"></i>
                    </div>
                </div>
                <div class="first">
                    <p>phone Number:</p>
                    <div class="input-box">
                        <input type="number" name="phone" placeholder="Phone Number" required>
                         <i class="fa-solid fa-phone"></i>
                    </div>
                </div>
            </div>
            <p>Email:</p>
            <div class="input-box">
                </class><input type="email" name="email" placeholder="Email" required> 
                <i class="fa-regular fa-envelope"></i>
            </div>
            <p>password:</p>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i> 
            </div>
            <div class="btn">
                <button type="submit">Register</button>
            </div>
            <div class="login-link">
                <p>Already have an account?<a href="{{ url('login') }}">&nbsp;Login</a></p>
            </div>
        </form>
    </div>
</section>
@endsection