<div id="modal-container">
    <div class="modal fade" id="modal-cambio_clilente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form_cliente">

                    <div class="modal-body">
                        <select name="id_cliente" id="" class="form-control " required>
                            <?php
                            $clientes = Utils::getEmpresaByContactoRH();
                            foreach ($clientes as $cliente) : ?>
                                <option value="<?= Encryption::encode($cliente['Cliente']) ?>"  <?=$_SESSION['id_cliente']==$cliente['Cliente']?'selected':''   ?>> <?= $cliente['Nombre_Cliente']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?= base_url ?>app/RH/modulerh.js?v=<?= rand() ?>"></script>

<script>
    document.querySelector('#modal_open_cliente').addEventListener('click', e => {
        e.preventDefault();
        $('#modal-container').html($('#modal-cambio_clilente'));
        $('#modal-cambio_clilente').modal({
            backdrop: 'static',
            keyboard: false
        });
    });


    document.querySelector(' #form_cliente').addEventListener('submit', e => {
        e.preventDefault();
        let moduleRH = new ModuleRH();
        moduleRH.cambiarIdCliente();
    });
</script>