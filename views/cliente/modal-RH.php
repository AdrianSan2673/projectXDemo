<div class="modal fade" id="modal_RH">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Paquetes de clientes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Cliente">
                    <input type="hidden" name="flag" value="1">
                    <input type="hidden" name="id_moduel" value="">


                    <div id="package">

                        <div class="form-group">
                            <label class="col-form-label" for="department">Empresa</label>
                            <input type="text" class="form-control" name="Empresa" disabled>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="department">Cliente</label>
                            <input type="text" class="form-control" name="Nombre_Cliente" disabled>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="">Tipo de paquete</label>
                            <select name='id_package' class="form-control" required>
                                <option disabled selected value="">Selecciona paquete</option>
                                <?php $packages = Utils::showPackages();
                                foreach ($packages as $pack) :
                                ?>
                                    <option value="<?= $pack['id'] ?>"><?= $pack['name'] . ' (' . $pack['number_employees'] . ' )'  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <div id="cancelation" hidden>
                        <div class="form-group ">
                            <label class="col-form-label">Fecha de cancelacion</label>
                            <input type="date" name="cancellation_date" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="Comentarios">Comentarios</label>
                            <textarea name="comment"  rows="10" class="form-control"></textarea>
                        </div>
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