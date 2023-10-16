<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?php if (isset($_GET['id'])) : ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url . "vacante/index" ?>">Vacantes</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url . "vacante/ver&id=" . $_GET['id'] ?>"><?= $vacante->vacancy ?></a></li>
              <?php if ($_GET['action'] == 'buscar') : ?>
                <?php if (isset($_GET['area'])) : ?>
                  <li class="breadcrumb-item active">Candidatos del área de <?= $vacante->area ?></li>
                <?php else : ?>
                  <li class="breadcrumb-item"><a href="<?= base_url . "postulaciones/buscar&id=" . $_GET['id'] . "&area=" . Utils::encrypt($vacante->id_area) ?>">Candidatos del área de <b><?= $vacante->area ?></b></a></li>
                  <li class="breadcrumb-item active">Todos los candidatos</li>
                <?php endif ?>
              <?php endif ?>
              <?php if ($_GET['action'] == 'ver') : ?>
                <li class="breadcrumb-item active">Postulaciones</li>
              <?php endif ?>
              <?php if ($_GET['action'] == 'enviados_a_reclutador') : ?>
                <li class="breadcrumb-item"><a href="<?= base_url . "postulaciones/ver&id=" . $_GET['id'] ?>">Postulaciones</a></li>
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
  <?php else : ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <h1>Candidatos</h1>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <?php endif ?>

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
      <?php if (isset($_GET['id'])) : ?>
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
      <?php endif ?>
    </div>
    <div class="row">
      <div class="col-sm-4 ml-auto">
        <?php if ($_GET['controller'] == 'postulaciones') : ?>
          <a class="btn btn-orange float-right btn-lg" href="<?= base_url ?>candidato/crear&vacante=<?= $_GET['id'] ?>">Crear candidato</a>
        <?php else : ?>
          <a class="btn btn-orange float-right btn-lg" href="<?= base_url ?>candidato/crear">Crear candidato</a>
        <?php endif ?>

      </div>
    </div>
  </section>
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Candidatos postulados</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tb_candidates" class="table table-responsive table-striped table-sm" style="display: none;">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th class="filterhead"></th>
              <th class="filterhead"></th>
              <th class="filterhead"></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th class="filterhead"></th>
              <th></th>
              <th></th>
              <th></th>
              <th class="filterhead"></th>
              <th></th>
            </tr>
            <tr>
              <th class="text-center">Foto</th>
              <th>Nombre del candidato</th>
              <th>Edad</th>
              <th>Ciudad</th>
              <th>Estado</th>
              <th>Escolaridad</th>
              <th>Título</th>
              <th>Reseña de su experiencia</th>
              <th>Experiencias</th>
              <th>Fortalezas</th>
              <th class="text-center">Estatus</th>
              <th>Seleccionar</th>
              <th>Descartar</th>
              <th>Fecha de creación</th>
              <th>Creado por</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($candidates as $candidate) : ?>
              <tr>
                <?php
                if (isset($_GET['id'])) {
                  if ($candidate['id_status'] == 1)
                    $bg_status = 'bg-info';
                  elseif ($candidate['id_status'] == 2)
                    $bg_status = 'bg-orange';
                  elseif ($candidate['id_status'] == 3)
                    $bg_status = 'bg-success';
                  elseif ($candidate['id_status'] == 5)
                    $bg_status = 'bg-navy';
                  elseif ($candidate['id_status'] == 6)
                    $bg_status = 'bg-danger';
                  else
                    $bg_status = 'bg-secondary bg-gradient';
                }
                /*if ($candidate['created_by'] == 'Janet Monserrat Gómez López') {
                        $recruiter_color = 'bg-success';
                      }elseif($candidate['created_by'] == 'Ernesto Iván Sánchez Vizcaya'){
                        $recruiter_color = 'bg-orange';
                      }elseif ($candidate['created_by'] == 'María Graciela López Rodríguez') {
                        $recruiter_color = 'bg-warning';
                      }elseif($candidate['created_by'] = 'Verónica Lizeth Hernández Zuviri'){
                        $recruiter_color = 'bg-danger';
                      }elseif ($candidate['created_by'] == 'Lorena Patricia De La Rosa González') {
                        $recruiter_color = 'bg-navy';
                      }else{
                        $recruiter_color = '';
                      }*/

                ?>
                <td class="image"><img class="img-circle img-fluid img-responsive elevation-2" src="<?= $candidate['avatar'] ?>" style="width:60px; height:auto;"></td>
                <td><?= $candidate['first_name'] . ' ' . $candidate['surname'] . ' ' . $candidate['last_name'] ?></td>
                <td><?= $candidate['age'] ?></td>
                <td><?= $candidate['city'] ?></td>
                <td><?= $candidate['state'] ?></td>
                <td><?= $candidate['level'] ?></td>
                <td><?= $candidate['job_title'] ?></td>
                <td><?= Utils::lineBreak($candidate['description']) ?></td>
                <td><?= Utils::lineBreak($candidate['experiences']) ?></td>
                <td><?= $candidate['aptitudes'] ?></td>
                <td class="<?= $bg_status ?> text-center align-middle"><?= $candidate['status'] ?></td>
                <td class="align-middle text-center">

                  <?php if ($candidate['id_status'] <= 2 || $candidate['id_status'] == 5) : ?>
                    <a href="<?= base_url ?>postulaciones/send_to_customer&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>&id_status=<?= $candidate['id_status'] ?>" class="btn"><i class="far fa-thumbs-up" style="font-size: large;"></i></a>
                    <!-- <button class="btn btn-select" data-id="<?= Encryption::encode($candidate['id']) ?>" data-status="<?= $candidate['id_status'] ?>"><i class="far fa-thumbs-up" style="font-size: large;"></i></button> -->
                  <?php else : ?>

                    <?php if ($candidate['id_status'] == 3) : ?>
                      <a href="<?= base_url ?>postulaciones/send_to_customer&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>&id_status=<?= $candidate['id_status'] ?>" class="btn"><i class="fas fa-thumbs-up" style="font-size: large;"></i></a>
                      <!-- <button class="btn btn-select" data-id="<?= Encryption::encode($candidate['id']) ?>" data-status="<?= $candidate['id_status'] ?>"><i class="fas fa-thumbs-up" style="font-size: large;"></i></button> -->
                    <?php endif ?>

                  <?php endif ?>
                </td>




                <td class="align-middle text-center">
                  <?php if ($candidate['id_status'] <= 2 || $candidate['id_status'] == 5) : ?>
                    <a href="<?= base_url ?>postulaciones/discard&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>&id_status=<?= $candidate['id_status'] ?>" class="btn"><i class="far fa-thumbs-down" style="font-size: large;"></i></a>
                    <!-- <button class="btn btn-discard" data-id="<?= Encryption::encode($candidate['id']) ?>" data-status="<?= $candidate['id_status'] ?>"><i class="far fa-thumbs-down" style="font-size: large;"></i></button> -->
                  <?php endif ?>
                  <?php if ($candidate['id_status'] == 6) : ?>
                    <a href="<?= base_url ?>postulaciones/discard&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>&id_status=<?= $candidate['id_status'] ?>" class="btn"><i class="fas fa-thumbs-down" style="font-size: large;"></i></a>
                    <!-- <button class="btn btn-discard" data-id="<?= Encryption::encode($candidate['id']) ?>" data-status="<?= $candidate['id_status'] ?>"><i class="fas fa-thumbs-down" style="font-size: large;"></i></button> -->
                  <?php endif ?>
                </td>

                <td><?= Utils::getShortDate($candidate['created_at']) ?></td>
                <td class=""><?= $candidate['created_by'] ?></td>
                <td class="text-right py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <a href="<?= base_url ?>candidato/ver&id=<?= Encryption::encode($candidate['id']) ?>&vacante=<?= $_GET['id'] ?>" class="btn btn-success">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <a href="<?= base_url ?>candidato/editar&id=<?= Encryption::encode($candidate['id']) ?>" class="btn btn-info">
                      <i class="fas fa-pencil-alt"></i> Editar
                    </a>
                    <a href="<?= base_url ?>resume/generate&id=<?= Encryption::encode($candidate['id']) ?>" target="_blank" class="btn btn-danger">
                      <i class="fas fa-download"></i> Plantilla
                    </a>
                    <?php if (isset($candidate['resume'])) : ?>
                      <a href="<?= $candidate['resume'] ?>" target="_blank" class="btn btn-orange">
                        <i class="fas fa-file-download"></i> CV
                      </a>
                    <?php endif ?>
                    <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'enviados_a_reclutador' && isset($_GET['id']) && (Utils::isAdmin() || Utils::isSenior())) : ?>
                      <button type="button" id="<?= $candidate['id_applicant'] ?>" class="btn btn-secondary btn-comments">
                        <i class="far fa-comment"></i> Comentarios
                      </button>
                    <?php endif ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>

          <tfoot>
            <tr>
              <th>Foto</th>
              <th>Nombre del candidato</th>
              <th>Edad</th>
              <th>Ciudad</th>
              <th>Estado</th>
              <th>Escolaridad</th>
              <th>Título</th>
              <th>Reseña de su experiencia</th>
              <th>Experiencias</th>
              <th>Fortalezas</th>
              <th class="text-center">Estatus</th>
              <th>Seleccionar</th>
              <th>Descartar</th>
              <th>Fecha de creación</th>
              <th>Creado por</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<script>
  $(document).ready(function() {
    let table = document.querySelector('#tb_candidates');
    table.style.display = "block";
    utils.dtTable(table, true);
  });
</script>
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
              <textarea class="form-control" name="interview_comments" rows="10" id="interview_comments"></textarea>
            </div>
            <div class="form-group mb-3">
              <label class="col-form-label" for="interview_date">Fecha de entrevista</label>
              <input type="date" class="form-control" id="interview_date" name="interview_date" value="<?= date("Y-m-d") ?>">
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
  <script type="text/javascript">
    /*document.addEventListener('DOMContentLoaded', e => {
    document.querySelector('#tb_candidates').addEventListener('click', e => {
      if (e.target.classList.contains('btn-select') || e.target.offsetParent.classList.contains('btn-select')) {
          let ID, status;
          if (e.target.classList.contains('btn-select')){
              ID = e.target.dataset.id;
              status = e.target.dataset.status;
          }else{
              ID = e.target.offsetParent.dataset.id;
              status = e.target.dataset.status;
          }
          let applicant = new Applicant();
          applicant.getContacto(ID);
      }
      e.stopPropagation();
    })
  })*/
  </script>
<?php endif ?>