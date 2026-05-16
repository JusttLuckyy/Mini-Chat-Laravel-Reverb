<nav x-data="{ open: false }" class="bg-white border-b border-gray-100" style="padding-left: 72px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ url('/dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
                <span class="ml-3 font-semibold text-gray-800 text-sm">
                    {{ config('app.name') }}
                </span>
            </div>

            {{-- Judul halaman aktif --}}
            <div class="flex items-center">
                <span class="text-sm text-gray-500">
                    {{ auth()->user()->name }}
                </span>
            </div>
        </div>
    </div>
</nav>