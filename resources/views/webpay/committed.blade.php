@extends('layouts/app')

@section('content')

<div class="card card-outline-secondary">
    <div class="card-header">
        <h3 class="mb-0">Ejemplo Webpay Plus: Voucher</h3>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Estado:@if ($resp->getStatus() == 'AUTHORIZED') Transacción aprobada @else Transacción rechazada @endif </li>
        
        <li class="list-group-item">Monto: ${{ $resp->amount }}</li>
        <li class="list-group-item">Nº Orden de compra: {{ $resp->buyOrder }}</li>
        <li class="list-group-item">Tarjeta: *****{{ $resp->cardDetail["card_number"] }}</li>
        <li class="list-group-item">Fecha de Transacción: {{ date_format(date_create($resp->transactionDate),"d/m/Y H:i:s") }}</li>
    </ul>
    <div class="card-body">
        <a class="btn btn-success btn-lg float-right" href="/">Volver</a>
    </div>
</div>
@endsection