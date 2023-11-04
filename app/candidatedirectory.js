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
                            //form.querySelector('[name="submit"]').hidden = true
                        } else {
                            //form.querySelector('[name="submit"]').hidden = false

                        }

                        $('#id_vacancy').val(json_app.candidate.id_vacancy).trigger('change.select2');

                        let State = ''
                        json_app.State.forEach(element => {
                            State += `
                            <option value='${element.id}' ${element.id == json_app.candidate.id_state ? 'selected' : ''}  >${element.state}</option>
                            `;
                        });
                        document.querySelector("#modal_create form [name='id_state']").innerHTML = State;

                        let citys = ''
                        json_app.City.forEach(element => {
                            citys += `
                            <option value='${element.id}' ${element.id == json_app.candidate.id_city ? 'selected' : ''} >${element.city}</option>
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
                //  if (element.vacancy == false || element.id_vacancy != false) {
                //   candidatesDirector += ` <a href="${element.url_crear}" class="btn btn-orange ml-2 mr-2" target="_blank" ${element.hidden}>
                //      <i class="fas fa-user-plus"></i> Agregar
                //     </a> `;
                //5  }

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





    save_contact(ID) {

        var formData = new FormData();
        formData.append('id_contact', ID);
        fetch('../CandidatoDirectorio/save_contacto', {
            method: 'POST',
            /* headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            }, */
            body: formData
        })
            .then(response => {
                console.log(response.json());
                if (response.ok) {
                    //    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {

                try {
                    const json_app = JSON.parse(r);

                    if (json_app.status === 0) {
                        utils.showToast('Error', 'error');

                    } else if (json_app.status === 1) {
                        utils.destruir_datatable('#tb_candidates', '#tb_candidates tbody', this.formatoContactTr(json_app));

                        utils.showToast('Candidato registrado correctamente en el directorio', 'success');


                    } else if (json_app.status === 2) {
                        utils.showToast('No se pudo guardar el dato', 'error');


                    }

                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

                }
            })
        // .catch(error => {
        //     utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

        // });
    }



    descart_contact(ID) {

        var formData = new FormData();
        formData.append('id_contact', ID);
        fetch('../CandidatoDirectorio/descart_contact', {
            method: 'POST',
            /* headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            }, */
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

                    if (json_app.status == 0) {
                        utils.showToast('Error', 'error');

                    } else if (json_app.status == 1) {
                        utils.destruir_datatable('#tb_candidates', '#tb_candidates tbody', this.formatoContactTr(json_app));

                        utils.showToast('Candidato descartado correctamente', 'success');


                    } else if (json_app.status == 2) {
                        utils.showToast('No se pudo guardar el dato', 'error');
                    }

                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

            });
    }





    formatoContactTr(json_app) {
        let contacts = '';
        json_app.contacts.forEach(element => {
            contacts += `
                <tr>
                        <td class="text-center align-middle">${element.created_at}</td>
                    <td class="text-center align-middle">${element.first_name} ${element.surname} ${element.last_name} </td>
                    <td class="text-center align-middle">${element.telephone}</td>
                    <td class="text-center align-middle">${element.vacancy}</td>
                    <td class="text-center align-middle">
                    <div class="btn-group">  `;

            if (element.status == 1) {
                contacts += `     <button class="btn btn-success" data-id="${element.id}">
    <i class="fas fa-check"></i>
</button>
<button class="btn btn-danger " data-id="${element.id}">
    <i class="fas fa-times-circle "></i>
</button> `;

            } else {

                if (element.status == 2) {
                    contacts += `Descartado`;
                } else if (element.status == 3) {
                    contacts += `En directorio`;
                }


            }


            contacts += `    
                </div>
                    </td>
                </tr>
                `;


        });

        return contacts;
    }





    save_candidate() {

        document.querySelector('#create').disabled = true;
        document.querySelector('#postulate').disabled = true;
        document.querySelector('#directory').disabled = true;
        var id_vacancy = document.querySelector("#search").value;


        const form = document.querySelector("#candidate-form");
        const formData = new FormData(form);
        formData.append('id_vacancy_filter', id_vacancy);

        fetch('../CandidatoDirectorio/save_candidato', {
            method: 'POST',
            /* headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            }, */
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
                    console.log(json_app)

                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                        document.querySelector('#create').disabled = false;
                        document.querySelector('#postulate').disabled = false;
                        document.querySelector('#directory').disabled = false;

                    } else if (json_app.status === 1) {
                        //descomentar
                        utils.destruir_datatable('#tb_candidates', '#tb_candidates tbody', this.formatoTr(json_app));

                        form.reset();
                        utils.showToast('Fue registrado exitosamente', 'success');



                        if (json_app.tipo == 'postulate' && json_app.id_vacancy != "" && json_app.id_candidate != "") {
                            setTimeout(() => {
                                window.location.href = `../candidato/profile&id_vacancy=${json_app.id_vacancy}&id_candidate=${json_app.id_candidate}`;
                            }, 2000);

                        } else {
                            $('#modal_create').modal('hide');
                            document.querySelector('#create').disabled = false;
                            document.querySelector('#postulate').disabled = false;
                            document.querySelector('#directory').disabled = false;
                        }






                    } else if (json_app.status === 2) {
                        utils.showToast('No se pudo guardar el dato', 'error');
                        document.querySelector('#create').disabled = false;
                        document.querySelector('#postulate').disabled = false;
                        document.querySelector('#directory').disabled = false;



                    } else if (json_app.status === 3) {
                        utils.showToast('No tienes permiso para registrar', 'error');
                        document.querySelector('#create').disabled = false;
                        document.querySelector('#postulate').disabled = false;
                        document.querySelector('#directory').disabled = false;



                    }
                    else if (json_app.status === 5) {
                        utils.showToast('Verifica la fecha de nacimiento por favor', 'error');
                        document.querySelector('#create').disabled = false;
                        document.querySelector('#postulate').disabled = false;
                        document.querySelector('#directory').disabled = false;



                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector('#create').disabled = false;
                    document.querySelector('#postulate').disabled = false;
                    document.querySelector('#directory').disabled = false;



                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector('#create').disabled = false;
                document.querySelector('#postulate').disabled = false;
                document.querySelector('#directory').disabled = false;
            });
    }



    //6 oct
    fill_modal(id) {
        var form = document.querySelector("#modal_create form");
        var formData = new FormData(form);
        formData.append('id', id);
        fetch('../CandidatoDirectorio/fill_modal', {
            method: 'POST',
            /*        headers: {
                       'Content-type': 'application/x-www-form-urlencoded'
                   }, */
            body: formData
        })
            .then(response => {
                //console.log(response.json())
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {

                try {
                    let json_app = JSON.parse(r);
                    console.log(json_app);

                    if (json_app.status == 0) {
                        utils.showToast('Ocurrio un error', 'success');
                    } else if (json_app.status == 1) {




                        form.querySelector('#id_candidate_directory').value = json_app.candidatedirectory.id;
                        form.querySelector('[name="first_name"]').value = json_app.candidatedirectory.first_name;
                        form.querySelector('[name="surname"]').value = json_app.candidatedirectory.surname;
                        form.querySelector('[name="last_name"]').value = json_app.candidatedirectory.last_name;
                        form.querySelector('[name="date_birth"]').value = json_app.candidatedirectory.date_birth;
                        form.querySelector('[name="age"]').value = json_app.candidatedirectory.age;
                        // form.querySelector('[name="id_level"]').value = json_app.education.id_level;
                        form.querySelector('[name="job_title"]').value = json_app.candidatedirectory.experience;
                        form.querySelector('[name="description"]').value = json_app.candidatedirectory.description;

                        form.querySelector('[name="status"]').value = json_app.candidatedirectory.status;
                        form.querySelector('[name="telephone"]').value = json_app.candidatedirectory.telephone;
                        form.querySelector('[name="id_state"]').value = json_app.candidatedirectory.id_state;

                        $("#modal_create  [name='id_level']").val(json_app.education.id_level).trigger('change');
                        $("#modal_create  [name='id_vacancy']").val(json_app.candidatedirectory.id_vacancy).trigger('change');

                        let subareas = json_app.subareas;
                        $("#modal_create [name='id_subarea']").find('option').remove();
                        subareas.forEach((element) => {
                            if (element['id'] == json_app.candidatedirectory.id_subarea) {

                                $("#modal_create [name='id_subarea']").append($('<option selected="selected">').val(element['id']).text(element['subarea']));
                            } else {
                                $("#modal_create [name='id_subarea']").append($('<option>').val(element['id']).text(element['subarea']));
                            }
                        });


                        let cities = json_app.cities;
                        $("#modal_create  [name='id_city']").find('option').remove();
                        cities.forEach((element) => {

                            if (element['id'] == json_app.candidatedirectory.id_city) {

                                $("#modal_create [name='id_city']").append($('<option selected="selected">').val(element['id']).text(element['city']));
                            } else {
                                $("#modal_create [name='id_city']").append($('<option>').val(element['id']).text(element['city']));
                            }
                        });

                        form.querySelector('[name="comment"]').value = json_app.candidatedirectory.comment;
                        // if (json_app.candidatedirectory.id_candidate != "") {
                        //     form.querySelector('#[name="id_candidate_directory"]').value = json_app.candidatedirectory.id_candidate;
                        // }


                        if (json_app.candidatedirectory.id_area != null && json_app.candidatedirectory.id_subarea != null) {
                            form.querySelector('[name="id_area"]').value = json_app.candidatedirectory.id_area;
                            form.querySelector('[name="id_subarea"]').value = json_app.candidatedirectory.id_subarea;
                        } else {
                            if (json_app.vacancy != false) {
                                lo
                                form.querySelector('[name="id_area"]').value = json_app.vacancy.id_area;
                                form.querySelector('[name="id_subarea"]').value = json_app.vacancy.id_subarea;
                            }
                        }


                        if (json_app.vacancy != false && (json_app.vacancy.type == 1 || json_app.vacancy.type == 4)) {
                            document.querySelector('#div-sexo').hidden = true;
                            document.querySelector('#div-civil-status').hidden = true;
                            document.querySelector('#div-email').hidden = true;
                            document.querySelector('#div-celular').hidden = true;
                            document.querySelector('#div-curriculum').hidden = true;
                            document.querySelector('#div-url').hidden = true;
                            document.querySelector('#div-experience').hidden = false;
                            document.querySelector('#div-curriculum').hidden = true;
                            form.querySelector('#documento_cargado').hidden = true;
                            $('#id_gender').removeAttr("required");
                            $('#id_civil_status').removeAttr("required");
                            $('#email').removeAttr("required");
                            $('#celular').removeAttr("required");

                            var row = "";
                            let primero = 1;

                            if (json_app.experience.length > 0) {
                                json_app.experience.forEach((element) => {

                                    row += `
                                <div class="row borrados" style="margin-bottom:0.6rem; border:1px solid #98AE98 ; border-radius:15px;padding:1rem">
                                <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
                                  <label for="" class="col-form-label" style="margin-top:30px">Información:</label>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group" style="text-align: center">
                                <label class="col-form-label">Empresa/Puesto</label>        
                                  <input required type="text" name="enterprise_experience[]"  style="text-align:center" value="` + element.enterprise + `" class=" form-control"   >
                                </div>
                              </div>
    
                              <div class="col-md-5">
                                <div class="form-group" style="text-align: center">
                                <label class="col-form-label">Descripcion</label>
                                 <textarea  name="review_experience[]"  id="review_experience" rows="4"  class=" form-control"  >` + element.review + `</textarea>
                                </div>
                              </div>`;
                                    if (primero != 1) {
                                        row += `
                              <div class="col-md-1">
                                <div class="form-group" style="text-align: center;padding-top:1.3rem">
                                <btn class="btn btn-danger" onclick="delete_row(this)">
                                <i class="fas fa-trash"></i> 
                              </btn>
                                </div>
                                </div>
                                  `;
                                    }
                                    row += `</div> `;
                                    primero = 0;
                                });


                                document.querySelector('#div_experience').innerHTML = row;
                            }


                        } else {

                            document.querySelector('#div-sexo').hidden = false;
                            document.querySelector('#div-civil-status').hidden = false;
                            document.querySelector('#div-email').hidden = false;
                            document.querySelector('#div-celular').hidden = false;
                            document.querySelector('#div-curriculum').hidden = false;
                            document.querySelector('#div-url').hidden = false; false
                            document.querySelector('#div-experience').hidden = true
                            document.querySelector('#div-curriculum').hidden = false

                            $('#id_gender').prop("required", true);
                            $('#id_civil_status').prop("required", true);
                            $('#email').prop("required", true);
                            $('#celular').prop("required", true);

                            form.querySelector('[name="id_gender"]').value = json_app.candidatedirectory.id_gender;
                            $("#modal_create  [name='id_civil_status']").val(json_app.candidatedirectory.id_civil_status).trigger('change');
                            form.querySelector('[name="cellphone"]').value = json_app.candidatedirectory.cellphone;
                            form.querySelector('[name="email"]').value = json_app.candidatedirectory.email;
                            form.querySelector('[name="url"]').value = json_app.candidatedirectory.url;

                            if (json_app.curriculum != '') {
                                form.querySelector('#documento_cargado').hidden = false;
                                form.querySelector('#curriculum').href = json_app.curriculum;
                            } else {
                                form.querySelector('#documento_cargado').hidden = true;
                            }



                        }

                        // json_app.postulado == false ? form.querySelector('#postulate').hidden = false : form.querySelector('#postulate').hidden = true;
                        // json_app.candidate == false ? form.querySelector('#create').hidden = false : form.querySelector('#create').hidden = true;

                        if (json_app.postulado != false || json_app.candidate != false) {
                            form.querySelector('[name="directory"]').hidden = true;
                            form.querySelector('[name="ver"]').href = '../candidato/ver&id=' + json_app.candidate.id;

                            form.querySelector('#postulate').hidden = true;
                            form.querySelector('#create').hidden = true;

                            form.querySelector('[name="ver"]').hidden = false;


                            if (json_app.experience.length > 0) {
                                document.querySelector('#div-experience').hidden = false;
                            } else {
                                document.querySelector('#div-experience').hidden = true;
                            }

                        } else {
                            form.querySelector('[name="directory"]').hidden = false;
                            form.querySelector('[name="ver"]').hidden = true;

                            form.querySelector('#postulate').hidden = false;
                            form.querySelector('#create').hidden = false;
                        }


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





}