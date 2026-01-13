@extends('layout.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Registro</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('credito.update', $credito->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="client_id" class="form-label">Cliente</label>
                    <select name="client_id" id="client_id" class="form-select" required>
                        <option value="">-- Seleccionar Cliente --</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $credito->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $credito->fecha }}" required>
                </div>

                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de Movimiento</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="cargo" {{ $credito->tipo == 'cargo' ? 'selected' : '' }}>Cargo (Aumenta Deuda)</option>
                        <option value="abono" {{ $credito->tipo == 'abono' ? 'selected' : '' }}>Abono (Disminuye Deuda/Pago)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="glosa" class="form-label">Glosa / Descripción</label>
                    <input type="text" name="glosa" id="glosa" class="form-control" value="{{ $credito->glosa }}" required>
                </div>

                <div class="mb-3">
                    <label for="monto" class="form-label">Monto</label>
                    <input type="number" name="monto" id="monto" class="form-control" value="{{ $credito->monto }}" required min="0" step="0.01">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('credito.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection