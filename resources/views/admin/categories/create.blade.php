@extends('layouts.admin')

@section('content')
<h1>Crear nueva categoría</h1>
<p class="mb-4">Completa correctamente el formulario para crear una nueva categoría</p>

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
  @csrf

  <div class="mb-2">
    <p class="mb-1"><label for="name" class="form-label">Nombre *</label></p>
    <input name="name" id="name" type="text" class="form-input" placeholder="Comidas, Cafetería, Panadería, etc" required maxlength="191">
    @error('name')
    <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
  </div>
  
  <div class="mb-2">
    <p class="mb-1"><label for="image" class="form-label">Imagen *</label></p>
    <input name="image" id="image" type="file" class="form-input" accept="image/*" required>
    @error('image')
    <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
  </div>

  <p class="text-sm mb-4">* Campos requeridos</p>

  <p class="text-center"><button class="btn-main text-2xl">Guardar</button></p>


</form>
@endsection