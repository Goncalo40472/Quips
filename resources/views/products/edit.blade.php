@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/editProduct.css') }}" />

@section('content')
<div id="addProduct">
    <div id="productDetails">
        <p>Editar Produto</p>
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="seller" value="{{ Auth::user()->id }}">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" placeholder="Nome" value="{{$product->name}}" required>
            <label for="description">Descrição</label>
            <textarea name="description" id="description" placeholder="Descrição do produto" required>{{$product->description}}</textarea>
            <label for="price">Preço</label>
            <input type="text" name="price" id="price" placeholder="Preço do produto" value="{{$product->price}}" required>
            <label for="image">Imagem</label>
            <input type="file" accept="image/*" value="{{$product->image}}" name="image" id="image">
            <label for="category">Categoria</label>
            <select name="category" id="category" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div id="buttons">
                <button class="btn btn-primary" type="submit" id="submit">Adicionar</button>
                <a class="btn btn-danger" id="cancel" href="{{ route('myProducts',Auth::user()) }}">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection