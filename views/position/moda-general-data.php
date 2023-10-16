<div class="modal fade" id="modal_general">
    <div class="modal-dialog">
        <div class="modal-content ">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Datos generales</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Titulo del puesto</label>
                        <input type="text" name="title" value="<?= $position->title ?>" maxlength="40" class="form-control" required>
                    </div>


                    <div class="form-group">
                        <label class="col-form-label">Departamentos</label>
                        <select name="id_department" id="id_department" class="form-control" required>
                            <?php foreach ($deparment as $dep) : ?>
                                <option value=" <?= Encryption::encode($dep['id']) ?>" <?= $dep['id'] == $position->id_department ? 'selected' : ''  ?>><?= $dep['department']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="">Tipo de puesto</label>
                        <select name="type_position" class="form-control" required>
                            <option disabled selected value="">Selecciona tipo de puesto</option>
                            <option value="<?= Encryption::encode(1) ?>" <?= $position->type_position == 1 ? 'selected' : '' ?>>Gerencia</option>
                            <option value="<?= Encryption::encode(2) ?>" <?= $position->type_position == 2 ? 'selected' : '' ?>>Subgerencia</option>
                            <option value="<?= Encryption::encode(3) ?>" <?= $position->type_position == 3 ? 'selected' : '' ?>>Administrativo</option>
                            <option value="<?= Encryption::encode(4) ?>" <?= $position->type_position == 4 ? 'selected' : '' ?>>Supervisorios / Coordinacion</option>
                            <option value="<?= Encryption::encode(5) ?>" <?= $position->type_position == 5 ? 'selected' : '' ?>>Operativo</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="">Catálogo de ocupación</label>
                        <?php $catalogo = Utils::getCatalogoOcupaciones(); ?>
                        <select name="clave_ocupacion" class="form-control select2">
                            <option disabled selected value="">Selecciona la ocupacion</option>
                            <?php foreach ($catalogo as $cat) : ?>
                                <option value=" <?= Encryption::encode($cat['clave']) ?>" <?= $cat['clave'] == $position->clave_ocupacion ? 'selected' : ''  ?>><?= $cat['descripcion']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Puesto al que reporta</label>
                        <select name="id_boss_position" id="id_boss_position" class="form-control">
                            <?= isset($positionName) ? '<option value="">Selecciona el puesto</option>' : '<option selected value="">Selecciona el puesto</option>' ?>
                            <?php foreach ($positionBoss as $post) : ?>
                                <option value=" <?= Encryption::encode($post['id']) ?>" <?= $post['id'] == $position->id_boss_position ? 'selected' : ''  ?>><?= $post['title']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Sucursal</label>

                        <select name="ID_Cliente" id="" class="form-control" required>
                        <?php $contactos = Utils::getEmpresaByContacto(); ?>
                            <option value="" disabled selected>Selecciona sucursal</option>
                            <?php foreach ($contactos as $contacto) : ?>
                                <option value="<?= Encryption::encode( $contacto['Cliente']) ?>" <?= $contacto['Cliente']== $position->ID_Cliente?'selected':'' ?> ><?= $contacto['Nombre_Cliente'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>


                </div>

                <input type="hidden" name="id_position" value="<?= $_GET['id'] ?>">

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>