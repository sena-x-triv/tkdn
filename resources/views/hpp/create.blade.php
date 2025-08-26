@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Tambah HPP</h1>
            <p class="text-gray-600 dark:text-gray-400">Buat Harga Pokok Pembelian baru</p>
        </div>
    </div>

    @if(session('error'))
        <div class="mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <form action="{{ route('hpp.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Informasi Umum -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Umum</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="project_id" class="form-label">Pilih Project <span class="text-red-500">*</span></label>
                        <select id="project_id" name="project_id" class="form-select @error('project_id') border-red-500 @enderror" required>
                            <option value="">Pilih Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <div id="project-info" class="hidden p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">Informasi Project</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Project</label>
                                    <p id="project-name" class="text-gray-900 dark:text-white"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Perusahaan</label>
                                    <p id="project-company" class="text-gray-900 dark:text-white"></p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                                    <p id="project-description" class="text-gray-900 dark:text-white"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Item Pekerjaan -->
        <div class="card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Item Pekerjaan</h3>
                    <button type="button" onclick="addItem()" class="btn btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Item
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="items-container">
                    <!-- Items will be added here dynamically -->
                </div>
            </div>
        </div>

        <!-- Kalkulasi -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kalkulasi</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="overhead_percentage" class="form-label">Overhead (%) <span class="text-red-500">*</span></label>
                        <input type="number" id="overhead_percentage" name="overhead_percentage" value="{{ old('overhead_percentage', 8) }}" step="0.01" min="0" max="100" class="form-input @error('overhead_percentage') border-red-500 @enderror" required>
                        @error('overhead_percentage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="margin_percentage" class="form-label">Margin (%) <span class="text-red-500">*</span></label>
                        <input type="number" id="margin_percentage" name="margin_percentage" value="{{ old('margin_percentage', 12) }}" step="0.01" min="0" max="100" class="form-input @error('margin_percentage') border-red-500 @enderror" required>
                        @error('margin_percentage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="ppn_percentage" class="form-label">PPN (%) <span class="text-red-500">*</span></label>
                        <input type="number" id="ppn_percentage" name="ppn_percentage" value="{{ old('ppn_percentage', 11) }}" step="0.01" min="0" max="100" class="form-input @error('ppn_percentage') border-red-500 @enderror" required>
                        @error('ppn_percentage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-3">
                        <label for="notes" class="form-label">Catatan</label>
                        <textarea id="notes" name="notes" rows="3" class="form-textarea @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('hpp.index') }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                Simpan HPP
            </button>
        </div>
    </form>
</div>

<!-- Template for item -->
<template id="item-template">
    <div class="item-row border border-gray-200 dark:border-gray-600 rounded-lg p-4 mb-4">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-md font-medium text-gray-900 dark:text-white">Item <span class="item-number"></span></h4>
            <button type="button" onclick="removeItem(this)" class="btn btn-outline p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="form-label">Uraian Barang/Pekerjaan <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="text" name="items[INDEX][description]" class="form-input description-input" required readonly placeholder="Klik untuk pilih data AHS">
                    <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="openAhsModal(this)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
                <input type="hidden" name="items[INDEX][estimation_item_id]" class="estimation-item-id-input">
                <input type="hidden" name="items[INDEX][ahs_type]" class="ahs-type-input">
            </div>
            
            <div>
                <label class="form-label">Klasifikasi TKDN <span class="text-red-500">*</span></label>
                <select name="items[INDEX][tkdn_classification]" class="form-select tkdn-classification-input" required>
                    <option value="">Pilih Klasifikasi TKDN</option>
                    <option value="3.1">3.1</option>
                    <option value="3.2">3.2</option>
                    <option value="3.3">3.3</option>
                    <option value="3.4">3.4</option>
                    <option value="3.5">3.5</option>
                    <option value="3.6">3.6</option>
                    <option value="3.7">3.7</option>
                </select>
            </div>
            
            <div>
                <label class="form-label">Volume <span class="text-red-500">*</span></label>
                <input type="number" name="items[INDEX][volume]" class="form-input volume-input" step="0.01" min="0" required>
            </div>
            
            <div>
                <label class="form-label">Satuan <span class="text-red-500">*</span></label>
                <input type="text" name="items[INDEX][unit]" class="form-input unit-input" required>
            </div>
            
            <div>
                <label class="form-label">Durasi <span class="text-red-500">*</span></label>
                <input type="number" name="items[INDEX][duration]" class="form-input" min="1" required>
            </div>
            
            <div>
                <label class="form-label">Satuan Durasi <span class="text-red-500">*</span></label>
                <select name="items[INDEX][duration_unit]" class="form-select" required>
                    <option value="Hari">Hari</option>
                    <option value="Minggu">Minggu</option>
                    <option value="Bulan" selected>Bulan</option>
                    <option value="Tahun">Tahun</option>
                </select>
            </div>
            
            <div>
                <label class="form-label">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="items[INDEX][unit_price]" class="form-input unit-price-input" step="0.01" min="0" required>
            </div>
            
            <div>
                <label class="form-label">Jumlah Harga (Rp)</label>
                <input type="number" name="items[INDEX][total_price]" class="form-input total-price-input" step="0.01" readonly>
            </div>
        </div>
    </div>
</template>

<!-- AHS Modal - Step 1: Pilih AHS -->
<div id="ahsModal" class="fixed inset-0 bg-black/40 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-16 mx-auto p-0 w-11/12 md:w-3/4 lg:w-2/3 xl:w-1/2 shadow-xl border border-gray-200 dark:border-gray-700 mt-2 rounded-3xl bg-white dark:bg-gray-900 overflow-hidden">
        <!-- Modal Header - Minimalist Style -->
        <div class="relative px-8 py-8 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
            <!-- Close Button - Top Right -->
            <button type="button" onclick="closeAhsModal()" class="absolute top-6 right-6 w-8 h-8 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="p-8 bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
            <!-- Step 1: Pilih AHS -->
            <div id="step1" class="step-content">
                <!-- Hero Section dengan Info Cards -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-blue-500 to-emerald-600 rounded-3xl flex items-center justify-center shadow-2xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Pilih Data AHS</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">Pilih jenis data yang akan digunakan untuk project ini</p>
                    
                    <!-- Info Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-4xl mx-auto mb-8">
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 dark:border-gray-700/50 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">AHS</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total AHS</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white" id="totalAhsCount">0</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 dark:border-gray-700/50 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">👷</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Pekerja</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white" id="totalWorkerCount">0</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 dark:border-gray-700/50 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">🧱</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Material</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white" id="totalMaterialCount">0</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-xl p-4 border border-gray-200/50 dark:border-gray-700/50 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">🔧</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Peralatan</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white" id="totalEquipmentCount">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Type Selection - Enhanced Tab Style -->
                <div class="mb-8">
                    <div class="text-center mb-6">
                        <h4 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">Pilih Kategori Data</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Pilih jenis data yang ingin Anda gunakan</p>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4 mb-6">
                        <button type="button" onclick="filterByType('ahs')" class="filter-btn-tab active bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-6 py-4 rounded-2xl border-0 shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center transform ring-4 ring-emerald-200 dark:ring-emerald-900/30" data-type="ahs">
                            <span class="text-2xl mr-3">📋</span>
                            <div class="text-left">
                                <div class="font-bold text-base">AHS</div>
                                <div class="text-xs opacity-90">Analisis Harga Satuan</div>
                            </div>
                        </button>
                        <button type="button" onclick="filterByType('worker')" class="filter-btn-tab bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border-3 border-gray-300 dark:border-gray-500 px-6 py-4 rounded-2xl hover:border-blue-400 hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center transform" data-type="worker">
                            <span class="text-2xl mr-3">👷</span>
                            <div class="text-left">
                                <div class="font-bold text-base">Pekerja</div>
                                <div class="text-xs opacity-80">Tenaga Kerja</div>
                            </div>
                        </button>
                        <button type="button" onclick="filterByType('material')" class="filter-btn-tab bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border-3 border-gray-300 dark:border-gray-500 px-6 py-4 rounded-2xl hover:border-orange-400 hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center transform" data-type="material">
                            <span class="text-2xl mr-3">🧱</span>
                            <div class="text-left">
                                <div class="font-bold text-base">Material</div>
                                <div class="text-xs opacity-80">Bahan Baku</div>
                            </div>
                        </button>
                        <button type="button" onclick="filterByType('equipment')" class="filter-btn-tab bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border-3 border-gray-300 dark:border-gray-500 px-6 py-4 rounded-2xl hover:border-purple-400 hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center transform" data-type="equipment">
                            <span class="text-2xl mr-3">🔧</span>
                            <div class="text-left">
                                <div class="font-bold text-base">Peralatan</div>
                                <div class="text-xs opacity-80">Alat Kerja</div>
                            </div>
                        </button>
                    </div>
                </div>
                
                <!-- Enhanced Search Bar with Filters -->
                <div class="mb-8">
                    <div class="max-w-3xl mx-auto space-y-6">
                        <!-- Main Search Bar -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="ahsSearch" placeholder="Cari data AHS, kode, atau deskripsi..." class="block w-full pl-16 pr-20 py-5 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-600 rounded-3xl shadow-lg placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 focus:shadow-xl dark:text-gray-100 transition-all duration-300 text-lg font-medium">
                            <div class="absolute inset-y-0 right-0 pr-6 flex items-center">
                                <div class="text-xs text-gray-500 bg-gray-100 dark:bg-gray-700 px-3 py-2 rounded-full border border-gray-200 dark:border-gray-600 font-medium">
                                    ⌘K
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Filters dengan Enhanced Design -->
                        <div class="flex flex-wrap justify-center gap-4">
                            <button type="button" onclick="quickFilter('recent')" class="quick-filter-btn active group relative px-6 py-3 text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-2xl border-0 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <span class="relative z-10 flex items-center">
                                    <span class="text-lg mr-2">🔥</span>
                                    <span>Terbaru</span>
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </button>
                            
                            <button type="button" onclick="quickFilter('popular')" class="quick-filter-btn group relative px-6 py-3 text-sm font-semibold bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 rounded-2xl border-2 border-gray-300 dark:border-gray-500 hover:border-blue-400 hover:text-blue-600 dark:hover:text-blue-400 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                <span class="relative z-10 flex items-center">
                                    <span class="text-lg mr-2">⭐</span>
                                    <span>Populer</span>
                                </span>
                            </button>
                            
                            <button type="button" onclick="quickFilter('verified')" class="quick-filter-btn group relative px-6 py-3 text-sm font-semibold bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 rounded-2xl border-2 border-gray-300 dark:border-gray-500 hover:border-green-400 hover:text-green-600 dark:hover:text-green-400 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                <span class="relative z-10 flex items-center">
                                    <span class="text-lg mr-2">✅</span>
                                    <span>Terverifikasi</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Enhanced AHS List with Stats -->
                <div class="mb-8">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-emerald-50 dark:from-blue-900/20 dark:to-emerald-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                                    </svg>
                                    Hasil Pencarian
                                </h3>
                                <div class="flex items-center space-x-4">
                                    <span id="resultCount" class="text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/60 dark:bg-gray-800/60 px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <span class="text-blue-600 dark:text-blue-400">0</span> hasil ditemukan
                                    </span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-600 dark:text-gray-400">Urutkan:</span>
                                        <select id="sortSelect" onchange="sortResults()" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400">
                                            <option value="name">Nama A-Z</option>
                                            <option value="code">Kode</option>
                                            <option value="price">Harga</option>
                                            <option value="recent">Terbaru</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- AHS List - Enhanced Card Style -->
                <div class="max-h-96 overflow-y-auto custom-scrollbar">
                    <div id="ahsList" class="space-y-4">
                        <!-- AHS data will be loaded here -->
                    </div>
                </div>
                
                <!-- Empty State -->
                <div id="emptyState" class="hidden text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Tidak ada data ditemukan</h3>
                    <p class="text-gray-500 dark:text-gray-400">Coba ubah filter atau kata kunci pencarian Anda</p>
                </div>
            </div>
            
            <!-- Step 2: Pilih Item dari AHS -->
            <div id="step2" class="step-content hidden">
                <div class="mb-6">
                    <button type="button" onclick="backToStep1()" class="inline-flex items-center px-4 py-3 text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        ← Kembali ke Pilihan AHS
                    </button>
                    
                    <div id="selectedAhsInfo" class="mt-8">
                        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-bold text-emerald-900 dark:text-emerald-100 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    AHS yang Dipilih
                                </h3>
                            </div>
                            <div class="p-6">
                                <!-- Selected AHS info will be shown here -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Enhanced AHS Items List -->
                <div class="mb-8">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-emerald-50 dark:from-blue-900/20 dark:to-emerald-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Detail Item AHS
                                </h3>
                                <div class="flex items-center space-x-4">
                                    <span id="itemCount" class="text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white/60 dark:bg-gray-800/60 px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <span class="text-blue-600 dark:text-blue-400">0</span> item tersedia
                                    </span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-600 dark:text-gray-400">Urutkan:</span>
                                        <select id="itemSortSelect" onchange="sortItems()" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400">
                                            <option value="name">Nama A-Z</option>
                                            <option value="code">Kode</option>
                                            <option value="price">Harga</option>
                                            <option value="tkdn">TKDN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="max-h-96 overflow-y-auto custom-scrollbar">
                    <div id="ahsItemsList" class="space-y-4">
                        <!-- AHS items will be loaded here -->
                    </div>
                </div>
                
                <!-- Empty Items State -->
                <div id="emptyItemsState" class="hidden text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Tidak ada item ditemukan</h3>
                    <p class="text-gray-500 dark:text-gray-400">AHS ini tidak memiliki item yang tersedia</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let itemIndex = 0;
let ahsData = @json($ahsData);
let currentItemRow = null;
let projects = @json($projects);
let currentFilterType = 'ahs';

function addItem() {
    const container = document.getElementById('items-container');
    const template = document.getElementById('item-template');
    const clone = template.content.cloneNode(true);
    
    // Update index
    const inputs = clone.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.name = input.name.replace('INDEX', itemIndex);
    });
    
    // Update item number
    const itemNumber = clone.querySelector('.item-number');
    itemNumber.textContent = itemIndex + 1;
    
    container.appendChild(clone);
    
    // Add event listeners for calculation
    const volumeInput = container.lastElementChild.querySelector('.volume-input');
    const unitPriceInput = container.lastElementChild.querySelector('.unit-price-input');
    const totalPriceInput = container.lastElementChild.querySelector('.total-price-input');
    
    volumeInput.addEventListener('input', function() { calculateTotal(container.lastElementChild); });
    unitPriceInput.addEventListener('input', function() { calculateTotal(container.lastElementChild); });
    
    itemIndex++;
}

function removeItem(button) {
    const itemRow = button.closest('.item-row');
    itemRow.remove();
}

function calculateTotal(row) {
    const volume = parseFloat(row.querySelector('.volume-input').value) || 0;
    const unitPrice = parseFloat(row.querySelector('.unit-price-input').value) || 0;
    const totalPrice = volume * unitPrice;
    row.querySelector('.total-price-input').value = totalPrice.toFixed(2);
}

function openAhsModal(button) {
    currentItemRow = button.closest('.item-row');
    document.getElementById('ahsModal').classList.remove('hidden');
    showStep1();
    loadAhsData();
}

function closeAhsModal() {
    document.getElementById('ahsModal').classList.add('hidden');
    currentItemRow = null;
    currentFilterType = 'ahs';
}

function showStep1() {
    document.getElementById('step1').classList.remove('hidden');
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('ahsSearch').value = '';
    loadAhsData();
}

function showStep2() {
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
}

function backToStep1() {
    showStep1();
}

function filterByType(type) {
    currentFilterType = type;
    
    // Update active button for new tab style
    document.querySelectorAll('.filter-btn-tab').forEach(btn => {
        btn.classList.remove('active', 'bg-gradient-to-r', 'from-emerald-600', 'to-teal-600', 'text-white', 'shadow-xl', 'ring-4', 'ring-emerald-200', 'dark:ring-emerald-900/30', 'border-0');
        btn.classList.add('bg-white', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-200', 'border-3', 'border-gray-300', 'dark:border-gray-500');
    });
    
    const activeBtn = document.querySelector(`[data-type="${type}"]`);
    activeBtn.classList.add('active', 'bg-gradient-to-r', 'from-emerald-600', 'to-teal-600', 'text-white', 'shadow-xl', 'ring-4', 'ring-emerald-200', 'dark:ring-emerald-900/30', 'border-0');
    activeBtn.classList.remove('bg-white', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-200', 'border-3', 'border-gray-300', 'dark:border-gray-500');
    
    loadAhsData();
}

function quickFilter(filterType) {
    // Update quick filter buttons
    document.querySelectorAll('.quick-filter-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-emerald-100', 'dark:bg-emerald-900/30', 'text-emerald-700', 'dark:text-emerald-300');
        btn.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-300');
    });
    
    const activeBtn = event.target;
    activeBtn.classList.add('active', 'bg-emerald-100', 'dark:bg-emerald-900/30', 'text-emerald-700', 'dark:text-emerald-300');
    activeBtn.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-300');
    
    // Apply filter logic here
    loadAhsData();
}

function sortResults() {
    const sortBy = document.getElementById('sortSelect').value;
    // Apply sorting logic here
    loadAhsData();
}

function sortItems() {
    const sortBy = document.getElementById('itemSortSelect').value;
    // Apply sorting logic here
    // This will be implemented when we have items to sort
}

function loadAhsData() {
    const ahsList = document.getElementById('ahsList');
    const emptyState = document.getElementById('emptyState');
    ahsList.innerHTML = '';
    
    const filteredData = ahsData.filter(item => item.type === currentFilterType);
    
    // Update result count
    const resultCount = document.getElementById('resultCount');
    resultCount.textContent = `Menampilkan ${filteredData.length} hasil`;
    
    // Show/hide empty state
    if (filteredData.length === 0) {
        emptyState.classList.remove('hidden');
        return;
    } else {
        emptyState.classList.add('hidden');
    }
    
    filteredData.forEach(function(item) {
        const div = document.createElement('div');
        div.className = 'bg-white dark:bg-gray-700 p-6 rounded-2xl border border-gray-100 dark:border-gray-600 cursor-pointer hover:shadow-lg hover:border-emerald-200 dark:hover:border-emerald-600 hover:scale-[1.02] transition-all duration-300 group';
        
        if (item.type === 'ahs') {
            div.onclick = function() { selectAhsForItems(item); };
            div.innerHTML = `
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-2xl flex items-center justify-center shadow-sm">
                            <span class="text-emerald-600 dark:text-emerald-400 text-xl">📋</span>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors text-lg mb-1">${item.description}</h5>
                            <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                <span class="flex items-center">
                                    <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2"></span>
                                    Kode: ${item.code}
                                </span>
                                <span class="flex items-center">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mr-2"></span>
                                    ${item.item_count} item
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-xs font-bold rounded-full shadow-sm">
                            AHS
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center justify-center">
                            <span class="mr-1">Klik untuk pilih</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </p>
                    </div>
                </div>
            `;
        } else {
            div.onclick = function() { selectAhsItem(item); };
            const iconMap = {
                worker: '👷',
                material: '🧱',
                equipment: '🔧'
            };
            const colorMap = {
                worker: 'from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30',
                material: 'from-orange-100 to-red-100 dark:from-orange-900/30 dark:to-red-900/30',
                equipment: 'from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30'
            };
            div.innerHTML = `
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br ${colorMap[item.type] || 'from-gray-100 to-gray-200 dark:from-gray-600 dark:to-gray-700'} rounded-2xl flex items-center justify-center shadow-sm">
                            <span class="text-gray-600 dark:text-gray-300 text-xl">${iconMap[item.type] || '📦'}</span>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors text-lg mb-1">${item.description}</h5>
                            <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                <span class="flex items-center">
                                    <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2"></span>
                                    Kode: ${item.code}
                                </span>
                                <span class="flex items-center">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mr-2"></span>
                                    ${item.category}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400">Rp ${numberFormat(item.unit_price)}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-600 px-2 py-1 rounded-full mt-1">${item.unit || 'Unit'}</p>
                    </div>
                </div>
            `;
        }
        
        ahsList.appendChild(div);
    });
}

function selectAhsForItems(ahs) {
    // Load AHS items
    fetch(`{{ route('hpp.get-ahs-items') }}?estimation_id=${ahs.id}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            
            // Show selected AHS info
            document.getElementById('selectedAhsInfo').innerHTML = `
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-white">${data.estimation.code} - ${data.estimation.title}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Pilih item dari AHS ini</p>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Item: ${data.items.length}</div>
                    </div>
                </div>
            `;
            
            // Load AHS items
            const ahsItemsList = document.getElementById('ahsItemsList');
            ahsItemsList.innerHTML = '';
            
            // Update item count
            const itemCount = document.getElementById('itemCount');
            itemCount.textContent = `Menampilkan ${data.items.length} item`;
            
            data.items.forEach(function(item) {
                const div = document.createElement('div');
                div.className = 'bg-white dark:bg-gray-700 p-6 rounded-2xl border border-gray-100 dark:border-gray-600 cursor-pointer hover:shadow-lg hover:border-emerald-200 dark:hover:border-emerald-600 hover:scale-[1.02] transition-all duration-300 group';
                div.onclick = function() { selectAhsItemFromList(item, ahs); };
                
                const categoryIcon = {
                    'worker': '👷',
                    'material': '🧱', 
                    'equipment': '🔧'
                }[item.category] || '📦';
                
                const colorMap = {
                    'worker': 'from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30',
                    'material': 'from-orange-100 to-red-100 dark:from-orange-900/30 dark:to-red-900/30',
                    'equipment': 'from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30'
                };
                
                const tkdnColor = item.tkdn_classification ? 'text-emerald-600 dark:text-emerald-400' : 'text-amber-600 dark:text-amber-400';
                const tkdnBg = item.tkdn_classification ? 'bg-emerald-100 dark:bg-emerald-900/20' : 'bg-amber-100 dark:bg-amber-900/20';
                
                div.innerHTML = `
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br ${colorMap[item.category] || 'from-gray-100 to-gray-200 dark:from-gray-600 dark:to-gray-700'} rounded-2xl flex items-center justify-center shadow-sm">
                                <span class="text-gray-600 dark:text-gray-300 text-xl">${categoryIcon}</span>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors text-lg mb-2">${item.description}</h5>
                                <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    <span class="flex items-center">
                                        <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2"></span>
                                        Kode: ${item.code}
                                    </span>
                                    <span class="flex items-center">
                                        <span class="w-2 h-2 bg-blue-400 rounded-full mr-2"></span>
                                        ${item.category}
                                    </span>
                                </div>
                                <div class="inline-flex items-center px-3 py-1.5 ${tkdnBg} ${tkdnColor} text-xs font-medium rounded-full">
                                    TKDN: ${item.tkdn_classification || 'Belum diatur'}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400 mb-1">Rp ${numberFormat(item.unit_price)}</p>
                            <div class="inline-flex items-center px-3 py-1.5 bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-300 text-xs font-medium rounded-full">
                                ${item.unit || 'Unit'}
                            </div>
                        </div>
                    </div>
                `;
                
                ahsItemsList.appendChild(div);
            });
            
            showStep2();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat data AHS items');
        });
}

function selectAhsItemFromList(item, ahs) {
    if (!currentItemRow) return;
    
    const descriptionInput = currentItemRow.querySelector('.description-input');
    const estimationItemIdInput = currentItemRow.querySelector('.estimation-item-id-input');
    const unitPriceInput = currentItemRow.querySelector('.unit-price-input');
    const unitInput = currentItemRow.querySelector('.unit-input');
    const tkdnClassificationInput = currentItemRow.querySelector('.tkdn-classification-input');
    
    descriptionInput.value = `${ahs.description} - ${item.description}`;
    estimationItemIdInput.value = item.id;
    unitPriceInput.value = item.unit_price;
    unitInput.value = item.unit || 'Unit';
    
    // Set TKDN classification
    if (item.tkdn_classification) {
        tkdnClassificationInput.value = item.tkdn_classification;
    } else if (item.tkdn_value) {
        // Auto-calculate TKDN classification based on value
        const tkdnValue = parseFloat(item.tkdn_value);
        if (tkdnValue <= 25) {
            tkdnClassificationInput.value = '3.1';
        } else if (tkdnValue <= 35) {
            tkdnClassificationInput.value = '3.2';
        } else if (tkdnValue <= 45) {
            tkdnClassificationInput.value = '3.3';
        } else if (tkdnValue <= 55) {
            tkdnClassificationInput.value = '3.4';
        } else if (tkdnValue <= 65) {
            tkdnClassificationInput.value = '3.5';
        } else if (tkdnValue <= 75) {
            tkdnClassificationInput.value = '3.6';
        } else {
            tkdnClassificationInput.value = '3.7';
        }
    } else {
        tkdnClassificationInput.value = '3.7'; // Default to highest TKDN
    }
    
    // Recalculate total
    calculateTotal(currentItemRow);
    
    closeAhsModal();
}

function selectAhsItem(item) {
    if (!currentItemRow) return;
    
    const descriptionInput = currentItemRow.querySelector('.description-input');
    const estimationItemIdInput = currentItemRow.querySelector('.estimation-item-id-input');
    const unitPriceInput = currentItemRow.querySelector('.unit-price-input');
    const unitInput = currentItemRow.querySelector('.unit-input');
    const tkdnClassificationInput = currentItemRow.querySelector('.tkdn-classification-input');
    
    descriptionInput.value = item.description;
    estimationItemIdInput.value = item.id;
    unitPriceInput.value = item.unit_price;
    
    // Set unit based on item type
    if (item.type === 'worker') {
        unitInput.value = item.unit || 'OH';
    } else if (item.type === 'material') {
        unitInput.value = item.unit || 'Unit';
    } else if (item.type === 'equipment') {
        unitInput.value = 'Hari';
    } else {
        unitInput.value = 'Unit';
    }
    
    // Set TKDN classification
    if (item.tkdn) {
        const tkdnValue = parseFloat(item.tkdn);
        if (tkdnValue <= 25) {
            tkdnClassificationInput.value = '3.1';
        } else if (tkdnValue <= 35) {
            tkdnClassificationInput.value = '3.2';
        } else if (tkdnValue <= 45) {
            tkdnClassificationInput.value = '3.3';
        } else if (tkdnValue <= 55) {
            tkdnClassificationInput.value = '3.4';
        } else if (tkdnValue <= 65) {
            tkdnClassificationInput.value = '3.5';
        } else if (tkdnValue <= 75) {
            tkdnClassificationInput.value = '3.6';
        } else {
            tkdnClassificationInput.value = '3.7';
        }
    } else {
        tkdnClassificationInput.value = '3.7'; // Default to highest TKDN
    }
    
    // Recalculate total
    calculateTotal(currentItemRow);
    
    closeAhsModal();
}

function numberFormat(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

// Project selection handler
document.getElementById('project_id').addEventListener('change', function() {
    const projectId = this.value;
    const projectInfo = document.getElementById('project-info');
    
    if (projectId) {
        const project = projects.find(function(p) { return p.id === projectId; });
        if (project) {
            document.getElementById('project-name').textContent = project.name;
            document.getElementById('project-company').textContent = project.company || '-';
            document.getElementById('project-description').textContent = project.description || '-';
            projectInfo.classList.remove('hidden');
        }
    } else {
        projectInfo.classList.add('hidden');
    }
});

// Enhanced Search functionality with real-time filtering
document.getElementById('ahsSearch').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const ahsItems = document.querySelectorAll('#ahsList > div');
    let visibleCount = 0;
    
    ahsItems.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    
    // Update result count for filtered results
    const resultCount = document.getElementById('resultCount');
    if (searchTerm) {
        resultCount.textContent = `Menampilkan ${visibleCount} hasil untuk "${searchTerm}"`;
    } else {
        loadAhsData(); // Reload to get original count
    }
    
    // Show/hide empty state for filtered results
    const emptyState = document.getElementById('emptyState');
    if (visibleCount === 0 && searchTerm) {
        emptyState.classList.remove('hidden');
    } else {
        emptyState.classList.add('hidden');
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Cmd/Ctrl + K to focus search
    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        document.getElementById('ahsSearch').focus();
    }
    
    // Escape to close modal
    if (e.key === 'Escape') {
        closeAhsModal();
    }
    
    // Enter to select first visible item
    if (e.key === 'Enter' && document.activeElement.id === 'ahsSearch') {
        const firstVisibleItem = document.querySelector('#ahsList > div[style*="block"]');
        if (firstVisibleItem) {
            firstVisibleItem.click();
        }
    }
});

// Custom scrollbar styles
const style = document.createElement('style');
style.textContent = `
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #4b5563;
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }
`;
document.head.appendChild(style);

// Close modal when clicking outside
document.getElementById('ahsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAhsModal();
    }
});

// Add first item on page load
document.addEventListener('DOMContentLoaded', function() {
    addItem();
});
</script>
@endsection
