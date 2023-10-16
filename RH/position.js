class Position {

    save_position() {
        var form = document.querySelector("#position-form");
        var formData = new FormData(form);
        document.querySelector('#registrar_puesto').disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Puesto/save');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        document.querySelector('#registrar_puesto').disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        document.querySelector('#registrar_puesto').disabled = true;
                        utils.showToast('Puesto registrado exitosamente', 'success');
                        setTimeout("location.href='./ver&id=" + json_app.id + "'", 3000);
                        form.reset();
                    } else if (json_app.status == 2) {
                        document.querySelector('#registrar_puesto').disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        document.querySelector('#registrar_puesto').disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    document.querySelector('#registrar_puesto').disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }

    update_objective() {
        var form = document.querySelector("#modal_objective form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Puesto/updateObject');
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
                        let objective = '';
                        objective += `<p> ${json_app.objectives} </p>`
                        document.querySelector('#content-objective').innerHTML = objective;
                        $('#modal_objective').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
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

    updateAuthority() {
        var form = document.querySelector("#modal_authority form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Puesto/updateAuthority');
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
                        let authority = '';
                        authority += `<p> ${json_app.authoritys} </p>`
                        document.querySelector('#content-authority').innerHTML = authority;
                        $('#modal_authority').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }



    updateProfile() {
        var form = document.querySelector("#modal_profile form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Puesto/updateProfile');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[1].disabled = false;

                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');
                        let profile = '';
                        profile += `
                        <div class="row">
                        <div class="col-3 text-bold">
                            Escolaridad:
                        </div>
                        <div class="col-3">
                        ${json_app.scholarship}
                        </div>
                        <div class="col-3 text-bold">
                            Experencia:
                        </div>
                        <div class="col-3">
                        ${json_app.experience}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 text-bold">
                            Estudio adicionales:
                        </div>
                        <div class="col-3">
                        ${json_app.additional_studies}
                        </div>
                        <div class="col-3 text-bold">
                            Años de experiencia:
                        </div>
                        <div class="col-3">
                        ${json_app.experience_years}
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-3 text-bold">
                            Idioma:
                        </div>
                        <div class="col-9">
                        ${json_app.language}
                        </div>
                    </div> `
                        document.querySelector('#content-profile').innerHTML = profile;
                        $('#modal_profile').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }

    save_responsability() {
        var form = document.querySelector("#modal_responsability form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ResponsabilidadesEspecificas/save');
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
                        $('#modal_responsability').modal('hide');
                    } else if (json_app.status == 1) {
                        utils.showToast('Responsabilidad guardada.', 'success');
                        let responsabilidades = '';
                        json_app.responsabilidades.forEach(element => {
                            responsabilidades += `
                            <div class="row mt-2">
                                  <div class="col-5">
                                      <dt class="">${element.responsability}</dt>
                                  </div>
                                  <div class="col-6">
                                      <dd class="">${element.activities}</dd>
                                  </div>
                                  <div class="col-1">
                                     <div class="row">
                                         <div class="col-6">
                                             <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                                         </div>
                                         <div class="col-6">
                                             <button class="btn btn-danger text-bold h4" value="${element.id}" name="${json_app.id_position}">X</button>
                                         </div>
                                     </div>
                                  </div>
                            </div>
                            `
                        });
                        form.reset();
                        document.querySelector('#respEspecficas').innerHTML = responsabilidades;
                        $('#modal_responsability').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;

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

    getResponsability(ID) {
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}`;
        let form = document.querySelector('#modal_responsability form');
        document.querySelectorAll('#modal_responsability form .btn')[1].disabled = false;
        xhr.open('POST', '../ResponsabilidadesEspecificas/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.responsability
                        form.querySelectorAll('textarea')[0].value = json_app.activities
                        form.querySelectorAll('input')[1].value = json_app.id
                        form.querySelectorAll('input')[2].value = 2
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }
        }
    }

    deleteResponsability(ID, id_position) {
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}&id_position=${id_position}`;
        //let form = document.querySelector('#modal_responsability form');
        //document.querySelectorAll('#modal_responsability form .btn')[1].disabled = false;
        xhr.open('POST', '../ResponsabilidadesEspecificas/delete');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        let json_app = JSON.parse(r);
                        utils.showToast('Eliminado exitosamente.', 'success');

                        let responsabilidades = '';
                        json_app.responsabilidades.forEach(element => {
                            responsabilidades += `
                            <div class="row mt-2">
                                  <div class="col-5">
                                      <dt class="col-sm-4">${element.responsability}</dt>
                                  </div>
                                  <div class="col-6">
                                      <dd class="col-sm-8">${element.activities}</dd>
                                  </div>
                                  <div class="col-1">
                                     <div class="row">
                                         <div class="col-6">
                                             <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                                         </div>
                                         <div class="col-6">
                                             <button class="btn btn-danger text-bold h4" value="${element.id}" name="${id_position}">X</button>
                                         </div>
                                     </div>
                                  </div>
                            </div>
                            `
                        });

                        document.querySelector('#respEspecficas').innerHTML = responsabilidades;

                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }


    save_indicator() {
        var form = document.querySelector("#modal_indicators form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Indicadores/save');
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
                        utils.showToast('Indicador guardado.', 'success');
                        let indications = '';
                        json_app.indications.forEach(element => {
                            indications += `
                            <div class="row mt-2">
                            <div class="col-11">
                                <dt class="">- ${element.indicator}</dt>
                            </div>
                            <div class="col-1">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger text-bold h4" value="${element.id}" name="${element.id_position}">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `
                        });
                        form.reset();
                        document.querySelector('#indicadorEfectivo').innerHTML = indications;
                        $('#modal_indicators').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;

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


    getIndicators(ID) {
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}`;
        let form = document.querySelector('#modal_indicators form');
        document.querySelectorAll('#modal_indicators form .btn')[1].disabled = false;
        xhr.open('POST', '../Indicadores/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('textarea')[0].value = json_app.indicator
                        form.querySelectorAll('input')[1].value = 2
                        form.querySelectorAll('input')[2].value = json_app.id
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo  ' + error, 'error');
                }
            }
        }
    }


    deleteIndication(ID, id_position) {
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}&id_position=${id_position}`;
        xhr.open('POST', '../Indicadores/delete');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        //form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                        $('#modal_indicators').modal('hide');
                    } else if (json_app.status == 1) {
                        utils.showToast('Eliminado exitosamente.', 'success');
                        let indications = '';
                        json_app.indications.forEach(element => {
                            indications += `
                            <div class="row mt-2">
                            <div class="col-11">
                                <dt class="">- ${element.indicator}</dt>
                            </div>
                            <div class="col-1">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger text-bold h4" value="${element.id}" name="${json_app.id_position}">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `
                        });
                        //form.reset();
                        document.querySelector('#indicadorEfectivo').innerHTML = indications;
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


    save_knowledge() {
        var form = document.querySelector("#modal_knowledge form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ConocimientosRequeridos/save');
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
                        $('#modal_knowledge').modal('hide');
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardada exitosamente.', 'success');
                        let conocimientos = '';
                        json_app.conocimientos.forEach(element => {
                            conocimientos += `
                            <div class="row">
                            <div class="col-9"> ${element.knowledge} </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger text-bold h4" value="${element.id}" name="${element.id_position}">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `
                        });
                        form.reset();
                        document.querySelector('#content_conocimiento').innerHTML = conocimientos;
                        $('#modal_knowledge').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;

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

    getConocimientos(ID) {
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}`;
        let form = document.querySelector('#modal_knowledge form');
        document.querySelectorAll('#modal_knowledge form .btn')[1].disabled = false;
        xhr.open('POST', '../ConocimientosRequeridos/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        console.log(form.querySelectorAll('textarea')[0]);
                        form.querySelectorAll('textarea')[0].value = json_app.knowledge
                        form.querySelectorAll('input')[1].value = 2
                        form.querySelectorAll('input')[2].value = json_app.id
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo  ' + error, 'error');
                }
            }
        }
    }


    deleteConocimientos(ID, id_position) {
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}&id_position=${id_position}`;
        xhr.open('POST', '../ConocimientosRequeridos/delete');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 1) {
                        utils.showToast('Eliminado exitosamente.', 'success');
                        let conocimientos = '';
                        console.log(conocimientos);

                        json_app.conocimientos.forEach(element => {
                            conocimientos += `
                            <div class="row">
                            <div class="col-9">
                                ${element.knowledge}
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger text-bold h4" value="${element.id}" name="${id_position}">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `
                        });


                        document.querySelector('#content_conocimiento').innerHTML = conocimientos;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    console.log(error);
                }
            }
        }
    }

    save_skills() {
        var form = document.querySelector("#modal_skills form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Habilidades/save');
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
                        $('#modal_skills').modal('hide');
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente.', 'success');
                        let habilidades = '';
                        json_app.habilidades.forEach(element => {
                            habilidades += `
                            <div class="row">
                            <div class="col-9">
                                ${element.skill}
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger text-bold h4" value="${element.id}" name="${element.id_position}">X</button>
                                    </div>
                                </div>
                            </div>
                        </div> `
                        });

                        form.reset();
                        document.querySelector('#content_habilidades').innerHTML = habilidades;
                        $('#modal_skills').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;

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


    getHabilidades(ID) {
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}`;
        let form = document.querySelector('#modal_skills form');
        document.querySelectorAll('#modal_skills form .btn')[1].disabled = false;
        xhr.open('POST', '../Habilidades/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('textarea')[0].value = json_app.skill
                        form.querySelectorAll('input')[1].value = 2
                        form.querySelectorAll('input')[2].value = json_app.id
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo  ' + error, 'error');
                }
            }
        }
    }



    deleteHabilidades(ID, id_position) {
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}&id_position=${id_position}`;

        xhr.open('POST', '../Habilidades/delete');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 1) {
                        let json_app = JSON.parse(r);
                        utils.showToast('Eliminado exitosamente.', 'success');
                        let habilidades = '';
                        json_app.habilidades.forEach(element => {
                            habilidades += `
                            <div class="row">
                            <div class="col-9">
                                ${element.skill}
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger text-bold h4" value="${element.id}" name="${id_position}">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `
                        });
                        document.querySelector('#content_habilidades').innerHTML = habilidades;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    console.log(error);
                }
            }
        }
    }

    getContactos(Cliente, Empresa) {
        let xhr = new XMLHttpRequest();
        let data = `Cliente=${Cliente}&Empresa=${Empresa}`;
        let form = document.querySelector('#modal_plan');
        document.querySelectorAll('#modal_plan form .btn')[1].disabled = false;
        xhr.open('POST', '../ClienteContacto_SA/getContactosByCliente');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        let contactos = '';
                        json_app.contactosEmpresa.forEach(element => {
                            contactos += `
                            <option value='${element.ID}'>${element.Nombre_Contacto} ${element.Apellido_Contacto}</option>
                            `;
                        });
                        form.querySelectorAll('select')[0].innerHTML = contactos;
                        form.querySelectorAll('select option').forEach(element => {
                            json_app.contactosCliente.forEach(contact => {
                                if (element.value == contact.ID_Contacto) {
                                    element.setAttribute('selected', 'selected');
                                }
                            });
                        })
                    } else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }
        }
    }

    update_DatosGenerales() {

    }


    save_deparment() {
        var form = document.querySelector("#modal_department form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Departamento/save');
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
                        $('#modal_department').modal('hide');
                    } else if (json_app.status == 1) {
                        utils.showToast('Departamento guardado.', 'success');
                        let departamentos = '';
                        json_app.departamentos.forEach(element => {
                            departamentos += `
                            <option value='${element.id}'>${element.department}</option>
                            `
                        });
                        document.querySelector('#id_department').innerHTML = departamentos;
                        $('#modal_department').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                        form.reset();

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


    update_datosGeneral() {

        var form = document.querySelector("#modal_general form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Puesto/updateDatosGenerales');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');
                        let title_position = document.querySelectorAll('.title-puesto')

                        for (let i = 0; i < title_position.length; i++) {
                            document.querySelectorAll('.title-puesto')[i].innerHTML = json_app.title
                        }
                        document.querySelector('#type_position').innerHTML = json_app.type_position
                        document.querySelector('.deparamento-title').innerHTML = json_app.department
                        document.querySelector('#boss_position-title').innerHTML = json_app.boss_position
                        document.querySelector('#Nombre_Cliente').innerHTML = json_app.Nombre_Cliente

                        $('#modal_general').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }


    updateSupervising() {
        var form = document.querySelector("#form-supervising");
        var formData = new FormData(form);
        //form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Puesto/updateSupervising');
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
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    // form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }



    updatePlanCarrera() {
        var form = document.querySelector("#form_plan_carrera");
        var formData = new FormData(form);
        //form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Puesto/updatePlanCarrera');
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
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    // form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }



    updateSatusPosition(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Puesto/updateSatusPosition');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status == 0) {
                        utils.showToast('Ocurrio un error', 'error');
                    } else if (json_app.status == 1) {
                        let icon = json_app.estado == 1 ? 'fa-trash-alt' : 'fa-power-off'
                        let color = json_app.estado == 1 ? 'btn-danger' : 'btn-success'
                        document.querySelector('#divEliminarPuesto').innerHTML =
                            `
                        <button class="btn ${color}" value="${json_app.id_position}" data-estatus="${json_app.estado}"> ${json_app.estado==0?'Reactivar':' Eliminar'} puesto</button>
                        `
                        utils.showToast('Estado del puesto actualizado.', 'success');
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }

}