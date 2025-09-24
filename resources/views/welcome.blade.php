<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="JARD Developers - Soluciones tecnológicas y desarrollo de software">
    <title>JARD Developers - Tecnología y Desarrollo</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    
    <!-- Estilos personalizados -->
    <style>
        :root {
            --verde: #0c443a;
            --limon: #25d1b2;
            --degradado: linear-gradient(135deg, var(--limon), var(--verde));
            --degradado-hover: linear-gradient(135deg, #2ee6c4, #0e5a4d);
            --sombra: 0 10px 30px rgba(0, 0, 0, 0.1);
            --sombra-hover: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .bg-custom-gradient {
            background: var(--degradado);
        }

        .text-custom-green {
            color: var(--verde);
        }

        .text-custom-limon {
            color: var(--limon);
        }

        .btn-custom {
            background: var(--degradado);
            color: white;
            border: none;
            box-shadow: var(--sombra);
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 50px;
        }

        .btn-custom:hover {
            background: var(--degradado-hover);
            transform: translateY(-3px);
            box-shadow: var(--sombra-hover);
            color: white;
        }

        .heading {
            background: var(--verde);
            color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
        }

        .heading::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 70px;
            height: 4px;
            background: var(--degradado);
            border-radius: 2px;
        }

        .heading-center::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .navbar {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 1rem 0;
        }

        .navbar-scrolled {
            padding: 0.5rem 0;
            background-color: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
        }

        .nav-link {
            position: relative;
            font-weight: 500;
            margin: 0 0.5rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--degradado);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .float-animation {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        section {
            padding: 6rem 0;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: var(--sombra-hover);
        }

        .card-img-container {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .card-img-container img {
            max-height: 100%;
            width: auto;
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-container img {
            transform: scale(1.1);
        }

        .service-list {
            list-style: none;
            padding: 0;
        }

        .service-list li {
            padding: 0.75rem 0;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }

        .service-list i {
            color: var(--limon);
            margin-right: 1rem;
            font-size: 1.3rem;
            width: 25px;
        }

        .hero-section {
            padding-top: 8rem;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.85);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--degradado);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.8rem;
        }

        .contact-info {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .contact-info i {
            width: 40px;
            height: 40px;
            background: var(--degradado);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--verde);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--limon);
            transform: translateY(-5px);
        }

        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--degradado);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background: var(--degradado-hover);
            transform: translateY(-5px);
        }

        @media (max-width: 768px) {
            section {
                padding: 4rem 0;
            }
            
            .hero-section {
                padding-top: 6rem;
                min-height: auto;
                text-align: center;
            }
            
            .display-4 {
                font-size: 2.5rem;
            }
            
            .service-list li {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#inicio">
                <span class="text-custom-green">JARD</span>
                <span class="text-custom-limon">developers</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-custom-green active" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-custom-green" href="#nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-custom-green" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-custom-green" href="#contacto">Contacto</a>
                    </li>
                </ul>

                <!-- Botones de autenticación -->
                @if (Route::has('login'))
                    <ul class="navbar-nav auth-nav">
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link text-custom-green">
                                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link text-custom-green">
                                    <i class="fas fa-sign-in-alt me-1"></i> Ingresa
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link text-custom-green">
                                        <i class="fas fa-user-plus me-1"></i> Regístrate
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    <!-- Sección Inicio/Hero -->
    <section id="inicio" class="hero-section"
        style="background: url('{{ asset('assets/imginicio/inicio_fondo.png') }}') no-repeat center center; background-size: cover;">
        <div class="container">
            <div class="row align-items-center hero-content">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        JARD TI <span class="text-custom-limon">TECNOLOGÍA Y DESARROLLO</span>
                    </h1>
                    <p class="lead mb-4">
                        Construimos soluciones digitales que impulsan tu negocio.
                        Más que código, creamos oportunidades, transformando ideas en experiencias digitales.
                    </p>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('assets/imginicio/copa-ganadora-concepto-medalla-oro.png') }}"
                        alt="Imagen inicio" class="img-fluid float-animation" style="max-width: 80%;">
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Nosotros -->
    <section id="nosotros" class="py-5 bg-light">
        <div class="container">
            <h2 class="heading text-center display-4 fw-bold mb-5 heading-center">Nosotros</h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-img-container">
                            <img src="{{ asset('assets/imginicio/grupo_jard.png') }}" alt="Empresa JARD" class="img-fluid">
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="fas fa-code"></i>
                            </div>
                            <h3 class="h4 mb-3">Empresa de Desarrollo TI</h3>
                            <p class="mb-0">
                                Somos una empresa dedicada al diseño, desarrollo e implementación de soluciones
                                tecnológicas innovadoras. Nuestro equipo combina creatividad y experiencia para 
                                transformar ideas en herramientas digitales funcionales.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-img-container">
                            <img src="{{ asset('assets/imginicio/digital-blue-hud-interface-laptop-concept.jpg') }}"
                                alt="Compromiso TI" class="img-fluid">
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h3 class="h4 mb-3">Compromiso al Desarrollo TI</h3>
                            <p class="mb-0">
                                En cada proyecto, nuestro compromiso es absoluto. Nos aseguramos de comprender 
                                a fondo las necesidades de nuestros clientes para ofrecer resultados que superen 
                                sus expectativas.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-img-container">
                            <img src="{{ asset('assets/imginicio/businessman-working-futuristic-office.jpg') }}"
                                alt="Versatilidad" class="img-fluid">
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <h3 class="h4 mb-3">Versatilidad</h3>
                            <p class="mb-0">
                                Nos caracterizamos por nuestra capacidad de adaptación a distintos sectores y
                                desafíos tecnológicos. Utilizamos una amplia gama de tecnologías para crear
                                soluciones a medida para cada tipo de cliente.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Servicios -->
    <section id="servicios" class="py-5"
        style="background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('{{ asset('assets/imginicio/fondo_2.png') }}') no-repeat left center; background-size: contain;">
        <div class="container">
            <h2 class="heading text-center display-4 fw-bold mb-5 heading-center">Servicios</h2>

            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="ps-lg-5">
                        <h2 class="mb-4">Ofrecemos Servicios de:</h2>
                        <ul class="service-list">
                            <li><i class="fa-solid fa-code"></i> Desarrollo Web Personalizado</li>
                            <li><i class="fa-solid fa-mobile-screen"></i> Aplicaciones Móviles</li>
                            <li><i class="fa-solid fa-gears"></i> Sistemas y Software Empresarial</li>
                            <li><i class="fa-solid fa-shield-halved"></i> Mantenimiento y Soporte Técnico</li>
                            <li><i class="fa-solid fa-cloud"></i> Soluciones en la Nube</li>
                            <li><i class="fa-solid fa-chart-line"></i> Consultoría Tecnológica</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1 text-center">
                    <img src="{{ asset('assets/imginicio/logo_sportzone-no fondo.png') }}" alt="Logo SportZone"
                        class="img-fluid" style="max-width: 80%;">
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="mb-3">JARD Developers</h4>
                    <p>Transformando ideas en experiencias digitales. Soluciones tecnológicas a medida para impulsar tu negocio.</p>
                </div>
                
            
            <hr class="my-4">
            
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Grupo J.A.R.D. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Botón para volver al inicio -->
    <a href="#inicio" class="back-to-top">
        <i class="fas fa-chevron-up"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Cerrar alertas automáticamente
            let alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    let bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 4000);
            }

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.querySelector('.navbar').classList.add('navbar-scrolled');
                } else {
                    document.querySelector('.navbar').classList.remove('navbar-scrolled');
                }
                
                // Mostrar/ocultar botón de volver al inicio
                if (window.scrollY > 300) {
                    document.querySelector('.back-to-top').classList.add('active');
                } else {
                    document.querySelector('.back-to-top').classList.remove('active');
                }
            });

            // Smooth scroll para enlaces internos
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Formulario de contacto
            const contactForm = document.querySelector('.contact-form');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    // Aquí iría la lógica para enviar el formulario
                    alert('¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.');
                    contactForm.reset();
                });
            }
        });
    </script>
</body>

</html>