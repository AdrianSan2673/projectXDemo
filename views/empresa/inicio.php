<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h3><?= $empresa->Nombre_Empresa ?></h3>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <form method="post" id="form_image_Empresa" enctype="multipart/form-data">
                                        <input type="hidden" name="ID_Empresa" value="<?=$ID_Empresa?>">
                                        <div class="col-md-8 mx-auto">
                                            <img class="img-fluid" src="<?=$empresa->logo ? $empresa->logo : base_url.'dist/img/image_unavailable.jpg'?>">
                                        </div>
                                        <div class="btn-group btn-group-sm mt-2">
                                            <button class="btn btn-success btn-watch-photo" style="display: <?=$empresa->logo ? 'block' : 'none'?>;"><i class="fas fa-eye"></i> Ver</button>
                                            <button class="btn btn-info btn-edit-photo" style="display: <?=$empresa->logo ? 'block' : 'none'?>;"><i class="fas fa-pencil-alt mr-1"></i> Editar</button>
                                            <button class="btn btn-danger btn-delete-photo" style="display: <?=$empresa->logo ? 'block' : 'none'?>;"><i class="fas fa-times mr-1"></i> Borrar</button>
                                            <label class="btn btn-orange ml-2">
                                                <input type="file" class="d-none btn-upload-photo" accept="image/x-png,image/gif,image/jpeg"><i class="fas fa-upload"> Subir logo</i>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills">
                                    <?php foreach ($clientes as $key => $cliente) : ?>
                                        <li class="nav-item"><a class="nav-link <?= $key == 0 ? 'active' : '' ?>" href="#<?= $cliente['Cliente'] ?>" data-toggle="tab"><?= $cliente['Nombre_Cliente'] ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <?php foreach ($clientes as $key => $cliente) : ?>
                                        <div class="tab-pane  <?= $key == 0 ? 'active' : '' ?>" id="<?= $cliente['Cliente'] ?>">
                                            <div class="row">
                                                <form method="post" class="form_image_Cliente" enctype="multipart/form-data">
                                                <input type="hidden" name="ID_Cliente" value="<?=$cliente['Cliente']?>">
                                                    <div class="col-md-8 mx-auto">
                                                        <img class="img-fluid" src="<?=$cliente['logo'] ? $cliente['logo'] : base_url.'dist/img/image_unavailable.jpg'?>">
                                                    </div>
                                                    <?php if ($cliente['logo']) : ?>
                                                        <button class="btn btn-success btn-watch-photo"><i class="fas fa-eye"></i> Ver</button>
                                                        <button class="btn btn-info btn-edit-photo"><i class="fas fa-pencil-alt mr-1"></i> Editar</button>
                                                        <button class="btn btn-danger btn-delete-photo"><i class="fas fa-times mr-1"></i> Borrar</button>
                                                    <?php endif ?>
                                                    <label class="btn btn-orange ml-2">
                                                        <input type="file" class="d-none btn-upload-photo" accept="image/x-png,image/gif,image/jpeg"><i class="fas fa-upload"> Subir logo</i>
                                                    </label>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', e =>{
        var new_image = document.querySelector('#modal_imagen img');

        document.querySelector('#form_image_Empresa').addEventListener('click', e => {
            if (e.target.classList.contains('btn-upload-photo') || e.target.parentElement.classList.contains('btn-upload-photo')) {
                var files = e.target.files;
                var done = function(url) {
                    new_image.src = url;

                    let form = document.querySelector('#modal_imagen form');
                    form.querySelectorAll('input')[0].value = document.querySelectorAll('#form_image_Empresa input')[0].value;
                    form.querySelectorAll('input')[1].value = 0;

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

            if (e.target.classList.contains('btn-watch-photo') || e.target.parentElement.classList.contains('btn-watch-photo')) {
                document.querySelector('#modal_ver_imagen img').src = document.getElementById('form_image_Empresa').querySelector('img').src;
                document.querySelector('#modal_ver_imagen .btn-primary').href = document.querySelector('#modal_ver_imagen img').src;
                $('#modal_ver_imagen').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

            if (e.target.classList.contains('btn-edit-photo') || e.target.parentElement.classList.contains('btn-edit-photo')) {
                new_image.src = document.getElementById('form_image_Empresa').querySelector('img').src;
                $('#modal_imagen').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                let cropper;
                $('#modal_imagen').on('shown.bs.modal', function(){
                    cropper = null;
                    cropper = new Cropper(new_image, {
                        movable: true,
                        zoomable: true,
                        scalable: true,
                        viewMode: 0,
                        rotatable: true,
                        preview:'.preview',
                        ready: function(e){
                            document.querySelectorAll('#modal_imagen .btn-primary')[0].addEventListener('click', e => {
                                cropper.rotate(-45);
                            })
                        
                            document.querySelectorAll('#modal_imagen .btn-primary')[1].addEventListener('click', e => {
                                cropper.rotate(45);
                            })
                        }
                    });
                    
                }).on('hidden.bs.modal', function(){
                    cropper.destroy();
                    cropper = null;
                });
            }

            if (e.target.classList.contains('btn-delete-photo') || e.target.parentElement.classList.contains('btn-delete-photo')) {
                $('#modal_delete_imagen').modal({backdrop: 'static', keyboard: false});
                
                document.querySelectorAll('#modal_delete_imagen form p')[0].textContent = `¿Estás seguro de que quieres eliminar el logo?`;
                document.querySelector('#modal_delete_imagen form').querySelectorAll('input')[0].value = document.querySelectorAll('#form_image_Empresa input')[0].value;
                document.querySelector('#modal_delete_imagen form').querySelectorAll('input')[1].value = 0;
            }
            e.stopPropagation();
        })

        document.querySelectorAll('.form_image_Cliente').forEach(e => {
            e.addEventListener('change', e => {
                if (e.target.classList.contains('btn-upload-photo') || e.target.parentElement.classList.contains('btn-upload-photo')) {

                    var files = e.target.files;
                    var done = function(url) {
                        new_image.src = url;

                        let form = document.querySelector('#modal_imagen form');
                        form.querySelectorAll('input')[0].value = e.target.parentElement.parentElement.querySelectorAll('#form_image_Empresa input')[0].value;

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
        });

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
        }).on('hidden.bs.modal', function(){
            cropper.destroy();
            cropper = null;
        });

        document.querySelector('#modal_imagen .docs-buttons').onclick = function (event) {
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

        document.querySelector('#modal_imagen').onsubmit = function(e){
            e.preventDefault();
            

            canvas = cropper.getCroppedCanvas({
                maxWidth: 900,
                maxHeight: 900
            });

            canvas.toBlob(function(blob){
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function(){
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
                    xhr.onreadystatechange = function(){
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            let r = this.responseText;
                            console.log(r);
                            try {
                                let json_app = JSON.parse(r);
                                if (json_app.status == 1){
                                    if (ID_Cliente != '' && ID_Cliente != 0){
                                        document.getElementById(ID_Cliente).querySelector('img').src = json_app.logo;
										console.log(ID_Cliente);
                                    }else if (ID_Empresa > 0 && ID_Empresa != '') {
                                        document.getElementById('form_image_Empresa').querySelector('img').src = json_app.logo;
										console.log(ID_Empresa);
                                    }
                                    utils.showToast('Logo cargado exitosamente', 'success');
                                    $('#modal_imagen').modal('hide');
                                    form.querySelectorAll('.btn-orange')[0].disabled = false;
                                }
                            } catch (error) {
                                utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                                form.querySelectorAll('.btn-orange')[0].disabled = false;
                            }
                        }
                    }
                };
            });
        }

        document.querySelector('#modal_delete_imagen').onsubmit = function(e){
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
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = this.responseText;
                    console.log(r);
                    try {
                        let json_app = JSON.parse(r);
                        if (json_app.status == 1){
                            if (ID_Cliente != '' && ID_Cliente != 0){
                                document.getElementById(ID_Cliente).querySelector('img').src = json_app.logo;
                                console.log(ID_Cliente);
                            }else if (ID_Empresa > 0 && ID_Empresa != '') {
                                document.getElementById('form_image_Empresa').querySelector('img').src = json_app.logo;
                                console.log(ID_Empresa);
                            }
                            utils.showToast('Logo eliminado exitosamente', 'success');
                            $('#modal_delete_imagen').modal('hide');
                            form.querySelectorAll('.btn-danger')[0].disabled = false;
                        }
                    } catch (error) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                        form.querySelectorAll('.btn-danger')[0].disabled = false;
                    }
                }
            }
        }
    })
</script>