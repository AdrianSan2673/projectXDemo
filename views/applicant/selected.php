<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left mb-2">
            <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url . "vacante/index" ?>">Vacantes</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url . "vacante/ver&id=" . $_GET['id'] ?>"><?= $vacante->vacancy ?></a></li>
            <?php if (!Utils::isCustomer()) : ?>
              <li class="breadcrumb-item"><a href="<?= base_url . "postulaciones/ver&id=" . $_GET['id'] ?>">Postulaciones</a></li>
              <!-- <li class="breadcrumb-item"><a href="<?= base_url . "postulaciones/enviados_a_reclutador&id=" . $_GET['id'] ?>">Candidatos enviados por ej. de búsqueda</a></li> -->
            <?php endif ?>

            <li class="breadcrumb-item active">Candidatos selectos</li>
          </ol>
        </div>
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Candidatos selectos para el puesto de <b><?= $vacante->vacancy ?></b></h3>
          </div>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content-header">
    <div class="row">
      <div class="col-md-4">
        <div class="info-box mb-3 bg-navy">
          <span class="info-box-icon"><i class="fas fa-address-card"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total de candidatos selectos</span>
            <span class="info-box-number"><?= count($candidates) ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card car-success">
      <div class="card-body">
        <div class="row d-flex align-items-stretch">
          <?php foreach ($candidates as $candidate) : ?>
            <div class="col-12 col-sm-6 col-md-4  align-items-stretch">
              <!-- gabo act -->
              <?php if ($candidate['id_status'] == 3 and $candidate['id_profile'] != "") {
                $color = 'card-info';
                $tipo_estatus = 'Notas de entrevista realizadas';
              } else if ($candidate['id_status'] == 7) {
                $color = 'card-danger';
                $tipo_estatus = 'Descartado';
              } else if ($candidate['id_status'] == 4) {
                $color = 'card-warning';
                $tipo_estatus = 'Elegido';
              } else {
                $color = 'card-secondary';
                $tipo_estatus = 'Pendiente';
              } ?>


              <div class="card <?= $color ?> ">
                <div class="card-header">
                  <h6><?= $tipo_estatus ?></h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img src="<?= $candidate['avatar'] ?>" alt="<?= $candidate['first_name'] ?>" class="profile-user-img img-circle img-fluid">
                  </div>

                  <h2 class="profile-username text-center">
                    <?= $candidate['first_name'] . ' ' . $candidate['surname'] . ' ' . $candidate['last_name'] ?>
                  </h2>
                  <p class="text-muted text-center"><?= mb_strtoupper($candidate['job_title']) ?></p>
                  <?php if ($candidate['id_status'] == 4) : ?>
                    <p class="text-orange text-xl text-center">
                      <i class="fas fa-trophy"></i>
                    </p>
                  <?php endif ?>
                  <?php if ($candidate['customer_date'] != '') : ?>
                    <p class="text-center"><i class="fas fa-check-circle"></i> Enviado el <?= Utils::getFullDate($candidate['customer_date']) ?></p>
                  <?php endif ?>
                  <p class="text-muted text-center">
                    <?= $candidate['description'] ?>
                  </p>
                  <!-- gabi act -->
                  <?php if ($candidate['id_status'] == 7) : ?>

                    <p class="text-muted text-center">
                      <b>Motivos de descartado: </b>
                      <i class="fas fa-message"> </i>
                      <?= $candidate['comments'] ?>
                    </p>

                    <p class="text-muted text-center">
                      <b>Fecha de descarte:</b>
                      <?= Utils::getFullDate($candidate['descard_date']) ?>
                    </p>
                  <?php endif;  ?>
                  <!-- fin gabo act -->

                  <div hidden>
                    <hr>
                    <b>Reseña</b><br>
                    <p class="text-muted">
                      <?= $candidate['about'] ?>
                    </p>
                    <?php if (!empty($candidate['interview_comments'])) : ?>
                      <hr>
                      <b>Comentarios de la entrevista | <?= Utils::getShortDate($candidate['interview_date']) ?></b>
                      <p class="text-muted"><?= $candidate['interview_comments'] ?></p>
                    <?php endif ?>
                  </div>

                  <?php if (!Utils::isCustomer()) : ?>

                    <a href="<?= base_url ?>postulaciones/descripcion_candidato&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>" class="btn btn-lg btn-info btn-block" hidden><i class="fas fa-pen"></i> Editar</a>
                    <hr>

                    <?php if ($candidate['id_status'] == 3) : ?>
                      <form method="post" action="./choose_for_vacancy">
                        <input type="hidden" name="id_candidate" value="<?= Encryption::encode($candidate['id']) ?>">
                        <input type="hidden" name="id_vacancy" value="<?= $_GET['id'] ?>">
                        <input type="hidden" name="id_status" value="3">
                        <div class="form-group">
                          <label for="entry_date" class="col-form-label">Fecha de ingreso</label>
                          <input type="date" name="entry_date" class="form-control" value="<?= $candidate['entry_date'] ?>">
                        </div>
                        <div class="form-group" hidden>
                          <label class="col-form-label" for="amount">Monto a facturar</label>
                          <input type="number" name="amount" class="form-control" value="<?= round($candidate['amount'], 2) ?>" step="0.01">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-lg btn-orange btn-block"><i class="far fa-thumbs-up"></i> Elegir para la vacante</button>
                        </div>

                        <div class="form-group" <?= $candidate['id_profile'] == null ? 'hidden' : ''  ?>>
                          <p class="text-center"><i class="fas fa-check-circle"></i> Candidato Entrevistado</p>

                        </div>

                      </form>
                    <?php endif ?>

                    <?php if ($candidate['id_status'] == 4) : ?>
                      <form method="post" action="./choose_for_vacancy">
                        <input type="hidden" name="id_candidate" value="<?= Encryption::encode($candidate['id']) ?>">
                        <input type="hidden" name="id_vacancy" value="<?= $_GET['id'] ?>">
                        <input type="hidden" name="id_status" value="4">
                        <div class="form-group">
                          <label for="entry_date" class="col-form-label">Fecha de ingreso</label>
                          <input type="date" name="entry_date" class="form-control" value="<?= $candidate['entry_date'] ?>">
                        </div>
                        <div class="form-group">
                          <label class="col-form-label" for="amount">Monto a facturar</label>
                          <input type="number" name="amount" class="form-control" value="<?= round($candidate['amount'], 2) ?>" step="0.01">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-lg btn-secondary btn-block"><i class="far fa-thumbs-down"></i> Descartar de la vacante</button>
                        </div>
                      </form>
                    <?php endif ?>
                    <?php if ($_SESSION['identity']->id == 1) : ?>
                      <a href="<?= base_url ?>psicometria/crear&candidate=<?= Encryption::encode($candidate['id']) ?>&customer=<?= Encryption::encode($vacante->id_customer) ?>" target="_blank" class="btn btn-lg btn-outline-info btn-block"><i class="fas fa-brain"></i> Registrar una psicometría</a>
                    <?php endif ?>

                  <?php endif ?>
                </div>
                <div class="card-footer">
                  <div class="text-center">

                    <?php if (!Utils::isCustomer()) : ?>
                      <a href="<?= base_url ?>resume/generate&id=<?= Encryption::encode($candidate['id']) ?>" target="_blank" class="btn btn-lg bg-maroon " hidden>
                        <i class="fas fa-download mr-1"></i>Generar CV
                      </a>

                      <a href="<?= base_url ?>candidato/editar&id=<?= Encryption::encode($candidate['id']) ?>" class="btn btn-lg btn-success mr-1" target="_blank">
                        <i class="fas fa-user "></i> Ver perfil
                      </a>
                    <?php endif ?>

                    <!-- // ===[20 mayo gabo operativa ]=== -->
                    <?php if ($vacante->type == 1) : ?>
                      <a href="<?= base_url ?>resume/CVoperador&id=<?= Encryption::encode($candidate['id']) ?>" target="_blank" class="btn btn-lg bg-maroon">
                        <i class="fas fa-download mr-1"></i>Generar CV
                      </a>
                    <?php endif ?>
                    <!-- // ===[20 mayo gabo estudios  operativa fin]=== -->

                    <?php if (isset($candidate['resume'])) : ?>
                      <a href="<?= $candidate['resume'] ?>" target="_blank" class="btn btn-lg btn-orange mt-1">
                        <i class="fas fa-file-download"></i> Descargar Currículum vitae
                      </a>
                    <?php endif ?>

                    <?php if ($candidate['video_call_url']) : ?>
                      <a href="<?= $candidate['video_call_url'] ?>" target="_blank" class="btn btn-lg btn-warning">
                        <i class="fas fa-video mr-1"></i> Videollamada
                      </a>
                    <?php endif ?>

                    <!--=============================[Gabo Marzo 21]======================== -->
                    <?php if ((Utils::isAdmin()) && ($candidate['id_status'] == 3)) : ?>
                      <btn class="btn btn-lg btn-info mr-1" onclick="metodo('<?= Encryption::encode($candidate['id']) ?>')">
                        <i class="fas fa-arrows-alt"></i> Mover
                      </btn>
                    <?php endif ?>

                    <?php if ((Utils::isAdmin() || Utils::isSenior() || Utils::isRecruitmentManager() || Utils::isCustomer()) && ($candidate['id_status'] == 3 || $candidate['id_status'] == 4|| $candidate['id_status'] == 7)) : ?>
                      <btn class="btn btn-lg btn-warning mr-1" style="margin: 3px;" onclick="abrir_formato('<?= Encryption::encode($candidate['id']) ?>','<?= $_GET['id']  ?> ','<?= $candidate['avatar'] ?>')" <?= Utils::isCustomer() && $candidate['id_profile'] == null ? 'hidden' : ''  ?>>
                        <i class="fas fa-file-invoice  "></i> Notas de entrevista
                      </btn>
                    <?php endif ?>

                    <!-- gabo act -->
                    <?php if ((Utils::isAdmin() || Utils::isSenior() || Utils::isRecruitmentManager() || Utils::isCustomer()) && ($candidate['id_status'] == 3)) : ?>
                      <btn class="btn btn-lg btn-danger mt-1" onclick="descartar('<?= Encryption::encode($candidate['id']) ?>','<?= $_GET['id']; ?>','<?= $candidate['id_status'] ?>','<?= $candidate['first_name'] . ' ' . $candidate['surname'] . ' ' . $candidate['last_name'] ?>')">
                        <i class="fas fa-times-circle "></i> Descartar
                      </btn>
                    <?php endif ?> 
                    <!-- GABO REACTIVAR -->
                    <?php if ((Utils::isAdmin() || Utils::isSenior() || Utils::isRecruitmentManager() || Utils::isCustomer())  && ($candidate['id_status'] == 7)) : ?>
                      <btn class="btn btn-lg btn-info  " onclick="reactivar('<?= Encryption::encode($candidate['id']) ?>','<?= $_GET['id']; ?>','<?= $candidate['id_status'] ?>','<?= $candidate['first_name'] . ' ' . $candidate['surname'] . ' ' . $candidate['last_name'] ?>')">
                        <i class="fas fa-badge-check"></i> Reactivar
                      </btn>
                    <?php endif ?>

                    <!-- GABO DELETE -->
                    <?php if (Utils::isAdmin()) : ?>
                      <btn class="btn btn-lg btn-dark mt-1 " onclick="eliminar('<?= Encryption::encode($candidate['id']) ?>','<?= $_GET['id']; ?>','<?= $candidate['id_status'] ?>','<?= $candidate['first_name'] . ' ' . $candidate['surname'] . ' ' . $candidate['last_name'] ?>')">
                        <i class="fas fa-user-slash"></i> Eliminar
                      </btn>
                    <?php endif ?>

                  </div>
                </div>
              </div>
            </div>
          <?php endforeach ?>

        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<script src="<?= base_url ?>app/candidate.js?v=<?= rand() ?>"></script>
<script>
  //==================================[Gabo Marzo 21]========================
  function metodo(valor) {
    $("#id_candidato").val(valor);

    $('#modal_mover_postulante').modal({
      backdrop: 'static',
      keyboard: false
    });
    $('#id_vacancy').val('1'); // Select the option with a value of '1'
    $('#id_vacancy').trigger('change');
  }
  //===========================================================

  //======================[Gabo Marzo 28 Perfil Postulado]=======

  function abrir_formato(id_candidate, id_vacancy, image) {
    if(document.getElementById('div_experience')){
    const div = document.querySelector('#div_experience');
    div.innerHTML = ``;
    row='';


    row += `
  <div class="row borrados">
    <div class="col-md-2">
    <div class="form-group" style="text-align: center">
      <label for="" class="col-form-label" style="margin-top:30px">Descripción:</label>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group" style="text-align: center">
      <label class="col-form-label">Empresa</label>
      <input type="text" name="enterprise_experience[]"  style="text-align:center" value="" class=" form-control"  >
    </div>
    </div>

    <div class="col-md-5">
    <div class="form-group" style="text-align: center">
      <label class="col-form-label">Puesto</label>
      <input type="text" name="position_experience[]" value="" style="text-align:center"  class=" form-control">
    </div>
    </div>
    <div class="col-md-1">
    <div class="form-group" style="text-align: center;padding-top:1.3rem">
    </div>
    </div> `;


    row += `</div></div>`;

    div.innerHTML = row;

    }

  let vacancy = new Vacancy();
  let form = document.querySelector('#modal_perfil_postulante form');
  form.reset();
  vacancy.llenar_perfil(id_vacancy);

  let candidate = new Candidate();
  candidate.llenar_perfil(id_candidate, id_vacancy);

  $("#id_candidate").val(id_candidate);
  $("#vacancy_id").val(id_vacancy);
  $('#photo').attr('src', image);

  $('#modal_perfil_postulante').modal({
    backdrop: 'static',
    keyboard: false
  });

  }
  //===========================================================

  //gabo act
  function descartar(id_candidate, id_vacancy, id_status, nombre) {

    $("#id_candidate_modal").val(id_candidate);
    $("#id_vacancy_modal").val(id_vacancy);
    $("#id_status_modal").val(id_status);
    document.querySelector('#titulo').innerHTML = nombre;

    $('#modal_descartar_postulante').modal({
      backdrop: 'static',
      keyboard: false
    });

  }

  function reactivar(id_candidate, id_vacancy, id_status, nombre) {
    $("#id_candidate_reactivar").val(id_candidate);
    $("#id_vacancy_reactivar").val(id_vacancy);
    $("#id_status_reactivar").val(id_status);
    document.querySelector('#nombre_reactivar').innerHTML = nombre;
    // href="<?= base_url ?>postulaciones/send_to_customer&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>&id_status=<?= $candidate['id_status'] ?>"
    $('#modal_reactivar_postulante').modal({
      backdrop: 'static',
      keyboard: false
    });
  }


  function eliminar(id_candidate, id_vacancy, id_status, nombre) {

    $("#id_candidate_eliminar").val(id_candidate);
    $("#id_vacancy_eliminar").val(id_vacancy);
    $("#id_status_eliminar").val(id_status);
    document.querySelector('#nombre_eliminar').innerHTML = nombre;

    $('#modal_eliminar_postulante').modal({
      backdrop: 'static',
      keyboard: false
    });

  }
</script>