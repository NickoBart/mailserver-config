<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', 'Connectia Mail')</title>

    {{-- Bootstrap 5 (o el fichero que uses) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

    {{-- DataTables CSS (versión 1.11.5 en este ejemplo) --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />

    @stack('css')
</head>
<body class="bg-light">

    {{-- Navbar fijo superior (puedes adaptarlo) --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
          Connectia Mail
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            {{-- Agrega aquí enlaces si los necesitas --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dominios.index') }}">Dominios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('buzones.index') }}">Buzones</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('estadisticas.index') }}">Estadísticas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('configuracion.index') }}">Configuración</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                 data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->email }}
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid mt-4">
      {{-- Aquí se inyecta el contenido de cada vista --}}
      @yield('content')
    </div>

    {{-- jQuery (necesario para DataTables) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Bootstrap JS (opcional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- DataTables JS --}}
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    {{-- ¡ESTE es el bloque que inyectará tus scripts personalizados! --}}
    @stack('js')
</body>
</html>
