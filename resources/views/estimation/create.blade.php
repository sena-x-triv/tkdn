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
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Add Estimation</h1>
            <p class="text-gray-600 dark:text-gray-400">Add a new estimation to the system</p>
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
    <form action="{{ route('master.estimation.store') }}" method="POST" class="space-y-8" id="estimation-form">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="relative">
                <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Estimasi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7l10 10M7 7l-4 4a2 2 0 002 2l4-4m0 0l10 10a2 2 0 01-2 2l-10-10z" /></svg>
                    </span>
                    <input type="text" name="code" id="code" value="{{ old('code') }}" class="form-input w-full pl-10 @error('code') border-red-500 @enderror" placeholder="Kode Estimasi">
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
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-input w-full pl-10 @error('title') border-red-500 @enderror" required placeholder="Judul Estimasi">
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
                    <input type="number" name="total" id="total" value="{{ old('total', 0) }}" class="form-input w-full pl-10 @error('total') border-red-500 @enderror" placeholder="Total" readonly>
                </div>
                @error('total')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <label for="margin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Margin (%)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="7" cy="17" r="2" /><circle cx="17" cy="7" r="2" /><line x1="7" y1="17" x2="17" y2="7" /></svg>
                    </span>
                    <input type="number" name="margin" id="margin" value="{{ old('margin', 15) }}" class="form-input w-full pl-10 pr-8 @error('margin') border-red-500 @enderror" placeholder="0" min="0" max="100" step="0.01">
                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-500 dark:text-gray-400">
                        %
                    </span>
                </div>
                @error('margin')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative">
                <label for="total_unit_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Satuan</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" /></svg>
                    </span>
                    <input type="number" name="total_unit_price" id="total_unit_price" value="{{ old('total_unit_price', 0) }}" class="form-input w-full pl-10 @error('total_unit_price') border-red-500 @enderror" placeholder="Harga Satuan" readonly>
                </div>
                @error('total_unit_price')
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
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 175px;">Harga</th>
                            <th class="px-3 py-2 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase" style="width: 175px;">Jumlah Harga</th>
                            <th class="px-3 py-2"></th>
                        </tr>
                    </thead>
                    <tbody id="items-body">
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
let itemIndex = 0;
function addItemRow(item = {}) {
    const tbody = document.getElementById('items-body');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td class="px-3 py-2 item-no">${itemIndex + 1}</td>
        <td class="px-2 py-2">
            <select name="items[${itemIndex}][category]" class="form-input" required onchange="toggleEquipmentInput(this)">
                <option value="worker" ${item.category === 'worker' ? 'selected' : ''}>Tenaga Kerja</option>
                <option value="material" ${item.category === 'material' ? 'selected' : ''}>Material</option>
                <option value="equipment" ${item.category === 'equipment' ? 'selected' : ''}>Peralatan</option>
            </select>
        </td>
        <td class="px-2 py-2"><input type="text" name="items[${itemIndex}][code]" class="form-input" value="${item.code || ''}"></td>
        <td class="px-2 py-2">
            <input type="text" name="items[${itemIndex}][equipment_name]" class="form-input" value="${item.equipment_name || ''}" placeholder="Nama/Peralatan">
        </td>
        <td class="px-2 py-2"><input type="number" step="0.001" name="items[${itemIndex}][coefficient]" class="form-input" value="${item.coefficient || ''}" oninput="updateTotalPrice(this)"></td>
        <td class="px-2 py-2"><input type="number" name="items[${itemIndex}][unit_price]" class="form-input" value="${item.unit_price || ''}" oninput="updateTotalPrice(this);"></td>
        <td class="px-2 py-2"><input type="number" name="items[${itemIndex}][total_price]" class="form-input" value="${item.total_price || ''}" readonly></td>
        <td class="px-2 py-2 text-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeItemRow(this)"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></td>
    `;
    tbody.appendChild(row);
    itemIndex++;
}
function toggleEquipmentInput(select) {
    // Optionally, you can show/hide fields based on category
}

function removeItemRow(button) {
    const row = button.closest('tr');
    row.remove();
    updateMainTotal();
    updateItemNumbers();
}

function updateItemNumbers() {
    const rows = document.querySelectorAll('#items-body tr');
    rows.forEach((row, index) => {
        const itemNoCell = row.querySelector('.item-no');
        if (itemNoCell) {
            itemNoCell.textContent = index + 1;
        }
    });
}
function updateTotalPrice(input) {
    const row = input.closest('tr');
    const coef = parseFloat(row.querySelector('input[name*="[coefficient]"]').value) || 0;
    const unitPrice = parseFloat(row.querySelector('input[name*="[unit_price]"]').value) || 0;
    const totalPrice = coef * unitPrice;
    
    row.querySelector('input[name*="[total_price]"]').value = totalPrice;
    
    // Update main totals
    updateMainTotal();
}

function updateMainTotal() {
    const itemRows = document.querySelectorAll('#items-body tr');
    let totalPrice = 0;
    
    itemRows.forEach(row => {
        const totalPriceInput = row.querySelector('input[name*="[total_price]"]');
        if (totalPriceInput && totalPriceInput.value) {
            totalPrice += parseFloat(totalPriceInput.value) || 0;
        }
    });
    
    // Update the main total input
    const mainTotalInput = document.getElementById('total');
    if (mainTotalInput) {
        mainTotalInput.value = totalPrice;
    }

    // update unit price = total * (1 + margin/100), hasil penghitungan pembulatan keatas
    const margin = parseFloat(document.getElementById('margin').value) || 0;
    const unitPrice = Math.ceil(totalPrice * (1 + margin/100));
    document.getElementById('total_unit_price').value = unitPrice;
}

// Handle form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('estimation-form');
    const submitButton = form.querySelector('button[type="submit"]');
    const submitButtonText = submitButton.innerHTML;
    
    // Calculate initial totals if there are existing items
    updateMainTotal();
    
    // Add event listener for margin input to recalculate unit price
    const marginInput = document.getElementById('margin');
    if (marginInput) {
        marginInput.addEventListener('input', function() {
            updateMainTotal();
        });
    }
    
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        // Validate form
        if (!validateForm()) {
            return false;
        }
        
        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Saving...
        `;
        
        // Submit form after short delay
        setTimeout(() => {
            form.submit();
        }, 500);
    });
    
    function validateForm() {
        let isValid = true;
        
        // Clear previous error states
        const inputs = form.querySelectorAll('.border-red-500');
        inputs.forEach(input => {
            input.classList.remove('border-red-500');
        });
        
        // Validate required fields
        const title = document.getElementById('title');
        if (!title.value.trim()) {
            title.classList.add('border-red-500');
            showError('Judul estimasi harus diisi');
            isValid = false;
        }
        
        // Validate estimation items
        const itemRows = document.querySelectorAll('#items-body tr');
        if (itemRows.length === 0) {
            showError('Minimal harus ada satu item estimasi');
            isValid = false;
        } else {
            // Validate each item row
            itemRows.forEach((row, index) => {
                const category = row.querySelector('select[name*="[category]"]');
                const code = row.querySelector('input[name*="[code]"]');
                const equipmentName = row.querySelector('input[name*="[equipment_name]"]');
                const coefficient = row.querySelector('input[name*="[coefficient]"]');
                const unitPrice = row.querySelector('input[name*="[unit_price]"]');
                
                if (!category.value) {
                    category.classList.add('border-red-500');
                    showError(`Kategori pada item ${index + 1} harus dipilih`);
                    isValid = false;
                }
                
                if (!equipmentName.value.trim()) {
                    equipmentName.classList.add('border-red-500');
                    showError(`Nama/Peralatan pada item ${index + 1} harus diisi`);
                    isValid = false;
                }
                
                if (!coefficient.value || parseFloat(coefficient.value) <= 0) {
                    coefficient.classList.add('border-red-500');
                    showError(`Koefisien pada item ${index + 1} harus lebih dari 0`);
                    isValid = false;
                }
                
                if (!unitPrice.value || parseFloat(unitPrice.value) <= 0) {
                    unitPrice.classList.add('border-red-500');
                    showError(`Harga satuan pada item ${index + 1} harus lebih dari 0`);
                    isValid = false;
                }
            });
        }
        
        if (!isValid) {
            // Reset button state if validation fails
            submitButton.disabled = false;
            submitButton.innerHTML = submitButtonText;
        }
        
        return isValid;
    }
    
    function showError(message) {
        // Remove existing error alerts
        const existingAlert = document.querySelector('.error-alert');
        if (existingAlert) {
            existingAlert.remove();
        }
        
        // Create new error alert
        const alert = document.createElement('div');
        alert.className = 'error-alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4';
        alert.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        // Insert alert at the top of the form
        form.insertBefore(alert, form.firstChild);
        
        // Scroll to top to show error
        form.scrollIntoView({ behavior: 'smooth', block: 'start' });
        
        // Auto remove alert after 5 seconds
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 5000);
    }
});
</script>
@endsection 