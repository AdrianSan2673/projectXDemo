<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-left mb-2">
                  <li class="breadcrumb-item"><a href="<?=base_url?>">Inicio</a></li>
                  <li class="breadcrumb-item"><a href="<?=base_url?>cliente_SA/index">Clientes</a></li>
                  <li class="breadcrumb-item active">Nuevo cliente</li>
              </ol>
          </div>
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>Crear cliente</h4>
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
            <form role="form" id="cliente-form">
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Nuevo cliente</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
                <div class="card-body">
                    <div class="form-group">
                      <label for="Empresa" class="col-form-label">Nombre de la empresa</label>
                      <select class="form-control" name="Empresa">
                        <?php $empresas = Utils::showEmpresas(); $enterprise = Encryption::decode($_GET['empresa'])?>
                        <?php foreach ($empresas as $empresa): ?>
                          <option value="<?= $empresa['Empresa'] ?>" <?=isset($_GET['empresa']) && $enterprise == $empresa['Empresa'] ? 'selected' : ''; ?>><?= $empresa['Nombre_Empresa'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="Nombre_Cliente" class="col-form-label">Nombre del Cliente</label>
                      <input type="text" name="Nombre_Cliente" id="Nombre_Cliente" class="form-control"  value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Prospecto : ''; ?>">
                    </div>
                </div>
                <!-- /.card-body -->
              </div>
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Condiciones de venta</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
                <div class="card-body">
                  <?php if (Utils::isAdmin() || Utils::isManager()): ?>
                    <div class="form-row">
                      <div class="form-group col">
                        <label for="ESE" class="col-form-label">Costo del Estudio Socioeconómico</label>
                        <input type="number" min="0" name="ESE" id="ESE" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio_ESE) : 0; ?>">
                      </div>
                      <div class="form-group col">
                        <label for="Investigacion_L" class="col-form-label">Costo de la Investigación Laboral</label>
                        <input type="number" min="0" name="Investigacion_L" id="Investigacion_L" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio_Inv) : 0; ?>">
                      </div>
                      <div class="form-group col">
                        <label for="RAL" class="col-form-label">Costo del Reporte de Antecedentes Legales</label>
                        <input type="number" min="0" name="RAL" id="RAL" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio_RAL) : 0; ?>">
                      </div>
                      <div class="form-group col">
                        <label for="Validacion_Licencia" class="col-form-label">Costo de Validación de Licencia</label>
                        <input type="number" name="Validacion_Licencia" class="form-control" id="Validacion_Licencia" min="0" value="0">
                      </div>
                      <div class="form-group col">
                        <label for="ESE_Visita" class="col-form-label">Costo del Estudio Socioeconómico + Visita</label>
                        <input type="number" name="ESE_Visita" class="form-control" id="ESE_Visita" min="0" value="0">
                      </div>
                    </div>
                  <?php endif ?>
                  <div class="form-group">
                    <label for="Paquetes" class="col-form-label">Costos especiales (paquetes)</label>
                    <input type="text" name="Paquetes" id="Paquetes" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="Plazo_Credito" class="col-form-label">Plazo de crédito</label>
                    <input type="text" name="Plazo_Credito" id="Plazo_Credito" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="Dias_Credito" class="col-form-label">Dias de crédito</label>
                    <select class="form-control" name="Dias_Credito">
                      <option value="3">3 días</option>
                      <option value="7">7 días</option>
                      <option value="15">15 días</option>
                      <option value="20">20 días</option>
                      <option value="30">30 días</option>
                      <option value="45">45 días</option>
                      <option value="60">60 días</option>
                    </select>
                  </div>
                    
                    
                </div>
                <!-- /.card-body -->
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Facturación</h3>
                </div>
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col">
                      <label class="col-form-label" for="Corte_Servicio">Cortes de servicio</label>
                      <select class="form-control" name="Corte_Servicio" id="Corte_Servicio">
                        <option value="1">Contraentrega</option>
                        <option value="2">Semanal</option>
                        <option value="3">Quincenal</option>
                        <option value="4">Mensual</option>
                      </select>
                    </div>
                    <div id="cortes_content">
                      <div class="form-group col">
                        <label class="col-form-label">Corte</label>
                        <select class="form-control" name="Corte_Semanal">
                          <option value="" hidden selected>Selecciona el día de la semana</option>
                          <?php $dias = Utils::getDiasSemana() ?>
                          <?php foreach ($dias as $dia): ?>
                            <option value="<?=$dia?>"><?=$dia?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group col">
                        <label class="col-form-label">Corte</label>
                        <div class="row">
                          <select class="form-control col" name="Corte_Q1">
                            <option value="" hidden selected>Selecciona el 1er corte</option>
                            <?php foreach (range(1, 31) as $i): ?>
                              <option value="<?=$i?>"><?=$i?></option>
                            <?php endforeach ?>
                          </select>
                          <select class="form-control col" name="Corte_Q2">
                            <option value="" hidden selected>Selecciona el 2do corte</option>
                            <?php foreach (range(1, 31) as $i): ?>
                              <option value="<?=$i?>"><?=$i?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col">
                        <label class="col-form-label">Corte</label>
                        <select class="form-control" name="Corte_Mensual">
                          <option value="" hidden selected>Selecciona el día del mes</option>
                          <?php foreach (range(1, 31) as $i): ?>
                              <option value="<?=$i?>"><?=$i?></option>
                            <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                      
                  </div>
                  <div class="form-row">
                    <div class="form-group col">
                      <label class="col-form-label" for="OC_NP">OC/NP</label>
                      <input type="text" name="OC_NP" class="form-control" maxlength="50">
                    </div>
                    <div class="form-group col">
                      <label class="col-form-label" for="Recepcion_Facturas">Recepción de facturas</label>
                      <input type="text" name="Recepcion_Facturas" class="form-control" maxlength="50">
                    </div>
                  </div>
                  <div class="form-row portales">
                    <div class="form-group col">
                      <label class="col-form-label" for="Uso_Portal">Uso de portales</label>
                      <select class="form-control" name="Uso_Portal" id="Uso_Portal">
                        <option value="0">Sí</option>
                        <option value="1">No</option>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label class="col-form-label" for="Portal_Direccion">Dirección</label>
                      <input type="text" name="Portal_Direccion" class="form-control" maxlength="50">
                    </div>
                  </div>
                  <div class="form-row portales">
                    <div class="form-group col">
                      <label class="col-form-label" for="Portal_Usuario">Usuario</label>
                      <input type="text" name="Portal_Usuario" class="form-control" maxlength="50">
                    </div>
                    <div class="form-group col">
                      <label class="col-form-label" for="Portal_Contraseña">Contraseña</label>
                      <input type="text" name="Portal_Contraseña" class="form-control" maxlength="50">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="Centro_Costos">Centro de costos</label>
                    <select class="form-control" name="Centro_Costos">
                      <option value="TAM" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'TAM' ? 'selected' : ''; ?>>TAM</option>
                      <option value="SLP" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'SLP' ? 'selected' : ''; ?>>SLP</option>
                      <option value="MTY" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'MTY' ? 'selected' : ''; ?>>MTY</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Cuentas por pagar</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label class="col-form-label" for="Cuentas_Contacto">Contacto
                    </label>
                    <input type="text" name="Cuentas_Contacto" class="form-control" maxlength="50">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="Cuentas_Correo">Correo electrónico</label>
                    <input type="text" name="Cuentas_Correo" class="form-control" maxlength="50">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-sm-8">
                      <label class="col-form-label" for="Cuentas_Telefono">Teléfono</label>
                      <input type="text" name="Cuentas_Telefono" class="form-control" maxlength="50">
                    </div>
                    <div class="form-group col-sm-4">
                      <label class="col-form-label" for="Cuentas_Extension">Extensión</label>
                      <input type="text" name="Cuentas_Extension" class="form-control" maxlength="50">
                    </div>
                  </div>
                    
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Comentarios</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label class="col-form-label" for="Comentario">Comentarios
                    </label>
                    <textarea class="form-control" name="Comentario" maxlength="300" rows="5"></textarea>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="form-group">
                  <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                  <input type="submit" class="btn btn-success float-right" value="Registrar cliente">
                </div>
              </div>
              
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
</div>
<script src="<?=base_url?>app/cliente.js?v=<?=rand()?>"></script>
  <script type="text/javascript">
      document.querySelector('#cliente-form').addEventListener('submit', e => {
          e.preventDefault();
          let cliente = new Cliente();
          cliente.save_cliente();
      });
      window.onload = function(){
        document.querySelectorAll('#cortes_content .form-group')[0].style.display = 'none';
        document.querySelectorAll('#cortes_content .form-group')[1].style.display = 'none';
        document.querySelectorAll('#cortes_content .form-group')[2].style.display = 'none';
      }
      document.querySelector('#Corte_Servicio').addEventListener('change', e => {
        if (document.querySelector('#Corte_Servicio').value == 1) {
          document.querySelectorAll('#cortes_content .form-group')[0].style.display = 'none';
          document.querySelectorAll('#cortes_content .form-group')[1].style.display = 'none';
          document.querySelectorAll('#cortes_content .form-group')[2].style.display = 'none';
        }else if (document.querySelector('#Corte_Servicio').value == 2){
          document.querySelectorAll('#cortes_content .form-group')[0].style.display = 'block';
          document.querySelectorAll('#cortes_content .form-group')[1].style.display = 'none';
          document.querySelectorAll('#cortes_content .form-group')[2].style.display = 'none';
        }else if (document.querySelector('#Corte_Servicio').value == 3) {
          document.querySelectorAll('#cortes_content .form-group')[0].style.display = 'none';
          document.querySelectorAll('#cortes_content .form-group')[1].style.display = 'block';
          document.querySelectorAll('#cortes_content .form-group')[2].style.display = 'none';
        }else if (document.querySelector('#Corte_Servicio').value == 4){
          document.querySelectorAll('#cortes_content .form-group')[0].style.display = 'none';
          document.querySelectorAll('#cortes_content .form-group')[1].style.display = 'none';
          document.querySelectorAll('#cortes_content .form-group')[2].style.display = 'block';
        }else{
          document.querySelectorAll('#cortes_content .form-group')[0].style.display = 'none';
          document.querySelectorAll('#cortes_content .form-group')[1].style.display = 'none';
          document.querySelectorAll('#cortes_content .form-group')[2].style.display = 'none';
        }
      })

      document.querySelector('#Uso_Portal').addEventListener('change', e => {
        if (document.querySelector('#Uso_Portal').value == 0) {
          document.querySelectorAll('.portales')[0].querySelectorAll(' .form-group')[1].style.display = 'block';
          document.querySelectorAll('.portales')[1].style.display = 'flex';
        }
        if (document.querySelector('#Uso_Portal').value == 1){
          document.querySelectorAll('.portales')[0].querySelectorAll(' .form-group')[1].style.display = 'none';
          document.querySelectorAll('.portales')[1].style.display = 'none';
        }
      })
  </script> 
