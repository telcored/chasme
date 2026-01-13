@extends('layout.admin')

@section('content')

<div class="animate-fade-in">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <h3 class="fw-bold mb-0">Clientes</h3>
        <div>
            <a href="{{ route('clients.create') }}" class="btn btn-primary shadow-sm"><i class="fas fa-plus me-2"></i> Nuevo</a>
            <a class="btn btn-outline-secondary shadow-sm ms-2" href="{{ route('clients.deleted') }}"><i class="fas fa-history me-2"></i> Historial</a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="glass-card mb-4 overflow-hidden">
        <div class="p-3 bg-light border-bottom d-flex justify-content-end gap-2">
            <a class="btn btn-success btn-sm" href="{{ route('clients.export') }}"><i class="fas fa-file-excel me-1"></i> Excel</a>
            <a class="btn btn-secondary btn-sm" href="{{ route('clients.form-import') }}"><i class="fas fa-file-import me-1"></i> Importar</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Nombre</th>
                        <th>Correo</th>
                        <th>Asignado a</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr class="align-middle">
                        <td class="ps-4">
                            <span class="fw-bold">{{ $client->name }}</span>
                        </td>
                        <td class="text-secondary small">{{ $client->email }}</td>
                        <td>
                            <span class="badge bg-light text-dark border"><i class="fas fa-user small me-1"></i> {{ $client->user->name }}</span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a class="btn btn-light btn-sm border" href="{{ route('clients.show', $client->id) }}" title="Ver detalles"><i class="fas fa-eye text-primary"></i></a>
                                <a class="btn btn-light btn-sm border" href="{{ route('clients.edit', $client->id) }}" title="Editar"><i class="fas fa-edit text-warning"></i></a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-light btn-sm border" type="submit" onclick="return confirm('¿Estás seguro?')" title="Eliminar"><i class="fas fa-trash text-danger"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">
        {!! $clients->links() !!}
    </div>
</div>

@endsection