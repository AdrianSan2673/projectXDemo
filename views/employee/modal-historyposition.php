<div class="modal fade" id="modal-historyposition">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Puesto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group ">
                        <label class="col-form-label">Fecha de puesto</label>
                        <input type="date" name="start_date" class="form-control" value="" required>
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Puesto</label>
                        <select name="id_position" id="id_position_history" class="form-control" required>
                            <option disabled value="" selected>Selecciona puesto</option>
                            <?php foreach ($positionContac as $pos) : ?>
                                <option value="<?=$pos['id']?>" ><?= $pos['title'] . ' - ' . $pos['department']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>

                <input type="hidden" name="id" value="">
                <input type="hidden" name="id_employee" value="<?= $_GET['id'] ?>">
            </form>
        </div>
    </div>
</div>