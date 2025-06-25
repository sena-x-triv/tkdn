@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="mb-4">Add Worker</h3>
    <form action="{{ route('workers.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label">Unit</label>
            <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit') }}" required>
            @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price (Rp)</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="tkdn" class="form-label">TKDN (%)</label>
            <input type="number" name="tkdn" id="tkdn" class="form-control @error('tkdn') is-invalid @enderror" value="{{ old('tkdn', 100) }}" required>
            @error('tkdn')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('workers.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection 