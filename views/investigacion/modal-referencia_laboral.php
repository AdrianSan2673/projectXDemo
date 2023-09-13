<div class="modal fade" id="modal_referencia_laboral">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Referencia laboral</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <input type="hidden" name="Renglon">
                            <input type="hidden" name="Folio">
                            <input type="hidden" name="flag">
                            <div class="form-group">
                                <label class="col-form-label" for="Empresa">Empresa</label>
                                <input type="text" class="form-control" name="Empresa" maxlength="150" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Giro">Giro</label>
                                <input type="text" name="Giro" class="form-control" maxlength="50" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Domicilio">Domicilio</label>
                                <input type="text" name="Domicilio" class="form-control" maxlength="200" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Telefono">Teléfono</label>
                                <input type="text" name="Telefono" class="form-control" maxlength="30" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Fecha_Ingreso">Fecha de Ingreso</label>
                                    <input type="text" class="form-control" name="Fecha_Ingreso" maxlength="60" required>
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Fecha_Baja">Fecha de Baja</label>
                                    <input type="text" class="form-control" name="Fecha_Baja" maxlength="60" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Puesto_Inicial">Puesto Inicial</label>
                                    <input type="text" class="form-control" name="Puesto_Inicial" maxlength="50" required>
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Puesto_Final">Puesto Final</label>
                                    <input type="text" class="form-control" name="Puesto_Final" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Jefe">Jefe Inmediato</label>
                                    <input type="text" class="form-control" name="Jefe" maxlength="50" required>
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Puesto_Jefe">Puesto del Jefe</label>
                                    <input type="text" class="form-control" name="Puesto_Jefe" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Motivo_Separacion">Motivo de Separación</label>
                                    <input type="text" name="Motivo_Separacion" class="form-control" maxlength="60"  required>
                                </div>
                                <div class="form-group col" style="display: none;">
                                    <label class="col-form-label" for="Dopaje">¿Sabe si el candidato consume estupefacientes o medicamentos controlados?</label>
                                    <select class="form-control" name="Dopaje">
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Recontratable">¿Es el candidato una persona recontratable?</label>
                                <select class="form-control" name="Recontratable" >
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                    <option value="2">No aplica</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Recontratable_PorQue">Justifique la respuesta anterior</label>
                                <textarea name="Recontratable_PorQue" rows="3" class="form-control" maxlength="180"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Informante">Nombre de quién proporciona la información</label>
                                <input type="text" name="Informante" class="form-control" maxlength="80"   >
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Puesto_Informante">Puesto de quién proporciona la información</label>
                                <input type="text" name="Puesto_Informante" class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label" for="Comentarios">Comentarios</label>
                                <textarea name="Comentarios" class="form-control" rows="33" maxlength="4000"  ></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="Calif">¿Cuenta con la calificación del candidato?</label>
                                <select class="form-control" name="Calif">
                                    <option value="0">Sí</option>
                                    <option value="1">No</option>
                                </select>
                            </div>
                            <div class="calif">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="col-form-label" for="Desempeno">Desempeño laboral</label>
                                        <select class="form-control" name="Desempeno">
                                            <option value="260">Excelente</option>
                                            <option value="261" selected>Apropiada</option>
                                            <option value="262">Regular</option>
                                            <option value="263">Malo</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label class="col-form-label" for="Honradez">Honradez</label>
                                        <select class="form-control" name="Honradez">
                                            <option value="260">Excelente</option>
                                            <option value="261" selected>Apropiada</option>
                                            <option value="262">Regular</option>
                                            <option value="263">Malo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="col-form-label" for="Puntualidad">Asistencia y puntualidad</label>
                                        <select class="form-control" name="Puntualidad">
                                            <option value="260">Excelente</option>
                                            <option value="261" selected>Apropiada</option>
                                            <option value="262">Regular</option>
                                            <option value="263">Malo</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label class="col-form-label" for="Relacion">Relación con superiores y compañeros</label>
                                        <select class="form-control" name="Relacion">
                                            <option value="260">Excelente</option>
                                            <option value="261" selected>Apropiada</option>
                                            <option value="262">Regular</option>
                                            <option value="263">Malo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="col-form-label" for="Responsabilidad">Responsabilidad</label>
                                        <select class="form-control" name="Responsabilidad">
                                            <option value="260">Excelente</option>
                                            <option value="261" selected>Apropiada</option>
                                            <option value="262">Regular</option>
                                            <option value="263">Malo</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label class="col-form-label" for="Adaptacion">Adaptación al ambiente de trabajo</label>
                                        <select class="form-control" name="Adaptacion">
                                            <option value="260">Excelente</option>
                                            <option value="261" selected>Apropiada</option>
                                            <option value="262">Regular</option>
                                            <option value="263">Malo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 
                    <div class="form-row">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Tipo_Unidad">Tipo Unidad</label>
                                    <input type="text" name="Tipo_Unidad" class="form-control" maxlength="50">
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Robos_Perdidas">Robos / pérdidas</label>
                                    <select class="form-control" name="Robos_Perdidas">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Accidentes_Graves">¿Accidentes graves?</label>
                                    <select class="form-control" name="Accidentes_Graves">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Cuidado_Unidad">Cuidado a la unidad</label>
                                    <select class="form-control" name="Cuidado_Unidad">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Problemas_Unidad">¿Problemas con Unidad?</label>
                                    <select class="form-control" name="Problemas_Unidad">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Gastos_Viaje">¿Manejaba Gastos de Viaje?</label>
                                    <select class="form-control" name="Gastos_Viaje">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Presentaba_Faltantes">¿Presentaba constantemente faltantes?</label>
                                    <select class="form-control" name="Presentaba_Faltantes">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Problemas_Diesel">¿Problemas con diésel?</label>
                                    <select class="form-control" name="Problemas_Diesel">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->    
                    <div class="form-row sindicato-cementin" style="display: none;">
                        <hr>
                        <div class="col-12">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Sindicalizado">En las empresas en las que ha trabajado, ¿ha estado como personal sindicalizado?</label>
                                    <select class="form-control" name="Sindicalizado">
                                        <option value="2">No aplica</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Sindicato">¿En cuál(es)?</label>
                                    <input type="text" name="Sindicato" class="form-control" maxlength="50">
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
                                    <input type="text" name="Puesto_Sindical" class="form-control" maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="col-form-label" for="Funciones_Sindicato">¿Cuáles eran sus funciones?</label>
                                    <input type="text" name="Funciones_Sindicato" class="form-control" maxlength="100">
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="Tiempo_Sindicato">¿Durante cuánto tiempo</label>
                                    <input type="text" name="Tiempo_Sindicato" class="form-control" maxlength="50">
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
<div class="modal fade" id="modal_delete_referencia_laboral">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="referencia_laboral-delete-form">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar referencia laboral</h4>
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
<script type="text/javascript">
    document.querySelectorAll('#modal_referencia_laboral select')[2].addEventListener('change', function(e){
        if (document.querySelectorAll('#modal_referencia_laboral select')[2].value == 1) 
            document.querySelector('.calif').style.display = "none";
        else
            document.querySelector('.calif').style.display = "block";

        console.log(document.querySelectorAll('#modal_referencia_laboral select')[1].value == 1);
    })
</script>