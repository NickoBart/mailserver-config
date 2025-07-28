{{-- resources/views/components/nav-link.blade.php --}}
@props(['href', 'active'])

@php
  // Clase base para todos los links
  $base = 'inline-flex items-center px-1 pt-1 pb-1 text-sm font-medium transition duration-150 ease-in-out';
  // Si está activo, borde inferior azul, texto oscuro; si no, transparente y texto gris
  $activeClasses = $active
    ? 'border-b-2 border-blue-500 text-gray-900 dark:text-gray-100'
    : 'border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:border-gray-300 hover:text-gray-700 dark:hover:border-gray-300';
  $classes = "$base $activeClasses";
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>
