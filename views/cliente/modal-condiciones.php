<div class="modal fade" id="modal_condiciones">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Condiciones de venta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Cliente">
                    <input type="hidden" name="flag" value="1">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="Validacion_Licencia" class="col-form-label">Costo de Validación de Licencia</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" name="Validacion_Licencia" class="form-control" step="0.01" value="0">
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="RAL" class="col-form-label">Costo del Reporte de Antecedentes Legales</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" min="0" name="RAL" class="form-control" step="0.01" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="Investigacion_L" class="col-form-label">Costo de la Investigación Laboral</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" min="0" name="Investigacion_L" class="form-control" step="0.01" value="0">
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="ESE" class="col-form-label">Costo del Estudio Socioeconómico</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" min="0" name="ESE" class="form-control" step="0.01" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="SMART" class="col-form-label">Costo del Estudio Socioeconómico(SMART)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" min="0" name="SMART" class="form-control" step="0.01" value="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Paquetes" class="col-form-label">Costos especiales (paquetes)</label>
                        <input type="text" name="Paquetes" class="form-control">
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="Plazo_Credito" class="col-form-label">Plazo de crédito</label>
                        <input type="text" name="Plazo_Credito" class="form-control" value=''>
                    </div>
                    <div class="form-group">
                        <label for="Dias_Credito" class="col-form-label">Dias de crédito</label>
                        <select class="form-control" name="Dias_Credito">
                            <option value="3">3 días</option>
                            <option value="7">7 días</option>
                            <option value="15">15 días</option>
                            <option value="20">20 días</option>
                            <option value="30">30 días</option>
                            <option value="45">45 días</option>
                            <option value="60">60 días</option>
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