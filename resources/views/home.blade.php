@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/homePage.css') }}" />

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($categories as $category)
                <div class="card" id="categories">
                    <div class="card-header">{{ $category->name }}</div>
                    <div class="card-body">
                        <div id="products">
                            @foreach ($products[$category->id] as $product)
                                <div id="product">
                                    <img src="{{ asset('storage/images/'.$product->image) }}" alt="image" width="100px" height="100px">
                                    <a id="name" href="{{ route('products.show',$product) }}">{{ $product->name }}</a>
                                    <p id="price">{{ $product->price }}€</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> 
</div>
@endsection
