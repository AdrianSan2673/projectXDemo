class Holidays {

    //===[gabo 20 oct]===
    save() {
        console.log('save');
        var form = document.querySelector('#modal_create_holidays form');
        let formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Vacaciones/save');
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);

                    if (r == 0)
                        utils.showToast('Omitiste algún dato', 'warning');
                    else {

                        if (json_app.status == 2) {
                            utils.showToast('Hubo un error al registrar la solicitud de vacaciones, intenta de nuevo.', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else if (json_app.status == 1) {

                            try {
                                const json_app = JSON.parse(r);
                                if (json_app.status === 0) {
                                    utils.showToast('Omitió algún dato', 'error');
                                } else if (json_app.status === 1) {
                                    console.log(json_app);

                                    let employees = '';
                                    json_app.employees.forEach(employee => {
                                        employees += `
                                    <tr>
                                        <td class="align-middle text-bold"> ${employee.first_name} ${employee.surname} ${employee.last_name}</td>
                                        <td class="text-center align-middle">${employee.start_date}</td>
                                        <td class="text-center align-middle">${employee.years}</td>
                                        <td class="text-center align-middle">${employee.holidays_by_year}</td>
                                        <td class="text-center align-middle">${employee.rest_vacation}</td>
                                        <td class="text-center align-middle">${employee.due_date}</td>
                                    </tr>
                                `;
                                    });

                                    utils.destruir_datatable('#tb_employees', '#tb_employees tbody', employees);


                                    var solicitudes = '';
                                    var cont = json_app.solicitudes.length;
                                    json_app.solicitudes.forEach(solicitud => {

                                        (solicitud.comments == '') ? solicitud.comments = '-' : false;
                                        solicitudes += ` <tr>
                                        <td class="text-center text-bold">${cont}</td>
                                        <td class="text-center">${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}</td>
                                        <td class="text-center">${solicitud.created_at}</td>
                                        <td class="text-center">${solicitud.start_date + " al " + solicitud.end_date}</td>
                                        <td class="text-center">${solicitud.days}</td>
                                        <td class="text-center">${solicitud.comments} </td>
                                        <td class="text-center"> `;
                                        if (solicitud.status == 'En revisión') {
                                            solicitudes += `  <button data-id="" value="${solicitud.id}" class="btn btn-success mt-1" id="btn-aceptar">
                                                    <i class="fas fa-check"> Aceptar</i>
                                                </button>
                                                <a data-id="${solicitud.id}" class="btn btn-danger mt-1" id="btn-denegar">
                                                    <i class="fas fa-ban"> Denegar</i>
                                                </a> <button value="${solicitud.id}"
                                            class="btn btn-warning mt-1" id="btn-borrar">
                                            <i class="fas fa-trash"> Borrar</i>
                                        </button>
										 <button value="${solicitud.id}"
                                        data-name='${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}'
                                        class="btn btn-info mt-1" id="btn-edit">
                                        <i class="fas fa-edit"> Editar</i>
                                    </button>`;
                                        }
                                        if (solicitud['status'] == 'Aceptada') {
                                            solicitudes += ` <small class="badge badge-success"> Aceptada</small>`;
                                        }
                                        if (solicitud['status'] == 'Declinada') {
                                            solicitudes += ` <small class="badge badge-danger"> Declinada</small>`;
                                        }

                                        solicitudes += `</td>
                                    </tr > `;

                                        cont--;
                                    });

                                    utils.destruir_datatable('#table3', '#table3 tbody', solicitudes);

                                    utils.showToast('Se agregó el periodo vacacional exitosamente', 'success');
                                    $('#modal_create_holidays').modal('hide');
                                    form.querySelectorAll('.btn')[1].disabled = false;
                                }
                            } catch (error) {
                                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                            }

                        }
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
            }
        }

    }

    //20 oct
    delete(id) {
        fetch('../Vacaciones/delete', {
            method: 'POST',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + id
        })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {
                console.log(r);
                try {
                    const json_app = JSON.parse(r);
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                    } else if (json_app.status === 1) {
                        let employees = '';
                        json_app.employees.forEach(employee => {
                            employees += `
                            <tr>
                                <td class="align-middle text-bold"> ${employee.first_name} ${employee.surname} ${employee.last_name}</td>
                                <td class="text-center align-middle">${employee.start_date}</td>
                                <td class="text-center align-middle">${employee.years}</td>
                                <td class="text-center align-middle">${employee.holidays_by_year}</td>
                                <td class="text-center align-middle">${employee.rest_vacation}</td>
                                <td class="text-center align-middle">${employee.due_date}</td>
                            </tr>
                        `;
                        });
                        utils.destruir_datatable('#tb_employees', '#tb_employees tbody', employees);


                        //tabla solicitud
                        // $('#table3').DataTable().destroy();
                        var solicitudes = '';
                        var cont = json_app.solicitudes.length;
                        json_app.solicitudes.forEach(solicitud => {

                            (solicitud.comments == '') ? solicitud.comments = '-' : false;
                            solicitudes += ` <tr>
                                        <td class="text-center text-bold">${cont}</td>
                                        <td class="text-center">${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}</td>
                                        <td class="text-center">${solicitud.created_at}</td>
                                        <td class="text-center">${solicitud.start_date + " al " + solicitud.end_date}</td>
                                        <td class="text-center">${solicitud.days}</td>
                                        <td class="text-center">${solicitud.comments} </td>
                                        <td class="text-center"> `;
                            if (solicitud.status == 'En revisión') {
                                solicitudes += `  <button data-id="" value="${solicitud.id}" class="btn btn-success mt-1" id="btn-aceptar">
                                                    <i class="fas fa-check"> Aceptar</i>
                                                </button>
                                                <a data-id="${solicitud.id}" class="btn btn-danger mt-1" id="btn-denegar">
                                                    <i class="fas fa-ban"> Denegar</i>
                                                </a> <button value="${solicitud.id}"
                                            class="btn btn-warning mt-1" id="btn-borrar">
                                            <i class="fas fa-trash"> Borrar</i>
                                        </button>
										`;
                            }
                            if (solicitud['status'] == 'Aceptada') {
                                solicitudes += ` <small class="badge badge-success"> Aceptada</small>`;
                            }
                            if (solicitud['status'] == 'Declinada') {
                                solicitudes += ` <small class="badge badge-danger"> Declinada</small>`;
                            }

                            solicitudes += ` <button value="${solicitud.id}"
                                        data-name='${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}'
                                        class="btn btn-info mt-1" id="btn-edit">
                                        <i class="fas fa-edit"> Editar</i>
                                    </button> </td >
                                    </tr > `;

                            cont--;
                        });


                        utils.destruir_datatable('#table3', '#table3 tbody', solicitudes);
                        utils.showToast('Fue eliminado exitosamente', 'success');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
            });
    }

    //===[20 oct]=== 
    update_holiday() {

        var form = document.querySelector("#modal_update_holidays form");
        var formData = new FormData(form);

        fetch('../Vacaciones/update_holiday', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                //  console.log(response.json());
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {

                try {
                    const json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                    } else if (json_app.status === 1) {
                        let employees = '';
                        json_app.employees.forEach(employee => {
                            employees += `
                            <tr>
                                <td class="align-middle text-bold"> ${employee.first_name} ${employee.surname} ${employee.last_name}</td>
                                <td class="text-center align-middle">${employee.start_date}</td>
                                <td class="text-center align-middle">${employee.years}</td>
                                <td class="text-center align-middle">${employee.holidays_by_year}</td>
                                <td class="text-center align-middle">${employee.rest_vacation}</td>
                                <td class="text-center align-middle">${employee.due_date}</td>
                            </tr>
                        `;
                        });
                        utils.destruir_datatable('#tb_employees', '#tb_employees tbody', employees);


                        //tabla solicitud
                        // $('#table3').DataTable().destroy();
                        var solicitudes = '';
                        var cont = json_app.solicitudes.length;
                        json_app.solicitudes.forEach(solicitud => {

                            (solicitud.comments == '') ? solicitud.comments = '-' : false;
                            solicitudes += ` <tr>
                                        <td class="text-center text-bold">${cont}</td>
                                        <td class="text-center">${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}</td>
                                        <td class="text-center">${solicitud.created_at}</td>
                                        <td class="text-center">${solicitud.start_date + " al " + solicitud.end_date}</td>
                                        <td class="text-center">${solicitud.days}</td>
                                        <td class="text-center">${solicitud.comments} </td>
                                        <td class="text-center"> `;
                            if (solicitud.status == 'En revisión') {
                                solicitudes += `  <button data-id="" value="${solicitud.id}" class="btn btn-success mt-1" id="btn-aceptar">
                                                    <i class="fas fa-check"> Aceptar</i>
                                                </button>
                                                <a data-id="${solicitud.id}" class="btn btn-danger mt-1" id="btn-denegar">
                                                    <i class="fas fa-ban"> Denegar</i>
                                                </a> <button value="${solicitud.id}"
                                            class="btn btn-warning mt-1" id="btn-borrar">
                                            <i class="fas fa-trash"> Borrar</i>
                                        </button> 
                                      
                                    `;
                            }
                            if (solicitud['status'] == 'Aceptada') {
                                solicitudes += ` <small class="badge badge-success"> Aceptada</small>`;
                            }
                            if (solicitud['status'] == 'Declinada') {
                                solicitudes += ` <small class="badge badge-danger"> Declinada</small>`;
                            }

                            solicitudes += `  <button value="${solicitud.id}"
                                        data-name='${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}'
                                        class="btn btn-info mt-1" id="btn-edit">
                                        <i class="fas fa-edit"> Editar</i>
                                    </button> </td >
                                    </tr > `;

                            cont--;
                        });


                        utils.destruir_datatable('#table3', '#table3 tbody', solicitudes);
                        utils.showToast('Fue editado exitosamente', 'success');
                        $('#modal_update_holidays').modal('hide');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
            });
    }

    fill_modal_update(id) {

        fetch('../Vacaciones/fill_modal_update', {
            method: 'POST',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + id
        })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {

                try {
                    const json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                    } else if (json_app.status === 1) {

                        document.querySelector('#modal_update_holidays #id').value = json_app.holiday.id;
                        document.querySelector('#modal_update_holidays #start_date').value = json_app.holiday.start_date;
                        document.querySelector('#modal_update_holidays #end_date').value = json_app.holiday.end_date;
                        // form.querySelector('[name="surname"]').value = json_app.candidate.surname

                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
            });
    }

}