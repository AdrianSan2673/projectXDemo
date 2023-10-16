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
    <?php if (!Utils::isCustomer()): ?>
      <section class="content-header">
        <div class="row">
          <div class="col-sm-2 ml-auto">
            <a class="btn btn-orange float-right" href="<?=base_url?>psicometria/crear">Registrar psicometria</a>
          </div>
        </div>
      </section>
      <br>
    <?php endif ?>
    
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
                      <th class="align-middle text-center">Comportamiento</th>
                      <th class="align-middle text-center">Inteligencia</th>
                      <th class="align-middle text-center">Competencias laborales</th>
                      <th class="align-middle text-center">Honestidad</th>
                      <th class="align-middle text-center">Personalidad</th>
                      <th class="align-middle text-center">Habilidades de ventas</th>
                      <th class="align-middle text-center">Liderazgo</th>
                      <th class="align-middle text-center">Estado</th>
                      <th class="align-middle text-center">Fecha de entrega</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach($psychometrics as $psycho): ?>
                      <tr>
                          <?php switch ($psycho['status']) {
                            case 1: $class_color = 'bg-orange';break;
                            case 2: $class_color = 'bg-success';break;
                            case 3: $class_color = 'bg-info';break;
                            default: $class_color = '';break;
                          }
                          ?>
                          <td class="text-center align-middle"><?=Utils::getShortDate($psycho['request_date'])?></td>
                          <td class="text-center align-middle"><?=$psycho['first_name'].' '.$psycho['surname'].' '.$psycho['last_name']?></td>
                          <td class="text-center align-middle"><?=$psycho['customer']?></td>
                          <td class="text-center align-middle"><?=$psycho['business_name']?></td>
                          <td class="text-center align-middle"><?=$psycho['behavior'] == 1 ? '<i class="fas fa-check"></i>' : ''?></td>
                          <td class="text-center align-middle"><?=$psycho['intelligence'] == 1 ? '<i class="fas fa-check"></i>' : ''?></td>
                          <td class="text-center align-middle"><?=$psycho['labor_competencies'] == 1 ? '<i class="fas fa-check"></i>' : ''?></td>
                          <td class="text-center align-middle"><?=$psycho['honesty_ethics_values'] == 1 ? '<i class="fas fa-check"></i>' : ''?></td>
                          <td class="text-center align-middle"><?=$psycho['personality'] == 1 ? '<i class="fas fa-check"></i>' : ''?></td>
                          <td class="text-center align-middle"><?=$psycho['sales_skills'] == 1 ? '<i class="fas fa-check"></i>' : ''?></td>
                          <td class="text-center align-middle"><?=$psycho['leadership'] == 1 ? '<i class="fas fa-check"></i>' : ''?></td>
                          <td class="text-center align-middle <?=$class_color?>"><?=$psycho['estado']?></td>
                          <td class="text-center align-middle"><?=!is_null($psycho['end_date']) && !empty($psycho['end_date']) ? $psycho['end_date'] : ''?></td>
                          <td class="text-center py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                              <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                                <a href="<?=base_url?>psicometria/ver&id=<?=Encryption::encode($psycho['id'])?>" class="btn btn-success">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?=base_url?>psicometria/editar&id=<?=Encryption::encode($psycho['id'])?>" class="btn btn-info">
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
                      <th class="align-middle text-center">Candidato</th>
                      <th class="align-middle text-center">Cliente</th>
                      <th class="align-middle text-center">Razón social</th>
                      <th class="align-middle text-center">Comportamiento</th>
                      <th class="align-middle text-center">Inteligencia</th>
                      <th class="align-middle text-center">Competencias laborales</th>
                      <th class="align-middle text-center">Honestidad</th>
                      <th class="align-middle text-center">Personalidad</th>
                      <th class="align-middle text-center">Habilidades de ventas</th>
                      <th class="align-middle text-center">Liderazgo</th>
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
  $(document).ready(function(){
    let table = document.querySelector('#tb_psychometrics');
    utils.dtTable(table);
  });
</script>