<div class="modal fade" id="modal_create_holidays">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Solicitud</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                    <input type="hidden" name="flag" value="0">
                    <input type="hidden" name="id">
                    <input type="hidden" name="id_contacto" value="<?=isset($id_contacto) ? $id_contacto : ''?>">
                    <div class="form-group">
                        <label class="col-form-label" for="">Empleado</label>
                        <select name="id_employee" class="form-control" id="">
                            <option disabled selected value="">Selecciona empleado</option>
                            <?php foreach ($employees as $emplo) : ?>
                                <?php if (($emplo['holidays_by_year'] - $emplo['taken_holidays']) > 0): ?>
                                    <option value="<?= $emplo['id'] ?>"> <?= $emplo['first_name'] . ' ' . $emplo['surname'] . ' ' . $emplo['last_name']  ?></option>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="start_date">Fecha de Inicio</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="end_date">Fecha de finalización</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="comments">Comentarios</label>
                        <textarea class="form-control" name="comments" rows="5"></textarea>
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
    var form = document.querySelector('#modal_create_holidays form');
    form.onsubmit = function(e) {
        e.preventDefault();
        let formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Vacaciones/save');
        xhr.send(formData);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                try {
                    if (r == 0)
                        utils.showToast('Omitiste algún dato','warning');
                    else {
                        let json_app = JSON.parse(r);
                        if (json_app.status == 2) {
                            utils.showToast('Hubo un error al registrar la solicitud de vacaciones, intenta de nuevo.', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        }else if (json_app.status == 1){
                            console.log(json_app);
                            form.querySelectorAll('.btn')[1].disabled = true;
                            let employees = '';
                            json_app.employees.forEach(employee => {
                                employees += `
                                    <tr>
                                        <td class="align-middle text-bold">${employee.first_name} ${employee.surname} ${employee.last_name}</td>
                                        <td class="text-center align-middle">${employee.start_date}</td>
                                        <td class="text-center align-middle">${employee.years}</td>
                                        <td class="text-center align-middle">${employee.holidays_by_year}</td>
                                        <td class="text-center align-middle">${employee.holidays_by_year - employee.taken_holidays}</td>
                                        <td class="text-center align-middle">${employee.due_date}</td>
                                    </tr>
                                `;
                            });
                            let holidays = '';
                            json_app.holidays.forEach(holiday => {
                                holidays += `
                                    <tr>
                                        <td class="align-middle text-bold">${holiday.first_name} ${holiday.surname} ${holiday.last_name}</td>
                                        <td class="text-center align-middle">${holiday.start_date}</td>
                                        <td class="text-center align-middle">${holiday.end_date}</td>
                                        <td class="text-center align-middle">${holiday.days}</td>
                                        <td class="text-center align-middle">${holiday.holidays_by_year - holiday.taken_holidays}</td>
                                    </tr>
                                `;
                            });
                            console.log(employees);
                            console.log(holidays);
                            document.querySelector('#tb_employees tbody').innerHTML = employees;
                            document.querySelector('#tb_holidays tbody').innerHTML = holidays;
                            utils.showToast('Se agregó el periodo vacacional exitosamente', 'success');
                            $('#modal_create_holidays').modal('hide');
                            form.querySelectorAll('.btn')[1].disabled = false;

                        }
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
            }
        }
    }
</script>