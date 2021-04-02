@extends('layouts/app')

@section('content')
<div class="card card-outline-secondary">
    <div class="card-header">
        <h3 class="mb-0">Ejemplo Webpay Plus</h3>
    </div>
    <div class="card-body">
        <form class="form" role="form" autocomplete="off" novalidate="" action="webpay/plus/init" method="POST">
            @csrf
            <div class="form-group">
                <label for="buy_order">
                    Orden de compra
                </label>
                <input id="buy_order" name="buy_order" class="form-control" value="{{ $params['buy_order'] }}" readonly/>
            </div>

            <div class="form-group">
                <label for="session_id">
                    Id de sesión
                </label>
                <input id="session_id" name="session_id" class="form-control" value="{{ $params['session_id'] }}" readonly/>
            </div>

            <div class="form-group">
                <label for="amount">
                    Monto
                </label>
                <input id="amount" name="amount" class="form-control" value="1000"/>
            </div>

            <div class="form-group">
                <label for="return_url">
                    URL de retorno
                </label>
                <input id="return_url" name="return_url" class="form-control" value="{{ $params['return_url'] }}" readonly/>
            </div>

            <button type="submit" class="btn btn-success btn-lg float-right">Pagar</button>
        </form>
    </div>
@endsection
