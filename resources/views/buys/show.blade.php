@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ url('css/buyDetails.css') }}" />

@section('content')

<p id="title">Detalhes de compra</p>

<div id="products">

    {{ $count = 1 }}

    @foreach ($productsBuy as $productBuy)

        @for ($i = 0; $i < count($products); $i++)

            @foreach ($products[$i] as $product)

                @if ($productBuy->product_id == $product->id)

                    <div id="product">

                        <p id="num">Produto nº{{$count++}}</p>

                        <div id="details">

                            <img src="{{ url('storage/images/'.$product->image) }}" alt="Imagem do produto" id="image" />
                            <p id="name">{{$product->name}}</p>
                            <p id="price">Preço: {{$product->price}}</p>
                            <p id="quantity">Quantidade: {{$productBuy->quantity}}</p>

                        </div>

                    </div>

                @endif

            @endforeach

        @endfor

    @endforeach

</div>

<div id="finalDetails">

    <p id="total">Total: {{$buy->total}}</p>
    <a id="receipt" class="btn btn-primary" href="{{route('receipt',$buy)}}">Gerar Fatura (PDF)</a>
    <p id="date">Data: {{$buy->created_at}}</p>

</div>

@endsection