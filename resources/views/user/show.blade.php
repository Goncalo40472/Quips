@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Informação do Utilizador </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>NIF:</strong>
                    {{ $user->nif }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nº de telemóvel:</strong>
                    {{ $user->cellphone }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipo de Utilizador:</strong>
                    @if($user->type == 0)
                        Administrador
                    @else
                        Utilizador
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url('/users') }}"> Voltar </a>
            </div>
        </div>
    </div>
</div>
@endsection