<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left mb-2">
                        <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url . "vacante/index" ?>">Vacantes</a></li>
                        <li class="breadcrumb-item active"><?= $vacante->vacancy ?></li>
                    </ol>
                </div>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h1><?= $vacante->vacancy ?> T</h1>
                    </div>
                </div><!-- /.col -->
            </div>
            <div class="row">
                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSales()) : ?>
                    <div class="col-sm-4 mr-auto">
                        <button class="btn btn-lg btn-outline-orange btn-flat btn-app float-left" onclick="duplicate(this)"><i class="fas fa-clone"></i> Duplicar vacante</button>
                    </div>
                <?php endif ?>
                <div class="col-sm-4 mx-auto">
                    <div class="alert <?= $class_color ?>">
                        <h6 class="text-center"><?= $vacante->vacancy_status ?></h6>
                    </div>
                </div>
                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSenior()) : ?>
                    <div class="col-sm-4 ml-auto">
                        <?php //if ($vacante->send_date != NULL): 
                        ?>
                        <button class="btn btn-lg btn-outline-info btn-flat float-right" onclick="restartDate()">Reactivar búsqueda</button>
                        <?php //endif 
                        ?>
                    </div>
                <?php endif ?>
            </div>
            <br>
            <input type="hidden" id="id" value="<?= $vacante->id_vacancy ?>">
            <div class="row">
                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSenior()) : ?>
                    <div class="col-md-5 mx-auto">
                        <?php if ($vacante->id_status == 1) : ?>
                            <button class="btn btn-success" onclick="changeStatus1()">Envío completado</button>
                        <?php endif ?>
                        <?php if ($vacante->id_status == 2) : ?>
                            <!-- <button class="btn btn-orange" onclick="changeStatus2()">En entrevistas</button> -->
                        <?php endif ?>
                        <?php if ($vacante->id_status == 3) : ?>
                            <button class="btn btn-outline-danger" onclick="changeStatus1()">Envío completado</button>
                            <!-- <button class="btn btn-outline-secondary" onclick="changeStatus3()">En seguimiento</button> -->
                        <?php endif ?>
                        <?php if ($vacante->id_status <= 8) : ?>
                            <!-- <button class="btn btn-warning" onclick="changeStatus7()">Stand by</button> -->
                            <button class="btn btn-maroon" onclick="changeStatus4()">Cerrado</button>
                            <button class="btn btn-outline-danger" onclick="changeStatus5()">Cancelado con cobro</button>
                            <button class="btn btn-outline-secondary" onclick="changeStatus6()">Cancelado sin cobro</button>
                            <button class="btn btn-outline-dark" onclick="changeStatus9()">No ingresado</button>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-2 mx-auto h6">
                    <?php if ($vacante->salary_min != $vacante->salary_max) : ?>
                        <b><?= '$' . number_format($vacante->salary_min) . ' - $' . number_format($vacante->salary_max) . ' (mensual)' ?></b>
                    <?php else : ?>
                        <b><?= '$' . number_format($vacante->salary_min) . ' (mensual)' ?></b>
                    <?php endif ?>
                </div>
                <div class="col-sm-2 mx-auto h6">
                    <p><?= $vacante->city . ', ' . $vacante->state ?></p>
                </div>
                <div class="col-sm-2 mx-auto h6">
                    <p class="text-muted"><?= Utils::getDate($vacante->request_date) ?></p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-success">
                        <div class="card-header">
                            <h4 class="card-title">Perfil del Puesto</h4>

                            <!-- <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon <?= $class_color ?>">
                          <?= $vacante->vacancy_status ?>
                        </div>
                    </div> -->
                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSalesManager()  || Utils::isSales()) : ?>
                                <!-- GABOOOOOO -->
                                <button class="btn btn-info btn-modal  float-right" id="editar-perfil"> <i class="fas fa-pencil-alt"></i> </button>
                            <?php endif ?>

                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Nombre del puesto</b>
                                    <p id="vacancy"><?= $vacante->vacancy ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Departamento</b>
                                    <p id="department"><?= $vacante->department ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Tipo de vacante</b>
                                    <?php
                                    // 25 abril 2023
                                    switch ($vacante->type) {
                                        case 1:
                                            $type = 'Operativa';
                                            break;
                                        case 2:
                                            $type = 'Orden Común';
                                            break;
                                        case 3:
                                            $type = 'Head Hunting';
                                            break;
										case 4:
                                            $type = 'Iguala';
											break;
                                        default:
                                            $type = '';
                                            break;
                                    }
                                    // fin 
                                    ?>
                                    <p id="type"><?= $type ?></p>
                                </div>
                            </div>

                            <?php if ($vacante->report_to != '') : ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Puesto al que le reportará</b>
                                        <p id="report_to"><?= $vacante->report_to ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <b>¿Tendrá personal a cargo?</b>
                                        <p id="personal_in_charge"><?= $in_charge = ($vacante->personal_in_charge == 1) ? 'Sí' : 'No' ?></p>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Área</b>
                                    <p id="area"><?= $vacante->area ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Subárea</b>
                                    <p id="subarea"><?= $vacante->subarea ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Tiempo de Garantía</b>
                                    <p id="warranty_time"><?= $vacante->warranty_time . ' días' ?></p>
                                </div>
                            </div>
                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSalesManager() || Utils::isSenior()) : ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Monto a facturar</b>
                                        <p id="amount_to_invoice"><?= '$ ' . number_format($vacante->amount_to_invoice, 2) ?></p>
                                    </div>

                                    <?php if ($vacante->authorization_date) : ?>
                                        <div class="col-md-4">
                                            <b>Fecha de autorización</b>
                                            <p id="authorization_date"><?= Utils::getFullDate($vacante->authorization_date) ?></p>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($vacante->commitment_date) : ?>
                                        <div class="col-md-4">
                                            <b>Fecha de compromiso de envío</b>
                                            <p id="commitment_date"><?= Utils::getDate($vacante->commitment_date) ?></p>
                                        </div>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <b>Ciudad y estado</b>
                                    <p id="city_and_state"><?= $vacante->city . ', ' . $vacante->state ?></p>
                                </div>
                                <?php if ($vacante->working_day) : ?>
                                    <div class="col-md-4">
                                        <b>Jornada Semanal</b>
                                        <p id="working_day"><?= $vacante->working_day ?> hrs</p>
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-4">
                                    <b>Sueldo base mensual</b>
                                    <?php if ($vacante->salary_min != $vacante->salary_max) : ?>
                                        <p id="salary_min_and_salary_max"><?= '$' . number_format($vacante->salary_min) . ' - $' . number_format($vacante->salary_max) . ' (mensual)' ?></p>
                                    <?php else : ?>
                                        <p id="salary_min"><?= '$' . number_format($vacante->salary_min) . ' (mensual)' ?></p>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h4 class="card-title">Descripción del Puesto</h4>
                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSalesManager() ||  Utils::isSales()) : ?>
                                <!-- gaboooo -->
                                <button class="btn btn-success btn-modal  float-right" id="editar-descripcion"> <i class="fas fa-pencil-alt"></i> </button>
                            <?php endif ?>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Escolaridad requerida</b>
                                    <p id="education_level"><?= $vacante->level ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Número de posiciones requeridas</b>
                                    <p id="position_number"><?= $vacante->position_number ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Años o meses de experiencia</b>
                                    <p id="experience_years"><?= $years = ($vacante->experience_years == 0) ? 'Sin experiencia' : $vacante->experience_years . ' ' . $vacante->experience_type ?></p>
                                </div>
                            </div>
                            <?php if ($vacante->experience != NULL) : ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Experiencias</b>
                                        <p><?= Utils::lineBreak($vacante->experience) ?></p>
                                    </div>
                                </div>
                            <?php endif ?>


                            <?php if ($vacante->skills != NULL) : ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Habilidades</b>
                                        <p><?= Utils::lineBreak($vacante->skills) ?></p>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if ($vacante->technical_knowledge != '') : ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Conocimientos técnicos</b>
                                        <p><?= Utils::lineBreak($vacante->technical_knowledge) ?></p>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Edad</b>
                                    <p id="age"><?= 'entre ' . $vacante->age_min . ' y ' . $vacante->age_max . ' años' ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Sexo</b>
                                    <p id="gender"><?= $vacante->gender ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Estado civil</b>
                                    <p id="civil_status"><?= $vacante->status ?></p>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4">
                                    <b>Idioma y nivel</b>
                                    <p id="language"><?= $vacante->language . ' ' . $vacante->language_level ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Días de trabajo</b>
                                    <p id="workdays"><?= $vacante->workdays ?></p>
                                </div>
                                <div class="col-md-4">
                                    <b>Horarios</b>
                                    <p id="schedule"><?= $vacante->schedule ?></p>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <b>Que experiencia debe haber desarrollado:</b>
                                    <p id="requeriments"><?= Utils::lineBreak($vacante->requirements) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <b>Puestos que pudo haber ocupado</b>
                                    <p id="functions"><?= Utils::linebreak($vacante->functions) ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <b>Prestaciones o beneficios</b>
                                    <p id="benefits"><?= Utils::lineBreak($vacante->benefits) ?></p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <?php if (!Utils::isCustomer() && false) : ?>

                        <div class="card card-danger">
                            <div class="card-header">
                                <h4 class="card-title">Proceso del cliente</h4>
                            </div>
                            <div class="card-body">
                                <?php if ($vacante->how_many_interviews != 0) : ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>¿Cuántas entrevistas se preveen que se realicen?</b>
                                            <p><?= $vacante->how_many_interviews ?></p>
                                        </div>
                                        <?php if ($vacante->accept_reentry != NULL) : ?>
                                            <div class="col-md-6">
                                                <b>¿Se aceptan reingresos?</b>
                                                <p><?= $reentry = ($vacante->accept_reentry == 1) ? 'Sí' : 'No' ?></p>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="row">
                                        <?php if ($vacante->offer_transportation != NULL) : ?>
                                            <div class="col-md-6">
                                                <b>¿Ofrecen transporte?</b>
                                                <p><?= $transportation = ($vacante->offer_transportation) ? 'Sí' : 'No' ?></p>
                                            </div>
                                        <?php endif ?>
                                        <?php if ($vacante->do_medical_exam != NULL) : ?>
                                            <div class="col-md-6">
                                                <b>¿Realizan exámen médico?</b>
                                                <p><?= $medical = ($vacante->do_medical_exam) ? 'Sí' : 'No' ?></p>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>

                                <div class="row">
                                    <div class="col">
                                        <b>¿Cuánto timepo tiene sin cubrir esta vacante?</b>
                                        <p><?= $vacante->time_without_filling ?></p>
                                    </div>
                                    <div class="col">
                                        <b>¿Están trabajando con alguna otra agencia de reclutamiento?</b>
                                        <p><?= $vacante->another_agency == 1 ? 'Sí' : ($vacante->another_agency == 0 ? 'No' : '') ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif ?>


                    <?php if (!Utils::isCustomer() || !Utils::isCustomerSA()) : ?>
                        <div class="card card-purple">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Condiciones Comerciales
                                </h4>
                                <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSalesManager() ||  Utils::isSales()) : ?>
                                    <!-- gaboooooo -->
                                    <button class="btn btn-info btn-modal  float-right" id="editar-condiciones"> <i class="fas fa-pencil-alt"></i> </button>
                                <?php endif ?>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <b>Fecha de envio de candidatos</b>
                                        <p id="send_date_candidate"><?= Utils::getDate($vacante->send_date_candidate) ?></p>
                                    </div>

                                    <div class="col-md-3">
                                        <b>Cantidad anticipo</b>
                                        <p id="advance_payment"><?= number_format($vacante->advance_payment, 2) ?> pesos</p>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Gastos administrativos</b>
                                        <p id="payment_amount"><?= number_format($vacante->payment_amount, 2) ?> pesos</p>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Porcentaje a facturar</b>
                                        <p id="recruitment_service_cost"><?= number_format($vacante->recruitment_service_cost, 0) ?>%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h4 class="card-title">Contacto</h4>
                            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSalesManager() || Utils::isSales()) : ?>
                                <!-- gabo -->
                                <button class="btn btn-info btn-modal  float-right" id="editar-contacto"> <i class="fas fa-pencil-alt"></i> </button>
                            <?php endif ?>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong>
                                <i class="fas fa-building"></i>
                                Empresa
                            </strong>
                            <p class="text-muted" id="customer"><?= $vacante->customer ?></p>
                            <hr>

                            <?php if ($vacante->customer_contact != NULL) : ?>
                                <strong>
                                    <i class="fas fa-user-circle"></i>
                                    Contacto
                                </strong>
                                <p class="text-muted" id="customer_contact"><?= $vacante->customer_contact ?></p>
                            <?php endif ?>

                            <?php if ($vacante->position != NULL) : ?>
                                <strong>
                                    <i class="fas fa-star"></i>
                                    Posición
                                </strong>
                                <p class="text-muted"><?= $vacante->position ?></p>
                            <?php endif ?>

                            <strong>
                                <i class="fas fa-envelope"></i>
                                Dirección de correo
                            </strong>
                            <p class="text-muted"><?= $vacante->customer_contact_email ?></p>

                            <?php if ($vacante->telephone != NULL) : ?>
                                <strong>
                                    <i class="fas fa-phone"></i>
                                    Teléfono
                                </strong>
                                <p class="text-muted"><?= $vacante->telephone ?></p>
                            <?php endif ?>

                            <?php if ($vacante->cellphone != NULL) : ?>
                                <strong>
                                    <i class="fas fa-mobile-alt"></i>
                                    Celular
                                </strong>
                                <p class="text-muted"><?= $vacante->cellphone ?></p>
                            <?php endif ?>

                            <hr>
                            <strong>
                                <i class="fas fa-user-tie"></i>
                                Reclutador
                            </strong>
                            <p class="text-muted" id="recruiter"><?= $vacante->recruiter ?></p>
                            <hr>
                            <strong>
                                <i class="fas fa-registered"></i>
                                Razón social
                            </strong>
                            <p class="text-muted" id="business_name"><?= $vacante->business_name ?></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php if ($vacante->comments != NULL) : ?>
                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Comentarios</h4>
                            </div>
                            <div class="card-body">
                                <strong>
                                    Comentarios
                                </strong>
                                <p class="text-muted" id="comments"><?= $vacante->comments ?></p>
                            </div>
                        </div>
                    <?php endif ?>

                    <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSales()) : ?>
                        <div class="row">

                            <div class="col-6">


                                <a href="<?= base_url ?>vacante/vacantePDF&id=<?= $_GET['id'] ?>" class="btn btn-orange w-100 p-3 text-bold">Descargar propuesta</a>
                            </div>
                            <div class="col-6">
                                <a href="<?= base_url ?>vacante/entregableVacante&id=<?= $_GET['id'] ?>" class="btn btn-success w-100 p-3 text-bold">Descargar Entregable</a>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
<script src="<?= base_url ?>app/vacancy.js?v=<?= rand() ?>"></script>

<script type="text/javascript">
    function changeStatus1() {
        let vacancy = new Vacancy();
        vacancy.changeStatus1();
    }

    function changeStatus2() {
        let vacancy = new Vacancy();
        vacancy.changeStatus2();
    }

    function changeStatus3() {
        let vacancy = new Vacancy();
        vacancy.changeStatus3();
    }

    function changeStatus4() {
        let vacancy = new Vacancy();
        vacancy.changeStatus4();
    }

    function changeStatus5() {
        let vacancy = new Vacancy();
        vacancy.changeStatus5();
    }

    function changeStatus6() {
        let vacancy = new Vacancy();
        vacancy.changeStatus6();
    }

    function changeStatus7() {
        let vacancy = new Vacancy();
        vacancy.changeStatus7();
    }

    function changeStatus9() {
        let vacancy = new Vacancy();
        vacancy.changeStatus9();
    }

    function restartDate() {
        let vacancy = new Vacancy();
        vacancy.restartDate();
    }

    function duplicate(e) {
        e.disabled = true;
        let vacancy = new Vacancy();
        vacancy.duplicate();
    }




    document.querySelector('#editar-perfil').addEventListener('click', e => { ///gabo
        e.preventDefault();

        $('#modal_perfil').modal({
            backdrop: 'static',
            keyboard: false
        });


    });
    document.querySelector('#editar-descripcion').addEventListener('click', e => { ///gabo
        e.preventDefault();
        $('#modal_descripcion').modal({
            backdrop: 'static',
            keyboard: false
        });


    });

    document.querySelector('#editar-contacto').addEventListener('click', e => { ///gabo
        e.preventDefault();
        $('#modal_contacto').modal({
            backdrop: 'static',
            keyboard: false
        });


    });

    document.querySelector('#editar-condiciones').addEventListener('click', e => { ///gabo
        e.preventDefault();
        $('#modal_condiciones').modal({
            backdrop: 'static',
            keyboard: false
        });


    });
</script>