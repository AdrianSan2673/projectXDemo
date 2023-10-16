<div class="modal fade" id="modal_update_holidays">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="title-modal-update"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="">

                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="start_date">Fecha de Inicio</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="end_date">Fecha de finalización</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Editar">
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    document.querySelector("#modal_update_holidays form").onsubmit = function(e) {
        e.preventDefault();
        let holiday = new Holidays();
        holiday.update_holiday()
    };
</script>