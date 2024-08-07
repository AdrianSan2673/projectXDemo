<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left mb-2">
                            <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url ?>departamento/index">Departamentos</a></li>
                            <li class="breadcrumb-item active title-departament"><?= $departamento->department ?></li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h4><b>Departamento</b>
                                <span class="title-departament">
                                    <?= $proyecto->Nombre ?>
                                </span>
                            </h4>
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
                                <h4 class="card-title">Datos del departamento</h4>
                            </div>
                            <div class="card-body">
                                <div class="row info-empresa">
                                    <div class="col-md-12 text-center">
                                        <b>Departamento</b>
                                        <p class="title-departament"><?= $departamento->department ?></p>
                                    </div>
                                </div>
                                <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                    <div class="text-center">
                                        <button class="btn btn-info" id="btn-editar-departamento">Editar</button>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>


                        <div class="card card-navy">
                            <div class="card-header">
                                <h4 class="card-title">Empleados</h4>
                            </div>
                            <div class="card-body">
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <?php if (Utils::permission($_GET['controller'], 'create')) : ?>
                                        <div class="text-right">
                                            <button class="btn btn-success" id="btn-nuevo-contacto">Nuevo Empleado</button>
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>

                                <div class="table-responsive">
                                    <table id="tb_employees" class="table table-responsive table-striped table-sm" style="display: none;">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle">Nombre</th>
                                                <th class="text-center align-middle">Puesto</th>
                                                <th class="text-center align-middle">Edad</th>
                                                <th class="text-center align-middle">Fecha de inicio</th>
                                                <th class="text-center align-middle">Accion</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($employees as $employee) : ?>
                                                <tr>
                                                    <td class="text-center align-middle text-bold"><?= $employee['first_name'] . ' ' . $employee['surname'] . ' ' . $employee['last_name'] ?></td>
                                                    <td class="text-center align-middle"><?= $employee['title'] ?></td>
                                                    <td class="text-center align-middle"><?= $employee['date_birth']  ?> Años</td>
                                                    <td class="text-center align-middle"><?= Utils::getDate($employee['start_date']) ?></td>
                                                    <td class="text-center align-middle">
                                                        <?php if (Utils::permission($_GET['controller'], 'read')) : ?>
                                                            <a href="<?= base_url ?>empleado/ver&id=<?= Encryption::encode($employee['id_employe']) ?>" class="btn btn-success">
                                                                <i class="fas fa-eye"></i> Ver
                                                            </a>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th class="text-center align-middle">Nombre</th>
                                                <th class="text-center align-middle">Puesto</th>
                                                <th class="text-center align-middle">Edad</th>
                                                <th class="text-center align-middle">Fecha de inicio</th>
                                                <th class="text-center align-middle">Accion</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Puestos</h4>
                            </div>
                            <div class="card-body">
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                    <div class="text-right">
                                        <button class="btn btn-success" id="btn-nueva-razon">Nuevo Puesto</button>
                                    </div>
                                <?php endif ?>
                                <div class="">
                                    <table id="tb_position" class="table  table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle">Puesto</th>
                                                <th class="text-center align-middle">Objetivos</th>
                                                <th class="text-center align-middle">Creado</th>
                                                <th class="text-center align-middle">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($positions as $position) :  ?>
                                                <tr>
                                                    <td class="text-center align-middle"><?= $position['title'] ?></td>
                                                    <td class="text-center align-middle"><?= isset($position['objective']) ? $position['objective'] : 'Sin objetivos' ?></td>
                                                    <td class="text-center align-middle"><?= Utils::getDate($position['created_at']) ?></td>
                                                    <td class="text-center align-middle">
                                                        <?php if (Utils::permission($_GET['controller'], 'read')) : ?>
                                                            <a href="<?= base_url ?>puesto/ver&id=<?= Encryption::encode($position['id']) ?>" class="btn btn-success">
                                                                <i class="fas fa-eye"></i> Ver
                                                            </a>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class=text-center align-middle">Puesto</th>
                                                <th class=text-center align-middle">Objetivos</th>
                                                <th class=text-center align-middle">Creado</th>
                                                <th class=text-center align-middle">Accion</th>
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
<script type="text/javascript" src="<?= base_url ?>app/RH/department.js?v=<?= rand() ?>"></script>

<script type="text/javascript">
    window.onload = function() {

        let table = document.querySelector('#tb_employees');
        table.style.display = "table";
        utils.dtTable(table, true);

        let table_position = document.querySelector('#tb_position');
        table_position.style.display = "table";
        utils.dtTable(table_position, true);

        document.querySelector('#modal_edit form').addEventListener('submit', e => {
            e.preventDefault();
            let departamento = new Department();
            departamento.updateDepartamento();
        });

        document.querySelector('#btn-editar-departamento').addEventListener('click', e => {
            e.preventDefault();
            $('#modal_edit').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

    }
</script>