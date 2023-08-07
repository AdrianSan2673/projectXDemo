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
                <div class="col-12">
                    <div class="card">
                        <form id="bill-manage-form" action="post">
                            <div class="card-body">
                                <input type="hidden" name="id" id="id" value="<?=isset($factura) && is_object($factura) ? $factura->id : ''; ?>">
                                <div class="form-group row">
                                    <label for="folio" class="col-md-2 col-form-label">Folio factura:</label>
                                    <input type="text" name="folio" id="folio"  class="col-md-10 form-control" value="<?=$folio?>" readonly>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Fecha:</label>
                                    <input name="emit_date" type="date" id="emit_date" class="col-md-10 form-control" value="<?=isset($factura) && is_object($factura) ? $factura->emit_date : ''; ?>" readonly>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Cliente:</label>
                                    <input name="customer" type="text" id="customer" class="col-md-10 form-control" value="<?=isset($factura) && is_object($factura) ? $factura->customer : ''; ?>" readonly>
                                </div>
                                <div class="form-group row">
                                    <label for="id_business_name" class="col-md-2">Razón social:</label>
                                    <select name="id_business_name" id="id_business_name" class="select-box col-md-10  form-control" readonly disabled>
                                        <?= $BNs = Utils::showBNByCustomer($factura->id_customer);?>
                                        <?php foreach ($BNs as $bn): ?>
                                          <option value="<?= $bn['id'] ?>" <?=isset($factura) && is_object($factura) && $bn['id'] == $factura->id_business_name ? 'selected' : ''; ?>><?= $bn['business_name']?></option>
                                        <?php endforeach ?>
                                        <option value>Pendiente</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-2">Estado:</label>
                                    <select name="status" id="status" class="select-box col-md-10  form-control">
                                        <option value="1" <?=isset($factura) && is_object($factura) && $factura->status == 1 ? 'selected' : ''; ?>>Pendiente de pago</option>
                                        <option value="2" <?=isset($factura) && is_object($factura) && $factura->status == 2 ? 'selected' : ''; ?>>Pagada</option>
                                        <option value="3" <?=isset($factura) && is_object($factura) && $factura->status == 3 ? 'selected' : ''; ?>>Cancelada</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-2 col-form-label">Se contactó con:</label>
                                    <input type="text" name="who_contacted" id="who_contacted"  class="col-md-10 form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Fecha de promesa de pago:</label>
                                    <input name="payment_promise_date" type="date" id="payment_promise_date" class="col-md-10 form-control" value="<?=isset($factura) && is_object($factura) ? $factura->payment_promise_date : ''; ?>">
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-2">Comentarios:</label>
                                    <textarea name="comments" rows="4" cols="20" id="comments" class="col-md-10 form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                                    <input type="submit" name="submit" value="Guardar" id="submit" class="btn btn-success float-right">
                                </div>
                            </div>
                        </form>
                            
                    </div>
                </div>
            </div>
            <br>
            <div class="card card-warning">
                <div class="card-header">
                    <h4 class="card-title">Gestiones de esta factura</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tb_managements" class="table table-bordered table-striped" style="font-size: 0.6rem;">
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
<script type="text/javascript">
    $(document).ready(function(){
        let table = document.querySelector('#tb_managements');
        utils.dtTable(table);
      });
    document.querySelector("#bill-manage-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#bill-manage-form #submit").disabled = true;
      let management = new Management();
      management.bill_manage();
    };
</script>