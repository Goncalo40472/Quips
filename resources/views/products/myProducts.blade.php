@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/userProducts.css') }}" />

@section('content')
<div class="container">
    @if($products->isEmpty())
        <p id="empty">Não tens produtos para vender</p>
    @else
        <p id="title">Meus produtos</p>
        @foreach($products as $product)
            <div id="product">
                <div id="details">
                    <img src="{{ asset('storage/images/'.$product->image) }}" alt="image">
                    <a id="name" href="{{ route('products.show',$product) }}">{{ $product->name }}</a>
                    <p id="price">{{ $product->price }}€</p>
                    <p id="stock">Stock: {{ $product->stock }}</p>
                </div>
                <div id="buttons">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <a id="edit" href="{{ route('products.edit',$product) }}">Editar</a>
                    <form action="{{ route('products.destroy',$product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="user" value="{{Auth::user()->id}}">
                        <button type="submit" id="delete">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection