<nav class="bg-white border-b px-4 py-2 flex items-center justify-between">
    <div class="text-lg font-semibold">Keuangan HMIF</div>
    <button class="md:hidden block text-gray-700" onclick="document.getElementById('nav-menu').classList.toggle('hidden')">
        &#9776;
    </button>
    <ul id="nav-menu" class="md:flex space-x-4 hidden md:block">
        <li><a href="{{ route('cash.index') }}" class="hover:text-blue-600">Kas</a></li>
        <li><a href="{{ route('cash.history') }}" class="hover:text-blue-600">Riwayat Kas</a></li>
        <li><a href="{{ route('deposit.index') }}" class="hover:text-blue-600">Deposit</a></li>
        <li><a href="{{ route('deposit.history') }}" class="hover:text-blue-600">Riwayat Deposit</a></li>
        <li><a href="{{ route('filament.finance.auth.login') }}" class="hover:text-blue-600">Bendahara</a></li>
        <li><a href="{{ route('filament.iltekFinance.auth.login') }}" class="hover:text-blue-600">Kas Iltek</a></li>
        <li><a href="{{ route('filament.kreusFinance.auth.login') }}" class="hover:text-blue-600">Kas Kreus</a></li>
        <li><a href="{{ route('filament.mikatFinance.auth.login') }}" class="hover:text-blue-600">Kas Mikat</a></li>
    </ul>
</nav>
