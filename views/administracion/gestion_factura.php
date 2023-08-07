<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Gestión de factura <?=$folio?></h3>
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
                                    <input type="text" name="Folio_Factura" id="Folio_Factura"  class="form-control" value="<?=$folio?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Fecha_Emision" class="col-form-label">Fecha:</label>
                                    <input name="Fecha_Emision" type="date" id="Fecha_Emision" class="form-control" value="<?=isset($factura) && is_object($factura) ? $factura->Fecha_Emision : ''; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Cliente" class="col-form-label">Cliente:</label>
                                    <input name="Cliente" type="text" id="Cliente" class="form-control" value="<?=isset($factura) && is_object($factura) ? $factura->Cliente : ''; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Razon_Social" class="col-form-label">Razón social:</label>
                                    <select name="Razon_Social" id="Razon_Social" class="form-control" readonly>
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
                                    <label for="Contacto_Con" class="col-form-label">Persona con la que se contactó:</label>
                                    <input type="text" name="Contacto_Con" id="Contacto_Con" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Comentarios" class="col-form-label">Comentarios:</label>
                                    <textarea name="Comentarios" id="Comentarios" class="form-control" rows="10"></textarea>
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
            </div>
            <br>
                  
        </div>
            
    </section>
</div>
<script src="<?=base_url?>app/administracion.js?v=<?=rand()?>"></script>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_follow_ups');
    utils.dtTable(table);
  });
  document.querySelector("#bill-edit-form").onsubmit = function(e) {
    e.preventDefault();
    document.querySelector("#bill-edit-form #submit").disabled = true;
    let administracion = new Administracion();
    administracion.gestionar_factura();
  };
</script>