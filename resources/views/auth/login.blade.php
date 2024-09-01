@extends('layout.main')

@section('title', 'Login')

@section('content')
    <section class="login">
        <div class="formcontainer">
            <div class="wrapper">
                <form method="POST" action="{{ url('login') }}">
                    @csrf
                    <div class="head">
                        <div class="head_a">
                            <img src="images/logohrr.png" alt="HRRS">
                        </div>
                        <div class="head_b">
                            <h2>Login</h2>
                        </div>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Display general login error -->
                    @if ($errors->has('login_failed'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('login_failed') }}</strong>
                        </div>
                    @endif

                    <div class="input-box">
                        <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Email"
                            required autocomplete="email" autofocus
                            class="form-control @error('email') is-invalid @enderror">
                        <i class="fa-regular fa-envelope"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-box">
                        <input id="password" type="password" name="password" placeholder="Password"
                            autocomplete="current-password" class="form-control @error('password') is-invalid @enderror">
                        <i class="fa-solid fa-lock"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            &nbsp;Remember me
                        </label>
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>

                    <div class="register-link">
                        <p>Don't have an account?<a href="{{ url('register') }}">&nbsp;Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
