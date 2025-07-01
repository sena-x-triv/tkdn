@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="glass rounded-2xl shadow-2xl p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Tambah Estimasi</h2>
        <form method="POST" action="{{ route('estimation.store') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Kategori</label>
                <select name="category" id="category" class="form-input" required>
                    <option value="">Pilih Kategori</option>
                    <option value="worker">Tenaga Kerja</option>
                    <option value="material">Material</option>
                    <option value="equipment">Peralatan</option>
                </select>
            </div>
            <div class="mb-4" id="worker-select" style="display:none;">
                <label class="form-label">Pilih Tenaga Kerja</label>
                <select name="reference_id" class="form-input">
                    <option value="">Pilih</option>
                    @foreach($workers as $worker)
                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4" id="material-select" style="display:none;">
                <label class="form-label">Pilih Material</label>
                <select name="reference_id" class="form-input">
                    <option value="">Pilih</option>
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4" id="equipment-input" style="display:none;">
                <label class="form-label">Nama Peralatan</label>
                <input type="text" name="equipment_name" class="form-input" placeholder="Nama Peralatan">
            </div>
            <div class="mb-4">
                <label class="form-label">Satuan</label>
                <input type="text" name="unit" class="form-input" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Koefisien</label>
                <input type="number" step="0.001" name="coefficient" class="form-input" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Harga Satuan (Rp)</label>
                <input type="number" name="unit_price" class="form-input" required>
            </div>
            <button type="submit" class="btn btn-primary w-full">Simpan Estimasi</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('category').addEventListener('change', function() {
        document.getElementById('worker-select').style.display = this.value === 'worker' ? '' : 'none';
        document.getElementById('material-select').style.display = this.value === 'material' ? '' : 'none';
        document.getElementById('equipment-input').style.display = this.value === 'equipment' ? '' : 'none';
    });
</script>
@endsection 