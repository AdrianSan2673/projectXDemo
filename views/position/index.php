<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 ">
          <div class="alert <?= $_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success' ?>">
            <h3>Plantilla de Puestos</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <br>
  <section class="content-header">
    <div class="row">
      <div class="col-sm-3 ml-auto">
        <div class="btn-group mr-3 text-center">
          <a href="<?= base_url ?>puesto/nuevo" class="btn btn-orange">Crear nuevo puesto</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card bg-transparent">
      <div class="card-header">
        <h3 class="card-title">Listado de puestos</h3>
      </div>
      <div class="card-body">

        <div class="col-12 col-sm-12">
          <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Puestos</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Puestos eliminados</a>
                </li>
              </ul>
            </div>

            <div class="card-body">
              <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                  <table id="tb_positions" class="table table-responsive table-striped table-sm" style="display: none;">
                    <thead>
                      <tr>
                        <th class="text-center align-middle">Puesto</th>
                        <th class="text-center align-middle">Departamento</th>
                        <th class="text-center align-middle">Empresa</th>
                        <th class="text-center align-middle">Creado</th>
                        <th class="text-center align-middle">Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($positions as $position) :  ?>
                        <tr>
                          <td class="text-center align-middle"><?= $position['title'] ?></td>
                          <td class="text-center align-middle"><?= $position['department'] ?></td>
                          <td class="text-center align-middle"><?= $position['Nombre_Empresa'] ?></td>
                          <td class="text-center align-middle"><?= Utils::getDate($position['created_at']) ?></td>
                          <td class="text-center align-middle">
                            <div class="row">

                              <div class="col-6">
                                <a href="<?= base_url ?>puesto/ver&id=<?= Encryption::encode($position['id']) ?>" class="btn btn-success">
                                  <i class="fas fa-eye"></i> Ver
                                </a>
                              </div>

                              <div class="col-4">
                              <a href="<?= base_url ?>puesto/puestoFormato&id=<?= Encryption::encode($position['id']) ?>" class="btn btn-orange" Target="_blank">
                                  <i class="fas fa-file-alt"></i>
                                </a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach;
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="text-center align-middle">Puesto</th>
                        <th class="text-center align-middle">Departamento</th>
                        <th class="text-center align-middle">Empresa</th>
                        <th class="text-center align-middle">Creado</th>
                        <th class="text-center align-middle">Accion</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>

                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                  <table id="tb_positions_desactive" class="table table-responsive table-striped table-sm" style="display: none;">
                    <thead>
                      <tr>
                        <th class="text-center align-middle">Puesto</th>
                        <th class="text-center align-middle">Departamento</th>
                        <th class="text-center align-middle">Empresa</th>
                        <th class="text-center align-middle">Creado</th>
                        <th class="text-center align-middle">Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($positionsDesc as $position) :  ?>
                        <tr>
                          <td class="text-center align-middle"><?= $position['title'] ?></td>
                          <td class="text-center align-middle"><?= $position['department'] ?></td>
                          <td class="text-center align-middle"><?= $position['Nombre_Empresa'] ?></td>
                          <td class="text-center align-middle"><?= Utils::getDate($position['created_at']) ?></td>
                          <td class="text-center align-middle">
                            <div class="row">

                              <div class="col-6">
                                <a href="<?= base_url ?>puesto/ver&id=<?= Encryption::encode($position['id']) ?>" class="btn btn-success">
                                  <i class="fas fa-eye"></i> Ver
                                </a>
                              </div>

                              <div class="col-4">
                                <a href="<?= base_url ?>puesto/puestoFormato&id=<?= Encryption::encode($position['id']) ?>" class="btn btn-orange" Target="_blank">
                                  <i class="fas fa-file-alt"></i>
                                </a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach;
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="text-center align-middle">Puesto</th>
                        <th class="text-center align-middle">Departamento</th>
                        <th class="text-center align-middle">Empresa</th>
                        <th class="text-center align-middle">Creado</th>
                        <th class="text-center align-middle">Accion</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>

              </div>
            </div>

          </div>
        </div>


      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>
<script>
  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_positions');
    table.style.display = "table";
    utils.dtTable(table, true);

    let table_desc = document.querySelector('#tb_positions_desactive');
    table_desc.style.display = "table";
    utils.dtTable(table_desc, true);



  })
</script>