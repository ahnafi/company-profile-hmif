<x-filament-panels::page>
    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Rekapitulasi Keuangan</h2>
                <p class="text-gray-600 text-sm mb-4">
                    Ringkasan saldo untuk setiap dana berdasarkan transaksi pemasukan dan pengeluaran
                </p>
                
                <div class="space-y-4">
                    @foreach ($this->getHeaderWidgets() as $widget)
                        @livewire($widget)
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Additional Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-green-900">Total Pemasukan</h3>
                        <p class="text-2xl font-bold text-green-600">
                            Rp {{ number_format(\App\Models\Transaction::where('type', 'income')->sum('amount'), 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-red-900">Total Pengeluaran</h3>
                        <p class="text-2xl font-bold text-red-600">
                            Rp {{ number_format(\App\Models\Transaction::where('type', 'expense')->sum('amount'), 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-blue-900">Saldo Bersih</h3>
                        @php
                            $income = \App\Models\Transaction::where('type', 'income')->sum('amount');
                            $expense = \App\Models\Transaction::where('type', 'expense')->sum('amount');
                            $balance = $income - $expense;
                        @endphp
                        <p class="text-2xl font-bold {{ $balance >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            Rp {{ number_format($balance, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
