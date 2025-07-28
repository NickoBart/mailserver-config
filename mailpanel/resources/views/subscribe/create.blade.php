<x-guest-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Contratar servicio</h2>
  </x-slot>

  <form action="{{ route('subscribe.store') }}" method="POST" class="max-w-md mx-auto p-6 bg-white shadow rounded">
    @csrf

    <label class="block mb-2">Nombre</label>
    <input type="text" name="name" required class="w-full mb-4 border rounded p-2">

    <label class="block mb-2">Correo</label>
    <input type="email" name="email" required class="w-full mb-4 border rounded p-2">

    <label class="block mb-2">Dominio</label>
    <input type="text" name="domain" required class="w-full mb-4 border rounded p-2" placeholder="tudominio.com">

    {{-- Cantidad de buzones --}}
    <label class="block mb-2">Cantidad de buzones</label>
    <select name="quantity" class="w-full mb-4 border rounded p-2">
      @for($i = 1; $i <= 200; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
      @endfor
    </select>

    {{-- Día de facturación --}}
    <label class="block mb-2">Día de facturación</label>
    <select name="billing_day" class="w-full mb-4 border rounded p-2">
      @for($d = 1; $d <= 28; $d++)
        <option value="{{ $d }}">{{ $d }}</option>
      @endfor
    </select>

    {{-- Datos para factura --}}
    <label class="block mb-2">Razón social</label>
    <input type="text" name="razon_social" required class="w-full mb-4 border rounded p-2">

    <label class="block mb-2">RUT / ID fiscal</label>
    <input type="text" name="rut" required class="w-full mb-4 border rounded p-2">

    <label class="block mb-2">Dirección</label>
    <input type="text" name="direccion" required class="w-full mb-4 border rounded p-2">

    <label class="block mb-2">Ciudad / Región</label>
    <input type="text" name="ciudad_region" required class="w-full mb-4 border rounded p-2">

    <label class="block mb-2">Giro / Actividad económica</label>
    <input type="text" name="giro" required class="w-full mb-4 border rounded p-2">

    <label class="block mb-2">Email de contacto (opcional)</label>
    <input type="email" name="contact_email" class="w-full mb-4 border rounded p-2">

    <label class="block mb-2">Teléfono de contacto (opcional)</label>
    <input type="tel" name="contact_phone" class="w-full mb-4 border rounded p-2">

    {{-- Campo oculto plan_id --}}
    <input type="hidden" name="plan_id" value="{{ request('plan_id') }}">

    <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">
      Enviar solicitud
    </button>
  </form>
</x-guest-layout>
