<x-guest-layout>
  @section('title', 'Solicitar Servicio')
  <x-slot name="slot">
    <section class="py-16">
      <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-bold mb-4">Solicita tu servicio</h1>
        <form action="{{ route('subscribe.store') }}" method="POST" class="space-y-4">
          @csrf
          <input name="name" type="text" placeholder="Tu nombre" class="w-full border rounded p-2" required>
          <input name="email" type="email" placeholder="Tu correo" class="w-full border rounded p-2" required>
          <input name="domain" type="text" placeholder="Tu dominio" class="w-full border rounded p-2" required>
          <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Enviar solicitud</button>
        </form>
      </div>
    </section>
  </x-slot>
</x-guest-layout>
