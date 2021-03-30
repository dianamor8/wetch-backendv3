@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Tipos de área disponibles ({{count($tiposAreaVivienda)}})</h2>
    @foreach ($tiposAreaVivienda as $tipo)
        <p>{{$tipo->nombre}}</p>
    @endforeach
</div>
@endsection