<x-app-layout>

<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">Mi Suscripción</h1>

    @if($subscription)
        @if($expired)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Tu suscripción ha expirado</strong> el {{ $subscription->expires_at->format('d-m-Y') }}.
            </div>
        @elseif($daysLeft <= 5)
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                <strong>Tu suscripción vence en {{ $daysLeft }} día{{ $daysLeft > 1 ? 's' : '' }}</strong>.
            </div>
        @endif

        <p><strong>Estado:</strong> {{ ucfirst($subscription->status) }}</p>
        <p><strong>Vence el:</strong> {{ $subscription->expires_at->format('d-m-Y') }}</p>
        <p><strong>Plan:</strong> {{ $subscription->plan_name }}</p>

        <div class="mt-4 space-x-2">
            {{-- Renovación mensual --}}
            <form action="{{ route('subscriptions.reactivate', $subscription->id) }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="period" value="monthly">
                <button type="submit"
                        class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Renovar 1 mes
                </button>
            </form>

            {{-- Renovación anual --}}
            <form action="{{ route('subscriptions.reactivate', $subscription->id) }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="period" value="annual">
                <button type="submit"
                        class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Renovar 1 año
                </button>
            </form>
        </div>
    @else
        <p>No tienes una suscripción activa.</p>
        <a href="{{ route('pricing') }}"
           class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Ver planes
        </a>
    @endif
</div>

</x-app-layout>
