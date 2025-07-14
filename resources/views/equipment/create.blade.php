@extends('layouts.app')

@section('content')
<div class="mb-8">
    <div class="flex items-center mb-4">
        <a href="{{ route('master.equipment.index') }}" class="btn btn-outline p-2 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tambah Peralatan</h1>
            <p class="text-gray-600 dark:text-gray-400">Tambah data peralatan proyek</p>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 w-full mx-auto mb-8 border border-gray-100 dark:border-gray-800">
    <form action="{{ route('master.equipment.store') }}" method="POST" class="space-y-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Peralatan <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-input w-full @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="tkdn" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">TKDN (%)</label>
                <input type="number" name="tkdn" id="tkdn" value="{{ old('tkdn') }}" class="form-input w-full @error('tkdn') border-red-500 @enderror" min="0" max="100" step="0.01">
                @error('tkdn')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="period" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Period (Hari) <span class="text-red-500">*</span></label>
                <input type="number" name="period" id="period" value="{{ old('period') }}" class="form-input w-full @error('period') border-red-500 @enderror" min="1" required>
                @error('period')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga <span class="text-red-500">*</span></label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" class="form-input w-full @error('price') border-red-500 @enderror" min="0" required>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Keterangan</label>
                <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-input w-full @error('description') border-red-500 @enderror">
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-8 flex justify-end">
            <button type="submit" class="btn btn-primary flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Peralatan
            </button>
        </div>
    </form>
</div>
@endsection 