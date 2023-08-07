class Education {

	create() {
		this.id = document.querySelector("#education-form #id").value;
		this.id_candidate = document.querySelector("#education-form #id_candidate").value;

		var form = document.querySelector("#education-form");
		var formData = new FormData(form);
		formData.append('id_candidate', this.id_candidate);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../educacion/create');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#education-form #candidate_submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Último grado de estudios creado exitosamente', 'success');
					setTimeout(() => {
						window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#education-form #candidate_submit").disabled = false;
				}
			}
		}
	}

	update() {
		this.id = document.querySelector("#education-form #id").value;
		this.id_candidate = document.querySelector("#education-form #id_candidate").value;

		var form = document.querySelector("#education-form");
		var formData = new FormData(form);
		formData.append('id_candidate', this.id_candidate);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../educacion/update');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#education-form #candidate_submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Educación actualizada exitosamente', 'success');
					setTimeout(() => {
						window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#education-form #candidate_submit").disabled = false;
				}
			}
		}
	}



	// ===[ gabo 21 abril ver candidato]===
	fill_modal(id_candidate) {
		this.id_candidate = id_candidate;
		let xhr = new XMLHttpRequest();
		let data = `id_candidate=${this.id_candidate}`;
		xhr.open('POST', '../educacion/getOne');
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
						document.querySelector("#save-education-form #candidate_education_submit").disabled = false;
					} else if (json_app.status == 1) {

						$("#education_level").val(json_app.educacion.id_level);
						$('#education_level').trigger('change');

						document.querySelector('#modal_educacion_candidato [name="institution"]').value = json_app.educacion.institution;
						document.querySelector('#modal_educacion_candidato [name="title"]').value = json_app.educacion.title;
						document.querySelector('#modal_educacion_candidato [name="start_date_education"]').value = json_app.educacion.start_date;
						document.querySelector('#modal_educacion_candidato [name="end_date_education"]').value = json_app.educacion.end_date;

						if (json_app.educacion.still_studies == 1) {
							$('#end_date_education').removeAttr('required');
							$("#still_studies").attr("checked", true);
							document.querySelector("#end_date_education").style.display = 'none';
						} else {
							$('#end_date_education').prop('required', true);
							$("#still_studies").attr("checked", false);
							document.querySelector("#end_date_education").style.display = 'block';
						}

						document.querySelector("#save-education-form #candidate_education_submit").disabled = false;

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-education-form #candidate_education_submit").disabled = false;
				}
			}
		}
	}




	update_modal() {
		var form = document.querySelector("#save-education-form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();

		xhr.open('POST', '../educacion/update_modal');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#save-education-form #candidate_eduction_submit").disabled = false;
					} else if (json_app.status == 1) {

						let exp = `<div class="col-md-6" >
				<b class="text-muted">` + json_app.educacion.level + `</b>
				<button value="update_education" onclick="save_education('` + json_app.educacion.id_candidate + `',this)" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
				<p>` + json_app.educacion.title + `</p>
				<p>` + json_app.educacion.institution + `</p>`;

						if (json_app.educacion.start_date != "") {
							exp += `
					  <p>` + json_app.educacion.texto + `</p>
					`;
						}
						exp += `</div> `;

						utils.showToast('Educación actualizada exitosamente', 'success');
						document.querySelector("#div_education").innerHTML = exp;
						$('#modal_educacion_candidato').modal('hide');

					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-education-form #candidate_education_submit").disabled = false;
					}

				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-education-form #candidate_education_submit").disabled = false;
				}
			} 
		}


	}
	// ===[FIN]===



}