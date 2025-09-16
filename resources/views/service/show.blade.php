@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <!-- Hero Header -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex-1 min-w-0">
                    <!-- Breadcrumb -->
                    <nav class="flex mb-6" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('service.index') }}" class="inline-flex items-center text-blue-200 hover:text-white transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                    </svg>
                                    Services
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-blue-200 md:ml-2">Detail Service</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <!-- Main Header Content -->
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h1 class="text-4xl font-bold text-white mb-2">{{ $service->service_name }}</h1>
                            <p class="text-xl text-blue-100 mb-4">{{ $service->getFormTitle() }}</p>
                            
                            <!-- Status and Category Badges -->
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30 backdrop-blur-sm">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    {{ ucfirst($service->status) }}
                                </span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $service->form_category === 'tkdn_jasa' ? 'bg-blue-500/30 text-blue-100 border border-blue-400/30' : 'bg-green-500/30 text-green-100 border border-green-400/30' }} backdrop-blur-sm">
                                    {{ $service->getFormCategoryLabel() }}
                                </span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-purple-500/30 text-purple-100 border border-purple-400/30 backdrop-blur-sm">
                                    {{ $service->getServiceTypeLabel() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service Info Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl p-6 border border-white/50 dark:border-gray-600/50 hover:bg-white dark:hover:bg-gray-800 transition-all duration-200 shadow-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Project</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $service->project->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl p-6 border border-white/50 dark:border-gray-600/50 hover:bg-white dark:hover:bg-gray-800 transition-all duration-200 shadow-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Cost</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">Rp {{ number_format($service->total_cost, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl p-6 border border-white/50 dark:border-gray-600/50 hover:bg-white dark:hover:bg-gray-800 transition-all duration-200 shadow-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">TKDN %</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ number_format($service->tkdn_percentage, 1) }}%</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl p-6 border border-white/50 dark:border-gray-600/50 hover:bg-white dark:hover:bg-gray-800 transition-all duration-200 shadow-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Items</p>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $service->items->count() }} Items</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-8 lg:mt-0 lg:ml-8">
                    <div class="flex flex-col sm:flex-row gap-3">
                        @if($service->status === 'draft')
                            <!-- Edit Button -->
                            <a href="{{ route('service.edit', $service) }}" class="inline-flex items-center justify-center px-6 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-sm font-medium text-white hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Service
                            </a>
                            
                            <!-- Generate All Forms Button -->
                            <form action="{{ route('service.generate', $service) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 border border-transparent rounded-xl text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6l.586-.586a2 2 0 012.828 0L20 8m-6-6L16 4m-6 6l.586-.586a2 2 0 012.828 0L20 8m-6-6L16 4"></path>
                                    </svg>
                                    Generate All Forms
                                </button>
                            </form>
                            
                            <!-- Submit Button -->
                            <form action="{{ route('service.submit', $service) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 border border-transparent rounded-xl text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-500/50 transition-all duration-200 shadow-lg hover:shadow-xl">
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
                                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 border border-transparent rounded-xl text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-500/50 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('service.reject', $service) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 border border-transparent rounded-xl text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Reject
                                </button>
                            </form>
                        @endif
                    </div>
                    
                    <!-- Secondary Actions - Generate Individual Forms -->
                    @if($service->status === 'draft')
                        <div class="mt-4">
                            <div class="flex items-center space-x-3">
                                <span class="text-sm text-blue-100 font-medium">Generate Individual Forms:</span>
                                <div class="flex flex-wrap gap-2">
                                    <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.1']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-white/20 hover:bg-white/30 border border-white/30 rounded-lg text-xs font-medium text-white hover:text-white transition-all duration-200 backdrop-blur-sm">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Form 3.1
                                        </button>
                                    </form>
                                    <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.2']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:hover:bg-green-900/50 border border-green-200 dark:border-green-700 rounded-md text-xs font-medium text-green-700 dark:text-green-300 hover:text-green-800 dark:hover:text-green-200 transition-all duration-200">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                            Form 3.2
                                        </button>
                                    </form>
                                    <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.3']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-purple-100 hover:bg-purple-200 dark:bg-purple-900/30 dark:hover:bg-purple-900/50 border border-purple-200 dark:border-purple-700 rounded-md text-xs font-medium text-purple-700 dark:text-purple-300 hover:text-purple-800 dark:hover:text-purple-200 transition-all duration-200">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            Form 3.3
                                        </button>
                                    </form>
                                    <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.4']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-orange-100 hover:bg-orange-200 dark:bg-orange-900/30 dark:hover:bg-orange-900/50 border border-orange-200 dark:border-orange-700 rounded-md text-xs font-medium text-orange-700 dark:text-orange-300 hover:text-orange-800 dark:hover:text-orange-200 transition-all duration-200">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Form 3.4
                                        </button>
                                    </form>
                                    <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.5']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900/30 dark:hover:bg-indigo-900/50 border border-indigo-200 dark:border-indigo-700 rounded-md text-xs font-medium text-indigo-700 dark:text-indigo-300 hover:text-indigo-800 dark:hover:text-indigo-200 transition-all duration-200">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                            Form 3.5
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        <div class="flex flex-wrap items-center gap-3 mb-6">
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

        <!-- Enhanced Action Buttons Section -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 100 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                    </svg>
                    Service Actions
                </h3>
                
                <!-- Debug Button -->
                <a href="{{ route('service.debug-hpp-items', $service) }}" target="_blank" class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Debug HPP Items
                </a>
            </div>
            
            <!-- Primary Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                @if($service->status === 'draft')
                    <!-- Edit Service -->
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg p-4 border border-blue-200 dark:border-blue-700">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-semibold text-blue-900 dark:text-blue-100">Edit Service</h4>
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-blue-700 dark:text-blue-300 mb-3">Modify service details and configuration</p>
                        <a href="{{ route('service.edit', $service) }}" class="w-full inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 border border-transparent rounded-md text-xs font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Service
                        </a>
                    </div>
                    
                    <!-- Generate All Forms -->
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-lg p-4 border border-purple-200 dark:border-purple-700">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-semibold text-purple-900 dark:text-purple-100">Generate All Forms</h4>
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6l.586-.586a2 2 0 012.828 0L20 8m-6-6L16 4m-6 6l.586-.586a2 2 0 012.828 0L20 8m-6-6L16 4"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-purple-700 dark:text-purple-300 mb-3">Generate all TKDN forms at once</p>
                        <form action="{{ route('service.generate', $service) }}" method="POST" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-purple-600 hover:bg-purple-700 border border-transparent rounded-md text-xs font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6l.586-.586a2 2 0 012.828 0L20 8m-6-6L16 4m-6 6l.586-.586a2 2 0 012.828 0L20 8m-6-6L16 4"></path>
                                </svg>
                                Generate All
                            </button>
                        </form>
                    </div>
                    
                    <!-- Submit for Approval -->
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg p-4 border border-blue-200 dark:border-blue-700">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-semibold text-blue-900 dark:text-blue-100">Submit for Approval</h4>
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-blue-700 dark:text-blue-300 mb-3">Submit service for approval process</p>
                        <form action="{{ route('service.submit', $service) }}" method="POST" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 border border-transparent rounded-md text-xs font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Submit
                            </button>
                        </form>
                    </div>
                @endif
                
                @if($service->status === 'submitted')
                    <!-- Approve Service -->
                    <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-lg p-4 border border-green-200 dark:border-green-700">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-semibold text-green-900 dark:text-green-100">Approve Service</h4>
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-green-700 dark:text-green-300 mb-3">Approve the submitted service</p>
                        <form action="{{ route('service.approve', $service) }}" method="POST" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-green-600 hover:bg-green-700 border border-transparent rounded-md text-xs font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Approve
                            </button>
                        </form>
                    </div>
                    
                    <!-- Reject Service -->
                    <div class="bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 rounded-lg p-4 border border-red-200 dark:border-red-700">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-semibold text-red-900 dark:text-red-100">Reject Service</h4>
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-red-700 dark:text-red-300 mb-3">Reject the submitted service</p>
                        <form action="{{ route('service.reject', $service) }}" method="POST" class="inline w-full">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-600 hover:bg-red-700 border border-transparent rounded-md text-xs font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reject
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            
            <!-- Secondary Actions - Generate Individual Forms -->
            @if($service->status === 'draft')
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Generate Individual Forms</h4>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Select specific TKDN forms to generate</span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                        <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.1']) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 border border-blue-200 dark:border-blue-700 rounded-md text-xs font-medium text-blue-700 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200 transition-all duration-200">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Form 3.1
                            </button>
                        </form>
                        <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.2']) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:hover:bg-green-900/50 border border-green-200 dark:border-green-700 rounded-md text-xs font-medium text-green-700 dark:text-green-300 hover:text-green-800 dark:hover:text-green-200 transition-all duration-200">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                Form 3.2
                            </button>
                        </form>
                        <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.3']) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-purple-100 hover:bg-purple-200 dark:bg-purple-900/30 dark:hover:bg-purple-900/50 border border-purple-200 dark:border-purple-700 rounded-md text-xs font-medium text-purple-700 dark:text-purple-300 hover:text-purple-800 dark:hover:text-purple-200 transition-all duration-200">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Form 3.3
                            </button>
                        </form>
                        <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.4']) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-orange-100 hover:bg-orange-200 dark:bg-orange-900/30 dark:hover:bg-orange-900/50 border border-orange-200 dark:border-orange-700 rounded-md text-xs font-medium text-orange-700 dark:text-orange-300 hover:text-orange-800 dark:hover:text-orange-200 transition-all duration-200">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Form 3.4
                            </button>
                        </form>
                        <form action="{{ route('service.generate-form', ['service' => $service->id, 'formNumber' => '3.5']) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900/30 dark:hover:bg-indigo-900/50 border border-indigo-200 dark:border-indigo-700 rounded-md text-xs font-medium text-indigo-700 dark:text-indigo-300 hover:text-indigo-800 dark:hover:text-indigo-200 transition-all duration-200">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Form 3.5
                            </button>
                        </form>
                    </div>
                </div>
            @endif
            
            <!-- Regenerate Form 3.4 Button (if needed) -->
            @if($service->status === 'generated' || $service->status === 'approved')
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Troubleshooting Actions</h4>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Fix specific form issues</span>
                    </div>
                    <div class="flex gap-3">
                        <button onclick="regenerateForm34()" class="inline-flex items-center px-3 py-2 bg-orange-100 hover:bg-orange-200 dark:bg-orange-900/30 dark:hover:bg-orange-900/50 border border-orange-200 dark:border-orange-700 rounded-md text-xs font-medium text-orange-700 dark:text-orange-300 hover:text-orange-800 dark:hover:text-orange-200 transition-all duration-200">
                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Regenerate Form 3.4
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Form Navigation Tabs -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-2 overflow-x-auto pb-2">
                <!-- Individual Form Tabs (3.1, 3.2, 3.3, 3.4) -->
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
                
                <!-- Form 4.x Tabs -->
                <button 
                    onclick="showForm('form-4-1')" 
                    id="tab-4-1"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-green-300 dark:hover:border-green-600 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    Form 4.1
                </button>
                <button 
                    onclick="showForm('form-4-2')" 
                    id="tab-4-2"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-green-300 dark:hover:border-green-600 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Form 4.2
                </button>
                <button 
                    onclick="showForm('form-4-3')" 
                    id="tab-4-3"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-green-300 dark:hover:border-green-600 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    </svg>
                    Form 4.3
                </button>
                <button 
                    onclick="showForm('form-4-4')" 
                    id="tab-4-4"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-green-300 dark:hover:border-green-600 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Form 4.4
                </button>
                <button 
                    onclick="showForm('form-4-5')" 
                    id="tab-4-5"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-green-300 dark:hover:border-green-600 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                    </svg>
                    Form 4.5
                </button>
                <button 
                    onclick="showForm('form-4-6')" 
                    id="tab-4-6"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-green-300 dark:hover:border-green-600 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Form 4.6
                </button>
                <button 
                    onclick="showForm('form-4-7')" 
                    id="tab-4-7"
                    class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium whitespace-nowrap hover:border-green-300 dark:hover:border-green-600 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Form 4.7
                </button>
                
                <!-- Summary Form Tab (3.5) - Different Style -->
                <div class="flex items-center mx-2">
                    <div class="w-px h-8 bg-gray-300 dark:bg-gray-600"></div>
                </div>
                <button 
                    onclick="showForm('form-3-5')" 
                    id="tab-3-5"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-xl font-medium whitespace-nowrap transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 border-2 border-purple-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="font-semibold">Form 3.5</span>
                    <span class="ml-2 px-2 py-0.5 bg-white/20 rounded-full text-xs font-medium">Summary</span>
                </button>
            </div>

        <!-- Form Content -->
        <div id="form-3-1" class="form-content">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-blue-50 dark:bg-blue-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Form 3.1: TKDN Jasa untuk Manajemen Proyek dan Perekayasaan
                        </h3>
                        
                        <!-- Export Excel Button for Form 3.1 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.1']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
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
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Form 3.2: TKDN Jasa untuk Alat Kerja dan Peralatan
                        </h3>
                        
                        <!-- Export Excel Button for Form 3.2 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.2']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 mb-8 border border-green-200 dark:border-green-700">
                        <h4 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 3.2
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Alamat</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->provider_address ?: 'Jl. Sudirman No. 123, Jakarta Pusat' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Nama Jasa</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->service_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-emerald-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-emerald-700 dark:text-emerald-300 mb-1">Pengguna Barang/Jasa</label>
                                        <p class="text-base font-semibold text-emerald-900 dark:text-emerald-100">{{ $service->user_name ?: 'PT Pembangunan Indonesia' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-emerald-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-emerald-700 dark:text-emerald-300 mb-1">No. Dokumen Jasa</label>
                                        <p class="text-base font-semibold text-emerald-900 dark:text-emerald-100">{{ $service->document_number ?: 'DOC-2024-001' }}</p>
                                    </div>
                                </div>
                            </div>
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
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 border-b border-gray-200 dark:border-gray-600">
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Data HPP - TKDN Classification 3.2
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
                                        @foreach($hppItems2 as $index => $hppItem)
                                            <tr class="hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors duration-200">
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
                                        <tr class="bg-green-50 dark:bg-green-900/20 font-semibold">
                                            <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">SUB TOTAL</td>
                                            <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($hppItems2->sum('total_price'), 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($hppItems2->sum('total_price'), 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">-</td>
                                            <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($hppItems2->sum('total_price'), 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data HPP</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data HPP dengan TKDN Classification 3.2 yang ditemukan untuk project ini.</p>
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4">
                                    <p class="text-sm text-green-800 dark:text-green-200">
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

        <div id="form-3-3" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-purple-50 dark:bg-purple-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Form 3.3: TKDN Jasa untuk Konstruksi dan Fabrikasi
                        </h3>
                        
                        <!-- Export Excel Button for Form 3.3 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.3']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-6 mb-8 border border-purple-200 dark:border-purple-700">
                        <h4 class="text-lg font-semibold text-purple-900 dark:text-purple-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 3.3
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-purple-700 dark:text-purple-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-purple-900 dark:text-purple-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-purple-700 dark:text-purple-300 mb-1">Alamat</label>
                                        <p class="text-base font-semibold text-purple-900 dark:text-purple-100">{{ $service->provider_address ?: 'Jl. Sudirman No. 123, Jakarta Pusat' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-purple-700 dark:text-purple-300 mb-1">Nama Jasa</label>
                                        <p class="text-base font-semibold text-purple-900 dark:text-purple-100">{{ $service->service_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-violet-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-violet-700 dark:text-violet-300 mb-1">Pengguna Barang/Jasa</label>
                                        <p class="text-base font-semibold text-violet-900 dark:text-violet-100">{{ $service->user_name ?: 'PT Pembangunan Indonesia' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-violet-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-violet-700 dark:text-violet-300 mb-1">No. Dokumen Jasa</label>
                                        <p class="text-base font-semibold text-violet-900 dark:text-violet-100">{{ $service->document_number ?: 'DOC-2024-001' }}</p>
                                    </div>
                                </div>
                            </div>
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
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 border-b border-gray-200 dark:border-gray-600">
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Data HPP - TKDN Classification 3.3
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
                                        @foreach($hppItems3 as $index => $hppItem)
                                            <tr class="hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors duration-200">
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
                                        <tr class="bg-purple-50 dark:bg-purple-900/20 font-semibold">
                                            <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-purple-900 dark:text-purple-100">SUB TOTAL</td>
                                            <td class="px-6 py-4 text-right text-sm font-bold text-purple-900 dark:text-purple-100">{{ number_format($hppItems3->sum('total_price'), 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-right text-sm font-bold text-purple-900 dark:text-purple-100">{{ number_format($hppItems3->sum('total_price'), 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-center text-sm font-bold text-purple-900 dark:text-purple-100">-</td>
                                            <td class="px-6 py-4 text-right text-sm font-bold text-purple-900 dark:text-purple-100">{{ number_format($hppItems3->sum('total_price'), 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data HPP</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data HPP dengan TKDN Classification 3.3 yang ditemukan untuk project ini.</p>
                                <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-700 rounded-lg p-4">
                                    <p class="text-sm text-purple-800 dark:text-purple-200">
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

        <div id="form-3-4" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-orange-50 dark:bg-orange-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Form 3.4: TKDN Jasa untuk Konsultasi dan Pengawasan
                        </h3>
                        
                        <!-- Export Excel Button for Form 3.4 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.4']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-orange-50 dark:bg-orange-900/20 rounded-xl p-6 mb-8 border border-orange-200 dark:border-orange-700">
                        <h4 class="text-lg font-semibold text-orange-900 dark:text-orange-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 3.4
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-orange-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-orange-700 dark:text-orange-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-orange-900 dark:text-orange-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-orange-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-orange-700 dark:text-orange-300 mb-1">Alamat</label>
                                        <p class="text-base font-semibold text-orange-900 dark:text-orange-100">{{ $service->provider_address ?: 'Jl. Sudirman No. 123, Jakarta Pusat' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-orange-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-orange-700 dark:text-orange-300 mb-1">Nama Jasa</label>
                                        <p class="text-base font-semibold text-orange-900 dark:text-orange-100">{{ $service->service_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-amber-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-amber-700 dark:text-amber-300 mb-1">Pengguna Barang/Jasa</label>
                                        <p class="text-base font-semibold text-amber-900 dark:text-amber-100">{{ $service->user_name ?: 'PT Pembangunan Indonesia' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-amber-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-amber-700 dark:text-amber-300 mb-1">No. Dokumen Jasa</label>
                                        <p class="text-base font-semibold text-amber-900 dark:text-amber-100">{{ $service->document_number ?: 'DOC-2024-001' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    @php
                        // Coba ambil data dari HPP items terlebih dahulu
                        $hppItems4 = \App\Models\HppItem::whereHas('hpp', function ($query) use ($service) {
                            $query->where('project_id', $service->project_id);
                        })
                        ->where('tkdn_classification', '3.4')
                        ->with(['hpp', 'estimation'])
                        ->get();

                        // Jika tidak ada data HPP, ambil dari Service Items
                        $serviceItems4 = collect();
                        if ($hppItems4->count() === 0) {
                            $serviceItems4 = $service->items()->where('tkdn_classification', '3.4')->get();
                        }
                    @endphp

                    @if($hppItems4->count() > 0 || $serviceItems4->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 border-b border-gray-200 dark:border-gray-600">
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    @if($hppItems4->count() > 0)
                                        Data HPP - TKDN Classification 3.4
                                    @else
                                        Data Service - TKDN Classification 3.4
                                    @endif
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
                                        @if($hppItems4->count() > 0)
                                            @foreach($hppItems4 as $index => $hppItem)
                                                <tr class="hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors duration-200">
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
                                        @else
                                            @foreach($serviceItems4 as $index => $serviceItem)
                                                <tr class="hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white text-center">{{ $serviceItem->item_number }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $serviceItem->description }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $serviceItem->qualification ?? '-' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $serviceItem->nationality }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                            {{ number_format($serviceItem->tkdn_percentage, 1) }}%
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $serviceItem->quantity }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $serviceItem->duration }} {{ $serviceItem->duration_unit }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($serviceItem->wage, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 dark:text-blue-400 text-right font-medium">{{ number_format($serviceItem->domestic_cost, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400 text-right font-medium">{{ number_format($serviceItem->foreign_cost, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($serviceItem->total_cost, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        
                                        <!-- Sub Total -->
                                        <tr class="bg-orange-50 dark:bg-orange-900/20 font-semibold">
                                            <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-orange-900 dark:text-orange-100">SUB TOTAL</td>
                                            @if($hppItems4->count() > 0)
                                                <td class="px-6 py-4 text-right text-sm font-bold text-orange-900 dark:text-orange-100">{{ number_format($hppItems4->sum('total_price'), 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 text-right text-sm font-bold text-orange-900 dark:text-orange-100">{{ number_format($hppItems4->sum('total_price'), 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 text-center text-sm font-bold text-orange-900 dark:text-orange-100">-</td>
                                                <td class="px-6 py-4 text-right text-sm font-bold text-orange-900 dark:text-orange-100">{{ number_format($hppItems4->sum('total_price'), 0, ',', '.') }}</td>
                                            @else
                                                <td class="px-6 py-4 text-right text-sm font-bold text-orange-900 dark:text-orange-100">{{ number_format($serviceItems4->sum('wage'), 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 text-right text-sm font-bold text-orange-900 dark:text-orange-100">{{ number_format($serviceItems4->sum('domestic_cost'), 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 text-right text-sm font-bold text-orange-900 dark:text-orange-100">{{ number_format($serviceItems4->sum('foreign_cost'), 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 text-right text-sm font-bold text-orange-900 dark:text-orange-100">{{ number_format($serviceItems4->sum('total_cost'), 0, ',', '.') }}</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data HPP</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data HPP dengan TKDN Classification 3.4 yang ditemukan untuk project ini.</p>
                                <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700 rounded-lg p-4">
                                    <p class="text-sm text-orange-800 dark:text-orange-200">
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

        <div id="form-3-5" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-indigo-50 dark:bg-indigo-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Form 3.5: Rangkuman TKDN Jasa
                        </h3>
                        
                        <!-- Export Excel Button for Form 3.5 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.5']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Summary Info Box -->
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 border border-purple-200 dark:border-purple-700 rounded-xl p-6 mb-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-purple-900 dark:text-purple-100 mb-2">Rangkuman TKDN Jasa</h4>
                                <p class="text-sm text-purple-700 dark:text-purple-300 mb-3">Formulir ini berisi rangkuman dari semua klasifikasi TKDN (Form 3.1, 3.2, 3.3, dan 3.4) yang telah dibuat sebelumnya.</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        Form 3.1: Manajemen Proyek
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Form 3.2: Alat Kerja
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                        Form 3.3: Konstruksi
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                        Form 3.4: Konsultasi
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Form 3.1 Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl p-6 border border-blue-200 dark:border-blue-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Form 3.1</p>
                                    <p class="text-xs text-blue-500 dark:text-blue-500">Manajemen Proyek</p>
                                </div>
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-2xl font-bold text-blue-900 dark:text-blue-100" id="form31-total">Rp 0</p>
                                <p class="text-xs text-blue-600 dark:text-blue-400">Total Biaya</p>
                            </div>
                        </div>

                        <!-- Form 3.2 Card -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl p-6 border border-green-200 dark:border-green-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-green-600 dark:text-green-400">Form 3.2</p>
                                    <p class="text-xs text-green-500 dark:text-green-500">Alat Kerja</p>
                                </div>
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-2xl font-bold text-green-900 dark:text-green-100" id="form32-total">Rp 0</p>
                                <p class="text-xs text-green-600 dark:text-green-400">Total Biaya</p>
                            </div>
                        </div>

                        <!-- Form 3.3 Card -->
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-xl p-6 border border-purple-200 dark:border-purple-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-purple-600 dark:text-purple-400">Form 3.3</p>
                                    <p class="text-xs text-purple-500 dark:text-purple-500">Konstruksi</p>
                                </div>
                                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-2xl font-bold text-purple-900 dark:text-purple-100" id="form33-total">Rp 0</p>
                                <p class="text-xs text-purple-600 dark:text-purple-400">Total Biaya</p>
                            </div>
                        </div>

                        <!-- Form 3.4 Card -->
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 rounded-xl p-6 border border-orange-200 dark:border-orange-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-orange-600 dark:text-orange-400">Form 3.4</p>
                                    <p class="text-xs text-orange-500 dark:text-orange-500">Konsultasi</p>
                                </div>
                                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-2xl font-bold text-orange-900 dark:text-orange-100" id="form34-total">Rp 0</p>
                                <p class="text-xs text-orange-600 dark:text-orange-400">Total Biaya</p>
                            </div>
                        </div>
                    </div>

                    <!-- Rangkuman TKDN Table -->
                    @php
                        // Ambil data dari Service Items untuk Form 3.5 (rangkuman)
                        $summaryItems = $service->items()->where('tkdn_classification', '3.5')->get();
                        
                        // Hitung total dari semua form
                        $totalKdn = $summaryItems->sum('domestic_cost');
                        $totalKln = $summaryItems->sum('foreign_cost');
                        $totalBiaya = $summaryItems->sum('total_cost');
                        
                        // Hitung TKDN percentage keseluruhan
                        $tkdnPercentage = $totalBiaya > 0 ? ($totalKdn / $totalBiaya) * 100 : 0;
                    @endphp

                    @if($summaryItems->count() > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 border-b border-purple-200 dark:border-purple-600">
                                <h5 class="text-lg font-semibold text-purple-900 dark:text-purple-100 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Rangkuman TKDN Jasa
                                </h5>
                            </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">(1)</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider" colspan="3">BIAYA *) (Rupiah)</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">(5)</th>
                                    </tr>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">URAIAN PEKERJAAN</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">KDN</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">KLN</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">TOTAL</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">TKDN Jasa (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($summaryItems as $item)
                                        @if($item->description !== 'Total Jasa')
                                            <tr class="hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $item->description }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 dark:text-blue-400 text-right font-medium">{{ number_format($item->domestic_cost, 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400 text-right font-medium">{{ number_format($item->foreign_cost, 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($item->total_cost, 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                        {{ number_format($item->tkdn_percentage, 2) }}%
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach



                                    <!-- Total Jasa -->
                                    <tr class="bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 font-bold border-t-2 border-purple-200 dark:border-purple-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-purple-900 dark:text-purple-100">Total Jasa</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-purple-900 dark:text-purple-100 text-right">{{ number_format($totalKdn, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-purple-900 dark:text-purple-100 text-right">{{ number_format($totalKln, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-purple-900 dark:text-purple-100 text-right bg-purple-100 dark:bg-purple-800">{{ number_format($totalBiaya, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
                                                {{ number_format($tkdnPercentage, 2) }}%
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data Rangkuman</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Form 3.5 akan menampilkan rangkuman setelah form individual (3.1, 3.2, 3.3, 3.4) di-generate.</p>
                                <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-700 rounded-lg p-4">
                                    <p class="text-sm text-purple-800 dark:text-purple-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Generate form TKDN terlebih dahulu untuk melihat rangkuman.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Footnotes -->
                    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                        <div class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                            <p><span class="font-medium">*)</span> Nilai Jasa dapat diambil dari nilai job order, lelang, atau kontrak.</p>
                            <p>Capaian nilai TKDN diatas dinyatakan sendiri oleh <span class="font-medium">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</span></p>
                        </div>
                    </div>

                    <!-- Signature Section -->
                    <div class="mt-8 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-xl border border-indigo-200 dark:border-indigo-700">
                        <div class="text-right">
                            <p class="text-gray-600 dark:text-gray-400 mb-2">Jakarta, {{ now()->format('d F Y') }}</p>
                            <p class="text-gray-600 dark:text-gray-400 mb-1">Dinyatakan Oleh,</p>
                            <p class="font-bold text-gray-900 dark:text-white mb-8">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                            <div class="mt-16">
                                <p class="font-bold text-gray-900 dark:text-white text-lg">_________________________</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Verifikator TKDN</p>
                            </div>
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

        <!-- Export Summary Section -->
        @if($service->status === 'generated' || $service->status === 'approved')
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden mt-8">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-green-900 dark:text-green-100 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export Excel TKDN Forms
                    </h3>
                    
                    <!-- Export All Forms Button -->
                    <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => 'all']) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6l.586-.586a2 2 0 012.828 0L20 8m-6-6L16 4m-6 6l.586-.586a2 2 0 012.828 0L20 8m-6-6L16 4"></path>
                        </svg>
                        Export Semua Form Excel
                    </a>
                </div>
                
                <p class="text-green-700 dark:text-green-300 text-sm mt-2">Download semua form TKDN dalam satu file Excel atau pilih form tertentu</p>
            </div>
            <div class="p-6">
                <!-- Quick Export Buttons -->
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.1']) }}" class="flex flex-col items-center p-4 bg-white dark:bg-gray-800 rounded-xl border-2 border-blue-200 dark:border-blue-700 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/40 rounded-full flex items-center justify-center mb-3">
                            <span class="text-blue-600 dark:text-blue-400 text-lg font-bold">3.1</span>
                        </div>
                        <span class="text-sm font-medium text-blue-700 dark:text-blue-300 text-center mb-1">Manajemen</span>
                        <span class="text-xs text-blue-600 dark:text-blue-400 text-center">Proyek & Perekayasaan</span>
                    </a>
                    <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.2']) }}" class="flex flex-col items-center p-4 bg-white dark:bg-gray-800 rounded-xl border-2 border-green-200 dark:border-green-700 hover:bg-green-50 dark:hover:bg-green-900/20 hover:border-green-300 dark:hover:border-green-600 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/40 rounded-full flex items-center justify-center mb-3">
                            <span class="text-green-600 dark:text-green-400 text-lg font-bold">3.2</span>
                        </div>
                        <span class="text-sm font-medium text-green-700 dark:text-green-300 text-center mb-1">Alat Kerja</span>
                        <span class="text-xs text-green-600 dark:text-green-400 text-center">& Peralatan</span>
                    </a>
                    <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.3']) }}" class="flex flex-col items-center p-4 bg-white dark:bg-gray-800 rounded-xl border-2 border-purple-200 dark:border-purple-700 hover:bg-purple-50 dark:hover:bg-purple-900/20 hover:border-purple-300 dark:hover:border-purple-600 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/40 rounded-full flex items-center justify-center mb-3">
                            <span class="text-blue-600 dark:text-blue-400 text-lg font-bold">3.3</span>
                        </div>
                        <span class="text-sm font-medium text-purple-700 dark:text-purple-300 text-center mb-1">Konstruksi</span>
                        <span class="text-xs text-purple-600 dark:text-purple-400 text-center">& Fabrikasi</span>
                    </a>
                    <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.4']) }}" class="flex flex-col items-center p-4 bg-white dark:bg-gray-800 rounded-xl border-2 border-orange-200 dark:border-orange-700 hover:bg-orange-50 dark:hover:bg-orange-900/20 hover:border-orange-300 dark:hover:border-orange-600 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/40 rounded-full flex items-center justify-center mb-3">
                            <span class="text-orange-600 dark:text-orange-400 text-lg font-bold">3.4</span>
                        </div>
                        <span class="text-sm font-medium text-orange-700 dark:text-orange-300 text-center mb-1">Konsultasi</span>
                        <span class="text-xs text-orange-600 dark:text-orange-400 text-center">& Pengawasan</span>
                    </a>
                    <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '3.5']) }}" class="flex flex-col items-center p-4 bg-white dark:bg-gray-800 rounded-xl border-2 border-indigo-200 dark:border-indigo-700 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 hover:border-indigo-300 dark:hover:border-indigo-600 transition-all duration-200 shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/40 rounded-full flex items-center justify-center mb-3">
                            <span class="text-indigo-600 dark:text-indigo-400 text-lg font-bold">3.5</span>
                        </div>
                        <span class="text-sm font-medium text-indigo-700 dark:text-indigo-300 text-center mb-1">Rangkuman</span>
                        <span class="text-xs text-indigo-600 dark:text-indigo-400 text-center">Semua Form</span>
                    </a>
                </div>
                
                <!-- Export Info -->
                <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            <p class="font-medium mb-1">Cara Export Excel:</p>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Klik tombol "Export Excel" di header masing-masing form untuk download form tertentu</li>
                                <li>Atau gunakan tombol "Export Semua Form Excel" untuk download semua form dalam satu file</li>
                                <li>File Excel akan otomatis terdownload dengan format yang sesuai standar TKDN</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

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

        <!-- Form 4.1 - Jasa Teknik dan Rekayasa -->
        <div id="form-4-1" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            Form 4.1: TKDN Jasa untuk Teknik dan Rekayasa
                        </h3>
                        
                        <!-- Export Excel Button for Form 4.1 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '4.1']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 mb-8 border border-green-200 dark:border-green-700">
                        <h4 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 4.1
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Classification</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">4.1 - Jasa Teknik dan Rekayasa</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Percentage</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">100% (WNI)</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Status</label>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Items Table -->
                    @php
                        $serviceItems41 = $service->items()->where('tkdn_classification', '4.1')->get();
                    @endphp

                    @if($serviceItems41->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-green-50 dark:bg-green-900/20">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Uraian</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kualifikasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kewarganegaraan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">TKDN (%)</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Upah (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KDN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KLN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Total Biaya (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($serviceItems41 as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white text-center">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->description }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $item->qualification ?: '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->nationality }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    {{ number_format($item->tkdn_percentage, 0) }}%
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->duration }} {{ $item->duration_unit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->wage, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($item->domestic_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">-</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->total_cost, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-green-50 dark:bg-green-900/20 font-semibold">
                                        <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">SUB TOTAL</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems41->sum('wage'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems41->sum('domestic_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">-</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems41->sum('total_cost'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data service items dengan TKDN Classification 4.1 yang ditemukan.</p>
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4">
                                    <p class="text-sm text-green-800 dark:text-green-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Data akan muncul setelah generate form TKDN.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form 4.2 - Jasa Pengadaan dan Logistik -->
        <div id="form-4-2" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Form 4.2: TKDN Jasa untuk Pengadaan dan Logistik
                        </h3>
                        
                        <!-- Export Excel Button for Form 4.2 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '4.2']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 mb-8 border border-green-200 dark:border-green-700">
                        <h4 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 4.2
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Classification</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">4.2 - Jasa Pengadaan dan Logistik</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Percentage</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">80%</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Status</label>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Items Table -->
                    @php
                        $serviceItems42 = $service->items()->where('tkdn_classification', '4.2')->get();
                    @endphp

                    @if($serviceItems42->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-green-50 dark:bg-green-900/20">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Uraian</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kualifikasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kewarganegaraan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">TKDN (%)</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Upah (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KDN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KLN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Total Biaya (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($serviceItems42 as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white text-center">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->description }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $item->qualification ?: '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->nationality }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                    {{ number_format($item->tkdn_percentage, 0) }}%
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->duration }} {{ $item->duration_unit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->wage, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($item->domestic_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400 text-right font-medium">{{ number_format($item->foreign_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->total_cost, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-green-50 dark:bg-green-900/20 font-semibold">
                                        <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">SUB TOTAL</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems42->sum('wage'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems42->sum('domestic_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems42->sum('foreign_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems42->sum('total_cost'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data service items dengan TKDN Classification 4.2 yang ditemukan.</p>
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4">
                                    <p class="text-sm text-green-800 dark:text-green-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Data akan muncul setelah generate form TKDN.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form 4.3 - Jasa Operasi dan Pemeliharaan -->
        <div id="form-4-3" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            </svg>
                            Form 4.3: TKDN Jasa untuk Operasi dan Pemeliharaan
                        </h3>
                        
                        <!-- Export Excel Button for Form 4.3 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '4.3']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 mb-8 border border-green-200 dark:border-green-700">
                        <h4 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 4.3
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Classification</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">4.3 - Jasa Operasi dan Pemeliharaan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Percentage</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">100% (WNI)</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Status</label>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Items Table -->
                    @php
                        $serviceItems43 = $service->items()->where('tkdn_classification', '4.3')->get();
                    @endphp

                    @if($serviceItems43->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-green-50 dark:bg-green-900/20">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Uraian</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kualifikasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kewarganegaraan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">TKDN (%)</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Upah (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KDN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KLN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Total Biaya (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($serviceItems43 as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white text-center">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->description }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $item->qualification ?: '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->nationality }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    {{ number_format($item->tkdn_percentage, 0) }}%
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->duration }} {{ $item->duration_unit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->wage, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($item->domestic_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">-</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->total_cost, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-green-50 dark:bg-green-900/20 font-semibold">
                                        <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">SUB TOTAL</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems43->sum('wage'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems43->sum('domestic_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">-</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems43->sum('total_cost'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data service items dengan TKDN Classification 4.3 yang ditemukan.</p>
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4">
                                    <p class="text-sm text-green-800 dark:text-green-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Data akan muncul setelah generate form TKDN.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form 4.4 - Jasa Pelatihan dan Sertifikasi -->
        <div id="form-4-4" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Form 4.4: TKDN Jasa untuk Pelatihan dan Sertifikasi
                        </h3>
                        
                        <!-- Export Excel Button for Form 4.4 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '4.4']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 mb-8 border border-green-200 dark:border-green-700">
                        <h4 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 4.4
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Classification</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">4.4 - Jasa Pelatihan dan Sertifikasi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Percentage</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">100% (WNI)</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Status</label>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Items Table -->
                    @php
                        $serviceItems44 = $service->items()->where('tkdn_classification', '4.4')->get();
                    @endphp

                    @if($serviceItems44->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-green-50 dark:bg-green-900/20">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Uraian</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kualifikasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kewarganegaraan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">TKDN (%)</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Upah (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KDN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KLN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Total Biaya (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($serviceItems44 as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white text-center">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->description }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $item->qualification ?: '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->nationality }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    {{ number_format($item->tkdn_percentage, 0) }}%
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->duration }} {{ $item->duration_unit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->wage, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($item->domestic_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">-</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->total_cost, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-green-50 dark:bg-green-900/20 font-semibold">
                                        <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">SUB TOTAL</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems44->sum('wage'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems44->sum('domestic_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">-</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems44->sum('total_cost'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data service items dengan TKDN Classification 4.4 yang ditemukan.</p>
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4">
                                    <p class="text-sm text-green-800 dark:text-green-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Data akan muncul setelah generate form TKDN.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form 4.5 - Jasa Teknologi Informasi -->
        <div id="form-4-5" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                            </svg>
                            Form 4.5: TKDN Jasa untuk Teknologi Informasi
                        </h3>
                        
                        <!-- Export Excel Button for Form 4.5 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '4.5']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 mb-8 border border-green-200 dark:border-green-700">
                        <h4 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 4.5
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Classification</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">4.5 - Jasa Teknologi Informasi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Percentage</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">70%</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Status</label>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Items Table -->
                    @php
                        $serviceItems45 = $service->items()->where('tkdn_classification', '4.5')->get();
                    @endphp

                    @if($serviceItems45->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-green-50 dark:bg-green-900/20">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Uraian</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kualifikasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kewarganegaraan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">TKDN (%)</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Upah (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KDN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KLN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Total Biaya (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($serviceItems45 as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white text-center">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->description }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $item->qualification ?: '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->nationality }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                    {{ number_format($item->tkdn_percentage, 0) }}%
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->duration }} {{ $item->duration_unit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->wage, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($item->domestic_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400 text-right font-medium">{{ number_format($item->foreign_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->total_cost, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-green-50 dark:bg-green-900/20 font-semibold">
                                        <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">SUB TOTAL</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems45->sum('wage'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems45->sum('domestic_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems45->sum('foreign_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems45->sum('total_cost'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data service items dengan TKDN Classification 4.5 yang ditemukan.</p>
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4">
                                    <p class="text-sm text-green-800 dark:text-green-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Data akan muncul setelah generate form TKDN.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form 4.6 - Jasa Lingkungan dan Keamanan -->
        <div id="form-4-6" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Form 4.6: TKDN Jasa untuk Lingkungan dan Keamanan
                        </h3>
                        
                        <!-- Export Excel Button for Form 4.6 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '4.6']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 mb-8 border border-green-200 dark:border-green-700">
                        <h4 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 4.6
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Classification</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">4.6 - Jasa Lingkungan dan Keamanan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Percentage</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">100% (WNI)</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Status</label>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Items Table -->
                    @php
                        $serviceItems46 = $service->items()->where('tkdn_classification', '4.6')->get();
                    @endphp

                    @if($serviceItems46->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-green-50 dark:bg-green-900/20">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Uraian</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kualifikasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kewarganegaraan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">TKDN (%)</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Upah (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KDN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KLN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Total Biaya (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($serviceItems46 as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white text-center">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->description }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $item->qualification ?: '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->nationality }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    {{ number_format($item->tkdn_percentage, 0) }}%
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->duration }} {{ $item->duration_unit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->wage, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($item->domestic_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">-</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->total_cost, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-green-50 dark:bg-green-900/20 font-semibold">
                                        <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">SUB TOTAL</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems46->sum('wage'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems46->sum('domestic_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">-</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems46->sum('total_cost'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data service items dengan TKDN Classification 4.6 yang ditemukan.</p>
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4">
                                    <p class="text-sm text-green-800 dark:text-green-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Data akan muncul setelah generate form TKDN.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form 4.7 - Jasa Lainnya -->
        <div id="form-4-7" class="form-content hidden">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Form 4.7: TKDN Jasa untuk Lainnya
                        </h3>
                        
                        <!-- Export Excel Button for Form 4.7 -->
                        @if($service->status === 'generated' || $service->status === 'approved')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('service.export.excel', ['service' => $service->id, 'classification' => '4.7']) }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Export Excel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <!-- Header Information -->
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 mb-8 border border-green-200 dark:border-green-700">
                        <h4 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Umum - Form 4.7
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Penyedia Barang / Jasa</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $service->provider_name ?: 'PT Konstruksi Maju' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Classification</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">4.7 - Jasa Lainnya</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">TKDN Percentage</label>
                                        <p class="text-base font-semibold text-green-900 dark:text-green-100">60%</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                    <div>
                                        <label class="block text-sm font-medium text-green-700 dark:text-green-300 mb-1">Status</label>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Items Table -->
                    @php
                        $serviceItems47 = $service->items()->where('tkdn_classification', '4.7')->get();
                    @endphp

                    @if($serviceItems47->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-green-50 dark:bg-green-900/20">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Uraian</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kualifikasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Kewarganegaraan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">TKDN (%)</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Upah (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KDN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Biaya KLN (Rp)</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-green-700 dark:text-green-300 uppercase tracking-wider">Total Biaya (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($serviceItems47 as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white text-center">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->description }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $item->qualification ?: '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $item->nationality }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                    {{ number_format($item->tkdn_percentage, 0) }}%
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-center">{{ $item->duration }} {{ $item->duration_unit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->wage, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 text-right font-medium">{{ number_format($item->domestic_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400 text-right font-medium">{{ number_format($item->foreign_cost, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white text-right font-medium">{{ number_format($item->total_cost, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Sub Total -->
                                    <tr class="bg-green-50 dark:bg-green-900/20 font-semibold">
                                        <td colspan="7" class="px-6 py-4 text-center text-sm font-bold text-green-900 dark:text-green-100">SUB TOTAL</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems47->sum('wage'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems47->sum('domestic_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems47->sum('foreign_cost'), 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-green-900 dark:text-green-100">{{ number_format($serviceItems47->sum('total_cost'), 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 mx-auto mb-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Data</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Tidak ada data service items dengan TKDN Classification 4.7 yang ditemukan.</p>
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-4">
                                    <p class="text-sm text-green-800 dark:text-green-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Data akan muncul setelah generate form TKDN.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
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

// Regenerate Form 3.4 function
function regenerateForm34() {
    if (confirm('Apakah Anda yakin ingin regenerate Form 3.4? Ini akan menghapus data yang ada dan membuat ulang.')) {
        const serviceId = '{{ $service->id }}';
        const url = `/service/${serviceId}/regenerate-form-34`;
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                const successMessage = document.createElement('div');
                successMessage.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                successMessage.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        ${data.message}
                    </div>
                `;
                document.body.appendChild(successMessage);
                
                // Remove message after 3 seconds
                setTimeout(() => {
                    successMessage.remove();
                }, 3000);
                
                // Reload page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                // Show error message
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat regenerate Form 3.4');
        });
    }
}



// Generate options dropdown functionality - Removed as no longer needed
</script>

@endsection 