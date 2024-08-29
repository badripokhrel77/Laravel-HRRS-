@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div style="max-width: 800px; margin: auto; padding: 15px;">
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="width: 100%; max-width: 600px;">
            <div style="border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div style="background-color: #f8f9fa; border-bottom: 1px solid #ddd; padding: 15px; font-weight: bold; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                    {{ __('Reset Password') }}
                </div>

                <div style="padding: 15px;">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div style="margin-bottom: 15px; display: flex; align-items: center;">
                            <label for="email" style="width: 40%; text-align: right; padding-right: 10px; font-weight: bold;">{{ __('Email Address') }}</label>

                            <div style="width: 60%;">
                                <input id="email" type="email" style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px;" class="@error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span style="color: #dc3545; font-size: 80%; display: block; margin-top: 5px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-bottom: 15px; display: flex; align-items: center;">
                            <label for="password" style="width: 40%; text-align: right; padding-right: 10px; font-weight: bold;">{{ __('Password') }}</label>

                            <div style="width: 60%;">
                                <input id="password" type="password" style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px;" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span style="color: #dc3545; font-size: 80%; display: block; margin-top: 5px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-bottom: 15px; display: flex; align-items: center;">
                            <label for="password-confirm" style="width: 40%; text-align: right; padding-right: 10px; font-weight: bold;">{{ __('Confirm Password') }}</label>

                            <div style="width: 60%;">
                                <input id="password-confirm" type="password" style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px;" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div style="margin-top: 10px; text-align: right;">
                            <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
