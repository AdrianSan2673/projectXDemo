<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h4><?= $cliente->customer ?>.</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 mr-auto">
                        <a class="btn btn-secondary btn-block float-left" href="<?= base_url ?>cliente/index">Regresar</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h4 class="card-title">Datos del cliente</h4>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <b>Empresa</b>
                                        <p><?= $cliente->customer ?></p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <b>Alias</b>
                                        <p><?= $cliente->alias ?></p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <b>Centro de costos</b>
                                        <p><?= $cliente->cost_center ?></p>
                                    </div>
                                </div>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <div class="text-center">
                                        <a href="<?= base_url ?>cliente/editar&id=<?= $_GET['id'] ?>" class="btn btn-info">Editar</a>
                                    </div>
                                <?php endif ?>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card card-orange">
                            <div class="card-header">
                                <h4 class="card-title">Contactos</h4>
                            </div>
                            <div class="card-body">
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <div class="text-right">
                                        <a href="<?= base_url ?>clientecontacto/crear&id=<?= $_GET['id'] ?>" class="btn btn-success">Crear contacto</a>
                                        <a class="btn btn-warning btn-modal-crear" hidden id="btn_contacto_modal" data-id="<?= $_GET['id'] ?>">Crear contacto modal</a>
                                    </div>
                                <?php endif ?>
                                <table id="tb_contacts" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre Completo</th>
                                            <th>Puesto</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Extensión</th>
                                            <th>Celular</th>
                                            <th>Cumpleaños</th>
                                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                <th>Usuario</th>
                                                <th>Accion</th>
                                            <?php endif ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($contacts as $c) : ?>
                                            <tr>
                                                <td><?= $c['first_name'] ?> <?= $c['last_name'] ?></td>
                                                <td><?= $c['position'] ?></td>
                                                <td><?= $c['email'] ?></td>
                                                <td><?= $c['telephone'] ?></td>
                                                <td><?= $c['extension'] ?></td>
                                                <td><?= $c['cellphone'] ?></td>
                                                <td><?= $c['birthday'] ?></td>
                                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                    <td><?= $c['username'] ?></td>
                                                    <td class="text-center py-0 align-middle">
                                                        <div class="btn-group btn-group-sm">
                                                            <!--  ////////////////////////////////// INICIO GABO  /////////////////////////////////   -->
                                                            <button class="btn btn-info btn-modal" data-id="<?= Encryption::encode($c['id']) ?>">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-danger" data-id="<?= Encryption::encode($c['id']) ?>">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <!--  ////////////////////////////////// FIN GABO  /////////////////////////////////   -->
                                                        </div>
                                                    </td>
                                                <?php endif ?>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre Completo</th>
                                            <th>Puesto</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Extensión</th>
                                            <th>Celular</th>
                                            <th>Cumpleaños</th>
                                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                <th>Usuario</th>
                                                <th></th>
                                            <?php endif ?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>




                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSAManager() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount()) : ?>
                            <div class="card card-navy">
                                <div class="card-header">
                                    <h4 class="card-title">Cuentas por pagar</h4>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">

                                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <div class="text-right">
                                            <button class="btn btn-success" id="btn-nuevo-contacto-cobranza">Crear contacto</button>
                                        </div>
                                    <?php endif ?>

                                    <table id="tb_contacts_collection" class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Teléfono</th>
                                                <th>Extensión</th>
                                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                    <th>Accion</th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($CustomerContactsCollection as $CustomerContacts) : ?>
                                                <tr>
                                                    <td><?= $CustomerContacts['name'] ?></td>
                                                    <td><?= $CustomerContacts['email'] ?></td>
                                                    <td><?= $CustomerContacts['phone'] ?></td>
                                                    <td><?= $CustomerContacts['extension'] ?></td>

                                                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                        <td class="text-center  align-middle">
                                                            <div class="btn-group">

                                                                <button class="btn btn-info" data-id="<?= Encryption::encode($CustomerContacts['id']) ?>">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </button>

                                                                <button class="btn btn-danger ml-3" data-id="<?= Encryption::encode($CustomerContacts['id']) ?>">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>

                                                            </div>
                                                        </td>
                                                    <?php endif ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Teléfono</th>
                                                <th>Extensión</th>
                                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                    <th>Accion</th>
                                                <?php endif ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        <?php endif ?>


                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Razones sociales</h4>
                            </div>
                            <div class="card-body">
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <div class="text-right">
                                        <a href="<?= base_url ?>businessname/crear&id=<?= $_GET['id'] ?>" class="btn btn-success">Crear razón social</a>
                                    </div>
                                <?php endif ?>
                                <table id="tb_bn" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Razón social</th>
                                            <th>RFC</th>
                                            <th>Dirección fiscal</th>
                                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                <th></th>
                                            <?php endif ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($business_names as $bn) : ?>
                                            <tr>
                                                <td><?= $bn['business_name'] ?></td>
                                                <td><?= $bn['RFC'] ?></td>
                                                <td><?= $bn['fiscal_address'] ?></td>
                                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                    <td class="text-center py-0 align-middle">
                                                        <a href="<?= base_url ?>businessname/editar&id=<?= Encryption::encode($bn['id']) ?>" class="btn btn-info">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <?php if (isset($bn['file'])) : ?>
                                                            <a href="<?= $bn['file'] ?>" target="_blank" class="btn btn-orange">
                                                                <i class="fas fa-file-download"></i>
                                                            </a>
                                                        <?php endif ?>
                                                    </td>
                                                <?php endif ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Razón social</th>
                                            <th>RFC</th>
                                            <th>Dirección fiscal</th>
                                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                <th></th>
                                            <?php endif ?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                            <div class="card card-success">
                                <div class="card-header">
                                    <h4 class="card-title">Condiciones de venta</h4>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col text-center">
                                            <b>Cuota de reclutamiento</b>
                                            <p><?= $cliente->recruitment_fee ?></p>
                                        </div>
                                        <div class="col text-center">
                                            <b>Psicometrías</b>
                                            <p>$ <?= number_format($cliente->price_for_psychometrics, 2) ?></p>
                                        </div>
                                        <div class="col text-center">
                                            <b>Atracción de talento 3.0</b>
                                            <p>$ <?= number_format($cliente->price_for_talent_attraction, 2) ?></p>
                                        </div>
                                        <div class="col text-center">
                                            <b>Días de crédito</b>
                                            <p><?= $cliente->credit_days ?></p>
                                        </div>
                                        <div class="col text-center">
                                            <b>Cortes de servicio</b>
                                            <p><?= $cliente->box_cut == 1 ? 'Contraentrega' : ($cliente->box_cut == 2 ? 'Semanal' : ($cliente->box_cut == 3 ? 'Quincenal' : ($cliente->box_cut == 4 ? 'Mensual' : ''))) ?></p>
                                        </div>
                                    </div>
                                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <div class="text-center">
                                            <a href="<?= base_url ?>cliente/condiciones&id=<?= $_GET['id'] ?>" class="btn btn-info">Editar</a>
                                        </div>
                                    <?php endif ?>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        <?php endif ?>
                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount()) : ?>
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h4 class="card-title">Evaluaciones</h4>
                                </div>
                                <div class="card-body">
                                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <div class="text-right">
                                            <a href="<?= base_url ?>cliente/evaluar&id=<?= $_GET['id'] ?>" class="btn btn-success">Nueva evaluación</a>
                                        </div>
                                    <?php endif ?>
                                    <table id="tb_ev" class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">Fecha</th>
                                                <!-- <th class="align-middle text-center">Tiempo de respuesta</th> -->
                                                <th class="align-middle text-center">Tiempo de recepción de candidatos</th>
                                                <th class="align-middle text-center">Comunicación con su ejecutivo</th>
                                                <th class="align-middle text-center">Amabilidad de su ejecutivo</th>
                                                <th class="align-middle text-center">Calidad de los candidatos</th>
                                                <th class="align-middle text-center">Total</th>
                                                <th class="align-middle text-center">Comentarios</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($evaluation_names as $ev) : ?>
                                                <tr>
                                                    <td class="text-center"><?= Utils::getFullDate($ev['created_at']) ?></td>
                                                    <!-- <td class="text-center"></td> -->
                                                    <td class="text-center"><?= $ev['reception_time'] ?></td>
                                                    <td class="text-center"><?= $ev['communication_with_executive'] ?></td>
                                                    <td class="text-center"><?= $ev['executive_friendliness'] ?></td>
                                                    <td class="text-center"><?= $ev['quality_of_candidates'] ?></td>
                                                    <td class="text-center"><b><?= number_format($ev['score'], 1) ?></b></td>
                                                    <td><?= $ev['comments'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="align-middle text-center">Fecha</th>
                                                <!-- <th class="align-middle text-center">Tiempo de respuesta</th> -->
                                                <th class="align-middle text-center">Tiempo de recepción de candidatos</th>
                                                <th class="align-middle text-center">Comunicación con su ejecutivo</th>
                                                <th class="align-middle text-center">Amabilidad de su ejecutivo</th>
                                                <th class="align-middle text-center">Calidad de los candidatos</th>
                                                <th class="align-middle text-center">Total</th>
                                                <th class="align-middle text-center">Comentarios</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="card card-navy">
                                <div class="card-header">
                                    <h4 class="card-title">Notas</h4>
                                </div>
                                <div class="card-body">
                                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount()) : ?>
                                        <div class="text-right">
                                            <button class="btn btn-success" id="btn-nueva-nota">Crear nota</button>
                                        </div>
                                    <?php endif ?>
                                    <div id="tb_notas" class="card-footer card-comments mt-5">
                                        <?php foreach ($notas as $nota) : ?>
                                            <div class="card-comment">
                                                <img src="<?= $nota['avatar'] ?>" class="img-circle img-sm">
                                                <div class="comment-text">
                                                    <span class="username">
                                                        <?= $nota['first_name'] . ' ' . $nota['last_name'] ?>
                                                        <span class="text-muted float-right"><?= $nota['Fechaa'] ?></span>
                                                    </span>
                                                    <?= Utils::lineBreak($nota['Comentarios']) ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

</div>
<script type="text/javascript" src="<?= base_url ?>app/cliente.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/clientecontactocobranza.js?v=<?= rand() ?>"></script>

<!-- ////////////////////////////////////////////   INICIO GABO   ///////////////////////////////////////////////////////////////// -->
<script type="text/javascript" src="<?= base_url ?>app/customercontact.js?v=<?= rand() ?>"></script>
<script>
    $(document).ready(function() {
        let table = document.querySelector('#tb_bn');
        let table2 = document.querySelector("#tb_contacts");
        utils.dtTable(table);
        utils.dtTable(table2);

        document.querySelector('#btn-nueva-nota').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#modal_nota form').reset();
            $('#modal_nota').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#modal_collection').addEventListener('submit', e => {
            e.preventDefault();
            let clientecobranza = new Clientecobranza();
            clientecobranza.saveReclu();
        })

        document.querySelector('#modal_nota form').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_nota();
        })

        document.querySelector('#btn-nuevo-contacto-cobranza').addEventListener('click', e => {
            document.querySelector('#modal_collection form').reset();
            document.querySelector('#modal_collection [name="flag"]').value = 1;
            document.querySelector('#modal_collection [name="id"]').value = '';

            $('#modal_collection').modal({
                backdrop: 'static',
                keyboard: false
            });

            e.preventDefault();
        })

    });

    document.addEventListener('DOMContentLoaded', e => { //gabo 24

        document.querySelector('#tb_contacts').addEventListener('click', e => {

            if (e.target.classList.contains('btn-modal') || e.target.offsetParent.classList.contains('btn-modal')) {
                let ID;
                if (e.target.classList.contains('btn-info'))
                    ID = e.target.dataset.id;
                else
                    ID = e.target.offsetParent.dataset.id;
                $('#modal_contacto_reclu').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                let cliente = new CustomerContact();
                let form = document.querySelector('#modal_contacto_reclu form');
                form.reset();
                document.getElementById("flag").value = 1;
                cliente.getContacto(ID);

                //gaboooooooooooooooo
                document.getElementById("username").setAttribute("readonly", true);
                document.getElementById("btn-duplicar-contacto").style.display = "inline";
                document.getElementById("cliente_asignado").removeAttribute("disabled");
                $("#cliente_asignado").val('').trigger('change')

                document.getElementById("select_empresa").style.display = "inline"; //fingabo
            }


            if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) { //gabo
                let ID;
                if (e.target.classList.contains('btn-danger'))
                    ID = e.target.dataset.id;
                else
                    ID = e.target.offsetParent.dataset.id;
                $('#modal_delete_contacto2 ').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                let cliente = new CustomerContact();
                cliente.deleteContacto_modal(ID);
            }
            e.stopPropagation();

        });

        document.querySelector('#btn_contacto_modal').addEventListener('click', e => { ///gabo
            e.preventDefault();

            $('#modal_contacto_reclu').modal({
                backdrop: 'static',
                keyboard: false
            });


            let form = document.querySelector('#modal_contacto_reclu form');

            form.reset();
            let id_cutomer;

            document.getElementById("username").removeAttribute("readonly", true);
            if (e.target.classList.contains('btn-modal-crear'))
                id_customer = e.target.dataset.id;
            else
                id_customer = e.target.offsetParent.dataset.id;

            let input_customer = document.getElementById("id_customer").value = id_customer;


            document.getElementById("username").removeAttribute("readonly"); //gabo
            document.getElementById("btn-duplicar-contacto").style.display = "none";
            document.getElementById("cliente_asignado").setAttribute("disabled", true);
            document.getElementById("select_empresa").style.display = "none"; //fingabo
            form.querySelector('[name="id_customer"]').value = ''
            form.querySelector('[name="id_user"]').value = ''
            form.querySelector('[name="id_contact"]').value = ''
            form.querySelector('[name="flag"]').value = '0'
        });


        document.querySelector('#modal_delete_contacto2 form').addEventListener('submit', e => { //gabo
            e.preventDefault();
            let cliente = new CustomerContact();
            cliente.delete_contacto_modal();
        })

        ////////////////////////////////////////////   FIN GABO   ///////////////////////////////////////////////////////////////// 




        //=====================[CUENTAS POR APGAR]=========================================
        document.querySelector('#tb_contacts_collection').addEventListener('click', e => {
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {

                let ID;
                if (e.target.classList.contains('btn-info'))
                    ID = e.target.dataset.id;
                else
                    ID = e.target.offsetParent.dataset.id;

                document.querySelector('#modal_collection [name="flag"]').value = 2
                document.querySelector('#modal_collection [name="id"]').value = ID
                $('#modal_collection').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                let clientecobranza = new Clientecobranza();
                clientecobranza.getOneReclu();

            }

            if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {
                Swal.fire({
                    title: '¿Quieres eliminar este contacto?',
                    text: "Se eliminara permanetemente y ya no aparecera en la lista.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        let ID;
                        if (e.target.classList.contains('btn-danger'))
                            ID = e.target.dataset.id;
                        else
                            ID = e.target.offsetParent.dataset.id;
                        let clientecobranza = new Clientecobranza();
                        clientecobranza.deleteReclu(ID);
                    }
                })
            }
            e.stopPropagation();
        })

    });
</script>