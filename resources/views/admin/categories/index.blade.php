@extends('layouts.admin')

@section('content')
<h1>Categorías</h1>

@if (count($categories) == 0)
<p>No hay categorías aún</p>
@else
  <table class="table-bordered w-full">
    @foreach ($categories as $category)
    <tr>
      <td><a href="{{ route('admin.categories.show', $category->id) }}" clas="link-basic">{{ $category->name }}</a></td>
      <td>{{ $category->businesses_count }}</td>
    </tr>
    @endforeach
  </table>
@endif
@endsection