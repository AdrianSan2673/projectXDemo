<div class="modal fade" id="modal-baja">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Baja del empleado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <label class="col-form-label">Fecha de terminacion</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?= isset($employee->end_date) ? $employee->end_date : ''  ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="reason_for_leaving" class="col-form-label">Razón de baja</label>
                        <select class="form-control" name="reason_for_leaving" id="selectreason_for_leaving" required>
                            <option disabled selected value="">Selecciona razon de baja</option>
                            <option value="Abandono del empleo" <?= $employee->reason_for_leaving == 'Abandono del empleo' ? 'selected' : '' ?>>Abandono del empleo</option>
                            <option value="Baja con causal" <?= $employee->reason_for_leaving == 'Baja con causal' ? 'selected' : '' ?>>Baja con causal</option>
                            <option value="Cambio de residencia" <?= $employee->reason_for_leaving == 'Cambio de residencia' ? 'selected' : '' ?>>Cambio de residencia</option>
                            <option value="Recorte de personal" <?= $employee->reason_for_leaving == 'Recorte de personal' ? 'selected' : '' ?>>Recorte de personal</option>
                            <option value="Reestructura de la empresa" <?= $employee->reason_for_leaving == 'Reestructura de la empresa' ? 'selected' : '' ?>>Reestructura de la empresa</option>
                            <option value="Renuncia voluntaria" <?= $employee->reason_for_leaving == 'Renuncia voluntaria' ? 'selected' : '' ?>>Renuncia voluntaria</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="comment_for_leaving" class="col-form-label">Comentario de baja</label>
                        <textarea class="form-control" name="comment_for_leaving" rows="8" maxlength="2000" ><?= isset($employee->comment_for_leaving) ? $employee->comment_for_leaving : ''  ?></textarea>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>

                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            </form>
        </div>
    </div>
</div>