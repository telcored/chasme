@extends('layout.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detalle de Registro</h1>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Fecha:</div>
                <div class="col-md-9">{{ \Carbon\Carbon::parse($credito->fecha)->format('d-m-Y') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Cliente:</div>
                <div class="col-md-9">{{ $credito->client->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Tipo:</div>
                <div class="col-md-9">
                    @if($credito->tipo == 'cargo')
                    <span class="badge bg-danger">Cargo</span>
                    @else
                    <span class="badge bg-success">Abono</span>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Glosa:</div>
                <div class="col-md-9">{{ $credito->glosa }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Monto:</div>
                <div class="col-md-9 h4">${{ number_format($credito->monto, 0, ',', '.') }}</div>
            </div>

            <div class="mt-4">
                <a href="{{ route('credito.edit', $credito->id) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('credito.index', ['client_id' => $credito->client_id]) }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection