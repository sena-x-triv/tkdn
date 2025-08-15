@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Edit HPP</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ $hpp->code }}</p>
        </div>
    </div>

    @if(session('error'))
        <div class="mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <form action="{{ route('hpp.update', $hpp->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
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
                                <option value="{{ $project->id }}" {{ old('project_id', $hpp->project_id) == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <div id="project-info" class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">Informasi Project</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Project</label>
                                    <p id="project-name" class="text-gray-900 dark:text-white">{{ $hpp->project->name ?? '' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Perusahaan</label>
                                    <p id="project-company" class="text-gray-900 dark:text-white">{{ $hpp->project->company ?? '-' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                                    <p id="project-description" class="text-gray-900 dark:text-white">{{ $hpp->project->description ?? '-' }}</p>
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
                    @foreach($hpp->items as $index => $item)
                    <div class="item-row border border-gray-200 dark:border-gray-600 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-md font-medium text-gray-900 dark:text-white">Item {{ $index + 1 }}</h4>
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
                                    <input type="text" name="items[{{ $index }}][description]" value="{{ $item->description }}" class="form-input description-input" required readonly>
                                    <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="openAhsModal(this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <input type="hidden" name="items[{{ $index }}][ahs_id]" class="ahs-id-input" value="{{ $item->estimation_item_id }}">
                                <input type="hidden" name="items[{{ $index }}][ahs_type]" class="ahs-type-input">
                            </div>
                            
                            <div>
                                <label class="form-label">Klasifikasi TKDN <span class="text-red-500">*</span></label>
                                <select name="items[{{ $index }}][tkdn_classification]" class="form-select tkdn-classification-input" required>
                                    <option value="">Pilih Klasifikasi TKDN</option>
                                    <option value="3.1" {{ $item->tkdn_classification == '3.1' ? 'selected' : '' }}>3.1</option>
                                    <option value="3.2" {{ $item->tkdn_classification == '3.2' ? 'selected' : '' }}>3.2</option>
                                    <option value="3.3" {{ $item->tkdn_classification == '3.3' ? 'selected' : '' }}>3.3</option>
                                    <option value="3.4" {{ $item->tkdn_classification == '3.4' ? 'selected' : '' }}>3.4</option>
                                    <option value="3.5" {{ $item->tkdn_classification == '3.5' ? 'selected' : '' }}>3.5</option>
                                    <option value="3.6" {{ $item->tkdn_classification == '3.6' ? 'selected' : '' }}>3.6</option>
                                    <option value="3.7" {{ $item->tkdn_classification == '3.7' ? 'selected' : '' }}>3.7</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="form-label">Volume <span class="text-red-500">*</span></label>
                                <input type="number" name="items[{{ $index }}][volume]" value="{{ $item->volume }}" class="form-input volume-input" step="0.01" min="0" required>
                            </div>
                            
                            <div>
                                <label class="form-label">Satuan <span class="text-red-500">*</span></label>
                                <input type="text" name="items[{{ $index }}][unit]" value="{{ $item->unit }}" class="form-input unit-input" required>
                            </div>
                            
                            <div>
                                <label class="form-label">Durasi <span class="text-red-500">*</span></label>
                                <input type="number" name="items[{{ $index }}][duration]" value="{{ $item->duration }}" class="form-input" min="1" required>
                            </div>
                            
                            <div>
                                <label class="form-label">Satuan Durasi <span class="text-red-500">*</span></label>
                                <select name="items[{{ $index }}][duration_unit]" class="form-select" required>
                                    <option value="Hari" {{ $item->duration_unit == 'Hari' ? 'selected' : '' }}>Hari</option>
                                    <option value="Minggu" {{ $item->duration_unit == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                    <option value="Bulan" {{ $item->duration_unit == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                                    <option value="Tahun" {{ $item->duration_unit == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="form-label">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                                <input type="number" name="items[{{ $index }}][unit_price]" value="{{ $item->unit_price }}" class="form-input unit-price-input" step="0.01" min="0" required>
                            </div>
                            
                            <div>
                                <label class="form-label">Jumlah Harga (Rp)</label>
                                <input type="number" name="items[{{ $index }}][total_price]" value="{{ $item->total_price }}" class="form-input total-price-input" step="0.01" readonly>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                        <input type="number" id="overhead_percentage" name="overhead_percentage" value="{{ old('overhead_percentage', $hpp->overhead_percentage) }}" step="0.01" min="0" max="100" class="form-input @error('overhead_percentage') border-red-500 @enderror" required>
                        @error('overhead_percentage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="margin_percentage" class="form-label">Margin (%) <span class="text-red-500">*</span></label>
                        <input type="number" id="margin_percentage" name="margin_percentage" value="{{ old('margin_percentage', $hpp->margin_percentage) }}" step="0.01" min="0" max="100" class="form-input @error('margin_percentage') border-red-500 @enderror" required>
                        @error('margin_percentage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="ppn_percentage" class="form-label">PPN (%) <span class="text-red-500">*</span></label>
                        <input type="number" id="ppn_percentage" name="ppn_percentage" value="{{ old('ppn_percentage', $hpp->ppn_percentage) }}" step="0.01" min="0" max="100" class="form-input @error('ppn_percentage') border-red-500 @enderror" required>
                        @error('ppn_percentage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-3">
                        <label for="notes" class="form-label">Catatan</label>
                        <textarea id="notes" name="notes" rows="3" class="form-textarea @error('notes') border-red-500 @enderror">{{ old('notes', $hpp->notes) }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('hpp.show', $hpp->id) }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                Update HPP
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
                    <input type="text" name="items[INDEX][description]" class="form-input description-input" required readonly>
                    <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="openAhsModal(this)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
                <input type="hidden" name="items[INDEX][ahs_id]" class="ahs-id-input">
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

<!-- AHS Modal -->
<div id="ahsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pilih Data AHS</h3>
                <button type="button" onclick="closeAhsModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="mb-4">
                <input type="text" id="ahsSearch" placeholder="Cari data AHS..." class="form-input w-full">
            </div>
            
            <div class="max-h-96 overflow-y-auto">
                <div id="ahsList" class="space-y-2">
                    <!-- AHS data will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let itemIndex = {{ count($hpp->items) }};
let ahsData = @json($ahsData);
let currentItemRow = null;
let projects = @json($projects);

function addItem() {
    const container = document.getElementById('items-container');
    const template = document.getElementById('item-template');
    const clone = template.content.cloneNode(true);
    
    // Update index
    const inputs = clone.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
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
    loadAhsData();
}

function closeAhsModal() {
    document.getElementById('ahsModal').classList.add('hidden');
    currentItemRow = null;
}

function loadAhsData() {
    const ahsList = document.getElementById('ahsList');
    ahsList.innerHTML = '';
    
    ahsData.forEach(function(item) {
        const div = document.createElement('div');
        div.className = 'p-3 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700';
        div.onclick = function() { selectAhsItem(item); };
        
        div.innerHTML = `
            <div class="flex justify-between items-start">
                <div>
                    <div class="font-medium text-gray-900 dark:text-white">${item.description}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">${item.category}</div>
                </div>
                <div class="text-right">
                    <div class="font-medium text-gray-700 dark:text-gray-300">Rp ${numberFormat(item.unit_price)}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">${item.code}</div>
                </div>
            </div>
        `;
        
        ahsList.appendChild(div);
    });
}

function selectAhsItem(item) {
    if (!currentItemRow) return;
    
    const descriptionInput = currentItemRow.querySelector('.description-input');
    const ahsIdInput = currentItemRow.querySelector('.ahs-id-input');
    const ahsTypeInput = currentItemRow.querySelector('.ahs-type-input');
    const unitPriceInput = currentItemRow.querySelector('.unit-price-input');
    const unitInput = currentItemRow.querySelector('.unit-input');
    const tkdnClassificationInput = currentItemRow.querySelector('.tkdn-classification-input');
    
    descriptionInput.value = item.description;
    ahsIdInput.value = item.id;
    ahsTypeInput.value = item.type;
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
        // Find the closest TKDN classification option
        const tkdnValue = parseFloat(item.tkdn);
        if (tkdnValue <= 30) {
            tkdnClassificationInput.value = '3.1';
        } else if (tkdnValue <= 40) {
            tkdnClassificationInput.value = '3.2';
        } else if (tkdnValue <= 50) {
            tkdnClassificationInput.value = '3.3';
        } else if (tkdnValue <= 60) {
            tkdnClassificationInput.value = '3.4';
        } else if (tkdnValue <= 70) {
            tkdnClassificationInput.value = '3.5';
        } else if (tkdnValue <= 80) {
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
        }
    }
});

// Search functionality
document.getElementById('ahsSearch').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const ahsItems = document.querySelectorAll('#ahsList > div');
    
    ahsItems.forEach(function(item) {
        const text = item.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
});

// Close modal when clicking outside
document.getElementById('ahsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAhsModal();
    }
});

// Add event listeners to existing rows
document.querySelectorAll('#items-container .item-row').forEach(function(row) {
    const volumeInput = row.querySelector('.volume-input');
    const unitPriceInput = row.querySelector('.unit-price-input');
    
    if (volumeInput && unitPriceInput) {
        volumeInput.addEventListener('input', function() { calculateTotal(row); });
        unitPriceInput.addEventListener('input', function() { calculateTotal(row); });
    }
});
</script>
@endsection
