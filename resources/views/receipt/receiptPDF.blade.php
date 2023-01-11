<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quips - Fatura de Compra</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ public_path('css/receipt.css') }}" rel="stylesheet">
</head>
<body>
    <div id="receipt">
        <p id="quips">Quips</p>
        <p id="title">Fatura de Compra</p>
        <p id="date">Data de emissão: {{ now()->toDateTimeString() }}</p>
        <p id="userName">Nome: {{ Auth::user()->name }}</p>
        <p id="price">Valor: {{ $buy->total }}€</p>
    </div>
</body>
</html>

