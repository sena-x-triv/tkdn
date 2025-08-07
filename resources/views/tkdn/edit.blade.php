@extends('layouts.app')

@section('title', 'Edit Item TKDN')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('master.tkdn.show', $tkdnItem->id) }}" class="text-blue-600 hover:text-blue-800 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Edit Item TKDN</h1>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('master.tkdn.update', $tkdnItem->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode -->
                    <div class="md:col-span-2">
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Item <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="code" id="code" value="{{ old('code', $tkdnItem->code) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: A.6.3.3.1">
                        <p class="text-sm text-gray-500 mt-1">Kode unik untuk item TKDN</p>
                    </div>

                    <!-- Nama Item -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Item <span class="text-red-500">*</span>
                        </label>
                        <textarea name="name" id="name" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Contoh: Penerimaan dan Pengangkutan Arsip Per Box Standard">{{ old('name', $tkdnItem->name) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Uraian barang/pekerjaan</p>
                    </div>

                    <!-- Klasifikasi TKDN -->
                    <div>
                        <label for="tkdn_classification" class="block text-sm font-medium text-gray-700 mb-2">
                            Klasifikasi TKDN <span class="text-red-500">*</span>
                        </label>
                        <select name="tkdn_classification" id="tkdn_classification" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Klasifikasi</option>
                            @foreach($classifications as $classification)
                                <option value="{{ $classification }}" 
                                        {{ old('tkdn_classification', $tkdnItem->tkdn_classification) == $classification ? 'selected' : '' }}>
                                    {{ $classification }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Klasifikasi TKDN (3.1, 3.2, 3.3, 3.4)</p>
                    </div>

                    <!-- Satuan -->
                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">
                            Satuan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="unit" id="unit" value="{{ old('unit', $tkdnItem->unit) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Box, Bulan, dll">
                        <p class="text-sm text-gray-500 mt-1">Satuan pengukuran</p>
                    </div>

                    <!-- Harga Satuan -->
                    <div class="md:col-span-2">
                        <label for="unit_price" class="block text-sm font-medium text-gray-700 mb-2">
                            Harga Satuan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                Rp
                            </span>
                            <input type="number" name="unit_price" id="unit_price" 
                                   value="{{ old('unit_price', $tkdnItem->unit_price) }}" required
                                   step="0.01" min="0"
                                   class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0">
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Harga per satuan dalam Rupiah</p>
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Deskripsi tambahan (opsional)">{{ old('description', $tkdnItem->description) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Deskripsi tambahan untuk item ini</p>
                    </div>

                    <!-- Status Aktif -->
                    <div class="md:col-span-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" 
                                   {{ old('is_active', $tkdnItem->is_active) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Item Aktif
                            </label>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Item aktif akan tersedia untuk digunakan</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('master.tkdn.show', $tkdnItem->id) }}" 
                       class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-save mr-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Format input harga dengan separator ribuan
document.getElementById('unit_price').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value) {
        value = parseInt(value).toLocaleString('id-ID');
        e.target.value = value;
    }
});

// Hapus separator saat submit
document.querySelector('form').addEventListener('submit', function(e) {
    let priceInput = document.getElementById('unit_price');
    priceInput.value = priceInput.value.replace(/\D/g, '');
});
</script>
@endsection
