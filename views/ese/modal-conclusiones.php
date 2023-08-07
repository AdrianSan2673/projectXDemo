<div class="modal fade" id="modal_conclusiones">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Conclusiones</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Sobre_Candidato">Acerca del candidato</label>
                        <input type="text" class="form-control" name="Sobre_Candidato" maxlength="200">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Sobre_Casa">Acerca de su familia y entorno</label>
                        <input type="text" name="Sobre_Casa" class="form-control" maxlength="200">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Conclusiones_Entrevistador">Conclusiones del entrevistador</label>
                        <input type="text" name="Conclusiones_Entrevistador" class="form-control" maxlength="400">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Participacion_Candidato">Participación del candidato</label>
                        <select class="form-control" name="Participacion_Candidato">
                            <option value="242">Bueno</option>
                            <option value="241">Regular</option>
                            <option value="240">No aceptable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Entorno_Familiar">Entorno familiar</label>
                        <select class="form-control" name="Entorno_Familiar">
                            <option value="242">Bueno</option>
                            <option value="241">Regular</option>
                            <option value="240">No aceptable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Referencias_Vecinales">Referencias personales</label>
                        <select class="form-control" name="Referencias_Vecinales">
                            <option value="242">Bueno</option>
                            <option value="241">Regular</option>
                            <option value="240">No aceptable</option>
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