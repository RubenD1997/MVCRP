@extends('layouts.app') 

@section('content')
    <h1>Crear usuarios</h1>
    <form action="{{ BASE_URI }}/users/store" method="POST">
        <input type="hidden" name="_token" value="{{ $csrfToken }}">
        <label>Nombre:</label>
        <input type="text" name="name" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br><br>

        <button type="submit">Guardar</button>
    </form>
@endsection