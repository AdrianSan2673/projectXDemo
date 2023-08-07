<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Cobranza SA</h3>
            </div>
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- <section class="content-header">
      <div class="container-fluid">
        <form method="POST" action="<?=base_url."administracion/cobranza_SA"?>" class="row">
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
      </div>  
    </section> -->
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab_1" data-toggle="tab">Facturas pendientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_2" data-toggle="tab">Facturas pagadas</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <table id="tb_unpaid_bills" class="table table-responsive table-striped" style="font-size: 0.6rem;">
                    <thead>
                        <tr>
                          <th class="align-middle">Factura</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle">Días de crédito</th>
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
                    <?php foreach($facturas_pendientes as $bill): ?>
                        <tr>
                            <?php switch ($bill['Estado']) {
                              case 'Pendiente de pago': $class_color = 'bg-warning';break;
                              case 'Pagada': $class_color = 'bg-success';break;
                              default: $class_color = '';break;
                            }
                            ?>
                            <td><b><?=$bill['Folio_Factura']?></b></td>
                            <td><?=Utils::getShortDate($bill['Fecha_Emision']);?></td>
                            <td class="text-center align-middle"><?=$bill['Plazo_Credito']?></td>
                            <td class="text-center align-middle"><?=$bill['Cliente']?></td>
                            <td><?=$bill['Razon_Social']?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto'])?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto_IVA'])?></td>
                            <td><?=!is_null($bill['Fecha_de_Pago']) ? Utils::getShortDate($bill['Fecha_de_Pago']) : ''?></td>
                            <td class="text-center align-middle <?=$class_color?>"><?=$bill['Estado']?></td>
                            <td><?=!is_null($bill['Promesa_Pago']) ? Utils::getShortDate($bill['Promesa_Pago']) : ''?></td>
                            <td><?=!is_null($bill['Fecha_Ultima_Gestion']) ? Utils::getShortDate($bill['Fecha_Ultima_Gestion']) : ''?></td>
                            <td><?=$bill['Ultima_Gestion']?></td>
                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <a href="<?=base_url?>administracion/editar_factura&id=<?=Encryption::encode($bill['id'])?>" class="btn btn-info" style="font-size: 0.6rem">
                                      <i class="fas fa-pencil-alt"></i>
                                      Editar
                                  </a>
                                  <a href="<?=base_url?>administracion/gestion_factura&id=<?=Encryption::encode($bill['id'])?>" class="btn btn-secondary" style="font-size: 0.6rem">
                                      <i class="fas fa-cog"></i>
                                      Gestionar
                                  </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                          <th class="align-middle">Factura</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle">Días de crédito</th>
                          <th class="align-middle">Días transcurridos</th>
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
                    </tfoot>
                  </table>
                </div>
                 <div class="tab-pane" id="tab_2">
                   <table id="tb_paid_bills" class="table table-bordered table-responsive table-striped" style="font-size: 0.6rem;">
                    <thead>
                        <tr>
                          <th class="align-middle">Factura</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle">Días de crédito</th>
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
                    <?php foreach($facturas_pagadas as $bill): ?>
                        <tr>
                            <?php switch ($bill['Estado']) {
                              case 'Pendiente de pago': $class_color = 'bg-warning';break;
                              case 'Pagada': $class_color = 'bg-success';break;
                              default: $class_color = '';break;
                            }
                            ?>
                            <td><b><?=$bill['Folio_Factura']?></b></td>
                            <td><?=Utils::getShortDate($bill['Fecha_Emision']);?></td>
                            <td class="text-center align-middle"><?=$bill['Plazo_Credito']?></td>
                            <td class="text-center align-middle"><?=$bill['Cliente']?></td>
                            <td><?=$bill['Razon_Social']?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto'])?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto_IVA'])?></td>
                            <td><?=!is_null($bill['Fecha_de_Pago']) ? Utils::getShortDate($bill['Fecha_de_Pago']) : ''?></td>
                            <td class="text-center align-middle <?=$class_color?>"><?=$bill['Estado']?></td>
                            <td><?=!is_null($bill['Promesa_Pago']) ? Utils::getShortDate($bill['Promesa_Pago']) : ''?></td>
                            <td><?=!is_null($bill['Fecha_Ultima_Gestion']) ? Utils::getShortDate($bill['Fecha_Ultima_Gestion']) : ''?></td>
                            <td><?=$bill['Ultima_Gestion']?></td>
                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <a href="<?=base_url?>administracion/editar_factura&id=<?=Encryption::encode($bill['id'])?>" class="btn btn-info" style="font-size: 0.6rem">
                                      <i class="fas fa-pencil-alt"></i>
                                      Editar
                                  </a>
                                  <a href="<?=base_url?>administracion/gestion_factura&id=<?=Encryption::encode($bill['id'])?>" class="btn btn-secondary" style="font-size: 0.6rem">
                                      <i class="fas fa-cog"></i>
                                      Gestionar
                                  </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                          <th class="align-middle">Factura</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle">Días de crédito</th>
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
    let table = document.querySelector('#tb_unpaid_bills');
    utils.dtTable(table, false, false);

    let table2 = document.querySelector('#tb_paid_bills');
    utils.dtTable(table2, false, false);
  });
</script>