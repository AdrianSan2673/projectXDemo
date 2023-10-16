<div class="modal fade" id="modal_schedule">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="update-schedule-form">
                <div class="modal-header">
                    <h4 class="modal-title">Agenda</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio_Candidato" id="Folio_Candidato">
                    <input type="hidden" name="flag" value="0">
                    <div class="form-group">
                        <label class="col-form-label" for="Candidato">Candidato</label>
                        <input type="text" class="form-control" name="Candidato" id="Candidato" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Nombre_Cliente">Cliente</label>
                        <input type="text" class="form-control" name="Nombre_Cliente" id="Nombre_Cliente" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Logistica">Ejecutivo Logística</label>
                        <?php $usuarios = Utils::showUsuariosPorPerfil(14); ?>
                        <select name="Logistica" id="Logistica" class="form-control">
                          <option disabled selected="selected">No asignado</option>
                          <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?=$usuario['Usuario']?>"><?=$usuario['Nombre']?></option>
                          <?php endforeach ?>
							<option value="PAMELAPULIDO">Pamela Ivonne Pulido Díaz</option>
							<option value="GRISELDABAUTISTA">Griselda Bautista Del Ángel</option>
						   <option value="EVA.GONZALEZ">Eva Daniela González Pérez</option>
						</select>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label" for="Solicitud">Fecha de aplicación</label>
                        <div class="row">
                          <div class="col-6">
                            <div class="input-group">
                              <input type="date" name="Fecha_Aplicacion" id="Fecha_Aplicacion" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="input-group">
                              <select id="Hora_Aplicacion" name="Hora_Aplicacion" class="form-control custom-select">
                                <option value="" hidden selected>Hora</option>
                                <?php foreach (range(0, 23) as $i): ?>
                                  <option value="<?=$i?>"><?=str_pad($i, 2, "0", STR_PAD_LEFT)?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="input-group">
                              <select id="Minuto_Aplicacion" name="Minuto_Aplicacion" class="form-control custom-select">
                                <option value="" hidden selected>Minutos</option>
                                <?php foreach (range(0, 60) as $i): ?>
                                  <option value="<?=$i?>"><?=str_pad($i, 2, "0", STR_PAD_LEFT)?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit_schedule" id="submit_schedule" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>