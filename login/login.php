<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            background: #1a1a2e;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-family: 'Century Gothic', sans-serif;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #003366;
            border-color: #003366;
        }

        .btn-primary:hover {
            background-color: #002244;
            border-color: #002244;
        }

        .view {
            position: absolute;
            top: 14%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Fondo de partículas -->
    <div id="particles-js"></div>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-4">
            <div class="card rounded-5 shadow bg-light" style="min-height: 450px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h3 class="card-title text-center mb-4">Iniciar Sesión</h3>
                    <i class="fa-solid fa-user-large fa-4x" style="color: #0b5289;"></i>
                    <form class="w-100" action="enviardatos.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" name="user" class="form-control" id="username" placeholder="Ingrese el usuario">
                        </div>
                        <div class="mb-3" style="position: relative;">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="pass" class="form-control rounded-3" id="password" placeholder="Ingrese la contraseña">
                            <i class="fa-solid fa-eye-slash view" id="togglePassword"></i>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="btnEntrar" class="btn btn-primary btn-lg rounded-5">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Archivo JS para partículas -->
    <script src="particles.min.js"></script>
    <script>
        particlesJS({
            "particles": {
                "number": {
                    "value": 85,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 200,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });

        // Funcionalidad de mostrar/ocultar contraseña
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
</body>

</html>
