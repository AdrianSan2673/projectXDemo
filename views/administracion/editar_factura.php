<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Factura <?=$folio?></h3>
            </div> 
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card">
                        <form id="bill-edit-form" action="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="Folio" id="Folio"  class="form-control" value="<?=$folio?>">
                                    <label for="Folio_Factura" class="col-form-label">Folio factura:</label>
                                    <input type="text" name="Folio_Factura" id="Folio_Factura"  class="form-control" value="<?=$folio?>">
                                </div>
                                <div class="form-group">
                                    <label for="Fecha_Emision" class="col-form-label">Fecha:</label>
                                    <input name="Fecha_Emision" type="date" id="Fecha_Emision" class="form-control" value="<?=isset($factura) && is_object($factura) ? $factura->Fecha_Emision : ''; ?>">
                                    <input name="Hora_Emision" type="hidden" id="Hora_Emision" class="form-control" value="<?=isset($factura) && is_object($factura) ? date('H:i:s', strtotime($factura->Hora_Emision)) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Cliente" class="col-form-label">Cliente:</label>
                                    <input name="Cliente" type="text" id="Cliente" class="form-control" value="<?=isset($factura) && is_object($factura) ? $factura->Cliente : ''; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Razon_Social" class="col-form-label">Razón social:</label>
                                    <select name="Razon_Social" id="Razon_Social" class="form-control">
                                        <?php $razones = Utils::showRazonesSocialesPorCliente($factura->ID_Cliente);?>
                                        <option value="Pendiente">Pendiente</option>
                                        <?php foreach ($razones as $razon): ?>
                                          <option value="<?= $razon['Nombre_Razon'] ?>" <?=isset($factura) && is_object($factura) && $razon['Nombre_Razon'] == $factura->Razon_Social ? 'selected' : ''; ?>><?= $razon['Nombre_Razon']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Estado" class="col-form-label">Estado:</label>
                                    <select name="Estado" id="Estado" class="form-control">
                                      <option value="Pendiente de pago" <?=isset($factura) && is_object($factura) && $factura->Estado == 'Pendiente de pago' ? 'selected' : ''; ?>>Pendiente de pago</option>
                                      <option value="Pagada" <?=isset($factura) && is_object($factura) && $factura->Estado == 'Pagada' ? 'selected' : ''; ?>>Pagada</option>
                                      <option value="Cancelada" <?=isset($factura) && is_object($factura) && $factura->Estado == 'Cancelada' ? 'selected' : ''; ?>>Cancelada</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Promesa_Pago" class="col-form-label">Fecha de promesa de pago:</label>
                                    <input name="Promesa_Pago" type="date" id="Promesa_Pago" class="form-control" value="<?=isset($factura) && is_object($factura) ? $factura->Promesa_Pago : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Monto" class="col-form-label">Monto:</label>
                                    <input type="number" name="Monto" id="Monto" step="0.01" min="0" class="form-control" value="<?=isset($factura) && is_object($factura) ? round($factura->Monto, 2) : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">¿Retener el 6%?</label>
                                    <div class="">
                                        <div class="icheck-success form-check-inline">
                                            <input class="form-check-input" type="radio" name="iva" id="yes" value="1.1" <?=isset($factura) && is_object($factura) && number_format($factura->Monto_IVA) == number_format($factura->Monto * 1.1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="yes">Sí</label>
                                        </div>
                                        <div class="icheck-success form-check-inline">
                                            <input class="form-check-input" type="radio" value="1.16" name="iva" id="no" <?=isset($factura) && is_object($factura) && number_format($factura->Monto_IVA) == number_format($factura->Monto * 1.16) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Fecha_de_Pago" class="col-form-label">Fecha de pago:</label>
                                    <input name="Fecha_de_Pago" type="date" id="Fecha_de_Pago" class="form-control" value="<?=isset($factura) && is_object($factura) ? $factura->Fecha_de_Pago : ''; ?>">
                                </div>  
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                                <input type="submit" name="submit" value="Guardar" id="submit" class="btn btn-success float-right">
                            </div>
                        </form>
                            
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="col-12 col-md-8">
                  <div class="card card-orange">
                      <div class="card-header">
                          <h4 class="card-title">Servicios de esta factura</h4>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="tb_vacancies" class="table table-sm table-responsive table-striped">
                          <thead>
                              <tr>
                                <th class="align-middle">Fecha</th>
                                <th class="align-middle">Candidato</th>
                                <th class="align-middle text-center">Cliente</th>
                                <th class="align-middle">Servicio solicitado</th>
                                <th class="align-middle text-center">Fase</th>
                                <th class="align-middle text-center">Fecha de Entrega</th>
                                <th class="align-middle text-center">Estado</th>
                                <th class="align-middle text-center">Factura</th>
                                <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php foreach($servicios as $servicio): ?>
                                <?php 
                                if ($servicio['Servicio_Solicitado'] == 'ESE') 
                                  $Color_Servicio_Solicitado = 'bg-navy';
                                elseif ($servicio['Servicio_Solicitado'] == 'INV. LABORAL') 
                                  $Color_Servicio_Solicitado = 'bg-danger';
                                elseif ($servicio['Servicio_Solicitado'] == 'RAL')
                                  $Color_Servicio_Solicitado = 'bg-warning';
                                elseif ($servicio['Servicio_Solicitado'] == 'ESE + VISITA')
                                  $Color_Servicio_Solicitado = 'bg-purple';
                                else
                                  $Color_Servicio_Solicitado = '';

                                if ($servicio['Fase'] == 'ESE' || $servicio['Fase'] == 'RAL + INV.LAB + ESE')
                                  $Color_Fase = 'bg-navy';
                                elseif ($servicio['Fase'] == 'INV. LABORAL' || $servicio['Fase'] == 'RAL + INV.LAB')
                                  $Color_Fase = 'bg-danger';
                                elseif ($servicio['Fase'] == 'RAL')
                                  $Color_Fase = 'bg-warning';
                                elseif ($servicio['Fase'] == 'RAL + INV.LAB + ESE + VISITA')
                                  $Color_Fase = 'bg-purple';
                                else
                                  $Color_Fase = '';
                          
                                if ($servicio['Estatus'] == strtoupper('Ral en Proceso'))
                                  $Color_Estatus = 'bg-warning';
                                elseif ($servicio['Estatus'] == strtoupper('Investigación en Proceso'))
                                  $Color_Estatus = 'bg-secondary';
                                elseif ($servicio['Estatus'] == strtoupper('Visita en Proceso'))
                                  $Color_Estatus = 'bg-navy';
                                elseif($servicio['Estatus'] == strtoupper('Finalizado'))
                                  $Color_Estatus = 'bg-primary';
                                elseif($servicio['Estatus'] == strtoupper('Facturado'))
                                  $Color_Estatus = 'table-info';
                                elseif($servicio['Estatus'] == strtoupper('Cancelado'))
                                  $Color_Estatus = 'bg-danger';
                                elseif($servicio['Estatus'] == strtoupper('Validación de Licencia en Proceso'))
                                  $Color_Estatus = 'bg-orange';
                                elseif($servicio['Estatus'] == strtoupper('Visita Presencial en Proceso'))
                                  $Color_Estatus == 'bg-purple';
                                else
                                  $Color_Estatus = '';
                                ?>
                                <tr>
                                  
                                  <td><?=Utils::getFullDate($servicio['Fecha'])?></td>
                                  <td><?=$servicio['Nombre']?></td>
                                  <td class="text-center align-middle"><?=$servicio['Cliente']?></td>
                                  <td class="<?=$Color_Servicio_Solicitado?>"><?=$servicio['Servicio_Solicitado']?></td>
                                  <td class="text-center align-middle <?=$Color_Fase?>"><?=$servicio['Fase']?></td>
                      <td class="text-center align-middle"><?= $servicio['Fase'] == 'RAL' && $servicio['Entrega'] == null ? Utils::getFullDate($servicio['Fecha']) :  Utils::getFullDate($servicio['Entrega']) ?></td>
                                  <td class="text-center align-middle <?=$Color_Estatus?>"><?=$servicio['Estatus']?></td>
                                  <td class="text-center align-middle"><?=$servicio['Factura']?></td>
                                  <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                      <?php if (($servicio['Servicio'] == 291 && $servicio['RAL']) != NULL || (($servicio['Servicio'] == 298 || $servicio['Servicio'] == 291) && $servicio['Folio'] == $servicio['RAL']) || (($servicio['Servicio'] == 299 || $servicio['Servicio'] == 300 || $servicio['Servicio'] == 324) && $servicio['Folio'] == $servicio['RAL'])  || (($servicio['Servicio'] == 300 || $servicio['Servicio'] == 324) && $servicio['Folio'] == $servicio['RAL'])): ?>
                                        <a href="<?=base_url?>formato/ral&candidato=<?=($servicio['Folio'])?>" target="_blank" class="btn btn-maroon btn-sm" style="display: <?=(($servicio['Servicio'] == 298 || $servicio['Servicio'] == 291) && $servicio['Folio'] == $servicio['RAL']) || (($servicio['Servicio'] == 299 || $servicio['Servicio'] == 300 || $servicio['Servicio'] == 324) && $servicio['Folio'] == $servicio['RAL'])  || (($servicio['Servicio'] == 300 || $servicio['Servicio'] == 324) && $servicio['Folio'] == $servicio['RAL']) ? 'block' : 'none'?>;">
                                            <i class="fas fa-gavel"></i> RAL
                                        </a>
                                      <?php else: ?>
                                        <a href="<?=base_url?>formato/resumen_resultado_RAL&busqueda=<?=Encryption::encode($servicio['ID_Busqueda_RAL'])?>" target="_blank" class="btn btn-maroon btn-sm" style="display: <?=($servicio['Servicio'] == 291 && $servicio['RAL'] == NULL) ? 'block' : 'none'?>;">
                                            <i class="fas fa-gavel"></i> RAL
                                        </a>
                                      <?php endif ?>
                                      <a href="<?=base_url?>formato/investigacion_laboral&candidato=<?=($servicio['Folio'])?>" target="_blank" class="btn btn-orange btn-sm" style="display: <?=(($servicio['Servicio'] == 231 || $servicio['Servicio'] == 299) || ($servicio['Servicio'] == 230)) || ($servicio['Servicio'] == 300 || $servicio['Servicio'] == 324) != NULL ? 'block' : 'none'?>;">
                                          <i class="far fa-id-badge"></i> IL
                                      </a>
                                      <a href="<?=base_url?>formato/ese&candidato=<?=($servicio['Folio'])?>" target="_blank" class="btn btn-info btn-sm" style="display: <?=($servicio['Servicio'] == 230 || $servicio['Servicio'] == 300 || $servicio['Servicio'] == 324) != NULL ? 'block' : 'none'?>;">
                                          <i class="fas fa-file-invoice-dollar"></i> VD
                                      </a>
                                      <a href="<?=base_url?>ServicioApoyo/ver&candidato=<?=Encryption::encode($servicio['Folio'])?>" target="_blank" class="btn btn-success btn-sm">
                                          <i class="fas fa-eye"></i> Ver
                                      </a>
                                    </div>
                                  </td>
                                </tr>
                          <?php endforeach; ?>
                              
                          </tbody>
                          <tfoot>
                              <tr>
                                <th class="align-middle">Fecha</th>
                                <th class="align-middle">Candidato</th>
                                <th class="align-middle text-center">Cliente</th>
                                <th class="align-middle">Servicio solicitado</th>
                                <th class="align-middle text-center">Fase</th>
                                <th class="align-middle text-center">Fecha de Entrega</th>
                                <th class="align-middle text-center">Estado</th>
                                <th class="align-middle text-center">Factura</th>
                                <th></th>
                              </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                </div>
                <div class="col-12 col-md-12">
                  <div class="card card-info">
                      <div class="card-header">
                          <h4 class="card-title">Gestiones de esta factura</h4>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="tb_follow_ups" class="table table-responsive table-striped">
                          <thead>
                              <tr>
                                <th class="align-middle">Fecha</th>
                                <th class="align-middle">Usuario</th>
                                <th class="align-middle text-center">Factura</th>
                                <th class="align-middle">Persona contactada</th>
                                <th class="align-middle text-center">Promesa de pago</th>
                                <th class="align-middle text-center">Comentarios</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php foreach($seguimientos as $seguimiento): ?>
                              <tr>
                                  
                                  <td><?=Utils::getFullDate($seguimiento['Fecha'])?></td>
                                  <td><?=$seguimiento['Usuario']?></td>
                                  <td><?=$seguimiento['Folio_Factura']?></td>
                                  <td><?=$seguimiento['Contacto_Con']?></td>
                                  <td class="text-center"><?=is_null($seguimiento['Promesa_Pago']) || empty($seguimiento['Promesa_Pago']) ? '' : Utils::getShortDate($seguimiento['Promesa_Pago'])?></td>
                                  <td><?=$seguimiento['Comentarios']?></td>
                              </tr>
                          <?php endforeach; ?>
                              
                          </tbody>
                          <tfoot>
                              <tr>
                                <th class="align-middle">Fecha</th>
                                <th class="align-middle">Usuario</th>
                                <th class="align-middle text-center">Factura</th>
                                <th class="align-middle">Persona contactada</th>
                                <th class="align-middle text-center">Promesa de pago</th>
                                <th class="align-middle text-center">Comentarios</th>
                              </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                </div>
            </div>
            <br>
                  
        </div>
            
    </section>
</div>
<script src="<?=base_url?>app/administracion.js?v=<?=rand()?>"></script>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_vacancies');
    utils.dtTable(table);
  });
  document.querySelector("#bill-edit-form").onsubmit = function(e) {
    e.preventDefault();
    document.querySelector("#bill-edit-form #submit").disabled = true;
    let administracion = new Administracion();
    administracion.editar_factura();
  };
</script>