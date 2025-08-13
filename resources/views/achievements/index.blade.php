@extends('layout.companyProfile')

@section('title', 'IF Bangga')

@section('content')
    <div class="container my-5">

        {{-- Filter Form --}}
        <form method="GET" action="{{ url('/if-bangga') }}" class="mb-4 border p-3 rounded">
            <div class="row g-3">
                {{-- Achievement Type --}}
                <div class="col-md-2">
                    <label class="form-label">Tipe</label>
                    <select name="type_id" class="form-select">
                        <option value="">-- Semua --</option>
                        @foreach ($filters['types'] as $type)
                            <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Achievement Category --}}
                <div class="col-md-2">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">-- Semua --</option>
                        @foreach ($filters['categories'] as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Achievement Level --}}
                <div class="col-md-2">
                    <label class="form-label">Tingkat</label>
                    <select name="level_id" class="form-select">
                        <option value="">-- Semua --</option>
                        @foreach ($filters['levels'] as $level)
                            <option value="{{ $level->id }}" {{ request('level_id') == $level->id ? 'selected' : '' }}>
                                {{ $level->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Study Program --}}
                <div class="col-md-2">
                    <label class="form-label">Prodi</label>
                    <select name="study_program" class="form-select">
                        <option value="">-- Semua --</option>
                        <option value="informatics" {{ request('study_program') == 'informatics' ? 'selected' : '' }}>
                            Informatika
                        </option>
                        <option value="computer_engineering" {{ request('study_program') == 'computer_engineering' ? 'selected' : '' }}>
                            Teknik Komputer
                        </option>
                    </select>
                </div>


                {{-- Batch Year --}}
                <div class="col-md-2">
                    <label class="form-label">Angkatan</label>
                    <select name="batch_year" class="form-select">
                        <option value="">-- Semua --</option>
                        @foreach ($filters['batchYears'] as $year)
                            <option value="{{ $year }}" {{ request('batch_year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Student Name --}}
                <div class="col-md-2">
                    <label class="form-label">Nama</label>
                    <input type="text" name="student_name" value="{{ request('student_name') }}" class="form-control">
                </div>

                {{-- NIM --}}
                <div class="col-md-2">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" value="{{ request('nim') }}" class="form-control">
                </div>

                {{-- Submit --}}
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        {{-- Achievement List --}}
        <h3 class="mb-3">Daftar Prestasi</h3>
        <div class="row g-3">
            @forelse ($achievements as $achievement)
                <div class="col-md-4">
                    <div class="card h-100">
                        @if ($achievement['image'])
                            <img src="/storage/{{ $achievement['image'] }}" class="card-img-top" alt="Achievement Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $achievement['name'] }}</h5>
                            <p class="card-text">{{ $achievement['description'] }}</p>
                            <p class="mb-1"><strong>Tipe:</strong> {{ $achievement['type_name'] }}</p>
                            <p class="mb-1"><strong>Kategori:</strong> {{ $achievement['category_name'] }}</p>
                            <p class="mb-1"><strong>Tingkat:</strong> {{ $achievement['level_name'] }}</p>
                            <p class="mb-1"><strong>Diberikan:</strong> {{ \Carbon\Carbon::parse($achievement['awarded_at'])->format('d M Y') }}</p>

                            <h6 class="mt-3">Mahasiswa</h6>
                            <ul class="list-unstyled">
                                @foreach ($achievement['students'] as $student)
                                    <li>{{ $student['student_name'] }} ({{ $student['nim'] }}) - {{ $student['study_program'] == 'informatics' ? 'Informatika' : 'Teknik Komputer' }} / {{ $student['batch_year'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada data prestasi.</p>
            @endforelse
        </div>

        {{-- Leaderboard --}}
        <h3 class="mt-5 mb-3">Leaderboard Mahasiswa</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Peringkat</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Prodi</th>
                <th>Angkatan</th>
                <th>Jumlah Prestasi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($leaderboard as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->nim }}</td>
                    <td>{{ $student->study_program == 'informatics' ? 'Informatika' : 'Teknik Komputer' }}</td>
                    <td>{{ $student->batch_year }}</td>
                    <td>{{ $student->achievements_count }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
