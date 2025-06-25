@extends('layouts.auth')

@section('content')
<h4 class="mb-3 text-center">Register</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
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
    <div class="mb-3">
        <label for="password-confirm" class="form-label">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Register</button>
</div>
</form>
@endsection
