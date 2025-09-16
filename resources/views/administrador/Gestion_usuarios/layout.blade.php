<!DOCTYPE html>
<html lang="es">
<head>
    <!-- CONFIGURACIÓN BÁSICA DEL DOCUMENTO -->
    <meta charset="utf-8">
    <!-- ETIQUETA META VIEWPORT PARA RESPONSIVIDAD -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- IMPORTACIÓN DE RECURSOS EXTERNOS -->
    <!-- Bootstrap CSS - Framework de estilos principal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons - Librería de iconos oficial de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome Icons - Amplia librería de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Hoja de estilos local personalizada -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    
    <!-- TÍTULO DINÁMICO CON VALOR POR DEFECTO -->
    <title>@yield('title', 'SportZone')</title>
    
    <style>
        /* SISTEMA DE VARIABLES CSS PARA MANTENER CONSISTENCIA EN LOS COLORES */
        :root {
            --primary-color: #4e73df;       /* Color primario azul */
            --secondary-color: #6f42c1;     /* Color secundario púrpura */
            --success-color: #1cc88a;       /* Color para operaciones exitosas */
            --danger-color: #e74a3b;        /* Color para operaciones peligrosas/errores */
            --warning-color: #f6c23e;       /* Color para advertencias */
            --light-bg: #f8f9fc;            /* Color de fondo claro */
        }
        
        /* ESTILOS GENERALES DEL BODY */
        body {
            background-color: var(--light-bg);  /* Usa variable CSS para el fondo */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente moderna */
            color: #333; /* Color de texto principal */
        }
        
        /* LOADER/PANTALLA DE CARGA GLOBAL */
        .loader-wrapper {
            position: fixed; /* Posición fija para cubrir toda la pantalla */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5); /* Fondo semitransparente oscuro */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Asegura que esté por encima de todo */
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db; /* Color azul para la animación */
            border-radius: 50%; /* Forma circular */
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite; /* Animación continua de rotación */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* ESTILOS ESPECÍFICOS PARA GESTIÓN DE USUARIOS */
        
        /* Título de la aplicación con gradiente y sombra */
        .app-title {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        /* Tarjetas con estilo moderno (sin borde, con sombra) */
        .card {
            border: none; /* Elimina el borde por defecto de Bootstrap */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15); /* Sombra suave */
            margin-bottom: 1.5rem; /* Espaciado inferior */
        }
        
        /* Tarjetas de estadísticas con gradientes de color */
        .stats-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            color: white; /* Texto blanco para contrastar con fondos oscuros */
        }
        
        /* Variantes de colores para las tarjetas de estadísticas */
        .stats-card-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        
        .stats-card-danger {
            background: linear-gradient(135deg, var(--danger-color), #fd7e14);
        }
        
        .stats-card-success {
            background: linear-gradient(135deg, var(--success-color), #20c9a2);
        }
        
        /* Badges para mostrar roles de usuario */
        .role-badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
            color: white;
            margin-right: 0.3rem;
            margin-bottom: 0.3rem;
        }
        
        /* Colores específicos para cada tipo de rol */
        .role-admin {
            background-color: var(--primary-color); /* Azul para administradores */
        }
        
        .role-colab {
            background-color: var(--secondary-color); /* Púrpura para colaboradores */
        }
        
        .role-user {
            background-color: var(--success-color); /* Verde para usuarios regulares */
        }
        
        .role-other {
            background-color: #6c757d; /* Gris para otros roles */
        }
    </style>
</head>

<body class="app sidebar-mini">
    <!-- INCLUSIÓN DEL ENCABEZADO ESPECÍFICO PARA GESTIÓN DE USUARIOS -->
    @include('administrador.admin.partials.header')
    
    <!-- CONTENEDOR PRINCIPAL DEL CONTENIDO -->
    <div class="app-content">
        @yield('content') <!-- Sección dinámica que será reemplazada por el contenido específico -->
    </div>

    <!-- LOADER/PANTALLA DE CARGA (oculto inicialmente) -->
    <div class="loader-wrapper" id="loader" style="display: none;">
        <div class="loader"></div>
    </div>

    <!-- SCRIPTS DE BOOTSTRAP Y FUNCIONALIDAD PERSONALIZADA -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // CONTROLADOR DEL LOADER/PANTALLA DE CARGA
    document.addEventListener('DOMContentLoaded', function() {
        // Añade evento click a todos los enlaces
        document.querySelectorAll('a').forEach(link => {
            // Excluye enlaces que no deben activar el loader:
            // - Enlaces con atributos data-toggle (dropdowns, modales, etc.)
            // - Enlaces vacíos o con # (javascript:void(0))
            // - Enlaces con la clase no-loader
            if (link.hasAttribute('data-toggle') || 
                link.hasAttribute('data-bs-toggle') || 
                link.getAttribute('href') === '#' ||
                link.getAttribute('href') === '' ||
                link.classList.contains('no-loader')) {
                return;
            }
            
            // Muestra el loader al hacer clic en un enlace válido
            link.addEventListener('click', function() {
                document.getElementById('loader').style.display = 'flex';
            });
        });
    });

    // Oculta el loader cuando la página termina de cargar completamente
    window.addEventListener('load', function() {
        document.getElementById('loader').style.display = 'none';
    });
    </script>

    <!-- INCLUSIÓN DEL PIE DE PÁGINA ESPECÍFICO PARA GESTIÓN DE USUARIOS -->
    @include('administrador.Gestion_usuarios.partials.footer')
</body>
</html>