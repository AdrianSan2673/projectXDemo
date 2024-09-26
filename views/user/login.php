<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <!-- Imagen del lado izquierdo -->
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="<?= base_url ?>dist\img\Login-imagee.png"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; width: 100%; height: 100%; object-fit:cover;" />
                            </div>

                            <!-- Formulario de login -->
                            <div class=" col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form id="login-form" method="post" action="login-handler.php">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img src="<?= base_url ?>dist\img\SIGMA.png" style="width: 200px; height:auto" class="mx-auto d-block" />

                                        </div>

                                        <h5 class=" text-center fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar Sesión</h5>

                                        <!-- Campo para correo electrónico -->
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input id="username" name="username" type="text" class="form-control form-control-lg" placeholder="Correo electrónico" required />
                                        </div>

                                        <!-- Campo para contraseña -->
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input id="password" name="password" type="password" class="form-control form-control-lg" placeholder="Contraseña" required />
                                        </div>

                                        <!-- Botón de inicio de sesión -->
                                        <div class="pt-1 mb-4">
                                            <button id="login-submit" type="submit" class=" btn-custom btn-lg btn-block">Iniciar Sesión</button>
                                        </div>

                                        <!-- Otras opciones -->
                                        <a class="small text-muted" href="#">¿Olvidaste tu contraseña?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">¿No tienes una cuenta? <a href="register.php"
                                                style="color: #393f81;">Regístrate aquí</a></p>
                                        <a href="#" class="small text-muted">Términos de uso.</a>
                                        <a href="#" class="small text-muted">Política de privacidad</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Modal de error al iniciar sesión -->
    <div class="modal fade" id="modal-login">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Error al iniciar sesión</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Nombre de usuario o contraseña incorrectos</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-orange" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.querySelector("#login-submit").addEventListener('click', e => {
            e.preventDefault();
            let account = new Account();
            account.login();
        });
    </script>

</body>

</html>