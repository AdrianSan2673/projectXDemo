<div class="modal fade" id="modal_examen_medico">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Exámen Médico</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Numero_Examen">Número de Exámen</label>
                        <input type="text" class="form-control" name="Numero_Examen" maxlength="40" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Tipo_Examen">Tipo de Exámen</label>
                        <input type="text" class="form-control" name="Tipo_Examen" maxlength="40" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Resultado_Examen">Resultado de Exámen</label>
                        <input type="text" class="form-control" name="Resultado_Examen" maxlength="40" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Fecha_Dictamen_Examen">Vigente del</label>
                            <input type="text" class="form-control" name="Fecha_Dictamen_Examen" placeholder="dd/mm/yyyy" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Vigente_Hasta_Examen">Hasta</label>
                            <input type="text" class="form-control" name="Vigente_Hasta_Examen" placeholder="dd/mm/yyyy" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>