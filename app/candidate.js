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
		document.querySelector("#candidate-form #candidate_submit").disabled = true;
		var form = document.querySelector("#candidate-form");
		var formData = new FormData(form);
		if (document.querySelector("#avatar").value.length > 0) {
			this.avatar = document.querySelector("#candidate-form #preview").toDataURL("image/png");
			formData.append('avatar', this.avatar);
		}
		if (document.querySelector("#bandera")) {
			if (document.querySelector("#bandera").value == 1) {
				document.querySelector("#directory").disabled = true;
				formData.append('directory', document.querySelector("#bandera").value);
			}
		}

		fetch('./new', {
			method: 'POST',
			body: formData
		})
			.then(response => {
				//	console.log(response.json());
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
					console.log(json_app);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (json_app.status == 1) {

						console.log(json_app);
						if (json_app.isCandidate == true) {
							utils.showToast('Informacion registrada exitosamente', 'success');
							setTimeout(() => {
								window.location.href = `../vacante/en_proceso`;
							}, 3000);
						} else if (json_app.id_vacancy == false) {
							utils.showToast('Informacion registrada exitosamente', 'success');
							setTimeout(() => {
								window.location.href = `../vacante/en_proceso`;
							}, 3000);
						} else {
							utils.showToast('Candidato creado exitosamente', 'success');
							setTimeout(() => {
								window.location.href = `./profile&id_vacancy=${json_app.id_vacancy}&id_candidate=${json_app.id_candidate}`;
							}, 3000);


						}
					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (json_app.status == 3) {
						utils.showToast('Error al subir la imagen', 'error');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (json_app.status == 4) {
						utils.showToast('El archivo de tu cv excede el peso permitido o tiene un formato no admitido', 'warning');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (json_app.status == 5) {
						utils.showToast('Fecha de nacimiento no permitida', 'warning');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (json_app.status == 6) {
						utils.showToast('Formato de fecha incorrecto, verifiquelas por favor', 'warning');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else if (json_app.status == 7) {
						utils.showToast('Llene todos los campos por favor, verifiquelas por favor', 'warning');
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					} else {
						document.querySelector("#candidate-form #candidate_submit").disabled = false;
					}

				} catch (error) {
					utils.showToast('Algo salió mal2. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#candidate-form #candidate_submit").disabled = false;
				}
			})
			.catch(error => {
				utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				document.querySelector('#agregar-subarea-form [name="guardar"]').disabled = false;
			});
	}
	//===[gabo 1 agosto operativa]===

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
						document.querySelector('#modal_perfil_postulante [name="experience_years_c"]').value = json_app.candidato.experience_years == '0' || json_app.candidato.experience_years == '' || json_app.candidato.experience_years == null ? '0' : json_app.candidato.experience_years;

						//addc comentarios,generales,candidato puestos y estado   gabo mod

						document.querySelector('#modal_perfil_postulante [name="experiencia_comments"]').value = json_app.candidato.experiencia_comments;
						document.querySelector('#modal_perfil_postulante [name="functions_comments"]').value = json_app.candidato.functions_comments;
						document.querySelector('#modal_perfil_postulante [name="general_comments"]').value = json_app.candidato.general_comments;

						//===[gabo 27 junio perfil]==
						document.querySelector('#modal_perfil_postulante [name="tiempo"]').value = json_app.candidato.tiempo;
						//===[gabo 27 junio perfil fin]==

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


	// ===[gabo 2 junio modal-experiencia]=== 

	llenar_experiencia(id_candidato) {
		this.id_candidato = id_candidato;
		let xhr = new XMLHttpRequest();
		let data = `id_candidato=${this.id_candidato}`;
		xhr.open('POST', '../Candidato/consulta_experiencia');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				try {
					let json_app = JSON.parse(this.responseText);

					if (json_app.status == 1) {
						let experiencias = json_app.experience;
						let titulo = "Descripcion:";
						var row = "";
						let primero = 1;

						const div = document.querySelector('#div_experience');

						experiencias.forEach((element) => {

							if (element.type == 'operativa') {
								var enterprise = 'name="enterprise_experience[]"';
								var review = 'name="review_experience[]"';
								var readonly = '';

							} else {
								var enterprise = '';
								var review = '';
								var readonly = 'readonly';

							}

							row += `
							<div class="row borrados" style="margin-bottom:0.6rem; border:1px solid #98AE98 ; border-radius:15px;padding:1rem">
							<div class="col-md-2">
							<div class="form-group" style="text-align: center">
							  <label for="" class="col-form-label" style="margin-top:30px">Información:</label>
							</div>
						  </div>
						  <div class="col-md-4">
							<div class="form-group" style="text-align: center">
										  
							`;

							row += ` <label class="col-form-label">Empresa/Puesto</label>`;

							row += `
							  <input required type="text" `+ enterprise + `  style="text-align:center" value="` + element.enterprise + `" class=" form-control"  ` + readonly + ` >
							</div>
						  </div>

						  <div class="col-md-5">
						 
						
							<div class="form-group" style="text-align: center">`;

							row += `<label class="col-form-label">Descripcion</label>`;

							row += `
							 <textarea  required  `+ review + `  id="review_experience" rows="4"  class=" form-control" ` + readonly + ` >` + element.review + `</textarea>
							</div>
						  </div>`;
							if (element.type == "operativa") {
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

						document.querySelector("#modal-experiencia #submit").disabled = false;


					} else if (json_app.status == 0) {
						utils.showToast(' No se pudo consultar la informacion', 'error');
						document.querySelector("#modal-experiencia #submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

				}
			}
		}
	}


	save_experiencia() {

		var form = document.querySelector("#experiencia-operativa-form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Candidato/save_experiencia');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);

				try {
					let json_app = JSON.parse(this.responseText);
					if (json_app.status == 1) {

						utils.showToast('La información se ha actualizado correctamente', 'success');
						$('#modal-experiencia').modal('hide');
						document.querySelector("#modal-experiencia #submit").disabled = false;

					} else if (json_app.status == 2) {
						utils.showToast(' No se pudo guardar la informacion', 'error');
						document.querySelector("#modal-experiencia #submit").disabled = false;

					} else if (json_app.status == 6) {
						utils.showToast('Formato de fecha incorrecto, verifiquelas por favor', 'error');
						document.querySelector("#modal-experiencia #submit").disabled = false;

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#modal-experiencia #submit").disabled = false;

				}
			}
		}
	}
	// ===[gabo 2 junio modal-experiencia fin]=== 


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

						$("#img_can").attr("src", json_app.candidato.img);

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


						/* 
									let div2 = "";
									div2 += ` 
								<b class="text-muted">Fecha de registro</b>
								<p id="created_at_can"> ` + json_app.candidato.created_at + `</p> 
								<b class="text-muted">última modificación</b>
								<p id="modified_at_can"> ` + json_app.candidato.modified_at + `</p> 
							  `;
									document.querySelector("#div_fechas").innerHTML = div2; */

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

	save_profile() {

		var form = document.querySelector("#profile-candidate-form");
		document.querySelector("#profile-candidate-form [name='submit']").disabled = true
		var formData = new FormData(form);

		fetch('../Candidato/save_perfil', {
			method: 'POST',
			body: formData
		})

			.then(response => {
				//	console.log(response.json());
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
						utils.showToast('Llena todos los campos requeridos por favor', 'error');
						document.querySelector("#profile-candidate-form [name='submit']").disabled = false

					} else if (json_app.status == 1) {
						utils.showToast('La información se ha actualizado correctamente', 'success');
						setTimeout(() => {
							window.location.href = `../postulaciones/enviados_a_cliente&id=${json_app.id_vacancy}`;
							document.querySelector("#profile-candidate-form [name='submit']").disabled = false

						}, 3000);

					} else if (json_app.status == 2) {
						utils.showToast(' No se pudo guardar la informacion', 'error');
						document.querySelector("#profile-candidate-form [name='submit']").disabled = false

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#profile-candidate-form [name='submit']").disabled = false

				}
			})
			.catch(error => {
				utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				document.querySelector("#profile-candidate-form [name='submit']").disabled = false
			});
	}

	postulate() {

		var form = document.querySelector("#postular-form");
		document.querySelector("#postular-form [name='submit']").disabled = true
		var formData = new FormData(form);

		fetch('../Candidato/postulate', {
			method: 'POST',
			body: formData
		})
			.then(response => {
				//console.log(response.json());
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
						utils.showToast('Llena todos los campos requeridos por favor', 'error');
						document.querySelector("#postular-form [name='submit']").disabled = false

					} else if (json_app.status == 1) {

						console.log(json_app);
						let vacancies = '';
						let cont = json_app.vacancies.length;
						json_app.vacancies.forEach(vacancy => {

							vacancies += `
                                <tr> `;
							(json_app.isCustomer == false) ? vacancies += `<td>${vacancy.applicant_date}</td>` : '';

							vacancies += `
                                    <td>${vacancy.applicant_status}</td>
                                    <td>${vacancy.about}</td>
                                    <td>${vacancy.interview_date}</td>
                                    <td>${vacancy.interview_comments}</td>
                                    <td> ${vacancy.request_date}</td>`;
							(json_app.isCustomer == false) ? vacancies += `<td> ${vacancy.customer}</td >` : '';
							vacancies += ` 
                                    <td>${vacancy.vacancy}</td>
                                    <td>${vacancy.city} , ${vacancy.abbreviation}</td>
                                    `;

							(vacancy.salary_min != vacancy.salary_max) ? vacancies += `<td class="text-center">$${vacancy.salary_min} - $${vacancy.salary_max}</td>` : vacancies += `<td class="text-center">$${vacancy.salary_max}`;

							(json_app.isCustomer == false) ? vacancies += `<td> ${vacancy.end_date}</td >` : '';

							vacancies += `
                                    <td class="text-center ${vacancy.class_color}">${vacancy.status}</td>
                                    <td class="text-center py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="${vacancy.base_url}vacante/ver&id=${vacancy.id}"
                                                class="btn btn-success">
                                                <i class="fas fa-eye"></i>
                                            </a> `;
							(json_app.isAdmin == true || json_app.isJunior == true) ? vacancies += `<a href="${vacancy.base_url}vacante/editar&id=${vacancy.id}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>` : '';

							(json_app.isJunior == true) ? vacancies += `<a href="${vacancy.base_url}postulaciones/buscar&id=${vacancy.id}&area=${vacancy.id}" class="btn btn-info"> <i class="fas fa-search"></i></a>` : '';
							vacancies += `
                                        </div>
                                    </td>
                                </tr >`;

						})

						utils.destruir_datatable('#tb_vacancies', '#tb_vacancies tbody', vacancies);
						$('#modal-postular').modal('hide');
						utils.showToast('Se ha postulado correctamente al candidato', 'success');
						document.querySelector("#postular-form [name='submit']").disabled = false

					} else if (json_app.status == 2) {
						utils.showToast(' No se pudo guardar la informacion', 'error');
						document.querySelector("#postular-form [name='submit']").disabled = false
					} else if (json_app.status == 3) {
						utils.showToast('El candidato ya está postulado a esta vacante', 'error');
						document.querySelector("#postular-form [name='submit']").disabled = false
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#postular-form [name='submit']").disabled = false

				}
			})

			.catch(error => {
				utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				document.querySelector("#postular-form [name='submit']").disabled = false
			});
	}


	//side server
	cargarTabla() {

		var form = document.querySelector("#filtros");
		let datos = '';
		let clave = (form.querySelector('#clave').value != '') ? form.querySelector('#clave').value.trim() : '';
		datos += (form.querySelector('#id_level').value != '') ? 'and id_level=' + form.querySelector('#id_level').value + ' ' : '';
		datos += (form.querySelector('#id_area').value != '') ? 'and id_area=' + form.querySelector('#id_area').value + ' ' : '';
		datos += (form.querySelector('#id_subarea').value != '') ? 'and id_subarea=' + form.querySelector('#id_subarea').value + ' ' : '';
		datos += (form.querySelector('#id_state').value != '') ? 'and id_state=' + form.querySelector('#id_state').value + ' ' : '';
		datos += (form.querySelector('#id_city').value != '') ? 'and id_city=' + form.querySelector('#id_city').value + ' ' : '';
		let id_language = (form.querySelector('#language').value != '') ? form.querySelector('#language').value : '';

		datos += (form.querySelector('#id_gender').value != '') ? 'and id_gender=' + form.querySelector('#id_gender').value + ' ' : '';

		let edad1 = (form.querySelector('#edad1').value != '') ? parseInt(form.querySelector('#edad1').value) + ' ' : 0;
		let edad2 = (form.querySelector('#edad2').value != '') ? parseInt(form.querySelector('#edad2').value) + ' ' : 0;

		edad1 > edad2 ? edad2 = edad1 : '';
		edad1 == '' ? edad1 = edad2 : '';
		edad2 == '' ? edad2 = edad1 : '';

		if (edad1 != 0 && edad2 != 0) {
			datos += 'and age  BETWEEN ' + edad1 + ' AND ' + edad2 + ' ';
		}

		if (clave != '') {
			document.getElementById('div_search').hidden = false;
		} else {
			document.getElementById('div_search').hidden = true;
		}


		$('#tb_candidates').DataTable().destroy();
		var table = $('#tb_candidates').DataTable({
			ajax: {
				url: '../candidato/sideserver?filtros=' + datos + '&id_language=' + id_language + '&clave=' + clave,
				type: "POST"
			},
			processing: true,
			serverSide: true,
			"searching": false,
			"pageLength": 50,
			"columnDefs": [{
				"targets": -1,
				"data": null,
				render: function (data, type, row) { // con row obtienes la información por fila

					let botones = `  <div class="btn-group btn-group-sm align-middle">
					
					<button id="btn_postular" class="btn btn-warning" data-id="${data[1]} ${data[18]} ${data[19]}" value="${data[15]}">
					<i class="fas fa-check"></i> Postular
					</button>
	                               <a href="ver&id=${data[15]}"
	                                    class="btn btn-success">
	                                    <i class="fas fa-eye"></i> Ver
	                                </a>
	                                <a href="editar&id=${data[15]}"
	                                    class="btn btn-info" hidden>
	                                    <i class="fas fa-pencil-alt"></i> Editar
	                                </a>
	                                <a href="../resume/generate&id=${data[15]}"
	                                    target="_blank" class="btn btn-danger" hidden>
	                                    <i class="fas fa-download"></i> Plantilla
	                                </a>
	                               `;

					if (data[17] != '') {
						botones += `
	                               <a href="${data[17]}" target="_blank" class="btn btn-orange">
	                                    <i class="fas fa-file-download"></i> CV
	                                </a></div>`;
					}
					return botones;
				}
			}, {
				"targets": 0,
				"data": null,
				"class": 'image',
				render: function (data, type, row) { // con row obtienes la información por fila
					return ` <img class="img-circle img-fluid img-responsive elevation-2"
	                                src="${data[0]}" style="width:60px; height:auto;">`
				}
			}, {
				"targets": 15,
				"data": 24,
			}], "drawCallback": function (settings) {
				document.querySelector('#encontrados').innerHTML = 'Candidatos Encontrados : ' + settings.json.recordsFiltered;
				console.log(settings.json.recordsFiltered);

				document.querySelector('#clean').disabled = false;
				document.querySelector('#search').disabled = false;

				let colores = ["#C295FE", "#FFEB90", "#84D4FE", "#9FFF90", "#F095FE", "#81A3FC", "#FFB47C", "#FF7C7C"];
				var cont = 0;
				$(`#tb_candidates thead tr:eq(0) th`).each(function (i) {
					if (this.classList.contains('filterhead')) {
						var select = $('<select class="form-control"  style="width: 100% !important;background-color:' + colores[cont] + '"><option value="">Sin filtro</option></select>')
							.appendTo($(this).empty())
							.on('change', function () {

								var valor_buscado = $(this).val();
								$.each($("#tb_candidates tbody tr"), function () {

									if ($(this).text().toLowerCase().indexOf(valor_buscado.toLowerCase()) === -1)
										$(this).hide();
									else
										$(this).show();
								});

							});
						table.column(i).data().unique().sort().each(function (d, j) {
							if (d != null) {
								select.append('<option value="' + d + '">' + d + '</option>')
							}

						});
						cont = cont + 1;
					}

				});
				//do whatever  
			},
		});

	}


	//===[gabo 30 agosto]===
	LoadTablePostulate() {

		var form = document.querySelector("#filtros");
		let datos = '';
		let clave = (form.querySelector('#clave').value != '') ? form.querySelector('#clave').value.trim() : '';
		datos += (form.querySelector('#id_level').value != '') ? 'and id_level=' + form.querySelector('#id_level').value + ' ' : '';
		datos += (form.querySelector('#id_area').value != '') ? 'and id_area=' + form.querySelector('#id_area').value + ' ' : '';
		datos += (form.querySelector('#id_subarea').value != '') ? 'and id_subarea=' + form.querySelector('#id_subarea').value + ' ' : '';
		datos += (form.querySelector('#id_state').value != '') ? 'and id_state=' + form.querySelector('#id_state').value + ' ' : '';
		datos += (form.querySelector('#id_city').value != '') ? 'and id_city=' + form.querySelector('#id_city').value + ' ' : '';
		let id_language = (form.querySelector('#language').value != '') ? form.querySelector('#language').value : '';

		datos += (form.querySelector('#id_gender').value != '') ? 'and id_gender=' + form.querySelector('#id_gender').value + ' ' : '';

		let edad1 = (form.querySelector('#edad1').value != '') ? parseInt(form.querySelector('#edad1').value) + ' ' : 0;
		let edad2 = (form.querySelector('#edad2').value != '') ? parseInt(form.querySelector('#edad2').value) + ' ' : 0;

		edad1 > edad2 ? edad2 = edad1 : '';
		edad1 == '' ? edad1 = edad2 : '';
		edad2 == '' ? edad2 = edad1 : '';

		if (edad1 != 0 && edad2 != 0) {
			datos += 'and age  BETWEEN ' + edad1 + ' AND ' + edad2 + ' ';
		}

		if (clave != '') {
			document.getElementById('div_search').hidden = false;
		} else {
			document.getElementById('div_search').hidden = true;
		}
		let id_vacancy = (form.querySelector('#id_vacancy').value != '') ? form.querySelector('#id_vacancy').value : 0;


		$('#tb_candidates_postulate').DataTable().destroy();
		var table = $('#tb_candidates_postulate').DataTable({
			ajax: {
				url: '../postulaciones/sideserver?filtros=' + datos + '&id_language=' + id_language + '&clave=' + clave + '&id_vacancy=' + id_vacancy,
				type: "POST"
			},
			processing: true,
			serverSide: true,
			"searching": false,
			"pageLength": 50,
			"columnDefs": [{
				"targets": -1,
				"data": null,
				render: function (data, type, row) { // con row obtienes la información por fila

					let botones = `<div class="btn-group btn-group-sm align-middle">`;
					console.log(data[22]);
					if (data[22] == 1 || data[22] == '' || data[22] === null) {
						botones += `	
						<button id="btn_postular" class="btn btn-warning" data-id="${data[1]} ${data[18]} ${data[19]}" value="${data[15]}">
						<i class="fas fa-check"></i>Postular
						</button>`;
					}

					botones += `<a href="../Candidato/ver&id=${data[15]}"
	                                    class="btn btn-success">
	                                    <i class="fas fa-eye"></i> Ver
	                                </a>
	                                <a href="../Candidato/editar&id=${data[15]}"
	                                    class="btn btn-info" hidden>
	                                    <i class="fas fa-pencil-alt"></i> Editar
	                                </a>
	                                <a href="../resume/generate&id=${data[15]}"
	                                    target="_blank" class="btn btn-danger" hidden>
	                                    <i class="fas fa-download"></i> Plantilla
	                                </a>
	                               `;


					if (data[17] != '') {
						botones += `
	                               <a href="${data[17]}" target="_blank" class="btn btn-orange">
	                                    <i class="fas fa-file-download"></i> CV
	                                </a></div>`;
					}
					return botones;
				}
			}, {
				"targets": 0,
				"data": null,
				"class": 'image',
				render: function (data, type, row) { // con row obtienes la información por fila
					return ` <img class="img-circle img-fluid img-responsive elevation-2"
	                                src="${data[0]}" style="width:70px; height:auto;">`
				}
			}, {
				"targets": 1,
				"data": null,
				render: function (data, type, row) { // con row obtienes la información por fila
					if (data[22] == 1 || data[22] == '' || data[22] === null) {
						return `<input type="checkbox" name="postulate[]" value="${data[15]}" class="form-control" >`;
					} else {
						return `<input type="checkbox" name="postulate[]" value="${data[15]}" disabled class="form-control" checked >`;

					}

				}
			}, {
				"targets": 2,
				"data": 1,
			}, {
				"targets": 3,
				"data": 2,
			}, {
				"targets": 4,
				"data": 3,
			}, {
				"targets": 5,
				"data": 4,
			}, {
				"targets": 6,
				"data": 5,
			}, {
				"targets": 7,
				"data": 6,
			}, {
				"targets": 8,
				"data": 7,
			}, {
				"targets": 9,
				"data": 8,
			}, {
				"targets": 10,
				"data": 9,
			}, {
				"targets": 11,
				"data": 10,
			}, {
				"targets": 12,
				"data": 11,
			}, {
				"targets": 13,
				"data": 12,
			}, {
				"targets": 14,
				"data": 13,
			}, {
				"targets": 15,
				"data": 14,
			}, {
				"targets": 16,
				"data": 24,
			}], "drawCallback": function (settings) {

				document.querySelector('#encontrados').innerHTML = 'Candidatos Encontrados : ' + settings.json.recordsFiltered;


				document.querySelector('#clean').disabled = false;
				document.querySelector('#search').disabled = false;
				let colores = ["#C295FE", "#FFEB90", "#84D4FE", "#9FFF90", "#F095FE", "#81A3FC", "#FFB47C", "#FF7C7C"];
				var cont = 0;
				$(`#tb_candidates_postulate thead tr:eq(0) th`).each(function (i) {
					if (this.classList.contains('filterhead')) {
						var select = $('<select class="form-control"  style="width: 100% !important;background-color:' + colores[cont] + '"><option value="">Sin filtro</option></select>')
							.appendTo($(this).empty())
							.on('change', function () {

								var valor_buscado = $(this).val();
								$.each($("#tb_candidates_postulate tbody tr"), function () {

									if ($(this).text().toLowerCase().indexOf(valor_buscado.toLowerCase()) === -1)
										$(this).hide();
									else
										$(this).show();
								});

							});
						table.column(i).data().unique().sort().each(function (d, j) {
							if (d != null) {
								select.append('<option value="' + d + '">' + d + '</option>')
							}

						});
						cont = cont + 1;
					}

				});
				//do whatever  
			},
		});

	}



	save_contact() {

		var form = document.querySelector("#candidate-contact-form");
		form.querySelector("#submit").disabled = true;
		var formData = new FormData(form);

		fetch('../Candidato/save_contact', {
			method: 'POST',
			body: formData
		})

			.then(response => {
				console.log(response.json());
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

						Swal.fire({
							title: 'Por favor llene todos los campos',
							icon: 'warning',
							focusConfirm: false,
							confirmButtonText:
								'Entendido!   <i class="fa fa-thumbs-up"></i>',
							confirmButtonColor: 'success',

						})

						form.querySelector("#submit").disabled = false;
					} else if (json_app.status == 1) {
						form.reset();
						Swal.fire({
							title: 'Datos enviados correctamente',
							text: "Si su perfil cumple con los requisitos de la vacante será contactado",
							icon: 'success',
							focusConfirm: false,
							confirmButtonText:
								'Entendido!',
							confirmButtonColor: 'success',

						}).then((result) => {
							console.log(result);
							if (result.value == true) {
								setTimeout(() => {
									window.location.href = "http://rrhh-ingenia.com.mx/"
								}, 1500);
							}
						})


					} else if (json_app.status == 2) {
						utils.showToast(' No se pudo guardar la informacion', 'error');
						form.querySelector("#submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					form.querySelector("#submit").disabled = false;
				}
			})
		// .catch(error => {
		// 	utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
		// 	form.querySelector("#submit").disabled = false;
		// });
	}




}