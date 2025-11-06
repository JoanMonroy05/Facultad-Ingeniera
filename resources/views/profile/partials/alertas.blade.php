{{-- Errores --}}
@if ($errors->any() || session('error'))
    @foreach ($errors->all() as $error)
        <div class="alert px-4 py-3 rounded relative mb-4 bg-red-100 border border-red-400 text-red-700">
            {{ $error }}
        </div>
    @endforeach
@endif

{{-- Éxito --}}
@if (session('success'))
    <div class="alert px-4 py-3 rounded relative mb-4 bg-green-100 border border-green-400 text-green-700">
        {{ session('success') }}
    </div>
@endif

{{-- Mensajes generales --}}
@if (session('info'))
    <div class="alert px-4 py-3 rounded relative mb-4 bg-blue-100 border border-blue-400 text-blue-700">
        {{ session('info') }}
    </div>
@endif
{{-- Tailwind styles para las alertas --}}
@if (session('warning'))
    <div class="alert px-4 py-3 rounded relative mb-4 bg-yellow-100 border border-yellow-400 text-yellow-700">
        {{ session('warning') }}
    </div>
@endif
