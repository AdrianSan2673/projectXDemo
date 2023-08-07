<div class="modal fade" id="modal-alta">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Alta del empleado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group ">
                        <label class="col-form-label">Fecha de reingreso</label>
                        <input type="date" name="re_entry_date" id="re_entry_date" class="form-control" value="<?= isset($employee->re_entry_date) ? $employee->re_entry_date : ''  ?>" required>
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