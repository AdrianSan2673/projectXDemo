<div class="modal fade" id="modal_send_evalaution">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Enviar evaluacione</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id" value="">

                    <div class="form-group">
                        <label for="contract" class="col-form-label">Enviar a</label>
                        <select class="form-control" name="id_boss" id="id_boss_select">
                            <option selected value="0">Selecciona a quien reporta</option>
                            <?php foreach ($type_positions as $type_pos) : ?>
                                <option value="<?= Encryption::encode($type_pos['id_employee']) ?>"> <?= $type_pos['employePosition'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label class="col-form-label">Correo de envio</label>
                        <input type="email" class="form-control" name="email_input" id="email_input" maxlength="100" required>
                        <select class="form-control" name="email_boss" id="email_employee" hidden>
                            <option value="">Escribir email</option>
                        </select>
                    </div>

                    <div class="form-group ">
                        <label class="col-label">Evaluacion</label>
                        <select name="id_evaluation" class="form-control" required>
                            <option disabled value="" selected>Selecciona evaluacion</option>
                            <?php foreach ($evaluationsAll as $eval) : ?>
                                <option value=" <?= Encryption::encode($eval['id']) ?>"><?= $eval['name']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">                        
                        <div class="form-group col-6">
                            <label class="col-form-label">Fecha inicial</label>
                            <input type="date" name="start_date" class="form-control" value="" required>
                        </div>
                    
                        <div class="form-group col-6">
                            <label class="col-form-label">Fecha final</label>
                            <input type="date" name="end_date" class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Empleados a evaluar</label>
                        <select name="employees[]" id="select_employee" multiple="multiple" class="form-control select2bs4" required>
                            <?php foreach ($employees as $emplo) : ?>
                                <option value="<?= $emplo['id_employee'] ?>"> <?= $emplo['employePosition']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="level" class="col-form-label">Cuerpo del correo</label>
                        <textarea name="cuerpo_email" class="form-control" rows="5" maxlength="200">Se adjunta la evaluación de desempeño de los siguientes colaboradores, quedando a su disposición ante cualquier duda que surja. Saludos cordiales.</textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Enviar">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url ?>app/RH/employee.js?v=<?= rand() ?>"></script>
<script>
    var id_employee = document.querySelector('#id_boss_select');

    id_employee.addEventListener('change', e => {
        $('#select_employee').val(null).trigger('change');
        let id_boss_select = new Employee();
        id_boss_select.getEmailByIdEmployee(id_employee.value);
        id_boss_select.getAllEmployeeByIdBoss(id_employee.value);
    })

    document.querySelector('#email_employee').addEventListener('change', e => {
        console.log(document.querySelector('#email_employee').value);
        if (document.querySelector('#email_employee').value == '') {
            document.querySelector('#email_input').required = true
            document.querySelector('#email_input').hidden = false
            document.querySelector('#email_employee').required = false
            document.querySelector('#email_employee').hidden = true
        } 

    })
</script>