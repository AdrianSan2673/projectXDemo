<div class="modal fade" id="modal_create">
    <div class="modal-dialog">
        <div class="modal-content" style="width:900px!important;margin-left:-150px">

            <div class="modal-header">
                <h4 class="modal-title">Candidato</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="candidate-form">
                <div class="modal-body">
                    <!-- <input type="hidden" name="flag" id="flag" value="1"> -->
                    <!-- <input type="hidden" name="id"> -->
                    <!-- <input type="hidden" name="id_vacancy_filter" value="<?= $id_vacancy ?>"> -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h4 class="card-title">Vacante</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Vacante*</label>
                                        <?php $vacantes = Utils::getVacantesEnProceso(); ?>
                                        <select name="id_vacancy" id="id_vacancy" class="form-control select2">
                                            <option value="" selected>Selecciona vacante</option>
                                            <?php foreach ($vacantes as $vacant) :
                                                $activo = '';
                                                if ($vacant['id_status'] < 5) {
                                                    $activo = '/ (ACTIVO)';
                                                }
                                            ?>
                                            <option value="<?= $vacant['id'] ?>">
                                                <?= $vacant['customer'] . " / " . $vacant['vacancy'] . " / " . $vacant['city'] . "      " . $activo     ?>
                                            </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Resultado</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" disabled selected>Selecciona resultado</option>
                                            <option value="1" selected>Nuevo</option>
                                            <option value="2">Por contactar</option>
                                            <option value="3">Contactado</option>
                                            <option value="4">Pendiente</option>
                                            <option value="5">No recomendado</option>
                                            <option value="6" hidden>Candidato postulado</option>
                                            <option value="7" hidden>Candidato en bolsa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>







                    <div class="card card-orange">
                        <div class="card-header">
                            <h4 class="card-title">Datos Personales</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label">Nombre*</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        maxlength="100" value="">
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Apellido Paterno*</label>
                                        <input type="text" class="form-control" name="surname" id="surname"
                                            maxlength="100" value="">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="col-form-label">Apellido materno</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                            maxlength="100" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- ===[gabo 1 agosto operativa]== -->
                                <div class="col-md-4">
                                    <!-- gabo 18 abril vacante -->
                                    <div class="form-group">
                                        <label f class="col-form-label">Fecha de
                                            nacimiento</label>
                                        <input type="date" name="date_birth" id="date_birth" class="form-control"
                                            value="">
                                    </div>
                                </div>
                                <!-- gabo 18 abril vacante -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="col-form-label">Edad</label>
                                        <input type="number" name="age" id="age" class="form-control" value="" min="16"
                                            max="99">
                                    </div>
                                </div>
                                <!-- gabo 18 abril vacante -->
                                <div class="col-md-3" id="div-sexo">
                                    <div class="form-group">
                                        <label class="col-form-label">Sexo</label>
                                        <?php $genders = Utils::showGenders(); ?>
                                        <select name="id_gender" id="id_gender" class="form-control">
                                            <option selected></option>
                                            <?php foreach ($genders as $gender) : ?>
                                            <option value="<?= $gender['id'] ?>">
                                                <?= $gender['gender'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
                                    <label class="col-form-label" for="telephone">Telefono*</label>
                                    <input type="text" name="telephone" maxlength="13" class="form-control" value=""
                                        placeholder="Ingresa tu número telefónico"
                                        data-inputmask='"mask": "999 999 9999"' data-mask>
                                </div> -->
                                <div class="col-md-3" id="div-civil-status">
                                    <!-- ===[gabo 1 agosto operativa]== -->
                                    <div class="form-group">
                                        <label class="col-form-label">Estado
                                            civil</label>
                                        <?php $civil_status = Utils::showCivilStatus(); ?>
                                        <select name="id_civil_status" id="id_civil_status" class="form-control">
                                            <option value>Selecciona el estado civil</option>
                                            <?php foreach ($civil_status as $status) : ?>
                                            <option value="<?= $status['id'] ?>"> <?= $status['status'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                        </div>
                    </div>


                    <div class="card card-info">
                        <div class="card-header">
                            <h4 class="card-title">Perfil Profesional</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Grado de estudios</label>
                                        <?php $education_levels = Utils::showEducationLevels(); ?>
                                        <select name="id_level" id="id_level" class="form-control">
                                            <option value="" hidden selected>Selecciona el Último grado de estudios
                                            </option>
                                            <?php foreach ($education_levels as $level) : ?>
                                            <option value="<?= $level['id'] ?>">
                                                <?= $level['level'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Experiencia en</label>
                                        <input type="text" name="job_title" id="job_title" class="form-control"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            <?= (isset($vacante->type) && ($vacante->type == 1 || $vacante->type == 4)) ? 'Observaciones' : 'Reseña breve';  ?></label>
                                        <textarea
                                            placeholder="Este campo no es obligatorio, escribe la reseña cuando se termine de entrevistar al candidato."
                                            name="description" id="description" rows="10"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Área de interés</label>
                                        <?php $areas = Utils::showAreas(); ?>
                                        <select name="id_area" id="id_area" class="form-control">
                                            <option value="" hidden selected>Selecciona un Área</option>
                                            <?php foreach ($areas as $area) : ?>
                                            <option value="<?= $area['id'] ?>">
                                                <?= $area['area'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Subarea</label>
                                        <select name="id_subarea" id="id_subarea" class="form-control">
                                            <?php foreach ($subareas as $subarea) : ?>
                                            <option value=""></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <!--  (isset($vacante->type) && ($vacante->type == 1 || $vacante->type == 4)) ? 'hidden' : '';  -->
                                <div class="col-md-12" id="div-curriculum">

                                    <!-- ===[gabo 1 agosto operativa]== -->
                                    <div class="form-group">
                                        <label class="col-form-label">Adjuntar curri­culum
                                            personal?</label>
                                        <input type="file" id="resume" name="resume" class="form-control"
                                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/pdf">
                                    </div>
                                    <!-- gabo 29 sept -->
                                    <!-- <div class="row" id="documento_cargado">
                                        <?php if (isset($resume)  and $_GET['action'] == 'editar') : ?> <?php endif; ?>
                                            <div class="col-8">
                                                <label for="psycho" class="col-form-label">Documento Cargado:</label>
                                                <a class="btn-success btn" href="" target="_blank">Ver
                                                    CV</a>
                                            </div>
                                            <br>
                                       
                                    </div> -->

                                    <div class="row" id="documento_cargado" hidden>
                                        <div class="col-8">
                                            <label for="psycho" class="col-form-label">Documento Cargado:</label>
                                            <a class="btn-success btn" href="" id="curriculum" target="_blank">Ver
                                                Curriculum</a>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="card card-maroon">
                        <div class="card-header">
                            <h4 class="card-title">Datos de Contacto</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Teléfono</label>
                                        <input type="text" name="telephone" id="telephone" maxlength="13"
                                            class="form-control"
                                            value="<?= isset($candidato) && is_object($candidato) ? $candidato->telephone : ''; ?>"
                                            data-inputmask='"mask": "999 999 9999"' data-mask>
                                    </div>
                                </div>
                                <!-- ===[gabo 1 agosto operativa]== -->
                                <div class="col-md-4" id="div-celular">
                                    <!-- ===[gabo 1 agosto operativa]== -->
                                    <div class="form-group">
                                        <label class="col-form-label">Celular:</label>
                                        <input type="text" name="cellphone" id="cellphone" maxlength="13"
                                            class="form-control" value="" data-inputmask='"mask": "999 999  9999"'
                                            data-mask>
                                    </div>
                                </div>

                                <!--  (isset($vacante->type) && ($vacante->type == 1 || $vacante->type == 4)) ? 'hidden' : '';  -->
                                <div class="col-md-4" id="div-email">
                                    <div class="form-group">
                                        <label class="col-form-label">Correo electrónico</label>
                                        <input type="email" name="email" id="email" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Estado</label>
                                        <?php $states = Utils::showStates(); ?>
                                        <select name="id_state" id="id_state" class="form-control" style="width: 100%;">
                                            <option selected="selected"></option>
                                            <?php foreach ($states as $state) : ?>
                                            <option value="<?= $state['id'] ?>">
                                                <?= $state['state'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Ciudad</label>
                                        <select name="id_city" id="id_city" class="form-control select2bs4"
                                            style="width: 100%;">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4" id="div-url">
                                    <div class="form-group">
                                        <label class="col-form-label">Link de contacto(pdf, Facebook,
                                            etc)</label>
                                        <input type="text" class="form-control" name="url" id="url" maxlength="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card card-red">
                        <div class="card-header">
                            <h4 class="card-title">Comentarios</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <!-- <label class="col-form-label" for="comment">Comentarios</label> -->
                                        <textarea class="form-control" id="comment" name="comment" rows="5"
                                            cols="30"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="card card-success" id="div-experience" hidden>
                        <div class="card-header" style="text-align: center;">
                            <h4 class="card-title">
                                Experiencia
                            </h4>
                            <btn class="btn btn-orange" style=" float:right" onclick="agregarFila()">
                                <i class="fas fa-plus"></i>
                            </btn>
                        </div>
                        <div class="card-body" id="div_experience">
                            <div class="card-body"
                                style="margin-bottom:0.6rem;border:1px solid #98AE98; border-radius:15px; padding:1rem">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group" style="text-align: center">
                                            <label for="" class="col-form-label"
                                                style="margin-top:30px">Información:</label>

                                        </div>
                                    </div>
                                    <div class="col-md-2" hidden>
                                        <div class="form-group" style="text-align: center">
                                            <label class="col-form-label">Fecha Inicio:</label>
                                            <input type="date" name="start_date[]" id="start_dates"
                                                style="text-align:center" class=" form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-2" hidden>
                                        <div class="form-group" style="text-align: center">
                                            <label class="col-form-label">Fecha Fin:</label>
                                            <input type="date" name="end_date[]" id="end_dates"
                                                style="text-align:center" class=" form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="text-align: center">
                                            <label class="col-form-label">Empresa/puesto:</label>
                                            <input onblur="verificar()" type="text" name="enterprise_experience[]"
                                                id="enterprise_experience" style="text-align:center"
                                                class=" form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="text-align: center">
                                            <label class="col-form-label">Descripción:</label>
                                            <textarea onblur="verificar()" name="review_experience[]"
                                                id="review_experience" class=" form-control"
                                                <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="text-align: center">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="" id="id_candidate_directory" name="id_candidate_directory" value="">
                    <input type="" id="tipo" name="tipo" value="">
                    <input type="" id="flag" name="flag" value="create">
                    <div class="card-footer">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>


                                <div class="col-md-3" style="text-align:center">
                                    <button class="btn btn-lg btn-success float-left " type="submit" value="0" hidden
                                        name="create" id="create">Guardar en
                                        bolsa</button>
                                </div>

                                <div class="col-md-3" style="text-align:center">
                                    <button class="btn btn-lg btn-orange float-right " type="submit" value="0" hidden
                                        name="postulate" id="postulate">Postular
                                    </button>
                                </div>


                                <div class="col-md-3">
                                    <button class="btn btn-lg btn-primary float-right ml-1" type="sumbit" id="directory"
                                        name="directory">
                                        Guardar </button>

                                    <a class="btn btn-lg btn-success float-right ml-1" id="ver" name="ver" hidden
                                        target="_blank">
                                        Ver </a>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
            <!-- <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                    </div> -->

        </div>
    </div>
</div>
</div>


<script type="text/javascript">
document.querySelector('#id_area').onchange = function() {
    let subareas = new Subarea();
    subareas.id_area = document.querySelector("#id_area").value;
    subareas.selector = document.querySelector("#id_subarea");
    subareas.getSubareasByArea();
};

document.querySelector('#create').onclick = function(e) {
    e.preventDefault();
    document.querySelector('#tipo').value = 'candidate';

    let candidatedirectory = new Candidatedirectory();
    candidatedirectory.save_candidate();

}
document.querySelector('#postulate').onclick = function(e) {
    e.preventDefault();
    document.querySelector('#tipo').value = 'postulate';

    let candidatedirectory = new Candidatedirectory();
    candidatedirectory.save_candidate();
}
document.querySelector('#directory').onclick = function(e) {
    e.preventDefault();
    document.querySelector('#tipo').value = 'directory';

    let candidatedirectory = new Candidatedirectory();
    candidatedirectory.save_candidate();
}



window.onload = function() {
    document.querySelector('#id_state').onchange = function() {
        console.log("holas");
        let cities = new City();
        cities.id_state = document.querySelector('#id_state').value;
        cities.selector = document.querySelector('#id_city');
        cities.getCitiesByState();
    }


    $("#id_vacancy").on("select2:select", function(e) {
        var data = e.params.data;
        let vacancy = new Vacancy();
        vacancy.getVacancySateCity(data.id);

        vacancy.getTypeVacancy(data.id);


    });
}




//gabo 4 oct

function delete_row(objeto) {
    objeto.parentElement.parentElement.parentElement.remove();
}



//===[gabo 15 junio experiencia candidato ]===
function agregarFila() {
    if (document.getElementById('div_experience')) {
        const div = document.querySelector('#div_experience');
        const row = document.createElement('div');
        row.classList.add('row');
        row.classList.add('borrados');
        row.style.marginBottom = "0.6rem";
        row.style.border = "1px solid #98AE98";
        row.style.borderRadius = "15px";
        row.style.padding = "1rem";
        row.innerHTML = `
                          <div class="col-md-2">
                            <div class="form-group" style="text-align: center">
                              <label for="" class="col-form-label" style="margin-top:30px">Información:</label>
                            </div>
                          </div>
                        
                          <div class="col-md-4">
                            <div class="form-group" style="text-align: center">
                               <label class="col-form-label">Empresa/puesto:</label>
                              <input type="text" name="enterprise_experience[]"  style="text-align:center" class="multiple form-control" required >
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group" style="text-align: center">
                             <label class="col-form-label">Descripción:</label>
                             <textarea   name="review_experience[]"  rows="4"  class="multiple form-control"  required ></textarea>
                            </div>
                          </div>
                          <div class="col-md-2">
						           	<div class="form-group" style="text-align: center;padding-top:1.3rem">
						           	<btn class="btn btn-danger" onclick="delete_row(this)">
						            	<i class="fas fa-trash"></i> 
						            </btn>
						          	</div>
                         
          `;
        div.appendChild(row);
    }
}

//===[gabo 15 junio experiencia candidato  ]===
function verificar() {
    var empresa = document.getElementById("enterprise_experience").value.trim();
    var descripcion = document.getElementById("review_experience").value.trim();


    var inputs = document.getElementsByClassName("multiple");
    var bandera = false;
    Array.from(inputs).forEach((input) => {
        bandera = true;
    })


    if (bandera == false) {
        if (empresa != "" || descripcion != "") {
            $('#enterprise_experience').prop("required", true);
            $('#review_experience').prop("required", true);

        } else {
            $('#enterprise_experience').removeAttr("required");
            $('#review_experience').removeAttr("required");


        }

    }
}
</script>