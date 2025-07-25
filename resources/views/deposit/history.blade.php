<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', "resources/js/app.tsx"])
</head>

<body>
    <h1 class="text-red-500">Kas HMIF</h1>
    <a href="{{ route('cash.index') }}">Kas</a>

    <h2>tabel histori deposit</h2>
    <table class="table-auto border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Nama</th>
                <th class="border border-gray-300 px-4 py-2">Dana</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                <th class="border border-gray-300 px-4 py-2">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $history->deposit->administrator->name }} <br>
                        {{ $history->deposit->administrator->division->name }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $history->fund->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ \Carbon\Carbon::parse($history->date)->format('d-m-Y') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($history->amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $histories->links() }}


    <h2>tabel histori denda</h2>
    <table class="table-auto border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Nama</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                <th class="border border-gray-300 px-4 py-2">Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penaltyHistories as $history)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $history->deposit->administrator->name }} <br>
                        {{ $history->deposit->administrator->division->name }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ \Carbon\Carbon::parse($history->date)->format('d-m-Y') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($history->amount, 0, ',', '.') }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $history->getDetailDescriptionAttribute() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $penaltyHistories->links() }}

</body>

</html>