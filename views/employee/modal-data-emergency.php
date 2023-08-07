<div class="modal fade" id="modal-data-emergency">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Datos de Emergencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group ">
                        <div class="row text-center">
                            <div class="col-12">
                                <p class=" h6">Persona 1</p>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-form-label">Nombre</label>
                            <input type="text" name="emergency_contact1" placeholder="Nombre del contacto" class="form-control" maxlength="150" value="<?= isset($employee_contacts->emergency_contact1) ? $employee_contacts->emergency_contact1 : '' ?>">
                        </div>

                        <div class="row">
                            <label class="col-form-label">Telefono</label>
                            <input type="text" name="emergency_number1" maxlength="13" class="form-control" placeholder="Ingresa tu número telefónico" data-inputmask='"mask": "999 999 9999"' data-mask value="<?= isset($employee_contacts->emergency_number1) ? $employee_contacts->emergency_number1 : '' ?>">
                        </div>

                        <div class="row">
                            <label class="col-form-label">Parentesco</label>
                            <input type="text" name="emergency_relationship1" class="form-control" maxlength="50" value="<?= isset($employee_contacts->emergency_relationship1) ? $employee_contacts->emergency_relationship1 : '' ?>" placeholder="Parentesco con el empleado">
                        </div>
                    </div>


                    <div class="form-group ">
                        <div class="row text-center">
                            <div class="col-12">
                                <p class=" h6">Persona 2</p>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-form-label">Nombre</label>
                            <input type="text" name="emergency_contact2" placeholder="Nombre del contacto" class="form-control" maxlength="150" value="<?= isset($employee_contacts->emergency_contact2) ? $employee_contacts->emergency_contact2 : '' ?>">
                        </div>

                        <div class="row">
                            <label class="col-form-label">Telefono</label>
                            <input type="text" name="emergency_number2" maxlength="13" class="form-control" placeholder="Ingresa tu número telefónico" data-inputmask='"mask": "999 999 9999"' data-mask value="<?= isset($employee_contacts->emergency_number2) ? $employee_contacts->emergency_number2 : '' ?>">
                        </div>

                        <div class="row">
                            <label class="col-form-label">Parentesco</label>
                            <input type="text" name="emergency_relationship2" class="form-control" maxlength="50" value="<?= isset($employee_contacts->emergency_relationship2) ? $employee_contacts->emergency_relationship2 : '' ?>" placeholder="Parentesco con el empleado">
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>

                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            </form>
        </div>
    </div>
</div>