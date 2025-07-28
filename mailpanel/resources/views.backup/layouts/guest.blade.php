<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }} | Correos corporativos seguros para PYMEs</title>
  <meta name="description" content="Connectia Mail ofrece correo corporativo cifrado y sin anuncios con soporte premium 24/7 para pymes chilenas. Garantía de uptime 99,9% y migración sencilla.">

  <!-- Open Graph / Facebook -->
  <meta property="og:type"        content="website" />
  <meta property="og:url"         content="{{ url()->current() }}" />
  <meta property="og:title"       content="{{ config('app.name') }} | Correos corporativos seguros para PYMEs" />
  <meta property="og:description" content="Connectia Mail ofrece correo corporativo cifrado y sin anuncios con soporte premium 24/7 para pymes chilenas. Garantía de uptime 99,9% y migración sencilla." />
  <meta property="og:image"       content="{{ asset('images/og-image.png') }}" />

  <!-- Twitter -->
  <meta name="twitter:card"       content="summary_large_image" />
  <meta name="twitter:url"        content="{{ url()->current() }}" />
  <meta name="twitter:title"      content="{{ config('app.name') }} | Correos corporativos seguros para PYMEs" />
  <meta name="twitter:description" content="Connectia Mail ofrece correo corporativo cifrado y sin anuncios con soporte premium 24/7 para pymes chilenas. Garantía de uptime 99,9% y migración sencilla." />
  <meta name="twitter:image"      content="{{ asset('images/og-image.png') }}" />

  <!-- Fonts & Scripts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0G8DP3C547"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-0G8DP3C547');
</script>
<!-- End Google Analytics -->
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900">

  {{-- NAV PARA INVITADOS --}}
  @include('layouts.guest-navigation')

  {{-- SI ES HOME, slot a toda anchura --}}
  @if(request()->routeIs('home'))
    {{ $slot }}
  @else
    {{-- PARA EL RESTO, contenedor unificado --}}
    <div class="py-12">
      <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </div>
  @endif

  {{-- FOOTER --}}
  @include('components.footer')

  <!-- Start of Tawk.to Script -->
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/683150be12ae50190a96fc75/1is0a6qjc';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
  <!-- End of Tawk.to Script -->

</body>
</html>
