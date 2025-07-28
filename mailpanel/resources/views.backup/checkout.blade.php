<x-guest-layout>
  @section('title','Contratar')
  <x-slot name="slot">
    <section class="py-16">
      <div class="max-w-2xl mx-auto bg-white shadow rounded p-6 text-gray-900 dark:text-gray-900">
        <h1 class="text-2xl font-bold mb-4">Formulario de Contratación</h1>

        {{-- Mostrar errores --}}
        @if($errors->any())
          <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6 text-gray-900">
          @csrf
          <input type="hidden" name="plan_id" value="{{ request('plan_id') }}">

          <div>
           <label for="name" class="block text-base font-medium text-gray-900 mb-1">Tu nombre</label>
           <input id="name" name="name" type="text" required
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400"
                  placeholder="Ej. María Pérez">
          </div>

          <div>
           <label for="email" class="block text-base font-medium text-gray-900 mb-1">Tu correo</label>
           <input id="email" name="email" type="email" required
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400"
                  placeholder="Ej. maria@ejemplo.com">
          </div>

          <div>
           <label for="domain" class="block text-base font-medium text-gray-900 mb-1">Tu dominio</label>
           <input id="domain" name="domain" type="text" required
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400"
                  placeholder="ejemplo.com">
          </div>

          <div>
           <label for="period" class="block text-base font-medium text-gray-900 mb-1">
             Período
           </label>
           <select id="period" name="period" required
                   class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900">
             <option value="monthly">Mensual (prorrateo)</option>
             <option value="annual">Anual (10% dto)</option>
           </select>
          </div>

          <div>
           <label for="quantity" class="block text-base font-medium text-gray-900 mb-1">Cantidad de buzones</label>
           <select id="quantity" name="quantity" required
                   class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400">
              @for($i=1; $i<=200; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
           </select>
          </div>

          <div>
           <label for="billing_day" class="block text-base font-medium text-gray-900 mb-1">Día de facturación (1–28)</label>
           <select id="billing_day" name="billing_day" required
                   class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400">
              @for($d=1; $d<=28; $d++)
                <option value="{{ $d }}">{{ $d }}</option>
              @endfor
           </select>
          </div>

          <div>
           <label for="razon_social" class="block text-base font-medium text-gray-900 mb-1">Razón social</label>
           <input id="razon_social" name="razon_social" type="text" required
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400">
          </div>

          <div>
           <label for="rut" class="block text-base font-medium text-gray-900 mb-1">RUT / ID fiscal</label>
           <input id="rut" name="rut" type="text" required
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400">
          </div>

          <div>
           <label for="direccion" class="block text-base font-medium text-gray-900 mb-1">Dirección</label>
           <input id="direccion" name="direccion" type="text" required
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400">
          </div>

          <div>
           <label for="ciudad_region" class="block text-base font-medium text-gray-900 mb-1">Ciudad / Región</label>
           <input id="ciudad_region" name="ciudad_region" type="text" required
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400">
          </div>

          <div>
           <label for="giro" class="block text-base font-medium text-gray-900 mb-1">Giro / Actividad económica</label>
           <input id="giro" name="giro" type="text" required
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400">
          </div>

          <div>
           <label for="contact_email" class="block text-base font-medium text-gray-900 mb-1">Email de contacto <span class="text-gray-500">(opcional)</span></label>
           <input id="contact_email" name="contact_email" type="email"
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400">
          </div>

          <div>
           <label for="contact_phone" class="block text-base font-medium text-gray-900 mb-1">Teléfono de contacto <span class="text-gray-500">(opcional)</span></label>
           <input id="contact_phone" name="contact_phone" type="tel"
                  class="block w-full border-gray-300 rounded p-2 focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-400">
          </div>

          <button type="submit"
                  class="w-full bg-blue-600 text-white font-medium py-3 rounded hover:bg-blue-700 transition">
            Pagar
          </button>
        </form>
      </div>
    </section>
  </x-slot>
</x-guest-layout>
