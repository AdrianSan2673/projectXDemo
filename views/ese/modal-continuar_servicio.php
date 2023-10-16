<div class="modal fade" id="modal_continuar_servicio">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="candidate-form">
                <div class="modal-header">
                    <h4 class="modal-title">Continuar servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="Folio" name="Folio">
                    <input type="hidden" name="Nombres">
                    <input type="hidden" name="Apellido_Paterno">
                    <input type="hidden" name="Apellido_Materno">
                    <input type="hidden" name="Estado">
                    <input type="hidden" name="Ciudad">
                    <input type="hidden" name="Servicio_Solicitado">
                    <input type="hidden" name="Razon">
                    <input type="hidden" name="CC_Cliente">
                    <input type="hidden" name="Cliente">
                    <input type="hidden" name="Plaza_Cliente">
                    <input type="hidden" name="Tipo_Licencia">
                    <input type="hidden" name="Numero_Licencia">
                    <input type="hidden" name="Numero_Examen">
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
                            <input class="form-check-input" type="radio" name="Cuenta_con" id="Cuenta_con_2" value="2" >
                            <label class="form-check-label" for="Cuenta_con_2">Fecha y lugar de nacimiento</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                          <label for="CURP" class="col-form-label">CURP</label>
                          <input type="text" name="CURP" id="CURP" class="form-control" maxlength="18" required>
                        </div>
                        <div class="form-group col-12">
                          <label for="NSS" class="col-form-label">Número de Seguridad Social</label>
                          <input type="text" name="NSS" class="form-control" maxlength="11" required>
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="form-group col-12">
                            <label for="Fecha_Nacimiento" class="col-form-label">Fecha de nacimiento</label>
                            <input type="date" name="Fecha_Nacimiento" id="Fecha_Nacimiento" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="Lugar_Nacimiento" class="col-form-label">Lugar de Nacimiento</label>
                            <input type="text" name="Lugar_Nacimiento" class="form-control" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Telefono" class="col-form-label">Teléfono</label>
                        <input type="text" name="Telefono" id="Telefono" maxlength="13" class="form-control" required data-inputmask='"mask": "999 999 9999"' data-mask>
                    </div>
                    <div class="form-group">
                        <label for="Puesto" class="col-form-label">Puesto</label>
                        <input type="text" name="Puesto" id="Puesto" class="form-control" maxlength="40" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Ejecutivo">Ejecutivo</label>
                        <select name="Ejecutivo" id="Ejecutivo" class="form-control">
                            <option value=""></option>
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Nivel">Nivel organizacional del candidato</label>
                        <select name="Nivel" id="Nivel" class="form-control" required>
                            <option value="" hidden selected>Selecciona el nivel organizacional</option>
                            <option value="1">Operativo</option>
                            <option value="2">Administrativo</option>
                            <option value="3">Gerencial</option>
                        </select>
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
                        <textarea name="Comentarios_Cliente" class="form-control" rows="5" maxlength="600"></textarea>
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
    var radios = document.getElementsByName('Cuenta_con');
    for (let i = 0; i < radios.length; i ++) {
        radios[i].addEventListener('change', e => {
          if (radios[i].value == 1) {
            document.querySelectorAll('#modal_continuar_servicio .row')[1].style.display = 'flex';
            document.querySelectorAll('#modal_continuar_servicio .row')[2].style.display = 'none'; 
          }
          if (radios[i].value == 2) {
            document.querySelectorAll('#modal_continuar_servicio .row')[1].style.display = 'none';
            document.querySelectorAll('#modal_continuar_servicio .row')[2].style.display = 'flex';
          }
        })
      }
    document.addEventListener('DOMContentLoaded', e => {
        document.querySelectorAll('.botones_continuar button')[0].addEventListener('click', e => {
            $('#modal_continuar_servicio').modal({backdrop: 'static', keyboard: false});
        })
        document.querySelectorAll('.botones_continuar button')[1].addEventListener('click', e => {
            $('#modal_continuar_servicio').modal({backdrop: 'static', keyboard: false});
        })
		
		
		    document.querySelector('#modal_continuar_servicio form #Cuenta_con_1').addEventListener('click', e => {
      document.querySelector('#modal_continuar_servicio form [name="CURP"]').required = true
      document.querySelector('#modal_continuar_servicio form [name="NSS"]').required = true

      document.querySelector('#modal_continuar_servicio form [name="Fecha_Nacimiento"]').required = false
      document.querySelector('#modal_continuar_servicio form [name="Lugar_Nacimiento"]').required = false
    })


    document.querySelector('#modal_continuar_servicio form #Cuenta_con_2').addEventListener('click', e => {
      document.querySelector('#modal_continuar_servicio form [name="CURP"]').required = false
      document.querySelector('#modal_continuar_servicio form [name="NSS"]').required = false

      document.querySelector('#modal_continuar_servicio form [name="Fecha_Nacimiento"]').required = true
      document.querySelector('#modal_continuar_servicio form [name="Lugar_Nacimiento"]').required = true

    })
		
		
    })
	document.querySelector('#CURP').addEventListener('blur', e => {
      e.preventDefault();
      let servicio = new ServicioApoyo();
      servicio.checkCURP(e.target.value);
    })
</script>