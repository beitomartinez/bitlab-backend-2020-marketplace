@extends('layouts.app')

@section('content')
<h1>Crear producto</h1>
<p class="mb-4">{{ $business->name }}</p>
<p class="mb-4">Completa correctamente el formulario para crear un producto.</p>

<form
  action="{{ route('my-businesses.products.store', $business->id) }}"
  class="p-4 border rounded max-w-4xl"
  enctype="multipart/form-data"
  method="POST">
  @csrf
  <div class="overflow-hidden">
    <div class="flex flex-col md:flex-row -mx-2">
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="name" class="form-label">Nombre del producto *</label></p>
        <input type="text" name="name" id="name" class="form-input" required maxlength="191" value="{{ old('name') }}">
        @error('name')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div> 
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="image" class="form-label">Imagen del producto *</label></p>
        <input type="file" name="image" id="image" class="form-input" required accept="image/*">
        @error('image')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>  
    </div>
  </div>

  <div class="text-center mt-4"><button class="btn-main text-xl">Guardar</button></div>

</form>

@endsection