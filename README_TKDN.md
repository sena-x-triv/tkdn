# Fitur TKDN (Tingkat Komponen Dalam Negeri)

## Deskripsi
Fitur TKDN adalah modul untuk mengelola data item-item TKDN dan menghitung breakdown biaya berdasarkan klasifikasi TKDN. Fitur ini dibuat berdasarkan gambar breakdown biaya yang terlampir.

## Fitur yang Tersedia

### 1. Manajemen Data TKDN
- **CRUD Item TKDN**: Tambah, edit, hapus, dan lihat detail item TKDN
- **Klasifikasi TKDN**: Mendukung klasifikasi 3.1, 3.2, 3.3, 3.4
- **Status Aktif/Nonaktif**: Kontrol ketersediaan item TKDN
- **Filter dan Pencarian**: Filter berdasarkan klasifikasi, status, dan pencarian berdasarkan nama/kode

### 2. Breakdown Biaya TKDN
- **Perhitungan Otomatis**: Menghitung total harga berdasarkan volume dan durasi
- **Parameter Fleksibel**: Volume, durasi, overhead, margin, dan PPN dapat disesuaikan
- **Tampilan Tabel**: Menampilkan breakdown seperti di gambar terlampir
- **Fitur Print**: Halaman print yang dioptimalkan untuk printing

### 3. Data Seeder
- **Data Default**: 4 item TKDN berdasarkan gambar terlampir
- **Klasifikasi Lengkap**: 3.1, 3.2, 3.3, 3.4
- **Harga Realistis**: Sesuai dengan data di gambar

## Struktur Database

### Tabel `tkdn_items`
```sql
- id (Primary Key)
- code (String, Unique) - Kode item TKDN
- name (String) - Nama item/uraian barang/pekerjaan
- tkdn_classification (String) - Klasifikasi TKDN (3.1, 3.2, 3.3, 3.4)
- unit (String) - Satuan (Box, Bulan, dll)
- unit_price (Decimal) - Harga satuan
- description (Text, Nullable) - Deskripsi tambahan
- is_active (Boolean) - Status aktif/nonaktif
- created_at, updated_at (Timestamps)
```

## Cara Penggunaan

### 1. Akses Menu TKDN
1. Login ke aplikasi
2. Klik menu "Master" di sidebar
3. Pilih "TKDN"

### 2. Mengelola Data TKDN
1. **Tambah Item Baru**:
   - Klik tombol "Tambah Item TKDN"
   - Isi form dengan data lengkap
   - Klik "Simpan"

2. **Edit Item**:
   - Klik ikon edit pada item yang ingin diedit
   - Ubah data yang diperlukan
   - Klik "Update"

3. **Hapus Item**:
   - Klik ikon hapus pada item yang ingin dihapus
   - Konfirmasi penghapusan

4. **Toggle Status**:
   - Klik ikon play/pause untuk mengaktifkan/nonaktifkan item

### 3. Breakdown Biaya
1. **Akses Breakdown**:
   - Klik tombol "Breakdown TKDN" di halaman index
   - Atau akses langsung: `/master/tkdn-breakdown`

2. **Atur Parameter**:
   - Volume: Jumlah box (default: 600)
   - Durasi: Jumlah bulan (default: 12)
   - Overhead: Persentase overhead (default: 8%)
   - Margin: Persentase margin (default: 12%)
   - PPN: Persentase PPN (default: 11%)

3. **Hitung Breakdown**:
   - Klik tombol "Hitung"
   - Sistem akan menampilkan tabel breakdown

4. **Print Breakdown**:
   - Klik tombol "Print" untuk mencetak
   - Halaman print akan terbuka di tab baru

## Perhitungan Breakdown

### Formula Perhitungan
1. **Total Harga Item**: `unit_price × volume × duration`
2. **Sub Total HPP**: `Σ(total_harga_item)`
3. **Overhead**: `sub_total_hpp × overhead_percentage / 100`
4. **Margin**: `sub_total_hpp × margin_percentage / 100`
5. **Sub Total**: `sub_total_hpp + overhead + margin`
6. **PPN**: `sub_total × ppn_percentage / 100`
7. **Grand Total**: `sub_total + ppn`

### Contoh Perhitungan
Berdasarkan data default:
- Volume: 600 Box
- Durasi: 12 Bulan
- Overhead: 8%
- Margin: 12%
- PPN: 11%

**Hasil Perhitungan**:
- Sub Total HPP: Rp 1.294.026.000
- Overhead: Rp 103.522.080
- Margin: Rp 155.283.120
- Sub Total: Rp 1.552.831.200
- PPN: Rp 170.811.432
- **Grand Total: Rp 1.723.642.632**

## Data Default

### Item TKDN yang Tersedia
1. **A.6.3.3.1** - Penerimaan dan Pengangkutan Arsip Per Box Standard
   - Klasifikasi: 3.1
   - Harga: Rp 77.325,00

2. **A.6.3.4.1** - Pemilahan dan Update Database Arsip Per Box Standard
   - Klasifikasi: 3.2
   - Harga: Rp 66.425,00

3. **A.6.3.2.1** - Penyimpanan Arsip Per Box Standart
   - Klasifikasi: 3.3
   - Harga: Rp 35.975,83

4. **A.6.3.1.1** - Penataan Arsip Per Box Arsip Standart
   - Klasifikasi: 3.4
   - Harga: Rp 44.758,33

## Routes yang Tersedia

### Master Routes
- `GET /master/tkdn` - Index TKDN
- `GET /master/tkdn/create` - Form tambah item
- `POST /master/tkdn` - Simpan item baru
- `GET /master/tkdn/{id}` - Detail item
- `GET /master/tkdn/{id}/edit` - Form edit item
- `PUT /master/tkdn/{id}` - Update item
- `DELETE /master/tkdn/{id}` - Hapus item
- `PATCH /master/tkdn/{id}/toggle-status` - Toggle status

### Breakdown Routes
- `GET /master/tkdn-breakdown` - Halaman breakdown
- `GET /master/tkdn-breakdown/print` - Halaman print

## Keamanan dan Validasi

### Validasi Input
- **Kode**: Required, unique, max 50 karakter
- **Nama**: Required, max 255 karakter
- **Klasifikasi**: Required, hanya 3.1, 3.2, 3.3, 3.4
- **Satuan**: Required, max 50 karakter
- **Harga**: Required, numeric, min 0
- **Deskripsi**: Optional, text

### Keamanan
- **CSRF Protection**: Semua form dilindungi CSRF
- **Mass Assignment Protection**: Menggunakan `$fillable`
- **Database Transactions**: Menggunakan transaksi untuk operasi kritis
- **Input Sanitization**: Validasi dan sanitasi input

## Teknologi yang Digunakan

### Backend
- **Laravel 10**: Framework PHP
- **Eloquent ORM**: Database abstraction
- **Database Migrations**: Schema management
- **Database Seeders**: Data seeding

### Frontend
- **Tailwind CSS**: Styling
- **Alpine.js**: JavaScript framework
- **Font Awesome**: Icons
- **Print CSS**: Optimized printing

### Database
- **MySQL/PostgreSQL**: Database
- **Foreign Keys**: Referential integrity
- **Indexes**: Performance optimization

## Maintenance dan Troubleshooting

### Menjalankan Seeder
```bash
php artisan db:seed --class=TkdnItemSeeder
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Troubleshooting
1. **Menu tidak muncul**: Pastikan route sudah terdaftar
2. **Data tidak muncul**: Jalankan seeder
3. **Perhitungan salah**: Periksa data di database
4. **Print tidak berfungsi**: Periksa browser settings

## Pengembangan Selanjutnya

### Fitur yang Bisa Ditambahkan
1. **Export Excel/PDF**: Export breakdown ke Excel/PDF
2. **Template Breakdown**: Multiple template breakdown
3. **History Perubahan**: Log perubahan data TKDN
4. **Approval Workflow**: Workflow approval untuk breakdown
5. **Multi-currency**: Support multiple currency
6. **API Endpoints**: REST API untuk integrasi
7. **Bulk Operations**: Import/export bulk data
8. **Advanced Filtering**: Filter berdasarkan range harga, tanggal, dll

### Optimasi Performance
1. **Database Indexing**: Optimize query performance
2. **Caching**: Cache frequently accessed data
3. **Lazy Loading**: Optimize relationship loading
4. **Pagination**: Handle large datasets
5. **Search Optimization**: Full-text search capabilities
