<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?=base_url?>">Inicio</a></li>
              <li class="breadcrumb-item active">Cobranza</li>
            </ol>
          </div>  
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Cobranza de Servicios de Apoyo</h3>
            </div> 
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h4 class="card-title"><?=ucfirst(strftime('%B'))?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col">
                                <span class="card-text">Facturado</span>
                                <p class="info-box-number"><?='$'.number_format($total_facturado_mensual, 2)?></p>
                            </div>
                            <div class="col">
                                <span class="card-text">Cobrado</span>
                                <p class="info-box-number"><?='$'.number_format($total_cobrado_mensual, 2)?></p>
                            </div>
                            <div class="col">
                                <p class="info-box-number"><?=$total_cobrado_mensual > 0 ? number_format($total_cobrado_mensual/$total_facturado_mensual * 100, 2) : '0' .'%'?></p>
                            </div>
                            <div class="col">
                                <span class="card-text">Operaciones facturadas</span>
                                <p class="info-box-number"><?=$totalOperacionesFacturadasMes?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-orange">
                    <div class="card-header">
                        <h4 class="card-title"><?=ucfirst(strftime('%B', (date(strtotime('-1 month')))))?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col">
                                <span class="card-text">Facturado</span>
                                <p class="info-box-number"><?='$'.number_format($total_facturado_mes_anterior, 2)?></p>
                            </div>
                            <div class="col">
                                <span class="card-text">Cobrado</span>
                                <p class="info-box-number"><?='$'.number_format($total_cobrado_mes_anterior, 2)?></p>
                            </div>
                            <div class="col">
                                <p class="info-box-number"><?=number_format($total_cobrado_mes_anterior/$total_facturado_mes_anterior * 100, 2).'%'?></p>
                            </div>
                            <div class="col">
                                <span class="card-text">Operaciones facturadas</span>
                                <p class="info-box-number"><?=$total_operaciones_facturadas_mes_anterior?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-maroon">
                    <div class="card-header">
                        <h4 class="card-title"><?=ucfirst(strftime('%B', date(strtotime('-2 month'))))?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col">
                                <span class="card-text">Facturado</span>
                                <p class="info-box-number"><?='$'.number_format($total_facturado_mes_tras_anterior, 2)?></p>
                            </div>
                            <div class="col">
                                <span class="card-text">Cobrado</span>
                                <p class="info-box-number"><?='$'.number_format($total_cobrado_mes_tras_anterior, 2)?></p>
                            </div>
                            <div class="col">
                                <p class="info-box-number"><?=number_format($total_cobrado_mes_tras_anterior/$total_facturado_mes_tras_anterior * 100, 2).'%'?></p>
                            </div>
                            <div class="col">
                                <span class="card-text">Operaciones facturadas</span>
                                <p class="info-box-number"><?=$total_operaciones_facturadas_mes_tras_anterior?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="card-title">Total anual</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col">
                                <span class="card-text">Facturado</span>
                                <p class="info-box-number"><?='$'.number_format($total_facturado_anual, 2)?></p>
                            </div>
                            <div class="col">
                                <span class="card-text">Cobrado</span>
                                <p class="info-box-number"><?='$'.number_format($total_cobrado_anual, 2)?></p>
                            </div>
                            <div class="col">
                                <p class="info-box-number"><?=$total_cobrado_anual > 0 ? number_format($total_cobrado_anual/$total_facturado_anual * 100, 2) : '0'.'%'?></p>
                            </div>
                            <div class="col">
                                <span class="card-text">Operaciones facturadas</span>
                                <p class="info-box-number"><?=$total_operaciones_facturadas_anual ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
      </div>
             
    </section>
    <section class="content-header">
        <div class="container-fluid">
            <div class="mx-auto text-center">
                <a class="btn btn-app bg-teal" href="<?=base_url?>reporte/excelcobranza">
                  <i class="far fa-file-excel"></i> Exportar
                </a>
            </div>
        </div>
		
		  <div class="row">
            <div class="col-md-4">
                <div class="mx-auto text-center">
                    <button class="btn btn-danger" id="facturas_group_cobranza">Afectar cobranza de facturas</button>
                </div>
            </div>
			 <?php if ($_SESSION['identity']->id == 1144 || $_SESSION['identity']->id == 539) : ?>
                <div class="col-md-4">
                    <div class="mx-auto text-center">
                        <button class="btn btn-orange" id="vetar_cliente">Suspender servicios a cliente</button>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-4">
                <div class="mx-auto text-center">
                    <button class="btn btn-warning" id="facturas_group_gestion">Afectar gestion de facturas</button>
                </div>
            </div>
        </div>
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
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_3" data-toggle="tab">Facturas canceladas</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <table id="tb_unpaid_bills" class="table table-responsive table-striped table-sm" style="display: none;">
                    <thead>
                        <tr>
                          <th></th>
                          <th></th>
                          <th class="filterhead"></th>
                          <th></th>
                          <th class="filterhead"></th>
                          <th class="filterhead"></th>
                          <th class="filterhead"></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th class="align-middle">Factura</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle">Días de crédito</th>
                          <th class="align-middle">Días trans</th>
                          <th class="align-middle">Empresa</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Razón social</th>
                          <th class="align-middle text-right">Monto</th>
                          <th class="align-middle text-right">Monto + IVA</th>
                          <th class="align-middle text-center">Fecha de pago</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle">Fecha última gestión</th>
                          <th class="align-middle">Próxima gestión</th>
                          <th class="align-middle text-center">Promesa de pago</th>
                          <th>Última gestión</th>
                          <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($facturas_pendientes as $bill): ?>
                        <tr id="factura<?=$bill['Folio_Factura']?>">
                            <?php 
                            switch ($bill['Estado']) {
                              case 'Pendiente de pago': $class_color = 'bg-orange';break;
                              case 'Pagada': $class_color = 'bg-success';break;
                              default: $class_color = '';break;
                            }
                            if ($bill['Dias_Transcurridos'] > $bill['Plazo_Credito'])
                              $class_color_days = ' bg-danger';
                            else 
                              $class_color_days = '';
                            ?>
                            <td class="text-center align-middle"><b><?=$bill['Folio_Factura']?></b></td>
                            <td class="text-center align-middle"><?=Utils::getShortDate($bill['Fecha_Emision']);?></td>
                            <td class="text-center align-middle"><?=$bill['Plazo_Credito']?></td>
                            <td class="text-center align-middle<?=$class_color_days?>"><?=$bill['Dias_Transcurridos']?></td>
                            <td class="text-center align-middle"><?=$bill['Nombre_Empresa']?></td>
                            <td class="text-center align-middle"><?=$bill['Cliente']?></td>
                            <td class="align-middle"><?=$bill['Razon_Social']?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto'], 2)?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto_IVA'], 2)?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Fecha_de_Pago']) ? Utils::getShortDate($bill['Fecha_de_Pago']) : ''?></td>
                            <td class="text-center align-middle <?=$class_color?>"><?=$bill['Estado']?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Fecha_Ultima_Gestion']) ? Utils::getShortDate($bill['Fecha_Ultima_Gestion']) : ''?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Proxima_Gestion']) ? Utils::getShortDate($bill['Proxima_Gestion']) : ''?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Promesa_Pago']) ? Utils::getShortDate($bill['Promesa_Pago']) : ''?></td>
                            <td><?=$bill['Ultima_Gestion']?></td>
                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <a href="<?=base_url?>administracion_SA/editar_factura&folio=<?=Encryption::encode($bill['Folio_Factura'])?>" class="btn btn-success btn-sm mr-1">
                                      <i class="fas fa-eye"></i>
                                  </a>
                                  <button class="btn btn-info btn-sm mr-1" data-id="<?=$bill['Folio_Factura']?>">
                                      <i class="fas fa-pencil-alt"></i>
                                  </button>
                                  <button class="btn btn-secondary btn-sm mr-1" data-id="<?=$bill['Folio_Factura']?>">
                                      <i class="fas fa-cog"></i>
                                  </button>
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
                          <th class="align-middle">Días trans</th>
                          <th class="align-middle">Empresa</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Razón social</th>
                          <th class="align-middle text-right">Monto</th>
                          <th class="align-middle text-right">Monto + IVA</th>
                          <th class="align-middle text-center">Fecha de pago</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle">Fecha última gestión</th>
                          <th class="align-middle">Próxima gestión</th>
                          <th class="align-middle text-center">Promesa de pago</th>
                          <th>Última gestión</th>
                          <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </tfoot>
                  </table>
                </div>
                
                 <div class="tab-pane" id="tab_2">
                   <table id="tb_paid_bills" class="table table-responsive table-striped table-sm" style="display: none;">
                    <thead>
                        <tr>
                          <th></th>
                          <th></th>
                          <th class="filterhead"></th>
                          <th></th>
                          <th class="filterhead"></th>
                          <th class="filterhead"></th>
                          <th class="filterhead"></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th class="align-middle">Factura</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle">Días de crédito</th>
                          <th class="align-middle">Días trans</th>
                          <th class="align-middle">Empresa</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Razón social</th>
                          <th class="align-middle text-right">Monto</th>
                          <th class="align-middle text-right">Monto + IVA</th>
                          <th class="align-middle text-center">Fecha de pago</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle">Fecha última gestión</th>
                          <th class="align-middle">Próxima gestión</th>
                          <th class="align-middle text-center">Promesa de pago</th>
                          <th>Última gestión</th>
                          <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($facturas_pagadas as $bill): ?>
                        <tr id="factura<?=$bill['Folio_Factura']?>">
                            <?php switch ($bill['Estado']) {
                              case 'Pendiente de pago': $class_color = 'bg-orange';break;
                              case 'Pagada': $class_color = 'bg-success';break;
                              default: $class_color = '';break;
                            }
                            ?>
                            <td class="text-center align-middle"><b><?=$bill['Folio_Factura']?></b></td>
                            <td class="text-center align-middle"><?=Utils::getShortDate($bill['Fecha_Emision']);?></td>
                            <td class="text-center align-middle"><?=$bill['Plazo_Credito']?></td>
                            <td class="text-center align-middle<?=$class_color_days?>"><?=$bill['Dias_Transcurridos']?></td>
                            <td class="text-center align-middle"><?=$bill['Nombre_Empresa']?></td>
                            <td class="text-center align-middle"><?=$bill['Cliente']?></td>
                            <td id="razon<?=$bill['Folio_Factura']?>" class="align-middle"><?=$bill['Razon_Social']?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto'], 2)?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto_IVA'], 2)?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Fecha_de_Pago']) ? Utils::getShortDate($bill['Fecha_de_Pago']) : ''?></td>
                            <td id="estado<?=$bill['Folio_Factura']?>" class="text-center align-middle <?=$class_color?>"><?=$bill['Estado']?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Fecha_Ultima_Gestion']) ? Utils::getShortDate($bill['Fecha_Ultima_Gestion']) : ''?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Proxima_Gestion']) ? Utils::getShortDate($bill['Proxima_Gestion']) : ''?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Promesa_Pago']) ? Utils::getShortDate($bill['Promesa_Pago']) : ''?></td>
                            <td id="gestion<?=$bill['Folio_Factura']?>"><?=$bill['Ultima_Gestion']?></td>
                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <a href="<?=base_url?>administracion_SA/editar_factura&folio=<?=Encryption::encode($bill['Folio_Factura'])?>" class="btn btn-success btn-sm mr-1">
                                      <i class="fas fa-eye"></i>
                                  </a>
                                  <button class="btn btn-info btn-sm mr-1" data-id="<?=$bill['Folio_Factura']?>">
                                      <i class="fas fa-pencil-alt"></i>
                                  </button>
                                  <button class="btn btn-secondary btn-sm mr-1" data-id="<?=$bill['Folio_Factura']?>">
                                      <i class="fas fa-cog"></i>
                                  </button>
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
                          <th class="align-middle">Días trans</th>
                          <th class="align-middle">Empresa</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Razón social</th>
                          <th class="align-middle text-right">Monto</th>
                          <th class="align-middle text-right">Monto + IVA</th>
                          <th class="align-middle text-center">Fecha de pago</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle">Fecha última gestión</th>
                          <th class="align-middle">Próxima gestión</th>
                          <th class="align-middle text-center">Promesa de pago</th>
                          <th>Última gestión</th>
                          <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </tfoot>
                  </table>
                 </div> 

                 <div class="tab-pane" id="tab_3">
                   <table id="tb_paid_bills_canhcel" class="table table-responsive table-striped  table-sm" style="display: none;">
                    <thead>
                        <tr>
                          <th></th>
                          <th></th>
                          <th class="filterhead"></th>
                          <th></th>
                          <th class="filterhead"></th>
                          <th class="filterhead"></th>
                          <th class="filterhead"></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th class="align-middle">Factura</th>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle">Días de crédito</th>
                          <th class="align-middle">Días trans</th>
                          <th class="align-middle">Empresa</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Razón social</th>
                          <th class="align-middle text-right">Monto</th>
                          <th class="align-middle text-right">Monto + IVA</th>
                          <th class="align-middle text-center">Fecha de pago</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle">Fecha última gestión</th>
                          <th class="align-middle">Próxima gestión</th>
                          <th class="align-middle text-center">Promesa de pago</th>
                          <th>Última gestión</th>
                          <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($facturas_canceladas as $bill): ?>
                        <tr id="factura<?=$bill['Folio_Factura']?>">
                            <?php switch ($bill['Estado']) {
                              case 'Pendiente de pago': $class_color = 'bg-orange';break;
                              case 'Pagada': $class_color = 'bg-success';break;
                              default: $class_color = '';break;
                            }
                            ?>
                            <td class="text-center align-middle"><b><?=$bill['Folio_Factura']?></b></td>
                            <td class="text-center align-middle"><?=Utils::getShortDate($bill['Fecha_Emision']);?></td>
                            <td class="text-center align-middle"><?=$bill['Plazo_Credito']?></td>
                            <td class="text-center align-middle<?=$class_color_days?>"><?=$bill['Dias_Transcurridos']?></td>
                            <td class="text-center align-middle"><?=$bill['Nombre_Empresa']?></td>
                            <td class="text-center align-middle"><?=$bill['Cliente']?></td>
                            <td id="razon<?=$bill['Folio_Factura']?>" class="align-middle"><?=$bill['Razon_Social']?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto'], 2)?></td>
                            <td class="text-right align-middle">$ <?=number_format($bill['Monto_IVA'], 2)?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Fecha_de_Pago']) ? Utils::getShortDate($bill['Fecha_de_Pago']) : ''?></td>
                            <td id="estado<?=$bill['Folio_Factura']?>" class="text-center align-middle <?=$class_color?>"><?=$bill['Estado']?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Fecha_Ultima_Gestion']) ? Utils::getShortDate($bill['Fecha_Ultima_Gestion']) : ''?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Proxima_Gestion']) ? Utils::getShortDate($bill['Proxima_Gestion']) : ''?></td>
                            <td class="text-center align-middle"><?=!is_null($bill['Promesa_Pago']) ? Utils::getShortDate($bill['Promesa_Pago']) : ''?></td>
                            <td id="gestion<?=$bill['Folio_Factura']?>"><?=$bill['Ultima_Gestion']?></td>
                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <a href="<?=base_url?>administracion_SA/editar_factura&folio=<?=Encryption::encode($bill['Folio_Factura'])?>" class="btn btn-success btn-sm mr-1">
                                      <i class="fas fa-eye"></i>
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
                          <th class="align-middle">Días trans</th>
                          <th class="align-middle">Empresa</th>
                          <th class="align-middle text-center">Cliente</th>
                          <th class="align-middle">Razón social</th>
                          <th class="align-middle text-right">Monto</th>
                          <th class="align-middle text-right">Monto + IVA</th>
                          <th class="align-middle text-center">Fecha de pago</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle">Fecha última gestión</th>
                          <th class="align-middle">Próxima gestión</th>
                          <th class="align-middle text-center">Promesa de pago</th>
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
<script type="text/javascript" src="<?=base_url?>app/administracion.js?v=<?=rand()?>"></script>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_unpaid_bills');
    table.style.display = "table";
    utils.dtTable(table, false);

    let table2 = document.querySelector('#tb_paid_bills');
    table2.style.display = "table";
    utils.dtTable(table2, false);

    let table3 = document.querySelector('#tb_paid_bills_canhcel');
    table3.style.display = "table";
    utils.dtTable(table3, false);


    table.addEventListener('click', e => {
        if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
            $('#modal_factura').modal('show');
            let folio;
            if (e.target.classList.contains('btn-info'))
                folio = e.target.dataset.id;
            else
                folio = e.target.offsetParent.dataset.id;

            let administracion = new Administracion();
            administracion.getFactura(folio);
        }

        if (e.target.classList.contains('btn-secondary') || e.target.offsetParent.classList.contains('btn-secondary')) {
            $('#modal_factura_gestion').modal('show');
            let folio;
            if (e.target.classList.contains('btn-secondary'))
                folio = e.target.dataset.id;
            else
                folio = e.target.offsetParent.dataset.id;

            let administracion = new Administracion();
            administracion.getFacturaGestion(folio);
        }
    })

    table2.addEventListener('click', e => {
        if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
            $('#modal_factura').modal('show');
            let folio;
            if (e.target.classList.contains('btn-info'))
                folio = e.target.dataset.id;
            else
                folio = e.target.offsetParent.dataset.id;

           let administracion = new Administracion();
            administracion.getFactura(folio);
        }

        if (e.target.classList.contains('btn-secondary') || e.target.offsetParent.classList.contains('btn-secondary')) {
            $('#modal_factura_gestion').modal('show');
            let folio;
            if (e.target.classList.contains('btn-secondary'))
                folio = e.target.dataset.id;
            else
                folio = e.target.offsetParent.dataset.id;

            let administracion = new Administracion();
            administracion.getFacturaGestion(folio);
        }
    })
  
    table3.addEventListener('click', e => {
        if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
            $('#modal_factura').modal('show');
            let folio;
            if (e.target.classList.contains('btn-info'))
                folio = e.target.dataset.id;
            else
                folio = e.target.offsetParent.dataset.id;

           let administracion = new Administracion();
            administracion.getFactura(folio);
        }

        if (e.target.classList.contains('btn-secondary') || e.target.offsetParent.classList.contains('btn-secondary')) {
            $('#modal_factura_gestion').modal('show');
            let folio;
            if (e.target.classList.contains('btn-secondary'))
                folio = e.target.dataset.id;
            else
                folio = e.target.offsetParent.dataset.id;

            let administracion = new Administracion();
            administracion.getFacturaGestion(folio);
        }
    })

    document.querySelector("#modal_factura form").onsubmit = function(e){
      e.preventDefault();
      let administracion = new Administracion();
      administracion.update_factura();
    };

    document.querySelector('#modal_factura_gestion').onsubmit = function (e){
        e.preventDefault();
        let administracion = new Administracion();
        administracion.update_factura_gestion();
    }
	             //============================[Ulises Febrero 17]=========================================
        document.querySelector('#facturas_group_cobranza').addEventListener('click', function() {
            $('#modal_afectar_facturas').modal({
                keyboard: false
            });
            $("#modal_afectar_facturas").draggable({
                handle: ".modal-header"
            });
        })
        //==========================================================================================

        //============================[Ulises Febrero 22]=========================================
        document.querySelector('#facturas_group_gestion').addEventListener('click', function() {
            $('#modal_afectar_factura_gestion').modal({
                keyboard: false
            });
            $("#modal_afectar_factura_gestion").draggable({
                handle: ".modal-header"
            });
        })
        //==========================================================================================
	   //============================[Ulises Marzo 31 Vetar cliente]===============================
        document.querySelector('#vetar_cliente').addEventListener('click', function() {
            $('#modal_vetar_cliente').modal({
                keyboard: false
            });
        })
        //==========================================================================================
  });
</script>