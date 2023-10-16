<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left mb-2">
            <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Vacantes</li>
          </ol>
        </div>
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h1>Vacantes<?= Utils::isCustomer() ? ' <b>' . $customerName . '</b>' : '' ?></h1>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <?php if ($_GET['action'] == 'index') : ?>
    <section class="content-header">
      <div class="container-fluid">
        <form method="POST" action="<?= base_url . "vacante/index" ?>" class="row">
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="start_date" class="col-form-label">Fecha inicial:</label>
              <input type="date" name="start_date" id="start_date" value="<?= isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d') ?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="end_date" class="col-form-label">Fecha final:</label>
              <input type="date" name="end_date" id="end_date" value="<?= isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d') ?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-2" style="padding-right: 14px;">
            <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar</button>
          </div>
        </form>
      </div>
    </section>
  <?php endif ?>
  <section class="content-header">
    <div class="row">
      <div class="col-md-4">
        <div class="info-box mb-3 bg-navy">
          <span class="info-box-icon"><i class="fas fa-briefcase"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total de operaciones ingresadas en <?= strftime('%B') ?></span>
            <span class="info-box-number"><?= !Utils::isCustomer() ? Statistics::getVacancyCountInCurrentMonth() : $inCurrentMont ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box mb-3 bg-info">
          <span class="info-box-icon"><i class="fas fa-briefcase"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total de operaciones en proceso en <?= strftime('%B') ?></span>
            <span class="info-box-number"><?= !Utils::isCustomer() ? Statistics::getVacancyInProcessCount() : $inProcess ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box mb-3 bg-maroon">
          <span class="info-box-icon"><i class="fas fa-briefcase"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total de operaciones cerradas en <?= strftime('%B') ?></span>
            <span class="info-box-number"><?= !Utils::isCustomer() ? Statistics::getVacancyClosedCountInCurrentMonth() :  $closeInCurrent ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2 ml-auto">
        <a class="btn btn-orange float-right" href="<?= base_url ?>vacante/crear">Crear vacante</a>
      </div>
    </div>
  </section>
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Listado de vacantes</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body ">
        <table id="tb_vacancies" class="table <?= Utils::isManager() ? 'table-head-fixed text-nowrap' : '' ?> table-striped table-sm table-responsive" style="display: none; <?= Utils::isManager() ? 'height: 400px;' : '' ?>">
          <thead>
            <tr>
              <th></th>
              <th class="filterhead"></th>
              <th></th>
              <?php if (!Utils::isCustomer()) : ?>
                <th class="filterhead"></th>
              <?php endif ?>
              <th></th>
              <th class="filterhead"></th>
              <th class="filterhead"></th>
              <?php if (!Utils::isCustomer()) : ?>
                <th class="filterhead"></th>
              <?php endif ?>
              <?php if (Utils::isCustomer()) : ?>
                <th class="text-center filterhead"></th>
              <?php endif ?>
              <th></th>
              <?php if (!Utils::isCustomer()) : ?>
                <th></th>
              <?php endif ?>
              <?php if (Utils::isAdmin() || Utils::isManager()) : ?>
                <!-- <th></th> -->
                <th></th>
              <?php endif ?>
              <?php if (Utils::isSenior()) : ?>
                <!-- <th></th> -->
                <th></th>
              <?php endif ?>
              <?php if (Utils::isJunior()) : ?>
                <!-- <th></th> -->
              <?php endif ?>
              <?php if (Utils::isCustomer()) : ?>
                <th></th>
              <?php endif ?>
              <?php if (!Utils::isCustomer()) : ?>
                <!-- <th></th> -->
                <th></th>
                <th></th>
                <th></th>
              <?php endif ?>
              <th></th>
              <?php if (!Utils::isCustomer()) : ?>
                <th></th>
              <?php endif ?>
              <!-- <th class="filterhead"></th> -->
              <th></th>
              <th class="filterhead"></th>
              <th></th>
            </tr>
            <tr>
              <th class="align-middle">Folio</th>
              <th class="align-middle">Reclutador</th>
              <th class="align-middle">Fecha de recepción</th>
              <?php if (!Utils::isCustomer()) : ?>
                <th class="align-middle">Cliente</th>
              <?php endif ?>
              <th class="align-middle">Vacante</th>
              <th class="align-middle">Tipo</th>
              <th class="align-middle">Ciudad</th>
              <?php if (!Utils::isCustomer()) : ?>
                <th class="align-middle text-center">CC</th>
              <?php endif ?>
              <?php if (Utils::isCustomer()) : ?>
                <th class="align-middle text-center">Facturable a</th>
              <?php endif ?>
              <th class="align-middle text-center">Sueldo</th>
              <?php if (!Utils::isCustomer()) : ?>
                <th class="align-middle text-center">Nuevas Postulaciones</th>
              <?php endif ?>
              <?php if (Utils::isAdmin() || Utils::isManager()) : ?>
                <!-- <th class="align-middle">Candidatos captados por Ej. Busq.</th> -->
                <th class="align-middle">Candidatos compartidos al cliente</th>
              <?php endif ?>
              <?php if (Utils::isSenior()) : ?>
                <!-- <th class="align-middle">Candidatos recibidos</th> -->
                <th class="align-middle">Candidatos compartidos al cliente</th>
              <?php endif ?>
              <?php if (Utils::isJunior()) : ?>
                <!-- <th class="align-middle">Candidatos enviados a Ej. Recl.</th> -->
              <?php endif ?>
              <?php if (Utils::isCustomer()) : ?>
                <th class="align-middle">Candidatos adecuados al perfil</th>
              <?php endif ?>
              <?php if (!Utils::isCustomer() && !Utils::isCandidate()) : ?>
                <!-- <th class="align-middle">Posiciones</th> -->
                <th class="align-middle">Posiciones por cubrir</th>
                <th>Fecha de Autorización</th>
                <th class="align-middle">Fecha de compromiso de envío</th>
              <?php endif ?>
              <th>Fecha real de envío</th>
              <?php if (!Utils::isCustomer()) : ?>
                <th class="align-middle">Fecha de finalización</th>
              <?php endif ?>
              <!-- <th class="align-middle">T</th> -->
              <th class="align-middle">Días</th>
              <th class="align-middle">Estado</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($vacancies as $vacancy) : ?>
              <tr>
                <?php switch ($vacancy['id_status']) {
                  case 1:
                    $class_color = 'bg-info';
                    break;
                  case 2:
                    $class_color = 'bg-success';
                    break;
                  case 3:
                    $class_color = 'bg-orange';
                    break;
                  case 4:
                    $class_color = 'bg-navy';
                    break;
                  case 5:
                    $class_color = 'bg-maroon';
                    break;
                  case 8:
                    $class_color = 'bg-warning';
                    break;
                  default:
                    $class_color = '';
                    break;
                }

                //if ($vacancy['time'] == 72) {
                if ($vacancy['n_days'] < 3)
                  $day_color = 'bg-success';
                elseif ($vacancy['n_days'] == 3)
                  $day_color = 'bg-orange';
                else
                  $day_color = 'bg-danger';
                /*}else{
                          if ($vacancy['n_days'] < 5)
                            $day_color = 'bg-success';
                          elseif ($vacancy['n_days'] == 5)
                            $day_color = 'bg-orange';
                          else
                            $day_color = 'bg-danger';
                        }*/

                if ($vacancy['new_n_applicants'] > 0)
                  $new_applicant_color = 'btn-info';
                else
                  $new_applicant_color = 'btn-secondary';

                //if ($vacancy['n_applicants'] <= 3) {
                if ($vacancy['real_n_applicants'] <= 3) {
                  $applicant_color = 'btn-danger';
                } elseif ($vacancy['n_applicants'] > 4) {
                  $applicant_color = 'btn-success';
                } else {
                  $applicant_color = 'btn-warning';
                }

                if ($vacancy['n_sent'] <= 3) {
                  $sent_color = 'btn-danger';
                } elseif ($vacancy['n_sent'] > 4) {
                  $sent_color = 'btn-success';
                } else {
                  $sent_color = 'btn-warning';
                }

                if ($vacancy['n_selected'] <= 3) {
                  $selected_color = 'btn-danger';
                } elseif ($vacancy['n_selected'] > 4) {
                  $selected_color = 'btn-success';
                } else {
                  $selected_color = 'btn-warning';
                }

                if ($vacancy['id_recruiter'] == 6113) { //michell
                  $recruiter_color = 'bg-navy';
                } elseif ($vacancy['id_recruiter'] == 1550) { //miros
                  $recruiter_color = 'bg-maroon';
                } elseif ($vacancy['id_recruiter'] == 24) { //cindy
                  $recruiter_color = 'bg-info';
                } elseif ($vacancy['id_recruiter'] == 333) { //vero
                  $recruiter_color = 'bg-warning';
                } elseif ($vacancy['id_recruiter'] == 2276) { //gisel
                  $recruiter_color = 'bg-success';
                } elseif ($vacancy['id_recruiter'] == 42) { //ivan
                  $recruiter_color = 'bg-gray';
                } elseif ($vacancy['id_recruiter'] == 4441) { //cinthiapaez
                  $recruiter_color = 'bg-fuchsia';
                } elseif ($vacancy['id_recruiter'] == 4094) { //melissabarron
                  $recruiter_color = 'bg-orange';
                } elseif ($vacancy['id_recruiter'] == 3908) //aglay
                  $recruiter_color = 'bg-purple';
                elseif ($vacancy['id_recruiter'] == 2096) //Sin ejecutivo
                  $recruiter_color = 'table-maroon';
                else {
                  $recruiter_color = 'bg-danger';
                }
                ?>
                <td class="align-middle h6"><?= $vacancy['id'] ?></td>
                <td class="align-middle <?= $recruiter_color ?>">
                  <?= $vacancy['recruiter'] != ' ' ? $vacancy['recruiter'] : 'Sin asignar' ?>
                </td>
                <td class="align-middle"><?= Utils::getFullDate($vacancy['request_date']); ?></td>
                <?php if (!Utils::isCustomer()) : ?>
                  <td class="align-middle"><?= $vacancy['customer'] ?></td>
                <?php endif ?>
                <td class="align-middle celda" data-id="<?= base_url.'usuario/index?vacante='.Encryption::encode($vacancy['id'])?>"><?= $vacancy['vacancy'] ?></td>
                <td class="align-middle"><?= $vacancy['type'] == 1 ? 'Operativa' : ($vacancy['type'] == 2 ? 'Orden común' : ($vacancy['type'] == 3 ? 'Head Hunting' : ($vacancy['type'] == 4 ? 'Iguala' : ''))) ?></td>
                <td class="align-middle"><?= $vacancy['city'] . ', ' . $vacancy['abbreviation'] ?></td>
                <?php if (!Utils::isCustomer()) : ?>
                  <td class="align-middle text-center"><?= $vacancy['cost_center'] ?></td>
                <?php endif ?>
                <?php if (Utils::isCustomer()) : ?>
                  <td class="align-middle"><?= $vacancy['business_name'] ?></td>
                <?php endif ?>
                <td class="align-middle text-center">$<?= $vacancy['salary_min'] != $vacancy['salary_max'] ? number_format($vacancy['salary_min'])  . ' - $' . number_format($vacancy['salary_max']) : number_format($vacancy['salary_min']) ?></td>
                <?php if (!Utils::isCustomer()) : ?>
                  <?php if ($vacancy['real_n_applicants'] > 0) : ?>
                    <td class="align-middle text-center"><a class="font-weight-bold btn <?= $new_applicant_color ?>" href="<?= base_url ?>postulaciones/ver&id=<?= Encryption::encode($vacancy['id']) ?>"><?= $vacancy['new_n_applicants'] ?></a></td>
                  <?php else : ?>
                    <td class="align-middle text-center"><?= $vacancy['real_n_applicants'] ?></td>
                  <?php endif ?>
                <?php endif ?>

                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSenior() || Utils::isJunior()) : ?>
                  <?php if ($vacancy['n_sent'] > 0) : ?>
                    <!-- <td class="align-middle text-center"><a class="font-weight-bold btn <?= $sent_color ?>" href="<?= base_url ?>postulaciones/enviados_a_reclutador&id=<?= Encryption::encode($vacancy['id']) ?>"><?= $vacancy['n_sent'] ?></a></td> -->
                  <?php else : ?>
                    <!-- <td class="align-middle text-center"><?= $vacancy['n_sent'] ?></td> -->
                  <?php endif ?>
                <?php endif ?>
                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSenior() || (Utils::isCustomer() && $vacancy['id_status'] != 7)) : ?>
                  <?php if ($vacancy['n_selected'] > 0) : ?>
                    <td class="align-middle text-center"><a class="font-weight-bold btn <?= $selected_color ?>" href="<?= base_url ?>postulaciones/enviados_a_cliente&id=<?= Encryption::encode($vacancy['id']) ?>"><?= $vacancy['n_selected'] ?></a></td>
                  <?php else : ?>
                    <td class="align-middle text-center"><?= $vacancy['n_selected'] ?></td>
                  <?php endif ?>
                <?php else : ?>
                  <?php if ((Utils::isCustomer() && $vacancy['id_status'] == 7)) : ?>
                    <td class="align-middle text-center"><?= $vacancy['n_selected'] ?></td>
                  <?php endif ?>
                <?php endif ?>
                <?php if (!Utils::isCustomer()) : ?>
                  <!-- <td class="align-middle text-center"><?= $vacancy['position_number'] ?></td> -->
                  <td class="align-middle text-center"><?= $vacancy['id_status'] < 5 || $vacancy['id_status'] == 8 ? $vacancy['position_number'] - $vacancy['n_chosen'] : 0 ?></td>
                  <td class="align-middle text-center"><?= $vacancy['authorization_date'] ? Utils::getFullDate($vacancy['authorization_date']) : '' ?></td>
                  <td class="align-middle text-center"><?= $vacancy['commitment_date'] == '' ? '' : Utils::getDate($vacancy['commitment_date']) ?></td>
                <?php endif ?>
                <td class="align-middle"><?= $send_date = $vacancy['send_date'] != NULL ? Utils::getFullDate($vacancy['send_date']) : '' ?></td>
                <?php if (!Utils::isCustomer()) : ?>
                  <td class="align-middle"><?= $end_date = $vacancy['end_date'] != NULL ? Utils::getFullDate($vacancy['end_date']) : '' ?></td>
                <?php endif ?>
                <!-- <td class="align-middle text-center <?= $vacancy['time'] == 72 ? 'bg-lightblue' : 'bg-purple' ?>"><?= $vacancy['time'] ?></td> -->
                <td class="<?= $day_color ?> align-middle text-center"><?= $vacancy['number_days'] ?></td>
                <td class="align-middle text-center <?= $class_color ?>"><?= $vacancy['status'] ?></td>
                <td class="text-center py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <a href="<?= base_url ?>vacante/ver&id=<?= Encryption::encode($vacancy['id']) ?>" class="btn btn-success">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <?php if (Utils::isAdmin() || Utils::isSales() || Utils::isSalesManager()) : ?>
                      <a href="<?= base_url ?>vacante/editar&id=<?= Encryption::encode($vacancy['id']) ?>" class="btn btn-info">
                        <i class="fas fa-pencil-alt"></i> Editar
                      </a>
                    <?php endif ?>
                    <?php if (Utils::isAdmin() || Utils::isSenior() || Utils::isJunior()) : ?>
                      <a href="<?= base_url ?>postulaciones/buscar&id=<?= Encryption::encode($vacancy['id']) ?>&area=<?= Encryption::encode($vacancy['id_area']) ?>" class="btn btn-navy">
                        <i class="fas fa-search"></i> Buscar
                      </a>
                    <?php endif ?>
                    <?php if (Utils::isAdmin() || Utils::isSenior() || Utils::isJunior()) : ?>
                      <a href="<?= base_url ?>candidato/crear&vacante=<?= Encryption::encode($vacancy['id']) ?>" class="btn btn-orange">
                        <i class="fas fa-user-plus"></i> Agregar
                      </a>
                    <?php endif ?>
                    <?php if (Utils::isAdmin()) : ?>
                      <button type="button" id="<?= $vacancy['id'] ?>" class="btn btn-secondary btn-config">
                        <i class="fas fa-cog"></i> Configurar
                      </button>
                    <?php endif ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
          <tfoot>
            <tr>
              <th>Folio</th>
              <th>Reclutador</th>
              <th>Fecha de recepción</th>
              <?php if (!Utils::isCustomer()) : ?>
                <th>Cliente</th>
              <?php endif ?>
              <th>Vacante</th>
              <th>Tipo</th>
              <th>Ciudad</th>
              <?php if (!Utils::isCustomer()) : ?>
                <th>CC</th>
              <?php endif ?>
              <?php if (Utils::isCustomer()) : ?>
                <th class="text-center">Facturable a</th>
              <?php endif ?>
              <th class="text-center">Sueldo</th>
              <?php if (!Utils::isCustomer()) : ?>
                <th class="text-center">Nuevos postulados</th>
              <?php endif ?>
              <?php if (Utils::isAdmin() || Utils::isManager()) : ?>
                <!-- <th>Candidatos captados por Ej. Busq.</th> -->
                <th>Candidatos compartidos al cliente</th>
              <?php endif ?>
              <?php if (Utils::isSenior()) : ?>
                <!-- <th>Candidatos recibidos</th> -->
                <th>Candidatos compartidos al cliente</th>
              <?php endif ?>
              <?php if (Utils::isJunior()) : ?>
                <!-- <th>Candidatos enviados a Ej. Recl.</th> -->
              <?php endif ?>
              <?php if (Utils::isCustomer()) : ?>
                <th>Candidatos adecuados al perfil</th>
              <?php endif ?>
              <?php if (!Utils::isCustomer()) : ?>
                <!-- <th>Posiciones</th> -->
                <th>Posiciones por cubrir</th>
                <th>Fecha de autorización</th>
                <th>Fecha de compromiso de envío</th>
              <?php endif ?>
              <th>Fecha real de envío</th>
              <?php if (!Utils::isCustomer()) : ?>
                <th>Fecha de finalización</th>
              <?php endif ?>
              <!-- <th>T</th> -->
              <th>Días</th>
              <th>Estado</th>
              <th></th>
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
    let table = document.querySelector('#tb_vacancies');
    table.style.display = "block";
    utils.dtTable(table, <?= Utils::isManager() ? 'false' : 'true' ?>);
  });
</script>
<?php if (Utils::isAdmin()) : ?>
  <div class="modal fade" id="modal_edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" id="update-form">
          <div class="modal-header">
            <h4 class="modal-title">Configuración</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_vacancy" id="id_vacancy">
            <div class="form-group mb-3">
              <label class="col-form-label" for="vacancy">Vacante</label>
              <input type="text" class="form-control" name="vacancy" id="vacancy" readonly>
            </div>
            <div class="form-group mb-3">
              <label class="col-form-label" for="customer">Cliente</label>
              <input type="text" class="form-control" name="customer" id="customer" readonly>
            </div>
            <div class="form-group">
              <label class="col-form-label" for="time">Vacante</label>
              <select class="form-control" name="time">
                <option value="72">72 horas (3 días)</option>
                <option value="120">120 horas (5 días)</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label class="col-form-label" for="interview_date">Fecha de solicitud</label>
              <div class="row">
                <div class="col-2">
                  <div class="input-group mb-3">
                    <select id="request_day" name="request_day" class="form-control custom-select" required>
                      <option value="" hidden selected>Día</option>
                      <?php foreach (range(1, 31) as $i) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="input-group mb-3">
                    <select id="request_month" name="request_month" class="form-control custom-select" required>
                      <option value="" hidden selected>Mes</option>
                      <?php $months = Utils::getMonths(); ?>
                      <?php foreach ($months as $i => $m) : ?>
                        <option value="<?= $i + 1 ?>"><?= $m ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="input-group mb-3">
                    <select id="request_year" name="request_year" class="form-control custom-select" required>
                      <option value="" hidden selected>Año</option>
                      <?php foreach (range(date('Y'), date('Y') - 1) as $i) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group mb-3">
                    <select id="request_hour" name="request_hour" class="form-control custom-select" required>
                      <option value="" hidden selected>Hora</option>
                      <?php foreach (range(0, 23) as $i) : ?>
                        <option value="<?= $i ?>"><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group mb-3">
                    <select id="request_minute" name="request_minute" class="form-control custom-select" required>
                      <option value="" hidden selected>Minutos</option>
                      <?php foreach (range(0, 60) as $i) : ?>
                        <option value="<?= $i ?>"><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <label class="col-form-label" for="interview_date">Fecha de envío</label>
              <div class="row">
                <div class="col-2">
                  <div class="input-group mb-3">
                    <select id="send_day" name="send_day" class="form-control custom-select">
                      <option value="" selected>Día</option>
                      <?php foreach (range(1, 31) as $i) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="input-group mb-3">
                    <select id="send_month" name="send_month" class="form-control custom-select">
                      <option value="" selected>Mes</option>
                      <?php $months = Utils::getMonths(); ?>
                      <?php foreach ($months as $i => $m) : ?>
                        <option value="<?= $i + 1 ?>"><?= $m ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="input-group mb-3">
                    <select id="send_year" name="send_year" class="form-control custom-select">
                      <option value="" selected>Año</option>
                      <?php foreach (range(date('Y'), date('Y') - 1) as $i) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group mb-3">
                    <select id="send_hour" name="send_hour" class="form-control custom-select">
                      <option value="" selected>Hora</option>
                      <?php foreach (range(0, 23) as $i) : ?>
                        <option value="<?= $i ?>"><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group mb-3">
                    <select id="send_minute" name="send_minute" class="form-control custom-select">
                      <option value="" selected>Minutos</option>
                      <?php foreach (range(0, 60) as $i) : ?>
                        <option value="<?= $i ?>"><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <label class="col-form-label" for="interview_date">Fecha de finalización</label>
              <div class="row">
                <div class="col-2">
                  <div class="input-group mb-3">
                    <select id="end_day" name="end_day" class="form-control custom-select">
                      <option value="" selected>Día</option>
                      <?php foreach (range(1, 31) as $i) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="input-group mb-3">
                    <select id="end_month" name="end_month" class="form-control custom-select">
                      <option value="" selected>Mes</option>
                      <?php $months = Utils::getMonths(); ?>
                      <?php foreach ($months as $i => $m) : ?>
                        <option value="<?= $i + 1 ?>"><?= $m ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="input-group mb-3">
                    <select id="end_year" name="end_year" class="form-control custom-select">
                      <option value="" selected>Año</option>
                      <?php foreach (range(date('Y'), date('Y') - 1) as $i) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group mb-3">
                    <select id="end_hour" name="end_hour" class="form-control custom-select">
                      <option value="" selected>Hora</option>
                      <?php foreach (range(0, 23) as $i) : ?>
                        <option value="<?= $i ?>"><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-2">
                  <div class="input-group mb-3">
                    <select id="end_minute" style="cursor: pointer;" name="end_minute" class="form-control custom-select">
                      <option value="" selected>Minutos</option>
                      <?php foreach (range(0, 60) as $i) : ?>
                        <option value="<?= $i ?>"><?= str_pad($i, 2, "0", STR_PAD_LEFT) ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
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
  <script src="<?= base_url ?>app/vacancy.js?v=<?= rand() ?>"></script>
  <script>
    window.onload = function() {

      // Obtén todas las celdas de la clase "celda"
      var celdas = document.querySelectorAll('.celda');

      // Función para copiar el enlace al portapapeles
      function copiarEnlaceAlPortapapeles(enlace) {
        var elementoTemporal = document.createElement('input');
        elementoTemporal.value = enlace;
        document.body.appendChild(elementoTemporal);
        elementoTemporal.select();
        document.execCommand('copy');
        document.body.removeChild(elementoTemporal);
      }

      // Agrega un evento clic a cada celda
      celdas.forEach(function(celda) {
        celda.addEventListener('click', function() {
          var enlace = celda.dataset.id; // O puedes obtener el enlace de otra manera si está almacenado en un atributo data o similar
          copiarEnlaceAlPortapapeles(enlace);
          alert('Enlace copiado al portapapeles: ' + enlace);
          
        });
      });


      /*let config = document.querySelectorAll("#tb_vacancies .btn-config");
      for(var i =0; i < config.length; i++) {
        config[i].onmouseup = function () {
           $('#modal_edit').modal('show'); 
          let vacancy = new Vacancy();
          vacancy.getVacancy(this.id);
        };
      }*/
      $("#tb_vacancies").on('click', '.btn-config', function() {
        $('#modal_edit').modal('show');
        let vacancy = new Vacancy();
        vacancy.getVacancy($(this).attr('id'));
      });

      document.querySelector("#update-form").onsubmit = function(e) {
        e.preventDefault();
        let vacancy = new Vacancy();
        vacancy.update_config();
      };
    };
  </script>

<?php endif ?>