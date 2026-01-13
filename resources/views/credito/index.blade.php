@extends('layout.admin')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Créditos y Abonos</h1>
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('credito.create') }}" class="btn btn-primary">Nuevo Registro</a>
            <a href="{{ route('clients.create') }}" class="btn btn-warning">Nuevo Cliente</a>
        </div>
        <div class="col-md-6 text-end">
            <!-- Filter Form -->
            <form action="{{ route('credito.index') }}" method="GET" class="d-flex justify-content-end">
                <select name="client_id" class="form-select me-2" onchange="this.form.submit()" style="max-width: 300px;">
                    <option value="">-- Todos los Clientes --</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $clientId == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                    @endforeach
                </select>
                @if($clientId)
                <a href="{{ route('credito.index') }}" class="btn btn-secondary">Limpiar</a>
                @endif
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Summary Box -->
    @if($clientId && !empty($summary))
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Cargos (Deuda Total)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="h4">${{ number_format($summary['total_cargos'], 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total Abonos (Pagado)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="h4">${{ number_format($summary['total_abonos'], 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card {{ $summary['saldo'] > 0 ? 'bg-danger' : 'bg-secondary' }} text-white mb-4">
                <div class="card-body">Saldo Pendiente (Deuda Actual)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="h4">${{ number_format($summary['saldo'], 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Registros
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Glosa</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($creditos as $credito)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($credito->fecha)->format('d-m-Y') }}</td>
                        <td>{{ $credito->client->name }}</td>
                        <td>{{ $credito->glosa }}</td>
                        <td>
                            @if($credito->tipo == 'cargo')
                            <span class="badge bg-danger">Cargo</span>
                            @else
                            <span class="badge bg-success">Abono</span>
                            @endif
                        </td>
                        <td class="text-end">${{ number_format($credito->monto, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('credito.edit', $credito->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('credito.destroy', $credito->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay registros encontrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $creditos->appends(['client_id' => $clientId])->links() }}
        </div>
    </div>
</div>

@endsection