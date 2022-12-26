@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/editProfile.css') }}" />

@section('content')
<div id="editProfile">
    <div id="profileDetails">
        <p>Editar perfil</p>
        <form action="{{ route('profile.update', $user) }}" method="POST">
            @csrf
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" />
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="{{ $user->email }}" />
            <label for="cellphone">Número de telemóvel:</label>
            <input type="text" name="cellphone" id="cellphone" value="{{ $user->cellphone }}" />
            <label for="nif">NIF:</label>
            <input type="text" name="nif" id="nif" value="{{ $user->nif }}" />
            <div id="buttons">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="{{ route('profile', $user) }}">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection