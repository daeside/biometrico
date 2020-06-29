@extends('Shared.menu')
@section('contentMain')

<div class="container-fluid">
<div class="text-center">
  <div class="error mx-auto" data-text="404">404</div>
  <p class="lead text-gray-800 mb-5">Página no encontrada</p>
  <p class="text-gray-500 mb-0">No se encontro el contenido que buscaba</p>
  <a href="{{ url('/Escritorio') }}">&larr; Ir al inicio</a>
</div>
</div>

@endsection