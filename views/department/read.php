<!--Bootstrap CSS-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!--Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
require_once __DIR__ . '/../../config/Connection.php';


try {
    $db = Connection::connect();
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}
?>

<?php
$id_proyecto = $proyecto->id;

$sql = "SELECT * FROM archivos_subidos WHERE id_proyecto = :id_proyecto";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_OBJ);
?>



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
                    <div class="col-md-12">
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
                                            <td>
                                                <p class="title-department" style='font-size: 17px;'><?= $proyecto->direccion ?> <?= $proyecto->Estado ?> </p>
                                            </td>
                                            <td>
                                                <p class="title-departament" style='font-size: 17px;'><?= $proyecto->status ?></p>
                                            </td>
                                            <td>
                                                <p class="title-departament" style='font-size: 17px;'><?= $proyecto->Telefono ?></p>
                                            </td>
                                            <td>
                                                <p class="title-departament" style='font-size: 17px;'><?= $proyecto->creado ?></p>
                                            </td>
                                            <td>
                                                <p class="title-departament" style='font-size: 17px;'><?= $proyecto->id_tipo_usuario ?></p>
                                            </td>
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

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-navy">
                            <div class="card-header">
                                <h3 class="text-center">Documentos</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="container">
                                            <h2 class="mt-4">Subir Archivos de Evidencia</h2>
                                            <form action="<?= base_url ?>Archivos/Archivo.php" id="form-document" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_proyecto" value="<?= $proyecto->id ?>">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <?php
                                                        if (isset($_SESSION['msj'])) {
                                                            $respuesta = $_SESSION['msj']; ?>
                                                            <script>
                                                                Swal.fire({
                                                                    title: "Buen trabajo!",
                                                                    text: '<?php echo $respuesta; ?>',
                                                                    icon: "success"
                                                                });
                                                            </script>
                                                        <?php
                                                            unset($_SESSION['msj']);
                                                        }
                                                        ?>
                                                        <input type="file" id="file" name="file" required>
                                                        <input class="btn btn-orange" type="submit" value="Subir">
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- Tabla de Archivos Subidos -->
                                            <h2 class="mt-4">Archivos Subidos</h2>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre del Proyecto</th>
                                                        <th>Nombre del Archivo</th>
                                                        <th>Fecha de Subida</th>
                                                        <th>Hora de Subida</th>
                                                        <th>Ver</th>
                                                        <th>Descargar</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($files as $file): ?>
                                                        <tr>
                                                            <td><?= $proyecto->Nombre ?></td>
                                                            <td><?= htmlspecialchars($file->file_name) ?></td>
                                                            <td><?= $file->upload_date ?></td>
                                                            <td><?= $file->upload_time ?></td>
                                                            <td><a href="<?= base_url ?>Archivos/Files/<?= htmlspecialchars($file->file_name) ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                                                            <td><a href="<?= base_url ?>Archivos/Files/<?= htmlspecialchars($file->file_name) ?>" download class="btn btn-success"><i class="fa fa-download"></i></a></td>
                                                            <td><a href="<?= base_url ?>Archivos/Archivo.php?delete=<?= $file->id ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este archivo?');"><i class="fa fa-trash"></i></a></td>

                                                            <td><a href="#" class="btn btn-danger" onclick="confirmDelete('<?= $file->id ?>')"><i class="fa fa-trash"></i></a></td>


                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <!-- Fin de la Tabla -->
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


<script type="text/javascript" src="<?= base_url ?>app/cliente.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/RH/department.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/archivo.js?v=<?= rand() ?>"></script>



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

<script>
    function confirmDelete(fileId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma, redirigir a Archivo.php con el ID del archivo a eliminar
                window.location.href = '<?= base_url ?>Archivos/Archivo.php?delete=' + fileId;
            }
        })
    }
</script>