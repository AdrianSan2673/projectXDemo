<p class="login-box-msg text-white h6">Escribe tu correo electrónico para recuperar tu cuenta.</p>

<form id="recover-form" method="post">
    <div class="input-group">
        <input type="email" id="email" name="email" class="form-control" placeholder="Correo electrónico"><br>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="email_exists" style="display: none;"></div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-12">
            <button type="submit" id="recover_submit" class="btn btn-orange btn-block" disabled="true">Solicitar nueva contraseña</button>
        </div>
        <!-- /.col -->
    </div>
</form>

<p class="mt-3 mb-1 text-center">
    <a href="<?=base_url?>usuario/index" class="bg-success btn btn-block">Iniciar Sesión</a>
</p>
<p class="mb-0 text-center">
    <a href="<?=base_url?>usuario/registrar" class="text-center bg-info btn btn-block">Registrarse</a>
</p>
<script type="text/javascript">
    document.querySelector('#recover-form #email').addEventListener('input', e =>{
        let email = new Account();
        email.checkEmail();
    });
    document.querySelector('#recover_submit').addEventListener('click', e => {
        e.preventDefault();
        let recover = new Account();
        recover.recoverSubmit();
    });
</script>