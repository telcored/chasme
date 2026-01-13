@extends('layout.admin')

@section('content')

<div class="animate-fade-in">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
        <h2 class="mb-0 fw-bold">Dashboard</h2>
        <div class="text-secondary small">{{ date('d M, Y') }}</div>
    </div>

    <div class="row g-4">
        <div class="col-xl-4 col-md-6">
            <div class="glass-card stat-card card-success h-100 p-4">
                <div class="stat-label">Total de Clientes</div>
                <div class="stat-value text-success">{{ $clients->count() }}</div>
                <div class="mt-2 text-muted small">
                    <a href="{{ route('clients.index') }}" class="text-decoration-none">Ver todos <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
                <div class="stat-icon"><i class="fa-solid fa-users-line"></i></div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="glass-card stat-card card-info h-100 p-4">
                <div class="stat-label">Tareas Pendientes</div>
                <div class="stat-value text-primary">{{ $tasksPendings->count() }}</div>
                <div class="mt-2 text-muted small">
                    <a href="{{ route('tasks.index') }}" class="text-decoration-none text-primary">Gestionar <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
                <div class="stat-icon"><i class="fa-solid fa-list-check"></i></div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="glass-card stat-card card-pending h-100 p-4">
                <div class="stat-label">Seguimientos (Hoy)</div>
                <div class="stat-value text-warning">{{ $follows->count() }}</div>
                <div class="mt-2 text-muted small">
                    <a href="{{ route('clients.index') }}" class="text-decoration-none text-warning">Ver agenda <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
                <div class="stat-icon"><i class="fa-solid fa-calendar-day"></i></div>
            </div>
        </div>
    </div>

    <div class="row mt-4 g-4">
        <div class="col-lg-7">
            <div class="glass-card p-4 h-100">
                <h5 class="fw-bold mb-4">Estado de Tareas</h5>
                <div class="chart-container">
                    <canvas id="myBarChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="glass-card p-4 h-100">
                <h5 class="fw-bold mb-4">Acciones Rápidas</h5>
                <div class="d-grid gap-3">
                    <a href="{{ route('clients.create') }}" class="btn btn-primary d-flex align-items-center justify-content-between">
                        Nuevo Cliente <i class="fas fa-plus"></i>
                    </a>
                    <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary d-flex align-items-center justify-content-between">
                        Nueva Tarea <i class="fas fa-check"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js" type="text/javascript"></script>

<script>
    // Ejemplo de gráfico de barras
    const ctx = document.getElementById('myBarChart').getContext('2d');
    const myBarChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pendientes', 'Completadas', 'En proceso'],
            datasets: [{
                label: 'Tareas',
                data: ['{{ $tasksPendings->count() }}', '{{ $tasksCompleted->count() }}', '{{ $tasksInProgress->count() }}'],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 5
            }]
        }
    });
</script>

@endpush