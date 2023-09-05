<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left mb-2">
                        <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url . "vacante/index" ?>">Vacantes</a></li>
                        <li class="breadcrumb-item"><a
                                href="<?= base_url . "vacante/ver&id=" . $_GET['id'] ?>"><?= $vacante->vacancy ?></a>
                        </li>
                        <li class="breadcrumb-item active">Candidatos del área de <?= $vacante->area ?></li>


                        <?php if ($_GET['action'] == 'ver') : ?>
                        <li class="breadcrumb-item active">Postulaciones</li>
                        <?php endif ?>
                        <?php if ($_GET['action'] == 'enviados_a_reclutador') : ?>
                        <li class="breadcrumb-item"><a
                                href="<?= base_url . "postulaciones/ver&id=" . $_GET['id'] ?>">Postulaciones</a></li>
                        <li class="breadcrumb-item active">Candidatos enviados por ejecutivo de búsqueda</li>
                        <?php endif ?>
                    </ol>
                </div>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h1><?= $lbl_candidates ?> para el puesto de <b><?= $vacante->vacancy ?></b></h1>
                    </div>
                </div>
            </div>
            <input type="hidden" id="id" value="<?= $vacante->id_vacancy ?>">
            <div class="row text-center">
                <div class="col-md-2">
                    <b><?= '$' . number_format($vacante->salary_min) . ' - $' . number_format($vacante->salary_max) . ' (mensual)' ?></b>
                </div>
                <div class="col-md-2">
                    <p><?= $vacante->city . ', ' . $vacante->state ?></p>
                </div>
                <div class="col-md-2">
                    <p class="text-muted"><?= Utils::getFullDate($vacante->request_date) ?></p>
                </div>
                <div class="col-md-2">
                    <p><?= $vacante->customer ?></p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content-header">
        <div class="row">
            <div class="col-md-5">
                <div class="info-box mb-3 bg-navy">
                    <span class="info-box-icon"><i class="fas fa-address-card"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total de candidatos en Bolsa de Trabajo</span>
                        <span class="info-box-number"><?= $total ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-5">
                <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="fas fa-address-card"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?= $lbl_n_candidates ?></span>
                        <span class="info-box-number"><?= count($candidates) ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 ml-auto">
                <?php if ($_GET['controller'] == 'postulaciones') : ?>
                <a class="btn btn-orange float-right btn-lg"
                    href="<?= base_url ?>candidato/crear&vacante=<?= $_GET['id'] ?>">Crear candidato</a>
                <?php else : ?>
                <a class="btn btn-orange float-right btn-lg" href="<?= base_url ?>candidato/crear">Crear candidato</a>
                <?php endif ?>

            </div>
        </div>


        <div class="row">
            <a href="<?= base_url ?>postulaciones/buscar&id=<?= $_GET['id'] ?>"
                class="btn btn-success btn-lg mx-auto">Mostrar todos</a>
        </div>
        <div class="row mt-3">
            <button class="btn btn-info btn-lg mx-auto" id="postulate" onclick="postulate(this)">Seleccionar candidatos
                para la vacante</button>
        </div>

    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de candidatos</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <!-- GABOOOOOOO 10/03/2023 -->
            <section class="content-header">
                <div class="container-fluid">
                    <!-- gabo mod filtro -->
                    <?php if (!isset($_GET['id'])) : ?>
                    <form method="POST" action="<?= base_url . "candidato/index" ?>" class="row" id="filtros">
                        <?php else : ?>
                        <form method="POST"
                            action="<?= base_url . "postulaciones/buscar&id=" ?><?= isset($_GET['id']) ? $_GET['id'] : '' ?><?= isset($_GET['area']) ? '&area=' . $_GET['area'] : '' ?>"
                            class="row" id="filtros">
                            <?php endif; ?> <div class="col-md-2">
                                <div class="form-group">
                                    <label for="clave" class="col-form-label">Palabra Clave:</label>
                                    <input type="" name="clave" id="clave" value="" class="form-control"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Este campo tiene prioridad de búsqueda, si desea buscar por filtros  deje este campo en blanco">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="id_level" class="col-form-label">Grado de estudios</label>
                                    <?php $education_levels = Utils::showEducationLevels(); ?>
                                    <select name="id_level" id="id_level" class="form-control filtro">
                                        <option value="" selected>Sin filtro</option>
                                        <?php foreach ($education_levels as $level) : ?>
                                        <option value="<?= $level['id'] ?>"
                                            <?= $level['id'] == $vacante->id_education_level ? 'selected' : ''; ?>>
                                            <?= $level['level'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="id_area" class="col-form-label">Área de interés</label>
                                    <?php $areas = Utils::showAreas(); ?>
                                    <select name="id_area" id="id_area" class="form-control filtro">
                                        <option value="">Sin filtro</option>
                                        <?php foreach ($areas as $area) : ?>
                                        <option value="<?= $area['id'] ?>"
                                            <?= ($area['id'] == Encryption::decode($_GET['area'])) ? 'selected' : ''; ?>>
                                            <?= $area['area'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="id_subarea" class="col-form-label">Subarea</label>
                                    <?php $subareas = Utils::showSubareasByArea(Encryption::decode($_GET['area'])); ?>
                                    <select name="id_subarea" id="id_subarea" class="form-control filtro">
                                        <option disabled selected="selected"></option>
                                        <?php foreach ($subareas as $subarea) : ?>
                                        <option value="<?= $subarea['id'] ?>"
                                            <?= $subarea['id'] == $vacante->id_subarea ? 'selected' : ''; ?>>
                                            <?= $subarea['subarea'] ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="id_state" class="col-form-label">Estado</label>
                                    <?php $states = Utils::showStates(); ?>
                                    <select name="id_state" id="id_state" class="form-control filtro"
                                        style="width: 100%;">
                                        <option value="">Sin filtro</option>
                                        <?php foreach ($states as $state) : ?>
                                        <option value="<?= $state['id'] ?>"
                                            <?= $state['id'] == $vacante->id_state ? 'selected' : '';  ?>>
                                            <?= $state['state'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="id_city" class="col-form-label">Ciudad</label>
                                    <select name="id_city" id="id_city" class=" form-control  filtro"
                                        style="width: 100%;">
                                        <option disabled selected="selected"></option>
                                        <?= $cities = Utils::showCitiesByState($vacante->id_state); ?>
                                        <?php foreach ($cities as $city) : ?>
                                        <option value="<?= $city['id'] ?>"
                                            <?= $city['id'] == $vacante->id_city ? 'selected' : '';  ?>>
                                            <?= $city['city'] ?></option>
                                        <?php endforeach ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="id_state" class="col-form-label">Idioma</label>
                                <?php $languages = Utils::showLanguages(); ?>
                                <select name="language" id="language" class="form-control filtro">
                                    <option value="" selected>Sin filtro</option>
                                    <?php foreach ($languages as $language) : ?>
                                    <option value="<?= $language['id'] ?>"
                                        <?= $level['id'] == $vacante->language_level  ? 'selected' : ''; ?>>
                                        <?= $language['language'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="edad1" class="col-form-label">
                                    Rango edad:</label>
                                <div class="form-group" style="display:flex">
                                    <div class="form-group" style="width:48%;margin:0.2rem">
                                        <input type="number" name="edad1" id="edad1" value="<?= $vacante->age_min ?>"
                                            class="form-control filtro">
                                    </div>
                                    <div style="width:48%;margin:0.2rem">
                                        <input type="number" name="edad2" id="edad2" value="<?= $vacante->age_max ?>"
                                            class="form-control filtro">
                                    </div>
                                </div>
                            </div>

                            <!-- gabo mod filtro -->
                            <div class="col-md-2">
                                <label for="gender" class="col-form-label filtro">Sexo</label>
                                <select name="id_gender" id="id_gender" class="form-control filtro">
                                    <option value="">Sin filtro</option>
                                    <option value="1" <?= $vacante->id_gender == "1" ? 'selected' : '';   ?>> Masculino
                                    </option>
                                    <option value="2" <?= $vacante->id_gender == "2" ? 'selected' : '';   ?>> Femenino
                                    </option>
                                </select>
                            </div>
                            <input type="hidden" id="id_city_aux" name="id_city_aux" value="<?= $vacante->id_city ?>">
                            <input type="hidden" id="id_subarea_aux" name="id_subarea_aux"
                                value="<?= $vacante->id_subarea ?>">

                            <input type="hidden" name="id_vacancy" id="id_vacancy" value="<?= $_GET['id'] ?>">
                            <!-- FIN GABO -->

                            <div class="col-md-2" style="margin-top:7px" hidden id="div_search">
                                <button type="submit" name="search" id="search"
                                    class="btn btn-app btn-block btn-info form-control"
                                    style="background-color: #17a2b8; color: #fff;"><i
                                        class="fas fa-search"></i>Buscar</button>
                            </div>
                            <!-- gabo mod filtro -->
                            <div class="col-md-2" style="margin-top:7px">
                                <button type="button" name="clean" id="clean"
                                    class="btn btn-app btn-block btn-warning form-control"
                                    onclick="limpiarForm()">Limpiar filtros</button>
                            </div>
                        </form>



                </div>
            </section>
            <!-- /.card-header -->
            <div class="card-body">
                <p class="h4" id="encontrados"></p>
                <div class="table-respsonsive">
                    <table id="tb_candidates_postulate" class="table table-striped table-respsonsive"
                        style="width: 100%; position:relative;display: inline-block;overflow-y: scroll;">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="filterhead"></th>
                                <th class="filterhead"></th>
                                <th class="filterhead"></th>
                                <th class="filterhead"></th>
                                <th></th>
                                <th class="filterhead"></th>
                                <th class="filterhead"></th>
                                <th class="filterhead"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Seleccionar</th>
                                <th>Nombre del candidato</th>
                                <th>Edad</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>Escolaridad</th>
                                <th>Titulo</th>
                                <th>Idioma</th>
                                <th>Area de interes</th>
                                <th>Subarea</th>
                                <th>Reseña de experiencia</th>
                                <th>Experiencias</th>
                                <th>Fortalezas</th>
                                <th>fecha de creacion</th>
                                <th>creado por</th>
                                <th>Acciones</th>



                            </tr>
                        </thead>
                        <tbody>

                            <!--  -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Seleccionar</th>
                                <th>Nombre del candidato</th>
                                <th>Edad</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>Escolaridad</th>
                                <th>Titulo</th>
                                <th>Idioma</th>
                                <th>Area de interes</th>
                                <th>Subarea</th>
                                <th>Reseña de experiencia</th>
                                <th>Experiencias</th>
                                <th>Fortalezas</th>
                                <th>fecha de creacion</th>
                                <th>creado por</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>

<!-- //===[gabo 30 agosto]=== -->
<script src="<?= base_url ?>app/candidate.js?v=<?= rand() ?>"></script>
<script>
$(document).ready(function() {
    let candidate = new Candidate();
    candidate.LoadTablePostulate();

});


let candidate = new Candidate();
//Seleccionas todos los elementos con clase test
var objs = document.getElementsByClassName("filtro");

//Recorres la lista de elementos seleccionados
for (var i = 0; i < objs.length; i++) {
    //Añades un evento a cada elemento
    objs[i].addEventListener("change", function() {
        candidate.LoadTablePostulate();
    });
}

document.getElementById('clave').addEventListener('keyup', e => {

    let clave = document.querySelector('#clave').value != '' ? document.querySelector('#clave').value.trim() :
        '';

    if (clave != '') {
        document.getElementById('div_search').hidden = false;
    } else {
        document.getElementById('div_search').hidden = true;
    }

})

document.getElementById('search').addEventListener('click', e => {
    e.preventDefault();
    document.querySelector('#search').disabled = true;
    let candidate = new Candidate();
    candidate.LoadTablePostulate();

})
</script>
<style>
thead input {
    width: 100%;
}
</style>
<!-- //===[gabo 30 agosto]=== -->
<?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'enviados_a_reclutador' && isset($_GET['id']) && (Utils::isAdmin() || Utils::isSenior())) : ?>
<div class="modal fade" id="modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="update-form">
                <div class="modal-header">
                    <h4 class="modal-title">Entrevista</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_applicant" id="id_applicant">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="candidate">Candidato</label>
                        <input type="text" class="form-control" name="candidate" id="candidate" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="interview_comments">Comentarios de la entrevista</label>
                        <textarea class="form-control" name="interview_comments" rows="10"
                            id="interview_comments"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="interview_date">Fecha de entrevista</label>
                        <input type="date" class="form-control" id="interview_date" name="interview_date"
                            value="<?= date("Y-m-d") ?>">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url ?>app/applicant.js?v=<?= rand() ?>"></script>
<script>
$(document).ready(function() {


    $("#tb_candidates ").on('click', '.btn-comments', function() {
        let applicant = new Applicant();
        applicant.getApplicantInterview($(this).attr('id'));
    });

    document.querySelector("#update-form").onsubmit = function(e) {
        e.preventDefault();
        let applicant = new Applicant();
        applicant.update_interview();
    };
});
</script>

<?php endif ?>

<script src="<?= base_url ?>app/applicant.js?v=<?= rand() ?>"></script>
< <script>
    function postulate(e) {
    e.disabled = true;
    let applicant = new Applicant();
    applicant.postulate();

    }
    </script>



    <script>
    document.querySelector('#id_area').onchange = function() {
        let subarea = new Subarea();
        subarea.id_area = document.querySelector("#id_area").value;
        subarea.selector = document.querySelector("#id_subarea");
        subarea.getSubareasByArea();
    };
    document.querySelector('#id_state').onchange = function() {
        let cities = new City();
        cities.id_state = document.querySelector('#id_state').value;
        cities.selector = document.querySelector('#id_city');
        cities.getCitiesByState();
    }
    // window.onload = function() {
    //     if (document.querySelector("#id_state").value != '' && document.querySelector("#id_city").value == '') {
    //         let cities = new City();
    //         cities.id_state = document.querySelector('#id_state').value;
    //         cities.selector = document.querySelector('#id_city');
    //         cities.getCitiesByState();
    //     }
    // }
    // gabo mod filtro
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function limpiarForm() {

        document.querySelector('#search').disabled = true;
        document.getElementById('id_state').selectedIndex = 0;
        $('#id_city').val('');
        $('#id_city').trigger('change');
        document.getElementById('id_level').selectedIndex = 0;
        document.getElementById('id_area').selectedIndex = 0;
        document.getElementById('id_subarea').selectedIndex = 0;
        document.getElementById('id_gender').selectedIndex = 0;
        document.getElementById('language').selectedIndex = 0;
        document.getElementById('clave').value = "";
        document.getElementById('edad1').value = "";
        document.getElementById('edad2').value = "";

        //gabo filtros
        let candidate = new Candidate();
        candidate.LoadTablePostulate();
        //gabo filtros
    }


    document.querySelector('#tb_candidates_postulate').addEventListener('click', function(e) {


        if (e.target.classList.contains('btn-warning') || e.target.offsetParent.classList.contains(
                'btn-warning')) {

            let candidate = '';
            let id_candidate = '';

            if (e.target.offsetParent.classList.contains('btn-warning')) {
                id_candidate = e.target.offsetParent.value;
                candidate = e.target.offsetParent.dataset.id;
            } else {
                id_candidate = e.target.value;
                candidate = e.target.dataset.id;
            }



            let id_vacancy = document.querySelector('#id_vacancy').value;
            console.log(id_vacancy);
            console.log(id_candidate);


            Swal.fire({
                title: '¿Estás seguro de postular a este candidato?',
                text: "" + candidate,
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Postular'
            }).then((result) => {
                if (result.value == true) {

                    let applicant = new Applicant();
                    applicant.postulate_one(id_candidate, id_vacancy);

                }
            })






        }



    })
    </script>