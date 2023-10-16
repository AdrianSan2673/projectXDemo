<div class="modal fade" id="modal_facturacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Facturación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Cliente">
                    <input type="hidden" name="flag" value="1">
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
                            <option value="TAM">TAM</option>
                            <option value="SLP">SLP</option>
                            <option value="MTY">MTY</option>
						    <option value="CDMX">CDMX</option>

                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>
<script type="text/javascript">
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