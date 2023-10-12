<div class="card-body" style="background-color: white; margin-bottom:7.6rem;border:1px solid #98AE98;border-radius:20px; padding:1rem">
    <h4 class="login-box-msg" style="margin-bottom:-13px"> Registrarse </h4>
    <p class="login-box-msg ">- <?= $vacancy->vacancy ?> -</p>
    <form id="candidate-contact-form" method="post">
        <input type="hidden" name="id_vacancy" id="id_vacancy" value="<?= isset($_GET['vacante']) && $_GET['vacante'] != '' ? $_GET['vacante'] : ''  ?>">
        <div class="row">

            <div class="col-md-12">
                <div class="input-group mb-3 ">
                    <input id="first_name" name="first_name" type="text" class="form-control" placeholder="Nombres" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3 ">
                    <input id="surname" name="surname" type="text" class="form-control" placeholder="Apellido Paterno" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3 ">
                    <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Apellido Materno" required>
                </div>
            </div>


            <div class="col-md-12">
                <div class="input-group mb-3 ">
                    <input id="telephone" name="telephone" type="text" class="form-control" placeholder="Telefono" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3"> </div>
            <div class="col-md-6">
                <button id="submit" type="submit" class="btn bg-success btn-block ">Enviar</button>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>

</div>

<script src="<?= base_url ?>app/candidate.js?v=<?= rand() ?>"></script>


<script type="text/javascript">
    document.querySelector("#candidate-contact-form").addEventListener('submit', e => {
        e.preventDefault();
        let contacto = new Candidate();
        contacto.save_contact();
    });
</script>