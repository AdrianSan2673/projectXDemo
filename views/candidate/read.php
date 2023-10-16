<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <?php if (!Utils::isCandidate()) : ?>
            <div class="col-sm-2 mr-auto">
              <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
            </div>
            <?php if (!Utils::isCustomer()) : ?>
              <?php if (isset($_GET['vacante'])) : ?>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-left mb-2">
                    <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url . "vacante/index" ?>">Vacantes</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url . "vacante/ver&id=" . $_GET['vacante'] ?>"><?= $vacante->vacancy ?></a></li>
                    <?php if (!Utils::isCustomer()) : ?>
                      <li class="breadcrumb-item"><a href="<?= base_url . "postulaciones/ver&id=" . $_GET['vacante'] ?>">Postulaciones</a></li>
                    <?php endif ?>

                    <li class="breadcrumb-item active"><?= $candidato->first_name . ' ' . $candidato->surname . ' ' . $candidato->last_name ?></li>
                  </ol>
                </div>
              <?php endif ?>
              <div class="col-sm-2 ml-auto">
                <a href="<?= base_url ?>resume/generate&id=<?= Encryption::encode($candidato->id) ?>" target="_blank" class="btn btn-lg bg-danger">
                  <i class="fas fa-download"></i> Generar CV
                </a>
              </div>
            <?php endif ?>
          <?php else : ?>
            <div class="col-sm-2 ml-auto">
              <a href="<?= base_url ?>resume/generate" target="_blank" class="btn btn-lg bg-danger">
                <i class="fas fa-download"></i> Generar CV
              </a>
            </div>
          <?php endif ?>


        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card bg-light" style="/*background: #F4F9FC*/">
              <div class="card-header" style="border-bottom: none;">
                <?php if (!Utils::isCustomer()) : ?>
                  <div class="card-tools">
                    <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                    <button class="btn btn-info" style="font-size: 1.2rem;" value="editar" onclick="update_candidate('<?= Encryption::encode($candidato->id) ?>')"><i class="fas fa-pen"></i> </button>
                    <!-- <a href="<?= base_url ?>candidato/editar&id=<?= Encryption::encode($candidato->id) ?>" class="btn btn-tool" style="font-size: 1.2rem;"><i class="fas fa-pen"></i></a> -->
                    <!--  ===[FIN]=== -->
                  </div>
                <?php endif ?>

              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-6 col-sm-6 col-md-8 mx-auto">
                    <img id="img_can" src="<?= $route ?>" class="img-fluid img-circle user-image mt-3"> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-12 text-center">
                    <h5><b id="first_name_can"><?= $candidato->first_name . ' ' . $candidato->surname . ' ' . $candidato->last_name ?></b></h5> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h6 class="text-uppercase" id="title_can"><?= $candidato->job_title ?></h6> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-12" id="div_candidato">
                    <h4 class="text-muted">Acerca de mí</h4>
                    <p id="description_can"><?= $candidato->description ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                    <?php if (!Utils::isCustomer()) : ?>
                      <ul class="list-unstyled mb-3">
                        <li>
                          <p id="telephone_can"><i class="fas fa-phone-alt"></i><?= '   ' . $candidato->telephone ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                        </li>
                        <li>
                          <p id="cellphone_can"><i class="fas fa-mobile-alt"></i><?= '   ' . $candidato->cellphone ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                        </li>
                        <li>
                          <p id="email_can"><i class="fas fa-envelope"></i><?= '   ' . $candidato->email ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                        </li>
                        <li>
                          <p id="city_state_can"><i class="fas fa-map-marker-alt"></i><?= '   ' . $candidato->city . ', ' . $candidato->state ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                        </li>
                        <?php if ($candidato->linkedinn != "") :  ?><!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                          <li>
                            <p id="linkedinn_can"><i class="fab fa-linkedin-in"></i><?= '   ' . $candidato->linkedinn ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                          </li>
                        <?php endif;   ?>
                        <?php if ($candidato->facebook != "") :  ?><!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                          <li>
                            <p id="facebook_can"><i class="fab fa-facebook-square"></i><?= '   ' . $candidato->facebook ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                          </li>
                        <?php endif;   ?>
                        <?php if ($candidato->instagram != "") :  ?><!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                          <li>
                            <p id="instagram_can"><i class="fab fa-instagram"></i><?= '   ' . $candidato->instagram ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                          </li>
                        <?php endif;   ?>

                      </ul>
                    <?php endif ?>

                  </div>
                </div>
                <?php if (Utils::isAdmin() || Utils::isSenior()) : ?>
                  <div class="content mt-4" id="div_fechas">
                    <b class="text-muted">Fecha de registro</b>
                    <p id="created_at_can"><?= Utils::getFullDate($candidato->created_at) ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                    <b class="text-muted">última modificación</b>
                    <p id="modified_at_can"><?= Utils::getFullDate($candidato->modified_at) ?></p> <!-- ===[GABO 27 ABRIL VER CANDIDATO2]=== -->
                  </div>
                <?php endif ?>


                <div class="row mt-4 mx-auto">
                  <?php if (Utils::isAdmin()||Utils::isSenior()||Utils::isJunior()||Utils::isCandidate()) : ?>
                    <div class="col-12 text-center">
                      <a href="<?= base_url ?>candidato/editar&id=<?= Encryption::encode($candidato->id) ?>" class="btn btn-lg btn-info"><i class="fas fa-pen"></i> Editar</a>

                    </div>
                  <?php endif ?>

                  <?php if ($cv_route) : ?>

                    <div class="col-12 mt-4 text-center">
                      <a href="<?= $cv_route ?>" target="_blank" class="btn btn-lg btn-success"><i class="fas fa-file-download"></i> Descargar CV personal</a>
                    </div>

                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-success">
              <div class="card-header">
                <h4 class="card-title">EXPERIENCIA</h4>
                <?php if (!Utils::isCustomer()) : ?>
                  <div class="card-tools">
                    <!-- ===[GABOL 19 Abril VER CANDIDATE]=== -->
                    <!-- <a href="<?= base_url ?>experiencia/crear&id=<?= Encryption::encode($candidato->id) ?>" class="btn btn-tool" style="font-size: 1.2rem;"><i class="fas fa-plus"></i> Agregar  </a> -->
                    <button class="btn" style="font-size: 1.2rem;" value="Agregar" onclick="save_experience('<?= Encryption::encode($candidato->id) ?>')"><i class="fas fa-plus"></i>Agregar </button>
                    <!-- ===[FIN]=== -->
                  </div>
                <?php endif ?>

              </div>
              <!-- ===[GABOL 19 Abril VER CANDIDATE]=== -->
              <div class="card-body" id="div_experiencia">
                <!-- ===[FIN]=== -->
                <?php foreach ($experiences as $exp) : ?>
                  <div class="row">
                    <div class="col-md-12">
                      <h5><b><?= $exp['position'] ?></b></h5>
                      <?php if (!Utils::isCustomer()) : ?>
                        <!-- ===[gabo 21 abril ver candidato  ]=== -->
                        <!-- <a href="<?= base_url ?>experiencia/editar&id=<?= Encryption::encode($exp['id_experience']) ?>" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i>
                              </a> -->
                        <button value="eliminar" onclick="delete_experience('<?= Encryption::encode($exp['id_experience']) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button>
                        <button value="editar" onclick="update_experience('<?= Encryption::encode($exp['id_experience']) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
                        <!-- ===[FIN  ]=== -->
                      <?php endif ?>

                      <p class="font-italic"><?= $exp['enterprise'] . ' | ' . $exp['city'] . ' - ' . $exp['state'] . ' | ' . strftime("%B %Y", strtotime($exp['start_date'])) . ' - ' . $end_date = ($exp['still_works'] == 1) ? 'Presente' : strftime("%B %Y", strtotime($exp['end_date'])) ?></p>
                      <p><?= $exp['review'] ?></p>
                      <ul>
                        <li><?= $exp['activity1'] ?></li>
                        <li><?= $exp['activity2'] ?></li>
                        <li><?= $exp['activity3'] ?></li>
                        <li><?= $exp['activity4'] ?></li>
                      </ul>
                    </div>
                  </div>
                <?php endforeach ?>


              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-maroon">
              <div class="card-header">
                <h4 class="card-title">EDUCACIÓN</h4>
                <?php if (!isset($candidato->level) && !Utils::isCustomer()) : ?>
                  <div class="card-tools">
                    <!-- ===[gabo 21 abril ver candidato ]===  -->
                    <!-- <a href="<?= base_url ?>educacion/crear&id=<?= Encryption::encode($candidato->id) ?>" class="btn btn-tool" style="font-size: 1.2rem;"><i class="fas fa-plus"></i> Agregar
                    </a> -->
                    <button value="save_education" onclick="save_education('<?= Encryption::encode($candidato->id) ?>',this)" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
                    <!-- ===[ FIN ]=== -->
                  </div>
                <?php endif ?>
              </div>
              <!-- ===[gabo 24 abril ver candidato ]===  -->
              <div class="card-body" id="div_education">
                <!-- ===[ FIN ]=== -->
                <div class="row" id="education_div">
                  <?php if (isset($candidato->level)) : ?>
                    <div class="col-md-6">
                      <b class="text-muted"><?= $candidato->level ?></b>
                      <?php if (!Utils::isCustomer()) : ?>
                        <!-- ===[gabo 24 abril ver candidato ]===  -->
                        <!-- <a href="<?= base_url ?>educacion/editar&id=<?= Encryption::encode($candidato->id) ?>" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i></a> -->
                        <button value="update_education" onclick="save_education('<?= Encryption::encode($candidato->id) ?>',this)" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
                        <!-- ===[ FIN ]=== -->
                      <?php endif ?>
                      <p><?= $candidato->title ?></p>
                      <p><?= $candidato->institution ?></p>
                      <?php if ($candidato->start_date != NULL) : ?>
                        <p><?= strftime("%Y", strtotime($candidato->start_date)) . ' - ' . $end_date = ($candidato->still_studies == 1) ? 'Presente' : strftime("%Y", strtotime($candidato->end_date)) ?></p>
                      <?php endif ?>

                    </div>
                  <?php endif ?>

                </div>
              </div>
            </div>
            <div class="card card-orange">
              <div class="card-header">
                <h4 class="card-title">FORMACIÓN ADICIONAL</h4>
                <?php if (!Utils::isCustomer()) : ?>
                  <div class="card-tools">
                    <!-- ===[gabo 24 abril ver candidato ]===  -->
                    <!-- <a href="<?= base_url ?>formacion/crear&id=<?= Encryption::encode($candidato->id) ?>" class="btn btn-tool" style="font-size: 1.2rem;"><i class="fas fa-plus"></i> Agregar
                    </a> -->
                    <button value="save_preparation" onclick="save_preparation('<?= Encryption::encode($candidato->id) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-plus"></i>Agregar </button>
                    <!-- ===[ FIN ]=== -->
                  </div>
                <?php endif ?>

              </div>
              <div class="card-body">
                <!-- ===[gabo 25 abril ver candidato ]===  -->
                <div class="row" id="div_preparation">
                  <!-- ===[ FIN ]=== -->
                  <?php foreach ($preparations as $ap) : ?>
                    <div class="col-md-6">
                      <b class="text-muted"><?= $ap['course'] ?></b>
                      <?php if (!Utils::isCustomer()) : ?>
                        <!-- ===[gabo 25 abril ver candidato ]===  -->
                        <!-- <a href="<?= base_url ?>formacion/editar&id=<?= Encryption::encode($ap['id']) ?>" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i></a> -->
                        <button value="eliminar" onclick="delete_preparation('<?= Encryption::encode($ap['id']) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button>
                        <button value="update_preparation" onclick="update_preparation('<?= Encryption::encode($ap['id']) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
                        <!-- ===[ FIN ]=== -->
                      <?php endif ?>

                      <?php if ($ap['level'] != NULL) : ?>
                        <p><?= $ap['level'] ?></p>
                      <?php endif ?>
                      <p><?= $ap['institution'] ?></p>
                      <p><?= date("Y", strtotime($ap['start_date'])) . ' - ' . date("Y", strtotime($ap['end_date'])) ?></p>
                    </div>
                  <?php endforeach ?>

                </div>
              </div>
            </div>
            <div class="card card-info">
              <div class="card-header">
                <h4 class="card-title">IDIOMAS</h4>
                <?php if (!Utils::isCustomer()) : ?>
                  <div class="card-tools">
                    <!-- ===[gabo 25 abril ver candidato ]===  -->
                    <!-- <a href="<?= base_url ?>idioma/crear&id=<?= Encryption::encode($candidato->id) ?>" class="btn btn-tool" style="font-size: 1.2rem;"><i class="fas fa-plus"></i> Agregar
                    </a> -->
                    <button value="save_language" onclick="save_language('<?= Encryption::encode($candidato->id) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-plus"></i>Agregar </button>
                    <!-- ===[ FIN ]=== -->
                  </div>
                <?php endif ?>
              </div>
              <div class="card-body">
                <!-- ===[gabo 25 abril ver candidato ]===  -->
                <div class="row" id="div_language">
                  <!-- ===[ FIN ]=== -->
                  <?php foreach ($languages as $lan) : ?>
                    <div class="col-md-6">
                      <b class="text-muted"><?= $lan['language'] . ' / ' . $lan['language_level'] ?></b>
                      <?php if (!Utils::isCustomer()) : ?>
                        <!-- ===[gabo 25 abril ver candidato ]===  -->
                        <!-- <a href="<?= base_url ?>idioma/editar&id=<?= Encryption::encode($lan['id']) ?>" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i></a> -->
                        <button value="eliminar" onclick="delete_language('<?= Encryption::encode($lan['id']) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button>
                        <button value="update_language" onclick="update_language('<?= Encryption::encode($lan['id']) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
                        <!-- ===[ FIN ]=== -->

                      <?php endif ?>
                      <p><?= $lan['institution'] ?></p>
                      <p><?= date("Y", strtotime($lan['start_date'])) . ' - ' . date("Y", strtotime($lan['end_date'])) ?></p>
                    </div>
                  <?php endforeach ?>
                </div>
              </div>
            </div>
            <div class="card card-navy">
              <div class="card-header">
                <h4 class="card-title">APTITUDES</h4>
                <?php if (!Utils::isCustomer()) : ?>
                  <div class="card-tools">
                    <!-- ===[gabo 25 abril ver candidato ]===  -->
                    <!-- <a href="<?= base_url ?>aptitud/crear&id=<?= Encryption::encode($candidato->id) ?>" class="btn btn-tool" style="font-size: 1.2rem;"><i class="fas fa-plus"></i> Agregar
                    </a> -->
                    <button value="save_aptitude" onclick="save_aptitude('<?= Encryption::encode($candidato->id) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;color:white"><i class="fas fa-plus"></i>Agregar </button>
                    <!-- ===[ FIN ]=== -->

                  </div>
                <?php endif ?>
              </div>
              <div class="card-body">
                <!-- ===[gabo 25 abril ver candidato ]===  -->
                <div class="row" id="div_aptitude">
                  <!-- ===[ FIN ]=== -->
                  <?php foreach ($aptitudes as $apt) : ?>
                    <div class="col-md-4">
                      <?php if (!Utils::isCustomer()) : ?>
                        <!-- ===[gabo 25 abril ver candidato ]===  -->
                        <!-- <a href="<?= base_url ?>aptitud/editar&id=<?= Encryption::encode($apt['id']) ?>" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i></a> -->
                        <button value="eliminar" onclick="delete_aptitude('<?= Encryption::encode($apt['id']) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button>
                        <button value="update_aptitude" onclick="update_aptitude('<?= Encryption::encode($apt['id']) ?>')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
                        <!-- ===[ FIN ]=== -->

                      <?php endif ?>
                      <p><?= $apt['aptitude'] ?></p>
                      <h6 class="text-muted"><?php for ($i = 1; $i <= 10; $i++) { ?>
                          <?php if ($i <= $apt['level']) : ?>
                            <i class="fas fa-circle"></i>
                          <?php else : ?>
                            <i class="far fa-circle"></i>
                          <?php endif ?>
                        <?php } ?>
                      </h6>
                    </div>
                  <?php endforeach ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <?php if (!Utils::isCustomer() && !Utils::isCandidate()) : ?>
          <?php if (Utils::isRecruitmentManager()||Utils::isAdmin() ) : ?>
            <br>
            <div class="card card-info">
              <div class="card-header">
                <h4 class="card-title">Vacantes a las que se ha postulado</h4>
              </div>
              <div class="card-body">
                <button class="btn btn-orange float-right btn-lg" data-toggle="modal" data-target="#modal-postular">Postular</button>

                <table id="tb_vacancies" class="table table-responsive table-striped" style="font-size: 0.6rem;">
                  <thead>
                    <tr>
                      <?php if (!Utils::isCustomer()) : ?>
                        <th class="align-middle text-center">Fecha de postulación</th>
                      <?php endif ?>
                      <th>Estado</th>
                      <th>Acerca de</th>
                      <th>Fecha de entrevista</th>
                      <th>Comentarios de la entrevista</th>
                      <th class="align-middle">Fecha de recepción</th>
                      <?php if (!Utils::isCustomer()) : ?>
                        <th class="align-middle">Cliente</th>
                      <?php endif ?>
                      <th class="align-middle">Vacante</th>
                      <th class="align-middle">Ciudad</th>

                      <th class="align-middle text-center"><?= !Utils::isCustomer() ? 'Sueldo' : 'Valor de la vacante' ?></th>
                      <?php if (!Utils::isCustomer()) : ?>
                        <th class="align-middle">Fecha de finalización</th>
                      <?php endif ?>
                      <th class="align-middle">Estado de vacante</th>
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
                          default:
                            $class_color = '';
                            break;
                        }
                        ?>
                        <?php if (!Utils::isCustomer()) : ?>
                          <td><?= Utils::getFullDate($vacancy['applicant_date']) ?></td>
                        <?php endif ?>
                        <td><?= $vacancy['applicant_status'] ?></td>
                        <td><?= $vacancy['about'] ?></td>
                        <td><?= $vacancy['interview_date'] ?></td>
                        <td><?= $vacancy['interview_comments'] ?></td>
                        <td><?= Utils::getFullDate($vacancy['request_date']); ?></td>
                        <?php if (!Utils::isCustomer()) : ?>
                          <td><?= $vacancy['customer'] ?></td>
                        <?php endif ?>
                        <td><?= $vacancy['vacancy'] ?></td>
                        <td><?= $vacancy['city'] . ', ' . $vacancy['abbreviation'] ?></td>
                        <td class="text-center">$<?= $vacancy['salary_min'] != $vacancy['salary_max'] ? number_format($vacancy['salary_min'])  . ' - $' . number_format($vacancy['salary_max']) : number_format($vacancy['salary_min']) ?></td>
                        <?php if (!Utils::isCustomer()) : ?>
                          <td><?= $end_date = $vacancy['end_date'] != NULL ? Utils::getFullDate($vacancy['end_date']) : '' ?></td>
                        <?php endif ?>
                        <td class="text-center <?= $class_color ?>"><?= $vacancy['status'] ?></td>
                        <td class="text-center py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="<?= base_url ?>vacante/ver&id=<?= Encryption::encode($vacancy['id']) ?>" class="btn btn-success">
                              <i class="fas fa-eye"></i>
                            </a>
                            <?php if (Utils::isAdmin() || Utils::isSenior()) : ?>
                              <a href="<?= base_url ?>vacante/editar&id=<?= Encryption::encode($vacancy['id']) ?>" class="btn btn-info">
                                <i class="fas fa-pencil-alt"></i>
                              </a>
                            <?php endif ?>
                            <?php if (Utils::isJunior()) : ?>
                              <a href="<?= base_url ?>postulaciones/buscar&id=<?= Encryption::encode($vacancy['id']) ?>&area=<?= Encryption::encode($vacancy['id_area']) ?>" class="btn btn-info">
                                <i class="fas fa-search"></i>
                              </a>
                            <?php endif ?>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <?php if (!Utils::isCustomer()) : ?>
                        <th>Fecha de recepción</th>
                      <?php endif ?>
                      <th>Estado</th>
                      <th>Acerca de</th>
                      <th>Fecha de entrevista</th>
                      <th>Comentarios de la entrevista</th>
                      <th>Fecha de recepción</th>
                      <?php if (!Utils::isCustomer()) : ?>
                        <th>Cliente</th>
                      <?php endif ?>
                      <th>Vacante</th>
                      <th>Ciudad</th>

                      <th class="text-center"><?= !Utils::isCustomer() ? 'Sueldo' : 'Valor de la vacante' ?></th>
                      <?php if (!Utils::isCustomer()) : ?>
                        <th>Fecha de finalización</th>
                      <?php endif ?>
                      <th>Estado de vacante</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
                <script>
                  $(document).ready(function() {
                    let table = document.querySelector('#tb_vacancies');
                    utils.dtTable(table);
                  });
                </script>
              </div>
            </div>
          <?php endif ?>
          <div class="card card-navy">
            <div class="card-header">
              <h4 class="card-title">Psicometrías</h4>
            </div>
            <div class="card-body">
              <div class="text-right">
                <a href="<?= base_url ?>psicometria/crear&candidate=<?= $_GET['id'] ?>" class="btn btn-success">Registrar psicometría</a>
              </div>
              <table id="tb_psychometrics" class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th class="align-middle text-center">Fecha solicitud</th>
                    <!-- <th class="align-middle text-center">Psicometría</th> -->
                    <th class="align-middle text-center">Cliente</th>
                    <th class="align-middle text-center">Razón social</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($psychometrics as $psycho) : ?>
                    <tr>
                      <td class="text-center align-middle"><?= Utils::getShortDate($psycho['request_date']) ?></td>
                      <!-- <td class="text-center align-middle"><?= $psycho['type'] ?></td> -->
                      <td class="text-center align-middle"><?= $psycho['customer'] ?></td>
                      <td class="text-center align-middle"><?= $psycho['business_name'] ?></td>
                      <td class="text-center py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="" class="btn btn-success">
                            <i class="fas fa-eye"></i>
                          </a>
                          <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                            <a href="#" class="btn btn-info">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                          <?php endif ?>

                        </div>

                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="align-middle text-center">Fecha solicitud</th>
                    <!-- <th class="align-middle text-center">Psicometría</th> -->
                    <th class="align-middle text-center">Cliente</th>
                    <th class="align-middle text-center">Razón social</th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
              <script>
                $(document).ready(function() {
                  let table = document.querySelector('#tb_psychometrics');
                  utils.dtTable(table);
                });
              </script>
            </div>
          </div>
        <?php endif ?>
      </div><!-- /.container-fluid -->
    </section>
  </div>

</div>
<script src="<?= base_url ?>app/candidate.js?v=<?= rand() ?>"></script>



<!--===[gabo 19 abril ver candidato]===-->
<script>
  function save_experience(id_candidate) {
    document.getElementById('save-experience-form').reset();
    $('#id_candidate').val(id_candidate);
    $('#id_experience').val("");

    $('#id_area').val('1');
    $('#id_area').trigger('change');
    $('#id_subarea').val('1');
    $('#id_subarea').trigger('change');
    $('#id_city').val('1');
    $('#id_city').trigger('change');
    $('#id_state').val('1');
    $('#id_state').trigger('change');
    document.querySelector('#modal_experiencia_candidato #title_modal').innerHTML = 'Nueva Experiencia';

    $('#modal_experiencia_candidato').modal({
      backdrop: 'static',
      keyboard: false
    });


  };

  function update_experience(id_experience) {
    document.getElementById('save-experience-form').reset();
    $('#id_experience').val(id_experience);
    $('#id_candidate').val("");


    document.querySelector('#modal_experiencia_candidato #title_modal').innerHTML = 'Editar Experiencia';

    $('#modal_experiencia_candidato').modal({
      backdrop: 'static',
      keyboard: false
    });
    let experience = new Experience();
    experience.fill_experience();

  };

  function delete_experience(id_experience) {

    Swal.fire({
      title: '¿Desea eliminar la experiencia?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      console.log(result);
      if (result.value == true) {
        let experience = new Experience();
        experience.delete_experience(id_experience);

      }
    })

  };


  function save_education(id_candidate, accion) {

    if (accion.value == 'update_education') {

      document.getElementById('save-education-form').reset();

      $('#accion_education').val("update");
      $('#save-education-form #id_candidate_education').val(id_candidate);
      document.querySelector('#modal_educacion_candidato #title_modal_education').innerHTML = 'Editar Educación';

      let education = new Education();
      education.fill_modal(id_candidate);

      $('#modal_educacion_candidato').modal({
        backdrop: 'static',
        keyboard: false
      });

    };


  };



  function save_preparation(id_candidate) {

    document.getElementById('save-preparation-form').reset();
    $('#id_candidate_preparation').val(id_candidate);
    $('#id_preparation').val("");
    document.querySelector('#modal_preparation_candidato #title_modal_preparation').innerHTML = 'Guardar Formación';
    $('#modal_preparation_candidato').modal({
      backdrop: 'static',
      keyboard: false
    });

  };


  function update_preparation(id_preparation) {

    $('#id_candidate_preparation').val("");
    $('#id_preparation').val(id_preparation);
    document.querySelector('#modal_preparation_candidato #title_modal_preparation').innerHTML = 'Editar Formación';

    let preparation = new Preparation();
    preparation.fill_modal(id_preparation);

    $('#modal_preparation_candidato').modal({
      backdrop: 'static',
      keyboard: false
    });

  }

  function delete_preparation(id_preparation) {

    Swal.fire({
      title: '¿Desea eliminar esta formación?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      console.log(result);
      if (result.value == true) {
        let preparation = new Preparation();
        preparation.delete_preparation(id_preparation);

      }
    })

  };


  function save_language(id_candidate) {

    document.getElementById('save-language-form').reset();

    $("#language").val("");
    $('#language').trigger('change');
    $("#level_language").val("");
    $('#level_language').trigger('change');

    $('#id_candidate_language').val(id_candidate);
    $('#id_language').val("");
    document.querySelector('#modal_language_candidato #title_modal_language').innerHTML = 'Añadir idioma';
    $('#modal_language_candidato').modal({
      backdrop: 'static',
      keyboard: false
    });

  };


  function update_language(id_language) {

    $('#id_candidate_language').val("");
    $('#id_language').val(id_language);
    document.querySelector('#modal_language_candidato #title_modal_language').innerHTML = 'Editar Idioma';

    let language = new Language();
    language.fill_modal(id_language);

    $('#modal_language_candidato').modal({
      backdrop: 'static',
      keyboard: false
    });

  }

  function delete_language(id_language) {

    Swal.fire({
      title: '¿Desea eliminar este idioma?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      console.log(result);
      if (result.value == true) {
        let language = new Language();
        language.delete_language(id_language);

      }
    })

  };


  function save_aptitude(id_candidate) {

    document.getElementById('save-aptitude-form').reset();

    $("#level_aptitude").val("");
    $('#level_aptitude').trigger('change');

    $('#id_candidate_aptitude').val(id_candidate);
    $('#id_aptitude').val("");
    document.querySelector('#modal_aptitude_candidato #title_modal_aptitude').innerHTML = 'Añadir Aptitud';
    $('#modal_aptitude_candidato').modal({
      backdrop: 'static',
      keyboard: false
    });

  };


  function update_aptitude(id_aptitude) {

    $('#id_candidate_aptitude').val("");
    $('#id_aptitude').val(id_aptitude);
    document.querySelector('#modal_aptitude_candidato #title_modal_aptitude').innerHTML = 'Editar Aptitud';

    let aptitude = new Aptitude();
    aptitude.fill_modal(id_aptitude);

    $('#modal_aptitude_candidato').modal({
      backdrop: 'static',
      keyboard: false
    });

  }

  function delete_aptitude(id_aptitude) {

    Swal.fire({
      title: '¿Desea eliminar este idioma?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      console.log(result);
      if (result.value == true) {
        let aptitude = new Aptitude();
        aptitude.delete_aptitude(id_aptitude);

      }
    })

  };


  // ===[GABO 27 ABRIL VER CANDIDATO2]===

  function update_candidate(id_candidate) {

    $('#modal_candidato').modal({
      backdrop: 'static',
      keyboard: false
    });

  }

  // ===[FIN]===
</script>