<div class="modal fade" id="modal_contacto_reclu">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="contacto-reclu-form">
                <div class="modal-header">
                    <h4 class="modal-title">Datos de contactos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <label class="col-form-label" for="first_name">Nombre</label>
                        <input type="text" class="form-control" name="first_name" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="last_name">Apellidos</label>
                        <input type="text" class="form-control" name="last_name" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="position">Puesto</label>
                        <input type="text" class="form-control" name="position" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="email">Dirección de correo electrónico</label>
                        <input type="text" class="form-control" name="email" maxlength="60" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="telephone">Teléfono</label>
                            <input type="text" class="form-control" name="telephone" maxlength="60" required>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="extension">Extension</label>
                            <input type="text" class="form-control" name="extension" maxlength="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="cellphone">Celular</label>
                        <input type="text" class="form-control" name="cellphone" maxlength="60">
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
                        <input type="text" name="username" id="username" class="form-control" maxlength="40" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Contraseña</label>
                        <input type="text" name="password" class="form-control" required>
                    </div>

                    <input type="hidden" name="id_customer" id="id_customer" value="">
                    <input type="hidden" name="id_user" id="id_user">
                    <input type="hidden" name="id_contact" id="id_contact">
                    <input type="hidden" name="flag" value="0" id="flag">
                    <!-- <?php // if (Utils::isSales()||Utils::isAdmin()) : 
                            ?>     -->
                    <div class="form-group" id="select_empresa">
                        <label for="customer" class="col-form-label">Empresa</label>
                        <?php $customers = Utils::showCustomers(); ?>
                        <select name="cliente_asignado" id="cliente_asignado" class="form-control select2">
                            <?php $clientes = !Utils::isCustomerSA() ? Utils::showClientes() : Utils::showClientesPorUsuario() ?>
                            <option value="" hidden selected></option>
                            <?php foreach ($clientes as $cliente) : ?>
                                <option value="<?= $cliente['Empresa'] ?>"><?= $cliente['Nombre_Cliente'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <!-- <?php // endif; 
                            ?> -->


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" name="duplicar_candidato" class="btn btn-orange bn_duplicate" id="btn-duplicar-contacto" value="Migrar a SA">
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_delete_contacto2">
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
                    <input type="hidden" name="id">
                    <input type="hidden" name="id_customer" value="">
                    <input type="hidden" name="username">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-danger" value="Eliminar">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- gabo 2 oct -->
<div class="modal fade" id="modal_send_email">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Enviar Correo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="display:flex">
                    <input type="hidden" name="Usuario" id="Usuario">
                    <p id="texto"> </p>
                    <img id="imagen" hidden src="<?= base_url ?>dist/img/sending.gif" style="max-width: 200px; max-height: 200px;margin:auto" border="0">


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" name="btn_send_email" id="btn_send_email" class="btn btn-orange" value="Enviar">
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    //gabo 2 oct


    document.querySelector('#btn_send_email').addEventListener('click', e => { //gabo duplicar
        e.preventDefault();

        document.getElementById("btn_send_email").disabled = true;
        document.getElementById("btn_send_email").value = 'Enviando';
        document.getElementById("texto").hidden = true;
        document.getElementById("imagen").hidden = false;
        let user = new User();
        var respuesta = user.Send_Email();


    })








    document.querySelector('#modal_contacto_reclu').addEventListener('submit', e => {
        e.preventDefault();
        let contact = new CustomerContact();

        if (document.querySelector("#flag").value == 0) {
            contact.save_modal();
        } else {
            contact.update_modal();
        }
    });

    document.querySelector('#btn-duplicar-contacto').addEventListener('click', e => { //gabo duplicar a sa
        e.preventDefault();
        let cliente = new CustomerContact();
        cliente.duplicate_Contact();
    })
</script>