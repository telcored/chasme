<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="telcored.cl" />
    <title>Acceso - CRM</title>

    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 Core -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />

    <!-- Custom Premium Login CSS -->
    <link href="{{ asset('css/login-premium.css') }}" rel="stylesheet" />
</head>

<body class="login-page">
    <!-- Decorative background blobs -->
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <div class="login-container">
        <div class="glass-card">
            <div class="brand-logo">
                <h1>Jaime Cornejo </h1>
            </div>

            <div class="login-header">
                <h2>Bienvenido</h2>
            </div>

            <!-- Pre-filled User Badge 
            <div class="user-badge">
                <i class="fas fa-user-circle fa-lg"></i>
                <span>soporte@telcored.cl</span>
            </div>-->

            @if(session('error'))
            <div class="error-message">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('authUser') }}" method="post" autocomplete="off">
                @csrf
                <!-- Hidden email field as requested -->
                <input type="hidden" name="email" value="{{ env('ADMIN_EMAIL', 'soporte@telcored.cl') }}">

                <div class="form-group">
                    <label for="password" class="form-label ms-1 mb-2 text-secondary small fw-bold">CONTRASEÑA</label>
                    <input class="form-control-custom" id="password" name="password" type="password" placeholder="••••••••" required autofocus />
                </div>

                <div class="mt-4">
                    <button class="btn-premium" type="submit">
                        Ingresar <i class="fas fa-arrow-right ms-2 small"></i>
                    </button>
                </div>
            </form>

            <div class="mt-4 text-center">
                <p class="text-secondary small mb-0">&copy; {{ date('Y') }} telcored.cl</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/login-premium.js') }}"></script>
</body>

</html>