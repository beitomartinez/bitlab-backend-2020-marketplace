@extends('layouts.admin')

@section('content')
<h1>{{ $category->name }}</h1>


<form
  action="{{ route('admin.categories.update', $category->id) }}"
  method="POST"
  enctype="multipart/form-data"
  class="max-w-2xl p-4 border">
  @csrf
  @method('PUT')
  
  <p class="mb-4">Completa correctamente el formulario para actualizar esta categoría</p>

  <img src="{{ asset("storage/categories/{$category->image}") }}" class="mx-auto w-24">
  <p class="text-center text-xs mb-4">Imagen actual</p>

  <div class="mb-2">
    <p class="mb-1"><label for="name" class="form-label">Nombre *</label></p>
    <input name="name" id="name" type="text" class="form-input" placeholder="Comidas, Cafetería, Panadería, etc" required maxlength="191" value="{{ old('name', $category->name) }}">
    @error('name')
    <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
  </div>
  
  <div class="mb-2">
    <p class="mb-1"><label for="image" class="form-label">Imagen *</label></p>
    <input name="image" id="image" type="file" class="form-input" accept="image/*">
    @error('image')
    <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
  </div>

  <p class="text-sm mb-4">* Campos requeridos</p>

  <p class="text-center"><button class="btn-main text-2xl">Actualizar</button></p>

</form>
@endsection