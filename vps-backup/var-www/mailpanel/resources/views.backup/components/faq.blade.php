{{-- resources/views/components/faq.blade.php --}}
@props(['faqs'])

<div class="space-y-4">
  <template x-for="(faq, index) in {{ json_encode($faqs) }}" :key="index">
    <div x-data="{ open: false }" class="border rounded-lg overflow-hidden">
      <button
        @click="open = !open"
        class="w-full px-6 py-4 flex justify-between items-center bg-gray-100 hover:bg-gray-200 transition"
      >
        <span class="text-gray-800 font-medium" x-text="faq.question"></span>
        <svg
          :class="open ? 'transform rotate-180' : ''"
          class="h-5 w-5 text-gray-600 transition-transform"
          fill="none" stroke="currentColor" viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div
        x-show="open"
        x-collapse
        class="px-6 py-4 bg-white text-gray-700"
        x-text="faq.answer"
      ></div>
    </div>
  </template>
</div>
