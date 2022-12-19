@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{url('/categories')}}" method="post">
            @csrf {{-- <- Required for protection or the form is rejected --}} 
            Nome: <input type="text" name="name" value="{{old('name')}}"> 
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@endsection