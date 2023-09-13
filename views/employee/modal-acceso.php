<div class="modal fade" id="modal-acceso">
    <div class="modal-dialog" style="width: 40%!important; ">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Datos de contacto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_user_rh" value="<?= isset($usuario_rh->id) && $usuario_rh->id!=NULL  ?Encryption::encode($usuario_rh->id): ''; ?>">
                    <div class="form-group ">
                        <label class="col-form-label">Usuario</label>
                        <input type="text" name="username" id="" class="form-control"
                            value="<?= $usuario_rh->username  ?>">
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Contraseña</label>
                        <input type="text" name="password" id="" class="form-control" placeholder="ejemplo@dominio.com"
                            value="<?= Encryption::decode($usuario_rh->password)  ?>">
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Status</label>
                        <div class="row">
                            <div class="col-8">
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?= ($usuario_rh->status == 1) ? 'selected' : '';  ?>>Activo
                                    </option>
                                    <option value="0" <?= ($usuario_rh->status == 0) ? 'selected' : '';  ?>>Inactivo
                                    </option>
                                </select>
                            </div>
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