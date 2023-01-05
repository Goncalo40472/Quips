@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/paymentSuccess.css') }}" />

@section('content')

<div id="success">
    <p id="title">Pagamento Efetuado com Sucesso!</p>
    <a id="receipt" class="btn btn-primary" href="{{route('receipt',$buy)}}">Gerar Fatura</a>
    <a id="back" class="btn btn-secondary" href="{{route('home')}}">Página Principal</a>
</div>

@endsection