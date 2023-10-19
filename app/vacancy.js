class Vacancy {
    contructor() {
        this.id = null;
        this.customer = '';
        this.customer_contact = null;
        this.vacancy = '';
        this.department = '';
        this.report_to = '';
        this.personal_in_charge = null;
        this.education_level = null;
        this.position_number = null;
        this.experience_years = null;
        this.experience = '';
        this.age_min = null;
        this.age_max = null;
        this.gender = null;
        this.civil_status = null;
        this.language = null;
        this.language_level = null;
        this.salary_min = null;
        this.salary_max = null;
        this.benefits = '';
        this.workdays = '';
        this.schedule = '';
        this.state = null;
        this.city = null;
        this.requirements = '';
        this.functions = '';
        this.skills = '';
        this.technical_knowledge = '';
        this.area = null;
        this.subarea = null;

        this.how_many_interviews = 0;
        this.accept_reentry = null;
        this.offer_transportation = null;
        this.do_medical_exam = null;
    }

    create() {
        this.customer = document.querySelector('#vacancy-form #customer').value;
        this.customer_contact = document.querySelector('#vacancy-form #customer_contact').value;
        this.business_name = document.querySelector('#vacancy-form #business_name').value;
        //this.recruiter = document.querySelector('#vacancy-form #recruiter').value;
        this.vacancy = document.querySelector('#vacancy-form #vacancy').value;
        this.department = document.querySelector('#vacancy-form #department').value;
        this.report_to = document.querySelector('#vacancy-form #report_to').value;
        this.personal_in_charge = document.querySelector('#vacancy-form #personal_in_charge').value;
        this.education_level = document.querySelector('#vacancy-form #education_level').value;
        this.position_number = document.querySelector('#vacancy-form #position_number').value;
        this.experience_years = document.querySelector('#vacancy-form #experience_years').value;
        this.age_min = document.querySelector('#vacancy-form #age_min').value;
        this.age_max = document.querySelector('#vacancy-form #age_max').value;
        this.gender = document.querySelector('#vacancy-form #gender').value;
        this.civil_status = document.querySelector('#vacancy-form #civil_status').value;
        this.language = document.querySelector('#vacancy-form #language').value;
        this.language_level = document.querySelector('#vacancy-form #language_level').value;
        this.salary_min = document.querySelector('#vacancy-form #salary_min').value;
        this.salary_max = document.querySelector('#vacancy-form #salary_max').value;
        this.benefits = document.querySelector('#vacancy-form #benefits').value;
        this.workdays = document.querySelector('#vacancy-form #workdays').value;
        this.schedule = document.querySelector('#vacancy-form #schedule').value;
        this.state = document.querySelector('#vacancy-form #state').value;
        this.city = document.querySelector('#vacancy-form #city').value;
        this.requirements = document.querySelector("#vacancy-form #requirements").value;
        this.functions = document.querySelector('#vacancy-form #functions').value;
        this.technical_knowledge = document.querySelector('#vacancy-form #technical_knowledge').value;
        this.area = document.querySelector("#vacancy-form #area").value,
            this.subarea = document.querySelector("#vacancy-form #subarea").value;

        this.how_many_interviews = document.querySelector('#vacancy-form #how_many_interviews').value;

        //if (this.customer.length > 0 && this.vacancy.length > 0 && this.department.length > 0 && this.report_to.length > 0 && this.personal_in_charge.length > 0 && this.education_level.length > 0 && this.position_number.length > 0 && this.experience_years.length > 0 && this.age_min.length > 0 && this.age_max.length > 0 && this.gender.length > 0 && this.civil_status.length > 0 && this.salary_min.length > 0 && this.salary_max.length > 0 && this.benefits.length > 0 && this.workdays.length > 0 && this.schedule.length > 0 && this.state.length > 0 && this.city.length > 0 && this.requirements.length > 0 && this.functions.length > 0 && this.technical_knowledge.length > 0 && this.area.length > 0 && this.subarea.length > 0 && this.how_many_interviews.length > 0) {
        var form = document.querySelector("#vacancy-form");
        var formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', './create');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Omitiste algún dato', 'error');
                    document.querySelector("#vacancy-form #registerSubmit").disabled = false;
                } else if (r == 1) {
                    utils.showToast('Vacante creada exitosamente', 'success');
                    document.querySelector("#vacancy-form #registerSubmit").disabled = true;
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                } else if (r == 2) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#vacancy-form #registerSubmit").disabled = false;
                } else {
                    document.querySelector("#vacancy-form #registerSubmit").disabled = false;
                }
            } else {
                document.querySelector("#vacancy-form #registerSubmit").disabled = false;
            }
        }
        //}else{
        //utils.showToast('Completa todos los campos', 'warning');
        //document.querySelector("#registerSubmit").disabled = false;
        //}
    }

    save() {
        this.customer = document.querySelector('#register-vacancy-form #customer').value;
        this.customer_contact = document.querySelector('#register-vacancy-form #customer_contact').value;
        this.business_name = document.querySelector('#register-vacancy-form #business_name').value;
        this.recruiter = document.querySelector('#register-vacancy-form #recruiter').value;
        this.vacancy = document.querySelector('#register-vacancy-form #vacancy').value;
        this.department = document.querySelector('#register-vacancy-form #department').value;
        this.report_to = document.querySelector('#register-vacancy-form #report_to').value;
        this.personal_in_charge = document.querySelector('#register-vacancy-form #personal_in_charge').value;
        this.education_level = document.querySelector('#register-vacancy-form #education_level').value;
        this.position_number = document.querySelector('#register-vacancy-form #position_number').value;
        this.experience_years = document.querySelector('#register-vacancy-form #experience_years').value;
        this.experience = document.querySelector('#register-vacancy-form #experience').value;
        this.age_min = document.querySelector('#register-vacancy-form #age_min').value;
        this.age_max = document.querySelector('#register-vacancy-form #age_max').value;
        this.gender = document.querySelector('#register-vacancy-form #gender').value;
        this.civil_status = document.querySelector('#register-vacancy-form #civil_status').value;
        this.language = document.querySelector('#register-vacancy-form #language').value;
        this.language_level = document.querySelector('#register-vacancy-form #language_level').value;
        this.salary_min = document.querySelector('#register-vacancy-form #salary_min').value;
        this.salary_max = document.querySelector('#register-vacancy-form #salary_max').value;
        this.benefits = document.querySelector('#register-vacancy-form #benefits').value;
        this.workdays = document.querySelector('#register-vacancy-form #workdays').value;
        this.schedule = document.querySelector('#register-vacancy-form #schedule').value;
        this.state = document.querySelector('#register-vacancy-form #state').value;
        this.city = document.querySelector('#register-vacancy-form #city').value;
        this.requirements = document.querySelector("#register-vacancy-form #requirements").value;
        this.functions = document.querySelector('#register-vacancy-form #functions').value;
        this.skills = document.querySelector('#register-vacancy-form #skills').value;
        this.technical_knowledge = document.querySelector('#register-vacancy-form #technical_knowledge').value;
        this.area = document.querySelector("#register-vacancy-form #area").value,
            this.subarea = document.querySelector("#register-vacancy-form #subarea").value;

        this.how_many_interviews = document.querySelector('#register-vacancy-form #how_many_interviews').value;
        this.accept_reentry = document.querySelector('#register-vacancy-form #accept_reentry').value;
        this.offer_transportation = document.querySelector('#register-vacancy-form #offer_transportation').value;
        this.do_medical_exam = document.querySelector('#register-vacancy-form #do_medical_exam').value;

        if (this.customer.length > 0 && this.vacancy.length > 0 && this.department.length > 0 && this.report_to.length > 0 && this.personal_in_charge.length > 0 && this.education_level.length > 0 && this.position_number.length > 0 && this.experience_years.length > 0 && this.experience.length > 0 && this.age_min.length > 0 && this.age_max.length > 0 && this.gender.length > 0 && this.civil_status.length > 0 && this.language.length > 0 && this.language_level.length > 0 && this.salary_min.length > 0 && this.salary_max.length > 0 && this.benefits.length > 0 && this.workdays.length > 0 && this.schedule.length > 0 && this.state.length > 0 && this.city.length > 0 && this.requirements.length > 0 && this.functions.length > 0 && this.skills.length > 0 && this.technical_knowledge.length > 0 && this.area.length > 0 && this.subarea.length > 0 && this.how_many_interviews.length > 0 && this.accept_reentry.length > 0 && this.offer_transportation.length > 0 && this.do_medical_exam.length > 0) {
            if (this.age_min >= 18 || this.age_max >= 18) {
                let data = `customer=${this.customer}&customer_contact=${this.customer_contact}&business_name=${this.business_name}&recruiter=${this.recruiter}&vacancy=${this.vacancy}&department=${this.department}&report_to=${this.report_to}&personal_in_charge=${this.personal_in_charge}&education_level=${this.education_level}&position_number=${this.position_number}&experience_years=${this.experience_years}&experience=${this.experience}&age_min=${this.age_min}&age_max=${this.age_max}&gender=${this.gender}&civil_status=${this.civil_status}&language=${this.language}&language_level=${this.language_level}&salary_min=${this.salary_min}&salary_max=${this.salary_max}&benefits=${this.benefits}&workdays=${this.workdays}&schedule=${this.schedule}&state=${this.state}&city=${this.city}&requirements=${this.requirements}&functions=${this.functions}&skills=${this.skills}&technical_knowledge=${this.technical_knowledge}&area=${this.area}&subarea=${this.subarea}&how_many_interviews=${this.how_many_interviews}&accept_reentry=${this.accept_reentry}&offer_transportation=${this.offer_transportation}&do_medical_exam=${this.do_medical_exam}`;
                let xhr = new XMLHttpRequest();
                xhr.open('POST', './create');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        if (r == 0) {
                            utils.showToast('Omitiste algún dato', 'error');
                            document.querySelector("#registerSubmit").disabled = false;
                        } else if (r == 1) {
                            utils.showToast('La vacante fue registrada exitosamente', 'success');

                            setTimeout(() => {
                                window.location.reload();
                            }, 3000);

                        } else if (r == 2) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                            document.querySelector("#registerSubmit").disabled = false;
                        }
                    }
                }
            } else {
                utils.showToast("La edad mínima es 18", "warning");
                document.querySelector("#registerSubmit").disabled = false;
            }
        } else {
            utils.showToast('Completa todos los campos', 'warning');
            document.querySelector("#registerSubmit").disabled = false;
        }
    }

    update() {
        let btn = document.querySelector("#vacancy-form #editSubmit");
        btn.disabled = true;
        this.id = document.querySelector("#vacancy-form #id").value;
        this.customer = document.querySelector('#vacancy-form #customer').value;
        this.customer_contact = document.querySelector('#vacancy-form #customer_contact').value;
        this.business_name = document.querySelector('#vacancy-form #business_name').value;
        this.recruiter = document.querySelector('#vacancy-form #recruiter').value;
        this.vacancy = document.querySelector('#vacancy-form #vacancy').value;
        this.department = document.querySelector('#vacancy-form #department').value;
        this.report_to = document.querySelector('#vacancy-form #report_to').value;
        this.personal_in_charge = document.querySelector('#vacancy-form #personal_in_charge').value;
        this.education_level = document.querySelector('#vacancy-form #education_level').value;
        this.position_number = document.querySelector('#vacancy-form #position_number').value;
        this.experience_years = document.querySelector('#vacancy-form #experience_years').value;
        this.age_min = document.querySelector('#vacancy-form #age_min').value;
        this.age_max = document.querySelector('#vacancy-form #age_max').value;
        this.gender = document.querySelector('#vacancy-form #gender').value;
        this.civil_status = document.querySelector('#vacancy-form #civil_status').value;
        this.language = document.querySelector('#vacancy-form #language').value;
        this.language_level = document.querySelector('#vacancy-form #language_level').value;
        this.salary_min = document.querySelector('#vacancy-form #salary_min').value;
        this.salary_max = document.querySelector('#vacancy-form #salary_max').value;
        this.benefits = document.querySelector('#vacancy-form #benefits').value;
        this.workdays = document.querySelector('#vacancy-form #workdays').value;
        this.schedule = document.querySelector('#vacancy-form #schedule').value;
        this.state = document.querySelector('#vacancy-form #state').value;
        this.city = document.querySelector('#vacancy-form #city').value;
        this.requirements = document.querySelector("#vacancy-form #requirements").value;
        this.functions = document.querySelector('#vacancy-form #functions').value;
        this.technical_knowledge = document.querySelector('#vacancy-form #technical_knowledge').value;
        this.area = document.querySelector("#vacancy-form #area").value,
            this.subarea = document.querySelector("#vacancy-form #subarea").value;

        this.how_many_interviews = document.querySelector('#vacancy-form #how_many_interviews').value;


        //if (this.customer.length > 0 && this.vacancy.length > 0 && this.department.length > 0 && this.report_to.length > 0 && this.personal_in_charge.length > 0 && this.education_level.length > 0 && this.position_number.length > 0 && this.experience_years.length > 0 && this.age_min.length > 0 && this.age_max.length > 0 && this.gender.length > 0 && this.civil_status.length > 0 && this.salary_min.length > 0 && this.salary_max.length > 0 && this.benefits.length > 0 && this.workdays.length > 0 && this.schedule.length > 0 && this.state.length > 0 && this.city.length > 0 && this.requirements.length > 0 && this.functions.length > 0 && this.technical_knowledge.length > 0 && this.area.length > 0 && this.subarea.length > 0 && this.how_many_interviews.length > 0) {
        if (this.age_min >= 18 || this.age_max >= 18) {
            var form = document.querySelector("#vacancy-form");
            var formData = new FormData(form);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', './update');
            //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(formData);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = xhr.responseText;
                    console.log(r);
                    if (r == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                        btn.disabled = false;
                    } else if (r == 1) {
                        utils.showToast('La vacante fue editada exitosamente', 'success');
                        //setTimeout("location.href='./index'", 3000);
                    } else if (r == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        btn.disabled = false;
                    }
                }
            }
        } else {
            utils.showToast("La edad mínima es 18", "warning");
            btn.disabled = false;
        }
        //}else {
        //utils.showToast('Completa todos los campos', 'warning');
        //btn.disabled = false;
        //}
        btn.disabled = false;
    }

    changeStatus1() {
        this.id = document.querySelector("#id").value;
        let status = 2;

        let data = `id=${this.id}&status=${status}`;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './changeStatus');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else if (r == 1) {
                    utils.showToast('El envío de candidatos de la vacante ha sido completado', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }

    changeStatus2() {
        this.id = document.querySelector("#id").value;
        let status = 3;

        let data = `id=${this.id}&status=${status}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './changeStatus');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else if (r == 1) {
                    utils.showToast('La vacante ahora está en fase de entrevistas', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }

    changeStatus3() {
        this.id = document.querySelector("#id").value;
        let status = 4;

        let data = `id=${this.id}&status=${status}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './changeStatus');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else if (r == 1) {
                    utils.showToast('La vacante ahora está en fase de seguimiento', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }

    changeStatus4() {
        this.id = document.querySelector("#id").value;
        let status = 5;

        let data = `id=${this.id}&status=${status}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './changeStatus');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else if (r == 1) {
                    utils.showToast('La vacante ahora está cerrada', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }

    changeStatus5() {
        this.id = document.querySelector("#id").value;
        let status = 6;

        let data = `id=${this.id}&status=${status}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './changeStatus');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else if (r == 1) {
                    utils.showToast('La vacante ha sido cancelada con cobro', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }

    changeStatus6() {
        this.id = document.querySelector("#id").value;
        let status = 7;

        let data = `id=${this.id}&status=${status}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './changeStatus');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else if (r == 1) {
                    utils.showToast('La vacante fue cancelada sin cobro', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }

    changeStatus7() {
        this.id = document.querySelector("#id").value;
        let status = 8;

        let data = `id=${this.id}&status=${status}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './changeStatus');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else if (r == 1) {
                    utils.showToast('La vacante ahora está en stand by', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }


    changeStatus9() {
        this.id = document.querySelector("#id").value;
        let status = 9;

        let data = `id=${this.id}&status=${status}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './changeStatus');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else if (r == 1) {
                    utils.showToast('La vacante ahora está en estado de no ingresado', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }


    restartDate() {
        this.id = document.querySelector("#id").value;

        let data = `id=${this.id}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './restart_date');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else if (r == 1) {
                    utils.showToast('Se ha reactivado la búsqueda', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }

    duplicate() {
        this.id = document.querySelector("#id").value;

        let data = `id=${this.id}`
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './duplicate');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else if (r == 1) {
                    utils.showToast('Se ha duplicado la vacante', 'success');
                    setTimeout(() => {
                        window.location.href = `../vacante/index`;
                    }, 2000);
                } else {
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        }
    }

    description() {
        var form = document.querySelector("#description-form");
        var formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './description');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 1) {
                    utils.showToast('Se guardó la descripción del candidato exitosamente', 'success');
                    setTimeout("history.back()", 3000);
                } else if (r == 2) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#submit").disabled = false;
                }
            } else {
                document.querySelector("#submit").disabled = false;
            }
        }

    }

    getVacancy(id_vacancy) {
        this.id_vacancy = id_vacancy;
        let xhr = new XMLHttpRequest();
        let data = `id_vacancy=${this.id_vacancy}`;
        xhr.open('POST', '../vacante/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;

                if (r != 0) {
                    let json_app = JSON.parse(this.responseText);

                    document.querySelector("#update-form").reset();
                    document.querySelector("#id_vacancy").value = json_app.id_vacancy;
                    document.querySelector("#vacancy").value = json_app.vacancy;
                    document.querySelector("#customer").value = json_app.customer;

                    document.querySelectorAll('#update-form select')[0].value = json_app.time;

                    let request_date = new Date(json_app.request_date);
                    document.querySelector("#request_day").value = request_date.getDate();
                    document.querySelector("#request_month").value = request_date.getMonth() + 1;
                    document.querySelector("#request_year").value = request_date.getFullYear();
                    document.querySelector("#request_hour").value = request_date.getHours();
                    document.querySelector("#request_minute").value = request_date.getMinutes();

                    if (json_app.send_date != null) {
                        let send_date = new Date(json_app.send_date);
                        document.querySelector("#send_day").value = send_date.getDate();
                        document.querySelector("#send_month").value = send_date.getMonth() + 1;
                        document.querySelector("#send_year").value = send_date.getFullYear();
                        document.querySelector("#send_hour").value = send_date.getHours();
                        document.querySelector("#send_minute").value = send_date.getMinutes();
                    }

                    if (json_app.end_date != null) {
                        let end_date = new Date(json_app.end_date);
                        document.querySelector("#end_day").value = end_date.getDate();
                        document.querySelector("#end_month").value = end_date.getMonth() + 1;
                        document.querySelector("#end_year").value = end_date.getFullYear();
                        document.querySelector("#end_hour").value = end_date.getHours();
                        document.querySelector("#end_minute").value = end_date.getMinutes();
                    }
                }
            }
        }
    }

    update_config() {
        var form = document.querySelector("#update-form");
        this.id_vacancy = document.querySelector("#id_vacancy").value;
        var formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../vacante/update_config');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r == 0) {
                    utils.showToast('Omitiste algún dato', 'error');
                } else if (r == 1) {
                    utils.showToast('Se actualizaron las fechas de la vacante', 'success');
                    $('#modal_edit').modal('hide');
                } else if (r == 2) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } else {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
            }
        }
    }



    ///////////////////// INICIO  GABOO //////////////////

    update_perfil() {
        var form = document.querySelector("#vacante-perfil-form");
        var formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './update_perfil');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;

                try {
                    let json_app = JSON.parse(this.responseText);
                    if (json_app.status == 0) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 1) {

                        document.querySelector('#vacancy').innerHTML = json_app.vacante.vacancy;
                        document.querySelector('#department').innerHTML = json_app.vacante.department;
                        document.querySelector('#type').innerHTML = json_app.vacante.type;
                        document.querySelector('#area').innerHTML = json_app.vacante.area;
                        document.querySelector('#subarea').innerHTML = json_app.vacante.subarea;
                        document.querySelector('#warranty_time').innerHTML = json_app.vacante.warranty_time;
                        if (document.querySelector('#amount_to_invoice')) {
                            document.querySelector('#amount_to_invoice').innerHTML = "$" + json_app.vacante.amount_to_invoice;
                        }
                        if (document.querySelector('#authorization_date')) {
                            document.querySelector('#authorization_date').innerHTML = json_app.vacante.authorization_date;
                        }
                        if (document.querySelector('#report_to')) {
                            document.querySelector('#report_to').innerHTML = json_app.vacante.report_to;
                        }
                        if (document.querySelector('#authorization_date')) {
                            document.querySelector('#authorization_date').innerHTML = json_app.vacante.authorization_date;
                        }
                        if (document.querySelector('#personal_in_charge')) {
                            document.querySelector('#personal_in_charge').innerHTML = json_app.vacante.personal_in_charge;
                        }
                        if (document.querySelector('#salary_min_and_salary_max')) {
                            document.querySelector('#salary_min_and_salary_max').innerHTML = "$" + json_app.vacante.salary_min + "- $" + json_app.vacante.salary_max + " (mensual)";
                        } else {
                            document.querySelector('#salary_min').innerHTML = "$" + json_app.vacante.salary_min + "(mensual)";
                        }


                        // document.querySelector('#commitment_date').innerHTML = json_app.vacante.commitment_date;
                        document.querySelector('#city_and_state').innerHTML = json_app.vacante.city + "," + json_app.vacante.state;
                        document.querySelector('#working_day').innerHTML = json_app.vacante.working_day;


                        utils.showToast('Se actualizó correctamente', 'success');
                        $('#modal_perfil').modal('hide');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }


            }
        }
    }

    update_descripcion() {

        var form = document.querySelector("#vacante-descripcion-form");
        var formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './update_descripcion');
        //  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(this.responseText);
                    if (json_app.status == 0) {
                        utils.showToast('Datos Incompletos. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 1) {

                        console.log(json_app);
                        document.querySelector('#education_level').innerHTML = json_app.vacante.level;
                        document.querySelector('#position_number').innerHTML = json_app.vacante.position_number;
                        document.querySelector('#experience_years').innerHTML = json_app.vacante.experience_years;
                        document.querySelector('#age').innerHTML = json_app.vacante.age_min;
                        document.querySelector('#gender').innerHTML = json_app.vacante.gender;
                        document.querySelector('#civil_status').innerHTML = json_app.vacante.status;
                        if (document.querySelector('#experience')) {
                            document.querySelector('#experience').innerHTML = +json_app.vacante.experience;
                        }
                        if (document.querySelector('#skills')) {
                            document.querySelector('#skills').innerHTML = json_app.vacante.skills;
                        }
                        document.querySelector('#language').innerHTML = json_app.vacante.language;
                        document.querySelector('#workdays').innerHTML = json_app.vacante.workdays;
                        document.querySelector('#requeriments').innerHTML = json_app.vacante.requirements;
                        document.querySelector('#functions').innerHTML = json_app.vacante.functions;
                        document.querySelector('#benefits').innerHTML = json_app.vacante.benefits;
                        document.querySelector('#comments').innerHTML = json_app.vacante.comments;
                        utils.showToast('Se actualizó correctamente', 'success');
                        $('#modal_descripcion').modal('hide');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }


    update_contacto() {
        var form = document.querySelector("#vacante-contacto-form");
        var formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './update_contacto');
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(this.responseText);
                    if (json_app.status == 0) {
                        utils.showToast('Datos Incompletos. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 1) {
                        console.log(json_app);
                        document.querySelector('#customer').innerHTML = json_app.vacante.customer;
                        document.querySelector('#customer_contact').innerHTML = json_app.vacante.customer_contact;
                        document.querySelector('#business_name').innerHTML = json_app.vacante.business_name;
                        document.querySelector('#recruiter').innerHTML = json_app.vacante.recruiter;
                        utils.showToast('Se actualizó correctamente', 'success');
                        $('#modal_contacto').modal('hide');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }

    update_condiciones() {

        var form = document.querySelector("#vacante-condiciones-form");
        var formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './update_condiciones');
        //  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(this.responseText);
                    if (json_app.status == 0) {
                        utils.showToast('Datos Incompletos. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 1) {

                        document.querySelector('#send_date_candidate').innerHTML = json_app.vacante.send_date_candidate;
                        document.querySelector('#advance_payment').innerHTML = json_app.vacante.advance_payment;
                        document.querySelector('#payment_amount').innerHTML = json_app.vacante.payment_amount;
                        document.querySelector('#recruitment_service_cost').innerHTML = json_app.vacante.recruitment_service_cost;
                        utils.showToast('Se actualizó correctamente', 'success');
                        $('#modal_condiciones').modal('hide');
                    } else if (json_app.status == 2) {
                        utils.showToast('El porcentaje debe ser igual o menor a 100. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }



    //==================================[Gabo Marzo 21]==========================
    mover_postulante() {
        var form = document.querySelector("#mover-postulante-form");
        var formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Postulaciones/mover_postulante');
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(this.responseText);
                    if (json_app.status == 0) {
                        utils.showToast(' Datos Incompletos. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast(' EL postulante se movió correctamente', 'success');
                        $('#mover-postulante-form').modal('hide');
                    } else if (json_app.status == 2) {
                        utils.showToast(' No se pudo crear', 'error');
                    } else if (json_app.status == 3) {
                        utils.showToast(' El postulante ya existe', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }
    //==========================================================================
    //==================================[Gabo Marzo 28 Perfil Postulado]======================
    llenar_perfil(id_vacancy) {
        this.id_vacancy = id_vacancy;
        let xhr = new XMLHttpRequest();
        let data = `id_vacancy=${this.id_vacancy}`;
        xhr.open('POST', '../Vacante/consulta_vacante');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(this.responseText);
                    if (json_app.status == 1) {
                        if (json_app.vacante.type == 1) {//Si es tipo de vacante operativa no son obligatorias
                            document.querySelector('#gender_c').required = false;
                            document.querySelector('#status_gender').required = false;
                            document.querySelector('#civil_status_c').required = false;
                            document.querySelector('#status_civil_status').required = false;
                            document.querySelectorAll('#modal_perfil_postulante .row')[0].hidden = true
                            document.querySelectorAll('#modal_perfil_postulante .row')[2].hidden = true
                        }

                        document.querySelector('#vacancy').innerHTML = "<b>Nombre del puesto:</b> " + json_app.vacante.vacancy;
                        document.querySelector('#ubication').innerHTML = "<b>Ubicación del puesto:</b> " + json_app.vacante.city + "," + json_app.vacante.state;

                        if (json_app.vacante.salary_min == "" || json_app.vacante.salary_max == "") {
                            if (json_app.vacante.salary_min == "") {
                                json_app.vacante.salary_min = json_app.vacante.salary_max;
                            }
                        }
                        document.querySelector('#salary').innerHTML = "<b>Sueldo Ofrecido:</b> " + json_app.vacante.salary_min + "-" + json_app.vacante.salary_max;
                        document.querySelector('#modal_perfil_postulante [name="gender"]').value = json_app.vacante.gender;

                        if (json_app.vacante.age_min == "" || json_app.vacante.age_max == "") {
                            if (json_app.vacante.age_min == "") {
                                json_app.vacante.age_min = json_app.vacante.age_max;
                            }
                            document.querySelector('#modal_perfil_postulante [name="age"]').value = json_app.vacante.age_min;
                        } else {
                            document.querySelector('#modal_perfil_postulante [name="age"]').value = json_app.vacante.age_min + "-" + json_app.vacante.age_max;
                        }
                        document.querySelector('#modal_perfil_postulante [name="civil_status"]').value = json_app.vacante.status;
                        document.querySelector('#modal_perfil_postulante [name="level"]').value = json_app.vacante.level;


                        if (json_app.vacante.language == null || json_app.vacante.language == '' || json_app.vacante.language == 'Español') {
                            document.querySelector('#modal_perfil_postulante .div_language').hidden = true
                        }
                        document.querySelector('#modal_perfil_postulante [name="language"]').value = json_app.vacante.language;
                        document.querySelector('#modal_perfil_postulante [name="language_level"]').value = json_app.vacante.language_level;
                        document.querySelector('#modal_perfil_postulante [name="experience_years"]').value = json_app.vacante.experience_years == null ? '0' + ' ' + json_app.vacante.experience_type : json_app.vacante.experience_years + ' ' + json_app.vacante.experience_type;

                        //  document.querySelector('#modal_perfil_postulante [name="requirements"]').value = json_app.vacante.requirements;
                        document.querySelector('#modal_perfil_postulante [name="functions"]').value = json_app.vacante.functions;
                    } else if (json_app.status == 0) {
                        utils.showToast(' No se pudo consultar la informacion', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }
    //============================================================================================


    // ===[gabo 28 abrill modal vacantes]===
    agregar_candidato() {
        document.querySelector("#add-candidate-form #add_candidate_submit").disabled = true;
        var form = document.querySelector("#add-candidate-form");
        var formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Postulaciones/agregar_a_vacante');
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(this.responseText);
                    if (json_app.status == 0) {
                        utils.showToast(' Datos Incompletos. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast(' Candidatos enviados al cliente correctamente', 'success');
                        $('#modal_vacantes').modal('hide');
                        $("#id_vacancy_v").val("");
                        $('#id_vacancy_v').trigger('change');
                        document.querySelector("#add-candidate-form #add_candidate_submit").disabled = false;

                    } else if (json_app.status == 2) {
                        utils.showToast(' No se pudo crear', 'error');
                        document.querySelector("#add-candidate-form #add_candidate_submit").disabled = false;
                    } else if (json_app.status == 3) {
                        utils.showToast(' El candidado ya se encuentra en esa vacante', 'error');
                        document.querySelector("#add-candidate-form #add_candidate_submit").disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector("#add-candidate-form #add_candidate_submit").disabled = false;
                }
            }
        }
    }
    //===Gabo 28 abril modal vacantes fin]===


    getVacancySateCity(id_vacancy) {
        fetch('../vacante/getVacancySateCity', {
            method: 'POST',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            body: 'id_vacancy=' + id_vacancy
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
                        //$('#id_state').val(json_app.vacancy_data.id_state).trigger('change.select2');

                        let State = ''
                        json_app.State.forEach(element => {
                            State += `
                            <option value='${element.id}' ${element.id == json_app.vacancy_data.id_state ? 'selected' : ''}  >${element.state}</option>
                            `;
                        });
                        document.querySelector("#modal_create form [name='id_state']").innerHTML = State;

                        let citys = ''
                        json_app.City.forEach(element => {
                            citys += `
                            <option value='${element.id}' ${element.id == json_app.vacancy_data.id_city ? 'selected' : ''} >${element.city}</option>
                            `;
                        });
                        document.querySelector("#modal_create form [name='id_city']").innerHTML = citys;

                        //$('#id_city').val(json_app.vacancy_data.id_city).trigger('change.select2');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
            });
    }
    //gabo 29


    save_notes() {

        var notes = document.querySelector('#notes').value;
        var id_vacancy = document.querySelector('#id_vacancy').value;
        var Data = new FormData();
        Data.append('notes', notes);
        Data.append('id_vacancy', id_vacancy);
        fetch('../vacante/save_notes', {
            method: 'POST',

            body: Data
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
                        document.querySelector("#save_notes").disabled = false;
                    } else if (json_app.status === 1) {
                        utils.showToast('Nota guardada correctamente', 'success');
                        document.querySelector("#save_notes").disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector("#save_notes").disabled = false;
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector("#save_notes").disabled = false;
            });
    }






    getTypeVacancy(id_vacancy) {

        fetch('../vacante/getTypeVacancy', {
            method: 'POST',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            body: 'id_vacancy=' + id_vacancy
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

                        $("#modal_create [name='id_area']").val(json_app.vacante.id_area);
                        //    $("#modal_create [name='id_area']").trigger('change');

                        let subareas = json_app.subareas;
                        $("#modal_create [name='id_subarea']").find('option').remove();
                        subareas.forEach((element) => {
                            if (element['id'] == json_app.vacante.id_subarea) {

                                $("#modal_create [name='id_subarea']").append($('<option selected="selected">').val(element['id']).text(element['subarea']));
                            } else {
                                $("#modal_create [name='id_subarea']").append($('<option>').val(element['id']).text(element['subarea']));
                            }
                        });



                        if (json_app.type == 1 || json_app.type == 4) {
                            document.querySelector('#div-sexo').hidden = true;
                            document.querySelector('#div-civil-status').hidden = true;
                            document.querySelector('#div-email').hidden = true;
                            document.querySelector('#div-celular').hidden = true;
                            document.querySelector('#div-curriculum').hidden = true;
                            document.querySelector('#div-url').hidden = true;

                            $('#id_gender').removeAttr("required");
                            $('#id_civil_status').removeAttr("required");
                            $('#email').removeAttr("required");
                            $('#celular').removeAttr("required");

                            document.querySelector('#div-experience').hidden = false;

                        } else {
                            document.querySelector('#div-sexo').hidden = false;
                            document.querySelector('#div-civil-status').hidden = false;
                            document.querySelector('#div-email').hidden = false;
                            document.querySelector('#div-celular').hidden = false;
                            document.querySelector('#div-curriculum').hidden = false;
                            document.querySelector('#div-url').hidden = false; false
                            document.querySelector('#div-experience').hidden = true

                            $('#id_gender').prop("required", true);
                            $('#id_civil_status').prop("required", true);
                            $('#email').prop("required", true);
                            $('#celular').prop("required", true);

                            document.querySelector('#div-experience').hidden = true;

                        }

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