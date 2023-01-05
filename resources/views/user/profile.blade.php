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
        <form action="{{ route('profile.destroy',$user) }}" method="POST">
            @csrf
            <a class="btn btn-primary" id="edit" href="{{ route('profile.edit', $user) }}">Editar perfil</a>
            <button id="delete" type="submit" class="btn btn-danger">Apagar perfil</button>
        </form>
    </div>
    @endif
</div>
@endsection