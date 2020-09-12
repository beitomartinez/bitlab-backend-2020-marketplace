@extends('layouts.app')

@section('content')
<div class="continer mx-auto">
  <div class="text-center mb-8">
    <h1 class="mb-8">¡Bienvenidos!</h1>

    <form action="{{ route('businesses.index') }}" method="GET">
      <p class="text-sm">¿Qué estás buscando?</p>
      <div class="flex flex-row max-w-md mx-auto">
        <div class="flex-1"><input type="text" class="form-input"></div>
        <div class="flex-none ml-2"><button class="btn-main">Buscar</button></div>
      </div>
    </form>
  </div>

  <div class="overflow-hidden text-center">
    <div class="flex flex-col md:flex-row -mx-2">
      @foreach($businesses as $business)
      <div class="w-full md:w-1/3 px-2">
        <a href="{{ route('businesses.show', $business->slug) }}" class="block rounded-lg overflow-hidden border p-2 link-basic">
          <img src="{{ asset("storage/businesses/{$business->image}") }}" class="mb-4">
          <p>{{ $business->name }}</p>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
