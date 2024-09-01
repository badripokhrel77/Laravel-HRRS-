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
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{ url('register') }}" method="post">
            @csrf
            <div class="name">
                <div class="first">
                    <p>First Name:</p>
                    <div class="input-box"> <input type="text" name="f_name" value="{{ old('f_name') }}" placeholder="First Name" >
                        <i class="fa-solid fa-pen"></i>
                    </div>
                </div>
                <div class="first">
                    <p>Last Name:</p>
                    <div class="input-box">
                        <input type="text" name="l_name" value="{{ old('l_name') }}" placeholder="Last Name" >
                        <i class="fa-solid fa-pen"></i>
                    </div>
                </div>
            </div>
            <div class="name">
                <div class="first">
                    <p>Address:</p>
                    <div class="input-box">
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Address" > 
                        <i class="fa-solid fa-address-book"></i>
                    </div>
                </div>
                <div class="first">
                    <p>phone Number:</p>
                    <div class="input-box">
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" >
                         <i class="fa-solid fa-phone"></i>
                    </div>
                </div>
            </div>
            <p>Email:</p>
            <div class="input-box">
                </class><input type="text" name="email" value="{{ old('email') }}" placeholder="Email" 
                class="form-control @error('email') is-invalid @enderror"> 
                <i class="fa-regular fa-envelope"></i>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <p>password:</p>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i> 
            </div>
            <p>confirm password:</p>
            <div class="input-box">
                <input type="password" name="password_confirmation" placeholder="password confirmation" required>
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