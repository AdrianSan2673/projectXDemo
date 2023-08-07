<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                <h4>Editar razón social</h4>
              <?php else: ?>
                <h4>Crear razón social</h4>
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
                  <h3 class="card-title"><?=$cliente->customer?></h3>
                <?php else: ?>
                  <h3 class="card-title">Nueva razón social</h3>
                <?php endif ?>
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="general">
                    <div class="row">
                      <form id="customer-bn-form" class="col-md-12">
                        <input type="hidden" id="id" value="<?=isset($business) && is_object($business) ? Encryption::encode($business->id) : ''?>">
                        <input type="hidden" value="<?=isset($business) && is_object($business) ? Encryption::encode($business->id_customer) : Encryption::encode($id)?>" id="id_customer" name="id_customer">
                        <div class="form-group">
                          <label for="business_name" class="col-form-label">Razón social:</label>
                          <input type="text" name="business_name" id="business_name" class="form-control" value="<?=isset($business) && is_object($business) ? $business->business_name : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="rfc" class="col-form-label">RFC:</label>
                          <input type="text" name="rfc" id="rfc" class="form-control" value="<?=isset($business) && is_object($business) ? $business->RFC : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="fiscal_address">Dirección Fiscal</label>
                            <input type="text" class="form-control" name="fiscal_address" value="<?=isset($business) && is_object($business) ? $business->fiscal_address : ''; ?>" maxlength="60" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="method_of_payment">Forma de Pago</label>
                            <select class="form-control" name="method_of_payment" required>
                                <option value="03. Transferencia Electrónica de Fondos" <?=isset($business) && is_object($business) && $business->method_of_payment == '03. Transferencia Electrónica de Fondos' ? 'selected' : ''; ?>>03. Transferencia Electrónica de Fondos</option>
                                <option value="99. Por definir" <?=isset($business) && is_object($business) && $business->method_of_payment == '99. Por definir' ? 'selected' : ''; ?>>99. Por definir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="fiscal_regime">Régimen Fiscal</label>
                            <input type="text" name="fiscal_regime" class="form-control" value="<?=isset($business) && is_object($business) ? $business->fiscal_regime : ''; ?>" maxlength="60">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="use_of_CFDI">Uso de CFDI</label>
                            <select class="form-control" name="use_of_CFDI" required>
                                <option value="G03. Gastos en General" <?=isset($business) && is_object($business) && $business->use_of_CFDI == 'G03. Gastos en General' ? 'selected' : ''; ?>>G03. Gastos en General</option>
                                <option value="Otros" <?=isset($business) && is_object($business) && $business->use_of_CFDI == 'Otros' ? 'selected' : ''; ?>>Otros</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="fiscal_situation">Situación fiscal</label>
                            <input type="file" name="fiscal_situation" class="form-control" accept="application/pdf">
                        </div>
                        <div class="card-footer">
                          <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                          <input type="submit" class="btn btn-orange float-right" id="submit" value="<?=($_GET['action'] == 'crear' ? 'Crear razón social' : 'Editar razón social')?>">
                        </div>                          
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
  </div>
    
</div>
<script src="<?=base_url?>app/businessname.js?v=<?=rand();?>"></script>
<script>
  document.querySelector('#customer-bn-form').addEventListener('submit', e => {
    e.preventDefault();
    let business = new BusinessName();

    if (document.querySelector("#id").value != '') {
      business.update();
    }else{
      business.save();
    }
  });
</script>