@extends('layouts.app')

@section('content')
<h1 class="mb-4">Directorio de negocios</h1>

@if (count($businesses) == 0)
<p class="text-center text-gray-700">No encontramos resultados para tu búsqueca. Por favor, intenta con otros parámetros.<br><a href="/" class="link-basic">Regresar al inicio</a></p>
@else

<div class="flex flex-row text-sm p-2 border border-blue-500 mb-2 rounded">
  <div class="flex-1">Encontramos {{ $businesses->total() }} negocio(s) en total</div>
  @if ($businesses->hasPages())
    @if (!$businesses->onFirstPage())
    <div class="flex-none px-2"><a href="{{ $businesses->previousPageUrl() }}" class="link-basic">ANTERIOR</a></div>
    @else
    <div class="flex-none px-2 text-gray-500">ANTERIOR</div>
    @endif
  <div class="flex-none px-2">Página {{ "{$businesses->currentPage()} de {$businesses->lastPage()}" }}</div>
    @if ($businesses->hasMorePages())
    <div class="flex-none px-2"><a href="{{ $businesses->nextPageUrl() }}" class="link-basic">SIGUIENTE</a></div>
    @else
    <div class="flex-none px-2 text-gray-500">SIGUIENTE</div>
    @endif
  @endif
</div>

<div class="overflow-hidden text-center">
  <div class="flex flex-col md:flex-row -mx-2">
    @foreach($businesses as $business)
    <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2">
      <a href="{{ route('businesses.show', $business->slug) }}" class="block rounded-lg overflow-hidden border p-2 link-basic">
        <img src="{{ asset("storage/businesses/{$business->image}") }}" class="mb-4">
        <p>{{ $business->name }}</p>
        <p class="text-sm text-black"><span class="font-bold">Productos:</span> {{ implode(', ', $business->products->pluck('name')->toArray()) }}</p>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endif

@endsection