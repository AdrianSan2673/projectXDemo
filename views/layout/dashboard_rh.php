<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url ?>app/utils.js?v=<?= rand() ?>"></script>


<!-- script rafa -->
<script src="https://cdn.maptiler.com/client-js/v1.5.0/maptiler-client.umd.min.js"></script>
<!-- fin rafa -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">

</script>

<style>
#tabla-solicitudes-movil {
    display: none;
}


#tabla-solicitudes-pendientes-movil {
    display: none;
}

@media (max-width:768px) {

    #tabla-solicitudes-movil {
        display: block;
    }

    #tabla-solicitudes {
        display: none;
    }

    #btn_asistencia {
        float: left;
        background: blue;
    }

    #contra-div {
        width: 90% !important;

    }

    #cerrar {
        margin-top: 0.3rem;
    }


    #tabla-solicitudes-pendientes {
        display: none;
    }

    #tabla-solicitudes-pendientes-movil {
        display: block
    }
}

@media (min-width:769px) {

    #contra-div {
        width: 500px !important;

    }
}
</style>

<script>
maptilerClient.config.apiKey = "D5wN1aRujYvuBJ9nihTZ";
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<div class="content-wrapper " style="width:90%;margin:auto;margin-top:8rem;">
    <div class="card">
        <div class="card-header">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div>
                                <h1>¡Hola, <?= $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>!</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#asistencias" role="tab"
                                        aria-controls="" aria-selected="true">Asistencias</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#solicitudes" role="tab"
                                        aria-controls="" aria-selected="false">Solicitud de
                                        vacaciones</a>
                                </li>
                                <?php if ($subordinados) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#div-pendientes" role="tab"
                                        aria-selected="false">Solicitudes Pendientes</a>
                                </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#div-contrasena" role="tab"
                                        aria-selected="false">Contraseña</a>
                                </li>
                            </ul>
                        </div>

                           <div class="col-sm-12 col-md-4" id="cerrar">
                            <a href="<?= base_url ?>usuario/logout_rh" class="btn btn-maroon float-right">Cerrar sesión </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="tab-content" style="margin:-0.5rem">

                        <div class="tab-pane fade show active" id="asistencias" role="tabpanel" aria-labelledby="">

                            <div class="row m-3">
                                <div class="col-sm-4 col-md-4  col-lg-4 ">
                                    <h5 class="card-title mb-3">Asistencias</h5>
                                </div>
                               <div class="col-sm-3 col-md-3 col-lg-2" id="btn-asietencia">
                                    <?php
                                    $types = Utils::getTypesByCliente();  ?>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Seleccione tipo </option>
                                        <?php foreach ($types as $type) :  ?>
                                            <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                                        <?php endforeach;  ?>
                                    </select>

                                </div>
                                <div class="col-sm-5 col-md-4 col-lg-4" id="btn-asietencia" style="margin-top: 0.3rem;">

                                    <button class="btn btn-orange" style="float: center;" data-toggle="modal" id="btn_asistencia" data-target="#">Registrar
                                        Asistencia</button>

                                </div>
                            </div>
                            <input id="total_asistencias" type="hidden" value="0">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabla1">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:10px">#</th>
                                            <th class="text-center">Hora y fecha</th>
											<th class="text-center">Tipo</th>
                                            <th class="text-center">Ubicación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cont = count($asistencias);
                                        foreach ($asistencias as $asistencia) :

                                        ?>
                                        <tr>
                                            <td class="text-center text-bold"> <?= $cont  ?></td>
                                            <td class="text-center"> <?= $asistencia['created_at'];  ?></td>
											<td class="text-center"> <?= $asistencia['name'];  ?></td>
                                            <td class="text-center"> <?= $asistencia['coordenada'];  ?></td>
                                        </tr>

                                        <?php $cont--;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <div class="tab-pane fade" id="solicitudes" role="tabpanel">
							
							
							     <div class="row">
                                <div class="col-lg-3">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h4><?= $holidays->years ?>
                                            </h4>
                                            <p>Años de antiguedad</p>
                                        </div>
                                        <div class="icon">
                                          
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div
                                        class="small-box <?= $holidays->holidays_by_year - $holidays->taken_holidays != 0 ? 'bg-primary' : 'bg-danger'  ?>     ">
                                        <div class="inner">
                                            <?php if ($holidays->holidays_by_year - $holidays->taken_holidays != 0) :   ?>
                                            <h4><?= $holidays->holidays_by_year - $holidays->taken_holidays ?>
                                            </h4>
                                            <p>Dias disponibles</p>
                                            <?php else : ?>
                                            <h6>Sin dias disponibles
                                            </h6>
                                            <h6>No puedes crear solicitudes en este momento</h6>


                                            <?php endif; ?>

                                        </div>
                                        <div class="icon">
                                          
                                        </div>
                                      
                                    </div>
                                </div>

                            </div>
							
							
                            <div style="padding-bottom:3rem">
                                <h5 class="card-title mb-3">Solicitudes</h5>
                                <div class="col-sm-2 ml-auto">
                                    <button class="btn btn-orange float-right" data-toggle="modal" id="btn_new_holidays"  <?= ($holidays->holidays_by_year - $holidays->taken_holidays == 0) ? 'disabled' : ''; ?>
                                        data-target="#">Crear</button>
                                </div>
                            </div>
                            <div class="content" id="tabla-solicitudes">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tabla2">
                                        <thead>
                                            <tr>
                                                <th class="text-center"
                                                    style="width: 80px;max-width:80px;min-width:80px">#
                                                </th>
                                                <th class="text-center"
                                                    style="width: 100;max-width:100px;min-width:10px">
                                                    Fecha de la
                                                    solicitud</th>
                                                <th class="text-center"
                                                    style="width: 150;max-width:150px;min-width:150px">
                                                    Dias solicitados
                                                </th>
                                                <th class="text-center"
                                                    style="width: 200px;max-width:200px;min-width:200px">Periodo de
                                                    Vacaciones</th>
                                                <th class="text-center"
                                                    style="width: 200px;max-width:200px;min-width:200px">Comentarios
                                                </th>
                                                <th class="text-center"
                                                    style="width: 150px;max-width:150px;min-width:150px">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cont = count($solicitudes);
                                            foreach ($solicitudes as $solicitud) :

                                            ?>
                                            <tr>
                                                <td class="text-center text-bold"> <?= $cont  ?></td>
                                                <td class="text-center"> <?= $solicitud['created_at'];  ?></td>
                                                <td class="text-center"> <?= $solicitud['days'];  ?></td>
                                                <td class="text-center">
                                                    <?= $solicitud['start_date'] . " Al " . $solicitud['end_date'];  ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= ($solicitud['comments'] != '') ? $solicitud['comments']  : '-' ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php if ($solicitud['status'] == 'En revisión') : ?>
                                                    <small class="badge badge-warning">
                                                        En revisión</small>
                                                    <?php endif; ?>
                                                    <?php if ($solicitud['status'] == 'Aceptada') : ?>
                                                    <small class="badge badge-success">
                                                        Aceptada</small>
                                                    <?php endif;  ?>
                                                    <?php if ($solicitud['status'] == 'Declinada') : ?>
                                                    <small class="badge badge-danger">
                                                        Declinada</small>
                                                    <?php endif; ?>

                                                </td>
                                            </tr>
                                            <?php $cont--;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- tabla mobile -->
                            <div class="content" id="tabla-solicitudes-movil">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" id="table-solicitud-movil">
                                        <thead>
                                            <tr>
                                                <th class="text-center" </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cont = count($solicitudes);
                                            foreach ($solicitudes as $solicitud) :

                                            ?>

                                            <tr>
                                                <td class="text-left">
                                                    <div class="card-body">
                                                        <b> # <?= $cont ?> </b>
                                                        <hr style="border-color:green; margin-top:0.1rem">

                                                        <b> Fecha de la solicitud : </b>
                                                        <?= $solicitud['created_at']; ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">

                                                        <b> Dias solicitados :</b> <?= $solicitud['days'];  ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Periodo de vacaciones :</b>
                                                        <?= $solicitud['start_date'] . " Al " . $solicitud['end_date'];  ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Comentarios :</b>
                                                        <?= ($solicitud['comments'] != '') ? $solicitud['comments']  : '-' ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Status :</b>
                                                        <?php if ($solicitud['status'] == 'En revisión') : ?>
                                                        <small class="badge badge-warning">
                                                            En revisión</small>
                                                        <?php endif; ?>
                                                        <?php if ($solicitud['status'] == 'Aceptada') : ?>
                                                        <small class="badge badge-success">
                                                            Aceptada</small>
                                                        <?php endif;  ?>
                                                        <?php if ($solicitud['status'] == 'Declinada') : ?>
                                                        <small class="badge badge-danger">
                                                            Declinada</small>
                                                        <?php endif; ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $cont--;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- tabla mobile -->
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="div-contrasena" role="tabpanel">
                            <form method="POST" id="contrasena-form">
                                <h5 class="card-title mb-3 text-center col-md-12">Cambiar Contraseña</h5>
                                <div class="card" style="width:500px;margin:auto;" id="contra-div">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="hidden" name="Folio" class="form-control">
                                            <label for="contrasena" class="col-form-label">Contraseña Actual:</label>
                                            <input type="text" name="actual" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="nueva" class="col-form-label">Nueva Contraseña:</label>
                                            <input name="nueva" type="nueva" class="form-control">
                                            <input name="id_user_h"
                                                value="<?= Encryption::encode($_SESSION['identity']->id) ?>"
                                                type="hidden" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmacion" class="col-form-label">Confirma
                                                Contraseña:</label>
                                            <input name="confirmacion" type="text" id="confirmacion"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="display: flex;">

                                        <input type="submit" name="submit" id="sumbit-contrasena"
                                            class="btn btn-orange float-right" value="Guardar">
                                    </div>
                                </div>
                            </form>
                        </div>



                        <div class="tab-pane fade" id="div-pendientes" role="tabpanel" aria-labelledby="">
                            <h5 class="card-title mb-3">Solicitudes Pendientes</h5>
                            <div class="col-sm-2 ml-auto">
                            </div>
                            <div class="content" id="tabla-solicitudes-pendientes">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tabla3">
                                        <thead>
                                            <tr>
                                                <th class="text-center"
                                                    style="width: 50px;max-width:50px;min-width:50px">#
                                                </th>
                                                <th class="text-center"
                                                    style="width: 150px;max-width:150px;min-width:150px">
                                                    Nombre
                                                </th>
                                                <th class="text-center"
                                                    style="width: 100px;max-width:100px;min-width:100px">
                                                    Fecha de
                                                    la solicitud</th>
                                                <th class="text-center"
                                                    style="width: 150px;max-width:150px;min-width:150px">
                                                    Periodo
                                                    de Vacaciones</th>
                                                <th class="text-center"
                                                    style="width: 100px;max-width:100px;min-width:100px">
                                                    Dias
                                                    solicitados</th>
                                                <th class="text-center"
                                                    style="width: 100px;max-width:100px;min-width:100px">
                                                    Dias
                                                    Disponibles</th>
                                                <th class="text-center"
                                                    style="width: 180px;max-width:180px;min-width:158px">
                                                    Comentarios</th>
                                                <th class="text-center"
                                                    style="width: 150px;max-width:150px;min-width:150px">
                                                    Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cont = count($solicitudes_pendientes);
                                            foreach ($solicitudes_pendientes as $solicitud) :

                                            ?>
                                            <tr>
                                                <td class="text-center text-bold"> <?= $cont  ?></td>
                                                <td class="text-center">
                                                    <?= $solicitud['first_name'] . " " . $solicitud['surname'] . " " . $solicitud['last_name']; ?>
                                                </td>
                                                <td class="text-center"> <?= $solicitud['created_at'];  ?></td>
                                                <td class="text-center">
                                                    <?= $solicitud['start_date'] . " Al " . $solicitud['end_date'];  ?>
                                                </td>
                                                <td class="text-center"> <?= $solicitud['days'];  ?></td>

                                                <td class="text-center">
                                                    <?= $solicitud['holidays_by_year'] - $solicitud['taken_holidays'];  ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= ($solicitud['comments'] != '') ? $solicitud['comments']  : '-' ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php if ($solicitud['status'] == 'En revisión') : ?>
                                                    <button data-id=""
                                                        value="<?= Encryption::encode($solicitud['id']) ?>"
                                                        class="btn btn-success mt-1" id="btn-aceptar">
                                                        <i class="fas fa-check"> Aceptar</i>
                                                    </button>
                                                    <button data-id="<?= Encryption::encode($solicitud['id']) ?>"
                                                        class="btn btn-danger mt-1" id="btn-denegar">
                                                        <i class="fas fa-ban"> Declinar</i>
                                                    </button>
                                                    <?php else : ?>

                                                    <?php if ($solicitud['status'] == 'Aceptada') : ?>
                                                    <small class="badge badge-success">
                                                        Aceptada</small>
                                                    <?php else : ?>
                                                    <small class="badge badge-danger">
                                                        Declinada</small>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <?php $cont--;
                                            endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- tabla mobile -->
                            <div class="content" id="tabla-solicitudes-pendientes-movil">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" id="table-solicitud-pendiente-movil">
                                        <thead>
                                            <tr>
                                                <th class="text-center" </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cont = count($solicitudes_pendientes);
                                            foreach ($solicitudes_pendientes as $solicitud) :
                                            ?>
                                            <tr>
                                                <td class="text-left">
                                                    <div class="card-body">
                                                        <b> # <?= $cont ?> </b>
                                                        <hr style="border-color:green; margin-top:0.1rem;">
                                                        <b> Nombre : </b>
                                                        <?= $solicitud['first_name'] . " " . $solicitud['surname'] . " " . $solicitud['last_name']; ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Fecha de la solicitud: </b>
                                                        <?= $solicitud['created_at'];   ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Periodo de vacaciones :</b>
                                                        <?= $solicitud['start_date'] . " Al " . $solicitud['end_date'];  ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Dias solicitados :</b>
                                                        <?= $solicitud['days'];  ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Dias disponibles :</b>
                                                        <?= $solicitud['holidays_by_year'] - $solicitud['taken_holidays']; ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Comentarios :</b>
                                                        <?= ($solicitud['comments'] != '') ? $solicitud['comments']  : '-' ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Status :</b>
                                                        <?php if ($solicitud['status'] == 'En revisión') : ?>
                                                        <small class="badge badge-warning">
                                                            En revisión</small>
                                                        <?php endif; ?>
                                                        <?php if ($solicitud['status'] == 'Aceptada') : ?>
                                                        <small class="badge badge-success">
                                                            Aceptada</small>
                                                        <?php endif;  ?>
                                                        <?php if ($solicitud['status'] == 'Declinada') : ?>
                                                        <small class="badge badge-danger">
                                                            Declinada</small>
                                                        <?php endif; ?>
                                                        <hr style="margin:0.1rem;opacity:0% ">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"
                                                            style="text-align:center;margin-top:-0.5rem;margin-bottom:1rem">
                                                            <?php if ($solicitud['status'] == 'En revisión') : ?>
                                                            <button value="<?= Encryption::encode($solicitud['id']) ?>"
                                                                class="btn btn-success mt-1" id="btn-aceptar">
                                                                <i class="fas fa-check"> Aceptar</i>
                                                            </button>
                                                            <button
                                                                data-id="<?= Encryption::encode($solicitud['id']) ?>"
                                                                class="btn btn-danger mt-1" id="btn-denegar">
                                                                <i class="fas fa-ban"> Declinar</i>
                                                            </button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $cont--;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- tabla mobile -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

</div>

<script>
document.addEventListener('DOMContentLoaded', e => {
    $("#tabla1").DataTable({
        "searching": true,
        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
        "oAria": {
            "sSortAscending": false,
            "sSortDescending": true
        }
    });
    $("#tabla2").DataTable({
        "searching": true,
        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
        "oAria": {
            "sSortAscending": false,
            "sSortDescending": true
        }
    });
    $("#tabla3").DataTable({
        "searching": true,
        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
        "oAria": {
            "sSortAscending": false,
            "sSortDescending": true
        }
    });
    $("#table-solicitud-movil").DataTable({
        "searching": true,
        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
        "oAria": {
            "sSortAscending": false,
            "sSortDescending": true
        }
    });
});




document.querySelector('#btn_new_holidays').addEventListener('click', e => {
    e.preventDefault();
    $('#modal_create_holidays').modal({
        backdrop: 'static',
        keyboard: false
    });
});


document.querySelector("#contrasena-form").onsubmit = function(e) {
    e.preventDefault();
    let empleado = new Employee_RH();
    empleado.update_password();

};

document.querySelector('#btn_asistencia').addEventListener('click', async (e) => {
    try {
        const position = await getCurrentPositionAsync();
        const ubicacion = document.getElementById('localizacion');
        const datos1 = position.coords.longitude;
        const datos2 = position.coords.latitude;
        geoLoc(datos1, datos2);
    } catch (error) {
        gestionarErrores(error);
    }
});

async function getCurrentPositionAsync() {
    return new Promise((resolve, reject) => {
        navigator.geolocation.getCurrentPosition(
            (position) => resolve(position),
            (error) => reject(error)
        );
    });
}


let table3 = document.querySelector('#tabla3 tbody');

table3.addEventListener('click', e => {
    if (e.target.classList.contains('btn-success') || e.target.offsetParent.classList.contains(
            'btn-success')) {

        let id;
        if (e.target.classList.contains('btn-success'))
            id = e.target.value;
        else
            id = e.target.offsetParent.value;
        $('#id_solicitud').val(id);
        $('#div-comments').hide();
        $('#titulo-responder').text("Aceptar Solicitud");
        $('#descripcion').text("¿Estás seguro de aceptar esta solicitud? ")
        $('#accion').val("1");
        $('#modal_responder').modal('show');


    }

    if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
            'btn-danger')) {

        let id;
        if (e.target.classList.contains('btn-danger'))
            id = e.target.dataset.id;
        else
            id = e.target.offsetParent.dataset.id;

        $('#id_solicitud').val(id);
        $('#titulo-responder').text("Declinar Solicitud");
        $('#descripcion').text("¿Estás seguro de declinar esta solicitud? ")
        $('#div-comments').show();
        $('#accion').val("0");
        $('#modal_responder').modal('show');


    }
})


// rafa
function gestionarErrores(error) {
    //sweeftalert
    alert('Error: ' + error.code + ' ' + error.message + '\n\nPor favor compruebe que está conectado ' +
        'a internet y habilite la opción permitir compartir ubicación física');

}


async function geoLoc(datos1, datos2) {

    const result = await maptilerClient.geocoding.reverse([datos1, datos2]);
    let empleado = new Employee_RH();
    empleado.registrar_asientencia(result.features[0].place_name);

}

let div = document.querySelector('#table-solicitud-pendiente-movil tbody');

div.addEventListener('click', e => {
    if (e.target.classList.contains('btn-success') || e.target.offsetParent.classList.contains(
            'btn-success')) {

        let id;
        if (e.target.classList.contains('btn-success'))
            id = e.target.value;
        else
            id = e.target.offsetParent.value;
        $('#id_solicitud').val(id);
        $('#div-comments').hide();
        $('#titulo-responder').text("Aceptar Solicitud");
        $('#descripcion').text("¿Estás seguro de aceptar esta solicitud? ")
        $('#accion').val("1");
        $('#modal_responder').modal('show');


    }

    if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
            'btn-danger')) {

        let id;
        if (e.target.classList.contains('btn-danger'))
            id = e.target.dataset.id;
        else
            id = e.target.offsetParent.dataset.id;

        $('#id_solicitud').val(id);
        $('#titulo-responder').text("Declinar Solicitud");
        $('#descripcion').text("¿Estás seguro de declinar esta solicitud? ")
        $('#div-comments').show();
        $('#accion').val("0");
        $('#modal_responder').modal('show');


    }
})
</script>