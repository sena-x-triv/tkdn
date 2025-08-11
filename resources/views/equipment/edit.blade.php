@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('master.equipment.index') }}" class="btn btn-outline p-2 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Peralatan</h1>
                <p class="text-gray-600 dark:text-gray-400">Ubah data peralatan proyek</p>
            </div>
        </div>
    </div>

    <!-- Equipment Form -->
    <div class="max-w-4xl">
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Peralatan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('master.equipment.update', $equipment->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="form-label">Nama Peralatan <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $equipment->name) }}" class="form-input pl-10 w-full @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" required placeholder="Masukkan nama peralatan">
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="category_id" class="form-label">Kategori</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <select name="category_id" id="category_id" class="form-input pl-10 w-full @error('category_id') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">
                                    <option value="">Pilih kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $equipment->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }} ({{ $category->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Technical Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tkdn" class="form-label">TKDN (%)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <input type="number" name="tkdn" id="tkdn" value="{{ old('tkdn', $equipment->tkdn) }}" class="form-input pl-10 w-full @error('tkdn') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" min="0" max="100" step="0.01" placeholder="Masukkan persentase TKDN">
                            </div>
                            @error('tkdn')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="period" class="form-label">Period (Hari) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="number" name="period" id="period" value="{{ old('period', $equipment->period) }}" class="form-input pl-10 w-full @error('period') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" min="1" required placeholder="Masukkan periode (hari)">
                            </div>
                            @error('period')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Pricing Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price" class="form-label">Harga <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <input type="number" name="price" id="price" value="{{ old('price', $equipment->price) }}" class="form-input pl-10 w-full @error('price') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" min="0" required placeholder="Masukkan harga peralatan">
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="location" class="form-label flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 0011.314-11.314l-4.243-4.243a4 4 0 00-5.657 5.657l4.243 4.243z"></path>
                                </svg>
                                Lokasi Peralatan
                            </label>
                            <select name="location" id="location" class="form-input select2-modern @error('location') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" style="width:100%">
                                <option value="">Pilih Kota Peralatan...</option>
                            </select>
                            @error('location')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Additional Information -->
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="description" class="form-label">Keterangan</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="description" id="description" value="{{ old('description', $equipment->description) }}" class="form-input pl-10 w-full @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Keterangan tambahan (opsional)">
                            </div>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('master.equipment.index') }}" class="btn btn-outline flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Update Peralatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.select2-container--default .select2-selection--single {
    background: #f9fafb;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    min-height: 44px;
    padding: 8px 12px;
    font-size: 1rem;
    color: #111827;
    transition: border 0.2s;
}
.select2-container--default .select2-selection--single:focus,
.select2-container--default .select2-selection--single.select2-selection--focus {
    border-color: #2563eb;
    outline: none;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #111827;
    line-height: 28px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%;
    right: 10px;
}
.select2-dropdown {
    border-radius: 0.5rem;
    box-shadow: 0 4px 24px 0 rgba(0,0,0,0.08);
}
.select2-results__option {
    padding-left: 2.5rem;
    position: relative;
}
.select2-results__option .city-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: #2563eb;
}
</style>
@endpush

@push('scripts')
<script>
const cities = [
    'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Bekasi', 'Depok', 'Tangerang', 'Semarang', 'Palembang', 'Makassar',
    'Bogor', 'Batam', 'Padang', 'Pekanbaru', 'Denpasar', 'Malang', 'Samarinda', 'Tasikmalaya', 'Pontianak', 'Banjarmasin',
    'Balikpapan', 'Jambi', 'Cimahi', 'Yogyakarta', 'Kediri', 'Cilegon', 'Cirebon', 'Mataram', 'Manado', 'Kupang',
    'Ambon', 'Jayapura', 'Palu', 'Kendari', 'Ternate', 'Sorong', 'Banda Aceh', 'Pangkal Pinang', 'Bengkulu', 'Gorontalo',
    'Tarakan', 'Bitung', 'Tanjung Pinang', 'Lubuklinggau', 'Pematangsiantar', 'Banjarbaru', 'Probolinggo', 'Magelang', 'Blitar', 'Mojokerto'
];
$(function() {
    const select = $('#location');
    select.empty();
    select.append('<option value="">Pilih Kota Peralatan...</option>');
    cities.forEach(function(city) {
        const isSelected = city === @json(old('location', $equipment->location)) ? 'selected' : '';
        select.append(`<option value="${city}" ${isSelected} data-icon="city">${city}</option>`);
    });
    select.select2({
        placeholder: 'Pilih Kota Peralatan...',
        allowClear: true,
        width: '100%',
        templateResult: function (data) {
            if (!data.id) return data.text;
            return $('<span> '+data.text+'</span>');
        },
        templateSelection: function (data) {
            if (!data.id) return data.text;
            return $('<span> '+data.text+'</span>');
        }
    });
});
</script>
@endpush 