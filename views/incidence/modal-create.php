<div class="modal fade" id="modal_create_incidencias">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Incidente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group" <?= isset($_GET['id']) ? 'hidden' : '' ?>>
                        <label class="col-form-label" for="">Empleados</label>
                        <select name="id_employees[]" id="" multiple="multiple" class="form-control select2bs4" required>
                            <?php foreach ($employees as $emplo) : ?>
                                <option value="<?= Encryption::encode($emplo['id_employee'] )?>"> <?= $emplo['employePosition']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">                        
                        <div class="form-group col-6">
                            <label class="col-form-label">Fecha inicial</label>
                            <input type="date" name="created_at" class="form-control" value="" required>
                        </div>
                    
                        <div class="form-group col-6">
                            <label class="col-form-label">Fecha final</label>
                            <input type="date" name="end_date" class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="">Tipo de incidencia</label>
                        <select name="type" id="selec_incidence" class="form-control" required>
                            <option disabled selected value="">Selecciona incidencia</option>
                            <option value="Retraso">Retraso</option>
                            <option value="Faltas">Faltas</option>
                            <option value="Incapacidades">Incapacidades</option>
                            <option value="Bonos" hidden>Bonos</option>
                            <option value="Horas extras" hidden>Horas extras</option>
                            <option value="Permiso">Permiso</option>
                        </select>
                    </div>

                    <div id="div_form_inputs">
                        <!-- Retrazo -->
                        <!-- Horas extras -->
                        <div class="form-group" id="form_hours" hidden>
                            <label class="col-form-label">Horas</label>
                            <input type="number" name="hours" class="form-control">
                        </div>

                        <!-- Falta -->
                        <div class="form-group" id="form_type_of_foul" hidden>
                            <label class="col-form-label" for="">Tipo de faltas</label>
                            <select name="type_of_foul" class="form-control">
                                <option disabled selected value="">Selecciona tipo de falta</option>
                                <option value="Falta injustificada">Falta injustificada</option>
                                <option value="Falta con gose de sueldo">Falta con gose de sueldo</option>
                                <option value="Falta sin gose de sueldo">Falta sin gose de sueldo</option>
                            </select>
                        </div>

                        <!-- Incapacidad -->
                        <div class="form-group" id="form_type_of_incapacity" hidden>
                            <label class="col-form-label" for="">Tipo de incapacidad</label>
                            <select name="type_of_incapacity" class="form-control">
                                <option disabled selected value="">Selecciona tipo de incapacidad </option>
                                <option value="Temporal">Temporal</option>
                                <option value="Permanencia parcial">Permanencia parcial</option>
                                <option value="Permanencia total">Permanencia total</option>
                            </select>
                        </div>

                        <!-- Bono -->
                        <div class="form-group" id="form_amount" hidden>
                            <label class="col-form-label">Importe de bono</label>
                            <input type="number" name="amount" class="form-control">
                        </div>

                        <!-- Permiso -->
                        <div class="form-group" id="form_permission" hidden>
                            <label class="col-form-label" for="">Tipo de permiso</label>
                            <select name="permission" class="form-control">
                                <option disabled selected value="">Selecciona tipo de permiso</option>
                                <option value="Permiso con gose de sueldo">Permiso con gose de sueldo</option>
                                <option value="Permiso sin gose de sueldo">Permiso sin gose de sueldo</option>
                                <option value="Paternidad ">Paternidad</option>
                                <option value="Por defunsion">Por defunsion</option>
                                <option value="Matrimonio">Matrimonio</option>
                                <option value="Lactancia">Lactancia</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="comments">Comentario</label>
                        <textarea class="form-control" name="comments" rows="5"></textarea>
                    </div>
                </div>

                <input type="hidden" name="flag" value="1">
                <input type="hidden" name="id_incident" value="">


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>




<script>
    let selec_incidence = document.querySelector('#selec_incidence')
    selec_incidence.addEventListener('change', e => {
        let div_form_inputs = document.querySelectorAll('#div_form_inputs .form-group')
        let form_inputs = document.querySelectorAll('#div_form_inputs .form-group .form-control')

        for (let i = 0; i < div_form_inputs.length; i++) {
            div_form_inputs[i].hidden = true
            form_inputs[i].required = false
        }
        if (selec_incidence.selectedIndex == 1 || selec_incidence.selectedIndex == 5) {
            document.querySelector('#form_hours').hidden = false
            document.querySelector('#form_hours input').required = true
        } else if (selec_incidence.selectedIndex == 2) {
            document.querySelector('#form_type_of_foul').hidden = false
            document.querySelector('#form_type_of_foul select').required = true
        } else if (selec_incidence.selectedIndex == 3) {
            document.querySelector('#form_type_of_incapacity').hidden = false
            document.querySelector('#form_type_of_incapacity select').required = true
        } else if (selec_incidence.selectedIndex == 4) {
            document.querySelector('#form_amount').hidden = false
            document.querySelector('#form_amount input').required = true
        } else if (selec_incidence.selectedIndex == 6) {
            document.querySelector('#form_permission').hidden = false
            document.querySelector('#form_permission select').required = true
        }
    })
</script>