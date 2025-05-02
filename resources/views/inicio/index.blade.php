@extends('layouts.app') 

@section('content')
    <h1>Bienvenido a la página de inicio</h1>
    <ul>
        @foreach($usuarios as $usuario)
            <li>{{ $usuario->name }}</li>
        @endforeach
    </ul>
@endsection
