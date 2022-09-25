<form class="user" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp"  placeholder="{{ __('Enter Email Address...') }}">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
    <div class="form-group">

        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">

        <div class="custom-control custom-checkbox small">
            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block">
        {{ __('Login') }}
    </button>
</form>
<hr>
@if (Route::has('password.request'))
    <div class="text-center">
        <a class="small" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    </div>
@endif
<div class="text-center">
    <a class="small" href="{{ route('register') }}">
        {{ __('Create an Account!') }}</a>
</div>