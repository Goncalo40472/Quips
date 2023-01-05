@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/productPage.css') }}" />

@section('content')
<div id="product">
    <img src="{{ asset('storage/images/'.$product->image) }}" alt="image">
    <div id="productInfo">
        <p id="name">{{ $product->name }}</p>
        <p id="price">{{ $product->price }} €</p>
        <form id="quantity" action="{{ route('cart.addProduct',$product) }}" method="POST">
            @csrf
            <a class="btn btn-primary" id="buy" href="{{ route('checkout',$product) }}">Comprar já!</a>
            <button class="btn btn-primary" id="addCart" type="submit" class="btn btn-primary">Adicionar ao carrinho</button>
            <label for="quantity">Quantidade</label>
            <input type="number" name="quantity" value="1">
        </form>
        <div class="description">
            <p id="descriptionTitle">Descrição</p>
            <p id="description">{{ $product->description }}</p>
            <p id="category">Categoria: {{ $category->name }}</p>
            <p id="seller">Vendedor: {{ $seller->name }}</p>
        </div>
        <div class="reviews">
            <p id="reviewsTitle">Reviews</p>
            @if(!$reviews->isEmpty())
                @foreach($reviews as $review)
                    <div class="review">
                        <p id="reviewUser"> {{ $users->find($review->user_id)->name }} </p>
                        <p id="reviewTitle">{{ $review->title }}</p>
                        <p id="reviewDescription">{{ $review->comment }}</p>
                        <p id="reviewRating">Rating: {{ $review->rating }}/5</p>
                    </div>
                @endforeach
            @endif
            <form id="newReview" action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <p id="newReviewHeader">Deixe uma review do produto:</p>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="text" id="newReviewTitle" name="title" placeholder="Título">
                <textarea id="newReviewComment" name="comment" placeholder="Comentário"></textarea>
                <label id="newRatingLabel">Rating</label>
                <select name="rating" id="newReviewRating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button type="submit" id="newReviewSubmit">Submeter</button>
            </form>
        </div>
    </div>
</div>
@endsection