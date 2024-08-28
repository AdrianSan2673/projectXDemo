<div class="card card-navy">
    <div class="card-header text-center" style="font-weight: bold;">Iniciar Sesion</div>
    <div class="card-body">
        <form id="login-form" method="post">
            <div class="input-group mb-3">
                <input id="username" name="username" type="text" class="form-control" placeholder="Correo electrónico">

            </div>
            <div class="input-group mb-3">
                <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña">

            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-12">
                    <button id="login-submit" type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>

        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<!-- <p class="mt-3 mb-1 text-center">
    <a href="<?= base_url ?>usuario/recuperar_cuenta" class="bg-danger btn btn-block">¿Has olvidado tu contraseña?</a>
</p> -->

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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    document.querySelector("#login-submit").addEventListener('click', e => {
        e.preventDefault();
        let account = new Account();
        account.login();
    });
</script>