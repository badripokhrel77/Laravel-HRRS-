

<div style="max-width: 800px; margin: auto; padding: 15px;">
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="width: 100%; max-width: 600px;">
            <div style="border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div style="background-color: #f8f9fa; border-bottom: 1px solid #ddd; padding: 15px; font-weight: bold; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                    {{ __('Reset Password') }}
                </div>

                <div style="padding: 15px;">
                    @if (session('status'))
                        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; border: 1px solid #c3e6cb;" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div style="margin-bottom: 15px; display: flex; align-items: center;">
                            <label for="email" style="width: 40%; text-align: right; padding-right: 10px; font-weight: bold;">{{ __('Email Address') }}</label>

                            <div style="width: 60%;">
                                <input id="email" type="email" style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px;" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span style="color: #dc3545; font-size: 80%; display: block; margin-top: 5px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-top: 10px; text-align: right;">
                            <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


