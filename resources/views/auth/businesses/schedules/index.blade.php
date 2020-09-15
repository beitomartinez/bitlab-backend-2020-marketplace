@extends('layouts.app')

@section('content')
<div class="flex flex-row mb-4 items-center">
  <div class="flex-1">
    <h1>Horarios</h1>
    <p>{{ $business->name }}</p>
  </div>
  <div class="flex-none ml-2"><a href="{{ route('my-businesses.schedules.create', $business->id) }}" class="btn-main text-xl">Crear horario</a></div>
</div>

@if (count($business->schedules) == 0)
<p class="text-center text-gray-700">No hay horarios para este negocio aún.</p>
@else
<div class="overflow-hidden text-center">
  <div class="flex flex-col md:flex-row -mx-2">
    @foreach($business->schedules as $schedule)
    <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2">
      <a href="{{ route('my-businesses.schedules.show', [$business->id, $schedule->id]) }}" class="block rounded-lg overflow-hidden border p-2 link-basic">
        <p>{{ $schedule->name }}</p>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endif

@endsection