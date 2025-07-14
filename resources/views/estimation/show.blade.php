@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <div class="flex items-center mb-4">
        <a href="{{ route('master.estimation.index') }}" class="btn btn-outline p-2 mr-4 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Detail AHS</h1>
            <p class="text-gray-600 dark:text-gray-400">Lihat detail lengkap Analisa Harga Satuan pekerjaan</p>
        </div>
    </div>
</div>

@if(session('status'))
    <div class="mb-6">
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative flex items-center" role="alert">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>{{ session('status') }}</span>
        </div>
    </div>
@endif

<!-- Main Content -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- AHS Details Card -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Basic Information -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4M7 7h.01M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                    </svg>
                    Informasi AHS
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Kode AHS</label>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                            </svg>
                            <span class="text-gray-900 dark:text-white font-semibold">{{ $estimation->code ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Judul AHS</label>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            <span class="text-gray-900 dark:text-white font-semibold">{{ $estimation->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- AHS Items -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Item AHS
                    <span class="ml-2 px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 text-xs rounded-full">
                        {{ $estimation->items->count() }} items
                    </span>
                </h3>
            </div>
            <div class="overflow-hidden">
                @forelse($estimation->items as $index => $item)
                    <div class="border-b border-gray-100 dark:border-gray-700 last:border-b-0 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-150">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">{{ $index + 1 }}</span>
            </div>
            <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $item->equipment_name }}</h4>
                                        <div class="flex items-center space-x-4 mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($item->category === 'worker') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                @elseif($item->category === 'material') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                                                @if($item->category === 'worker')
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                    </svg>
                                                @elseif($item->category === 'material')
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4M7 7h.01M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                                    </svg>
                                                @endif
                                                {{ ucfirst($item->category) }}
                                            </span>
                                            @if($item->code)
                                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $item->code }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Item Details Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="text-center sm:text-left">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Koefisien</div>
                                    <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ number_format($item->coefficient, 2, ',', '.') }}</div>
                                </div>
                                <div class="text-center sm:text-left">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Harga Satuan</div>
                                    <div class="text-lg font-semibold text-blue-600 dark:text-blue-400">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</div>
                                </div>
                                <div class="text-center sm:text-right">
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total</div>
                                    <div class="text-lg font-bold text-green-600 dark:text-green-400">Rp {{ number_format($item->total_price, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada item AHS</p>
                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Tambahkan item untuk melihat detail biaya</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Summary Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Financial Summary -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-800 dark:to-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                    Ringkasan Biaya
                </h3>
            </div>
            <div class="p-6 space-y-6">
                <!-- Total Dasar -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Dasar</span>
                        </div>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">Rp {{ number_format($estimation->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Margin -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            <span class="text-sm font-medium text-blue-600 dark:text-blue-300">Margin</span>
                        </div>
                        <span class="text-lg font-semibold text-blue-600 dark:text-blue-400">{{ number_format($estimation->margin, 1, ',', '.') }}%</span>
                    </div>
                </div>

                <!-- Harga Final -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-4 border-2 border-green-200 dark:border-green-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                            </svg>
                            <span class="text-sm font-medium text-green-700 dark:text-green-300">Harga Final</span>
                        </div>
                        <span class="text-xl font-bold text-green-600 dark:text-green-400">Rp {{ number_format($estimation->total_unit_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                    </svg>
                    Aksi
                </h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('master.estimation.edit', $estimation->id) }}" class="btn btn-primary w-full flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit AHS</span>
                </a>
                
                <a href="{{ route('master.estimation.index') }}" class="btn btn-outline w-full flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    <span>Daftar AHS</span>
                </a>
            </div>
        </div>

        <!-- Statistics -->
        @if($estimation->items->count() > 0)
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-gray-800 dark:to-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Statistik
                </h3>
            </div>
            <div class="p-6 space-y-4">
                @php
                    $categoryStats = $estimation->items->groupBy('category')->map(function($items) {
                        return [
                            'count' => $items->count(),
                            'total' => $items->sum('total_price')
                        ];
                    });
                @endphp
                
                @foreach($categoryStats as $category => $stats)
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center space-x-2">
                        @if($category === 'worker')
                            <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        @elseif($category === 'material')
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        @else
                            <div class="w-3 h-3 rounded-full bg-gray-500"></div>
                        @endif
                        <span class="text-sm text-gray-600 dark:text-gray-300 capitalize">{{ $category }}</span>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $stats['count'] }} items</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Rp {{ number_format($stats['total'], 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 