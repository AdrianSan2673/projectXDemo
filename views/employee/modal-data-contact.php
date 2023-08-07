<div class="modal fade" id="modal-data-contact">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Datos de contacto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <label class="col-form-label">Correo electronico</label>
                        <input type="email" name="email" id="" class="form-control" placeholder="ejemplo@dominio.com" value="<?= isset($employee_contacts->email) ? $employee_contacts->email : '' ?>" >
                    </div>
               
                    <div class="form-group ">
                        <label class="col-form-label">Correo electronico empresarial</label>
                        <input type="email" name="institutional_email" id="" class="form-control" placeholder="ejemplo@dominio.com" value="<?= isset($employee_contacts->institutional_email) ? $employee_contacts->institutional_email : '' ?>">
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Telefono 1</label>
                        <div class="row">
                            <div class="col-8">
                                <input type="text" name="phone_number1" id="" maxlength="13" class="form-control" placeholder="Ingresa tu número telefónico" data-inputmask='"mask": "999 999 9999"' data-mask value="<?= isset($employee_contacts->phone_number1) ? $employee_contacts->phone_number1 : '' ?>" >
                            </div>

                            <div class="col-4">
                                <select name="label1" id="" class="form-control" >
                                    <option disabled value="" selected>Etiqueta</option>
                                    <?php foreach ($arrayLabel as $key => $v) : ?>
                                        <option value="<?= $v['id']  ?>" <?= isset($employee_contacts) && is_object($employee_contacts) && $v['id'] == $employee_contacts->label1 ? 'selected' : ''; ?>    ><?= $v['label'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div> 

                    <div class="form-group ">
                        <label class="col-form-label">Telefono 2</label>
                        <div class="row">
                            <div class="col-8">
                                <input type="text" name="phone_number2" id="" maxlength="13" class="form-control" placeholder="Ingresa tu número telefónico" data-inputmask='"mask": "999 999 9999"' data-mask value="<?= isset($employee_contacts->phone_number2) ? $employee_contacts->phone_number2 : '' ?> ">
                            </div>

                            <div class=" col-4">
                                <select name="label2" id="" class="form-control">
                                    <option disabled value="" selected>Etiqueta</option>
                                    <?php foreach ($arrayLabel as $key => $v) : ?>
                                        <option value="<?= $v['id']  ?>" <?= isset($employee_contacts) && is_object($employee_contacts) && $v['id'] == $employee_contacts->label2 ? 'selected' : ''; ?>    ><?= $v['label'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>

                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="flag" value="<?= Encryption::encode(1) ?>">
            </form>
        </div>
    </div>
</div>