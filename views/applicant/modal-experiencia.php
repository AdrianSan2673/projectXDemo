<div class="modal fade" id="modal-experiencia">
  <div class="modal-dialog" style="max-width:  900px!important;">
    <div class="modal-content">
      <form method="post" id="experiencia-operativa-form">
        <div class="modal-header">
          <h4 class="modal-title" id="titulo_experiencia"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_candidate_exp" id="id_candidate_exp" class=" form-control" value="">
          <div class="card card-success">
            <div class="card-header" style="text-align: center;">
              <h4 class="card-title">
                Experiencia
              </h4>
              <btn class="btn btn-orange" style=" float:right" onclick="agregarFila()">
                <i class="fas fa-plus"></i>
              </btn>
            </div>
            <div class="card-body">
              <div class="card-body" id="div_experience">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group" style="text-align: center">
                      <label for="" class="col-form-label" style="margin-top:30px">Información:</label>

                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group" style="text-align: center">
                      <label class="col-form-label">Empresa/puesto</label>
                      <input type="text" name="enterprise_experience[]" id="enterprise_experience" style="text-align:center" class=" form-control" value="">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group" style="text-align: center">
                      <label class="col-form-label">Descripción</label>
                      <textarea name="review_experience[]" id="review_experience" style="text-align:center" class=" form-control" value="" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                      </textarea>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group" style="text-align: center">
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
        </div>
      </form>
    </div>
  </div>
</div>



<script>
  document.querySelector('#experiencia-operativa-form').addEventListener('submit', e => {
    e.preventDefault();
    document.querySelector("#modal-experiencia #submit").disabled = true;
    let candidato = new Candidate();
    console.log("entre");
    candidato.save_experiencia();

  });

  function agregarFila() {
    if (document.getElementById('div_experience')) {
      const div = document.querySelector('#div_experience');
      const row = document.createElement('div');
      row.classList.add('row');
      row.classList.add('borrados');
      row.innerHTML = `
                          <div class="col-md-2">
                            <div class="form-group" style="text-align: center">
                              <label for="" class="col-form-label" style="margin-top:30px"></label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group" style="text-align: center">
                               <label class="col-form-label"></label>
                              <input type="text" name="enterprise_experience[]"  style="text-align:center" class=" form-control"  >
                            </div>
                          </div>

                          <div class="col-md-5">
                            <div class="form-group" style="text-align: center">
                             <label class="col-form-label"></label>
                             <textarea   name="review_experience[]"  rows="4"  class=" form-control" > </textarea>
                            </div>
                          </div>
                          <div class="col-md-1">
						           	<div class="form-group" style="text-align: center;padding-top:1.3rem">
						           	<btn class="btn btn-danger" onclick="delete_row(this)">
						            	<i class="fas fa-trash"></i> 
						            </btn>
						          	</div>
                         
          `;
      div.appendChild(row);
    }
  }
</script>