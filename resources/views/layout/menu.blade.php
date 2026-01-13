<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark shadow-lg" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav mt-4">
                <div class="sb-sidenav-menu-heading px-4 small text-uppercase fw-bold opacity-50">CRM</div>

                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                @permission('clientes')
                <a class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-line"></i></div>
                    Clientes
                </a>
                @endpermission


                @permission('creditos')
                <a class="nav-link {{ request()->routeIs('credito.*') ? 'active' : '' }}" href="{{ route('credito.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                    Créditos
                </a>
                @endpermission


                @permission('tareas')
                <a class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check"></i></div>
                    Tareas
                </a>
                @endpermission

                <div class="sb-sidenav-menu-heading px-4 mt-3 small text-uppercase fw-bold opacity-50">Administración</div>

                @permission('configuracion')
                <a class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}" href="{{ route('settings.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                    Configuración
                </a>
                @endpermission

                @permission('usuarios')
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-gear"></i></div>
                    Usuarios
                </a>
                @endpermission

                @permission('permisos')
                <a class="nav-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}" href="{{ route('permissions.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-shield"></i></div>
                    Permisos
                </a>
                @endpermission

            </div>
        </div>
        <div class="sb-sidenav-footer bg-transparent border-top border-white border-opacity-10 p-3 mt-auto">
            <div class="small opacity-50">Sesión iniciada como:</div>
            <div class="fw-bold">{{ auth()->user()->name }}</div>
        </div>
    </nav>
</div>