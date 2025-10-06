# Update: Student Selection dengan Searchable Dropdown

## 🎯 Perubahan

Field NIM Mahasiswa telah diubah dari input text biasa menjadi **searchable dropdown** yang mengambil data langsung dari database students.

## ✨ Fitur Baru

### 1. **Real-time Search**
- Cari mahasiswa berdasarkan NIM atau Nama
- Search langsung saat mengetik (live search)
- Dropdown muncul otomatis dengan hasil pencarian

### 2. **Multi-Select**
- Bisa memilih lebih dari satu mahasiswa
- Tampilan visual untuk setiap mahasiswa yang dipilih
- Tombol remove untuk menghapus mahasiswa dari pilihan

### 3. **Validasi Otomatis**
- Data mahasiswa sudah pasti valid (ada di database)
- Tidak perlu validasi manual NIM lagi
- Mencegah input NIM yang tidak terdaftar

### 4. **User-Friendly Interface**
- Dropdown dengan scroll untuk banyak hasil
- Hover effect pada setiap option
- Counter jumlah mahasiswa terpilih
- Visual feedback dengan warna

## 🔧 Implementasi Teknis

### Controller Changes
```php
public function form()
{
    $types = AchievementType::orderBy('name')->get();
    $categories = AchievementCategory::orderBy('name')->get();
    $levels = AchievementLevel::orderBy('name')->get();
    $students = \App\Models\Student::select('id', 'nim', 'name')
        ->orderBy('nim')
        ->get();

    return view('forms.achievement', compact(['types', 'categories', 'levels', 'students']));
}
```

### Blade Template Changes
1. **Search Input Field**: Input untuk mencari mahasiswa
2. **Dropdown Results**: Menampilkan hasil pencarian
3. **Selected Container**: Menampilkan mahasiswa yang sudah dipilih
4. **Hidden Input**: Menyimpan NIM dalam format comma-separated

### JavaScript Features
- **State Management**: `selectedStudents` array untuk track pilihan
- **Search Filter**: Filter berdasarkan NIM dan nama (case-insensitive)
- **Dynamic UI Update**: Real-time update tampilan saat add/remove
- **Click Outside**: Close dropdown saat klik di luar
- **Validation**: Cek minimal 1 mahasiswa sebelum submit

## 📋 Cara Penggunaan

### Untuk User:
1. Klik pada search box "Cari berdasarkan NIM atau Nama..."
2. Ketik NIM atau nama mahasiswa (minimal 1 karakter)
3. Pilih mahasiswa dari dropdown yang muncul
4. Mahasiswa terpilih akan muncul di bawah search box
5. Untuk menambah mahasiswa lain, ulangi langkah 1-3
6. Untuk menghapus, klik icon X di setiap mahasiswa terpilih

### Contoh Pencarian:
- Ketik: `2110` → Akan muncul semua mahasiswa dengan NIM yang mengandung 2110
- Ketik: `John` → Akan muncul semua mahasiswa dengan nama yang mengandung John
- Ketik: `211` → Akan muncul semua mahasiswa dengan NIM yang mengandung 211

## 🎨 UI Components

### Search Box
```
┌─────────────────────────────────────────┐
│ Cari berdasarkan NIM atau Nama...      │
└─────────────────────────────────────────┘
```

### Dropdown Results (saat ada hasil)
```
┌─────────────────────────────────────────┐
│ 2110001                                 │
│ John Doe                                │
├─────────────────────────────────────────┤
│ 2110002                                 │
│ Jane Smith                              │
└─────────────────────────────────────────┘
```

### Selected Students Display
```
┌─────────────────────────────────────────┐
│ 2110001                             [X] │
│ John Doe                                │
└─────────────────────────────────────────┘
┌─────────────────────────────────────────┐
│ 2110002                             [X] │
│ Jane Smith                              │
└─────────────────────────────────────────┘

0 mahasiswa dipilih
```

## ⚙️ Data Flow

1. **Load Page**: 
   - Controller fetch semua data students dari database
   - Pass data ke Blade via compact
   - JavaScript convert PHP array ke JS array

2. **User Types**: 
   - Input event triggered
   - Filter students array by NIM/name
   - Render filtered results to dropdown

3. **User Selects**: 
   - Click event triggered
   - Add student to selectedStudents array
   - Update UI: render selected, update count, update hidden input

4. **User Removes**: 
   - Remove button clicked
   - Filter out student from selectedStudents array
   - Update UI

5. **Form Submit**: 
   - Validate at least 1 student selected
   - Hidden input contains comma-separated NIMs
   - Submit via AJAX with FormData

## 🔒 Validasi

### Client-Side:
- ✅ Minimal 1 mahasiswa harus dipilih
- ✅ File size check (max 2MB)
- ✅ File type check (image only)

### Server-Side:
- ✅ NIM validation (exists in database)
- ✅ All required fields filled
- ✅ File validation (type, size, format)

## 📊 Performance

### Optimisasi:
- Students data di-load sekali saat page load
- Filter dilakukan di client-side (faster)
- Dropdown hanya render matched results
- No additional AJAX calls untuk search

### Scalability:
- Jika students > 1000, pertimbangkan:
  - Server-side search dengan AJAX
  - Pagination pada dropdown
  - Debounce pada search input

## 🐛 Troubleshooting

**Dropdown tidak muncul:**
- Cek console untuk error
- Pastikan students data ter-pass ke view
- Cek JavaScript tidak error

**Search tidak menemukan mahasiswa:**
- Pastikan mahasiswa ada di database
- Cek capitalization (search case-insensitive)
- Cek mahasiswa belum terpilih

**Tidak bisa remove mahasiswa:**
- Cek onclick handler
- Cek function removeStudent defined
- Cek student ID valid

**Form tidak ter-submit:**
- Cek minimal 1 mahasiswa terpilih
- Cek hidden input punya value
- Cek validation di browser console

## 📝 Code Example

### Struktur Data Students (dari Controller)
```javascript
[
    {
        id: 1,
        nim: "2110001",
        name: "John Doe"
    },
    {
        id: 2,
        nim: "2110002",
        name: "Jane Smith"
    }
]
```

### Format Data yang Dikirim ke Server
```
student_nims: "2110001,2110002,2110003"
```

### Response yang Diharapkan
```json
{
    "message": "Prestasi berhasil dikirim dan menunggu verifikasi admin",
    "achievement": { ... }
}
```

## 🚀 Future Enhancements

Possible improvements:
- [ ] Lazy loading untuk banyak students
- [ ] Avatar/photo untuk setiap student
- [ ] Batch year filter
- [ ] Keyboard navigation (arrow keys)
- [ ] Recent selections memory
- [ ] Export selected students list

## 📚 Related Files

- `app/Http/Controllers/StudentAchievementController.php` (updated)
- `resources/views/forms/achievement.blade.php` (updated)
- `app/Models/Student.php`
- `routes/web.php`
