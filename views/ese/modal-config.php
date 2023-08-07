<div class="modal fade" id="modal_config">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="update-form">
                <div class="modal-header">
                    <h4 class="modal-title">Configuración</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio" id="Folio">
                    <input type="hidden" name="flag" value="0">
                    <div class="form-group">
                        <label class="col-form-label" for="Nombre_Candidato">Candidato</label>
                        <input type="text" class="form-control" name="Nombre_Candidato" id="Nombre_Candidato" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Cliente">Cliente</label>
                        <input type="text" class="form-control" name="Cliente" id="Cliente" readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Ejecutivo">Ejecutivo</label>
                        <?php $usuarios = Utils::showUsuariosPorPerfil(13); ?>
                        <select name="Ejecutivo" id="Ejecutivo" class="form-control">
                          <option disabled selected="selected"></option>
                          <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?=$usuario['Usuario']?>"><?=$usuario['Nombre']?></option>
                          <?php endforeach ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label" for="Solicitud">Fecha de solicitud</label>
                        <div class="row">
                          <div class="col-6">
                            <div class="input-group">
                              <input type="date" name="Fecha_Solicitud" id="Fecha_Solicitud" class="form-control" required>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="input-group">
                              <select id="Hora_Solicitud" name="Hora_Solicitud" class="form-control custom-select" required>
                                <option value="" hidden selected>Hora</option>
                                <?php foreach (range(0, 23) as $i): ?>
                                  <option value="<?=$i?>"><?=str_pad($i, 2, "0", STR_PAD_LEFT)?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="input-group">
                              <select id="Minuto_Solicitud" name="Minuto_Solicitud" class="form-control custom-select" required>
                                <option value="" hidden selected>Minutos</option>
                                <?php foreach (range(0, 60) as $i): ?>
                                  <option value="<?=$i?>"><?=str_pad($i, 2, "0", STR_PAD_LEFT)?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Fecha_Entrega">Fecha de finalización</label>
                        <div class="row">
                          <div class="col-6">
                            <div class="input-group">
                              <input type="date" name="Fecha_Entrega" id="Fecha_Entrega" class="form-control">
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="input-group">
                              <select id="Hora_Entrega" name="Hora_Entrega" class="form-control custom-select">
                                <option value="" selected>Hora</option>
                                <?php foreach (range(0, 23) as $i): ?>
                                  <option value="<?=$i?>"><?=str_pad($i, 2, "0", STR_PAD_LEFT)?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="input-group">
                              <select id="Minuto_Entrega" name="Minuto_Entrega" class="form-control custom-select">
                                <option value="" selected>Minutos</option>
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
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>