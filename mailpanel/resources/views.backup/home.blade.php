{{-- resources/views/home.blade.php --}}
<x-guest-layout>

  {{-- Hero con vídeo de fondo, métricas y CTA principal --}}
  <section id="hero" class="relative w-full h-[550px] overflow-hidden">
    <video aria-label="Vídeo de fondo" autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
      <source src="{{ asset('assets/videos/Video_Corporativo_Listo.webm') }}" type="video/webm">
    </video>
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 py-26 flex flex-col lg:flex-row items-center gap-12">
      <div class="lg:w-1/2 space-y-6 text-white">
        <h1 class="text-5xl font-extrabold leading-tight">
          Tu Correo Corporativo
          <span class="text-blue-400">Profesional y Seguro</span>
        </h1>
        <p class="text-lg max-w-lg">
          Correo corporativo cifrado y sin anuncios: privacidad total y profesionalismo al instante.
        </p>

        {{-- Métricas de confianza --}}
        <div class="flex flex-wrap gap-4 mt-6">
          <span class="inline-block bg-blue-600 text-white rounded-full px-3 py-1 text-sm font-semibold">
            ✅ Uptime 99,9%
          </span>
          <span class="inline-block bg-blue-600 text-white rounded-full px-3 py-1 text-sm font-semibold">
            🚀 1.234 buzones activos
          </span>
          <span class="inline-block bg-blue-600 text-white rounded-full px-3 py-1 text-sm font-semibold">
            ⏱ Soporte &lt;10 min
          </span>
        </div>

        {{-- CTA principal --}}
        <div class="mt-8">
          <a href="{{ route('pricing') }}"
             class="inline-block bg-white text-blue-600 font-semibold px-10 py-4 rounded-lg shadow hover:bg-gray-100 transition">
            Ver planes
          </a>
        </div>
      </div>
      {{-- Mockup del panel --}}
      <div class="lg:w-1/2">
        <img
          src="{{ asset('images/placeholder-device.png') }}"
          alt="Mockup panel de Connectia Mail"
          class="w-full max-w-md mx-auto transform scale-100 transition-transform hover:scale-105"
        />


      </div>
    </div>
  </section>

  {{-- Beneficios Clave en cards --}}
  <section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h2 class="text-3xl font-bold text-gray-800 mb-12">Beneficios Clave</h2>
      <div class="max-w-md mx-auto lg:max-w-6xl">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        @foreach($features as $feature)
          <div class="card p-8 flex items-start gap-4">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full">
              <i class="{{ $feature['icon'] }} text-blue-600 text-xl"></i>
            </div>
            <div>
              <h3 class="text-xl font-semibold text-gray-800">{{ $feature['title'] }}</h3>
              <p class="text-gray-600">{{ $feature['text'] }}</p>
            </div>
          </div>
        @endforeach
       </div>
    </div>

      </div>
    </div>
  </section>

  {{-- Testimonios en fondo oscuro --}}
  <section class="py-20 bg-gray-900">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <h2 class="text-3xl font-bold text-white mb-8">Lo que dicen nuestros clientes</h2>
    <div class="max-w-3xl mx-auto py-16">
      <x-testimonial-slider :testimonios="$testimonios" class="text-white" />
    </div>
  </section>

  {{-- Logos de clientes en carrusel --}}
  <section class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4">
      <h2 class="text-2xl font-semibold text-gray-800 text-center mb-8">Clientes que confían en nosotros</h2>
      <div class="flex overflow-x-auto gap-6">
        @foreach($logos as $logo)
          <div class="flex-shrink-0 w-48 h-32 bg-white rounded-lg shadow flex items-center justify-center">
            <img src="{{ asset($logo) }}" alt="Logo cliente" class="max-h-16 object-contain">
          </div>
        @endforeach
       </div>
    </div>
      </div>
    </div>
  </section>

  {{-- CTAs secundarios y botón flotante --}}
  <section class="py-16 bg-gray-100 text-center">
    <div class="max-w-xl mx-auto flex flex-col sm:flex-row gap-4 justify-center">
      <a href="{{ url('/chat') }}"
         class="inline-block bg-blue-600 text-white font-semibold px-8 py-4 rounded-lg shadow hover:bg-blue-700 transition">
        Chatea con nosotros
      </a>
      <a href="{{ url('/signup?domain=true') }}"
         class="inline-block px-8 py-4 border border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition">
        Ya tengo dominio
      </a>
    </div>
  </section>

  {{-- Botón flotante de chat --}}
  <a href="{{ url('/chat') }}"
     class="fixed bottom-6 right-6 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition">
    <i class="fas fa-comments text-xl"></i>
  </a>

</x-guest-layout>
