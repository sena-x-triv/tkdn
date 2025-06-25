@extends('layouts.auth')

@section('content')
<h4 class="mb-3 text-center">Reset Password</h4>
                    @if (session('status'))
    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </div>
</form>
@endsection
