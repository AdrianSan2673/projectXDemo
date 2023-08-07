class OpenQuestion {

    save() {
        var form = document.querySelector("#modal_question_open form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../preguntasabiertas/save');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;

                        let openquestions = ''
                        let i = 0
                        json_app.openQuestions.forEach(element => {
                            openquestions += `
                                <div class="row pt-3">
                                <div class="col-md-11">
                                  <label for="knowledge" class="col-form-label">${element.question}</label>
                                </div>

                                <div class="col-md-1 float-right">
                                  <div class="row">
                                    <div class="col-6">
                                      <button class="btn btn-info btn_new_openquestion" value="${element.id}"><i class="fas fa-edit"></i></button>
                                    </div>

                                    <div class="col-6"  ${i==0&&element.status==2?'hidden':''}>
                                      <button class="btn btn-danger text-bold btn_delete_openquestion" value="${element.id}">X</button>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-12 pt-3">
                                  <textarea class="form-control" maxlength="400" rows="3" disabled></textarea>
                                </div>
                              </div>`
                            i++;
                        })

                        document.querySelector("#" + json_app.id_question_js).innerHTML = openquestions;
                        $('#modal_question_open').modal('hide');


                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
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

        xhr.open('POST', '../preguntasabiertas/dalete');
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
                        let openquestions = ''
                        let i=0;
                        json_app.openQuestions.forEach(element => {
                            openquestions += `
                                <div class="row pt-3">
                                <div class="col-md-11">
                                  <label for="knowledge" class="col-form-label">${element.question}</label>
                                </div>

                                <div class="col-md-1 float-right">
                                  <div class="row">
                                    <div class="col-6">
                                      <button class="btn btn-info btn_new_openquestion" value="${element.id}"><i class="fas fa-edit"></i></button>
                                    </div>

                                    <div class="col-6" ${i==0&&element.status==2?'hidden':''}>
                                      <button class="btn btn-danger text-bold btn_delete_openquestion" value="${element.id}">X</button>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-12 pt-3">
                                  <textarea class="form-control" maxlength="400" rows="3" disabled></textarea>
                                </div>
                              </div>`
                              i++
                        })

                        document.querySelector("#" + json_app.id_question_js).innerHTML = openquestions;
                        utils.showToast('Fue eliminado exitosamente.', 'success');
                    } else if (json_app.status == 2) {
                        utils.showToast('El departamento contiene empleados o puestos.', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }



    getOpenQuestion(id) {
        var form = document.querySelector("#modal_question_open form");
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../preguntasabiertas/getOne');
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
                        document.querySelector('#modal_question_open [name="question"]').value = json_app.openQuestion.question
                        document.querySelector('#modal_category [name="flag"]').value = 2
                        document.querySelector('#modal_question_open [name="status"]').value = json_app.openQuestion.status

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