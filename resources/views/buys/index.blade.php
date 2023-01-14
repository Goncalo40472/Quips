@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/buys.css') }}" />

@section('content')

<p id="title">Minhas Compras</p>

{{($i = 1)}}

@foreach ($buys as $buy)

    <div id="buy">

        <a href="{{ route('buy',$buy) }}" id="buyNum">Compra nº{{$i++}}</a>
        <p id="date">Data: {{$buy->created_at}}</p>

    </div>

@endforeach

@endsection