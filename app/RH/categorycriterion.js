class CategoryCriterion {


    save() {
        var form = document.querySelector("#modal-categoryCriterion form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../categoriacriterios/save');
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    if (r == 0) {
                        utils.showToast('Omitiste algún dato', 'warning');
                    } else {
                        let json_app = JSON.parse(r);
                        if (json_app.status == 2) {
                            utils.showToast('Hubo un error al guardar, intenta de nuevo.', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else if (json_app.status == 1) {


                            document.querySelector("#criterion_name_" + json_app.categoryCriterion.id).textContent = json_app.categoryCriterion.criterion
                            document.querySelector('#card_body_criterion_' + json_app.categoryCriterion.id).getElementsByTagName('th')[0].innerHTML = `
                            ${json_app.categoryCriterion.criterion}
                            <button class="btn btn-warning rounded-circle float-right btn_new_category_criterion" value="${json_app.categoryCriterion.id_cirtierion_encryption}"><i class="fas fa-edit"></i></button>
                            `
                            document.querySelector('#card_body_criterion_' + json_app.categoryCriterion.id + ' .btn_new_criterionScore').value = json_app.categoryCriterion.id_cirtierion_encryption
                            document.querySelector('#card_body_criterion_' + json_app.categoryCriterion.id + ' .btn_new_question').value = json_app.categoryCriterion.id_cirtierion_encryption

                            document.querySelector('#modal-categoryCriterion [name="flag"]').value = 1
                            form.querySelectorAll('.btn')[1].disabled = false;
                            form.reset()

                            $('#modal-categoryCriterion').modal('hide');
                            utils.showToast('Se realizo con exito', 'success');

                        } else if (json_app.status == 3) {
                            let div_category = '';
                            let category_criterion = '';

                            json_app.getCriterionsCategory.forEach(element => {
                                div_category = element.id_category

                                category_criterion += `
                                <div class="row">
                                  <div class="col-md-12">
                                      <div class="card">
                                          <div class="card-header bg-cyan">
                                              <h5 class="card-title" id="criterion_name_${element.id}">${element.criterion}</h5>
                                              <div class="card-tools">
                                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                      <i class="fas fa-minus"></i>
                                                  </button>
            
                                                  <button type="button" class="btn btn-tool btn_delete_criterion" value="${element.id_criterion_encryption}">
                                                      <i class="fas fa-times"></i>
                                                  </button>
            
                                              </div>
                                          </div>
            
                                          <div class="card-body" style="display: block;" id="card_body_criterion_${element.id}">
            
                                              <div class="row">
                                                  <div class="col-11">
                                                      <table class="table table-bordered table-hover mt-3">
                                                          <thead id="thead_category_${element.id}">
                                                              <tr>
            
                                                                  <th>
                                                                      ${element.criterion==null?'Criterio':element.criterion}
            
                                                                      <button class="btn btn-warning rounded-circle float-right btn_new_category_criterion" value="${element.id_criterion_encryption}" name="${element.id_category_encryption}"><i class="fas fa-edit"></i></button>
            
                                                                  </th>
            
                                                                  ${element.th==undefined?'':element.th}
                                                              </tr>
                                                          </thead>
            
            
                                                          <tbody id="tbody_category_${element.id}">
                                                              ${element.tr==undefined?'':element.tr}
                                                          </tbody>
            
                                                      </table>
                                                  </div>
            
                                                  <div class="col-1 text-center m-auto">
                                                      <button class="btn btn-warning rounded-circle btn_new_criterionScore" value="${element.id_criterion_encryption}"><i class="fas fa-plus"></i></button>
                                                  </div>
            
                                                  <div class="col-12 text-center">
                                                      <button class="btn btn-success rounded-circle btn_new_question" value="${element.id_criterion_encryption}"><i class="fas fa-plus"></i></button>
                                                  </div>
                                              </div>
            
            
                                          </div>
                                      </div>
            
                                  </div>
            
                              </div> ` 
                            
                            
                            });

                            document.querySelector('#div_category_cirterion_' + div_category).innerHTML = category_criterion


                            document.querySelector('#modal-categoryCriterion [name="flag"]').value = 1
                            form.querySelectorAll('.btn')[1].disabled = false;
                            form.reset()

                            $('#modal-categoryCriterion').modal('hide');
                            utils.showToast('Se realizo con exito', 'success');

                        } else {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        }
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }

            }
        }
    }


    getCategoryCriterion(id) {
        var form = document.querySelector("#modal_category form");
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../categoriacriterios/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 1) {
                        document.querySelector('#modal-categoryCriterion [name="flag"]').value = 2
                        document.querySelector('#modal-categoryCriterion [name="criterion"]').value = json_app.categoryCriterion.criterion
                        document.querySelector('#modal-categoryCriterion [name="id_category"]').value = json_app.categoryCriterion.id_category
                        document.querySelector('#modal-categoryCriterion [name="id_criterion"]').value = json_app.categoryCriterion.id
                    } else {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        document.querySelector('#modal-categoryCriterion [name="flag"]').value = 1
                        form.reset()

                        //utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[0].disabled = false;
                    document.querySelector('#modal-categoryCriterion [name="flag"]').value = 1
                    form.reset()
                    //utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }


    delete(id) {

        let xhr = new XMLHttpRequest();
        let data = `id=${id}`;
    
        xhr.open('POST', '../categoriacriterios/delete');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
    
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            let r = xhr.responseText;
            console.log(r);
            try {
              let json_app = JSON.parse(r);
              if (json_app.status == 0) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
              } else if (json_app.status == 1) {
                let div_category = '';
                let category_criterion = '';

                json_app.getCriterionsCategory.forEach(element => {

                    div_category = element.id_category

                    category_criterion += `
                    <div class="row">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header bg-cyan">
                                  <h5 class="card-title" id="criterion_name_${element.id}">${element.criterion}</h5>
                                  <div class="card-tools">
                                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                          <i class="fas fa-minus"></i>
                                      </button>

                                      <button type="button" class="btn btn-tool btn_delete_criterion" value="${element.id_criterion_encryption}">
                                          <i class="fas fa-times"></i>
                                      </button>

                                  </div>
                              </div>

                              <div class="card-body" style="display: block;" id="card_body_criterion_${element.id}">

                                  <div class="row">
                                      <div class="col-11">
                                          <table class="table table-bordered table-hover mt-3">
                                              <thead id="thead_category_${element.id}">
                                                  <tr>

                                                      <th>
                                                          ${element.criterion==null?'Criterio':element.criterion}

                                                          <button class="btn btn-warning rounded-circle float-right btn_new_category_criterion" value="${element.id_criterion_encryption}" name="${element.id_category_encryption}"><i class="fas fa-edit"></i></button>

                                                      </th>

                                                      ${element.th==undefined?'':element.th}
                                                  </tr>
                                              </thead>


                                              <tbody id="tbody_category_${element.id}">
                                                  ${element.tr==undefined?'':element.tr}
                                              </tbody>

                                          </table>
                                      </div>

                                      <div class="col-1 text-center m-auto">
                                          <button class="btn btn-warning rounded-circle btn_new_criterionScore" value="${element.id_criterion_encryption}"><i class="fas fa-plus"></i></button>
                                      </div>

                                      <div class="col-12 text-center">
                                          <button class="btn btn-success rounded-circle btn_new_question" value="${element.id_criterion_encryption}"><i class="fas fa-plus"></i></button>
                                      </div>
                                  </div>


                              </div>
                          </div>

                      </div>



                  </div> ` });

                document.querySelector('#div_category_cirterion_' + div_category).innerHTML = category_criterion
    
                utils.showToast('Fue eliminado exitosamente.', 'success');
              } else if (json_app.status == 2) {
                utils.showToast('El departamento contiene empleados o puestos.', 'error');
              } else {
                utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
              }
            } catch (error) {
              utils.showToast('Algo salió mal. Inténtalo de nuevo ', 'error');
            }
    
          }
        }
      }
    

}