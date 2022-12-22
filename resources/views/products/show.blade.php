@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('productPage.css') }}" />

@section('content')
<div id="product">
    <img src="{{ $product->image }}" alt="image" width="200px" height="200px">
    <div id="productInfo">
        <p id="name">{{ $product->name }}</p>
        <p id="price">{{ $product->price }}€</p>
        <a class="btn btn-primary" id="buy">Comprar já!</a>
        <a class="btn btn-primary" id="addCart">Adicionar ao carrinho</a>
        <div class="description">
            <p id="descriptionTitle">Descrição</p>
            <p id="description">{{ $product->description }}</p>
            <p id="category">Categoria: {{ $category->name }}</p>
            <p id="seller">Vendedor: {{ $seller->name }}</p>
        </div>
    </div>
</div>
@endsection