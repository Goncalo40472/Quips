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
            @forelse($categories as $category)
            <li class="list-group-item">
                <h5>{{$category->id}} - {{$category->name}}</h5>
                <form action="{{ url('categories/destroy/'.$category->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Apagar</button>
                </form>
            </li>
        
            @empty
            <h5 class="text-center">Não foram encontradas categorias!</h5>
            @endforelse
        </ul>
        {!! $categories->links('pagination::bootstrap-4') !!}
    </div>
</div>

@endsection