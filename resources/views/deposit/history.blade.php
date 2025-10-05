@extends('financeLayout.finance')

@section('title', 'Riwayat deposit pengurus HMIF')
@section('content')
    <div class="container mx-auto px-4 py-6 lg:py-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Riwayat Deposit HMIF</h1>
            <p class="text-gray-600 text-sm md:text-base">Riwayat transaksi deposit dan denda pengurus HMIF</p>
        </div>

        <!-- Histori Deposit Section -->
        <div class="mb-8">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Histori Deposit
            </h2>

            <!-- Desktop Table View -->
            <div class="hidden md:block bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-green-600 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Dana</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($histories as $history)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $history->deposit->administrator->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $history->deposit->administrator->division->name }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $history->fund->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($history->date)->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-right text-sm font-semibold text-green-600">Rp {{ number_format($history->amount, 0, ',', '.') }}</td>
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
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-green-600">
                        <!-- Card Header -->
                        <div class="bg-green-50 px-4 py-3 border-b border-green-100">
                            <h3 class="text-gray-800 font-semibold text-base">{{ $history->deposit->administrator->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $history->deposit->administrator->division->name }}</p>
                        </div>
                        
                        <!-- Card Body -->
                        <div class="px-4 py-3 space-y-2">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Dana</span>
                                <span class="text-sm font-medium text-gray-900">{{ $history->fund->name }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Tanggal</span>
                                <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($history->date)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-sm font-semibold text-gray-700">Jumlah</span>
                                <span class="text-base font-bold text-green-600">Rp {{ number_format($history->amount, 0, ',', '.') }}</span>
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
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada riwayat deposit</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada transaksi deposit yang tercatat.</p>
                </div>
            @endif
        </div>

        <!-- Histori Denda Section -->
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                Histori Denda
            </h2>

            <!-- Desktop Table View -->
            <div class="hidden md:block bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-red-600 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-right text-sm font-semibold">Jumlah</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($penaltyHistories as $history)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $history->deposit->administrator->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $history->deposit->administrator->division->name }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ \Carbon\Carbon::parse($history->date)->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-right text-sm font-semibold text-red-600">Rp {{ number_format($history->amount, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $history->getDetailDescriptionAttribute() }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                    {{ $penaltyHistories->links() }}
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @foreach ($penaltyHistories as $history)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-red-600">
                        <!-- Card Header -->
                        <div class="bg-red-50 px-4 py-3 border-b border-red-100">
                            <h3 class="text-gray-800 font-semibold text-base">{{ $history->deposit->administrator->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $history->deposit->administrator->division->name }}</p>
                        </div>
                        
                        <!-- Card Body -->
                        <div class="px-4 py-3 space-y-2">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Tanggal</span>
                                <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($history->date)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600">Detail</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ $history->getDetailDescriptionAttribute() }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-sm font-semibold text-gray-700">Jumlah Denda</span>
                                <span class="text-base font-bold text-red-600">Rp {{ number_format($history->amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Mobile Pagination -->
                <div class="mt-6">
                    {{ $penaltyHistories->links() }}
                </div>
            </div>

            @if($penaltyHistories->isEmpty())
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada riwayat denda</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada denda yang tercatat.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
