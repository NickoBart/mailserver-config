@props(['testimonios'])
<div class="my-16">
  <div id="testimonials" class="splide mx-auto max-w-4xl">
    <div class="splide__track">
      <ul class="splide__list">
        @foreach($testimonios as $t)
          <li class="splide__slide p-6 bg-gray-800 text-white rounded-lg shadow">
            <div class="flex items-center mb-4">
              <img src="{{ asset($t['foto']) }}" alt="{{ $t['name'] }}" class="h-12 w-12 rounded-full mr-4">
              <div>
                <p class="font-semibold">{{ $t['name'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $t['cargo'] }}</p>
              </div>
<div class="mb-16"></div>
            </div>
<div class="mb-16"></div>
            <p class="text-gray-200">“{{ $t['texto'] }}”</p>
          </li>
        @endforeach
      </ul>
    </div>
<div class="mb-16"></div>
  </div>
<div class="mb-16"></div>
</div>
<div class="mb-16"></div>
