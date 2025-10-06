<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran IF Bangga - HMIF</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logos/hmif.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logos/hmif.png') }}">
    @vite(['resources/css/app.css', "resources/js/app.tsx"])
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Custom scrollbar for dropdown */
        #student_dropdown::-webkit-scrollbar {
            width: 8px;
        }
        #student_dropdown::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        #student_dropdown::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        #student_dropdown::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Fixed Header Image -->
            <div class="w-full h-64 bg-gradient-to-r from-blue-600 to-blue-800 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-4xl font-bold mb-2">IF Bangga</h1>
                    <p class="text-xl">Form Pendaftaran Prestasi Mahasiswa</p>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <!-- Form Description -->
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-md">
                    <p class="text-sm text-blue-800">
                        <strong>Petunjuk:</strong> Silakan lengkapi form berikut untuk mendaftarkan prestasi Anda. 
                        Data yang Anda kirim akan diverifikasi oleh admin sebelum ditampilkan di website.
                    </p>
                </div>

                <!-- Form -->
                <form id="achievement-form" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Achievement Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Prestasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" required
                            placeholder="Contoh: Juara 1 Lomba Web Design Nasional"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Organizer -->
                    <div>
                        <label for="organizer" class="block text-sm font-medium text-gray-700 mb-1">
                            Penyelenggara/Organizer <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="organizer" name="organizer" required
                            placeholder="Contoh: HMIF, IEEE, Kementerian Pendidikan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Students (NIM) -->
                    <div>
                        <label for="student_search" class="block text-sm font-medium text-gray-700 mb-1">
                            Mahasiswa <span class="text-red-500">*</span>
                        </label>
                        <p class="text-sm text-gray-500 mb-2">Cari dan pilih mahasiswa. Bisa memilih lebih dari satu mahasiswa.</p>
                        
                        <!-- Search Input -->
                        <div class="relative mb-2">
                            <input type="text" id="student_search" 
                                placeholder="Cari berdasarkan NIM atau Nama..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div id="student_dropdown" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto hidden">
                                <!-- Results will be populated here -->
                            </div>
                        </div>

                        <!-- Selected Students -->
                        <div id="selected_students" class="space-y-2 mb-2">
                            <!-- Selected students will appear here -->
                        </div>

                        <!-- Hidden input to store selected student IDs -->
                        <input type="hidden" id="student_nims" name="student_nims" required>
                        
                        <p class="text-xs text-gray-500 mt-1">
                            <span id="selected_count">0</span> mahasiswa dipilih
                        </p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi Prestasi <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" name="description" required rows="4"
                            placeholder="Jelaskan detail tentang prestasi ini..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <!-- Image Upload (Bukti Pertama) -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                            Foto/Dokumentasi Prestasi (Diri atau Tim) <span class="text-red-500">*</span>
                        </label>
                        <p class="text-sm text-gray-500 mb-2">Upload foto dokumentasi prestasi (format: JPG, PNG, JPEG, max 2MB)</p>
                        <input type="file" id="image" name="image" required accept="image/jpeg,image/png,image/jpg"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div id="image-preview" class="mt-2 hidden">
                            <img src="" alt="Preview" class="w-full max-w-md h-48 object-cover rounded-md">
                        </div>
                    </div>

                    <!-- Certificate Upload (Sertifikat) -->
                    <div>
                        <label for="proof" class="block text-sm font-medium text-gray-700 mb-1">
                            Sertifikat/Bukti Prestasi
                        </label>
                        <p class="text-sm text-gray-500 mb-2">Upload sertifikat atau bukti prestasi (format: JPG, PNG, JPEG, max 2MB)</p>
                        <input type="file" id="proof" name="proof" accept="image/jpeg,image/png,image/jpg"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div id="proof-preview" class="mt-2 hidden">
                            <img src="" alt="Preview" class="w-full max-w-md h-48 object-cover rounded-md">
                        </div>
                    </div>

                    <!-- Awarded Date -->
                    <div>
                        <label for="awarded_at" class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal Perolehan Prestasi
                        </label>
                        <input type="date" id="awarded_at" name="awarded_at"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Achievement Type -->
                    <div>
                        <label for="achievement_type_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Jenis Prestasi <span class="text-red-500">*</span>
                        </label>
                        <select id="achievement_type_id" name="achievement_type_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih jenis prestasi...</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Achievement Category -->
                    <div>
                        <label for="achievement_category_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Kategori Prestasi <span class="text-red-500">*</span>
                        </label>
                        <select id="achievement_category_id" name="achievement_category_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih kategori prestasi...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Achievement Level -->
                    <div>
                        <label for="achievement_level_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Tingkat Prestasi <span class="text-red-500">*</span>
                        </label>
                        <select id="achievement_level_id" name="achievement_level_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih tingkat prestasi...</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="border-t pt-6">
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="submit-text">Kirim Prestasi</span>
                            <span id="loading-text" class="hidden">Mengirim...</span>
                        </button>
                    </div>

                    <div class="text-sm text-gray-500 text-center">
                        Data yang Anda kirim akan diverifikasi oleh admin terlebih dahulu sebelum ditampilkan.
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <div id="message-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        // Student selection state
        let selectedStudents = [];
        const allStudents = @json($students);

        // Initialize search functionality
        const searchInput = document.getElementById('student_search');
        const dropdown = document.getElementById('student_dropdown');
        const selectedContainer = document.getElementById('selected_students');
        const hiddenInput = document.getElementById('student_nims');
        const selectedCount = document.getElementById('selected_count');

        // Search students
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            
            if (searchTerm.length === 0) {
                dropdown.innerHTML = '';
                dropdown.classList.add('hidden');
                return;
            }

            const filtered = allStudents.filter(student => {
                const nim = student.nim.toLowerCase();
                const name = student.name.toLowerCase();
                return nim.includes(searchTerm) || name.includes(searchTerm);
            }).filter(student => {
                // Exclude already selected students
                return !selectedStudents.find(s => s.id === student.id);
            });

            if (filtered.length === 0) {
                dropdown.innerHTML = '<div class="px-4 py-2 text-sm text-gray-500">Tidak ada mahasiswa ditemukan</div>';
                dropdown.classList.remove('hidden');
                return;
            }

            dropdown.innerHTML = filtered.map(student => `
                <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer student-option" data-id="${student.id}" data-nim="${student.nim}" data-name="${student.name}">
                    <div class="font-medium text-sm">${student.nim}</div>
                    <div class="text-xs text-gray-600">${student.name}</div>
                </div>
            `).join('');

            dropdown.classList.remove('hidden');

            // Add click handlers to options
            document.querySelectorAll('.student-option').forEach(option => {
                option.addEventListener('click', function() {
                    addStudent({
                        id: this.dataset.id,
                        nim: this.dataset.nim,
                        name: this.dataset.name
                    });
                    searchInput.value = '';
                    dropdown.classList.add('hidden');
                });
            });
        });

        // Click outside to close dropdown
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Add student to selection
        function addStudent(student) {
            if (selectedStudents.find(s => s.id === student.id)) {
                return; // Already selected
            }

            selectedStudents.push(student);
            updateUI();
        }

        // Remove student from selection
        function removeStudent(studentId) {
            selectedStudents = selectedStudents.filter(s => s.id != studentId);
            updateUI();
        }

        // Update UI
        function updateUI() {
            // Update selected students display
            if (selectedStudents.length === 0) {
                selectedContainer.innerHTML = '<p class="text-sm text-gray-500 p-3 bg-gray-50 rounded-md">Belum ada mahasiswa dipilih</p>';
            } else {
                selectedContainer.innerHTML = selectedStudents.map(student => `
                    <div class="flex items-center justify-between p-3 bg-blue-50 border border-blue-200 rounded-md">
                        <div>
                            <div class="font-medium text-sm">${student.nim}</div>
                            <div class="text-xs text-gray-600">${student.name}</div>
                        </div>
                        <button type="button" onclick="removeStudent(${student.id})" 
                            class="text-red-500 hover:text-red-700 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                `).join('');
            }

            // Update hidden input with comma-separated NIMs
            const nims = selectedStudents.map(s => s.nim).join(',');
            hiddenInput.value = nims;

            // Update count
            selectedCount.textContent = selectedStudents.length;

            // Update validation
            if (selectedStudents.length > 0) {
                hiddenInput.removeAttribute('required');
            } else {
                hiddenInput.setAttribute('required', 'required');
            }
        }

        // Initial UI update
        updateUI();

        // Image Preview for 'image' field
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    showMessage('Ukuran file terlalu besar. Maksimal 2MB.', 'error');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    preview.querySelector('img').src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Image Preview for 'proof' field
        document.getElementById('proof').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    showMessage('Ukuran file terlalu besar. Maksimal 2MB.', 'error');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('proof-preview');
                    preview.querySelector('img').src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Form submission
        document.getElementById('achievement-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Validate at least one student is selected
            if (selectedStudents.length === 0) {
                showMessage('Pilih minimal satu mahasiswa', 'error');
                return;
            }

            const submitBtn = this.querySelector('button[type="submit"]');
            const submitText = document.getElementById('submit-text');
            const loadingText = document.getElementById('loading-text');
            
            // Disable submit button
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            
            try {
                const formData = new FormData(this);
                
                const response = await fetch('{{ route("student.achievements.create") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    showMessage('Prestasi berhasil dikirim! Data Anda akan diverifikasi oleh admin.', 'success');
                    this.reset();
                    // Hide previews
                    document.getElementById('image-preview').classList.add('hidden');
                    document.getElementById('proof-preview').classList.add('hidden');
                    
                    // Redirect after 2 seconds
                    setTimeout(() => {
                        window.location.href = '{{ route("student.achievements.index") }}';
                    }, 2000);
                } else {
                    if (result.errors) {
                        let errorMessage = 'Terjadi kesalahan:\n';
                        for (const field in result.errors) {
                            errorMessage += result.errors[field].join(', ') + '\n';
                        }
                        showMessage(errorMessage, 'error');
                    } else if (result.message) {
                        showMessage(result.message, 'error');
                    } else {
                        showMessage('Terjadi kesalahan saat mengirim data', 'error');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showMessage('Terjadi kesalahan jaringan. Silakan coba lagi.', 'error');
            } finally {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
            }
        });
        
        function showMessage(message, type) {
            const container = document.getElementById('message-container');
            const div = document.createElement('div');
            
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            
            div.className = `${bgColor} text-white px-6 py-3 rounded-md shadow-lg mb-4 max-w-sm whitespace-pre-line`;
            div.textContent = message;
            
            container.appendChild(div);
            
            setTimeout(() => {
                div.remove();
            }, 5000);
        }
    </script>
</body>
</html>
