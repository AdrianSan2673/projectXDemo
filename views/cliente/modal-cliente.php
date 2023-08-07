<div class="modal fade" id="modal_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Cliente">
                    <input type="hidden" name="flag" value="1">
                    <div class="form-group">
                        <label for="Empresa" class="col-form-label">Nombre de la empresa</label>
                        <select class="form-control" name="Empresa">
                            <?php $empresas = Utils::showEmpresas();?>
                            <?php foreach ($empresas as $empresa): ?>
                                <option value="<?= $empresa['Empresa'] ?>"><?= $empresa['Nombre_Empresa'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Nombre_Cliente" class="col-form-label">Nombre del Cliente</label>
                        <input type="text" name="Nombre_Cliente" class="form-control">
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