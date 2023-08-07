<div class="modal fade" id="modal_enseres">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Enseres</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <h6>Electrónicos</h6>
                    <br>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Computadoras">Computadoras</label>
                            <input type="number" min="0" name="Computadoras" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Pantallas">Pantallas</label>
                            <input type="number" min="0" name="Pantallas" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Laptop">Laptop</label>
                            <input type="number" min="0" name="Laptop" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Impresoras">Impresoras</label>
                            <input type="number" min="0" name="Impresoras" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <h6>Línea blanca</h6>
                    <br>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Refrigerador">Refrigerador</label>
                            <input type="number" min="0" name="Refrigerador" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Estufa">Estufa</label>
                            <input type="number" min="0" name="Estufa" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Aire_Acondicionado">Aire Acondicionado</label>
                            <input type="number" min="0" name="Aire_Acondicionado" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Lavadora">Lavadora</label>
                            <input type="number" min="0" name="Lavadora" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label class="col-form-label" for="Secadora">Secadora</label>
                            <input type="number" min="0" name="Secadora" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <br>
                    <div class="form-group col">
                        <label class="col-form-label" for="Otros">Otros</label>
                        <input type="text" name="Otros" class="form-control" maxlength="150">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Mobiliario">Mobiliario</label>
                        <select class="form-control" name="Mobiliario">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Comentarios">Comentarios</label>
                        <textarea class="form-control" name="Comentarios" rows="3" maxlength="255"></textarea>
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