@extends('layouts.app')

@section('content')
<div class="container-fluid uix-dashboard">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Workers</h2>
                    <div class="text-muted">Manage worker information</div>
                </div>
                <a href="{{ route('worker.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Add Worker
                </a>
            </div>
            
            <div class="card uix-card mb-4">
                <div class="card-header fw-bold fs-5 bg-transparent border-bottom">Worker List</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Price (Rp)</th>
                                    <th>TKDN (%)</th>
                                    <th class="text-center" style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($workers as $worker)
                                <tr>
                                    <td>{{ $loop->iteration + ($workers->firstItem() - 1) }}</td>
                                    <td>{{ $worker->name }}</td>
                                    <td>{{ $worker->unit }}</td>
                                    <td>{{ number_format($worker->price, 0, ',', '.') }}</td>
                                    <td>{{ $worker->tkdn }}%</td>
                                    <td class="text-center">
                                        <a href="{{ route('worker.edit', $worker) }}" class="btn btn-outline-primary me-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('worker.destroy', $worker) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this worker?')">
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
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="bi bi-people fs-1 d-block mb-2"></i>
                                        No worker found. <a href="{{ route('workers.create') }}" class="text-decoration-none">Add your first worker</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if(method_exists($workers, 'links'))
            <div class="d-flex justify-content-end mt-3">
                {{ $workers->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 