<div class="modal fade" id="modal_general">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Datos generales</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-4">
                            <label class="col-form-label">Nombre</label>
                            <input type="text" name="first_name" value="<?= $employee->first_name ?>" class="form-control" maxlength="40" required>
                        </div>
                        <div class="form-group col-4">
                            <label class="col-form-label">Apellido Paterno</label>
                            <input type="text" name="surname" value="<?= $employee->surname ?>" class="form-control" maxlength="40" required>
                        </div>
                        <div class="form-group col-4">
                            <label class="col-form-label">Apellido Materno</label>
                            <input type="text" name="last_name" value="<?= $employee->last_name ?>" class="form-control" maxlength="40" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gender" class="col-form-label">Sexo</label>
                                <?php $genders = Utils::showGenders(); ?>
                                <select name="id_gender" id="id_gender" class="form-control" required>
                                    <option disabled value="" selected>Selecciona sexo</option>
                                    <?php foreach ($genders as $gender) : ?>
                                        <option value="<?= $gender['id'] ?>" <?= isset($employee) && is_object($employee) && $gender['id'] == $employee->id_gender ? 'selected' : ''; ?>><?= $gender['gender'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label">Estado Civíl</label>
                            <select name="civil_status" class="form-control">
                                <option disabled value="" selected>Selecciona estado civil</option>
                                <option value="Casado(a)" <?= $employee->civil_status == 'Casado(a)' ? 'selected' : ''; ?>>Casado(a)</option>
                                <option value="Divorciado(a)" <?= $employee->civil_status == 'Divorciado(a)' ? 'selected' : ''; ?>>Divorciado(a)</option>
                                <option value="Soltero(a)" <?= $employee->civil_status == 'Soltero(a)' ? 'selected' : ''; ?>>Soltero(a)</option>
                                <option value="Union libre" <?= $employee->civil_status == 'Union libre' ? 'selected' : ''; ?>>Union libre</option>
                                <option value="Viudo" <?= $employee->civil_status == 'Viudo' ? 'selected' : ''; ?>>Viudo</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label class="col-form-label">Titulo profesional</label>
                            <input type="text" name="scholarship" value="<?= isset($employee->scholarship) ? $employee->scholarship : ''  ?>" class="form-control">
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group col-6">
                            <label class="col-form-label">CURP</label>
                            <input type="text" name="curp" value="<?= isset($employee->curp) ? $employee->curp : ''  ?>" class="form-control" maxlength="18">
                        </div>


                        <div class="form-group col-6">
                            <label for="contract" class="col-form-label">Numero de empleado</label>
                            <input type="number" name="employee_number" minlength="0" class="form-control" value="<?= isset($employee->employee_number) ?  $employee->employee_number : '' ?>">
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label class="col-form-label">NSS</label>
                            <input type="text" name="nss" value="<?= isset($employee->nss) ? $employee->nss : ''  ?>" class="form-control" maxlength="11">
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label">RFC</label>
                            <input type="text" name="rfc" value="<?= isset($employee->rfc) ? $employee->rfc : ''  ?>" class="form-control" maxlength="13">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label class="col-form-label">Fecha de nacimiento</label>
                            <input type="date" name="date_birth" id="date_birth" class="form-control" value="<?= $employee->date_birth  ?>" required>
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label">Fecha de contratacion</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $employee->start_date  ?>" required>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-6">
                            <label class="col-form-label">Empresa contratante</label>
                            <?php $contactos = Utils::getEmpresaByContacto(); ?>
                            <select name="cliente" id="Cliente" class="form-control" required>
                                <option disabled value="">Selecciona comercio</option>
                                <?php foreach ($contactos as $contacto) : ?>
                                    <option value="<?= $contacto['Cliente'] ?>" <?= $employee->Cliente == $contacto['Cliente'] ? 'selected' : ''  ?>><?= $contacto['Nombre_Cliente'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label class="col-form-label" for="id_razon">Razón social</label>
                            <?php $razon_social = Utils::showRazonesSocialesPorCliente($employee->Cliente); ?>
                            <select class="form-control" name="id_razon" id="select_razon_social" required>
                                <?php if ($razon_social) : ?>
                                    <option  value="">Selecciona comercio</option>
                                    <?php foreach ($razon_social as $razson) : ?>
                                        <option value="<?= $razson['ID_Razon'] ?>" <?= $employee->id_razon == $razson['ID_Razon'] ? 'selected' : ''  ?>><?= $razson['Razon'] ?></option>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-form-label">Puesto</label>
                        <select name="id_position" id="id_position" class="form-control" required>
                            <option disabled value="">Selecciona puesto</option>
                            <?php foreach ($positionContac as $pos) : ?>
                                <option value="<?= Encryption::encode($pos['id']) ?>" <?= $employee->id_position == $pos['id'] ? 'selected' : ''  ?>><?= $pos['title'] . ' - ' . $pos['department']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contract" class="col-form-label">A quien reporta*</label>
                        <select class="form-control" name="id_boss" required>
                          <option selected value="0">Selecciona a quien reporta</option>
                          <?php foreach ($type_positions as $type_pos) : ?>
                            <option value="<?= Encryption::encode($type_pos['id_employee']) ?>" <?= $employee->id_boss == $type_pos['id_employee'] ? 'selected' : ''  ?>> <?= $type_pos['employePosition'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                    <div class="divReasion" <?= isset($employee->end_date) ? '' : 'hidden' ?>>
                        <div class="form-group ">
                            <label class="col-form-label">Fecha de terminacion</label>
                            <input type="date" name="end_date" id="end_date" class="form-control end_date2" value="<?= isset($employee->end_date) ? $employee->end_date : ''  ?>" <?= $employee->status == 0 ? 'required' : '' ?>>
                        </div>

                        <label for="reason_for_leaving" class="col-form-label">Razón de baja</label>
                        <select class="form-control" name="reason_for_leaving" id="selectreason_for_leaving" <?= $employee->status == 0 ? 'required' : '' ?>>
                            <option disabled selected value="">Selecciona razon de baja</option>
                            <option value="Abandono del empleo" <?= $employee->reason_for_leaving == 'Abandono del empleo' ? 'selected' : '';  ?>>Abandono del empleo</option>
                            <option value="Baja con causal" <?= $employee->reason_for_leaving == 'Baja con causal del empleo' ? 'selected' : '';  ?>>Baja con causal</option>
                            <option value="Cambio de residencia" <?= $employee->reason_for_leaving == 'Cambio de residencia' ? 'selected' : '';  ?>>Cambio de residencia</option>
                            <option value="Recorte de personal" <?= $employee->reason_for_leaving == 'Recorte de personal' ? 'selected' : '';  ?>>Recorte de personal</option>
                            <option value="Reestructura de la empresa" <?= $employee->reason_for_leaving == 'Reestructura de la empresa' ? 'selected' : '';  ?>>Reestructura de la empresa</option>
                            <option value="Renuncia voluntaria" <?= $employee->reason_for_leaving == 'Renuncia voluntaria' ? 'selected' : '';  ?>>Renuncia voluntaria</option>
                        </select>

                        <div class="form-group">
                            <label for="comment_for_leaving" class="col-form-label">Razón de baja</label>
                            <textarea class="form-control comment_for_leaving" name="comment_for_leaving" rows="8" <?= $employee->status == 0 ? 'required' : '' ?>><?= $employee->comment_for_leaving  ?> </textarea>
                        </div>

                    </div>

                    <div class="form-group divRe_entrry_date" <?= isset($employee->re_entry_date) ? '' : 'hidden' ?>>
                        <label class="col-form-label">Fecha de recontratacion</label>
                        <input type="date" name="re_entry_date" id="re_entry_date" class="form-control " value="<?= isset($employee->re_entry_date) ? $employee->re_entry_date : ''  ?>" <?= $employee->status == 0 ? 'required' : '' ?>>
                    </div>
                    
                </div>

                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="ID_Contacto" value="<?= Encryption::encode($id_contacto)  ?>">
                <input type="hidden" name="Empresa" value="<?= Encryption::encode($Empresa)  ?>">
                <input type="hidden" name="flag" value="<?= Encryption::encode(1) ?>">

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>