<p class="login-box-msg text-white"><b>Iniciar Sesión | Recursos Humanos</b></p>

<form id="login_rh-form" method="post">
    <div class="input-group mb-3">
        <input id="username" name="username" type="text" class="form-control" placeholder="CURP">

    </div>
    <div class="input-group mb-3">
        <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña">

    </div>
    <div class="row">
        <div class="col-12">
            <button id="login-submit" type="submit" class="btn btn-orange btn-block">Entrar</button>
        </div>
    </div>
</form>


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
                <p>CURP ó contraseña incorrectos</p>
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
    account.login_rh();

});
</script>