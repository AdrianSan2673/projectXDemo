<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert <?= $_SESSION['identity']->usuario == 'salmaperez1' ? 'alert-maroon' : 'alert-navy' ?>">
            <h1>¡Hola, <?= $_SESSION['identity']->Nombres ?>!</h1>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="col-12">


          <section class="content">
            <div class="card-body bg-light">
              <div class="row gx-5 justify-content-center text-center">
                <div class="col-12">
                  <img src="<?= base_url ?>dist\img\SIGMA.png" alt="LOGOSIGMA" style="width: 100px; height: auto;">

                  <h1 class="display-6">¿Qué deseas hacer hoy?</h1>
                </div>
                <div class="col-12 mt-3">
                  <a class="btn btn-app btn-lg bg-secondary mx-2" href="<?= base_url ?>proyecto/index">
                    <i class="fa fa-folder"></i> Proyectos
                  </a>

                  <a class="btn btn-app btn-lg bg-secondary mx-2" href="<?= base_url ?>proyecto/index">
                    <i class="fa fa-check-square"></i> Revisar Proyectos
                  </a>

                  <a class="btn btn-app btn-lg bg-orange mx-2" href="<?= base_url ?>usuario/all">
                    <i class="fa fa fa-users"></i> Administrar Usuarios
                  </a>
                </div>
              </div>
            </div>
          </section>

          <section>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="<?= base_url ?>dist\img\slide.png" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?= base_url ?>dist\img\slide1.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?= base_url ?>dist\img\slide2.png" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?= base_url ?>dist\img\slide3.png" alt="Fourth slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </section>

          <?php if (Utils::isCustomer()) : ?>
            <div class="row">
              <div class="col-lg-4 col-12">
                <div class="small-box bg-navy">
                  <div class="inner">
                    <h4><?= isset($contacto->id_customer) ? Statistics::getVacancyCountByCustomer($contacto->id_customer) : '0' ?></h4>
                    <p>Vacantes solicitadas</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-briefcase"></i>
                  </div>
                  <a href="<?= base_url ?>vacante/index" class="small-box-footer">
                    Ver
                    <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h4><?= isset($contacto->id_customer) ? Statistics::getVacancyInProcessCountByCustomer($contacto->id_customer) : '0' ?></h4>
                    <p>Vacantes en proceso</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-load-a"></i>
                  </div>
                  <a href="<?= base_url ?>vacante/en_proceso" class="small-box-footer">
                    Ver
                    <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-4 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h4><?= isset($contacto->id_customer) ? Statistics::getVacancyClosedCountByCustomer($contacto->id_customer) : '0' ?></h4>
                    <p>Vacantes cerradas</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-lock"></i>
                  </div>
                  <a href="<?= base_url ?>vacante/index" class="small-box-footer">
                    Ver
                    <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
            </div>
          <?php endif ?>

          <!--<?php $avisos = Utils::avisoClientes(); ?>

          <?php if (isset($avisos) && (Utils::isCustomerSA() || Utils::isCustomer())) : ?>-->
          <div class="card">
            <div class="card bg-transparent">
              <div class="card-header bg-yellow">
                <h3 class="card-title">Mural de actualizaciones </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>

              <div class="card-body">
                <div id="accordion">
                  <?php $avisos = Utils::avisoClientes();
                  $aux = 0; //este solo es para hacer chico la pestaña
                  foreach ($avisos as $aviso) : ?>

                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapse<?= $aviso['id']  ?>" aria-expanded="true">
                            <?= $aviso['titulo']  ?>
                          </a>
                        </h4>
                      </div>

                      <div id="collapse<?= $aviso['id']  ?>" class="collapse <?= $aux == 0 ? 'show' : '' ?>" data-parent="#accordion">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <div class="embed-responsive embed-responsive-16by9">
                                <iframe width="560" height="315" src="<?= $aviso['url']  ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                              </div>
                            </div>
                            <div class="col-4">
                              <div class="card">
                                <div class="card-body">

                                  <div class="row">
                                    <div class="col-md-12">
                                      <h5 class="card-title"><?= $aviso['subtitulo']  ?></h5>

                                    </div>
                                    <div class="col-md-12">
                                      <p class="mt-3">Fecha de publicacion: <span class="text-bold"> <?= Utils::getDate($aviso['fecha_creacion']) ?></span></p>

                                    </div>
                                    <div class="col-md-12">
                                      <p class="card-text text-justify"><?= $aviso['descripcion']  ?></p>
                                    </div>
                                  </div>

                                </div>
                              </div>

                            </div>

                          </div>
                        </div>
                      </div><!--  -->
                    </div>

                  <?php $aux++;
                  endforeach; ?>
                </div>
              </div>
            </div>
          </div>

        <?php endif;  ?>



        <?php if (Utils::isCustomerSA()) : ?>



          <?php if (isset($employeeContract) && $employeeContract != null) : ?>
            <section class="content">
              <div class="card bg-transparent">
                <div class="card-header bg-danger">
                  <h3 class="card-title">Contratos a vencer </h3>
                </div>

                <div class="card-body table-responsive p-0 table-sm">
                  <table id="tb_contacts" class="table table-sm">
                    <thead>
                      <tr>
                        <th class="align-middle">Nombre</th>
                        <th class="align-middle">Puesto</th>
                        <th class="align-middle">Departamento</th>
                        <th class="align-middle">Inicio de contrato</th>
                        <th class="align-middle">Final de contrato</th>
                        <th class="align-middle">Dias para finalizar contrato</th>
                        <th class="align-middle">Empresa contratante</th>
                        <th class="align-middle">Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($employeeContract as $emplC) : ?>
                        <tr>
                          <td class="align-middle"><?= $emplC['fullName'] ?></td>
                          <td class="align-middle"><?= $emplC['title'] ?></td>
                          <td class="align-middle text-center"><?= $emplC['department'] ?></td>
                          <td class="align-middle "><?= Utils::getDate($emplC['contract_start']) ?></td>
                          <td class="align-middle"><?= Utils::getDate($emplC['contract_end']) ?></td>
                          <?php
                          $date1 = new DateTime($emplC['contract_end']);
                          $date2 = new DateTime(date('d-m-Y', time()));
                          $diff = $date1->diff($date2);
                          ?>
                          <td class="align-middle text-center"><?= $diff->days . ' dias' ?></td>
                          <td class="align-middle text-center"><?= $emplC['nombre_comercial'] ?></td>
                          <td class="align-middle">
                            <a href="<?= base_url ?>empleado/ver&id=<?= Encryption::encode($emplC['id_employee']) ?>" target="_blank" class="btn btn-success">
                              <i class="fas fa-eye"></i> Ver
                            </a>
                          </td>
                        </tr>

                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </section>
          <?php endif; ?>




          <?php if ((isset($employeeBirthday) || isset($employeeBirthdayNextMonth)) && ($employeeBirthday != null || $employeeBirthdayNextMonth != null)) : ?>
            <section class="content">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-birthday-cake mr-2"></i>Cumpleaños de nuestros colaboradores</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>

                  </div>
                </div>

                <div class="card-body" style="display: none;">
                  <div class="row">
                    <div class="card bg-primary col-md-6">
                      <div class="card-header">
                        <h4 class="card-title"><?= ucfirst(strftime('%B')) ?></h4>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <?php foreach ($employeeBirthday as $eb) : ?>
                            <div class="card bg-white card-widget widget-user col-md-6">
                              <!-- Add the bg color to the header using any of the bg-* classes -->
                              <div class="widget-user-header <?= $eb['id_gender'] == 2 ? 'bg-maroon' : 'bg-navy' ?>">
                                <h5 class="widget-user-username" style="font-size: 16px;"> <a href="<?= base_url . 'empleado/ver&id=' . Encryption::encode($eb['id_employee']) ?>" target="_blank" class="text-bold text-white"> <?= $eb['fullName'] ?></a></h5>
                                <h6 class="widget-user-desc" style="font-size: 14px;"><b><?= $eb['department'] ?></b></h6>
                              </div>
                              <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="<?= $eb['image'] ?  Utils::getImage("data:image/jpg;base64, " . (base64_encode($eb['image'])))[0] : ($eb['id_gender'] == 2 ? base_url . 'dist/img/user-icon-rose.png' : base_url . 'dist/img/user-icon.png') ?>" alt="User Avatar">
                              </div>
                              <div class="card-footer">
                                <div class="row">
                                  <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                      <h5 class="description-header"><?= $eb['nombre_comercial'] ?></h5>
                                      <span class="description-text"><?= $eb['title'] ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                      <h5 class="description-header"><span class="badge badge-warning" style="font-size: 17px;"><?= date_format(date_create($eb['date_birth']), 'd') ?></span></h5>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4">
                                    <div class="description-block">
                                      <h5 class="description-header"><?= $eb['age'] ?></h5>
                                      <span class="description-text">años</span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
                              </div>
                            </div>
                          <?php endforeach ?>
                        </div>
                      </div>
                    </div>
                    <div class="card bg-success col-md-6">
                      <div class="card-header">
                        <h4 class="card-title"><?= ucfirst(strftime('%B', (date(strtotime('+1 month'))))) ?></h4>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <?php foreach ($employeeBirthdayNextMonth as $eb) : ?>
                            <div class="card bg-white card-widget widget-user col-md-6">
                              <!-- Add the bg color to the header using any of the bg-* classes -->
                              <div class="widget-user-header <?= $eb['id_gender'] == 2 ? 'bg-maroon' : 'bg-navy' ?>">
                                <h5 class="widget-user-username" style="font-size: 16px;"> <a href="<?= base_url . 'empleado/ver&id=' . Encryption::encode($eb['id_employee']) ?>" target="_blank" class="text-bold text-white"> <?= $eb['fullName'] ?></a></h5>
                                <h6 class="widget-user-desc" style="font-size: 14px;"><b><?= $eb['department'] ?></b></h6>
                              </div>
                              <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="<?= $eb['image'] ?  Utils::getImage("data:image/jpg;base64, " . (base64_encode($eb['image'])))[0] : ($eb['id_gender'] == 2 ? base_url . 'dist/img/user-icon-rose.png' : base_url . 'dist/img/user-icon.png') ?>" alt="User Avatar">
                              </div>
                              <div class="card-footer">
                                <div class="row">
                                  <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                      <h5 class="description-header"><?= $eb['nombre_comercial'] ?></h5>
                                      <span class="description-text"><?= $eb['title'] ?></span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                      <h5 class="description-header"><span class="badge badge-warning" style="font-size: 17px;"><?= date_format(date_create($eb['date_birth']), 'd') ?></span></h5>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4">
                                    <div class="description-block">
                                      <h5 class="description-header"><?= $eb['age'] ?></h5>
                                      <span class="description-text">años</span>
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                </div>
                                <!-- /.row -->
                              </div>
                            </div>
                          <?php endforeach ?>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </section>
          <?php endif ?>
          <?php if (isset($evaluations) && $evaluations != null) : ?>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Evaluaciones pendientes</h4>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: none;">
                <table class="table table-sm table-striped" id="table_evaluations">
                  <thead>
                    <tr>
                      <th>Evaluación</th>
                      <th>Empleado</th>
                      <th class="align-middle text-center">Departamento</th>
                      <th class="align-middle text-center">Puesto</th>
                      <th>Jefe Inmediato</th>
                      <th class="align-middle text-center">Período a evaluar</th>
                      <th class="align-middle text-center">Estatus</th>
                      <th class="align-middle text-center">Fecha de evaluación</th>
                      <th class="align-middle text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($evaluations as $evaluation) : ?>
                      <tr>
                        <td class="align-middle"><?= $evaluation['name'] ?></td>
                        <td class="align-middle"><?= $evaluation['first_name'] . ' ' . $evaluation['surname'] . ' ' . $evaluation['last_name'] ?></td>
                        <td class="align-middle text-center"><?= $evaluation['department'] ?></td>
                        <td class="align-middle text-center"><?= $evaluation['title'] ?></td>
                        <td class="align-middle"><?= $evaluation['first_name_boss'] . ' ' . $evaluation['surname_boss'] . ' ' . $evaluation['last_name_boss'] ?></td>
                        <td class="align-middle text-center"><?= $evaluation['start_date'] . ' - ' . $evaluation['end_date'] ?></td>
                        <td class="align-middle text-center"><?= $evaluation['status'] == 1 ? 'Enviada' : ($evaluation['status'] == 2 ? 'Contestada' : ($evaluation['status'] == 3 ? 'Retroalimentada' : ($evaluation['status'] == 4 ? 'Firmada' : ''))) ?></td>
                        <td class="align-middle text-center"><?= $evaluation['date_of_realization'] ?></td>
                        <td class="align-middle text-center">
                          <div class="btn-group btn-group-sm">
                            <a href="<?= base_url ?>evaluacionempleado/ver&id=<?= Encryption::encode($evaluation['id']) ?>&id_boss=<?= Encryption::encode($evaluation['id_boss']) ?>" class="btn btn-success">
                              <i class="far fa-check-circle"></i> Ver
                            </a>
                            <button class="btn btn-primary" data-id="<?= ($evaluation['id']) ?>">
                              <i class="far fa-envelope"></i> Notificar
                            </button>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
            <script type="text/javascript">
              document.addEventListener('DOMContentLoaded', e => {
                let table = document.querySelector('#table_evaluations');
                table.style.display = "table";
                utils.dtTable(table, true);
              });

              document.querySelector('#table_evaluations').addEventListener('click', e => {
                if (e.target.classList.contains('btn-primary') || e.target.parentElement.classList.contains('btn-primary')) {
                  let id;
                  let button;
                  if (e.target.classList.contains('btn-primary')) {
                    button = e.target;
                    id = e.target.dataset.id;
                  } else {
                    button = e.target;
                    id = e.target.parentElement.dataset.id;
                  }

                  button.disabled = true;
                  let xhr = new XMLHttpRequest();
                  let data = `id_evaluation_employee=${id}`;
                  xhr.open('POST', '../evaluacionempleado/notify');
                  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                  xhr.send(data);
                  xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                      let r = this.responseText;
                      console.log(r);
                      try {
                        let json_app = JSON.parse(r);
                        if (json_app.status == 0) {
                          utils.showToast('Error al enviar correo', 'error');
                          button.disabled = false;
                        } else if (json_app.status == 1) {
                          utils.showToast('Se envió correo de notificación de la evaluación', 'success');
                        } else {
                          utils.showToast('Error al enviar correo', 'error');
                          button.disabled = false;
                        }
                      } catch (error) {
                        utils.showToast('Error al enviar correo', 'error');
                        button.disabled = false;
                      }
                    }
                  }
                }

                e.stopPropagation();
              })
            </script>
          <?php endif ?>
        <?php endif; ?>



        <?php if (Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isRecruitmentManager()) : ?>

          <?php //$fecha = date('Y-m-d H:i:s');
          //$fechaComoEntero = strtotime($fecha);
          //echo $fechaComoEntero;
          //echo $hora = date("H", $fechaComoEntero);
          //echo '<br>';
          //echo $minutos = date("i", $fechaComoEntero);
          ?>
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-maroon">
                <div class="inner">
                  <h4><?= Statistics::getVacancyCountInCurrentMonth() ?></h4>
                  <p>Vacantes de <?= strftime('%B') ?></p>
                </div>
                <div class="icon">
                  <i class="fas fa-briefcase"></i>
                </div>
                <a href="<?= base_url ?>vacante/index" class="small-box-footer">
                  Ver
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-navy">
                <div class="inner">
                  <h4><?= Statistics::getVacancyInProcessCount() ?></h4>
                  <p>Vacantes en proceso</p>
                </div>
                <div class="icon">
                  <i class="ion ion-load-a"></i>
                </div>
                <a href="<?= base_url ?>vacante/index" class="small-box-footer">
                  Ver
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h4><?= Statistics::getTodayCandidatesCount() ?></h4>
                  <p>Candidatos registrados hoy</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <a href="<?= base_url ?>candidato/index" class="small-box-footer">
                  Ver
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h4><?= Statistics::getCustomerCountInCurrentMonth() ?></h4>
                  <p>Clientes ingresados en el mes</p>
                </div>
                <div class="icon">
                  <i class="far fa-handshake"></i>
                </div>
                <a href="<?= base_url ?>cliente/index" class="small-box-footer">
                  Ver
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="row">
            <?php $candidates_executive = Statistics::getCandidateCountByExecutive() ?>
            <?php if (count($candidates_executive) > 0) : ?>
              <div class="col-12 col-md-4">
                <div class="card card-orange">
                  <div class="card-header border-0">
                    <h3 class="card-title">
                      # candidatos registrados por ejecutivo el día de hoy
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                      <button type="button" class="btn btn-orange btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <table class="table table-hover table-sm text-nowrap">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Registrado por</th>
                          <th class="text-center">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($candidates_executive as $count) : ?>
                          <tr>
                            <td><?php if (!is_null($count['id'])) : ?>
                                <img class="img-circle img-fluid img-responsive elevation-2" src="<?= $count['avatar'] ?>" style="width:50px; height:auto;">
                              <?php endif ?>
                            </td>
                            <td class="align-middle"><?= $count['name'] != ' ' ? $count['name'] : 'Si mismos' ?></td>
                            <td class="align-middle text-center"><?= $count['total'] ?></td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <?php endif ?>
            <div class="col-12 col-md-8">
              <div class="card bg-navy">
                <?php $candidates_count = Statistics::getCandidateCountFromLast7Days() ?>
                <div class="card-header border-0">
                  <h3 class="card-title">
                    # candidatos registrados en los últimos 7 días
                  </h3>
                  <!-- card tools -->
                  <div class="card-tools">
                    <button type="button" class="btn btn-navy btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <div class="card-body p-0">
                  <div class="container-fluid">
                    <div class="row">

                      <div class="col-12 col-md-8">
                        <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      </div>
                      <div class="col-12 col-md-4">
                        <table class="table table-hover table-sm text-nowrap">
                          <thead>
                            <tr>
                              <th class="text-center">Día</th>
                              <th class="text-center">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach (array_reverse($candidates_count) as $count) : ?>
                              <tr>
                                <td class="text-center"><?= $count['dia_semana'] . ' ' . $count['dia'] ?></td>
                                <td class="text-center"><?= $count['total'] ?></td>
                              </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <?php $vacancies_executive = Statistics::getVacancyCountByExecutive() ?>
            <?php if (count($vacancies_executive) > 0) : ?>
              <div class="col-12 col-md-6">
                <div class="card card-info">
                  <div class="card-header border-0">
                    <h3 class="card-title">
                      # vacantes en proceso por ejecutivo
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                      <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <table class="table table-hover table-sm text-nowrap">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Ejecutivo</th>
                          <th class="text-center">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($vacancies_executive as $count) : ?>
                          <tr>
                            <td><?php if (!is_null($count['id'])) : ?>
                                <img class="img-circle img-fluid img-responsive elevation-2" src="<?= $count['avatar'] ?>" style="width:50px; height:auto;">
                              <?php endif ?>
                            </td>
                            <td class="align-middle"><?= $count['name'] != ' ' ? $count['name'] : 'Si mismos' ?></td>
                            <td class="align-middle text-center"><?= $count['total'] ?></td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <?php endif ?>

            <?php $vacancies_customer = Statistics::getVacancyInProcessCountByCustomers() ?>
            <?php if (count($vacancies_customer) > 0) : ?>
              <div class="col-12 col-md-6">
                <div class="card card-success">
                  <div class="card-header border-0">
                    <h3 class="card-title">
                      # vacantes en proceso por cliente
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                      <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <div class="card-body">
                    <table class="table table-hover table-sm text-nowrap">
                      <thead>
                        <tr>
                          <th>Cliente</th>
                          <th class="text-center">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($vacancies_customer as $count) : ?>
                          <tr>
                            <td class="align-middle"><?= $count['customer'] ?></td>
                            <td class="align-middle text-center"><?= $count['total'] ?></td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <?php endif ?>
          </div>




          <?php if ((Utils::isAdmin() || Utils::isCustomerSA())  && isset($_SESSION['id_cliente'])) : ?>

            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Vacaciones por vencer de Empleados</h4>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: none;">
                <table id="table-vencimiento" class="table table-striped " style="width: 100%;">
                  <thead>
                    <tr>
                      <th class=" align-middle text-center">Nombre</th>
                      <th class="align-middle text-center">Días restantes</th>
                      <th class="align-middle text-center">Vencen el </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($expired_employees as $employee) :

                      $fecha_actual = date("Y-m-d");
                      $vencimiento =  date("Y-m-d", strtotime($fecha_actual . "+ 3 month"));
                      // var_dump($employee['due_date']);
                      // die();
                      $due_date = $employee['due_date'] == 'Sin días' ? '' : Utils::ConvertirFecha($employee['due_date']);
                      if ($due_date != 'Sin días' && $due_date <=  $vencimiento   &&  $due_date >=  $fecha_actual) :
                    ?>
                        <tr>
                          <td class="align-middle text-center ">
                            <?= $employee['first_name'] . ' ' . $employee['surname'] . ' ' . $employee['last_name'] ?>
                          </td>
                          <td class="text-center align-middle">
                            <?= $employee['total_days'] ?></td>
                          <td class="text-center align-middle"><?= $employee['due_date'] ?>
                          </td>
                        </tr>
                    <?php

                      endif;

                    endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="align-middle text-center">Nombre</th>
                      <th class="align-middle text-center">Días restantes</th>
                      <th class="align-middle text-center">Vencen el</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>

          <?php endif; ?>








          <?php if (Utils::isAdmin() || Utils::isSales() || Utils::isSalesManager()) : ?>
            <div class="row">
              <div class="col-12">
                <div class="card collapsed-card">
                  <?php $contactos = Utils::showCumpleanosClientes(); ?>
                  <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-birthday-cake mr-2"></i>Cumpleaños de
                      nuestros clientes SA</h3>
                    <div class="card-tools">
                      <button type="button" class="btn  btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="tb_contacts_SA" class="table table-sm table-striped">

                        <thead>
                          <tr>
                            <th></th>

                            <th></th>
                            <th></th>
                            <th class="filterhead"></th>
                            <th></th>

                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                          <tr>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Mes</th>
                            <th>Cumple</th>
                            <th>Puesto</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Extensión</th>
                            <th>Celular</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          $fechaActual = new DateTime();
                          // Fecha de un mes antes
                          $fechaInicio = clone $fechaActual;
                          $fechaInicio->modify('-15 days');

                          // Fecha de un mes después
                          $fechaFin = clone $fechaActual;
                          $fechaFin->modify('+45 days');

                          $formato = 'd/m';
                          $fechaInicioFormateada = $fechaInicio->format($formato);
                          $fechaFinFormateada = $fechaFin->format($formato);

                          $fechaInicioFormateada = explode('/', $fechaInicioFormateada);
                          $fechaFinFormateada = explode('/', $fechaFinFormateada);

                          $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');


                          foreach ($contactos as &$contacto) :


                            $fechas_cumpleaños = explode('/', $contacto['Fecha_Cumpleaños']);

                            if ($fechas_cumpleaños[1] == $fechaInicioFormateada[1] ||  $fechas_cumpleaños[1] == $fechaFinFormateada[1] - 1) :

                          ?>


                              <tr class="<?= $contacto['Cumple'] == 'Hoy' ? 'table-warning text-bold' : '' ?>">
                                <td><?= $contacto['Nombre_Contacto'] . ' ' . $contacto['Apellido_Contacto'] ?>
                                </td>
                                <td> <a href="<?= base_url . 'empresa_SA/ver&id=' . Encryption::encode($contacto['Empresa']) ?>" target="_blank"> <?= $contacto['Nombre_Empresa'] ?></a></td>
                                <td><?= $contacto['Fecha_Cumpleaños'] ?></td>
                                <td><?= $meses[$fechas_cumpleaños[1] - 1] ?></td>
                                <td><?= $contacto['Cumple'] ?></td>
                                <td><?= $contacto['Puesto'] ?></td>
                                <td><?= $contacto['Correo'] ?></td>
                                <td><?= $contacto['Telefono'] ?></td>
                                <td><?= $contacto['Extension'] ?></td>
                                <td><?= $contacto['Celular'] ?></td>

                              </tr>



                          <?php
                            endif;
                          endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card collapsed-card">
                  <?php $contactosReclu = Utils::showCumpleanosClientesReclu(); ?>
                  <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-birthday-cake mr-2"></i>Cumpleaños de
                      nuestros de Reclutamiento</h3>

                    <div class="card-tools">
                      <button type="button" class="btn  btn-sm" data-card-widget="collapse"
                        data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>



                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="tb_contacts_reclu" class="table table-sm table-striped">
                        <thead>

                          <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="filterhead"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                          <tr>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Mes</th>
                            <th>Cumple</th>
                            <th>Puesto</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Extensión</th>
                            <th>Celular</th>
                          </tr>
                        </thead>
                        <tbody>


                          <?php

                          $fechaActual = new DateTime();
                          // Fecha de un mes antes
                          $fechaInicio = clone $fechaActual;
                          $fechaInicio->modify('-15 days');

                          // Fecha de un mes después
                          $fechaFin = clone $fechaActual;
                          $fechaFin->modify('+45 days');

                          $formato = 'd/m';
                          $fechaInicioFormateada = $fechaInicio->format($formato);
                          $fechaFinFormateada = $fechaFin->format($formato);

                          $fechaInicioFormateada = explode('/', $fechaInicioFormateada);
                          $fechaFinFormateada = explode('/', $fechaFinFormateada);

                          $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');


                          ?>

                          <?php foreach ($contactosReclu as $contactoReclu) :

                            if ($contactoReclu['birthday'] != '') {
                              $fechas_cumpleaños = explode('/', $contactoReclu['birthday']);
                            }


                            if ($contactoReclu['birthday'] != '' && ($fechas_cumpleaños[1] == $fechaInicioFormateada[1]  ||  $fechas_cumpleaños[1] == $fechaFinFormateada[1] - 1)) :

                          ?>
                              <tr
                                class="<?= $contactoReclu['Cumple'] == 'Hoy' ? 'table-warning text-bold' : '' ?>">
                                <td><?= $contactoReclu['first_name'] . ' ' . $contactoReclu['last_name'] ?>
                                </td>
                                <td><?= $contactoReclu['customer'] ?></td>
                                <td><?= $contactoReclu['birthday'] ?></td>
                                <td><?= $meses[$fechas_cumpleaños[1] - 1] ?></td>

                                <td><?= $contactoReclu['Cumple'] ?></td>
                                <td><?= $contactoReclu['position'] ?></td>
                                <td><?= $contactoReclu['email'] ?></td>
                                <td><?= $contactoReclu['telephone'] ?></td>
                                <td><?= $contactoReclu['extension'] ?></td>
                                <td><?= $contactoReclu['cellphone'] ?></td>
                              </tr>


                          <?php
                            endif;
                          endforeach; ?>


                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card card-warning">
                <?php $prospectos = !Utils::isSales() ? Utils::showProspectosPorSeguirHoy() : Utils::showProspectosPorSeguirHoyEjecutivo() ?>
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <?= count($prospectos) ?> prospectos con fecha de seguimiento de hoy
                  </h3>
                  <!-- card tools -->
                  <div class="card-tools">
                    <button type="button" class="btn btn-warning btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <div class="card-body table-responsive p-0 table-sm">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Prospecto</th>
                        <th>Giro</th>
                        <th>CC</th>
                        <th>Ejecutivo</th>
                        <th>Tipo de cliente</th>
                        <th>Contacto</th>
                        <th>Puesto</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Periodicidad</th>
                        <th>Fecha del último contacto</th>
                        <th>Siguiente contacto</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($prospectos as $pros) : ?>
                        <tr>
                          <td><?= $pros['Prospecto'] ?></td>
                          <td><?= $pros['Giro'] ?></td>
                          <td><?= $pros['Plaza'] ?></td>
                          <td><?= $pros['Ejecutivo'] ?></td>
                          <td><?= $pros['Tipo'] ?></td>
                          <td><?= $pros['Contacto_RH'] ?></td>
                          <td><?= $pros['Puesto'] ?></td>
                          <td><?= $pros['Telefono'] ?></td>
                          <td><?= $pros['Correo'] ?></td>
                          <td><?= $pros['Periodicidad'] ?></td>
                          <td><?= Utils::getShortDate($pros['Fecha_Envio_Propuesta']) ?></td>
                          <td><?= Utils::getShortDate($pros['Fecha_Prox_Seguimiento']) ?></td>
                          <td class="text-center py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                              <a href="<?= base_url ?>prospecto/editar&id=<?= $pros['ID'] ?>" class="btn btn-info">
                                <i class="fas fa-pencil-alt"></i>
                              </a>
                              <a href="<?= base_url ?>prospecto/trabajar&id=<?= $pros['ID'] ?>" class="btn btn-orange">
                                <i class="fas fa-hammer"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
        </div>
      <?php endif ?>

      <?php if (Utils::isAdmin() || Utils::isManager()) : ?>
        <div class="card card-danger">
          <?php $facturas = Utils::showCuentasPorCobrarHoy() ?>
          <div class="card-header border-0">
            <h3 class="card-title">
              <?= count($facturas) ?> facturas de SA con promesa de pago para hoy
            </h3>
            <!-- card tools -->
            <div class="card-tools">
              <button type="button" class="btn btn-danger btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <div class="card-body table-responsive p-0 table-sm">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th class="align-middle">Factura</th>
                  <th class="align-middle">Fecha</th>
                  <th class="align-middle">Días de crédito</th>
                  <th class="align-middle">Días transcurridos</th>
                  <th class="align-middle text-center">Cliente</th>
                  <th class="align-middle">Razón social</th>
                  <th class="align-middle text-right">Monto</th>
                  <th class="align-middle text-right">Monto + IVA</th>
                  <th class="align-middle text-center">Fecha de pago</th>
                  <th class="align-middle text-center">Estado</th>
                  <th class="align-middle text-center">Promesa de pago</th>
                  <th class="align-middle">Fecha última gestión</th>
                  <th>Última gestión</th>
                  <th class="align-middle text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($facturas as $bill) : ?>
                  <tr>
                    <?php switch ($bill['Estado']) {
                      case 'Pendiente de pago':
                        $class_color = 'bg-orange';
                        break;
                      case 'Pagada':
                        $class_color = 'bg-success';
                        break;
                      default:
                        $class_color = '';
                        break;
                    }
                    ?>
                    <td class="text-center align-middle"><b><?= $bill['Folio_Factura'] ?></b></td>
                    <td class="text-center align-middle"><?= Utils::getShortDate($bill['Fecha_Emision']); ?></td>
                    <td class="text-center align-middle"><?= $bill['Plazo_Credito'] ?></td>
                    <td class="text-center align-middle"><?= $bill['Dias_Transcurridos'] ?></td>
                    <td class="text-center align-middle"><?= $bill['Cliente'] ?></td>
                    <td class="align-middle"><?= $bill['Razon_Social'] ?></td>
                    <td class="text-right align-middle">$ <?= number_format($bill['Monto']) ?></td>
                    <td class="text-right align-middle">$ <?= number_format($bill['Monto_IVA']) ?></td>
                    <td class="text-center align-middle"><?= !is_null($bill['Fecha_de_Pago']) ? Utils::getShortDate($bill['Fecha_de_Pago']) : '' ?></td>
                    <td class="text-center align-middle <?= $class_color ?>"><?= $bill['Estado'] ?></td>
                    <td class="text-center align-middle"><?= !is_null($bill['Promesa_Pago']) ? Utils::getShortDate($bill['Promesa_Pago']) : '' ?></td>
                    <td class="text-center align-middle"><?= !is_null($bill['Fecha_Ultima_Gestion']) ? Utils::getShortDate($bill['Fecha_Ultima_Gestion']) : '' ?></td>
                    <td><?= $bill['Ultima_Gestion'] ?></td>
                    <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="<?= base_url ?>administracion_SA/editar_factura&folio=<?= Encryption::encode($bill['Folio_Factura']) ?>" class="btn btn-info" style="font-size: 0.6rem">
                          <i class="fas fa-pencil-alt"></i>
                          Editar
                        </a>
                        <a href="<?= base_url ?>administracion_SA/gestion_factura&folio=<?= Encryption::encode($bill['Folio_Factura']) ?>" class="btn btn-secondary" style="font-size: 0.6rem">
                          <i class="fas fa-cog"></i>
                          Gestionar
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>

        </div>

        <div class="card card-orange">
          <?php $ordenes = Utils::showOrdenesCompraHoy() ?>
          <div class="card-header border-0">
            <h3 class="card-title">
              <?= count($ordenes) ?> ordenes de compra de SA para gestionar hoy
            </h3>
            <!-- card tools -->
            <div class="card-tools">
              <button type="button" class="btn btn-orange btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <div class="card-body table-responsive p-0 table-sm">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th class="align-middle">Folio</th>
                  <th class="align-middle">Fecha</th>
                  <th class="align-middle text-center">Cliente</th>
                  <th class="align-middle">Razón social</th>
                  <th class="align-middle text-center"># servicios</th>
                  <th class="align-middle text-right">Total</th>
                  <th class="align-middle text-center">Estado</th>
                  <th class="align-middle text-center">Fecha última gestión</th>
                  <th class="align-middle text-center">Última gestión</th>
                  <th class="align-middle text-center">Fecha próxima gestión</th>
                  <th class="align-middle text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($ordenes as $order) : ?>
                  <tr>
                    <?php switch ($order['Estado_OC']) {
                      case 'Pendiente':
                        $class_color = 'bg-orange';
                        break;
                      case 'En Proceso':
                        $class_color = 'bg-navy';
                        break;
                      case 'Liberada':
                        $class_color = 'bg-success';
                        break;
                      default:
                        $class_color = '';
                        break;
                    }
                    ?>
                    <td><b><?= $order['Factura'] ?></b></td>
                    <td><?= Utils::getShortDate($order['Fecha_Emision']); ?></td>
                    <td class="text-center"><?= $order['Cliente'] ?></td>
                    <td><?= $order['Razon'] ?></td>
                    <td class="text-center"><?= $order['No_Servicios'] ?></td>
                    <td class="text-right">$ <?= number_format($order['Monto']) ?></td>
                    <td class="text-center <?= $class_color ?>"><?= $order['Estado_OC'] ?></td>
                    <td><?= !is_null($order['Fecha_Gestion']) ? Utils::getShortDate($order['Fecha_Gestion']) : '' ?></td>
                    <td><?= $order['Comentarios'] ?></td>
                    <td><?= !is_null($order['Fecha_Prox_Gestion']) ? Utils::getShortDate($order['Fecha_Prox_Gestion']) : '' ?></td>
                    <td class="text-center py-0">
                      <div class="btn-group btn-group-sm">
                        <a href="<?= base_url ?>administracion_SA/gestion_orden_de_compra&folio=<?= Encryption::encode($order['Factura']) ?>" class="btn btn-info" style="font-size: 0.6rem">
                          <i class="fas fa-cog"></i>
                          Gestionar
                        </a>
                        <a href="<?= base_url ?>administracion_SA/detalle_orden_de_compra&folio=<?= Encryption::encode($order['Factura']) ?>" class="btn btn-success" style="font-size: 0.6rem">
                          <i class="far fa-clipboard"></i>
                          Detalle
                        </a>
                        <a href="<?= base_url ?>administracion_SA/listado_orden_de_compra&folio=<?= Encryption::encode($order['Factura']) ?>" class="btn btn-orange" style="font-size: 0.6rem">
                          <i class="fas fa-list-alt"></i>
                          Listado
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>

        </div>

      <?php endif ?>

      <?php if (Utils::isAdmin() && $_SESSION['identity']->id == 1) : ?>
        <div class="row">
          <div class="col-12">
            <div class="card card bg-gradient-navy">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Candidatos por estado
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-navy btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div class="d-md-flex">
                  <div class="p-1 flex-fill" style="overflow: hidden">
                    <!-- Map will be created here -->
                    <div id="world-map" style="height: 600px; width: 100%;"></div>
                  </div>
                  <div class="card-pane-right bg-success pt-2 pb-2 pl-4 pr-4">
                    <div class="description-block mb-4">
                      <div class="sparkbar pad" data-color="#fff"></div>
                      <h5 class="description-header"></h5>
                      <span class="description-text"></span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block mb-4">
                      <div class="sparkbar pad" data-color="#fff"></div>
                      <h5 class="description-header"></h5>
                      <span class="description-text"></span>
                    </div>
                    <!-- /.description-block -->
                  </div><!-- /.card-pane-right -->
                </div><!-- /.d-md-flex -->
              </div>

            </div>
          </div>
        </div>
      <?php endif ?>

      <!-- <div class="row">
                  <div class="col-md-6 mx-auto">
                      <div class="card card-navy">
                          <div class="card-header">
                              <h4 class="card-title">Guía de Ejecutivo de Búsqueda</h4>
                          </div>
                          <div class="card-body">
                              <div class="embed-responsive embed-responsive-16by9">
                                  <video controls="controls" poster="<?= base_url ?>dist/img/poster_video_busqueda.png">
                                      <source src="<?= base_url ?>dist/videos/GUIA EJECUTIVO DE BUSQUEDA.mp4" type="video/mp4" />
                                  </video>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 mx-auto">
                      <div class="card card-info">
                          <div class="card-header">
                              <h4 class="card-title">Guía de Ejecutivo de Reclutamiento</h4>
                          </div>
                          <div class="card-body">
                              <div class="embed-responsive embed-responsive-16by9">
                                  <video controls="controls" poster="<?= base_url ?>dist/img/poster_video_reclutamiento.png">
                                      <source src="<?= base_url ?>dist/videos/GUIA EJECUTIVO DE RECLUTAMIENTO.mp4" type="video/mp4" />
                                  </video>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>   -->
    <?php endif ?>



    <?php if (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager()) : ?>
      <div class="col-12">

        <div class="card card-info card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Servicios ingresados hoy</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Servicios en proceso</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="true">Servicios ingresados en la semana</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Servicios ingresados en el mes</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalRALESHoy() +  Statistics::getTotalISELAHoy() + Statistics::getTotalInvHoy() + Statistics::getTotalVDHoy() + Statistics::getTotalESESHoy() + Statistics::getTotalESESOIHoy() + Statistics::getTotalESESMARTHoy() : Statistics::getTotalServiciosApoyoHoyPorEjecutivo() ?>
                          <p>Servicios solicitados hoy</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-android-calendar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalInvHoy() : Statistics::getTotalInvHoyPorEjecutivo() ?></h4>
                        <p>Inv. Lab. solicitadas hoy</p>
                      </div>
                      <div class="icon">
                        <i class="far fa-id-badge"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>


                  <div class="col-lg-1 col-2">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalESESHoy() : Statistics::getTotalESESHoyPorEjecutivo() ?>
                        </h4>
                        <p>ESE </p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <!--   ===[gabo 15 agosto estadisticas]=== -->
                  <div class="col-lg-1 col-2">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalESESOIHoy() : Statistics::getTotalESESOIHoyPorEjecutivo() ?>
                        </h4>
                        <p>SOI </p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-1 col-2">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalESESMARTHoy() : Statistics::getTotalESESMARTHoyPorEjecutivo() ?>
                        </h4>
                        <p>
                          <font size="2">SMART</font>
                        </p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

                  <div class="col-lg-1 col-2">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalVDHoy() : Statistics::getTotalESESMARTHoyPorEjecutivo() ?>
                        </h4>
                        <p>
                          <font size="2">VD</font>
                        </p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

                  <div class="col-lg-2 col-2">
                    <div class="small-box bg-maroon">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalISELAHoy() : Statistics::getTotalRALESHoyPorEjecutivo() ?></h4>
                        <p>ISELA solicitados hoy</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-gavel"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col col-md-8">
                    <div class="card">
                      <?php $serviciosxclientehoy = !Utils::isAccount() ? Statistics::getServiciosSolicitadosPorClientesHoy() : Statistics::getServiciosSolicitadosPorClientesYEjecutivoHoy() ?>
                      <div class="card-header">
                        <h4 class="card-title">Servicios solicitados de hoy por cliente</h4>
                        <div class="card-tools">
                          <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Cliente</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                                <th class="text-center"># RAL</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosxclientehoy as $s) : ?>
                                <tr>
                                  <td><?= $s['Nombre_Cliente'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center text-bold"><?= $s['No_INV'] + $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                </tr>
                              <?php endforeach ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col col-md-4">
                    <div class="card card-navy">
                      <div class="card-header">
                        <h3 class="card-title">Servicios solicitados</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <canvas id="pieChartHoy" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <div class="card">
                  <?php $serviciosxcchoy = !Utils::isAccount() ? Statistics::getServiciosSolicitadosPorCCHoy() : Statistics::getServiciosSolicitadosPorCCYEjecutivoHoy() ?>
                  <div class="card-header">
                    <h4 class="card-title">Servicios solicitados por plaza</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col col-md-8">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Plaza</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                                <th class="text-center"># RAL</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosxcchoy as $s) : ?>
                                <tr>
                                  <td><?= $s['Centro_Costos'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center text-bold"><?= $s['No_INV'] + $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                </tr>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col col-md-4">
                        <!-- <div class="chart">
                                <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                              </div>-->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <?php $serviciosentxejhoy = !Utils::isAccount() ? Statistics::getServiciosPorEjecutivoHoy() : Statistics::getServiciosPorEjecutivoHoy() //getServiciosPorEjecutivoUnicoHoy 
                  ?>
                  <div class="card-header">
                    <h4 class="card-title">Servicios solicitados hoy de cada ejecutivo</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col col-md-8">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Ejecutivo</th>
                                <th class="text-center"># RAL</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosentxejhoy as $s) : ?>
                                <tr>
                                  <td><?= $s['Nombre'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_Servicios'] ?></td>
                                </tr>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col col-md-4">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalServiciosApoyoEnProceso() : Statistics::getTotalServiciosApoyoEnProcesoPorEjecutivo() ?></h4>
                        <p>Servicios solicitados en proceso</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-android-calendar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-maroon">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalRALESEnProceso() + Statistics::getTotalIselaESEnProceso() : Statistics::getTotalRALESEnProcesoPorEjecutivo() ?></h4>
                        <p>RAL-ISELA solicitados en proceso</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-gavel"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>



                  <div class="col-lg-2 col-6">
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalInvEnProceso() : Statistics::getTotalInvEnProcesoPorEjecutivo() ?></h4>
                        <p>Inv. Lab. solicitadas en proceso</p>
                      </div>
                      <div class="icon">
                        <i class="far fa-id-badge"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

                  <div class="col-lg-2 col-6">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalESESEnProceso() : Statistics::getTotalESESEnProcesoPorEjecutivo() ?></h4>
                        <p>ESE solicitados en proceso</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-2 col-6">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalVDEnProceso() : '0' ?></h4>
                        <p>VD solicitados en proceso</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col col-md-8">
                    <div class="card">
                      <?php $serviciosxclienteenproceso = !Utils::isAccount() ? Statistics::getServiciosSolicitadosPorClientesEnProceso() : Statistics::getServiciosSolicitadosPorClientesYEjecutivoEnProceso() ?>
                      <div class="card-header">
                        <h4 class="card-title">Servicios solicitados en proceso por cliente</h4>
                        <div class="card-tools">
                          <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Cliente</th>
                                <th class="text-center"># RAL</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosxclienteenproceso as $s) : ?>
                                <tr>
                                  <td><?= $s['Nombre_Cliente'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_Servicios'] ?></td>
                                </tr>
                              <?php endforeach ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col col-md-4">
                    <div class="card card-navy">
                      <div class="card-header">
                        <h3 class="card-title">Servicios solicitados</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <canvas id="pieChartEnProceso" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <div class="card">
                  <?php $serviciosxccenproceso = !Utils::isAccount() ? Statistics::getServiciosSolicitadosPorCCEnProceso() : Statistics::getServiciosSolicitadosPorCCYEjecutivoEnProceso() ?>
                  <div class="card-header">
                    <h4 class="card-title">Servicios solicitados en proceso por centro de costos</h4>
                    <div class="card-tools">
                      <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col col-md-8">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Plaza</th>
                                <th class="text-center"># RAL</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosxccenproceso as $s) : ?>
                                <tr>
                                  <td><?= $s['Centro_Costos'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_Servicios'] ?></td>
                                </tr>
                              <?php endforeach ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col col-md-4"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalServiciosApoyoSemana() : Statistics::getTotalServiciosApoyoSemanaPorEjecutivo() ?></h4>
                        <p>Servicios solicitados en la semana</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-android-calendar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-maroon">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalRALESSemana() : Statistics::getTotalRALESSemanaPorEjecutivo() ?></h4>
                        <p>RAL solicitados en la semana</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-gavel"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalInvSemana() : Statistics::getTotalInvSemanaPorEjecutivo() ?></h4>
                        <p>Inv. Lab. solicitadas en la semana</p>
                      </div>
                      <div class="icon">
                        <i class="far fa-id-badge"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalESESSemana() : Statistics::getTotalESESSemanaPorEjecutivo() ?></h4>
                        <p>ESE solicitados en la semana</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col col-md-8">
                    <div class="card">
                      <?php $serviciosxclientesemana = !Utils::isAccount() ? Statistics::getServiciosSolicitadosPorClientesSemana() : Statistics::getServiciosSolicitadosPorClientesYEjecutivoSemana() ?>
                      <div class="card-header">
                        <h4 class="card-title">Servicios solicitados en la semana por cliente</h4>
                        <div class="card-tools">
                          <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Cliente</th>
                                <th class="text-center"># RAL</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosxclientesemana as $s) : ?>
                                <tr>
                                  <td><?= $s['Nombre_Cliente'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_Servicios'] ?></td>
                                </tr>
                              <?php endforeach ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col col-md-4">
                    <div class="card card-navy">
                      <div class="card-header">
                        <h3 class="card-title">Servicios solicitados</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <canvas id="pieChartSemana" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <div class="card">
                  <?php $serviciosxccsemana = !Utils::isAccount() ? Statistics::getServiciosSolicitadosPorCCSemana() : Statistics::getServiciosSolicitadosPorCCYEjecutivoSemana() ?>
                  <div class="card-header">
                    <h4 class="card-title">Servicios solicitados en la semana por centro de costos</h4>
                    <div class="card-tools">
                      <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col col-md-8">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Plaza</th>
                                <th class="text-center"># RAL</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosxccsemana as $s) : ?>
                                <tr>
                                  <td><?= $s['Centro_Costos'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_Servicios'] ?></td>
                                </tr>
                              <?php endforeach ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col col-md-4"></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <?php $serviciosentxejsemana = !Utils::isAccount() ? Statistics::getServiciosEntregadosPorEjecutivoSemana() : Statistics::getServiciosEntregadosPorEjecutivoUnicoSemana() ?>
                  <div class="card-header">
                    <h4 class="card-title">Servicios por ejecutivos</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col col-md-8">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Ejecutivo</th>
                                <th class="text-center"># RAL</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosentxejsemana as $s) : ?>
                                <tr>
                                  <td><?= $s['Nombre'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_Servicios'] ?></td>
                                </tr>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col col-md-4">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalServiciosApoyoMes() : Statistics::getTotalServiciosApoyoMesPorEjecutivo() ?></h4>
                        <p>Servicios solicitados en el mes</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-android-calendar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-maroon">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalRALESMes() : Statistics::getTotalRALESMesPorEjecutivo() ?></h4>
                        <p>RAL solicitados en el mes</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-gavel"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalInvMes() : Statistics::getTotalInvMesPorEjecutivo() ?></h4>
                        <p>Inv. Lab. solicitadas en el mes</p>
                      </div>
                      <div class="icon">
                        <i class="far fa-id-badge"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h4><?= !Utils::isAccount() ? Statistics::getTotalESESMes() : Statistics::getTotalESESMesPorEjecutivo() ?></h4>
                        <p>ESE solicitados en el mes</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        Ver
                        <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col col-md-8">
                    <div class="card">
                      <?php $serviciosxclientesmes = !Utils::isAccount() ? Statistics::getServiciosSolicitadosPorClientesMes() : Statistics::getServiciosSolicitadosPorClientesYEjecutivoMes() ?>
                      <div class="card-header">
                        <h4 class="card-title">Servicios solicitados en el mes por cliente</h4>
                        <div class="card-tools">
                          <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Cliente</th>
                                <th class="text-center"># RAL</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosxclientesmes as $s) : ?>
                                <tr>
                                  <td><?= $s['Nombre_Cliente'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_Servicios'] ?></td>
                                </tr>
                              <?php endforeach ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col col-md-4">
                    <div class="card card-navy">
                      <div class="card-header">
                        <h3 class="card-title">Servicios solicitados</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <canvas id="pieChartMes" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <div class="card">
                  <?php $serviciosxccmes = !Utils::isAccount() ? Statistics::getServiciosSolicitadosPorCCMes() : Statistics::getServiciosSolicitadosPorCCYEjecutivoMes() ?>
                  <div class="card-header">
                    <h4 class="card-title">Servicios solicitados en el mes por centro de costos</h4>
                    <div class="card-tools">
                      <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col col-md-8">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Plaza</th>
                                <th class="text-center"># RAL</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosxccmes as $s) : ?>
                                <tr>
                                  <td><?= $s['Centro_Costos'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_Servicios'] ?></td>
                                </tr>
                              <?php endforeach ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col col-md-4">

                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <?php $serviciosentxejmes = !Utils::isAccount() ? Statistics::getServiciosEntregadosPorEjecutivoMes() : Statistics::getServiciosEntregadosPorEjecutivoUnicoMes() ?>
                  <div class="card-header">
                    <h4 class="card-title">Servicios por ejecutivos</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col col-md-8">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Ejecutivo</th>
                                <th class="text-center"># RAL</th>
                                <th class="text-center"># Inv</th>
                                <th class="text-center"># ESE</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($serviciosentxejmes as $s) : ?>
                                <tr>
                                  <td><?= $s['Nombre'] ?></td>
                                  <td class="text-center"><?= $s['No_RAL'] ?></td>
                                  <td class="text-center"><?= $s['No_INV'] ?></td>
                                  <td class="text-center"><?= $s['No_ESE'] ?></td>
                                  <td class="text-center"><?= $s['No_Servicios'] ?></td>
                                </tr>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col col-md-4">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    <?php endif ?>
    <?php if (Utils::isMarketing()) : ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Candidatos</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieApplicantsChart" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Atracciones de Talento</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>

    <?php endif ?>
    <?php if (Utils::isCandidate()) : ?>
      <div class="row">
        <div class="col-md-6">
          <div class="card card-widget widget-user-2">
            <div class="widget-user-header bg-warning">
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="<?= $_SESSION["avatar_route"] ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><a href="<?= base_url ?>candidato/datos_cv"><?= $candidato->first_name . ' ' . $candidato->surname . ' ' . $candidato->last_name ?></a></h3>
              <h5 class="widget-user-desc"><?= $candidato->job_title ?></h5>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Mis postulaciones</h4>
            </div>
            <div class="card-body">
              <?php $talent_attractions = Statistics::getTAApplicantsByCandidates($candidato->id); ?>
              <?php $vacancies = Statistics::getApplicantsByCandidates($candidato->id); ?>
              <?php foreach ($talent_attractions as $ta): ?>
                <div class="callout callout-navy">
                  <h5><a href="<?= base_url ?>bolsa/ver&atracciontalento=<?= Encryption::encode($ta['id']) ?>" class="text-primary" style="text-decoration: none;"><?= $ta['job_title'] ?></a></h5>
                  <i class="fas fa-map-marker-alt"></i> <b class="text-navy"><?= $ta['city'] . ', ' . $ta['abbreviation'] ?></b>
                  <?= ($ta['description']) ?>
                </div>
              <?php endforeach ?>
              <?php foreach ($vacancies as $vacancy): ?>
                <div class="callout callout-navy">
                  <h5><a href="<?= base_url ?>bolsa/ver&vacante=<?= Encryption::encode($vacancy['id']) ?>" class="text-primary" style="text-decoration: none;"><?= $vacancy['vacancy'] ?></a></h5>
                  <i class="fas fa-map-marker-alt"></i> <b class="text-navy"><?= $vacancy['city'] . ', ' . $vacancy['abbreviation'] ?></b>
                  <p><?= Utils::linebreak($vacancy['functions']) ?></p>
                </div>
              <?php endforeach ?>
            </div>
          </div>

        </div>
        <div class="col-md-6">
          <?php $jobsTA = Statistics::getTalentAttractionsAvailable($candidato->id); ?>
          <?php $jobs = Statistics::getVacanciesAvailable($candidato->id); ?>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Vacantes que te podrían interesar</h4>
            </div>
            <div class="card-body">
              <?php foreach ($jobsTA as $ta): ?>
                <div class="callout callout-success">
                  <h5><a href="<?= base_url ?>bolsa/ver&atracciontalento=<?= Encryption::encode($ta['id']) ?>" class="text-primary" style="text-decoration: none;"><?= $ta['job_title'] ?></a></h5>
                  <i class="fas fa-map-marker-alt"></i> <b class="text-navy"><?= $ta['city'] . ', ' . $ta['abbreviation'] ?></b>
                  <?= ($ta['description']) ?>
                </div>
              <?php endforeach ?>
              <?php foreach ($jobs as $v): ?>
                <div class="callout callout-success">
                  <h5><a href="<?= base_url ?>bolsa/ver&vacante=<?= Encryption::encode($v['id']) ?>" class="text-primary" style="text-decoration: none;"><?= $v['vacancy'] ?></a></h5>
                  <i class="fas fa-map-marker-alt"></i> <b class="text-navy"><?= $v['city'] . ', ' . $v['abbreviation'] ?></b>
                  <?= ($v['functions']) ?>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif ?>
      </div>
    </div>
</div>
</section>
<!-- /.content -->
</div>

<script type="text/javascript" src="<?= base_url ?>app/utils.js?v=<?= rand() ?>"></script>

<script>
  let table = document.querySelector('#tb_contacts_SA');
  table.style.display = "table";
  utils.dtTable(table, false);
  let table2 = document.querySelector('#tb_contacts_reclu');
  table2.style.display = "table";
  utils.dtTable(table2, false);



  let table3 = document.querySelector('#table-vencimiento');
  utils.dtTable(table3, false);
</script>


<?php if (!Utils::isCustomer() && !Utils::isCustomerSA() && !Utils::isCandidate()):  ?>
  <script>
    document.addEventListener('DOMContentLoaded', e => {

      Swal.fire({
        //title: "Hola",
        // text: "Modal with a custom image.",
        confirmButtonText: `Enterado`,
        imageUrl: "https://rrhh-ingenia.com.mx/dist/img/frases/frase5.gif",
        imageWidth: 700,
        imageHeight: 400,
        imageAlt: "Custom image"
      });

    })
  </script>
<?php endif; ?>