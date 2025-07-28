<x-app-layout>
  <x-slot name="header"><h2>Editar Dominio</h2></x-slot>

  <form action="{{ route('domains.update', $domain) }}" method="POST" class="space-y-4">
    @csrf @method('PUT')

    <div>
      <label class="block">Dominio</label>
      <input type="text" name="domain" value="{{ old('domain', $domain->domain) }}"
             class="w-full border rounded p-2" required>
      @error('domain')
        <p class="text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
      Actualizar
    </button>
  </form>
</x-app-layout>
