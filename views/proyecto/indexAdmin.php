<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Proyectos por Area</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <?php //if (Utils::permission($_GET['controller'], 'create')) : ?>
  <section class="content-header">
    <div class="row">
      <div class="col-sm-2 ml-auto">
        <button class="btn btn-orange float-right" id="btn_new_department">Crear Departamento</button>
      </div>
    </div>
  </section>
  <?php //endif ?>
  <section class="content">

    <div class="row mt-3 " id="all_departments">
      <?php foreach ($proyectos as $proyecto) : ?>
        <div class="col-md-4 ">
          <div class="small-box bg-info">
            <button class="btn text-white btn-delete" value="<?= Encryption::encode($areas['id']) ?>">X</button>
            <div class="inner">
              <h4><?= $areas['nombre_area'] ?></h4>
            </div>
            <?php //if (Utils::permission($_GET['controller'], 'read')) : ?>
            <a class="small-box-footer" href="<?= base_url ?>proyecto/ver&id=<?= Encryption::encode($areas['id']) ?>">
              Ver
              <i class="fas fa-arrow-circle-right"></i>
            </a>
            <?php //endif ?>
          </div>
        </div>
      <?php endforeach ?>

    </div>
  </section>
  
</div>


<script type="text/javascript" src="<?= base_url ?>app/RH/department.js?v=<?= rand() ?>"></script>

<script>
  document.querySelector('#all_departments').addEventListener('click', function(e) {

    if (e.target.classList.contains('btn-delete')) {
      Swal.fire({
        title: '¿Quieres eliminar este departamento?',
        text: "Si se elimina el departamento, los puestos que fueron asignados a este departamento aún se veran con su departamento asignado.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Eliminar'
      }).then((result) => {
        if (result.value == true) {
          let departamento = new Department();
          departamento.delet(e.target.value);
        }
      })
    }
  })
</script>

