<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Gestión de órden de compra <?=$folio?></h3>
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
                        <form id="po-manage-form" action="post">
                            <div class="card-body">
                                <div class="form-group row">
                                    <input type="hidden" name="id" id="id" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->id : ''; ?>">
                                    <input type="hidden" name="id_customer" id="id_customer" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->id_customer : ''; ?>">
                                    <label for="" class="col-md-2 col-form-label">Folio:</label>
                                    <input type="text" name="folio" id="folio"  class="col-md-10 form-control"  value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->folio : ''; ?>">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Fecha:</label>
                                    <input name="emit_date" type="date" id="emit_date" class="col-md-10 form-control" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->emit_date : ''; ?>">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Cliente:</label>
                                    <input name="customer" type="text" id="customer" class="col-md-10 form-control" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->customer : ''; ?>" readonly>
                                </div>
                                <div class="form-group row">
                                    <label for="id_business_name" class="col-md-2">Razón social:</label>
                                    <select name="id_business_name" id="id_business_name" class="select-box col-md-10  form-control">
                                        <?= $BNs = Utils::showBNByCustomer($orden_de_compra->id_customer);?>
                                        <?php foreach ($BNs as $bn): ?>
                                          <option value="<?= $bn['id'] ?>" <?=isset($orden_de_compra) && is_object($orden_de_compra) && $bn['id'] == $orden_de_compra->id_business_name ? 'selected' : ''; ?>><?= $bn['business_name']?></option>
                                        <?php endforeach ?>
                                        <option value>Pendiente</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-md-2">Estado:</label>
                                    <select name="status" id="status" class="select-box col-md-10  form-control">
                                        <option value="1" <?=isset($orden_de_compra) && is_object($orden_de_compra) && $orden_de_compra->status == 1 ? 'selected' : ''; ?>>Pendiente</option>
                                        <option value="2" <?=isset($orden_de_compra) && is_object($orden_de_compra) && $orden_de_compra->status == 2 ? 'selected' : ''; ?>>En Proceso</option>
                                        <option value="3" <?=isset($orden_de_compra) && is_object($orden_de_compra) && $orden_de_compra->status == 3 ? 'selected' : ''; ?>>Liberada</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-2">Comentarios:</label>
                                    <textarea name="comments" rows="4" cols="20" id="comments" class="col-md-10 form-control"></textarea>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Fecha próxima gestión:</label>
                                    <input name="next_follow_up_date" type="date" id="next_follow_up_date" class="col-md-10 form-control" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->next_follow_up_date : ''; ?>">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Folio de factura:</label>
                                    <input name="bill_folio" type="text" id="bill_folio" class="col-md-10 form-control" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->bill_folio : ''; ?>">
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
                    <h4 class="card-title">Gestiones de esta órden de compra</h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tb_managements" class="table table-bordered table-striped" style="font-size: 0.6rem;">
                    <thead>
                        <tr>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle text-center">Próxima gestión</th>
                          <th class="align-middle">Comentarios</th>
                          <th class="align-middle">Gestionado por</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($follow_ups as $follow_up): ?>
                        <tr>
                            <td><?=Utils::getShortDate($follow_up['contact_date'])?></td>
                            <td class="text-center align-middle"><?=!is_null($follow_up['next_follow_up_date']) ? Utils::getShortDate($follow_up['next_follow_up_date']) : ''?></td>
                            <td><?=$follow_up['comments']?></td>
                            <td class="align-middle"><?=$follow_up['first_name'].' '.$follow_up['last_name']?></td>
                        </tr>
                    <?php endforeach; ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                          <th class="align-middle">Fecha</th>
                          <th class="align-middle text-center">Próxima gestión</th>
                          <th class="align-middle">Comentarios</th>
                          <th class="align-middle">Gestionado por</th>
                        </tr>
                    </tfoot>
                  </table>
                </div>
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
    document.querySelector("#po-manage-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#po-manage-form #submit").disabled = true;
      let management = new Management();
      management.po_manage();
    };
</script>