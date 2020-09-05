@extends('layouts.app')

@section('content')
<h1 class="font-bold text-4xl">Registro</h1>

<form method="POST" action="{{ route('register') }}" class="max-w-sm">
  @csrf
  <div class="overflow-hidden">
    <div class="flex flex-col md:flex-row -mx-2">
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="name" class="form-label">Nombre</label></p>
        <input type="text" class="form-input" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
          <strong>{{ $message }}</strong>
        @enderror
      </div>
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="email" class="form-label">Correo electrónico</label></p>
        <input type="email" class="form-input" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')
          <strong>{{ $message }}</strong>
        @enderror
      </div>
    </div>
  </div>

  <div class="overflow-hidden">
    <div class="flex flex-col md:flex-row -mx-2">
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="password" class="form-label">Contraseña</label></p>
        <input type="password" class="form-input" name="password" id="password" required>
        @error('password')
          <strong>{{ $message }}</strong>
        @enderror
      </div>
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="password_confirmation" class="form-label">Confirmar contraseña</label></p>
        <input type="password" class="form-input" name="password_confirmation" id="password_confirmation" required>
        @error('password_confirmation')
          <strong>{{ $message }}</strong>
        @enderror
      </div>
    </div>
  </div>

  <div class="text-center mt-4"><button class="btn-main">Registrarme</button></div>
</form>
@endsection
