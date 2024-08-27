@extends('layout.main')
@section('title','Login')
@section('content')

<section class="login">
    <div class="formcontainer">
    <div class="wrapper">
            <form action="login.php" method="post">
                <div class="head">
                    <div class="head_a">
                        <img src="images/logohrr.png" alt="HRRS">
                    </div>
                    <div class="head_b">
                        <h2>Login </h2>
                    </div>
                </div>
                <div class="input-box"> <input type="text" name="email" placeholder="Email" required>
                    <i class="fa-regular fa-envelope"></i>
                </div>
                <div class="input-box"> <input type="password" name="password" placeholder="password" required> 
                    <i class="fa-solid fa-lock"></i> </div>
                <div class="remember-forgot">
                    <lable> <input type="checkbox">&nbsp;Remember me</lable> <a href="#">Forgot password? </a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="register-link">
                    <p>Don't have an account?<a href="{{ url('register') }}">&nbsp;Register</a></p>
                </div>
            </form>
        </div>
    </div>
</section>
    @endsection