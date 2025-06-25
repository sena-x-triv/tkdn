@extends('layouts.app')

@section('content')
<div class="container-fluid uix-dashboard">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <h2 class="fw-bold mb-1">Add Material</h2>
            <div class="text-muted mb-4">Add a new material to the system</div>
            <div class="card uix-card mb-4">
                <div class="card-header fw-bold fs-5 bg-transparent border-bottom">Material Information</div>
                <div class="card-body">
                    <form action="{{ route('material.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama_barang_jasa" class="form-label">Nama Barang/Jasa</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="spesifikasi" class="form-label">Spesifikasi</label>
                                <input type="text" name="specification" id="specification" class="form-control @error('specification') is-invalid @enderror" value="{{ old('specification') }}">
                                @error('specification')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tipe" class="form-label">Tipe</label>
                                <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}">
                                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="merk" class="form-label">Merk</label>
                                <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}">
                                @error('brand')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tkdn" class="form-label">TKDN</label>
                                <input type="text" name="tkdn" id="tkdn" class="form-control @error('tkdn') is-invalid @enderror" value="{{ old('tkdn') }}">
                                @error('tkdn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit') }}">
                                @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="link_acuan" class="form-label">Link Acuan</label>
                                <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}">
                                @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="harga_satuan_inflasi" class="form-label">Harga Satuan Inflasi</label>
                                <input type="number" name="price_inflasi" id="price_inflasi" class="form-control @error('price_inflasi') is-invalid @enderror" value="{{ old('price_inflasi') }}">
                                @error('price_inflasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('material.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Material
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 