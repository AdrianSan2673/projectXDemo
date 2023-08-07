class Evaluations {
    save() {
        var form = document.querySelector("#modal_create_evaluation form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../evaluaciones/creat');
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
                        if (json_app.status == 0) {
                            utils.showToast('Hubo un error al guardar, intenta de nuevo.', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else if (json_app.status == 1) {
                            form.querySelectorAll('.btn')[1].disabled = true;
                            utils.showToast('Se creo con exito', 'success');
                            $('#modal_create_evaluation').modal('hide');

                            //window.location.href = json_app.url;
                            setTimeout(function () {
                                window.location.reload()
                            }, 1200);
                            form.querySelectorAll('.btn')[1].disabled = false;

                        } else if (json_app.status == 2) {
                            form.querySelectorAll('.btn')[1].disabled = false;
                            utils.showToast('Se actualizo con exito', 'success');
                            $('#modal_create_evaluation').modal('hide');

                            let evaluations = '';
                            json_app.evaluations.forEach(element => {
                                evaluations += `
                            <div class="col-md-4 ">
                            <div class="small-box bg-info">
                                  <button class="btn text-white btn-delete" value="${element.id}">X</button>
                                  <button class="btn btn-info float-right" value="${element.id}"><i class="fas fa-edit"></i></button>

                                  <div class="inner">
                                    <h4>${element.name}</h4>
                                    <div class="row">
                                          <div class="col-4">
                                            <p style="font-size: small;">${element.levelFormat}</p>
                                          </div>
                                          <div class="col-8">
                                            <p style="font-size: small;">Actualizada en ${element.modified_at}</p>
                                          </div>
                                    </div>
                                  </div>
                                  <a class="small-box-footer" href="${element.url}">
                                    Ver
                                    <i class="fas fa-arrow-circle-right"></i>
                                  </a>
                            </div>
                          </div>
                            `
                            });
                            document.querySelector('#all_evaluaciones').innerHTML = evaluations;

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
        xhr.open('POST', '../evaluaciones/delete');
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
                        let evaluations = '';
                        json_app.evaluations.forEach(element => {
                            evaluations += `
                        <div class="col-md-4 ">
                        <div class="small-box bg-info">
                              <button class="btn text-white btn-delete" value="${element.id}">X</button>
                              <button class="btn btn-info float-right" value="${element.id}"><i class="fas fa-edit"></i></button>

                              <div class="inner">
                                <h4>${element.name}</h4>
                                <div class="row">
                                      <div class="col-4">
                                        <p style="font-size: small;">${element.levelFormat}</p>
                                      </div>
                                      <div class="col-8">
                                        <p style="font-size: small;">Actualizada en ${element.modified_at}</p>
                                      </div>
                                </div>
                              </div>
                              <a class="small-box-footer" href="${json_app.url}evaluaciones/ver&id=${element.id}">
                                Ver
                                <i class="fas fa-arrow-circle-right"></i>
                              </a>
                        </div>
                      </div>
                        `
                        });
                        document.querySelector('#all_evaluaciones').innerHTML = evaluations;
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

    getEvaluation(id) {
        var form = document.querySelector("#modal_create_evaluation form");
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../evaluaciones/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 1) {
                        document.querySelector('#modal_create_evaluation [name="flag"]').value = 2
                        document.querySelector('#modal_create_evaluation [name="name"]').value = json_app.evaluations.name
                        document.querySelector('#modal_create_evaluation [name="level"]').value = json_app.evaluations.level
                        document.querySelector('#modal_create_evaluation [name="type"]').checked = json_app.evaluations.type != 0 ? true : false
                        //===[gabo 12 junio excel evaluaciones pt2]===
                        document.getElementById("id_cliente_plantilla").value = json_app.evaluations.ID_Cliente;
                        //===[gabo 12 junio excel evaluaciones fin pt2]===

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


    getEMployeeByIdDeparamente(id_deparament) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ServicioApoyo/getEjecutivosYRazonesPorCliente');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id_deparament=' + id_deparament);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0) {
                    let json_app = JSON.parse(r);
                    let razones = '';
                    json_app.razones.forEach(razon => {
                        razones +=
                            `<option value="${razon.ID_Razon}">${razon.Nombre_Razon}</option>`;
                    });
                    razones += '<option value="Pendiente">Pendiente</option>';
                    document.querySelector('#select_razon_social').innerHTML = razones;
                }
            }
        }
    }

    evaluate() {
        var form = document.querySelector("#evaluate_form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[0].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../evaluacionempleado/evaluate');
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Evaluación realizada con éxito', 'success');
                        form.querySelectorAll('.btn')[0].disabled = true;
                        setTimeout(() => {
                            window.location.reload()
                        }, 3000);


                    } else {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[0].disabled = false;
                    utils.showToast('Omitiste algún dato', 'error');
                }

            }
        }
    }

    // ===[gabo 15 mayo evaluaciones]===
    evaluate2() {
        var form = document.querySelector("#evaluate_form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[0].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../evaluacionempleado/evaluate2');
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Evaluación realizada con éxito', 'success');
                        form.querySelectorAll('.btn')[0].disabled = true;
                        setTimeout(() => {
                            window.location.href = json_app.url;
                        }, 3000);


                    } else {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[0].disabled = false;
                    utils.showToast('Omitiste algún dato', 'error');
                }

            }
        }
    }
    // ===[gabo 15 mayo evaluaciones]===



}