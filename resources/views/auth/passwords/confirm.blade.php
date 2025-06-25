@extends('layouts.auth')

@section('content')
<h4 class="mb-3 text-center">Confirm Password</h4>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autofocus>
                                @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Confirm Password</button>
                        </div>
    <div class="mt-3 text-center">
                                @if (Route::has('password.request'))
            <a class="small" href="{{ route('password.request') }}">Forgot Your Password?</a>
                                @endif
    </div>
</form>
@endsection
