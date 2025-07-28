<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Mis Dominios</h2>
  </x-slot>

  <div class="mb-4">
    <a href="{{ route('domains.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Dominio</a>
  </div>

  @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <table class="min-w-full bg-white shadow rounded">
    <thead>
      <tr>
        <th class="px-4 py-2">Dominio</th>
        <th class="px-4 py-2">Verificado</th>
        <th class="px-4 py-2">MX</th>
        <th class="px-4 py-2">SPF</th>
        <th class="px-4 py-2">DKIM</th>
        <th class="px-4 py-2">DMARC</th>
        <th class="px-4 py-2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($domains as $d)
        <tr>
          <!-- Dominio -->
          <td class="border px-4 py-2">{{ $d->domain }}</td>

          <!-- Verificado -->
          <td class="border px-4 py-2">
            @if($d->verified)
              <span class="text-green-600">Sí</span>
            @else
              <span class="text-red-600">No</span>
            @endif
          </td>

          <!-- MX -->
          <td class="border px-4 py-2 text-center" title="{{ $d->mx_message }}">
            @if($d->mx_valid)
              <span class="text-green-600">✓</span>
            @else
              <span class="text-red-600">✕</span>
            @endif
          </td>

          <!-- SPF -->
          <td class="border px-4 py-2 text-center" title="{{ $d->spf_message }}">
            @if($d->spf_valid)
              <span class="text-green-600">✓</span>
            @else
              <span class="text-red-600">✕</span>
            @endif
          </td>

          <!-- DKIM -->
          <td class="border px-4 py-2 text-center" title="{{ $d->dkim_message }}">
            @if($d->dkim_valid)
              <span class="text-green-600">✓</span>
            @else
              <span class="text-red-600">✕</span>
            @endif
          </td>

          <!-- DMARC -->
          <td class="border px-4 py-2 text-center" title="{{ $d->dmarc_message }}">
            @if($d->dmarc_valid)
              <span class="text-green-600">✓</span>
            @else
              <span class="text-red-600">✕</span>
            @endif
          </td>

          <!-- Acciones -->
          <td class="border px-4 py-2 space-x-2">
            <!-- Editar -->
            <a href="{{ route('domains.edit', $d) }}"
               class="text-blue-600">Editar</a>

            <!-- Eliminar -->
            <form action="{{ route('domains.destroy', $d) }}"
                  method="POST"
                  class="inline">
              @csrf
              @method('DELETE')
              <button type="submit"
                      onclick="return confirm('¿Eliminar dominio?')"
                      class="text-red-600">Eliminar</button>
            </form>

            <!-- Actualizar DNS -->
            <form action="{{ route('domains.revalidate', $d) }}"
                  method="POST"
                  class="inline">
              @csrf
              <button type="submit"
                      class="text-gray-600">Actualizar DNS</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="px-4 py-2 text-center">
            No tienes dominios aún.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-4">{{ $domains->links() }}</div>
</x-app-layout>
