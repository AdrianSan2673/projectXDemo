<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left mb-2">
                            <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url ?>empresa_SA/index">Empresas</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url ?>empresa_SA/ver&id=<?= Encryption::encode($cliente->Empresa) ?>"><?= $cliente->Nombre_Empresa ?></a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?= base_url ?>cliente_SA/index">Clientes</a></li>
                            <li class="breadcrumb-item active"><?= $cliente->Nombre_Cliente ?></li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h4><b>Cliente</b> <?= $cliente->Nombre_Cliente ?></h4>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Datos del cliente</h4>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="row" id="content-nombre_cliente">
                                    <div class="col-md-6 text-center">
                                        <b>Empresa</b>
                                        <p><?= $cliente->Nombre_Empresa ?></p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <b>Alias</b>
                                        <p><?= $cliente->Nombre_Cliente ?></p>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <b>Creado por</b>
                                        <p><?= $cliente->creadopor ?></p>
                                    </div>
                                </div>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <div class="text-center">
                                        <button class="btn btn-info" id="btn-editar-cliente">Editar</button>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="card card-navy">
                            <div class="card-header">
                                <h4 class="card-title">Contactos</h4>
                            </div>
                            <div class="card-body">
                                <?php if ((Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) : ?>
                                    <div class="text-right" style="display: <?= count($razones) > 0 ? 'block' : 'none' ?>;">
                                        <button class="btn btn-success" id="btn-nuevo-contacto">Crear contacto</button>
                                    </div>
                                <?php endif ?>
                                <table id="tb_contacts" class="table table-sm table-striped  table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Puesto</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Extensión</th>
                                            <th>Celular</th>
                                            <th>Cumpleaños</th>
                                            <th>Usuario</th>

                                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                <th>Contraseña</th>
                                                <th>Tipo</th>
                                                <th></th>
                                            <?php endif ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($contactos as $contacto) : ?>
                                            <tr>
                                                <td><?= $contacto['Nombre_Contacto'] . ' ' . $contacto['Apellido_Contacto'] ?>
                                                </td>
                                                <td><?= $contacto['Puesto'] ?></td>
                                                <td><?= $contacto['Correo'] ?></td>
                                                <td><?= $contacto['Telefono'] ?></td>
                                                <td><?= $contacto['Extension'] ?></td>
                                                <td><?= $contacto['Celular'] ?></td>
                                                <td><?= $contacto['Fecha_Cumpleaños'] ?></td>
                                                <td><?= $contacto['Usuario'] ?></td>
                                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                    <td><?= Utils::decrypt($contacto['password']) ?></td>
                                                    <td><?= $contacto['nombre_tipo'] ?></td>
                                                    <td class="text-center py-0 align-middle">
                                                        <div class="btn-group btn-group-sm">

                                                            <!-- gabo 2 sept -->
                                                            <button class="btn btn-warning" data-id="<?= $contacto['Usuario'] ?>" data-nombre="<?= $contacto['Nombre_Contacto'] . " " . $contacto['Apellido_Contacto'] ?>">
                                                                <i class="fas fa-envelope"></i>
                                                            </button>
                                                            <!-- gabo 2 sept -->

                                                            <button class="btn btn-info" data-id="<?= $contacto['ID_Contacto'] ?>">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                            <button class="btn btn-danger" data-id="<?= $contacto['ID_Contacto'] ?>">
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
                                            <th>Puesto</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Extensión</th>
                                            <th>Celular</th>
                                            <th>Cumpleaños</th>
                                            <th>Usuario</th>
                                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                <th>Contraseña</th>
                                                <th>Tipo</th>
                                                <th></th>
                                            <?php endif ?>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <div class="text-center" style="display: <?= count($razones) > 0 ? 'block' : 'block' ?>;">
                                        <button class="btn btn-info" id="btn-modificar-contactos">Editar</button>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Servicios</h4>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div id="content-servicios">
                                    <div class="row">
                                        <div class="col text-center">
                                            <b>Investigación Laboral</b>
                                            <p><?= $cliente->Tiene_IL == 1 ? 'Sí' : 'No' ?></p>
                                        </div>
                                        <div class="col text-center">
                                            <b>Verificación Domiciliaria</b>
                                            <p><?= $cliente->Tiene_ESE == 1 ? 'Sí' : 'No' ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <b>Safe Operator By Ingenia</b>
                                            <p><?= $cliente->Tiene_SOI == 1 ? 'Sí' : 'No' ?></p>
                                        </div>
                                        <div class="col text-center">
                                            <b>Estudio Socioeconómico SMART</b>
                                            <p><?= $cliente->Tiene_SMART == 1 ? 'Sí' : 'No' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <div class="text-center">
                                        <button class="btn btn-info" id="btn-editar-servicios">Editar</button>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSAManager()) : ?>
                            <div class="card card-info">
                                <div class="card-header">
                                    <h4 class="card-title">Condiciones de venta</h4>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    <div id="content-condiciones">
                                        <div class="row">
                                            <div class="col text-center">
                                                <b>Validación de Licencia</b>
                                                <p><?= number_format($cliente->Validacion_Licencia, 2) ?></p>
                                            </div>
                                            <div class="col text-center">
                                                <b>RAL</b>
                                                <p><?= number_format($cliente->RAL, 2) ?></p>
                                            </div>
                                            <div class="col text-center">
                                                <b>Investigación Laboral</b>
                                                <p><?= number_format($cliente->Investigacion_L, 2) ?></p>
                                            </div>
                                            <div class="col text-center">
                                                <b>Estudio Socioeconómico</b>
                                                <p><?= number_format($cliente->ESE, 2) ?></p>
                                            </div>
                                            <div class="col text-center">
                                                <b>Estudio Socioeconómico + Visita</b>
                                                <p><?= number_format($cliente->ESE_Visita, 2) ?></p>
                                            </div>
                                            <div class="col text-center">
                                                <b>Estudio Socioeconómico(SMART)</b>
                                                <p><?= number_format($cliente->SMART, 2) ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <b>Costos especiales (paquetes)</b>
                                                <p><?= $cliente->Paquetes ?></p>
                                            </div>
                                            <div class="col text-center">
                                                <b>Días de crédito</b>
                                                <p><?= $cliente->Dias_Credito ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <div class="text-center">
                                            <button class="btn btn-info" id="btn-editar-condiciones">Editar</button>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="card card-navy">
                                <div class="card-header">
                                    <h4 class="card-title">Facturación</h4>
                                </div>
                                <div class="card-body">
                                    <div id="content-facturacion">
                                        <div class="row">
                                            <div class="col text-center">
                                                <b>Cortes de servicio</b>
                                                <p><?= $cliente->Corte_Servicio == 1 ? 'Contraentrega' : ($cliente->Corte_Servicio == 2 ? 'Semanal' : ($cliente->Corte_Servicio == 3 ? 'Quincenal' : ($cliente->Corte_Servicio == 4 ? 'Mensual' : 'Sin asignar'))) ?>
                                                </p>
                                            </div>
                                            <div class="col text-center">
                                                <b><?= $cliente->Corte_Servicio == 1 ? '' : ($cliente->Corte_Servicio == 2 ? 'Corte Semanal:' : ($cliente->Corte_Servicio == 3 ? 'Corte Quincenal: ' : ($cliente->Corte_Servicio == 4 ? 'Corte Mensual:' : ''))) ?></b>
                                                <p><?= $cliente->Corte_Servicio == 1 ? '' : ($cliente->Corte_Servicio == 2 ? 'Cada ' . $cliente->Fechas_Especificas : ($cliente->Corte_Servicio == 3 ? 'Los días ' . explode(',', $cliente->Fechas_Especificas)[0] . ' y ' . explode(',', $cliente->Fechas_Especificas)[1] : ($cliente->Corte_Servicio == 4 ? 'El día ' . $cliente->Fechas_Especificas : ''))) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <b>OC/NP</b>
                                                <p><?= $cliente->OC_NP ?></p>
                                            </div>
                                            <div class="col text-center">
                                                <b>Recepción de facturas</b>
                                                <p><?= $cliente->Recepcion_Facturas ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <b>Uso de portales</b>
                                                <p><?= $cliente->Uso_Portal == 0 ? 'Sí' : ($cliente->Uso_Portal == 1 ? 'No' : '') ?>
                                                </p>
                                            </div>
                                            <div class="col">
                                                <b>Dirección</b>
                                                <p><?= $cliente->Portal_Direccion ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <b>Usuario</b>
                                                <p><?= $cliente->Portal_Usuario ?></p>
                                            </div>
                                            <div class="col text-center">
                                                <b>Contraseña</b>
                                                <p><?= $cliente->Portal_Contraseña ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <b>Centro de costos</b>
                                                <p><?= $cliente->Centro_Costos ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <div class="text-center">
                                            <button class="btn btn-info" id="btn-editar-facturacion">Editar</button>
                                        </div>
                                    <?php endif ?>
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
                                        <button class="btn btn-success" id="btn-nueva-razon">Crear razón social</button>
                                    </div>
                                <?php endif ?>
                                <table id="tb_razones" class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>Razón Social</th>
                                            <th>RFC</th>
                                            <th>Dirección Fiscal</th>
                                            <th>Contacto</th>
                                            <th>Otro</th>
                                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                <th></th>
                                            <?php endif ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($razones as $razon) : ?>
                                            <tr>
                                                <td><?= $razon['Razon'] ?></td>
                                                <td><?= $razon['RFC'] ?></td>
                                                <td><?= $razon['Direccion_Fiscal'] ?></td>
                                                <td><?= $razon['Contacto'] ?></td>
                                                <td><?= $razon['Otro'] ?></td>
                                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                    <td class="text-center py-0 align-middle">
                                                        <button class="btn btn-info" data-id="<?= $razon['ID_Razon'] ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <?php if (isset($razon['archivo'])) : ?>
                                                            <a href="<?= $razon['archivo'] ?>" target="_blank" class="btn btn-orange">
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
                                            <th>Razón Social</th>
                                            <th>RFC</th>
                                            <th>Dirección Fiscal</th>
                                            <th>Contacto</th>
                                            <th>Otro</th>
                                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                <th></th>
                                            <?php endif ?>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <div class="text-center">
                                        <button class="btn btn-info" id="btn-modificar-razones">Añadir o quitar
                                            razones</button>
                                    </div>
                                <?php endif ?>
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
                                            <button class="btn btn-success" id="btn-nuevo-contacto-cobranza">Crear
                                                contacto</button>
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
                                                    <th></th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($contactoCobranza as $conCobranza) : ?>
                                                <tr>
                                                    <td><?= $conCobranza['Nombre'] ?></td>
                                                    <td><?= $conCobranza['Correo'] ?></td>
                                                    <td><?= $conCobranza['Telefono'] ?></td>
                                                    <td><?= $conCobranza['Extension'] ?></td>

                                                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                        <td class="text-center  align-middle">
                                                            <div class="btn-group">

                                                                <button class="btn btn-info" data-id="<?= Encryption::encode($conCobranza['id']) ?>">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </button>

                                                                <button class="btn btn-danger ml-3" data-id="<?= Encryption::encode($conCobranza['id']) ?>">
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
                                                    <th></th>
                                                <?php endif ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>



                        <?php endif ?>

                        <div class="card card-orange">
                            <div class="card-header">
                                <h4 class="card-title">Especificaciones del cliente</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="content-comentario">
                                    <?= Utils::lineBreak($cliente->Comentario) ?>
                                </div>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSAManager()) : ?>
                                    <div class="text-center">
                                        <button class="btn btn-info" id="btn-editar-comentario">Editar</button>
                                    </div>
                                <?php endif ?>
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
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
</div>
<script type="text/javascript" src="<?= base_url ?>app/cliente.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/clientecontactocobranza.js?v=<?= rand() ?>"></script>

<?php if (Utils::isSAManager()) : ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', e => {

            document.querySelector('#btn-editar-comentario').addEventListener('click', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.getComentario(<?= $cliente->Cliente ?>);
                $('#modal_comentario').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            })
        })
    </script>
<?php endif; ?>

<?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', e => {

            let table = document.querySelector('#tb_contacts');
            table.style.display = "table";
            utils.dtTable(table, true);

            document.querySelector('#tb_contacts').addEventListener('click', e => {
                if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains(
                        'btn-info')) {
                    let ID;
                    if (e.target.classList.contains('btn-info'))
                        ID = e.target.dataset.id;
                    else
                        ID = e.target.offsetParent.dataset.id;
                    $('#modal_contacto').modal({
                        backdrop: 'static',
                        keyboard: false
                    }); // inciiogaboooooooooooooooo
                    document.getElementById("username").setAttribute("readonly", true);
                    document.getElementById("btn-duplicar-contacto").style.display = "inline";
                    document.getElementById("cliente_asignado").removeAttribute("disabled");
                    document.getElementById("select_empresa").style.display = "inline"; //fingabo
                    document.querySelector('#modal_contacto  [name="Correo"]').removeEventListener("input",
                        checkEmail);
                    document.querySelector('#modal_contacto  [name="Usuario"]').removeEventListener("input",
                        checkusername);
                    document.querySelector('#user_exists').style.display = 'none';
                    document.querySelector('#email_exists').style.display = 'none';
                    // gabo 13 sept
                    document.getElementById("password").removeAttribute("disabled");


                    let cliente = new Cliente();
                    cliente.getContacto(ID);
                }
                if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
                        'btn-danger')) {
                    let ID;
                    if (e.target.classList.contains('btn-danger'))
                        ID = e.target.dataset.id;
                    else
                        ID = e.target.offsetParent.dataset.id;
                    $('#modal_delete_contacto').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    let cliente = new Cliente();
                    cliente.deleteContacto(ID);
                }



                //gabo 2 oct

                if (e.target.classList.contains('btn-warning') || e.target.offsetParent.classList.contains(
                        'btn-warning')) {
                    let Usuario;
                    let Nombre;
                    if (e.target.classList.contains('btn-warning')) {
                        Usuario = e.target.dataset.id;
                        nombre = e.target.dataset.nombre;
                    } else {
                        Usuario = e.target.offsetParent.dataset.id;
                        nombre = e.target.offsetParent.dataset.nombre;
                    }


                    $('#modal_send_email').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    document.querySelector('#modal_send_email p').textContent =
                        "¿Estás seguro de enviar el Usuario y Contraseña a " + nombre + "?";
                    document.querySelector('#modal_send_email [name="Usuario"]').value = Usuario;
                }
                //gasbo 2 oct

















                e.stopPropagation();
            })

            //=====================[RAZON]=========================================
            document.querySelector('#tb_razones').addEventListener('click', e => {
                if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains(
                        'btn-info')) {
                    let ID;
                    if (e.target.classList.contains('btn-info'))
                        ID = e.target.dataset.id;
                    else
                        ID = e.target.parentElement.dataset.id;

                    $('#modal_razon').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    let razon = new Cliente();
                    razon.getRazonSocial(ID);
                }
                e.stopPropagation();
            })


            //=====================[CUENTAS POR APGAR]=========================================

            document.querySelector('#tb_contacts_collection').addEventListener('click', e => {

                if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains(
                        'btn-info')) {

                    let ID;

                    if (e.target.classList.contains('btn-info'))
                        ID = e.target.dataset.id;
                    else
                        ID = e.target.offsetParent.dataset.id;

                    document.querySelector('#modal_cuentas [name="flag"]').value = 2
                    document.querySelector('#modal_cuentas [name="id"]').value = ID

                    $('#modal_cuentas').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    let clientecobranza = new Clientecobranza();
                    clientecobranza.getOne();

                }

                if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
                        'btn-danger')) {
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

                            //Eliminar
                            let ID;
                            if (e.target.classList.contains('btn-danger'))
                                ID = e.target.dataset.id;
                            else
                                ID = e.target.offsetParent.dataset.id;
                            let clientecobranza = new Clientecobranza();
                            clientecobranza.delete(ID);

                        }
                    })
                }
                e.stopPropagation();
            })


            document.querySelector('#modal_contacto form').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_contacto();
            })

            document.querySelector('#modal_delete_contacto form').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.delete_contacto();
            })

            document.querySelector('#modal_razon form').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_razon();
            })

            document.querySelector('#modal_cliente form').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_nombre_cliente();
            })

            document.querySelector('#modal_servicios').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_servicios();
            })

            document.querySelector('#modal_condiciones').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_condiciones();
            })

            document.querySelector('#modal_facturacion').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_facturacion();
            })

            document.querySelector('#modal_cuentas').addEventListener('submit', e => {
                e.preventDefault();
                let clientecobranza = new Clientecobranza();
                clientecobranza.save();
            })

            document.querySelector('#modal_comentario').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_comentario_cliente();
            })

            document.querySelector('#modal_contactos form').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_contactos_cliente();
            })

            document.querySelector('#modal_razones form').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_razones_cliente();
            })

            /*document.querySelector('#modal_nota form').addEventListener('submit', e => {
                e.preventDefault();
                let cliente = new Cliente();
                cliente.save_nota();
            })*/
        })
    </script>


    <script type="text/javascript">
        document.querySelector('#btn-editar-cliente').addEventListener('click', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.getCliente(<?= $cliente->Cliente ?>);
            $('#modal_cliente').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-editar-servicios').addEventListener('click', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.getServicios(<?= $cliente->Cliente ?>);
            $('#modal_servicios').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-editar-condiciones').addEventListener('click', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.getCondiciones(<?= $cliente->Cliente ?>);
            $('#modal_condiciones').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-editar-facturacion').addEventListener('click', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.getFacturacion(<?= $cliente->Cliente ?>);
            $('#modal_facturacion').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-nuevo-contacto-cobranza').addEventListener('click', e => {
            document.querySelector('#modal_cuentas form').reset();
            document.querySelector('#modal_cuentas [name="flag"]').value = 1;
            document.querySelector('#modal_cuentas [name="id"]').value = '';

            $('#modal_cuentas').modal({
                backdrop: 'static',
                keyboard: false
            });

            e.preventDefault();
        })

        document.querySelector('#btn-editar-comentario').addEventListener('click', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.getComentario(<?= $cliente->Cliente ?>);
            $('#modal_comentario').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-nuevo-contacto').addEventListener('click', e => {
            e.preventDefault();
            let form = document.querySelector('#modal_contacto form');
            form.reset();
            form.querySelectorAll('input')[0].removeAttribute('value');
            form.querySelectorAll('input')[1].value = 0;
            form.querySelectorAll('input')[9].placeholder = '';
            form.querySelectorAll('input')[10].placeholder = '';
            form.querySelectorAll('input')[13].value = 0;
            $('#modal_contacto').modal({
                backdrop: 'static',
                keyboard: false
            });
            document.getElementById("username").removeAttribute("readonly"); // incio gabo
            document.getElementById("btn-duplicar-contacto").style.display = "none";
            document.getElementById("cliente_asignado").setAttribute("disabled", true);
            document.getElementById("select_empresa").style.display = "none"; //fingabo
            document.querySelector('#modal_contacto [name="Usuario"]').addEventListener('input', checkusername);
            document.querySelector('#modal_contacto  [name="Correo"]').addEventListener('input', checkEmail);
            document.querySelector('#user_exists').innerHTML = '';
            document.querySelector('#email_exists').innerHTML = '';
            // gabo 13 sept
            document.getElementById("password").setAttribute("disabled", true);

        })

        document.querySelector('#btn-nueva-razon').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#modal_razon form').reset();
            $('#modal_razon').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-modificar-razones').addEventListener('click', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.getRazonesSociales(<?= $cliente->Cliente ?>, <?= $cliente->Empresa ?>);
            $('#modal_razones').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-modificar-contactos').addEventListener('click', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.getContactos(<?= $cliente->Cliente ?>, <?= $cliente->Empresa ?>);
            $('#modal_contactos').modal({
                backdrop: 'static',
                keyboard: false
            });
        })
    </script>
<?php endif ?>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', e => {
        document.querySelector('#modal_nota form').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_nota();
        })
    })
    document.querySelector('#btn-nueva-nota').addEventListener('click', e => {
        e.preventDefault();
        document.querySelector('#modal_nota form').reset();
        $('#modal_nota').modal({
            backdrop: 'static',
            keyboard: false
        });
    })
</script>