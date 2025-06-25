@extends('layouts.app')

@section('content')
<div class="container-fluid uix-dashboard">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Material List</h2>
                    <div class="text-muted">Manage material data</div>
                </div>
                <a href="{{ route('material.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Add Material
                </a>
            </div>
            
            <div class="card uix-card mb-4">
                <div class="card-header fw-bold fs-5 bg-transparent border-bottom">Material List</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang/Jasa</th>
                                    <th>Tipe</th>
                                    <th>Merk</th>
                                    <th>Harga Satuan</th>
                                    <th class="text-center" style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($materials as $material)
                                <tr>
                                    <td>{{ $loop->iteration + ($materials->firstItem() - 1) }}</td>
                                    <td>{{ $material->name }}</td>
                                    <td>{{ $material->type }}</td>
                                    <td>{{ $material->brand }}</td>
                                    <td>{{ number_format($material->price, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('material.edit', $material) }}" class="btn btn-outline-primary me-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('material.destroy', $material) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this material?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" class="text-center py-4 text-muted">
                                        <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                                        No material found. <a href="{{ route('material.create') }}" class="text-decoration-none">Add your first material</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(method_exists($materials, 'links'))
                <div class="d-flex justify-content-end mt-3">
                    {{ $materials->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 