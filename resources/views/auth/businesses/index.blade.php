@extends('layouts.app')

@section('content')
<div class="flex flex-row mb-4 items-center">
  <h1 class="flex-1">Mis negocios</h1>
  <div class="flex-none ml-2"><a href="{{ route('my-businesses.create') }}" class="btn-main text-xl">Crear negocio</a></div>
</div>

@if (count($businesses) == 0)
<p class="text-center text-gray-700">No tienes negocios creados. <a href="{{ route('my-businesses.create') }}" class="link-basic">¿Por qué no creas uno?</a></p>
@else

<div class="flex flex-row text-sm p-2 border border-blue-500 mb-2 rounded">
  <div class="flex-1">Tienes {{ $businesses->total() }} negocio(s) en total</div>
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

<table class="w-full table-bordered">
  <tr>
    <th class="text-left">Nombre</th>
    <th class="text-left">Categoría</th>
    <th class="text-left">Ubicación</th>
  </tr>
  @foreach ($businesses as $business)
    <tr>
      <td><a href="{{ route('my-businesses.edit', $business->id) }}" class="link-basic">{{ $business->name }}</a></td>
      <td>{{ $business->category->name }}</td>
      <td>{{ "{$business->city->name}, {$business->state->name}" }}</td>
    </tr>
  @endforeach
</table>
@endif

@endsection