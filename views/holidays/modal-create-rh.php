<div class="modal fade" id="modal_create_holidays">
    <div class="modal-dialog" style="max-width: 700px!important;">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Solicitud</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_employee"
                        value="<?= Encryption::encode($_SESSION['identity']->id) ?>">

                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="start_date">Fecha de Inicio</label>
                            <input type="date" name="start_date" min="<?= date('Y-m-d') ?>" class="form-control" required>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="end_date">Fecha de finalización</label>
                            <input type="date" name="end_date" min="<?= date('Y-m-d') ?>"  class="form-control" required>
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

<script src="<?= base_url ?>app/RH/employee_RH.js?v=<?= rand() ?>"></script>
<script>
document.querySelector("#modal_create_holidays form").onsubmit = function(e) {
    e.preventDefault();
    let empleado = new Employee_RH();
    empleado.save_solicitud();
};
</script>