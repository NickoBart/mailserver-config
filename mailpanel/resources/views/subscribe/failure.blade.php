<x-guest-layout>
  @section('title','Pago Fallido')
  <x-slot name="slot">
    <section class="py-16">
      <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-2xl font-bold mb-4">Pago Fallido</h1>
        <p>Hubo un problema procesando tu pago. Por favor, inténtalo de nuevo.</p>
        <a href="{{ route('subscribe.create') }}" class="underline">Volver al formulario</a>
      </div>
    </section>
  </x-slot>
</x-guest-layout>
