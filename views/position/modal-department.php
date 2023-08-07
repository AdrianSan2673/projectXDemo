<div class="modal fade" id="modal_department">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Crear departamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-form-label">Departamento</label>
                        <input type="text" name="department" class="form-control" value="" required>
                    </div>

                    <!-- ===[gabo 9 junio excel evaluaciones]=== -->
                    <div class="form-group">
                        <label for="gender" class="col-form-label">Sucursal*</label>
                        <?php $contactos = Utils::getEmpresaByContacto(); ?>
                        <select name="id_cliente_create" class="form-control" required>
                            <option disabled selected value="">Selecciona una sucursal</option>
                            <?php foreach ($contactos as $contacto) : ?>
                                <option value="<?= $contacto['Cliente'] ?>"><?= $contacto['Nombre_Cliente'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <!-- ===[gabo 9 junio excel evaluaciones fin]=== -->

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
                <input type="hidden" name="flag" value="1">
            </form>
        </div>
    </div>
</div>