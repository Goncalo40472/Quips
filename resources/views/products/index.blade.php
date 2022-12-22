@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('userProducts.css') }}" />

@section('content')
<div class="container">
    @foreach($products as $product)
    @if($product->seller == Auth::user()->id)
    <div id="product">
        <img src="{{ $product->image }}" alt="image" width="200px" height="200px">
        <a id="name" href="{{ route('products.show',$product) }}">{{ $product->name }}</a>
        <p id="price">{{ $product->price }}€</p>
    </div>
    @endif
    @endforeach
</div>
@endsection