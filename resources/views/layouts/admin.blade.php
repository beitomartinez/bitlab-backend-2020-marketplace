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
        <div class="flex-1 text-2xl leading-none"><a href="{{ route('admin.dashboard') }}" class="hover:underline">Panel administrativo</a></div>
        
        <div class="flex-none mr-4"><a href="{{ route('admin.categories.index') }}" class="link-basic">Categorías</a></div>
        <div class="flex-none mr-4"><a href="{{ route('admin.users.index') }}" class="link-basic">Usuarios</a></div>
        <div class="flex-none">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <button class="link-basic">Cerrar sesión</button>
        </form>
        </div>
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
