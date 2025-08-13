@extends('financeLayout.finance')

@section('title', 'Kas HMIF')
@section('content')
    <h1 class="text-red-500">Kas HMIF</h1>

    <table class="table-auto border-collapse border border-gray-300">
        <thead>
        <tr>
            <th class="border border-gray-300 px-4 py-2">Nama</th>
            <th class="border border-gray-300 px-4 py-2">April</th>
            <th class="border border-gray-300 px-4 py-2">Mei</th>
            <th class="border border-gray-300 px-4 py-2">Juni</th>
            <th class="border border-gray-300 px-4 py-2">Juli</th>
            <th class="border border-gray-300 px-4 py-2">Agustus</th>
            <th class="border border-gray-300 px-4 py-2">September</th>
            <th class="border border-gray-300 px-4 py-2">Oktober</th>
            <th class="border border-gray-300 px-4 py-2">November</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cashs as $cash)
            <tr>
                <td class="border border-gray-300 px-4 py-2">
                    {{ $cash->administrator->name }} <br>
                    {{ $cash->administrator->division->name }}
                </td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($cash->april ?? 0, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($cash->may ?? 0, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($cash->june ?? 0, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($cash->july ?? 0, 0, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($cash->august ?? 0, 0, ',', '.') }}
                </td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($cash->september ?? 0, 0, ',', '.') }}
                </td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($cash->october ?? 0, 0, ',', '.') }}
                </td>
                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($cash->november ?? 0, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
