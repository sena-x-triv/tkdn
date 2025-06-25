@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="mb-4">Worker List</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('workers.create') }}" class="btn btn-primary mb-3">Add Worker</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Price (Rp)</th>
                    <th>TKDN (%)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workers as $i => $worker)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $worker->name }}</td>
                    <td>{{ $worker->unit }}</td>
                    <td>Rp{{ number_format($worker->price,0,',','.') }}</td>
                    <td>{{ $worker->tkdn }}%</td>
                    <td>
                        <a href="{{ route('workers.edit', $worker) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('workers.destroy', $worker) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this worker?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 