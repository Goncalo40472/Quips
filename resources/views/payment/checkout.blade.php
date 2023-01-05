@extends('layouts.app')

@section('content')

    <div class="row">
        <aside class="col-sm-6 offset-3">
            <article class="card">
                <div class="card-body p-5">
                    <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill">
                            <i class="fa fa-credit-card"></i> Efetuar Pagamento</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-tab-card">
                            @foreach (['danger', 'success'] as $status)
                                @if(Session::has($status))
                                    <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                                @endif
                            @endforeach
                            <form role="form" method="POST" id="paymentForm" action="{{ route('payment.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Nome</label>
                                    <input type="text" class="form-control" name="fullName" placeholder="Nome" required>
                                </div>
                                <div class="form-group">
                                    <label for="cardNumber">Número do Cartão</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cardNumber" placeholder="Número do cartão" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label><span class="hidden-xs">Data de Expiração</span> </label>
                                            <div class="input-group">
                                                <select class="form-control" name="month" required>
                                                    <option value="">Mês</option>
                                                    @foreach(range(1, 12) as $month)
                                                        <option value="{{$month}}">{{$month}}</option>
                                                    @endforeach
                                                </select>
                                                <select class="form-control" name="year" required>
                                                    <option value="">Ano</option>
                                                    @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                        <option value="{{$year}}">{{$year}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" title=""
                                                data-original-title="3 digits code on back side of the card">CVV <i
                                                class="fa fa-question-circle"></i></label>
                                            <input type="number" class="form-control" placeholder="CVV" name="cvv" minlength="3" maxlength="3" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="price" value="{{ $price }}">
                                <button class="subscribe btn btn-primary btn-block" type="submit"> Pagar ({{ $price }}€) </button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </aside>
    </div>
@endsection