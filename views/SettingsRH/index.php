<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h3>Configuraciones</h3>
                        </div>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
							 <li class="nav-item">
                                <a class="nav-link active  ml-2" href="#tabla-holidays" data-toggle="tab">Dias
                                    Festivos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="false">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-worker-days-tab" data-toggle="pill" href="#custom-tabs-four-worker-days" role="tab" aria-controls="custom-tabs-four-worker-days" aria-selected="false">Días laborales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-holidays-tab" data-toggle="pill" href="#custom-tabs-four-holidays" role="tab" aria-controls="custom-tabs-four-holidays" aria-selected="true">Vacaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Permisos de usuario</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade  show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                <div class="row">
                                    <form method="post" class="form_image_Cliente" enctype="multipart/form-data">
                                        <input type="hidden" name="ID_Empresa" value="<?= $cliente['Empresa'] ?>">
                                        <input type="hidden" name="ID_Cliente" value="<?= $cliente['Cliente'] ?>">
                                        <label for="ID_Cliente" class="col-form-label">Logo de la empresa</label>
                                        <div class="col-md-8 mx-auto">
                                            <img src="<?= $cliente['logo'] ? $cliente['logo'] : base_url . 'dist/img/image_unavailable.jpg' ?>">
                                        </div>
                                        <div id="content-buttons-logo">
                                            <?php if ($cliente['logo']) : ?>
                                                <button class="btn btn-success btn-watch-photo"><i class="fas fa-eye"></i> Ver</button>
                                                <button class="btn btn-info btn-edit-photo"><i class="fas fa-pencil-alt mr-1"></i> Editar</button>
                                                <button class="btn btn-danger btn-delete-photo"><i class="fas fa-times mr-1"></i> Borrar</button>
                                            <?php endif ?>
                                        </div>

                                        <label class="btn btn-orange ml-2">
                                            <input type="file" class="d-none btn-upload-photo" accept="image/x-png,image/gif,image/jpeg"><i class="fas fa-upload"> Subir logo</i>
                                        </label>
                                    </form>
                                </div>
                                <hr>
                                <button class="btn btn-info btn-sm float-right btn-legal-representative"><i class="fas fa-pencil-alt"></i></button>
                                <b>Representante Legal</b>
                                <p><?= $cliente['Representante_Legal'] ?><br></p>

                                <hr>
                                <?php foreach ($representatives as $worker) : ?>
                                    <button class="btn btn-info btn-sm float-right btn-representative" data-representative="<?=$worker['id']?>"><i class="fas fa-pencil-alt"></i></button>
                                    <p><?= $worker['full_name'] ?></p>
                                <?php endforeach ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-worker-days" role="tabpanel" aria-labelledby="custom-tabs-four-worker-days-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Días de la semana laborales</h4>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool btn-edit" id="btn-edit-workdays"><i class="far fa-edit"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <th class="text-center">Día</th>
                                                <th class="text-center">Laboral</th>
                                            </thead>
                                            <tbody id="table-workdays">
                                                <tr>
                                                    <td class="text-center">Domingo</td>
                                                    <td class="text-center"><?= $workdays && $workdays->sunday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Lunes</td>
                                                    <td class="text-center"><?= $workdays && $workdays->monday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Martes</td>
                                                    <td class="text-center"><?= $workdays && $workdays->tuesday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Miércoles</td>
                                                    <td class="text-center"><?= $workdays && $workdays->wednesday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Jueves</td>
                                                    <td class="text-center"><?= $workdays && $workdays->thursday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Viernes</td>
                                                    <td class="text-center"><?= $workdays && $workdays->friday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Sábado</td>
                                                    <td class="text-center"><?= $workdays && $workdays->saturday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' ?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-holidays" role="tabpanel" aria-labelledby="custom-tabs-four-holidays-tab">
                                <section class="content-header">
                                    <div class="row">
                                        <div class="col-sm-2 ml-auto">
                                            <button class="btn btn-orange float-right" id="btn_new_policy">Crear Política</button>
                                        </div>
                                    </div>
                                </section>
                                <section class="content" id="policies-content">
                                    <div class="row mt-3 ">
                                        <?php foreach ($policies as $policy) :  ?>
                                            <div class="col-md-4">
                                                <div class="card collapsed-card">
                                                    <div class="card-header">
                                                        <h4 class="card-title"><?= $policy['name'] ?></h4>
                                                        <div class="card-tools">
                                                            <?php if ($policy['id'] != 1) : ?>
                                                                <button type="button" class="btn btn-tool btn-edit" data-id="<?= $policy['id'] ?>"><i class="far fa-edit"></i>
                                                                </button>
                                                            <?php endif; ?>
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <th class="text-center">Años laborados</th>
                                                                <th class="text-center">Días de vacaciones</th>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($policy['holidays'] as $holiday) : ?>
                                                                    <tr>
                                                                        <td class="text-center"><?= $holiday['years'] ?></td>
                                                                        <td class="text-center"><?= $holiday['holidays'] ?></td>
                                                                    </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                                <table id="tb_users" class="table table-sm table-striped">
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
										<th></th>
									  </tr>
									</thead>
									<tbody>
									  <?php foreach ($contactos as $contacto) : ?>
										<tr>
										  <td><?= $contacto['Nombre_Contacto'] . ' ' . $contacto['Apellido_Contacto'] ?></td>
										  <td><?= $contacto['Puesto'] ?></td>
										  <td><?= $contacto['Correo'] ?></td>
										  <td><?= $contacto['Telefono'] ?></td>
										  <td><?= $contacto['Extension'] ?></td>
										  <td><?= $contacto['Celular'] ?></td>
										  <td><?= $contacto['Fecha_Cumpleaños'] ?></td>
										  <td><?= $contacto['Usuario'] ?></td>
										  <td class="text-center py-0 align-middle">
											<div class="btn-group btn-group-sm">
											  <button class="btn btn-warning" data-id="<?= Encryption::encode($contacto['id_user']) ?>">
												<i class="fas fa-lock"></i>
											  </button>
											</div>
										  </td>
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
										<th></th>
									  </tr>
									</tfoot>
							  </table>
                            </div>
							
							
							 <div class="tab-pane active show" id="tabla-holidays">
                                <?php require_once 'views/SettingsRH/Holidays/tablaHolidays.php';
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </section>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        var new_image = document.querySelector('#modal_imagen img');

        document.querySelector('#content-buttons-logo').addEventListener('click', e => {
            if (e.target.classList.contains('btn-watch-photo') || e.target.parentElement.classList.contains('btn-watch-photo')) {
                document.querySelector('#modal_ver_imagen img').src = document.querySelector('.form_image_Cliente img').src;
                document.querySelector('#modal_ver_imagen .btn-primary').href = document.querySelector('#modal_ver_imagen img').src;
                $('#modal_ver_imagen').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            if (e.target.classList.contains('btn-edit-photo') || e.target.parentElement.classList.contains('btn-edit-photo')) {
                new_image.src = document.querySelector('.form_image_Cliente img').src;
                $('#modal_imagen').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                let cropper;
                $('#modal_imagen').on('shown.bs.modal', function() {
                    cropper = null;
                    cropper = new Cropper(new_image, {
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

            if (e.target.classList.contains('btn-delete-photo') || e.target.parentElement.classList.contains('btn-delete-photo')) {
                $('#modal_delete_imagen').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                document.querySelectorAll('#modal_delete_imagen form p')[0].textContent = `¿Estás seguro de que quieres eliminar el logo?`;
                let form = document.querySelector('.form_image_Cliente');
                document.querySelectorAll('#modal_delete_imagen input')[0].value = form.querySelectorAll('input')[0].value;
                document.querySelectorAll('#modal_delete_imagen input')[1].value = form.querySelectorAll('input')[1].value;
            }
            e.preventDefault();
            e.stopPropagation();
        })

        document.querySelector('.btn-upload-photo').addEventListener('change', e => {
            if (e.target.classList.contains('btn-upload-photo') || e.target.parentElement.classList.contains('btn-upload-photo')) {

                var files = e.target.files;
                var done = function(url) {
                    new_image.src = url;

                    let form = document.querySelector('.form_image_Cliente');
                    document.querySelectorAll('#modal_imagen input')[0].value = form.querySelectorAll('input')[0].value;
                    document.querySelectorAll('#modal_imagen input')[1].value = form.querySelectorAll('input')[1].value;

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
                maxHeight: 900
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;

                    var form = document.querySelector("#modal_imagen form");
                    let ID_Empresa = form.querySelectorAll('input')[0].value;
                    let ID_Cliente = form.querySelectorAll('input')[1].value;

                    form.querySelectorAll('.btn-orange')[0].disabled = true;

                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '../Empresa_SA/upload_image64');
                    let data = `ID_Empresa=${ID_Empresa}&ID_Cliente=${ID_Cliente}&logo=${base64data}`;
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send(data);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            let r = this.responseText;
                            try {
                                let json_app = JSON.parse(r);
                                if (json_app.status == 1) {
                                    if (ID_Cliente != '' && ID_Cliente != 0) {
                                        document.querySelector('.form_image_Cliente img').src = json_app.logo;
                                        console.log(ID_Cliente);
                                    }
                                    document.querySelector('#content-buttons-logo').innerHTML = `
                                        <button class="btn btn-success btn-watch-photo"><i class="fas fa-eye"></i> Ver</button>
                                        <button class="btn btn-info btn-edit-photo"><i class="fas fa-pencil-alt mr-1"></i> Editar</button>
                                        <button class="btn btn-danger btn-delete-photo"><i class="fas fa-times mr-1"></i> Borrar</button>
                                    `;
                                    utils.showToast('Logo cargado exitosamente', 'success');
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
        }

        document.querySelector('#modal_delete_imagen').onsubmit = function(e) {
            e.preventDefault();

            var form = document.querySelector("#modal_delete_imagen form");
            let ID_Empresa = form.querySelectorAll('input')[0].value;
            let ID_Cliente = form.querySelectorAll('input')[1].value;

            form.querySelectorAll('.btn-danger')[0].disabled = true;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../Empresa_SA/delete_image64');
            let data = `ID_Empresa=${ID_Empresa}&ID_Cliente=${ID_Cliente}`;
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(data);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = this.responseText;
                    console.log(r);
                    try {
                        let json_app = JSON.parse(r);
                        if (json_app.status == 1) {
                            if (ID_Cliente != '' && ID_Cliente != 0) {
                                document.querySelector('.form_image_Cliente img').src = json_app.logo;
                                console.log(ID_Cliente);
                            } else if (ID_Empresa > 0 && ID_Empresa != '') {
                                document.querySelector('.form_image_Cliente img').src = json_app.logo;
                                console.log(ID_Empresa);
                            }
                            document.querySelector('#content-buttons-logo').innerHTML = '';
                            utils.showToast('Logo eliminado exitosamente', 'success');
                            $('#modal_delete_imagen').modal('hide');
                            form.querySelectorAll('.btn-danger')[0].disabled = false;
                        }
                    } catch (error) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                        form.querySelectorAll('.btn-danger')[0].disabled = false;
                    }
                }
            }
        }
    })
</script>
<script>
    document.addEventListener('DOMContentLoaded', e => {
    /**workdays */
        document.querySelector('#modal_workdays form').addEventListener('submit', e => {
            e.preventDefault();
            var form = document.querySelector("#modal_workdays form");
            var formData = new FormData(form);
            form.querySelectorAll('.btn')[1].disabled = true;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../ConfiguracionesRH/saveWorkdays');
            xhr.send(formData);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = this.responseText;
                    console.log(r);
                    try {
                        let json_app = JSON.parse(r);
                        if (json_app.status == 1) {
                            document.querySelector('#table-workdays').innerHTML = 
                             `
                            <tr>
                                <td class="text-center">Domingo</td>
                                <td class="text-center">${json_app.workdays.sunday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' }</td>
                            </tr>
                            <tr>
                                <td class="text-center">Lunes</td>
                                <td class="text-center">${json_app.workdays.monday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' }</td>
                            </tr>
                            <tr>
                                <td class="text-center">Martes</td>
                                <td class="text-center">${json_app.workdays.tuesday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' }</td>
                            </tr>
                            <tr>
                                <td class="text-center">Miércoles</td>
                                <td class="text-center">${json_app.workdays.wednesday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' }</td>
                            </tr>
                            <tr>
                                <td class="text-center">Jueves</td>
                                <td class="text-center">${json_app.workdays.thursday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' }</td>
                            </tr>
                            <tr>
                                <td class="text-center">Viernes</td>
                                <td class="text-center">${json_app.workdays.friday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' }</td>
                            </tr>
                            <tr>
                                <td class="text-center">Sábado</td>
                                <td class="text-center">${json_app.workdays.saturday == 1 ? '<i class="far fa-check-circle text-success text-lg"></i>' : '' }</td>
                            </tr>
                            `;
                            utils.showToast('Días laborales guardados exitosamente', 'success');
                            $('#modal_workdays').modal('hide');
                        }else {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        }
                    } catch (error) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }

                }
            }
        })
        document.querySelector('#btn-edit-workdays').addEventListener('click', e => {
            e.preventDefault();
            $('#modal_workdays').modal({
                backdrop: 'static',
                keyboard: false
            });

            let Empresa = document.querySelectorAll('.form_image_Cliente input')[0].value;
            let Cliente = document.querySelectorAll('.form_image_Cliente input')[1].value;
            var form = document.querySelector("#modal_workdays form");
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../ConfiguracionesRH/getWorkdays');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('Empresa=' + Empresa + '&Cliente=' + Cliente);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = xhr.responseText;
                    console.log(r);
                    try {
                        let json_app = JSON.parse(r);
                        if (json_app.status == 1) {
                            form.querySelectorAll('input[type=hidden]')[0].value = Empresa;
                            form.querySelectorAll('input[type=hidden]')[1].value = Cliente;
                            form.querySelectorAll('input[type=checkbox]')[0].checked = json_app.workdays.sunday == 1 ? true : false;
                            form.querySelectorAll('input[type=checkbox]')[1].checked = json_app.workdays.monday == 1 ? true : false;
                            form.querySelectorAll('input[type=checkbox]')[2].checked = json_app.workdays.tuesday == 1 ? true : false;
                            form.querySelectorAll('input[type=checkbox]')[3].checked = json_app.workdays.wednesday == 1 ? true : false;
                            form.querySelectorAll('input[type=checkbox]')[4].checked = json_app.workdays.thursday == 1 ? true : false;
                            form.querySelectorAll('input[type=checkbox]')[5].checked = json_app.workdays.friday == 1 ? true : false;
                            form.querySelectorAll('input[type=checkbox]')[6].checked = json_app.workdays.saturday == 1 ? true : false;
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        }
                    } catch (error) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                    }

                }
            }
        })
    })
	
	document.querySelector('.btn-legal-representative').addEventListener('click', e => {
		e.preventDefault();
		$('#modal_legal_representative').modal({
			backdrop: 'static',
			keyboard: false
		});
    })
	document.querySelector('#custom-tabs-four-home').addEventListener('click', e => {
		e.preventDefault();
		if (e.target.classList.contains('btn-representative') || e.target.parentElement.classList.contains('btn-representative')) {
			console.log(e.target.dataset.representative)
			$('#modal_worker_representative').modal({
				backdrop: 'static',
				keyboard: false
			});
		}
		e.stopPropagation();
    })
    
</script>
<script>
    document.addEventListener('DOMContentLoaded', e => {
        document.querySelector('#btn_new_policy').addEventListener('click', e => {
            e.preventDefault();
            $('#modal_policy').modal({
                backdrop: 'static',
                keyboard: false
            });
            var form = document.querySelector("#modal_policy form");
            form.querySelectorAll('input')[0].value = 1;
            var formData = new FormData(form);
            let xhr = new XMLHttpRequest();
            document.querySelectorAll('#modal_policy form .btn')[1].disabled = false;
            xhr.open('POST', '../vacaciones/getOnePolicy');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('id=1');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = xhr.responseText;
                    console.log(r);
                    try {
                        let json_app = JSON.parse(r);
                        if (json_app.status == 1) {
                            form.querySelectorAll('input')[1].value = json_app.policy.name;
                            form.querySelector('.form-row').innerHTML = '';
                            let holidays = '';
                            for (let i in json_app.holidays) {
                                holidays += `
                      <div class="col-sm-4 col">
                          <div class="form-group row">
                              <label class="col-form-label col-3">${json_app.holidays[i].years +  ' años:'}</label>
                              <div class="col-7 input-group">
                                  <input type="number" name="holiday${json_app.holidays[i].years}" id="holiday${json_app.holidays[i].years}" class="form-control" value="${json_app.holidays[i].holidays}">
                                  <div class="input-group-append">
                                      <span class="input-group-text">días</span>
                                  </div>
                              </div>
                          </div>
                      </div>`;
                            }
                            form.querySelector('.form-row').innerHTML = holidays;
                        } else {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        }
                    } catch (error) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }

                }
            }
        })
        document.querySelector('#modal_policy form').addEventListener('submit', e => {
            e.preventDefault();
            var form = document.querySelector("#modal_policy form");
            var formData = new FormData(form);
            form.querySelectorAll('.btn')[1].disabled = true;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../Vacaciones/savePolicy');
            xhr.send(formData);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = this.responseText;
                    console.log(r);
                    try {
                        let json_app = JSON.parse(r);
                        if (json_app.status == 1) {
                            window.location.reload();
                        }
                    } catch (error) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }

                }
            }
        })
        document.querySelector('#policies-content').addEventListener('click', e => {
            e.preventDefault();
            if (e.target.classList.contains('btn-edit') || e.target.parentElement.classList.contains('btn-edit')) {
                $('#modal_policy').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                let id;
                if (e.target.classList.contains('btn-edit'))
                    id = e.target.dataset.id;
                else
                    id = e.target.parentElement.dataset.id;

                var form = document.querySelector("#modal_policy form");
                form.querySelectorAll('input')[0].value = id;
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../vacaciones/getOnePolicy');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + id);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        console.log(r);
                        try {
                            let json_app = JSON.parse(r);
                            if (json_app.status == 1) {
                                form.querySelectorAll('input')[1].value = json_app.policy.name;
                                form.querySelector('.form-row').innerHTML = '';
                                let holidays = '';
                                for (let i in json_app.holidays) {
                                    holidays += `
                        <div class="col-sm-4 col">
                            <div class="form-group row">
                                <label class="col-form-label col-3">${json_app.holidays[i].years +  ' años:'}</label>
                                <div class="col-7 input-group">
                                    <input type="number" name="holiday${json_app.holidays[i].years}" id="holiday${json_app.holidays[i].years}" class="form-control" value="${json_app.holidays[i].holidays}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">días</span>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                                }
                                form.querySelector('.form-row').innerHTML = holidays;
                            } else {
                                utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                            }
                        } catch (error) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                        }

                    }
                }
            }
        })
    })
</script>
<script>
  $(document).ready(function() {
    let table = document.querySelector('#tb_users');
    utils.dtTable(table);
    table.addEventListener('click', e => {
      e.preventDefault();
      if (e.target.classList.contains('btn-warning') || e.target.parentElement.classList.contains('btn-warning')) {
        $('#modal_permission').modal({
          backdrop: 'static',
          keyboard: false
        });
        let Id;
        if (e.target.classList.contains('btn-warning')) {
          Id = e.target.dataset.id;
          Nombre = e.target.parentElement.parentElement.parentElement.children[0].textContent;
          Puesto = e.target.parentElement.parentElement.parentElement.children[1].textContent;
        }
        else {
          Id = e.target.parentElement.dataset.id;
          Nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].textContent;
          Puesto = e.target.parentElement.parentElement.parentElement.parentElement.children[1].textContent;
        }
        
        document.querySelectorAll('#modal_permission input')[0].value = Id;
        document.querySelectorAll('#modal_permission input')[1].value = Nombre;
        document.querySelectorAll('#modal_permission input')[2].value = Puesto;

        this.Id = Id;
        let xhr = new XMLHttpRequest();
        let data = `id_user=${this.Id}`;
        document.querySelectorAll('#modal_permission form .btn')[1].disabled = false;
        xhr.open('POST', '../usuario/getPermissions');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                  let json_app = JSON.parse(r);
                  if (json_app.status == 1) {
                    let accesos = '';
                    json_app.access.forEach(acceso => {
                      accesos += 
                      `<tr>
                            <th scope="row">${acceso.section_name}</th>
                            <!-- <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.create == 1 && acceso.read == 1 && acceso.update == 1 && acceso.delete == 1 ? 'checked' : ''} class="custom-control-input control" id="control_${acceso.id}" name="control_${acceso.id}">
                                        <label class="custom-control-label" for="control_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td> -->
                            <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.create == 1 ? 'checked' : ''} class="custom-control-input" id="create_${acceso.id}" name="create_${acceso.id}">
                                        <label class="custom-control-label" for="create_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.read == 1 ? 'checked' : ''} class="custom-control-input" id="read_${acceso.id}" name="read_${acceso.id}">
                                        <label class="custom-control-label" for="read_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.update == 1 ? 'checked' : ''} class="custom-control-input" id="update_${acceso.id}" name="update_${acceso.id}">
                                        <label class="custom-control-label" for="update_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" ${acceso.delete == 1 ? 'checked' : ''} class="custom-control-input" id="delete_${acceso.id}" name="delete_${acceso.id}">
                                        <label class="custom-control-label" for="delete_${acceso.id}"></label>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                    });
                    document.querySelector('#modal_permission table tbody').innerHTML = accesos;
                  }else {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                  }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
          }
        }
      }

    })
  });
</script>