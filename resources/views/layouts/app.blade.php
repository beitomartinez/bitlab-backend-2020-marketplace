<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
  <body>
    <div class="container mx-auto">
      <div class="flex flex-row items-center py-4 mb-4 border-b border-blue-500">
        <div class="flex-1 text-3xl font-bold"><a href="{{ route('home') }}" class="hover:underline">MarketPlace</a></div>
        @guest
          <div class="flex-none mr-4"><a class="text-blue-500 hover:underline" href="{{ route('login') }}">Iniciar sesión</a></div>
          <div class="flex-none mr-4"><a class="text-blue-500 hover:underline" href="{{ route('register') }}">Registrarme</a></div>
        @else
          <div class="flex-none mr-4">Hola, {{ Auth::user()->name }}</div>
          <!-- AQUI VAN LOS ENLACES -->
          <div class="flex-none">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
              <button class="text-blue-500 hover:underline">Cerrar sesión</button>
          </form>
          </div>
        @endguest
      </div>

      @section('content')
      <p>Este es un mensaje de ejemplo</p>
      @show

      <div class="border-t border-blue-500 py-2 mt-8 text-xs">{{ date('Y') }} - Derechos reservados</div>

      @section('scripts')
      @show
    </div>
  </body>
</html>
