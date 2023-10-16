<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert <?= $_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success' ?>">
            <h3>Plantilla de <?= Encryption::decode($_GET['flag']) == 1 ? 'empleados' : 'exempleados'  ?></h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <br>
 
	 <section class="content-header">
    <div class="row">
      <div class="col-6  ml-auto">
        <a href="<?= base_url ?>reporte/employeesinformation&status=<?= $_GET['flag'] ?>" class="btn btn-success ">Excel de empleados <br><i class="fas fa-file-excel display-4"></i></a>
      </div>

      <div class="col-2 ml-auto">
        <div class="btn-group mr-3 text-center">
          <button class="btn btn-orange dropdown-toggle dropdown-icon" data-toggle="dropdown">Nuevo empleado </button>
          <div class="dropdown-menu">
            <a href="<?= base_url ?>empleado/nuevo" class="dropdown-item">Crear nuevo empleado</a>
            <!-- <button class="dropdown-item">Añadir a candidato existente</button> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Main content -->

  <section class="content">
    <div class="card bg-transparent">
      <div class="card-header">
        <h3 class="card-title">Listado de <?= Encryption::decode($_GET['flag']) == 1 ? 'empleados' : 'exempleados'  ?> </h3>
      </div>

      <div class="card-body">
        <table id="tb_employees" class="table table-responsive table-striped table-sm" style="display: none;">
          <thead>
            <tr>
              <th class="align-middle">Nombre</th>
              <th class="align-middle">Puesto</th>
              <th class="align-middle">Edad</th>
              <th class="align-middle">Empresa contratante</th>
              <th class="align-middle">Fecha de inicio</th>
              <th class="align-middle">Fecha de modificacion</th>
              <th class="align-middle">Accion</th>
            </tr>
          </thead>

          <tbody id="tb_employees_body" >
            <?php foreach ($employees as $employee) : ?>
              <tr>
                <td class="align-middle"><?= $employee['first_name'] . ' ' . $employee['surname'] . ' ' . $employee['last_name'] ?></td>
                <td class="text-center align-middle"><?= $employee['title'] ?></td>
                <td class="text-center align-middle"><?= $employee['date_birth']  ?> Años</td>
                <td class="text-center align-middle"><?= $employee['Nombre_Cliente']  ?></td>
                <td class="text-center align-middle"><?= Utils::getDate($employee['start_date']) ?></td>
                <td class="text-center align-middle"><?= Utils::getFullDate($employee['modified_at']) ?></td>
                <td class="text-center align-middle">
                  <a href="<?= base_url ?>empleado/ver&id=<?= Encryption::encode($employee['id_employee']) ?>" target="_blank" class="btn btn-success">
                    <i class="fas fa-eye"></i> Ver
                  </a>

                  <?php if (Encryption::decode($_GET['flag']) != 1 && $Empresa==82) : ?>
                    <button class="btn btn-danger" value="<?=Encryption::encode( $employee['id_employee'])?>" name="<?= $employee['first_name'] . ' ' . $employee['surname'] . ' ' . $employee['last_name'] ?>">Borrar</button>
                  <?php endif; ?>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        
        </table>


      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<script src="<?= base_url ?>app/RH/employee.js?v=<?= rand() ?>"></script>


<script>
  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_employees');
    table.style.display = "table";
    utils.dtTable(table, true);


    document.querySelector('#tb_employees').addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-danger')) {
        Swal.fire({
          title: '¿Quieres eliminar este empleado? ' + e.target.name,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Eliminar'
        }).then((result) => {
          if (result.value == true) {
            var empl = new Employee();
            empl.updateDeleteSatus(e.target.value)
          }
        })
      }

    })

  })
</script>