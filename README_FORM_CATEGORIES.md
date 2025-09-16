# Implementasi Kategori Form TKDN

## Overview
Implementasi ini menambahkan sistem kategori form TKDN yang memungkinkan pemilihan jenis form berdasarkan kategori:

- **Kategori 1: TKDN Jasa** - Form 3.1 sampai 3.5
- **Kategori 2: TKDN Barang & Jasa** - Form 4.1 sampai 4.7

## Perubahan yang Dilakukan

### 1. Database Migration
- **File**: `database/migrations/2025_09_16_023102_add_form_category_to_services_table.php`
- **Perubahan**: Menambahkan kolom `form_category` dengan enum `['tkdn_jasa', 'tkdn_barang_jasa']`

### 2. Model Service
- **File**: `app/Models/Service.php`
- **Perubahan**:
  - Menambahkan konstanta `CATEGORY_TKDN_JASA` dan `CATEGORY_TKDN_BARANG_JASA`
  - Menambahkan method `getFormCategories()` untuk mendapatkan daftar kategori
  - Menambahkan method `getFormCategoryLabel()` untuk mendapatkan label kategori
  - Menambahkan method `getAvailableForms()` untuk mendapatkan form yang tersedia berdasarkan kategori

### 3. Controller ServiceController
- **File**: `app/Http/Controllers/ServiceController.php`
- **Perubahan**:
  - Menambahkan `form_category` ke validation rules di method `store()` dan `update()`
  - Mengupdate method `generateTkdnFormsFromHpp()` untuk menggunakan kategori form
  - Menambahkan `formCategories` ke view data di method `create()` dan `edit()`

### 4. Views
- **File**: `resources/views/service/create.blade.php`
  - Menambahkan field select untuk kategori form
  - Menambahkan JavaScript `updateFormCategoryPreview()` untuk menangani perubahan kategori

- **File**: `resources/views/service/edit.blade.php`
  - Menambahkan field select untuk kategori form dengan nilai yang sudah ada

- **File**: `resources/views/service/show.blade.php`
  - Menambahkan badge untuk menampilkan kategori form yang dipilih

### 5. Testing
- **File**: `tests/Feature/ServiceFormCategoryTest.php`
- **Coverage**: 8 test cases yang mencakup:
  - Validasi model dan method
  - Testing form categories
  - Testing available forms berdasarkan kategori
  - Testing tampilan di halaman create, edit, dan show

## Cara Penggunaan

### 1. Membuat Service Baru
1. Pilih **Kategori Form TKDN**:
   - `TKDN Jasa (Form 3.1 - 3.5)` - untuk form 3.1, 3.2, 3.3, 3.4, 3.5
   - `TKDN Barang & Jasa (Form 4.1 - 4.7)` - untuk form 4.1, 4.2, 4.3, 4.4, 4.5, 4.6, 4.7

2. Pilih **Jenis Service** (project, equipment, construction)

3. Pilih **HPP** sebagai sumber data

4. System akan otomatis generate form sesuai kategori yang dipilih

### 2. Form yang Tersedia

#### Kategori TKDN Jasa (3.1 - 3.5):
- **3.1**: Jasa Manajemen Proyek dan Perekayasaan
- **3.2**: Jasa Alat Kerja dan Peralatan  
- **3.3**: Jasa Konstruksi dan Pembangunan
- **3.4**: Jasa Konsultasi dan Pengawasan
- **3.5**: Rangkuman TKDN Jasa

#### Kategori TKDN Barang & Jasa (4.1 - 4.7):
- **4.1**: Jasa Teknik dan Rekayasa
- **4.2**: Jasa Pengadaan dan Logistik
- **4.3**: Jasa Operasi dan Pemeliharaan
- **4.4**: Jasa Pelatihan dan Sertifikasi
- **4.5**: Jasa Teknologi Informasi
- **4.6**: Jasa Lingkungan dan Keamanan
- **4.7**: Jasa Lainnya

## Keamanan dan Validasi
- Semua input divalidasi dengan Laravel validation rules
- Authorization menggunakan middleware `can:manage-service`
- Database constraints dengan enum untuk memastikan data integrity

## Testing
Jalankan test dengan perintah:
```bash
php artisan test tests/Feature/ServiceFormCategoryTest.php
```

Semua test telah lulus dengan 8 test cases dan 32 assertions.
