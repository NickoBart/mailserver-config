@props(['icon', 'title'])

<div class="block mx-auto p-6 bg-white rounded-xl shadow hover:shadow-lg transition">
  <div class="flex items-center justify-center w-16 h-16 mb-6">
    <i class="{{ $icon }} text-2xl text-blue-600"></i>
  </div>
  <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $title }}</h3>
  <div class="text-gray-600 text-sm">
    {{ $slot }}
  </div>
</div>
