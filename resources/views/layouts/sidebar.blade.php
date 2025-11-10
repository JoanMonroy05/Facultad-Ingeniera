<aside class="w-64 bg-blue-700 text-white flex flex-col fixed top-0 left-0 h-screen z-20">
    {{-- Logo/Título --}}
    <div class="p-4 text-center text-xl font-bold border-b border-blue-600">
        <i class="fa-solid fa-graduation-cap mr-2"></i>
        Facultad Ingeniería
    </div>

    {{-- Navegación --}}
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">

        {{-- Dashboard - común para todos --}}
        <a href="{{ route('dashboard') }}"
            class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('dashboard') ? 'bg-blue-600' : '' }}">
            <i class="fa-solid fa-house mr-2"></i> Dashboard
        </a>

        {{-- Menú para ADMIN --}}
        @role('admin')
            <div class="pt-4 pb-2 text-xs font-semibold text-blue-300 uppercase">
                Administración
            </div>
            <a href="{{ route('estudiantes.index') }}"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('estudiantes.*') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-user-graduate mr-2"></i> Estudiantes
            </a>
            <a href="{{ route('docentes.index') }}"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('docentes.*') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-chalkboard-teacher mr-2"></i> Docentes
            </a>
            <a href="#"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('asignaturas.*') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-book mr-2"></i> Asignaturas
            </a>
            <a href="#"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('horarios.*') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-clock mr-2"></i> Horarios
            </a>
            <a href="#"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('reportes.*') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-chart-bar mr-2"></i> 
                Consultas
            </a>
        @endrole

        {{-- Menú para DOCENTE --}}
        @role('docente')
            <div class="pt-4 pb-2 text-xs font-semibold text-blue-300 uppercase">
                Mis Clases
            </div>
            <a href="#"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('docente.horarios') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-clock mr-2"></i> Mi Horario
            </a>
            <a href="#"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('docente.asignaturas') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-book mr-2"></i> Tomar Asistencia
            </a>
            <a href="#"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('docente.estudiantes') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-users mr-2"></i> Mis Estudiantes
            </a>
        @endrole

        {{-- Menú para ESTUDIANTE --}}
        @role('estudiante')
            <div class="pt-4 pb-2 text-xs font-semibold text-blue-300 uppercase">
                Mi Academia
            </div>
            <a href="#"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('estudiante.horario') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-calendar mr-2"></i> Mi Horario
            </a>
            <a href="#"
                class="block px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('estudiante.calificaciones') ? 'bg-blue-600' : '' }}">
                <i class="fa-solid fa-star mr-2"></i> Calificaciones
            </a>
        @endrole

    </nav>

    {{-- Info usuario en sidebar (opcional) --}}
    <div class="p-4 border-t border-blue-600">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                <p class="text-xs text-blue-300">
                    {{ Auth::user()->getRoleNames()->first() ?? 'Usuario' }}
                </p>
            </div>
        </div>
    </div>
</aside>
