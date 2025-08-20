@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <!-- Hero Header -->
    <div class="relative overflow-hidden bg-white dark:bg-gray-900 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="absolute inset-0 bg-blue-600/10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $service->service_name }}</h1>
                            <p class="text-lg text-gray-600 dark:text-gray-400">{{ $service->getFormTitle() }}</p>
                        </div>
                    </div>
                    
                    <!-- Service Info Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-lg p-4 border border-gray-200/50 dark:border-gray-700/50">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Project</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $service->project->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-lg p-4 border border-gray-200/50 dark:border-gray-700/50">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ ucfirst($service->status) }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-lg p-4 border border-gray-200/50 dark:border-gray-700/50">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $service->getServiceTypeLabel() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-lg p-4 border border-gray-200/50 dark:border-gray-700/50">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Cost</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($service->total_cost, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-6 lg:mt-0 lg:ml-6 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                    @if($service->status === 'draft')
                        <a href="{{ route('service.edit', $service) }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Service
                        </a>
                        <form action="{{ route('service.submit', $service) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center ml-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Submit for Approval
                            </button>
                        </form>
                    @endif
                    @if($service->status === 'submitted')
                        <form action="{{ route('service.approve', $service) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 border border-transparent rounded-lg text-sm font-medium text-white hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Approve
                            </button>
                        </form>
                        <form action="{{ route('service.reject', $service) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-pink-600 border border-transparent rounded-lg text-sm font-medium text-white hover:from-red-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reject
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-700 rounded-xl p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content Container -->
    <div class="py-8">
        <!-- Status and Type Badges -->
        <div class="flex flex-wrap items-center gap-3 mb-8">
            <div class="inline-flex items-center border border-blue-200 px-3 py-1 rounded-full text-sm font-medium {{ $service->getStatusBadgeClass() }} shadow-sm">
                @switch($service->status)
                    @case('draft')
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Draft
                        @break
                    @case('submitted')
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Submitted
                        @break
                    @case('approved')
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Approved
                        @break
                    @case('rejected')
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Rejected
                        @break
                    @case('generated')
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Generated
                        @break
                    @default
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Draft
                @endswitch
            </div>
            <div class="inline-flex items-center ml-2 px-3 py-1 rounded-full text-sm font-medium bg-blue-100 border border-blue-200 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 shadow-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                {{ $service->getServiceTypeLabel() }}
            </div>
        </div>

        <!-- Form Navigation Tabs -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-2 overflow-x-auto pb-2">
                <button 
                    onclick="showForm('form-3-1')" 
                    id="tab-3-1"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium whitespace-nowrap transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Form 3.1
                </button>
                <button 
                    onclick="showForm('form-3-2')" 
                    id="tab-3-2"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-blue-300 dark:hover:border-blue-600 hover:text-blue-700 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Form 3.2
                </button>
                <button 
                    onclick="showForm('form-3-3')" 
                    id="tab-3-3"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-blue-300 dark:hover:border-blue-600 hover:text-blue-700 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Form 3.3
                </button>
                <button 
                    onclick="showForm('form-3-4')" 
                    id="tab-3-4"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-blue-300 dark:hover:border-blue-600 hover:text-blue-700 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Form 3.4
                </button>
                <button 
                    onclick="showForm('form-3-5')" 
                    id="tab-3-5"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-blue-300 dark:hover:border-blue-600 hover:text-blue-700 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Form 3.5 (Summary)
                </button>
            </div>

        <!-- Form Content -->
        <div id="form-3-1" class="form-content">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-blue-50 dark:bg-blue-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Form 3.1: TKDN Jasa untuk Manajemen Proyek dan Perekayasaan
                    </h3>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 mb-8 border border-blue-200 dark:border-blue-700">
                        <h4 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 3.1
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-blue-900 dark:text-blue-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-1">Alamat</label>
                                        <p class="text-base font-semibold text-blue-900 dark:text-blue-100">{{ $service->provider_address ?: 'Jl. Sudirman No. 123, Jakarta Pusat' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-1">Nama Jasa</label>
                                        <p class="text-base font-semibold text-blue-900 dark:text-blue-100">{{ $service->service_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-indigo-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-indigo-700 dark:text-indigo-300 mb-1">Pengguna Barang/Jasa</label>
                                        <p class="text-base font-semibold text-indigo-900 dark:text-indigo-100">{{ $service->user_name ?: 'PT Pembangunan Indonesia' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-indigo-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-indigo-700 dark:text-indigo-300 mb-1">No. Dokumen Jasa</label>
                                        <p class="text-base font-semibold text-indigo-900 dark:text-indigo-100">{{ $service->document_number ?: 'DOC-2024-001' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- HPP Data Table -->
                    @php
                        $hppItems = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                            $query->where('project_id', $service->project_id);
                        })
                        ->where('tkdn_classification', '3.1')
                        ->with(['hpp', 'estimation'])
                        ->get();
                    @endphp

                    @if($hppItems->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 border-b border-gray-200 dark:border-gray-600">
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Data HPP - TKDN Classification 3.1
                                </h5>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No.</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Uraian</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kualifikasi</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">WN</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">TKDN (%)</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Durasi</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Upah (Rupiah)</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider" colspan="3">BIAYA (Rupiah)</th>
                                        </tr>
                                        <tr>
                                            <th colspan="8" class="px-6 py-2"></th>
                                            <th class="px-6 py-2 text-center text-xs font-medium text-blue-600 dark:text-blue-400 uppercase tracking-wider">KDN</th>
                                            <th class="px-6 py-2 text-center text-xs font-medium text-red-600 dark:text-red-400 uppercase tracking-wider">KLN</th>
                                            <th class="px-6 py-2 text-center text-xs font-medium text-green-600 dark:text-green-400 uppercase tracking-wider">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($hppItems as $index => $hppItem)
                                            <tr class="hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white text-center">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $hppItem->description }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">-</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">WNI</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        100%
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $hppItem->volume }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $hppItem->duration }} {{ $hppItem->duration_unit }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 dark:text-blue-400 text-right font-medium">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">-</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($hppItem->total_price, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        
                                        <!-- Sub Total -->
                                        <tr class="bg-blue-50 dark:bg-blue-900/20 font-semibold">
                                            <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-blue-900 dark:text-blue-100">SUB TOTAL</td>
                                            <td class="px-6 py-4 text-right text-sm font-bold text-blue-900 dark:text-blue-100">{{ number_format($hppItems->sum('total_price'), 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-right text-sm font-bold text-blue-900 dark:text-blue-100">{{ number_format($hppItems->sum('total_price'), 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-center text-sm font-bold text-blue-900 dark:text-blue-100">-</td>
                                            <td class="px-6 py-4 text-right text-sm font-bold text-blue-900 dark:text-blue-100">{{ number_format($hppItems->sum('total_price'), 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data HPP</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data HPP dengan TKDN Classification 3.1 yang ditemukan untuk project ini.</p>
                                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                                    <p class="text-sm text-blue-800 dark:text-blue-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Data akan muncul setelah generate form TKDN dari HPP yang tersedia.
                                    </p>
                                </div>
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
                        ->with(['hpp', 'estimation'])
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
                                        <th>WN</th>
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
                        ->with(['hpp', 'estimation'])
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
                                        <th>WN</th>
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
                        ->with(['hpp', 'estimation'])
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
                                        <th>WN</th>
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
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Form 3.5: Rangkuman TKDN Jasa</h3>
                </div>
                <div class="card-body">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-1">Informasi Form 3.5</h4>
                                <p class="text-sm text-blue-700 dark:text-blue-300">Formulir ini berisi rangkuman dari semua klasifikasi TKDN (Form 3.1, 3.2, 3.3, dan 3.4) yang telah dibuat sebelumnya.</p>
                            </div>
                        </div>
                    </div>
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

                    <!-- Rangkuman TKDN Table -->
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">(1)</th>
                                    <th class="text-center" colspan="3">BIAYA *) (Rupiah)</th>
                                    <th class="text-center">(5)</th>
                                </tr>
                                <tr>
                                    <th>URAIAN PEKERJAAN</th>
                                    <th class="text-center">KDN</th>
                                    <th class="text-center">KLN</th>
                                    <th class="text-center">TOTAL</th>
                                    <th class="text-center">TKDN Jasa (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Ambil data untuk setiap klasifikasi TKDN
                                    $hppItems31 = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                                        $query->where('project_id', $service->project_id);
                                    })
                                    ->where('tkdn_classification', '3.1')
                                    ->sum('total_price');

                                    $hppItems32 = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                                        $query->where('project_id', $service->project_id);
                                    })
                                    ->where('tkdn_classification', '3.2')
                                    ->sum('total_price');

                                    $hppItems33 = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                                        $query->where('project_id', $service->project_id);
                                    })
                                    ->where('tkdn_classification', '3.3')
                                    ->sum('total_price');

                                    $hppItems34 = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                                        $query->where('project_id', $service->project_id);
                                    })
                                    ->where('tkdn_classification', '3.4')
                                    ->sum('total_price');

                                    // Hitung total KDN dan KLN
                                    // Untuk sementara semua dianggap KDN, bisa diubah sesuai kebutuhan
                                    $totalKdn = $hppItems31 + $hppItems32 + $hppItems33 + $hppItems34;
                                    $totalKln = 0; // Bisa diubah sesuai kebutuhan
                                    $totalBiaya = $totalKdn + $totalKln;
                                    
                                    // Hitung TKDN percentage
                                    $tkdnPercentage = $totalBiaya > 0 ? ($totalKdn / $totalBiaya) * 100 : 0;
                                    
                                    // Hitung persentase untuk setiap kategori
                                    $tkdnPercentage31 = $totalBiaya > 0 ? ($hppItems31 / $totalBiaya) * 100 : 0;
                                    $tkdnPercentage32 = $totalBiaya > 0 ? ($hppItems32 / $totalBiaya) * 100 : 0;
                                    $tkdnPercentage33 = $totalBiaya > 0 ? ($hppItems33 / $totalBiaya) * 100 : 0;
                                    $tkdnPercentage34 = $totalBiaya > 0 ? ($hppItems34 / $totalBiaya) * 100 : 0;
                                @endphp

                                <!-- I. Manajemen Proyek dan Perekayasaan -->
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="font-medium">I. Manajemen Proyek dan Perekayasaan</td>
                                    <td class="text-right">{{ number_format($hppItems31, 0, ',', '.') }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-right">{{ number_format($hppItems31, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($tkdnPercentage31, 2) }}</td>
                                </tr>

                                <!-- II. Alat Kerja/Fasilitas Kerja -->
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="font-medium">II. Alat Kerja/Fasilitas Kerja</td>
                                    <td class="text-right">{{ number_format($hppItems32, 0, ',', '.') }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-right">{{ number_format($hppItems32, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($tkdnPercentage32, 2) }}</td>
                                </tr>

                                <!-- III. Konstruksi dan Fabrikasi -->
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="font-medium">III. Konstruksi dan Fabrikasi</td>
                                    <td class="text-right">{{ number_format($hppItems33, 0, ',', '.') }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-right">{{ number_format($hppItems33, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($tkdnPercentage33, 2) }}</td>
                                </tr>

                                <!-- IV. Jasa Umum -->
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="font-medium">IV. Jasa Umum</td>
                                    <td class="text-right">{{ number_format($hppItems34, 0, ',', '.') }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-right">{{ number_format($hppItems34, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($tkdnPercentage34, 2) }}</td>
                                </tr>

                                <!-- Total Jasa -->
                                <tr class="bg-blue-50 dark:bg-blue-900/20 font-bold border-t-2 border-blue-200 dark:border-blue-700">
                                    <td class="font-bold">Total Jasa</td>
                                    <td class="text-right font-bold text-blue-600 dark:text-blue-400">{{ number_format($totalKdn, 0, ',', '.') }}</td>
                                    <td class="text-center font-bold text-blue-600 dark:text-blue-400">{{ $totalKln > 0 ? number_format($totalKln, 0, ',', '.') : '-' }}</td>
                                    <td class="text-right font-bold text-blue-600 dark:text-blue-400">{{ number_format($totalBiaya, 0, ',', '.') }}</td>
                                    <td class="text-center font-bold text-blue-600 dark:text-blue-400">{{ number_format($tkdnPercentage, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Footnotes -->
                    <div class="mt-6 text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <p>*) Nilai Jasa dapat diambil dari nilai job order, lelang, atau kontrak.</p>
                        <p>Capaian nilai TKDN diatas dinyatakan sendiri oleh {{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                    </div>

                    <!-- Signature Section -->
                    <div class="mt-8 text-right">
                        <p class="text-gray-600 dark:text-gray-400 mb-2">Jakarta, {{ now()->format('d F Y') }}</p>
                        <p class="text-gray-600 dark:text-gray-400 mb-1">Dinyatakan Oleh,</p>
                        <p class="font-bold text-gray-900 dark:text-white mb-4">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                        <div class="mt-16">
                            <p class="font-bold text-gray-900 dark:text-white">_________________________</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Verifikator TKDN</p>
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

        <!-- Tabel Detail Item Service -->
        <div class="bg-white dark:bg-gray-900 mt-6 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-bold text-green-900 dark:text-green-100 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Detail Item Service
                </h3>
            </div>
            
            <!-- TKDN Classification Filter -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center space-x-3">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                            </svg>
                            Filter TKDN Classification:
                        </label>
                        <select id="tkdnFilter" class="form-select w-32 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" onchange="filterTkdnItems()">
                            <option value="">Semua</option>
                            <option value="3.1">3.1</option>
                            <option value="3.2">3.2</option>
                            <option value="3.3">3.3</option>
                            <option value="3.4">3.4</option>
                            <option value="3.5">3.5</option>
                        </select>
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Total Items: <span class="font-semibold text-green-600 dark:text-green-400">{{ $service->items->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Uraian</th>
                            <th>Kualifikasi</th>
                            <th>WN</th>
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
                    <tbody id="tkdnItemsTable">
                        @php
                            // Ambil semua service items untuk service ini
                            $serviceItems = $service->items()
                                ->with(['estimationItem'])
                                ->orderBy('item_number')
                                ->get();
                        @endphp

                        @if($serviceItems->count() > 0)
                            @foreach($serviceItems as $index => $serviceItem)
                                <tr class="tkdn-item-row hover:bg-gray-50 dark:hover:bg-gray-700" data-tkdn-classification="{{ $serviceItem->tkdn_classification }}">
                                    <td class="text-center">{{ $serviceItem->item_number }}</td>
                                    <td>{{ $serviceItem->description }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($serviceItem->qualification ?? '-', 30) }}</td>
                                    <td>{{ $serviceItem->nationality }}</td>
                                    <td class="text-center">{{ number_format($serviceItem->tkdn_percentage, 1) }}%</td>
                                    <td class="text-center">{{ $serviceItem->quantity }}</td>
                                    <td class="text-center">{{ $serviceItem->duration }} {{ $serviceItem->duration_unit }}</td>
                                    <td class="text-right">{{ number_format($serviceItem->wage, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($serviceItem->domestic_cost, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($serviceItem->foreign_cost, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($serviceItem->total_cost, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            
                            <!-- Sub Total -->
                            <tr class="bg-gray-50 dark:bg-gray-700 font-semibold">
                                <td colspan="7" class="text-center">SUB TOTAL</td>
                                <td class="text-right">{{ number_format($serviceItems->sum('wage'), 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($serviceItems->sum('domestic_cost'), 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($serviceItems->sum('foreign_cost'), 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($serviceItems->sum('total_cost'), 0, ',', '.') }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="11" class="text-center py-8">
                                    <div class="text-gray-500 dark:text-gray-400">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-lg font-medium">Tidak ada data service items ditemukan</p>
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
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-bold text-purple-900 dark:text-purple-100 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Ringkasan TKDN
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl border border-blue-200 dark:border-blue-700">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                            {{ number_format($service->tkdn_percentage, 2) }}%
                        </div>
                        <div class="text-sm font-medium text-blue-700 dark:text-blue-300">Persentase TKDN</div>
                    </div>
                    
                    <div class="text-center p-6 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-xl border border-green-200 dark:border-green-700">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-2">
                            Rp {{ number_format($service->total_domestic_cost, 0, ',', '.') }}
                        </div>
                        <div class="text-sm font-medium text-green-700 dark:text-green-300">Total Biaya KDN</div>
                    </div>
                    
                    <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl border border-purple-200 dark:border-purple-700">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-2">
                            Rp {{ number_format($service->total_cost, 0, ',', '.') }}
                        </div>
                        <div class="text-sm font-medium text-purple-700 dark:text-purple-300">Total Biaya</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-8">
            <a href="{{ route('service.index') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl font-medium hover:border-blue-300 dark:hover:border-blue-600 hover:text-blue-700 dark:hover:text-blue-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
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
    
    // Remove active state from all tabs and reset to default styling
    const allTabs = document.querySelectorAll('[id^="tab-"]');
    allTabs.forEach(tab => {
        // Remove active state classes
        tab.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'text-white', 'shadow-lg', 'hover:shadow-xl', 'transform', 'hover:-translate-y-0.5');
        
        // Reset to default inactive state
        tab.classList.add('bg-white', 'dark:bg-gray-800', 'border-2', 'border-gray-200', 'dark:border-gray-700', 'text-gray-700', 'dark:text-gray-300', 'shadow-sm');
    });
    
    // Show selected form
    const selectedForm = document.getElementById(formId);
    if (selectedForm) {
        selectedForm.classList.remove('hidden');
    }
    
    // Update active tab with proper styling
    const tabId = formId.replace('form-', 'tab-');
    const activeTab = document.getElementById(tabId);
    if (activeTab) {
        // Remove default inactive classes
        activeTab.classList.remove('bg-white', 'dark:bg-gray-800', 'border-2', 'border-gray-200', 'dark:border-gray-700', 'text-gray-700', 'dark:text-gray-300', 'shadow-sm');
        
        // Add active state classes
        activeTab.classList.add('bg-blue-600', 'hover:bg-blue-700', 'text-white', 'shadow-lg', 'hover:shadow-xl', 'transform', 'hover:-translate-y-0.5');
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