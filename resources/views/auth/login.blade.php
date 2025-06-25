@extends('layouts.auth')

@section('content')
<h4 class="mb-3 text-center">Login</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
    <div class="mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Login</button>
                            </div>
    <div class="mt-3 text-center">
                                @if (Route::has('password.request'))
            <a class="small" href="{{ route('password.request') }}">Forgot Your Password?</a>
                                @endif
    </div>
</form>
@endsection
