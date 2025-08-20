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
                @case('generated')
                    Generated
                    @break
                @default
                    Draft
            @endswitch
        </span>
        <span class="badge bg-blue-100 text-blue-800">
            {{ $service->getServiceTypeLabel() }}
        </span>
    </div>

    <!-- Form Navigation Tabs -->
    <div class="mb-6">
        <div class="flex space-x-2 overflow-x-auto mb-4">
            <button 
                onclick="showForm('form-3-1')" 
                id="tab-3-1"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium whitespace-nowrap transition-colors">
                Form 3.1
            </button>
            <button 
                onclick="showForm('form-3-2')" 
                id="tab-3-2"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium whitespace-nowrap hover:bg-gray-300 transition-colors">
                Form 3.2
            </button>
            <button 
                onclick="showForm('form-3-3')" 
                id="tab-3-3"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium whitespace-nowrap hover:bg-gray-300 transition-colors">
                Form 3.3
            </button>
            <button 
                onclick="showForm('form-3-4')" 
                id="tab-3-4"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium whitespace-nowrap hover:bg-gray-300 transition-colors">
                Form 3.4
            </button>
            <button 
                onclick="showForm('form-3-5')" 
                id="tab-3-5"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium whitespace-nowrap hover:bg-gray-300 transition-colors">
                Form 3.5
            </button>
        </div>

        <!-- Form Content -->
        <div id="form-3-1" class="form-content">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form 3.1: TKDN Jasa untuk Manajemen Proyek dan Perekayasaan</h3>
                </div>
                <div class="card-body">
                    <!-- Header Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Penyedia Barang / Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->provider_address ?: 'Jl. Sudirman No. 123, Jakarta Pusat' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->service_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pengguna Barang/Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->user_name ?: 'PT Pembangunan Indonesia' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Dokumen Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->document_number ?: 'DOC-2024-001' }}</p>
                        </div>
                    </div>

                    <!-- HPP Data Table -->
                    @php
                        $hppItems = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                            $query->where('project_id', $service->project_id);
                        })
                        ->where('tkdn_classification', '3.1')
                        ->with(['hpp', 'estimationItem'])
                        ->get();
                    @endphp

                    @if($hppItems->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Uraian</th>
                                        <th>Kualifikasi</th>
                                        <th>Kewarganegaraan</th>
                                        <th class="text-center">TKDN (%)</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Durasi</th>
                                        <th class="text-center">Upah (Rupiah)</th>
                                        <th class="text-center" colspan="3">BIAYA (Rupiah)</th>
                                    </tr>
                                    <tr>
                                        <th colspan="8"></th>
                                        <th class="text-center">KDN</th>
                                        <th class="text-center">KLN</th>
                                        <th class="text-center">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hppItems as $index => $hppItem)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $hppItem->description }}</td>
                                            <td>-</td>
                                            <td>WNI</td>
                                            <td class="text-center">100%</td>
                                            <td class="text-center">{{ $hppItem->volume }}</td>
                                            <td class="text-center">{{ $hppItem->duration }} {{ $hppItem->duration_unit }}</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                            <td class="text-center">-</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-gray-50 dark:bg-gray-700 font-semibold">
                                        <td colspan="7" class="text-center">SUB TOTAL</td>
                                        <td class="text-right">{{ number_format($hppItems->sum('total_price'), 0, ',', '.') }}</td>
                                        <td class="text-right">{{ number_format($hppItems->sum('total_price'), 0, ',', '.') }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">{{ number_format($hppItems->sum('total_price'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-500 dark:text-gray-400">
                                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">Tidak ada data HPP dengan TKDN Classification 3.1</p>
                                <p class="text-sm">Data akan muncul setelah generate form TKDN</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div id="form-3-2" class="form-content hidden">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form 3.2: TKDN Jasa untuk Alat Kerja dan Peralatan</h3>
                </div>
                <div class="card-body">
                    <!-- Header Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Penyedia Barang / Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->provider_address ?: 'Jl. Sudirman No. 123, Jakarta Pusat' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->service_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pengguna Barang/Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->user_name ?: 'PT Pembangunan Indonesia' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Dokumen Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->document_number ?: 'DOC-2024-001' }}</p>
                        </div>
                    </div>

                    <!-- HPP Data Table -->
                    @php
                        $hppItems2 = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                            $query->where('project_id', $service->project_id);
                        })
                        ->where('tkdn_classification', '3.2')
                        ->with(['hpp', 'estimationItem'])
                        ->get();
                    @endphp

                    @if($hppItems2->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Uraian</th>
                                        <th>Kualifikasi</th>
                                        <th>Kewarganegaraan</th>
                                        <th class="text-center">TKDN (%)</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Durasi</th>
                                        <th class="text-center">Upah (Rupiah)</th>
                                        <th class="text-center" colspan="3">BIAYA (Rupiah)</th>
                                    </tr>
                                    <tr>
                                        <th colspan="8"></th>
                                        <th class="text-center">KDN</th>
                                        <th class="text-center">KLN</th>
                                        <th class="text-center">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hppItems2 as $index => $hppItem)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $hppItem->description }}</td>
                                            <td>-</td>
                                            <td>WNI</td>
                                            <td class="text-center">100%</td>
                                            <td class="text-center">{{ $hppItem->volume }}</td>
                                            <td class="text-center">{{ $hppItem->duration }} {{ $hppItem->duration_unit }}</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                            <td class="text-center">-</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-gray-50 dark:bg-gray-700 font-semibold">
                                        <td colspan="7" class="text-center">SUB TOTAL</td>
                                        <td class="text-right">{{ number_format($hppItems2->sum('total_price'), 0, ',', '.') }}</td>
                                        <td class="text-right">{{ number_format($hppItems2->sum('total_price'), 0, ',', '.') }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">{{ number_format($hppItems2->sum('total_price'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-500 dark:text-gray-400">
                                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">Tidak ada data HPP dengan TKDN Classification 3.2</p>
                                <p class="text-sm">Data akan muncul setelah generate form TKDN</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div id="form-3-3" class="form-content hidden">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form 3.3: TKDN Jasa untuk Konstruksi dan Pembangunan</h3>
                </div>
                <div class="card-body">
                    <!-- Header Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Penyedia Barang / Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->provider_address ?: 'Jl. Sudirman No. 123, Jakarta Pusat' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->service_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pengguna Barang/Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->user_name ?: 'PT Pembangunan Indonesia' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Dokumen Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->document_number ?: 'DOC-2024-001' }}</p>
                        </div>
                    </div>

                    <!-- HPP Data Table -->
                    @php
                        $hppItems3 = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                            $query->where('project_id', $service->project_id);
                        })
                        ->where('tkdn_classification', '3.3')
                        ->with(['hpp', 'estimationItem'])
                        ->get();
                    @endphp

                    @if($hppItems3->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Uraian</th>
                                        <th>Kualifikasi</th>
                                        <th>Kewarganegaraan</th>
                                        <th class="text-center">TKDN (%)</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Durasi</th>
                                        <th class="text-center">Upah (Rupiah)</th>
                                        <th class="text-center" colspan="3">BIAYA (Rupiah)</th>
                                    </tr>
                                    <tr>
                                        <th colspan="8"></th>
                                        <th class="text-center">KDN</th>
                                        <th class="text-center">KLN</th>
                                        <th class="text-center">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hppItems3 as $index => $hppItem)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $hppItem->description }}</td>
                                            <td>-</td>
                                            <td>WNI</td>
                                            <td class="text-center">100%</td>
                                            <td class="text-center">{{ $hppItem->volume }}</td>
                                            <td class="text-center">{{ $hppItem->duration }} {{ $hppItem->duration_unit }}</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                            <td class="text-center">-</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-gray-50 dark:bg-gray-700 font-semibold">
                                        <td colspan="7" class="text-center">SUB TOTAL</td>
                                        <td class="text-right">{{ number_format($hppItems3->sum('total_price'), 0, ',', '.') }}</td>
                                        <td class="text-right">{{ number_format($hppItems3->sum('total_price'), 0, ',', '.') }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">{{ number_format($hppItems3->sum('total_price'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-500 dark:text-gray-400">
                                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">Tidak ada data HPP dengan TKDN Classification 3.3</p>
                                <p class="text-sm">Data akan muncul setelah generate form TKDN</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div id="form-3-4" class="form-content hidden">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form 3.4: TKDN Jasa untuk Konsultasi dan Pengawasan</h3>
                </div>
                <div class="card-body">
                    <!-- Header Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Penyedia Barang / Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->provider_address ?: 'Jl. Sudirman No. 123, Jakarta Pusat' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->service_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pengguna Barang/Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->user_name ?: 'PT Pembangunan Indonesia' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Dokumen Jasa</label>
                            <p class="text-gray-900 dark:text-white">{{ $service->document_number ?: 'DOC-2024-001' }}</p>
                        </div>
                    </div>

                    <!-- HPP Data Table -->
                    @php
                        $hppItems4 = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                            $query->where('project_id', $service->project_id);
                        })
                        ->where('tkdn_classification', '3.4')
                        ->with(['hpp', 'estimationItem'])
                        ->get();
                    @endphp

                    @if($hppItems4->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Uraian</th>
                                        <th>Kualifikasi</th>
                                        <th>Kewarganegaraan</th>
                                        <th class="text-center">TKDN (%)</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Durasi</th>
                                        <th class="text-center">Upah (Rupiah)</th>
                                        <th class="text-center" colspan="3">BIAYA (Rupiah)</th>
                                    </tr>
                                    <tr>
                                        <th colspan="8"></th>
                                        <th class="text-center">KDN</th>
                                        <th class="text-center">KLN</th>
                                        <th class="text-center">TOTAL</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($hppItems4 as $index => $hppItem)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $hppItem->description }}</td>
                                            <td>-</td>
                                            <td>WNI</td>
                                            <td class="text-center">100%</td>
                                            <td class="text-center">{{ $hppItem->volume }}</td>
                                            <td class="text-center">{{ $hppItem->duration }} {{ $hppItem->duration_unit }}</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                            <td class="text-center">-</td>
                                            <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-gray-50 dark:bg-gray-700 font-semibold">
                                        <td colspan="7" class="text-center">SUB TOTAL</td>
                                        <td class="text-right">{{ number_format($hppItems4->sum('total_price'), 0, ',', '.') }}</td>
                                        <td class="text-right">{{ number_format($hppItems4->sum('total_price'), 0, ',', '.') }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">{{ number_format($hppItems4->sum('total_price'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-500 dark:text-gray-400">
                                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">Tidak ada data HPP dengan TKDN Classification 3.4</p>
                                <p class="text-sm">Data akan muncul setelah generate form TKDN</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div id="form-3-5" class="form-content hidden">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form 3.5: TKDN Jasa Lainnya</h3>
                </div>
                <div class="card-body">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Formulir ini berisi detail TKDN untuk jasa lainnya yang tidak termasuk dalam kategori di atas.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Jasa</label>
                            <p class="text-gray-900 dark:text-white">Jasa Lainnya</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori TKDN</label>
                            <p class="text-gray-900 dark:text-white">Jasa Umum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    <p class="text-gray-900 dark:text-white">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->provider_address ?: 'Jl. Sudirman No. 123, Jakarta Pusat' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Service</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->service_name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pengguna Barang/Jasa</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->user_name ?: 'PT Pembangunan Indonesia' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Dokumen Service</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->document_number ?: 'DOC-2024-001' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Proyek</label>
                    <p class="text-gray-900 dark:text-white">{{ $service->project->name ?: 'Gedung Perkantoran 5 Lantai' }}</p>
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
            <!-- TKDN Classification Filter -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter TKDN Classification:</label>
                    <select id="tkdnFilter" class="form-select w-32" onchange="filterTkdnItems()">
                        <option value="">Semua</option>
                        <option value="3.1">3.1</option>
                        <option value="3.2">3.2</option>
                        <option value="3.3">3.3</option>
                        <option value="3.4">3.4</option>
                        <option value="3.5">3.5</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">NO. (1)</th>
                            <th>URAIAN (2)</th>
                            <th>KUALIFIKASI (3)</th>
                            <th>KEWARGANEGARAAN (4)</th>
                            <th class="text-center">TKDN (%) (5)</th>
                            <th class="text-center">JUMLAH (6)</th>
                            <th class="text-center">DURASI (7)</th>
                            <th class="text-center">UPAH (RUPIAH) (8)</th>
                            <th class="text-center" colspan="3">BIAYA (RUPIAH) (9)</th>
                        </tr>
                        <tr>
                            <th colspan="8"></th>
                            <th class="text-center">KDN</th>
                            <th class="text-center">KLN</th>
                            <th class="text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody id="tkdnItemsTable">
                        @php
                            // Ambil semua HPP items untuk project ini
                            $allHppItems = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                                $query->where('project_id', $service->project_id);
                            })
                            ->with(['hpp', 'estimationItem'])
                            ->orderBy('tkdn_classification')
                            ->orderBy('item_number')
                            ->get();
                        @endphp

                        @if($allHppItems->count() > 0)
                            @foreach($allHppItems as $index => $hppItem)
                                <tr class="tkdn-item-row hover:bg-gray-50 dark:hover:bg-gray-700" data-tkdn-classification="{{ $hppItem->tkdn_classification }}">
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $hppItem->description }}</td>
                                    <td>-</td>
                                    <td>WNI</td>
                                    <td class="text-center">100%</td>
                                    <td class="text-center">{{ $hppItem->volume }}</td>
                                    <td class="text-center">{{ $hppItem->duration }} {{ $hppItem->duration_unit }}</td>
                                    <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-right">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            
                            <!-- Sub Total -->
                            <tr class="bg-gray-50 dark:bg-gray-700 font-semibold">
                                <td colspan="7" class="text-center">SUB TOTAL</td>
                                <td class="text-right">{{ number_format($allHppItems->sum('total_price'), 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($allHppItems->sum('total_price'), 0, ',', '.') }}</td>
                                <td class="text-center">-</td>
                                <td class="text-right">{{ number_format($allHppItems->sum('total_price'), 0, ',', '.') }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="11" class="text-center py-8">
                                    <div class="text-gray-500 dark:text-gray-400">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-lg font-medium">Tidak ada data HPP ditemukan</p>
                                        <p class="text-sm">Data akan muncul setelah generate form TKDN</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
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

<script>
// Tab functionality
function showForm(formId) {
    // Hide all form content
    const allForms = document.querySelectorAll('.form-content');
    allForms.forEach(form => {
        form.classList.add('hidden');
    });
    
    // Remove active state from all tabs
    const allTabs = document.querySelectorAll('[id^="tab-"]');
    allTabs.forEach(tab => {
        tab.classList.remove('bg-blue-600', 'text-white');
        tab.classList.add('bg-gray-200', 'text-gray-700');
    });
    
    // Show selected form
    const selectedForm = document.getElementById(formId);
    if (selectedForm) {
        selectedForm.classList.remove('hidden');
    }
    
    // Update active tab
    const tabId = formId.replace('form-', 'tab-');
    const activeTab = document.getElementById(tabId);
    if (activeTab) {
        activeTab.classList.remove('bg-gray-200', 'text-gray-700');
        activeTab.classList.add('bg-blue-600', 'text-white');
    }
}

// Filter TKDN items
function filterTkdnItems() {
    const filter = document.getElementById('tkdnFilter').value;
    const tkdnItemsTable = document.getElementById('tkdnItemsTable');
    const rows = tkdnItemsTable.querySelectorAll('.tkdn-item-row');
    let visibleRows = [];
    let totalUpah = 0;
    let totalKdn = 0;
    let totalKln = 0;
    let totalTotal = 0;

    rows.forEach(row => {
        const tkdnClassification = row.dataset.tkdnClassification;
        if (filter === '' || tkdnClassification === filter) {
            row.classList.remove('hidden');
            visibleRows.push(row);
            
            // Hitung total dari row yang visible
            const upahCell = row.cells[7]; // Upah (Rupiah) column
            const kdnCell = row.cells[8]; // KDN column
            const klnCell = row.cells[9]; // KLN column
            const totalCell = row.cells[10]; // TOTAL column
            
            if (upahCell && kdnCell && klnCell && totalCell) {
                const upah = parseFloat(upahCell.textContent.replace(/[^\d]/g, '')) || 0;
                const kdn = parseFloat(kdnCell.textContent.replace(/[^\d]/g, '')) || 0;
                const kln = parseFloat(klnCell.textContent.replace(/[^\d]/g, '')) || 0;
                const total = parseFloat(totalCell.textContent.replace(/[^\d]/g, '')) || 0;
                
                totalUpah += upah;
                totalKdn += kdn;
                totalKln += kln;
                totalTotal += total;
            }
        } else {
            row.classList.add('hidden');
        }
    });

    // Update subtotal row
    updateSubtotal(totalUpah, totalKdn, totalKln, totalTotal);
}

// Update subtotal row
function updateSubtotal(totalUpah, totalKdn, totalKln, totalTotal) {
    const subtotalRow = document.querySelector('#tkdnItemsTable tr:last-child');
    if (subtotalRow && subtotalRow.classList.contains('bg-gray-50')) {
        const upahCell = subtotalRow.cells[7];
        const kdnCell = subtotalRow.cells[8];
        const klnCell = subtotalRow.cells[9];
        const totalCell = subtotalRow.cells[10];
        
        if (upahCell && kdnCell && klnCell && totalCell) {
            upahCell.textContent = formatCurrency(totalUpah);
            kdnCell.textContent = formatCurrency(totalKdn);
            klnCell.textContent = totalKln > 0 ? formatCurrency(totalKln) : '-';
            totalCell.textContent = formatCurrency(totalTotal);
        }
    }
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID').format(amount);
}

// Initialize with Form 3.1 active
document.addEventListener('DOMContentLoaded', function() {
    showForm('form-3-1');
});
</script>

@endsection 