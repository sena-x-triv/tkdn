@extends('layouts.app')

@section('content')
<div class="mb-8">
    <div class="flex items-center mb-4">
        <a href="{{ route('master.estimation.index') }}" class="btn btn-outline p-2 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Estimation</h1>
            <p class="text-gray-600 dark:text-gray-400">Update estimation information</p>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 w-full max-w-5xl mx-auto mb-8 border border-gray-100 dark:border-gray-800">
    <div class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4" /></svg>
            Estimation Information
        </h2>
    </div>
    <form action="{{ route('master.estimation.update', $estimation->id) }}" method="POST" class="space-y-8" id="estimation-form">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="relative">
                <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Estimasi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7l10 10M7 7l-4 4a2 2 0 002 2l4-4m0 0l10 10a2 2 0 01-2 2l-10-10z" /></svg>
                    </span>
                    <input type="text" name="code" id="code" value="{{ old('code', $estimation->code) }}" class="form-input w-full pl-10 @error('code') border-red-500 @enderror" placeholder="Kode Estimasi">
                </div>
                @error('code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul Estimasi <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h6" /></svg>
                    </span>
                    <input type="text" name="title" id="title" value="{{ old('title', $estimation->title) }}" class="form-input w-full pl-10 @error('title') border-red-500 @enderror" required placeholder="Judul Estimasi">
                </div>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <label for="total" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" /><path d="M9 8h6M9 12h6M9 16h6" /></svg>
                    </span>
                    <input type="number" name="total" id="total" value="{{ old('total', $estimation->total) }}" class="form-input w-full pl-10 @error('total') border-red-500 @enderror" placeholder="Total">
                </div>
                @error('total')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <label for="margin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Margin</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="7" cy="17" r="2" /><circle cx="17" cy="7" r="2" /><line x1="7" y1="17" x2="17" y2="7" /></svg>
                    </span>
                    <input type="number" name="margin" id="margin" value="{{ old('margin', $estimation->margin) }}" class="form-input w-full pl-10 @error('margin') border-red-500 @enderror" placeholder="Margin">
                </div>
                @error('margin')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <label for="unit_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Satuan</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" /></svg>
                    </span>
                    <input type="number" name="unit_price" id="unit_price" value="{{ old('unit_price', $estimation->unit_price) }}" class="form-input w-full pl-10 @error('unit_price') border-red-500 @enderror" placeholder="Harga Satuan">
                </div>
                @error('unit_price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-10">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4" /></svg>
                Item Estimasi
            </h3>
            <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 50px;">No</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 175px;">Kategori</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 125px;">Kode</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama/Peralatan</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 100px;">Koefisien</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 175px;">Harga Satuan</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 175px;">Jumlah Harga</th>
                            <th class="px-3 py-2"></th>
                        </tr>
                    </thead>
                    <tbody id="items-body">
                        @foreach($estimation->items as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-3 py-2 item-no">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2">
                                <select name="items[{{ $loop->index }}][category]" class="form-input" required>
                                    <option value="worker" {{ $item->category == 'worker' ? 'selected' : '' }}>Tenaga Kerja</option>
                                    <option value="material" {{ $item->category == 'material' ? 'selected' : '' }}>Material</option>
                                    <option value="equipment" {{ $item->category == 'equipment' ? 'selected' : '' }}>Peralatan</option>
                                </select>
                                <input type="hidden" name="items[{{ $loop->index }}][id]" value="{{ $item->id }}">
                            </td>
                            <td class="px-3 py-2"><input type="text" name="items[{{ $loop->index }}][code]" class="form-input" value="{{ $item->code }}"></td>
                            <td class="px-3 py-2 flex items-center gap-2">
                                <svg class="h-5 w-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01" /></svg>
                                <input type="text" name="items[{{ $loop->index }}][equipment_name]" class="form-input flex-1" value="{{ $item->equipment_name }}" placeholder="Nama/Peralatan">
                            </td>
                            <td class="px-3 py-2"><input type="number" step="0.001" name="items[{{ $loop->index }}][coefficient]" class="form-input" value="{{ $item->coefficient }}" oninput="updateTotalPrice(this)"></td>
                            <td class="px-3 py-2"><input type="number" name="items[{{ $loop->index }}][unit_price]" class="form-input" value="{{ $item->unit_price }}" oninput="updateTotalPrice(this)"></td>
                            <td class="px-3 py-2"><input type="number" name="items[{{ $loop->index }}][total_price]" class="form-input" value="{{ $item->total_price }}" readonly></td>
                            <td class="px-3 py-2 text-center"><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-secondary mt-4 flex items-center gap-2" onclick="addItemRow()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                Tambah Item
            </button>
        </div>
        
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('master.estimation.index') }}" class="btn btn-outline flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Cancel
            </a>
            <button type="submit" class="btn btn-primary flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save Estimation
            </button>
        </div>
    </form>
</div>
<script>
let itemIndex = {{ $estimation->items->count() }};
function addItemRow(item = {}) {
    const tbody = document.getElementById('items-body');
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50 dark:hover:bg-gray-700 transition';
    row.innerHTML = `
        <td class="px-3 py-2 item-no">${itemIndex + 1}</td>
        <td class="px-3 py-2">
            <select name="items[\u0000INDEX\u0000][category]" class="form-input" required>
                <option value="worker" ${item.category === 'worker' ? 'selected' : ''}>Tenaga Kerja</option>
                <option value="material" ${item.category === 'material' ? 'selected' : ''}>Material</option>
                <option value="equipment" ${item.category === 'equipment' ? 'selected' : ''}>Peralatan</option>
            </select>
        </td>
        <td class="px-3 py-2"><input type="text" name="items[\u0000INDEX\u0000][code]" class="form-input" value="${item.code || ''}"></td>
        <td class="px-3 py-2 flex items-center gap-2">
            <svg class="h-5 w-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01" /></svg>
            <input type="text" name="items[\u0000INDEX\u0000][equipment_name]" class="form-input flex-1" value="${item.equipment_name || ''}" placeholder="Nama/Peralatan">
        </td>
        <td class="px-3 py-2"><input type="number" step="0.001" name="items[\u0000INDEX\u0000][coefficient]" class="form-input" value="${item.coefficient || ''}" oninput="updateTotalPrice(this)"></td>
        <td class="px-3 py-2"><input type="number" name="items[\u0000INDEX\u0000][unit_price]" class="form-input" value="${item.unit_price || ''}" oninput="updateTotalPrice(this)"></td>
        <td class="px-3 py-2"><input type="number" name="items[\u0000INDEX\u0000][total_price]" class="form-input" value="${item.total_price || ''}" readonly></td>
        <td class="px-3 py-2 text-center"><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></td>
    `.replace(/\u0000INDEX\u0000/g, itemIndex);
    tbody.appendChild(row);
    itemIndex++;
}
function updateTotalPrice(input) {
    const row = input.closest('tr');
    const coef = parseFloat(row.querySelector('input[name*="[coefficient]"]').value) || 0;
    const unit = parseFloat(row.querySelector('input[name*="[unit_price]"]').value) || 0;
    row.querySelector('input[name*="[total_price]"]').value = coef * unit;
}

// Notification helper
function showNotification(message, type = 'error') {
    let notif = document.getElementById('notif-bar');
    if (!notif) {
        notif = document.createElement('div');
        notif.id = 'notif-bar';
        notif.className = 'fixed top-6 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded shadow text-white text-center';
        document.body.appendChild(notif);
    }
    notif.textContent = message;
    notif.className = 'fixed top-6 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded shadow text-white text-center ' + (type === 'success' ? 'bg-green-500' : 'bg-red-500');
    notif.style.display = 'block';
    setTimeout(() => { notif.style.display = 'none'; }, 3000);
}

document.getElementById('estimation-form').addEventListener('submit', function(e) {
    // Frontend validation
    let valid = true;
    let msg = '';
    const title = this.querySelector('[name="title"]');
    if (!title.value.trim()) {
        valid = false;
        msg = 'Judul Estimasi wajib diisi.';
    }
    // At least one item
    const itemsBody = document.getElementById('items-body');
    if (valid && (!itemsBody || itemsBody.children.length === 0)) {
        valid = false;
        msg = 'Minimal 1 item estimasi harus diisi.';
    }
    // Validate each item row
    if (valid) {
        for (let row of itemsBody.children) {
            const category = row.querySelector('select[name*="[category]"]');
            const code = row.querySelector('input[name*="[code]"]');
            const coef = row.querySelector('input[name*="[coefficient]"]');
            const unit = row.querySelector('input[name*="[unit_price]"]');
            if (!category.value) {
                valid = false; msg = 'Kategori item wajib diisi.'; break;
            }
            if (!code.value.trim()) {
                valid = false; msg = 'Kode item wajib diisi.'; break;
            }
            if (!coef.value || isNaN(coef.value)) {
                valid = false; msg = 'Koefisien item wajib diisi dan berupa angka.'; break;
            }
            if (!unit.value || isNaN(unit.value)) {
                valid = false; msg = 'Harga satuan item wajib diisi dan berupa angka.'; break;
            }
        }
    }
    if (!valid) {
        e.preventDefault();
        showNotification(msg, 'error');
        return false;
    }
    // UX feedback
    const submitBtn = this.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>Menyimpan...';
    }
    showNotification('Estimasi sedang disimpan...', 'success');
});
</script>
@endsection 