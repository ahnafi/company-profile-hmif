@extends('financeLayout.finance')

@section('title', 'Kas HMIF')
@section('content')
    <div class="container mx-auto px-4 py-6 lg:py-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Kas HMIF</h1>
            <p class="text-gray-600 text-sm md:text-base">Data pembayaran kas pengurus HMIF per bulan</p>
        </div>

        <!-- Desktop Table View (hidden on mobile) -->
        <div class="hidden lg:block bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">April</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">Mei</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">Juni</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">Juli</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">Agustus</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">September</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">Oktober</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">November</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($cashs as $cash)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $cash->administrator->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $cash->administrator->division->name }}</div>
                                </td>
                                <td class="px-4 py-3 text-right text-sm text-gray-700">Rp {{ number_format($cash->april ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-700">Rp {{ number_format($cash->may ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-700">Rp {{ number_format($cash->june ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-700">Rp {{ number_format($cash->july ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-700">Rp {{ number_format($cash->august ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-700">Rp {{ number_format($cash->september ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-700">Rp {{ number_format($cash->october ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-sm text-gray-700">Rp {{ number_format($cash->november ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tablet Horizontal Scroll View (hidden on mobile and desktop) -->
        <div class="hidden md:block lg:hidden bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-semibold sticky left-0 bg-red-600 z-10">Nama</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold whitespace-nowrap">April</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold whitespace-nowrap">Mei</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold whitespace-nowrap">Juni</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold whitespace-nowrap">Juli</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold whitespace-nowrap">Agustus</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold whitespace-nowrap">September</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold whitespace-nowrap">Oktober</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold whitespace-nowrap">November</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($cashs as $cash)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2 sticky left-0 bg-white">
                                    <div class="text-xs font-medium text-gray-900">{{ $cash->administrator->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $cash->administrator->division->name }}</div>
                                </td>
                                <td class="px-3 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($cash->april ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($cash->may ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($cash->june ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($cash->july ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($cash->august ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($cash->september ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($cash->october ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($cash->november ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-xs text-gray-600 text-center">
                <p>← Geser untuk melihat data selengkapnya →</p>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach ($cashs as $cash)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-red-600 px-4 py-3">
                        <h3 class="text-white font-semibold text-base">{{ $cash->administrator->name }}</h3>
                        <p class="text-red-100 text-sm">{{ $cash->administrator->division->name }}</p>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="px-4 py-3 space-y-2">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">April</span>
                            <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($cash->april ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Mei</span>
                            <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($cash->may ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Juni</span>
                            <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($cash->june ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Juli</span>
                            <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($cash->july ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Agustus</span>
                            <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($cash->august ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">September</span>
                            <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($cash->september ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Oktober</span>
                            <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($cash->october ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm font-medium text-gray-600">November</span>
                            <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($cash->november ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($cashs->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                <p class="mt-1 text-sm text-gray-500">Data kas belum tersedia.</p>
            </div>
        @endif
    </div>

@endsection
