@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('master.category.index') }}" class="btn btn-outline p-2 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Detail Kategori</h1>
                <p class="text-gray-600 dark:text-gray-400">Informasi lengkap kategori</p>
            </div>
        </div>
    </div>
    <div class="max-w-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Kategori</h3>
            </div>
            <div class="card-body space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Nama Kategori</label>
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">{{ $category->name }}</div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Kode</label>
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">{{ $category->code }}</div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Dibuat</label>
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">{{ $category->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Diperbarui</label>
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">{{ $category->updated_at->format('d M Y, H:i') }}</div>
                </div>
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('master.category.index') }}" class="btn btn-outline flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    <a href="{{ route('master.category.edit', $category) }}" class="btn btn-primary flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 