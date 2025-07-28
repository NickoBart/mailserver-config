<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <!-- Logo -->
      <div class="shrink-0 flex items-center">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
          <img src="{{ asset('images/logo-connectia.png') }}" alt="Connectia Mail Logo" style="height:40px; width:auto;" />
          <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ config('app.name') }}</span>
        </a>
      </div>

      <!-- Links de invitado -->
      <div class="hidden space-x-8 sm:flex sm:ms-10">
        <x-nav-link :href="route('home')"    :active="request()->routeIs('home')">Home</x-nav-link>
        <x-nav-link :href="route('pricing')" :active="request()->routeIs('pricing')">Planes</x-nav-link>
        <x-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">Acerca de</x-nav-link>
        <x-nav-link :href="route('faq')"     :active="request()->routeIs('faq')">FAQ</x-nav-link>
        <x-nav-link :href="route('login')"   :active="false">Iniciar sesión</x-nav-link>
      </div>

      <!-- Hamburger (mobile) omitido en este ejemplo -->
    </div>
  </div>
</nav>
