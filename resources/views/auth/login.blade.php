@extends('layouts.app')

@section('content')
<h1 class="text-4xl font-bold">Inicia sesión</h1>
<form method="POST" action="{{ route('login') }}" class="max-w-sm">
  @csrf

  <div class="mb-2">
    <p class="mb-1"><label for="email" class="form-label">Correo electrónico</label></p>
    <input type="email" class="form-input" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    @error('email')
      <strong>{{ $message }}</strong>
    @enderror
  </div>
  
  <div class="mb-2">
    <p class="mb-1"><label for="password" class="form-label">Contraseña</label></p>
    <input type="password" class="form-input" name="password" id="password" required autocomplete="current-password">
    @error('password')
      <strong>{{ $message }}</strong>
    @enderror
  </div>
  
  <div class="mb-2">
    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    <label class="form-label" for="remember">Recuérdame</label>
  </div>

  <div class="mb-4"><button class="btn-main">Iniciar sesión</button></div>

  <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
</form>
@endsection
