@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Detail Service</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ $service->getFormTitle() }}</p>
        </div>
        <div class="mt-4 sm:mt-0 flex space-x-2">
            @if($service->status === 'draft')
                <a href="{{ route('service.edit', $service) }}" class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('service.submit', $service) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Ajukan
                    </button>
                </form>
            @endif
            @if($service->status === 'submitted')
                <form action="{{ route('service.approve', $service) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Setujui
                    </button>
                </form>
                <form action="{{ route('service.reject', $service) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Tolak
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Status Badge -->
    <div class="flex items-center space-x-2">
        <span class="badge {{ $service->getStatusBadgeClass() }}">
            @switch($service->status)
                @case('draft')
                    Draft
                    @break
                @case('submitted')
                    Diajukan
                    @break
                @case('approved')
                    Disetujui
                    @break
                @case('rejected')
                    Ditolak
                    @break
            @endswitch
        </span>
        <span class="badge bg-blue-100 text-blue-800">
            {{ $service->getServiceTypeLabel() }}
        </span>
    </div>

    <!-- Informasi Umum -->
    <div class="card">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Umum</h3>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Penyedia Barang/Jasa</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->provider_name ?: '-' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->provider_address ?: '-' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Service</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->service_name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pengguna Barang/Jasa</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->user_name ?: '-' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Dokumen Service</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->document_number ?: '-' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Proyek</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->project->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Detail Item -->
    <div class="card">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Item Service</h3>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No. (1)</th>
                            <th>Uraian (2)</th>
                            <th>Kualifikasi (3)</th>
                            <th>Kewarganegaraan (4)</th>
                            <th>TKDN (%) (5)</th>
                            <th>Jumlah (6)</th>
                            <th>Durasi (7)</th>
                            <th>Upah (Rupiah) (8)</th>
                            <th class="text-center" colspan="3">BIAYA (Rupiah) (9)</th>
                        </tr>
                        <tr>
                            <th colspan="8"></th>
                            <th class="text-center">KDN</th>
                            <th class="text-center">KLN</th>
                            <th class="text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($service->items as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td>{{ $item->item_number }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->qualification ?: '-' }}</td>
                                <td>{{ $item->nationality }}</td>
                                <td>{{ number_format($item->tkdn_percentage, 2) }}%</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->duration, 2) }} {{ $item->duration_unit }}</td>
                                <td>{{ $item->getFormattedWage() }}</td>
                                <td class="text-right">{{ $item->getFormattedDomesticCost() }}</td>
                                <td class="text-right">{{ $item->foreign_cost > 0 ? $item->getFormattedForeignCost() : '-' }}</td>
                                <td class="text-right">{{ $item->getFormattedTotalCost() }}</td>
                            </tr>
                        @endforeach
                        
                        <!-- Sub Total -->
                        <tr class="bg-gray-50 dark:bg-gray-700 font-semibold">
                            <td colspan="7">SUB TOTAL</td>
                            <td>{{ number_format($service->items->sum('wage'), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($service->total_domestic_cost, 0, ',', '.') }}</td>
                            <td class="text-right">{{ $service->total_foreign_cost > 0 ? number_format($service->total_foreign_cost, 0, ',', '.') : '-' }}</td>
                            <td class="text-right">{{ number_format($service->total_cost, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Ringkasan TKDN -->
    <div class="card">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ringkasan TKDN</h3>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-primary-600 dark:text-primary-400">
                        {{ number_format($service->tkdn_percentage, 2) }}%
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Persentase TKDN</div>
                </div>
                
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                        Rp {{ number_format($service->total_domestic_cost, 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Total Biaya KDN</div>
                </div>
                
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                        Rp {{ number_format($service->total_cost, 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Total Biaya</div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('service.index') }}" class="btn btn-secondary">
            Kembali ke Daftar
        </a>
    </div>
</div>
@endsection 