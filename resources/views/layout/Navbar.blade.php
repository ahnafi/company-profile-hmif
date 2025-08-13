<nav class="bg-white border-b px-4 py-2 flex items-center justify-between">
    <div class="text-lg font-semibold">HMIF Company Profile</div>
    <button class="md:hidden block text-gray-700" onclick="document.getElementById('nav-menu').classList.toggle('hidden')">
        &#9776;
    </button>
    <ul id="nav-menu" class="md:flex space-x-4 hidden md:block">
        <li><a href="{{ route('student.achievements.index') }}" class="hover:text-blue-600">IF Bangga</a></li>
    </ul>
</nav>
