@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('createProduct.css') }}" />

@section('content')
<div class="addProduct">
    <div id="title">
        <p>Adicionar produto</p>
    </div>
    <div id="form">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="seller" value="{{ Auth::user()->id }}">
            <div id="name">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" placeholder="Nome do produto" value="{{old('name')}}" required>
            </div>
            <div id="description">
                <label for="description">Descrição</label>
                <input type="text" name="description" id="description" placeholder="Descrição do produto" value="{{old('description')}}" required>
            </div>
            <div id="price">
                <label for="price">Preço</label>
                <input type="text" name="price" id="price" placeholder="Preço do produto" value="{{old('price')}}" required>
            </div>
            <div id="image">
                <label for="image">Imagem</label>
                <input type="file" accept="image/*" name="image" id="image" required>
            </div>
            <div id="category">
                <label for="category">Categoria</label>
                <select name="category" id="category" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="buttons">
                <button type="submit" id="submit">Adicionar</button>
                <a id="cancel" href="{{ route('myProducts',Auth::user()) }}">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection