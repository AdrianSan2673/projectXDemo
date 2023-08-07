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
                                <input type="hidden" name="Folio" id="Folio"  class="form-control" value="<?=$folio?>">
                                <div class="form-group row">
                                    <label for="Folio_Factura" class="col-md-2 col-form-label">Folio:</label>
                                    <input type="text" name="Folio_Factura" id="Folio_Factura"  class="col-md-10 form-control"  value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->Folio_Factura : ''; ?>">
                                </div>
                                <div class="form-group row">
                                    <label for="Fecha_Emision" class="col-md-2">Fecha:</label>
                                    <input name="Fecha_Emision" type="date" id="Fecha_Emision" class="col-md-10 form-control" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->Fecha_Emision : ''; ?>">
                                    <input name="Hora_Emision" type="hidden" id="Hora_Emision" class="form-control" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? date('H:i:s', strtotime($orden_de_compra->Hora_Emision)) : ''; ?>">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Cliente:</label>
                                    <input name="Cliente" type="text" id="Cliente" class="col-md-10 form-control" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->Cliente : ''; ?>" readonly>
                                </div>
                                <div class="form-group row">
                                    <label for="Razon_Social" class="col-md-2">Razón social:</label>
                                    <select name="Razon_Social" id="Razon_Social" class="select-box col-md-10  form-control">
                                        <?php $razones = Utils::showRazonesSocialesPorCliente($orden_de_compra->ID_Cliente);?>
                                        <option value="Pendiente">Pendiente</option>
                                        <?php foreach ($razones as $razon): ?>
                                          <option value="<?= $razon['Nombre_Razon'] ?>" <?=isset($orden_de_compra) && is_object($orden_de_compra) && $razon['Nombre_Razon'] == $orden_de_compra->Razon ? 'selected' : ''; ?>><?= $razon['Nombre_Razon']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="Estado_OC" class="col-md-2">Estado:</label>
                                    <select name="Estado_OC" id="Estado_OC" class="select-box col-md-10  form-control">
                                        <option value="Pendiente" <?=isset($orden_de_compra) && is_object($orden_de_compra) && $orden_de_compra->Estado_OC == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                        <option value="En Proceso" <?=isset($orden_de_compra) && is_object($orden_de_compra) && $orden_de_compra->Estado_OC == 'En Proceso' ? 'selected' : ''; ?>>En Proceso</option>
                                        <option value="Liberada" <?=isset($orden_de_compra) && is_object($orden_de_compra) && $orden_de_compra->Estado_OC == 'Liberada' ? 'selected' : ''; ?>>Liberada</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="Comentarios" class="col-md-2">Comentarios:</label>
                                    <textarea name="Comentarios" rows="4" cols="20" id="Comentarios" class="col-md-10 form-control"><?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->Comentarios : ''; ?></textarea>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">Fecha próxima gestión:</label>
                                    <input name="Fecha_Prox_Gestion" type="date" id="Fecha_Prox_Gestion" class="col-md-10 form-control" value="<?=isset($orden_de_compra) && is_object($orden_de_compra) ? $orden_de_compra->Fecha_Prox_Gestion : ''; ?>">
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
        </div>
    </section>
</div>
<script src="<?=base_url?>app/administracion.js?v=<?=rand()?>"></script>
<script type="text/javascript">
    document.querySelector("#po-manage-form").onsubmit = function(e) {
      e.preventDefault();
      document.querySelector("#po-manage-form #submit").disabled = true;
      let administracion = new Administracion();
      administracion.gestionar_orden();
    };
</script>