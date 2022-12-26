@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/createProduct.css') }}" />

@section('content')
<div class="addProduct">
    <div id="title">
        <p>Adicionar produto</p>
    </div>
    <div id="form">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="seller" value="{{ Auth::user()->id }}">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" placeholder="Nome do produto" value="{{old('name')}}" required>
            <label for="description">Descrição</label>
            <textarea name="description" id="description" placeholder="Descrição do produto" value="{{old('description')}}" required></textarea>
            <label for="price">Preço</label>
            <input type="text" name="price" id="price" placeholder="Preço do produto" value="{{old('price')}}" required>
            <label for="image">Imagem</label>
            <input type="file" accept="image/*" name="image" id="image" required>
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