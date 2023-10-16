class Training {
    save(flag) {
        var form = document.querySelector("#modal_create_training form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Capacitaciones/save');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                        $('#modal_indicators').modal('hide');
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado con exito.', 'success');
                        let trining = ''
                        json_app.trainings.forEach(element => {
                            trining += `
                        <tr>
                            <td class=" align-middle text-center">${element.title}</td>
                            <td class=" align-middle text-center">${element.clave_area_tematica}</td>
                            <td class=" align-middle text-center">${element.description}</td>
                            <td class=" align-middle text-center">${element.hours} hrs</td>
                            <td class=" align-middle text-center">${element.nombre_cliente}</td>
                            <td class=" align-middle text-center">${element.start_date}</td>
                            <td class=" align-middle text-center">${element.end_date}</td>
                            <td class=" align-middle text-center">
                            <div class="row">
                              <div class="col-4">
                                <a href="${element.url}" target="_blank" class="btn btn-success">
                                  <i class="fas fa-eye"></i>
                                </a>
                              </div>
                              <div class="col-4">
                              <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                              </div>
                              <div class="col-4">
                              <button class="btn btn-danger text-bold" value="${element.id}">X</button>  
                              </div>
                            </div>
                          </td>
                        </tr>
                        `
                        });

                        utils.destruir_datatable('#tb_employees', '#tboodyTraining', trining);


                        $('#modal_create_training').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                        form.reset();

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 3) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('La fecha inicial es mayor que la final.', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                }
            }
        }
    }

    getTraining(id) {
        var form = document.querySelector("#modal_create_training form");
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Capacitaciones/getOne');
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
                        document.querySelectorAll('#modal_create_training input')[0].value = json_app.trainings.title
                        $('#modal_create_training #select_tematica').val(` ${json_app.trainings.clave_area_tematica}`).trigger('change.select2');
                        document.querySelector('#modal_create_training textarea').value = json_app.trainings.description
                        document.querySelector('#modal_create_training [name="hours"]').value = json_app.trainings.hours
                        document.querySelector('#modal_create_training [name="start_date"]').value = json_app.trainings.start_date
                        document.querySelector('#modal_create_training [name="end_date"]').value = json_app.trainings.end_date
                        document.querySelector('#modal_create_training [name="training_agent"]').value = json_app.trainings.training_agent
                        document.querySelector('#modal_create_training [name="instructor"]').value = json_app.trainings.instructor
                        document.querySelector('#modal_create_training #Cliente').value = json_app.trainings.Cliente
                        document.querySelector('#modal_create_training [name="id"]').value = id
                        document.querySelector('#modal_create_training [name="flag"]').value = 2

                        let employees = ''
                        json_app.employees.forEach(element => {
                            employees += `
                            <option value='${element.id_employee}' >${element.employePosition}</option>
                            `;
                        });

                        document.querySelector('#modal_create_training #select_integrantes').innerHTML = employees;

                        document.querySelectorAll('#select_integrantes option').forEach(element => {
                            json_app.employee_trainings.forEach(contact => {
                                if (element.value == contact.id_employee) {
                                    element.setAttribute('selected', 'selected');
                                }
                            });
                        })




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


    deleteTraing(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Capacitaciones/deleteTraing');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Eliminado con exito.', 'success');



                        let trining = ''
                        json_app.trainings.forEach(element => {
                            trining += `
                        <tr>
                            <td class=" align-middle ">${element.title}</td>
                            <td class=" align-middle ">${element.clave_area_tematica}</td>
                            <td class=" align-middle ">${element.description}</td>
                            <td class=" align-middle ">${element.hours} hrs</td>
                            <td class=" align-middle ">${element.nombre_cliente}</td>
                            <td class=" align-middle ">${element.start_date}</td>
                            <td class=" align-middle ">${element.end_date}</td>
                            <td class=" align-middle text-center">
                            <div class="row">
                              <div class="col-4">
                                <a href="${element.url}" target="_blank" class="btn btn-success">
                                  <i class="fas fa-eye"></i>
                                </a>
                              </div>
                              <div class="col-4">
                              <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                              </div>
                              <div class="col-4">
                              <button class="btn btn-danger text-bold" value="${element.id}">X</button>  
                              </div>
                            </div>
                          </td>
                        </tr>
                        `
                        });

                        utils.destruir_datatable('#tb_employees', '#tboodyTraining', trining);


                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                }
            }
        }
    }


    deleteTraingEmployee(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Capacitaciones/deleteTrainingEmployee');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Eliminado con exito.', 'success');
                        let trining = ''
                        json_app.trainings.forEach(element => {
                            trining += `
                        <tr>
                            <td class=" align-middle ">${element.title}</td>
                            <td class=" align-middle ">${element.description}</td>
                            <td class=" align-middle ">${element.hours} hrs</td>
                            <td class=" align-middle ">${element.nombre_cliente}</td>
                            <td class=" align-middle ">${element.start_date}</td>
                            <td class=" align-middle ">${element.end_date}</td>
                            <td class=" align-middle ">${element.modified_at}</td>
                            <td class=" align-middle ">
                              <button class="btn btn-danger text-bold" value="${element.id_empployee+','+element.id_employee}">X</button>  
                            </td>
                        </tr>
                        `
                        });

                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                }
            }
        }
    }
}