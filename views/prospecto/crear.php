<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <?php if (isset($edit) && isset($prospecto) && is_object($prospecto)): ?>
                <h4>Editar prospecto</h4>
              <?php else: ?>
                <h4>Crear prospecto</h4>
              <?php endif ?>
                
            </div>         
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <form name="prospecto-form" id="prospecto-form">
                <div class="card-body">
                    <input type="hidden" name="id" id="id" class="col-md-10 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->ID : ''; ?>">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Fecha de alta</label>
                        <input type="date" name="Fecha" id="Fecha" class="col-md-10 form-control" disabled value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Fecha : ''; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Empresa:</label>
                        <input type="text" name="Prospecto" id="Prospecto" class="col-md-10 form-control" maxlength="60" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Prospecto : ''; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Giro:</label>
                        <input type="text" name="Giro" id="Giro" class="col-md-10 form-control" maxlength="40" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Giro : ''; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Plaza:</label>
                        <select name="Plaza" id="Plaza" class="col-md-10 form-control">
                          <option value=""></option>
                          <option value="TAM" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'TAM' ? 'selected' : ''; ?>>TAM</option>
                          <option value="SLP" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'SLP' ? 'selected' : ''; ?>>SLP</option>
                          <option value="MTY" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'MTY' ? 'selected' : ''; ?>>MTY</option>
					<option value="CDMX" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'CDMX' ? 'selected' : ''; ?>>CDMX</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tipo de cliente:</label>
                        <select name="Tipo" id="Tipo" class="col-md-10 form-control">
                          <option value=""></option>
                          <option value="Real" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tipo == 'Real' ? 'selected' : ''; ?>>Real</option>
                          <option value="Potencial" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tipo == 'Potencial' ? 'selected' : ''; ?>>Potencial</option>
                          <option value="BI" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tipo == 'BI' ? 'selected' : ''; ?>>BI</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="Contacto_RH" class="col-md-2 col-form-label">Nombre del contacto:</label>
                        <input type="text" name="Contacto_RH" id="Contacto_RH" class="col-md-10 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Contacto_RH : ''; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Puesto:</label>
                        <input type="text" name="Puesto" id="Puesto" class="col-md-10 form-control" maxlength="40" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Puesto : ''; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Teléfono:</label>
                        <input type="text" name="Telefono" id="Telefono" class="col-md-10 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Telefono : ''; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Correo:</label>
                        <input type="email" name="Correo" id="Correo" class="col-md-10 form-control" maxlength="60" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Correo : ''; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Acciones realizadas:</label>
                        <select name="Acciones" id="Acciones" class="col-md-10 form-control">
                          <option value=""></option>
                          <option value="Prospeccion" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Prospeccion' ? 'selected' : ''; ?>>Prospección</option>
                          <option value="Contacto" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Contacto' ? 'selected' : ''; ?>>Primer contacto</option>
                          <option value="Entrevista" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Entrevista' ? 'selected' : ''; ?>>Entrevista de ventas</option>
                          <option value="Cortesia" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Cortesia' ? 'selected' : ''; ?>>Servicio de cortesía</option>
                          <option value="Cliente" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Cliente' ? 'selected' : ''; ?>>Alta como cliente</option>
                          <option value="Propuesta" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Propuesta' ? 'selected' : ''; ?>>Propuesta enviada</option>
                          <option value="Seguimiento" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Seguimiento' ? 'selected' : ''; ?>>Seguimiento</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Comentarios</label>
                        <textarea name="Acciones_Realizadas" id="Acciones_Realizadas" class="col-md-10 form-control" rows="7"><?=isset($prospecto) && is_object($prospecto) ? $prospecto->Acciones_Realizadas : ''; ?></textarea>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Periodicidad del seguimiento</label>
                        <select name="Periodicidad" id="Periodicidad" class="col-md-10 form-control">
                          <option value=""></option>
                          <option value="Diaria" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Periodicidad == 'Diaria' ? 'selected' : ''; ?>>Diaria</option>
                          <option value="3dia" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Periodicidad == '3dia' ? 'selected' : ''; ?>>Cada 3er día</option>
                          <option value="Semanal" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Periodicidad == 'Semanal' ? 'selected' : ''; ?>>Semanal</option>
                          <option value="Mensual" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Periodicidad == 'Mensual' ? 'selected' : ''; ?>>Mensual</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Siguiente contacto:</label>
                        <input type="date" name="Fecha_Prox_Seguimiento" id="Fecha_Prox_Seguimiento" class="col-md-10 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Fecha_Prox_Seguimiento : ''; ?>">
                    </div>
                </div>
                <div class="card-footer">
                  <a href="<?=base_url?>prospecto/index" class="btn btn-secondary btn-lg float-left">Regresar</a>
                  <input type="submit" class="btn btn-lg btn-orange float-right" name="submit" id="submit" value="<?=($_GET['action'] == 'crear' ? 'Crear' : 'Editar')?>">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
</div>
<script src="<?=base_url?>app/prospecto.js?v=<?=rand()?>"></script>
<?php if (isset($_GET['id'])): ?>
<script type="text/javascript">
  document.querySelector('#prospecto-form').addEventListener('submit', e =>{
    e.preventDefault();
    let prospecto = new Prospecto();
    prospecto.update();
  });
</script>
<?php else: ?>
<script type="text/javascript">
  document.querySelector('#prospecto-form').addEventListener('submit', e =>{
    e.preventDefault();
    document.querySelector("#submit").disabled = true;
    let prospecto = new Prospecto();
    prospecto.create();
  });
</script>
<?php endif ?>