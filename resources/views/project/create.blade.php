@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Tambah Project</h1>
    <p class="text-gray-600 dark:text-gray-400">Masukkan data project baru di bawah ini.</p>
</div>

<div class="card max-w-xl mx-auto">
    <form action="{{ route('master.project.store') }}" method="POST" class="card-body space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Project <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-input w-full @error('name') border-red-500 @enderror" required autofocus>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end">
            <a href="{{ route('master.project.index') }}" class="btn btn-secondary mr-2">Batal</a>
            <button type="submit" class="btn btn-primary flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection 