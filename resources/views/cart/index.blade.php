@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/cart.css') }}" />

@section('content')

<p id="title">Carrinho</p>

<div id="products">
    @if($cart->isEmpty())
    <p>Carrinho vazio</p>
    @else
        @foreach($cart as $item)
        <div id="product">
            <div id="details">
                <img src="{{ asset('storage/images/'.$item->product->image) }}" alt="image">
                <a id="name" href="{{ route('products.show',$item->product) }}">{{ $item->product->name }}</a>
                <p id="price">{{ $item->price }}€</p>
            </div>
            <div id="buttons">
                <form action="{{ route('cart.productQuantity',$item->product) }}" method="POST">   
                    @csrf
                    <input type="number" name="quantity" value="{{$item->quantity}}">
                    <button id="quantity" type="submit">Alterar quantidade</button>
                </form>
                <form action="{{ route('cart.removeProduct',$item->product->id) }}" method="POST">
                    @csrf
                    <button id="remove" type="submit">Remover</button>
                </form>
            </div>
        </div>
        @endforeach
        <form id="submitForm" action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button id="submit" type="submit">Finalizar compra</button>
        </form>
    @endif
</div>

@endsection