<!doctype html>
<html lang="es">

<head>
    <title>Registro</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <style>
        :root {
            --primary-color: #00274D;
            --secondary-color: #77DAB5;
            --error-color: #dc3545;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .gradient-custom-2 {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
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
            border-color: var(--error-color);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6.4.4.4-.4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .invalid-feedback {
            display: none;
            color: var(--error-color);
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .was-validated .form-control:invalid ~ .invalid-feedback,
        .form-control.is-invalid ~ .invalid-feedback {
            display: block;
        }
        
        .password-mismatch {
            display: none;
            color: var(--error-color);
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
        
        .logo-container {
            width: 150px;
            padding: 10px; 
            opacity: 0.8; 
            background: radial-gradient(circle at 20% 30%, rgb(3, 23, 138), transparent), 
                       radial-gradient(circle at 70% 80%, rgb(5, 92, 24), transparent);
            border-radius: 10px;
            margin: 0 auto;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .password-strength {
            height: 5px;
            margin-top: 0.5rem;
            border-radius: 5px;
            background-color: #e9ecef;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0;
            border-radius: 5px;
            transition: width 0.3s ease;
        }
        
        .input-group-text {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .input-group-text:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .alert-box {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            animation: slideIn 0.5s ease-out forwards;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .success-alert {
            background: linear-gradient(to right, #d4edda, #c3e6cb);
            border-left: 4px solid #28a745;
            color: #155724;
        }
        
        .error-alert {
            background: linear-gradient(to right, #f8d7da, #f5c6cb);
            border-left: 4px solid #dc3545;
            color: #721c24;
        }
        
        .info-alert {
            background: linear-gradient(to right, #d1ecf1, #bee5eb);
            border-left: 4px solid #17a2b8;
            color: #0c5460;
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

  <section class="h-100 gradient-form" style="background-image: url('Fondodeporte.jpeg');
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: center;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black animated-card">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{ asset('assets/logo_sportzone-edit.png') }}" style="width: 150px;
                                        padding: 10px; opacity: 0.4; background: radial-gradient(circle at 20% 30%, rgb(3, 23, 138), transparent), 
                                        radial-gradient(circle at 70% 80%, rgb(5, 92, 24), transparent);
                                        border-radius: 10px; " alt="logo">

                                    </div>
                                                                        <br>
                                    <h3 class="text-center mb-4">Crea tu cuenta</h3>
                                    <br><br>

 <form id="registroForm" action="{{ route('register') }}" method="POST" novalidate>
    @csrf
<h1 class="text-center pt-1 mb-5 pb-1" style="text-align: center;">Registrate con tu cuenta </h1>
    <!-- Nombre -->
    <div class="form-outline mb-4">
    <label class="form-label" for="name">Nombre Completo</label>
        <input type="text" name="name" id="name" 
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" placeholder="Digita tu nombre" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @else
            <div class="invalid-feedback">El nombre es requerido.</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="form-outline mb-4">
        <label class="form-label" for="email">Correo Electrónico</label>
        <input type="email" name="email" id="email" 
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" placeholder="Digita tu correo electrónico" required>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @else
            <div class="invalid-feedback">Introduce un correo válido.</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="form-outline mb-4">
        <label class="form-label" for="password">Contraseña</label>
        <div class="input-group">
            <input type="password" name="password" id="password" 
               class="form-control @error('password') is-invalid @enderror"
               placeholder="Minimo 8 caracteres" required  minlength="8">
            <span class="input-group-text"
            onclick="togglePassword('password','togglePasswordIcon1')">
            <i class="bi bi-eye-slash" id="togglePasswordIcon1"></i>
            </span>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @else
            <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres.</div>
            @enderror
        </div>
    </div>

    <!-- Confirmación -->
    <div class="form-outline mb-4">
        <label class="form-label mb-6" 
        for="password_confirmation">Confirmar Contraseña</label>
        <div class="input-group">
        <input type="password" name="password_confirmation" id="password_confirmation"
               class="form-control" placeholder="Confirma la contraseña" required>
            <span class="input-group-text"
            onclick="togglePassword('password_confirmation','togglePasswordIcon2')">
            <i class="bi bi-eye-slash" id="togglePasswordIcon2"></i></span>
        <div id="password-mismatch-error" class="password-mismatch">
            Las contraseñas no coinciden. Por favor, verifica que ambas contraseñas sean iguales.
            </div>
            </div>
            
    </div>



                                        <div class="text-center pt-1 mb-5 pb-1">
                                           <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 w-100"
                                                type="submit">
                                                Ingresar
                                            </button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">¿ Tienes cuenta?</p>
                                            <a href="{{ route('login') }}" data-mdb-button-init
                                                class="">Inicia Sesion</a>
                                        </div>


                                    </form>
                                </div>
                            </div>                            <!-- Texto lateral -->
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
            const passwordMismatchError = document.getElementById('password-mismatch-error');
            const passwordError = document.getElementById('password-error');
            const emailError = document.getElementById('email-error');
            const passwordStrengthBar = document.getElementById('password-strength-bar');

            passwordConfirmationInput.addEventListener('input', function() {
            validatePasswordMatch();
            });
            passwordInput.addEventListener('input', function() {
                validatePasswordMatch();
                checkPasswordStrength(this.value);
            });
            emailInput.addEventListener('blur', function() {
                checkEmailAvailability(this.value);
            });
            form.addEventListener('submit', function (event) {

                if (validateForm()) {
                    showAlert('¡Registro exitoso! Tu cuenta ha sido creada correctamente.', 'success');
                    // Aquí normalmente enviarías el formulario
                    setTimeout(() => {
                        form.reset();
                        form.classList.remove('was-validated');
                        passwordStrengthBar.style.width = '0%';
                        passwordStrengthBar.className = 'password-strength-bar';
                    }, 2000);
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
            function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (!input || !icon) {
                console.warn('togglePassword: elemento no encontrado', inputId, iconId);
                return;
            }

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }

        
        function showAlert(message, type) {
            const alertBox = document.getElementById('alert-box');
            const alertMessage = document.getElementById('alert-message');
            
            alertMessage.textContent = message;
            alertBox.style.display = 'block';
            
            // Configurar el tipo de alerta
            const alertDiv = alertBox.querySelector('.alert');
            alertDiv.className = 'alert alert-dismissible fade show';
            
            if (type === 'success') {
                alertDiv.classList.add('success-alert');
            } else if (type === 'error') {
                alertDiv.classList.add('error-alert');
            } else {
                alertDiv.classList.add('info-alert');
            }
            
            // Ocultar automáticamente después de 5 segundos
            setTimeout(hideAlert, 5000);
        }
        
        function hideAlert() {
            document.getElementById('alert-box').style.display = 'none';
        }


    </script>
</body>

</html>