<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Ordenes de compra</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
      <!-- <div class="container-fluid">
        <form method="POST" action="<?=base_url."administracion/ordenes_de_compra"?>" class="row">
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="start_date" class="col-form-label">Fecha inicial:</label>
              <input type="date" name="start_date" id="start_date" value="<?=isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d')?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="end_date" class="col-form-label">Fecha final:</label>
              <input type="date" name="end_date" id="end_date" value="<?=isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d')?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-2" style="padding-right: 14px;">
              <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar</button>
          </div>
        </form>
        <hr>
      </div>  --> 
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab_1" data-toggle="tab">En seguimiento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_2" data-toggle="tab">Facturadas</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <table id="tb_orders" class="table table-responsive table-striped">
                    <thead>
                        <tr>
                          <th class="align-middle">Folio</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Facturable a</th>
                          <th class="align-middle text-center"># servicios</th>
                          <th class="align-middle text-right">Total</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle text-center">Fecha última gestión</th>
                          <th class="align-middle text-center">Última gestión</th>
                          <th class="align-middle text-center">Fecha próxima gestión</th>
                          <th class="align-middle text-center">Folio Fact</th>
                          <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($orders as $order): ?>
                        <tr>
                            <?php switch ($order['status']) {
                              case 1: $class_color = 'bg-orange';break;
                              case 2: $class_color = 'bg-navy';break;
                              case 3: $class_color = 'bg-success';break;
                              default: $class_color = '';break;
                            }
                            ?>
                            <td><b><?=$order['folio']?></b></td>
                            <td><?=Utils::getShortDate($order['emit_date']);?></td>
                            <td class="text-center align-middle"><?=$order['customer']?></td>
                            <td><?=$order['business_name']?></td>
                            <td class="text-center align-middle"><?=$order['no_services']?></td>
                            <td class="text-right align-middle">$ <?=number_format($order['total'])?></td>
                            <td class="text-center align-middle <?=$class_color?>"><?=$order['estado']?></td>
                            <td><?=!is_null($order['last_follow_up_date']) ? Utils::getShortDate($order['last_follow_up_date']) : ''?></td>
                            <td><?=$order['last_follow_up_comments']?></td>
                            <td><?=!is_null($order['next_follow_up_date']) ? Utils::getShortDate($order['next_follow_up_date']) : ''?></td>
                            <td class="text-center align-middle"><?=$order['folio_fact']?></td>
                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <a href="<?=base_url?>administracion/gestion_orden_de_compra&id=<?=Encryption::encode($order['id'])?>" class="btn btn-info" style="font-size: 0.6rem">
                                      <i class="fas fa-cog"></i>
                                      Gestionar
                                  </a>
                                  <a href="<?=base_url?>administracion/detalle_orden_de_compra&id=<?=Encryption::encode($order['id'])?>" class="btn btn-success" style="font-size: 0.6rem">
                                      <i class="far fa-clipboard"></i>
                                      Detalle
                                  </a>
                                  <a href="<?=base_url?>administracion/listado_orden_de_compra&id=<?=Encryption::encode($order['id'])?>" class="btn btn-orange" style="font-size: 0.6rem">
                                      <i class="fas fa-list-alt"></i>
                                      Listado
                                  </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                          <th class="align-middle">Folio</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Facturable a</th>
                          <th class="align-middle text-center"># servicios</th>
                          <th class="align-middle text-right">Total</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle text-center">Fecha última gestión</th>
                          <th class="align-middle text-center">Última gestión</th>
                          <th class="align-middle text-center">Fecha próxima gestión</th>
                          <th class="align-middle text-center">Folio Fact</th>
                          <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="tab-pane" id="tab_2">
                  <table id="tb_orders2" class="table table-bordered table-responsive table-striped" style="font-size: 0.6rem;">
                    <thead>
                        <tr>
                          <th class="align-middle">Folio</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Facturable a</th>
                          <th class="align-middle text-center"># servicios</th>
                          <th class="align-middle text-right">Total</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle text-center">Fecha última gestión</th>
                          <th class="align-middle text-center">Última gestión</th>
                          <th class="align-middle text-center">Fecha próxima gestión</th>
                          <th class="align-middle text-center">Folio Fact</th>
                          <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($bills as $order): ?>
                        <tr>
                            <?php switch ($order['status']) {
                              case 1: $class_color = 'bg-orange';break;
                              case 2: $class_color = 'bg-navy';break;
                              case 3: $class_color = 'bg-success';break;
                              default: $class_color = '';break;
                            }
                            ?>
                            <td><b><?=$order['folio']?></b></td>
                            <td><?=Utils::getShortDate($order['emit_date']);?></td>
                            <td class="text-center align-middle"><?=$order['customer']?></td>
                            <td><?=$order['business_name']?></td>
                            <td class="text-center align-middle"><?=$order['no_services']?></td>
                            <td class="text-right align-middle">$ <?=number_format($order['total'])?></td>
                            <td class="text-center align-middle <?=$class_color?>"><?=$order['estado']?></td>
                            <td><?=!is_null($order['last_follow_up_date']) ? Utils::getShortDate($order['last_follow_up_date']) : ''?></td>
                            <td><?=$order['last_follow_up_comments']?></td>
                            <td><?=!is_null($order['next_follow_up_date']) ? Utils::getShortDate($order['next_follow_up_date']) : ''?></td>
                            <td class="text-center align-middle"><?=$order['folio_fact']?></td>
                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <a href="<?=base_url?>administracion/gestion_orden_de_compra&id=<?=Encryption::encode($order['id'])?>" class="btn btn-info" style="font-size: 0.6rem">
                                      <i class="fas fa-cog"></i>
                                      Gestionar
                                  </a>
                                  <a href="<?=base_url?>administracion/detalle_orden_de_compra&id=<?=Encryption::encode($order['id'])?>" class="btn btn-success" style="font-size: 0.6rem">
                                      <i class="far fa-clipboard"></i>
                                      Detalle
                                  </a>
                                  <a href="<?=base_url?>administracion/listado_orden_de_compra&id=<?=Encryption::encode($order['id'])?>" class="btn btn-orange" style="font-size: 0.6rem">
                                      <i class="fas fa-list-alt"></i>
                                      Listado
                                  </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                          <th class="align-middle">Folio</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Facturable a</th>
                          <th class="align-middle text-center"># servicios</th>
                          <th class="align-middle text-right">Total</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle text-center">Fecha última gestión</th>
                          <th class="align-middle text-center">Última gestión</th>
                          <th class="align-middle text-center">Fecha próxima gestión</th>
                          <th class="align-middle text-center">Folio Fact</th>
                          <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </tfoot>
                  </table>
                </div> 
              </div>
                
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_orders');
    utils.dtTable(table, false, false);

    let table2 = document.querySelector('#tb_orders2');
    utils.dtTable(table2, false, false);
  });
</script>