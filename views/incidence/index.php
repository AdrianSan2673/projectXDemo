<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert <?= $_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success' ?>">
            <h3>Plantilla de Incidentes</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <br>

  <!-- Main content -->
  <section class="content">
    <div class="card bg-transparent">
      <div class="card-header">
        <h3 class="card-title">Listado de incidentes</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-2 ml-auto">
            <div class="btn-group mr-3 text-center">
              <button class="btn btn-orange" id="btn-nuevo-incidencia">Nuevo incidente</button>
            </div>
          </div>
        </div>

        <!-- //===[gabo 7 junio incidencias]=== -->

        <section class="content-header">

          <form method="POST" action="<?= base_url . "Reporte/incidentes" ?>" target="_blank">

            <div class="d-flex flex-row justify-content-center alig-items-center">
              <div class="row" style="width:70%;">

                <div class="col">
                  <div class="form-group">
                    <label for="start_date" class="col-form-label">Fecha Inicio</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="<?= date('Y-m-d', strtotime('-30 days'));  ?>" required>

                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="end_date" class="col-form-label">Fecha Fin</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="<?= date('Y-m-d');  ?>" required onchange="comprobar()" required>

                  </div>
                </div>
                <div class="col-2" style="margin-top:9px;">
                  <div class="form-group">
                    <label for="edad1" class="col-form-label"></label>
                    <button type="submit" name="search" id="search" class="form-control btn-success" style="background-color: #17a2b8; "><i class="fas fa-file-excel "></i>
                      Excel</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </section>



        <!-- //===[gabo 7 junio incidencias fin]=== -->
        <table id="tb_employees" class="table table-responsive table-striped table-sm" style="display: none;">
          <thead>
            <tr>
              <th class="align-middle">Incidencia</th>
              <th class="align-middle">Movimientos</th>
              <th class="align-middle">Comentario</th>
              <th class="align-middle">Empleado</th>
              <th class="align-middle">Puesto</th>
              <th class="align-middle">Departamento</th>
              <th class="align-middle">Fecha inicial</th>
              <th class="align-middle">Fecha final</th>
              <th class="align-middle">Accion</th>
            </tr>
          </thead>

          <tbody id="tboodyInciden">
            <?php foreach ($incidens as $inc) : ?>
              <tr>
                <td class="text-center align-middle"> <?= $inc['type']  ?></td>
                <td class="text-center align-middle">
                  <?php
                  if ($inc['type'] == 'Retraso' || $inc['type'] == 'Horas extras') {
                    echo $inc['hours'] . ' hrs';
                  } else if ($inc['type'] == 'Faltas') {
                    echo $inc['type_of_foul'];
                  } else if ($inc['type'] == 'Incapacidades') {
                    echo $inc['type_of_incapacity'];
                  } else if ($inc['type'] == 'Bonos') {
                    echo '$' . number_format($inc['amount'], 2);
                    //===[gabo 7 junio incidencias]=== 
                  } else if ($inc['type'] == 'Permiso') {
                    echo $inc['permission'];
                  }
                  //===[gabo 7 junio incidencias fin]=== 
                  ?>
                </td>
                <td class="text-center align-middle"><?= $inc['comments']  ?></td>
                <td class="text-center align-middle"><?= $inc['employeFullName']  ?></td>
                <td class="text-center align-middle"><?= $inc['title']  ?></td>
                <td class="text-center align-middle"><?= $inc['department']  ?></td>
                <td class="text-center align-middle"><?= Utils::getDate($inc['created_at'])  ?></td>
                <td class="text-center align-middle"><?= Utils::getDate($inc['end_date'])  ?></td>
                <td class="text-center align-middle">
                  <a href="<?= base_url ?>empleado/ver&id=<?= Encryption::encode($inc['id_employe']) ?>" class="btn btn-success"><i class="fas fa-eye"></i> Ver</a>
                  <button class="btn btn-danger text-bold" value="<?= Encryption::encode($inc['id_incident'])  ?>">X</button>
                </td>
              </tr>
            <?php endforeach;
            ?>
          </tbody>

        </table>


      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>

<script type="text/javascript" src="<?= base_url ?>app/RH/incidence.js?v=<?= rand() ?>"></script>

<script>
  function comprobar() {
    inicio = document.getElementById("start_date").value;
    var fin = document.getElementById("end_date").value;

    console.log(inicio);
    console.log(fin);

    if (fin < inicio) {
      Swal.fire('La fecha final no puede ser menor a la fecha inicial');
      document.getElementById("end_date").value = "";
    }
  }

  document.addEventListener('DOMContentLoaded', e => {
    let table = document.querySelector('#tb_employees');
    table.style.display = "table";
    utils.dtTable(table, true);

    document.querySelector('#btn-nuevo-incidencia').addEventListener('click', e => {
      e.preventDefault();
      document.querySelector("#modal_create_incidencias form").reset();
      $('#modal_create_incidencias').modal({
        backdrop: 'static',
        keyboard: false
      });
    });


    var incidente = new Incidence();
    document.querySelector('#modal_create_incidencias form').addEventListener('submit', e => {
      e.preventDefault();
      incidente.save_index();
    });


    document.querySelector('#tboodyInciden').addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains(
          'btn-info')) {
        if (e.target.offsetParent.classList.contains('btn-info')) {
          incidente.getIncident(e.target.offsetParent.value)
        } else {
          incidente.getIncident(e.target.value)
        }
        document.querySelectorAll('#modal_create_incidencias input')[0].value = 2
        $('#modal_create_incidencias').modal({
          backdrop: 'static',
          keyboard: false
        });
      }

      if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
          'btn-denger')) {
        Swal.fire({
          title: '¿Quieres eliminar esta incidencia?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Eliminar'
        }).then((result) => {
          if (result.value == true) {
            incidente.delete(e.target.value, 1);

          }
        })
      }
    })

  })
</script>