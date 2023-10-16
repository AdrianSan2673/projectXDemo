class Experience {

	create() {
		this.id = document.querySelector("#experience-form #id").value;
		this.id_candidate = document.querySelector("#experience-form #id_candidate").value;

		var form = document.querySelector("#experience-form");
		var formData = new FormData(form);
		formData.append('id_candidate', this.id_candidate);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../experiencia/create');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#experience-form #candidate_submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Experiencia creada exitosamente', 'success');
					setTimeout(() => {
						window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#experience-form #candidate_submit").disabled = false;
				}
			}
		}
	}

	update() {
		this.id = document.querySelector("#experience-form #id").value;
		this.id_candidate = document.querySelector("#experience-form #id_candidate").value;

		var form = document.querySelector("#experience-form");
		var formData = new FormData(form);
		formData.append('id', this.id);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../experiencia/update');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#experience-form #candidate_submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Experiencia actualizada exitosamente', 'success');
					setTimeout(() => {
						window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#experience-form #candidate_submit").disabled = false;
				} else {
					document.querySelector("#experience-form #candidate_submit").disabled = false;
				}
			}
		}
	}




	// ===[gabo 19 abril ver candidato] ===
	create_modal() {

		var form = document.querySelector("#save-experience-form");
		var formData = new FormData(form);
		document.querySelector("#save-experience-form #candidate_submit").disabled = true;
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../experiencia/create_modal');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;

				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						$('#modal_experiencia_candidato').modal('hide');
						document.querySelector("#save-experience-form #candidate_submit").disabled = false;
					} else if (json_app.status == 1) {
						let experiencias = json_app.experiencias;
						let exp = "";
						experiencias.forEach((element) => {

							exp = exp + `<div class="row">
					     <div class="col-md-12">
					       <h5><b> ` + element.position + `</b></h5>
						   <button value="eliminar" onclick="delete_experience('` + element.id_experience + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button> 
					       <button value="editar" onclick="update_experience('` + element.id_experience + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
					       <p class="font-italic">` + element.texto + `</p>
					       <p>` + element.review + `</p>
					       <ul>
					         <li>` + element.activity1 + `</li>
					         <li>` + element.activity2 + `</li>
					         <li>` + element.activity3 + `</li>
					         <li>` + element.activity4 + `</li>
					       </ul>
					     </div>
					   </div> `;
						});

						document.querySelector("#div_experiencia").innerHTML = exp;
						utils.showToast('Experiencia creada exitosamente', 'success');
						$('#modal_experiencia_candidato').modal('hide');
						document.querySelector("#save-experience-form #candidate_submit").disabled = false;
					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-experience-form #candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-education-form #candidate_education_submit").disabled = false;
				}
			}
		}
	}

	update_modal() {

		var form = document.querySelector("#save-experience-form");
		var formData = new FormData(form);
		document.querySelector("#save-experience-form #candidate_submit").disabled = true;

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../experiencia/update_modal');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;

				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#save-experience-form #candidate_submit").disabled = false;
					} else if (json_app.status == 1) {
						utils.showToast('Experiencia actualizada exitosamente', 'success');


						console.log(json_app.experiencias);
						let experiencias = json_app.experiencias;
						let exp = "";
						experiencias.forEach((element) => {

							exp = exp + `<div class="row">
					     <div class="col-md-12">
					       <h5><b> ` + element.position + `</b></h5>
						   <button value="eliminar" onclick="delete_experience('` + element.id_experience + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button> 
					       <button value="editar" onclick="update_experience('` + element.id_experience + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
					       <p class="font-italic">` + element.texto + `</p>
					       <p>` + element.review + `</p>
					       <ul>
					         <li>` + element.activity1 + `</li>
					         <li>` + element.activity2 + `</li>
					         <li>` + element.activity3 + `</li>
					         <li>` + element.activity4 + `</li>
					       </ul>
					     </div>
					   </div> `;

						});

						document.querySelector("#div_experiencia").innerHTML = exp;

						$('#modal_experiencia_candidato').modal('hide');
						document.querySelector("#save-experience-form #candidate_submit").disabled = false;

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-experience-form #candidate_submit").disabled = false;
				}
			}
		}
	}


	fill_experience() {
		var form = document.querySelector("#save-experience-form");
		var formData = new FormData(form);
		document.querySelector("#save-experience-form #candidate_submit").disabled = true;

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../experiencia/getOne');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-experience-form #candidate_submit").disabled = false;
					} else if (json_app.status == 1) {

						document.querySelector('#modal_experiencia_candidato [name="position"]').value = json_app.exp.position;
						document.querySelector('#modal_experiencia_candidato [name="enterprise"]').value = json_app.exp.enterprise;
						document.querySelector('#modal_experiencia_candidato [name="start_date"]').value = json_app.exp.start_date;
						document.querySelector('#modal_experiencia_candidato [name="end_date"]').value = json_app.exp.end_date;
						document.querySelector('#modal_experiencia_candidato [name="review"]').value = json_app.exp.review;
						document.querySelector('#modal_experiencia_candidato [name="activity1"]').value = json_app.exp.activity1;
						document.querySelector('#modal_experiencia_candidato [name="activity2"]').value = json_app.exp.activity2;
						document.querySelector('#modal_experiencia_candidato [name="activity3"]').value = json_app.exp.activity3;
						document.querySelector('#modal_experiencia_candidato [name="activity4"]').value = json_app.exp.activity4;


						let areas = json_app.areas;
						$("#modal_experiencia_candidato  [name='id_area']").find('option').remove();
						areas.forEach((element) => {
							if (element['id'] == json_app.exp.id_area) {

								$("#modal_experiencia_candidato [name='id_area']").append($('<option selected="selected">').val(element['id']).text(element['area']));
							} else {
								$("#modal_experiencia_candidato [name='id_area']").append($('<option>').val(element['id']).text(element['area']));
							}
						});

						let subareas = json_app.subareas;
						$("#modal_experiencia_candidato  [name='id_subarea']").find('option').remove();
						subareas.forEach((element) => {
							if (element['id'] == json_app.exp.id_subarea) {

								$("#modal_experiencia_candidato [name='id_subarea']").append($('<option selected="selected">').val(element['id']).text(element['subarea']));
							} else {
								$("#modal_experiencia_candidato [name='id_subarea']").append($('<option>').val(element['id']).text(element['subarea']));
							}
						});


						let cities = json_app.cities;
						$("#modal_experiencia_candidato  [name='id_city']").find('option').remove();
						cities.forEach((element) => {

							if (element['id'] == json_app.exp.id_city) {

								$("#modal_experiencia_candidato [name='id_city']").append($('<option selected="selected">').val(element['id']).text(element['city']));
							} else {
								$("#modal_experiencia_candidato [name='id_city']").append($('<option>').val(element['id']).text(element['city']));
							}
						});


						let states = json_app.states;
						$("#modal_experiencia_candidato  [name='id_state']").find('option').remove();
						states.forEach((element) => {
							if (element['id'] == json_app.exp.id_state) {

								$("#modal_experiencia_candidato [name='id_state']").append($('<option selected="selected">').val(element['id']).text(element['state']));
							} else {
								$("#modal_experiencia_candidato [name='id_state']").append($('<option>').val(element['id']).text(element['state']));
							}
						});



						if (json_app.exp.still_works == 1) {

							$("#still_works").attr("checked", true);
							document.querySelector("#end_date").style.display = 'none';
						} else {
							$("#still_works").attr("checked", false);
							document.querySelector("#end_date").style.display = 'block';
						}
						document.querySelector("#save-experience-form #candidate_submit").disabled = false;

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-experience-form #candidate_submit").disabled = false;
				}
			} 
		}
	}

	delete_experience(id_experience) {
		this.id_experience = id_experience;
		let xhr = new XMLHttpRequest();
		let data = `id_experience=${this.id_experience}`;
		xhr.open('POST', '../experiencia/delete_experience');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;

				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-experience-form #candidate_submit").disabled = false;
					} else if (json_app.status == 1) {
						utils.showToast('Experiencia eliminada exitosamente', 'success');

						console.log(json_app.experiencias);
						let experiencias = json_app.experiencias;
						let exp = "";
						experiencias.forEach((element) => {

							exp = exp + `<div class="row">
					     <div class="col-md-12">
					       <h5><b> ` + element.position + `</b></h5>
						   <button value="eliminar" onclick="delete_experience('` + element.id_experience + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button> 
					       <button value="editar" onclick="update_experience('` + element.id_experience + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
					       <p class="font-italic">` + element.texto + `</p>
					       <p>` + element.review + `</p>
					       <ul>
					         <li>` + element.activity1 + `</li>
					         <li>` + element.activity2 + `</li>
					         <li>` + element.activity3 + `</li>
					         <li>` + element.activity4 + `</li>
					       </ul>
					     </div>
					   </div> `;

						});


						document.querySelector("#div_experiencia").innerHTML = exp;

						$('#modal_experiencia_candidato').modal('hide');
						document.querySelector("#save-experience-form #candidate_submit").disabled = false;

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-experience-form #candidate_submit").disabled = false;
				}
			} 
		}
	}

	// ===[FIN]====


}