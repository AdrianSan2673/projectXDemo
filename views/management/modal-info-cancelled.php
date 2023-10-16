<div class="modal fade" id="modal_info_cancelled">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="form-info-cancelled">
                <div class="modal-header">
                    <h4 id="titulo"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="id">
                    <div class="form-group">
                        <label for="cancellation_date" class="col-form-label">Fecha de cancelación:</label>
                        <input type="date" name="cancellation_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="comments" class="col-form-label">comentarios:</label>
                        <textarea name="comments" class="form-control" required> </textarea>
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
document.querySelector("#form-info-cancelled").onsubmit = function(e) {
    e.preventDefault();
    let managementt = new Management();
    managementt.updateInfoCancelled();
};
</script>