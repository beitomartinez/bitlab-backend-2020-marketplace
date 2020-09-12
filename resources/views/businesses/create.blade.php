@extends('layouts.app')

@section('content')
<h1>Crear negocio</h1>
<p class="mb-4">Completa correctamente el formulario para crear tu negocio.</p>

<form
  action="{{ route('businesses.store') }}"
  class="p-4 border rounded max-w-4xl"
  enctype="multipart/form-data"
  method="POST">
  @csrf
  <div class="overflow-hidden">
    <div class="flex flex-col md:flex-row -mx-2">
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="name" class="form-label">Nombre del negocio *</label></p>
        <input type="text" name="name" id="name" class="form-input" required maxlength="191" value="{{ old('name') }}">
        @error('name')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div> 
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="image" class="form-label">Logo del negocio *</label></p>
        <input type="file" name="image" id="image" class="form-input" required accept="image/*">
        @error('image')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>  
    </div>
  </div>

  <div class="mb-2">
    <p class="mb-1"><label for="description" class="form-label">Descripción del negocio *</label></p>
    <textarea class="form-input" name="description" id ="description">{{ old('description') }}</textarea>
    @error('description')
    <p class="text-xs text-red-500">{{ $message }}</p>
    @enderror
  </div>

  <div class="overflow-hidden">
    <div class="flex flex-col md:flex-row -mx-2">
      <div class="w-full md:w-1/2 lg:w-1/4 px-2 mb-2">
        <p class="mb-1"><label for="phone" class="form-label">Teléfono del negocio</label></p>
        <input type="tel" name="phone" id="phone" class="form-input" maxlength="9" value="{{ old('phone') }}">
        @error('phone')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div> 
      <div class="w-full md:w-1/2 lg:w-1/4 px-2 mb-2">
        <p class="mb-1"><label for="whatsapp" class="form-label">Whatsapp</label></p>
        <input type="tel" name="whatsapp" id="whatsapp" class="form-input" maxlength="9" value="{{ old('whatsapp') }}">
        @error('whatsapp')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="w-full md:w-1/2 lg:w-1/4 px-2 mb-2">
        <p class="mb-1"><label for="email" class="form-label">Correo electrónico</label></p>
        <input type="email" name="email" id="email" class="form-input" maxlength="191" value="{{ old('email') }}">
        @error('email')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="w-full md:w-1/2 lg:w-1/4 px-2 mb-2">
        <p class="mb-1"><label for="website" class="form-label">Sitio web</label></p>
        <input type="text" name="website" id="website" class="form-input" maxlength="191" value="{{ old('website') }}">
        @error('website')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>
    </div>
  </div>
  
  <div class="overflow-hidden">
    <div class="flex flex-col md:flex-row -mx-2">
      <div class="w-full md:w-2/3 px-2 mb-2">
        <p class="mb-1"><label for="address" class="form-label">Dirección *</label></p>
        <input type="text" name="address" id="address" class="form-input" maxlength="191" required value="{{ old('address') }}">
        @error('address')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="w-full md:w-1/3 px-2 mb-2">
        <p class="mb-1"><label for="city_id" class="form-label">Municipio *</label></p>
        <select name="city_id" id="city_id" class="form-input">
          @foreach ($states as $state)
          <optgroup label="{{ $state->name }}">
            @foreach ($state->cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
          </optgroup>
          @endforeach
        </select>
        @error('city_id')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>
    </div>
  </div>
  
  <div class="overflow-hidden">
    <div class="flex flex-col md:flex-row -mx-2">
      <div class="w-full md:w-1/3 px-2 mb-2">
        <p class="mb-1"><label for="category_id" class="form-label">Categoría *</label></p>
        <select name="category_id" id="category_id" class="form-input">
          @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        @error('category_id')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="w-full md:w-1/3 px-2 mb-2">
        <p class="mb-1"><label for="is_delivery" class="form-label">¿Servicio a domicilio? *</label></p>
        <p><label class="form-label">
          <input type="radio" name="is_delivery" value="0" {{ old('is_delivery') == 0 ? 'checked' : '' }}> No</label> <label class="form-label">
          <input type="radio" name="is_delivery" value="1" {{ old('is_delivery') == 0 ? 'checked' : '' }}> Sí</label></p>
        @error('is_delivery')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="w-full md:w-1/3 px-2 mb-2">
        <p class="mb-1"><label for="is_takeout" class="form-label">¿Servicio para llevar? *</label></p>
        <p><label class="form-label">
          <input type="radio" name="is_takeout" value="0" {{ old('is_takeout') == 0 ? 'checked' : '' }}> No</label> <label class="form-label">
          <input type="radio" name="is_takeout" value="1" {{ old('is_takeout') == 0 ? 'checked' : '' }}> Sí</label></p>
        @error('is_takeout')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div>
    </div>
  </div>

  <div class="text-center mt-4"><button class="btn-main text-xl">Guardar</button></div>

</form>

@endsection