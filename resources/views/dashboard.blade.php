<x-app-layout>
    <x-slot name="header">
        Panel de Control
    </x-slot>

    <div class="space-y-6">
        {{-- Mensaje de bienvenida --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800">
                ¡Bienvenido, {{ Auth::user()->getNombreCompletoAttribute() }}!
            </h2>
            <p class="text-gray-600 mt-2">
                Rol actual: <span class="font-semibold text-blue-600">
                    {{ Auth::user()->getRoleNames()->first() ?? 'Usuario' }}
                </span>
            </p>
        </div>

        {{-- Widgets específicos por rol --}}
        {{-- @role('admin')
            <x-dashboard.admin-widgets :totalUsers="$totalUsers ?? 0" :totalEstudiantes="$totalEstudiantes ?? 0" :totalDocentes="$totalDocentes ?? 0" :totalAsignaturas="$totalAsignaturas ?? 0" />
        @endrole

        @role('docente')
            <x-dashboard.docente-widgets :asignaturas="$misAsignaturas ?? collect()" :proximasClases="$proximasClases ?? collect()" />
        @endrole

        @role('estudiante')
            <x-dashboard.estudiante-widgets :horarioHoy="$horarioHoy ?? collect()" :asignaturasInscritas="$asignaturasInscritas ?? collect()" />
        @endrole --}}
    </div>
</x-app-layout>
