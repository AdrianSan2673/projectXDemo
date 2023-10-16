<div class="modal fade" id="modal_create_training">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Programa de capacitación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="">Nombre del curso</label>
                        <input type="text" name="title" id="" class="form-control" maxlength="250" value="" required>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Descripción</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Duración en horas</label>
                        <input type="number" name="hours" id="" class="form-control" value="" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Fecha de inicio</label>
                            <input type="date" name="start_date" id="" class="form-control" value="" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Fecha final</label>
                            <input type="date" name="end_date" id="" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="">Área tematica del curso</label>
                        <?php $catalogo = Utils::getCatalogoAreasTematicas(); ?>
                        <select name="clave_area_tematica" id="select_tematica" class="form-control select2" required>
                            <option disabled selected value="">Selecciona el área tematica</option>
                            <?php foreach ($catalogo as $cat) : ?>
                                <option value=" <?= $cat['clave']?>"><?= $cat['descripcion']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="training_agent" class="col-form-label">Nombre del Agente Capacitador o STPS</label>
                        <input type="text" class="form-control" name="training_agent" id="training_agent">
                    </div>
                    <div class="form-group">
                        <label for="instructor" class="col-form-label">Instructor o tutor</label>
                        <input type="text" class="form-control" name="instructor" id="instructor">
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-form-label">Empresa</label>
                        <?php $contactos = Utils::getEmpresaByContacto(); ?>
                        <select name="cliente" id="Cliente" class="form-control" required>
                            <option disabled selected value="">Selecciona comercio</option>
                            <?php foreach ($contactos as $contacto) : ?>
                                <option value="<?= $contacto['Cliente'] ?>"><?= $contacto['Nombre_Cliente'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Integrantes</label>
                        <select name="employees[]" id="select_integrantes" multiple="multiple" class="form-control select2bs4" required>
                            <?php foreach ($employees as $emplo) : ?>
                                <option value="<?= $emplo['id_employee'] ?>"> <?= $emplo['employePosition']  ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>

                <input type="hidden" name="flag" value="1">
                <input type="hidden" name="id" value="">

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>