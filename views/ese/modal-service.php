<div class="modal fade" id="modal_service">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <div class="form-group">
                        <label class="col-form-label" for="Servicio_Solicitado">Servicio solicitado</label>
                        <select name="Servicio_Solicitado" class="form-control">
                          <?php $servicios = Utils::showTiposServiciosApoyo(); ?>
                          <?php foreach ($servicios as $servicio): ?>
                              <option value="<?=$servicio['Campo']?>"><?=$servicio['Descripcion']?></option>
                          <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Fase">Fase</label>
                        <select name="Fase" class="form-control">
                            <?php $fases = Utils::showFasesServiciosApoyo(); ?>
                            <?php foreach ($fases as $fase): ?>
                                <option value="<?=$fase['Campo']?>"><?=$fase['Descripcion']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Estado">Estatus</label>
                        <select name="Estado" class="form-control">
                          <option disabled selected="selected">No asignado</option>
                          <option value="250">En proceso</option>
                          <option value="252">Finalizado</option>
                          <option value="254">Facturado</option>
                          <option value="258">Cancelado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit_service" id="submit_service" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>