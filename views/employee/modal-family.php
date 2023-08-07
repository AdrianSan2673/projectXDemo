<div class="modal fade" id="modal_family">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva familiar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="department">Nombre del familiar</label>
                        <input type="text" class="form-control" name="name" maxlength="70" >
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="department">Edad</label>
                        <input type="number" minlength="0" min="0" class="form-control" name="age">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="department"  class="col-form-label" >Parentesco</label>
                        <select name="type" class="form-control" required>
                            <option disabled selected value="">Selecciona el parentesco</option>
                            <option value="1">Esposa</option>
                            <option value="2">Esposo</option>
                            <option value="3">Hija</option>
                            <option value="4">Hijo</option>
                            <option value="5">Madre</option>
                            <option value="6">Padre</option>
                        </select>

                    </div>


                </div>

                <input type="hidden" name="flag" id="flag" value="1">
                <input type="hidden" name="id_employee" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="id" value="">

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>