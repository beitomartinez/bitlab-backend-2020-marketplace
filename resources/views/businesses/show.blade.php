@extends('layouts.app')

@section('content')
<img src="{{ asset("storage/businesses/{$business->image}") }}" alt="{{ $business->name }}" class="mb-2 w-full max-w-sm">
<h1>{{ $business->name }}</h1>
<p class="mb-4">{{ $business->description }}</p>

<h2>Contacto</h2>
@if (!is_null($business->phone))
<p>Teléfono: <a href="tel:+503{{ preg_replace("/[^0-9]/", "", $business->phone) }}" class="link-basic">{{ $business->phone }}</a></p>
@endif
@if (!is_null($business->whatsapp))
<p>Whatsapp: <a href="https://wa.me/503{{ preg_replace("/[^0-9]/", "", $business->whatsapp) }}" class="link-basic">{{ $business->whatsapp }}</a></p>
@endif
@if (!is_null($business->email))
<p>Correo electrónico: <a href="mailto:{{ $business->email }}"> class="link-basic"{{ $business->email }}</a></p>
@endif
@if (!is_null($business->website))
<p>Sitio web: <a href="{{ $business->website }}" class="link-basic">{{ $business->website }}</a></p>
@endif

@endsection