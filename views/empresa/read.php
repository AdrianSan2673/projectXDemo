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
                            <li class="breadcrumb-item active"><?= $empresa->Nombre_Empresa ?></li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h4><b>Empresa</b> <?= $empresa->Nombre_Empresa ?></h4>
                        </div>
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
                                <h4 class="card-title">Datos de la empresa</h4>
                            </div>
                            <div class="card-body">
                                <div class="row info-empresa">
                                    <div class="col-md-6 text-center">
                                        <b>Empresa</b>
                                        <p><?= $empresa->Nombre_Empresa ?></p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <b>Alias</b>
                                        <p><?= $empresa->Alias ?></p>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <b>Especificaciones del proceso</b>
                                        <p><?= $empresa->Especificaciones ? $empresa->Especificaciones : 'SIN ESPECIFICACIONES' ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-info" id="btn-editar-empresa">Editar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card card-navy">
                            <div class="card-header">
                                <h4 class="card-title">Contactos</h4>
                            </div>
                            <div class="card-body">
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                <div class="text-right">
                                    <button class="btn btn-success" id="btn-nuevo-contacto">Crear contacto</button>
                                </div>
                                <?php endif ?>
                                <div class="table-responsive">
                                    <table id="tb_contacts" class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Puesto</th>
                                                <th>Correo</th>
                                                <th>Teléfono</th>
                                                <th>Extensión</th>
                                                <th>Celular</th>
                                                <th class="text-center">Cumpleaños</th>
                                                <!-- 15 sept -->
                                                <th>Usuario</th>
                                                <th>Contraseña</th>
                                                <th>Tipo</th>
                                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
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
                                                <td class="text-center"><?= $contacto['Fecha_Cumpleaños'] ?></td>
                                                <td><?= $contacto['Usuario'] ?></td>
                                                <!-- 15 sept -->
                                                <td><?= Utils::decrypt($contacto['password'])  ?></td>
                                                <td><?= $contacto['nombre_tipo'] ?></td>
                                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                                <td class="text-center py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-info" data-id="<?= $contacto['ID'] ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-id="<?= $contacto['ID'] ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>

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
                                        <th class="text-center">Cumpleaños</th>
                                        <th>Usuario</th>
                                        <th>Contraseña</th>
                                        <th>Tipo</th>
                                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <th></th>
                                        <?php endif ?>
                                    </tr>
                                </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
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
                            <div class="table-responsive">
                                <table id="tb_razones" class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>Razón social</th>
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
                                                <a href="<?= $razon['archivo'] ?>" target="_blank"
                                                    class="btn btn-orange">
                                                    <i class="fas fa-file-download"></i>
                                                </a>
                                                <?php endif ?>
                            </div>
                            </td>
                            <?php endif ?>
                            </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Razón social</th>
                                    <th>RFC</th>
                                    <th>Dirección Fiscal
                                    </th>
                                    <th>Contacto</th>
                                    <th>Otro</th>
                                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <th></th>
                                    <?php endif ?>
                                </tr>
                            </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="card card-orange">
                    <div class="card-header">
                        <h4 class="card-title">Clientes pertenecientes a <?= $empresa->Nombre_Empresa ?></h4>
                    </div>
                    <div class="card-body">
                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                        <div class="text-right">
                            <a href="<?= base_url ?>cliente_SA/crear&empresa=<?= $_GET['id'] ?>"
                                class="btn btn-success">Crear cliente</a>
                        </div>
                        <?php endif ?>
                        <div class="table-responsive">
                            <table id="tb_bn" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre comercial</th>
                                        <th class="text-center">Centro de costos</th>
                                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <th></th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clientes as $cliente) : ?>
                                    <tr>
                                        <td><?= $cliente['Nombre_Cliente'] ?></td>
                                        <td class="text-center"><?= $cliente['Centro_Costos'] ?></td>
                                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                        <td class="text-center py-0 align-middle">
                                            <a href="<?= base_url ?>cliente_SA/ver&id=<?= Encryption::encode($cliente['Cliente']) ?>"
                                                class="btn btn-success">
                                                <i class="fas fa-eye"></i>
                                            </a>
                        </div>
                        </td>
                        <?php endif ?>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre comercial</th>
                                <th class="text-center">Centro de costos</th>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                <th></th>
                                <?php endif ?>
                            </tr>
                        </tfoot>
                        </table>
                    </div>

                </div>
            </div>
    </div>
</div>
</div>
</section>
</div>
</div>
<script type="text/javascript" src="<?= base_url ?>app/cliente.js?v=<?= rand() ?>"></script>
<script type="text/javascript">
window.onload = function() {
    //gabo 15 sept
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
            });
            let cliente = new Cliente();
            cliente.getContacto(ID);
            //23 agosto 
            document.querySelector('#user_exists').style.display = 'none';
            document.querySelector('#email_exists').style.display = 'none';
            document.getElementById("username").setAttribute("readonly", true);
            document.getElementById("btn-duplicar-contacto").style.display = "inline";
            document.getElementById("cliente_asignado").removeAttribute("disabled");
            document.getElementById("select_empresa").style.display = "inline"; //fingabo


            document.querySelector('#modal_contacto  [name="Correo"]').removeEventListener("input",
                checkEmail);
            document.querySelector('#modal_contacto  [name="Usuario"]').removeEventListener("input",
                checkusername);
            // gabo 13 sept
            document.getElementById("password").removeAttribute("disabled");

            //23 agosto
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
        e.stopPropagation();
    })
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
    });

    document.querySelector('#modal_empresa form').addEventListener('submit', e => {
        e.preventDefault();
        let cliente = new Cliente();
        cliente.save_empresa2();
    });
}
</script>
<script type="text/javascript">
document.querySelector('#btn-editar-empresa').addEventListener('click', e => {
    e.preventDefault();
    let cliente = new Cliente();
    cliente.getEmpresa(<?= $empresa->Empresa ?>);
    $('#modal_empresa').modal({
        backdrop: 'static',
        keyboard: false
    });
})
document.querySelector('#btn-nuevo-contacto').addEventListener('click', e => {
    e.preventDefault();
    let form = document.querySelector('#modal_contacto form');
    form.reset();
    form.querySelectorAll('input')[9].placeholder = '';
    form.querySelectorAll('input')[10].placeholder = '';
    $('#modal_contacto').modal({
        backdrop: 'static',
        keyboard: false
    });
    //23 agosto
    document.querySelector('#user_exists').style.display = 'none';
    document.querySelector('#email_exists').style.display = 'none';
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

    //23 agosto
})
document.querySelector('#btn-nueva-razon').addEventListener('click', e => {
    e.preventDefault();
    document.querySelector('#modal_razon form').reset();
    document.querySelectorAll('#modal_razon input')[0].value = 0;
    document.querySelectorAll('#modal_razon input')[1].value = 0;
    $('#modal_razon').modal({
        backdrop: 'static',
        keyboard: false
    });
})
</script>