<div class="modal fade" id="modal_datos_personales">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Datos generales</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="Folio" name="Folio">
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="Nacimiento" maxlength="50">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Edad">Edad</label>
                            <input type="number" class="form-control" name="Edad" min="18">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Sexo">Sexo</label>
                            <select class="form-control" name="Sexo">
                                <option value="0">No asignado</option>
                                <option value="98">Masculino</option>
                                <option value="99">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Lugar_Nacimiento">Lugar de Nacimiento</label>
                        <input type="text" class="form-control" name="Lugar_Nacimiento" maxlength="50">
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Estado_Civil">Estado Civil</label>
                            <select class="form-control" name="Estado_Civil">
                                <option value="0">No asignado</option>
                                <?php $estados_civiles = Utils::showEstadosCiviles() ?>
                                <?php foreach ($estados_civiles as $edo): ?>
                                    <option value="<?= $edo['Campo'] ?>"><?= $edo['Descripcion'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="matrimonio" hidden>
                            <div class="form-group col">
                                <label class="col-form-label" for="Fecha_Matrimonio">Fecha de Matrimonio</label>
                                <input type="text" name="Fecha_Matrimonio" class="form-control" maxlength="50">
                            </div>
                        </div>
                            
                        <div class="form-group col">
                            <label class="col-form-label" for="Hijos">Número de hijos</label>
                            <input type="number" name="Hijos" class="form-control" min="0">
                        </div>                    
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Nacionalidad">Nacionalidad</label>
                            <input type="text" name="Nacionalidad" class="form-control" maxlength="20">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Vive_con">Vive con</label>
                            <input type="text" name="Vive_con" class="form-control" maxlength="40">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="CURP">CURP</label>
                        <input type="text" class="form-control" name="CURP" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="IMSS">Número de Seguridad Social</label>
                        <input type="text" class="form-control" name="IMSS" maxlength="15" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="RFC">RFC</label>
                        <input type="text" class="form-control" name="RFC" maxlength="15" required>
                    </div>
                   
                    <div class="form-group num_licen" style="display: none;">
                        <label class="col-form-label" for="Numero_Licencia">Numero de licencia</label>
                        <input type="text" class="form-control" name="Numero_Licencia" maxlength="15">
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
	//Esto es para la fecha de matrimonio
    /*document.querySelectorAll('#modal_datos_personales select')[1].addEventListener('change', function(e){
        if (document.querySelectorAll('#modal_datos_personales select')[1].value != "102") 
            document.querySelector('.matrimonio').style.display = "none";
        else
            document.querySelector('.matrimonio').style.display = "block";
    })*/
</script>