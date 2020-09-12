@extends('layouts.app')

@section('content')
@section('content')
<div class="flex flex-row mb-4 items-center">
  <div class="flex-1">
    <h1>Productos</h1>
    <p>{{ $business->name }}</p>
  </div>
  <div class="flex-none ml-2"><a href="{{ route('my-businesses.products.create', $business->id) }}" class="btn-main text-xl">Crear producto</a></div>
</div>
@endsection