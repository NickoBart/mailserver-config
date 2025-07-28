<x-app-layout>
  <x-slot name="header"><h2>Mis Buzones</h2></x-slot>

  <div class="mb-4">
    <a href="{{ route('mailboxes.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
      Nuevo Buzón
    </a>
  </div>

  <table class="min-w-full bg-white shadow rounded-lg">
    <thead class="bg-gray-800 text-white">
      <tr>
        <th class="px-4 py-2">Dirección</th>
        <th class="px-4 py-2">Dominio</th>
        <th class="px-4 py-2">Acciones</th>
      </tr>
    </thead>
    <tbody class="text-gray-700">
      @forelse($mailboxes as $mb)
      <tr>
        <td class="border px-4 py-2">{{ $mb->username }}</td>
        <td class="border px-4 py-2">{{ $mb->domain }}</td>
        <td class="border px-4 py-2 space-x-2">
          <a href="{{ route('mailboxes.edit', $mb->username) }}"
             class="text-blue-600">Editar</a>
          <form action="{{ route('mailboxes.destroy', $mb->username) }}"
                method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="submit"
                    onclick="return confirm('¿Eliminar buzón?')"
                    class="text-red-600">Eliminar</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="3" class="px-4 py-2">No hay buzones.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-4">{{ $mailboxes->links() }}</div>
</x-app-layout>
1~<x-app-layout>
  <x-slot name="header"><h2>Mis Buzones</h2></x-slot>

  <div class="mb-4">
    <a href="{{ route('mailboxes.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
      Nuevo Buzón
    </a>
  </div>

  <table class="min-w-full bg-white shadow rounded-lg">
    <thead class="bg-gray-800 text-white">
      <tr>
        <th class="px-4 py-2">Dirección</th>
        <th class="px-4 py-2">Dominio</th>
        <th class="px-4 py-2">Acciones</th>
      </tr>
    </thead>
    <tbody class="text-gray-700">
      @forelse($mailboxes as $mb)
      <tr>
        <td class="border px-4 py-2">{{ $mb->username }}</td>
        <td class="border px-4 py-2">{{ $mb->domain }}</td>
        <td class="border px-4 py-2 space-x-2">
          <a href="{{ route('mailboxes.edit', $mb->username) }}"
             class="text-blue-600">Editar</a>
          <form action="{{ route('mailboxes.destroy', $mb->username) }}"
                method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="submit"
                    onclick="return confirm('¿Eliminar buzón?')"
                    class="text-red-600">Eliminar</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="3" class="px-4 py-2">No hay buzones.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-4">{{ $mailboxes->links() }}</div>
</x-app-layout>
