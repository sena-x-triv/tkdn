@extends('layouts.auth')

@section('content')
<h4 class="mb-3 text-center">Verify Your Email Address</h4>
                    @if (session('resent'))
    <div class="alert alert-success" role="alert">A fresh verification link has been sent to your email address.</div>
                    @endif
<p class="mb-3">Before proceeding, please check your email for a verification link.<br> If you did not receive the email, click below to request another.</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
    </div>
</form>
@endsection
