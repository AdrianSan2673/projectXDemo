class Candidate {
	contructor() {
		this.id = null;
		this.first_name = '';
		this.surname = '';
		this.last_name = '';
		this.date_birth = null;
		this.id_gender = null;
		this.id_civil_status = null;
		this.job_title = '';
		this.description = '';
		this.telephone = null;
		this.cellphone = null;
		this.email = '';
		this.id_state = null;
		this.id_city = null;
		this.linkedinn = '';
		this.facebook = '';
		this.instagram = '';
		this.id_user = null;

		this.education_level = null;
		this.institution = '';
		this.title = '';
		this.start_date = null;
		this.end_date = null;
		this.still_studies = null;

		this.course = '';
		this.institution_additional_education = '';
		this.start_date_additional = null;
		this.end_date_additional_education = null;

		this.avatar = null;
	}

	save() {
		this.first_name = document.querySelector('#register-candidate-form #first_name').value;
		this.surname = document.querySelector('#register-candidate-form #surname').value;
		this.last_name = document.querySelector('#register-candidate-form #last_name').value;
		this.date_birth = document.querySelector('#register-candidate-form #date_birth').value;
		this.id_gender = document.querySelector('#register-candidate-form #id_gender').value;
		this.id_civil_status = document.querySelector('#register-candidate-form #id_civil_status').value;
		this.job_title = document.querySelector('#register-candidate-form #job_title').value;
		this.description = document.querySelector('#register-candidate-form #description').value;
		this.telephone = document.querySelector('#register-candidate-form #telephone').value;
		this.cellphone = document.querySelector('#register-candidate-form #cellphone').value;
		this.email = document.querySelector('#register-candidate-form #email').value;
		this.id_state = document.querySelector('#register-candidate-form #id_state').value;
		this.id_city = document.querySelector('#register-candidate-form #id_city').value;
		this.linkedinn = document.querySelector('#register-candidate-form #linkedinn').value;
		this.facebook = document.querySelector('#register-candidate-form #facebook').value;
		this.instagram = document.querySelector('#register-candidate-form #instagram').value;

		this.education_level = document.querySelector("#register-candidate-form #education_level").value;
		this.institution = document.querySelector("#register-candidate-form #institution").value;
		this.title = document.querySelector("#register-candidate-form #title").value;
		this.start_date = document.querySelector("#register-candidate-form #start_date").value;
		this.end_date = document.querySelector("#register-candidate-form #end_date").value;
		this.still_studies = document.querySelector("#register-candidate-form #still_studies").checked;

		this.course = document.querySelector("#register-candidate-form #course").value;
		this.institution_additional_education = document.querySelector("#register-candidate-form #institution_additional_education").value;
		this.start_date_additional = document.querySelector("#register-candidate-form #start_date_additional").value;
		this.end_date_additional = document.querySelector("#register-candidate-form #end_date_additional").value;

		let data_avatar = "";
		if (document.querySelector("#avatar").value.length > 0) {
			this.avatar = document.querySelector("#register-candidate-form #preview").toDataURL("image/png");
			data_avatar = `&avatar=${this.avatar}`;
		}

		this.experiences = [];

		var nExperiences = document.getElementsByName("position[]");
		for (let i = 0; i < nExperiences.length; i++) {
			this.experiences.push({
				"position": document.getElementsByName("position[]")[i].value,
				"enterprise": document.getElementsByName("enterprise[]")[i].value,
				"area": document.getElementsByName("position_area[]")[i].value,
				"subarea": document.getElementsByName("position_subarea[]")[i].value,
				"state": document.getElementsByName("state_enterprise[]")[i].value,
				"city": document.getElementsByName("city_enterprise[]")[i].value,
				"start_date": document.getElementsByName("start_date_job[]")[i].value,
				"end_date": document.getElementsByName("end_date_job[]")[i].value,
				"still_works": document.getElementsByName("still_works[]")[i].checked,
				"review": document.getElementsByName("review[]")[i].value,
				"activity1": document.getElementsByName("activity1[]")[i].value,
				"activity2": document.getElementsByName("activity2[]")[i].value,
				"activity3": document.getElementsByName("activity3[]")[i].value,
				"activity4": document.getElementsByName("activity4[]")[i].value
			});
		}
		this.languages = [];

		var nLanguages = document.getElementsByName("language[]");
		for (let j = 0; j < nLanguages.length; j++) {
			this.languages.push({
				"language": document.getElementsByName("language[]")[j].value,
				"language_level": document.getElementsByName("language_level[]")[j].value,
				"institution": document.getElementsByName("institution_language[]")[j].value,
				"start_date": document.getElementsByName("start_date_language[]")[j].value,
				"end_date": document.getElementsByName("end_date_language[]")[j].value
			});
		}

		this.aptitudes = [];

		var nAptitudes = document.getElementsByName("aptitude[]");
		for (let k = 0; k < nAptitudes.length; k++) {
			this.aptitudes.push({
				"aptitude": document.getElementsByName("aptitude[]")[k].value,
				"level": document.getElementsByName("aptitude_level[]")[k].value
			});
		}

		if (this.first_name.length > 0 && this.surname.length > 0 && this.last_name.length > 0 && this.date_birth.length > 0 && this.id_gender.length > 0 && this.id_civil_status.length > 0 && this.job_title.length > 0 && this.description.length > 0 && this.telephone.length > 0 && this.cellphone.length > 0 && this.email.length > 0 && this.id_state.length > 0 && this.id_city.length > 0) {
			let data = `first_name=${this.first_name}&surname=${this.surname}&last_name=${this.last_name}&date_birth=${this.date_birth}&id_gender=${this.id_gender}&id_civil_status=${this.id_civil_status}&job_title=${this.job_title}&description=${this.description}&telephone=${this.telephone}&cellphone=${this.cellphone}&email=${this.email}&id_state=${this.id_state}&id_city=${this.id_city}&linkedinn=${this.linkedinn}&facebook=${this.facebook}&instagram=${this.instagram}&education_level=${this.education_level}&institution=${this.institution}&title=${this.title}&start_date=${this.start_date}&end_date=${this.end_date}&still_studies=${this.still_studies}&course=${this.course}&institution_additional_education=${this.institution_additional_education}&start_date_additional=${this.start_date_additional}&end_date_additional=${this.end_date_additional}&experiences=${JSON.stringify(this.experiences)}&languages=${JSON.stringify(this.languages)}&aptitudes=${JSON.stringify(this.aptitudes)}${data_avatar}`;
			let xhr = new XMLHttpRequest();
			xhr.open('POST', './create');
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.send(data);

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let r = xhr.responseText;
					console.log(r);
					if (r == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#register-candidate-form #candidate_submit").disabled = false;
					} else if (r == 1) {
						utils.showToast('El currículum fue registrado exitosamente', 'success');
						setTimeout(() => {
							window.location.reload();
						}, 3000);
						//document.querySelector('#register-candidate-form').reset();

					} else if (r == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#register-candidate-form #candidate_submit").disabled = false;
					}
				}
			}

		} else {
			utils.showToast('Completa todos los campos', 'warning');
			document.querySelector("#register-candidate-form #candidate_submit").disabled = false;
		}
	}

	getTbCandidates() {
		this.id_customer = document.querySelector('#id').value;
		let xhr = new XMLHttpRequest();
		let data = `customer=${this.id_customer}`;
		xhr.open('POST', '../ClienteContacto/getContactsByCustomer');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				if (r != 0) {
					let json_contacts = JSON.parse(this.responseText);
					let contacts = '';
					for (let i in json_contacts) {
						contacts += `<tr>
                                        <td>${json_contacts[i].first_name} ${json_contacts[i].last_name}</td>
                                        <td>${json_contacts[i].position}</td>
                                        <td>${json_contacts[i].email}</td>
                                        <td>${json_contacts[i].telephone}</td>
                                        <td>${json_contacts[i].extension}</td>
                                        <td>${json_contacts[i].cellphone}</td>
                                        <td>${json_contacts[i].username}</td>
                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <a href="#" class="btn btn-info">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>`
					}
					console.log();
					document.querySelector("#tb_contacts tbody").innerHTML = contacts;
				}
			}
		}
	}

	create() {

		this.first_name = document.querySelector('#candidate-form #first_name').value;
		this.surname = document.querySelector('#candidate-form #surname').value;
		this.last_name = document.querySelector('#candidate-form #last_name').value;
		this.date_birth = document.querySelector('#candidate-form #date_birth').value;
		this.id_gender = document.querySelector('#candidate-form #id_gender').value;
		this.id_civil_status = document.querySelector('#candidate-form #id_civil_status').value;
		this.id_level = document.querySelector('#candidate-form #id_level').value;
		this.job_title = document.querySelector('#candidate-form #job_title').value;
		this.description = document.querySelector('#candidate-form #description').value;
		this.email = document.querySelector('#candidate-form #email').value;
		this.id_state = document.querySelector('#candidate-form #id_state').value;
		this.id_city = document.querySelector('#candidate-form #id_city').value;
		this.id_area = document.querySelector('#candidate-form #id_area').value;
		this.id_subarea = document.querySelector('#candidate-form #id_subarea').value;
		this.photo = document.querySelector("#avatar").value;

		if (this.first_name.length > 0 && this.surname.length > 0 && this.last_name.length > 0 && this.id_level.length > 0 && this.job_title.length > 0 && this.email.length > 0 && this.id_state.length > 0 && this.id_city.length > 0 && this.id_area.length > 0 && this.id_subarea.length > 0) {
			var form = document.querySelector("#candidate-form");
			var formData = new FormData(form);
			if (document.querySelector("#avatar").value.length > 0) {
				this.avatar = document.querySelector("#candidate-form #preview").toDataURL("image/png");
				formData.append('avatar', this.avatar);
			}
			let xhr = new XMLHttpRequest();
			xhr.open('POST', './new');
			//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.send(formData);

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let r = xhr.responseText;
					console.log(r);
					if (r == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (r == 1) {
						utils.showToast('Candidato creado exitosamente', 'success');
						document.querySelector("#candidate-form #candidate_submit").disabled = true;
						setTimeout(() => {
							//window.location.href = `./index`;
							window.history.back();
						}, 3000);

					} else if (r == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (r == 3) {
						utils.showToast('Error al subir la imagen', 'error');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (r == 4) {
						utils.showToast('El archivo de tu cv excede el peso permitido o tiene un formato no admitido', 'warning');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else {
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					}
				} else {
					document.querySelector("#candidate-form #candidate_submit").disabled = false;
				}
			}
		} else {
			utils.showToast('Completa todos los campos', 'warning');
			document.querySelector("#candidate-form #candidate_submit").disabled = false;
		}

		/*if (this.photo.length == 0) {
			utils.showToast('Es necesario que agregues una foto tuya', 'warning');
		}*/

	}

	update() {
		this.id = document.querySelector("#candidate-form #id").value;
		this.first_name = document.querySelector('#candidate-form #first_name').value;
		this.surname = document.querySelector('#candidate-form #surname').value;
		this.last_name = document.querySelector('#candidate-form #last_name').value;
		this.date_birth = document.querySelector('#candidate-form #date_birth').value;
		this.id_gender = document.querySelector('#candidate-form #id_gender').value;
		this.id_civil_status = document.querySelector('#candidate-form #id_civil_status').value;
		this.job_title = document.querySelector('#candidate-form #job_title').value;
		this.description = document.querySelector('#candidate-form #description').value;
		this.telephone = document.querySelector('#candidate-form #telephone').value;
		this.cellphone = document.querySelector('#candidate-form #cellphone').value;
		this.email = document.querySelector('#candidate-form #email').value;
		this.id_state = document.querySelector('#candidate-form #id_state').value;
		this.id_city = document.querySelector('#candidate-form #id_city').value;
		this.id_area = document.querySelector('#candidate-form #id_area').value;
		this.id_subarea = document.querySelector('#candidate-form #id_subarea').value;
		this.linkedinn = document.querySelector('#candidate-form #linkedinn').value;
		this.facebook = document.querySelector('#candidate-form #facebook').value;
		this.instagram = document.querySelector('#candidate-form #instagram').value;

		this.id_level = document.querySelector("#candidate-form #id_level").value;
		/*this.institution = document.querySelector("#candidate-form #institution").value;
		this.title = document.querySelector("#candidate-form #title").value;
		this.start_date = document.querySelector("#candidate-form #start_date").value;
		this.end_date = document.querySelector("#candidate-form #end_date").value;
		this.still_studies = document.querySelector("#candidate-form #still_studies").checked;

		this.course = document.querySelector("#candidate-form #course").value;
		this.institution_additional_education = document.querySelector("#candidate-form #institution_additional_education").value;
		this.start_date_additional = document.querySelector("#candidate-form #start_date_additional").value;
		this.end_date_additional = document.querySelector("#candidate-form #end_date_additional").value; */

		if (this.id.length > 0 && this.first_name.length > 0 && this.surname.length > 0 && this.last_name.length > 0 && this.id_level.length > 0 && this.job_title.length > 0 && this.telephone.length > 0 && this.cellphone.length > 0 && this.email.length > 0 && this.id_state.length > 0 && this.id_city.length > 0 && this.id_area.length > 0 && this.id_subarea.length > 0) {
			/* let data = `id=${this.id}&first_name=${this.first_name}&surname=${this.surname}&last_name=${this.last_name}&date_birth=${this.date_birth}&id_gender=${this.id_gender}&id_civil_status=${this.id_civil_status}&job_title=${this.job_title}&description=${this.description}&telephone=${this.telephone}&cellphone=${this.cellphone}&email=${this.email}&id_state=${this.id_state}&id_city=${this.id_city}&linkedinn=${this.linkedinn}&facebook=${this.facebook}&instagram=${this.instagram}${data_avatar}`; */
			var form = document.querySelector("#candidate-form");
			var formData = new FormData(form);
			formData.append('id', this.id);
			if (document.querySelector("#avatar").value.length > 0) {
				this.avatar = document.querySelector("#candidate-form #preview").toDataURL("image/png");
				formData.append('avatar', this.avatar);
			}

			let xhr = new XMLHttpRequest();
			xhr.open('POST', './update');
			//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.send(formData);
			xhr.id_candidate = this.id;

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let r = xhr.responseText;
					console.log(r);
					if (r == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (r == 1) {
						utils.showToast('Currículum editado exitosamente', 'success');
						document.querySelector("#candidate-form #candidate_submit").disabled = true;
						setTimeout(() => {
							window.location.href = `./ver&id=${xhr.id_candidate}`;
						}, 3000);

					} else if (r == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (r == 3) {
						utils.showToast('Error al subir la imagen', 'error');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (r == 4) {
						utils.showToast('El archivo de tu cv excede el peso permitido o tiene un formato no admitido', 'warning');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else {
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					}
				} else {
					document.querySelector("#candidate-form #candidate_submit").disabled = false;
				}
			}

		} else {
			utils.showToast('Completa todos los campos', 'warning');
			document.querySelector("#candidate-form #candidate_submit").disabled = false;
		}
	}



	//gabo perfil
	llenar_perfil(id_candidato, id_vacancy) {
		this.id_candidato = id_candidato;
		this.id_vacancy = id_vacancy;
		let xhr = new XMLHttpRequest();
		let data = `id_candidato=${this.id_candidato}&id_vacancy=${this.id_vacancy}`;
		xhr.open('POST', '../Candidato/consulta_perfil');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				//console.log(r);
				try {
					let json_app = JSON.parse(this.responseText);

					//    ===[gabo 21 mayo operativa]===
					if (document.getElementById('div_experience') && document.getElementById('div_experience').style.display != 'none') {


						let experiencias = json_app.experience;
						let titulo = "Descripcion:";
						var row = "";
						let primero = 1;

						const div = document.querySelector('#div_experience');

						experiencias.forEach((element) => {

							row += `
						<div class="row borrados">
							<div class="col-md-2">
							<div class="form-group" style="text-align: center">
							  <label for="" class="col-form-label" style="margin-top:30px">`+ titulo + `</label>
							</div>
						  </div>
						  <div class="col-md-4">
							<div class="form-group" style="text-align: center">`;
							if (primero == 1) {
								row += ` <label class="col-form-label">Empresa</label>`;
							} else {
								row += `<label class="col-form-label"></label>`;
							}
							row += `
							  <input type="text" name="enterprise_experience[]"  style="text-align:center" value="` + element.enterprise + `" class=" form-control"  >
							</div>
						  </div>

						  <div class="col-md-5">
							<div class="form-group" style="text-align: center">`;
							if (primero == 1) {
								row += `<label class="col-form-label">Puesto</label>`;
							} else {
								row += `<label class="col-form-label"></label>`;
							}
							row += `
							  <input type="text" name="position_experience[]" value="` + element.position + `" style="text-align:center"  class=" form-control">
							</div>
						  </div>`;
							if (primero == 0) {
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
							
							titulo = '';
							primero = 0;
						});
						if (experiencias.length > 0) {
							div.innerHTML = row;
						}

					}

					//    ===[gabo 21 mayo operativa fin]=== 


					if (json_app.status == 1) { //obtiene info desde candidato
						document.querySelector('#modal_perfil_postulante #candidate_name').innerHTML = "<b>Nombre del candidato:</b> " + json_app.name_candidate
						document.querySelector('#modal_perfil_postulante [name="gender_c"]').value = json_app.candidato.gender;
						document.querySelector('#modal_perfil_postulante [name="age_c"]').value = json_app.candidato.age_cal;
						document.querySelector('#modal_perfil_postulante [name="civil_status_c"]').value = json_app.candidato.status;
						document.querySelector('#modal_perfil_postulante [name="level_c"]').value = json_app.candidato.level;
						document.querySelector('#modal_perfil_postulante [name="language_c"]').value = json_app.language.language;
						//gabo act
						document.querySelector('#modal_perfil_postulante [name="language_level_c"]').value = json_app.language.level;

					} else if (json_app.status == 2) { //obtiene info desde el perfil
						document.querySelector('#modal_perfil_postulante #candidate_name').innerHTML = "<b>Nombre del candidato:</b> " + json_app.name_candidate;
						document.querySelector('#modal_perfil_postulante [name="gender_c"]').value = json_app.candidato.gender;
						document.querySelector('#modal_perfil_postulante [name="age_c"]').value = json_app.candidato.age;
						document.querySelector('#modal_perfil_postulante [name="civil_status_c"]').value = json_app.candidato.civil_status;
						document.querySelector('#modal_perfil_postulante [name="level_c"]').value = json_app.candidato.level;
						document.querySelector('#modal_perfil_postulante [name="language_c"]').value = json_app.candidato.language;
						document.querySelector('#modal_perfil_postulante [name="language_level_c"]').value = json_app.candidato.language_level;
						// document.querySelector('#modal_perfil_postulante [name="requirements_c"]').value = json_app.candidato.requirements;
						document.querySelector('#modal_perfil_postulante [name="functions_c"]').value = json_app.candidato.functions;
						document.querySelector('#modal_perfil_postulante [name="experience_years_c"]').value = json_app.candidato.experience_years == '0' || json_app.candidato.experience_years == '' ? '0' : json_app.candidato.experience_years;

						//addc comentarios,generales,candidato puestos y estado   gabo mod

						document.querySelector('#modal_perfil_postulante [name="experiencia_comments"]').value = json_app.candidato.experiencia_comments;
						document.querySelector('#modal_perfil_postulante [name="functions_comments"]').value = json_app.candidato.functions_comments;
						document.querySelector('#modal_perfil_postulante [name="general_comments"]').value = json_app.candidato.general_comments;



						$("#status_gender").val(json_app.candidato.status_gender);
						$("#status_age").val(json_app.candidato.status_age);
						$("#status_civil_status").val(json_app.candidato.status_civil_status);
						$("#status_level").val(json_app.candidato.status_level);
						$("#status_language").val(json_app.candidato.status_language);
						$("#status_language_level").val(json_app.candidato.status_language_level);
						$("#status_experience_years").val(json_app.candidato.status_experience_years);
						//gabo mod
						$("#status_functions").val(json_app.candidato.status_functions);




					} else if (json_app.status == 0) {
						utils.showToast(' No se pudo consultar la informacion', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

				}
			}
		}
	}

	//==================================[Gabo Marzo 28 Perfil Postulado]======================
	save_perfil() {
		let xhr = new XMLHttpRequest();
		var form = document.querySelector("#save_perfil-form");
		var formData = new FormData(form);

		document.querySelector("#save_perfil-form [name='submit']").disabled = true
		xhr.open('POST', '../Candidato/save_perfil');
		// xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);

				try {
					document.querySelector("#save_perfil-form #submit").disabled = false;
					let json_app = JSON.parse(this.responseText);
					if (json_app.status == 0) {
						utils.showToast('Llena todos los campos requeridos por favor', 'error');
						document.querySelector("#save_perfil-form [name='submit']").disabled = false

					} else if (json_app.status == 1) {
						utils.showToast('La información se ha actualizado correctamente', 'success');
						$('#modal_perfil_postulante').modal('hide');
						document.querySelector("#save_perfil-form [name='submit']").disabled = false


						const collection = document.getElementsByClassName("borrados");


						var total = collection.length;

						for (let i = 0; i < total; i++) {
							collection[0].remove();
						}


					} else if (json_app.status == 2) {
						utils.showToast(' No se pudo guardar la informacion', 'error');
						document.querySelector("#save_perfil-form [name='submit']").disabled = false

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save_perfil-form [name='submit']").disabled = false

				}
			}
		}
	}
	//============================================================================================

	// gabo act




	descartar() {

		var form = document.querySelector("#descartar-postulante-form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Postulaciones/update_comments');
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
						utils.showToast('Información guardada correctamente', 'success');
						$('#modal_descartar_postulante').modal('hide');
						setTimeout(() => {
							window.location.reload();
						}, 1000);


					} else if (json_app.status == 2) {
						utils.showToast(' No se pudo descartar', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				}
			}
		}
	}

	//gabo reactivar

	reactivar() {

		var form = document.querySelector("#reactivar-postulante-form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Postulaciones/reactivar_postulante');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(this.responseText);
					if (json_app.status == 1) {
						utils.showToast('Postulante reactivado correctamente', 'success');
						$('#modal_descartar_postulante').modal('hide');
						setTimeout(() => {
							window.location.reload();
						}, 1000);


					} else if (json_app.status == 2) {
						utils.showToast(' No se pudo reactivar', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				}
			}
		}
	}

	//gabo  eliminar
	eliminar() {
		var form = document.querySelector("#eliminar-postulante-form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Postulaciones/eliminar_postulante');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(this.responseText);
					if (json_app.status == 1) {
						utils.showToast('Postulante eliminado correctamente', 'success');
						$('#modal_elininar_postulante').modal('hide');
						setTimeout(() => {
							window.location.reload();
						}, 1000);


					} else if (json_app.status == 2) {
						utils.showToast(' No se pudo eliminar', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				}
			}
		}
	}



	// ===[GABO 27 ABRIL VER CANDIDATO2]===

	update_modal() {

		var form = document.querySelector("#update-candidate-form");
		var formData = new FormData(form);

		if (document.querySelector("#avatar").value.length > 0) {
			this.avatar = document.querySelector("#update-candidate-form #preview").toDataURL("image/png");
			formData.append('avatar', this.avatar);
		}

		let xhr = new XMLHttpRequest();
		xhr.open('POST', './update_modal');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#update_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {

						$("#img_can").attr("src", "" + json_app.candidato.img);

						document.querySelector("#title_can").innerHTML = json_app.candidato.job_title;
						document.querySelector("#first_name_can").innerHTML = json_app.candidato.first_name + " " + json_app.candidato.surname + " " + json_app.candidato.last_name;


						let div1 = "";
						div1 += ` 
				 <h4 class="text-muted">Acerca de mí</h4>
				 <p id="description_can"> ` + json_app.candidato.description + ` </p>  
						<ul class="list-unstyled mb-3">
                        <li>
                          <p id="telephone_can"><i class="fas fa-phone-alt"></i>  ` + json_app.candidato.telephone + `</p> 
                        </li>
                        <li>
                          <p id="cellphone_can"><i class="fas fa-mobile-alt"></i>  ` + json_app.candidato.cellphone + `</p> 
                        </li>
                        <li>
                          <p id="email_can"><i class="fas fa-envelope"></i>  ` + json_app.candidato.email + `</p> 
                        </li>
                        <li>
                          <p id="city_state_can"><i class="fas fa-map-marker-alt"></i>  ` + json_app.candidato.city + `, ` + json_app.candidato.state + `</p> 
                        </li>`;
						if (json_app.candidato.linkedinn != "") {
							div1 += ` 
                        <li>
                          <p id="linkedinn_can"><i class="fab fa-linkedin-in"></i>  ` + json_app.candidato.linkedinn + `</p> 
                        </li> `;
						}

						if (json_app.candidato.facebook != "") {
							div1 += ` 
                        <li>
                          <p id="facebook_can"><i class="fab fa-facebook-square"></i>  ` + json_app.candidato.facebook + `</p> 
                        </li>
						`;
						}

						if (json_app.candidato.instagram != "") {
							div1 += ` 
                        <li>
                          <p id="instagram_can"><i class="fab fa-instagram"></i>  ` + json_app.candidato.instagram + `</p> 
                        </li>`;
						}

						div1 += ` </ul> `;

						document.querySelector("#div_candidato").innerHTML = div1;


						let div2 = "";
						div2 += ` 
                    <b class="text-muted">Fecha de registro</b>
                    <p id="created_at_can"> ` + json_app.candidato.created_at + `</p> 
                    <b class="text-muted">última modificación</b>
                    <p id="modified_at_can"> ` + json_app.candidato.modified_at + `</p> 
                  `;
						document.querySelector("#div_fechas").innerHTML = div2;

						utils.showToast('Currículum editado exitosamente', 'success');
						document.querySelector("#update_candidate_submit").disabled = false;
						$('#modal_candidato').modal('hide');

					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#update_candidate_submit").disabled = false;
					} else if (json_app.status == 3) {
						utils.showToast('Error al subir la imagen', 'error');
						document.querySelector("#update_candidate_submit").disabled = false;
					} else if (json_app.status == 4) {
						utils.showToast('El archivo de tu cv excede el peso permitido o tiene un formato no admitido', 'warning');
						document.querySelector("#update_candidate_submit").disabled = false;
					} else {
						document.querySelector("#update_candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#update_candidate_submit").disabled = false;
				}
			}
		}


	}

	// ===[FN]===

}