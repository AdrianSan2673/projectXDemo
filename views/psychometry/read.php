<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h4>Psicometrías de <?= $psycho->candidate ?> solicitadas por <?= $psycho->customer ?></h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2 mr-auto">
                    <a class="btn btn-secondary btn-block float-left"
                        href="<?= base_url ?>psicometria/index">Regresar</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h4 class="card-title">Datos de las psicometrías</h4>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <b>Fecha de solicitud</b>
                                    <p><?= $psycho->request_date ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <b>Nombre del candidato</b>
                                    <p><?= $psycho->candidate ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <b>Cliente</b>
                                    <p><?= $psycho->customer ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <b>Razón social</b>
                                    <p><?= $psycho->business_name ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <b>Estado</b>
                                    <p><?= $psycho->estado ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <b>Fecha de entrega</b>
                                    <p><?= $psycho->end_date ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <b>Psicometrías</b>
                                    <p><?= $psycho->behavior == 1 ? 'Comportamiento, ' : '' ?><?= $psycho->intelligence == 1 ? 'Inteligencia, ' : '' ?><?= $psycho->labor_competencies == 1 ? 'Competencias laborales, ' : '' ?><?= $psycho->honesty_ethics_values == 1 ? 'Honestidad, ética y valores, ' : '' ?><?= $psycho->personality == 1 ? 'Personalidad, ' : '' ?><?= $psycho->sales_skills == 1 ? 'Habilidades de ventas, ' : '' ?><?= $psycho->leadership == 1 ? 'Liderazgo' : '' ?>
                                    </p>
                                </div>
                            </div>
                            <!-- gabo 22 -->

                            <?php if (Utils::isAdmin() || Utils::isSalesManager()) : ?>
                            <div class="text-center">
                                <a href="<?= base_url ?>psicometria/editar&id=<?= $_GET['id'] ?>"
                                    class="btn btn-info">Editar</a>
                            </div>
                            <?php endif ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php if (!Utils::isCustomer() && ($psycho->status != 2 || $psycho->status != 3)) : ?>
                    <div class="card card-orange">
                        <div class="card-header">
                            <h4 class="card-title">Psicometrías aplicadas</h4>
                        </div>
                        <div class="card-body">
                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                            <div class="text-right">
                                <a href="<?= base_url ?>psicometria/agregar&candidate=<?= Encryption::encode($psycho->id_candidate) ?>"
                                    class="btn btn-success">Agregar psicometría</a>
                            </div>
                            <?php endif ?>
                            <br>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <th></th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($psychometrics as $p) : ?>
                                    <tr>
                                        <td><?= $p['type'] ?></td>
                                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <td class="text-center py-0 align-middle">
                                            <?php if (isset($p['file'])) : ?>
                                            <a href="<?= $p['file'] ?>" class="btn btn-success">
                                                <i class="fas fa-download"></i> Descargar
                                            </a>
                                            <?php endif ?>
                        </div>
                        </td>
                        <?php endif ?>

                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tipo</th>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                <th></th>
                                <?php endif ?>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
                <?php endif ?>







                <!-- gabo 22 -->
                <div class="card card-blue">
                    <div class="card-header">
                        <h4 class="card-title">Interpretación</h4>
                    </div>
                    <form id='interpretation-form'>
                        <input type="hidden" name='id_psycho' value='<?= $_GET['id'] ?>'>
                        <div class="card-body">
                            <!-- <div class="row " style="margin-bottom:0.6rem; border:1px solid #98AE98 ; border-radius:15px;padding:1rem"> -->
                            <div class="row " style="margin-bottom:0.6rem;padding:1rem">
                                <div class="col-md-12">
                                    <textarea name="interpretation" id="interpretation" rows="10"
                                        style="width: 100%;"><?= $psycho->interpretation ?></textarea>
                                </div>
                            </div>
                            <div class="text-right">
                                <button id="guardar_interpretacion" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>




                <div class="card card-purple">
                    <div class="card-header">
                        <h4 class="card-title">Documento</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="form-document" enctype="multipart/form-data">

                            <div class="row" id="documento_cargado">

                                <?php if ($routeDocu != false) : ?>
                                <div class="col-8">
                                    <label for="psycho" class="col-form-label">Documento Cargado:</label>
                                    <a class="btn-success btn" href="<?= $routeDocu ?>" target="_blank">Ver
                                        psicometria</a>
                                </div>
                                <br>
                                <?php endif; ?>

                            </div>




                            <div class="row">
                                <div class="col-8">
                                    <label for="psycho" class="col-form-label">Cargar Nuevo Documento:</label>
                                    <input type="file" id="psycho_document" class="form-control" name="psycho_document"
                                        placeholder="Adjuntar archivo" class="form-control-file text-white"
                                        accept=" application/pdf">
                                </div>
                                <input type="hidden" name="id_psychometry" value="<?= $_GET['id'] ?>">
                                <div class="col-4" style="margin-top: 2rem;">
                                    <input class="btn btn-orange" type="submit">
                                </div>
                            </div>
                        </form>

                        <br>

                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
</div>
<!-- gabo 22 -->

<script src="<?= base_url ?>app/psychometry.js?v=<?= rand() ?>"></script>
<script>
document.querySelector("#interpretation-form").onsubmit = function(e) {
    e.preventDefault();
    document.querySelector("#guardar_interpretacion").disabled = true;

    let psycho = new Psychometry();
    psycho.save_interpretation();

};

let file_input = document.querySelector("#psycho_document")
file_input.addEventListener('change', function(e) {
    if (file_input.files[0] == undefined) {

    } else {
        var ext = file_input.files[0].name.split('.').pop().toLowerCase();
        if (ext != 'pdf') {
            utils.showToast('Solo se permite extension pdf.', 'warning');
            file_input.value = '';
        }
    }
})


document.querySelector('#form-document').addEventListener('submit', e => {
    e.preventDefault();

    let file_input = document.querySelector("#psycho_document")

    if (file_input.value != '') {
        let psycho = new Psychometry();
        psycho.upload_file();
    } else {
        utils.showToast('Selecciona archivo.', 'warning');
    }
});
</script>