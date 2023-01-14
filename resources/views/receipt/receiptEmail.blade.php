<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quips - Fatura de Compra</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div id="receipt">
        <p id="quips">Quips</p>
        <p id="title">Fatura de Compra</p>
        <p id="date">Data de emissão: {{ now()->toDateTimeString() }}</p>
        <p id="userName">Nome: {{ $name }}</p>
        <p id="price">Valor: {{ $total }}€</p>
    </div>
</body>
</html>

<style>

#receipt{
        background-color: #fff;
        padding: 0;
        margin: 0;
        position: relative;
        text-align: center;
    }
    
    #quips{
        font-size: 50px;
        color: dodgerblue;
        margin-bottom: 40px;
        margin-top: 10px;
        font-weight: bold;
    }
    
    #title{
        font-size: 25px;
        margin-bottom: 10px;
        font-weight: bold;
    }
    
    #date{
        font-size: 17px;
        margin-bottom: 40px;
    }
    
    #userName, #price{
        font-size: 20px;
        margin-bottom: 10px;
    }

</style>