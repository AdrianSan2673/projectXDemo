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
                    <input type="hidden" name="id_contacto" value="<?= isset($id_contacto) ? $id_contacto : '' ?>">
                    <div class="form-group">
                        <label class="col-form-label" for="">Empleado</label>
                        <select name="id_employee" class="form-control select2" id="" required>
                            <option disabled selected value="">Selecciona empleado</option>
                            <?php foreach ($employees as $emplo) : ?>
                                <?php //if (($emplo['holidays_by_year'] - $emplo['taken_holidays']) > 0) : ?>
                                    <option value="<?= $emplo['id'] ?>"> <?= $emplo['first_name'] . ' ' . $emplo['surname'] . ' ' . $emplo['last_name']  ?></option>
                                <?php //endif ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="start_date">Fecha de Inicio</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="end_date">Fecha de finalización</label>
                            <input type="date" name="end_date" class="form-control" required>
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
