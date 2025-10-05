@extends('financeLayout.finance')

@section('title', 'Riwayat Kas HMIF')
@section('content')
    <div class="container mx-auto px-4 py-6 lg:py-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Riwayat Kas HMIF</h1>
            <p class="text-gray-600 text-sm md:text-base">Riwayat transaksi pembayaran kas pengurus HMIF</p>
        </div>

        <!-- Desktop Table View (hidden on mobile) -->
        <div class="hidden md:block bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Dana</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Bulan</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">Jumlah</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">Denda</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($histories as $history)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $history->cash->administrator->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $history->cash->administrator->division->name }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $history->fund->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($history->date)->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $history->month }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right text-sm font-semibold text-green-600">Rp {{ number_format($history->amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right text-sm font-semibold text-red-600">Rp {{ number_format($history->penalty, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $histories->links() }}
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach ($histories as $history)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-red-600 px-4 py-3">
                        <h3 class="text-white font-semibold text-base">{{ $history->cash->administrator->name }}</h3>
                        <p class="text-red-100 text-sm">{{ $history->cash->administrator->division->name }}</p>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="px-4 py-3 space-y-3">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Dana</p>
                                <p class="text-sm font-medium text-gray-900">{{ $history->fund->name }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $history->month }}
                            </span>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-3">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs text-gray-500">Tanggal Pembayaran</span>
                                <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($history->date)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs text-gray-500">Jumlah Bayar</span>
                                <span class="text-sm font-semibold text-green-600">Rp {{ number_format($history->amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">Denda</span>
                                <span class="text-sm font-semibold text-red-600">Rp {{ number_format($history->penalty, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <!-- Total -->
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-700">Total</span>
                                <span class="text-base font-bold text-gray-900">Rp {{ number_format($history->amount + $history->penalty, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Mobile Pagination -->
            <div class="mt-6">
                {{ $histories->links() }}
            </div>
        </div>

        @if($histories->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada riwayat</h3>
                <p class="mt-1 text-sm text-gray-500">Belum ada transaksi kas yang tercatat.</p>
            </div>
        @endif
    </div>

@endsection
