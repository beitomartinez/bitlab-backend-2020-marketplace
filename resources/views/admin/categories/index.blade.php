@extends('layouts.admin')

@section('content')
<div class="flex flex-row items-center">
  <h1 class="flex-1">Categorías</h1>
  <div class="flex-none ml-2">
    <a href="{{ route('admin.categories.create') }}" class="btn-main text-xl">Crear</a>
  </div>
</div>

@if (count($categories) == 0)
<p>No hay categorías aún</p>
@else
  <table class="table-bordered w-full max-w-md">
    <tr>
      <th class="text-left" colspan="2">Nombre</th>
      <th class="text-left">Negocios</th>
    </tr>
    @foreach ($categories as $category)
    <tr>
      <td class="w-16"><a href="{{ route('admin.categories.show', $category->id) }}" clas="link-basic"><img src="{{ asset("storage/categories/{$category->image}") }}"></a></td>
      <td><a href="{{ route('admin.categories.show', $category->id) }}" class="link-basic">{{ $category->name }}</a></td>
      <td>{{ $category->businesses_count }}</td>
    </tr>
    @endforeach
  </table>
@endif
@endsection