<div class="modal fade" id="modal_comentarios_generales">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Comentarios generales</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Comentarios_Generales">Comentarios generales</label>
                        <textarea name="Comentarios_Generales" class="form-control" rows="35"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-for-label">¿Atendió puntual y en fecha y hora acordada?</label>
                        <div class="form-row">
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Puntualidad" id="Puntualidad1" value="1">
                                    <label class="form-check-label" for="Puntualidad1">Sí</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Puntualidad" id="Puntualidad2" value="2">
                                    <label class="form-check-label" for="Puntualidad2">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-for-label">¿Presentó la documentación solicitada?</label>
                        <div class="form-row">
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Documentacion" id="Documentacion1" value="1">
                                    <label class="form-check-label" for="Documentacion1">Sí</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Documentacion" id="Documentacion2" value="2">
                                    <label class="form-check-label" for="Documentacion2">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-for-label">¿Se condujo con naturalidad y dominio?</label>
                        <div class="form-row">
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Naturalidad" id="Naturalidad1" value="1">
                                    <label class="form-check-label" for="Naturalidad1">Sí</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Naturalidad" id="Naturalidad2" value="2">
                                    <label class="form-check-label" for="Naturalidad2">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-for-label">¿Sus respuestas fueron claras y seguras?</label>
                        <div class="form-row">
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Respuestas_Claras" id="Respuestas_Claras1" value="1">
                                    <label class="form-check-label" for="Respuestas_Claras1">Sí</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Respuestas_Claras" id="Respuestas_Claras2" value="2">
                                    <label class="form-check-label" for="Respuestas_Claras2">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Califica_como">Análisis de Verificación</label>
                       <input type="hidden" name="Califica_como" class="form-control" maxlength="50">
                         <textarea name="Viabilidad" class="form-control" rows="10"></textarea>
                      <!--  <select name="Viabilidad" class="form-control">
                            <option value="4">Sin viabilidad</option>
                            <option value="0">Viable</option>
                            <option value="1">No viable</option>
                            <option value="2">Viable con reservas</option>
                            <option value="5">Viable con observaciones (RADEC)</option>
                        </select> -->
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