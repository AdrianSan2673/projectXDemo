class EvaluationCategory {

  save() {
    var form = document.querySelector("#modal_category form");
    var formData = new FormData(form);
    form.querySelectorAll('.btn')[1].disabled = true;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../evaluacionescategoria/save');
    xhr.send(formData);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let r = this.responseText;
        console.log(r);
        try {
          if (r == 0) {
            utils.showToast('Omitiste algún dato', 'warning');
            form.querySelectorAll('.btn')[1].disabled = false;
          } else {
            let json_app = JSON.parse(r);
            if (json_app.status == 2) {
              utils.showToast('Hubo un error al guardar, intenta de nuevo.', 'error');
              form.querySelectorAll('.btn')[1].disabled = false;
            } else if (json_app.status == 1) {

              let category = '';
              json_app.evaluationCategory.forEach(element => {
                category += `
                    <div class="card">
                      <div class="card-header">
                          <h4 class="card-title w-100">
                              <div class="row">
                                  <div class="col-md-11">
                                      <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse_${element.id}" aria-expanded="false">
                                      ${element.category} 
                                      </a>
                                  </div>

                                  <div class="col-md-1 float-right">
                                      <div class="row">
                                          <div class="col-6">
                                              <button class="btn btn-info btn_update_category" value="${element.id_category_encryption}"><i class="fas fa-edit"></i></button>
                                          </div>

                                          <div class="col-6">
                                              <button class="btn btn-danger text-bold btn_delete_category" value="${element.id_category_encryption}">X</button>
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </h4>
                      </div>

                      <div id="collapse_${element.id}" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                              <p>${element.description}</p>

                              <div id="div_category_cirterion_${element.id}">`

                              element.getCriterionsCategory.forEach(elementCriterion => {

                                category+= `
                                <div class="row">
                                  <div class="col-md-12">
                                      <div class="card">
                                          <div class="card-header bg-cyan">
                                              <h5 class="card-title" id="criterion_name_${elementCriterion.id}">${elementCriterion.criterion}</h5>
                                              <div class="card-tools">
                                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                      <i class="fas fa-minus"></i>
                                                  </button>
            
                                                  <button type="button" class="btn btn-tool btn_delete_criterion" value="${elementCriterion.id_criterion_encryption}">
                                                      <i class="fas fa-times"></i>
                                                  </button>
            
                                              </div>
                                          </div>
            
                                          <div class="card-body" style="display: block;" id="card_body_criterion_${elementCriterion.id}">
            
                                              <div class="row">
                                                  <div class="col-11">
                                                      <table class="table table-bordered table-hover mt-3">
                                                          <thead id="thead_category_${elementCriterion.id}">
                                                              <tr>
            
                                                                  <th>
                                                                      ${elementCriterion.criterion==null?'Criterio':elementCriterion.criterion}
            
                                                                      <button class="btn btn-warning rounded-circle float-right btn_new_category_criterion" value="${elementCriterion.id_criterion_encryption}" name="${elementCriterion.id_category_encryption}"><i class="fas fa-edit"></i></button>
            
                                                                  </th>
            
                                                                  ${elementCriterion.th==undefined?'':elementCriterion.th}
                                                              </tr>
                                                          </thead>
            
            
                                                          <tbody id="tbody_category_${elementCriterion.id}">
                                                              ${elementCriterion.tr==undefined?'':elementCriterion.tr}
                                                          </tbody>
            
                                                      </table>
                                                  </div>
            
                                                  <div class="col-1 text-center m-auto">
                                                      <button class="btn btn-warning rounded-circle btn_new_criterionScore" value="${elementCriterion.id_criterion_encryption}"><i class="fas fa-plus"></i></button>
                                                  </div>
            
                                                  <div class="col-12 text-center">
                                                      <button class="btn btn-success rounded-circle btn_new_question" value="${elementCriterion.id_criterion_encryption}"><i class="fas fa-plus"></i></button>
                                                  </div>
                                              </div>
            
            
                                          </div>
                                      </div>
            
                                  </div>
            
                              </div> ` 
                              });


                              category += `  </div>

                              <div class="row">
                                  <div class="col-12">
                                      <button class="btn btn-orange creat_new_criterion" value="${element.id_category_encryption}"> Crear nuevo criterio</button>
                                  </div>
                              </div>

                          </div>
                      </div>

                  </div>`
              });

              document.querySelector('#accordion').innerHTML = category;

              $(function () {
                $('[data-toggle="tooltip"]').tooltip()
              })

              form.reset()
              form.querySelectorAll('.btn')[1].disabled = false;

              utils.showToast('Se realizo con exito', 'success');
              $('#modal_category').modal('hide');

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


  delete(id) {

    let xhr = new XMLHttpRequest();
    let data = `id=${id}`;

    xhr.open('POST', '../evaluacionescategoria/delete');
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
            let category = '';
            json_app.evaluationCategory.forEach(element => {
              category += `
                  <div class="card">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            <div class="row">
                                <div class="col-md-11">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse_${element.id}" aria-expanded="false">
                                    ${element.category} 
                                    </a>
                                </div>

                                <div class="col-md-1 float-right">
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-info btn_update_category" value="${element.id_category_encryption}"><i class="fas fa-edit"></i></button>
                                        </div>

                                        <div class="col-6">
                                            <button class="btn btn-danger text-bold btn_delete_category" value="${element.id_category_encryption}">X</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </h4>
                    </div>

                    <div id="collapse_${element.id}" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p>${element.description}</p>

                            <div id="div_category_cirterion_${element.id}">`

                            element.getCriterionsCategory.forEach(elementCriterion => {

                              category+= `
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-cyan">
                                            <h5 class="card-title" id="criterion_name_${elementCriterion.id}">${elementCriterion.criterion}</h5>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
          
                                                <button type="button" class="btn btn-tool btn_delete_criterion" value="${elementCriterion.id_criterion_encryption}">
                                                    <i class="fas fa-times"></i>
                                                </button>
          
                                            </div>
                                        </div>
          
                                        <div class="card-body" style="display: block;" id="card_body_criterion_${elementCriterion.id}">
          
                                            <div class="row">
                                                <div class="col-11">
                                                    <table class="table table-bordered table-hover mt-3">
                                                        <thead id="thead_category_${elementCriterion.id}">
                                                            <tr>
          
                                                                <th>
                                                                    ${elementCriterion.criterion==null?'Criterio':elementCriterion.criterion}
          
                                                                    <button class="btn btn-warning rounded-circle float-right btn_new_category_criterion" value="${elementCriterion.id_criterion_encryption}" name="${elementCriterion.id_category_encryption}"><i class="fas fa-edit"></i></button>
          
                                                                </th>
          
                                                                ${elementCriterion.th==undefined?'':elementCriterion.th}
                                                            </tr>
                                                        </thead>
          
          
                                                        <tbody id="tbody_category_${elementCriterion.id}">
                                                            ${elementCriterion.tr==undefined?'':elementCriterion.tr}
                                                        </tbody>
          
                                                    </table>
                                                </div>
          
                                                <div class="col-1 text-center m-auto">
                                                    <button class="btn btn-warning rounded-circle btn_new_criterionScore" value="${elementCriterion.id_criterion_encryption}"><i class="fas fa-plus"></i></button>
                                                </div>
          
                                                <div class="col-12 text-center">
                                                    <button class="btn btn-success rounded-circle btn_new_question" value="${elementCriterion.id_criterion_encryption}"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
          
          
                                        </div>
                                    </div>
          
                                </div>
          
                            </div> ` 
                            });


                            category += `  </div>

                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-orange creat_new_criterion" value="${element.id_category_encryption}"> Crear nuevo criterio</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>`
            });

            document.querySelector('#accordion').innerHTML = category;

            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })

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



  getEvaluationCategory(id) {
    var form = document.querySelector("#modal_category form");
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../evaluacionescategoria/getOne');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + id);

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let r = xhr.responseText;
        console.log(r);
        try {
          let json_app = JSON.parse(r);
          if (json_app.status == 0) {
            form.querySelectorAll('.btn')[0].disabled = false;
            utils.showToast('Omitiste algún dato', 'error');
          } else if (json_app.status == 1) {
            document.querySelector('#modal_category [name="flag"]').value = 2
            document.querySelector('#modal_category [name="id"]').value = json_app.evaluationCategory.id
            document.querySelector('#modal_category [name="category"]').value = json_app.evaluationCategory.category
            document.querySelector('#modal_category [name="description"]').value = json_app.evaluationCategory.description
          } else if (json_app.status == 2) {
            form.querySelectorAll('.btn')[0].disabled = false;
            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
          } else if (json_app.status == 3) {
            utils.showToast('La fecha inicial es mayor que la final.', 'error');
          } else {
            form.querySelectorAll('.btn')[0].disabled = false;
            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
          }
        } catch (error) {
          form.querySelectorAll('.btn')[0].disabled = false;
          utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
        }

      }
    }
  }


}