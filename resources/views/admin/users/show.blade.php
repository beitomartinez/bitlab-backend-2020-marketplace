@extends('layouts.admin')

@section('content')
<h1 class="mb-4">{{ $user->name }}</h1>

@if (is_null($user->deleted_at))
<form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="border rounded mb-8 p-4" onsubmit="return confirm('¿Estás seguro que quieres desactivar el usuario?');">
  @csrf
  @method('DELETE')
  <h2>Desactivar usuario</h2>
  <p class="mb-2">Puedes eliminar un usuario. Luego, puedes reactivarlo cuando desees.</p>
  <button class="btn-delete">Eliminar</button>
</form>
@else
<form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="border rounded mb-8 p-4" onsubmit="return confirm('¿Estás seguro que quieres reactivar el usuario?');">
  @csrf
  <h2>Reactivar usuario</h2>
  <button class="btn-main">Reactivar</button>
</form>
@endif

@endsection