<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <h3>Política de vacaciones</h3>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="row">
        <div class="col-sm-2 ml-auto">
          <button class="btn btn-orange float-right" id="btn_new_policy">Crear Política</button>
        </div>
      </div>
    </section>
    <section class="content" id="policies-content">
      <div class="row mt-3 ">
        <?php foreach ($policies as $policy):  ?>
        <div class="col-md-4">
          <div class="card collapsed-card">
            <div class="card-header">
              <h4 class="card-title"><?= $policy['name'] ?></h4>
              <div class="card-tools">
                <?php if ($policy['id'] != 1): ?>
                  <button type="button" class="btn btn-tool btn-edit" data-id="<?=$policy['id']?>"><i class="far fa-edit"></i>
                </button>
                <?php endif; ?>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-sm">
                <thead>
                  <th class="text-center">Años laborados</th>
                  <th class="text-center">Días de vacaciones</th>
                </thead>
                <tbody>
                  <?php foreach ($policy['holidays'] as $holiday): ?>
                  <tr>
                    <td class="text-center"><?=$holiday['years']?></td>
                    <td class="text-center"><?=$holiday['holidays']?></td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>
    </section>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', e => {
    document.querySelector('#btn_new_policy').addEventListener('click', e => {
      e.preventDefault();
      $('#modal_policy').modal({backdrop: 'static', keyboard: false});
      var form = document.querySelector("#modal_policy form");
      form.querySelectorAll('input')[0].value = 1;
      var formData = new FormData(form);
      let xhr = new XMLHttpRequest();
      document.querySelectorAll('#modal_policy form .btn')[1].disabled = false;
      xhr.open('POST', '../vacaciones/getOnePolicy');
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('id=1');
      xhr.onreadystatechange = function(){
          if (xhr.readyState == 4 && xhr.status == 200) {
              let r = xhr.responseText;
              console.log(r);
              try {
                let json_app = JSON.parse(r);
                if (json_app.status == 1) {
                  form.querySelectorAll('input')[1].value = json_app.policy.name;
                  form.querySelector('.form-row').innerHTML = '';
                  let holidays = '';
                  for (let i in json_app.holidays){
                    holidays += `
                      <div class="col-sm-4 col">
                          <div class="form-group row">
                              <label class="col-form-label col-3">${json_app.holidays[i].years +  ' años:'}</label>
                              <div class="col-7 input-group">
                                  <input type="number" name="holiday${json_app.holidays[i].years}" id="holiday${json_app.holidays[i].years}" class="form-control" value="${json_app.holidays[i].holidays}">
                                  <div class="input-group-append">
                                      <span class="input-group-text">días</span>
                                  </div>
                              </div>
                          </div>
                      </div>`;
                  }
                  form.querySelector('.form-row').innerHTML = holidays;
                }else {
                  utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
              } catch (error) {
                  utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
              }
                  
        }
      }
    })
    document.querySelector('#modal_policy form').addEventListener('submit', e => {
      e.preventDefault();
      var form = document.querySelector("#modal_policy form");
      var formData = new FormData(form);
      form.querySelectorAll('.btn')[1].disabled = true;
      
      let xhr = new XMLHttpRequest();
      xhr.open('POST', '../Vacaciones/savePolicy');
      xhr.send(formData);
      xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
          let r = this.responseText;
          console.log(r);
          try {
            let json_app = JSON.parse(r);
            if (json_app.status == 1) {
              window.location.reload();
            }
          } catch (error) {
              utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
              form.querySelectorAll('.btn')[1].disabled = false;
          }
                  
        }
      }
    })
    document.querySelector('#policies-content').addEventListener('click', e => {
      e.preventDefault();
      if (e.target.classList.contains('btn-edit') || e.target.parentElement.classList.contains('btn-edit')) {
        $('#modal_policy').modal({backdrop: 'static', keyboard: false});
        let id;
        if (e.target.classList.contains('btn-edit'))
            id = e.target.dataset.id;
        else
            id = e.target.parentElement.dataset.id;

        var form = document.querySelector("#modal_policy form");
        form.querySelectorAll('input')[0].value = id;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../vacaciones/getOnePolicy');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id='+id);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                  let json_app = JSON.parse(r);
                  if (json_app.status == 1) {
                    form.querySelectorAll('input')[1].value = json_app.policy.name;
                    form.querySelector('.form-row').innerHTML = '';
                    let holidays = '';
                    for (let i in json_app.holidays){
                      holidays += `
                        <div class="col-sm-4 col">
                            <div class="form-group row">
                                <label class="col-form-label col-3">${json_app.holidays[i].years +  ' años:'}</label>
                                <div class="col-7 input-group">
                                    <input type="number" name="holiday${json_app.holidays[i].years}" id="holiday${json_app.holidays[i].years}" class="form-control" value="${json_app.holidays[i].holidays}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">días</span>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }
                    form.querySelector('.form-row').innerHTML = holidays;
                  }else {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                  }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' +error, 'error');
                }
                    
          }
        }
    }
    })
  })
  
</script>