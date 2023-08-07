<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left mb-2">
                            <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url ?>puesto/index">Puestos</a></li>
                            <li class="breadcrumb-item active title-puesto"><?= $position->title ?></li>
                        </ol>
                    </div>

                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h4>
                                <b>Descripción del puesto </b>
                                <span class="title-puesto"> <?= $position->title ?></span>
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Datos generales</h4>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div id="content-description">
                                    <div class="row">
                                        <div class="col-sm-4 text-center">
                                            <b>Título del puesto</b>
                                            <p class="title-puesto"><?= $position->title ?></p>
                                        </div>

                                        <div class="col-sm-4 text-center">
                                            <b>Fecha de creación</b>
                                            <p><?= Utils::getDate($position->created_at) ?></p>
                                        </div>

                                        <div class="col-sm-4 text-center">
                                            <b>Tipo de puesto</b>
                                            <p id="type_position"><?= isset($position->type_position) ? Utils::getTypePosition($position->type_position) : 'Sin definir'  ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4 text-center">
                                            <b>Departamento</b>
                                            <p class="deparamento-title"><?= $position->department ?></p>
                                        </div>
                                        <div class="col-sm-4 text-center">
                                            <b>Puesto al que reporta</b>
                                            <p id="boss_position-title"><?= isset($positionName) ? $positionName : ' Sin asignar' ?></p>
                                        </div>

                                        <div class="col-sm-4 text-center">
                                            <b>Clave de ocupacion</b>
                                            <p id="clave_ocupacion_js"><?= isset($catalogoOcupaciones) && $catalogoOcupaciones != null ? $catalogoOcupaciones->descripcion : ' Sin asignar' ?></p>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <b>Sucursal</b>
                                            <p id="Nombre_Cliente"><?= $position->Nombre_cliente  ?></p>
                                        </div>
                                    </div>
                                    <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                        <div class="text-center pt-4">
                                            <button class="btn btn-info" id="btn-editar-puesto">Editar</button>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <hr>
                                <div class="content-supervising_positions">
                                    <form id="form-supervising">
                                        <label class="col-form-label" for="">Puesto(s) que supervisa</label>

                                        <select name="supervising[]" id="" multiple="multiple" class="form-control select2bs4">
                                            <?php foreach ($positionReport as $post) : ?>
                                                <option value=" <?= $post['id'] ?>" <?= in_array($post['id'], $arraySupervising) ? 'selected' : ''  ?>><?= $post['title']  ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="hidden" name="id_position" value="<?= $_GET['id'] ?>">


                                        <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                            <div class="text-center">
                                                <input type="submit" name="submit" class="btn btn-info" value="Guardar">
                                            </div>
                                        <?php endif ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Objetivo del puesto</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="content-objective">
                                    <p><?= isset($position->objective) ? $position->objective : ' Sin asignar' ?> </p>
                                </div>
                                <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                    <div class="text-center">
                                        <button class="btn btn-info" id="btn-editar-objetivo">Editar</button>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Autoridad</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="content-authority">
                                    <p><?= isset($position->authority) ? $position->authority : ' Sin asignar' ?> </p>
                                </div>
                                <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                    <div class="text-center">
                                        <button class="btn btn-info" id="btn-editar-autoridad">Editar</button>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Responsabilidades específicas</h4>
                            </div>
                            <div class="card-body">
                                <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                    <div class="text-right">
                                        <button class="btn btn-success" id="btn-nueva-responsabilidad">Registrar responsabilidad</button>
                                    </div>
                                    <div class="row text-bold">
                                        <div class="col-6">
                                            <p>Responsabilidades</p>
                                        </div>
                                        <div class="col-6">
                                            <p>Actividad</p>
                                        </div>
                                    </div>

                                    <dl id="respEspecficas">
                                        <?php foreach ($responsabilityEspec as $resp) : ?>
                                            <div class="row mt-2">
                                                <div class="col-5">
                                                    <dt class=""><?= $resp['responsability'] ?></dt>
                                                </div>
                                                <div class="col-6">
                                                    <dd class=""><?= $resp['activities'] ?></dd>
                                                </div>
                                                <div class="col-1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <button class="btn btn-info" value="<?= Encryption::encode($resp['id']) ?>"><i class="fas fa-edit"></i></button>
                                                        </div>

                                                        <div class="col-6">
                                                            <button class="btn btn-danger text-bold h4" name="<?= $_GET['id'] ?>" value="<?= Encryption::encode($resp['id']) ?>">X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </dl>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Indicadores de efectividad del puesto</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="text-right">
                                    <button class="btn btn-success" id="btn-nueva-indicadores">Registrar indicador</button>
                                </div>
                                <div id="indicadorEfectivo">
                                    <?php foreach ($effectivenessIndicatiors as $ef) : ?>
                                        <div class="row mt-2">
                                            <div class="col-11">
                                                <dt class=""><?= '- ' . $ef['indicator']  ?></dt>
                                            </div>
                                            <div class="col-1">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button class="btn btn-info" value="<?= Encryption::encode($ef['id']); ?>"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button class="btn btn-danger text-bold h4" name="<?= $_GET['id'] ?>" value="<?= Encryption::encode($ef['id']); ?>">X</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Perfil</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="content-profile">
                                    <div class="row">
                                        <div class="col-3 text-bold">
                                            Escolaridad:
                                        </div>
                                        <div class="col-3">
                                            <?= isset($position->scholarship) ? $position->scholarship : ' Sin asignar' ?>
                                        </div>
                                        <div class="col-3 text-bold">
                                            Experencia:
                                        </div>
                                        <div class="col-3">
                                            <?= isset($position->experience) ? $position->experience : ' Sin asignar' ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-3 text-bold">
                                            Estudio adicionales:
                                        </div>
                                        <div class="col-3">
                                            <?= isset($position->additional_studies) ? $position->additional_studies : ' Sin asignar' ?>
                                        </div>
                                        <div class="col-3 text-bold">
                                            Años de experiencia:
                                        </div>
                                        <div class="col-3">
                                            <?= isset($position->experience_years) ? $position->experience_years : ' Sin asignar' ?>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-3 text-bold">
                                            Idioma:
                                        </div>
                                        <div class="col-9">
                                            <?= isset($position->language) ? $position->language : ' Sin asignar' ?>
                                        </div>
                                    </div>
                                </div>


                                <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                    <div class="text-center">
                                        <button class="btn btn-info" id="btn-editar-perfil">Editar</button>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Competencias</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="text-right">
                                            <button class="btn btn-success" id="btn-nueva-conocimiento">Agregar conocimiento +</button>
                                        </div>
                                        <b>Conocimientos requeridos por el puesto</b>
                                        <div id="content_conocimiento">
                                            <?php foreach ($requiredKnowledge as $req) : ?>
                                                <div class="row">
                                                    <div class="col-9">
                                                        <?= $req['knowledge'] ?>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button class="btn btn-info" value="<?= Encryption::encode($req['id']) ?>"><i class="fas fa-edit"></i></button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="btn btn-danger text-bold h4" value="<?= Encryption::encode($req['id']) ?>" name="<?= $_GET['id']  ?>">X</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="text-right">
                                            <button class="btn btn-success" id="btn-nueva-habilidades">Agregar habilidad +</button>
                                        </div>
                                        <b>Habilidades interpersonales</b>
                                        <div id="content_habilidades">
                                            <?php foreach ($interpersonalSkills as $inter) : ?>
                                                <div class="row">
                                                    <div class="col-9">
                                                        <?= $inter['skill'];  ?>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button class="btn btn-info" value="<?= Encryption::encode($inter['id'])  ?>"><i class="fas fa-edit"></i></button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="btn btn-danger text-bold h4" value="<?= Encryption::encode($inter['id']) ?>" name="<?= $_GET['id'] ?>">X</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card card-info">
                            <div class="card-header">
                                <h4 class="card-title">Plan de carrera</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="form_plan_carrera">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <b>Puesto(s) a aspirar en la empresa</b>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="positionsToAspire[]" id="" multiple="multiple" class="form-control select2bs4">
                                                <?php foreach ($positionReport as $post) : ?>
                                                    <option value=" <?= Encryption::encode($post['id']) ?>" <?= in_array($post['id'], $arrayToSupervising) ? 'selected' : ''  ?>><?= $post['title']  ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                                 <div class="row">
                                        <div class="col-sm-3">
                                            <b>Revisado por:</b>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="reviewed_by" class="form-control">
                                                <option value="">Sin definir</option>
                                                <?php foreach ($employes as $emplos) : ?>
                                                    <option value=" <?= Encryption::encode($emplos['id_employee']) ?>" <?= isset($position->id_reviewed_by) && $position->id_reviewed_by == $emplos['id_employee'] ? 'selected' : ''  ?>><?= $emplos['employePosition']  ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <b>Aprobado por:</b>
                                        </div>
                                        <div class="col-sm-6">
                                            <select name="approved_by" class="form-control">
                                                <option value="">Sin definir</option>
                                                <?php foreach ($employes as $emplo) : ?>
                                                    <option value=" <?= Encryption::encode($emplo['id_employee']) ?>" <?= isset($position->id_approved_by) && $position->id_approved_by == $emplo['id_employee'] ? 'selected' : ''  ?>><?= $emplo['employePosition']  ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id_position" value="<?= $_GET['id'] ?>">

                                    <?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?>
                                        <div class="text-center">
                                            <input type="submit" name="submit" class="btn btn-info" value="Guardar">
                                        </div>
                                    <?php endif ?>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 float-left">
                                <a class="btn btn-orange" href="<?= base_url ?>puesto/puestoFormato&id=<?= $_GET['id']  ?>" target="_blank">Descargar Descripcion de Puesto</a>
                            </div>


                            <div class="col-sm-2 float-right" id="divEliminarPuesto">
                                <button class="btn <?= $position->status == 1 ? 'btn-danger ' : 'btn-success' ?>  " value="<?= $_GET['id']  ?>" data-estatus="<?= $position->status ?>"> <?= $position->status == 1 ? 'Eliminar puesto' : 'Reactivar puesto' ?></button>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
</div>
<script type="text/javascript" src="<?= base_url ?>app/RH/position.js?v=<?= rand() ?>"></script>

<<?php if (Utils::isAdmin() || Utils::isCustomerSA()) : ?> <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', e => {
    document.querySelector('#btn-editar-puesto').addEventListener('click', e => {
    e.preventDefault();
    let position = new Position();

    $('#modal_general').modal({
    backdrop: 'static',
    keyboard: false
    });
    })

    document.querySelector('#modal_general form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.update_datosGeneral();
    });


    document.querySelector('#btn-editar-objetivo').addEventListener('click', e => {
    e.preventDefault();
    $('#modal_objective').modal({
    backdrop: 'static',
    keyboard: false
    });
    })

    document.querySelector('#btn-editar-autoridad').addEventListener('click', e => {
    e.preventDefault();
    $('#modal_authority').modal({
    backdrop: 'static',
    keyboard: false
    });
    })

    document.querySelector('#modal_authority form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.updateAuthority();
    });


    document.querySelector('#btn-nueva-responsabilidad').addEventListener('click', e => {
    e.preventDefault();
    var form = document.querySelector("#modal_responsability form");
    form.querySelectorAll('input')[2].value = 1
    form.reset();

    $('#modal_responsability').modal({
    backdrop: 'static',
    keyboard: false });
    })

    document.querySelector('#modal_objective form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.update_objective();
    });

    document.querySelector('#modal_responsability form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.save_responsability();
    });

    document.querySelector('#modal_indicators form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.save_indicator();
    });

    document.querySelector('#modal_profile form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.updateProfile();
    });

    document.querySelector('#btn-nueva-indicadores').addEventListener('click', e => {
    e.preventDefault();
    var form = document.querySelector("#modal_indicators form");
    form.querySelectorAll('input')[1].value = 1
    form.reset();

    $('#modal_indicators').modal({
    backdrop: 'static',
    keyboard: false});
    })

    document.querySelector('#btn-editar-perfil').addEventListener('click', e => {
    e.preventDefault();
    $('#modal_profile').modal({
    backdrop: 'static',
    keyboard: false
    });
    })

    document.querySelector('#btn-nueva-conocimiento').addEventListener('click', e => {
    e.preventDefault();
    var form = document.querySelector("#modal_knowledge form");
    form.reset();
    form.querySelectorAll('input')[1].value = 1
    $('#modal_knowledge').modal({
    backdrop: 'static',
    keyboard: false
    });
    })

    document.querySelector('#modal_knowledge form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.save_knowledge();
    });

    document.querySelector('#btn-nueva-habilidades').addEventListener('click', e => {
    e.preventDefault();
    var form = document.querySelector("#modal_skills form");
    form.querySelectorAll('input')[1].value = 1
    form.reset();
    $('#modal_skills').modal({
    backdrop: 'static',
    keyboard: false
    });
    })


    document.querySelector('#modal_skills form').addEventListener('submit', e => {
    e.preventDefault();
    let position = new Position();
    position.save_skills();



    });


    })
    </script>



    <script>
        var respEspecficas = document.querySelector('#respEspecficas');
        respEspecficas.addEventListener('click', function(e) {
            let position = new Position();
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                if (e.target.offsetParent.classList.contains('btn-info')) {
                    position.getResponsability(e.target.offsetParent.value);
                } else {
                    position.getResponsability(e.target.value);
                }
                $('#modal_responsability').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }


            if (e.target.classList.contains('btn-danger')) {
                let id = e.target.value,
                    id_position = e.target.name
                Swal.fire({
                    title: '¿Quieres eliminar esta actividad?',
                    //text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        position.deleteResponsability(id, id_position);
                    }
                })
            }
        })

        var indicadorEfectivo = document.querySelector('#indicadorEfectivo')
        indicadorEfectivo.addEventListener('click', function(e) {
            let position = new Position();
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                if (e.target.offsetParent.classList.contains('btn-info')) {
                    position.getIndicators(e.target.offsetParent.value);
                } else {
                    position.getIndicators(e.target.value);
                }
                $('#modal_indicators').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            if (e.target.classList.contains('btn-danger')) {
                let id = e.target.value,
                    id_position = e.target.name
                Swal.fire({
                    title: '¿Quieres eliminar este indicador?',
                    //text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        position.deleteIndication(id, id_position);
                    }
                })
            }
        })



        var content_habilidades = document.querySelector('#content_habilidades')
        content_habilidades.addEventListener('click', function(e) {
                let position = new Position();
                if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                    if (e.target.offsetParent.classList.contains('btn-info')) {

                        position.getHabilidades(e.target.offsetParent.value);
                    } else {
                        position.getHabilidades(e.target.value);
                    }
                    $('#modal_skills').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }


                if (e.target.classList.contains('btn-danger')) {
                    let id = e.target.value,
                        id_position = e.target.name
                    Swal.fire({
                        title: '¿Quieres eliminar esta habilidad?',
                        //text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Eliminar'
                    }).then((result) => {
                        if (result.value == true) {
                            position.deleteHabilidades(id, id_position);
                        }
                    })
                }
            })

            /
            document.querySelector('#divEliminarPuesto').addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger') || e.target.classList.contains('btn-success') || e.target.parentElement.classList.contains('btn-success')) {
                    e.preventDefault();

                    console.log(e.target.getAttribute("data-estatus"));

                    let id = e.target.value == undefined ? e.target.parentElement.value : e.target.value;
                    let status = e.target.getAttribute("data-estatus");
                    let estado = status == 0 ? 'reactivar' : 'eliminar';
                    Swal.fire({
                        title: '¿Quieres ' + estado + ' este puesto?',
                        text: "El puesto aun aparecera en los empleados que lleven asignado este puesto.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: status == 0 ? '#5cb85c' : '#d33',
                        cancelButtonColor: '#6c757d',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: status == 0 ? 'Reactivar' : 'Eliminar'
                    }).then((result) => {
                        if (result.value == true) {
                            let position = new Position();
                            position.updateSatusPosition(id);
                        }
                    })

                }
            })


        document.querySelector('#form-supervising').addEventListener('submit', e => {
            e.preventDefault();
            let position = new Position();
            position.updateSupervising();
        });


        document.querySelector('#form_plan_carrera').addEventListener('submit', e => {
            e.preventDefault();
            let position = new Position();
            position.updatePlanCarrera();
        });

        var content_conocimiento = document.querySelector('#content_conocimiento')
        content_conocimiento.addEventListener('click', function(e) {
            let position = new Position();
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                if (e.target.offsetParent.classList.contains('btn-info')) {

                    position.getConocimientos(e.target.offsetParent.value);
                } else {
                    position.getConocimientos(e.target.value);
                }
                $('#modal_knowledge').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
            if (e.target.classList.contains('btn-danger')) {
                let id = e.target.value,
                    id_position = e.target.name
                Swal.fire({
                    title: '¿Quieres eliminar este conocimiento?',
                    //text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        position.deleteConocimientos(id, id_position);
                    }
                })
            }
        })
    </script>
<?php endif ?>