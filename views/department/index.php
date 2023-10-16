<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h3>Departamentos</h3>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content-header">
    <div class="row">
      <div class="col-sm-2 ml-auto">
        <button class="btn btn-orange float-right" id="btn_new_department">Crear Departamento</button>
      </div>
    </div>
  </section>
  <section class="content">
  
  <div class="row mt-3 " id="all_departments">
      <?php foreach ($departamentos as $department) : ?>
        <div class="col-md-4 ">
          <div class="small-box bg-info">
              <button class="btn text-white btn-delete" value="<?= Encryption::encode($department['id'])?>" <?= $department['no_employees']==0 || $department['no_positions']==0?'':'hidden' ?>>X</button>
            <div class="inner">
              <h4><?= $department['department'] ?></h4>
              <div class="row">
                <div class="col-6">
                  <p style="font-size: small;"><?= $department['no_employees'] ?> empleados</p>
                </div>
                <div class="col-6">
                  <p style="font-size: small;"><?= $department['no_positions'] ?> puestos</p>
                </div>
              </div>
            </div>
            <a class="small-box-footer" href="<?= base_url ?>departamento/ver&id=<?= Encryption::encode($department['id']) ?>">
              Ver
              <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php endforeach ?>

    </div>
  </section>
</div>


<script type="text/javascript" src="<?= base_url ?>app/RH/department.js?v=<?= rand() ?>"></script>

<script>
  document.querySelector('#all_departments').addEventListener('click', function(e) {
    let departamento = new Department();
    if (e.target.classList.contains('btn-delete')) {
      departamento.delet(e.target.value);
    }
  })
</script>