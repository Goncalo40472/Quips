@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <ul class="list-group">
            @forelse($products as $product)
            <li class="list-group-item">
                <h5>{{$product->id}} - {{$product->name}}</h5>
            </li>
        
            @empty
            <h5 class="text-center">Não foram encontradas categorias!</h5>
            @endforelse
        </ul>
        {!! $products->links('pagination::bootstrap-4') !!}
    </div>
</div>

@endsection