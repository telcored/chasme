@extends('layout.admin')

@section('content')

<div class="animate-fade-in">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <h3 class="fw-bold mb-0">Créditos y Abonos</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('credito.create') }}" class="btn btn-primary shadow-sm"><i class="fas fa-plus me-1"></i> Registro</a>
            <a href="{{ route('clients.create') }}" class="btn btn-outline-primary shadow-sm"><i class="fas fa-user-plus me-1"></i> Cliente</a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="glass-card p-3 mb-4">
        <form action="{{ route('credito.index') }}" method="GET" class="row align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <select name="client_id" class="form-select border-start-0" onchange="this.form.submit()">
                        <option value="">-- Todos los Clientes --</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $clientId == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($clientId)
            <div class="col-md-2">
                <a href="{{ route('credito.index') }}" class="btn btn-link text-decoration-none">Limpiar filtros</a>
            </div>
            @endif
        </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Summary Box -->
    @if($clientId && !empty($summary))
    <div class="row mb-4 g-4">
        <div class="col-md-4">
            <div class="glass-card stat-card card-info h-100 p-4">
                <div class="stat-label">Total Cargos</div>
                <div class="stat-value text-primary">${{ number_format($summary['total_cargos'], 0, ',', '.') }}</div>
                <div class="stat-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card stat-card card-success h-100 p-4">
                <div class="stat-label">Total Abonos</div>
                <div class="stat-value text-success">${{ number_format($summary['total_abonos'], 0, ',', '.') }}</div>
                <div class="stat-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card stat-card {{ $summary['saldo'] > 0 ? 'card-danger' : 'card-success' }} h-100 p-4">
                <div class="stat-label">Saldo Pendiente</div>
                <div class="stat-value {{ $summary['saldo'] > 0 ? 'text-danger' : 'text-success' }}">${{ number_format($summary['saldo'], 0, ',', '.') }}</div>
                <div class="stat-icon"><i class="fa-solid fa-scale-balanced"></i></div>
            </div>
        </div>
    </div>
    @endif

    <div class="glass-card mb-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Fecha</th>
                        <th>Cliente</th>
                        <th>Glosa</th>
                        <th>Tipo</th>
                        <th class="text-end">Monto</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($creditos as $credito)
                    <tr class="align-middle">
                        <td class="ps-4 small text-secondary">
                            {{ \Carbon\Carbon::parse($credito->fecha)->format('d/m/Y') }}
                        </td>
                        <td class="fw-bold">{{ $credito->client->name }}</td>
                        <td class="small">{{ $credito->glosa }}</td>
                        <td>
                            @if($credito->tipo == 'cargo')
                            <span class="badge bg-soft-danger text-danger border border-danger border-opacity-25" style="background: rgba(239, 68, 68, 0.1);">Cargo</span>
                            @else
                            <span class="badge bg-soft-success text-success border border-success border-opacity-25" style="background: rgba(16, 185, 129, 0.1);">Abono</span>
                            @endif
                        </td>
                        <td class="text-end fw-bold {{ $credito->tipo == 'cargo' ? 'text-danger' : 'text-success' }}">
                            ${{ number_format($credito->monto, 0, ',', '.') }}
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="{{ route('credito.edit', $credito->id) }}" class="btn btn-light btn-sm border" title="Editar"><i class="fas fa-edit text-warning"></i></a>
                                <form action="{{ route('credito.destroy', $credito->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light btn-sm border" onclick="return confirm('¿Eliminar este registro?')" title="Eliminar"><i class="fas fa-trash text-danger"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                            <p>No se encontraron registros para este criterio.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">
        {{ $creditos->appends(['client_id' => $clientId])->links() }}
    </div>
</div>

@endsection