# Fitur Jasa Proyek - TKDN

## Deskripsi
Fitur Jasa Proyek adalah modul untuk mengelola formulir TKDN (Tingkat Komponen Dalam Negeri) untuk jasa manajemen proyek dan perekayasaan. Fitur ini memungkinkan pengguna untuk membuat, mengelola, dan melacak status jasa proyek sesuai dengan standar formulir 3.1 TKDN.

## Fitur Utama

### 1. Manajemen Jasa Proyek
- **CRUD Operations**: Create, Read, Update, Delete jasa proyek
- **Status Management**: Draft, Submitted, Approved, Rejected
- **Workflow**: Sistem approval untuk jasa proyek

### 2. Detail Item Jasa
- **Multiple Items**: Setiap jasa proyek dapat memiliki multiple item
- **TKDN Calculation**: Perhitungan otomatis persentase TKDN
- **Cost Breakdown**: Pemisahan biaya KDN (Domestik) dan KLN (Luar Negeri)

### 3. Formulir TKDN
- **Structured Data**: Sesuai format formulir 3.1 TKDN
- **Validation**: Validasi input yang ketat
- **Calculation**: Perhitungan otomatis total biaya dan persentase TKDN

## Struktur Database

### Tabel `project_services`
- `id` (ULID): Primary key
- `project_id` (ULID): Foreign key ke tabel projects
- `service_name`: Nama jasa
- `provider_name`: Nama penyedia barang/jasa
- `provider_address`: Alamat penyedia
- `user_name`: Pengguna barang/jasa
- `document_number`: Nomor dokumen jasa
- `total_domestic_cost`: Total biaya KDN
- `total_foreign_cost`: Total biaya KLN
- `total_cost`: Total biaya keseluruhan
- `tkdn_percentage`: Persentase TKDN
- `status`: Status (draft, submitted, approved, rejected)

### Tabel `project_service_items`
- `id` (ULID): Primary key
- `project_service_id` (ULID): Foreign key ke project_services
- `item_number`: Nomor urut item
- `description`: Uraian item
- `qualification`: Kualifikasi
- `nationality`: Kewarganegaraan (WNI/WNA)
- `tkdn_percentage`: Persentase TKDN item
- `quantity`: Jumlah
- `duration`: Durasi
- `duration_unit`: Satuan durasi
- `wage`: Upah (Rupiah)
- `domestic_cost`: Biaya KDN
- `foreign_cost`: Biaya KLN
- `total_cost`: Total biaya item

## Workflow

### 1. Draft
- Jasa proyek dibuat dalam status "draft"
- Dapat diedit dan dihapus
- Belum dapat diajukan

### 2. Submitted
- Jasa proyek diajukan untuk approval
- Tidak dapat diedit lagi
- Menunggu approval dari admin

### 3. Approved/Rejected
- Status final setelah review
- Tidak dapat diubah lagi

## Perhitungan TKDN

### Formula Perhitungan
```
Total Biaya Item = Upah × Jumlah × Durasi
Biaya KDN = Total Biaya Item × (TKDN % / 100)
Biaya KLN = Total Biaya Item - Biaya KDN
Persentase TKDN = (Total Biaya KDN / Total Biaya) × 100
```

### Contoh
- Item: Overhead management
- Upah: Rp 103.522.080
- Jumlah: 1
- Durasi: 1.00 Is
- TKDN: 100%
- Total Biaya: Rp 103.522.080
- Biaya KDN: Rp 103.522.080
- Biaya KLN: Rp 0

## API Endpoints

### Resource Routes
- `GET /master/project-service` - Index
- `GET /master/project-service/create` - Create form
- `POST /master/project-service` - Store
- `GET /master/project-service/{id}` - Show
- `GET /master/project-service/{id}/edit` - Edit form
- `PUT /master/project-service/{id}` - Update
- `DELETE /master/project-service/{id}` - Delete

### Additional Routes
- `POST /master/project-service/{id}/submit` - Submit for approval
- `POST /master/project-service/{id}/approve` - Approve
- `POST /master/project-service/{id}/reject` - Reject

## Penggunaan

### 1. Membuat Jasa Proyek Baru
1. Klik menu "Jasa Proyek" di sidebar
2. Klik tombol "Tambah Jasa Proyek"
3. Isi informasi umum (proyek, nama jasa, penyedia, dll)
4. Tambah item-item jasa dengan detail lengkap
5. Klik "Simpan Jasa Proyek"

### 2. Mengelola Status
- **Draft**: Dapat diedit dan dihapus
- **Submitted**: Klik "Ajukan" untuk mengirim ke approval
- **Approved/Rejected**: Status final

### 3. Melihat Detail
- Klik "Detail" pada daftar jasa proyek
- Tampilan sesuai format formulir TKDN
- Informasi lengkap item dan perhitungan

## Validasi

### Informasi Umum
- Proyek: Required, harus ada di database
- Nama Jasa: Required, max 255 karakter
- Penyedia: Optional, max 255 karakter
- Alamat: Optional, text
- Pengguna: Optional, max 255 karakter
- Dokumen: Optional, max 255 karakter

### Item Jasa
- Uraian: Required, max 255 karakter
- Kualifikasi: Optional, max 255 karakter
- Kewarganegaraan: Required, WNI/WNA
- TKDN: Required, 0-100%
- Jumlah: Required, min 1
- Durasi: Required, min 0
- Satuan Durasi: Required, max 10 karakter
- Upah: Required, min 0

## Keamanan

### ACID Compliance
- Menggunakan database transactions untuk operasi multi-step
- Rollback otomatis jika terjadi error
- Validasi data sebelum penyimpanan

### Authorization
- Menggunakan middleware auth untuk proteksi route
- Validasi input menggunakan Laravel validation
- Sanitasi data untuk mencegah XSS

## Testing

### Unit Tests
- Model relationships
- Calculation methods
- Validation rules

### Feature Tests
- CRUD operations
- Workflow status changes
- Form validation
- Authorization

## Maintenance

### Backup
- Database backup regular
- Backup file uploads jika ada

### Monitoring
- Log aktivitas user
- Error tracking
- Performance monitoring

## Future Enhancements

### Planned Features
- Export ke PDF/Excel
- Email notifications
- Advanced filtering dan search
- Bulk operations
- API untuk integrasi eksternal

### Technical Improvements
- Caching untuk performance
- Queue untuk background jobs
- Real-time updates
- Mobile responsive improvements 