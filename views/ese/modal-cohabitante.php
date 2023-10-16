<div class="modal fade" id="modal_cohabitante">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="cohabitante-form">
                <div class="modal-header">
                    <h4 class="modal-title">Cohabitante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Renglon">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Nombre">Nombre</label>
                        <input type="text" class="form-control" name="Nombre" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Parentesco">Parentesco</label>
                        <select name="Parentesco" class="form-control" required>
                            <option value="" hidden selected>Selecciona el parentesco</option>
                            <?php $parentescos = Utils::showParentescos() ?>
                            <?php foreach ($parentescos as $p): ?>
                                <option value="<?=$p['Campo'] ?>"><?=$p['Descripcion']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Edad</label>
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" name="Edad" min="0" max="99" required>
                            </div>
                            <div class="col">
                                <select class="form-control" name="Edad_2">
                                    <option value="Años">Años</option>
                                    <option value="Meses">Meses</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label class="col-form-label" for="Estado_Civil">Estado civil</label>
                        <select name="Estado_Civil" class="form-control">
                            <option value="" hidden selected>Selecciona el estado civil</option>
                            <option value="0">No asignado</option>
                            <?php $estados_civiles = Utils::showEstadosCiviles() ?>
                            <?php foreach ($estados_civiles as $p): ?>
                                <option value="<?=$p['Campo'] ?>"><?=$p['Descripcion']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Ocupacion">Ocupación</label>
                        <input type="text" class="form-control" name="Ocupacion" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Empresa">Empresa / Escuela</label>
                        <input type="text" class="form-control" name="Empresa" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">¿Es dependiente económico</label>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="Dependiente" value="1" checked>
                            <label class="form-check-label">Sí</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="Dependiente" value="0">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label class="col-form-label" for="Telefono">Teléfono</label>
                        <input type="text" class="form-control" name="Telefono" maxlength="30">
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


<div class="modal fade" id="modal_delete_cohabitante">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="cohabitante-delete-form">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar cohabitante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Renglon">
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

<div class="modal fade" id="modal_comentario_cohabitan">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Comentarios cohabitantes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <div class="form-group">
                        <label class="col-form-label" for="Comentario_Cohabitan">Comentario</label>
                        <textarea name="Comentario_Cohabitan" class="form-control" rows="7" maxlength="500"></textarea>
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