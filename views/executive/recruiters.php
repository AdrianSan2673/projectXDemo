<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h3>Reclutadores asignados a <?=$ejecutivo->first_name.' '.$ejecutivo->last_name?></h3>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card car-success">
            <div class="card-header">
              <h3 class="card-title">Listado de reclutadores</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="recruiter" class="col-form-label">Reclutador</label>
                    <select name="recruiter" id="recruiter" class="form-control select2" required>
                      <option disabled selected="selected"></option>
                      <?php foreach ($unassigned_recruiters as $recruiter): ?>
                        <option value="<?=$recruiter['id']?>"><?=$recruiter['first_name'].' '.$recruiter['last_name'] ?></option>
                      <?php endforeach ?>
                    </select>
                    <input type="hidden" id="executiveJR" value="<?=$ejecutivo->id?>">
                  </div>
                </div>
                <div class="col-md-4 align-middle text-center">
                  <div class="form-group">
                    <button type="submit" class="btn btn-success" id="btn_assign_recruiter">Asignar reclutador</button>
                  </div>
                </div>
              </div>
                
                
              <table id="tb_recruiters" class="table table-striped">
                <thead>
                    <tr>
                      <th>Nombre completo</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($executiveJR_recruiters as $recruiter): ?>
                    <tr>
                        <td><?=$recruiter['first_name'].' '.$recruiter['last_name']?></td>
                        <td class="text-center py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="<?=base_url?>ejecutivos/delete_executiveJR_recruiter&id_executiveJR=<?=$_GET['id']?>&id_recruiter=<?=$recruiter['id']?>" class="btn btn-danger"><i class="fas fa-times"></i>
                            </a>
                          </div>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                      <th>Nombre completo</th>
                      <th></th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>      
</div>
<script type="text/javascript" src="<?=base_url?>app/executivejrrecruiters.js?v=<?=rand()?>"></script>
<script>
  $(document).ready(function(){
    let table = document.querySelector('#tb_recruiters');
    utils.dtTable(table);
  });
  document.querySelector("#btn_assign_recruiter").onclick = function(e){
    e.preventDefault();
    er = new ExecutiveJRRecruiters();
    er.save();
  };
</script>