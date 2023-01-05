@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/searchedProducts.css') }}" />

@section('content')
<div class="container">
    @if($products->isEmpty())
        <p id="empty">Não foi possível encontrar nenhum produto!</p>
    @else
        <div id="order">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Ordenar por
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('search',['order'=>'priceAsc','search'=>$search]) }}">Preço ascendente</a>
                    <a class="dropdown-item" href="{{ route('search',['order'=>'priceDesc','search'=>$search]) }}">Preço descendente</a>
                    <a class="dropdown-item" href="{{ route('search',['order'=>'name','search'=>$search]) }}">Nome</a>
                    <a class="dropdown-item" href="{{ route('search',['order'=>'dateAsc','search'=>$search]) }}">Mais recentes</a>
                    <a class="dropdown-item" href="{{ route('search',['order'=>'dateDesc','search'=>$search]) }}">Mais antigos</a>
                </div>
        </div>
        <div id="products">
            @foreach($products as $product)
            <div id="product">
                <img src="{{ asset('storage/images/'.$product->image) }}" alt="image" width="200px" height="200px">
                <a id="name" href="{{ route('products.show',$product) }}">{{ $product->name }}</a>
                <p id="price">{{ $product->price }}€</p>
            </div>
            @endforeach
        </div>
    @endif
    {!! $products->appends($_GET)->links('pagination::bootstrap-4') !!}
</div>
@endsection