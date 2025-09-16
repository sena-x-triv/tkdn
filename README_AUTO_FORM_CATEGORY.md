# Auto Generation Form Category TKDN

## Overview
Sistem sekarang secara otomatis menentukan `form_category` berdasarkan jenis form yang tersedia di HPP yang dipilih, sehingga user tidak perlu memilih kategori form secara manual.

## Perubahan yang Dilakukan

### 1. Controller ServiceController
- **File**: `app/Http/Controllers/ServiceController.php`
- **Perubahan**:
  - Menghapus `form_category` dari validation rules di method `store()`
  - Menambahkan method `determineFormCategoryFromHpp()` untuk auto determination
  - Logic auto determination:
    - Jika ada form 4.x di HPP → `TKDN Barang & Jasa`
    - Jika hanya ada form 3.x atau tidak ada form → `TKDN Jasa`
    - Prioritas: Form 4.x lebih diutamakan daripada form 3.x

### 2. Views
- **File**: `resources/views/service/create.blade.php`
  - Mengganti field select dengan info box yang menjelaskan auto determination
  - Menghapus JavaScript `updateFormCategoryPreview()`

- **File**: `resources/views/service/edit.blade.php`
  - Menampilkan form_category sebagai read-only info box
  - Menjelaskan bahwa kategori ditentukan otomatis

### 3. Testing
- **File**: `tests/Feature/ServiceFormCategoryTest.php`
- **Test Cases Baru**:
  - `test_form_category_determined_automatically_from_hpp_with_form3()`
  - `test_form_category_determined_automatically_from_hpp_with_form4()`
  - `test_form_category_prioritizes_form4_over_form3()`

## Logic Auto Determination

### Algoritma Penentuan Kategori:

1. **Ambil semua `tkdn_classification` dari HPP items**
2. **Cek keberadaan form 4.x**:
   - Jika ada form 4.x → `TKDN Barang & Jasa`
3. **Cek keberadaan form 3.x**:
   - Jika hanya ada form 3.x atau tidak ada form → `TKDN Jasa`
4. **Default fallback**:
   - Jika tidak ada form sama sekali → `TKDN Jasa`

### Prioritas:
- **Form 4.x** memiliki prioritas tertinggi
- **Form 3.x** sebagai fallback
- **Default** ke TKDN Jasa jika tidak ada form

## Contoh Skenario:

### Skenario 1: HPP dengan Form 3.x
```
HPP Items:
- Item 1: tkdn_classification = "3.1"
- Item 2: tkdn_classification = "3.2"

Result: form_category = "tkdn_jasa"
```

### Skenario 2: HPP dengan Form 4.x
```
HPP Items:
- Item 1: tkdn_classification = "4.1"
- Item 2: tkdn_classification = "4.2"

Result: form_category = "tkdn_barang_jasa"
```

### Skenario 3: HPP dengan Form 3.x dan 4.x
```
HPP Items:
- Item 1: tkdn_classification = "3.1"
- Item 2: tkdn_classification = "4.1"

Result: form_category = "tkdn_barang_jasa" (prioritas form 4.x)
```

### Skenario 4: HPP tanpa Form
```
HPP Items:
- Item 1: tkdn_classification = null
- Item 2: tkdn_classification = ""

Result: form_category = "tkdn_jasa" (default fallback)
```

## Keuntungan:

1. **User Experience**: User tidak perlu memilih kategori form secara manual
2. **Konsistensi**: Kategori form selalu sesuai dengan data HPP
3. **Akurasi**: Menghindari kesalahan pemilihan kategori
4. **Otomatisasi**: Proses lebih efisien dan cepat

## Testing:

Jalankan test dengan perintah:
```bash
php artisan test tests/Feature/ServiceFormCategoryTest.php
```

**Hasil Test**: 11 passed (38 assertions) ✅

## Logging:

Sistem mencatat proses penentuan kategori di log:
- `Determining form category from HPP`
- `Form category determined: TKDN Jasa/Barang & Jasa`
- Detail form classifications yang ditemukan

## Backward Compatibility:

- Service yang sudah ada tetap mempertahankan `form_category` yang sudah ditentukan
- Edit service tidak mengubah `form_category` (read-only)
- Hanya service baru yang menggunakan auto determination
