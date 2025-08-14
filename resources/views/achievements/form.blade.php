@extends('layout.companyProfile')

@section('title', 'Formulir IF Bangga')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Formulir IF Bangga</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.achievements.create') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Tipe Prestasi --}}
            <div class="mb-3">
                <label for="type_id" class="form-label">Tipe Prestasi</label>
                <select name="type_id" id="type_id" class="form-select">
                    <option value="">-- Pilih Tipe --</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Kategori Prestasi --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori Prestasi</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Tingkat Prestasi --}}
            <div class="mb-3">
                <label for="level_id" class="form-label">Tingkat Prestasi</label>
                <select name="level_id" id="level_id" class="form-select">
                    <option value="">-- Pilih Tingkat --</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                            {{ $level->name }}
                        </option>
                    @endforeach
                </select>
                @error('level_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Nama Prestasi --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nama Prestasi</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name') }}">
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Tanggal Penghargaan --}}
            <div class="mb-3">
                <label for="awarded_at" class="form-label">Tanggal Penghargaan</label>
                <input type="date" name="awarded_at" id="awarded_at" class="form-control"
                       value="{{ old('awarded_at') }}">
                @error('awarded_at') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Upload Gambar --}}
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Prestasi</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Upload Bukti --}}
            <div class="mb-3">
                <label for="proof" class="form-label">Bukti Prestasi</label>
                <input type="file" name="proof" id="proof" class="form-control">
                @error('proof') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- NIM Mahasiswa --}}
            <div class="mb-3">
                <label class="form-label">NIM Mahasiswa</label>
                <div id="nim-fields">
                    @php
                        $oldNims = old('nim', ['']);
                    @endphp
                    @foreach ($oldNims as $nim)
                        <div class="d-flex mb-2 nim-group">
                            <input type="text" name="nim[]" class="form-control me-2" value="{{ $nim }}" placeholder="Masukkan NIM">
                            <button type="button" class="btn btn-danger btn-remove-nim">Hapus</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-nim" class="btn btn-secondary mt-2">Tambah NIM</button>
                @error('nim') <div class="text-danger small">{{ $message }}</div> @enderror
                @error('nim.*') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>

    {{-- Script untuk tambah/hapus NIM --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nimFields = document.getElementById('nim-fields');
            const addNimBtn = document.getElementById('add-nim');

            addNimBtn.addEventListener('click', function () {
                const wrapper = document.createElement('div');
                wrapper.classList.add('d-flex', 'mb-2', 'nim-group');

                wrapper.innerHTML = `
            <input type="text" name="nim[]" class="form-control me-2" placeholder="Masukkan NIM">
            <button type="button" class="btn btn-danger btn-remove-nim">Hapus</button>
        `;

                nimFields.appendChild(wrapper);
            });

            nimFields.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-remove-nim')) {
                    e.target.closest('.nim-group').remove();
                }
            });
        });
    </script>
@endsection
