class Candidatedirectory {
    save() {
        const form = document.querySelector("#modal_create form");
        const submitBtn = form.querySelector('[name="submit"]');
        submitBtn.disabled = true;
        const formData = new FormData(form);

        fetch('../CandidatoDirectorio/save', {
                method: 'POST',
                /* headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                }, */
                body: formData
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
                        submitBtn.disabled = false;
                    } else if (json_app.status === 1) {
                        utils.destruir_datatable('#tb_candidates', '#tb_candidates tbody', this.formatoTr(json_app));
                        $("#modal_create form [name='id_state']").val(null).trigger('change');
                        $("#modal_create form [name='id_city']").val(null).trigger('change');
                        form.reset();
                        utils.showToast('Fue registrada exitosamente', 'success');
                        submitBtn.disabled = false;
                        $('#modal_create').modal('hide');

                    } else if (json_app.status === 2) {
                        utils.showToast('No se pudo guardar el dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 3) {
                        utils.showToast('No tienes permiso para registrar', 'error');
                        submitBtn.disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                submitBtn.disabled = false;
            });
    }


    getOne() {
        var form = document.querySelector("#modal_create form");
        var formData = new FormData(form);
        fetch('../CandidatoDirectorio/getOne', {
                method: 'POST',
                /*        headers: {
                           'Content-type': 'application/x-www-form-urlencoded'
                       }, */
                body: formData
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
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Ocurrio un error', 'success');
                    } else if (json_app.status == 1) {
                        form.querySelector('[name="id"]').value = json_app.candidate.id
                        form.querySelector('[name="first_name"]').value = json_app.candidate.first_name
                        form.querySelector('[name="surname"]').value = json_app.candidate.surname
                        form.querySelector('[name="last_name"]').value = json_app.candidate.last_name
                        form.querySelector('[name="telephone"]').value = json_app.candidate.telephone
                        form.querySelector('[name="experience"]').value = json_app.candidate.experience

                        if (json_app.candidate.status == 6) {
                            form.querySelector('[name="submit"]').hidden = true
                        } else {
                            form.querySelector('[name="submit"]').hidden = false

                        }

                        $('#id_vacancy').val(json_app.candidate.id_vacancy).trigger('change.select2');

                        let State = ''
                        json_app.State.forEach(element => {
                            State += `
                            <option value='${element.id}' ${element.id == json_app.candidate.id_state?'selected' :''}  >${element.state}</option>
                            `;
                        });
                        document.querySelector("#modal_create form [name='id_state']").innerHTML = State;

                        let citys = ''
                        json_app.City.forEach(element => {
                            citys += `
                            <option value='${element.id}' ${element.id == json_app.candidate.id_city?'selected' :''} >${element.city}</option>
                            `;
                        });
                        document.querySelector("#modal_create form [name='id_city']").innerHTML = citys;



                        form.querySelector('[name="email"]').value = json_app.candidate.email
                        form.querySelector('[name="url"]').value = json_app.candidate.url

                        form.querySelector("[name='status']").value = json_app.candidate.status;

                        form.querySelector('[name="comment"]').value = json_app.candidate.comment
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }


    delete(id, id_vacancy) {
        fetch('../CandidatoDirectorio/delete', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id + '&' + 'id_vacancy=' + id_vacancy
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

                        utils.destruir_datatable('#tb_candidates', '#tb_candidates tbody', this.formatoTr(json_app));
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

    formatoTr(json_app) {
        let candidatesDirector = '';
        json_app.candidatesDirector.forEach(element => {

            if (json_app.flag == true) {
                candidatesDirector += `
                <tr>
                    <td class="text-center align-middle">${element.created_at}</td>
                    <td class="text-center align-middle">${element.name}</td>
                    <td class="text-center align-middle">${element.telephone}</td>
                    <td class="text-center align-middle">${element.vacancy}</td>
                    <td class="text-center align-middle">${element.id_state}</td>
                    <td class="text-center align-middle">${element.id_city}</td>
                    <td class="text-center align-middle">
                         <div class="btn-group">
                             <button class="btn btn-info" data-id="${element.id}">
                                 <i class="fas fa-pencil-alt"></i>
                             </button>
                              <button class="btn btn-danger ml-3" data-id="${element.id}">
                                  <i class="fas fa-trash"></i>
                              </button>
                         </div>
                    </td>
                </tr>
                `;
            } else {
                candidatesDirector += `
                <tr>
                <td class="text-center align-middle">${element.created_at_month}</td>
                <td class="text-center align-middle">${element.created_at}</td>
                <td class="text-center align-middle">${element.modified_at}</td>
                <td class="text-center align-middle">${element.name}</td>
                <td class="text-center align-middle">${element.telephone}</td>
                <td class="text-center align-middle">${element.experience}</td>
                <td class="text-center align-middle">${element.vacancy}</td>
                <td class="text-center align-middle">${element.id_state}</td>
                <td class="text-center align-middle">${element.id_city}</td>
                <td class="text-center align-middle ${element.color}"> ${element.comment}</td>
                <td class="text-center align-middle">
                     <div class="btn-group">
                         <button class="btn btn-info" data-id="${element.id}">
                             <i class="fas fa-pencil-alt"></i>
                         </button>
                         
                         <a href="${element.url_ver}" class="btn btn-success ml-2 mr-2" target="_blank" ${element.hidden_ver}>
                         <i class="fas fa-eye"></i> Ver
                        </a>`;
                if (element.vacancy == false || element.id_vacancy != false) {
                    candidatesDirector += ` <a href="${element.url_crear}" class="btn btn-orange ml-2 mr-2" target="_blank" ${element.hidden}>
                         <i class="fas fa-user-plus"></i> Agregar
                        </a> `;
                }

                candidatesDirector += `
                          <button class="btn btn-danger " data-id="${element.id}" ${element.hidden}>
                              <i class="fas fa-trash"></i>
                          </button>
                     </div>
                </td>
            </tr>
        `;
            }
        });

        return candidatesDirector;
    }

}