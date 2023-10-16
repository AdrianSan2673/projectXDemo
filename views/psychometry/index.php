<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Psicometrías</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
	
    <section class="content-header">
      <div class="row">
        <div class="col-sm-2 ml-auto">
          <a class="btn btn-orange float-right" href="<?= base_url ?>psicometria/crear">Registrar psicometria</a>
        </div>
      </div>
    </section>
    <br>

  <!-- Main content -->
  <section class="content">
    <div class="card car-success">
      <div class="card-header">
        <h3 class="card-title">Listado de psicometrías</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tb_psychometrics" class="table table-striped" style="font-size: 0.6rem;">
          <thead>
            <tr>
              <th class="align-middle text-center">Fecha solicitud</th>
              <th class="align-middle text-center">Candidato</th>
              <th class="align-middle text-center">Cliente</th>
              <th class="align-middle text-center">Razón social</th>
              <th class="align-middle text-center">Estado</th>
              <th class="align-middle text-center">Fecha de entrega</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($psychometrics as $psycho) : ?>
              <tr>
                <?php switch ($psycho['status']) {
                  case 1:
                    $class_color = 'bg-orange';
                    break;
                  case 2:
                    $class_color = 'bg-success';
                    break;
                  case 3:
                    $class_color = 'bg-info';
                    break;
                  default:
                    $class_color = 'bg-danger';
                    break;
                }

                if (file_exists('uploads/psychometrics/' . $psycho['id'] . '.pdf')) {
                  $routeDocu = base_url . 'resume/psicometria&id=' . Encryption::encode($psycho['id']);

                } else {
                  $routeDocu = false;
                }

                ?>
                <td class="text-center align-middle"><?= Utils::getShortDate($psycho['request_date']) ?></td>
                <td class="text-center align-middle"><?= $psycho['first_name'] . ' ' . $psycho['surname'] . ' ' . $psycho['last_name'] ?></td>
                <td class="text-center align-middle"><?= $psycho['customer'] ?></td>
                <td class="text-center align-middle"><?= $psycho['business_name'] ?></td>
                <td class="text-center align-middle <?= $class_color ?>"><?= $psycho['estado'] ?></td>
                <td class="text-center align-middle"><?= !is_null($psycho['end_date']) && !empty($psycho['end_date']) ? Utils::getDate($psycho['end_date']) : '' ?></td>
                <td class="text-center py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                      <a href="<?= base_url ?>psicometria/editar&id=<?= Encryption::encode($psycho['id']) ?>" class="btn btn-info mr-2" target="blank_">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
                    <?php endif ?>
                    <!-- gabo22 -->
                    <?php if (($routeDocu != false && (Utils::isAdmin() || Utils::isManager()  || Utils::isSenior())) || (utils::isCustomer()&& $routeDocu != false  && $psycho['estado']==2)) : ?>
                      <a href="<?= $routeDocu ?>" class="btn btn-danger mr-2" target="blank_" title="Ver Psicometria">
                        <i class="fas fa-file-pdf"></i>
                      </a>
                    <?php endif;  ?>

                    <a href="<?= base_url ?>psicometria/ver&id=<?= Encryption::encode($psycho['id']) ?>" class="btn btn-success" target="blank_">
                      <i class="fas fa-eye"></i>
                    </a>
                  </div>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th class="align-middle text-center">Fecha solicitud</th>
              <th class="align-middle text-center">Candidato</th>
              <th class="align-middle text-center">Cliente</th>
              <th class="align-middle text-center">Razón social</th>
              <th class="align-middle text-center">Estado</th>
              <th class="align-middle text-center">Fecha de entrega</th>
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
    let table = document.querySelector('#tb_psychometrics');
    utils.dtTable(table);
  });
</script>