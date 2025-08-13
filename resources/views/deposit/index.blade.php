@extends('financeLayout.finance')

@section('title', 'Deposit Pengurus HMIF')
@section('content')

    <h1 class="text-red-500">Deposit HMIF</h1>

    <table class="table-auto border-collapse border border-gray-300">
        <thead>
        <tr>
            <th rowspan="2" class="border border-gray-300 px-4 py-2">Nama</th>
            <th rowspan="2" class="border border-gray-300 px-4 py-2">Sisa Deposit</th>
            <th colspan="7" class="px-4 py-2">Denda</th>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">Rapat Pleno</th>
            <th class="border border-gray-300 px-4 py-2">Jahim Day</th>
            <th class="border border-gray-300 px-4 py-2">Wisuda</th>
            <th class="border border-gray-300 px-4 py-2">Piket Pesek</th>
            <th class="border border-gray-300 px-4 py-2">Proker</th>
            <th class="border border-gray-300 px-4 py-2">Lainnya</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($deposits as $deposit)
            <tr>
                <td class="border border-gray-300 px-4 py-2">
                    {{ $deposit->administrator->name }} <br>
                    {{ $deposit->administrator->division->name }}
                </td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($deposit->deposit ?? 0, 0, ',', '.') }}
                </td>
                <td class="border border-gray-300 px-4 py-2">Rp
                    {{ number_format($deposit->getPlenaryMeetingAttribute() ?? 0, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp
                    {{ number_format($deposit->getPenaltyAmountByDetail('jahim_day') ?? 0, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp
                    {{ number_format($deposit->getPenaltyAmountByDetail('wisuda') ?? 0, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp
                    {{ number_format($deposit->getPenaltyAmountByDetail('piket_pesek') ?? 0, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp
                    {{ number_format($deposit->getPenaltyAmountByDetail('proker') ?? 0, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp
                    {{ number_format($deposit->getPenaltyAmountByDetail('lainnya') ?? 0, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
