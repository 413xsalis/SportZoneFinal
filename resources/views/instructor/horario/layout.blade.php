<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Enlaza la hoja de estilos principal de Bootstrap 5. --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Enlaza la biblioteca de iconos de Bootstrap, que se usa para los iconos visuales. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Enlaza un archivo CSS local que contiene estilos personalizados. --}}
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <title>@yield('title', 'SportZone')</title>
</head>
<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #6f42c1;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
        --warning-color: #f6c23e;
        --light-bg: #f8f9fc;
    }


    .loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
</head>

<body class="app sidebar-mini">
    @include('instructor.inicio.partials.header')

    @hasSection('page-header')
        <div class="page-header bg-white border-bottom">
            <div
                class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3">
                <div>
                    @hasSection('page-title')
                        <h1 class="h4 mb-1">@yield('page-title')</h1>
                    @endif
                    @hasSection('page-subtitle')
                        <p class="text-muted mb-0">@yield('page-subtitle')</p>
                    @endif
                </div>
                @hasSection('breadcrumb')
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                @endif
            </div>
        </div>
    @endif
    <div class="app-content">
        @yield('content')
    </div>

    <div class="loader-wrapper" id="loader" style="display: none;">
        <div class="loader"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mostrar loader solo para enlaces que navegan a otras páginas
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('a').forEach(link => {
            if (link.hasAttribute('data-toggle') ||
                link.hasAttribute('data-bs-toggle') ||
                link.getAttribute('href') === '#' ||
                link.getAttribute('href') === '' ||
                link.classList.contains('no-loader')) {
                return;
            }

            link.addEventListener('click', function () {
                document.getElementById('loader').style.display = 'flex';
            });
        });
    });

    // Ocultar loader cuando la página termine de cargar
    window.addEventListener('load', function () {
        document.getElementById('loader').style.display = 'none';
    });

    // Solución: también ocultar loader al volver con el botón "atrás"
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            document.getElementById('loader').style.display = 'none';
        }
    });
</script>

    @include('instructor.horario.partials.footer')
</body>

</html>