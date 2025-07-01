@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="glass rounded-2xl shadow-2xl p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Edit Estimasi</h2>
        <form method="POST" action="{{ route('estimation.update', $estimation->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="form-label">Kategori</label>
                <select name="category" id="category" class="form-input" required>
                    <option value="">Pilih Kategori</option>
                    <option value="worker" {{ $estimation->category == 'worker' ? 'selected' : '' }}>Tenaga Kerja</option>
                    <option value="material" {{ $estimation->category == 'material' ? 'selected' : '' }}>Material</option>
                    <option value="equipment" {{ $estimation->category == 'equipment' ? 'selected' : '' }}>Peralatan</option>
                </select>
            </div>
            <div class="mb-4" id="worker-select" style="display:none;">
                <label class="form-label">Pilih Tenaga Kerja</label>
                <select name="reference_id" class="form-input">
                    <option value="">Pilih</option>
                    @foreach($workers as $worker)
                        <option value="{{ $worker->id }}" {{ $estimation->category == 'worker' && $estimation->reference_id == $worker->id ? 'selected' : '' }}>{{ $worker->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4" id="material-select" style="display:none;">
                <label class="form-label">Pilih Material</label>
                <select name="reference_id" class="form-input">
                    <option value="">Pilih</option>
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}" {{ $estimation->category == 'material' && $estimation->reference_id == $material->id ? 'selected' : '' }}>{{ $material->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4" id="equipment-input" style="display:none;">
                <label class="form-label">Nama Peralatan</label>
                <input type="text" name="equipment_name" class="form-input" placeholder="Nama Peralatan" value="{{ $estimation->equipment_name }}">
            </div>
            <div class="mb-4">
                <label class="form-label">Satuan</label>
                <input type="text" name="unit" class="form-input" required value="{{ $estimation->unit }}">
            </div>
            <div class="mb-4">
                <label class="form-label">Koefisien</label>
                <input type="number" step="0.001" name="coefficient" class="form-input" required value="{{ $estimation->coefficient }}">
            </div>
            <div class="mb-4">
                <label class="form-label">Harga Satuan (Rp)</label>
                <input type="number" name="unit_price" class="form-input" required value="{{ $estimation->unit_price }}">
            </div>
            <button type="submit" class="btn btn-primary w-full">Update Estimasi</button>
        </form>
    </div>
</div>
<script>
    function showCategoryFields(val) {
        document.getElementById('worker-select').style.display = val === 'worker' ? '' : 'none';
        document.getElementById('material-select').style.display = val === 'material' ? '' : 'none';
        document.getElementById('equipment-input').style.display = val === 'equipment' ? '' : 'none';
    }
    document.getElementById('category').addEventListener('change', function() {
        showCategoryFields(this.value);
    });
    // On page load
    showCategoryFields(document.getElementById('category').value);
</script>
@endsection 