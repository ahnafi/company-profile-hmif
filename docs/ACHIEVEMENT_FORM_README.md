# IF Bangga Achievement Form Implementation

## Overview
Halaman form pendaftaran prestasi mahasiswa IF Bangga yang terintegrasi dengan sistem verifikasi admin.

## Features Implemented

### 1. Blade Template Form (`resources/views/forms/achievement.blade.php`)
- **Fixed Header Image**: Header dengan gradient blue yang fixed di bagian atas
- **Responsive Design**: Menggunakan Tailwind CSS untuk tampilan yang responsive
- **Form Fields**:
  - Nama Prestasi (required)
  - NIM Mahasiswa (required, multi-student dengan pemisah koma)
  - Deskripsi Prestasi (required, textarea)
  - Foto/Dokumentasi (required, image upload, max 2MB)
  - Sertifikat/Bukti (optional, image upload, max 2MB)
  - Tanggal Perolehan
  - Jenis Prestasi (dropdown, required)
  - Kategori Prestasi (dropdown, required)
  - Tingkat Prestasi (dropdown, required)

### 2. Image Upload Features
- **File Type Validation**: Hanya menerima JPG, JPEG, PNG
- **File Size Validation**: Maksimal 2MB per file
- **Live Preview**: Preview gambar sebelum submit
- **Two Upload Fields**:
  1. `image`: Foto dokumentasi prestasi (wajib)
  2. `proof`: Sertifikat/bukti prestasi (opsional)

### 3. Controller Implementation (`app/Http/Controllers/StudentAchievementController.php`)

#### `form()` Method
- Menampilkan halaman form
- Menyediakan data dropdown: types, categories, levels

#### `create()` Method
- **Validation Rules**:
  - Semua field required kecuali proof dan awarded_at
  - Image validation: format dan ukuran
  - NIM validation: cek keberadaan di database
  
- **Multi-Student Handling**:
  - Parse NIM yang dipisah koma
  - Validasi semua NIM terdaftar di database
  - Attach multiple students ke achievement via pivot table

- **File Upload**:
  - Store di `storage/app/public/ifbangga-image/`
  - Store di `storage/app/public/ifbangga-proof/`
  - Auto cleanup jika terjadi error saat save

- **Approval System**:
  - Set `approval` field ke `null` untuk verifikasi manual admin
  - Admin dapat approve/reject via Filament panel

- **Error Handling**:
  - Try-catch untuk database operations
  - Cleanup uploaded files jika gagal
  - Return proper JSON responses

### 4. Routes Configuration (`routes/web.php`)

```php
Route::get('/if-bangga/formulir', 'form')->name('student.achievements.form');
Route::post('/if-bangga', 'create')->name('student.achievements.create')->middleware('throttle:3,10');
```

- **Throttle Middleware**: `throttle:3,10`
  - Maksimal 3 request per 10 menit
  - Mencegah spam/abuse dari bot

### 5. JavaScript Features
- **AJAX Form Submission**: Async form submit tanpa reload
- **Image Preview**: Real-time preview untuk kedua upload fields
- **File Size Validation**: Client-side validation sebelum upload
- **Loading State**: Disable button dan show loading text saat submit
- **Toast Notifications**: Success/error messages dengan auto-dismiss
- **Auto Redirect**: Redirect ke halaman IF Bangga setelah success

## Database Schema
Achievement model menggunakan relasi many-to-many dengan Student via `achievement_student` pivot table:

```php
// Achievement fields
- name: string
- description: text
- image: string (path)
- proof: string|null (path)
- awarded_at: date|null
- approval: boolean|null (null = pending, true = approved, false = rejected)
- achievement_type_id: foreign key
- achievement_category_id: foreign key
- achievement_level_id: foreign key
```

## Security Features
1. **CSRF Protection**: Token validation untuk semua POST requests
2. **Throttle Middleware**: Rate limiting untuk mencegah spam
3. **File Validation**: 
   - Type validation (hanya image)
   - Size validation (max 2MB)
   - Server-side validation
4. **Database Validation**: NIM existence check
5. **Error Handling**: Proper error messages tanpa expose sensitive info

## Admin Verification Workflow
1. User submit form → `approval = null` (pending)
2. Admin review di Filament panel
3. Admin approve → `approval = true` (tampil di public)
4. Admin reject → `approval = false` (tidak tampil)
5. Hanya achievement dengan `approval = true` yang muncul di halaman publik

## Testing Checklist
- [ ] Form dapat diakses via `/if-bangga/formulir`
- [ ] Validation errors muncul dengan proper message
- [ ] Image upload berhasil dengan preview
- [ ] Multi-student (comma-separated NIM) berhasil
- [ ] Throttle middleware bekerja (max 3 per 10 min)
- [ ] Data tersimpan dengan approval = null
- [ ] Admin dapat approve/reject di Filament
- [ ] Hanya approved achievement yang muncul di public page

## File Structure
```
app/
├── Http/Controllers/
│   └── StudentAchievementController.php  (updated)
├── Models/
│   ├── Achievement.php
│   └── Student.php
resources/
└── views/
    └── forms/
        └── achievement.blade.php  (new)
routes/
└── web.php  (updated)
```

## Usage
1. User mengakses: `https://yourdomain.com/if-bangga/formulir`
2. Mengisi form dengan data prestasi
3. Upload foto dokumentasi (required) dan sertifikat (optional)
4. Submit form
5. Data masuk ke database dengan status pending (approval = null)
6. Admin verifikasi di panel Filament
7. Jika approved, muncul di halaman publik IF Bangga

## Notes
- Pastikan symbolic link untuk storage sudah dibuat: `php artisan storage:link`
- Pastikan folder storage memiliki permission yang tepat
- Image disimpan di `public/storage/ifbangga-image/` dan `public/storage/ifbangga-proof/`
