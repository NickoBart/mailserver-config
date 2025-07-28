{{-- resources/views/about/index.blade.php --}}
<x-guest-layout>
  {{-- Misión y Visión --}}
  <section class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-4 text-center space-y-12">
      <div>
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Nuestra misión</h2>
        <p class="text-gray-600">
          Somos Connectia Mail, el correo corporativo diseñado para pymes chilenas que buscan un servicio cercano, seguro y confiable. Brindamos
          <strong>atención 100 % humana</strong>, con un ejecutivo asignado, <strong>configuración instantánea y automatizada</strong> y
          <strong>seguridad de nivel empresarial</strong>, para que tu empresa comunique, colabore y crezca con la tranquilidad de un aliado que cumple sus promesas.
        </p>
      </div>
      <div>
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Nuestra visión</h2>
        <p class="text-gray-600">
          En los próximos 5–10 años, Connectia Mail será la plataforma de correo corporativo líder para pymes en Chile y Latinoamérica, reconocida por:
        </p>
        <ul class="mt-4 text-gray-600 list-disc list-inside text-left max-w-xl mx-auto space-y-2">
          <li>Construir relaciones a largo plazo con cada cliente.</li>
          <li>Transformar el correo en una experiencia personal, potente y libre de publicidad.</li>
          <li>Innovar continuamente, agregando valor con nuevas herramientas colaborativas.</li>
        </ul>
      </div>
    </div>
  </section>

  {{-- Indicadores Clave --}}
  <section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4">
      <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Nuestros indicadores</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6 text-center">
        @foreach($metrics as $m)
          <div class="p-4 bg-white rounded-lg shadow">
            <p class="text-xl font-bold text-blue-600">{{ $m['value'] }}</p>
            <p class="text-gray-600">{{ $m['label'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Equipo --}}
  <section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4">
      <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Nuestro equipo</h2>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
        <div>
          <h3 class="text-xl font-medium text-gray-800">Juan Pérez</h3>
          <p class="text-gray-600">CEO</p>
        </div>
        <div>
          <h3 class="text-xl font-medium text-gray-800">María Gómez</h3>
          <p class="text-gray-600">CTO</p>
        </div>
        <div>
          <h3 class="text-xl font-medium text-gray-800">Luis Rodríguez</h3>
          <p class="text-gray-600">Head de Soporte</p>
        </div>
      </div>
    </div>
  </section>

  {{-- Historia --}}
  <section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
      <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Nuestra historia</h2>
      <ul class="space-y-6">
        <li class="flex items-center">
          <span class="inline-block w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-4">2018</span>
          <span class="text-gray-700">Fundación de Connectia.</span>
        </li>
        <li class="flex items-center">
          <span class="inline-block w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-4">2020</span>
          <span class="text-gray-700">Lanzamiento de Mail Pro.</span>
        </li>
        <li class="flex items-center">
          <span class="inline-block w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-4">2022</span>
          <span class="text-gray-700">1.000 buzones activos.</span>
        </li>
        <li class="flex items-center">
          <span class="inline-block w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-4">2025</span>
          <span class="text-gray-700">Expansión a Chile, Perú y México.</span>
        </li>
      </ul>
    </div>
  </section>
</x-guest-layout>
