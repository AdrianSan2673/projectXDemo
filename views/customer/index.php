<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Nuestros clientes</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior()): ?>
      <section class="content-header">
        <div class="row">
          <div class="col-md-4">
            <div class="info-box mb-3 bg-navy">
              <span class="info-box-icon"><i class="fas fa-briefcase"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de operaciones ingresadas en <?=strftime('%B')?></span>
                <span class="info-box-number"><?=Statistics::getVacancyCountInCurrentMonth()?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
        </div>
        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
          <div class="row">
            <div class="col-sm-2 ml-auto">
              <a class="btn btn-orange float-right" href="<?=base_url?>cliente/crear">Crear cliente</a>
            </div>
          </div>
          <div class="row mt-5">
          <div class="col-sm-2 mr-auto">
              <a class="btn btn-primary float-right" href="<?=base_url?>clientecontacto/index"><i class="far fa-id-card"></i> Contactos</a>
            </div>
            <div class="col-sm-2 mx-auto">
              <a class="btn btn-warning float-right" href="<?=base_url?>cliente/evaluaciones"><i class="fas fa-star"></i> Últimas evaluaciones</a>
            </div>
            <div class="col-sm-2 ml-auto">
              <a class="btn btn-danger float-right" href="<?=base_url?>cliente/detallado"><i class="fas fa-chart-bar mr-1"></i>Detallado</a>
            </div>
          </div>
        <?php endif ?>
      </section>
      <br>
    <?php endif ?>
    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Listado de clientes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tb_customers" class="table table-striped">
                <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                        <th class="filterhead"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      <?php endif ?>
                      <th></th>
                    </tr>
                    <tr>
                      <th>Cliente</th>
                      <th>Alias</th>
                      <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                        <th class="text-center align-middle">Centro de costo</th>
                        <th class="text-center align-middle"># vacantes de <?=strftime('%B')?></th>
                        <th class="text-center align-middle"># vacantes de <?=date('Y')?></th>
                        <th class="text-center align-middle">Fecha última evaluación</th>
                        <th class="text-center align-middle">Última evaluación</th>
                      <?php endif ?>
                      <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($customers as $customer): ?>
                    <tr>
                        <td><?=$customer['customer']?></td>
                        <td><?=$customer['alias']?></td>
                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                          <td class="text-center align-middle"><?=$customer['cost_center']?></td>
                          <td class="text-center align-middle"><?=$customer['monthly']?></td>
                          <td class="text-center align-middle"><?=$customer['annually']?></td>
                          <td class="text-center align-middle"><?=$last_evaluation = $customer['last_evaluation'] != NULL ? Utils::getShortDate($customer['last_evaluation']) : ''?></td>
                          <td class="text-center align-middle"><?=$score = $customer['score'] != NULL ? number_format($customer['score'], 1) : ''?></td>
                        <?php endif ?>
                        
                        <td class="text-center py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="<?=base_url?>cliente/ver&id=<?=Encryption::encode($customer['id'])?>" class="btn btn-success">
                              <i class="fas fa-eye"></i> Ver
                            </a>
                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                              <a href="<?=base_url?>cliente/editar&id=<?=Encryption::encode($customer['id'])?>" class="btn btn-info">
                                <i class="fas fa-pencil-alt"></i> Editar
                              </a>
                              <a href="<?=base_url?>cliente/evaluar&id=<?=Encryption::encode($customer['id'])?>" class="btn btn-warning">
                                <i class="fas fa-star"></i> Evaluar
                              </a>
                            <?php endif ?>
                          </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                      <th>Cliente</th>
                      <th>Alias</th>
                      <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                        <th class="text-center align-middle">Centro de costo</th>
                        <th class="text-center align-middle"># vacantes de <?=strftime('%B')?></th>
                        <th class="text-center align-middle"># vacantes de <?=date('Y')?></th>
                        <th class="text-center align-middle">Fecha última evaluación</th>
                        <th class="text-center align-middle">Última evaluación</th>
                      <?php endif ?>
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
  $(document).ready(function(){
    let table = document.querySelector('#tb_customers');
    utils.dtTable(table);
  });
</script>