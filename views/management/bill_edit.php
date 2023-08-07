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
                <div class="col-4">
                    <div class="card">
                        <form id="bill-edit-form" action="post">
                            <div class="card-body">
                                <div class="form-group row">
                                    <input type="hidden" name="id" id="id" value="<?=isset($factura) && is_object($factura) ? $factura->id : ''; ?>">
                                    <label for="folio" class="col-md-2 col-form-label">Folio factura:</label>
                                    <input type="text" name="folio" id="folio"  class="col-md-10 form-control" value="<?=$folio?>">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Fecha:</label>
                                    <input name="emit_date" type="date" id="emit_date" class="col-md-10 form-control" value="<?=isset($factura) && is_object($factura) ? $factura->emit_date : ''; ?>">
                                </div>
                                <div class="form-group row">
                                    <label for="customer" class="col-md-2">Cliente:</label>
                                    <input name="customer" type="text" id="customer" class="col-md-10 form-control" value="<?=isset($factura) && is_object($factura) ? $factura->customer : ''; ?>" readonly>
                                </div>
                                <div class="form-group row">
                                    <label for="id_business_name" class="col-md-2">Razón social:</label>
                                    <select name="id_business_name" id="id_business_name" class="select-box col-md-10  form-control">
                                        <?= $BNs = Utils::showBNByCustomer($factura->id_customer);?>
                                        <?php foreach ($BNs as $bn): ?>
                                          <option value="<?= $bn['id'] ?>" <?=isset($factura) && is_object($factura) && $bn['id'] == $factura->id_business_name ? 'selected' : ''; ?>><?= $bn['business_name']?></option>
                                        <?php endforeach ?>
                                        <option value>Pendiente</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-md-2">Estado:</label>
                                    <select name="status" id="status" class="select-box col-md-10  form-control">
                                      <option value="1" <?=isset($factura) && is_object($factura) && $factura->status == 1 ? 'selected' : ''; ?>>Pendiente de pago</option>
                                      <option value="2" <?=isset($factura) && is_object($factura) && $factura->status == 2 ? 'selected' : ''; ?>>Pagada</option>
                                      <option value="3" <?=isset($factura) && is_object($factura) && $factura->status == 3 ? 'selected' : ''; ?>>Cancelada</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="payment_promise_date" class="col-md-2 col-form-label">Fecha de promesa de pago:</label>
                                    <input name="payment_promise_date" type="date" id="payment_promise_date" class="col-md-10 form-control" value="<?=isset($factura) && is_object($factura) ? $factura->payment_promise_date : ''; ?>">
                                </div>
                                <div class="form-group row">
                                    <label for="amount" class="col-md-2">Monto:</label>
                                    <input type="number" name="amount" id="amount"  class="col-md-10 form-control" value="<?=isset($factura) && is_object($factura) ? round($factura->total, 2) : ''; ?>" readonly>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">¿Retener el 6%?</label>
                                    <div class="col-md-10">
                                        <div class="icheck-success form-check-inline">
                                            <input class="form-check-input" type="radio" name="iva" id="yes" value="1.1" <?=isset($factura) && is_object($factura) && $factura->iva == 1.1 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="yes">Sí</label>
                                        </div>
                                        <div class="icheck-success form-check-inline">
                                            <input class="form-check-input" type="radio" value="1.16" name="iva" id="no" <?=isset($factura) && is_object($factura) && $factura->iva == 1.16 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="payment_date" class="col-md-2 col-form-label">Fecha de pago:</label>
                                    <input name="payment_date" type="date" id="payment_date" class="col-md-10 form-control" value="<?=isset($factura) && is_object($factura) ? $factura->payment_date : ''; ?>">
                                </div>  
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                                <input type="submit" name="submit" value="Guardar" id="submit" class="btn btn-success float-right">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-8">
                <?php if ($applicants): ?>
            <div class="card card-orange">
                <div class="card-header">
                    <h4 class="card-title">Vacantes de esta factura</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  
                  <table id="tb_vacancies" class="table table-striped">
                    <thead>
                        <tr>
                          <th class="align-middle">Cliente</th>
                          <th class="align-middle">Razón social</th>
                          <th class="align-middle text-center">Vacante</th>
                          <th class="align-middle">Candidato</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle text-center">Ejecutivo</th>
                          <th class="align-middle text-center">Solicita</th>
                          <th class="align-middle text-center">CC RHI</th>
                          <th class="align-middle text-right">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($applicants as $applicant): ?>
                        <tr>
                            <?php switch ($applicant['id_status']) {
                              case 1: $class_color = 'bg-info';break;
                              case 2: $class_color = 'bg-success';break;
                              case 3: $class_color = 'bg-orange';break;
                              case 4: $class_color = 'bg-navy';break;
                              case 5: $class_color = 'bg-danger';break;
                              default: $class_color = '';break;
                            }
                            ?>
                            <td><b><?=$applicant['customer']?></b></td>
                            <td><?=$applicant['business_name']?></td>
                            <td class="text-center align-middle"><?=$applicant['vacancy']?></td>
                            <td><?=$applicant['candidate']?></td>
                            <td class="text-center align-middle <?=$class_color?>"><?=$applicant['status']?></td>
                            <td class="text-center align-middle"><?=$applicant['recruiter']?></td>
                            <td class="text-center align-middle"><?=$applicant['customer_contact']?></td>
                            <td class="text-center align-middle"><?=$applicant['cost_center']?></td>
                            <td class="text-right align-middle">$ <?=number_format($applicant['amount'])?></td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                          <th class="align-middle">Cliente</th>
                          <th class="align-middle">Razón social</th>
                          <th class="align-middle text-center">Vacante</th>
                          <th class="align-middle">Candidato</th>
                          <th class="align-middle text-center">Estado</th>
                          <th class="align-middle text-center">Ejecutivo</th>
                          <th class="align-middle text-center">Solicita</th>
                          <th class="align-middle text-center">CC RHI</th>
                          <th class="align-middle text-right">Monto</th>
                        </tr>
                    </tfoot>
                  </table>
                  <hr>    
                  
                </div>
                <!-- /.card-body -->
            </div>
            <?php endif ?>
                </div>
            </div>
            <br>

          
            
            <?php if ($psychometrics): ?>
            <div class="card card-info">
                <div class="card-header">
                    <h4 class="card-title">Psicometrías de esta factura</h4>
                </div>
                <div class="card-body">
                    <table id="tb_psychometrics" class="table table-striped">
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
            </div>    
            <?php endif ?>
            
            <?php if ($attractions): ?>
            <div class="card card-navy">
                <div class="card-header">
                    <h4 class="card-title">Atracciones de Talento de esta factura</h4>
                </div>
                <div class="card-body">
                    <table id="tb_attractions" class="table table-striped">
                        <thead>
                          <tr>
                            <th class="align-middle">Puesto</th>
                            <th class="align-middle">Cliente</th>
                            <th class="align-middle">Fecha Solicitud</th>
                            <th class="align-middle">Fecha finalización</th>
                            <th class="align-middle">Ciudad</th>
                            <th class="align-middle">Sueldo</th>
                            <th class="align-middle">Estatus</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($attractions as $at): ?>
                            <tr>
                                <td class="align-middle"><?=$at['job_title']?></td>
                                <td class="text-left align-middle"><?=$at['customer']?></td>
                                <td class="align-middle"><?=($at['request_date'])?></td>
                                <td class="align-middle"><?=($at['end_date'])?></td>
                                <td class="align-middle"><?=$at['city'].', '.$at['abbreviation']?></td>
                                <td class="align-middle">$ <?=number_format($at['salary'], 2)?></td>
                                <td class="align-middle"><?=$at['estatus']?></td>
                            </tr>
                        <?php endforeach; ?>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                              <th class="align-middle">Puesto</th>
                              <th class="align-middle">Cliente</th>
                              <th class="align-middle">Fecha Solicitud</th>
                              <th class="align-middle">Fecha finalización</th>
                              <th class="align-middle">Ciudad</th>
                              <th class="align-middle">Sueldo</th>
                              <th class="align-middle">Estatus</th>
                            </tr>
                        </tfoot>
                      </table>
                </div>
            </div>    
            <?php endif ?>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
          
            <div class="card card-info">
                <div class="card-header">
                    <h4 class="card-title">Gestiones de esta factura</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tb_managements" class="table table-striped">
                    <thead>
                        <tr>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle">Se contactó con</th>
                          <th class="align-middle text-center">Promesa de pago</th>
                          <th class="align-middle">Comentarios</th>
                          <th class="align-middle">Gestionado por</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($follow_ups as $follow_up): ?>
                        <tr>
                            <td><b><?=Utils::getShortDate($follow_up['contact_date'])?></b></td>
                            <td><?=$follow_up['who_contacted']?></td>
                            <td class="text-center align-middle"><?=!is_null($follow_up['payment_promise_date']) ? Utils::getShortDate($follow_up['payment_promise_date']) : ''?></td>
                            <td><?=$follow_up['comments']?></td>
                            <td class="text-center align-middle"><?=$follow_up['first_name'].' '.$follow_up['last_name']?></td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle">Se contactó con</th>
                          <th class="align-middle text-center">Promesa de pago</th>
                          <th class="align-middle">Comentarios</th>
                          <th class="align-middle">Gestionado por</th>
                        </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>
<script src="<?=base_url?>app/management.js?v=<?=rand()?>"></script>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_vacancies');
    utils.dtTable(table);

    let table1 = document.querySelector('#tb_psychometrics');
    utils.dtTable(table1);

    let table2 = document.querySelector('#tb_attractions');
    utils.dtTable(table2); 

    let table3 = document.querySelector('#tb_managements');
        utils.dtTable(table3);
  });
  document.querySelector("#bill-edit-form").onsubmit = function(e) {
    e.preventDefault();
    document.querySelector("#bill-edit-form #submit").disabled = true;
    let management = new Management();
    management.bill_update();
  };
</script>