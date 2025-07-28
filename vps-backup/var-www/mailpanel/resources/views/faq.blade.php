{{-- resources/views/faq.blade.php --}}
<x-guest-layout>
  <section class="py-16 bg-gray-50 faq-container">
    <div class="max-w-3xl mx-auto px-4 space-y-8 bg-gray-50">
      <h2 class="text-3xl font-semibold text-center text-gray-800">Preguntas Frecuentes</h2>

      <div class="space-y-4">
        @foreach($faqs as $item)
          <div x-data="{ open: false }" class="faq-item border rounded-lg overflow-hidden bg-white shadow-sm">
            <button
              @click="open = !open"
              class="faq-item w-full flex justify-between items-center px-6 py-4 bg-gray-100 hover:bg-gray-200 transition"
            >
              <span class="faq-item font-medium text-gray-800">{{ $item['question'] }}</span>
              <i :class="faq-item open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-gray-600"></i>
            </button>
            <div x-show="open" x-cloak class="faq-item px-6 py-4 text-gray-700">
              {!! $item['answer'] !!}
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
</x-guest-layout>
