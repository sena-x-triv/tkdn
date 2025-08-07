@extends('layouts.app')

@section('title', 'Detail Item TKDN')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <a href="{{ route('master.tkdn.index') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Detail Item TKDN</h1>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('master.tkdn.edit', $tkdnItem->id) }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('master.tkdn.destroy', $tkdnItem->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>

        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-white">{{ $tkdnItem->name }}</h2>
                        <p class="text-blue-100 mt-1">Kode: {{ $tkdnItem->code }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            TKDN {{ $tkdnItem->tkdn_classification }}
                        </span>
                        @if($tkdnItem->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 ml-2">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 ml-2">
                                Nonaktif
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detail Information -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Dasar -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Kode Item</label>
                                <p class="text-sm text-gray-900 font-medium">{{ $tkdnItem->code }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nama Item</label>
                                <p class="text-sm text-gray-900">{{ $tkdnItem->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Klasifikasi TKDN</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    {{ $tkdnItem->tkdn_classification }}
                                </span>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Status</label>
                                @if($tkdnItem->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Nonaktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Harga -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Harga</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Satuan</label>
                                <p class="text-sm text-gray-900 font-medium">{{ $tkdnItem->unit }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Harga Satuan</label>
                                <p class="text-lg font-bold text-green-600">{{ $tkdnItem->formatted_unit_price }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tanggal Dibuat</label>
                                <p class="text-sm text-gray-900">{{ $tkdnItem->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Terakhir Diupdate</label>
                                <p class="text-sm text-gray-900">{{ $tkdnItem->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                @if($tkdnItem->description)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-700">{{ $tkdnItem->description }}</p>
                        </div>
                    </div>
                @endif

                <!-- Contoh Perhitungan -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contoh Perhitungan</h3>
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Volume: 600 Box</label>
                                <p class="text-sm text-gray-900 font-medium">600 {{ $tkdnItem->unit }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Durasi: 12 Bulan</label>
                                <p class="text-sm text-gray-900 font-medium">12 Bulan</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Total Harga</label>
                                <p class="text-lg font-bold text-green-600">
                                    {{ 'Rp ' . number_format($tkdnItem->calculateTotalPrice(600, 12), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-between">
            <a href="{{ route('master.tkdn.index') }}" 
               class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
            </a>
            
            <div class="flex space-x-2">
                <form action="{{ route('master.tkdn.toggle-status', $tkdnItem->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200"
                            onclick="return confirm('Apakah Anda yakin ingin {{ $tkdnItem->is_active ? 'menonaktifkan' : 'mengaktifkan' }} item ini?')">
                        <i class="fas fa-{{ $tkdnItem->is_active ? 'pause' : 'play' }} mr-2"></i>
                        {{ $tkdnItem->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>
                
                <a href="{{ route('master.tkdn.edit', $tkdnItem->id) }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
