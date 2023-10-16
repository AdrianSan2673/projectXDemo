class CriterionScore {

    save() {
        var form = document.querySelector("#modal-criterionScore form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../critieropuntuaje/save');
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

                            let th = ''
                            th += `
                              <th>
                                ${json_app.criterion.criterion}
                                <button class="btn btn-warning rounded-circle float-right btn_new_category_criterion" value="${json_app.criterion.id}"><i class="fas fa-edit"></i></button>
                              </th>`


                            json_app.criterionsScore.forEach(element => {
                                th += `
                                   <th>
                                   ${element.name}
                                   <div class="row float-right">
                                     <div class="col-6">
                                        <button class="btn btn-info btn_update_criterion_score" value="${element.id}"><i class="fas fa-edit"></i></button>
                                     </div>

                                     <div class="col-6">
                                       <button class="btn btn-danger text-bold btn_delete_criterion_score" value="${element.id}">X</button>
                                     </div>
                                   </div>`
                                });


                            document.querySelector('#thead_category_' + json_app.id_criterion + ' tr').innerHTML = th;

                            let questions = ''
                            json_app.questions.forEach(element => {
                                questions += `
                                <tr>
                                <th>${element.question}
                                  <small class="badge badge-dark" data-toggle="tooltip" data-placement="top" title data-original-title="${element.definition}" ${element.definition==''?'hidden':''}>
                                    <i class="fas fa-question"></i>
                                  </small>
              
                                  <div class="row float-right">
                                    <div class="col-6">
                                      <button class="btn btn-info  float-right btn_update_question" value="${element.id}"><i class="fas fa-edit"></i></button>
                                    </div>
                                    
                                    <div class="col-6">
                                      <button class=" btn btn-danger text-bold float-right btn_delete_question" value="${element.id}">X</button>
                                    </div>
                                  </div>
                              </th>
                              
                                 ${json_app.td}                                 
                              </tr>
                                `
                            });

                            document.querySelector('#tbody_category_' + json_app.id_criterion).innerHTML = questions;

                            $(function () {
                                $('[data-toggle="tooltip"]').tooltip()
                            })

                            form.querySelectorAll('.btn')[1].disabled = false;
                            form.reset()
                            
                            $('#modal-criterionScore').modal('hide');
                            utils.showToast('Se realizo con exito', 'success');
                            
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Agrega un criterio',
                                text: 'Para empezar primero debes crear un criterio',
                            })
                            
                            $('#modal-criterionScore').modal('hide');
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



    getCriterionScore(id) {
        var form = document.querySelector("#modal-criterionScore form");
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../critieropuntuaje/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 1) {

                        document.querySelector('#modal-criterionScore [name="name"]').value = json_app.criterionScore.name
                        document.querySelector('#modal-criterionScore [name="value"]').value = json_app.criterionScore.value

                    } else {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[0].disabled = false;
                    //utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }



    delete(id) {

        let xhr = new XMLHttpRequest();
        let data = `id=${id}`;

        xhr.open('POST', '../critieropuntuaje/delete');
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
                        let th = ''
                        th += `
                  <th>
                    ${json_app.criterion.criterion}
                    <button class="btn btn-warning rounded-circle float-right btn_new_category_criterion" value="${json_app.criterion.id}"><i class="fas fa-edit"></i></button>
                  </th>`

                        json_app.criterionsScore.forEach(element => {
                            th += `
                    <th>
                    ${element.name}
                    <div class="row float-right">
                      <div class="col-6">
                         <button class="btn btn-info btn_update_criterion_score" value="${element.id}"><i class="fas fa-edit"></i></button>
                      </div>

                      <div class="col-6">
                        <button class="btn btn-danger text-bold btn_delete_criterion_score" value="${element.id}">X</button>
                      </div>
                    </div>
                  `
                        });

                        document.querySelector('#thead_category_' + json_app.id_criterion + ' tr').innerHTML = th;

                        let questions = ''
                        json_app.questions.forEach(element => {
                            questions += `
                    <tr>
                    <th>${element.question}
                      <small class="badge badge-dark" data-toggle="tooltip" data-placement="top" title data-original-title="${element.definition}" ${element.definition==''?'hidden':''}>
                        <i class="fas fa-question"></i>
                      </small>
  
                      <div class="row float-right">
                        <div class="col-6">
                          <button class="btn btn-info  float-right btn_update_question" value="${element.id}"><i class="fas fa-edit"></i></button>
                        </div>
                        
                        <div class="col-6">
                          <button class=" btn btn-danger text-bold float-right btn_delete_question" value="${element.id}">X</button>
                        </div>
                      </div>
                  </th>
                  
                     ${json_app.td}                                 
                  </tr>
                    `
                        });

                        document.querySelector('#tbody_category_' + json_app.id_criterion).innerHTML = questions;

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
}