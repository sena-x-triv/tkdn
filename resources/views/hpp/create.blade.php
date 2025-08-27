@extends('layouts.app')

@section('content')
<div class="mb-8">
    <div class="flex items-center mb-4">
        <a href="{{ route('hpp.index') }}" class="btn btn-outline p-2 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tambah HPP</h1>
            <p class="text-gray-600 dark:text-gray-400">Tambah Harga Pokok Pembelian baru ke sistem</p>
        </div>
    </div>
</div>

@if($errors->any())
    <div class="mb-6">
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative flex items-center" role="alert">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <div class="font-medium">Terjadi kesalahan:</div>
                <ul class="mt-1 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 w-full mx-auto mb-8 border border-gray-100 dark:border-gray-800">
    <div class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4" />
            </svg>
            Informasi HPP
        </h2>
    </div>
    
    <form action="{{ route('hpp.store') }}" method="POST" class="space-y-8" id="hpp-form">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="relative">
                <label for="project_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Project <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </span>
                    <select id="project_id" name="project_id" class="form-input w-full pl-10 @error('project_id') border-red-500 @enderror" required>
                        <option value="">Pilih Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('project_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative">
                <label for="overhead_percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Overhead (%) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <input type="number" id="overhead_percentage" name="overhead_percentage" value="{{ old('overhead_percentage', 0) }}" step="0.01" min="0" max="100" class="form-input w-full pl-10 @error('overhead_percentage') border-red-500 @enderror" required placeholder="0.00">
                </div>
                @error('overhead_percentage')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative">
                <label for="margin_percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Margin (%) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </span>
                    <input type="number" id="margin_percentage" name="margin_percentage" value="{{ old('margin_percentage', 0) }}" step="0.01" min="0" max="100" class="form-input w-full pl-10 @error('margin_percentage') border-red-500 @enderror" required placeholder="0.00">
                </div>
                @error('margin_percentage')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative">
                <label for="ppn_percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">PPN (%) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <input type="number" id="ppn_percentage" name="ppn_percentage" value="{{ old('ppn_percentage', 11) }}" step="0.01" min="0" max="100" class="form-input w-full pl-10 @error('ppn_percentage') border-red-500 @enderror" required placeholder="11.00">
                </div>
                @error('ppn_percentage')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative">
                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </span>
                    <textarea id="notes" name="notes" rows="3" class="form-input w-full pl-10 @error('notes') border-red-500 @enderror" placeholder="Catatan tambahan">{{ old('notes') }}</textarea>
                </div>
                @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Project Info Display -->
        <div id="project-info" class="hidden p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
            <h4 class="font-medium text-gray-900 dark:text-white mb-2">Informasi Project</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Project</label>
                    <p id="project-name" class="text-gray-900 dark:text-white">-</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Perusahaan</label>
                    <p id="project-company" class="text-gray-900 dark:text-white">-</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                    <p id="project-description" class="text-gray-900 dark:text-white">-</p>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4" />
                    </svg>
                    Item Pekerjaan
                </h3>
                <button type="button" class="btn btn-secondary flex items-center gap-2" onclick="addItem()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Item
                </button>
            </div>
            
            <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 50px;">No</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Uraian Barang/Pekerjaan</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 120px;">Klasifikasi TKDN</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 100px;">Volume</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 80px;">Satuan</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 100px;">Durasi</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 120px;">Satuan Durasi</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 150px;">Harga Satuan</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 150px;">Jumlah Harga</th>
                            <th class="px-3 py-2"></th>
                        </tr>
                    </thead>
                    <tbody id="items-container">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('hpp.index') }}" class="btn btn-outline flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Cancel
            </a>
            <button type="submit" class="btn btn-primary flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan HPP
            </button>
        </div>
    </form>
</div>

<!-- AHS Modal -->
<div id="ahsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pilih Data AHS</h3>
            <button onclick="closeAhsModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="mb-4">
            <input type="text" id="ahsSearch" placeholder="Cari AHS..." class="form-input w-full">
        </div>
        
        <div id="ahsList" class="max-h-96 overflow-y-auto space-y-2">
            <!-- AHS items will be populated here -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let itemIndex = 0;
const ahsData = @json($ahsData);
const projects = @json($projects);

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

// Add item function
function addItem() {
    const container = document.getElementById('items-container');
    const newItem = document.createElement('tr');
    newItem.className = 'item-row border-b border-gray-200 dark:border-gray-700';
    newItem.innerHTML = `
        <td class="px-3 py-2 text-center">
            <span class="item-number">${itemIndex + 1}</span>
        </td>
        <td class="px-3 py-2">
            <div class="relative">
                <input type="text" name="items[${itemIndex}][description]" class="form-input w-full description-input" required readonly placeholder="Klik untuk pilih data AHS">
                <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="openAhsModal(this)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
            <input type="hidden" name="items[${itemIndex}][estimation_item_id]" class="estimation-item-id-input">
            <input type="hidden" name="items[${itemIndex}][ahs_type]" class="ahs-type-input">
        </td>
        <td class="px-3 py-2">
            <select name="items[${itemIndex}][tkdn_classification]" class="form-select w-full tkdn-classification-input" required>
                <option value="">Pilih</option>
                <option value="3.1">3.1</option>
                <option value="3.2">3.2</option>
                <option value="3.3">3.3</option>
                <option value="3.4">3.4</option>
                <option value="3.5">3.5</option>
                <option value="3.6">3.6</option>
                <option value="3.7">3.7</option>
            </select>
        </td>
        <td class="px-3 py-2">
            <input type="number" name="items[${itemIndex}][volume]" class="form-input w-full volume-input" step="0.01" min="0" required>
        </td>
        <td class="px-3 py-2">
            <input type="text" name="items[${itemIndex}][unit]" class="form-input w-full unit-input" required>
        </td>
        <td class="px-3 py-2">
            <input type="number" name="items[${itemIndex}][duration]" class="form-input w-full" min="1" required>
        </td>
        <td class="px-3 py-2">
            <select name="items[${itemIndex}][duration_unit]" class="form-select w-full" required>
                <option value="Hari">Hari</option>
                <option value="Minggu">Minggu</option>
                <option value="Bulan" selected>Bulan</option>
                <option value="Tahun">Tahun</option>
            </select>
        </td>
        <td class="px-3 py-2">
            <input type="number" name="items[${itemIndex}][unit_price]" class="form-input w-full unit-price-input" step="0.01" min="0" required>
        </td>
        <td class="px-3 py-2">
            <input type="number" name="items[${itemIndex}][total_price]" class="form-input w-full total-price-input" step="0.01" readonly>
        </td>
        <td class="px-3 py-2 text-center">
            <button type="button" onclick="removeItem(this)" class="btn btn-outline p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </td>
    `;
    
    container.appendChild(newItem);
    
    // Add event listeners for calculation
    const volumeInput = newItem.querySelector('.volume-input');
    const unitPriceInput = newItem.querySelector('.unit-price-input');
    
    volumeInput.addEventListener('input', function() { calculateTotal(newItem); });
    unitPriceInput.addEventListener('input', function() { calculateTotal(newItem); });
    
    itemIndex++;
}

// Remove item function
function removeItem(button) {
    button.closest('tr').remove();
    updateItemNumbers();
}

// Update item numbers
function updateItemNumbers() {
    const items = document.querySelectorAll('.item-row');
    items.forEach((item, index) => {
        item.querySelector('.item-number').textContent = index + 1;
    });
}

// Calculate total for an item
function calculateTotal(itemRow) {
    const volume = parseFloat(itemRow.querySelector('.volume-input').value) || 0;
    const unitPrice = parseFloat(itemRow.querySelector('.unit-price-input').value) || 0;
    const totalPrice = volume * unitPrice;
    
    itemRow.querySelector('.total-price-input').value = totalPrice.toFixed(2);
}

// AHS Modal functions
function openAhsModal(button) {
    const modal = document.getElementById('ahsModal');
    const ahsList = document.getElementById('ahsList');
    
    // Clear previous items
    ahsList.innerHTML = '';
    
    // Populate AHS items
    ahsData.forEach(function(item) {
        const div = document.createElement('div');
        div.className = 'p-3 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700';
        div.onclick = function() { selectAhsItem(item, button); };
        
        let icon = '';
        if (item.type === 'worker') {
            icon = '<svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>';
        } else if (item.type === 'material') {
            icon = '<svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>';
        } else if (item.type === 'equipment') {
            icon = '<svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 00-1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-2.573 1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 001.065-2.572c-.426-1.756-2.924-1.756-3.35 0a1.724 1.724 0 00-1.065 2.572c-.94 1.543.826 3.31 2.37 2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>';
        }
        
        div.innerHTML = `
            <div class="flex items-center">
                ${icon}
                <div>
                    <div class="font-medium text-gray-900 dark:text-white">${item.description}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">${item.category} - ${item.code || 'N/A'}</div>
                </div>
            </div>
        `;
        
        ahsList.appendChild(div);
    });
    
    modal.classList.remove('hidden');
}

function closeAhsModal() {
    document.getElementById('ahsModal').classList.add('hidden');
}

function selectAhsItem(item, button) {
    const itemRow = button.closest('tr');
    const descriptionInput = itemRow.querySelector('.description-input');
    const estimationItemIdInput = itemRow.querySelector('.estimation-item-id-input');
    const ahsTypeInput = itemRow.querySelector('.ahs-type-input');
    const unitInput = itemRow.querySelector('.unit-input');
    const tkdnClassificationInput = itemRow.querySelector('.tkdn-classification-input');
    
    descriptionInput.value = item.description;
    estimationItemIdInput.value = item.id;
    ahsTypeInput.value = item.type;
    
    // Set unit based on item type
    if (item.type === 'worker') {
        unitInput.value = 'OH';
    } else if (item.type === 'material') {
        unitInput.value = 'Unit';
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
        tkdnClassificationInput.value = '3.7';
    }
    
    // Recalculate total
    calculateTotal(itemRow);
    
    closeAhsModal();
}

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

// Initialize with one item
document.addEventListener('DOMContentLoaded', function() {
    addItem();
});
</script>
@endpush
