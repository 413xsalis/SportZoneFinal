<!doctype html>
<html lang="es">

<head>
    <title>Registro</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />

    <style>
        .gradient-custom-2 {
            background: linear-gradient(to right, #00274D, #77DAB5);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

        /* Animación formulario */
        .animated-card {
            animation: bounceIn 1.2s ease-out forwards;
            opacity: 0;
            transform: scale(0.8);
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            50% {
                opacity: 1;
                transform: scale(1.1);
            }

            75% {
                transform: scale(0.95);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Estilos para validación */
        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
        }

        .was-validated .form-control:invalid~.invalid-feedback,
        .is-invalid~.invalid-feedback {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Alertas -->
    <div id="message-box" class="position-fixed top-0 start-50 translate-middle-x p-3"
        style="z-index: 1050; display: none;">
        <div id="alert-message" class="alert alert-dismissible fade show" role="alert">
            <span id="message-text"></span>
            <button type="button" class="btn-close"
                onclick="document.getElementById('message-box').style.display='none';"></button>
        </div>
    </div>

    <section class="h-100 gradient-form"
        style="background-image: url('Fondodeporte.jpeg'); background-size: cover; background-position: center;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card animated-card">
                        <div class="row g-0">
                            <!-- Formulario -->
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/logo_sportzone-edit.png') }}"
                                            style="width: 150px; padding: 10px; opacity: 0.8; border-radius: 10px;"
                                            alt="logo">
                                    </div>

 <form id="registroForm" action="{{ route('register') }}" method="POST" novalidate>
    @csrf
    <p class="mt-3">Por favor regístrate</p>

    <!-- Nombre -->
    <div class="form-outline mb-4">
        <input type="text" name="name" id="name" 
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" placeholder="Digita tu nombre" required>
        <label class="form-label" for="name">Nombre</label>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @else
            <div class="invalid-feedback">El nombre es requerido.</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="email" 
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" placeholder="Digita tu correo electrónico" required>
        <label class="form-label" for="email">Correo Electrónico</label>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @else
            <div class="invalid-feedback">Introduce un correo válido.</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="form-outline mb-4">
        <input type="password" name="password" id="password" 
               class="form-control @error('password') is-invalid @enderror"
               placeholder="Digita la contraseña" required>
        <label class="form-label" for="password">Contraseña</label>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @else
            <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres.</div>
        @enderror
    </div>

    <!-- Confirmación -->
    <div class="form-outline mb-4">
        <input type="password" name="password_confirmation" id="password_confirmation"
               class="form-control" placeholder="Confirma la contraseña" required>
        <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
        <div class="invalid-feedback">Las contraseñas no coinciden.</div>
    </div>



                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block gradient-custom-2 mb-3"
                                                type="submit">Registrarse</button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <a href="{{ route('login') }}" class="btn btn-outline-danger">Login</a>
                                        </div>

                                        <div class="text-center mt-4">
                                            <a href="{{ route('welcome') }}" class="text-decoration-none">
                                                <i class="bi bi-arrow-left-circle me-1"></i> Volver a la página
                                                principal
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Texto lateral -->
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h1 class="mb-4" style="text-align: center;">¡Bienvenidos!</h1>
                                    <p class="fs-5 mb-0" style="text-align: center;">
                                        Regístrate para acceder a tu panel. El administrador definirá tu rol
                                        (colaborador o instructor).
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('registroForm');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const emailFeedback = document.getElementById('email-feedback');

            form.addEventListener('submit', function (event) {
                if (!validateForm()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                }
            });

            function validateForm() {
                let valid = true;

                if (nameInput.value.trim() === '') {
                    nameInput.classList.add('is-invalid'); valid = false;
                } else { nameInput.classList.remove('is-invalid'); }

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    emailInput.classList.add('is-invalid'); valid = false;
                } else { emailInput.classList.remove('is-invalid'); }

                if (passwordInput.value.length < 8) {
                    passwordInput.classList.add('is-invalid'); valid = false;
                } else { passwordInput.classList.remove('is-invalid'); }

                if (passwordConfirmationInput.value !== passwordInput.value) {
                    passwordConfirmationInput.classList.add('is-invalid'); valid = false;
                } else { passwordConfirmationInput.classList.remove('is-invalid'); }

                return valid;
            }
        });
    </script>
</body>

</html>