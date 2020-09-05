@extends('layouts.admin')

@section('content')
<h1 class="mb-4">Usuarios</h1>

<div class="overflow-hidden">
  <div class="flex flex-col md:flex-row -mx-2">
    <div class="w-full md:w-1/3 px-2 mb-2">
      <form action="{{ route('admin.users.index') }}" method="GET" class="border rounded p-2">
        <h2>Buscar</h2>

        <div class="mb-2">
          <p class="mb-1"><label for="name" class="form-label">Nombre</label></p>
          <input name="name" id="name" type="text" class="form-input" placeholder="Juan Pérez" value="{{ request()->name }}"">
        </div>
        <div class="mb-2">
          <p class="mb-1"><label for="email" class="form-label">Correo electrónico</label></p>
          <input name="email" id="email" type="text" class="form-input" placeholder="juan@perez.com" value="{{ request()->email }}"">
        </div>
        <div class="mb-2">
          <p class="mb-1"><label for="is_admin" class="form-label">Rol</label></p>
          <select name="is_admin" id="is_admin" class="form-input">
            <option value="0" {{ request()->is_admin == 0 ? 'selected' : '' }}>Usuario normal</option>
            <option value="1" {{ request()->is_admin == 1 ? 'selected' : '' }}>Administrador</option>
          </select>
        </div>
        <div class="mb-2">
          <p class="mb-1"><label for="is_active" class="form-label">Estado</label></p>
          <select name="is_active" id="is_active" class="form-input">
            <option value="1" {{ request()->is_active == 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ request()->is_active == 0 ? 'selected' : '' }}>Desactivado</option>
          </select>
        </div>

        <p class="text-center mb-2"><button class="btn-main">Buscar</button></p>
        <p class="text-center mb-2"><a href="{{ route('admin.users.index') }}" class="link-basic">Limpiar</a></p>
      </form>
    </div>
    <div class="w-full md:w-2/3 px-2 mb-2">
      @if (count($users) == 0)
      <p>No encontramos resultados. Intenta con otros parámetros de búsqueda.</p>
      @else
        <table class="table-bordered w-full">
          <tr>
            <th class="text-left">Nombre</th>
            <th class="text-left">Correo electrónico</th>
            <th class="text-left">Negocios</th>
            <th class="text-left">¿Activo?</th>
            <th class="text-left">Administrador?</th>
          </tr>
          @foreach ($users as $user)
          <tr>
            @if (auth()->id() == $user->id)
            <td>{{ $user->name }}</td>
            @else
            <td><a href="{{ route('admin.users.show', $user->id) }}" class="link-basic">{{ $user->name }}</a></td>
            @endif
            <td>{{ $user->email }}</td>
            <td>{{ $user->businesses_count }}</td>
            <td>{{ is_null($user->deleted_at) ? 'Sí' : 'No' }}</td>
            <td>{{ $user->is_admin ? 'Sí' : 'No' }}</td>
          </tr>
          @endforeach
        </table>
      @endif
    </div>
  </div>
</div>

@endsection