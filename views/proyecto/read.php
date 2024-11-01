<!--Bootstrap CSS-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!--Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha384-ZvpUoO/+PpTRWZm8frl7C5c0bR6erbrsLJmlCRW8GTGHvNhuv8Yk5g7DhGZ1jL6F" crossorigin="anonymous"></script>

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
$userType = $_SESSION['identity']->tipo_usuario;
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
                        <div class="alert alert-navy">
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
        <!-- Pendiente de agregar
        <section class="content">
            <div class = "container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class = "card-header">
                                <h3 class="text-center">Encargado</h3>
                            </div>
                            <div class = "col-md-12 table-responsive">
                                <table class="table tablestriped">
                                    <thead>
                                        <tr>
                                            <th style='font-size: 17px;'></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
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
                                            <th style='font-size: 17px;'>Dirección</th>
                                            <th style='font-size: 17px;'>Fase</th>
                                            <th style='font-size: 17px;'>Telefono del encargado</th>
                                            <th style='font-size: 17px;'>inicio del proyecto</th>
                                            <th style='font-size: 17px;'>Area Encargada</th>
                                        </tr>
                                    </thead>
                                    <tbody id = "tb_proyecto">
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
                            
                            <div class="card-footer"> 
                            <div class="text-center">
                            <button class="btn btn-info" id="btn_editar_proyecto">Editar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php if(!Utils::isAdmin($userType)) : ?>
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

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif ?>                                        

        <section>
            <!-- Tabla de Archivos Subidos -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-navy">
                            <div class="card-header">
                                <h2 class="text-center">Archivos Subidos</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="container">
                            <div>
                                <div class="col-md-12">
                                    <div class="card shadow-0 border comment-input">

                                        <table class="table table-striped" id="archivos">
                                            <thead>
                                                <tr>
                                                    <th style='font-size: 17px;'>Nombre del Proyecto</th>
                                                    <th style='font-size: 17px;'>Nombre del Archivo</th>
                                                    <th style='font-size: 17px;'>Fecha de Subida</th>
                                                    <th style='font-size: 17px;'>Hora de Subida</th>
                                                    <th style='font-size: 17px;'>Ver</th>
                                                    <th style='font-size: 17px;'>Descargar</th>
                                                    <th style='font-size: 17px;'>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($files as $file): ?>
                                                    <tr>
                                                        <td style='font-size: 16px;'><?= $proyecto->Nombre ?></td>
                                                        <td style='font-size: 16px;'><?= htmlspecialchars($file->file_name) ?></td>
                                                        <td style='font-size: 16px;'><?= $file->upload_date ?></td>
                                                        <td style='font-size: 16px;'><?= $file->upload_time ?></td>
                                                        <td style='font-size: 16px;'><a href="<?= base_url ?>Archivos/Files/<?= htmlspecialchars($file->file_name) ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                                                        <td style='font-size: 16px;'><a href="<?= base_url ?>Archivos/Files/<?= htmlspecialchars($file->file_name) ?>" download class="btn btn-success"><i class="fa fa-download"></i></a></td>
                                                        <td style='font-size: 16px;'><a href="#" class="btn btn-danger" onclick="confirmDelete('<?= $file->id ?>')"><i class="fa fa-trash"></i></a></td>


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
            </div>



        </section>



        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-navy">
                            <div class="card-header">
                                <h3 class="text-center">Foro de Comentarios</h3>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12">
                                    <div class="card shadow-0 border comment-input">
                                        <div class="card-body p-4">
                                            <form id="formulario-comentario">
                                                <div data-mdb-input-init class="form-outline mb-4">
                                                    <input type="text" id="comentario" name="comentario" class="form-control" placeholder="Escribe un comentario..." required />
                                                    <label class="form-label" for="comentario">+ Agregar un comentario</label>
                                                </div>
                                            </form>

                                            <button id="vaciar-comentarios" class="btn btn-danger mb-4">Vaciar Comentarios</button>

                                            <div id="comentarios-container">
                                                <!-- Los comentarios se cargarán aquí -->
                                            </div>

                                        </div>
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
<script type="text/javascript" src="<?= base_url ?>app/proyecto.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/archivo.js?v=<?= rand() ?>"></script>



<script type="text/javascript">
    window.onload = function() {

        let table = document.querySelector('#archivos');
        table.style.display = "table";
        utils.dtTable(table, true);

        // let table_position = document.querySelector('#tb_position');
        // table_position.style.display = "table";
        // utils.dtTable(table_position, true);

        document.querySelector('#modal_editar_proyecto form').addEventListener('submit', e => {
            e.preventDefault();
            console.log("Hola")
            let departamento = new Proyecto();
            departamento.updateProject();
        });
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
            if (result.value == true) {
                // Si se confirma, redirigir a Archivo.php con el ID del archivo a eliminar
                window.location.href = '<?= base_url ?>Archivos/Archivo.php?delete=' + fileId;
            }
        })
    }

    document.querySelector('#btn_editar_proyecto').addEventListener('click', e => {
        e.preventDefault();
        document.querySelector('#modal_editar_proyecto form').reset();
        $('#modal_editar_proyecto').modal({
            backdrop: 'static',
            keyboard: false
        });
    });
</script>


<script>
    $(document).ready(function() {
        cargarComentarios();

        // Recargar comentarios cada 5 segundos
        setInterval(cargarComentarios, 5000);

        // Función para cargar los comentarios
        function cargarComentarios() {
            $.ajax({
                url: '<?= base_url ?>Foro/Foro.php',
                method: 'GET',
                success: function(data) {
                    $('#comentarios-container').html(data);
                },
                error: function(xhr, status, error) {
                    console.error("Error al cargar comentarios:", error);
                }
            });
        }

        // Enviar comentario al presionar Enter
        $('#comentario').keypress(function(e) {
            if (e.which == 13 && !e.shiftKey) {
                e.preventDefault(); // Prevenir el salto de línea
                $('#formulario-comentario').submit(); // Enviar el formulario
            }
        });

        // Enviar comentario
        $('#formulario-comentario').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url ?>Foro/Foro.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    cargarComentarios(); // Recargar comentarios después de enviar
                    Swal.fire({
                        icon: 'success',
                        title: 'Comentario enviado',
                        text: 'Tu comentario ha sido enviado correctamente.'
                    });
                    $('#formulario-comentario')[0].reset(); // Limpiar el formulario
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al enviar tu comentario.'
                    });
                }
            });
        });

        // Vaciar comentarios
        $('#vaciar-comentarios').on('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esto eliminará todos los comentarios. ¡No podrás deshacer esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, vaciar comentarios'
            }).then((result) => {
                if (result.value == true) {
                    $.ajax({
                        url: '<?= base_url ?>Foro/vaciar_comentarios.php',
                        method: 'POST',
                        success: function(data) {
                            try {
                                const response = JSON.parse(data);
                                if (response.status === 'success') {
                                    Swal.fire(
                                        'Comentarios Vaciados',
                                        'Todos los comentarios han sido eliminados.',
                                        'success'
                                    );
                                    cargarComentarios(); // Recargar la lista de comentarios
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.message || 'Hubo un problema al vaciar los comentarios.'
                                    });
                                }
                            } catch (e) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un problema al procesar la respuesta del servidor.'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al vaciar los comentarios.'
                            });
                        }
                    });
                }
            });
        });

    });
</script>