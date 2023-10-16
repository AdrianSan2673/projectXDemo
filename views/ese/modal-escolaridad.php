<div class="modal fade" id="modal_escolaridad">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Escolaridad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Renglon">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Grado">Grado escolar</label>
                        <select name="Grado" class="form-control">
                            <option value="" hidden selected>Selecciona el grado escolar</option>
                            <?php $grados = Utils::showEscolaridades() ?>
                            <?php foreach ($grados as $g): ?>
                                <option value="<?=$g['Campo'] ?>"><?=$g['Descripcion']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Institucion">Institución</label>
                        <input type="text" name="Institucion" class="form-control" maxlength="60">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Localidad">Localidad</label>
                        <input type="text" name="Localidad" class="form-control" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Periodo">Período</label>
                        <input type="text" name="Periodo" class="form-control" maxlength="25">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Documento">Documento</label>
                        <select name="Documento" class="form-control">
                            <option value="" hidden selected>Selecciona el documento obtenido</option>
                            <?php $documentos = Utils::showDocumentosEscolaridad() ?>
                            <?php foreach ($documentos as $d): ?>
                                <option value="<?=$d['Campo'] ?>"><?=$d['Descripcion']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Folioo">Folio</label>
                        <input type="text" name="Folioo" class="form-control" maxlength="25">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Comentario_Escolaridad">Comentarios</label>
                        <textarea name="Comentario_Escolaridad" class="form-control" rows="6" maxlength="300"></textarea>
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
<!-- <div class="modal fade" id="modal_delete_escolaridad">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar escolaridad</h4>
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
</div> -->