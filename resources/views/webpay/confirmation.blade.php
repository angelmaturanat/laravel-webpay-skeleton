@extends('layouts/app')

@section('content')
<div class="card card-outline-secondary">
    <div class="card-header">
        <h3 class="mb-0">Ejemplo Webpay Plus: Confirmación</h3>
    </div>
    <div class="card-body">
        <form method="get" action={{  $response->getUrl() }}>
            <div class="form-group">
                <label for="session_id">
                    Token de compra:
                </label>
                <input name="token_ws" class="form-control" value={{ $response->getToken() }} readonly/>
            </div>
        
            <button type="submit" class="btn btn-success btn-lg float-right">Enviar datos</button>
        </form>
    </div>
</div>
@endsection
