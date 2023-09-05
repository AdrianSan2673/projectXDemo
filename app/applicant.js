class Applicant {

    constructor() {
        this.id_applicant = null;

    }

    getApplicant(id_applicant) {
        this.id_applicant = id_applicant;
        let xhr = new XMLHttpRequest();
        let data = `id_applicant=${this.id_applicant}`;
        xhr.open('POST', '../Administracion/getApplicant');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0) {
                    let json_app = JSON.parse(this.responseText);
                    console.log(json_app);
                    document.querySelector("#update-form").reset();
                    document.querySelector("#id_applicant").value = json_app.id_applicant;
                    document.querySelector("#id_customer").value = json_app.id_customer;
                    document.querySelector("#id_business_name").value = json_app.id_business_name;
                    document.querySelector("#id_purchase_order").value = json_app.id_purchase_order;
                    document.querySelector("#vacancy").value = json_app.vacancy;
                    document.querySelector("#customer").value = json_app.customer;
                    document.querySelector("#candidate").value = json_app.candidate;
                    document.querySelector("#entry_date").value = json_app.entry_date;
                    document.querySelector("#folio").value = json_app.folio;
                    document.querySelector("#amount").value = parseFloat(json_app.amount).toFixed(2);
                    $('#modal_edit').modal('show');
                }
            }
        }
    }

    update_folio() {
        var form = document.querySelector("#update-form");
        this.id_applicant = document.querySelector("#id_applicant").value;
        var formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../administracion/update_folio');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.id = this.id_applicant;
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Omitiste algún dato', 'error');
                } else {
                    document.getElementById("folio" + xhr.id).textContent = r;
                    $('#modal_edit').modal('hide');
                }
            }
        }
    }


    getApplicantInterview(id_applicant) {
        this.id_applicant = id_applicant;
        let xhr = new XMLHttpRequest();
        let data = `id_applicant=${this.id_applicant}`;
        xhr.open('POST', '../postulaciones/getApplicantInterview');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0) {
                    let json_app = JSON.parse(this.responseText);
                    console.log(json_app);
                    document.querySelector("#update-form").reset();
                    document.querySelector("#id_applicant").value = json_app.id_applicant;
                    document.querySelector("#candidate").value = json_app.candidate;
                    document.querySelector("#interview_comments").value = json_app.interview_comments;
                    document.querySelector("#interview_date").value = json_app.interview_date;
                    $('#modal_edit').modal('show');
                }
            }
        }
    }

    update_interview() {
        var form = document.querySelector("#update-form");
        this.id_applicant = document.querySelector("#id_applicant").value;
        var formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../postulaciones/update_interview');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.id = this.id_applicant;
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Omitiste algún dato', 'error');
                } else if (r == 1) {
                    utils.showToast('Comentarios registrados exitosamente', 'success');
                    $('#modal_edit').modal('hide');
                } else if (r == 2) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
            }
        }
    }

    postulate() {
        this.id = document.querySelector("#id").value;

        let postulaciones = [];
        $('[name="postulate[]"]:checked').map(function () {
            postulaciones.push(this.value);
        });
        console.log(postulaciones);

        let data = `id_vacancy=${this.id}&postulate=${JSON.stringify(postulaciones)}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../postulaciones/postulate_multiple');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('No has seleccionado ningún candidato', 'error');
                    document.querySelector("#postulate").disabled = false;
                } else if (r == 1) {
                    // utils.showToast('Los candidatos seleccionados se enviaron al reclutador', 'success');
                    //side server
                    Swal.fire(
                        'Postulados!',
                        'Los candidatos seleccionados se enviaron al reclutador',
                        'success'
                    )
                    document.querySelector("#postulate").disabled = false;

                    let candidate = new Candidate();
                    candidate.LoadTablePostulate();

                    // setTimeout(() => {
                    //     window.location.reload();
                    // }, 2000);
                    //side server

                } else if (r == 2) {
                    utils.showToast('Algo salió mal, inténtalo de nuevo', 'error');
                    document.querySelector("#postulate").disabled = false;
                } else {
                    document.querySelector("#postulate").disabled = false;
                }
            }
        }
    }


    // ===[gabo 2 mayo  modal vacantes]===
    getVacanciesByCandidato(id_candidato, id_recruiter) {

        let xhr = new XMLHttpRequest();
        let data = `id_candidato=${id_candidato}&id_recruiter=${id_recruiter}`;
        xhr.open('POST', '../postulaciones/getVacanciesByCandidato');
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
                        let cities = '';
                        cities += `<option value=""></option>`
                        for (let i in json_app.vacantes) {
                            cities += `<option value="${json_app.vacantes[i].id}">${json_app.vacantes[i].id} - ${json_app.vacantes[i].vacancy}</option>`
                        }
                        document.getElementById("id_vacancy_v").innerHTML = cities;


                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }


                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector("#update_candidate_submit").disabled = false;
                }

            }
        }
    }

    // ===[gabo 2 mayo  modal vacantes fin]===


    //side server
    postulate_one(id_candidate, id_vacancy) {
        var formData = new FormData();
        formData.append('id_candidate', id_candidate);
        formData.append('id_vacancy', id_vacancy);

        fetch('../postulaciones/postulate_one', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                //   console.log(response.json());
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
                    if (json_app.status == 1) {


                        Swal.fire(
                            'Postulado!',
                            'Candidato postulado correctamente.',
                            'success'
                        )

                        let candidate = new Candidate();
                        candidate.LoadTablePostulate();


                    } else if (json_app.status == 0) {
                        utils.showToast('No se pudo consultar la informacion dentro', 'error');
                        document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
                    } else if (json_app.status == 2) {
                        utils.showToast('No se pudo consultar la informacion fuera', 'error');
                        document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
                    } else {
                        utils.showToast('Esa area ya esta registrada ', 'error');
                        document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
            });
    }





}