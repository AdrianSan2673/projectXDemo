<div class="modal fade" id="modal_datos_generales">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Datos del cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="Folio" name="Folio">
                    <div class="form-group">
                        <label class="col-form-label" for="Nombres">Nombre(s)</label>
                        <input type="text" name="Nombres" class="form-control" maxlength="35">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Apellido_Paterno">Apellido Paterno</label>
                        <input type="text" name="Apellido_Paterno" class="form-control" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Apellido Materno</label>
                        <input type="text" name="Apellido_Materno" class="form-control" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Puesto">Puesto</label>
                        <input type="text" name="Puesto" class="form-control" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label " for="Cliente">Cliente</label>
                        <select class="form-control" name="Cliente">
                            <option value="0">No asignado</option>
                            <?php $clientes = Utils::showClientes() ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?= $cliente['Cliente'] ?>"><?= $cliente['Nombre_Cliente'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Contacto">Contacto</label>
                        <select class="form-control" name="Contacto"></select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Razon">Razón social</label>
                        <select class="form-control" name="Razon"></select>
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
<script type="text/javascript">
    let select_clientes = document.querySelectorAll('#modal_datos_generales select')[0];
    select_clientes.addEventListener('change', e => {
        let servicio = new ServicioApoyo();
        servicio.getContactosYRazonesPorCliente(select_clientes.value);
    })
</script>