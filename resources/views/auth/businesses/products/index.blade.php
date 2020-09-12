@extends('layouts.app')

@section('content')
<div class="flex flex-row mb-4 items-center">
  <div class="flex-1">
    <h1>Productos</h1>
    <p>{{ $business->name }}</p>
  </div>
  <div class="flex-none ml-2"><a href="{{ route('my-businesses.products.create', $business->id) }}" class="btn-main text-xl">Crear producto</a></div>
</div>

@if (count($products) == 0)
<p class="text-center text-gray-700">No hay productos para este negocio aún.</p>
@else
<div class="overflow-hidden text-center">
  <div class="flex flex-col md:flex-row -mx-2">
    @foreach($products as $product)
    <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2">
      <a href="{{ route('my-businesses.products.show', [$business->id, $product->id]) }}" class="block rounded-lg overflow-hidden border p-2 link-basic">
        <img src="{{ asset("storage/products/{$product->image}") }}" class="mb-4">
        <p>{{ $product->name }}</p>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endif

@endsection