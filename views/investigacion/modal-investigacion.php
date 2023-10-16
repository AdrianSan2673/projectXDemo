<div class="modal fade" id="modal_investigacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="update-investigacion-form">
                <div class="modal-header">
                    <h4 class="modal-title">Investigación laboral</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="Folio" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Circunstancias_Laborales">¿El candidato cuenta con constancias laborales?</label>
                        <select class="form-control" name="Circunstancias_Laborales" required>
                            <option value="" hidden selected>Selecciona</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Proporciono_Datos_Empleos">¿Proporcionó los datos de contacto de sus empleos?</label>
                        <select class="form-control" name="Proporciono_Datos_Empleos" required>
                            <option value="" hidden selected>Selecciona</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Motivo_No_Proporciono_Datos">En caso de que no, ¿cuál fue el motivo por que no los proporcionó?</label>
                        <input type="text" class="form-control" name="Motivo_No_Proporciono_Datos" maxlength="150">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Demanda_Laboral">¿Ha demandado alguna empresa?</label>
                        <select class="form-control" name="Demanda_Laboral" required>
                            <option value="" hidden selected>Selecciona</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Motivo_Demanda">En caso afirmativo, ¿cuál fue el motivo?</label>
                        <input type="text" class="form-control" name="Motivo_Demanda" maxlength="150" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="No_Empleos">Número de empleos registrados en los últimos 3 años</label>
                        <input type="number" class="form-control" name="No_Empleos" min="0" required>
                    </div>
                    <div class="form-row sindicato-cementin" style="display: none;">
                        <hr>
                        <div class="col-12">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Sindicalizado">¿El candidato fue sindicalizado?</label>
                                    <select class="form-control" name="Sindicalizado">
                                        <option value="2">No aplica</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Sindicato">¿En cuál(es) sindicato(s) estuvo?</label>
                                    <input type="text" name="Sindicato" class="form-control" maxlength="300">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Comite_Sindical">¿Tuvo un puesto en el comité sindical?</label>
                                    <select class="form-control" name="Comite_Sindical">
                                        <option value="2">No aplica</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Puesto_Sindical">¿Cuál fue el puesto?</label>
                                    <input type="text" name="Puesto_Sindical" class="form-control" maxlength="250">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="Funciones_Sindicato">¿Cuáles eran sus funciones?</label>
                            <input type="text" name="Funciones_Sindicato" class="form-control" maxlength="250">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="Tiempo_Sindicato">¿Durante cuánto tiempo</label>
                            <input type="text" name="Tiempo_Sindicato" class="form-control" maxlength="250">
                        </div>
                    </div>

                    <div class="trabajo-ternium" style="display: none;">
                        <div class="form-group ">
                            <label class="col-form-label" for="Trabajo_Ternium">¿Ha trabajado para Ternium?</label>
                            <select class="form-control" name="Trabajo_Ternium">
                                <option value="" hidden selected>Selecciona</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="form-group ">
                            <label class="col-form-label" for="Alta_Ternium">¿Qué empresa lo dio de alta y cuándo fue su último acceso a una planta Ternium?</label>
                            <input type="text" name="Alta_Ternium" class="form-control" maxlength="50">
                        </div>

                        <div class="form-group ">
                            <label class="col-form-label" for="Veto_Ternium">¿Tiene algún veto o sanción con Ternium?</label>
                            <input type="text" name="Veto_Ternium" class="form-control" maxlength="50">
                        </div>
                    </div>


                    <div class="form-row preguntas-operador" style="display: none;">
                        <div class="form-group col">
                            <label for="Positivo_Antidoping" class="col-form-label">¿Alguna vez salió positivo en una prueba antidpoing?</label>
                            <select class="form-control" name="Positivo_Antidoping">
                                <option value="" hidden selected>Selecciona</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="Sustancia_Antidoping" class="col-form-label">Especificar la sustancia</label>
                            <input type="text" name="Sustancia_Antidoping" class="form-control" maxlength="50">
                        </div>
                        <div class="form-group col">
                            <label for="Accidentes_Empresa" class="col-form-label">¿Cuenta con accidentes en su historia con la empresa?</label>
                            <select class="form-control" name="Accidentes_Empresa">
                                <option value="" hidden selected>Selecciona</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="Abandono_Unidad" class="col-form-label">¿Tuvo abandono de unidad?</label>
                            <select class="form-control" name="Abandono_Unidad">
                                <option value="" hidden selected>Selecciona</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="trabajo-dalton" style="display: none;">
                        <div class="form-group ">
                            <label class="col-form-label" for="Trabajo_dalton">¿Cuentan con algún familiar dentro de la empresa?</label>
                            <select class="form-control" name="Familiar_Empresa">
                                <option value="" disabled selected>Selecciona</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
					
					       <div class="reingreso" style="display: none;">
                        <div class="form-group ">
                            <label class="col-form-label" for="Reingreso">¿Es reingreso de la empresa?</label>
                            <select class="form-control" name="Reingreso">
                                <option value="" disabled selected>Selecciona</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
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


<script>
    let trabajo_Ternium = document.querySelectorAll('#modal_investigacion form select')[5]

    trabajo_Ternium.addEventListener('change', (event) => {
        if (event.target.value == 'No') {
            document.querySelectorAll('#modal_investigacion form .form-group')[13].hidden = true
            document.querySelectorAll('#modal_investigacion form .form-group')[14].hidden = true
        }
        if (event.target.value == 'Si') {
            document.querySelectorAll('#modal_investigacion form .form-group')[13].hidden = false
            document.querySelectorAll('#modal_investigacion form .form-group')[14].hidden = false
        }
    });
</script>