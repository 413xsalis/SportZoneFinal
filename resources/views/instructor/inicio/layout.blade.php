<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Assets locales -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <title>@yield('title', 'SportZone')</title>
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
    {{-- Incluye otro archivo de Blade (un "partial") que contiene el código del encabezado o header. --}}
    @include('instructor.inicio.partials.header')

    {{-- @hasSection es una directiva de Blade que comprueba si la página hija (la que usa este layout) ha definido una
    sección llamada 'page-header'. Si es así, se renderiza todo el contenido de este bloque. --}}
    @hasSection('page-header')
        <div class="page-header bg-white border-bottom">
            <div
                class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3">
                <div>
                    {{-- Si existe la sección 'page-title', la muestra. --}}
                    @hasSection('page-title')
                        <h1 class="h4 mb-1">@yield('page-title')</h1>
                    @endif
                    {{-- Si existe la sección 'page-subtitle', la muestra. --}}
                    @hasSection('page-subtitle')
                        <p class="text-muted mb-0">@yield('page-subtitle')</p>
                    @endif
                </div>
                {{-- Si existe la sección 'breadcrumb', la muestra dentro de una barra de navegación. --}}
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
        {{-- Aquí se inserta el contenido principal de cada página que use este layout. Es la sección 'content' que
        vimos en el archivo anterior. --}}
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
                // Excluir enlaces que no deben activar el loader
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
    </script>
    {{-- Incluye otro archivo "partial" que contiene el código del pie de página. --}}
    @include('instructor.inicio.partials.footer')
</body>

</html>