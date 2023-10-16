<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left mb-2">
                                <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url ?>Empleado/index&flag=<?= Encryption::encode($employee->status) ?>">Empleados</a></li>
                                <li class="breadcrumb-item active title-empelado"> <?= $employee->first_name . " " . $employee->surname . " " . $employee->last_name  ?></li>
                            </ol>
                        </div>
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <h4>
                                    <b>Empleado</b>
                                </h4>
                            </div>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center ml-5 mr-5 mb-3">
                                        <img src="<?= $avatar->image[0] ?>" class="img-fluid img-circle user-image mt-3">
                                        <div class="btn-group btn-group-sm mt-2">
                                            <?php if ($avatar->image[2]) : ?>
                                                <button class="btn btn-success btn-watch-photo" data-id=<?= $avatar->id ?>><i class="fas fa-eye"></i></button>
                                                <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                                    <button class="btn btn-info btn-edit-photo" data-id="<?= $avatar->id ?>"><i class="fas fa-pencil-alt mr-1"></i></button>
                                                <?php endif ?>
                                                <?php if (Utils::permission($_GET['controller'], 'delete')) : ?>
                                                    <button class="btn btn-danger btn-delete-photo" data-id="<?= $avatar->id ?>"><i class="fas fa-times mr-1"></i></button>
                                                <?php endif ?>
                                            <?php endif ?>
                                            <label class="btn btn-orange ml-2">
                                                <input type="file" class="d-none btn-upload-photo" accept="image/x-png,image/gif,image/jpeg"><i class="fas fa-upload"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <h3 class="profile-username text-center title-empelado"><?= $employee->first_name . " " . $employee->surname . " " . $employee->last_name  ?></h3>

                                    <p class="text-muted text-center title-position"><?= $position->title ?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong><i class="fas fa-user"></i> Edad</strong>
                                                    <p class="text-muted" id="age"><?= date("Y") - date("Y", strtotime($employee->date_birth)) . ' Años'; ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong><i class="fas fa-user-friends"></i> Estado Civíl</strong>
                                                    <p class="text-muted" id="civil_status"> <?= isset($employee->civil_status) ? $employee->civil_status : 'Sin definir' ?></p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong><i class="fas fa-trophy"></i> No. de empleado</strong>
                                                    <p class="text-muted" id="employee_number"><?= isset($employee->employee_number) ? $employee->employee_number : 'Sin definir' ?></p>

                                                </div>
                                                <div class="col-6">

                                                    <strong><i class="fas fa-trophy"></i> Antiguedad</strong>
                                                    <p class="text-muted"><?= date('Y', time()) - date("Y", strtotime($employee->start_date)) . ' Años'; ?></p>

                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <strong><i class="fas fa-file-alt"></i> Curriculum vitae</strong>
                                            <p class="text-muted" id="cv_employee_url"><?= $routeDocu == false ? 'No cuenta con cv' : '<a href="' . $routeDocu . '" target="_blank">CV_' . $employee->first_name . "_" . $employee->surname . "_" . $employee->last_name .  '.pdf</a>'  ?></p>
                                        </li>

                                        <li class="list-group-item">
                                            <strong><i class="fas fa-file-alt"></i> RFC</strong>
                                            <p class="text-muted" id="rfc_employee_url"><?= $routeDocuRFC == false ? 'No cuenta con el documento' : '<a href="' . $routeDocuRFC . '" target="_blank">RFC_' . $employee->first_name . "_" . $employee->surname . "_" . $employee->last_name .  '.pdf</a>'  ?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fas fa-file-alt"></i> CIF</strong>
                                            <p class="text-muted" id="cfdi_employee_url"><?= $routeDocuCFDI == false ? 'No cuenta con el documento' : '<a href="' . $routeDocuCFDI . '" target="_blank">CFDI_' . $employee->first_name . "_" . $employee->surname . "_" . $employee->last_name .  '.pdf</a>'  ?></p>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h4 class="card-title"></h4>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5 col-sm-3">
                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" id="vert-tabs-datos-generales-tab" data-toggle="pill" href="#vert-tabs-datos-generales" role="tab" aria-controls="vert-tabs-datos-generales" aria-selected="false">Datos del empleado</a>
                                                <a class="nav-link" id="vert-tabs-historial-puestos-tab" data-toggle="pill" href="#vert-tabs-historial-puestos" role="tab" aria-controls="vert-tabs-historial-puestos" aria-selected="false">Movimientos de personal</a>
                                                <a class="nav-link" id="vert-tabs-contratacion-tab" data-toggle="pill" href="#vert-tabs-contratacion" role="tab" aria-controls="vert-tabs-contratacion" aria-selected="false">Historial de contratos</a>
                                                <a class="nav-link" id="vert-tabs-circulo-familiar-tab" data-toggle="pill" href="#vert-tabs-circulo-familiar" role="tab" aria-controls="vert-tabs-circulo-familiar" aria-selected="false">Circulo familiar</a>
                                                <a class="nav-link" id="vert-tabs-nomina-tab" data-toggle="pill" href="#vert-tabs-nomina" role="tab" aria-controls="vert-tabs-nomina" aria-selected="false">Datos para Nomina</a>
                                                <a class="nav-link" id="vert-tabs-incidencias-tab" data-toggle="pill" href="#vert-tabs-incidencias" role="tab" aria-controls="vert-tabs-incidencias" aria-selected="false">Incidencias</a>
                                                <a class="nav-link" id="vert-tabs-capacitacion-tab" data-toggle="pill" href="#vert-tabs-capacitacion" role="tab" aria-controls="vert-tabs-capacitacion" aria-selected="false">Capacitacion</a>
                                                <a class="nav-link" id="vert-tabs-documentos-tab" data-toggle="pill" href="#vert-tabs-documentos" role="tab" aria-controls="vert-tabs-documentos" aria-selected="false">Documentos</a>
                                                <a class="nav-link" id="vert-tabs-documentacion-tab" data-toggle="pill" href="#vert-tabs-documentacion" role="tab" aria-controls="vert-tabs-documentacion" aria-selected="false">Documentación</a>
                                            </div>
                                        </div>
                                        <div class="col-7 col-sm-9">
                                            <div class="tab-content" id="vert-tabs-tabContent">

                                                <div class="tab-pane fade active show" id="vert-tabs-datos-generales" role="tabpanel" aria-labelledby="vert-tabs-datos-generales-tab">

                                                    <div class="row">

                                                        <div class="card col-md-12 collapsed-card">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Datos generales</h3>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                                        <i class="fas fa-minus text-primary"></i>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="card-body" style="display: block;">
                                                                <div id="content-datos-general">
                                                                    <div class="row">
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Nombre del empleado</b>
                                                                            <p class="title-empelado"><?= $employee->first_name . " " . $employee->surname . " " . $employee->last_name  ?></p>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Titulo profesional</b>
                                                                            <p><?= isset($employee->scholarship) ? $employee->scholarship : 'Sin definir' ?></p>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Sexo</b>
                                                                            <p><?= $employee->id_gender == 1 ? 'Hombre' : 'Mujer' ?></p>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>CURP</b>
                                                                            <p><?= !isset($employee->curp) || $employee->curp == '' ? 'Sin definir' : $employee->curp  ?></p>
                                                                        </div>
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>NSS</b>
                                                                            <p><?= !isset($employee->nss) || $employee->nss == '' ? 'Sin definir' : $employee->nss  ?></p>
                                                                        </div>
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>RFC</b>
                                                                            <p><?= !isset($employee->rfc) || $employee->rfc == '' ? 'Sin definir' : $employee->rfc  ?></p>
                                                                        </div>
                                                                    </div>

																	
																	
																	   <!-- 7 SEP -->
                                                                    <div class="row">
                                                                        <div class="col-sm-12 text-center">
                                                                            <b>Corrreo</b>
                                                                            <p><?= !isset($employee->email) || $employee->email == '' ? 'Sin definir' : $employee->email  ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <!-- 7 SEP -->


                                                                   <div class="row">
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Fecha de creación</b>
                                                                            <p><?= Utils::getDate($employee->date_birth) ?>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Fecha de nacimiento</b>
                                                                            <p><?= Utils::getDate($employee->date_birth) ?>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Fecha de contratacion</b>
                                                                            <p><?= Utils::getDate($employee->start_date) ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Puesto</b>
                                                                            <p><?= $position->title ?></p>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Departamento</b>
                                                                            <p><?= $deparment->department ?></p>
                                                                        </div>
                                                                     
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>A quien reporta</b>
                                                                            <p><?= isset($employee->id_boss)?$employee->nameBoss:'Sin definir' ?></p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-6 text-center">
                                                                            <b>Empresa contratante</b>
                                                                            <?php $contactos = Utils::getEmpresaByContacto(); ?>
                                                                            <?php foreach ($contactos as $contacto) : ?>
                                                                                <?php if ($employee->Cliente == $contacto['Cliente']) : ?>
                                                                                    <p><?= $contacto['Nombre_Cliente'] ?></p>
                                                                                <?php endif; ?>
                                                                            <?php endforeach ?>
                                                                        </div>

                                                                        <div class="col-sm-6 text-center">
                                                                            <b>Razón social</b>
                                                                            <?php $razonSocial = Utils::showRazonesSocialesPorID($employee->id_razon); ?>
                                                                            <p><?= isset($employee->id_razon) ? $razonSocial->Nombre_Razon : 'Sin definir' ?></p>
                                                                        </div>
                                                                    </div>
                                                                    

                                                                    <div class="row divReasion" <?= isset($employee->end_date) ? '' : 'hidden' ?>>
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Fecha de terminacion</b>
                                                                            <p class="end_date"><?= isset($employee->end_date) ? Utils::getDate($employee->end_date) : 'Sin definir' ?></p>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center" id="divReasion">
                                                                            <b>Motivo de baja</b>
                                                                            <p class="reason_for_leaving"><?= isset($employee->reason_for_leaving) ?  $employee->reason_for_leaving : 'sin definir' ?></p>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center" id="divReasion">
                                                                            <b>Comentario de baja</b>
                                                                            <p class="comment_for_leaving"><?= isset($employee->comment_for_leaving) ?  $employee->comment_for_leaving : 'sin definir' ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row divRe_entrry_date" <?= isset($employee->re_entry_date) ? '' : 'hidden' ?>>
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Fecha de reingreso </b>
                                                                            <p id="re_entry_dateP"><?= isset($employee->re_entry_date) ? Utils::getDate($employee->re_entry_date) : 'Sin definir' ?></p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                                                    <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                                                        <div class="text-center">
                                                                            <button class="btn btn-info" id="btn-editar-empleado">Editar</button>
                                                                        </div>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>


                                                        <div class="card col-md-12 collapsed-card collapsed-card mt-3">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Datos de contacto</h3>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                                        <i class="fas fa-plus text-primary"></i>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="card-body" style="display: none;">
                                                                <div id="datos_Contacto">

                                                                    <div class="row">
                                                                        <div class="col-sm-6 text-center">
                                                                            <b>Telefono 1</b>
                                                                            <p><?= isset($employee_contacts->phone_number1) && $employee_contacts->phone_number1 != '' ? $employee_contacts->phone_number1 . ' ' . Utils::labelContact($employee_contacts->label1) : 'Sin definir' ?></p>
                                                                        </div>
                                                                        <div class="col-sm-6 text-center">
                                                                            <b>Telefono 2</b>
                                                                            <p><?= isset($employee_contacts->phone_number2) && $employee_contacts->phone_number2 != '' ? $employee_contacts->phone_number2 . ' ' . Utils::labelContact($employee_contacts->label2) : 'Sin definir' ?></p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-6 text-center">
                                                                            <b>Correo</b>
                                                                            <p><?= !isset($employee_contacts->email) || $employee_contacts->email == '' ? 'Sin definir' : $employee_contacts->email  ?></p>
                                                                        </div>
                                                                        <div class="col-sm-6 text-center">
                                                                            <b>Correo empresarial</b>
                                                                            <p><?= !isset($employee_contacts->institutional_email) || $employee_contacts->institutional_email == '' ? 'Sin definir' : $employee_contacts->institutional_email  ?></p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                                                    <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                                                        <div class="text-center">
                                                                            <button class="btn btn-info" id="btn-editar-contacto">Editar</button>
                                                                        </div>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            </div>



                                                        </div>

                                                        <div class="card collapsed-card col-md-12 mt-3">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Datos de emergencia</h3>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                                        <i class="fas fa-plus text-primary"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body" style="display: none;">

                                                                <div id="datos_ContactoEmergency">
                                                                    <div class="row text-center">
                                                                        <div class="col-12">
                                                                            <b class="h6">Contacto 1</b>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Nombre</b>
                                                                            <p><?= isset($employee_contacts->emergency_contact1) ? $employee_contacts->emergency_contact1 : 'Sin definir' ?></p>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Parentesco</b>
                                                                            <p><?= isset($employee_contacts->emergency_relationship1) ? $employee_contacts->emergency_relationship1 : 'Sin definir' ?></p>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Telefono</b>
                                                                            <p><?= isset($employee_contacts->emergency_number1) ? $employee_contacts->emergency_number1 : 'Sin definir' ?></p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row text-center">
                                                                        <div class="col-12">
                                                                            <b class="h6">Contacto 2</b>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Nombre</b>
                                                                            <p><?= isset($employee_contacts->emergency_contact2) ? $employee_contacts->emergency_contact2 : 'Sin definir' ?></p>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center">
                                                                            <b>Parentesco</b>
                                                                            <p><?= isset($employee_contacts->emergency_relationship2) ? $employee_contacts->emergency_relationship2 : 'Sin definir' ?></p>
                                                                        </div>

                                                                        <div class="col-sm-4 text-center">
                                                                            <b id="colores">Telefono</b>
                                                                            <p><?= isset($employee_contacts->emergency_number2) ? $employee_contacts->emergency_number2 : 'Sin definir' ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                                                    <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                                                        <div class="text-center">
                                                                            <button class="btn btn-info" id="btn-editar-emergency">Editar</button>
                                                                        </div>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            </div>

                                                        </div>

														 <?php if ($usuario_rh) : ?>
                                                        <div class="card col-md-12 collapsed-card collapsed-card mt-3">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Datos de Acceso</h3>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool"
                                                                        data-card-widget="collapse" title="Collapse">
                                                                        <i class="fas fa-plus text-primary"></i>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="card-body" style="display: none;">
                                                                <div id="datos_Contacto">

                                                                    <div class="row">
                                                                        <div class="col-sm-6 text-center">
                                                                            <b>Usuario</b>
                                                                            <p id="usernamep">
                                                                                <?= $usuario_rh->username ?>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-sm-6 text-center">
                                                                            <b>Contraseña</b>
                                                                            <p id="passwordp">
                                                                                <?= Encryption::decode($usuario_rh->password) ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-sm-12 text-center">
                                                                            <b>Status</b>
                                                                            <p id="statusp">
                                                                                <?= $usuario_rh->status == 1 ? 'Activo' : 'Inactivo'  ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                                                    <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                                                        <div class="text-center">
                                                                            <button class="btn btn-info"
                                                                                id="btn-editar-acceso">Editar</button>
                                                                        </div>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="vert-tabs-historial-puestos" role="tabpanel" aria-labelledby="vert-tabs-historial-puestos-tab">
                                                    <div class="row " hidden>
                                                        <div class="col-12 ">
                                                            <button class="btn btn-orange float-right" id="btn-editar-puesto">Agregar puesto</a>
                                                        </div>
                                                    </div>

                                                    <table id="tb_history_positions" class="table table-responsive table-striped table-sm" style="display: none;">
                                                        <thead>
                                                            <tr>
                                                                <th class="align-middle text-center">Nombre de puesto</th>
                                                                <th class="align-middle text-center">Departamento</th>
                                                                <th class="align-middle text-center">Fecha del ultimo cambio</th>
                                                                <th class="align-middle text-center">Accion</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tboodyHistory">
                                                            <?php foreach ($historyPositions as $hp) : ?>
                                                                <tr>
                                                                    <td class=" align-middle "><?= $hp['title']  ?></td>
                                                                    <td class=" align-middle "><?= $hp['department']  ?></td>
                                                                    <td class=" align-middle "><?= Utils::getDate($hp['start_date'])  ?></td>
                                                                    <td class=" text-center ">
                                                                        <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                                                            <button class="btn btn-info" value="<?= Encryption::encode($hp['id'])    ?>"><i class="fas fa-edit"></i></button>
                                                                        <?php endif ?>
                                                                        <?php if (Utils::permission($_GET['controller'], 'delete')) : ?>
                                                                            <button class="btn btn-danger text-bold" value="<?= Encryption::encode($hp['id'])   ?>">X</button>
                                                                        <?php endif ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>

                                                    </table>
                                                </div>

                                                <div class="tab-pane fade" id="vert-tabs-contratacion" role="tabpanel" aria-labelledby="vert-tabs-contratacion-tab">
                                                    <div id="datos_contrato">
                                                        <div class="row ">
                                                            <div class="col-12 ">
                                                                <button class="btn btn-orange float-right" id="btn-editar-contratos">Crear contrato</a>
                                                            </div>
                                                        </div>

                                                        <div class="row pb-3">
                                                            <div class="col-sm-12 text-center">
                                                                <b class="h5">Última contratacion</b>
                                                            </div>
                                                            <div class="col-sm-4 text-center">
                                                                <b>Fecha de inicio</b>
                                                                <p><?= isset($employeeContract->contract_start) ? Utils::getDate($employeeContract->contract_start) : 'Sin definir' ?></p>
                                                            </div>
                                                            <div class="col-sm-4 text-center">
                                                                <b>Fecha de finalizacion</b>
                                                                <p><?= isset($employeeContract->contract_end) ? Utils::getDate($employeeContract->contract_end) : 'Sin finalizacion' ?></p>
                                                            </div>
                                                            <div class="col-sm-4 text-center">
                                                                <b>Tipo de contrato</b>
                                                                <p><?= isset($employeeContract->type) ? $employeeContract->type : 'Sin definir' ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-12 ">
                                                                <table id="tb_contract" class="table table-responsive table-striped table-sm" style="display: none;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="align-middle text-center">Fecha de inicio</th>
                                                                            <th class="align-middle text-center">Fecha de finalizacion</th>
                                                                            <th class="align-middle text-center">Tipo de contrato</th>
                                                                            <th class="align-middle text-center">Accion</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody id="tboodycontract">
                                                                        <?php foreach ($employeeContractAll as $emplContrac) : ?>
                                                                            <tr>
                                                                                <td class=" align-middle "><?= Utils::getDate($emplContrac['contract_start'])  ?></td>
                                                                                <td class=" align-middle "><?= isset($emplContrac['contract_end']) ? Utils::getDate($emplContrac['contract_end']) : 'Sin finalizacion'  ?></td>
                                                                                <td class=" align-middle "><?= $emplContrac['type']  ?></td>
                                                                                <td class=" text-center ">
                                                                                    <?php if (Utils::permission($_GET['controller'], 'delete')) : ?>
                                                                                        <button class="btn btn-danger text-bold" value="<?= Encryption::encode($emplContrac['id'])   ?>">X</button>
                                                                                    <?php endif ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="tab-pane fade" id="vert-tabs-circulo-familiar" role="tabpanel" aria-labelledby="vert-tabs-circulo-familiar-tab">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <button class="btn btn-orange float-right" id="btn-editar-familiar">Agregar familiar</a>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <table id="tb_familly" class="table table-responsive table-striped table-sm" style="display: none;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="align-middle">Parentesco</th>
                                                                        <th class="align-middle">Nombre</th>
                                                                        <th class="align-middle">Edad</th>
                                                                        <th class="align-middle">Fecha de cracion</th>
                                                                        <th class="align-middle">Accion</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody id="tboodyFamily">
                                                                    <?php foreach ($employeeFamily as $empfam) : ?>
                                                                        <tr>
                                                                            <td class="text-center align-middle text-bold"> <?= Utils::labelFamily($empfam['type'])  ?></td>
                                                                            <td class="text-center align-middle"><?= isset($empfam['name']) && $empfam['name'] != null ? $empfam['name'] : 'Sin definir' ?></td>
                                                                            <td class="text-center align-middle"><?= isset($empfam['age']) ? $empfam['age'] . ' Años' : 'Sin definir'  ?> </td>
                                                                            <td class="text-center align-middle"><?= Utils::getFullDate($empfam['created_at'])  ?></td>
                                                                            <td class="text-center align-middle">
                                                                                <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                                                                    <button class="btn btn-info" value="<?= Encryption::encode($empfam['id']) ?>"><i class="fas fa-edit"></i></button>
                                                                                <?php endif ?>
                                                                                <?php if (Utils::permission($_GET['controller'], 'delete')) : ?>
                                                                                    <button class="btn btn-danger text-bold" value="<?= Encryption::encode($empfam['id']) ?>">X</button>
                                                                                <?php endif ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach;
                                                                    ?>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="tab-pane fade" id="vert-tabs-nomina" role="tabpanel" aria-labelledby="vert-tabs-nomina-tab">
                                                    <div id="divNomina">

                                                        <div class="row">

                                                            <div class="col-sm-4 text-center">
                                                                <b>Fecha del último ajuste</b>
                                                                <p><?= isset($employeePayroll->created_at) ? Utils::getDate($employeePayroll->created_at) : 'Sin definir' ?></p>
                                                            </div>

                                                            <div class="col-sm-4 text-center">
                                                                <b>Salario actual o final</b>
                                                                <p><?= isset($employeePayroll->gross_pay) ? '$' . number_format($employeePayroll->gross_pay, 2) : 'Sin definir' ?></p>
                                                            </div>

                                                            <div class="col-sm-4 text-center">
                                                                <b>Salario inicial</b>
                                                                <p><?= isset($employeePayroll->start_pay) ? '$' . number_format($employeePayroll->start_pay, 2) : 'Sin definir' ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4 text-center">
                                                                <b>Banco</b>
                                                                <p><?= isset($employeePayroll->bank) ? $employeePayroll->bank : 'Sin definir' ?></p>
                                                            </div>

                                                            <div class="col-sm-4 text-center">
                                                                <b>Cuenta</b>
                                                                <p><?= isset($employeePayroll->account_number)  && $employeePayroll->account_number != '' ? $employeePayroll->account_number : 'Sin definir' ?></p>
                                                            </div>
                                                            <div class="col-sm-4 text-center">
                                                                <b>CLABE</b>
                                                                <p><?= isset($employeePayroll->CLABE) && $employeePayroll->CLABE != '' ? $employeePayroll->CLABE : 'Sin definir' ?></p>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12" id="divTableHistory" hidden>
                                                            <table id="tb_employees_payroll" class="table table-responsive table-striped table-sm" style="display: none;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="align-middle">Sueldo bruto</th>
                                                                        <th class="align-middle">Banco</th>
                                                                        <th class="align-middle">Cuenta</th>
                                                                        <th class="align-middle">CLABE</th>
                                                                        <th class="align-middle">Fecha del ajuste</th>
                                                                        <th class="align-middle">Accion</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody id="tableRollPay">
                                                                    <?php foreach ($employeePayrollAll as $employeePayro) :  ?>
                                                                        <tr>
                                                                            <td class="text-center align-middle"><?= '$' . number_format($employeePayro['gross_pay'], 2) ?></td>
                                                                            <td class="text-center align-middle"><?= $employeePayro['bank'] ?></td>
                                                                            <td class="text-center align-middle"><?= $employeePayro['account_number'] ?></td>
                                                                            <td class="text-center align-middle"><?= $employeePayro['CLABE'] ?></td>
                                                                            <td class="text-center align-middle"><?= Utils::getDate($employeePayro['created_at']) ?></td>
                                                                            <td class=" text-center ">
                                                                                <?php if (Utils::permission($_GET['controller'], 'delete')) : ?>
                                                                                    <button class="btn btn-danger text-bold" value="<?= Encryption::encode($employeePayro['id'])   ?>">X</button>
                                                                                <?php endif ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach;
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                                        <div class="text-center ">
                                                            <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                                                <button class="btn btn-info" id="btn-editar-payroll">Editar</button>
                                                            <?php endif ?>
                                                            <?php if (Utils::permission($_GET['controller'], 'read')) : ?>
                                                                <button class="btn btn-success" id="btn-history-payroll">Ver historial de cambios</button>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>

                                                <div class="tab-pane fade" id="vert-tabs-incidencias" role="tabpanel" aria-labelledby="vert-tabs-incidencias-tab">
                                                    <div class="row ">
                                                        <div class="col-12 ">
                                                            <button class="btn btn-orange float-right" id="btn-editar-incidence">Agregar incidencia</a>
                                                        </div>
                                                    </div>
                                                    <!--   <div class="row">
                                                        <div class="col-12 float-right">
                                                            <a href="<?= base_url  ?>Incidencias/index" class="btn btn-orange float-right">Crear Incidencia</a>
                                                        </div>
                                                    </div> -->
                                                    <div class="row">
                                                        <div class="col-12" id="divTableIncidens">
                                                            <table id="tb_employees_incidens" class="table table-responsive table-striped table-sm" style="display: none;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="align-middle">Incidencia</th>
                                                                        <th class="align-middle">Movimiento</th>
                                                                        <th class="align-middle">Comentario</th>
                                                                        <th class="align-middle">Fecha de inicio</th>
                                                                        <th class="align-middle">Fecha de final</th>
                                                                        <th class="align-middle">Accion</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody id="tboodyInciden">
                                                                    <?php foreach ($incidens as $inc) : ?>
                                                                        <tr>
                                                                            <td class="text-center align-middle"> <?= $inc['type']  ?></td>
                                                                            <td class="text-center align-middle">
                                                                                <?php
                                                                                if ($inc['type'] == 'Retraso' || $inc['type'] == 'Horas extras') {
                                                                                    echo $inc['hours'] . ' hrs';
                                                                                } else if ($inc['type'] == 'Faltas') {
                                                                                    echo $inc['type_of_foul'];
                                                                                } else if ($inc['type'] == 'Incapacidades') {
                                                                                    echo $inc['type_of_incapacity'];
                                                                                } else if ($inc['type'] == 'Bonos') {
                                                                                    echo '$' . number_format($inc['amount'], 2);
                                                                                }
                                                                                ?>
                                                                            </td>

                                                                            <td class="text-center align-middle"><?= $inc['comments']  ?></td>
                                                                            <td class="text-center align-middle"><?= Utils::getDate($inc['created_at'])  ?></td>
                                                                            <td class="text-center align-middle"><?= Utils::getDate($inc['end_date'])  ?></td>
                                                                            <td class="text-center align-middle">
                                                                                <?php if (Utils::permission($_GET['controller'], 'delete')) : ?>
                                                                                    <button class="btn btn-danger text-bold" value="<?= Encryption::encode($inc['id_incident'])  ?>">X</button>
                                                                                <?php endif ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach;
                                                                    ?>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>

                                                    <div class="text-center " hidden>
                                                        <button class="btn btn-success" id="btn-historial-incidente">Ver historial de incidencias</button>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="vert-tabs-capacitacion" role="tabpanel" aria-labelledby="vert-tabs-capacitacion-tab">
                                                    <div class="row">
                                                        <div class="col-12 ">
                                                            <a href="<?= base_url  ?>capacitaciones/index" class="btn btn-orange float-right">Ver capacitaciones</a>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12" id="divTableTraining">
                                                            <table id="tb_employees_training" class="table table-responsive table-striped table-sm" style="display: none;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="align-middle text-center">Nombre de la capacitacion</th>
                                                                        <th class="align-middle text-center">Descripcion</th>
                                                                        <th class="align-middle text-center">Horas</th>
                                                                        <th class="align-middle text-center">Empresa contratante</th>
                                                                        <th class="align-middle text-center">Fecha de inicio</th>
                                                                        <th class="align-middle text-center">Fecha final</th>
                                                                        <th class="align-middle text-center">Fecha de modificacion</th>
                                                                        <th class="align-middle text-center">Accion</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody id="tboodyTraining">
                                                                    <?php foreach ($employee_trainings as $tra) : ?>
                                                                        <tr>
                                                                            <td class=" align-middle "><?= $tra['title']  ?></td>
                                                                            <td class=" align-middle "><?= $tra['description']  ?></td>
                                                                            <td class=" align-middle "><?= $tra['hours'] . ' hrs'  ?></td>
                                                                            <td class=" align-middle "><?= $tra['nombre_cliente']  ?></td>
                                                                            <td class=" align-middle "><?= Utils::getDate($tra['start_date'])  ?></td>
                                                                            <td class=" align-middle "><?= Utils::getDate($tra['end_date'])  ?></td>
                                                                            <td class=" align-middle "><?= Utils::getFullDate($tra['modified_at'])  ?></td>
                                                                            <td class=" align-middle ">
                                                                                <?php if (Utils::permission($_GET['controller'], 'delete')) : ?>
                                                                                    <button class="btn btn-danger text-bold" value="<?= Encryption::encode($tra['id_employee_training']) . ',' . Encryption::encode($tra['id_employee'])  ?>">X</button>
                                                                                <?php endif ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>

                                                    <div class="text-center " hidden>
                                                        <button class="btn btn-success" id="btn-historial-capacitaciones">Ver historial de capacitaciones</button>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="vert-tabs-documentos" role="tabpanel" aria-labelledby="vert-tabs-documentos-tab">

                                                    <form action="" id="form_cv">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <label for="cv" class="col-form-label">Curriculum Vitae</label>
                                                                <input type="file" id="input_cv" class="form-control" name="cv" placeholder="Adjuntar currículum" class="form-control-file text-white" accept=" application/pdf">
                                                            </div>
                                                            <input type="hidden" name="id_employee" value="<?= $_GET['id'] ?>">
                                                            <div class="col-4">
                                                                <input class="btn btn-orange" type="submit"></input>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <form action="" id="form_rfc">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <label for="rfc" class="col-form-label">RFC</label>
                                                                <input type="file" id="input_rfc" class="form-control" name="rfc" placeholder="Adjuntar RFC" class="form-control-file text-white" accept=" application/pdf">
                                                            </div>
                                                            <input type="hidden" name="id_employee" value="<?= $_GET['id'] ?>">
                                                            <div class="col-4">
                                                                <input class="btn btn-orange" type="submit"></input>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <form action="" id="form_cfdi">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <label for="cfdi" class="col-form-label">CIF</label>
                                                                <input type="file" id="input_cfdi" class="form-control" name="cfdi" placeholder="Adjuntar CFDI" class="form-control-file text-white" accept=" application/pdf">
                                                            </div>
                                                            <input type="hidden" name="id_employee" value="<?= $_GET['id'] ?>">
                                                            <div class="col-4">
                                                                <input class="btn btn-orange" type="submit"></input>
                                                            </div>
                                                        </div>
                                                    </form>


                                                </div>
                                                <div class="tab-pane fade" id="vert-tabs-documentacion" role="tabpanel" aria-labelledby="vert-tabs-documentacion-tab">
                                                    <div class="form-group mb-3">
                                                        <label class="col-form-label">Agregar documento</label>
                                                        <input type="file" class="btn btn-success" accept="image/x-png,image/gif,image/jpeg" style="display: block;">
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>Documento</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="content-documentos">
                                                                <?php foreach ($documents as $document): ?>
                                                                <tr>
                                                                    <td><?=$document['Descripcion']?></td>
                                                                    <td class="text-right py-0 align-middle">
                                                                        <div class="btn-group btn-group-sm">
                                                                            <button class="btn btn-success" data-id="<?=$document['id']?>">
                                                                                <i class="fas fa-eye"></i>
                                                                            </button>
                                                                            <?php if (Utils::permission($_GET['controller'], 'update')) : ?>
                                                                                <button class="btn btn-info" data-id="<?=$document['id']?>">
                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                </button>
                                                                            <?php endif ?>
                                                                            <?php if (Utils::permission($_GET['controller'], 'delete')) : ?>
                                                                                <button class="btn btn-danger" data-id="<?=$document['id']?>">
                                                                                    <i class="fas fa-times"></i>
                                                                                </button>
                                                                            <?php endif ?>
                                                                        </div>
                                                                    </td>
                                                                </tr> 
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                    </div><!-- /.container-fluid -->
            </section>
            <?php if (Utils::permission($_GET['controller'], 'update')) : ?>    
            <div class="row">
                <div class="col-sm-6 p-3">
                    <button class="btn btn-<?= $employee->status == 1 ? 'danger' : 'success' ?>" id="btn-debaja-empleado" value="<?= $_GET['id']  ?>">Dar de <?= $employee->status == 1 ? 'baja' : 'alta' ?></button>
                </div>
            </div>
            <?php endif ?>
        </div>

    </div>
</div>
<script type="text/javascript" src="<?= base_url ?>app/RH/employee.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/historyposition.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/incidence.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/training.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/contract.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/employee_RH.js?v=<?= rand() ?>"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', e => {

        //APLICANDO DATATABLE EN LAS TABLAS
        let tb_employees_payroll = document.querySelector('#tb_employees_payroll');
        tb_employees_payroll.style.display = "table";
        utils.dtTable(tb_employees_payroll, true);

        let tb_employees_incidens = document.querySelector('#tb_employees_incidens');
        tb_employees_incidens.style.display = "table";
        utils.dtTable(tb_employees_incidens, true);

        let tb_employees_training = document.querySelector('#tb_employees_training');
        tb_employees_training.style.display = "table";
        utils.dtTable(tb_employees_training, true);

        let tb_history_positions = document.querySelector('#tb_history_positions');
        tb_history_positions.style.display = "table";
        utils.dtTable(tb_history_positions, true);

        let tb_familly = document.querySelector('#tb_familly');
        tb_familly.style.display = "table";
        utils.dtTable(tb_familly, true);

        let tb_contract = document.querySelector('#tb_contract');
        tb_contract.style.display = "table";
        utils.dtTable(tb_contract, true);


        document.querySelector('#btn-history-payroll').addEventListener('click', e => {
            e.preventDefault();
            let div = document.querySelector('#divTableHistory')
            if (div.hidden == true) {
                div.hidden = false
                document.querySelector('#btn-history-payroll').textContent = 'Cerrar historial de cambios'
            } else {
                div.hidden = true
                document.querySelector('#btn-history-payroll').textContent = 'Ver historial de cambios'
            }
        })

        document.querySelector('#btn-historial-incidente').addEventListener('click', e => {
            e.preventDefault();
            let div = document.querySelector('#divTableIncidens')
            if (div.hidden == true) {
                div.hidden = false
                document.querySelector('#btn-historial-incidente').textContent = 'Cerrar historial de incidencias'
            } else {
                div.hidden = true
                document.querySelector('#btn-historial-incidente').textContent = 'Ver historial de incidencias'
            }
        })

        document.querySelector('#btn-historial-capacitaciones').addEventListener('click', e => {
            e.preventDefault();
            let div = document.querySelector('#divTableTraining')
            if (div.hidden == true) {
                div.hidden = false
                document.querySelector('#btn-historial-capacitaciones').textContent = 'Cerrar historial de capacitaciones'
            } else {
                div.hidden = true
                document.querySelector('#btn-historial-capacitaciones').textContent = 'Ver historial de capacitaciones'
            }
        })

        //MOSTRANDO MODALAS 
        let employee = new Employee();
        document.querySelector('#btn-editar-empleado').addEventListener('click', e => {
            e.preventDefault();
            $('#modal_general').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        var id_cliente = document.querySelector('#Cliente');
        id_cliente.addEventListener('change', e => {
            employee.getContactosYRazonesPorCliente(id_cliente.value);
        })

        document.querySelector('#btn-editar-puesto').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#modal-historyposition form').reset()
            $('#modal-historyposition').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-editar-contratos').addEventListener('click', e => {
            e.preventDefault();
            $('#modal-contract').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-editar-familiar').addEventListener('click', e => {
            var form = document.querySelector("#modal_family form");
            form.reset()

            document.querySelector('#modal_family [name="flag"]').value = "1"
            e.preventDefault();
            $('#modal_family').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-editar-contacto').addEventListener('click', e => {
            e.preventDefault();
            $('#modal-data-contact').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-editar-contacto').addEventListener('click', e => {
            e.preventDefault();
            $('#modal-data-contact').modal({
                backdrop: 'static',
                keyboard: false
            });
        })
        document.querySelector('#btn-editar-emergency').addEventListener('click', e => {
            e.preventDefault();
            $('#modal-data-emergency').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-editar-payroll').addEventListener('click', e => {
            e.preventDefault();
            $('#modal-payroll').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#btn-editar-incidence').addEventListener('click', e => {
            e.preventDefault();
            $('#modal-incidence').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        //EVENTOS DE LOS MODALS
        document.querySelector('#modal_general form').addEventListener('submit', e => {
            e.preventDefault();
            employee.updateEmployee();
        });

        document.querySelector('#modal-historyposition form').addEventListener('submit', e => {
            e.preventDefault();
            let history_position = new History_position();
            history_position.updatStartDate();

        });

        document.querySelector('#modal-contract form').addEventListener('submit', e => {
            e.preventDefault();
            let contract = new Contract();
            contract.save()
        });

        document.querySelector('#modal_family form').addEventListener('submit', e => {
            e.preventDefault();
            employee.save_employee_family()
        });

        document.querySelector('#modal-data-contact form').addEventListener('submit', e => {
            e.preventDefault();
            employee.updateDatacontact();
        });

        document.querySelector('#modal-data-emergency form').addEventListener('submit', e => {
            e.preventDefault();
            employee.updateDatacontactEmergency();
        });

        document.querySelector('#modal-payroll form').addEventListener('submit', e => {
            e.preventDefault();
            employee.updatePayroll();
        });

        document.querySelector('#modal-incidence form').addEventListener('submit', e => {
            e.preventDefault();
            var incidente = new Incidence();
            incidente.save();
        });


        document.querySelector('#modal-baja form').addEventListener('submit', e => {
            e.preventDefault();
            employee.updateEnd_date();
        });

        document.querySelector('#modal-alta form').addEventListener('submit', e => {
            e.preventDefault();
            employee.updateRe_entry_date();
        });
		
		  document.querySelector('#modal-acceso form').addEventListener('submit', e => {
        e.preventDefault();
        usuario_rh = new Employee_RH();
        usuario_rh.Update_UserRH();
    });

    document.querySelector('#btn-editar-acceso').addEventListener('click', e => {
        e.preventDefault();
        $('#modal-acceso').modal({
            backdrop: 'static',
            keyboard: false
        });
    })



        document.querySelector('#tboodyInciden').addEventListener('click', function(e) {
            var incidente = new Incidence();

            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                document.querySelectorAll('#modal_create_incidencias input')[0].value = 3
                if (e.target.offsetParent.classList.contains('btn-info')) {
                    incidente.getIncident(e.target.offsetParent.value)
                } else {
                    incidente.getIncident(e.target.value)
                }
                $('#modal_create_incidencias').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }


            if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-denger')) {
                Swal.fire({
                    title: '¿Quieres eliminar esta incidente?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        incidente.delete(e.target.value, 2);
                    }
                })
            }
        })


        document.querySelector('#tboodyFamily').addEventListener('click', function(e) {
            var form = document.querySelector("#modal_family form");
            form.reset()
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                if (e.target.offsetParent.classList.contains('btn-info')) {
                    employee.getFamily(e.target.offsetParent.value);
                } else {
                    employee.getFamily(e.target.value);
                }
                $('#modal_family').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
            if (e.target.classList.contains('btn-danger')) {
                Swal.fire({
                    title: '¿Quieres eliminar este familiar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        employee.deleteFamily(e.target.value)
                    }
                })
            }

        })


        document.querySelector('#tableRollPay').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-danger')) {
                Swal.fire({
                    title: '¿Quieres eliminar este ajuste?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        employee.deletePayroll(e.target.value)
                    }
                })
            }
        })

        document.querySelector('#tboodycontract').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-danger')) {
                Swal.fire({
                    title: '¿Quieres eliminar este contrato?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        let contract = new Contract()
                        contract.delete(e.target.value)
                    }
                })
            }
        })

        document.querySelector('#tboodyTraining').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-denger')) {
                Swal.fire({
                    title: '¿Quieres eliminar esta capacitacion?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        var training = new Training();
                        training.deleteTraingEmployee(e.target.value)
                    }
                })
            }
        })

        document.querySelector('#tboodyHistory').addEventListener('click', function(e) {
            let history_position = new History_position();

            var form = document.querySelector("#modal-historyposition form");
            form.reset()

            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                if (e.target.offsetParent.classList.contains('btn-info')) {
                    history_position.getHistoryposition(e.target.offsetParent.value);
                } else {
                    history_position.getHistoryposition(e.target.value);
                }
                $('#modal-historyposition').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {
                Swal.fire({
                    title: '¿Quieres eliminar el puesto?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        history_position.delete_historyPosition(e.target.value)
                    }
                })
            }

        })


        document.querySelector('#btn-debaja-empleado').addEventListener('click', e => {
            e.preventDefault();
            if (e.target.classList.contains('btn-danger')) {
                $('#modal-baja').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
            if (e.target.classList.contains('btn-success')) {
                $('#modal-alta').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        })

        //=================================SUBIR ARCHIVO CV============================================ ulises
        let file_input = document.querySelector("#input_cv")
        file_input.addEventListener('change', function(e) {
            if (file_input.files[0] == undefined) {

            } else if (file_input.files[0].size > 15368312) {
                utils.showToast('  El archivo no debe superar los 15MB', 'warning');
                file_input.value = '';
            } else {
                var ext = file_input.files[0].name.split('.').pop().toLowerCase();
                if (ext != 'pdf') {
                    utils.showToast('Solo se permite extension pdf.', 'warning');
                    file_input.value = '';
                }
            }
        })

        document.querySelector('#form_cv').addEventListener('submit', e => {
            e.preventDefault();
            if (file_input.value != '') {
                let employee_cv = new Employee();
                employee_cv.upload_file('cv');
            } else {
                utils.showToast('Selecciona archivo.', 'warning');
            }
        });

        //=================================SUBIR ARCHIVO RFC============================================ ulises
        let file_input_rfc = document.querySelector("#input_rfc")
        file_input_rfc.addEventListener('change', function(e) {
            if (file_input_rfc.files[0] == undefined) {

            } else if (file_input_rfc.files[0].size > 15368312) {
                utils.showToast('  El archivo no debe superar los 15MB', 'warning');
                file_input_rfc.value = '';
            } else {
                var ext = file_input_rfc.files[0].name.split('.').pop().toLowerCase();
                if (ext != 'pdf') {
                    utils.showToast('Solo se permite extension pdf.', 'warning');
                    file_input_rfc.value = '';
                }
            }
        })

        document.querySelector('#form_rfc').addEventListener('submit', e => {
            e.preventDefault();
            if (file_input_rfc.value != '') {
                let employee_rfc = new Employee();
                employee_rfc.upload_file('rfc');
            } else {
                utils.showToast('Selecciona archivo.', 'warning');
            }
        });
        //=================================SUBIR ARCHIVO RFC============================================ ulises

        let file_input_cfdi = document.querySelector("#input_cfdi")
        file_input_cfdi.addEventListener('change', function(e) {
            if (file_input_cfdi.files[0] == undefined) {

            } else if (file_input_cfdi.files[0].size > 15368312) {
                utils.showToast('  El archivo no debe superar los 15MB', 'warning');
                file_input_cfdi.value = '';
            } else {
                var ext = file_input_cfdi.files[0].name.split('.').pop().toLowerCase();
                if (ext != 'pdf') {
                    utils.showToast('Solo se permite extension pdf.', 'warning');
                    file_input_cfdi.value = '';
                }
            }
        })

        document.querySelector('#form_cfdi').addEventListener('submit', e => {
            e.preventDefault();
            if (file_input_cfdi.value != '') {
                let employee_cfdi = new Employee();
                employee_cfdi.upload_file('cfdi');
            } else {
                utils.showToast('Selecciona archivo.', 'warning');
            }
        });

        //=================================MODALAS IMAGENES============================================ernesto

        var new_image = document.querySelector('#modal_imagen img');
        document.addEventListener('change', e => {
            if (e.target.classList.contains('btn-upload-photo') || e.target.parentElement.classList.contains('btn-upload-photo')) {

                var files = e.target.files;
                var done = function(url) {
                    new_image.src = url;

                    let form = document.querySelector('#modal_imagen form');
                    form.querySelectorAll('input')[0].value = 0;
                    form.querySelectorAll('input')[2].value = files[0].name;
                    form.querySelectorAll('input')[3].value = 0;

                    $('#modal_imagen').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }

                if (files && files.length) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    }
                    reader.readAsDataURL(files[0]);
                }
            }
            e.stopPropagation();
        })

        var cropper;
        var optionsImgs = {
            movable: true,
            zoomable: true,
            scalable: true,
            viewMode: 0,
            rotatable: true,
            autoCropArea: 1,
            //preview:'.preview'
        }

        $('#modal_imagen').on('shown.bs.modal', function() {
            cropper = new Cropper(new_image, optionsImgs);
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        document.querySelector('#modal_imagen .docs-buttons').onclick = function(event) {
            var e = event || window.event;
            var target = e.target || e.srcElement;
            var cropped;
            var result;
            var input;
            var data;

            if (!cropper) {
                return;
            }

            while (target !== this) {
                if (target.getAttribute('data-method')) {
                    break;
                }

                target = target.parentNode;
            }

            if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
                return;
            }

            data = {
                method: target.getAttribute('data-method'),
                target: target.getAttribute('data-target'),
                option: target.getAttribute('data-option') || undefined,
                secondOption: target.getAttribute('data-second-option') || undefined
            };

            cropped = cropper.cropped;

            if (data.method) {
                if (typeof data.target !== 'undefined') {
                    input = document.querySelector(data.target);

                    if (!target.hasAttribute('data-option') && data.target && input) {
                        try {
                            data.option = JSON.parse(input.value);
                        } catch (e) {
                            console.log(e.message);
                        }
                    }
                }

                switch (data.method) {
                    case 'rotate':
                        if (cropped && optionsImgs.viewMode > 0) {
                            cropper.clear();
                        }

                        break;
                }

                result = cropper[data.method](data.option, data.secondOption);

                switch (data.method) {
                    case 'rotate':
                        if (cropped && optionsImgs.viewMode > 0) {
                            cropper.crop();
                        }

                        break;

                    case 'scaleX':
                    case 'scaleY':
                        target.setAttribute('data-option', -data.option);
                        break;
                }

                if (typeof result === 'object' && result !== cropper && input) {
                    try {
                        input.value = JSON.stringify(result);
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            }
        };


        document.querySelector('#modal_imagen').onsubmit = function(e) {
            e.preventDefault();


            canvas = cropper.getCroppedCanvas({
                maxWidth: 900,
                maxHeight: 900,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high'
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;

                    var form = document.querySelector("#modal_imagen form");
                    let id = form.querySelectorAll('input')[0].value;
                    let id_employee = form.querySelectorAll('input')[1].value;
                    let file_name = form.querySelectorAll('input')[2].value;
                    let flag = form.querySelectorAll('input')[3].value;

                    form.querySelectorAll('.btn-orange')[0].disabled = true;

                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '../EmpleadoFoto/save');
                    let data = `id=${id}&id_employee=${id_employee}&file_name=${file_name}&Objeto=${base64data}&flag=${flag}`;
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send(data);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            let r = this.responseText;
                            console.log(r);
                            try {
                                let json_app = JSON.parse(r);
                                if (json_app.status == 1) {
                                    form.querySelector('img').src = json_app.avatar.image[0];

                                    utils.showToast('Imagen cargada exitosamente', 'success');
                                    $('#modal_imagen').modal('hide');
                                    form.querySelectorAll('.btn-orange')[0].disabled = false;
                                }
                            } catch (error) {
                                utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                                form.querySelectorAll('.btn-orange')[0].disabled = false;
                            }
                        }
                    }
                };
            });


            //estudio.save_imagen();
        }

        document.addEventListener('click', e => {
            if (e.target.classList.contains('btn-watch-photo') || e.target.parentElement.classList.contains('btn-watch-photo')) {
                let id;
                if (e.target.classList.contains('btn-watch-photo'))
                    id = e.target.dataset.id;
                else
                    id = e.target.parentElement.dataset.id;

                let xhr = new XMLHttpRequest();
                let data = `id=${id}`;
                let image = document.querySelector('#modal_ver_imagen img');
                image.style.display = "none";
                image.src = "";
                let link = document.querySelector('#modal_ver_imagen a');
                link.href = "";
                xhr.open('POST', "../EmpleadoFoto/getOne");
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        try {
                            if (r != 0) {
                                let json_app = JSON.parse(r);
                                console.log(json_app);
                                image.src = json_app.image[0];
                                image.style.display = "block";
                                link.href = json_app.image[0];
                                link.download = json_app.file_name;
                                $('#modal_ver_imagen').modal('show');
                            }

                        } catch (error) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                        }
                    }
                }
            }

            if (e.target.classList.contains('btn-edit-photo') || e.target.parentElement.classList.contains('btn-edit-photo')) {
                let id;
                if (e.target.classList.contains('btn-edit-photo'))
                    id = e.target.dataset.id;
                else
                    id = e.target.parentElement.dataset.id;

                let xhr = new XMLHttpRequest();
                let data = `id=${id}`;
                let form = document.querySelector('#modal_imagen form');
                form.querySelectorAll('.btn')[3].disabled = false;
                //let content_imagen = form.querySelector('.imagen');
                let image = form.querySelector('img');
                image.style.display = "none";
                image.src = "";
                xhr.open('POST', "../EmpleadoFoto/getOne");
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        try {
                            let json_app = JSON.parse(r);
                            if (json_app.status == 1) {
                                form.querySelectorAll('input')[0].value = json_app.id;
                                form.querySelectorAll('input')[1].value = json_app.id_employee;
                                form.querySelectorAll('input')[2].value = json_app.file_name;
                                form.querySelectorAll('input')[3].value = 1;
                                /*let image = document.createElement('img');
                                image.setAttribute('src', json_app);
                                content_imagen.appendChild(image);*/
                                image.src = json_app.image[0];
                                image.style.display = "block";
                                $('#modal_imagen').modal({
                                    backdrop: 'static',
                                    keyboard: false
                                });
                                if (image.src == json_app.image[0]) {
                                    let cropper;
                                    $('#modal_imagen').on('shown.bs.modal', function() {
                                        cropper = null;
                                        cropper = new Cropper(image, {
                                            movable: true,
                                            zoomable: true,
                                            scalable: true,
                                            viewMode: 0,
                                            rotatable: true,
                                            preview: '.preview',
                                            ready: function(e) {
                                                document.querySelectorAll('#modal_imagen .btn-primary')[0].addEventListener('click', e => {
                                                    cropper.rotate(-45);
                                                })

                                                document.querySelectorAll('#modal_imagen .btn-primary')[1].addEventListener('click', e => {
                                                    cropper.rotate(45);
                                                })
                                            }
                                        });

                                    }).on('hidden.bs.modal', function() {
                                        cropper.destroy();
                                        cropper = null;
                                    });
                                }

                            } else {
                                form.querySelectorAll('input')[0].value = 0;
                                form.querySelectorAll('input')[1].value = 0;
                            }

                        } catch (error) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                            console.log(error);
                        }
                    }
                }
            }

            if (e.target.classList.contains('btn-delete-photo') || e.target.parentElement.classList.contains('btn-delete-photo')) {

            }
            e.stopPropagation();
        })
		
		
        <?php if ($employee->status == 0) : ?>
            var botones = document.querySelectorAll("button");
            botones.forEach(function(boton) {
                if (boton.classList.contains('btn-info') || boton.classList.contains('btn-danger') || boton.classList.contains('btn-orange')) {
                    boton.remove();
                }
            });
        <?php endif; ?>
		
		let cropperr;
        let optionsDocs = {
            autoCropArea: 1,
            //preview:'.previeww',
            checkOrientation: true,
            responsive: true
        };

        $('#modal_documento').on('shown.bs.modal', function() {
            cropperr = new Cropper(document.querySelector('#modal_documento img'), optionsDocs);
        }).on('hidden.bs.modal', function(){
            cropperr.destroy();
            cropperr = null;
        });

        document.querySelector('#modal_documento .docs-buttons').onclick = function (event) {
            var e = event || window.event;
            var target = e.target || e.srcElement;
            var cropped;
            var result;
            var input;
            var data;
        
            if (!cropperr) {
            return;
            }
        
            while (target !== this) {
            if (target.getAttribute('data-method')) {
                break;
            }
        
            target = target.parentNode;
            }
        
            if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
            return;
            }
        
            data = {
            method: target.getAttribute('data-method'),
            target: target.getAttribute('data-target'),
            option: target.getAttribute('data-option') || undefined,
            secondOption: target.getAttribute('data-second-option') || undefined
            };
        
            cropped = cropperr.cropped;
        
            if (data.method) {
            if (typeof data.target !== 'undefined') {
                input = document.querySelector(data.target);
        
                if (!target.hasAttribute('data-option') && data.target && input) {
                try {
                    data.option = JSON.parse(input.value);
                } catch (e) {
                    console.log(e.message);
                }
                }
            }
        
            switch (data.method) {
                case 'rotate':
                if (cropped && optionsDocs.viewMode > 0) {
                    cropperr.clear();
                }
        
                break;
            }
        
            result = cropperr[data.method](data.option, data.secondOption);
        
            switch (data.method) {
                case 'rotate':
                if (cropped && optionsDocs.viewMode > 0) {
                    cropperr.crop();
                }
        
                break;
        
                case 'scaleX':
                case 'scaleY':
                target.setAttribute('data-option', -data.option);
                break;
            }
        
            if (typeof result === 'object' && result !== cropperr && input) {
                try {
                input.value = JSON.stringify(result);
                } catch (e) {
                console.log(e.message);
                }
            }
            }
        };

        document.querySelectorAll('.content-documentos')[0].parentElement.parentElement.parentElement.children[0].children[1].addEventListener('change', e => {
            var files = e.target.files;
            let data = `id_employee=${document.querySelectorAll('#modal_documento form input')[1].value}`;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../EmpleadoDocumento/getDocumentosPorCompletar');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(data);
            xhr.clase = this;
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = this.responseText;
                    console.log(r);
                    try {
                        let json_app = JSON.parse(r);
                        let data = '';
                        json_app.forEach(element => {
                            data += `<option value="${element.Campo}">${element.Descripcion}</option>`;
                        });
                        document.querySelector('#modal_documento select').innerHTML = data;
                    } catch (error) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                        //form.querySelectorAll('.btn')[1].disabled = false;
                    }
                }
            }
            
            var done = function(url){
                
                document.querySelector('#modal_documento img').src = url;

                var form = document.querySelector("#modal_documento form");
                //var formData = new FormData(form);
                form.querySelectorAll('input')[0].value = 0;
                form.querySelectorAll('input')[2].value = files[0].name;
                form.querySelectorAll('input')[4].value = 0;

                form.querySelectorAll('.btn')[3].disabled = false;
                $('#modal_documento').modal({backdrop: 'static', keyboard: false});
            };

            if(files && files.length > 0)
            {
                reader = new FileReader();
                reader.onload = function(e)
                {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        })

        document.querySelectorAll('.content-documentos')[0].addEventListener('click', e => {

            if (e.target.classList.contains('btn-success') || e.target.offsetParent.classList.contains('btn-success')) {
                let id;
                if (e.target.classList.contains('btn-success'))
                    id = e.target.dataset.id;
                else
                    id = e.target.offsetParent.dataset.id;
        
                let xhr = new XMLHttpRequest();
                let data = `id=${id}`;
                let image = document.querySelector('#modal_ver_imagen img');
                image.style.display = "none";
                image.src = "";
                let link = document.querySelector('#modal_ver_imagen a');
                link.href = "";
                xhr.open('POST', "../EmpleadoDocumento/getOne");
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        let json_app = JSON.parse(r);
                        try {
                            if (json_app.status == 1) {
                                console.log(json_app);
                                image.src = json_app.data.image[0];
                                image.style.display = "block";
                                link.href = json_app.data.image[0];
                                link.download = json_app.data.file_name;
                                $('#modal_ver_imagen').modal('show');
                            }

                        } catch (error) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                        }
                    }
                }
            }

            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                let id;
                if (e.target.classList.contains('btn-info'))
                    id = e.target.dataset.id;
                else
                    id = e.target.offsetParent.dataset.id;
        
                let xhr = new XMLHttpRequest();
                let data = `id=${id}`;
                let form = document.querySelector('#modal_imagen form');
                form.querySelectorAll('.btn')[3].disabled = false;
                //let content_imagen = form.querySelector('.imagen');
                let image = form.querySelector('img');
                image.style.display = "none";
                image.src = "";
                xhr.open('POST', "../EmpleadoDocumento/getOne");
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        try {
                            let json_app = JSON.parse(r);
                            if (json_app.status == 1) {
                                form.querySelectorAll('input')[0].value = json_app.data.id;
                                form.querySelectorAll('input')[1].value = json_app.data.id_employee;
                                form.querySelectorAll('input')[2].value = json_app.data.file_name;
                                form.querySelectorAll('input')[3].value = 1;
                                /*let image = document.createElement('img');
                                image.setAttribute('src', json_app);
                                content_imagen.appendChild(image);*/
                                image.src = json_app.image[0];
                                image.style.display = "block";
                                $('#modal_imagen').modal({
                                    backdrop: 'static',
                                    keyboard: false
                                });
                                if (image.src == json_app.image[0]) {
                                    let cropper;
                                    $('#modal_imagen').on('shown.bs.modal', function() {
                                        cropper = null;
                                        cropper = new Cropper(image, {
                                            movable: true,
                                            zoomable: true,
                                            scalable: true,
                                            viewMode: 0,
                                            rotatable: true,
                                            preview: '.preview',
                                            ready: function(e) {
                                                document.querySelectorAll('#modal_imagen .btn-primary')[0].addEventListener('click', e => {
                                                    cropper.rotate(-45);
                                                })

                                                document.querySelectorAll('#modal_imagen .btn-primary')[1].addEventListener('click', e => {
                                                    cropper.rotate(45);
                                                })
                                            }
                                        });

                                    }).on('hidden.bs.modal', function() {
                                        cropper.destroy();
                                        cropper = null;
                                    });
                                }

                            } else {
                                form.querySelectorAll('input')[0].value = 0;
                                form.querySelectorAll('input')[1].value = 0;
                            }

                        } catch (error) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                            console.log(error);
                        }
                    }
                }
            }

            if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {
                $('#modal_delete_imagen').modal({backdrop: 'static', keyboard: false});
                let imagen;
                if (e.target.classList.contains('btn-danger')){
                    imagen = e.target.dataset.id;
                    nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
                }else{
                    imagen = e.target.offsetParent.dataset.id;
                    nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
                }
                document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[0].value = imagen;
                document.querySelector('#modal_delete_imagen form p').textContent = `¿Estás seguro(a) de que deseas eliminar la imagen ${nombre}?  `;
            }
            e.stopPropagation();
        })
    })
</script>