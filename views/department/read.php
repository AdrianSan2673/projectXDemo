<!--Bootstrap CSS-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<!--Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left mb-2">
                            <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url ?>departamento/index">Proyectos</a></li>
                            <li class="breadcrumb-item active title-departament"><?= $proyecto->Nombre ?></li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <h4><b>Proyecto: </b>
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
            <div class = "container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="text-center">Datos del proyecto</h3>
                            </div>
                            <div class="col-12 table-responsive">
                                <table class="table tablestriped">            
                                <thead>
                                        <tr>
                                            <th>Dirección</th>
                                            <th>Fase</th>
                                            <th>Telefono del encargado</th>
                                            <th>inicio del proyecto</th>
                                            <th>Area Encargada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><p class="title-department" style='font-size: 17px;'><?= $proyecto->direccion?> <?= $proyecto->Estado?> </p></td>
                                            <td><p class="title-departament" style='font-size: 17px;'><?= $proyecto->status?></p></td>
                                            <td><p class="title-departament" style='font-size: 17px;'><?= $proyecto->Telefono?></p></td>
                                            <td><p class="title-departament" style='font-size: 17px;'><?= $proyecto->creado?></p></td>
                                            <td><p class="title-departament" style='font-size: 17px;'><?= $proyecto->id_tipo_usuario?></p></td>
                                        </tr>
                                    </tbody>    
                                </table>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-info" id="btn-editar-departamento" onclick="document.getElementById('id01').style.display='block'">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Open Edit Form  -->
        <!--<section class="content"> -->
        <div id="id01" class="modal">
            <div class="card-header">
                <h3 class="text-center">Editar Proyecto</h3>

            </div>
            <div>
                <div class="card-body">
                    <label for="inputName">Nombre</label>
                    <input type="text" id="inputName" class="form-control" value="AdminLTE">
                </div>
                <div class="card-body">
                    <label for="inputName">Estado</label>
                    <input type="text" id="inputEstado" class="form-control" value="AdminLTE">
                </div>
                <div class="card-body">
                    <label for="inputName">Direccion</label>
                    <input type="text" id="inputAddress" class="form-control" value="AdminLTE">
                </div>
                <div class="card-body">
                    <label for="inputName">Estatus</label>
                    <input type="text" id="inputStatus" class="form-control" value="AdminLTE">
                </div>
                <div class="card-body">
                    <label for="inputName">Telefono</label>
                    <input type="text" id="inputPhone" class="form-control" value="AdminLTE">
                </div>
                <div class="card-body">
                    <label for="inputName">Activacion</label>
                    <input type="text" id="inputActive" class="form-control" value="AdminLTE">
                </div>
                <div class="card-body">
                    <label for="inputName">Area</label>
                    <input type="text" id="inputIdUserType" class="form-control" value="AdminLTE">
                </div>
            </div>
        </div>

        </section>
        

        <!-- This section is used to show the docuement-->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-navy">
                            <div class="card-header">
                                <h3 class="text-center">Lista de documentos</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-right">
                                            <button class="btn btn-info" id="btn-editar-departamento">Añadir</button>
                                        </div>
                                        <div> </div>
                                        <table id="docuemento" class="table table-border table-hover" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle" style='font-size: 17px;'>Verificado</th>
                                                    <th class="text-center align-middle" style='font-size: 17px;'>Nombre del docuemento</th>
                                                    <th class="text-center align-middle" style='font-size: 17px;'>Cargar</th>
                                                    <th class="text-center align-middle" style='font-size: 17px;'>Descargar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center align-middle"><input type="checkbox"></td>
                                                    <td class="text-center align-middle" style='font-size: 17px;'> factura </td>
                                                    <td class="text-center align-middle"><a href = "" class="btn btn-small btn-primary"><i class="fa fa-upload"></i></a></td>
                                                    <td class="text-center align-middle"><a href = "" class="btn btn-small btn-success"><i class="fa fa-download"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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