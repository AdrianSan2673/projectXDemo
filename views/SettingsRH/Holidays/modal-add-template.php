<div class="modal fade" id="modal-add-template">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add-template-form" name="formulario">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar nueva platilla</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" class="form-control" name="client" id="client" value="<?= Encryption::encode($_SESSION['id_cliente']) ?>" required>

                <div class="modal-body">
                    <label>Ingrese el nombre de la nueva plantilla:</label>
                    <div class="input-group mb-3">
                        <input placeholder='Nombre de la plantilla' type="text" onPaste="return false" class="form-control" name="name" id="name" autocomplete="off" required>
                    </div>

                    <div class="form-control" style="border: none;">
                        <input style="transform:scale(1.3);margin-right:0.5rem" type="checkbox" checked id="duplicate" name="duplicate">
                        <font size=1> Duplicar las fechas de la última plantilla creada </font>
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
    document.querySelector('#modal-add-template').addEventListener('submit', e => {
        e.preventDefault();
        modulerh.save_template();

    });
</script>