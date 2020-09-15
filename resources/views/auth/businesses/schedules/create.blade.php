@extends('layouts.app')

@section('content')
<h1>Crear horario</h1>
<p class="mb-4">{{ $business->name }}</p>
<p class="mb-4">Completa correctamente el formulario para crear un horario.</p>

<form
  action="{{ route('my-businesses.schedules.store', $business->id) }}"
  class="p-4 border rounded max-w-4xl"
  method="POST">
  @csrf
  <div class="mb-2">
    <p class="mb-1"><label for="day" class="form-label">Día *</label></p>
    <select name="day" id="day" class="form-input" required>
      @foreach ($availableDays as $day)
      <option value="{{ $day }}">{{ __("days.{$day}") }}</option>
      @endforeach
    </select>
  </div>
  <div class="overflow-hidden">
    <div class="flex flex-col md:flex-row -mx-2">
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="opens_at" class="form-label">Desde *</label></p>
        <input type="text" name="opens_at" id="opens_at" class="form-input time-picker" required value="{{ old('opens_at') }}">
        @error('opens_at')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div> 
      <div class="w-full md:w-1/2 px-2 mb-2">
        <p class="mb-1"><label for="closes_at" class="form-label">Desde *</label></p>
        <input type="text" name="closes_at" id="closes_at" class="form-input time-picker" required value="{{ old('closes_at') }}">
        @error('closes_at')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
      </div> 
    </div>
  </div>

  <div class="text-center mt-4"><button class="btn-main text-xl">Guardar</button></div>

</form>

@endsection