<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-navy">
            <h3>Proyectos</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  
  
  <?php if (Utils::isAdmin($userType)) : ?>
    <section class="content-header">
      <div class="row">
        <div class="col-sm-2 ml-auto">
          <button class="btn btn-orange float-right" id="btn_new_project">Crear proyecto</button>
        </div>
      </div>
    </section>
  <?php endif ?>

  <section class="content">
    <div class="row mt-3 " id="all_projects">
      <?php foreach ($proyectos as $proyecto) : ?>
        <div class="col-md-4 ">
          <div class="small-box bg-info">
            <button class="btn text-white btn-delete" value="<?= Encryption::encode($proyecto['id']) ?>">X</button>
            <div class="inner">
              <h4><?= $proyecto['Nombre'] ?></h4>
              <div class="row">
                <div class="col-6">
                  <p style="font-size: small;"><?= $proyecto['Estado'] ?> Estado</p>
                </div>
                <div class="col-6">
                  <p style="font-size: small;"><?= $proyecto['status'] ?> Status</p>
                </div>
              </div>
            </div>
            <?php //if (Utils::permission($_GET['controller'], 'read')) : 
            ?>
            <a class="small-box-footer" href="<?= base_url ?>proyecto/ver&id=<?= Encryption::encode($proyecto['id']) ?>">
              Ver
              <i class="fas fa-arrow-circle-right"></i>
            </a>
            <?php //endif 
            ?>
          </div>
        </div>
      <?php endforeach ?>

    </div>
  </section>

</div>


<script type="text/javascript" src="<?= base_url ?>app/RH/department.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/proyecto.js?v=<?= rand() ?>"></script>
<script>
  document.querySelector('#all_projects').addEventListener('click', function(e) {

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
          departamento.deleteProject(e.target.value);
        }
      })
    }
  })

  document.querySelector('#btn_new_project').addEventListener('click', e => {
    e.preventDefault();
    document.querySelector('#modal_create form').reset();
    $('#modal_create').modal({
      backdrop: 'static',
      keyboard: false
    });
  });

  document.querySelector('#btn_create_project').addEventListener('click' , e => {
    e.preventDefault();
    const selectContent = document.querySelector("#userSelect").value
    console.log(selectContent);
    let project = new Proyecto();
    project.createNewProject();
  })
</script>