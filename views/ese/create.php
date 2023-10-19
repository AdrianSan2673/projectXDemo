<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <h4>Nuevo Servicio de Apoyo</h4>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- form start -->
            <form id="candidate-form" name="candidate-form" method="POST">
              <!-- general form elements -->
              <div class="card">
                <div class="card-body">
                  <input type="hidden" name="Folio" value="0">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Nombres" class="col-form-label">Nombre(s)</label>
                        <input type="text" name="Nombres" id="Nombres" class="form-control" onkeypress="return soloLetras(event)" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Apellido_Paterno" class="col-form-label">Apellido Paterno</label>
                        <input type="text" name="Apellido_Paterno" id="Apellido_Paterno" class="form-control" onkeypress="return soloLetras(event)" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="Apellido_Materno" class="col-form-label">Apellido Materno</label>
                        <input type="text" name="Apellido_Materno" id="Apellido_Materno" class="form-control" onkeypress="return soloLetras(event)" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_state" class="col-form-label">Estado del candidato</label>
                        <select class="form-control" name="Estado" required>
                          <?= $pais = ['', 'México', 'Guatemala'] ?>
                          <?php for ($i = 1; $i < count($pais); $i++) : ?>

                            <optgroup label="<?= $pais[$i] ?>">
                              <?php $estados = Utils::showEstadosPorPais($i) ?>
                              <?php foreach ($estados as $e) : ?>
                                <option value="<?= $e['Estado'] ?>"><?= $e['Descripcion'] ?></option>
                              <?php endforeach ?>
                            </optgroup>

                          <?php endfor; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-form-label" for="Ciudad">Delegación o municipio</label>
                        <input type="text" name="Ciudad" class="form-control" maxlength="50" required>
                      </div>
                    </div>
                  </div>
                  <div class="data">
                    <div class="form-group">
                      <label class="col-form-label">Cuenta con</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="icheck-success form-check-inline">
                            <input class="form-check-input" type="radio" name="Cuenta_con" id="Cuenta_con_1" value="1" required checked>
                            <label class="form-check-label" for="Cuenta_con_1">CURP Y Número de Seguridad Social</label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="icheck-success form-check-inline">
                            <input class="form-check-input" type="radio" name="Cuenta_con" id="Cuenta_con_2" value="2" required>
                            <label class="form-check-label" for="Cuenta_con_2">Fecha y lugar de nacimiento</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="CURP" class="col-form-label">CURP</label>
                          <input type="text" name="CURP" id="CURP" class="form-control" maxlength="18">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="NSS" class="col-form-label">Número de Seguridad Social</label>
                          <input type="text" name="NSS" class="form-control" maxlength="11">
                        </div>
                      </div>
                    </div>
                    <div class="row" style="display: none;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="Fecha_Nacimiento" class="col-form-label">Fecha de nacimiento</label>
                          <input type="date" name="Fecha_Nacimiento" id="Fecha_Nacimiento" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="Lugar_Nacimiento" class="col-form-label">Lugar de Nacimiento</label>
                          <input type="text" name="Lugar_Nacimiento" class="form-control" maxlength="30">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="Telefono" class="col-form-label">Teléfono</label>
                          <input type="text" name="Telefono" id="Telefono" maxlength="13" class="form-control" required data-inputmask='"mask": "999 999 9999"' data-mask>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="Puesto" class="col-form-label">Puesto</label>
                          <?php $Id_Empresa = Utils::showContactoPorUsuario()->Empresa ?>

                          <?php if ($Id_Empresa != 525) : ?>
                            <input type="text" name="Puesto" id="Puesto" class="form-control" maxlength="40" required>
                          <?php else : ?>
                            <select name="Puesto"  class="form-control">
                              <option value="Agente de seguros">Agente de seguros</option>
                              <option value="Promotor de seguros">Promotor de seguros</option>
                            </select>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-form-label" for="Cliente">Nombre comercial</label>
                        <select class="form-control " name="Cliente" id="Cliente" required>
                          <?php $Id_Empresa = Utils::showContactoPorUsuario()->Empresa ?>
                          <?php $clientes = !Utils::isCustomerSA() ? Utils::showClientes() : Utils::showClientesPorUsuario() ?>
                          <option value="" hidden selected>Selecciona el nombre comercial</option>
                          <?php foreach ($clientes as $cliente) : ?>
                            <option value="<?= $cliente['Cliente'] ?>" <?= $Id_Empresa == 525 ? 'selected' : '' ?> ><?= $cliente['Nombre_Cliente'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-form-label" for="Servicio_Solicitado">Servicio solicitado</label>
                        <select name="Servicio_Solicitado" class="form-control" id="Servicio_Solicitado">
                          <?php if (Utils::isCustomerSA()) : ?>
                            <?php $Id_Empresa = Utils::showContactoPorUsuario()->Empresa ?>
                            <?php //if ($Id_Empresa == 45): 
                            ?>
                            <!--  <option value="298">Registro de Antecedentes Legales (RAL)</option> -->
                            <?php //endif 
                            ?>
                            <?php if($Id_Empresa==525): //if ($Id_Empresa !=316 && $Id_Empresa !=587 && $Id_Empresa !=586 && $Id_Empresa !=82 && $Id_Empresa !=584 && $Id_Empresa !=209 && $Id_Empresa !=308 && $Id_Empresa !=387 && $Id_Empresa !=582 && $Id_Empresa !=581 && $Id_Empresa !=580 && $Id_Empresa !=95 && $Id_Empresa !=561 && $Id_Empresa !=529 && $Id_Empresa !=536 && $Id_Empresa !=573 && $Id_Empresa !=571 && $Id_Empresa !=367 && $Id_Empresa !=570 && $Id_Empresa !=99 && $Id_Empresa !=568 && $Id_Empresa !=565 && $Id_Empresa !=567 && $Id_Empresa !=566 && $Id_Empresa !=466 && $Id_Empresa !=562 && $Id_Empresa !=505 &&$Id_Empresa !=523 && $Id_Empresa !=545 && $Id_Empresa !=543 && $Id_Empresa !=507 && $Id_Empresa !=548 && $Id_Empresa != 550 && $Id_Empresa != 549 && $Id_Empresa != 544 && $Id_Empresa != 534 && $Id_Empresa != 105 && $Id_Empresa != 536 && $Id_Empresa != 533 && $Id_Empresa != 496 && $Id_Empresa != 349 && $Id_Empresa != 528 && $Id_Empresa != 409 && $Id_Empresa != 527 && $Id_Empresa != 519 && $Id_Empresa != 517 && $Id_Empresa != 513 && $Id_Empresa != 497 && $Id_Empresa != 512 && $Id_Empresa != 511 && $Id_Empresa != 510 && $Id_Empresa != 508 && $Id_Empresa != 460 && $Id_Empresa != 487 && $Id_Empresa != 483 && $Id_Empresa != 501 && $Id_Empresa != 498 && $Id_Empresa != 500 && $Id_Empresa != 201 && $Id_Empresa != 490 && $Id_Empresa != 465 && $Id_Empresa != 461 && $Id_Empresa != 490 && $Id_Empresa != 453 && $Id_Empresa != 485 && $Id_Empresa != 468 && $Id_Empresa != 472 && $Id_Empresa != 480 && $Id_Empresa != 470 && $Id_Empresa != 422 && $Id_Empresa != 231 && $Id_Empresa != 417 && $Id_Empresa != 86 && $Id_Empresa != 175 && $Id_Empresa != 361 && $Id_Empresa != 397 && $Id_Empresa != 435 && $Id_Empresa != 404 && $Id_Empresa != 435 && $Id_Empresa != 566 && $Id_Empresa != 411 && $Id_Empresa != 454 && $Id_Empresa != 457 && $Id_Empresa != 462 && $Id_Empresa != 452 && $Id_Empresa != 305 && $Id_Empresa != 434 && $Id_Empresa != 298 && $Id_Empresa != 278 && $Id_Empresa != 245 && $Id_Empresa != 199 && $Id_Empresa != 120 && $Id_Empresa != 445 && $Id_Empresa != 444 && $Id_Empresa != 439 && $Id_Empresa != 438 && $Id_Empresa != 253 && $Id_Empresa != 181 && $Id_Empresa != 141 && $Id_Empresa != 94 && $Id_Empresa != 426 && $Id_Empresa != 151 && $Id_Empresa != 214 && $Id_Empresa != 232 && $Id_Empresa != 220 && $Id_Empresa != 248 && $Id_Empresa != 143 && $Id_Empresa != 302 && $Id_Empresa != 284 && $Id_Empresa != 162 && $Id_Empresa != 139 && $Id_Empresa != 112 && $Id_Empresa != 58 && $Id_Empresa != 410 && $Id_Empresa != 127 && $Id_Empresa != 126 && $Id_Empresa != 107 && $Id_Empresa != 93 && $Id_Empresa != 77 && $Id_Empresa != 335 && $Id_Empresa != 213 && $Id_Empresa != 142 && $Id_Empresa != 110 && $Id_Empresa != 7 && $Id_Empresa != 432 && $Id_Empresa != 430 && $Id_Empresa != 418 && $Id_Empresa != 322 && $Id_Empresa != 227 && $Id_Empresa != 161 && $Id_Empresa != 6 && $Id_Empresa != 296 && $Id_Empresa != 235 && $Id_Empresa != 154 && $Id_Empresa != 85 && $Id_Empresa != 24 && $Id_Empresa != 328 && $Id_Empresa != 247 && $Id_Empresa != 242 && $Id_Empresa != 163 && $Id_Empresa != 114 && $Id_Empresa != 100 && $Id_Empresa != 359 && $Id_Empresa != 320 && $Id_Empresa != 212 && $Id_Empresa != 108 && $Id_Empresa != 32 && $Id_Empresa != 325 && $Id_Empresa != 263 && $Id_Empresa != 223 && $Id_Empresa != 200 && $Id_Empresa != 157 && $Id_Empresa != 140 && $Id_Empresa != 25 && $Id_Empresa != 79 && $Id_Empresa != 183 && $Id_Empresa != 81 && $Id_Empresa != 341 && $Id_Empresa != 415 && $Id_Empresa != 416 && $Id_Empresa != 353 && $Id_Empresa != 252 && $Id_Empresa != 407 && $Id_Empresa != 399 && $Id_Empresa != 372 && $Id_Empresa != 405 && $Id_Empresa != 336 && $Id_Empresa != 184 && $Id_Empresa != 27 && $Id_Empresa != 25 && $Id_Empresa != 197 && $Id_Empresa != 109 && $Id_Empresa != 413 && $Id_Empresa != 76 && $Id_Empresa != 56 && $Id_Empresa != 222 && $Id_Empresa != 17 && $Id_Empresa != 31 && $Id_Empresa != 30 && $Id_Empresa != 130 && $Id_Empresa != 153 && $Id_Empresa != 8 && $Id_Empresa != 391 && $Id_Empresa != 412 && $Id_Empresa != 279 && $Id_Empresa != 224 && $Id_Empresa != 307 && $Id_Empresa != 389  && $Id_Empresa != 103 && $Id_Empresa != 158 && $Id_Empresa != 167 && $Id_Empresa != 87 && $Id_Empresa != 388 && $Id_Empresa != 385 && $Id_Empresa != 292 && $Id_Empresa != 260 && $Id_Empresa != 365 && $Id_Empresa != 274 && $Id_Empresa != 195 && $Id_Empresa != 369 && $Id_Empresa != 339 && $Id_Empresa != 382 && $Id_Empresa != 356 && $Id_Empresa != 381 && $Id_Empresa != 61 && $Id_Empresa != 45 && $Id_Empresa != 180 && $Id_Empresa != 35 && $Id_Empresa != 33 && $Id_Empresa != 304 && $Id_Empresa != 15 && $Id_Empresa != 179 && $Id_Empresa != 111 && $Id_Empresa != 102 && $Id_Empresa != 22 && $Id_Empresa != 319 && $Id_Empresa != 46 && $Id_Empresa != 193 && $Id_Empresa != 168 && $Id_Empresa != 36 && $Id_Empresa != 225 && $Id_Empresa != 196 && $Id_Empresa != 329 && $Id_Empresa != 215 && $Id_Empresa != 190 && $Id_Empresa != 144 && $Id_Empresa != 257 && $Id_Empresa != 14 && $Id_Empresa != 268 && $Id_Empresa != 39 && $Id_Empresa != 301 && $Id_Empresa != 9 && $Id_Empresa != 295 && $Id_Empresa != 314 && $Id_Empresa != 40 && $Id_Empresa != 273 && $Id_Empresa != 315 && $Id_Empresa != 52 && $Id_Empresa != 350 && $Id_Empresa != 147 && $Id_Empresa != 277 && $Id_Empresa != 267 && $Id_Empresa != 115 && $Id_Empresa != 131 && $Id_Empresa != 92 && $Id_Empresa != 351 && $Id_Empresa != 159 && $Id_Empresa != 368 && $Id_Empresa != 375 && $Id_Empresa != 165 && $Id_Empresa != 18) : ?>
                              <option value="231">LABORAL (RAL + IL)</option>
                              <option value="230" <?= $Id_Empresa == 525 ? 'hidden' : '' ?>>Estudio Socioeconómico (RAL + IL + VD)</option>
                            <?php else : ?>
                              <option value="291">Registro de Antecedentes Legales (RAL)</option>
                            <?php endif ?>
                          <?php else : ?>
                            <option value="231">LABORAL (RAL + IL)</option>
                            <option value="230">Estudio Socioeconómico (RAL + IL + VD)</option>
                            <option value="340" <?= !Utils::isCustomerSA() && !Utils::isCustomer() ? '' : 'hidden' ?>>Estudio Socioeconómico SOI(RAL + IL + VD)</option>
                            <option value="341" <?= !Utils::isCustomerSA() && !Utils::isCustomer() ? '' : 'hidden' ?>>Estudio Socioeconómico SMART(RAL + IL + VD)</option>

                          <?php endif ?>
                          <?php if ($Id_Empresa == 16 || Utils::isAdmin() || Utils::isSAManager() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount()) : ?>
                            <option value="323">Estudio Socioeconómico + Visita Presencial (RAL + IL + VD + Visita)</option>
                          <?php endif ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-row" style="display: <?= Utils::isCustomerSA() ? 'none' : 'flex' ?>;">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label" for="Ejecutivo">Ejecutivo</label>
                        <?php if (!Utils::isAccount()) : ?>
                          <?php $usuarios = Utils::showUsuariosPorPerfil(13); ?>
                          <select name="Ejecutivo" id="Ejecutivo" class="form-control">
							<?= $Id_Empresa == 525 ? '<option value="ANALIPAREDES" selected>Dulce Anali Paredes Rodríguez</option>' : '' ?>
                            <?php foreach ($usuarios as $usuario) : ?>
                              <option value="<?= $usuario['Usuario'] ?>"><?= $usuario['Nombre'] ?></option>
                            <?php endforeach ?>
                          </select>
                        <?php else : ?>
                          <select name="Ejecutivo" id="Ejecutivo" class="form-control">
                            <option value="<?= $_SESSION['identity']->username ?>"><?= $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name ?></option>
                          </select>
                        <?php endif ?>

                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label" for="Razon">Razón social</label>
                        <select class="form-control" name="Razon"></select>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-sm-6"  >
                      <div class="form-group">

                          <?php $Id_Empresa = Utils::showContactoPorUsuario()->Empresa ?>
                          <input type="hidden" name="Empresa" value="<?= $Id_Empresa ?>">
                          <?php if ($Id_Empresa == 167 || $Id_Empresa == 198) : ?>
                            <?php $Centro_Costos = Utils::showCentrosCostoPorEmpresa($Id_Empresa) ?>
                            <label class="col-form-label" for="CC_Cliente"><?= $Id_Empresa == 167 ? 'Centro de Costo' : 'CAR' ?></label>
                            <select class="form-control" name="CC_Cliente">
                              <?php foreach ($Centro_Costos as $Centro) : ?>
                                <option value="<?= $Centro['Centro_Costos'] ?>"><?= $Centro['Centro_Costos'] ?></option>
                              <?php endforeach ?>
                            </select>
                          <?php else : ?>
                            <label class="col-form-label" for="CC_Cliente"><?= $Id_Empresa == 525 ? 'Folio prudential' : 'Centro de Costo' ?></label>
                            <input type="text" name="CC_Cliente" class="form-control" maxlength="30" <?= $Id_Empresa == 45 ? 'required' : '' ?>>
                          <?php endif ?>
                    
                      </div>
                    </div>
                    <div class="col-sm-6" style="display: <?= !Utils::isCustomerSA() ? 'block' : 'none' ?>;">
                      <div class="form-group">
                        <label class="col-form-label" for="Nombre_Cliente">Contacto</label>
                        <select class="form-control" name="Nombre_Cliente"></select>
                      </div>
                    </div>
                  </div>
                  <div class="form-row" style="display: <?= Utils::isCustomerSA() ? (Utils::showContactoPorUsuario()->Empresa == 13 ? 'flex' : 'none') : 'none' ?>;">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label" for="Plaza_Cliente">Plaza</label>
                        <input type="text" name="Plaza_Cliente" class="form-control" maxlength="30">
                      </div>
                    </div>
                  </div>
                  <div class="data">
                    <div class="form-row">
                      <div class="col-sm-6" <?= Utils::userClientePrudential($Id_Empresa) == true ? 'hidden' : ''; ?>>
                        <div class="form-group">
                          <label class="col-form-label" for="Nivel">Nivel organizacional del candidato</label>
                          <select name="Nivel" id="Nivel" class="form-control" required>
                            <option value="" hidden selected>Selecciona el nivel organizacional</option>
                            <option value="1" <?= Utils::userClientePrudential($Id_Empresa) == true ? 'selected' : ''; ?>>Operativo</option>
                            <option value="2">Administrativo</option>
                            <option value="3">Gerencial</option>
                            <?php if (Utils::showContactoPorUsuario()->Empresa == 167) : ?>
                              <option value="4">Preventista</option>
                            <?php endif ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="resume" class="col-form-label">¿Adjuntar currículum personal?</label>
                          <input type="file" id="resume" name="resume" class="form-control" accept="application/pdf">
                        </div>
                      </div>
                    </div>
                    <div class="form-row" style="display: none;">
                      <div class="form-group col">
                        <label for="Tipo_Licencia" class="col-form-label">Tipo de Licencia</label>
                        <select class="form-control" name="Tipo_Licencia" id="Tipo_Licencia">
                          <option value="1">Federal</option>
                          <option value="2">Estatal</option>
                        </select>
                      </div>
                      <div class="form-group col">
                        <label for="Numero_Licencia" class="col-form-label">Número de Licencia</label>
                        <input type="text" name="Numero_Licencia" id="Numero_Licencia" class="form-control">
                      </div>
                      <div class="form-group col">
                        <label for="Numero_Examen" class="col-form-label">Número de Expediente Médico</label>
                        <input type="text" name="Numero_Examen" class="form-control">
                      </div>
                    </div>

                    <div id="div_curp_duplicado" style="display: none;">
                      <p>Detectamos a través del CURP que quiere solicitar un servicio de un candidato que está en nuestras bases de datos</p>
                      <div>
                        <input type="radio" name="duplicar" id="duplicar" value="0">
                        <label for="duplicar">Empezar de cero</label>
                        <input type="radio" name="duplicar" id="duplicar1">
                        <label for="duplicar">Actualizar información</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="Comentarios_Cliente">Comentarios</label>
                      <textarea name="Comentarios_Cliente" class="form-control" rows="10" maxlength="600"></textarea>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button class="btn btn-lg btn-orange float-right"><?= !Utils::isCustomerSA() ? 'Registrar candidato' : ($Id_Empresa != 167 && $Id_Empresa != 180 && $Id_Empresa != 82 ? 'Registrar candidato' : 'Consultar RAL') ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
</div>
<script type="text/javascript" src="<?= base_url ?>app/cliente.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/cc_cliente.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/servicioapoyo.js?v=<?= rand() ?>"></script>
<script type="text/javascript">
  var radios = document.getElementsByName('Cuenta_con');
  for (let i = 0; i < radios.length; i++) {
    radios[i].addEventListener('change', e => {
      if (radios[i].value == 1) {
        document.querySelectorAll('#candidate-form .row')[3].style.display = 'flex';
        document.querySelectorAll('#candidate-form .row')[4].style.display = 'none';
      }
      if (radios[i].value == 2) {
        document.querySelectorAll('#candidate-form .row')[3].style.display = 'none';
        document.querySelectorAll('#candidate-form .row')[4].style.display = 'flex';
      }
    })
  }


  document.querySelector('#candidate-form').addEventListener('submit', e => {
    e.preventDefault();
    let servicio = new ServicioApoyo();
    servicio.save_servicio();
  });


  document.querySelector('#CURP').addEventListener('blur', e => {
    e.preventDefault();
    let servicio = new ServicioApoyo();
    servicio.checkCURP(e.target.value);
  })
</script>



<?php if (Utils::isCustomerSA()) : ?>

  <?php if ($Id_Empresa == 525) : ?>
    <script type="text/javascript">
      const selectElement = document.querySelector('[ name="Razon"]')
      const newOption = document.createElement('option');
      newOption.value = 'opcion3';
      newOption.textContent = 'Opción 3';
      selectElement.appendChild(newOption);
      newOption.selected = true;
    </script>

  <?php endif; ?>


  <script type="text/javascript">
    var id_cliente = document.querySelector('#Cliente');
    id_cliente.addEventListener('change', e => {

      let cliente = new Cliente();
      cliente.getEjecutivosYRazonesPorCliente(id_cliente.value);

      let Servicio_Solicitado = document.querySelector('#Servicio_Solicitado');
      let Servicio_Solicitado_Valor = Servicio_Solicitado.value;
      if (id_cliente.value == 74 || id_cliente.value == 475 || id_cliente.value == 506 || id_cliente.value == 453 || id_cliente.value == 181 || id_cliente.value == 314 || id_cliente.value == 517 || id_cliente.value == 544 || id_cliente.value == 543 || id_cliente.value == 42 || id_cliente.value == 513 || id_cliente.value == 193 || id_cliente.value == 475 || id_cliente.value == 245 || id_cliente.value == 531 || id_cliente.value == 502 || id_cliente.value == 179)
        Servicio_Solicitado.innerHTML = `<option value="291">Registro de Antecedentes Legales (RAL)</option>`;
      else if (id_cliente.value == 662) {
        Servicio_Solicitado.innerHTML = `
          <option value="230">Estudio Socioeconómico (RAL + IL + VD)</option>
          `;
        document.querySelector('#Nivel').removeAttribute('required');
        document.querySelectorAll('#candidate-form .form-row')[2].style.display = 'none';
        document.querySelectorAll('#candidate-form .form-row .col-sm-6')[0].style.display = 'none';
        document.querySelectorAll('#candidate-form .form-row ')[3].style.display = 'none';
        document.querySelector('#Telefono').setAttribute('required', '');
        document.querySelector('#Nivel').value = '1'
      }else if (id_cliente.value == 705||id_cliente.value == 760||id_cliente.value == 757||id_cliente.value == 756||id_cliente.value == 762||id_cliente.value == 761||id_cliente.value == 759||id_cliente.value == 754||id_cliente.value == 753||id_cliente.value == 714||id_cliente.value == 755||id_cliente.value == 758||id_cliente.value == 752) {
        cc_clientes(id_cliente.value);
      } else if (id_cliente.value == 426) {
        setTimeout(function() {
          document.querySelectorAll('[name="Razon"] option')[0].remove()
        }, 200);
      } else {
        const contenedor = document.querySelectorAll('.form-group')[16];
        const selectElement = document.querySelector('[name="CC_Cliente"]');
        const nuevoInput = document.createElement('input');
        nuevoInput.type = 'text';
        nuevoInput.className = 'form-control';
        nuevoInput.required = false;
        nuevoInput.setAttribute('name', 'CC_Cliente');
        contenedor.replaceChild(nuevoInput, selectElement);
      }
      /*else if (id_cliente.value == 68)
      	Servicio_Solicitado.innerHTML = `
      	<option value="298">Registro de Antecedentes Legales (RAL)</option>
      	<option value="231">LABORAL (RAL + IL)</option>
      	<option value="230">Estudio Socioeconómico (RAL + IL + VD)</option>
      	`;*/
      document.querySelector('#Servicio_Solicitado').value = Servicio_Solicitado_Valor;
      ocultarCamposRAL();
    })
  </script>

<?php else : ?>
  <script type="text/javascript">
    var id_cliente = document.querySelector('#Cliente');
    id_cliente.addEventListener('change', e => {

      let cliente = new Cliente();
      console.log(id_cliente);
      cliente.getContactosYRazonesPorCliente(id_cliente.value);
      if (id_cliente.value == 18) {
        document.querySelectorAll('#candidate-form .form-row')[2].style.display = 'block';
      } else if (id_cliente.value == 662) {
        document.querySelectorAll('#candidate-form .form-row')[2].style.display = 'block';
        document.querySelector('#Nivel').removeAttribute('required');

      } else {
        document.querySelectorAll('#candidate-form .form-row')[2].style.display = 'none';
      }
    })
  </script>
<?php endif ?>




<script type="text/javascript">
  var Servicio_Solicitado = document.querySelector('#Servicio_Solicitado');

  function ocultarCamposRAL() {
    if (Servicio_Solicitado.value == 310)
      document.querySelectorAll('#candidate-form .form-row')[4].style.display = 'flex';
    else
      document.querySelectorAll('#candidate-form .form-row')[4].style.display = 'none';

    if (Servicio_Solicitado.value == 291) {
      document.querySelectorAll('.data')[0].style.display = 'none';
      document.querySelectorAll('.data')[1].style.display = 'none';
      document.querySelectorAll('#candidate-form .form-row')[0].querySelectorAll('.form-group')[0].style.display = 'none';
      document.querySelector('#Telefono').removeAttribute('required');
      document.querySelector('#Puesto').removeAttribute('required');
      document.querySelector('#Nivel').removeAttribute('required');
    } else {
      document.querySelectorAll('.data')[0].style.display = 'block';
      document.querySelectorAll('.data')[1].style.display = 'block';
      document.querySelectorAll('#candidate-form .form-row')[0].querySelectorAll('.form-group')[0].style.display = 'block';
      document.querySelector('#Telefono').setAttribute('required', '');
      //document.querySelector('#Puesto').setAttribute('required', '');
      //document.querySelector('#Nivel').setAttribute('required', '');
    }

  }
  document.addEventListener('DOMContentLoaded', e => {
    ocultarCamposRAL();
    Servicio_Solicitado.addEventListener('change', e => {
      ocultarCamposRAL();
    })
    var Tipo_Licencia = document.querySelector('#Tipo_Licencia');
    Tipo_Licencia.addEventListener('change', e => {
      if (Tipo_Licencia.value == 2)
        Tipo_Licencia.parentElement.parentElement.children[2].style.display = 'none';
      else
        Tipo_Licencia.parentElement.parentElement.children[2].style.display = 'block';
    })
  })


  function soloLetras(event) {
    var regex = new RegExp("^[a-zA-Z ÁÉÍÓÚáéíóú ÄËÏÖÜäëïöüÑñ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  }

  var timer = new Array();

  function checkFields(el) {
    var inputBox = document.getElementById(el);
    inputBox.value = inputBox.value.replace(/[^a-zA-Z  ÁÉÍÓÚáéíóú ÄËÏÖÜäëïöüÑñ]/g, '');
    clearTimeout(timer[el]);
    timer[el] = setTimeout((function() {
      checkFields(el);
    }), 50);
  };

  function timerFields(el) {
    timer[el] = setTimeout((function() {
      checkFields(el);
    }), 50);
  };

  timerFields('Nombres');
  timerFields('Apellido_Paterno');
  timerFields('Apellido_Materno');
</script>