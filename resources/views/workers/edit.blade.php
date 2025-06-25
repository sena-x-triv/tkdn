@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="mb-4">Edit Worker</h3>
    <form action="{{ route('workers.update', $worker) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $worker->name) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label">Unit</label>
            <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit', $worker->unit) }}" required>
            @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price (Rp)</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $worker->price) }}" required>
            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="tkdn" class="form-label">TKDN (%)</label>
            <input type="number" name="tkdn" id="tkdn" class="form-control @error('tkdn') is-invalid @enderror" value="{{ old('tkdn', $worker->tkdn) }}" required>
            @error('tkdn')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('workers.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection 