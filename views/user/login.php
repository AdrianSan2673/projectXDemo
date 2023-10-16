
<p class="login-box-msg text-white"><b>Iniciar Sesión | Reclutamiento</b></p>

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
            <button id="login-submit" type="submit" class="btn btn-orange btn-block">Entrar</button>
        </div>
    <!-- /.col -->
    </div>
</form>
<br><br><br>
<a href="<?=$client->createAuthUrl(); ?>" class="btn btn-block btn-default mt-3" style="display: none;">
    <i class="fab fa-google mr-3"></i> Continuar con Google
</a>
<br>
<p class="mt-3 mb-1 text-center">
    <a href="<?=base_url?>usuario/recuperar_cuenta" class="bg-danger btn btn-block">¿Has olvidado tu contraseña?</a>
</p>
<?php if (isset($_GET['vacante'])): ?>
<p class="mt-4 text-center ">
    <a href="<?=base_url?>usuario/registrar&vacante=<?=$_GET['vacante']?>" class="text-center bg-success  btn btn-block">Registrarse</a>
</p>
<?php else: ?>
<p class="mt-3 text-center">
    <a href="<?=base_url?>usuario/registrar" class="text-center bg-success  btn btn-block">Registrarse</a>
</p>
<?php endif ?>

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