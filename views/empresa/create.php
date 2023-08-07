<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>Crear empresa</h4>
            </div>         
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Nueva empresa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="card-body">
                <form role="form" id="empresa-form">
                  <input type="hidden" name="Empresa" value="0">
                  <input type="hidden" name="flag" value="0">
                  <div class="form-group row">
                    <label for="Nombre_Empresa" class="col-md-2 col-form-label">Nombre de la empresa</label>
                    <input type="text" name="Nombre_Empresa" id="Nombre_Empresa" class="col-md-10 form-control">
                  </div>
                  <div class="form-group row">
                    <label for="Alias" class="col-md-2">Alias:</label>
                    <input type="text" name="Alias" id="Alias" class="col-md-10 form-control">
                  </div>
                  <div class="form-group">
                    <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                    <input type="submit" class="btn btn-success float-right" value="Registrar empresa">
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
</div>
<script src="<?=base_url?>app/cliente.js?v=<?=rand()?>"></script>
  <script type="text/javascript">
      document.querySelector('#empresa-form').addEventListener('submit', e => {
          e.preventDefault();
          let cliente = new Cliente();
          cliente.save_empresa();
      });
  </script> 
