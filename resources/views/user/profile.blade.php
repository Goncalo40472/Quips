@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/profile.css') }}" />

@section('content')
<div id="profile">
    <div id="profileDetails">
        <h1>Perfil</h1>
        <p id="name">Nome: {{ $user->name }}</p>
        <p id="email">Email: {{ $user->email }}</p>
        <p id="phone">Número de telemóvel: {{ $user->cellphone }}</p>
        <p id="nif">NIF: {{ $user->nif }}</p>
    </div>
    @if($user->id == Auth::user()->id)
    <div id="editProfile">
        <a class="btn btn-primary" id="edit" href="{{ route('profile.edit', $user) }}">Editar perfil</a>
        <a class="btn btn-danger" id="cancel" href="{{ route('profile.destroy', $user) }}">Eliminar perfil</a>
    </div>
    @endif
</div>
@endsection