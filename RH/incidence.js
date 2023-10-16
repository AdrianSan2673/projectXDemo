class Incidence {
    save(flag) {
        var form = document.querySelector("#modal-incidence form");
        var formData = new FormData(form);
        console.log(formData);
        form.querySelectorAll('.btn')[1].disabled = true

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Incidencias/save');
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
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado con exito.', 'success');

                        let incidentes = '';
                        json_app.employeeIncidence.forEach(element => {
                            incidentes += `
                            <tr>
                                <td class="text-center align-middle"> ${element.type}</td>
                                <td class="text-center align-middle">${element.type_incident}</td>
                                <td class="text-center align-middle">${element.comments}</td>
                                <td class="text-center align-middle">${element.created_at}</td>
                                <td class="text-center align-middle">${element.end_date}</td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                                </td>
                        </tr>
                            `
                        });

                        document.querySelector('#tboodyInciden').innerHTML = incidentes;

                        form.reset();
                        form.querySelectorAll('.btn')[1].disabled = false;
                        $('#modal-incidence').modal('hide');
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
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

    save_index() {
        var form = document.querySelector("#modal_create_incidencias form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Incidencias/save_index');
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
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado con exito.', 'success');


                        let incidentes = '';
                        json_app.employeeIncidence.forEach(element => {
                            incidentes += `
                        <tr>
                            <td class="text-center align-middle"> ${element.type}</td>
                            <td class="text-center align-middle">${element.type_incident}</td>
                            <td class="text-center align-middle">${element.comments}</td>
                            <td class="text-center align-middle">${element.employeFullName}</td>
                            <td class="text-center align-middle">${element.title}</td>
                            <td class="text-center align-middle">${element.department}</td>
                            <td class="text-center align-middle">${element.created_at}</td>
                            <td class="text-center align-middle">${element.end_date}</td>
                            <td class="text-center align-middle">
                                <a href="${element.id_employe}" class="btn btn-success"><i class="fas fa-eye"></i> Ver</a>
                                <button class="btn btn-danger text-bold" value="${element.id_incident}">X</button>
                            </td>
                        </tr>`
                        });


                        utils.destruir_datatable('#tb_employees', '#tboodyInciden', incidentes);

                        $('#modal_create_incidencias form [name="id_employees[]"]').val(null).trigger('change');
                        form.reset();
                        form.querySelectorAll('.btn')[1].disabled = false;
                        $('#modal_create_incidencias').modal('hide');

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
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

    getIncident(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Incidencias/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        document.querySelectorAll('#modal_create_incidencias  select')[0].value = json_app.type
                        document.querySelectorAll('#modal_create_incidencias  select')[1].value = json_app.employee
                        document.querySelector('#modal_create_incidencias textarea').value = json_app.comments
                        document.querySelectorAll('#modal_create_incidencias input')[1].value = id
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                }
            }
        }
    }

    delete(id, flag) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Incidencias/delete');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id + '&flag=' + flag);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        let incidentes = '';
                        if (json_app.flag == 2) {
                            let incidentes = '';
                            json_app.employeeIncidence.forEach(element => {
                                incidentes += `
                            <tr>
                                <td class="text-center align-middle"> ${element.type}</td>
                                <td class="text-center align-middle">${element.type_incident}</td>
                                <td class="text-center align-middle">${element.comments}</td>
                                <td class="text-center align-middle">${element.employeFullName}</td>
                                <td class="text-center align-middle">${element.title}</td>
                                <td class="text-center align-middle">${element.department}</td>
                                <td class="text-center align-middle">${element.created_at}</td>
                                <td class="text-center align-middle">${element.end_date}</td>
                                <td class="text-center align-middle">
                                    <a href="${element.id_employe}" class="btn btn-success"><i class="fas fa-eye"></i> Ver</a>
                                    <button class="btn btn-danger text-bold" value="${element.id_incident}">X</button>
                                </td>
                          </tr>
                            `
                            });
                            utils.destruir_datatable('#tb_employees', '#tboodyInciden', incidentes);


                        } else {
                            let incidentes = '';
                            json_app.employeeIncidence.forEach(element => {
                                incidentes += `
                            <tr>
                                <td class="text-center align-middle"> ${element.type}</td>
                                <td class="text-center align-middle">${element.type_incident}</td>
                                <td class="text-center align-middle">${element.comments}</td>
                                <td class="text-center align-middle">${element.created_at}</td>
                                <td class="text-center align-middle">${element.end_date}</td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                                </td>
                          </tr>
                            `
                            });

                            utils.destruir_datatable('#tb_employees', '#tboodyInciden', incidentes);

                        }
                        utils.showToast('Eliminado exitosamente.', 'success');


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