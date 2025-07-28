<x-app-layout>
  <x-slot name="header"><h2>Nuevo Buzón</h2></x-slot>

  <div class="bg-white shadow rounded-lg p-6 text-gray-800">
    <form action="{{ route('mailboxes.store') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block text-gray-700">Prefijo (antes de @)</label>
        <input type="text" name="local_part" value="{{ old('local_part') }}"
               class="w-full border rounded p-2 bg-gray-50" required>
        @error('local_part')
          <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-gray-700">Dominio</label>
        <select name="domain" class="w-full border rounded p-2 bg-gray-50" required>
          <option value="">Selecciona dominio</option>
          @foreach($domains as $dom)
            <option value="{{ $dom }}" @selected(old('domain')==$dom)>
              {{ $dom }}
            </option>
          @endforeach
        </select>
        @error('domain')
          <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-gray-700">Contraseña</label>
        <input type="password" name="password"
               class="w-full border rounded p-2 bg-gray-50" required>
        @error('password')
          <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-gray-700">Cuota (MB)</label>
        <input type="number" name="quota" value="{{ old('quota',1024) }}"
               class="w-full border rounded p-2 bg-gray-50" required>
        @error('quota')
          <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded mt-4">
        Crear Buzón
      </button>
    </form>
  </div>
</x-app-layout>
