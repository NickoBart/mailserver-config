{{-- resources/views/components/client-logos.blade.php --}}
@props(['logos'])

<div class="py-16 bg-gray-50">
  <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">
    Clientes que confían en nosotros
  </h2>

  <!-- Contenedor Splide -->
  <div id="client-logos-carousel" class="splide max-w-5xl mx-auto">
    <div class="splide__track">
      <ul class="splide__list flex gap-6 items-center justify-center">
        @foreach($logos as $logo)
          @php
            // extrae el nombre de archivo sin extensión
            $name = pathinfo($logo, PATHINFO_FILENAME);
          @endphp
          <li class="splide__slide p-4 bg-white rounded-lg shadow flex items-center justify-center cursor-pointer">
            <img
              src="{{ asset($logo) }}"
              alt="Logo {{ $name }}"
              title="{{ $name }}"
              class="max-h-16 object-contain"
            >
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
