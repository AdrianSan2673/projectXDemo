<div class="modal fade" id="modal-add-type">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add-type-form" name="formulario">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar nuevo tipo de asistencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" class="form-control" name="client" id="client"
                    value="<?= Encryption::encode($_SESSION['id_cliente']) ?>" required>
                <input type="hidden" class="form-control" name="flag" id="flag" value="1" required>
                <input type="hidden" class="form-control" name="id_type" id="id_type" value="0" required>

                <div class="modal-body">
                    <label>Ingrese el nombre del nuevo tipo:</label>
                    <div class="input-group mb-3">

                        <input placeholder='Nombre' type="text" onPaste="return false" class="form-control" name="type"
                            id="type" autocomplete="off" required>
                    </div>

                    <div class="modal-footer">
                        <button id="guardar" name="guardar" type="submit" class="btn btn-primary">Guardar
                        </button>
                        <button id='close' type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url ?>app/RH/modulerh.js?v=<?= rand() ?>"></script>
<script>
modulerh = new ModuleRH();
document.querySelector('#modal-add-type').addEventListener('submit', e => {
    e.preventDefault();
    modulerh.save_type();

});
</script>