@extends('financeLayout.finance')

@section('title', 'Deposit Pengurus HMIF')
@section('content')
    <div class="container mx-auto px-4 py-6 lg:py-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Deposit HMIF</h1>
            <p class="text-gray-600 text-sm md:text-base">Data deposit dan denda pengurus HMIF</p>
        </div>

        <!-- Desktop Table View (hidden on mobile and tablet) -->
        <div class="hidden lg:block bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th rowspan="2" class="px-4 py-3 text-left text-sm font-semibold border-r border-red-500">Nama</th>
                            <th rowspan="2" class="px-4 py-3 text-right text-sm font-semibold border-r border-red-500">Sisa Deposit</th>
                            <th colspan="6" class="px-4 py-2 text-center text-sm font-semibold border-b border-red-500">Denda</th>
                        </tr>
                        <tr>
                            <th class="px-3 py-2 text-right text-xs font-semibold border-r border-red-500">Rapat Pleno</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold border-r border-red-500">Jahim Day</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold border-r border-red-500">Wisuda</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold border-r border-red-500">Piket Pesek</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold border-r border-red-500">Proker</th>
                            <th class="px-3 py-2 text-right text-xs font-semibold">Lainnya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($deposits as $deposit)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-3 border-r border-gray-200">
                                    <div class="text-sm font-medium text-gray-900">{{ $deposit->administrator->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $deposit->administrator->division->name }}</div>
                                </td>
                                <td class="px-4 py-3 text-right text-sm font-bold text-green-600 border-r border-gray-200">
                                    Rp {{ number_format($deposit->deposit ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-3 py-3 text-right text-sm text-gray-700 border-r border-gray-100">Rp {{ number_format($deposit->getPlenaryMeetingAttribute() ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-3 text-right text-sm text-gray-700 border-r border-gray-100">Rp {{ number_format($deposit->getPenaltyAmountByDetail('jahim_day') ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-3 text-right text-sm text-gray-700 border-r border-gray-100">Rp {{ number_format($deposit->getPenaltyAmountByDetail('wisuda') ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-3 text-right text-sm text-gray-700 border-r border-gray-100">Rp {{ number_format($deposit->getPenaltyAmountByDetail('piket_pesek') ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-3 text-right text-sm text-gray-700 border-r border-gray-100">Rp {{ number_format($deposit->getPenaltyAmountByDetail('proker') ?? 0, 0, ',', '.') }}</td>
                                <td class="px-3 py-3 text-right text-sm text-gray-700">Rp {{ number_format($deposit->getPenaltyAmountByDetail('lainnya') ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tablet Horizontal Scroll View (hidden on mobile and desktop) -->
        <div class="hidden md:block lg:hidden bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-auto text-sm">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th rowspan="2" class="px-3 py-2 text-left text-xs font-semibold sticky left-0 bg-red-600 z-10">Nama</th>
                            <th rowspan="2" class="px-3 py-2 text-right text-xs font-semibold whitespace-nowrap">Sisa Deposit</th>
                            <th colspan="6" class="px-3 py-2 text-center text-xs font-semibold">Denda</th>
                        </tr>
                        <tr>
                            <th class="px-2 py-2 text-right text-xs font-semibold whitespace-nowrap">R. Pleno</th>
                            <th class="px-2 py-2 text-right text-xs font-semibold whitespace-nowrap">Jahim Day</th>
                            <th class="px-2 py-2 text-right text-xs font-semibold whitespace-nowrap">Wisuda</th>
                            <th class="px-2 py-2 text-right text-xs font-semibold whitespace-nowrap">Piket</th>
                            <th class="px-2 py-2 text-right text-xs font-semibold whitespace-nowrap">Proker</th>
                            <th class="px-2 py-2 text-right text-xs font-semibold whitespace-nowrap">Lainnya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($deposits as $deposit)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2 sticky left-0 bg-white z-10">
                                    <div class="text-xs font-medium text-gray-900">{{ $deposit->administrator->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $deposit->administrator->division->name }}</div>
                                </td>
                                <td class="px-3 py-2 text-right text-xs font-bold text-green-600 whitespace-nowrap">Rp {{ number_format($deposit->deposit ?? 0, 0, ',', '.') }}</td>
                                <td class="px-2 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($deposit->getPlenaryMeetingAttribute() ?? 0, 0, ',', '.') }}</td>
                                <td class="px-2 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($deposit->getPenaltyAmountByDetail('jahim_day') ?? 0, 0, ',', '.') }}</td>
                                <td class="px-2 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($deposit->getPenaltyAmountByDetail('wisuda') ?? 0, 0, ',', '.') }}</td>
                                <td class="px-2 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($deposit->getPenaltyAmountByDetail('piket_pesek') ?? 0, 0, ',', '.') }}</td>
                                <td class="px-2 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($deposit->getPenaltyAmountByDetail('proker') ?? 0, 0, ',', '.') }}</td>
                                <td class="px-2 py-2 text-right text-xs text-gray-700 whitespace-nowrap">Rp {{ number_format($deposit->getPenaltyAmountByDetail('lainnya') ?? 0, 0, ',', '.') }}</td>
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
            @foreach ($deposits as $deposit)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-red-600 px-4 py-3">
                        <h3 class="text-white font-semibold text-base">{{ $deposit->administrator->name }}</h3>
                        <p class="text-red-100 text-sm">{{ $deposit->administrator->division->name }}</p>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="px-4 py-3">
                        <!-- Sisa Deposit -->
                        <div class="mb-4 p-3 bg-green-50 rounded-lg border border-green-200">
                            <p class="text-xs text-green-700 mb-1">Sisa Deposit</p>
                            <p class="text-xl font-bold text-green-700">Rp {{ number_format($deposit->deposit ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <!-- Denda Section -->
                        <div class="space-y-2">
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Rincian Denda</h4>
                            
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-xs text-gray-600">Rapat Pleno</span>
                                <span class="text-sm font-semibold text-red-600">Rp {{ number_format($deposit->getPlenaryMeetingAttribute() ?? 0, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-xs text-gray-600">Jahim Day</span>
                                <span class="text-sm font-semibold text-red-600">Rp {{ number_format($deposit->getPenaltyAmountByDetail('jahim_day') ?? 0, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-xs text-gray-600">Wisuda</span>
                                <span class="text-sm font-semibold text-red-600">Rp {{ number_format($deposit->getPenaltyAmountByDetail('wisuda') ?? 0, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-xs text-gray-600">Piket Pesek</span>
                                <span class="text-sm font-semibold text-red-600">Rp {{ number_format($deposit->getPenaltyAmountByDetail('piket_pesek') ?? 0, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-xs text-gray-600">Proker</span>
                                <span class="text-sm font-semibold text-red-600">Rp {{ number_format($deposit->getPenaltyAmountByDetail('proker') ?? 0, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2">
                                <span class="text-xs text-gray-600">Lainnya</span>
                                <span class="text-sm font-semibold text-red-600">Rp {{ number_format($deposit->getPenaltyAmountByDetail('lainnya') ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Total Denda -->
                        @php
                            $totalPenalty = 
                                ($deposit->getPlenaryMeetingAttribute() ?? 0) +
                                ($deposit->getPenaltyAmountByDetail('jahim_day') ?? 0) +
                                ($deposit->getPenaltyAmountByDetail('wisuda') ?? 0) +
                                ($deposit->getPenaltyAmountByDetail('piket_pesek') ?? 0) +
                                ($deposit->getPenaltyAmountByDetail('proker') ?? 0) +
                                ($deposit->getPenaltyAmountByDetail('lainnya') ?? 0);
                        @endphp
                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-700">Total Denda</span>
                                <span class="text-base font-bold text-red-600">Rp {{ number_format($totalPenalty, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($deposits->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                <p class="mt-1 text-sm text-gray-500">Data deposit belum tersedia.</p>
            </div>
        @endif
    </div>

@endsection
