class Evaluationempoyee {

    save() {
        var form = document.querySelector("#modal_send_evalaution form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../evaluaciones/saveEalaucionEmpleado');
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
                            utils.showToast('Se envio con exito', 'success');
                            form.querySelectorAll('.btn')[1].disabled = false;
                            form.reset();
                            $('#select_employee').val(null).trigger('change');

                            document.querySelector('#email_input').required = true
                            document.querySelector('#email_input').hidden = false
                            document.querySelector('#email_employee').required = false
                            document.querySelector('#email_employee').hidden = true

                            let options = '<option value="">Escribir email</option>'
                            document.querySelector('#email_employee').innerHTML = options;

                            setTimeout(function () {
                                window.location.reload();
                            }, 1200);

                            $('#modal_send_evalaution').modal('hide');


                        } else if (json_app.status == 2) {
                            form.querySelectorAll('.btn')[1].disabled = false;
                            utils.showToast('Se actualizo con exito', 'success');

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
    // ===[gabo 15 mayo evaluaciones ]===
    save2() {
        var form = document.querySelector("#modal_send_evalaution form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../evaluaciones/saveEalaucionEmpleado2');
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
                            utils.showToast('Se envio con exito', 'success');
                            form.querySelectorAll('.btn')[1].disabled = false;
                            form.reset();
                            $('#select_employee').val(null).trigger('change');

                            document.querySelector('#email_input').required = true
                            document.querySelector('#email_input').hidden = false
                            document.querySelector('#email_employee').required = false
                            document.querySelector('#email_employee').hidden = true

                            let options = '<option value="">Escribir email</option>'
                            document.querySelector('#email_employee').innerHTML = options;

                            $('#modal_send_evalaution').modal('hide');



                            let grupos = "";
                            json_app.groups.forEach(group => {

                                grupos +=
                                    `
                           <tr>
                           <td class="text-center align-middle">${group.name}</td>
                           <td class="text-center align-middle">${group.created_at}</td>
                           <td class="text-center align-middle">${group.fullNameBoss}</td>
                           <td class="text-center align-middle">${group.title}</td>
                           <td class="text-center align-middle">${group.start_date}</td>
                           <td class="text-center align-middle">${group.end_date}</td>
                           <td class="text-center align-middle">
                           <a href="${group.url}" class="btn btn-success">
                             <i class="fas fa-eye"></i> Ver
                             </a>
                             <btn class="btn btn-danger" onclick="delete_group('${group.id_group}')">
                               <i class="fas fa-trash"></i> Borrar
                             </btn>
                           </td>
                         </tr>`;
                            });


                            document.querySelector('#body_table_sendEvaluation').innerHTML = grupos;



                        } else if (json_app.status == 2) {
                            form.querySelectorAll('.btn')[1].disabled = false;
                            utils.showToast('Se actualizo con exito', 'success');

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



    delete_group(id_group) {

        const data = new FormData();
        data.append('id_group', id_group);
        fetch('../EvaluacionEmpleado/delete_group', {
                method: 'POST',
                body: data
            })
            .then(function (response) {
                //  console.log(response.json());
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la Petición";
                }

            })
            .then(function (json_app) {

                console.log(json_app);
                if (json_app.status == 1) {
                    let grupos = "";
                    json_app.groups.forEach(group => {

                        grupos +=
                            `
                        <tr>
                        <td class="text-center align-middle">${group.name}</td>
                        <td class="text-center align-middle">${group.created_at}</td>
                        <td class="text-center align-middle">${group.fullNameBoss}</td>
                        <td class="text-center align-middle">${group.title}</td>
                        <td class="text-center align-middle">${group.start_date}</td>
                        <td class="text-center align-middle">${group.end_date}</td>
                        <td class="text-center align-middle">
                            
                          <a href="${group.url}" class="btn btn-success">
                            <i class="fas fa-eye"></i> Ver
                          </a>
                          <btn class="btn btn-danger" onclick="delete_group('${group.id_group}')">
                            <i class="fas fa-trash"></i> Borrar
                          </btn>
                        </td>
                      </tr>`;
                    });
                    utils.showToast('Evaluaciónes eliminadas', 'success');
                    document.querySelector('#body_table_sendEvaluation').innerHTML = grupos;

                } else if (json_app.status == 0) {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                }


            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });


    }




    delete_evaluation(id_evaluation) {

        const data = new FormData();
        data.append('id_evaluation', id_evaluation);
        fetch('../EvaluacionEmpleado/delete_evaluation', {
                method: 'POST',
                body: data
            })
            .then(function (response) {
                //   console.log(response.json());
                if (response.ok) {
                    return response.json();

                } else {
                    throw "Error en la Petición";
                }

            })
            .then(function (json_app) {

                console.log(json_app);

                if (json_app.status == 1) {
                    let evaluaciones = "";
                    json_app.evaluations.forEach(evaluation => {

                        evaluaciones +=
                            `
                        <tr>
                        <td class="align-middle">${evaluation.name}</td>
                        <td class="align-middle">${evaluation.first_name} ${evaluation.surname} ${evaluation.last_name}</td>
                        <td class="align-middle text-center">${evaluation.department}</td>
                        <td class="align-middle text-center">${evaluation.title}</td>
                        <td class="align-middle"> ${evaluation.first_name_boss} ${evaluation.surname_boss} ${evaluation.last_name_boss}</td>
                        <td class="align-middle text-center">${evaluation.start_date} - ${evaluation.end_date}</td>
                        <td class="align-middle text-center">${evaluation.status}</td>
                        <td class="align-middle text-center">${evaluation.date_of_realization}</td>
                        <td class="align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="${evaluation.url}" class="btn btn-primary">
                              <i class="far fa-check-circle"></i> Evaluar
                            </a>
                            <btn class="btn btn-danger" onclick="delete_evaluation('${evaluation.id}')">
                              <i class="fas fa-trash"></i> Borrar
                            </btn>
        
                          </div>
                        </td>
                      </tr>`;

                    });

                    document.querySelector('#evaluations_table_list').innerHTML = evaluaciones;
                    utils.showToast('Evaluación eliminada', 'success');
                } else if (json_app.status == 0) {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                }


            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });


    }


    borrar_evaluation(id_evaluation) {
        const data = new FormData();
        data.append('id_evaluation', id_evaluation);
        fetch('../EvaluacionEmpleado/delete_evaluation', {
                method: 'POST',
                body: data
            })
            .then(function (response) {
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la Petición";
                }

            })
            .then(function (json_app) {
                console.log(json_app);
                if (json_app.status == 1) {
                    utils.showToast('Evaluación eliminada', 'success');
                    setTimeout(function () {
                        window.location.reload();
                    }, 1200);
                } else if (json_app.status == 0) {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                }
            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }


    // ===[gabo 15 mayo evaluaciones fin]===


}