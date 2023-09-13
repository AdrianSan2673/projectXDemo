<div class="modal fade" id="modal_contacto">
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
                    <input type="hidden" name="ID_Contacto">
                    <input type="hidden" name="flag" value="0">
                    <div class="form-group">
                        <label class="col-form-label" for="Nombre_Contacto">Nombre</label>
                        <input type="text" class="form-control" name="Nombre_Contacto" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Apellido_Contacto">Apellidos</label>
                        <input type="text" class="form-control" name="Apellido_Contacto" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Puesto">Puesto</label>
                        <input type="text" class="form-control" name="Puesto" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Correo">Dirección de correo electrónico</label>
                        <input type="text" class="form-control" name="Correo" id="email" maxlength="60" required>
						<div id="email_exists" style="display:none"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Telefono">Teléfono</label>
                            <input type="text" class="form-control" name="Telefono" maxlength="60" required>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Extension">Extension</label>
                            <input type="text" class="form-control" name="Extension" maxlength="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Celular">Celular</label>
                        <input type="text" class="form-control" name="Celular" maxlength="60">
                    </div>
                    <label class="col-form-label">Fecha de nacimiento</label>
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <select id="Dia" name="Dia" class="form-control" required>
                                    <option value="" hidden selected>Día</option>
                                    <?php foreach (range(1, 31) as $i) : ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <select id="Mes" name="Mes" class="form-control" required>
                                    <option value="" hidden selected>Mes</option>
                                    <?php $months = Utils::getMonths(); ?>
                                    <?php foreach ($months as $i => $m) : ?>
                                        <option value="<?= $i + 1 ?>"><?= $m ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Usuario</label>
                        <input type="text" name="Usuario" id="username" class="form-control" maxlength="40" required  >
						<div id="user_exists" style="display: none"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Contraseña</label>
                        <input type="text" name="Password" id="password" class="form-control" required>
                    </div>
                    <input type="hidden" name="Empresa" value="<?= $_GET['controller'] == 'cliente_SA' ? $cliente->Empresa : Encryption::decode($_GET['id']) ?>">
                    <input type="hidden" name="ID_Cliente" value="<?= $_GET['controller'] == 'cliente_SA' ? $_GET['id'] : 0 ?>">
                    <input type="hidden" name="user_flag">
                    <!-- id 82 -->
                    <!-- id contacto 1077 -->

                    <!-- <?php // if (Utils::isSales()||Utils::isAdmin()) : ?>     -->
                        <div class="form-group" id="select_empresa">  
                            <label for="customer" class="col-form-label">Empresa</label>
                            <?php $customers = Utils::showCustomers(); ?>
                            <select name="cliente_asignado" id="cliente_asignado" class="form-control select2" >
                                <option disabled selected="selected"></option>
                                <?php foreach ($customers as $customer) : ?>
                                    <option value="<?= $customer['id'] ?>"><?= $customer['customer'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <!-- <?php // endif; ?> -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" name="duplicar_candidato" class="btn btn-orange bn_duplicate" id="btn-duplicar-contacto" value="Migrar a Reclu">
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_delete_contacto">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar contacto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ID_Contacto">
                    <input type="hidden" name="Empresa" value="<?= $_GET['controller'] == 'cliente_SA' ? $cliente->Empresa : Encryption::decode($_GET['id']) ?>">
                    <input type="hidden" name="ID_Cliente" value="<?= $_GET['controller'] == 'cliente_SA' ? $_GET['id'] : 0 ?>">
                    <input type="hidden" name="Usuario">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>



<script>

     document.querySelector('#btn-duplicar-contacto').addEventListener('click', e => {   //gabo duplicar
        e.preventDefault();
        let cliente = new Cliente();
        cliente.duplicate_contact();
    })
	
	  const checkusername = () => {
        let user = new User();
        user.checkUsernameWithInfo();

    };

    const checkEmail = () => {
        let user = new User();
        user.checkEmailWithInfo();

    };
</script>