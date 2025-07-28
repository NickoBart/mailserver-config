<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }}</title>
  {{-- favicon, fuentes y Vite --}}
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
  {{-- Navegación de invitados --}}
  @include('layouts.guest-navigation')

  {{-- Contenido de la página --}}
  <main class="py-8">
    {{ $slot }}
  </main>

  {{-- Footer común --}}
  @include('layouts.footer')
</body>
</html>
