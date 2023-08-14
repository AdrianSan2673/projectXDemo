<div class="modal fade" id="modal_referencia">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Referencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="Renglon">
                            <input type="hidden" name="Folio">
                            <input type="hidden" name="flag">
                            <div class="form-group">
                                <label class="col-form-label" for="Tipo">Tipo</label>
                                <select class="form-control" name="Tipo" required>
                                    <option value="1">Personal</option>
                                    <option value="2">Vecinal</option>
                                    <option value="3">Familiar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Relacion">Relacion</label>
                                <input type="text" name="Relacion" class="form-control" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Nombre">Nombre</label>
                                <input type="text" name="Nombre" class="form-control" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Telefono">Teléfono</label>
                                <input type="text" name="Telefono" class="form-control" maxlength="30" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Domicilio">Domicilio de la referencia</label>
                                <input type="text" name="Domicilio" class="form-control" maxlength="255" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Domicilio_Candidato">¿Cuál es el domicilio del candidato?</label>
                                <input type="text" name="Domicilio_Candidato" class="form-control" maxlength="255" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Tiempo_Viviendo">¿Cuánto tiempo tiene el candidato viviendo ahí?</label>
                                <input type="text" name="Tiempo_Viviendo" class="form-control" maxlength="30" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="Tiempo_Conocerlo">¿Cuánto tiempo tiene de conocerlo?</label>
                                <input type="text" name="Tiempo_Conocerlo" class="form-control" maxlength="30" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Tiene_Hijos">¿Sabe si tiene hijos?</label>
                                <input type="text" name="Tiene_Hijos" class="form-control" maxlength="100" >
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Dedicacion">¿Sabe a qué se dedica?</label>
                                <input type="text" name="Dedicacion" class="form-control" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Estado_Civil">¿Sabe sobre su estado civil?</label>
                                <input type="text" name="Estado_Civil" class="form-control" maxlength="50" >
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Comentarios">Comentarios</label>
                                <textarea class="form-control" name="Comentarios" rows="10"></textarea>
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
<div class="modal fade" id="modal_delete_referencia">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar referencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Renglon">
                    <input type="hidden" name="Folio">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-danger" value="Eliminar">
                </div>
            </form>
        </div>
    </div>              
</div>