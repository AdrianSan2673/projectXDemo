<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                <h4>Evaluación de <?=$cliente->customer?></h4>
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
                <h3 class="card-title">Nueva evaluación</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <div class="card-body">
                <form role="form" id="customer-form">
                  <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                    <input type="hidden" name="id_customer" id="id_customer" value="<?=$_GET['id']?>">
                  <?php endif ?>
                  <!-- Fue idea de Edgar xD <div class="form-group">
                    <label class="col-form-label">Tiempo de respuesta</label>
                    <div class="rating">
                      <input type="radio" name="response_time" id="response_time1" value="1"><label for="response_time1"></label>
                      <input type="radio" name="response_time" id="response_time2" value="2"><label for="response_time2"></label>
                      <input type="radio" name="response_time" id="response_time3" value="3"><label for="response_time3"></label>
                      <input type="radio" name="response_time" id="response_time4" value="4"><label for="response_time4"></label>
                      <input type="radio" name="response_time" id="response_time5" value="5"><label for="response_time5"></label>
                    </div>
                  </div><br> -->
                  <div class="form-group">
                    <label class="col-form-label">Tiempo de recepción de candidatos</label>
                    <div class="rating">
                      <input type="radio" name="reception_time" id="reception_time1" value="1"><label for="reception_time1"></label>
                      <input type="radio" name="reception_time" id="reception_time2" value="2"><label for="reception_time2"></label>
                      <input type="radio" name="reception_time" id="reception_time3" value="3"><label for="reception_time3"></label>
                      <input type="radio" name="reception_time" id="reception_time4" value="4"><label for="reception_time4"></label>
                      <input type="radio" name="reception_time" id="reception_time5" value="5"><label for="reception_time5"></label>
                    </div>
                  </div><br>
                  <div class="form-group">
                    <label class="col-form-label">Comunicación con su ejecutivo</label>
                    <div class="rating">
                      <input type="radio" name="communication_with_executive" id="communication_with_executive1" value="1"><label for="communication_with_executive1"></label>
                      <input type="radio" name="communication_with_executive" id="communication_with_executive2" value="2"><label for="communication_with_executive2"></label>
                      <input type="radio" name="communication_with_executive" id="communication_with_executive3" value="3"><label for="communication_with_executive3"></label>
                      <input type="radio" name="communication_with_executive" id="communication_with_executive4" value="4"><label for="communication_with_executive4"></label>
                      <input type="radio" name="communication_with_executive" id="communication_with_executive5" value="5"><label for="communication_with_executive5"></label>
                    </div>
                  </div><br>
                  <div class="form-group">
                    <label class="col-form-label">Amabilidad de su ejecutivo</label>
                    <div class="rating">
                      <input type="radio" name="executive_friendliness" id="executive_friendliness1" value="1"><label for="executive_friendliness1"></label>
                      <input type="radio" name="executive_friendliness" id="executive_friendliness2" value="2"><label for="executive_friendliness2"></label>
                      <input type="radio" name="executive_friendliness" id="executive_friendliness3" value="3"><label for="executive_friendliness3"></label>
                      <input type="radio" name="executive_friendliness" id="executive_friendliness4" value="4"><label for="executive_friendliness4"></label>
                      <input type="radio" name="executive_friendliness" id="executive_friendliness5" value="5"><label for="executive_friendliness5"></label>
                    </div>
                  </div><br>
                  <div class="form-group">
                    <label class="col-form-label">Calidad de los candidatos</label>
                    <div class="rating">
                      <input type="radio" name="quality_of_candidates" id="quality_of_candidates1" value="1"><label for="quality_of_candidates1"></label>
                      <input type="radio" name="quality_of_candidates" id="quality_of_candidates2" value="2"><label for="quality_of_candidates2"></label>
                      <input type="radio" name="quality_of_candidates" id="quality_of_candidates3" value="3"><label for="quality_of_candidates3"></label>
                      <input type="radio" name="quality_of_candidates" id="quality_of_candidates4" value="4"><label for="quality_of_candidates4"></label>
                      <input type="radio" name="quality_of_candidates" id="quality_of_candidates5" value="5"><label for="quality_of_candidates5"></label>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <label class="col-form-label">Comentarios:</label>
                    <textarea class="form-control" rows="7" name="comments" id="comments" placeholder="Escribe tus comentarios"></textarea>
                  </div>
                  <div class="form-group">
                    <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                    <?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
                      <button type="submit" class="btn btn-orange float-right" id="editSubmit">Evaluar</button>
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
<script src="<?=base_url?>app/customerevaluate.js?v=<?=rand()?>"></script>
<?php if (isset($edit) && isset($cliente) && is_object($cliente)): ?>
  <script type="text/javascript">
    document.querySelector('#customer-form').addEventListener('submit', e => {
        e.preventDefault();
        let customer = new CustomerEvaluation();
        customer.save();
      });
  </script>
<?php endif ?>
