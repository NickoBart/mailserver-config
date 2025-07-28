<x-app-layout>
  <x-slot name="header"><h2>Editar Buzón</h2></x-slot>

  <div class="bg-white shadow rounded-lg p-6 text-gray-800">
    <form action="{{ route('mailboxes.update', $mb->username) }}"
          method="POST" class="space-y-4">
      @csrf @method('PUT')

      <div>
        <label class="block text-gray-700">Prefijo (antes de @)</label>
        <input type="text" name="local_part"
               value="{{ old('local_part', $local) }}"
               class="w-full border rounded p-2 bg-gray-50" readonly>
      </div>

      <div>
        <label class="block text-gray-700">Dominio</label>
        <select name="domain" class="w-full border rounded p-2 bg-gray-50" required>
          @foreach($domains as $domName)
            <option value="{{ $domName }}"
              @selected(old('domain', $dom)==$domName)>
              {{ $domName }}
            </option>
          @endforeach
        </select>
        @error('domain')
          <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-gray-700">Nueva Contraseña (opcional)</label>
        <input type="password" name="password"
               class="w-full border rounded p-2 bg-gray-50">
        @error('password')
          <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-gray-700">Cuota (MB)</label>
        <input type="number" name="quota"
               value="{{ old('quota', $mb->quota) }}"
               class="w-full border rounded p-2 bg-gray-50" required>
        @error('quota')
          <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Actualizar Buzón
      </button>
    </form>
  </div>
</x-app-layout>
