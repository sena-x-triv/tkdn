@extends('layouts.app')

@section('content')
<div class="container-fluid uix-dashboard">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <h2 class="fw-bold mb-1">Add Worker</h2>
            <div class="text-muted mb-4">Add a new worker to the system</div>
            
            <div class="card uix-card mb-4">
                <div class="card-header fw-bold fs-5 bg-transparent border-bottom">Worker Information</div>
                <div class="card-body">
                    <form action="{{ route('worker.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit') }}" required>
                                @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price (Rp)</label>
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tkdn" class="form-label">TKDN (%)</label>
                                <input type="number" name="tkdn" id="tkdn" class="form-control @error('tkdn') is-invalid @enderror" value="{{ old('tkdn', 100) }}" required>
                                @error('tkdn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('worker.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Worker
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 