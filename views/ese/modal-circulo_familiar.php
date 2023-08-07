<div class="modal fade" id="modal_circulo-familiar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="circulo_familiar-form">
                <div class="modal-header">
                    <h4 class="modal-title">Círculo familiar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="Id" name="Id">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Nombre_Parentesco">Nombre</label>
                        <input type="text" class="form-control" name="Nombre_Parentesco" maxlength="150">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Parentesco">Parentesco</label>
                        <select name="Parentesco" class="form-control">
                            <option value="" hidden selected>Selecciona el parentesco</option>
                            <?php $parentescos = Utils::showParentescos() ?>
                            <?php foreach ($parentescos as $p): ?>
                                <option value="<?=$p['Campo'] ?>"><?=$p['Descripcion']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Telefono_Parentesco">Teléfono</label>
                        <input type="text" class="form-control" name="Telefono_Parentesco" maxlength="50">
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="Estatus" value="Vive" checked>
                        <label class="form-check-label">Vivo</label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="Estatus" value="Finado">
                        <label class="form-check-label">Finado</label>
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


<div class="modal fade" id="modal_delete_circulo-familiar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="circulo_familiar-delete-form">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar miembro del círculo familiar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Id">
                    <input type="hidden" name="Folio">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-danger" value="Eliminar">
                </div>
            </form>
        </div>
    </div>              
</div>