<x-app-layout>
  <x-slot name="header"><h2>Agregar Dominio</h2></x-slot>

  {{-- Card contenedor para mejor contraste --}}
  <div class="bg-white shadow rounded-lg p-6 text-gray-800">

    {{-- Instrucciones DNS --}}
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
      <p class="font-bold">¡Atención!</p>
      <p>Para que tus buzones funcionen en <code>@sudominio</code>, debes agregar:</p>
      <ul class="list-disc list-inside mb-2">
        <li><strong>A Record:</strong> Host <code>mail</code> → apunta a <em>IP de nuestro servidor</em></li>
        <li><strong>MX Record:</strong> Host <code>@</code> → apunta a <code>mail.sudominio</code>, prioridad <code>10</code></li>
        <li><strong>SPF (TXT):</strong> <code>v=spf1 a mx ~all</code></li>
      </ul>
      <p>Si compras también tu dominio con nosotros, configuraremos esto automáticamente.</p>
    </div>

    {{-- Formulario --}}
    <form action="{{ route('domains.store') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block text-gray-700">Dominio (sin esquema)</label>
        <input type="text" name="domain" value="{{ old('domain') }}"
              class="w-full border rounded p-2 bg-gray-50" required>
        @error('domain')
          <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>
      <button type="submit"
              class="bg-blue-800 hover:bg-blue-900 text-black px-4 py-2 rounded shadow">
        Guardar
      </button>
    </form>
  </div>
</x-app-layout>
