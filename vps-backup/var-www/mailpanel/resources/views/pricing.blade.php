{{-- resources/views/pricing.blade.php --}}
<x-guest-layout>
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
      <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Planes & Precios</h1>

      {{-- Cards de planes --}}
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-12">
        @foreach($plans as $plan)
          <div
            @class([
              'bg-white text-gray-900 p-6 rounded-xl shadow-lg flex flex-col justify-between',
              'border-2 border-blue-600 scale-105' => $plan->slug === 'pro',
            ])
          >
            @if($plan->slug === 'pro')
              <span class="block text-center text-sm font-semibold text-blue-600 uppercase mb-4">
                ★ Más popular
              </span>
            @endif

            <div class="space-y-2 text-center">
              <h3 class="text-2xl font-semibold">{{ $plan->name }}</h3>
              <p class="text-xl font-bold">
                USD {{ number_format($plan->price_usd, 2) }}<span class="font-normal"> / buzón</span>
              </p>
              @if($rate)
                <p class="text-sm text-gray-500">≈ CLP {{ number_format($plan->price_usd * $rate, 0) }}</p>
              @endif
              <ul class="mt-4 text-gray-700 space-y-1">
                <li>{{ $plan->mailbox_space_gb }} GB de almacenamiento</li>
                <li>{{ $plan->domain_limit }} dominio</li>
                <li>Antispam y antivirus</li>
                <li>Soporte premium 24/7</li>
                <li>Prueba gratis 30 días</li>
                <li>SLA 99,9% o mes gratis</li>
              </ul>
            </div>

            <a href="{{ route('checkout', ['plan_id' => $plan->id]) }}"
               class="mt-6 block bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition">
              Contratar
            </a>
          </div>
        @endforeach
      </div>

      {{-- Tabla comparativa --}}
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left font-medium text-gray-700">Característica</th>
              @foreach($plans as $plan)
                <th class="px-6 py-3 text-center font-medium text-gray-700">{{ $plan->name }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @php
              $rows = [
                'Almacenamiento' => fn($p) => $p->mailbox_space_gb.' GB',
                'Dominios incluidos' => fn($p) => $p->domain_limit,
                'Antispam + Antivirus' => fn($p) => '✓',
                'Soporte Premium 24/7' => fn($p) => '✓',
                'Prueba gratuita 30 días' => fn($p) => '✓',
                'SLA 99,9% o mes gratis' => fn($p) => '✓',
              ];
            @endphp

            @foreach($rows as $feature => $callback)
              <tr class="@if($loop->even) bg-white @else bg-gray-50 @endif">
                <td class="border-t px-6 py-4 text-gray-600">{{ $feature }}</td>
                @foreach($plans as $plan)
                  <td class="border-t px-6 py-4 text-center text-gray-800">{{ $callback($plan) }}</td>
                @endforeach
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</x-guest-layout>
