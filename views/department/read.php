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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="text-center">Datos del proyecto</h3>
                            </div>
                            <div class="card-body">
                                <div class="row info-empresa">
                                    <div class="col-md-12 text-left">
                                        <b>Dirección</b>
                                        <p class="title-departament"><?= $proyecto->direccion?> <?= $proyecto->Estado?></p>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <b>Fase</b>
                                        <p class="title-departament"><?= $proyecto->status?></p>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <b>Telefono del encargado</b>
                                        <p class="title-departament"><?= $proyecto->Telefono?></p>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <b>Inicio del proyecto</b>
                                        <p class="title-departament"><?= $proyecto->creado?></p>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <b>Area Encargada</b>
                                        
                                        <p class="title-departament"><?= $proyecto->id_tipo_usuario?></p>
                                       
                                        
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-info" id="btn-editar-departamento">Editar</button>
                                </div>
                            </div>
                        </div>

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