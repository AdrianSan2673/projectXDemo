<div class="modal fade" id="modal_historial_salud">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Historial de salud</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag_salud">
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Diabetes">Diabetes</label>
                            <select class="form-control" name="Diabetes">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Diabetes_Familiar">¿Quién?</label>
                            <input type="text" name="Diabetes_Familiar" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Cancer">Cáncer</label>
                            <select class="form-control" name="Cancer">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Cancer_Familiar">¿Quién?</label>
                            <input type="text" name="Cancer_Familiar" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Hipertension">Hipertensión</label>
                            <select class="form-control" name="Hipertension">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Hipertension_Familiar">¿Quién?</label>
                            <input type="text" name="Hipertension_Familiar" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Disfuncion_Renal">Disfunción Renal</label>
                            <select class="form-control" name="Disfuncion_Renal">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Disfuncion_Renal_Familiar">¿Quién?</label>
                            <input type="text" name="Disfuncion_Renal_Familiar" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Fibrosis_Quistica">Fibrosis Quística</label>
                            <select class="form-control" name="Fibrosis_Quistica">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Fibrosis_Quistica_Familiar">¿Quién?</label>
                            <input type="text" name="Fibrosis_Quistica_Familiar" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Miopia">Miopía</label>
                            <select class="form-control" name="Miopia">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Miopia_Familiar">¿Quién?</label>
                            <input type="text" name="Miopia_Familiar" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Asma">Asma</label>
                            <select class="form-control" name="Asma">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Asma_Familiar">¿Quién?</label>
                            <input type="text" name="Asma_Familiar" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Migranas">Migrañas</label>
                            <select class="form-control" name="Migranas">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Migranas_Familiar">¿Quién?</label>
                            <input type="text" name="Migranas_Familiar" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Esclerosis_Multiple">Esclerosis Múltiple</label>
                            <select class="form-control" name="Esclerosis_Multiple">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Esclerosis_Multiple_Familiar">¿Quién?</label>
                            <input type="text" name="Esclerosis_Multiple_Familiar" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Fuma">¿Fuma?</label>
                            <select class="form-control" name="Fuma">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Fuma_Cuanto">¿Cuántos cigarros al día?</label>
                            <input type="text" name="Fuma_Cuanto" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Bebe">¿Bebe?</label>
                            <select class="form-control" name="Bebe">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Bebe_Frecuencia">¿Con qué frecuencia?</label>
                            <input type="text" name="Bebe_Frecuencia" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Consume_Droga">¿Consume alguna droga?</label>
                            <select class="form-control" name="Consume_Droga">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Cual_Droga">¿Cuál?</label>
                            <input type="text" name="Cual_Droga" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Deportes">¿Practica algún deporte?</label>
                            <select class="form-control" name="Deportes">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Deportes_Frecuencia">¿Qué deporte y con qué frecuencia?</label>
                            <input type="text" name="Deportes_Frecuencia" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Seguro_Medico">Seguro Médico</label><br>
                        <?php $Seguros_Medicos = Utils::showSaludSeguros() ?>
                        <?php foreach ($Seguros_Medicos as $seguro): ?>
                             <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="Servicio_Medico[]" value="<?=$seguro['Campo'] ?>">
                                <label class="form-check-label" for="Servicio_Medico"><?=$seguro['Descripcion'] ?></label>
                            </div>   
                        <?php endforeach ?>
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
    const selects_salud = document.querySelectorAll('#modal_historial_salud form select');
    const inputs_salud = document.querySelectorAll('#modal_historial_salud form input');
    for (let i = 0; i < selects_salud.length; i++) {
        selects_salud[i].addEventListener('change', e => {
            if (selects_salud[i].value == "Si" || selects_salud[i].value == 1)
                inputs_salud[i + 2].parentElement.style.display = "block";
            else if (selects_salud[i].value == "No" || selects_salud[i].value == 0)
                inputs_salud[i + 2].parentElement.style.display = "none";
        })
    }
</script>