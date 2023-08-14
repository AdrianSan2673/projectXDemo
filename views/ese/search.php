<div class="content-wrapper" <?=$_SESSION['identity']->username == 'salmaperez' ? 'style="background: #ffcdd4"' : ''?>>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert  <?=$_SESSION['identity']->username == 'salmaperez' ? 'alert-maroon' : 'alert-success'?>">
                <h3>Reporte de operaciones</h3>
            </div> 
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <br>
    <section class="content-header">
      <div class="container-fluid">
        <form method="POST" action="<?=base_url."reporte/excel"?>" class="row">
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="start_date" class="col-form-label">Fecha inicial:</label>
              <input type="date" name="start_date" id="start_date" value="<?=isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d')?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-5">
            <div class="form-group">
              <label for="end_date" class="col-form-label">Fecha final:</label>
              <input type="date" name="end_date" id="end_date" value="<?=isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d')?>" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-2" style="padding-right: 14px;">
              <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar y exportar</button>
          </div>
        </form>
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
    </section>
</div>