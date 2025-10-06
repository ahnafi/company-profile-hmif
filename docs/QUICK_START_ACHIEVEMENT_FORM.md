# Quick Start Guide - IF Bangga Achievement Form

## 🚀 Setup

Jalankan command berikut untuk memastikan storage link sudah dibuat:

```bash
php artisan storage:link
```

## 📍 URLs

- **Form Page**: `http://localhost/if-bangga/formulir`
- **Public Page**: `http://localhost/if-bangga`

## 📝 Form Fields

### Required Fields:
- ✅ Nama Prestasi
- ✅ NIM Mahasiswa (pisah dengan koma untuk multiple)
- ✅ Deskripsi
- ✅ Foto Dokumentasi (image, max 2MB)
- ✅ Jenis Prestasi (dropdown)
- ✅ Kategori Prestasi (dropdown)
- ✅ Tingkat Prestasi (dropdown)

### Optional Fields:
- ⚪ Sertifikat/Bukti (image, max 2MB)
- ⚪ Tanggal Perolehan

## 🔒 Security

- **Throttle**: 3 requests per 10 minutes
- **CSRF**: Protected
- **File Validation**: Type & size checked

## 📊 Admin Workflow

1. Data masuk dengan status `approval = null` (pending)
2. Admin buka Filament panel
3. Admin klik "Approve" atau "Reject"
4. Hanya data approved yang muncul di public

## 🧪 Testing

```bash
# Test form access
curl http://localhost/if-bangga/formulir

# Test throttle (jalankan 4x cepat, ke-4 akan ditolak)
curl -X POST http://localhost/if-bangga \
  -F "name=Test Achievement" \
  -F "student_nims=2110001" \
  -F "description=Test Description" \
  -F "image=@/path/to/image.jpg" \
  -F "achievement_type_id=1" \
  -F "achievement_category_id=1" \
  -F "achievement_level_id=1"
```

## 💡 Tips

1. **Multiple Students**: Format NIM: `2110001, 2110002, 2110003`
2. **Image Size**: Kompres dulu jika lebih dari 2MB
3. **Testing**: Gunakan Postman atau browser untuk test upload
4. **Admin Panel**: Login ke `/admin` untuk approve/reject

## ⚠️ Troubleshooting

**Error: "The image field is required"**
- Pastikan file size < 2MB
- Pastikan format JPG/PNG/JPEG

**Error: "NIM tidak valid"**
- Cek NIM ada di tabel students
- Cek format: pisah dengan koma

**Error: 429 Too Many Requests**
- Tunggu 10 menit sebelum submit lagi
- Throttle: 3 submit per 10 menit

**Storage link error**
- Run: `php artisan storage:link`
- Check permission: `chmod -R 775 storage`
