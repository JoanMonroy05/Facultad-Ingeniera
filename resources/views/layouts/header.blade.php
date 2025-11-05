<header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="px-6 py-4 flex justify-between items-center">
        {{-- Título de la página --}}
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                @isset($header)
                    {{ $header }}
                @else
                    Dashboard
                @endisset
            </h1>
            <p class="text-sm text-gray-500">
                {{ now()->locale('es')->translatedFormat('l, d \de F \de Y') }}
            </p>
        </div>

        {{-- Menú de perfil --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-user"></i>
                </div>
                <i class="fa-solid fa-chevron-down text-gray-400 text-sm"></i>
            </button>

            {{-- Dropdown --}}
            <div x-show="open" @click.away="open = false" x-transition
                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">

                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fa-solid fa-user-pen mr-2"></i> Mi Perfil
                </a>

                <hr class="my-2">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
