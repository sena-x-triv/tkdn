@extends('layouts.app')

@section('content')
<div class="container-fluid uix-dashboard">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <h2 class="fw-bold mb-1">Settings</h2>
            <div class="text-muted mb-4">Manage your account settings and preferences</div>
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="card uix-card mb-4">
                <div class="card-header fw-bold fs-5 bg-transparent border-bottom">Profile Information</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf
                        @method('PATCH')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control-plaintext fw-bold" value="{{ $user->email }}" readonly>
                                <div class="small text-muted">Email cannot be changed</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 