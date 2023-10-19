<div class="modal fade" id="modal_comentarios_generales_inv">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Comentarios generales de la investigación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Info_Proporcionada_Candidato">Información proporcionada por el candidato</label>
                        <select class="form-control" name="Info_Proporcionada_Candidato">
                            <option value="242">Buena</option>
                            <option value="241">Regular</option>
                            <option value="240">Malo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Referencias_Laborales">Referencias laborales obtenidas</label>
                        <select class="form-control" name="Referencias_Laborales">
                            <option value="242">Buena</option>
                            <option value="241">Regular</option>
                            <option value="240">Malo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Info_Confiable">Información confiable y verificable</label>
                        <select class="form-control" name="Info_Confiable">
                            <option value="242">Buena</option>
                            <option value="241">Regular</option>
                            <option value="240">Malo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Comentario_General_il">Comentarios generales</label>
                        <textarea name="Comentario_General_il" class="form-control" rows="25" ></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Viable">Viabilidad</label>
                        <select name="Viable" class="form-control">
                            <option value="4">Sin viabilidad</option>
                            <option value="0">Viable</option>
                            <option value="1">No viable</option>
                            <option value="2">Viable con reservas</option>
							<option value="5">Viable con observaciones (RADEC)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-for-label">¿El candidato proporcionó los datos de contacto?</label>
                        <div class="form-row">
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Proporciona_Contacto" id="Proporciona_Contacto1" value="1">
                                    <label class="form-check-label" for="Proporciona_Contacto1">Sí</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Proporciona_Contacto" id="Proporciona_Contacto2" value="2">
                                    <label class="form-check-label" for="Proporciona_Contacto2">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-for-label">¿Es congruente la información con lo obtenido en información de IMSS?</label>
                        <div class="form-row">
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Informacion_Congruente" id="Informacion_Congruente1" value="1">
                                    <label class="form-check-label" for="Informacion_Congruente1">Sí</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Informacion_Congruente" id="Informacion_Congruente2" value="2">
                                    <label class="form-check-label" for="Informacion_Congruente2">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-for-label">¿Se detectó algún factor de riesgo?</label>
                        <div class="form-row">
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Factor_Riesgo" id="Factor_Riesgo1" value="1">
                                    <label class="form-check-label" for="Factor_Riesgo1">Sí</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Factor_Riesgo" id="Factor_Riesgo2" value="2">
                                    <label class="form-check-label" for="Factor_Riesgo2">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Cual_Factor_Riesgo">¿Cuál?</label>
                        <input type="text" name="Cual_Factor_Riesgo" class="form-control"  maxlength="150">
                    </div>
                    <div class="form-group">
                        <label class="col-for-label">¿Se observa estabilidad laboral?</label>
                        <div class="form-row">
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Estabilidad_Laboral" id="Estabilidad_Laboral1" value="1">
                                    <label class="form-check-label" for="Estabilidad_Laboral1">Sí</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icheck-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="Estabilidad_Laboral" id="Estabilidad_Laboral2" value="2">
                                    <label class="form-check-label" for="Estabilidad_Laboral2">No</label>
                                </div>
                            </div>
                        </div>
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