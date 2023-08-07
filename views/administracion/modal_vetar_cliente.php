<div class="modal fade" id="modal_vetar_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-orange">
                    <h4 class="">Suspender servicios </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group ">
                        <label class="col-form-label">Candidatos</label>
                        <select name="Clientes[]" multiple="multiple" class="form-control select2bs4" >
                            <?php $clientes = Utils::showClientes();
                            foreach ($clientes as $cliente) : ?>
                                <option value="<?= $cliente['Cliente']  ?>" <?= $cliente['Activo'] == 0 ? 'selected' : '' ?>><?= $cliente['Nombre_Cliente']  ?></option>
                            <?php endforeach; ?>
                        </select>
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
    document.querySelector('#modal_vetar_cliente').addEventListener('submit', e => {
        let administracion = new Administracion();
        administracion.updateVetarcliente('#modal_vetar_cliente');
        e.preventDefault();
    })
</script>