<!doctype html>
<html lang="en">

<head>
    <title>Registro</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    
    <style>
        /* Contenido de estilos_login.css */
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
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

        /* ========================================= */
        /* ANIMACIONES NUEVAS Y AVANZADAS      */
        /* ========================================= */

        /* Animación para el contenedor principal del formulario (efecto de rebote) */
        .animated-card {
            animation: bounceIn 1.2s ease-out forwards;
            opacity: 0;
            transform: scale(0.8);
            transform-origin: center bottom;
            border-radius: 1rem;
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

        /* Animación de pulso para el fondo */
        .pulse-bg {
            animation: background-pulse 4s infinite ease-in-out;
        }

        @keyframes background-pulse {
            0% {
                box-shadow: 0 0 15px rgba(0, 39, 77, 0.4);
            }

            50% {
                box-shadow: 0 0 30px rgba(119, 218, 181, 0.8), 0 0 20px rgba(0, 39, 77, 0.6);
            }

            100% {
                box-shadow: 0 0 15px rgba(0, 39, 77, 0.4);
            }
        }

        /* Animación y retraso para los elementos internos */
        .text-center img,
        .form-outline.mb-4,
        .text-center.pt-1,
        .d-flex.align-items-center.justify-content-center.pb-4,
        .col-lg-6.d-flex.align-items-center.gradient-custom-2 {
            opacity: 0;
            animation: fadeIn 1.2s ease-out forwards;
        }

        .text-center img {
            animation-delay: 0.5s;
        }

        .form-outline.mb-4:nth-of-type(1) {
            animation-delay: 1s;
        }

        .form-outline.mb-4:nth-of-type(2) {
            animation-delay: 1.2s;
        }

        .text-center.pt-1 {
            animation-delay: 1.4s;
        }

        .d-flex.align-items-center.justify-content-center.pb-4 {
            animation-delay: 1.6s;
        }

        .col-lg-6.d-flex.align-items-center.gradient-custom-2 {
            animation-delay: 0.8s;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
        
        /* Estilos para la validación de Bootstrap */
        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;
        }

        .was-validated .form-control:invalid ~ .invalid-feedback,
        .is-invalid ~ .invalid-feedback {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Contenedor para los mensajes de éxito y error -->
    <div id="message-box" class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1050; display: none;">
        <div id="alert-message" class="alert alert-dismissible fade show" role="alert">
            <span id="message-text"></span>
            <button type="button" class="btn-close" onclick="document.getElementById('message-box').style.display='none';" aria-label="Close"></button>
        </div>
    </div>

    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black animated-card">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <!-- Se mantiene la ruta original del logo de Laravel -->
                                        <img src="{{ asset('assets/logo_sportzone-edit.png') }}" style="width: 150px;
                                        padding: 10px; opacity: 0.4; background: radial-gradient(circle at 20% 30%, rgb(3, 23, 138), transparent), 
                                        radial-gradient(circle at 70% 80%, rgb(5, 92, 24), transparent);
                                        border-radius: 10px; " alt="logo">
                                    </div>

                                    <!-- Se mantiene la ruta original del formulario de Laravel -->
                                    <form id="registroForm" action="{{ route('register') }}" method="post" novalidate>
                                        @csrf
                                        <p>Por favor regístrate</p>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Digita tu nombre" required />
                                            <label class="form-label" for="name">Nombre</label>
                                            <div class="invalid-feedback">El nombre es requerido.</div>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Digita tu correo electronico" required />
                                            <label class="form-label" for="email">Correo Electrónico</label>
                                            <div class="invalid-feedback" id="email-feedback">Por favor, introduce un correo electrónico válido.</div>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Digita la contraseña" required />
                                            <label class="form-label" for="password">Contraseña</label>
                                            <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres.</div>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation" class="form-control"
                                                placeholder="Confirma la contraseña" required />
                                            <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                            <div class="invalid-feedback">Las contraseñas no coinciden.</div>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">Registrarse</button><br>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Ir al Login</p>
                                            <a href="{{ route('login') }}" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-outline-danger">Login</a>
                                        </div>

                                        <div class="text-center mt-4">
                                            <a href="{{ route('welcome') }}" class="text-decoration-none">
                                                <i class="bi bi-arrow-left-circle me-1"></i> Volver a la pagina principal
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h1 class="mt-1 mb-5 pb-1" style="text-align: center;">¡Bienvenidos!</h1>
                                    <p class="fs-5 mb-0" style="font-family: 'Playfair Display', serif; text-align: center;">Nos alegra tenerte aquí. Registrate para poder asignarte un rol,
                                        al ingresar ya se definira tu respectivo rol, si eres colaborador o instructor, el admin te otorgara el acceso a tu panel.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        xintegrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        xintegrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('registroForm');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const emailFeedback = document.getElementById('email-feedback');

            // Simula una base de datos de usuarios ya registrados
            const registeredUsers = ['usuario@ejemplo.com', 'admin@ejemplo.com'];

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                event.stopPropagation();
                
                // Realiza la validación de cada campo
                const isNameValid = validateName();
                const isEmailValid = validateEmail();
                const isPasswordValid = validatePassword();
                const isPasswordConfirmationValid = validatePasswordConfirmation();

                // Si toda la validación de campos es exitosa
                if (isNameValid && isEmailValid && isPasswordValid && isPasswordConfirmationValid) {
                    // Verifica si el usuario ya existe
                    if (registeredUsers.includes(emailInput.value)) {
                        showErrorMessage('El usuario ya está registrado.');
                        emailInput.classList.add('is-invalid');
                        emailFeedback.textContent = 'Este usuario ya está creado.';
                    } else {
                        // Simula el registro exitoso: añade el usuario a la "base de datos"
                        registeredUsers.push(emailInput.value);
                        showSuccessMessage('¡Usuario registrado con éxito!');
                        // Oculta la validación del formulario después del éxito
                        form.classList.remove('was-validated');
                        form.reset();
                    }
                } else {
                    form.classList.add('was-validated');
                }
            });

            function showSuccessMessage(message) {
                const messageBox = document.getElementById('message-box');
                const alertMessage = document.getElementById('alert-message');
                const messageText = document.getElementById('message-text');

                alertMessage.className = 'alert alert-success alert-dismissible fade show';
                messageText.textContent = message;
                messageBox.style.display = 'block';
            }

            function showErrorMessage(message) {
                const messageBox = document.getElementById('message-box');
                const alertMessage = document.getElementById('alert-message');
                const messageText = document.getElementById('message-text');

                alertMessage.className = 'alert alert-danger alert-dismissible fade show';
                messageText.textContent = message;
                messageBox.style.display = 'block';
            }

            function validateName() {
                const isValid = nameInput.value.trim() !== '';
                nameInput.classList.toggle('is-invalid', !isValid);
                nameInput.classList.toggle('is-valid', isValid);
                return isValid;
            }

            function validateEmail() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const isValid = emailRegex.test(emailInput.value);
                emailInput.classList.toggle('is-invalid', !isValid);
                emailInput.classList.toggle('is-valid', isValid);
                // Restablece el mensaje de error personalizado
                if(isValid) {
                    emailFeedback.textContent = 'Por favor, introduce un correo electrónico válido.';
                }
                return isValid;
            }

            function validatePassword() {
                const isValid = passwordInput.value.length >= 8;
                passwordInput.classList.toggle('is-invalid', !isValid);
                passwordInput.classList.toggle('is-valid', isValid);
                return isValid;
            }

            function validatePasswordConfirmation() {
                const isValid = passwordConfirmationInput.value === passwordInput.value && passwordConfirmationInput.value.trim() !== '';
                passwordConfirmationInput.classList.toggle('is-invalid', !isValid);
                passwordConfirmationInput.classList.toggle('is-valid', isValid);
                return isValid;
            }
        });
    </script>
</body>

</html>
