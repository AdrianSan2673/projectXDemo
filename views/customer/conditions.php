<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                <h4><?=$cliente->customer?></h4>
              <?php endif ?>
                
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
                <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                  <h3 class="card-title"><?=$cliente->alias?></h3>
                <?php endif ?>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="card-body">
                <form role="form" id="customer-form">
                  <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                    <input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
                  <?php endif ?>
                  <div class="row">
                    <div class="form-group col">
                      <label for="recruitment_fee" class="col-form-label">Cuota de reclutamiento</label>
                      <input type="number" name="recruitment_fee" id="recruitment_fee" class="form-control" value="<?=isset($cliente) && is_object($cliente) ? $cliente->recruitment_fee : ''; ?>" min="0" max="100">
                    </div>
                    <div class="form-group col">
                      <label for="price_for_psychometrics" class="col-form-label">Psicometrías:</label>
                      <input type="number" name="price_for_psychometrics" id="price_for_psychometrics" class="form-control" value="<?=isset($cliente) && is_object($cliente) ? $cliente->price_for_psychometrics : ''; ?>">
                    </div>
                    <div class="form-group col">
                      <label for="price_for_talent_attraction" class="col-form-label">Atracción de talento 3.0:</label>
                      <input type="number" name="price_for_talent_attraction" id="price_for_talent_attraction" class="form-control" value="<?=isset($cliente) && is_object($cliente) ? $cliente->price_for_talent_attraction : ''; ?>">
                    </div>
                    <div class="form-group col">
                      <label for="credit_days" class="col-form-label">Días de crédito:</label>
                      <input type="number" name="credit_days" id="credit_days" class="form-control" value="<?=isset($cliente) && is_object($cliente) ? $cliente->credit_days : ''; ?>">
                    </div>
                    <div class="form-group col">
                        <label class="col-form-label" for="box_cut">Cortes de servicio</label>
                        <select class="form-control" name="box_cut" id="box_cut">
                            <option value="1">Contraentrega</option>
                            <option value="2">Semanal</option>
                            <option value="3">Quincenal</option>
                            <option value="4">Mensual</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                    <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                      <button type="submit" class="btn btn-orange float-right" id="editSubmit">Editar</button>
                    <?php endif ?>
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
<script src="<?=base_url?>app/customer.js?v=<?=rand()?>"></script>
<?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
  <script type="text/javascript">
    document.querySelector('#customer-form').addEventListener('submit', e => {
        e.preventDefault();
        let customer = new Customer();
        customer.update_conditions();
      });
  </script>
<?php endif ?>

